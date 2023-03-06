<?php 

    include_once($_SERVER['DOCUMENT_ROOT'] . '/url_function.php');
    include_once($_SERVER['DOCUMENT_ROOT'] . '/webchat/logics/chat_dbconn.php');

    $dbconn = paliolite();
    $fpin = $_GET['f_pin'];

    // SELECT USER PROFILE
    $query = $dbconn->prepare("(SELECT msg.*
    FROM MESSAGE_WEB msg
    LEFT JOIN GROUPS gr ON msg.DESTINATION = gr.GROUP_ID 
    LEFT JOIN MEMBERS mbr ON mbr.GROUP_ID = gr.GROUP_ID WHERE msg.DESTINATION = gr.GROUP_ID 
    AND mbr.F_PIN = ? )
    UNION (
    SELECT msg.*
    FROM MESSAGE_WEB msg
    LEFT JOIN FRIEND_LIST fl ON msg.DESTINATION = fl.L_PIN WHERE fl.F_PIN = ? AND msg.ORIGINATOR = ?
    ) UNION (
    SELECT msg.*
    FROM MESSAGE_WEB msg
    LEFT JOIN FRIEND_LIST fl ON msg.ORIGINATOR = fl.L_PIN WHERE fl.F_PIN = ? AND msg.DESTINATION = ?
    )
    ");
    $query->bind_param("sssss", $fpin, $fpin, $fpin, $fpin, $fpin);
    $query->execute();
    $messages = $query->get_result();
    $query->close();

    $rows = array();
    while ($message = $messages->fetch_assoc()) {
        // remove symbols
        $message['CONTENT'] = preg_replace('/[^A-Za-z0-9\s~`*!@#$%^&()_={}[\]:;,.<>+\/?-]/u', '', $message['CONTENT']);
        
        $rows[] = $message;
    };

    echo json_encode($rows);

?>
