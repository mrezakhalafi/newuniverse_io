<?php

  function overQuota($user_id){

    include_once($_SERVER['DOCUMENT_ROOT'] . '/db_conn.php');

    $dbconn = getDBConn();

    $query = $dbconn->prepare("SELECT * FROM SUBSCRIPTION_TYPE WHERE USER_ID = ? ORDER BY DATE DESC LIMIT 1;");
    $query->bind_param("i", $user_id);
    $query->execute();
    $user_sub_data = $query->get_result()->fetch_assoc();
    $query->close();

    $query = $dbconn->prepare("SELECT tb.START_TIME, tb.END_TIME, tb.COMPANY, tb.USER_ID,
    SUM( IF( tb.SERVICE_NAME = 'Live Streaming', tb.BYTE, 0) ) AS LiveStreaming,
    SUM( IF( tb.SERVICE_NAME = 'Video Call', tb.BYTE, 0) ) AS VideoCall,
    SUM( IF( tb.SERVICE_NAME = 'Audio Call', tb.BYTE, 0) ) AS AudioCall,
    SUM( IF( tb.SERVICE_NAME = 'Unified Messaging', tb.BYTE, 0) ) AS UnifiedMessaging,
    SUM( IF( tb.SERVICE_NAME = 'Whiteboard', tb.BYTE, 0) ) AS Whiteboard,
    SUM( IF( tb.SERVICE_NAME = 'Screen Sharing', tb.BYTE, 0) ) AS ScreenSharing,
    SUM( IF( tb.SERVICE_NAME = 'Chatbot', tb.BYTE, 0) ) AS Chatbot,
    SUM( tb.BYTE ) AS USAGE_SUM
    FROM ( SELECT usg.ID, usg.COMPANY, usg.USER_ID, usg.BYTE, usg.START_TIME, usg.END_TIME, srv.SERVICE_NAME FROM `USAGE` usg INNER JOIN SERVICE srv ON usg.COMPONENT=srv.ID WHERE usg.USER_ID = ? ) tb
    GROUP BY tb.START_TIME;");

    $query->bind_param("i", $user_id);
    $query->execute();
    $user_sum = $query->get_result()->fetch_assoc();
    $query->close();

    if ($user_sum['USAGE_SUM'] > $user_sub_data['STORAGE']) {

      $query = $dbconn->prepare("SELECT * FROM USER_ACCOUNT WHERE ID = ?;");
      $query->bind_param("i", $user_id);
      $query->execute();
      $user_data = $query->get_result()->fetch_assoc();
      $query->close();

      $product_id = 0;
      $status_user= 0;

      // insert id product to subscribe table
      $query = $dbconn->prepare("INSERT INTO SUBSCRIBE (COMPANY, PRODUCT, START_DATE, END_DATE, STATUS) VALUES (?, ?, NOW(), DATE_ADD(NOW(), INTERVAL 30 DAY), 0)");
      $query->bind_param("ii", $user_data['COMPANY'], $product_id);
      $query->execute();
      $query->close();

      //GET SUBSCRIBE ID
      $query = $dbconn->prepare("SELECT ID FROM SUBSCRIBE WHERE COMPANY = ? ORDER BY ID ASC LIMIT 1");
      $query->bind_param("i",$user_data['COMPANY']);
      $query->execute();
      $subscribe = $query->get_result()->fetch_assoc();
      $subscribe_id = $subscribe['ID'];
      $query->close();

      if ($user_sub_data['TYPE'] == 'monthly') {
        //BILLING INSERT QUERY
        $query = $dbconn->prepare("INSERT INTO BILLING (BILL_DATE, DUE_DATE, COMPANY, SUBSCRIBE, CHARGE, CUT_OFF_DATE, IS_PAID) VALUES (NOW(), DATE_ADD(NOW(), INTERVAL 30 DAY), ?, ?, ?, DATE_ADD(NOW(), INTERVAL 37 DAY), 0)");
        $query->bind_param("iid", $user_data['COMPANY'], $subscribe_id, $user_sub_data['PRICE']);
        $query->execute();
        $query->close();
      } else if ($user_sub_data['TYPE'] == 'annual') {
        //BILLING INSERT QUERY
        $query = $dbconn->prepare("INSERT INTO BILLING (BILL_DATE, DUE_DATE, COMPANY, SUBSCRIBE, CHARGE, CUT_OFF_DATE, IS_PAID) VALUES (NOW(), DATE_ADD(NOW(), INTERVAL 365 DAY), ?, ?, ?, DATE_ADD(NOW(), INTERVAL 372 DAY), 0)");
        $query->bind_param("iid", $user_data['COMPANY'], $subscribe_id, $user_sub_data['PRICE']);
        $query->execute();
        $query->close();
      }

      // update status account
      $query = $dbconn->prepare("UPDATE USER_ACCOUNT SET STATUS = ? WHERE ID = ?");
      $query->bind_param("ii", $status_user, $user_data['ID']);
      $query->execute();
      $query->close();

      function invoiceMail($username, $activation_link){
          $content = file_get_contents('template/overquota_reminder.html');
          $content = str_replace('*NAME*', $username, $content);
          $content = str_replace('replace_this_link', $activation_link, $content);
          return $content;
      }

      $activation_link = "http://103.94.169.26:8081/paycheckout.php?company=" . $user_data['COMPANY'] . "&price=". $user_sub_data['PRICE'];
      $content = invoiceMail($user_data['USERNAME'], $activation_link);

      ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ // EMAIL ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
      require $_SERVER['DOCUMENT_ROOT'] . '/PHPMailer/src/Exception.php';
      require $_SERVER['DOCUMENT_ROOT'] . '/PHPMailer/src/PHPMailer.php';
      require $_SERVER['DOCUMENT_ROOT'] . '/PHPMailer/src/SMTP.php';

      $mail = new PHPMailer\PHPMailer\PHPMailer();
      $mail->isSMTP();
      $mail->Host       = 'smtp.gmail.com';
      $mail->SMTPAuth   = true;
      $mail->Username   = 'support@palio.io';
      $mail->Password   = '12345easySoft67890';
      $mail->SMTPSecure = 'tls';
      $mail->Port       = 587;

      //Recipients
      $mail->setFrom('support@palio.io', 'Palio');
      $mail->addAddress($user_data['EMAIL_ACCOUNT']);
      $mail->addReplyTo('support@palio.io');

      $mail->isHTML(true);
      $mail->Subject = 'Over Quota Reminder';
      $mail->Body = $content;

      $mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'].'/template/FreeTrial_files/image002.png','image002','images002.png');
      $mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'].'/template/FreeTrial_files/image004.png','image004','images004.png');
      $mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'].'/template/FreeTrial_files/image006.png','image006','images006.png');
      $mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'].'/template/FreeTrial_files/image008.png','image008','images008.png');
      $mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'].'/template/FreeTrial_files/image010.png','image010','images010.png');
      $mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'].'/template/FreeTrial_files/image012.png','image012','images012.png');
      $mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'].'/template/FreeTrial_files/image014.png','image014','images014.png');

      if (!$mail->send()) {
        $succMsg = "";
        $mail->ClearAllRecipients();
        $msg = 'Error : ' . $mail->ErrorInfo;
      } else {
        $mail->ClearAllRecipients();
        $sent = true;
      }
      ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ // END EMAIL ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

      // payment reminder
      $msg = "Over Quota Reminder";
      $query = $dbconn->prepare("INSERT INTO MESSAGE (COMPANY, USER_ACCOUNT, M_ID, MESSAGE_DATE, MESSAGE_DESC, IS_READ) VALUES (?,?,7, NOW(), ?, NULL)");
      $query->bind_param("iis", $user_data['COMPANY'], $user_data['ID'], $msg);
      $query->execute();
      $query->close();

    }

  }

?>
