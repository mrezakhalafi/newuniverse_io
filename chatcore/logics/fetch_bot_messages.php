<?php 

include_once($_SERVER['DOCUMENT_ROOT'] . '/chatcore/logics/chat_dbconn.php');

$flag = $_GET['flag'];

if($flag == 1){
    $dbconn = paliolite();
} else {
    $dbconn = catchup();
}

$fpin = $_GET['f_pin'];
$bot = "-999";

$init = '%"by":"' . $fpin . '"%';

// SELECT USER PROFILE
$query = $dbconn->prepare("(SELECT * FROM MESSAGE_WEB msweb, MESSAGE_STATUS_WEB mstatus
WHERE msweb.ORIGINATOR = ? AND msweb.DESTINATION = ?
AND msweb.MESSAGE_ID = mstatus.MESSAGE)
UNION
(SELECT * FROM MESSAGE_WEB msweb, MESSAGE_STATUS_WEB mstatus
WHERE msweb.ORIGINATOR = ? AND msweb.CONTENT LIKE ?
AND msweb.MESSAGE_ID = mstatus.MESSAGE)");
$query->bind_param("ssss", $bot, $fpin, $bot, $init);
$query->execute();
$messages = $query->get_result();
$query->close();

$rows = array();
while ($message = $messages->fetch_assoc()) {
    // remove symbols
    $message['CONTENT'] = preg_replace('/[^A-Za-z0-9\s~`*!@#$%^&()_={}[\]:;,.<>+\/?-]/u', '', $message['CONTENT']);
    
    $rows[] = $message;
};

echo json_encode($rows);


// (SELECT * FROM MESSAGE_WEB msweb, MESSAGE_STATUS_WEB mstatus
// WHERE msweb.ORIGINATOR = ? AND msweb.DESTINATION = ?
// AND msweb.MESSAGE_ID = mstatus.MESSAGE)
// UNION
// (SELECT * FROM MESSAGE_WEB msweb, MESSAGE_STATUS_WEB mstatus
// WHERE msweb.ORIGINATOR = ? AND msweb.CONTENT LIKE ?
// AND msweb.MESSAGE_ID = mstatus.MESSAGE)