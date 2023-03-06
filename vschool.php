<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/header-alt.php'); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/header-alt-meta.php'); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/index-nav.php'); ?>
<?php 

    $_SESSION['previous_page'] = $_SESSION['current_page'];
    $_SESSION['current_page'] = 4;
   require_once($_SERVER['DOCUMENT_ROOT'] . '/state_control.php');

?>

<style>
	@media (min-width: 769px) {
		#bg-index-alt {
			background-image: url('../banner_ib.jpg') !important;
			background-size: cover;
		}
	}

	@media (max-width: 600px) {
		.store {
			max-width: 175px !important;
			margin-left: 13px;
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

		.ss-mbl {
			width: 45% !important;
			height: auto !important;
		}

		.head-mbl {
			/* width: 30% !important; */
			height: auto !important;
			margin: 0 auto;
		}

		#head-img {
			padding: 0;
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
			flex: 0 0 60% !important;
			max-width: 60% !important;
		}

		#p-embed {
			/* margin: 4rem 0 !important; */
			/* margin: 1.5rem 0 !important; */
			padding-top: 6rem;
		}

		.product-desc {
			font-size: 20px !important;
		}
		/* .ss-mbl {
			width: 45% !important;
			height: auto !important;
		} */
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
			font-size: 35px !important;
		}
	}

	.img-ss {
		height: 500px;
		width: auto;
	}
</style>

<header class="productBanner-alt">
	<div class="row px-5 pt-5 mb-5 mt-3 pb-5">
		<div class="col-md-6 d-flex justify-content-center" id="head-img">
			<!-- <img src="<?php echo base_url(); ?>newAssets/vs_ss/Picture1.png" alt="" class="img-fluid align-self-center head-mbl mr-1">
			<img src="<?php echo base_url(); ?>newAssets/vs_ss/Picture2.png" alt="" class="img-fluid align-self-center head-mbl"> -->
			<img src="<?php echo base_url(); ?>newAssets/vs_ss/VS_Diagram.webp" alt="" class="img-fluid align-self-center head-mbl mr-1">
			<!-- <img src="<?php echo base_url(); ?>newAssets/ib_ss/Picture11.png" alt="" class="img-fluid align-self-center head-mbl"> -->
		</div>
		<div class="col-md-6 pt-5">
			<h1 class="mb-3 fontRobBold fs-35" style="color:#262626;">Simplified Education <br>Platform</h1>
			<p class="text-left pr-0 pr-lg-5 fs-20" style="font-family: 'Josefin Sans'; font-weight: 300 !important; color: #262626;">
				Simple yet powerful app where Synchronous and Asynchronous Learning integrated in single platform. You dont have to switch between many apps anymore!
			</p>
			<div class="row">
				<div class="col-12 pl-0">
					<a href='https://play.google.com/store/apps/details?id=io.newuniverse.VirtualSchoolIndonesiaBisa'><img alt='Get it on Google Play' src='https://play.google.com/intl/en_us/badges/static/images/badges/en_badge_web_generic.png' style='max-width: 200px;' /></a>
					<img class="store" src="ucaas_assets\img\app_store_editedx.png" style="max-width:185px; height: 52px;">
				</div>
			</div>
		</div>
	</div>
</header>

