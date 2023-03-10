<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/chatcore/logics/chat_dbconn.php');

session_start();

$dbconn = paliolite();
$customer_id = $_GET['customer_id'];


// SELECT USER PROFILE
$query = $dbconn->prepare("SELECT * FROM COMPLAINT_WEB WHERE CUSTOMER_ID = ? OR OFFICER_ID = ? ORDER BY START_HANDLING DESC LIMIT 1");
$query->bind_param("ss", $customer_id, $customer_id);
$query->execute();
$result = $query->get_result()->fetch_assoc();
$query->close();

if($result != null){
	$_SESSION['ongoing_complain_id'] = $result['ID'];
	$_SESSION['complain_officer'] = $result['OFFICER_ID'];
	$_SESSION['complain_cust'] = $result['CUSTOMER_ID'];
	echo json_encode($result);
} else {
	echo 0;
};
