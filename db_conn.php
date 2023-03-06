<?php
function getDBConn()
{
    // $host = "192.168.0.34:3306";
    // $user = "nup";
    // $password = "5m1t0l_aptR";
    $host = "localhost:3306";
    $user = "root";
    $password = "";
    $database = "new_nus";
    $dbconn = mysqli_connect($host, $user, $password, $database);

    if (mysqli_connect_errno()) {
        echo "Koneksi database gagal : " . mysqli_connect_errno();
    } else {
        $dbconn->autocommit(TRUE);
        return $dbconn;
    }
}

function dbConnPalioLite() {
    
    // $host = "192.168.0.34:3306";
    // $user = "nup";
    // $password = "5m1t0l_aptR";
    $host = "localhost:3306";
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

// function getDBConnCore()
// {
//     $host2 = "10.128.0.9";
//     $user2 = "palio";
//     $password2 = "5u!h$abZxe5Q1+d8";
//     $database2 = "palio_lite";
//     //$host2 = "192.168.0.35:3306";
//     //$user2 = "nus";
//     //$password2 = "Rn1u2sE";
//     //$database2 = "lumia";
//     $dbconn2 = mysqli_connect($host2, $user2, $password2, $database2);

//     if (mysqli_connect_errno()) {
//         echo "Koneksi database gagal : " . mysqli_connect_errno();
//     } else {
//         $dbconn2->autocommit(TRUE);
//         return $dbconn2;
//     }
// }
	
// function getDBConnCore()
// {
//     $host2 = "202.158.33.26:3306";
//     $user2 = "nup";
//     $password2 = "5m1t0l_aptR";
//     $database2 = "lumia";
// 	//$host2 = "192.168.0.35:3306";
//     //$user2 = "nus";
//     //$password2 = "Rn1u2sE";
//     //$database2 = "lumia";
//     $dbconn2 = mysqli_connect($host2, $user2, $password2, $database2);

//     if (mysqli_connect_errno()) {
//         echo "Koneksi database gagal : " . mysqli_connect_errno();
//     } else {
//         $dbconn2->autocommit(TRUE);
//         return $dbconn2;
//     }
// }

// function getDBConnIB()
// {
//     $host3 = "202.158.33.26:3306";
//     $user3 = "nup";
//     $password3 = "5m1t0l_aptR";
//     $database3 = "tib_01";
//     $dbconn3 = mysqli_connect($host3, $user3, $password3, $database3);

//     if (mysqli_connect_errno()) {
//         echo "Koneksi database gagal : " . mysqli_connect_errno();
//     } else {
//         $dbconn3->autocommit(TRUE);
//         return $dbconn3;
//     }
// }

?>
