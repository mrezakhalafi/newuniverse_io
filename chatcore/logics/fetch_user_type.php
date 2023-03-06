<?php

    // HIT THIS PAGE TO GET USER STATUS STATUS

    include_once($_SERVER['DOCUMENT_ROOT'] . '/chatcore/logics/chat_dbconn.php');

    $dbconn = paliolite();
    $f_pin = $_POST['f_pin'];

    // STATUS
    $query = $dbconn->prepare("SELECT * FROM CONTACT_CENTER WHERE F_PIN = ?");
    $query->bind_param("s", $f_pin);
    $query->execute();
    $status = $query->get_result()->fetch_assoc();
    $query->close();

    // send user data as json
    echo json_encode($status);
 
?>