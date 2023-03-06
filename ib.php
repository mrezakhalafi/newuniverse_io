<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/header-ib.php'); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/header-ib-meta.php'); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/ib-nav.php'); ?>
<?php session_start(); ?>

<style>
	@media (max-width: 600px) {
		.store {
			max-width: 125px !important;
		}
	}

	@media screen and (min-width: 1367px) {
		#row-connect {
			margin: 3rem 0 !important;
		}

		#row-embed {
			padding: 3rem 0 !important;
			margin-top: 10rem;
		}

		#p-embed {
			margin: 1.5rem 0 !important;
		}

		#main-col {
			flex: 0 0 58.333333% !important;
			max-width: 58.333333% !important;
		}


		.fs-35 {
			font-size: 43px !important;
		}
	}

	@media screen and (min-width:768px) {
		.btn-m-top {
			margin-top: 3rem !important;
		}

		.btn-smaller {
			font-size: 1rem !important;
		}
	}

	@media screen and (max-width:1366px) {
		#sales-line {
			font-size: 24px !important;
		}
	}


	@media screen and (min-width:601px) {
		#bg-index-alt {
			background-color: #f2ad33;
			background-image: url('../newAssets/banner awal-01.jpg');
		}
	}

	@media screen and (max-width:600px) {
		#main-col {
			flex: 0 0 80% !important;
			max-width: 80% !important;
		}
	}
</style>

<script type="text/javascript" src="<?php echo base_url(); ?>countdown.js"></script>

<script>
	// countdown script
	// Set the date we're counting down to
	var countDownDate = new Date(countdown_time).getTime();

	// Update the count down every 1 second
	var x = setInterval(function() {

		// Get today's date and time
		var now = new Date().getTime();

		// Find the distance between now and the count down date
		var distance = countDownDate - now;

		// Time calculations for days, hours, minutes and seconds
		var days = Math.floor(distance / (1000 * 60 * 60 * 24));
		var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
		var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
		var seconds = Math.floor((distance % (1000 * 60)) / 1000);

		// Output the result in an element with id="demo"
		document.getElementById("daysmodal").innerHTML = days + "Days";
		document.getElementById("hoursmodal").innerHTML = hours;
		document.getElementById("minutesmodal").innerHTML = minutes;
		document.getElementById("secondsmodal").innerHTML = seconds;

		// If the count down is over, write some text
		if (distance < 0) {
			clearInterval(x);
			document.getElementById("exlabelmodal").style.display = "none";
			document.getElementById("excountdownmodal").style.display = "none";
		}
	}, 1000);
</script>

<style>
	@media screen and (min-width: 1367px) {
		#row-connect {
			margin: 4rem 0 !important;
			/* margin: 3rem 0 !important; */
		}

		#row-embed {
			padding: 4rem 0 !important;
			/* padding: 3rem 0 !important; */
		}

		#p-embed {
			margin: 2rem 0 !important;
			/* margin: 1.5rem 0 !important; */
		}

		#main-col {
			flex: 0 0 66.666667% !important;
			max-width: 66.666667% !important;
		}

		.fs-35 {
			font-size: 43px !important;
		}
	}

	@media screen and (min-width:768px) {
		.btn-m-top {
			margin-top: 3rem !important;
		}

		.btn-smaller {
			font-size: 1rem !important;
		}
	}

	@media screen and (min-width:601px) and (max-width:1366px) {
		#sales-line {
			font-size: 24px !important;
		}

		#main-col {
			flex: 0 0 50% !important;
			max-width: 50% !important;
		}

		#p-embed {
			/* margin: 4rem 0 !important; */
			/* margin: 1.5rem 0 !important; */
			padding-top: 5rem;
		}

		.product-desc {
			font-size: 20px !important;
		}
	}

	@media screen and (min-width:769px) {
		#mobile-img {
			display: none !important;
		}
	}

	.color-green {
		color: #01686d;
	}

	.color-yellow {
		color: #f2ad33;
	}

	.fa-circle {
		font-size: 10px;
		font-weight: 500;
	}

	@media (max-width:576px) {
		#header {
			font-size: 28px !important;
		}
	}

	@media (min-width:768px) {
		#header {
			font-size: 36px !important;
		}
	}

	@media (min-width:1024px) {
		#header {
			font-size: 43px !important;
		}
	}
