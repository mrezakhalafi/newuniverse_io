<?php

function paliolite()
{
    $host = "192.168.0.35:3306";
    // $host = "202.158.33.26:3306";
    $user = "nup";
    $password = "5m1t0l_aptR";
    $database = "palio_lite";
    $dbconn = mysqli_connect($host, $user, $password, $database);

    if (mysqli_connect_errno()) {
        echo "Koneksi database gagal : " . mysqli_connect_errno();
    } else {
        $dbconn->autocommit(TRUE);
        return $dbconn;
    }
}

function paliobrowser()
{
    $host = "192.168.0.35:3306";
    // $host = "202.158.33.26:3306";
    $user = "nup";
    $password = "5m1t0l_aptR";
    $database = "palio_browser";
    $dbconn = mysqli_connect($host, $user, $password, $database);

    if (mysqli_connect_errno()) {
        echo "Koneksi database gagal : " . mysqli_connect_errno();
    } else {
        $dbconn->autocommit(TRUE);
        return $dbconn;
    }
}

?>