<?php

    // $AccessToken = "8b483dba-eb2c-41d0-8e64-8e4be9a256d0";
    // $TransactionID = "ddb88107-8bd5-4f11-98f5-7469f7b3699f";
    // $FullAmount = "1000000";
    // $PaymentID = "0EB75AFCE6C8446EE0540021281A5568";

    $data = "1e01f631-2fe3-4664-9a79-34bbaac75537134723563A946C7D1AF342323E05400144FF98E94";


    // $data = $AccessToken.$TransactionID.$FullAmount.$PaymentID;
    $hash = hash('sha256', $data);
    echo $hash;
?>

