<link rel="icon" type="image/x-icon" href="newAssets/fav.ico">
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/url_function.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/db_conn.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/session_function.php'); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/header-alt.php'); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/header-alt-meta.php'); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/session_insert.php'); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/api_generator_2.php'); ?>

<?php

require './gmail/email.php';
session_start();

$_SESSION['previous_page'] = $_SESSION['current_page'];
$_SESSION['current_page'] = 12;
require_once($_SERVER['DOCUMENT_ROOT'] . '/state_control.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$dbconn = getDBConn();

$company_id = $_SESSION['id_company'];
$email = $_SESSION['email'];

$price_item_amount = 0;

$query = $dbconn->prepare("SELECT * FROM USER_ACCOUNT WHERE COMPANY = ?");
$query->bind_param("i", $company_id);
$query->execute();
$dataUser = $query->get_result()->fetch_assoc();
$password = $dataUser['PASSWORD'];
$user_id = $dataUser['ID'];
$query->close();

$query = $dbconn->prepare("SELECT * FROM COMPANY WHERE ID = ?");
$query->bind_param("i", $company_id);
$query->execute();
$company = $query->get_result()->fetch_assoc();
$apikey = $company['API_KEY'];
$query->close();

$query = $dbconn->prepare("SELECT * FROM COMPANY_INFO WHERE COMPANY = ?");
$query->bind_param("i", $company_id);
$query->execute();
$dataCompany = $query->get_result()->fetch_assoc();
$query->close();

$query = $dbconn->prepare("SELECT * FROM SUBSCRIBE WHERE COMPANY = ? AND STATUS = 3");
$query->bind_param("i", $company_id);
$query->execute();
$subscribe = $query->get_result()->fetch_assoc();
$subscribe_id = $subscribe['ID'];
$query->close();

$paycheck = 1; //TRIAL ALWAYS SUCCESS
if ($paycheck == 1) {

    // update status company
    $query = $dbconn->prepare("UPDATE COMPANY SET STATUS = 1 WHERE ID = ? AND STATUS = 0");
    $query->bind_param("i", $company_id);
    $query->execute();
    $query->close();

    //MESSAGE NEW USER INSERT QUERY
    $msg = "New User";
    $query = $dbconn->prepare("INSERT INTO MESSAGE (COMPANY, USER_ACCOUNT, M_ID, MESSAGE_DATE, MESSAGE_DESC, IS_READ) VALUES (?,?,1, NOW(), ?, NULL)");
    $query->bind_param("iis", $company_id, $user_id, $msg);
    $query->execute();
    $query->close();

    $expire_date = strtotime('+1 day') * 1000;

    $url = "http://192.168.1.100:8004/webrest/";
    $data = array(
        'code' => 'REGBE',
        'data' => array(
            'company_id' => $company_id,
            'name' => $dataCompany['COMPANY_NAME'],
            'api_key' => $apikey,
            'expire_date' => $expire_date,
            'private_key' => $_SESSION['password'],
            'is_trial' => 1,
            'is_anonymous' => 1,
        ),

    );

    $options = array(
        'http' => array(
            'header'  =>
            // "Authorization: ".$secretKey."\r\n".
            "Content-type: application/json\r\n",
            'method'  => 'POST',
            'content' => strval(json_encode($data))
        )
    );

      $stream = stream_context_create($options); 
      $result = file_get_contents($url, false, $stream);
      $json_result = json_decode($result);

    $queryUpdateInfo = $dbconn->prepare("REPLACE INTO COMP_FEATURE (`COMPANY_ID`, `TYPE`, `VALUE`) VALUES (" . $company_id . ",1, 1)");
    $queryUpdateInfo->execute();
    $queryUpdateInfo->close();


    $queryUpdateInfo = $dbconn->prepare("REPLACE INTO COMP_FEATURE (`COMPANY_ID`, `TYPE`, `VALUE`) VALUES (" . $company_id . ",2, 1)");
    $queryUpdateInfo->execute();
    $queryUpdateInfo->close();

    $queryUpdateInfo = $dbconn->prepare("REPLACE INTO COMP_FEATURE (`COMPANY_ID`, `TYPE`, `VALUE`) VALUES (" . $company_id . ",3, 1)");
    $queryUpdateInfo->execute();
    $queryUpdateInfo->close();

    $queryUpdateInfo = $dbconn->prepare("REPLACE INTO COMP_FEATURE (`COMPANY_ID`, `TYPE`, `VALUE`) VALUES (" . $company_id . ",4, 1)");
    $queryUpdateInfo->execute();
    $queryUpdateInfo->close();

    $queryUpdateInfo = $dbconn->prepare("REPLACE INTO COMP_FEATURE (`COMPANY_ID`, `TYPE`, `VALUE`) VALUES (" . $company_id . ",5, 1)");
    $queryUpdateInfo->execute();
    $queryUpdateInfo->close();

    $queryUpdateInfo = $dbconn->prepare("REPLACE INTO COMP_FEATURE (`COMPANY_ID`, `TYPE`, `VALUE`) VALUES (" . $company_id . ",6, 1)");
    $queryUpdateInfo->execute();
    $queryUpdateInfo->close();

    $queryUpdateInfo = $dbconn->prepare("REPLACE INTO COMP_FEATURE (`COMPANY_ID`, `TYPE`, `VALUE`) VALUES (" . $company_id . ",7, 1)");
    $queryUpdateInfo->execute();
    $queryUpdateInfo->close();

    // $query = $dbconn->prepare("UPDATE COMPANY SET API_KEY = ? WHERE ID = ?");
    // $query->bind_param("si", $apikey, $company_id);
    // $query->execute();
    // $query->close();

    $query = $dbconn->prepare("UPDATE USER_ACCOUNT SET STATUS = 3, STATE = 3 WHERE COMPANY = ?");
    $query->bind_param("i", $company_id);
    $query->execute();
    $query->close();

    //update status subscribe
    $query = $dbconn->prepare("UPDATE SUBSCRIBE SET STATUS = 3 WHERE ID = ?");
    $query->bind_param("i", $subscribe_id);
    $query->execute();
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
    $query = $dbconn->prepare("INSERT INTO BILLING (ORDER_NUMBER, BILL_DATE, DUE_DATE, COMPANY, SUBSCRIBE, CURRENCY, CHARGE, CUT_OFF_DATE, IS_PAID) VALUES (?, NOW(), DATE_ADD(NOW(), INTERVAL 1 DAY), ?, ?, NULL, ?, DATE_ADD(NOW(), INTERVAL 1 DAY), 1)");
    $query->bind_param("siid", $order_number, $company_id, $subscribe_id, $price_item_amount);
    $query->execute();
    $bill_id = $query->insert_id;
    $query->close();

    //GET CURRENT USER_ACCOUNT
    $query = $dbconn->prepare("SELECT * FROM USER_ACCOUNT WHERE EMAIL_ACCOUNT = ?");
    $query->bind_param("s", $email);
    $query->execute();
    $user_account = $query->get_result()->fetch_assoc();
    $query->close();

    //PAYMENT INSERT QUERY
    $query = $dbconn->prepare("INSERT INTO PAYMENT (PAYMENT_METHOD, BILL, COMPANY, USER, PAY_DATE) VALUES ('PAYPAL', ?, ?, ?, NOW())");
    $query->bind_param("iii", $bill_id, $user_account['COMPANY'], $user_account['ID']);
    $query->execute();
    $query->close();

    setSession('email', $email);
    setSession('password', $password);
    setSession('id_user', $user_id);
    setSession('id_company', $company_id);

    // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ // EMAIL ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

    $email = strtolower(getSession('email'));

    function invoiceMail($name, $dashboard)
    {
        $content = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/template/FreeTrial.htm');
        $content = str_replace('*NAME*', $name, $content);
        $content = str_replace('http://103.94.169.26:8081/', $dashboard, $content);

        $content = str_replace('cid:image002', 'https://newuniverse.io/template/PalioEmailConfirmation_files/newuniverse.png', $content);
        $content = str_replace('cid:image004', 'https://newuniverse.io/template/ExpiredFreeTrial_files/image004.png', $content);
        $content = str_replace('cid:image005', 'https://newuniverse.io/template/ExpiredFreeTrial_files/image005.png', $content);
        return $content;
    }

    $name = $user_account['USERNAME'];
    $dashboard = base_url() . 'dashboardv2/';
    $content = invoiceMail($name, $dashboard);

    send_email($email, $email, "Subsription Trial", $content);

    // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ // END EMAIL ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

    apiGen();
    insertSession($user_id);
    redirect(base_url() . 'dashboardv2/');
}

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

// function sendMail($body, $destination){
// 	require $_SERVER['DOCUMENT_ROOT'].'/PHPMailer/src/Exception.php';
// 	require $_SERVER['DOCUMENT_ROOT'].'/PHPMailer/src/PHPMailer.php';
// 	require $_SERVER['DOCUMENT_ROOT'].'/PHPMailer/src/SMTP.php';
// 	$succMsg = "";
// 	$errMsg = "";

// 	if($destination != ""){

// 		$mail = new PHPMailer();
// 		//$mail->SMTPDebug = 2;
// 		$mail->isSMTP();
// 		$mail->Host       = 'smtp.gmail.com';
// 		$mail->SMTPAuth   = true;
// 		$mail->Username   = 'support@palio.io';
// 		$mail->Password   = '12345easySoft67890';
// 		$mail->SMTPSecure = 'tls';
// 		$mail->Port       = 587;

//     	//Recipients
// 		$mail->setFrom('support@palio.io', 'Palio');
// 		$mail->addAddress($destination);
// 		$mail->addReplyTo('support@palio.io');

// 		$mail->isHTML(true);
// 		$mail->Subject = 'Trial Submission';
//         $mail->Body = $body;
//         $mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'] . '/template/FreeTrial_files/image002.png', 'images002', 'images002.png');
//         $mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'] . '/template/FreeTrial_files/image004.png', 'images004', 'images004.png');
//         $mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'] . '/template/FreeTrial_files/image005.png', 'images005', 'images005.png');

// 		if(!$mail->send()){
// 			$mail->ClearAllRecipients();
// 			$succMsg = $mail->ErrorInfo;
// 		} else {
// 			$mail->ClearAllRecipients();
// 			$succMsg = "Email has been sent successfully.";
// 		}

// 	} else {
// 		$errMsg = "Please fill all the form!";
// 	}
// }

?>