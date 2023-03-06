<?php

error_log(print_r("ACPTCLCC called", TRUE)); 

include_once($_SERVER['DOCUMENT_ROOT'] . '/chatcore/logics/chat_dbconn.php');

	$from = $_POST['from'];
	$to = $_POST['to'];
    $complain_id = $_POST['complaint_id'];
	$channel = $_POST['channel'];

	try {

        $api_url = $webrest_palio;
        $api_data = array(
            'code' => 'ACPTCLCC',
            'data' => array(
                'from' => $from,
                'to' => $to,
                'complaint_id' => $complain_id,
                'channel' => $channel,
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
            throw new Exception('Send message failed!');
        } else {
            error_log(print_r("ACPTCLCC success", TRUE)); 
        }

    } catch (Exception $e) {

        echo $e->getMessage();

    }

    echo json_encode($api_json_result);

 ?>