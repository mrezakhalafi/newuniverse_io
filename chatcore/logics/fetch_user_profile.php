<?php 

include_once($_SERVER['DOCUMENT_ROOT'] . '/chatcore/logics/chat_dbconn.php');

$flag = $_GET['flag'];

if($flag == 1){
    $dbconn = paliolite();
} else {
    $dbconn = catchup();
}

$fpin = $_GET['f_pin'];

// SELECT USER PROFILE
$query = $dbconn->prepare("SELECT ul.*, ule.USER_TYPE 
FROM USER_LIST ul
LEFT JOIN USER_LIST_EXTENDED ule ON ul.F_PIN = ule.F_PIN
WHERE ul.F_PIN = ?");
$query->bind_param("s", $fpin);
$query->execute();
$dataUser = $query->get_result()->fetch_assoc();
$query->close();

echo json_encode($dataUser);
