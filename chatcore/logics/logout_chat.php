<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/url_function.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/chatcore/logics/chat_dbconn.php');

session_start();
$dbconn = newnus();

$query = $dbconn->prepare("SELECT * FROM WEB_LOGIN WHERE QR_CODE = ?");
$query->bind_param("s", $_SESSION['web_login']);
$query->execute();
$user = $query->get_result()->fetch_assoc();
$query->close();

$query = $dbconn->prepare("DELETE FROM WEB_LOGIN WHERE F_PIN = ?");
$query->bind_param("s", $user['F_PIN']);
$query->execute();
$query->close();

session_destroy();
redirect(base_url());