<?php

function catchup()
{
    $host = "localhost:3306";
    $user = "root";
    $password = "";
    // $host = "127.0.0.1:3306";
    // $user = "nup";
    // $password = "5m1t0l_aptR";

    // $host = "192.168.0.34:3306";
    // $host = "202.158.33.26:3306";
    // $user = "nup";
    // $password = "5m1t0l_aptR";
    $database = "palio_lite_qiosk";

    // $database = "catchup";
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
    $host = "localhost:3306";
    $user = "root";
    $password = "";
    // $host = "127.0.0.1:3306";
    // $user = "nup";
    // $password = "5m1t0l_aptR";

    // $host = "192.168.0.34:3306";
    // $host = "202.158.33.26:3306";
    // $user = "nup";
    // $password = "5m1t0l_aptR";
    $database = "new_nus";

    // $database = "new_nus";
    $dbconn = mysqli_connect($host, $user, $password, $database);

    if (mysqli_connect_errno()) {
        echo "Koneksi database gagal : " . mysqli_connect_errno();
    } else {
        $dbconn->autocommit(TRUE);
        return $dbconn;
    }
}

function newnusgaspol()
{
    // $host = "localhost:3306";
    // $user = "root";
    // $password = "";
    // $host = "127.0.0.1:3306";
    // $user = "nup";
    // $password = "5m1t0l_aptR";

    $host = "192.168.0.34:3306";
    // $host = "202.158.33.26:3306";
    $user = "nup";
    $password = "5m1t0l_aptR";
    $database = "palio_lite_qiosk";

    // $database = "new_nus";
    $dbconn = mysqli_connect($host, $user, $password, $database);

    if (mysqli_connect_errno()) {
        echo "Koneksi database gagal : " . mysqli_connect_errno();
    } else {
        $dbconn->autocommit(TRUE);
        return $dbconn;
    }
}

function paliolite()
{
    // $host = "localhost:3306";
    // $user = "root";
    // $password = "";
    // $host = "127.0.0.1:3306";
    // $user = "nup";
    // $password = "5m1t0l_aptR";

    // $host = "192.168.0.34:3306";
    $host = "202.158.33.27:3306";
    $user = "nup";
    $password = "5m1t0l_aptR";
    $database = "palio_lite_qiosk";

    // $database = "palio_lite_qiosk";
    $dbconn = mysqli_connect($host, $user, $password, $database);

    if (mysqli_connect_errno()) {
        echo "Koneksi database gagal : " . mysqli_connect_errno();
    } else {
        $dbconn->autocommit(TRUE);
        return $dbconn;
    }
}

$webrest_palio = "http://192.168.1.100:8004/webrest/";
$webrest_cu = "http://127.0.0.1:8104/webrest/";
