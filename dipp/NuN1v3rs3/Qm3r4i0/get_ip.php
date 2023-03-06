<?php

function getDBConn()
{
    $host = "192.168.1.101:3306";
    $user = "nup";
    $password = "5m1t0l_aptR";
    $database = "new_nus_qiosk";
    $dbconn = mysqli_connect($host, $user, $password, $database);

    if (mysqli_connect_errno()) {
        echo "Koneksi database gagal : " . mysqli_connect_errno();
    } else {
        $dbconn->autocommit(TRUE);
        return $dbconn;
    }
}

$dbconn = getDBConn();
$account = $_GET['account'];
$default = "<html><head><title>Qmera</title></head><body>MzMuMTU4LjI2LjIwMjo0MjgyMzo0MjMyOA==</body></html>";

// get company id
$query = $dbconn->prepare("SELECT * FROM COMPANY WHERE API_KEY = ?");
$query->bind_param("s", $account);
$query->execute();
$company = $query->get_result()->fetch_assoc();
$company_id = $company['ID'];
$query->close();

// get ip and port
$query = $dbconn->prepare("SELECT * FROM SERVER_ADDRESS WHERE COMPANY = ?");
$query->bind_param("s", $company_id);
$query->execute();
$server = $query->get_result();
$query->close();

$ip_array = [];

// loop through sequences
foreach ($server as $s) {

        $sequence = $s['SEQUENCE'];
        $ip_address = $s['IP_ADDRESS'];
        // turn ip into array
        $ip_address = explode(".",$ip_address);
        $port_android = $s['PORT_ANDROID'];
        $port_IOS = $s['PORT_IOS'];

        // reorder ip, concat with ports
        // A  .B  .C .D  :port   C  .B  .D .A  :port
        $combined = $ip_address[2] . "." . $ip_address[1] . "." . $ip_address[3] . "." . $ip_address[0] . ":" . $port_android . ":" . $port_IOS;

        $ip_array[$sequence] = $combined;
}

$combined_decrypted = base64_encode(implode(",", $ip_array));

$template = "<html><head><title>Qmera</title></head><body>" . $combined_decrypted . "</body></html>";

if($server->num_rows > 0){
        echo $template;
} else {
        echo $default;
}

