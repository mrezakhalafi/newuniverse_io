<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/db_conn.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/session_function.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/url_function.php');?>

<?php
    $entityBody = file_get_contents('php://input');
    $decoded = json_decode($entityBody);

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    $dbconn = getDBConn();
    $dbconn2 = getDBConnCore();

        $query = $dbconn->prepare("SELECT *, COUNT(*) as cnt FROM SUBSCRIPTION_TYPE WHERE ID = ?");
    $query->bind_param("i", $decoded->TransactionID);
    $query->execute();
    $subscriptionData = $query->get_result()->fetch_assoc();
    $cnt = $subscriptionData['cnt'];
    $query->close();

    // echo 'is exist -> '.$cnt.', Transaction ID ->'.$decoded->TransactionID.'<br>';

    if($cnt > 0){
        
        // $company_id = $_SESSION['id_company'];

        $company_id = $subscriptionData['COMPANY_ID'];

        $stringQuery = "SELECT EMAIL_ACCOUNT FROM USER_ACCOUNT ua 
        INNER JOIN SUBSCRIPTION_TYPE st ON 
        st.COMPANY_ID WHERE ua.COMPANY = st.COMPANY_ID 
        AND st.COMPANY_ID = ?";

        $query = $dbconn->prepare($stringQuery);
        $query->bind_param("i", $company_id);
        $query->execute();
        $qResult = $query->get_result()->fetch_assoc();
        $email = $qResult['EMAIL_ACCOUNT'];
        $query->close();
      
        // $email = $_SESSION['email'];
        $apikey = base64_encode(microtime() . $email);
    
        $query = $dbconn->prepare("SELECT * FROM USER_ACCOUNT WHERE COMPANY = ?");
        $query->bind_param("i", $company_id);
        $query->execute();
        $dataUser = $query->get_result()->fetch_assoc();
        $password = MD5($dataUser['PASSWORD']);
        $user_id = $dataUser['ID'];
        $query->close();
    
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

        $query2 = $dbconn2->prepare("INSERT INTO `ENTITY` (`id`, `name`, `is_active`, `api_key`, `created_date`, `expired_date`, `state`) VALUES (NULL, ?,1,?, NOW(), DATE_ADD(NOW(), INTERVAL 7 DAY), 1)");
        $query2->bind_param("ss", $dataCompany['COMPANY_NAME'], $apikey);
        $query2->execute();
        $query2->close();

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

        //GET CURRENT USER_ACCOUNT
        $sessEmail = getSession('email');
        $query = $dbconn->prepare("SELECT * FROM USER_ACCOUNT WHERE EMAIL_ACCOUNT = ?");
        $query->bind_param("s", $sessEmail);
        $query->execute();
        $user_account = $query->get_result()->fetch_assoc();
        $query->close();

        //GET BILLING ID
        $query = $dbconn->prepare("SELECT ID FROM BILLING WHERE COMPANY = ? ORDER BY ID ASC LIMIT 1");
        $query->bind_param("i", $user_account['COMPANY']);
        $query->execute();
        $bill = $query->get_result()->fetch_assoc();
        $bill_id = $bill['ID'];
        $query->close();

        //PAYMENT INSERT QUERY
        $query = $dbconn->prepare("INSERT INTO PAYMENT (PAYMENT_METHOD, BILL, COMPANY, USER, PAY_DATE) VALUES ('SAKUKU', ?, ?, ?, NOW())");
        $query->bind_param("iii", $bill_id, $user_account['ID'], $user_account['COMPANY']);
        $query->execute();
        $query->close();

        setSession('email', $email);
        setSession('password', $password);
        setSession('id_user', $user_id);
        setSession('id_company', $company_id);
    
        //get product
        $sessCompId = getSession('id_company');
        $query = $dbconn->prepare("SELECT CHARGE FROM BILLING WHERE COMPANY = ?");
        $query->bind_param("i", $sessCompId);
        $query->execute();
        $package = $query->get_result()->fetch_assoc();
        $active_package = $package['CHARGE']; //price for product chosen
        $query->close();

        // invoice
        function invoiceMail($name, $orderNumber, $orderDate, $item, $price, $method){
            $content = file_get_contents(base_url().'template/Payment_copy_01.html');
            $content = str_replace('*NAME*', $name, $content);
            $content = str_replace('*AMOUNT*', $price, $content);
            $content = str_replace('1A2B3C4D5EFFF', $orderNumber, $content);
            $content = str_replace('April 28, 2020', $orderDate, $content);
            $content = str_replace('ITEM1', $item, $content);
            $content = str_replace('$75', $price, $content);
            $content = str_replace('BCA: **** 5808', $method, $content);
            return $content;
        }
        
        $name = $user_account['USERNAME'];
        // $orderNumber = $bill_id;
        $orderDate = date("F d, Y");
        $item = $dataCompany['PRODUCT_INTEREST'];
        $price = "$" . $price_item_amount;
        $method = 'SAKUKU';
        $content = invoiceMail($name, $orderNumber, $orderDate, $item, $price, $method);

        // EMAIL

        $email = strtolower(getSession('email'));
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
        $mail->addAddress($email);
        $mail->addReplyTo('support@palio.io');

        $mail->isHTML(true);
        $mail->Subject = 'Subscription Submission';
        $mail->Body = $content;

        if (!$mail->send()) {
            $succMsg = "";
            $mail->ClearAllRecipients();
            $msg = 'Error : ' . $mail->ErrorInfo;
        } else {
            $mail->ClearAllRecipients();
            $sent = true;
        }
        
        // END EMAIL

        $status = array("Indonesian" => "Sukses.", "English" => "Success.");
        $reponse = array("FlagStatus" => "00","ReasonStatus" => $status);
        echo json_encode($reponse);
    } else {
        $status = array("Indonesian" => "Gagal.", "English" => "Failed.");
        $reponse = array("FlagStatus" => "01","ReasonStatus" => $status);
        echo json_encode($reponse);
    }
?>