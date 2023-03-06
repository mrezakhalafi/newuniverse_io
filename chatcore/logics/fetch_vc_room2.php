<?php 
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
include_once($_SERVER['DOCUMENT_ROOT'] . '/chatcore/logics/chat_dbconn.php');

$dbconn = paliolite();

$fpin = '02b6c89aa2';

// SELECT GROUP
$query = $dbconn->prepare("SELECT * FROM VC_ROOM WHERE F_PIN = '$fpin' ORDER BY ID DESC LIMIT 1");
$query->execute();
$groups  = $query->get_result()->fetch_assoc();
$query->close();

echo json_encode($groups);