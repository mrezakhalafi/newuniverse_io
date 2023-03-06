<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/url_function.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/db_conn.php'); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/header-alt.php'); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/header-alt-meta.php'); ?>
<?php
require './gmail/email.php';

session_start();

if ($_SESSION['id_user'] != '') {
	header("Location: dashboardv2/index.php");
}

// session_unset();

$version = 'v=' . time();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$sent = false;

//To send email
function send_email($email_address, $full_name, $subject, $body)
{
	try {
		// Get the API client and construct the service object.
		$client = getClient();
		$service = new Google_Service_Gmail($client);

		$message = createMessage('support@palio.io', $email_address, $subject, $body);
		sendMessage($service, 'me', $message);

		return 'Message has been sent';
	} catch (Exception $e) {

		return "Message could not be sent. Mailer Error: {$e}";
	}
}

if (isset($_POST['recover_pass'])) {

	$dbconn = getDBConn();
	$email = strtolower($_POST['forgotMail']);

	$query = $dbconn->prepare("SELECT COMPANY FROM USER_ACCOUNT WHERE EMAIL_ACCOUNT = ?");
	$query->bind_param("s", $email);
	$query->execute();
	$user = $query->get_result()->fetch_assoc();
	$company_id = $user['COMPANY'];
	$msg = "";

	// if (!$user) {
	// 	echo ("<script>alert('Could not find your email account!');</script>");
	// 	echo ("<script>window.location = 'forgot.php';</script>");
	// };

	if ($company_id > 0) {

		$generatedPass = substr(md5(time()), 0, 10);
		$content = file_get_contents('Palio_Recover_Password_Header.html') . '<div class="text-center" style="text-align: center; font-size: 25px; margin-bottom: 50px; font-weight: bold ">' . $generatedPass . '</div>' . file_get_contents('Palio_Recover_Password_Footer.html');
		send_email($email, "", "Forgot Password Submission", $content);

		$queryUpdatePasswordCompany = $dbconn->prepare("UPDATE USER_ACCOUNT SET PASSWORD = ? WHERE EMAIL_ACCOUNT = ? ");
		$queryUpdatePasswordCompany->bind_param("ss", MD5($generatedPass), $email);
		$queryUpdatePasswordCompany->execute();
		if (!$dbconn->commit()) {
			$msg = 'Update Error : Update Not Commited!';
		}

		$queryUpdatePasswordCompany->close();

		echo ("<script>
		
		if (localStorage.lang == 1){
			alert('Harap check email anda untuk mengatur ulang kata sandi!');
		}
		else{
			alert('Please check your email to reset your password!');
		}
		
		");
		echo ("window.location = 'login.php';</script>");
		// header('Location: /login');

	} else {
		$msg = 'Your mail account is not yet registered!';
	}
}

?>

<!-- <!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title data-translate="forgot-0"></title>

	
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	
	<link rel="stylesheet" href="css/custom.css?<?php echo $version; ?>">
	<link rel="stylesheet" type="text/css" href="./css/api_web.css?<?php echo $version; ?>">

	
	<link rel="stylesheet" href="./fonts/poppins/style.css">
	<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>

	
	<script src="js/custom.js?<?php echo $version; ?>"></script>
	<link rel="stylesheet" type="text/css" href="./css/animate.css">
	<script type="module" src="<?php echo base_url(); ?>translate.js?<?php echo $version; ?>"></script>

</head>

<body> -->

<!-- <nav class="navbar navbar-expand-lg navbar-dark fixed-top px-0" id="navtop-alt" style="transition: top 0.3s;">
		<div class="container" style="max-width: 90%">
			<a class="navbar-brand txt-decor-none" href="index.php">
				<img src="https://id.palio.io/new_palio_logo.png" id="logoImg">
			</a>
		</div>
	</nav> -->

<style>
	@media (max-width: 600px) {
		#login-text {
			/* display: none; */
			font-size: 9px !important;
		}
	}

	.navbar-brand {
		margin-right: 0rem !important;
	}

	@media (max-width: 410px) {
		#btn-sign-in {
			font-size: 12px;
		}
	}

	@media (max-width: 386px) {
		#btn-sign-in {
			font-size: 10px;
		}
	}

	@media (max-width: 372px) {
		#btn-sign-in {
			font-size: 8px;
		}
	}

	@media (min-width: 410px) {
		#btn-sign-in {
			font-size: 16px;
		}
	}

	@media (min-width: 425px) {
		#btn-sign-in {
			font-size: 18px;
		}
	}

	.navbar-nav .dropdown-menu {
		position: absolute !important;
	}
