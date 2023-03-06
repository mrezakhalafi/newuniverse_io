
<?php

//fetch_user_chat_history.php

include_once($_SERVER['DOCUMENT_ROOT'] . '/url_function.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/db_conn.php');

session_start();
$dbconn = getDBConn();

function get_user_name($user_id)
{
    $dbconn = getDBConn();
    $query = $dbconn->prepare("SELECT USERNAME FROM USER_ACCOUNT WHERE ID = ?");
    $query->bind_param("i", $user_id);
    $query->execute();
    $result = $query->get_result()->fetch_assoc();
    $query->close();

    return $result['USERNAME'];
}

function fetch_user_chat_history($from_user_id, $to_user_id)
{
    $dbconn = getDBConn();
    $query = $dbconn->prepare("SELECT * FROM CHAT_MESSAGE WHERE (FROM_USER_ID = ? AND TO_USER_ID = ?) OR (FROM_USER_ID = ? AND TO_USER_ID = ?) ORDER BY TIMESTAMP DESC");
    $query->bind_param("iiii", $from_user_id, $to_user_id, $to_user_id, $from_user_id);
    $query->execute();
    $result = $query->get_result();
    $query->close();

    $output = '';
    foreach ($result as $row) {
        if ($row["TYPE"] == 1) {
            $chat_msg = '<a href="uploadsFile/' . $row["CHAT_MESSAGE"] . '">' . $row["CHAT_MESSAGE"] . '</a>';
        } else {
            $chat_msg = $row["CHAT_MESSAGE"];
        }
        if ($row["FROM_USER_ID"] == $from_user_id) {
            $output .= '<li style="width:100%"> 
                <div>
                <div class="text text-l" style="float: right; margin: 10px; max-width: 240px; min-width: 32px; text-align: right; padding: 4px 10px; background-color: #f2ad33; color: #fff; border-radius: 7px;">
                <p style="margin-bottom: 0px;">' . $chat_msg . '</p>
                </div>
                <div class="text text-l" style="float: right; margin: 10px;">
                <small><p>' . $row['TIMESTAMP'] . '</p></small>
                </div>
                </div>
                </li><br style="clear: both;">';
        } else {
            $output .= '<li style="width:100%">
            <div>
            <div class="text text-l" style="float: left; margin: 10px; max-width: 240px; min-width: 32px; text-align: left; padding: 4px 10px; background-color: #01686d; color: #fff; border-radius: 7px;">
            <p style="margin-bottom: 0px;">' . $chat_msg . '</p>
            </div>
            <div class="text text-l" style="float: left; margin: 10px;">
            <small><p>' . $row['TIMESTAMP'] . '</p></small>
            </div>
            </div>
            </li><br style="clear: both;">';
        }
    }
    return $output;
}

echo fetch_user_chat_history($_SESSION['id_user'], $_POST['to_user_id']);

?>