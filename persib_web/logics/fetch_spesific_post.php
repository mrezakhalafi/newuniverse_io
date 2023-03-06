<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/url_function.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/persib_web/logics/chat_dbconn.php');

$dbconn = paliolite();

if(isset($_REQUEST['product_code'])){
    $product_code = $_REQUEST['product_code'];
}

$query = $dbconn->prepare("SELECT p.TITLE, p.DESCRIPTION, p.THUMB_ID, p.CREATED_DATE, u.IMAGE as SHOP_THUMB_ID FROM POST p join USER_LIST u on p.F_PIN = u.F_PIN WHERE p.POST_ID='$product_code'");
$query->execute();
$groups  = $query->get_result();
$query->close();

$rows = array();
while ($group = $groups->fetch_assoc()) {
    $rows[] = $group;
};

// echo json_encode($rows);

return $rows;
