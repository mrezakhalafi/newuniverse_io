<?php 

include_once($_SERVER['DOCUMENT_ROOT'] . '/digitalForm/logics/db_conn.php');

$dbconn = test_db();

$json = file_get_contents('php://input');
var_dump($json);
$data = json_decode(stripslashes($json),true);
var_dump($data);
$form_id = $data["form_id"];
$user_id = $data["user_id"];
$items = json_encode($data["items"]);
var_dump($items);
$date = new DateTime();
$timestamp = $date->format("Y-m-d H:i:s");
$form_query = "INSERT INTO `form_submission` (`USER_ID`, `FORM_ID`, `TIMESTAMP`, `DATA`)
VALUES ('".$user_id."','".$form_id."','".$timestamp."','".$items."')";
$query = $dbconn->prepare($form_query);
$query->execute();
?>