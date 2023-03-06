<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/dashboardv2/dashboard_header.php'); ?>
<link rel="icon" type="image/x-icon" href="newAssets/fav.ico">
<?php

$_SESSION['previous_page'] = $_SESSION['current_page'];
$_SESSION['current_page'] = 16;
require_once($_SERVER['DOCUMENT_ROOT'] . '/state_control.php');

// mail id
$idM = $_GET['id'];
if ($idM == null) {
	header("Location:" . base_url() . "dashboardv2/mailbox.php");
}

$message2 = $dbconn->prepare("SELECT * FROM MESSAGE WHERE COMPANY = ? AND ID= ?");
$message2->bind_param("ii", getSession('id_company'), $idM);
$message2->execute();
$itemMessage2 = $message2->get_result()->fetch_assoc();

if ($itemMessage2 == null) {
	header("Location:" . base_url() . "dashboardv2/mailbox.php");
}

$updateMessage = $dbconn->prepare("UPDATE MESSAGE SET IS_READ = 1 WHERE COMPANY = ? AND ID= ?");
$updateMessage->bind_param("ii", getSession('id_company'), $idM);
$updateMessage->execute();
$dbconn->commit();

$billing_date = $dbconn->prepare("SELECT * FROM BILLING WHERE COMPANY = ? ORDER BY ID DESC LIMIT 1");
$billing_date->bind_param("i", getSession('id_company'));
$billing_date->execute();
$bill_date = $billing_date->get_result()->fetch_assoc();
$billing_date->close();

$welcome = "Welcome to newuniverse.io!";
$payment = "Payment Notice";
$due_date = "Due Date Reminder";
$overdue = "Overdue Notice";
$cutoff_date = "Cut Off Date Reminder";
$terminate = "Service Termination Notice";
$subscribe = "Subscription Activation";

// $trial = "Reminder: Your trial has expired";
// $payment= "Payment Success";

//welcome
$message1 = "Hey there, <br>
			Welcome!<br><br>
			newuniverse.io helps companies to embed Contact Center,

			Livestreaming, Push Notifications, Instant Messaging, Video and VoIP Calling Features <br> into their mobile apps so that they could stay connected with their applications users.<br>
			<br>
			Here are some resources to help get you started: <a href='/guide/index'>Quick Start Guides</a>
			<br>
			We can’t wait to see what you've build!
			<br>
			<br>
			Thank you.<br>
			With Regards<br>
			newuniverse.io<br>
			";

// subscribe active
$message11 = "Dear User,

Thank you for activating your subscription to newuniverse.io!<br><br>
Currently, you have access to all of our API services and we hope that you will be enjoying our best services. Just as a reminder, to avoid any inconveniences please remember to always pay your subscription on time. Best of Luck.
<br>
<br>
Thank you.<br>
With Regards<br>
newuniverse.io<br>";

//due date reminder
$message6 = "Dear User...<br>
			Due Date Reminder:<br>
			To continue using our services, you have to make a repayment on " . $bill_date['DUE_DATE'] . ".
			<br>
			Thank you.<br>
			With Regards<br>
			newuniverse.io<br>
			";

//overdue notice
$message3 = "Dear User...<br>
			Overdue Reminder:<br>
			Your package has entered a grace period, make sure to finish your payment to continue using our services.
			<br>
			Thank you.<br>
			With Regards<br>
			newuniverse.io<br>
			";

//cut off date reminder
$message4 = "Dear User...<br>
			Cut Off Date Reminder:<br>
			Your package has entered a grace period, and will be terminated on " . $bill_date['DUE_DATE'] . ".
			<br>
			Thank you.<br>
			With Regards<br>
			newuniverse.io<br>
			";

//termination notice
$message5 = "Dear User...<br>
			Your package has been terminated on " . $bill_date['DUE_DATE'] . ".
			<br>
			If you are interested in using our services again,
			<br>
			Thank you.<br>
			With Regards<br>
			newuniverse.io<br>
			";

//payment notice
$message2 = "Dear User...<br>
			You haven't paid for your package, if you are interested in using our services please finish your payment.
			<br>
			Thank you.<br>
			With Regards<br>
			newuniverse.io<br>
			";
// $message3 = "Dear user...<br>
// 	Trial Reminder:<br>
// 	Your trial will end on
// 	";
// $message4 = "Dear user...<br>
// 	Payment Reminder:<br>
// 	Your services will end on
// 	";
$nextMessage34 = ". Make sure to finish your payment to continue using our services.<br>
			<br>If you have already paid your dues, please ignore this message.
			<br>
			Thank you.<br>
			Regards's<br>
			newuniverse.io<br>";

