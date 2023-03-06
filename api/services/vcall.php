<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and object files
include_once '../objects/vcall.php';

// initialize email
$caller = new Vcall();

// make sure data is not empty check the destination
if (

    !empty($_POST['api_key']) &&
    !empty($_POST['user_id']) &&
    !empty($_POST['room_name']) &&
    !empty($_POST['camera']) 
) {

    $caller->ApiKey = $_POST['api_key'];
    $caller->UserID = $_POST['user_id'];
    $caller->RoomName = $_POST['room_name'];
    $caller->Code = $_POST['code'];

    // set response code - 200 OK
    http_response_code(200);

    // tell the user
    echo json_encode(array("Download Link" => $caller->DownloadURL, "URL" => $caller->generateURL()), JSON_UNESCAPED_SLASHES);
}

// tell the user data is incomplete
else {

    // set response code - 400 bad request
    http_response_code(400);

    // tell the user
    echo json_encode(array("message" => "Data is incomplete."));
}
