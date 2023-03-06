<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/dashboardv2/logics/db_conn.php');

$dbconn = dbConnPalioLite();

if(isset($_REQUEST['form_id'])){
    $form_id = $_REQUEST['form_id'];
}

$query = $dbconn->prepare("DELETE FROM `FORM` WHERE `FORM_ID`='$form_id'");
$query->execute();

?>