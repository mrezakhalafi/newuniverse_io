<?php 

    include_once($_SERVER['DOCUMENT_ROOT'] . '/url_function.php');
    include_once($_SERVER['DOCUMENT_ROOT'] . '/webchat/logics/chat_dbconn.php');

    $dbconn = paliolite();
    $fpin = $_GET['f_pin'];

    // SELECT USER PROFILE
    $query = $dbconn->prepare("SELECT * FROM FRIEND_LIST WHERE F_PIN = ?");
    $query->bind_param("s", $fpin);
    $query->execute();
    $lpins = $query->get_result();
    $query->close();

    $rows = array();
    while ($lpin = $lpins->fetch_assoc()) {
        $rows[] = $lpin;
    };

    echo json_encode($rows);
 
 ?>