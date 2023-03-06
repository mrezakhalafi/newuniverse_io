<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/url_function.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/chatcore/logics/chat_dbconn.php');

$dbconn = paliolite();
$comp_id = $_GET['comp_id'];

// SELECT USER PROFILE
$query = $dbconn->prepare("SELECT ch.*
FROM COMPLAINT_HISTORY ch
WHERE ch.ID = ?");
$query->bind_param("s", $comp_id);
$query->execute();
$grps = $query->get_result()->fetch_assoc();
$query->close();

echo json_encode($grps);