<?php

error_log(print_r("CallCenterPalio", TRUE)); 

include_once($_SERVER['DOCUMENT_ROOT'] . '/chatcore/logics/chat_dbconn.php');

	$complain_id = $_POST['complaint_id'];
    $from = $_POST['from'];
    $to = $_POST['to'];
    $channel = $_POST['channel'];

	try {

        $api_url = $webrest_palio;
        $api_data = array(
            'code' => 'CALLCC',
            'data' => array(
                'complaint_id' => $complain_id,
                'from' => $from,
                'to' => $to,
                'channel' => $channel
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
    
        if (http_response_code() != 200) {
            throw new Exception('cancel notif failed!');
        } else {
            error_log(print_r("CallCenterPalioSuccess", TRUE)); 
        }

    } catch (Exception $e) {

        echo $e->getMessage();

    }

    echo 'Success';

 ?>