<div class="container-fluid" id="features-list">
	<div class="row justify-content-center my-auto" data-aos="fade-left">
		<div class="col-md-11">
			<div class="row">
				<div class="col-md-5 order-md-1 text-center mx-auto">
					<img src="<?php echo base_url(); ?>newAssets/vs_ss/Picture3.webp" class="img-ss">
				</div>
				<div class="col-md-5 order-md-2 features-desc my-auto mx-auto">
					<h2 class="fontRobBold fs-35 color-green">School Organization</h2>
					<br>
					<h3 class="fs-24 fontRobReg product-desc">
                        Register your school while managing it digitally through our platform. You can also create your school organization, so you can know your school in general and in a more structured way.
					</h3>
				</div>

			</div>
		</div>
	</div>
	<div class="row justify-content-center bg-light my-auto" data-aos="fade-right">
		<div class="col-md-11">
			<div class="row">
				<div class="col-md-7 order-md-2  text-center mx-auto">
					<img src="<?php echo base_url(); ?>newAssets/vs_ss/Picture4.webp" class="img-ss ss-mbl">
					<img src="<?php echo base_url(); ?>newAssets/vs_ss/Picture5.webp" class="img-ss ss-mbl">
				</div>
				<div class="col-md-5 order-md-1 features-desc my-auto mx-auto">
					<h2 class="fontRobBold fs-35 color-green">Synchronous Learning</h2>
					<br>
					<h3 class="fs-24 fontRobReg product-desc">
						Synchronous learning refers to all types of learning in which learner(s) and teacher(s) are in the same place, at the same time, in order for learning to take place. Online classes and conference rooms are embedded in Virtual School, so students can do real-time online learning.
					</h3>
				</div>
			</div>
		</div>
	</div>
	<div class="row justify-content-center my-auto" data-aos="fade-right">
		<div class="col-md-11">
			<div class="row">
				<div class="col-md-7 order-md-1  text-center mx-auto">
					<img src="<?php echo base_url(); ?>newAssets/vs_ss/Picture6.webp" class="img-ss ss-mbl">
					<img src="<?php echo base_url(); ?>newAssets/vs_ss/Picture7.webp" class="img-ss ss-mbl">
				</div>
				<div class="col-md-5 order-md-2 features-desc my-auto mx-auto">
					<!-- <h2 class="fontRobBold fs-35 color-green">Video Call</h2> -->
					<br>
					<h3 class="fs-24 fontRobReg product-desc mb-4">
						The online class comes with a Smart Feature to detect presence and recognize the expression of the students in an Online Class session. With this feature the teacher will get a notification when the students become sleepy, looking sad, laugh or disappear from the online class session.
					</h3>
					<h3 class="fs-24 fontRobReg product-desc mb-4">
						During Online Class, you can also share your screens and whiteboards to help you deliver the material better.
					</h3>
				</div>
			</div>
		</div>
	</div>
	<div class="row justify-content-center bg-light my-auto" data-aos="fade-right">
		<div class="col-md-10">
			<div class="row">
				<div class="col-md-7 order-md-2 text-center mx-auto">
					<img src="<?php echo base_url(); ?>newAssets/vs_ss/Picture8.webp" class="img-ss ss-mbl">
					<img src="<?php echo base_url(); ?>newAssets/vs_ss/Picture9.webp" class="img-ss ss-mbl">
				</div>
				<div class="col-md-5 order-md-1 features-desc my-auto mx-auto">
					<h2 class="fontRobBold fs-35 color-green">Asynchronous Learning</h2>
					<br>
					<h3 class="fs-24 fontRobReg product-desc">
                        General term used to describe forms of education, instruction, and learning that do not occur in the same place or at the same time.
					</h3>
				</div>
			</div>
		</div>
	</div>
    <div class="row justify-content-center my-auto" data-aos="fade-right">
		<div class="col-md-11">
			<div class="row">
				<div class="col-md-7 order-md-1  text-center mx-auto">
					<img src="<?php echo base_url(); ?>newAssets/vs_ss/Picture10.webp" class="img-ss ss-mbl">
					<img src="<?php echo base_url(); ?>newAssets/vs_ss/Picture11.webp" class="img-ss ss-mbl">
				</div>
				<div class="col-md-5 order-md-2 features-desc my-auto mx-auto">
					<!-- <h2 class="fontRobBold fs-35 color-green">Video Call</h2> -->
					<br>
					<h3 class="fs-24 fontRobReg product-desc mb-4">
                        1-1 or group discussion? Virtual School comes with Instant Messaging, Audio Call and Video Call
					</h3>
				</div>
			</div>
		</div>
	</div>
    <div class="row justify-content-center bg-light my-auto" data-aos="fade-right">
		<div class="col-md-10">
			<div class="row">
				<div class="col-md-7 order-md-2 text-center mx-auto">
					<img src="<?php echo base_url(); ?>newAssets/vs_ss/Picture12.webp" class="img-ss ss-mbl">
					<img src="<?php echo base_url(); ?>newAssets/vs_ss/Picture13.webp" class="img-ss ss-mbl">
				</div>
				<div class="col-md-5 order-md-1 features-desc my-auto mx-auto">
					<!-- <h2 class="fontRobBold fs-35 color-green">Asynchronous Learning</h2> -->
					<br>
					<h3 class="fs-24 fontRobReg product-desc">
                        Share anything to your Class. <br>
                        Literally anything.
					</h3>
				</div>
			</div>
		</div>
	</div>
    <div class="row justify-content-center my-auto" data-aos="fade-right">
		<div class="col-md-11">
			<div class="row">
				<div class="col-md-7 order-md-1  text-center mx-auto">
					<img src="<?php echo base_url(); ?>newAssets/vs_ss/Picture14.webp" class="img-ss ss-mbl">
					<img src="<?php echo base_url(); ?>newAssets/vs_ss/Picture15.webp" class="img-ss ss-mbl">
				</div>
				<div class="col-md-5 order-md-2 features-desc my-auto mx-auto">
					<!-- <h2 class="fontRobBold fs-35 color-green">Video Call</h2> -->
					<br>
					<h3 class="fs-24 fontRobReg product-desc mb-4">
                        Create assessment quickly and easily within app.
					</h3>
				</div>
			</div>
		</div>
	</div>
    <div class="row justify-content-center bg-light my-auto" data-aos="fade-right">
		<div class="col-md-10">
			<div class="row">
				<div class="col-md-5 order-md-1 features-desc my-auto mx-auto">
					<!-- <h2 class="fontRobBold fs-35 color-green">Asynchronous Learning</h2> -->
					<br>
					<h3 class="fs-24 fontRobReg product-desc text-center">
                        Ready to transform your school?
					</h3>
				</div>
			</div>
		</div>
	</div>
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

