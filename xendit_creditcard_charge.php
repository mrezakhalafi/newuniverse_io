<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/db_conn.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/session_insert.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/api_generator_2.php'); ?>
<?php

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

require './gmail/email.php';

// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;

// TEST MODE ( base64( 'secret api key' + ':' ) )
// eG5kX2RldmVsb3BtZW50X2s3WE5VUVczd05oUUpseEF6TVd0N1hNYm40MkVEMENjc3VzejNXQ21GbWd0eHUzNVVnRGJFdFdLTnFVRWE1Sjo=
// oldeG5kX2RldmVsb3BtZW50X3RCTnkxZGRWb2pjcEN1M0ZjQjdJbHhybDNFZnFUY3V0akp4eGxMQzJrcWNtcUc4TFdFYll2VDF1VFFoVmo6
$secretKey = "eG5kX2RldmVsb3BtZW50X2s3WE5VUVczd05oUUpseEF6TVd0N1hNYm40MkVEMENjc3VzejNXQ21GbWd0eHUzNVVnRGJFdFdLTnFVRWE1Sjo=";

// LIVE MODE
// $secretKey = "eG5kX3Byb2R1Y3Rpb25fOWRiV1ptd2k4SDducThhSG4xdFB4bzdzd0QxQU9nNDFaSVNZdHlNQnhDZE4zOEFYQzJiYjJjYTFsUGx4Og==";

//To send email
function send_email($email_address, $email_dest, $subject, $body)
{
    try {
        // Get the API client and construct the service object.
        $client = getClient();
        $service = new Google_Service_Gmail($client);

        $message = createMessage('support@palio.io', $email_dest, $subject, $body);
        sendMessage($service, 'support@palio.io', $message);

        return 'Message has been sent';
    } catch (Exception $e) {

        return "Message could not be sent. Mailer Error: {$e}";
    }
}

