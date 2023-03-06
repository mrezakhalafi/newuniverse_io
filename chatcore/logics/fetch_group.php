<?php 

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

include_once($_SERVER['DOCUMENT_ROOT'] . '/chatcore/logics/chat_dbconn.php');

$flag = $_GET['flag'];

if($flag == 1){
    $dbconn = paliolite();
} else {
    $dbconn = catchup();
}

$fpin = $_GET['f_pin'];

// OLD QUERY

// $query = $dbconn->prepare("SELECT g.* FROM `GROUPS` g, MEMBERS m WHERE m.F_PIN = ? AND m.GROUP_ID = g.GROUP_ID");
// $query->bind_param("s", $fpin);
// $query->execute();
// $groups = $query->get_result();
// $query->close();

// QUERY 14 RENEW

$query = $dbconn->prepare("SELECT min(level) AS MIN_LEVEL
                        FROM MEMBERS m 
                        INNER JOIN `GROUPS` g 
                        ON m.group_id = g.group_id 
                        AND 
                        m.f_pin = '$fpin' 
                        AND 
                        g.created_by = '0249dba0c7'");
$query->execute();
$getLevel = $query->get_result()->fetch_assoc();
$query->close();

$level = $getLevel["MIN_LEVEL"];

if ($level < 8){
    $level = 8;
}elseif($level == 8){
    $level = 10;
}

$query = $dbconn->prepare("WITH RECURSIVE org AS 
                            (SELECT gr.GROUP_ID, gr.GROUP_NAME, gr.PARENT_ID, gr.LEVEL, gr.QUOTE, gr.LAST_UPDATE, gr.IS_OPEN, gr.IS_ORGANIZATION, gr.CREATED_BY 
                            FROM `GROUPS` gr, MEMBERS m
                            WHERE m.f_pin = '$fpin' 
                            AND m.group_id = gr.group_id 
                            AND gr.LEVEL < $level
                            UNION
                            SELECT c.GROUP_ID, c.GROUP_NAME, c.PARENT_ID , c.LEVEL, c.QUOTE, c.LAST_UPDATE, c.IS_OPEN, c.IS_ORGANIZATION, c.CREATED_BY  
                            FROM `GROUPS` c
                            INNER JOIN org 
                            ON org.GROUP_ID = c.GROUP_ID 
                            WHERE c.LEVEL < $level)
                            SELECT GROUP_ID, LEVEL, PARENT_ID, GROUP_NAME, QUOTE, LAST_UPDATE, IS_OPEN, IS_ORGANIZATION, CREATED_BY
                            FROM org 
                            ORDER BY LEVEL, PARENT_ID, GROUP_NAME");
$query->execute();
$groups = $query->get_result();
$query->close();

$rows = array();
while ($group = $groups->fetch_assoc()) {
    $rows[] = $group;
};

echo json_encode($rows);
