<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/db_conn.php');

$dbconn = getDBConn();

if (isset($_POST['company'])) {
    $company = $_POST['company'];
    $query = $dbconn->prepare("SELECT COUNT(*) AS CNT FROM COMPANY_INFO WHERE COMPANY_NAME = ?");
    $query->bind_param("s", $company);
    $query->execute();
    $items = $query->get_result()->fetch_assoc();
    $countCompany = $items['CNT'];
    // $cnt = $items['cnt'];
    $query->close();

    echo $countCompany;
}
