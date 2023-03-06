<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/db_conn.php'); ?>
<?php 
    if(isset($_POST['accessToken'])){
        $dbconn = getDBConn();
        
        try {
            $id = round(microtime(true)*1000) + 1;
            $transactionId = (int)$_POST['transactionID'];
            $accessToken = $_POST['accessToken'];
            $paymentId = $_POST['paymentID'];
            $amount = (double)$_POST['fullAmount'];
            $url = $_POST['landingPageURL'];

            $data = $accessToken.$_POST['transactionID'].number_format($_POST['fullAmount'], 2, '.', '').$paymentId;
            $hash = hash('sha256', $data);

            $query= $dbconn->prepare("SELECT ID FROM TRANSACTION_HISTORY WHERE TRANSACTION_ID = ?");
            $query->bind_param("i", $transactionId);
            $query->execute();
            $dataHistory = $query->get_result()->fetch_assoc();
            $query->close();

            $idHistory = $dataHistory['ID'];
            if($idHistory == NULL){
                $query = $dbconn->prepare("INSERT INTO TRANSACTION_HISTORY(ID, TRANSACTION_ID, ACCESS_TOKEN, PAYMENT_ID, AMOUNT, SIGNATURE, LANDING_URL, DATE) VALUES (?, ?, ?, ?, ?, ?, ?, NOW())");
                $query->bind_param("iissdss", $id, $transactionId, $accessToken, $paymentId, $amount, $hash, $url);
                $query->execute();
                $query->close();
            } else {
                $query = $dbconn->prepare("UPDATE TRANSACTION_HISTORY SET ACCESS_TOKEN = ?, PAYMENT_ID = ?, AMOUNT = ?, SIGNATURE = ?, LANDING_URL = ?, DATE = NOW() WHERE ID = ?");
                $query->bind_param("ssdssi", $accessToken, $paymentId, $amount, $hash, $url, $idHistory);
                $query->execute();
                $query->close();
            }

            print 1;
        } catch(exception $e) {
            print $e;
        }
        
    } else {
        print 0;
    }
?>