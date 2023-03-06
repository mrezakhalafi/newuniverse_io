<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/chatcore/logics/chat_dbconn.php');

	$fpin = $_GET['f_pin'];
	$customer = $_GET['customer_fpin'];
	$complain_id = $_GET['complain_id'];

	try {

        $api_url = $webrest_palio;
        $api_data = array(
            'code' => 'ENDCC',
            'data' => array(
                'from' => $fpin,
                'to' => $customer,
                'data' => $complain_id,
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

    echo 'Success';

 ?>