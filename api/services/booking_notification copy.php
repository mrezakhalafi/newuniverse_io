<?php

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

class Notification {

    public $To;
    public $Branch;
    public $Booking;
    public $Service;
    public $Date;

    private const WEBREST = "http://192.168.1.100:8004/webrest/";
    private const API_CODE = "BNIBN";

    function sendNotif() {
    
        try {
    
            $api_url = self::WEBREST;
            $api_data = array(
                'code' => self::API_CODE,
                'data' => array(
                    'to' => $this->To,
                    'branch' => $this->Branch,
                    'booking' => $this->Booking,
                    'service' => $this->Service,
                    'date' => $this->Date,
                    'api' => ""
                ),
            );
    
            $api_options = array(
                'http' => array(
                    'header'  => "Content-type: application/json\r\n",
                    'method'  => 'POST',
                    'content' => strval(json_encode($api_data))
                )
            );
    
            $api_stream = stream_context_create($api_options);
            $api_result = file_get_contents($api_url, false, $api_stream);
            $api_json_result = json_decode($api_result);
    
            return true;
        } catch (Exception $e) {
    
            return false;
        }

        // return true;
    
    }

}


// START HANDLE DATA
$raw = json_decode(file_get_contents('php://input'));

if (isset($raw) && !empty($raw)) {

    $data = $raw->data;

    $To = $data->to;
    $Branch = $data->branch;
    $Booking = $data->booking;
    $Service = $data->service;
    // $Date = $data->date;

    $temp_date = $data->date;
    $millisDate = intval($temp_date) * 1000; // strtotime in seconds, * 1000 to get millisecond
    $Date = strval($millisDate);

    $to_valid = ($To !== null) && ($To !== '') && (strlen($To) <= 16);
    $branch_valid = ($Branch !== null) && ($Branch !== '') && (strlen($Branch) <= 1024);
    $bcode_valid = ($Booking !== null) && ($Booking !== '') && (strlen($Booking) <= 32);
    $service_valid = ($Service !== null) && ($Service !== '') && (strlen($Service) <= 1024);

    if ($to_valid && $branch_valid && $bcode_valid && $service_valid && $Date !== null) {

        $notification = new Notification();

        $notification->To = $To;
        $notification->Branch = $Branch;
        $notification->Booking = $Booking;
        $notification->Service = $Service;
        $notification->Date = $Date;

        if ($notification->sendNotif()) {

            // print_r($notification);

            // 200 OK
            http_response_code(200);

            // tell the user
            echo json_encode(array("message" => "Notification sent."));

        } else {

            http_response_code(503);

            // tell the user
            echo json_encode(array("message" => "Unable to send broadcast."));

        }

    } else {

        // set response code - 400 bad request
        http_response_code(400);

        // tell the user
        echo json_encode(array("message" => "Unable to send notification. Data is incomplete or invalid."));

    }
} else {
    // set response code - 400 bad request
    http_response_code(400);

    // tell the user
    echo json_encode(array("message" => "Unable to send notification. Data is incomplete."));
}

?>