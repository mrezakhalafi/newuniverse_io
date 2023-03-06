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
include_once '../objects/broadcast.php';

// initialize email
$broadcaster = new Broadcast();

// make sure data is not empty
if (
    
    !empty($_POST['sender']) &&
    !empty($_POST['target_audience']) &&
    !empty($_POST['broadcast_type']) &&
    !empty($_POST['broadcast_mode']) &&
    // !empty($_POST['starting_date']) &&
    isset($_POST['category']) &&
    !empty($_POST['title']) &&
    !empty($_POST['message']) &&
    !empty($_POST['start_date']) 
    // !empty($_POST['start_date']) &&
    // !empty($_POST['destinations']) || !empty($_FILES['destinations']) 
) {

    // set product property values
    $broadcaster->Sender = $_POST['sender'];
    $broadcaster->TargetAudience = $_POST['target_audience'];
    $broadcaster->BroadcastType = $_POST['broadcast_type'];
    $broadcaster->BroadcastMode = $_POST['broadcast_mode'];
    // $broadcaster->StartingDate = round(microtime(true) * 1000) + 3000;
    $broadcaster->Title = $_POST['title'];
    $broadcaster->Message = $_POST['message'];
    $broadcaster->Hex = round(microtime(true) * 1000);
    $broadcaster->Category = $_POST['category'];

    $start = date_create($_POST['start_date']);
    $broadcaster->StartingDate =  date_format($start, "Y/m/d H:i:s");

    // check for form id
    if (!empty($_POST['form_id'])) {

        $broadcaster->FormID = $_POST['form_id'];
    }

    // check for end date
    if (!empty($_POST['end_date'])) {

        $end = date_create($_POST['end_date']);
        $broadcaster->EndingDate =  date_format($end, "Y/m/d H:i:s");
    }

    // check for destinations type
    if (!empty($_POST['destinations'])) {

        $array = [];
        array_push($array, $_POST['destinations']);

    } else if (!empty($_FILES['destinations'])) {

        $txt_file = file_get_contents($_FILES['destinations']["tmp_name"]); // multiple email in a txt file separated by comma
        $array = explode(",", $txt_file); // turn emails into array
    }

    $broadcaster->Destinations = json_encode($array);

    // check for attachments
    if (!empty($_FILES['file'])) {

        $_FILES['file']['name'] = preg_replace('/\s/i', '%20', $_FILES['file']['name']);
        $broadcaster->upload_attachment($_FILES);
    }

    // echo "<br>";
    // echo "form " . $broadcaster->FormID;

    // create the product
    if ($broadcaster->send_broadcast()) {

        // set response code - 200 OK
        http_response_code(200);

        // tell the user
        echo json_encode(array("message" => "Broadcast was sent."));
    }

    // if unable to create the product, tell the user
    else {

        // set response code - 503 service unavailable
        http_response_code(503);

        // tell the user
        echo json_encode(array("message" => "Unable to send broadcast."));
    }
}

// tell the user data is incomplete
else {

    // set response code - 400 bad request
    http_response_code(400);

    // tell the user
    echo json_encode(array("message" => "Unable to send broadcast. Data is incomplete."));
}
