<?php

$id = $_GET['id'];

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.xendit.co/ewallets/charges/" . $id,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_POSTFIELDS => "{\n\t\"charge_id\": \"" .$id. "\"\n}",
    CURLOPT_HTTPHEADER => array(
        "authorization: Basic eG5kX3Byb2R1Y3Rpb25feXBwVkFkM1R3UTJNNFdVQW9lWWZKYkNORjhVZFpwUVlQYjZRTnVlSkw5VnVtM3RDMktJN2Jma1pjaXpaZ256Og==",
        "cache-control: no-cache",
        "content-type: application/json"
    ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    echo $response;
}
