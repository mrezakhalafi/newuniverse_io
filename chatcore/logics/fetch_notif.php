<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/chatcore/logics/chat_dbconn.php');

session_start();

$dbconn = paliolite();
$fpin = $_GET['f_pin'];

// SELECT USER PROFILE
$query = $dbconn->prepare("SELECT * FROM CONTACT_CENTER_NOTIF_WEB WHERE OFFICER = ?");
$query->bind_param("s", $fpin);
$query->execute();
$notif = $query->get_result()->fetch_assoc();
$query->close();

if($notif != null){
	$_SESSION['inc_complain_id'] = $notif['COMPLAINT_ID'];
	$_SESSION['complain_officer'] = $notif['OFFICER'];
	$_SESSION['complain_cust'] = $notif['CUSTOMER_F_PIN'];
	echo json_encode($notif);
} else {
	echo 0;
};
