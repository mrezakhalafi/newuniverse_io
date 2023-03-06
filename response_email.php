<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/url_function.php'); ?>
<?php 

    header("Content-Type: application/json");
    $data = json_decode(file_get_contents("php://input")); 
  
    use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

    require $_SERVER['DOCUMENT_ROOT'] . '/PHPMailer/src/Exception.php';
    require $_SERVER['DOCUMENT_ROOT'] . '/PHPMailer/src/PHPMailer.php';
    require $_SERVER['DOCUMENT_ROOT'] . '/PHPMailer/src/SMTP.php';

    $name = $data->name;
    $email = $data->email;
    $msg = $data->message;

    $succMsg = "";
    $errMsg = "";
    $result = '';

    if ($name != "" && $email != "" && $msg != "") {

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'support@palio.io';
        $mail->Password   = '12345easySoft67890';
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        //Recipients
        $mail->setFrom('support@palio.io', 'Palio');
        $mail->addAddress('support@palio.io');
        $mail->addReplyTo('support@palio.io');

        $mail->isHTML(true);
        $mail->Subject = 'Form Submit';
        $mail->Body = 'Prospect: ' . $name . '<br>Email: ' . $email . '<br>Inquiry: ' . $msg;

        if (!$mail->send()) {
            $mail->ClearAllRecipients();
            $succMsg = $mail->ErrorInfo;
            $result = $succMsg;
        } else {
            $mail->ClearAllRecipients();
            $succMsg = "Email has been sent successfully.";
            $result = $succMsg;

            // RESPONSE EMAIL

                // invoice
                function invoiceMail($username){
                    $content = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/template/ContactusResponse.htm');
                    $content = str_replace('USERNAME', $username, $content);
                    return $content;
                }
                
                $username = $name;
                $content = invoiceMail($username);

                // EMAIL
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
                $mail->Subject = 'Feedback Response';
                $mail->Body = $content;
                $mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'] . '/template/PalioEmailConfirmation_files/image003.png', 'ccimage', 'images003.png');

                if (!$mail->send()) {
                    $succMsg = "";
                    $mail->ClearAllRecipients();
                    $msg = 'Error Mailler: ' . $mail->ErrorInfo;
                    echo $msg;
                } else {
                    $mail->ClearAllRecipients();
                    $sent = true;
                }
                
                // END EMAIL

            // END RESPONSE EMAIL

        }
        
    } else {
        $errMsg = "Please fill all the form!";
        $result = $errMsg;
    }

    echo $result;

?>