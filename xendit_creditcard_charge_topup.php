<?php session_start(); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/url_function.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/db_conn.php'); ?>
<?php

// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

require './gmail/email.php';

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

    $dbconn = getDBConn();
    $company_id = $_SESSION['id_company'];

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

    $query = $dbconn->prepare("SELECT * FROM CREDIT WHERE USER_ID = ?");
    $query->bind_param("i", $user_id);
    $query->execute();
    $dataCredit = $query->get_result()->fetch_assoc();
    $currCredit = $dataCredit['CREDIT'];
    $currency = $dataCredit['CURRENCY'];
    $query->close();

    if (!$json_result) {
        echo $result;
    } else if ($json_result->status == "FAILED") {
        echo $result;
    } else if ($json_result->status == "CAPTURED") {
        $dbconn = getDBConn();
        $amount = sprintf('%0.2f', $amount);

        //TOPUP INSERT QUERY
        $query = $dbconn->prepare("INSERT INTO TOPUP (USER_ID, CURRENCY, AMOUNT, ORDER_NUMBER) VALUES (?, ?, ?, ?)");
        $query->bind_param("isds", $user_id, $currency, $amount, $transaction_id);
        $query->execute();
        $query->close();

        $creditSum = $currCredit + $amount;
        $prepaid_quota = $creditSum / 3.975;

        $query = $dbconn->prepare("UPDATE CREDIT SET CREDIT = ?, PREPAID_QUOTA = ? WHERE COMPANY_ID = ?");
        $query->bind_param("ddi", $creditSum, $prepaid_quota, $company_id);
        $query->execute();
        $query->close();


        function invoiceMail($name, $orderNumber, $orderDate, $price, $method, $dashboard)
        {
            $item = "Top Up " . $price . " Credit";
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
        $method = 'Credit Card / Debit Card';
        $dashboard = base_url();
        $content = invoiceMail($name, $transaction_id, $orderDate, $currency . ' ' . $amount, $method, $dashboard);

        // EMAIL
        $lowerCaseMail = strtolower($email);

        $mailResp = send_email($email, $email, "Top Up Submission", $content);
        if ($mailResp == "Message has been sent") {
            // apiGen();
            // insertSession($user_id);

        } else {
            echo $mailResp;
        }
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
        // $mail->Subject = 'Top Up Submission';
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
        // }
    }

    echo $result;
}
?>