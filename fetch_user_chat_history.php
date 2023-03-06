
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

    $output = '<ul class="list-unstyled">';
    foreach ($result as $row) {
        $user_name = '';
        if ($row["FROM_USER_ID"] == $from_user_id) {
            $user_name = '<b class="text-success">You</b>';
        } else {
            $user_name = '<b class="text-danger">' . get_user_name($row['FROM_USER_ID']) . '</b>';
        }
        if ($row["TYPE"] == 1) {
            $output .= '
            <li style="border-bottom:1px dotted #ccc">
            <p>' . $user_name . ' - <a href="uploadsFile/' . $row["CHAT_MESSAGE"] . '">' . $row["CHAT_MESSAGE"] . '</a>
                <div align="right">
                - <small><em>' . $row['TIMESTAMP'] . '</em></small>
                </div>
            </p>
            </li>
            ';
        } else {
            $output .= '
            <li style="border-bottom:1px dotted #ccc">
            <p>' . $user_name . ' - ' . $row["CHAT_MESSAGE"] . '
                <div align="right">
                - <small><em>' . $row['TIMESTAMP'] . '</em></small>
                </div>
            </p>
            </li>
            ';
        }
    }
    $output .= '</ul>';
    return $output;
}

echo fetch_user_chat_history($_SESSION['user_id'], $_POST['to_user_id']);

?>