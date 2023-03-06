<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/url_function.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/persib_web/logics/chat_dbconn.php');

$dbconn = paliolite();

$f_pin = $_GET['f_pin'];
// SELECT USER PROFILE
if(!isset($f_pin) && isset($_GET['f_pin'])){
    $f_pin = $_GET['f_pin'];
}
$rows = array();
if (isset($f_pin)) {
    $query = $dbconn->prepare("SELECT POST_ID FROM POST_REACTION WHERE F_PIN = ? AND FLAG = 1");
    $query->bind_param("s", $f_pin);
    // SELECT USER PROFILE
    $query->execute();
    $groups  = $query->get_result();
    $query->close();
    
    while ($group = $groups->fetch_assoc()) {
        $rows[] = $group;
    };
};
echo json_encode($rows);
?>