<!-- <hr width="75%"> -->

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
			padding: 4rem 2rem;
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
			padding: 12rem 0 12rem 1.75rem
		}
	}

	/* Large devices (desktops, 992px and up) */

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
			padding: 12rem 1rem 13rem 3rem;
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
			padding: 14rem 2rem;
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
			padding: 10rem 9.75rem 10rem 5.5rem;
		}
	}
</style>

<!-- <div class="container my-5 w-content">
	<div class="row">
		<div class="col-sm-12 col-md-8 col-lg-6 col-xl-5 mx-auto" id="benefits">
			<div class="text-container">
				<h3 class="fontRobBold benefits-title">Secure</h3>
				<p class="fontRobReg m-0 aman">
					<i class="fa fa-circle"></i> 
					We don't keep your phone number or email address.
				</p>
				<p class="fontRobReg mb-3 aman">
					<i class="fa fa-circle"></i> 
					End-to-end encryption to keep your communications secure.
				</p>
				<p class="fontRobReg m-0 aman">
					<i class="fa fa-circle"></i> Data kamu disimpan dengan aman, dan tidak digunakan untuk apapun selain pengembangan aplikasi.
				</p>
				<p class="fontRobReg m-0 aman">
					<i class="fa fa-circle"></i> Kami menjaga privasi kamu dengan serius dan tidak akan pernah memberikan akses pihak ketiga ke data kamu.
				</p>

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
</div> -->

<!-- <hr width="75%"> -->

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

<?php //require_once($_SERVER['DOCUMENT_ROOT'] . '/palio-contact.php');
?>

<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/footer-alt.php'); ?>