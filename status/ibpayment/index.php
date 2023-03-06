<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/db_conn.php'); ?>

<?php
    $entityBody = file_get_contents('php://input');
    $decoded = json_decode($entityBody);

    $dbconn = getDBConnIB();

    $query = $dbconn->prepare("SELECT *, COUNT(*) as cnt FROM `TRANSFER_PAYMENT` WHERE `ID` = ?");
    $query->bind_param("i", $decoded->TransactionID);
    $query->execute();
    $transfer_payment_cnt = $query->get_result()->fetch_assoc();
    $cnt = $transfer_payment_cnt['cnt'];
    $query->close();

    $query = $dbconn->prepare("SELECT `STATUS` FROM `TRANSFER_PAYMENT` WHERE `ID` = ?");
    $query->bind_param("i", $decoded->TransactionID);
    $query->execute();
    $transfer_payment = $query->get_result()->fetch_assoc();
    $status = $transfer_payment['STATUS'];
    $query->close();

    $query = $dbconn->prepare("SELECT `SIGNATURE` FROM `SAKUKU_PAYMENT` WHERE `TRANSACTION_ID` = ?");
    $query->bind_param("i", $decoded->TransactionID);
    $query->execute();
    $sakuku_payment = $query->get_result()->fetch_assoc();
    $query->close();

    if($cnt > 0 && $transfer_payment['STATUS'] != 1 && $sakuku_payment['SIGNATURE'] == $decoded->Signature){
        
        $query = $dbconn->prepare("UPDATE `TRANSFER_PAYMENT` SET `STATUS` = 1 WHERE `ID` = ?");
        $query->bind_param("i", $decoded->TransactionID);
        $query->execute();
        $query->close();

        $status = array("Indonesian" => "Sukses.", "English" => "Success.");
        $reponse = array("FlagStatus" => "00","ReasonStatus" => $status);
        echo json_encode($reponse);
    } elseif($transfer_payment["STATUS"] == 1){
        $status = array("Indonesian" => "Sudah Bayar.", "English" => "Already Paid.");
        $reponse = array("FlagStatus" => "01","ReasonStatus" => $status);
        echo json_encode($reponse);
    } else {
        $status = array("Indonesian" => "Gagal.", "English" => "Failed.");
        $reponse = array("FlagStatus" => "01","ReasonStatus" => $status);
        echo json_encode($reponse);
    }

?>