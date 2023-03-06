<?php

// WHEN USER OPEN THIS PAGE, CREATE QR CODE
// IF USER SCANS THE QR CODE, CHECK USER STATUS AND REDIRECT TO CHAT_PAGE

include_once($_SERVER['DOCUMENT_ROOT'] . '/url_function.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/chatcore/logics/chat_dbconn.php');

session_start();
$dbconn = newnus();

if(isset($_SESSION['web_login'])){
    // USER SCANNED IN
    $query = $dbconn->prepare("SELECT * FROM WEB_LOGIN WHERE QR_CODE = ?");
    $query->bind_param("s", $_SESSION['web_login']);
    $query->execute();
    $status = $query->get_result()->fetch_assoc();
    $query->close();

    $env = $_GET['env'];

    if($status['STATUS'] != 0){
        if($status['FLAG'] == 1){
            if ($env == '3') {
                redirect(base_url() . 'chatcore/pages/digisales/chat_index.php');
            } else {
                redirect(base_url() . 'chatcore/pages/paliolite/chat_index.php');
            }
        } else if($status['FLAG'] == 2){
            redirect(base_url() . 'chatcore/pages/gaspol/chat_index.php');
        }

    } else {
        // GENERATE NEW RECORD IN WEB_LOGIN
        $query = $dbconn->prepare("INSERT INTO WEB_LOGIN (QR_CODE) VALUES (MD5(RAND()))");
        $status = $query->execute();
        while( false===$status ){
            $query = $dbconn->prepare("INSERT INTO WEB_LOGIN (QR_CODE) VALUES (MD5(RAND()))");
            $status = $query->execute();
        }
        $id_qr = $query->insert_id;
        $query->close();

        $query = $dbconn->prepare("SELECT * FROM WEB_LOGIN WHERE ID = ?");
        $query->bind_param("i", $id_qr);
        $query->execute();
        $qr = $query->get_result()->fetch_assoc();
        $_SESSION['web_login'] = $qr['QR_CODE'];
        $query->close();

    }

} else {
    // GENERATE NEW RECORD IN WEB_LOGIN
    $query = $dbconn->prepare("INSERT INTO WEB_LOGIN (QR_CODE) VALUES (MD5(RAND()))");
    $status = $query->execute();
    while( false===$status ){
        $query = $dbconn->prepare("INSERT INTO WEB_LOGIN (QR_CODE) VALUES (MD5(RAND()))");
        $status = $query->execute();
    }
    $id_qr = $query->insert_id;
    $query->close();

    $query = $dbconn->prepare("SELECT * FROM WEB_LOGIN WHERE ID = ?");
    $query->bind_param("i", $id_qr);
    $query->execute();
    $qr = $query->get_result()->fetch_assoc();
    $_SESSION['web_login'] = $qr['QR_CODE'];
    $query->close();
    
}
