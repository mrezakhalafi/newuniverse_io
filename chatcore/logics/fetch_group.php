<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/chatcore/logics/chat_dbconn.php');

$flag = $_GET['flag'];

if ($flag == 1) {
    $dbconn = paliolite();
} else {
    $dbconn = catchup();
}

$fpin = $_GET['f_pin'];

// SELECT GROUP
$query = $dbconn->prepare("SELECT g.* FROM `GROUPS` g, MEMBERS m WHERE m.F_PIN = ? AND m.GROUP_ID = g.GROUP_ID");
$query->bind_param("s", $fpin);
$query->execute();
$groups = $query->get_result();
$query->close();

$rows = array();
while ($group = $groups->fetch_assoc()) {
    $rows[] = $group;
};

echo json_encode($rows);
