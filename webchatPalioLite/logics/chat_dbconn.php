<?php

function paliolite()
{
    $host = "192.168.0.35:3306";
    $user = "nup";
    $password = "5m1t0l_aptR";
    $database = "catchup";
    $dbconn = mysqli_connect($host, $user, $password, $database);

    if (mysqli_connect_errno()) {
        echo "Koneksi database gagal : " . mysqli_connect_errno();
    } else {
        $dbconn->autocommit(TRUE);
        return $dbconn;
    }
}

function newnus()
{
    $host = "192.168.0.35:3306";
    $user = "nup";
    $password = "5m1t0l_aptR";
    $database = "new_nus";
    $dbconn = mysqli_connect($host, $user, $password, $database);

    if (mysqli_connect_errno()) {
        echo "Koneksi database gagal : " . mysqli_connect_errno();
    } else {
        $dbconn->autocommit(TRUE);
        return $dbconn;
    }
}

?>