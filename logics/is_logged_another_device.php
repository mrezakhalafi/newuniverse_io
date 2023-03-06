<?php 

include_once($_SERVER['DOCUMENT_ROOT'].'/db_conn.php');
$dbconn = getDBConn();

$session_token_exist = $_POST['session_token_exist'];
$user_id = $_POST['user_id'];

$query= $dbconn->prepare("SELECT * FROM SESSION WHERE SESSION_TOKEN = ? AND USER_ID = ?");
$query->bind_param("si", $session_token_exist, $user_id);
$query->execute();
$session_exist = $query->get_result()->fetch_assoc();
$query->close();

if ($session_exist == NULL) {

    echo(1);

}else{

    echo(0);

}


?>