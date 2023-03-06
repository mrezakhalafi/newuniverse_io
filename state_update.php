<?php
    include_once($_SERVER['DOCUMENT_ROOT'] . '/db_conn.php');
    $dbconn = getDBConn();
    $company_id = $_POST['company_id'];
    
    $query = $dbconn->prepare("UPDATE USER_ACCOUNT SET STATE = 1 WHERE COMPANY = ?");
    $query->bind_param("i", $company_id);
    $query->execute();

    if (!$dbconn->commit()) {
        echo "Update failed!";
    } else {
        echo "Update success!";
    }

    $query->close();
?>