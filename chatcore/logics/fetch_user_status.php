<?php

// HIT THIS PAGE TO GET USER STATUS STATUS

include_once($_SERVER['DOCUMENT_ROOT'] . '/chatcore/logics/chat_dbconn.php');

$dbconn = newnus();
$qr_code = $_GET['qr_code'];

// STATUS
$query = $dbconn->prepare("SELECT * FROM WEB_LOGIN WHERE QR_CODE = ?");
$query->bind_param("s", $qr_code);
$query->execute();
$status = $query->get_result()->fetch_assoc();
$query->close();

// send user data as json
echo json_encode($status);
