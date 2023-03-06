<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/url_function.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/persib_web/logics/chat_dbconn.php');

$dbconn = paliolite();
if(!isset($f_pin) && isset($_REQUEST['f_pin'])){
    $f_pin = $_REQUEST['f_pin'];
}
if(!isset($que) && isset($_REQUEST['query'])){
    $que = $_REQUEST['query'];
}
if(!isset($filter) && isset($_REQUEST['filter'])){
    $filter = $_REQUEST['filter'];
}
if(!isset($f_pin)){
    $f_pin = '';
}
if(!isset($que)){
    $que = '';
}
if(!isset($filter)){
    $filter = '1';
}

$que = '%' . $que . '%';

$sql = "call GET_POST_TIMELINE_NEW(?, ?, '0', ?)";
$query = $dbconn->prepare($sql);
$query->bind_param("sss",$f_pin,$filter,$que);
// SELECT USER PROFILE
$query->execute();
$groups  = $query->get_result();
$query->close();

$rows = array();
while ($group = $groups->fetch_assoc()) {
    $rows[] = $group;
};

return $rows;
?>