<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/chatcore/logics/chat_dbconn.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

$_SESSION['currenttime'] = time();

// $webrest_palio = "http://192.168.1.100:8004/webrest/";
// $webrest_cu = "http://127.0.0.1:8104/webrest/";

// $fpin = $_SESSION['complain_officer'];
// $customer = $_SESSION['complain_cust'];
// $ongoing_complain_id = $_SESSION['ongoing_complain_id'];
// $inc_complain_id = $_SESSION['inc_complain_id'];
// $call_complain_id = $_SESSION['call_complain_id'];

// function rejectComplain()
// {
//     try {

//         global $webrest_palio;
//         global $fpin;
//         global $customer;
//         global $inc_complain_id;

//         $api_url = $webrest_palio;
//         $api_data = array(
//             'code' => 'RJTOCC',
//             'data' => array(
//                 'from' => $fpin,
//                 'to' => $customer,
//                 'channel' => "0",
//             ),
//         );

//         $api_options = array(
//             'http' => array(
//                 'header'  => "Content-type: application/json\r\n",
//                 'method'  => 'POST',
//                 'content' => strval(json_encode($api_data))
//             )
//         );

//         $api_stream = stream_context_create($api_options);
//         $api_result = file_get_contents($api_url, false, $api_stream);
//         $api_json_result = json_decode($api_result);

//         return 1;

//         if (http_response_code() != 200) {
//             throw new Exception('Send message failed!');
//         }
//     } catch (Exception $e) {

//         echo $e->getMessage();
//     }
// }

// function finishComplain()
// {
//     global $webrest_palio;
//     global $fpin;
//     global $customer;
//     global $ongoing_complain_id;

//     try {

//         $api_url = $webrest_palio;
//         $api_data = array(
//             'code' => 'ENDCC',
//             'data' => array(
//                 'from' => $fpin,
//                 'to' => $customer,
//                 'data' => $ongoing_complain_id,
//             ),
//         );

//         $api_options = array(
//             'http' => array(
//                 'header'  => "Content-type: application/json\r\n",
//                 'method'  => 'POST',
//                 'content' => strval(json_encode($api_data))
//             )
//         );

//         $api_stream = stream_context_create($api_options);
//         $api_result = file_get_contents($api_url, false, $api_stream);
//         $api_json_result = json_decode($api_result);

//         return 1;

//         if (http_response_code() != 200) {
//             throw new Exception('Send message failed!');
//         }
//     } catch (Exception $e) {

//         return $e->getMessage();
//     }
// }

// function removeCallNotif()
// {

//     global $webrest_palio;
//     global $fpin;
//     global $customer;
//     global $call_complain_id;

//     try {

//         $api_url = $webrest_palio;
//         $api_data = array(
//             'code' => 'CNCLCC',
//             'data' => array(
//                 'complaint_id' => $call_complain_id,
//             ),
//         );

//         $api_options = array(
//             'http' => array(
//                 'header'  => "Content-type: application/json\r\n",
//                 'method'  => 'POST',
//                 'content' => strval(json_encode($api_data))
//             )
//         );

//         $api_stream = stream_context_create($api_options);
//         $api_result = file_get_contents($api_url, false, $api_stream);
//         $api_json_result = json_decode($api_result);

//         return 1;

//         if (http_response_code() != 200) {
//             throw new Exception('cancel notif failed!');
//         }
//     } catch (Exception $e) {

//         echo $e->getMessage();
//     }
// }

// function logOut() {
//     $dbconn = newnus();

// 	$query = $dbconn->prepare("SELECT * FROM WEB_LOGIN WHERE QR_CODE = ?");
// 	$query->bind_param("s", $_SESSION['web_login']);
// 	$query->execute();
// 	$user = $query->get_result()->fetch_assoc();
// 	$query->close();

// 	$query = $dbconn->prepare("DELETE FROM WEB_LOGIN WHERE F_PIN = ? AND FLAG = 1");
// 	$query->bind_param("s", $user['F_PIN']);
// 	$query->execute();
// 	$query->close();

// 	session_destroy();
// }

// $time = $_GET['t'];
// $_SESSION['currenttime'] = $time;


// $current = floor(microtime(true) * 1000);

// // echo $current-$_SESSION['currenttime'];

// // http_response_code(200);

// // sleep(15);
// if (floor(microtime(true) * 1000) - $_SESSION['currenttime'] >= 10000) { // current - session > 10s

//     logOut();

//     // include 'force_logout.php';
//     // $dbconn = newnus();

// 	// $query = $dbconn->prepare("SELECT * FROM WEB_LOGIN WHERE QR_CODE = ?");
// 	// $query->bind_param("s", $_SESSION['web_login']);
// 	// $query->execute();
// 	// $user = $query->get_result()->fetch_assoc();
// 	// $query->close();

// 	// $query = $dbconn->prepare("DELETE FROM WEB_LOGIN WHERE F_PIN = ? AND FLAG = 1");
// 	// $query->bind_param("s", $user['F_PIN']);
// 	// $query->execute();
// 	// $query->close();

//     // if (isset($_SESSION['ongoing_complain_id'])) {
//     //     if (finishComplain() == 1) {
//     //         logOut();
//     //     }
//     // }

//     // if (isset($_SESSION['inc_complain_id'])) {
//     //     if (rejectComplain() == 1) {
//     //         logOut();
//     //     }
//     // }
    
// 	// if (isset($_SESSION['call_complain_id'])) {
//     //     if (removeCallNotif() == 1) {
//     //         logOut();
//     //     }
//     // }
// } else {
//     $_SESSION['currenttime'] = floor(microtime(true) * 1000);
// }
