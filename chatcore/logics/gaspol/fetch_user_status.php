<?php

// HIT THIS PAGE TO GET USER STATUS STATUS

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

include_once($_SERVER['DOCUMENT_ROOT'] . '/chatcore/logics/chat_dbconn.php');

$dbconn = newnusgaspol();
$qr_code = $_GET['qr_code'];

$dbconnPalio = paliolite();

session_start();

// echo "SELECT wl.*, ule.USER_TYPE FROM WEB_LOGIN wl LEFT JOIN USER_LIST_EXTENDED ule ON ule.F_PIN = wl.F_PIN WHERE QR_CODE = '$qr_code'";

// STATUS
$query = $dbconn->prepare("SELECT * FROM WEB_LOGIN WHERE QR_CODE = '$qr_code'");
$query->execute();
$status = $query->get_result()->fetch_assoc();
$query->close();


if ($status["F_PIN"] != null) {

    $f_pin = $status["F_PIN"];

    // check admin status
    $query = $dbconnPalio->prepare("SELECT * FROM ADMIN_PROVINCE WHERE F_PIN = '$f_pin' AND BE_ID = 282");
    $query->execute();
    $adm_status = $query->get_result()->fetch_assoc();
    $query->close();


    if ($adm_status != null) {
        $_SESSION["F_PIN"] = $status["F_PIN"];
        $_SESSION["FLAG"] = $status["FLAG"];
        $_SESSION["ADMIN_PROVINCE"] = $adm_status["PROVINCE_ID"];

        $data = array(
            'F_PIN' => $status["F_PIN"],
            'FLAG' => $status["FLAG"],
            'CREATED_AT' => $status["CREATED_AT"],
            'STATUS' => $status["STATUS"],
            'QR_CODE' => $status["QR_CODE"],
            'USER_TYPE' => $adm_status["PROVINCE_ID"]
        );     
          
        $delete_old = "DELETE FROM WEB_LOGIN WHERE F_PIN = '$f_pin' AND QR_CODE NOT IN ('$qr_code')";
        $query = $dbconn->prepare($delete_old);
        $query->execute();
        $query->close();
        
    } else {
        // $query = $dbconn->prepare("DELETE FROM WEB_LOGIN WHERE QR_CODE = '$qr_code'");
        // $query->execute();
        // $status = $query->get_result()->fetch_assoc();
        // $query->close();

        $data = array(
            'ERROR' => 'Please login as an administrator.',
        );   
    }

    
    echo json_encode($data);
    // send user data as json
} else {

    // send user data as json
    echo json_encode($status);
}