// $message5 = "Dear user...<br>
// 	Thank you for your payment transaction on ";
$nextMessage5 = "  <br>
			Currently, you have access to all of our API services and we hope that you will be enjoying our best services. To avoid any inconveniences please pay your service bill on the due date in the future. Best of Luck.
			<br>
			<br>
			Thank you.<br>
			With Regards<br>
			newuniverse.io<br>
			";
?>

<style>
	@media only screen and (min-width: 600px) {
		.pull {
			float: right;
		}
	}
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<span class="card-name" style="font-size:1.5rem; margin-right: 1rem;"><strong id="read-mail-text">Read Mail</strong></span>
					<a href="mailbox.php"><span style="font-family:'Josefin Sans',sans-serif;">&lt;&lt; <span id="back-inbox-text">Back to Inbox</span></span></a>
					<div class="card" id="inbox">
						<div class="card-header">
							<div class="row">
								<div class="col-12 col-md-6">
									<h4>
										<?php
										if ($itemMessage2['M_ID'] == 1) echo $welcome;
										else if ($itemMessage2['M_ID'] == 11) echo $subscribe;
										else if ($itemMessage2['M_ID'] == 6) echo $due_date;
										else if ($itemMessage2['M_ID'] == 2) echo $payment;
										else if ($itemMessage2['M_ID'] == 3) echo $overdue; //substr($message3, 0, 12)."...[TRIAL]";
										else if ($itemMessage2['M_ID'] == 4) echo $cutoff_date; //substr($message4, 0, 12)."...[DUE DATE]";
										else if ($itemMessage2['M_ID'] == 5) echo $terminate; //substr($message5, 0, 12)."...[PAYMENT]";
										?>
									</h4>
									<h5 id="from-newuniverse">From: support@newuniverse.io</h5>
								</div>
								<div class="col-12 col-md-6 mt-4">
									<h5 class="pull">
										<?php
										$dateNtime = $itemMessage2['MESSAGE_DATE'];
										$newDate = date("d F Y H:i", strtotime($dateNtime));
										echo $newDate;
										?>
									</h5>
								</div>
							</div>
						</div>
						<div class="card-body">
							<p id="msg-body">
								<?php
								$dataDesc = explode("|", $itemMessage2['MESSAGE_DESC']);
								$dataDesc2 = strtotime($dataDesc[1]);

								$dataAmount = explode("|", $itemMessage2['MESSAGE_DESC']);
								$dataDate = $itemMessage2['MESSAGE_DATE'];
								$dataDate2 = strtotime($dataDate[1]);


								if ($itemMessage2['M_ID'] == 1) echo $message1;
								else if ($itemMessage2['M_ID'] == 2) echo $message2;
								else if ($itemMessage2['M_ID'] == 11) echo $message11;
								else if ($itemMessage2['M_ID'] == 3) echo $message3;
								else if ($itemMessage2['M_ID'] == 4) echo $message4;
								else if ($itemMessage2['M_ID'] == 5) echo $message5;
								else if ($itemMessage2['M_ID'] == 6) echo $message6;
								?>
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /.content-wrapper -->

<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/dashboardv2/dashboard_footer.php'); ?>

<script>
	var _0x2522 = ['a.nav-link[href=\x22billpayment.php\x22]', '1pXPPvL', '23UJSImY', 'a.nav-link[href=\x22usage.php\x22]', '99129qVGjnO', 'active', '374037sDlapl', 'a.nav-link[href=\x22index.php\x22]', '395113yOiTJN', 'removeClass', '6guKYSg', '470ERqtlz', '627409dLRBRr', 'a.nav-link[href=\x22support.php\x22]', '234994ntMDOC', '739PrUwvP', '25966YFjKSq', 'a.nav-link[href=\x22mailbox.php\x22]', 'addClass', 'ready'];
	var _0x8bc1 = function(_0x9fc769, _0x23e1f2) {
		_0x9fc769 = _0x9fc769 - 0xcf;
		var _0x252241 = _0x2522[_0x9fc769];
		return _0x252241;
	};
	var _0x193d54 = _0x8bc1;
	(function(_0x41166a, _0x356e44) {
		var _0x343f64 = _0x8bc1;
		while (!![]) {
			try {
				var _0x63ac9c = -parseInt(_0x343f64(0xdc)) + -parseInt(_0x343f64(0xd0)) * parseInt(_0x343f64(0xde)) + parseInt(_0x343f64(0xcf)) * parseInt(_0x343f64(0xd6)) + parseInt(_0x343f64(0xd4)) + parseInt(_0x343f64(0xd8)) * -parseInt(_0x343f64(0xd2)) + parseInt(_0x343f64(0xdd)) * parseInt(_0x343f64(0xd9)) + parseInt(_0x343f64(0xda));
				if (_0x63ac9c === _0x356e44) break;
				else _0x41166a['push'](_0x41166a['shift']());
			} catch (_0x3cf872) {
				_0x41166a['push'](_0x41166a['shift']());
			}
		}
	}(_0x2522, 0x4d5e7), $(document)[_0x193d54(0xe1)](function() {
		var _0x13ea3b = _0x193d54;
		$(_0x13ea3b(0xe2))['removeClass'](_0x13ea3b(0xd3)), $(_0x13ea3b(0xd5))['removeClass'](_0x13ea3b(0xd3)), $(_0x13ea3b(0xd1))[_0x13ea3b(0xd7)](_0x13ea3b(0xd3)), $(_0x13ea3b(0xdb))[_0x13ea3b(0xd7)](_0x13ea3b(0xd3)), $(_0x13ea3b(0xdf))[_0x13ea3b(0xe0)](_0x13ea3b(0xd3));
	}));
