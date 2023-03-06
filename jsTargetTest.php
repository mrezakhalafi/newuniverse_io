<?php 

    include_once($_SERVER['DOCUMENT_ROOT'] . '/db_conn.php');

    $dbconn = getDBConn();

    if (isset($_POST['email'])) {
        $email = $_POST['email'];
        $query = $dbconn->prepare("SELECT COUNT(*) AS CNT FROM USER_ACCOUNT WHERE EMAIL_ACCOUNT = ?");
        $query->bind_param("s", $email);
        $query->execute();
        $items = $query->get_result()->fetch_assoc();
        $countEmail = $items['CNT'];
        // $cnt = $items['cnt'];
        $query->close();

        echo $countEmail;   
    }


?>