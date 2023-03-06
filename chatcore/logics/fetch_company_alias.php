<?php

    // HIT THIS PAGE TO GET USER STATUS STATUS

    include_once($_SERVER['DOCUMENT_ROOT'] . '/chatcore/logics/chat_dbconn.php');

    $dbconn = paliolite();
    $f_pin = $_POST['f_pin'];

    // STATUS
    $query = $dbconn->prepare("SELECT ul.*
    FROM `USER_LIST` ul
    LEFT JOIN `USER_LIST_EXTENDED` ule
    ON ul.F_PIN = ule.F_PIN
    WHERE ul.BE IN
    (SELECT BE 
    FROM USER_LIST
    WHERE F_PIN = ?)
    AND ule.OFFICIAL_ACCOUNT = '1'");
    $query->bind_param("s", $f_pin);
    $query->execute();
    $status = $query->get_result()->fetch_assoc();
    $query->close();

    // send user data as json
    echo json_encode($status);
 
?>