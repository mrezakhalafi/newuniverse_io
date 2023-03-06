<?php

//fetch_user.php
error_reporting(0);
include_once($_SERVER['DOCUMENT_ROOT'] . '/url_function.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/db_conn.php');

session_start();
$dbconn = getDBConn();

function fetch_user_last_activity($user_id)
{
    $dbconn = getDBConn();
    $query = $dbconn->prepare("SELECT * FROM LOGIN_DETAILS WHERE USER_ID = ? ORDER BY LAST_ACTIVITY DESC LIMIT 1");
    $query->bind_param('i', $user_id);
    $query->execute();
    $result = $query->get_result()->fetch_assoc();
    $query->close();

    return $result['LAST_ACTIVITY'];
}

$query = $dbconn->prepare("SELECT * FROM USER_ACCOUNT WHERE ID != ?");
$query->bind_param('i', $_SESSION['id_user']);
$query->execute();
$result = $query->get_result();
$query->close();

// $output = '<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">';

foreach($result as $row)
{
    $output .= '<a class="dropdown-item" id="chatUser-' . $row['ID'] . '" href="#" role="button" onclick="fetch_user_chat_history(' . $row['ID'] . ')">';
    $status = '';
    $current_timestamp = strtotime(date("Y-m-d H:i:s") . '- 10 second');
    $current_timestamp = date('Y-m-d H:i:s', $current_timestamp);
    $user_last_activity = fetch_user_last_activity($row['ID']);
    if ($user_last_activity > $current_timestamp) {
        $status = '<span class="label label-success">Online</span>';
    } else {
        $status = '<span class="label label-danger">Offline</span>';
    }

    $output .= $status . ' ' . $row['USERNAME'] . '</a>';

}

// $output .= '</div>';

echo $output;
