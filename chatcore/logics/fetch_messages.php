<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/chatcore/logics/chat_dbconn.php');

$flag = $_GET['flag'];
$fpin = $_GET['f_pin'];

if ($flag == 1) {
    $dbconn = paliolite();
    // SELECT USER PROFILE
    $query = $dbconn->prepare("(SELECT msg.*, msts.L_PIN, msts.STATUS
    FROM MESSAGE_WEB msg
    LEFT JOIN MESSAGE_STATUS_WEB msts ON msts.MESSAGE = msg.MESSAGE_ID
    LEFT JOIN `GROUPS` gr ON msg.DESTINATION = gr.GROUP_ID 
    LEFT JOIN MEMBERS mbr ON mbr.GROUP_ID = gr.GROUP_ID WHERE msg.DESTINATION = gr.GROUP_ID 
    AND mbr.F_PIN = ? AND msg.SENT_TIME > FLOOR(UNIX_TIMESTAMP(mbr.CREATED_DATE)*1000))
    UNION (
    SELECT msg.*, msts.L_PIN, msts.STATUS
    FROM MESSAGE_WEB msg
    LEFT JOIN MESSAGE_STATUS_WEB msts ON msts.MESSAGE = msg.MESSAGE_ID
    LEFT JOIN DISCUSSION_FORUM df ON df.CHAT_ID = msg.DESTINATION
    LEFT JOIN `GROUPS` gr ON df.GROUP_ID = gr.GROUP_ID 
    LEFT JOIN MEMBERS mbr ON mbr.GROUP_ID = gr.GROUP_ID WHERE msg.DESTINATION = df.CHAT_ID
    AND mbr.F_PIN = ? AND msg.SENT_TIME > FLOOR(UNIX_TIMESTAMP(mbr.CREATED_DATE)*1000)
    ) UNION (
    SELECT msg.*, msts.L_PIN, msts.STATUS
    FROM MESSAGE_WEB msg
    LEFT JOIN MESSAGE_STATUS_WEB msts ON msts.MESSAGE = msg.MESSAGE_ID
    LEFT JOIN FRIEND_LIST fl ON msg.DESTINATION = fl.L_PIN WHERE fl.F_PIN = ?  AND msg.ORIGINATOR = ?
    ) UNION (
    SELECT msg.*, msts.L_PIN, msts.STATUS
    FROM MESSAGE_WEB msg
    LEFT JOIN MESSAGE_STATUS_WEB msts ON msts.MESSAGE = msg.MESSAGE_ID
    LEFT JOIN FRIEND_LIST fl ON msg.ORIGINATOR = fl.L_PIN WHERE fl.F_PIN = ?  AND msg.DESTINATION = ?
    )");
    $query->bind_param("ssssss", $fpin, $fpin, $fpin, $fpin, $fpin, $fpin);
    $query->execute();
    $messages = $query->get_result();
    $query->close();
} else {
    $dbconn = catchup();
    $param = '%"' . $fpin . '"%';
    $query = $dbconn->prepare("(SELECT msg.*, msts.L_PIN, msts.STATUS
    FROM MESSAGE msg
    LEFT JOIN MESSAGE_STATUS msts ON msts.MESSAGE = msg.MESSAGE_ID
    LEFT JOIN `GROUPS` gr ON msg.DESTINATION = gr.GROUP_ID 
    LEFT JOIN MEMBERS mbr ON mbr.GROUP_ID = gr.GROUP_ID WHERE msg.DESTINATION = gr.GROUP_ID 
    AND mbr.F_PIN = ? AND msg.SENT_TIME > FLOOR(UNIX_TIMESTAMP(mbr.CREATED_DATE)*1000))
    UNION (
    SELECT msg.*, msts.L_PIN, msts.STATUS
    FROM MESSAGE msg
    LEFT JOIN MESSAGE_STATUS msts ON msts.MESSAGE = msg.MESSAGE_ID
    LEFT JOIN DISCUSSION_FORUM df ON df.CHAT_ID = msg.DESTINATION
    LEFT JOIN `GROUPS` gr ON df.GROUP_ID = gr.GROUP_ID 
    LEFT JOIN MEMBERS mbr ON mbr.GROUP_ID = gr.GROUP_ID WHERE msg.DESTINATION = df.CHAT_ID
    AND mbr.F_PIN = ? AND msg.SENT_TIME > FLOOR(UNIX_TIMESTAMP(mbr.CREATED_DATE)*1000)
    ) UNION (
    SELECT msg.*, msts.L_PIN, msts.STATUS
    FROM MESSAGE msg
    LEFT JOIN MESSAGE_STATUS msts ON msts.MESSAGE = msg.MESSAGE_ID
    LEFT JOIN FRIEND_LIST fl ON msg.DESTINATION = fl.L_PIN WHERE fl.F_PIN = ?  AND msg.ORIGINATOR = ?
    ) UNION (
    SELECT msg.*, msts.L_PIN, msts.STATUS
    FROM MESSAGE msg
    LEFT JOIN MESSAGE_STATUS msts ON msts.MESSAGE = msg.MESSAGE_ID
    LEFT JOIN FRIEND_LIST fl ON msg.ORIGINATOR = fl.L_PIN WHERE fl.F_PIN = ?  AND msg.DESTINATION = ?
    )
UNION
(
SELECT msg.*, msts.L_PIN, msts.STATUS
FROM MESSAGE msg
LEFT JOIN MESSAGE_STATUS msts ON msts.MESSAGE = msg.MESSAGE_ID
WHERE CONTENT LIKE ?
)");
    $query->bind_param("sssssss", $fpin, $fpin, $fpin, $fpin, $fpin, $fpin, $param);
    $query->execute();
    $messages = $query->get_result();
    $query->close();
}






$rows = array();
while ($message = $messages->fetch_assoc()) {
    // remove symbols
    $message['CONTENT'] = preg_replace('/[^A-Za-z0-9\s~`\'\"*!@#$%^&()|_={}[\]:;,.<>+\/?-]/u', '', $message['CONTENT']);

    $rows[] = $message;
};

echo json_encode($rows);
