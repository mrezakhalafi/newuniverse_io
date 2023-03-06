<?php include_once($_SERVER['DOCUMENT_ROOT'].'/db_conn.php');?>
<?php include_once($_SERVER['DOCUMENT_ROOT'].'/customize_template.php');?>
<?php


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
$username = '';
$destination = '';
$testnumber = 0;
$apikey = '';
$amount = '';
$companyid = '';

if (isset($_GET['username'])) {
	$username =  $_GET['username'];
} else {
	$username = '';
}

if (isset($_GET['destination'])) {
	$destination =  $_GET['destination'];
} else {
	$destination = '';
}

if (isset($_GET['scenario'])) {
	$testnumber =  $_GET['scenario'];
} else {
	$testnumber = 0;
}

if (isset($_GET['apikey'])) {
	$apikey =  $_GET['apikey'];
} else {
	$apikey = '';
}
if (isset($_GET['amount'])) {
	$amount =  $_GET['amount'];
} else {
	$amount = '';
}
if (isset($_GET['companyid'])) {
	$companyid =  $_GET['companyid'];
} else {
	$companyid = '';
}

function rupiah($angka){
	
	$hasil_rupiah = "Rp " . number_format($angka,2,',','.');
	return $hasil_rupiah;
 
}


function sendMailEmailConfirmation($body, $destination){
	require $_SERVER['DOCUMENT_ROOT'].'/PHPMailer/src/Exception.php';
	require $_SERVER['DOCUMENT_ROOT'].'/PHPMailer/src/PHPMailer.php';
	require $_SERVER['DOCUMENT_ROOT'].'/PHPMailer/src/SMTP.php';

	//$email=$_POST['email'];
	//$msg=$_POST['message'];


	$succMsg = "";
	$errMsg = "";

	if($destination != ""){

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
		$mail->addAddress($destination);
		$mail->addReplyTo('support@palio.io');

		$mail->isHTML(true);
		$mail->Subject = 'Palio Email Confirmation';
        $mail->Body = $body;
        $mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'].'/template/PalioEmailConfirmation_files/image002.png','image002','images002.png');
        $mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'].'/template/PalioEmailConfirmation_files/image004.png','image004','images004.png');
        $mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'].'/template/PalioEmailConfirmation_files/image006.png','image006','images006.png');
        $mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'].'/template/PalioEmailConfirmation_files/image008.png','image008','images008.png');
        $mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'].'/template/PalioEmailConfirmation_files/image010.png','image010','images010.png');
        $mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'].'/template/PalioEmailConfirmation_files/image012.png','image012','images012.png');

		if(!$mail->send()){
			$mail->ClearAllRecipients();
            $succMsg = $mail->ErrorInfo;
            echo $succMsg;
		} else {
			$mail->ClearAllRecipients();
            $succMsg = "Email has been sent successfully.";
            // echo $succMsg;
		}

	} else {
        $errMsg = "Please fill all the form!";
        // echo $errMsg;
	}
}
function sendMailPayment($body, $destination){
	require $_SERVER['DOCUMENT_ROOT'].'/PHPMailer/src/Exception.php';
	require $_SERVER['DOCUMENT_ROOT'].'/PHPMailer/src/PHPMailer.php';
	require $_SERVER['DOCUMENT_ROOT'].'/PHPMailer/src/SMTP.php';

	//$email=$_POST['email'];
	//$msg=$_POST['message'];


	$succMsg = "";
	$errMsg = "";

	if($destination != ""){

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
		$mail->addAddress($destination);
		$mail->addReplyTo('support@palio.io');

		$mail->isHTML(true);
		$mail->Subject = 'Payment';
        $mail->Body = $body;
        $mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'].'/template/Payment_files/image002.png','image002','images002.png');
        $mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'].'/template/Payment_files/image004.jpg','image004','images004.jpg');
        $mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'].'/template/Payment_files/image006.png','image006','images006.png');
        $mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'].'/template/Payment_files/image008.png','image008','images008.png');
        $mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'].'/template/Payment_files/image010.png','image010','images010.png');
        $mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'].'/template/Payment_files/image012.png','image012','images012.png');
        $mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'].'/template/Payment_files/image014.png','image014','images014.png');

		if(!$mail->send()){
			$mail->ClearAllRecipients();
            $succMsg = $mail->ErrorInfo;
            echo $succMsg;
		} else {
			$mail->ClearAllRecipients();
            $succMsg = "Email has been sent successfully.";
            echo $succMsg;
		}

	} else {
        $errMsg = "Please fill all the form!";
        echo $errMsg;
	}
}
function sendMailWelcome($body, $destination){
	require $_SERVER['DOCUMENT_ROOT'].'/PHPMailer/src/Exception.php';
	require $_SERVER['DOCUMENT_ROOT'].'/PHPMailer/src/PHPMailer.php';
	require $_SERVER['DOCUMENT_ROOT'].'/PHPMailer/src/SMTP.php';

	//$email=$_POST['email'];
	//$msg=$_POST['message'];


	$succMsg = "";
	$errMsg = "";

	if($destination != ""){

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
		$mail->addAddress($destination);
		$mail->addReplyTo('support@palio.io');

		$mail->isHTML(true);
		$mail->Subject = 'Welcome To Palio';
        $mail->Body = $body;
        $mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'].'/template/WelcometoPalio_files/image002.png','image002','images002.png');
        $mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'].'/template/WelcometoPalio_files/image004.png','image004','images004.png');
        $mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'].'/template/WelcometoPalio_files/image006.png','image006','images006.png');
        $mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'].'/template/WelcometoPalio_files/image008.png','image008','images008.png');
        $mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'].'/template/WelcometoPalio_files/image010.png','image010','images010.png');
        $mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'].'/template/WelcometoPalio_files/image012.png','image012','images012.png');
		$mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'].'/template/WelcometoPalio_files/image014.png','image014','images014.png');
		$mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'].'/template/WelcometoPalio_files/image016.png','image016','images016.png');
		$mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'].'/template/WelcometoPalio_files/image018.png','image018','images018.png');

		if(!$mail->send()){
			$mail->ClearAllRecipients();
            $succMsg = $mail->ErrorInfo;
            echo $succMsg;
		} else {
			$mail->ClearAllRecipients();
            $succMsg = "Email has been sent successfully.";
            echo $succMsg;
		}

	} else {
        $errMsg = "Please fill all the form!";
        echo $errMsg;
	}
}
function sendMailAPIKey($body, $destination){
	require $_SERVER['DOCUMENT_ROOT'].'/PHPMailer/src/Exception.php';
	require $_SERVER['DOCUMENT_ROOT'].'/PHPMailer/src/PHPMailer.php';
	require $_SERVER['DOCUMENT_ROOT'].'/PHPMailer/src/SMTP.php';

	//$email=$_POST['email'];
	//$msg=$_POST['message'];


	$succMsg = "";
	$errMsg = "";

	if($destination != ""){

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
		$mail->addAddress($destination);
		$mail->addReplyTo('support@palio.io');

		$mail->isHTML(true);
		$mail->Subject = 'Palio API Key';
        $mail->Body = $body;
        $mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'].'/template/PalioAPIKey_files/image002.png','image002','images002.png');
        $mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'].'/template/PalioAPIKey_files/image004.png','image004','images004.png');
        $mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'].'/template/PalioAPIKey_files/image006.png','image006','images006.png');
        $mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'].'/template/PalioAPIKey_files/image008.png','image008','images008.png');
        $mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'].'/template/PalioAPIKey_files/image010.png','image010','images010.png');
        $mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'].'/template/PalioAPIKey_files/image012.png','image012','images012.png');

		if(!$mail->send()){
			$mail->ClearAllRecipients();
            $succMsg = $mail->ErrorInfo;
            echo $succMsg;
		} else {
			$mail->ClearAllRecipients();
            $succMsg = "Email has been sent successfully.";
            echo $succMsg;
		}

	} else {
        $errMsg = "Please fill all the form!";
        echo $errMsg;
	}
}
function sendMailFreeTrial($body, $destination){
	require $_SERVER['DOCUMENT_ROOT'].'/PHPMailer/src/Exception.php';
	require $_SERVER['DOCUMENT_ROOT'].'/PHPMailer/src/PHPMailer.php';
	require $_SERVER['DOCUMENT_ROOT'].'/PHPMailer/src/SMTP.php';

	//$email=$_POST['email'];
	//$msg=$_POST['message'];


	$succMsg = "";
	$errMsg = "";

	if($destination != ""){

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
		$mail->addAddress($destination);
		$mail->addReplyTo('support@palio.io');

		$mail->isHTML(true);
		$mail->Subject = 'Free Trial';
        $mail->Body = $body;
        $mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'].'/template/FreeTrial_files/image002.png','image002','images002.png');
        $mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'].'/template/FreeTrial_files/image004.png','image004','images004.png');
        $mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'].'/template/FreeTrial_files/image006.png','image006','images006.png');
        $mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'].'/template/FreeTrial_files/image008.png','image008','images008.png');
        $mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'].'/template/FreeTrial_files/image010.png','image010','images010.png');
        $mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'].'/template/FreeTrial_files/image012.png','image012','images012.png');
		$mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'].'/template/FreeTrial_files/image014.png','image014','images014.png');

		if(!$mail->send()){
			$mail->ClearAllRecipients();
            $succMsg = $mail->ErrorInfo;
            echo $succMsg;
		} else {
			$mail->ClearAllRecipients();
            $succMsg = "Email has been sent successfully.";
            echo $succMsg;
		}

	} else {
        $errMsg = "Please fill all the form!";
        echo $errMsg;
	}
}
function sendMailExpiredFreeTrial($body, $destination){
	require $_SERVER['DOCUMENT_ROOT'].'/PHPMailer/src/Exception.php';
	require $_SERVER['DOCUMENT_ROOT'].'/PHPMailer/src/PHPMailer.php';
	require $_SERVER['DOCUMENT_ROOT'].'/PHPMailer/src/SMTP.php';

	//$email=$_POST['email'];
	//$msg=$_POST['message'];


	$succMsg = "";
	$errMsg = "";

	if($destination != ""){

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
		$mail->addAddress($destination);
		$mail->addReplyTo('support@palio.io');

		$mail->isHTML(true);
		$mail->Subject = 'Expired Free Trial';
        $mail->Body = $body;
        $mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'].'/template/ExpiredFreeTrial_files/image002.png','image002','images002.png');
        $mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'].'/template/ExpiredFreeTrial_files/image004.jpg','image004','images004.jpg');
        $mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'].'/template/ExpiredFreeTrial_files/image006.png','image006','images006.png');
        $mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'].'/template/ExpiredFreeTrial_files/image008.png','image008','images008.png');
        $mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'].'/template/ExpiredFreeTrial_files/image010.png','image010','images010.png');
        $mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'].'/template/ExpiredFreeTrial_files/image012.png','image012','images012.png');
		$mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'].'/template/ExpiredFreeTrial_files/image014.png','image014','images014.png');

		if(!$mail->send()){
			$mail->ClearAllRecipients();
            $succMsg = $mail->ErrorInfo;
            echo $succMsg;
		} else {
			$mail->ClearAllRecipients();
            $succMsg = "Email has been sent successfully.";
            echo $succMsg;
		}

	} else {
        $errMsg = "Please fill all the form!";
        echo $errMsg;
	}
}
function sendMailBetaTest($body, $destination){
	require $_SERVER['DOCUMENT_ROOT'].'/PHPMailer/src/Exception.php';
	require $_SERVER['DOCUMENT_ROOT'].'/PHPMailer/src/PHPMailer.php';
	require $_SERVER['DOCUMENT_ROOT'].'/PHPMailer/src/SMTP.php';

	//$email=$_POST['email'];
	//$msg=$_POST['message'];


	$succMsg = "";
	$errMsg = "";

	if($destination != ""){

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
		$mail->addAddress($destination);
		$mail->addReplyTo('support@palio.io');

		$mail->isHTML(true);
		$mail->Subject = 'Beta Test';
        $mail->Body = $body;
        $mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'].'/template/BetaTest_files/image002.png','image002','images002.png');
        $mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'].'/template/BetaTest_files/image004.jpg','image004','images004.jpg');
        $mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'].'/template/BetaTest_files/image006.png','image006','images006.png');
        $mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'].'/template/BetaTest_files/image008.png','image008','images008.png');
        $mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'].'/template/BetaTest_files/image010.png','image010','images010.png');
        $mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'].'/template/BetaTest_files/image012.png','image012','images012.png');
		$mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'].'/template/BetaTest_files/image014.png','image014','images014.png');

		if(!$mail->send()){
			$mail->ClearAllRecipients();
            $succMsg = $mail->ErrorInfo;
            echo $succMsg;
		} else {
			$mail->ClearAllRecipients();
            $succMsg = "Email has been sent successfully.";
            echo $succMsg;
		}

	} else {
        $errMsg = "Please fill all the form!";
        echo $errMsg;
	}
}
function sendMailSpecialOffering($body, $destination){
	require $_SERVER['DOCUMENT_ROOT'].'/PHPMailer/src/Exception.php';
	require $_SERVER['DOCUMENT_ROOT'].'/PHPMailer/src/PHPMailer.php';
	require $_SERVER['DOCUMENT_ROOT'].'/PHPMailer/src/SMTP.php';

	//$email=$_POST['email'];
	//$msg=$_POST['message'];


	$succMsg = "";
	$errMsg = "";

	if($destination != ""){

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
		$mail->addAddress($destination);
		$mail->addReplyTo('support@palio.io');

		$mail->isHTML(true);
		$mail->Subject = 'Special Offering';
        $mail->Body = $body;
        $mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'].'/template/SpecialOfferingv1_files/image002.png','image002','images002.png');
        $mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'].'/template/SpecialOfferingv1_files/image004.jpg','image004','images004.jpg');
        $mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'].'/template/SpecialOfferingv1_files/image006.png','image006','images006.png');
        $mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'].'/template/SpecialOfferingv1_files/image008.png','image008','images008.png');
        $mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'].'/template/SpecialOfferingv1_files/image010.png','image010','images010.png');
        $mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'].'/template/SpecialOfferingv1_files/image012.png','image012','images012.png');
		$mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'].'/template/SpecialOfferingv1_files/image014.png','image014','images014.png');

		if(!$mail->send()){
			$mail->ClearAllRecipients();
            $succMsg = $mail->ErrorInfo;
            echo $succMsg;
		} else {
			$mail->ClearAllRecipients();
            $succMsg = "Email has been sent successfully.";
            echo $succMsg;
		}

	} else {
        $errMsg = "Please fill all the form!";
        echo $errMsg;
	}
}
function sendMailPersonalized($body, $destination){
	require $_SERVER['DOCUMENT_ROOT'].'/PHPMailer/src/Exception.php';
	require $_SERVER['DOCUMENT_ROOT'].'/PHPMailer/src/PHPMailer.php';
	require $_SERVER['DOCUMENT_ROOT'].'/PHPMailer/src/SMTP.php';

	//$email=$_POST['email'];
	//$msg=$_POST['message'];


	$succMsg = "";
	$errMsg = "";

	if($destination != ""){

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
		$mail->addAddress($destination);
		$mail->addReplyTo('support@palio.io');

		$mail->isHTML(true);
		$mail->Subject = 'Personalized';
        $mail->Body = $body;
        $mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'].'/template/Personalized BCA _files/image002.png','image002','images002.png');
        $mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'].'/template/Personalized BCA _files/image004.jpg','image004','images004.jpg');
        $mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'].'/template/Personalized BCA _files/image006.png','image006','images006.png');
        $mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'].'/template/Personalized BCA _files/image008.png','image008','images008.png');
        $mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'].'/template/Personalized BCA _files/image010.png','image010','images010.png');
        $mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'].'/template/Personalized BCA _files/image012.png','image012','images012.png');
		
		if(!$mail->send()){
			$mail->ClearAllRecipients();
            $succMsg = $mail->ErrorInfo;
            echo $succMsg;
		} else {
			$mail->ClearAllRecipients();
            $succMsg = "Email has been sent successfully.";
            echo $succMsg;
		}

	} else {
        $errMsg = "Please fill all the form!";
        echo $errMsg;
	}
}
function sendMailLaunching($body, $destination){
	require $_SERVER['DOCUMENT_ROOT'].'/PHPMailer/src/Exception.php';
	require $_SERVER['DOCUMENT_ROOT'].'/PHPMailer/src/PHPMailer.php';
	require $_SERVER['DOCUMENT_ROOT'].'/PHPMailer/src/SMTP.php';

	//$email=$_POST['email'];
	//$msg=$_POST['message'];


	$succMsg = "";
	$errMsg = "";

	if($destination != ""){

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
		$mail->addAddress($destination);
		$mail->addReplyTo('support@palio.io');

		$mail->isHTML(true);
		$mail->Subject = 'Launching Palio';
        $mail->Body = $body;
        $mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'].'/template/Launching_files/image002.png','image002','images002.png');
        $mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'].'/template/Launching_files/image004.jpg','image004','images004.jpg');
        $mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'].'/template/Launching_files/image006.png','image006','images006.png');
        $mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'].'/template/Launching_files/image008.png','image008','images008.png');
        $mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'].'/template/Launching_files/image010.png','image010','images010.png');
        $mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'].'/template/Launching_files/image012.png','image012','images012.png');
		$mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'].'/template/Launching_files/image014.png','image014','images014.png');
		$mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'].'/template/Launching_files/image016.png','image016','images016.png');
		$mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'].'/template/Launching_files/image018.png','image018','images018.png');

		if(!$mail->send()){
			$mail->ClearAllRecipients();
            $succMsg = $mail->ErrorInfo;
            echo $succMsg;
		} else {
			$mail->ClearAllRecipients();
            $succMsg = "Email has been sent successfully.";
            echo $succMsg;
		}

	} else {
        $errMsg = "Please fill all the form!";
        echo $errMsg;
	}
}

