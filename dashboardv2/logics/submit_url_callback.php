<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/dashboardv2/logics/db_conn.php');

session_start();

$dbconn = dbConnPalioLite();

$companyId = $_SESSION['id_company'];

$url_callback = $_POST['url'];

// get BE ID
$sqlBE = 'SELECT ID FROM `BUSINESS_ENTITY` be WHERE COMPANY_ID = ' . $companyId;
$query = $dbconn->prepare($sqlBE);
$query->execute();
$be_id = $query->get_result()->fetch_assoc();
$query->close();

$form_query = "INSERT INTO `CTA_CALLBACK`
(`BE_ID`, `CALLBACK`)
VALUES 
(".$be_id["ID"].", '$url_callback')
ON DUPLICATE KEY UPDATE    
CALLBACK = '$url_callback'";
$query = $dbconn->prepare($form_query);
$query->execute();
$query->close();

echo "Success," . $url_callback;
?>