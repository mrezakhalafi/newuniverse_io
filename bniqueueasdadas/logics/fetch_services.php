<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function getDBConn()
{
    // $host = "localhost:3306";
    // $user = "root";
    // $password = "";
    $database = "palio_lite_qiosk";
    // $host = "192.168.0.34:3306";
    $host = "202.158.33.27:3306";
    $user = "nup";
    $password = "5m1t0l_aptR";
    // $database = "palio_lite_qiosk";
    $dbconn = mysqli_connect($host, $user, $password, $database);

    if (mysqli_connect_errno()) {
        echo "Koneksi database gagal : " . mysqli_connect_errno();
    } else {
        $dbconn->autocommit(TRUE);
        return $dbconn;
    }
}

$dbconn = getDBConn();

$query = "SELECT * FROM SERVICE_BNI";

$query = $dbconn->prepare($query);
$query->execute();
$groups = $query->get_result();
$query->close();

$rows = array();
while ($group = $groups->fetch_assoc()) {
    $rows[] = $group;
};

echo json_encode($rows);

?>