</style>

<header id="bg-index-alt">
	<div class="container pt-4 pb-5">
		<div class="row justify-content-center py-3 my-5">
			<div class="col-md-5 py-5" id="main-col">
				<div class="row text-center" id="row-connect">
					<div class="col-12">
						<p class="fontRobBold" style="color:#262626;" id="header">Media Komunikasi Terpadu!
						</p>
					</div>
				</div>
				<div class="row text-center" id="mobile-img">
					<div class="col-12">

						<img src="<?php echo base_url(); ?>newAssets/homepage/banner-img-mbl.png" style="max-height: 300px;" />
					</div>
				</div>
				<div class="row text-center" id="row-embed">
					<div class="col-12">

						<p class="fontRobReg fs-32 mt-3" id="p-embed" style="color:#262626; font-size: 20px;">Aplikasi <strong>media sosial</strong> dengan <strong>media komunikasi terpadu</strong> yang memadukan suara, video, pesan instan dan email ke dalam satu aplikasi yang mudah digunakan dengan keamanan data yang terjamin. </p>
					</div>
				</div>
				<div class="row justify-content-center">
					<div class="col-12 mx-auto text-center">
						<a href='https://play.google.com/store/apps/details?id=io.newuniverse.IndonesiaBisa&hl=en_US&pcampaignid=pcampaignidMKT-Other-global-all-co-prtnr-py-PartBadge-Mar2515-1'><img alt='Get it on Google Play' src='https://play.google.com/intl/en_us/badges/static/images/badges/en_badge_web_generic.png' style='max-width: 200px;' /></a>
						<img class="mx-auto store" src="ucaas_assets\img\app_store_editedx.png" style="max-width:185px; height: 52px;">
					</div>
				</div>
			</div>
		</div>
	</div>
</header>

<?php //require_once($_SERVER['DOCUMENT_ROOT'] . '/fabmsg.php'); 
?>

<!-- <div class="container-fluid my-5 py-3">

	<div class="row justify-content-center text-center m-0">
		<div class="col-md-10">
			
			<p class="fs-30" id="sales-line" style="font-family: 'Work Sans'; font-style:italic; color:#01686d;">Why bother going through third parties
				and <strong style="color:#f2ad33;">risking customer data privacy</strong> when you can engage with your customer directly?<br>
				It’s Your <strong style="color:#f2ad33;">Business</strong>. Your <strong style="color:#f2ad33;">Customer</strong>. Your <strong style="color:#f2ad33;">App</strong>. Now, it’s your turn to fully <strong style="color:#f2ad33;">own</strong> them.</p>
		</div>
	</div>
</div> -->

