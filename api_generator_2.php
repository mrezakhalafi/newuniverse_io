<?php

    include_once($_SERVER['DOCUMENT_ROOT'] . '/db_conn.php');

    function apiGen(){

        $dbconn = getDBConn();
        //check apikey availability
        do {
            $bytes = random_bytes(32);
            $hexbytes = strtoupper(bin2hex($bytes));

            $query = $dbconn->prepare("SELECT COUNT(*) as counter_api FROM APIKEY WHERE APIKEY = ?");
            $query->bind_param("s", $hexbytes);
            $query->execute();
            $counter = $query->get_result()->fetch_assoc();
            $counter_api = $counter['counter_api'];
            $query->close();
        } while ($counter_api > 0);

        //PAYMENT INSERT QUERY
        $query = $dbconn->prepare("INSERT INTO APIKEY (APIKEY) VALUES (?)");
        $query->bind_param("s", $hexbytes);
        $query->execute();
        $query->close();

    }
