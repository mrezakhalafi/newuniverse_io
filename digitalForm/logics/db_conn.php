<?php

function test_db()
{
    $host = "localhost";
    // $host = "202.158.33.26:3306";
    $user = "root";
    $password = "";
    $database = "the_db";
    $dbconn = mysqli_connect($host, $user, $password, $database);

    if (mysqli_connect_errno()) {
        echo "Koneksi database gagal : " . mysqli_connect_errno();
    } else {
        $dbconn->autocommit(TRUE);
        return $dbconn;
    }
}