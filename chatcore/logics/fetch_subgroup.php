<?php 

include_once($_SERVER['DOCUMENT_ROOT'] . '/chatcore/logics/chat_dbconn.php');

$flag = $_GET['flag'];

if($flag == 1){
    $dbconn = paliolite();
} else {
    $dbconn = catchup();
}

$p_id = $_GET['p_id'];

// SELECT GROUP
$query = $dbconn->prepare("SELECT * FROM `GROUPS` WHERE PARENT_ID = ?");
$query->bind_param("s", $p_id);
$query->execute();
$groups = $query->get_result();
$query->close();

$rows = array();
while ($group = $groups->fetch_assoc()) {
    $rows[] = $group;
};

echo json_encode($rows);
