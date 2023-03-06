<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/url_function.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/db_conn.php'); ?>
<?php

    $dbconn = getDBConn();
    $company_id = $_POST['company_id'];

    $query = $dbconn->prepare("SELECT * FROM USER_ACCOUNT WHERE COMPANY = ?");
    $query->bind_param("i", $company_id);
    $query->execute();
    $userData = $query->get_result()->fetch_assoc();
    $userActive = $userData['ACTIVE'];
    $query->close();

    echo $userActive;

?>