<div class="container-fluid" id="features-list">
	<div class="row justify-content-center bg-light my-auto" data-aos="fade-left">
		<div class="col-md-11">
			<div class="row">
				<div class="col-md-5 order-md-1 text-center mx-auto">
					<!-- <img src="<?php echo base_url(); ?>newAssets/homepage/livestreaming.gif" class="img-fluid ls"> -->
					<video src="livestreaming.mp4" type="video/mp4" playsinline autoplay muted loop style="max-height: 500px;"></video>

				</div>
				<div class="col-md-5 order-md-2 features-desc my-auto mx-auto">
					<h2 class="fontRobBold fs-35 color-green">Video Streaming Langsung</h2>
					<br>
					<h3 class="fs-24 fontRobReg product-desc">
						<i class="fa fa-circle"></i> Siarkan dan jelajahi dunia melalui video streaming langsung. Lihat berita,
						kunjungi tempat baru, atau
						bertemu orang dan berbagi minat -
						semuanya secara langsung dan interaktif.
					</h3>
					<h3 class="fs-24 fontRobReg product-desc">
						<i class="fa fa-circle"></i> Temukan berbagai video streaming langsung dari pengguna lain dan saling
						berinteraksi melalui komentar.
					</h3>
					<h3 class="fs-24 fontRobReg product-desc">
						<i class="fa fa-circle"></i> Siarkan secara pribadi ke teman atau secara publik.
					</h3>
					<!-- <div class="btn-m-top ">
						<button class="btn nav-menu-btn-alt shadow m-2 btn-smaller" onclick="pindah('livestream.php')">Learn More</button>
						<?php //if (!isset($_SESSION['id_company'])) { 
						?>
							<button class="btn nav-menu-btn-wht-alt shadow m-2 btn-smaller" onclick="pindah('sign_up.php')">Sign Up</button>
						<?php //} 
						?>
					</div> -->
				</div>

			</div>
		</div>
	</div>
	<div class="row justify-content-center my-auto" data-aos="fade-right">
		<div class="col-md-11">
			<div class="row">
				<div class="col-md-5 order-md-2  text-center mx-auto">
					<img src="<?php echo base_url(); ?>newAssets/homepage/video-call.gif" class="img-fluid">
					<!-- <video src="<?php echo base_url(); ?>newAssets/homepage/video-call.gif" playsinline autoplay muted loop style="max-height: 500px;"></video> -->
					<!-- <source src="videocall.mp4" type="video/mp4"> -->
					<!-- </video> -->
				</div>
				<div class="col-md-5 order-md-1 features-desc my-auto mx-auto">
					<h2 class="fontRobBold fs-35 color-green">Panggilan Video</h2>
					<br>
					<h3 class="fs-24 fontRobReg product-desc mb-4">
						Jangan hanya mendengar, lihatlah!
					</h3>
					<h3 class="fs-24 fontRobReg product-desc">
						Berkumpul dengan 1 atau 16 teman dan keluarga melalui panggilan video. Tonton semua orang tersenyum dan menangis ketika memberitahu mereka kabar pernikahanmu.
					</h3>
					<!-- <div class="btn-m-top">
						<button class="btn nav-menu-btn-alt shadow m-2 btn-smaller" onclick="pindah('videocall.php')">Learn More</button>
						<?php //if (!isset($_SESSION['id_company'])) { 
						?>
							<button class="btn nav-menu-btn-wht-alt shadow m-2 btn-smaller" onclick="pindah('sign_up.php')">Sign Up</button>
						<?php //} 
						?>
					</div> -->
				</div>
			</div>
		</div>
	</div>
	<div class="row justify-content-center bg-light" data-aos="fade-left">
		<div class="col-md-11">
			<div class="row">
				<div class="col-md-5 order-md-1  text-center mx-auto">
					<img src="<?php echo base_url(); ?>newAssets/homepage/audiocall.png" class="img-fluid ac">
				</div>
				<div class="col-md-5 order-md-2 features-desc my-auto mx-auto">
					<h2 class="fontRobBold fs-35 color-green">Panggilan Suara</h2>
					<br>
					<h3 class="fs-24 mb-4 fontRobReg product-desc">
						Malu untuk tampil didepan kamera?
					</h3>
					<h3 class="fs-24 fontRobReg product-desc">
						Kamu dapat melakukan panggilan suara ke satu sampai dengan 16 orang menggunakan IndonesiaBisa.
					</h3>
					<!-- <div class="btn-m-top">
						<button class="btn nav-menu-btn-alt shadow m-2 btn-smaller" onclick="pindah('audiocall.php')">Learn More</button>
						<?php //if (!isset($_SESSION['id_company'])) { 
						?>
							<button class="btn nav-menu-btn-wht-alt shadow m-2 btn-smaller" onclick="pindah('sign_up.php')">Sign Up</button>
						<?php //} 
						?>
					</div> -->
				</div>
			</div>
		</div>
	</div>
	<div class="row justify-content-center my-auto" data-aos="fade-right">
		<div class="col-md-10">
			<div class="row">
				<div class="col-md-5 order-md-2 text-center mx-auto">
					<img src="<?php echo base_url(); ?>newAssets/homepage/unifiedmessaging.png" class="img-fluid um">
				</div>
				<div class="col-md-5 order-md-1 features-desc my-auto mx-auto">
					<h2 class="fontRobBold fs-35 color-green">Pesan Instan & Email Terintegrasi</h2>
					<br>
					<h3 class="fs-24 fontRobReg product-desc">
						<i class="fa fa-circle"></i>
						Kamu dapat membuat grup diskusi hingga 100.000 anggota.
					</h3>
					<h3 class="fs-24 fontRobReg product-desc">
						<i class="fa fa-circle"></i>
						Berbagi media, video, dan dokumen 'apapun' hingga 50 MB.
					</h3>
					<h3 class="fs-24 fontRobReg product-desc">
						<i class="fa fa-circle"></i> Email Terintegrasi untuk kemudahan komunikasi terpadu melalui satu layar aplikasi.
					</h3>
					<!-- <div class="btn-m-top">
						<button class="btn nav-menu-btn-alt shadow m-2 btn-smaller" onclick="pindah('instantmessaging.php')">Learn More</button>
						<?php //if (!isset($_SESSION['id_company'])) { 
						?>
							<button class="btn nav-menu-btn-wht-alt shadow m-2 btn-smaller" onclick="pindah('sign_up.php')">Sign Up</button>
						<?php //} 
						?>
					</div> -->
				</div>
			</div>
		</div>
	</div>
	<!-- <div class="row justify-content-center bg-light my-auto" data-aos="fade-left">
		<div class="col-md-10">
			<div class="row">
				<div class="col-md-5 order-md-1 text-center mx-auto">
					<img src="<?php echo base_url(); ?>newAssets/homepage/screensharing.png" class="img-fluid um">
				</div>
				<div class="col-md-5 order-md-2 features-desc my-auto mx-auto">
					<h2 class="fontRobBold fs-35 color-green">Screen Sharing</h2>
					<br>
					<h3 class="fs-24 fontRobReg product-desc">Allow users to share their screen with other users in real-time.</h3>
					<div class="btn-m-top">
						<button class="btn nav-menu-btn-alt shadow m-2 btn-smaller" onclick="pindah('screenshare.php')">Learn More</button>
						<?php //if (!isset($_SESSION['id_company'])) { 
						?>
							<button class="btn nav-menu-btn-wht-alt shadow m-2 btn-smaller" onclick="pindah('sign_up.php')">Sign Up</button>
						<?php //} 
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row justify-content-center my-auto" data-aos="fade-right">
		<div class="col-md-10">
			<div class="row">
				<div class="col-md-5 order-md-2 text-center mx-auto">
					<img src="<?php echo base_url(); ?>newAssets/homepage/chatbot.png" class="img-fluid cb">
				</div>
				<div class="col-md-5 order-md-1 features-desc my-auto mx-auto">
					<h2 class="fontRobBold fs-35 color-green">Chat-bot</h2>
					<br>
					<h3 class="fs-24 fontRobReg product-desc">Chat-bot can be trained to respond to customer's question faster than humans and at any time of the day.</h3>
					<div class="btn-m-top">
						<button class="btn nav-menu-btn-alt shadow m-2 btn-smaller" onclick="pindah('chatbot.php')">Learn More</button>
						<?php //if (!isset($_SESSION['id_company'])) { 
						?>
							<button class="btn nav-menu-btn-wht-alt shadow m-2 btn-smaller">Coming Soon</button>
						<?php //} 
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row justify-content-center my-auto py-4 bg-light" data-aos="fade-left">
		<div class="col-md-10">
			<div class="row">
				<div class="col-md-5 order-md-1 text-center mx-auto">
					<img src="<?php echo base_url(); ?>newAssets/homepage/whiteboarding.png" class="img-fluid wb">
				</div>
				<div class="col-md-5 order-md-2 features-desc my-auto mx-auto">
					<h2 class="fontRobBold fs-35 color-green">Whiteboard</h2>
					<br>
					<h3 class="fs-24 fontRobReg product-desc">A collaborative tool to facilitate communication by allowing users to write and sketch on a shared whiteboard space.</h3>
					<div class="btn-m-top">
						<button class="btn nav-menu-btn-alt shadow m-2 btn-smaller" onclick="pindah('whiteboard.php')">Learn More</button>
						<?php //if (!isset($_SESSION['id_company'])) { 
						?>
							<button class="btn nav-menu-btn-wht-alt shadow m-2 btn-smaller" onclick="pindah('sign_up.php')">Sign Up</button>
						<?php //} 
						?>
					</div>
				</div>
			</div>
		</div>
	</div> -->