/*
	Untuk Testing
	Isi destination dengan email yang akan dituju
*/

switch ($testnumber) {
	case 1:
		$content = customizeTemplateRemoteAPIKey($username,$apikey);
		sendMailAPIKey($content,$destination);
	case 2:
		$content = customizeTemplateRemoteByName('*NAME*',$username,'template/WelcometoPalio.htm');
		sendMailWelcome($content,$destination);
	case 3:
		$amount = rupiah($amount);
		$content = customizeTemplateRemoteByName(array('*NAME*','*AMOUNT*'),array($username,$amount),'template/Payment.htm');
		sendMailPayment($content,$destination);
	case 4:
		$today = date("d-m-Y");
		$nextday = strftime("%d-%m-%Y",strtotime("$today +1 day"));
		$content = customizeTemplateRemoteByName(array('*NAME*','*DATE*'),array($username,$nextday),'template/FreeTrial.htm');
		sendMailFreeTrial($content,$destination);
	case 5:
		$content = customizeTemplateRemoteByName('*NAME*',$username,'template/ExpiredFreeTrial.htm');
		sendMailExpiredFreeTrial($content,$destination);
	case 6:
		$content = customizeTemplateRemoteByName('Hi!',$username,'template/BetaTest.htm');
		sendMailBetaTest($content,$destination);
	case 7:
		$content = customizeTemplateRemoteByName('*NAME*',$username,'template/SpecialOfferingv1.htm');
		sendMailSpecialOffering($content,$destination);
	case 8:
		$content = customizeTemplateRemoteByName('',$username,'template/Launching.htm');
		sendMailLaunching($content,$destination);
	case 9:
		$content = customizeTemplateRemoteByName('',$username,'template/Personalized BCA .htm');
		sendMailPersonalized($content,$destination);
	case 10:
		$hash = md5(rand(0, 1000));
		$activation_link = "http://103.94.169.26:8081/verify.php?email=" . $destination . "&company=". $companyid ."&hash=" . $hash;
		$content = customizeTemplateRemoteEmailConfirmation($username,$activation_link);
		sendMailEmailConfirmation($content,$destination);
}


?>