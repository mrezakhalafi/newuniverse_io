<?php

// WHEN USER OPEN THIS PAGE, CREATE QR CODE
// IF USER SCANS THE QR CODE, CHECK USER STATUS AND REDIRECT TO CHAT_PAGE

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

include_once($_SERVER['DOCUMENT_ROOT'] . '/url_function.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/chatcore/logics/chat_dbconn.php');

session_start();
$dbconn = newnusgaspol();

if(isset($_SESSION['web_login'])){
    // USER SCANNED IN
    $query = $dbconn->prepare("SELECT * FROM WEB_LOGIN WHERE QR_CODE = ?");
    $query->bind_param("s", $_SESSION['web_login']);
    $query->execute();
    $status = $query->get_result()->fetch_assoc();
    $query->close();

    if($status['STATUS'] != 0){
        if($status['FLAG'] == 1){
            $dbconnPalio = paliolite();

            $query = $dbconnPalio->prepare("SELECT * FROM ADMIN_PROVINCE WHERE F_PIN = '$f_pin' AND BE_ID = 282");
            $query->execute();
            $adm_status = $query->get_result()->fetch_assoc();
            $query->close();

            if ($adm_status != null) {
                $_SESSION["F_PIN"] = $status["F_PIN"];
                $_SESSION["FLAG"] = $status["FLAG"];
                $_SESSION["ADMIN_PROVINCE"] = $adm_status["PROVINCE_ID"];

                $qr_login = $_SESSION['web_login'];

                $delete_old = "DELETE FROM WEB_LOGIN WHERE F_PIN = '$f_pin' AND QR_CODE NOT IN ('$qr_login')";
                $query = $dbconn->prepare($delete_old);
                $query->execute();
                $adm_status = $query->get_result()->fetch_assoc();
                $query->close();

                echo '<script>';
                echo 'localStorage.setItem("F_PIN", "'.$status["F_PIN"].'");';
                echo 'localStorage.setItem("FLAG", 1);';
                echo '</script>';

                redirect(base_url() . 'gaspol_web/pages/gaspol-landing/dashboard/index');
            } else {
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

                echo '<script>';
                echo 'window.location.reload();';
                echo '</script>';
            }
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