</div>

<style>
	@media screen and (min-width:1367px) {
		#row-container {
			width: 90%;
		}

		#img-container {
			flex: 0 0 13%;
		}

		.img-centered {
			padding-left: 14rem !important;
		}
	}
</style>

<hr width="75%">

<style>
	#benefits {
		background-image: url('cu-bg.png');
	}

	.benefits-title {
		color: #007a87;
	}

	/* Small devices (landscape phones, 576px and up) */
	@media (max-width: 576px) {
		#benefits {
			background-size: contain;
			background-repeat: no-repeat;
			background-position: center;
			padding: 3rem 0;
		}

		h3.benefits-title {
			font-size: 20px;
		}

		.aman {
			font-size: 14px;
		}

		.text-container {
			margin-left: 7rem;
			padding: 0.75rem;
		}
	}

	/* Medium devices (tablets, 768px and up) */
	@media (min-width: 768px) {
		#benefits {
			background-size: cover;
			background-repeat: no-repeat;
			background-position: center;
			/* padding: 3rem 0; */
		}

		h3.benefits-title {
			font-size: 22px;
		}

		.aman {
			font-size: 18px;
		}

		.text-container {
			margin-left: 130px;
			padding: 7rem 0 7rem .75rem;
		}
	}

	/* Large devices (desktops, 992px and up) */
	@media (min-width: 992px) {}

	@media (min-width: 1200px) {
		#benefits {
			background-size: cover;
			background-repeat: no-repeat;
			background-position: center;
			/* padding: 3rem 0; */
		}

		h3.benefits-title {
			font-size: 23px;
		}

		.aman {
			font-size: 19.5px;
		}

		.text-container {
			margin-left: 150px;
			padding: 7rem .25rem 8rem .75rem;
		}
	}

	/* Extra large devices (large desktops, 1200px and up) */
	@media (min-width: 1367px) {
		#benefits {
			background-size: cover;
			background-repeat: no-repeat;
			background-position: center;
			/* padding: 3rem 0; */
		}

		.aman {
			font-size: 22px;
		}

		.text-container {
			margin-left: 225px;
			padding: 5rem 8.75rem 5rem 4.5rem;
		}
	}

	@media (min-width: 1440px) {
		#benefits {
			background-size: cover;
			background-repeat: no-repeat;
			background-position: center;
			/* padding: 3rem 0; */
		}

		.aman {
			font-size: 22px;
		}

		.text-container {
			margin-left: 165px;
			padding: 8rem .75rem 8rem 0;
		}
	}

	@media (min-width: 1920px) {
		#benefits {
			background-size: contain;
			background-repeat: no-repeat;
			background-position: center;
			/* padding: 3rem 0; */
		}

		.aman {
			font-size: 22px;
		}

		.text-container {
			margin-left: 225px;
			padding: 5rem 8.75rem 5rem 4.5rem;
		}
	}
