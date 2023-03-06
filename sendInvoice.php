<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/url_function.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/db_conn.php'); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/header-alt.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/session_function.php'); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/header-alt-meta.php'); ?>
<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
function invoiceMail($name, $orderNumber, $orderDate, $item, $price, $method, $dashboard)
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

$name = $_POST['username'];
$orderDate = $_POST['orderdate'];
$item = $_POST['product'];
$price = $_POST['price'];
$method = 'PAYPAL';
$dashboard = base_url();
$orderNumber = $_POST['ordernumber'];
$content = invoiceMail($name, $orderNumber, $orderDate, $item, '$' . $price, $method, $dashboard);


// // EMAIL
$lowerCaseMail = $_POST['email'];
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
$mail->addAddress($lowerCaseMail);
$mail->addReplyTo('support@palio.io');

$mail->isHTML(true);
$mail->Subject = 'Subscription Submission';
$mail->Body = $content;
$mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'] . '/template/PalioEmailConfirmation_files/image003.png', 'ccimage', 'images003.png');

if (!$mail->send()) {
    $succMsg = "";
    $mail->ClearAllRecipients();
    $msg = 'Error Mailler: ' . $mail->ErrorInfo;
    echo $msg;
} else {
    $mail->ClearAllRecipients();
    $sent = true;

    $dbconn = getDBConn();
    $query = $dbconn->prepare("UPDATE USER_ACCOUNT SET STATE = 3 WHERE EMAIL_ACCOUNT = ?");
    $query->bind_param("s", $lowerCaseMail);
    $query->execute();
    $query->close();

    echo 'sent!';
}