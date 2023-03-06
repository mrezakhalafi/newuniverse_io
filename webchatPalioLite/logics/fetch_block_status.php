<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/url_function.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/webchat/logics/chat_dbconn.php');

$dbconn = paliolite();
$fpin = $_GET['f_pin'];

// SELECT USER PROFILE
$query = $dbconn->prepare("SELECT * FROM BLOCK_USER WHERE F_PIN = ? OR L_PIN = ?");
$query->bind_param("ss", $fpin, $fpin);
$query->execute();
$blocklist = $query->get_result();
$query->close();

$rows = array();
while ($block = $blocklist->fetch_assoc()) {

    $rows[] = $block;
};

echo json_encode($rows);
