<?php 

include_once($_SERVER['DOCUMENT_ROOT'] . '/chatcore/logics/chat_dbconn.php');

$flag = $_POST['flag'];

if($flag == 1){
    $dbconn = paliolite();
    $api_url = "http://202.158.33.26:8004/webrest/";
} else {
    $dbconn = catchup();
    $api_url = "http://127.0.0.1:8104/webrest/";
}

// get message data
$message_id = $_POST['message_id'];
$originator = $_POST['originator'];
$destination = $_POST['destination'];
$content = $_POST['content'];
$sent_time = $_POST['sent_time'];
$scope = $_POST['scope'];
$chat_id = $_POST['chat_id']; // if custom topic

$is_complain = $_POST['is_complain'];
$call_center_id = $_POST['call_center_id'];

$reply_to = $_POST['reply_to'];

try {

    $api_data = array(
        'code' => 'SNDMSG',
        'data' => array(
            'message_id' => $message_id,
            'from' => $originator,
            'to' => $destination,
            'message_text' => $content,
            'scope' => $scope,
            'chat_id' => $chat_id,
            'is_complaint' => $is_complain,
            'call_center_id' => $call_center_id,
            'reply_to' => $reply_to
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

    echo("<script>console.log(" . $e . ");</script>");

}

echo 'Success';
