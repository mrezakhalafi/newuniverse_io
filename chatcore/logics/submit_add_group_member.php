<?php

// error_log(print_r("CallCenterPalio", TRUE)); 

include_once($_SERVER['DOCUMENT_ROOT'] . '/chatcore/logics/chat_dbconn.php');

    $from = $_POST['from'];
    $grpId = $_POST['group_id'];
    $m_pin = $_POST['member_pin'];

	try {

        $api_url = $webrest_palio;
        $api_data = array(
            'code' => 'ADDMMBR',
            'data' => array(
                'from' => $from,
                'group_name' => $grpName,
                'member_pin' => $m_pin
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
            throw new Exception('add group member failed!');
        } else {
            // error_log(print_r("CallCenterPalioSuccess", TRUE)); 
            echo '"' . $m_pin . '" added!';
        }

    } catch (Exception $e) {

        echo $e->getMessage();

    }

    

 ?>