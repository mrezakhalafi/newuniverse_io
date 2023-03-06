<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/chatcore/logics/chat_dbconn.php');

	$from = $_POST['from']; // fpin yang update
    $msg_id = $_POST['message_id'];
    $f_pin = $_POST['f_pin'];
    $l_pin = $_POST['l_pin'];
    $scope = $_POST['scope'];
    $status = $_POST['status'];
    $time = $_POST['time'];
    $flag = $_POST['flag'];

    if($flag == 1){
        $dbconn = paliolite();
        // $api_url = "http://192.168.0.56:8104/webrest/";
        $api_url = $webrest_palio;
    } else {
        $dbconn = catchup();
        $api_url = $webrest_cu;
    }

	try {

        // $api_url = "http://192.168.0.56:8104/webrest/";
        $api_data = array(
            'code' => 'UPDMSG',
            'data' => array(
                'from' => $from,
                'message_id' => $msg_id,
                'f_pin' => $f_pin,
                'l_pin' => $l_pin,
                'scope' => $scope,
                'status' => $status,
                'time' => $time
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