<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/digitalForm/logics/db_conn.php');

$dbconn = test_db();

if(isset($_REQUEST['user_id'])){
    $user_id = $_REQUEST['user_id'];
}

$forms_query = "SELECT * FROM `form` WHERE `CREATED_BY`='".$user_id."' ORDER BY SQ_NO";
$query = $dbconn->prepare($forms_query);
$query->execute();
$groups  = $query->get_result();
$query->close();

$rows = array();
while ($group = $groups->fetch_assoc()) {
    $rows[] = $group;
};

return $rows;

?>