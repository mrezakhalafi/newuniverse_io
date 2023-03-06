<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/header-ib.php'); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/header-ib-meta.php'); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/ib-nav.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/url_function.php'); ?>

<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['send'])) {

	require $_SERVER['DOCUMENT_ROOT'] . '/PHPMailer/src/Exception.php';
	require $_SERVER['DOCUMENT_ROOT'] . '/PHPMailer/src/PHPMailer.php';
	require $_SERVER['DOCUMENT_ROOT'] . '/PHPMailer/src/SMTP.php';

	$name = $_POST['name'];
	$email = $_POST['email'];
	$msg = $_POST['message'];


	$succMsg = "";
	$errMsg = "";

	if ($name != "" && $email != "" && $msg != "") {

		$mail = new PHPMailer();
		//$mail->SMTPDebug = 2;
		$mail->isSMTP();
		$mail->Host       = 'smtp.gmail.com';
		$mail->SMTPAuth   = true;
		$mail->Username   = 'halo@indonesiabisa.io';
		$mail->Password   = '12345easySoft67890';
		$mail->SMTPSecure = 'tls';
		$mail->Port       = 587;

		//Recipients
		$mail->setFrom('support@palio.io', 'Palio');
		$mail->addAddress('support@palio.io');
		//$mail->addCC($email); 
		$mail->addReplyTo('support@palio.io');

		$mail->isHTML(true);
		$mail->Subject = 'Form Submit';
		$mail->Body = 'Prospect: ' . $name . '<br>Email: ' . $email . '<br>Inquiry: ' . $msg;

		if (!$mail->send()) {
			$mail->ClearAllRecipients();
			$succMsg = $mail->ErrorInfo;
		} else {
			$mail->ClearAllRecipients();
			$succMsg = "Email has been sent successfully.";
		}
	} else {
		$errMsg = "Please fill all the form!";
	}
}

?>

<script>
	var a = document.getElementById('beta'); //or grab it by tagname etc
	a.href = "sign_up.php?page=" + page;
	var b = document.getElementById('loginbeta'); //or grab it by tagname etc
	b.href = "login.php?page=" + page;
</script>

<style>
	input::placeholder,
	textarea::placeholder {
		font-family: 'Josefin Sans';
	}
</style>

<header class="bannerNav">

</header>

<div class="container">
	<!-- <div class="row justify-content-center mt-5 mb-4">
		<h2 class="my-auto ml-4 font-weight-bold">Talk to sales</h2>
	</div> -->

	<div class="row justify-content-center" style="margin-top:8rem;">
		<div class="col-md-10 text-center">
			<h2 style="font-family:'Work Sans';">Staff kami akan membantu Anda.<br>Mohon isi formulir di bawah.</h2>
		</div>
	</div>

	<form method="POST">
		<div class="row my-5 justify-content-center">
			<div class="col-md-8">
				<div class="card shadow">
					<div class="card-body">
						<div class="row my-3">
							<div class="col">
								<input required type="text" name="name" class="form-control" placeholder="Nama Anda">
							</div>
							<div class="col">
								<input required type="text" name="email" class="form-control" id="email" placeholder="Email" onkeyup="checkEmail();">
								<p class="text-danger fs-15 fontRobReg m-0 text-left" id="alertEmail" style="display: none;">Mohon gunakan email yang benar.</p>
							</div>
						</div>
						<div class="row my-3">
							<div class="col-md-12">
								<textarea required class="form-control" name="message" rows="10" placeholder="Pesan" onclick="checkEmail();"></textarea>
							</div>
						</div>
						<div class="row my-3">
							<div class="col-md-12">
								<button id="submit" type="submit" name="send" class="btn nav-menu-btn-wht-alt w-100 m-0">Kirim</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>

<div class="modal fade" id="myModal">
	<div class="modal-dialog modal-dialog-centered modal-lg">
		<div class="modal-content">
			<div class="modal-body pb-5">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<div class="row justify-content-center m-0">
					<p class="text-center font-weight-bold fontRobReg mb-0 mt-5 fs-20 pl-lg-4">Terima kasih telah mengisi form kontak kami!</p>
				</div>
				<div class="row justify-content-center mt-4">
					<p class="fontRobReg mb-0 fs-15 text-center">Pertanyaan Anda telah dikirim!<br>
						Kami akan menghubungi Anda untuk memberikan informasi lebih lanjut.</p>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="myModal2">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-body fontRobReg">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<label>Prompt</label>
				<p class="fs-20 fc-70 mt-1"><?php if (!empty($errMsg)) {
												echo $errMsg;
											} else {
												echo "error";
											} ?></p>
				<!-- <button type="button" class="btn btn-default btn-modal fs-15" data-dismiss="modal">Confirm</button> -->
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	function checkEmail() {

		var val = $('#email').val();

		var regExEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;

		if (regExEmail.test(val)) {

			$('#alertEmail').css('display', 'none');
			$('#submit').prop('disabled', false);

		} else {

			$('#alertEmail').css('display', 'block');
			$('#submit').prop('disabled', true);

		}

	}
</script>

<?php if (!empty($errMsg)) : ?>
	<script type="text/javascript">
		$(document).ready(function() {
			$("#myModal2").modal("show");
		});
	</script>
<?php endif; ?>

<?php if (!empty($succMsg)) : ?>
	<script type="text/javascript">
		$(document).ready(function() {
			$("#myModal").modal("show");
		});
	</script>
<?php endif; ?>

<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/footer-ib.php'); ?>