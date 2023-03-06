<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/chatcore/logics/chat_dbconn.php');

$flag = $_GET['flag'];
$fpin = $_GET['f_pin'];

if ($flag == 1) {
    $dbconn = paliolite();
    $query = $dbconn->prepare("SELECT msts.* FROM MESSAGE_STATUS_WEB msts WHERE msts.L_PIN = ? AND msts.STATUS = 4");
    $query->bind_param("s", $fpin);
    $query->execute();
    $groups = $query->get_result();
    $query->close();
} else {
    $dbconn = catchup();
    $query = $dbconn->prepare("SELECT msts.* FROM MESSAGE_STATUS msts WHERE msts.L_PIN = ? AND msts.STATUS = 4");
    $query->bind_param("s", $fpin);
    $query->execute();
    $groups = $query->get_result();
    $query->close();
}



$rows = array();
while ($group = $groups->fetch_assoc()) {
    $rows[] = $group;
};

echo json_encode($rows);
