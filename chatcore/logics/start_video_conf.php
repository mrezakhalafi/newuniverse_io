<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/chatcore/logics/chat_dbconn.php');

	// $complain_id = $_POST['cmp_id'];
    $from = $_POST['from'];
    $conf_data = $_POST['conference_data'];
    $conf_id = $_POST['conference_id'];

	try {

        $api_url = $webrest_palio;
        $api_data = array(
            'code' => 'CRTCONF',
            'data' => array(
                'from' => $from,
                'conference_data' => $conf_data,
                'conference_id' => $conf_id,
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
            throw new Exception('Start VCR failed!');
        }

    } catch (Exception $e) {

        echo $e->getMessage();

    }

    echo 'Success';

 ?>