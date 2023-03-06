<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

    include_once($_SERVER['DOCUMENT_ROOT'] . '/db_conn.php');
    $db_conn = getDBConn();
    session_start();

	$email = strtolower($_POST['forgotMail']);

	$str = 'SELECT COMPANY FROM USER_ACCOUNT WHERE EMAIL_ACCOUNT = \''.$email.'\'';
	// echo $str;
	$query = $db_conn->prepare($str);
	$query->execute();
	$user = $query->get_result()->fetch_assoc();
	$query->close();

	if (!$user) {
		echo "0";
	}
    else {
        echo "1";
    }
?>