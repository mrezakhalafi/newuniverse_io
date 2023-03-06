<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/chatcore/logics/chat_dbconn.php');

	$fpin = $_POST['f_pin'];
	$channel = $_POST['channel'];

	try {

        $api_url = $webrest_palio;
        $api_data = array(
            'code' => 'RQSTCC',
            'data' => array(
                'from' => $fpin,
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
        }

    } catch (Exception $e) {

        echo $e->getMessage();

    }

    echo json_encode($api_json_result);

 ?>