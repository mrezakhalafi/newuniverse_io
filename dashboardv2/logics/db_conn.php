<?php

function test_db()
{
    $host = "localhost:3306";
    // $host = "202.158.33.26:3306";
    $user = "root";
    $password = "";
    $database = "palio_lite_qiosk";
    $dbconn = mysqli_connect($host, $user, $password, $database);

    if (mysqli_connect_errno()) {
        echo "Koneksi database gagal : " . mysqli_connect_errno();
    } else {
        $dbconn->autocommit(TRUE);
        return $dbconn;
    }
}

function dbConnPalioLite() {

    $host = "localhost:3306";
    // $host = "202.158.33.26:3306";
    $user = "root";
    $password = "";
    // $user = "nup";
    // $password = "5m1t0l_aptR";
    $database = "palio_lite_qiosk";
    $dbconn = mysqli_connect($host, $user, $password, $database);

    if (mysqli_connect_errno()) {
        echo "Koneksi database gagal : " . mysqli_connect_errno();
    } else {
        $dbconn->autocommit(TRUE);
        return $dbconn;
    }
}