<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/digitalForm/logics/db_conn.php');

$dbconn = test_db();

if(isset($_REQUEST['form_id'])){
    $form_id = $_REQUEST['form_id'];
}

$form_query = "SELECT * FROM `form_item` WHERE `FORM_ID`='".$form_id."' ORDER BY SQ_NO";
$query = $dbconn->prepare($form_query);
$query->execute();
$groups  = $query->get_result();
$query->close();

$rows = array();
while ($group = $groups->fetch_assoc()) {
    $rows[] = $group;
};

return $rows;

?>