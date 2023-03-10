<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/chatcore/logics/chat_dbconn.php');

session_start();

$dbconn = paliolite();
// $fpin = $_POST['complainID'];
$fpin = $_POST['f_pin'];

// SELECT USER PROFILE
$query = $dbconn->prepare("SELECT * FROM CONTACT_CENTER_NOTIF_CALL_WEB WHERE CUSTOMER_F_PIN = ?");
$query->bind_param("s", $fpin);
$query->execute();
$notif = $query->get_result()->fetch_assoc();
$query->close();	


	echo json_encode($notif);

if($notif != null){
	$_SESSION['call_complain_ID'] = $notif['COMPLAINT_ID'];
	$_SESSION['complain_officer'] = $notif['OFFICER'];
	$_SESSION['complain_cust'] = $notif['CUSTOMER_F_PIN'];
}