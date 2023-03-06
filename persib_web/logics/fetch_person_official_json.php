<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/url_function.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/persib_web/logics/chat_dbconn.php');

$dbconn = paliolite();

if(isset($_REQUEST['f_pin'])){
    $f_pin = $_REQUEST['f_pin'];
}
if(!isset($filter) && isset($_REQUEST['filter'])){
    $filter = $_REQUEST['filter'];
}
if(!isset($filter)){
    $filter = '1';
}

$subquery = "";
if(isset($filter)){
    $filterArr = explode('-', $filter);
    foreach ($filterArr as $filterPoint) {
        if($filterPoint == "1"){
            $subquery = $subquery . " OR ue.OFFICIAL_ACCOUNT = 2";
        }
        else if($filterPoint == "2" && isset($f_pin)){
            $subquery = $subquery . " OR u.F_PIN in (SELECT f.L_PIN from FRIEND_LIST f where f.F_PIN = '" . $f_pin . "') OR u.F_PIN in (SELECT f.F_PIN from FRIEND_LIST f where f.L_PIN = '" . $f_pin . "')";
        }
        else if($filterPoint == "4" && isset($f_pin)){
            $subquery = $subquery . " OR TRUE)";
        }
    }
}

$query = $dbconn->prepare("SELECT u.F_PIN, CONCAT(u.FIRST_NAME, ' ', u.LAST_NAME) as NAME, u.IMAGE, ue.OFFICIAL_ACCOUNT, count(p.POST_ID) as POST_COUNT FROM USER_LIST u LEFT JOIN USER_LIST_EXTENDED ue ON u.F_PIN = ue.F_PIN LEFT JOIN POST p on u.F_PIN = p.F_PIN WHERE u.ROOT_BE = '48' AND (ue.OFFICIAL_ACCOUNT = 1 " . $subquery . " ) GROUP BY u.F_PIN ORDER by POST_COUNT desc, (case when ue.OFFICIAL_ACCOUNT = 0 then 100 else ue.OFFICIAL_ACCOUNT end) asc");
$query->execute();
$groups  = $query->get_result();
$query->close();

$rows = array();
while ($group = $groups->fetch_assoc()) {
    $rows[] = $group;
};

echo json_encode($rows);

// return $rows;
