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

function checkFileExists($url)
{
    $ext = pathinfo($url, PATHINFO_EXTENSION);

    if ($ext) {
        $handle = fopen($url, 'r');

        if ($handle) {
            return 1;
        } else {
            return 0;
        }
    } else {
        return 0;
    }
}

$dbconn = paliolite();

// $remoteFile = 'https://media.discordapp.net/stickers/862085213965385768.webp';

// // echo checkFileExists($remoteFile);

// $hex = bin2hex(strval(time()));
// // echo $hex;

// // $milliseconds = floor(microtime(true) * 1000);

// // echo $milliseconds;

// function file_get_contents_ssl($url) {
//     $ch = curl_init();
//     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
//     curl_setopt($ch, CURLOPT_HEADER, false);
//     curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
//     curl_setopt($ch, CURLOPT_URL, $url);
//     curl_setopt($ch, CURLOPT_REFERER, $url);
//     curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
//     curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3000); // 3 sec.
//     curl_setopt($ch, CURLOPT_TIMEOUT, 10000); // 10 sec.
//     $result = curl_exec($ch);
//     curl_close($ch);
//     return $result;
// }

// $haha = file_get_contents_ssl('https://file-examples.com/wp-content/uploads/2017/02/file-sample_100kB.docx');

echo "NEWUNIV";
var_dump($_SESSION);

?>