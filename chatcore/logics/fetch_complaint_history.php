<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/chatcore/logics/chat_dbconn.php');

$dbconn = paliolite();
$f_pin = $_POST['f_pin'];

// SELECT USER PROFILE
$query = $dbconn->prepare("SELECT msg.*, ch.*
FROM MESSAGE_WEB msg, COMPLAINT_HISTORY ch
WHERE msg.CALL_CENTER_ID = ch.ID
AND (CUSTOMER_ID = ? OR OFFICER_ID = ?)
AND ch.STATUS = 2");
$query->bind_param("ss", $f_pin, $f_pin);
$query->execute();
$grps = $query->get_result();
$query->close();

$rows = array();
while ($grp = $grps->fetch_assoc()) {

    $rows[] = $grp;
};

echo json_encode($rows);