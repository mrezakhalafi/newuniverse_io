<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/db_conn.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/session_insert.php'); ?>
<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    function saveData(){
        
        $company_id = $_POST["company_id"];
        $transaction_id = (int)$_POST["transaction_id"];

        $dbconn = getDBConn();
        $dbconn2 = getDBConnCore();

        $query = $dbconn->prepare("SELECT *, COUNT(*) as cnt FROM SUBSCRIPTION_TYPE WHERE ID = " . $transaction_id);
        // echo $dbconn -> error;die;
        // $query->bind_param("i", $transaction_id);
        $query->execute();
        $subscriptionData = $query->get_result()->fetch_assoc();
        $cnt = $subscriptionData['cnt'];
        $query->close();
        
        $query = $dbconn->prepare("SELECT ua.* FROM USER_ACCOUNT ua, SUBSCRIPTION_TYPE st WHERE ua.COMPANY = st.COMPANY_ID 
        AND st.COMPANY_ID = ?");
        $query->bind_param("i", $company_id);
        $query->execute();
        $user_account = $query->get_result()->fetch_assoc();
        $email = $user_account['EMAIL_ACCOUNT'];
        $user_id = $user_account['ID'];
        $query->close();

        if($cnt > 0 && $user_account['STATUS'] != 1){
            $apikey = base64_encode(microtime() . $email);

            $query = $dbconn->prepare("SELECT * FROM COMPANY_INFO WHERE COMPANY = ?");
            $query->bind_param("i", $company_id);
            $query->execute();
            $dataCompany = $query->get_result()->fetch_assoc();
            $query->close();
        
            $query = $dbconn->prepare("SELECT * FROM SUBSCRIPTION_TYPE WHERE COMPANY_ID = ?");
            $query->bind_param("i", $company_id);
            $query->execute();
            $subscriptionData = $query->get_result()->fetch_assoc();
            $subscriptionType = $subscriptionData['TYPE'];
            $price_item_amount = $subscriptionData['PRICE'];
            $orderNumber = $subscriptionData['ID'];
            $query->close();
            
            $msg = "New User";
            $query = $dbconn->prepare("INSERT INTO MESSAGE (COMPANY, USER_ACCOUNT, M_ID, MESSAGE_DATE, MESSAGE_DESC, IS_READ) VALUES (?,?,1, NOW(), ?, NULL)");
            $query->bind_param("iis", $company_id, $user_id, $msg);
            $query->execute();
            $query->close();

            // $query2 = $dbconn2->prepare("INSERT INTO `ENTITY` (`id`, `name`, `is_active`, `api_key`, `created_date`, `expired_date`, `state`) VALUES (NULL, ?,1,?, NOW(), DATE_ADD(NOW(), INTERVAL 7 DAY), 1)");
            // $query2->bind_param("ss", $dataCompany['COMPANY_NAME'], $apikey);
            // $query2->execute();
            // $query2->close();

            // insert apikey to nusdk server
            // $url = "http://202.158.33.26:8004/webrest/";
            // $data = array(
            //     'code' => 'REGBE',
            //     'data' => array(
            //         'company_id' => $company_id,
            //         'name' => $user_account['USERNAME'],
            //         'api_key' => $apikey,
            //     ),
                
            // );

            // $options = array(
            //     'http' => array(
            //         'header'  => 
            //             // "Authorization: ".$secretKey."\r\n".
            //             "Content-type: application/json\r\n",
            //         'method'  => 'POST',
            //         'content' => strval(json_encode($data))
            //     )
            // );

            // $stream = stream_context_create($options); 
            // $result = file_get_contents($url, false, $stream);
            // $json_result = json_decode($result);
            // end apikey

            $query = $dbconn->prepare("UPDATE COMPANY SET API_KEY = ? WHERE ID = ?");
            $query->bind_param("si", $apikey, $company_id);
            $query->execute();
            $query->close();

            $query = $dbconn->prepare("UPDATE USER_ACCOUNT SET STATUS = 1 WHERE COMPANY = ?");
            $query->bind_param("i", $company_id);
            $query->execute();
            $query->close();

            //update status subscribe
            $query = $dbconn->prepare("UPDATE SUBSCRIBE SET STATUS = 1 WHERE COMPANY = ?");
            $query->bind_param("i", $company_id);
            $query->execute();
            $query->close();

            //GET SUBSCRIBE ID
            $query = $dbconn->prepare("SELECT ID FROM SUBSCRIBE WHERE COMPANY = ? ORDER BY ID ASC LIMIT 1");
            $query->bind_param("i", $company_id);
            $query->execute();
            $subscribe = $query->get_result()->fetch_assoc();
            $subscribe_id = $subscribe['ID'];
            $query->close();

            //update billing
            $query = $dbconn->prepare("UPDATE BILLING SET IS_PAID = 1 WHERE COMPANY = ? AND SUBSCRIBE = ?");
            $query->bind_param("ii", $company_id, $subscribe_id);
            $query->execute();
            $query->close();

            //GET BILLING ID
            $query = $dbconn->prepare("SELECT ID FROM BILLING WHERE COMPANY = ? ORDER BY ID ASC LIMIT 1");
            $query->bind_param("i", $company_id);
            $query->execute();
            $bill = $query->get_result()->fetch_assoc();
            $bill_id = $bill['ID'];
            $query->close();

            //PAYMENT INSERT QUERY
            $query = $dbconn->prepare("INSERT INTO PAYMENT (PAYMENT_METHOD, BILL, COMPANY, USER, PAY_DATE) VALUES ('OVO E-Wallet', ?, ?, ?, NOW())");
            $query->bind_param("iii", $bill_id, $company_id, $user_id);
            $query->execute();
            $query->close();

            //get product
            $query = $dbconn->prepare("SELECT CHARGE FROM BILLING WHERE COMPANY = ?");
            $query->bind_param("i", $company_id);
            $query->execute();
            $package = $query->get_result()->fetch_assoc();
            $active_package = $package['CHARGE']; //price for product chosen
            $query->close();

            // invoice
            function invoiceMail($name, $orderNumber, $orderDate, $item, $price, $method, $dashboard){
                $content = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/template/Payment_copy_01.html');
                $content = str_replace('*NAME*', $name, $content);
                $content = str_replace('*AMOUNT*', $price, $content);
                $content = str_replace('1A2B3C4D5EFFF', $orderNumber, $content);
                $content = str_replace('April 28, 2020', $orderDate, $content);
                $content = str_replace('ITEM1', $item, $content);
                $content = str_replace('$75', $price, $content);
                $content = str_replace('BCA: **** 5808', $method, $content);
                $content = str_replace('http://103.94.169.26:8081/', $dashboard, $content);
                return $content;
            }
            
            $name = $user_account['USERNAME'];
            $orderDate = date("F d, Y");
            $item = $dataCompany['PRODUCT_INTEREST'];
            $price = sprintf('%0.2f', round($price_item_amount * 14187.50));
            $method = 'OVO E-Wallet';
            $dashboard = base_url();
            $content = invoiceMail($name, $orderNumber, $orderDate, $item, 'Rp. '.$price, $method, $dashboard);

            // EMAIL

            $lowerCaseMail = strtolower($email);
            require $_SERVER['DOCUMENT_ROOT'] . '/PHPMailer/src/Exception.php';
            require $_SERVER['DOCUMENT_ROOT'] . '/PHPMailer/src/PHPMailer.php';
            require $_SERVER['DOCUMENT_ROOT'] . '/PHPMailer/src/SMTP.php';

            $mail = new PHPMailer();
            //$mail->SMTPDebug = 2;
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'support@palio.io';
            $mail->Password   = '12345easySoft67890';
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;

            //Recipients
            $mail->setFrom('support@palio.io', 'Palio');
            $mail->addAddress($lowerCaseMail);
            $mail->addReplyTo('support@palio.io');

            $mail->isHTML(true);
            $mail->Subject = 'Subscription Submission';
            $mail->Body = $content;

            if (!$mail->send()) {
                $succMsg = "";
                $mail->ClearAllRecipients();
                $msg = 'Error Mailler: ' . $mail->ErrorInfo;
                echo $msg;
            } else {
                $mail->ClearAllRecipients();
                $sent = true;
                
                // insert session into db
                insertSession($user_id);
            }
            
            // END EMAIL
        }

        // echo $result;
    }

    function checkOvo(){
        $secretKey = $_POST["secretKey"];
        $external_id = $_POST["external_id"];

        $url = "https://api.xendit.co/ewallets?external_id=" . $external_id . "&ewallet_type=OVO";

        $options = array(
            'http' => array(
                'header'  => 
                    "Authorization: ".$secretKey."\r\n".
                    "Content-type: application/json\r\n",
                'method'  => 'GET',
            )
        );

        $stream = stream_context_create($options); 
        $result = file_get_contents($url, false, $stream);
        $json_result = json_decode($result);

        if($json_result->status == "COMPLETED"){
            saveData();
            echo $result;
        } else {
            checkOvo();
        }
    }

    checkOvo();

?>