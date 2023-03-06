<?php

session_start();

include_once($_SERVER['DOCUMENT_ROOT'] . '/db_conn.php');

$dbconn = getDBConn();
$company_id = $_POST['company_id'];

$query = $dbconn->prepare("DELETE FROM COMPANY WHERE ID = ?");
$query->bind_param("i", $company_id);
$query->execute();
$query->close();

$query = $dbconn->prepare("DELETE FROM SUBSCRIBE WHERE COMPANY = ?");
$query->bind_param("i", $company_id);
$query->execute();
$query->close();

$query = $dbconn->prepare("DELETE FROM USER_ACCOUNT WHERE COMPANY = ?");
$query->bind_param("i", $company_id);
$query->execute();
$query->close();

$query = $dbconn->prepare("DELETE FROM BILLING WHERE COMPANY = ?");
$query->bind_param("i", $company_id);
$query->execute();
$query->close();

$query = $dbconn->prepare("DELETE FROM COMPANY_INFO WHERE COMPANY = ?");
$query->bind_param("i", $company_id);
$query->execute();
$query->close();

unset($_SESSION['password']);
unset($_SESSION['email']);
unset($_SESSION['hash']);
unset($_SESSION['companyname']);
unset($_SESSION['username']);
unset($_SESSION['price']);
unset($_SESSION['id_company']);

session_destroy();

?>
