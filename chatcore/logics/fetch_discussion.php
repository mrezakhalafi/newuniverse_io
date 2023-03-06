<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/chatcore/logics/chat_dbconn.php');

$flag = $_GET['flag'];

if($flag == 1){
    $dbconn = paliolite();
} else {
    $dbconn = catchup();
}

$f_pin = $_GET['f_pin'];

// SELECT USER PROFILE
$query = $dbconn->prepare("SELECT df.* 
        FROM DISCUSSION_FORUM df, MEMBERS mb 
        WHERE df.GROUP_ID = mb.GROUP_ID
        AND mb.F_PIN = ?");
$query->bind_param("s", $f_pin);
$query->execute();
$grps = $query->get_result();
$query->close();

$rows = array();
while ($grp = $grps->fetch_assoc()) {

    $rows[] = $grp;
};

echo json_encode($rows);
