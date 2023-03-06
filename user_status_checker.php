<?php 

    include_once($_SERVER['DOCUMENT_ROOT'] . '/db_conn.php');

    $dbconn = getDBConn();

    $company_id = $_POST['company_id'];
    
    $query = $dbconn->prepare("SELECT * FROM USER_ACCOUNT WHERE COMPANY = ?");
    $query->bind_param("i", $company_id);
    $query->execute();
    $checkSts = $query->get_result()->fetch_assoc();
    $userStatus = $checkSts['STATUS'];
    $query->close();

    echo $userStatus;
    
    ?>