<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/db_conn.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/url_function.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

// $connection = ssh2_connect('192.168.1.100', 2309);
// ssh2_auth_password($connection, 'easysoft', '*347e^!VU4y+#hAP');

$dbconn = getDBConn();
$dbConnPalio = dbConnPalioLite();

$hms_json_path = "/apps/lcs/paliolite/server/lib/accounts/";

$huawei_pushkit = "";
$gps_pushkit = 0;

$id_company = $_SESSION['id_company'];

$sqlBE = "SELECT ID FROM BUSINESS_ENTITY WHERE COMPANY_ID = '$id_company'";
$query = $dbConnPalio->prepare($sqlBE);
// echo $sqlBE;
$query->execute();
$res = $query->get_result()->fetch_assoc();
$be_id = $res["ID"];

try {
    if (isset($_FILES['huawei_pushkit']) && $_FILES['huawei_pushkit']['size'] != 0) {
        // No file was selected for upload, your (re)action goes here
        $millisecond = floor(microtime(true) * 1000);
        $json_name = $be_id . '_hms_' . $millisecond . ".json";
        if (move_uploaded_file($_FILES['huawei_pushkit']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/dashboardv2/uploads/huawei_pushkit/' . $json_name)) {
            $huawei_pushkit = $json_name;

            // $ssh_local_file = $_SERVER['DOCUMENT_ROOT'] . '/dashboardv2/uploads/huawei_pushkit/' . $json_name;
            // ssh2_scp_send($connection, $ssh_local_file, $hms_json_path . $json_name, 0777);

            $huawei_clientID = $_POST["huawei_clientID"];
            $sqlPrefs = "REPLACE INTO `SERVICE_ACCOUNTS` (`BUSINESS_ENTITY`, `PRIVATE_KEY`, `CLIENT_SECRET`, `TYPE`) VALUES ($be_id, '$huawei_pushkit', '$huawei_clientID', 0)";
            $prefsBg = $dbConnPalio->prepare($sqlPrefs);
            $prefsBg->execute();
            $prefsBg->close();

            // echo "INSERT SERVICE ACCOUNT";
        }
    } else if (isset($_POST["huawei_pushkit"]) && intval($_POST["huawei_pushkit"] == 0)) {
        $sqlPrefs = "DELETE FROM `SERVICE_ACCOUNTS` WHERE `BUSINESS_ENTITY` = $be_id AND `TYPE` = 0";
        $prefsBg = $dbConnPalio->prepare($sqlPrefs);
        $prefsBg->execute();
        $prefsBg->close();
    }

    if (isset($_POST["gps_pushkit"])) {
        if (intval($_POST["gps_pushkit"]) == 1) {
            // $gps_clientID = $_POST["gps_clientID"];
            $sqlPrefs = "REPLACE INTO `SERVICE_ACCOUNTS` (`BUSINESS_ENTITY`, `PRIVATE_KEY`, `TYPE`) VALUES ($be_id, 'push-kit-de2e3-firebase-adminsdk-gxv6c-79deb86157.json', 1)";
            $prefsBg = $dbConnPalio->prepare($sqlPrefs);
            $prefsBg->execute();
            $prefsBg->close();
        } else {
            $sqlPrefs = "DELETE FROM `SERVICE_ACCOUNTS` WHERE `BUSINESS_ENTITY` = $be_id AND `TYPE` = 1";
            $prefsBg = $dbConnPalio->prepare($sqlPrefs);
            $prefsBg->execute();
            $prefsBg->close();
        }
    }
    
    echo "Success";
} catch (Exception $e) {
    echo $e->getMessage();
}