</style>

<div class="container my-5 w-content">
	<div class="row">
		<div class="col-sm-12 col-md-8 col-lg-6 col-xl-5 mx-auto" id="benefits">
			<div class="text-container">
				<h3 class="fontRobBold benefits-title">Aman</h3>
				<p class="fontRobReg m-0 aman">
					<i class="fa fa-circle"></i> Tidak ada nomor telepon atau alamat email yang kami simpan.
				</p>
				<p class="fontRobReg mb-3 aman">
					<i class="fa fa-circle"></i> Penerapan enkripsi secara <span style="font-style:italic;">end-to-end</span> untuk menjamin keamanan data percakapan kamu.
				</p>
				<!-- <p class="fontRobReg m-0 aman">
					<i class="fa fa-circle"></i> Data kamu disimpan dengan aman, dan tidak digunakan untuk apapun selain pengembangan aplikasi.
				</p>
				<p class="fontRobReg m-0 aman">
					<i class="fa fa-circle"></i> Kami menjaga privasi kamu dengan serius dan tidak akan pernah memberikan akses pihak ketiga ke data kamu.
				</p> -->

				<h3 class="fontRobBold benefits-title">Buatan Indonesia</h3>
				<p class="fontRobReg m-0 aman">
					<i class="fa fa-circle"></i> Sepenuhnya dibangun oleh anak-anak Indonesia tanpa menggunakan komponen komunikasi milik pihak lain.
				</p>
				<p class="fontRobReg m-0 aman">
					<i class="fa fa-circle"></i> Server kami terletak di Indonesia.
				</p>
			</div>
		</div>
	</div>
