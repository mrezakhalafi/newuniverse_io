<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/chatcore/logics/chat_dbconn.php');

$flag = $_GET['flag'];

if($flag == 1){
    $dbconn = paliolite();
} else {
    $dbconn = catchup();
}

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
