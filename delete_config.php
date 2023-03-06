<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/url_function.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/db_conn.php');
$dbconn = dbConnPalioLite();

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

if (isset($_GET['url'])) {
    $url = $_GET['url'];
} else {
    echo "URL not supplied";
    die();
}

$sqlGetUCD = "SELECT * FROM UI_CONFIG WHERE `URL` = '$url'";
$query = $dbconn->prepare($sqlGetUCD);
$query->execute();
$getUCD = $query->get_result()->fetch_assoc();
$query->close();

$ui_config = $getUCD['ID'];

// echo($ui_config);

$sqlUC = "DELETE FROM UI_CONFIG WHERE `URL` = '$url'";
$sqlUCD = "DELETE FROM UI_CONFIG_DETAIL WHERE UI_CONFIG = '$ui_config'";

if (mysqli_query($dbconn, $sqlUC) && mysqli_query($dbconn, $sqlUCD)){
    echo (1);
}else{
    echo(0);
}

?>