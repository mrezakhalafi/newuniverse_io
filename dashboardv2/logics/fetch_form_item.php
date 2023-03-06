<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/dashboardv2/logics/db_conn.php');

$dbconn = dbConnPalioLite();

if(isset($_REQUEST['form_id'])){
    $form_id = $_REQUEST['form_id'];
}

$form_query = "SELECT * FROM `FORM_ITEM` WHERE `FORM_ID`='".$form_id."' ORDER BY SQ_NO";
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