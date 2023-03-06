<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/url_function.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/db_conn.php'); ?>
<?php

    $company_id = $_POST['company_id'];
    // $company_id = 63;

    // after 1 hour if the payment isn't completed, account will be deleted
    sleep(60*60);
    $dbconn = getDBConn();

    // check the payment status
    $query = $dbconn->prepare("SELECT * FROM USER_ACCOUNT WHERE COMPANY = ?");
    $query->bind_param("i", $company_id);
    $query->execute();
    $userData = $query->get_result()->fetch_assoc();
    $userState = $userData['STATE'];
    $query->close();

    if($userState == 0){
        // payment is not made
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

        echo "This Account Deleted!";
        error_log('1 hour has passed, account ' . $userData['EMAIL_ACCOUNT'] . " is deleted!");

    } else {
        
        echo "This User Paid!";

    }

?>