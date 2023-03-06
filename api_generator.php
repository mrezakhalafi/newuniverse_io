<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/db_conn.php');

$dbconn = getDBConn();
$i = 0;
$how_much = 1000;
while ($i < $how_much){
    $bytes = random_bytes(32);
    $hexbytes = strtoupper(bin2hex($bytes));

    //PAYMENT INSERT QUERY
    $query = $dbconn->prepare("INSERT INTO APIKEY (APIKEY) VALUES (?)");
    $query->bind_param("s", $hexbytes);
    $query->execute();
    $query->close();

    $i++;
    if($i == $how_much){
        echo $how_much . " api key inserted!";
    }
}

?>
