<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/url_function.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/persib_web/logics/chat_dbconn.php');

$dbconn = paliolite();
$store_id = $_GET['store_id'];

// SELECT USER PROFILE
if(!isset($store_id) && isset($_GET['store_id'])){
    $store_id = $_GET['store_id'];
}
if (isset($store_id)) {
    $query = $dbconn->prepare("SELECT p.*, s.CODE as STORE_CODE, s.NAME as STORE_NAME, s.THUMB_ID as STORE_THUMB_ID, s.LINK as STORE_LINK, s.TOTAL_FOLLOWER as TOTAL_FOLLOWER FROM PRODUCT p join SHOP s on p.SHOP_CODE = s.CODE WHERE p.SHOP_CODE = ? ORDER BY p.SCORE DESC, p.CREATED_DATE DESC");
    $query->bind_param("s", $store_id);
}
else {
    $query = $dbconn->prepare("SELECT p.*, s.CODE as STORE_CODE, s.NAME as STORE_NAME, s.THUMB_ID as STORE_THUMB_ID, s.LINK as STORE_LINK, s.TOTAL_FOLLOWER as TOTAL_FOLLOWER FROM PRODUCT p join SHOP s on p.SHOP_CODE = s.CODE ORDER BY p.SCORE DESC, p.CREATED_DATE DESC");
};
$query->execute();
$groups  = $query->get_result();
$query->close();

$rows = array();
while ($group = $groups->fetch_assoc()) {
    $rows[] = $group;
};

echo json_encode($rows);
?>