</div>

<hr width="75%">

<!-- <div class="container-fluid my-4 py-4">
	<div class="row justify-content-center m-0">
		<div class="col-md-8">
			<div class="row justify-content-center text-center">
				<p class="fontRobBold fs-30">Worried about the price ? Pssst… We guarantee you our price is the cheapest in the market!</p>
			</div>
		</div>
	</div>
</div> -->

<!-- <hr width="75%"> -->

<script type="text/javascript">
	$(document).ready(function() {
		$(".owl-carousel").owlCarousel({
			autoplay: true,
			autoplayTimeout: 10000,
			loop: true,
			responsive: {
				0: {
					items: 1,
					nav: false
				},
				600: {
					items: 3,
					nav: false
				}
			}
		});
	});

	$('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
		if ($('#tl-1').hasClass('active')) {
			$('#ta-1').removeClass('d-none').addClass('d-tab');
			$('#ta-2, #ta-3, #ta-4, #ta-5, #ta-6, #ta-7').removeClass('d-tab').addClass('d-none');
		} else if ($('#tl-2').hasClass('active')) {
			$('#ta-2').removeClass('d-none').addClass('d-tab');
			$('#ta-1, #ta-3, #ta-4, #ta-5, #ta-6, #ta-7').removeClass('d-tab').addClass('d-none');
		} else if ($('#tl-3').hasClass('active')) {
			$('#ta-3').removeClass('d-none').addClass('d-tab');
			$('#ta-1, #ta-2, #ta-4, #ta-5, #ta-6, #ta-7').removeClass('d-tab').addClass('d-none');
		} else if ($('#tl-4').hasClass('active')) {
			$('#ta-4').removeClass('d-none').addClass('d-tab');
			$('#ta-1, #ta-2, #ta-3, #ta-5, #ta-6, #ta-7').removeClass('d-tab').addClass('d-none');
		} else if ($('#tl-5').hasClass('active')) {
			$('#ta-5').removeClass('d-none').addClass('d-tab');
			$('#ta-1, #ta-2, #ta-3, #ta-4, #ta-6, #ta-7').removeClass('d-tab').addClass('d-none');
		} else if ($('#tl-6').hasClass('active')) {
			$('#ta-6').removeClass('d-none').addClass('d-tab');
			$('#ta-1, #ta-2, #ta-3, #ta-4, #ta-5, #ta-7').removeClass('d-tab').addClass('d-none');
		} else if ($('#tl-7').hasClass('active')) {
			$('#ta-7').removeClass('d-none').addClass('d-tab');
			$('#ta-1, #ta-2, #ta-3, #ta-4, #ta-5, #ta-6').removeClass('d-tab').addClass('d-none');
		}
	})


	// $(".pindiv").pin({
	// 	containerSelector: ".pincontainer",
	// 	minWidth: 940,
	// 	padding: {
	// 		top: 200,
	// 		bottom: 100
	// 	}
	// });

	// $(document).ready(function(){
	// 	new $.Zebra_Pin($('#.pindiv'), {
	// 		contained: true,
	// 		top_spacing: 200
	// 	});
	// });
</script>

