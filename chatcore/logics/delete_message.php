<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/chatcore/logics/chat_dbconn.php');

    $msgId = $_POST['message_id'];
	$from = $_POST['from']; // fpin yang update
    $to = $_POST['to']; // fpin yang
    $chat_id = $_POST['chat_id'];
    $scope = $_POST['scope'];
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
            'code' => 'DELMSG',
            'data' => array(
                'message_id' => $msgId,
                'from' => $from,
                'to' => $to,
                'chat_id' => $chat_id,
                'scope' => $scope
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
            throw new Exception('Delete conversation failed!');
        }

    } catch (Exception $e) {

        echo $e->getMessage();

    }

    echo json_encode($api_json_result);

 ?>