</script>

<script>
	//   $('#lang-nav').hover(function(){  
	//     $('#lang-menu').dropdown("show");
	//     }, function(){
	//     $('#lang-menu').dropdown("hide");
	//   });

	//   $('#lang-menu').hover(function(){
	//     $('#lang-menu').dropdown("show");
	//     }, function(){
	//     $('#lang-menu').dropdown("hide");
	//   });

	if (localStorage.lang == 1) {

		<?php
		function indonesiaDate($tanggal)
		{
			$bulan = array(
				1 => 'Januari',
				'Februari',
				'Maret',
				'April',
				'Mei',
				'Juni',
				'Juli',
				'Agustus',
				'September',
				'Oktober',
				'November',
				'Desember'
			);
			$pecahkan = explode('-', $tanggal);
			return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
		}

		if ($itemMessage2['M_ID'] == 1) {
		?>
			var message1_ID = `Halo, <br>
			Selamat Datang!<br><br>
			newuniverse.io membantu perusahaan untuk menanamkan Fitur <i>Contact Center</i>,

			<i>Livestreaming</i>, <i>Push Notifications</i>, <i>Instant Messaging</i>, <i>Video</i> dan <i>VoIP Calling</i> <br> ke dalam aplikasi seluler agar mereka dapat tetap terhubung dengan pengguna aplikasi mereka.<br>
			<br>
			Berikut adalah berbagai sumber untuk membantu anda memulai menggunakan aplikasi: <a href='/guide/index'>panduan Memulai Cepat</a>
			<br>
			Kami tidak dapat menunggu untuk melihat apa yang telah anda bangun!
			<br>
			<br>
			Terima kasih.<br>
			Dengan Hormat<br>
			newuniverse.io<br>`;
			$("#msg-body").html(message1_ID);
		<?php
		} else if ($itemMessage2['M_ID'] == 2) {
		?>
			var message2_ID = `Untuk Pengguna...<br>
			Anda belum membayar untuk paket anda, jika anda tertarik untuk menggunakan layanan kami mohon selesaikan pembayaran anda.<br>
			Terima kasih.<br>
			Dengan Hormat<br>
			newuniverse.io<br>`;
			$("#msg-body").html(message2_ID);
		<?php
		} else if ($itemMessage2['M_ID'] == 3) {
		?>
			var message3_ID = `Untuk Pengguna...<br>
			Pengingat Keterlambatan:<br>
			Paket anda telah memasuki masa tenggang, harap pastikan untuk menyelesaikan pembayaran anda untuk melanjutkan menggunakan layanan kami.<br>
			Terima kasih.<br>
			Dengan Hormat<br>
			newuniverse.io`;
			$("#msg-body").html(message3_ID);
		<?php
		} else if ($itemMessage2['M_ID'] == 4) {
		?>
			var mail_dueDate = '<?= $bill_date['DUE_DATE'] ?>';
			var message4_ID = `Untuk Pengguna...<br>
			Pengingat Tanggal Pemotongan:<br>
			Paket anda telah memasuki masa tenggang, dan akan berakhir pada ` + mail_dueDate + `.<br>Terima kasih.<br>
			Dengan Hormat<br>
			newuniverse.io<br>`;
			$("#msg-body").html(message4_ID);
		<?php
		} else if ($itemMessage2['M_ID'] == 5) {
		?>
			var mail_dueDate = '<?= $bill_date['DUE_DATE'] ?>';
			var message5_ID = `Untuk Pengguna...<br>
			Paket anda telah berakhir pada ` + mail_dueDate + `.<br>
			Jika anda tertarik untuk menggunakan layanan kami lagi,<br>
			Terima kasih.<br>
			Dengan Hormat<br>
			newuniverse.io<br>`;
			$("#msg-body").html(message5_ID);
		<?php
		} else if ($itemMessage2['M_ID'] == 6) {
		?>
			var mail_dueDate = '<?= $bill_date['DUE_DATE'] ?>';
			var message6_ID = `Untuk Pengguna...<br>
			Pengingat Tanggal Jatuh Tempo:<br>
			Untuk melanjutkan menggunakan layanan kami, anda harus melakukan pembayaran kembali pada ` + mail_dueDate + `.<br>
			Terima kasih.<br>
			Dengan Hormat<br>
			newuniverse.io<br>`;
			$("#msg-body").html(message6_ID);
		<?php
		}
		?>

		var indonesiaDate = '<?php echo indonesiaDate(date("Y H:i -m-d", strtotime($itemMessage2['MESSAGE_DATE']))); ?>';

		$("#from-newuniverse").text("Dari: support@newuniverse.io");
		$('#back-inbox-text').text("Kembali ke kotak surat");
		$('#read-mail-text').text("Baca Surat");
		$(".pull-right").text(indonesiaDate);
	}

	$("#change-lang-EN").click(function() {

		var englishDate = '<?php echo date("d F Y H:i", strtotime($itemMessage2['MESSAGE_DATE'])); ?>';
		<?php
		if ($itemMessage2['M_ID'] == 1) {
		?>
			var message1_EN = `Hey there, <br>
				Welcome!<br><br>
				newuniverse.io helps companies to embed Contact Center,

				Livestreaming, Push Notifications, Instant Messaging, Video and VoIP Calling Features <br> into their mobile apps so that they could stay connected with their applications users.<br>
				<br>
				Here are some resources to help get you started: <a href='/guide/index'>Quick Start Guides</a>
				<br>
				We can’t wait to see what you've build!
				<br>
				<br>
				Thank you.<br>
				With Regards<br>
				newuniverse.io<br>`;
			$("#msg-body").html(message1_EN);
		<?php
		} else if ($itemMessage2['M_ID'] == 2) {
		?>
			var message2_EN = `Dear User...<br>
				You haven't paid for your package, if you are interested in using our services please finish your payment.
				<br>
				Thank you.<br>
				With Regards<br>
				newuniverse.io<br>`;
			$("#msg-body").html(message2_EN);
		<?php
		} else if ($itemMessage2['M_ID'] == 3) {
		?>
			var message3_EN = `Dear User...<br>
				Overdue Reminder:<br>
				Your package has entered a grace period, make sure to finish your payment to continue using our services.
				<br>
				Thank you.<br>
				With Regards<br>
				newuniverse.io<br>`;
			$("#msg-body").html(message3_EN);
		<?php
		} else if ($itemMessage2['M_ID'] == 4) {
		?>
			var mail_dueDate = '<?= $bill_date['DUE_DATE'] ?>';
			var message4_EN = `Dear User...<br>
				Cut Off Date Reminder:<br>
				Your package has entered a grace period, and will be terminated on ` + mail_dueDate + `.
				<br>
				Thank you.<br>
				With Regards<br>
				newuniverse.io<br>`;
			$("#msg-body").html(message4_EN);
		<?php
		} else if ($itemMessage2['M_ID'] == 5) {
		?>
			var mail_dueDate = '<?= $bill_date['DUE_DATE'] ?>';
			var message5_EN = `Dear User...<br>
				Your package has been terminated on ` + mail_dueDate + `.
				<br>
				If you are interested in using our services again,
				<br>
				Thank you.<br>
				With Regards<br>
				newuniverse.io<br>`;
			$("#msg-body").html(message5_EN);
		<?php
		} else if ($itemMessage2['M_ID'] == 6) {
		?>
			var mail_dueDate = '<?= $bill_date['DUE_DATE'] ?>';
			var message6_EN = `Dear User...<br>
				Due Date Reminder:<br>
				To continue using our services, you have to make a repayment on ` + mail_dueDate + `.
				<br>
				Thank you.<br>
				With Regards<br>
				newuniverse.io<br>`;
			$("#msg-body").html(message6_EN);
		<?php
		}
		?>
		localStorage.lang = 0;
		$("#from-newuniverse").text("From: support@newuniverse.io");
		$("#lang-nav").text('EN');
		$('#back-inbox-text').text("Back to Inbox");
		$('#read-mail-text').text("Read Mail");
		$(".pull-right").text(englishDate);
		change_lang();
	});

	$("#change-lang-ID").click(function() {

		<?php
		function dateOfIndonesia($tanggal)
		{
			$bulan = array(
				1 => 'Januari',
				'Februari',
				'Maret',
				'April',
				'Mei',
				'Juni',
				'Juli',
				'Agustus',
				'September',
				'Oktober',
				'November',
				'Desember'
			);
			$pecahkan = explode('-', $tanggal);
			return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
		}

		if ($itemMessage2['M_ID'] == 1) {
		?>
			var message1_ID = `Halo, <br>
				Selamat Datang!<br><br>
				newuniverse.io membantu perusahaan untuk menanamkan Fitur <i>Contact Center</i>,
		
				<i>Livestreaming</i>, <i>Push Notifications</i>, <i>Instant Messaging</i>, <i>Video</i> dan <i>VoIP Calling</i> <br> ke dalam aplikasi seluler agar mereka dapat tetap terhubung dengan pengguna aplikasi mereka.<br>
				<br>
				Berikut adalah berbagai sumber untuk membantu anda memulai menggunakan aplikasi: <a href='/guide/index'>panduan Memulai Cepat</a>
				<br>
				Kami tidak dapat menunggu untuk melihat apa yang telah anda bangun!
				<br>
				<br>
				Terima kasih.<br>
				Dengan Hormat<br>
				newuniverse.io<br>`;
			$("#msg-body").html(message1_ID);
		<?php
		} else if ($itemMessage2['M_ID'] == 2) {
		?>
			var message2_ID = `Untuk Pengguna...<br>
				Anda belum membayar untuk paket anda, jika anda tertarik untuk menggunakan layanan kami mohon selesaikan pembayaran anda.<br>
				Terima kasih.<br>
				Dengan Hormat<br>
				newuniverse.io<br>`;
			$("#msg-body").html(message2_ID);
		<?php
		} else if ($itemMessage2['M_ID'] == 3) {
		?>
			var message3_ID = `Untuk Pengguna...<br>
				Pengingat Keterlambatan:<br>
				Paket anda telah memasuki masa tenggang, harap pastikan untuk menyelesaikan pembayaran anda untuk melanjutkan menggunakan layanan kami.<br>
				Terima kasih.<br>
				Dengan Hormat<br>
				newuniverse.io`;
			$("#msg-body").html(message3_ID);
		<?php
		} else if ($itemMessage2['M_ID'] == 4) {
		?>
			var mail_dueDate = '<?= $bill_date['DUE_DATE'] ?>';
			var message4_ID = `Untuk Pengguna...<br>
				Pengingat Tanggal Pemotongan:<br>
				Paket anda telah memasuki masa tenggang, dan akan berakhir pada ` + mail_dueDate + `.<br>Terima kasih.<br>
				Dengan Hormat<br>
				newuniverse.io<br>`;
			$("#msg-body").html(message4_ID);
		<?php
		} else if ($itemMessage2['M_ID'] == 5) {
		?>
			var mail_dueDate = '<?= $bill_date['DUE_DATE'] ?>';
			var message5_ID = `Untuk Pengguna...<br>
				Paket anda telah berakhir pada ` + mail_dueDate + `.<br>
				Jika anda tertarik untuk menggunakan layanan kami lagi,<br>
				Terima kasih.<br>
				Dengan Hormat<br>
				newuniverse.io<br>`;
			$("#msg-body").html(message5_ID);
		<?php
		} else if ($itemMessage2['M_ID'] == 6) {
		?>
			var mail_dueDate = '<?= $bill_date['DUE_DATE'] ?>';
			var message6_ID = `Untuk Pengguna...<br>
				Pengingat Tanggal Jatuh Tempo:<br>
				Untuk melanjutkan menggunakan layanan kami, anda harus melakukan pembayaran kembali pada ` + mail_dueDate + `.<br>
				Terima kasih.<br>
				Dengan Hormat<br>
				newuniverse.io<br>`;
			$("#msg-body").html(message6_ID);
		<?php
		}
		?>

		var indonesiaDate = '<?php echo dateOfIndonesia(date("Y H:i -m-d", strtotime($itemMessage2['MESSAGE_DATE']))); ?>';

		localStorage.lang = 1;
		$("#from-newuniverse").text("Dari: support@newuniverse.io");
		$("#lang-nav").text('ID');
		$('#back-inbox-text').text("Kembali ke kotak surat");
		$('#read-mail-text').text("Baca Surat");
		$(".pull-right").text(indonesiaDate);
		change_lang();
	});
</script>