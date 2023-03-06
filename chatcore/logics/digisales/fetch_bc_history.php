<?php 

include_once($_SERVER['DOCUMENT_ROOT'] . '/chatcore/logics/chat_dbconn.php');


$dbconn = paliolite();


$f_pin = $_GET['f_pin'];

// SELECT GROUP
$str = "SELECT bch.*
FROM BROADCAST_HISTORY bch
WHERE bch.ORIGINATOR = '$f_pin'";
$query = $dbconn->prepare($str);
$query->execute();
$groups = $query->get_result();
$query->close();

$rows = array();
while ($group = $groups->fetch_assoc()) {
    $rows[] = $group;
};

echo json_encode($rows);
