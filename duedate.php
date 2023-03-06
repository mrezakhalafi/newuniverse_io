<?php
  function serviceEnd(){
    global $dbconn;
    global $today;
    $due_date_min = date('Y-m-d H:i:s', strtotime($due_date . ' - 1 days')); //day before due date
    $tomorrow = new DateTime('tomorrow');
    $newDate = $tomorrow->format('d/m/Y');
    $email = getSession('email');
    $company = getSession('id_company');
    $id_user = getSession('id_user');

    if ($due_date_min < $today) {
      $msg = "Due Date Reminder";
      $query = $dbconn->prepare("INSERT INTO MESSAGE (COMPANY, USER_ACCOUNT, M_ID, MESSAGE_DATE, MESSAGE_DESC, IS_READ) VALUES (?,?,6, NOW(), ?, NULL)");
      $query->bind_param("iis", $company, $id_user, $msg);
      $query->execute();
      $query->close();

      // START EMAIL
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
      $mail->addAddress($email);
      $mail->addReplyTo('support@palio.io');

      $mail->isHTML(true);
      $mail->Subject = 'Reminder: Due Date';
      $mail->Body = "Dear user...<br>
      Due Date Reminder:<br>
      To continue using our services, you have to make a repayment before " . $newDate . ".
      <br>
      Thank you.<br>
      With Regards<br>
      Palio<br>
      ";

      if (!$mail->send()) {
          $succMsg = "";
          $mail->ClearAllRecipients();
          $msg = 'Error : ' . $mail->ErrorInfo;
      } else {
          $mail->ClearAllRecipients();
          $sent = true;
          $msg = 'Sent';
      }
      // END EMAIL
    }
  }

 ?>
