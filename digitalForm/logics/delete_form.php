<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/digitalForm/logics/db_conn.php');

$dbconn = test_db();

if(isset($_REQUEST['form_id'])){
    $form_id = $_REQUEST['form_id'];
}

$query = $dbconn->prepare("DELETE FROM `form` WHERE `FORM_ID`='$form_id'");
$query->execute();

?>