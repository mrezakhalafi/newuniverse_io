<?php


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
// $response = '{
// 	"status": 0,
// 	"message": "Purchase success. UNIPIN100-xxxxx . Price: Rp.1314",
// 	"trx_id": 12126,
// 	"partner_trxid": "as2111213",
// 	"serial_number": "UPGC-4-S-010xxxx|7255-1644-xxxx-xxx",
// 	"data": {
// 		"customer_number": "1231d1f1g123",
// 		"serial_number": "UPGC-4-S-01020xxxx|7255-1644-9239-xxxxx",
// 		"price": 1231231,
// 		"product": "UNIPINxxxx"
// 	}
// }
// ';

function paliolite()
{
    $host = "localhost:3306";
    $user = "root";
    $password = "";
    // $host = "127.0.0.1:3306";
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

$dbconn = paliolite();

// $query = $dbconn->prepare("SELECT * FROM ADMIN_PROVINCE WHERE F_PIN = 'sdads'");
// $query->execute();
// $status = $query->get_result()->fetch_assoc();
// $query->close();

var_dump($_SESSION);

?>