</style>

<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
<link rel="stylesheet" type="text/css" href="./css/api_web.css?<?php echo $version; ?>">
<script type="module" src="<?php echo base_url(); ?>translate.js?<?php echo $version; ?>"></script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
<!-- <script src="bootstrap/js/bootstrap.min.js"></script> -->

<nav class="navbar navbar-expand-lg navbar-dark fixed-top px-0" id="navtop-alt" style="transition: top 0.3s;">
	<div class="container" style="max-width: 90%">
		<a class="navbar-brand txt-decor-none" href="<?php echo base_url(); ?>" style="margin-left: -20px !important">
			<!-- <img src="<?php echo base_url(); ?>newAssets/home.png" id="homeLogo" style="max-height: 30px;"> -->
			<img src="<?php echo base_url(); ?>green_newuniverse.png" id="logoImg">
		</a>
		<ul class="nav navbar-nav ml-auto text-center fontRobReg">
			<li class="nav-item mx-1 d-flex justify-content-center align-items-center">
				<span id="login-text" class="navbar-text navbar-right fs-16" style="color: rgba(0, 0, 0, 1) !important;"><strong data-translate="login-2"></strong></span>
			</li>
			<li class="nav-item mx-1 d-flex justify-content-center align-items-center">
				<!-- <button data-translate="login-3" onclick="pindah('newpricing.php#pay')" class="btn nav-menu-btn-wht-alt fs-16 py-1 px-3"></button> -->
				<a href="sign_up.php" id="btn-sign-in" data-translate="login-3" class="btn nav-menu-btn-wht-alt-subs py-1 px-3"></a>
			</li>
			<li class="nav-item dropdown position-static d-flex justify-content-center align-items-center" id="lang-li">
				<a data-translate="indexnav-28" style="font-size: 18px !important; margin-right: 0px;" class="nav-link nav-menu-link dropdown-toggle fontRobReg fs-20 greenText" id="lang-nav" role="button" aria-haspopup="true" aria-expanded="false">

				</a>
				<div class="dropdown-menu" id="lang-menu" aria-labelledby="dropdownMenuButton">
					<div class="col d-flex justify-content-start p-0">
						<a class="dropdown-item fontRobReg fs-20 py-2 greenText" id="change-lang-EN" role="button" style="display: inline;  color: #1a73e8;">
							EN
						</a>
					</div>
					<div class="col d-flex justify-content-start p-0">
						<a class="dropdown-item fontRobReg fs-20 py-2 greenText" id="change-lang-ID" role="button" style="display: inline;  color: #1a73e8;">
							ID
						</a>
					</div>
				</div>
			</li>
		</ul>
	</div>
</nav>

<div class="modal fade" id="myModal">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-body">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<label class="title-modal fontRobReg">Invalid User or Password</label>
				<p class="text-modal fs-20 fontRobReg"><?php if (!empty($msg)) {
															echo $msg;
														} else {
															echo "error";
														} ?></p>
			</div>
		</div>
	</div>
</div>

<div class="container" style="margin-top: 4.5rem" id="rowForgot">
	<div class="row justify-content-center mt-5">
		<div class="mt-5 col-sm-9 col-md-7 col-lg-5 col-xl-4">
			<form id="email-submit" method="post">
				<div class="form-group mb-4 mt-5">
					<span class="text-left fontRobReg fc-70 fs-30">
						<strong data-translate="forgot-1"></strong>
					</span>
				</div>
				<div class="form-group m-0">
					<span data-translate="forgot-2" class="forget-password fontRobReg text-secondary"></span>
				</div>
				<div class="form-group">
					<input type="email" class="form-control fs-16 ff-segoe-ui" id="forgotMail" name="forgotMail" placeholder="Email" required style="font-family:'Poppins', sans-serif">
				</div>
				<p data-translate="signup-6" class="text-danger fs-15 fontRobReg m-0 text-left mb-3" id="alertEmail" style="display: none;"></p>
				<button id="btn-forgot" data-translate="forgot-3" type="button" class="btn nav-menu-btn-wht-alt py-1 px-3 w-100 m-0 fs-16" name="recover_pass"></button>
			</form>
		</div>
	</div>
