<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/dashboardv2/logics/db_conn.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$dbconn = dbConnPalioLite();

$json = file_get_contents('php://input');
// var_dump($json);
$data = json_decode(stripslashes($json),true);
// $data = json_decode(json_encode($datax),true);
// var_dump($data);
$title = $data["title"];
$items = $data["items"];
// $deleted = $data["deleted"];
// $added = $data["added"];
$form_id = $data["form_id"];

$query = $dbconn->prepare("UPDATE `FORM` SET `TITLE`='".$title."' WHERE `FORM_ID`='".$form_id."'");
$query->execute();

// foreach($deleted as $d){
//     $item_id = $d["value"];
//     $item_query = "DELETE FROM `FORM_ITEM` WHERE `SQ_NO`=".$item_id." AND `FORM_ID`='".$form_id."'";
//     // $query = $dbconn->prepare($item_query);
//     // $query->execute();
//     echo $item_query;
//     echo "<br>";
// }

$sqlRemove = "DELETE FROM `FORM_ITEM` WHERE `FORM_ID`='".$form_id."'";
$query = $dbconn->prepare($sqlRemove);
$query->execute();
$query->close();

// $item_query = "INSERT INTO `FORM_ITEM` (`FORM_ID`,`LABEL`,`KEY`,`VALUE`,`SQ_NO`,`TYPE`) VALUES ";
$sql_query = "";
$index = 1;
foreach($items as $item){
    $item_id = $item["id"];
    $label = $item["label"];
    $key = $item["key"];
    $value = $item["value"];
    $sq_no = $index;
    $type = $item["type"];
    // if(!in_array($item_id, $added)){
    //     $item_query = "UPDATE `FORM_ITEM` SET `LABEL`='".$label."', `KEY`='".$key."', `VALUE`='".$value."', `SQ_NO`=".$sq_no.", `TYPE`='".$type."' WHERE `FORM_ID`='".$form_id."'";
    // }
    // else{
        $item_query = "INSERT INTO `FORM_ITEM` (`FORM_ID`,`LABEL`,`KEY`,`VALUE`,`SQ_NO`,`TYPE`) VALUES ('".$form_id."','".$label."','".$key."','".$value."',".$sq_no.",'".$type."')";
        // $sql_query = $sql_query."('".$form_id."','".$label."','".$key."','".$value."',".$sq_no.",'".$type."')";
        // $item_query = $item_query.$sql_query;
    // }
    // echo "<br>";
    // echo $item_query;
    // echo "<br>";
    $query = $dbconn->prepare($item_query);
    $query->execute();
    $index++;
}
// $query = $dbconn->prepare("SELECT * FROM `form_item` WHERE `FORM_ID`='$form_id' ORDER BY SQ_NO");
// $query->execute();
echo 'ok';

?>