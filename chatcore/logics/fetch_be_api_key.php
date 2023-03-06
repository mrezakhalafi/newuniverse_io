<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/url_function.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/chatcore/logics/chat_dbconn.php');

$dbconn = paliolite();
$fpin = $_POST['f_pin'];

// SELECT USER PROFILE
$query = $dbconn->prepare("SELECT be.*
FROM BUSINESS_ENTITY be, USER_LIST ul
WHERE ul.F_PIN = ?
AND ul.BE = be.ID");
$query->bind_param("s", $fpin);
$query->execute();
$grps = $query->get_result()->fetch_assoc();
$query->close();

echo json_encode($grps);