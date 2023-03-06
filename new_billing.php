<?php
  include_once($_SERVER['DOCUMENT_ROOT'] . '/url_function.php');
  include_once($_SERVER['DOCUMENT_ROOT'] . '/db_conn.php');

//   ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;

  function newBilling(){

    $dbconn = getDBConn();
    $company_id = getSession('id_company');
    $product_id = 0;
    $status_user = 0;
    $user_id = getSession('id_user');
    $email = getSession('email');
    // $charge = 33.5;

    if ($_SESSION['geolocSts'] == 0 && $_SESSION['language'] == 1) {
        $currency = 'IDR';
        $charge = 450000.00;
    } else {
        // $currency = 'USD';
        // $charge = 33.50;
        if ($_SESSION['country_code'] == 'ID') {
          $currency = 'IDR';
            $charge = 450000.00;
        } else {
          $currency = 'USD';
            $charge = 33.50;
        }
    }

    // get user info
    $query = $dbconn->prepare("SELECT * FROM USER_ACCOUNT WHERE ID = ?");
    $query->bind_param("i", $user_id);
    $query->execute();
    $user = $query->get_result()->fetch_assoc();
    $username = $user['USERNAME'];
    $query->close();

    // get credit info
    $query = $dbconn->prepare("SELECT * FROM CREDIT WHERE COMPANY_ID = ?");
    $query->bind_param("i", $company_id);
    $query->execute();
    $credit = $query->get_result()->fetch_assoc();
    $query->close();

    //get user currency
    $query = $dbconn->prepare("SELECT * FROM BILLING WHERE COMPANY = ? ORDER BY DUE_DATE DESC");
    $query->bind_param("i", $company_id);
    $query->execute();
    $bill = $query->get_result()->fetch_assoc();
    if($bill['CURRENCY'] != null){
      if($bill['CURRENCY'] == 'IDR'){
          $currency = 'IDR';
          $charge = 450000.00;
      } else {
          // $currency = 'USD';
          // $charge = 33.50;
          if ($_SESSION['country_code'] == 'ID') {
            $currency = 'IDR';
              $charge = 450000.00;
          } else {
            $currency = 'USD';
              $charge = 33.50;
          }
      }
    } else {
      if ($_SESSION['country_code'] == 'ID') {
        $currency = 'IDR';
          $charge = 450000.00;
      } else {
        $currency = 'USD';
          $charge = 33.50;
      }
    }
    $query->close();

    if($bill['IS_PAID'] == 0){

      // UNPAID BILL, SET ACCOUNT INACTIVE (ACTIVE = 0) && STATE = 2 (VERIFIED BUT NOT PAID);
      $query = $dbconn->prepare("UPDATE USER_ACCOUNT SET ACTIVE = 0, STATE = 2 WHERE ID = ?");
      $query->bind_param("i", $_SESSION['id_user']);
      $query->execute();
      $query->close();

      // echo "NOT PAID";
      redirect(base_url() . 'checkout.php');  
      die();

    } else {

      // UNPAID BILL, SET ACCOUNT INACTIVE (ACTIVE = 0) && STATE = 2 (VERIFIED BUT NOT PAID);
      $query = $dbconn->prepare("UPDATE USER_ACCOUNT SET ACTIVE = 0, STATE = 2 WHERE ID = ?");
      $query->bind_param("i", $_SESSION['id_user']);
      $query->execute();
      $query->close();

      // insert id product to subscribe table
      $query = $dbconn->prepare("INSERT INTO SUBSCRIBE (COMPANY, PRODUCT, START_DATE, END_DATE, STATUS) VALUES (?, ?, NOW(), DATE_ADD(NOW(), INTERVAL 30 DAY), 0)");
      $query->bind_param("ii", $company_id, $product_id);
      $query->execute();
      $subscribe_id = $query->insert_id;
      $query->close();

      //check order number availability
      do {
        $bytes = random_bytes(8);
        $hexbytes = strtoupper(bin2hex($bytes));
        $order_number = substr($hexbytes, 0, 15);

        $query = $dbconn->prepare("SELECT COUNT(*) as counter_bill FROM BILLING WHERE ORDER_NUMBER = ?");
        $query->bind_param("s", $order_number);
        $query->execute();
        $counter = $query->get_result()->fetch_assoc();
        $counter_bill = $counter['counter_bill'];
        $query->close();
      } while ($counter_bill > 0);

      //BILLING INSERT QUERY
      $query = $dbconn->prepare("INSERT INTO BILLING (ORDER_NUMBER, BILL_DATE, DUE_DATE, COMPANY, SUBSCRIBE, CURRENCY, CHARGE, CUT_OFF_DATE, IS_PAID) VALUES (?, NOW(), DATE_ADD(NOW(), INTERVAL 30 DAY), ?, ?, ?, ?, DATE_ADD(NOW(), INTERVAL 37 DAY), 0)");
      $query->bind_param("siisd", $order_number, $company_id, $subscribe_id, $currency, $charge);
      $query->execute();
      $query->close();

      if($credit['CREDIT'] > $charge){
        $rich = 1;
      } else {
        $rich = 0;
      }

      function invoiceMail($username, $activation_link, $rich, $order_number)
      {
        $content = file_get_contents(base_url() . 'template/payment_reminder.html');
        $content = str_replace('*NAME*', $username, $content);
        $content = str_replace('replace_this_link', $activation_link, $content);
        if($rich == 1){
          $content = str_replace("As a
            reminder, when your subscription ends you won't be able to access our
            features.", "As a reminder, you still have some balance in your prepaid account. If you want to use your remaining balance to pay, please click <a href='" . base_url() . "pay_prepaid.php?order=" . $order_number ."'>here</a> instead.", $content);
        }
        return $content;
      }

      $activation_link = base_url() . "checkout.php";
      $content = invoiceMail($username, $activation_link, $rich, $order_number);

      ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ // EMAIL ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
      require $_SERVER['DOCUMENT_ROOT'] . '/PHPMailer/src/Exception.php';
      require $_SERVER['DOCUMENT_ROOT'] . '/PHPMailer/src/PHPMailer.php';
      require $_SERVER['DOCUMENT_ROOT'] . '/PHPMailer/src/SMTP.php';

      $mail = new PHPMailer();
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
      $mail->Subject = 'Payment Reminder';
      $mail->Body = $content;

      $mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'] . '/template/FreeTrial_files/image002.png', 'image002', 'images002.png');
      $mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'] . '/template/FreeTrial_files/image004.png', 'image004', 'images004.png');
      $mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'] . '/template/FreeTrial_files/image006.png', 'image006', 'images006.png');
      $mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'] . '/template/FreeTrial_files/image008.png', 'image008', 'images008.png');
      $mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'] . '/template/FreeTrial_files/image010.png', 'image010', 'images010.png');
      $mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'] . '/template/FreeTrial_files/image012.png', 'image012', 'images012.png');
      $mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'] . '/template/FreeTrial_files/image014.png', 'image014', 'images014.png');

      if (!$mail->send()) {
        $succMsg = "";
        $mail->ClearAllRecipients();
        $msg = 'Error : ' . $mail->ErrorInfo;
      } else {
        $mail->ClearAllRecipients();
        $sent = true;
      }
      // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ // END EMAIL ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

      // payment reminder
      $msg = "Payment Reminder";
      $query = $dbconn->prepare("INSERT INTO MESSAGE (COMPANY, USER_ACCOUNT, M_ID, MESSAGE_DATE, MESSAGE_DESC, IS_READ) VALUES (?,?,4, NOW(), ?, NULL)");
      $query->bind_param("iis", $company_id, $user_id, $msg);
      $query->execute();
      $query->close();

      redirect(base_url() . 'checkout.php');

    }

  }

  // untuk billing kalo ce_quota habis
  if (isset($_POST['company_id']) && isset($_POST['quota_exceeded'])){

    $dbconn = getDBConn();
    $company_id = $_POST['company_id'];
    $product_id = 0;

    // get user info
    $query = $dbconn->prepare("SELECT * FROM USER_ACCOUNT WHERE COMPANY = ?");
    $query->bind_param("i", $company_id);
    $query->execute();
    $user = $query->get_result()->fetch_assoc();
    $username = $user['USERNAME'];
    $email = $user['EMAIL_ACCOUNT'];
    $query->close();

    //get user currency
    $query = $dbconn->prepare("SELECT * FROM BILLING WHERE COMPANY = ? ORDER BY DUE_DATE DESC");
    $query->bind_param("i", $company_id);
    $query->execute();
    $bill = $query->get_result()->fetch_assoc();
    if($bill['CURRENCY'] == 'IDR'){
        $currency = 'IDR';
        $charge = 450000.00;
    } else {
        $currency = 'USD';
        $charge = 33.50;
    }
    $query->close();

    function invoiceMail($username, $activation_link)
    {
      $content = file_get_contents('template/payment_reminder.html');
      $content = str_replace('*NAME*', $username, $content);
      $content = str_replace('Your subscription is on grace period', 'Your usage has exceeded your credit', $content);
      $content = str_replace('your subscription
            is now on a grace period', 'your usage has exceeded your credit', $content);
      $content = str_replace('when your subscription ends', 'when your usage has exceeded', $content);
      $content = str_replace('replace_this_link', $activation_link, $content);
      return $content;
    }

    $activation_link = base_url() . 'topup.php';
    $content = invoiceMail($username, $activation_link);

    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ // EMAIL ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    require $_SERVER['DOCUMENT_ROOT'] . '/PHPMailer/src/Exception.php';
    require $_SERVER['DOCUMENT_ROOT'] . '/PHPMailer/src/PHPMailer.php';
    require $_SERVER['DOCUMENT_ROOT'] . '/PHPMailer/src/SMTP.php';

    $mail = new PHPMailer();
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
    $mail->Subject = 'Payment Reminder';
    $mail->Body = $content;

    $mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'] . '/template/FreeTrial_files/image002.png', 'image002', 'images002.png');
    $mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'] . '/template/FreeTrial_files/image004.png', 'image004', 'images004.png');
    $mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'] . '/template/FreeTrial_files/image006.png', 'image006', 'images006.png');
    $mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'] . '/template/FreeTrial_files/image008.png', 'image008', 'images008.png');
    $mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'] . '/template/FreeTrial_files/image010.png', 'image010', 'images010.png');
    $mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'] . '/template/FreeTrial_files/image012.png', 'image012', 'images012.png');
    $mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'] . '/template/FreeTrial_files/image014.png', 'image014', 'images014.png');

    if (!$mail->send()) {
      $succMsg = "";
      $mail->ClearAllRecipients();
      $msg = 'Error : ' . $mail->ErrorInfo;
      echo $msg;
    } else {
      $mail->ClearAllRecipients();
      $sent = true;
      echo 'Email sent!';
    }
    // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ // END EMAIL ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

  }
