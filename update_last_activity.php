<?php

//update_last_activity.php

include_once($_SERVER['DOCUMENT_ROOT'] . '/url_function.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/db_conn.php');

session_start();
$dbconn = getDBConn();

$query = $dbconn->prepare("UPDATE LOGIN_DETAILS SET LAST_ACTIVITY = NOW() WHERE LOGIN_DETAILS_ID = ?");
$query->bind_param("i", $_SESSION["login_details_id"]);
$query->execute();
$query->close();
