<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and object files
include_once '../objects/message.php';

// initialize email
$messager = new Message();

// make sure data is not empty
if (
    !empty($_POST['originator']) &&
    !empty($_POST['destination']) &&
    !empty($_POST['content'])
) {
    $messager->MessageID = $_POST['originator'] . round(microtime(true) * 1000);

    // set product property values
    $messager->Originator = $_POST['originator'];
    $messager->Destination = $_POST['destination'];
    $messager->Content = $_POST['content'];
    
    $messager->Hex = round(microtime(true) * 1000);
    $messager->Scope = $_POST['scope'];
    $messager->ChatID = $_POST['chat_id'];
    $messager->IsComplain = $_POST['is_complain'];
    $messager->ReplyTo = $_POST['reply_to'];
    $messager->CCID = $_POST['call_center_id'];

    // check for attachments
    if (!empty($_FILES['file'])) {

        $_FILES['file']['name'] = preg_replace('/\s/i', '%20', $_FILES['file']['name']);
        $messager->upload_attachment($_FILES);
    }

    // create the product
    if ($messager->send_message()) {

        // set response code - 200 OK
        http_response_code(200);

        // tell the user
        echo json_encode(array("message" => "Message was sent."));
    }

    // if unable to create the product, tell the user
    else {

        // set response code - 503 service unavailable
        http_response_code(503);

        // tell the user
        echo json_encode(array("message" => "Unable to send message."));
    }
}

// tell the user data is incomplete
else {

    // set response code - 400 bad request
    http_response_code(400);

    // tell the user
    echo json_encode(array("message" => "Unable to send message. Data is incomplete."));
}
