<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/url_function.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/db_conn.php'); ?>
<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$dbconn = getDBConn();

// get the order number
$orderNumber = $_GET['order'];

// get the user 
$query = $dbconn->prepare("SELECT * FROM BILLING WHERE ORDER_NUMBER = ?");
$query->bind_param("s", $orderNumber);
$query->execute();
$subscriptionData = $query->get_result()->fetch_assoc();
$query->close();

if ($subscriptionData == null || $subscriptionData['IS_PAID'] == 1) {
    // order not exist or alreadt been paid
    redirect(base_url());
} else {
    // order exist
    $subscribe_id = $subscriptionData['SUBSCRIBE'];
    $bill_id = $subscriptionData['ID'];
    $currency = $subscriptionData['CURRENCY'];
    $charge = $subscriptionData['CHARGE'];
    $company_id = $subscriptionData['COMPANY'];
    $subscriptionType = $subscriptionData['ORDER_TYPE'];

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

    $msg = "New User";
    $query = $dbconn->prepare("INSERT INTO MESSAGE (COMPANY, USER_ACCOUNT, M_ID, MESSAGE_DATE, MESSAGE_DESC, IS_READ) VALUES (?,?,1, NOW(), ?, NULL)");
    $query->bind_param("iis", $company_id, $user_id, $msg);
    $query->execute();
    $query->close();

    $queryUpdateInfo = $dbconn->prepare("REPLACE INTO COMP_FEATURE (`COMPANY_ID`, `TYPE`, `VALUE`) VALUES (" . $company_id . ",1, 1)");
    $queryUpdateInfo->execute();
    $queryUpdateInfo->close();

    $queryUpdateInfo = $dbconn->prepare("REPLACE INTO COMP_FEATURE (`COMPANY_ID`, `TYPE`, `VALUE`) VALUES (" . $company_id . ",2, 1)");
    $queryUpdateInfo->execute();
    $queryUpdateInfo->close();

    $queryUpdateInfo = $dbconn->prepare("REPLACE INTO COMP_FEATURE (`COMPANY_ID`, `TYPE`, `VALUE`) VALUES (" . $company_id . ",3 , 1)");
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
    $query = $dbconn->prepare("INSERT INTO PAYMENT (PAYMENT_METHOD, BILL, COMPANY, USER, PAY_DATE) VALUES ('Prepaid Balance', ?, ?, ?, NOW())");
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

    if ($currency == 'IDR') {

        $prepaid_balance = $credit_data['CREDIT'] - 450000;
        $prepaid_quota = $credit_data['PREPAID_QUOTA'] - 113207.5471698113;
    } else {

        $prepaid_balance = $credit_data['CREDIT'] - 33.5;
        $prepaid_quota = $credit_data['PREPAID_QUOTA'] - 126415.0943396226;
    }

    $query = $dbconn->prepare("UPDATE CREDIT SET CREDIT = ?, PREPAID_QUOTA = ?, CE_QUOTA = 17800000 WHERE COMPANY_ID = ?");
    $query->bind_param("ddi", $prepaid_balance, $prepaid_quota, $company_id);
    $query->execute();
    $query->close();

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
    $price = $charge;
    $method = 'Prepaid Balance';
    $dashboard = base_url();
    $content = invoiceMail($name, $orderNumber, $orderDate, $currency . ' ' . $price, $method, $dashboard);

    // EMAIL
    $lowerCaseMail = strtolower($email);
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
    $mail->addAddress($lowerCaseMail);
    $mail->addReplyTo('support@palio.io');

    $mail->isHTML(true);
    $mail->Subject = 'Subscription Submission';
    $mail->Body = $content;
    $mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'] . '/template/PalioEmailConfirmation_files/image003.png', 'ccimage', 'images003.png');
    $mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'] . '/new_palio_logo.png', 'logoimage', 'logo.png');

    if (!$mail->send()) {
        $succMsg = "";
        $mail->ClearAllRecipients();
        $msg = 'Error Mailler: ' . $mail->ErrorInfo;
        echo $msg;
    } else {
        $mail->ClearAllRecipients();
        $sent = true;
    }

    redirect(base_url() . 'thankyou_prepaid.php');
}
