<?php 

include_once($_SERVER['DOCUMENT_ROOT'] . '/chatcore/logics/chat_dbconn.php');

$flag = $_GET['flag'];


$dbconn = paliolite();


$p_id = $_GET['p_id'];

// SELECT GROUP
$str = "SELECT g.*, 
(
SELECT COUNT(g1.GROUP_ID) FROM `GROUPS` g1 WHERE g1.PARENT_ID = g.GROUP_ID
) AS CHILD_AMT 
FROM `GROUPS` g
WHERE g.PARENT_ID = '$p_id'";
$query = $dbconn->prepare($str);
$query->execute();
$groups = $query->get_result();
$query->close();

$rows = array();
while ($group = $groups->fetch_assoc()) {
    $rows[] = $group;
};

echo json_encode($rows);
