<?php 
	echo "test page \n";
    session_start();
    echo '<pre>';
    print_r($_SESSION);
    echo '</pre>';

    // include_once($_SERVER['DOCUMENT_ROOT'] . '/webchat/logics/chat_dbconn.php');

    // $dbconn = paliolite();

    // // STATUS
    // $query = $dbconn->prepare("SELECT REQUEST_DATE FROM CONTACT_CENTER WHERE F_PIN = '02493a69d9'");
    // // $query->bind_param("s", $f_pin);
    // $query->execute();
    // $status = $query->num_rows;
    // $query->close();

    // // send user data as json
    // echo($status);

?>
