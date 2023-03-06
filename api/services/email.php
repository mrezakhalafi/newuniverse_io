<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and object files
include_once '../objects/email.php';

// initialize email
$mailer = new Email();

// make sure data is not empty check the destination
if (

    !empty($_POST['subject']) && 
    !empty($_POST['destinations']) || !empty($_FILES['destinations']) &&
    !empty($_POST['body']) &&
    !empty($_FILES['attachments'])

) {

    // set product property values
    $mailer->Subject = $_POST['subject'];

    // check for destinations type
    if(!empty($_POST['destinations'])){

        $mailer->addAddress($_POST['destinations']); // single email

    } else {

        $txt_file = file_get_contents($_FILES['destinations']["tmp_name"]); // multiple email in a txt file separated by comma
        $array = explode(",", $txt_file); // turn emails into array
        $mailer->addMultipleAddress($array);

    }

    // check for attachments
    if(!empty($_FILES['attachments'])) {

        // loop through attachments
        for ($i=0; $i < count($_FILES['attachments']["tmp_name"]); $i++) {
            $mailer->addAttachment($_FILES['attachments']["tmp_name"][$i], $_FILES['attachments']["name"][$i]); 
        }

    }

    $mailer->Body = $_POST['body'];

    // create the product
    if ($mailer->send()) {

        // set response code - 200 OK
        http_response_code(200);

        // tell the user
        echo json_encode(array("message" => "Email was sent."));
    }

    // if unable to create the product, tell the user
    else {

        // set response code - 503 service unavailable
        http_response_code(503);

        // tell the user
        echo json_encode(array("message" => "Unable to send email."));
    }
}

// tell the user data is incomplete
else {

    // set response code - 400 bad request
    http_response_code(400);

    // tell the user
    echo json_encode(array("message" => "Unable to send email. Data is incomplete."));
}