<script>
	var me = {};
	me.avatar = "http://c0185784a2b233b0db9b-d0e5e4adc266f8aacd2ff78abb166d77.r51.cf2.rackcdn.com/templates/img_profile.jpg";

	var you = {};
	you.avatar = "https://ngrok.com/static/img/twimg/AlyZVxzy_bigger.jpg";

	var today = new Date();
	var date = today.getFullYear() + today.getMonth() + today.getDate();
	var time = today.getHours() + today.getMinutes() + today.getSeconds();
	var dateTime = date + time;
	sessionStorage.setItem("unique_user", dateTime);
	var unique = sessionStorage.getItem("unique_user");

	function formatAMPM(date) {
		var hours = date.getHours();
		var minutes = date.getMinutes();
		var ampm = hours >= 12 ? 'PM' : 'AM';
		hours = hours % 12;
		hours = hours ? hours : 12; // the hour '0' should be '12'
		minutes = minutes < 10 ? '0' + minutes : minutes;
		var strTime = hours + ':' + minutes + ' ' + ampm;
		return strTime;
	}

	//-- No use time. It is a javaScript effect.
	function insertChat(who, text, time) {
		if (time === undefined) {
			time = 0;
		}
		var control = "";
		var date = formatAMPM(new Date());

		if (who == "me") {
			control = '<li style="width:100%">' +
				'<div>' +
				// '<div class="avatar"><img style="width:10%; margin: 10px; border-radius: 50%; float: right;" src="' + me.avatar + '" /></div>' +
				'<div class="text text-l" style="float: right; margin: 10px; max-width: 240px; min-width: 32px; text-align: right; padding: 4px 10px; background-color: #f2ad33; color: #fff; border-radius: 7px;">' +
				'<p style="margin-bottom: 0px;">' + text + '</p>' +
				'</div>' +
				'<div class="text text-l" style="float: right; margin: 10px;">' +
				'<small><p>' + date + '</p></small>' +
				'</div>' +
				'</div>' +
				'</li><br style="clear: both;">';
		} else {
			control = '<li style="width:100%">' +
				'<div>' +
				// '<div class="avatar"><img style="width:10%; margin: 10px; border-radius: 50%; float: left;" src="' + you.avatar + '" /></div>' +
				'<div class="text text-l" style="float: left; margin: 10px; max-width: 240px; min-width: 32px; text-align: left; padding: 4px 10px; background-color: #01686d; color: #fff; border-radius: 7px;">' +
				'<p style="margin-bottom: 0px;">' + text + '</p>' +
				'</div>' +
				'<div class="text text-l" style="float: left; margin: 10px;">' +
				'<small><p>' + date + '</p></small>' +
				'</div>' +
				'</div>' +
				'</li><br style="clear: both;">';
		}
		setTimeout(
			function() {
				$("#chat-ul").append(control).scrollTop($("#chat-ul").prop('scrollHeight'));
			}, time);

	}

	function resetChat() {
		$("#chat-ul").empty();
	}

	// $(".mytext").on("keydown", function(e){
	// 	if (e.which == 13){
	// 		var text = $(this).val();
	// 		if (text !== ""){
	// 			insertChat("me", text);
	// 			$(this).val('');
	// 		}
	// 	}
	// });

	// $('body > div > div > div:nth-child(2) > span').click(function(){
	// 	$(".mytext").trigger({type: 'keydown', which: 13, keyCode: 13});
	// })


	function submitMessage(text) {
		insertChat("me", text);
		sendMessage(text);
		$('#mytext').val('');
	}

	function sendMessage(text) {
		// submit form
		$.ajax({
			//url: '/?r=site/chatbot',
			url: '/chatservice.php',
			type: 'POST',
			dataType: 'json',
			contentType: 'application/json',
			data: JSON.stringify({
				"message": text,
				"sender": unique
			}),
			success: function(response) {
				//console.log(response.text);
				insertChat("you", response[0].text);
				// insertChat("you", JSON.stringify(response[0].recipient_id));
				// alert(JSON.stringify(response[0].text));
			},
			error: function(error) {
				insertChat("you", "Sorry. Something went wrong on the server.");
				// alert(JSON.stringify(response));
			}
		});
	}

	//-- Clear Chat
	//resetChat();

	$(document).ready(function() {
		$(".mytext").on("keyup", function(e) {
			if ((e.keyCode || e.which) == 13) {
				var text = $(this).val();
				if (text !== "") {
					submitMessage(text);
					$(this).val('');
				}
				$("#chatBody").animate({
					scrollTop: 20000000
				}, "slow");
			}
		});

		$("#sendchat").on("click", function(e) {
			var text = $('#mytext').val();
			if (text !== "") {
				submitMessage(text);
				$(this).val('');
			}
			$("#chatBody").animate({
				scrollTop: 20000000
			}, "slow");
		});
	});
	//-- NOTE: No use time on insertChat.
</script>

<script>
	// $('#QuestaoModal').on('hide.bs.modal', function () {
	//     // $('#exlabel').css("display","display");
	//     // $('#excountdown').css("display","display");
	//     alert(
	//         "hidden"
	//     );
	// });
</script>

<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/contact-ib.php');
?>

<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/footer-ib.php'); ?>