if (isset($_POST["token_id"])) {
    $company_id = $_POST["company_id"];
    $transaction_id = $_POST["transaction_id"];
    $token_id = $_POST["token_id"];
    $external_id = round(microtime(true) * 1000) + 1;
    $amount = $_POST["amount"];
    $cvv = $_POST["cvv"];

    // xendit api
    $url = "https://api.xendit.co/credit_card_charges";
    $data = array(
        'token_id' => $token_id,
        'external_id' => strval($external_id),
        'amount' => $amount,
        'card_cvn' => $cvv
    );

    $options = array(
        'http' => array(
            'header'  =>
            "Authorization: Basic " . $secretKey . "\r\n" .
                "Content-type: application/json\r\n",
            'method'  => 'POST',
            'content' => strval(json_encode($data))
        )
    );
    $stream = stream_context_create($options);
    $result = file_get_contents($url, false, $stream);
    $json_result = json_decode($result);
    // end xendit api

    $query = $dbconn->prepare("SELECT * FROM USER_ACCOUNT WHERE COMPANY = ?");
    $query->bind_param("i", $company_id);
    $query->execute();
    $dataUser = $query->get_result()->fetch_assoc();
    $password = MD5($dataUser['PASSWORD']);
    $user_id = $dataUser['ID'];
    $email = $dataUser['EMAIL_ACCOUNT'];
    $query->close();

    $query = $dbconn->prepare("SELECT * FROM COMPANY WHERE ID = ?");
    $query->bind_param("i", $company_id);
    $query->execute();
    $company = $query->get_result()->fetch_assoc();
    $apikey = $company['API_KEY'];
    $query->close();

    $query = $dbconn->prepare("SELECT * FROM CREDIT WHERE COMPANY_ID = ?");
    $query->bind_param("i", $company_id);
    $query->execute();
    $credit_data = $query->get_result()->fetch_assoc();
    $query->close();

    $query = $dbconn->prepare("SELECT * FROM BILLING WHERE COMPANY = ? ORDER BY ID DESC");
    $query->bind_param("i", $company_id);
    $query->execute();
    $dataBilling = $query->get_result()->fetch_assoc();
    $query->close();

    if (!$json_result) {
        echo $result;
    } else if ($json_result->status == "FAILED") {
        echo $result;
    } else if ($json_result->status == "CAPTURED") {
        $dbconn = getDBConn();

        if ($dataUser['STATUS'] == 3 && $dataBilling['IS_PAID'] == 1) {
            // TRIAL TO SUBSCRIBE

            $product_id = 0;
            $currency = 'IDR';
            $charge = 450000.00;

            // insert id product to subscribe table
            $query = $dbconn->prepare("INSERT INTO SUBSCRIBE (COMPANY, PRODUCT, START_DATE, END_DATE, STATUS) VALUES (?, ?, NOW(), DATE_ADD(NOW(), INTERVAL 30 DAY), 0)");
            $query->bind_param("ii", $company_id, $product_id);
            $query->execute();
            $subscribe_id = $query->insert_id;
            $query->close();

            //BILLING INSERT QUERY
            $query = $dbconn->prepare("INSERT INTO BILLING (ORDER_NUMBER, BILL_DATE, DUE_DATE, COMPANY, SUBSCRIBE, CURRENCY, CHARGE, CUT_OFF_DATE, IS_PAID) VALUES (?, NOW(), DATE_ADD(NOW(), INTERVAL 30 DAY), ?, ?, ?, ?, DATE_ADD(NOW(), INTERVAL 37 DAY), 0)");
            $query->bind_param("siisd", $transaction_id, $company_id, $subscribe_id, $currency, $charge);
            $query->execute();
            $bill_id = $query->insert_id;
            $query->close();
            // END CREATE NEW BILLING FOR USER
        } else {
            // NEW BILLING
            $query = $dbconn->prepare("SELECT * FROM SUBSCRIBE WHERE COMPANY = ? AND STATUS = 0");
            $query->bind_param("i", $company_id);
            $query->execute();
            $subscribe = $query->get_result()->fetch_assoc();
            $subscribe_id = $subscribe['ID'];
            $query->close();

            $query = $dbconn->prepare("SELECT * FROM BILLING WHERE COMPANY = ? AND SUBSCRIBE = ?");
            $query->bind_param("ii", $company_id, $subscribe_id);
            $query->execute();
            $subscriptionData = $query->get_result()->fetch_assoc();
            $bill_id = $subscriptionData['ID'];
            $currency = $subscriptionData['CURRENCY'];
            $query->close();
        }

        $query = $dbconn->prepare("SELECT *, COUNT(*) as cnt FROM BILLING WHERE ID = ?");
        $query->bind_param("i", $bill_id);
        $query->execute();
        $subscriptionData = $query->get_result()->fetch_assoc();
        $cnt = $subscriptionData['cnt'];
        $query->close();

        if ($cnt > 0) {

            // update status company
            $query = $dbconn->prepare("UPDATE COMPANY SET STATUS = 1 WHERE ID = ? AND STATUS = 0");
            $query->bind_param("i", $company_id);
            $query->execute();
            $query->close();

            $query = $dbconn->prepare("SELECT * FROM COMPANY_INFO WHERE COMPANY = ?");
            $query->bind_param("i", $company_id);
            $query->execute();
            $dataCompany = $query->get_result()->fetch_assoc();
            $query->close();

            $query = $dbconn->prepare("SELECT * FROM BILLING WHERE ID = ?");
            $query->bind_param("i", $bill_id);
            $query->execute();
            $subscriptionData = $query->get_result()->fetch_assoc();
            $subscriptionType = $subscriptionData['ORDER_TYPE'];
            $orderNumber = $subscriptionData['ORDER_NUMBER'];
            $query->close();

            $msg = "New User";
            $query = $dbconn->prepare("INSERT INTO MESSAGE (COMPANY, USER_ACCOUNT, M_ID, MESSAGE_DATE, MESSAGE_DESC, IS_READ) VALUES (?,?,11, NOW(), ?, NULL)");
            $query->bind_param("iis", $company_id, $user_id, $msg);
            $query->execute();
            $query->close();

            $queryUpdateInfo = $dbconn->prepare("REPLACE INTO COMP_FEATURE (`COMPANY_ID`, `TYPE`, `VALUE`) VALUES (". $company_id.",1, 1)");
      $queryUpdateInfo->execute();
      $queryUpdateInfo->close();
      

      $queryUpdateInfo = $dbconn->prepare("REPLACE INTO COMP_FEATURE (`COMPANY_ID`, `TYPE`, `VALUE`) VALUES (". $company_id.",2, 1)");
      $queryUpdateInfo->execute();
      $queryUpdateInfo->close();

      $queryUpdateInfo = $dbconn->prepare("REPLACE INTO COMP_FEATURE (`COMPANY_ID`, `TYPE`, `VALUE`) VALUES (". $company_id.",3, 1)");
      $queryUpdateInfo->execute();
      $queryUpdateInfo->close();

      $queryUpdateInfo = $dbconn->prepare("REPLACE INTO COMP_FEATURE (`COMPANY_ID`, `TYPE`, `VALUE`) VALUES (". $company_id.",4, 1)");
      $queryUpdateInfo->execute();
      $queryUpdateInfo->close();

      $queryUpdateInfo = $dbconn->prepare("REPLACE INTO COMP_FEATURE (`COMPANY_ID`, `TYPE`, `VALUE`) VALUES (". $company_id.",5, 1)");
      $queryUpdateInfo->execute();
      $queryUpdateInfo->close();

      $queryUpdateInfo = $dbconn->prepare("REPLACE INTO COMP_FEATURE (`COMPANY_ID`, `TYPE`, `VALUE`) VALUES (". $company_id.",6, 1)");
      $queryUpdateInfo->execute();
      $queryUpdateInfo->close();

      $queryUpdateInfo = $dbconn->prepare("REPLACE INTO COMP_FEATURE (`COMPANY_ID`, `TYPE`, `VALUE`) VALUES (". $company_id.",7, 1)");
      $queryUpdateInfo->execute();
      $queryUpdateInfo->close();

            //update status subscribe
            $query = $dbconn->prepare("UPDATE SUBSCRIBE SET STATUS = 1 WHERE ID = ?");
            $query->bind_param("i", $subscribe_id);
            $query->execute();
            $query->close();

            //update billing
            $query = $dbconn->prepare("UPDATE BILLING SET IS_PAID = 1 WHERE ID = ?");
            $query->bind_param("i", $bill_id);
            $query->execute();
            $query->close();

            //PAYMENT INSERT QUERY
            $query = $dbconn->prepare("INSERT INTO PAYMENT (PAYMENT_METHOD, BILL, COMPANY, USER, PAY_DATE) VALUES ('Credit Card / Debit Card', ?, ?, ?, NOW())");
            $query->bind_param("iii", $bill_id, $company_id, $user_id);
            $query->execute();
            $query->close();

            $expire_date = strtotime('+30 days') * 1000;

            // insert apikey to nusdk server
            $api_url = "http://192.168.1.100:8004/webrest/";
            $api_data = array(
                'code' => 'REGBE',
                'data' => array(
                    'company_id' => $company_id,
                    'name' => $dataCompany['COMPANY_NAME'],
                    'api_key' => $apikey,
                    'expire_date' => $expire_date,
                    'private_key' => $_SESSION['password'],
                    'is_trial' => 0,
                    'is_anonymous' => 1,
                ),

            );

            $api_options = array(
                'http' => array(
                    'header'  =>
                    // "Authorization: ".$secretKey."\r\n".
                    "Content-type: application/json\r\n",
                    'method'  => 'POST',
                    'content' => strval(json_encode($api_data))
                )
            );

            $api_stream = stream_context_create($api_options);
            $api_result = file_get_contents($api_url, false, $api_stream);
            $api_json_result = json_decode($api_result);
            // end apikey

            $query = $dbconn->prepare("UPDATE USER_ACCOUNT SET STATUS = 1, ACTIVE = 1, STATE = 3 WHERE COMPANY = ?");
            $query->bind_param("i", $company_id);
            $query->execute();
            $query->close();

            if ($credit_data['PREPAID_QUOTA'] < 0) {

                $ce_quota = 17800000 + $credit_data['PREPAID_QUOTA'];

                $query = $dbconn->prepare("UPDATE CREDIT SET CREDIT = 0, PREPAID_QUOTA = 0, CE_QUOTA = ? WHERE COMPANY_ID = ?");
                $query->bind_param("di", $ce_quota, $company_id);
                $query->execute();
                $query->close();
            } else {

                $query = $dbconn->prepare("UPDATE CREDIT SET CE_QUOTA = 17800000 WHERE COMPANY_ID = ?");
                $query->bind_param("i", $company_id);
                $query->execute();
                $query->close();
            }

            // $dbconncore = getDBConnCore();
            // $query = $dbconncore->prepare("UPDATE BUSINESS_ENTITY SET EC_DATE = DATE_ADD(NOW(), INTERVAL 30 DAY) WHERE COMPANY_ID = ?");
            // $query->bind_param("i", $company_id);
            // $query->execute();
            // $query->close();

            function invoiceMail($name, $orderNumber, $orderDate, $price, $method, $dashboard)
            {
                $item = "Up to 5,000,000 Monthly Text Recipients, Up to 50,000 Monthly Image Recipients, Up to 5,000 Monthly Video Recipients, Up to 3,000 Monthly Minutes Livestream Recipients, Up to 50,000 Monthly Minutes 1-1 VoIP Calls, Up to 500 Monthly Minutes 1-1 Video Calls";
                $content = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/template/Payment_copy_01.html');
                $content = str_replace('*NAME*', $name, $content);
                $content = str_replace('*AMOUNT*', $price, $content);
                $content = str_replace('1A2B3C4D5EFFF', $orderNumber, $content);
                $content = str_replace('April 28, 2020', $orderDate, $content);
                $content = str_replace('ITEM1', $item, $content);
                $content = str_replace('$75', $price, $content);
                $content = str_replace('BCA: **** 5808', $method, $content);
                $content = str_replace('http://103.94.169.26:8081/', $dashboard, $content);
                return $content;
            }

            $name = $dataUser['USERNAME'];
            $orderDate = date("F d, Y");
            // $price = $active_package;
            $price = $amount;
            $method = 'Credit Card / Debit Card';
            $dashboard = base_url();
            $content = invoiceMail($name, $orderNumber, $orderDate, $currency . ' ' . $price, $method, $dashboard);

            $mailResp = send_email($email, $email, "Subscription Submission", $content);
            if ($mailResp == "Message has been sent") {
                apiGen();
                insertSession($user_id);
            } else {
                echo $mailResp;
            }
            

            // EMAIL
            // $lowerCaseMail = strtolower($email);
            // require $_SERVER['DOCUMENT_ROOT'] . '/PHPMailer/src/Exception.php';
            // require $_SERVER['DOCUMENT_ROOT'] . '/PHPMailer/src/PHPMailer.php';
            // require $_SERVER['DOCUMENT_ROOT'] . '/PHPMailer/src/SMTP.php';

            // $mail = new PHPMailer();
            // //$mail->SMTPDebug = 2;
            // $mail->isSMTP();
            // $mail->Host       = 'smtp.gmail.com';
            // $mail->SMTPAuth   = true;
            // $mail->Username   = 'support@palio.io';
            // $mail->Password   = '12345easySoft67890';
            // $mail->SMTPSecure = 'tls';
            // $mail->Port       = 587;

            // //Recipients
            // $mail->setFrom('support@palio.io', 'Palio');
            // $mail->addAddress($lowerCaseMail);
            // $mail->addReplyTo('support@palio.io');

            // $mail->isHTML(true);
            // $mail->Subject = 'Subscription Submission';
            // $mail->Body = $content;
            // $mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'] . '/template/PalioEmailConfirmation_files/image003.png', 'ccimage', 'images003.png');
            // $mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'] . '/new_palio_logo.png', 'logoimage', 'logo.png');

            // if (!$mail->send()) {
            //     $succMsg = "";
            //     $mail->ClearAllRecipients();
            //     $msg = 'Error Mailler: ' . $mail->ErrorInfo;
            //     echo $msg;
            // } else {
            //     $mail->ClearAllRecipients();
            //     $sent = true;

            //     apiGen();
            //     // insert session into db
            //     insertSession($user_id);
            // }
        }

        echo $result;
    }
}
?>