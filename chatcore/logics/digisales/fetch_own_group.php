<?php 

include_once($_SERVER['DOCUMENT_ROOT'] . '/chatcore/logics/chat_dbconn.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// $flag = $_GET['flag'];


    $dbconn = paliolite();


$fpin = $_GET['f_pin'];

function fetchGroup($parentID, $f_pin) {
    echo 'fetchGroup '.$parentID.'| ';
    $dbconn = paliolite();

    $str = "SELECT g.*
    FROM `GROUPS` g, MEMBERS m 
    WHERE m.GROUP_ID = g.GROUP_ID
    AND g.GROUP_ID = '$parentID'
    AND m.F_PIN = '$f_pin'";
    $query = $dbconn->prepare($str);
    $query->execute();
    $groups = $query->get_result();
    $query->close();
    
    $rows = array();
    while ($group = $groups->fetch_assoc()) {
        $rows[] = $group;
    };

    if (count($rows) > 0) {
        return true;
    } else {
        return false;
    }
    // if groups > 0 return true
    // else false
}

function selectFirst($f_pin) {
    echo 'selectFirst | ';
    $dbconn = paliolite();
    $str = "SELECT m.GROUP_ID
    FROM MEMBERS m
    WHERE m.F_PIN = '$f_pin' LIMIT 1";
    $query = $dbconn->prepare($str);
    $query->execute();
    $groups = $query->get_result()->fetch_assoc();
    $query->close();

    return $groups["GROUP_ID"];
}
    

function getRootGroup($f_pin) {
    $dbconn = paliolite();

    echo 'getRoot | ';
    
    $temp = selectFirst($f_pin);

    while(fetchGroup($temp, $f_pin)) {
        $str = "SELECT g.GROUP_ID
        FROM `GROUPS` g
        WHERE g.PARENT_ID = '$temp'";
        $query = $dbconn->prepare($str);
        $query->execute();
        $groups = $query->get_result()->fetch_assoc();
        $query->close();

        if ($groups["GROUP_ID"] != null && $groups["GROUP_ID"] != "") {
            $temp = $groups["GROUP_ID"];
        }
        
    }

    echo $temp;
}


getRootGroup($fpin);

// SELECT GROUP
// $str = "SELECT g.*,
// (
// SELECT COUNT(g1.GROUP_ID) FROM `GROUPS` g1 WHERE g1.PARENT_ID = g.GROUP_ID
// ) AS CHILD_AMT 
// FROM `GROUPS` g
// LEFT JOIN MEMBERS m ON m.GROUP_ID = g.GROUP_ID
// WHERE m.F_PIN = '$fpin'";
// $query = $dbconn->prepare($str);
// $query->execute();
// $groups = $query->get_result();
// $query->close();

// $rows = array();
// while ($group = $groups->fetch_assoc()) {
//     $rows[] = $group;
// };

// echo json_encode($rows);
