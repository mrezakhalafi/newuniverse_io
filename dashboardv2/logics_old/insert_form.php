<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/dashboardv2/logics/db_conn.php');

$dbconn = test_db();

$json = file_get_contents('php://input');
// var_dump($json);
$data = json_decode(stripslashes($json),true);
// var_dump($data);
$title = $data["title"];
$user_id = $data["user_id"];

$be = $data["be"];
$query = $dbconn->prepare("SELECT `ID` FROM `BUSINESS_ENTITY` WHERE `COMPANY_ID`='$be'");
$query->execute();
$query_result = $query->get_result()->fetch_assoc();
$be = $query_result['BE'];
$query->close();

$items = $data["items"];
$date = new DateTime();
$form_id = random_int(100000,200000); // change later
$timestamp = $date->format("Y-m-d H:i:s");

// echo $form_id . ", " . $title . ", " . $user_id . ", " . $be;
$item_query = "INSERT INTO `FORM_ITEM` (`FORM_ID`,`LABEL`,`KEY`,`VALUE`,`SQ_NO`,`TYPE`) VALUES ";
$index = 1;
$comma = false;
foreach($items as $item){
    $sql_query = "";
    if($comma){
        $sql_query = $sql_query.",";
        $index++;
    }
    $label = $item["label"];
    $key = $item["key"];
    $value = $item["value"];
    $sq_no = (string) $index;
    $type = $item["type"];
    $sql_query = $sql_query."('".$form_id."','".$label."','".$key."','".$value."',".$sq_no.",'".$type."')";
    $item_query = $item_query.$sql_query;
    $comma = true;
}
$query = $dbconn->prepare("INSERT INTO `FORM` (`FORM_ID`,`TITLE`,`CREATED_DATE`,`CREATED_BY`) VALUES ('$form_id','$title','$timestamp','$user_id')");
$query->execute();
$query = $dbconn->prepare("INSERT INTO `FORM_ACCESS` (`FORM_ID`,`BE`) VALUES ('$form_id',$be)");
$query->execute();
$query = $dbconn->prepare($item_query);
$query->execute();
$retval = [
    "form_id" => $form_id,
    "timestamp" => $timestamp
];
echo json_encode($retval);




// $query = $dbconn->prepare("SELECT * FROM `form_item` WHERE `FORM_ID`='$form_id' ORDER BY SQ_NO");
// $query->execute();
?>