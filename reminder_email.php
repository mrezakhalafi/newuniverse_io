<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/db_conn.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/url_function.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/session_function.php'); ?>
<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$dbconn = getDBConn();

//GET ALL BILLING
$query = $dbconn->prepare("SELECT * FROM BILLING");
$query->execute();
$rows = array();
$rows = $query->get_result(); //GET ROWS
$query->close();

foreach ($rows as $row) {

    $now = new DateTime();
    $due_date = $row['DUE_DATE'];
    $cut_off_date = $row['CUT_OFF_DATE'];
    $is_paid = $row['IS_PAID'];
    $now_date = $now->format('Y-m-d H:i:s');
    $now_date_add = date('Y-m-d H:i:s', strtotime($now_date . ' + 1 days'));
    $cut_off_date_min = date('Y-m-d H:i:s', strtotime($cut_off_date . ' - 3 days'));
    $due_date_min = date('Y-m-d H:i:s', strtotime($due_date . ' - 3 days'));
    $bill_date_add = date('Y-m-d H:i:s', strtotime($row["BILL_DATE"] . ' + 1 days'));

    //GET USER EMAIL ADDRESS
    $company_id = $row["COMPANY"];
    $query =  $dbconn->prepare("SELECT * FROM USER_ACCOUNT WHERE COMPANY = ?");
    $query->bind_param("i", $company_id);
    $query->execute();
    $result = $query->get_result()->fetch_assoc();
    $email = $result["EMAIL_ACCOUNT"];
    $user_id = $result["ID"];
    $query->close();

    // PAYMENT REMINDER
    if ($is_paid == 0) {

        // INSERT DATA TO DB
        $msg = "Payment Reminder";
        $query = $dbconn->prepare("INSERT INTO MESSAGE (COMPANY, USER_ACCOUNT, M_ID, MESSAGE_DATE, MESSAGE_DESC, IS_READ) VALUES (?,?,2, NOW(), ?, NULL)");
        $query->bind_param("iis", $company_id, $user_id, $msg);
        $query->execute();
        $query->close();

        require $_SERVER['DOCUMENT_ROOT'] . '/PHPMailer/src/Exception.php';
        require $_SERVER['DOCUMENT_ROOT'] . '/PHPMailer/src/PHPMailer.php';
        require $_SERVER['DOCUMENT_ROOT'] . '/PHPMailer/src/SMTP.php';

        // START EMAIL
        $lowerCaseMail = strtolower($email);
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'support@palio.io';
        $mail->Password = '12345easySoft67890';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        //Recipients
        $mail->setFrom('support@palio.io', 'Palio');
        $mail->addAddress($lowerCaseMail);
        $mail->addReplyTo('support@palio.io');

        $mail->isHTML(true);
        $mail->Subject = 'Reminder: Payment';
        $mail->Body = "Dear user...<br>
		You haven't paid for your package, if you are interested in using our services please finish your payment.
		<br>
		Thank you.<br>
		With Regards<br>
		nuSDK<br>
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

    // DUE DATE REMINDER
    // if ($due_date_min < $now_date && $now_date < $due_date) {
    //     // $pay_reminder = 1;
    //     $msg = "Due Date Reminder";
    //     $query = $dbconn->prepare("INSERT INTO MESSAGE (COMPANY, USER_ACCOUNT, M_ID, MESSAGE_DATE, MESSAGE_DESC, IS_READ) VALUES (?,?,6, NOW(), ?, NULL)");
    //     $query->bind_param("iis", getSession('id_company'), getSession('user_id'), $msg);
    //     $query->execute();
    //     $query->close();

    //     // START EMAIL

    //     $mail_due_date = new PHPMailer();
    //     $mail_due_date->isSMTP();
    //     $mail_due_date->Host       = 'smtp.gmail.com';
    //     $mail_due_date->SMTPAuth   = true;
    //     $mail_due_date->Username   = 'support@palio.io';
    //     $mail_due_date->Password   = '12345easySoft67890';
    //     $mail_due_date->SMTPSecure = 'tls';
    //     $mail_due_date->Port       = 587;

    //     //Recipients
    //     $mail_due_date->setFrom('support@palio.io', 'Palio');
    //     $mail_due_date->addAddress($email);
    //     $mail_due_date->addReplyTo('support@palio.io');

    //     $mail_due_date->isHTML(true);
    //     $mail_due_date->Subject = 'Reminder: Due Date';
    //     $mail_due_date->Body = "Dear user...<br>
	// 	Due Date Reminder:<br>
	// 	To continue using our services, you have to make a repayment before" . $row["DUE_DATE"] . ".
	// 	<br>
	// 	Thank you.<br>
	// 	With Regards<br>
	// 	nuSDK<br>
	// 	";

    //     if (!$mail_due_date->send()) {
    //         $succMsg = "";
    //         $mail_due_date->ClearAllRecipients();
    //         $msg = 'Error : ' . $mail_due_date->ErrorInfo;
    //     } else {
    //         $mail_due_date->ClearAllRecipients();
    //         $sent = true;
    //         $msg = 'Sent';
    //     }
    //     // END EMAIL

    // }

    // //OVERDUE REMINDER
    // if ($due_date < $now_date && $now_date < $cut_off_date) {
    //     // $due_reminder = 1;
    //     $msg = "Overdue Reminder";
    //     $query = $dbconn->prepare("INSERT INTO MESSAGE (COMPANY, USER_ACCOUNT, M_ID, MESSAGE_DATE, MESSAGE_DESC, IS_READ) VALUES (?,?,3, NOW(), ?, NULL)");
    //     $query->bind_param("iis", $row["COMPANY"], $user_id, $msg);
    //     $query->execute();
    //     $query->close();

    //     // START EMAIL
    //     // require $_SERVER['DOCUMENT_ROOT'] . '/PHPMailer/src/Exception.php';
    //     // require $_SERVER['DOCUMENT_ROOT'] . '/PHPMailer/src/PHPMailer.php';
    //     // require $_SERVER['DOCUMENT_ROOT'] . '/PHPMailer/src/SMTP.php';

    //     $mail_overdue_reminder = new PHPMailer();
    //     $mail_overdue_reminder->isSMTP();
    //     $mail_overdue_reminder->Host       = 'smtp.gmail.com';
    //     $mail_overdue_reminder->SMTPAuth   = true;
    //     $mail_overdue_reminder->Username   = 'support@palio.io';
    //     $mail_overdue_reminder->Password   = '12345easySoft67890';
    //     $mail_overdue_reminder->SMTPSecure = 'tls';
    //     $mail_overdue_reminder->Port       = 587;

    //     //Recipients
    //     $mail_overdue_reminder->setFrom('support@palio.io', 'Palio');
    //     $mail_overdue_reminder->addAddress($email);
    //     $mail_overdue_reminder->addReplyTo('support@palio.io');

    //     $mail_overdue_reminder->isHTML(true);
    //     $mail_overdue_reminder->Subject = 'Reminder: Overdue';
    //     $mail_overdue_reminder->Body = "Dear user...<br>
	// 	Overdue Reminder:<br>
	// 	Your package has entered a grace period, make sure to finish your payment to continue using our services.
	// 	<br>
	// 	Thank you.<br>
	// 	With Regards<br>
	// 	nuSDK<br>
	// 	";

    //     if (!$mail_overdue_reminder->send()) {
    //         $succMsg = "";
    //         $mail_overdue_reminder->ClearAllRecipients();
    //         $msg = 'Error : ' . $mail_overdue_reminder->ErrorInfo;
    //     } else {
    //         $mail_overdue_reminder->ClearAllRecipients();
    //         $sent = true;
    //         $msg = 'Sent';
    //     }
    //     // END EMAIL

    // }

    // //CUTOFF REMINDER
    // if ($now_date > $cut_off_date_min) {
    //     // $cutoff_reminder = 1;
    //     $msg = "Cutoff Date Reminder";
    //     $query = $dbconn->prepare("INSERT INTO MESSAGE (COMPANY, USER_ACCOUNT, M_ID, MESSAGE_DATE, MESSAGE_DESC, IS_READ) VALUES (?,?,4, NOW(), ?, NULL)");
    //     $query->bind_param("iis", $row["COMPANY"], $user_id, $msg);
    //     $query->execute();
    //     $query->close();

    //     // START EMAIL
    //     // require $_SERVER['DOCUMENT_ROOT'] . '/PHPMailer/src/Exception.php';
    //     // require $_SERVER['DOCUMENT_ROOT'] . '/PHPMailer/src/PHPMailer.php';
    //     // require $_SERVER['DOCUMENT_ROOT'] . '/PHPMailer/src/SMTP.php';

    //     $mail_cutoff_reminder = new PHPMailer();
    //     $mail_cutoff_reminder->isSMTP();
    //     $mail_cutoff_reminder->Host       = 'smtp.gmail.com';
    //     $mail_cutoff_reminder->SMTPAuth   = true;
    //     $mail_cutoff_reminder->Username   = 'support@palio.io';
    //     $mail_cutoff_reminder->Password   = '2020easySoft';
    //     $mail_cutoff_reminder->SMTPSecure = 'tls';
    //     $mail_cutoff_reminder->Port       = 587;

    //     //Recipients
    //     $mail_cutoff_reminder->setFrom('support@palio.io', 'NUSA');
    //     $mail_cutoff_reminder->addAddress($email);
    //     $mail_cutoff_reminder->addReplyTo('support@palio.io');

    //     $mail_cutoff_reminder->isHTML(true);
    //     $mail_cutoff_reminder->Subject = 'Reminder: Cut Off Date';
    //     $mail_cutoff_reminder->Body = "Dear user...<br>
	// 	Cut Off Date Reminder:<br>
	// 	Your package has entered a grace period, and will be terminated on" . $row["CUT_OFF_DATE"] . ". 
	// 	<br>
	// 	Thank you.<br>
	// 	With Regards<br>
	// 	nuSDK<br>
	// 	";

    //     if (!$mail_cutoff_reminder->send()) {
    //         $succMsg = "";
    //         $mail_cutoff_reminder->ClearAllRecipients();
    //         $msg = 'Error : ' . $mail_cutoff_reminder->ErrorInfo;
    //     } else {
    //         $mail_cutoff_reminder->ClearAllRecipients();
    //         $sent = true;
    //         $msg = 'Sent';
    //     }
    //     // END EMAIL

    // }

    // //TERMINATE
    // if ($now_date > $cut_off_date) {
    //     // $terminate_reminder = 1;
    //     $msg = "Service Termination";
    //     $query = $dbconn->prepare("INSERT INTO MESSAGE (COMPANY, USER_ACCOUNT, M_ID, MESSAGE_DATE, MESSAGE_DESC, IS_READ) VALUES (?,?,5, NOW(), ?, NULL)");
    //     $query->bind_param("iis", $row["COMPANY"], $user_id, $msg);
    //     $query->execute();
    //     $query->close();

    //     // START EMAIL
    //     // require $_SERVER['DOCUMENT_ROOT'] . '/PHPMailer/src/Exception.php';
    //     // require $_SERVER['DOCUMENT_ROOT'] . '/PHPMailer/src/PHPMailer.php';
    //     // require $_SERVER['DOCUMENT_ROOT'] . '/PHPMailer/src/SMTP.php';

    //     $mail_terminate = new PHPMailer();
    //     $mail_terminate->isSMTP();
    //     $mail_terminate->Host       = 'smtp.gmail.com';
    //     $mail_terminate->SMTPAuth   = true;
    //     $mail_terminate->Username   = 'support@palio.io';
    //     $mail_terminate->Password   = '12345easySoft67890';
    //     $mail_terminate->SMTPSecure = 'tls';
    //     $mail_terminate->Port       = 587;

    //     //Recipients
    //     $mail_terminate->setFrom('support@palio.io', 'Palio');
    //     $mail_terminate->addAddress($email);
    //     $mail_terminate->addReplyTo('support@palio.io');

    //     $mail_terminate->isHTML(true);
    //     $mail_terminate->Subject = 'Service Termination';
    //     $mail_terminate->Body = "Dear user...<br>
	// 	Your package has been terminated on" . $now_date . ".
	// 	<br>
	// 	If you are interested in using our services again, please consider subscribe.
	// 	<br>
	// 	Thank you.<br>
	// 	With Regards<br>
	// 	nuSDK<br>
	// 	";

    //     if (!$mail_terminate->send()) {
    //         $succMsg = "";
    //         $mail_terminate->ClearAllRecipients();
    //         $msg = 'Error : ' . $mail_terminate->ErrorInfo;
    //     } else {
    //         $mail_terminate->ClearAllRecipients();
    //         $sent = true;
    //         $msg = 'Sent';
    //     }
    //     // END EMAIL

    // }

    //NEW SUBSCRIBER
    // if( $row["BILL_DATE"] < $bill_date_add ){

    // 	$msg = "New User";
    // 	$query = $dbconn->prepare("INSERT INTO MESSAGE (COMPANY, USER_ACCOUNT, M_ID, MESSAGE_DATE, MESSAGE_DESC, IS_READ) VALUES (?,?,1, NOW(), ?, NULL)");
    // 	$query->bind_param("iis", $row["COMPANY"], $user_id, $msg);
    // 	$query->execute();
    //     $query->close();

    //     // START EMAIL
    //     require $_SERVER['DOCUMENT_ROOT'] . 'PHPMailer/src/Exception.php';
    //     require $_SERVER['DOCUMENT_ROOT'] . 'PHPMailer/src/PHPMailer.php';
    //     require $_SERVER['DOCUMENT_ROOT'] . 'PHPMailer/src/SMTP.php';

    //     $mail = new PHPMailer();
    //     $mail->isSMTP();        
    //     $mail->Host       = 'smtp.gmail.com';  
    //     $mail->SMTPAuth   = true;                             
    //     $mail->Username   = 'support@palio.io';                
    //     $mail->Password   = '2020easySoft';
    //     $mail->SMTPSecure = 'tls';         
    //     $mail->Port       = 587;                     

    //     //Recipients
    //     $mail->setFrom('support@palio.io', 'NUSA');
    //     $mail->addAddress('0zwd0nuov6@smart-email.me');
    //     $mail->addReplyTo('support@palio.io');

    //     $mail->isHTML(true);
    //     $mail->Subject = 'Welcome to nuSDK!';
    //     $mail->Body = 'Welcome to nuSDK!<br>
    //     We are glad to have you here!<br>
    //     You have successfully subscribed to '. $row["CHARGE"] .' package.
    // 	Now you can easily build your mobile apps with live streaming, video and VoIP call in less than 15 minutes.<br>
    // 	We support all platforms including iOS, Android, and Kotlin. We can not wait to see what you have build!
    // 	<br>
    // 	<br>
    // 	Thank you.<br>
    // 	With Regards<br>
    // 	nuSDK<br>
    //     ';

    //     if(!$mail->send()){
    //         $succMsg = "";
    //         $mail->ClearAllRecipients();
    //         $msg = 'Error : '.$mail->ErrorInfo;
    //     } else {
    //         $mail->ClearAllRecipients();
    //         $sent = true;
    //         $msg = 'Sent';
    //     }
    //     // END EMAIL

    // }
}

?>