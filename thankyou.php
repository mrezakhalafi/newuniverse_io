<?php
    include_once($_SERVER['DOCUMENT_ROOT'] . '/url_function.php');
    include_once($_SERVER['DOCUMENT_ROOT'] . '/db_conn.php');
    include_once($_SERVER['DOCUMENT_ROOT'] . '/session_function.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/header-alt.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/header-alt-meta.php');

    // $entityBody = '{"FlagStatus":"00","ReasonStatus":{"Indonesian":"Sukses.","English":"Success."}}';
     $entityBody = file_get_contents('php://input');
    // $entityBody = $_POST['data'];
     $decoded = json_decode($entityBody);
     if($decoded->FlagStatus == "00"){
       $flagstatus = "sukses";
     } else {
       $flagstatus = "gagal";
     }
	

    //if($_POST){
    //  $flagstatus = "sukses";
    //} else {
    //  $flagstatus = "gagal";
    //}

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    $dbconn = getDBConn();
    $dbconn2 = getDBConnCore();
    $base_url = base_url();
    // echo "<script>base_url = '". $base_url ."';</script>";
    // echo "<script>session = ". $_SESSION['id_company'] .";</script>";

    if (isset($_GET['company'])) {
      $company_id = $_GET['company'];
    } else {
      $company_id = $_SESSION['id_company'];
    }

    // $email = $_SESSION['email'];
    $email = $_GET['email'];
    $apikey = base64_encode(microtime() . $email);

    $query = $dbconn->prepare("SELECT * FROM USER_ACCOUNT WHERE COMPANY = ?");
    $query->bind_param("i", $company_id);
    $query->execute();
    $dataUser = $query->get_result()->fetch_assoc();
    $password = MD5($dataUser['PASSWORD']);
    $user_id = $dataUser['ID'];
    $query->close();

    $query = $dbconn->prepare("SELECT * FROM COMPANY_INFO WHERE COMPANY = ?");
    $query->bind_param("i", $company_id);
    $query->execute();
    $dataCompany = $query->get_result()->fetch_assoc();
    $query->close();

    $query = $dbconn->prepare("SELECT * FROM SUBSCRIPTION_TYPE WHERE COMPANY_ID = ?");
    $query->bind_param("i", $company_id);
    $query->execute();
    $subscriptionData = $query->get_result()->fetch_assoc();
    echo "<script>transaction_id = " . $subscriptionData['ID'] . ";</script>";
    echo "<script>transaction_date = '" . $subscriptionData['DATE'] . "';</script>";
    $subscriptionType = $subscriptionData['TYPE'];
    $query->close();

    if ($_GET['price'] == '') {
      $price_item_amount = sprintf('%0.2f', $subscriptionData['PRICE']);
      $price_item_amount_rupiah = sprintf('%0.2f', round($price_item_amount * 14187.50));
      $rupiah = number_format($price_item_amount_rupiah,2,",",".");
      echo '<script language="javascript">';
      echo 'paypal_payment ='. $price_item_amount .';';
      echo 'bca_payment ='. $price_item_amount_rupiah .';';
      echo '</script>';
    } else {
      $price_item_amount = sprintf('%0.2f', $_GET['price']);
      $price_item_amount_rupiah = sprintf('%0.2f', round($price_item_amount * 14187.50));
      $rupiah = number_format($price_item_amount_rupiah,2,",",".");
      echo '<script language="javascript">';
      echo 'paypal_payment ='. $price_item_amount .';';
      echo 'bca_payment ='. $price_item_amount_rupiah .';';
      echo '</script>';
    }

    if (isset($_POST['dashboard'])) {
      //if($_POST['payment_status'] == 200){
      $paycheck = 1; //DUMMY RESPON DARI PAYPAL

      //MESSAGE NEW USER INSERT QUERY
      $msg = "New User";
      $query = $dbconn->prepare("INSERT INTO MESSAGE (COMPANY, USER_ACCOUNT, M_ID, MESSAGE_DATE, MESSAGE_DESC, IS_READ) VALUES (?,?,1, NOW(), ?, NULL)");
      $query->bind_param("iis", $company_id, $user_id, $msg);
      $query->execute();
      $query->close();

      if ($paycheck == 1) {

        $query2 = $dbconn2->prepare("INSERT INTO `ENTITY` (`id`, `name`, `is_active`, `api_key`, `created_date`, `expired_date`, `state`) VALUES (NULL, ?,1,?, NOW(), DATE_ADD(NOW(), INTERVAL 7 DAY), 1)");
        $query2->bind_param("ss", $dataCompany['COMPANY_NAME'], $apikey);
        $query2->execute();
        //mysqli_commit($dbconn2);
        $query2->close();

        $query = $dbconn->prepare("UPDATE COMPANY SET API_KEY = ? WHERE ID = ?");
        $query->bind_param("si", $apikey, $company_id);
        $query->execute();
        $query->close();

        $query = $dbconn->prepare("UPDATE USER_ACCOUNT SET STATUS = 1 WHERE COMPANY = ?");
        $query->bind_param("i", $company_id);
        $query->execute();
        $query->close();

        //update status subscribe
        $query = $dbconn->prepare("UPDATE SUBSCRIBE SET STATUS = 1 WHERE COMPANY = ?");
        $query->bind_param("i", $company_id);
        $query->execute();
        $query->close();

        //GET SUBSCRIBE ID
        $query = $dbconn->prepare("SELECT ID FROM SUBSCRIBE WHERE COMPANY = ? ORDER BY ID ASC LIMIT 1");
        $query->bind_param("i", $company_id);
        $query->execute();
        $subscribe = $query->get_result()->fetch_assoc();
        $subscribe_id = $subscribe['ID'];
        $query->close();

        //update billing
        $query = $dbconn->prepare("UPDATE BILLING SET IS_PAID = 1 WHERE COMPANY = ? AND SUBSCRIBE = ?");
        $query->bind_param("ii", $company_id, $subscribe_id);
        $query->execute();
        $query->close();

        //GET CURRENT USER_ACCOUNT
        $query = $dbconn->prepare("SELECT * FROM USER_ACCOUNT WHERE EMAIL_ACCOUNT = ?");
        $query->bind_param("s", getSession('email'));
        $query->execute();
        $user_account = $query->get_result()->fetch_assoc();
        $query->close();

        //GET BILLING ID
        $query = $dbconn->prepare("SELECT ID FROM BILLING WHERE COMPANY = ? ORDER BY ID ASC LIMIT 1");
        $query->bind_param("i", $user_account['COMPANY']);
        $query->execute();
        $bill = $query->get_result()->fetch_assoc();
        $bill_id = $bill['ID'];
        $query->close();

        //PAYMENT INSERT QUERY
        $query = $dbconn->prepare("INSERT INTO PAYMENT (PAYMENT_METHOD, BILL, COMPANY, USER, PAY_DATE) VALUES ('PAYPAL', ?, ?, ?, NOW())");
        $query->bind_param("iii", $bill_id, $user_account['ID'], $user_account['COMPANY']);
        $query->execute();
        $query->close();

        setSession('email', $email);
        setSession('password', $password);
        setSession('id_user', $user_id);
        setSession('id_company', $company_id);

        //get product
        $query = $dbconn->prepare("SELECT CHARGE FROM BILLING WHERE COMPANY = ?");
        $query->bind_param("i", getSession('id_company'));
        $query->execute();
        $package = $query->get_result()->fetch_assoc();
        $active_package = $package['CHARGE']; //price for product chosen
        $query->close();

        // invoice
        function invoiceMail($name, $orderNumber, $orderDate, $item, $price, $method){
            $content = file_get_contents('template/Payment_copy_01.html');
            $content = str_replace('*NAME*', $name, $content);
            $content = str_replace('*AMOUNT*', $price, $content);
            $content = str_replace('1A2B3C4D5EFFF', $orderNumber, $content);
            $content = str_replace('April 28, 2020', $orderDate, $content);
            $content = str_replace('ITEM1', $item, $content);
            $content = str_replace('$75', $price, $content);
            $content = str_replace('BCA: **** 5808', $method, $content);
            return $content;
        }
        $name = $user_account['USERNAME'];
        $orderNumber = $bill_id;
        $orderDate = date("F d, Y");
        $item = $dataCompany['PRODUCT_INTEREST'];
        $price = "$" . $price_item_amount;
        $method = 'PAYPAL';
        $content = invoiceMail($name, $orderNumber, $orderDate, $item, $price, $method);

        ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ // EMAIL ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

        $email = strtolower(getSession('email'));
        require $_SERVER['DOCUMENT_ROOT'] . '/PHPMailer/src/Exception.php';
        require $_SERVER['DOCUMENT_ROOT'] . '/PHPMailer/src/PHPMailer.php';
        require $_SERVER['DOCUMENT_ROOT'] . '/PHPMailer/src/SMTP.php';

        $mail = new PHPMailer();
        //$mail->SMTPDebug = 2;
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
        $mail->Subject = 'Subscription Submission';
        $mail->Body = $content;

        if (!$mail->send()) {
          $succMsg = "";
          $mail->ClearAllRecipients();
          $msg = 'Error : ' . $mail->ErrorInfo;
        } else {
          $mail->ClearAllRecipients();
          $sent = true;
        }
        ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ // END EMAIL ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

        redirect(base_url() . 'newdashboard.php');
      }
    }
