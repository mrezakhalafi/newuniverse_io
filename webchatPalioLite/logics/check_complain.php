<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/webchat/logics/chat_dbconn.php');

$dbconn = paliolite();
$customer_id = $_GET['customer_id'];

// SELECT USER PROFILE
$query = $dbconn->prepare("SELECT * FROM COMPLAINT_WEB WHERE CUSTOMER_ID = ?");
$query->bind_param("s", $customer_id);
$query->execute();
$result = $query->get_result()->fetch_assoc();
$query->close();

if($result != null){
	echo json_encode($result);
} else {
	echo 0;
};
