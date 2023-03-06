<?php

function startTraining() {

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://103.94.169.26:8349/train',
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST'
    ));

    $result = curl_exec($curl);
    curl_close($curl);

    echo $result;
}


startTraining();