?>

<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Thank You</title>

  <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css'>

</head>

<body>

  <div class="jumbotron text-xs-center">
  <?php if($flagstatus == "sukses"){ ?>
    <h1 class="display-3">Thank You!</h1>
    <p class="lead">Your payment has been processed successfully. Please continue to your dashboard to start using our services.</p>
  <?php } else { ?>
    <h1 class="display-3">Oops!</h1>
    <p class="lead">Your payment was not successfully processed. Please try again later or please try a different payment method.</p>
  <?php } ?>
  <hr>
  <p>
    Having trouble? <a href="contactus.php" style="color: #f0ad4e;">Contact us</a>
    <?php //echo("<br>" . $_POST['data']); ?>
  </p>
  <p class="lead">
  <?php if($flagstatus == "sukses"){ ?>
    <form method="post">
      <input class="btn btn-warning btn-sm" type="submit" value="Go to Dashboard" name="dashboard">
    </form>
  <?php } else { ?>
    <a href="paycheckout.php" class="btn btn-warning btn-sm" type="button">Checkout</a>
  <?php } ?>
  </p>
</div>
  <script src='https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js'></script>
  <script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js'></script>

  <div style="margin:60px auto;text-align:center;">
    <hr>
    <img src="palio_logo.png" alt="Palio.io" width="200">
    <br><br>
  </div>

</body>

</html>