</div>
<div class="container animated bounceIn" id="rowSuccess" style="display: none;">
	<div class="row justify-content-center mt-5">
		<div class="col-sm-9 col-md-7 col-lg-5 col-xl-5 text-center">
			<div class="mt-5">
				<i class="fa fa-check-circle" style="color: #355DC9; font-size: 120px;"></i>
			</div>
			<div class="mt-5">
				<span data-translate="forgot-4" class="fs-25 ff-segoe-ui-bold fc-70"></span>
			</div>
			<div class="mt-2">
				<span data-translate="forgot-5" class="fs-20 ff-segoe-ui-light fc-70"></span>
			</div>
		</div>
	</div>
</div>

<?php if (!empty($msg)) : ?>
	<script type="text/javascript">
		$(document).ready(function() {
			$("#myModal").modal("show");
		});
	</script>
<?php endif; ?>

<?php if ($sent) : ?>
	<script type="text/javascript">
		$('#rowForgot').css('display', 'none');
		setTimeout(function() {
			$('#rowSuccess').css('display', 'block');
		}, 200);

		setTimeout(function() {
			location.href = "<?php echo base_url() ?>" + "login.php";
		}, 4000);
	</script>
<?php endif; ?>

<!-- </body> -->

<script>
	if (localStorage.lang == 1) {

		document.getElementsByName("forgotMail")[0].placeholder = "Alamat Email";
		$('#forgotMail').attr('oninvalid', 'this.setCustomValidity("Harap isi bidang ini.")');
		$('#forgotMail').attr('onchange', 'this.setCustomValidity("")');

	}

	$("#change-lang-EN").click(function() {
		document.getElementsByName("forgotMail")[0].placeholder = "Email";
	});

	$("#change-lang-ID").click(function() {
		document.getElementsByName("forgotMail")[0].placeholder = "Alamat Email";
	});

	$("#forgotMail").on('input', function() {
		checkEmail();
	});

	function checkEmail() {
		var val = $("#forgotMail").val();

		var regExEmail = /^[A-Z0-9._-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;

		if (regExEmail.test(val)) {
			if (val != "") {
				$("#alertEmail").hide();
				$("#btn-forgot").attr('type', 'submit');
				console.log("MASUK");
			} else {
				$("#alertEmail").show();
				$("#btn-forgot").attr('type', 'button');
			}
		} else {
			$("#alertEmail").show();
			$("#btn-forgot").attr('type', 'button');
		}
	}

	var input = document.getElementById("forgotMail");

	input.addEventListener("keypress", function(event) {

		var val = $("#forgotMail").val();
		var regExEmail = /^[A-Z0-9._-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;

		if (event.key === "Enter") {

			if (!regExEmail.test(val)) {

				$("#alertEmail").show();
				event.preventDefault();
				return false;

			} else {
				$("#alertEmail").hide();
			}

		}
	});
</script>

<!-- </html> -->

<script>
	$('#btn-forgot').on('touchstart', function() {
		$('#btn-forgot').css('background-color', '#fff');
		$('#btn-forgot').css('color', '#1799ad');
	})

	$('#btn-forgot').on('touchend', function() {
		$('#btn-forgot').css('background-color', '#1799ad');
		$('#btn-forgot').css('color', '#fff');
	})
</script>

<script>
	function nextButton() {

		var myForm = $("#email-submit")[0];
		var fd = new FormData(myForm);

		$.ajax({
			type: "POST",
			url: "/fetch_logic",
			data: fd,
			enctype: 'multipart/form-data',
			cache: false,
			processData: false,
			async: false,
			contentType: false,
			success: function(response) {
				if (response == "1") {
					if (localStorage.lang == 0) {
						alert("We found your email account!");
					} else {
						alert("Kami menemukan akun emailmu!");
					}
				} else {

					if (localStorage.lang == 1) {

						alert("Tidak dapat menemukan email tersebut!");

					} else {

						alert("Could not find your email account!");

					}
					$("#btn-forgot").attr("type", "button");
				}
			},
			error: function(response) {
				alert("connection error");
			}
		});


	}

	$('#btn-forgot').on('click', function() {

		let value = $('#forgotMail').val();

		if (!value) {

			if (localStorage.lang == 1) {
				$('#alertEmail').text('Harap isi bidang ini.');
			} else {
				$('#alertEmail').text('Please fill this required fill.');
			}


			$('#alertEmail').css('display', 'block');
		} else {
			$('#alertEmail').css('display', 'hidden');
			nextButton();
		}

	});
</script>