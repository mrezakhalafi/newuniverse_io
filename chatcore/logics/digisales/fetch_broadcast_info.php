<?php 

include_once($_SERVER['DOCUMENT_ROOT'] . '/chatcore/logics/chat_dbconn.php');


$dbconn = paliolite();


$msg = $_GET['msg'];

// SELECT GROUP
$str = "SELECT bci.*
FROM BROADCAST_INFO bci
WHERE bci.ROOT_ID = '$msg'";
$query = $dbconn->prepare($str);
$query->execute();
$groups = $query->get_result()->fetch_assoc();
$query->close();

echo json_encode($groups);
