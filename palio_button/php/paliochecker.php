<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/db_conn.php');

$dbconn = getDBConn();

// get registered url
$param = "%{$_GET['domain']}%";
$query = $dbconn->prepare("SELECT COUNT(*) AS NUM_ROWS FROM WEBFORM WHERE WEB_URL LIKE ?");
$query->bind_param("s", $param);
$query->execute();
$result = $query->get_result()->fetch_assoc();
if ($result['NUM_ROWS'] == 0) {
    echo "not registered";
} else {
    echo "registered";
}
$query->close();

// check if domain registered
// if (strpos(file_get_contents("domains.txt"), $_GET['domain']) !== false) {
//     // do stuff
//     echo "registered";
// } else {
//     echo "not registered";
// }

?>