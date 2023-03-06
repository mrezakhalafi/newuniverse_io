<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/header-alt.php'); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/header-alt-meta.php'); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/index-nav.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/url_function.php'); ?>
<?php

$_SESSION['previous_page'] = $_SESSION['current_page'];
$_SESSION['current_page'] = 7;
require_once($_SERVER['DOCUMENT_ROOT'] . '/state_control.php');

$version = 'v=2.03';

?>

<style>
	input::placeholder,
	textarea::placeholder {
		font-family: 'Poppins', sans-serif;
	}

	.btn{
		font-size: 15px;
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
			<h2 id="titleText" data-translate="contactus-1" style="font-family:'Poppins', sans-serif; font-size: 35px"></h2>
		</div>
	</div>

	<!-- <form id="contact-form" method="POST"> -->
	<div class="row my-5 justify-content-center">
		<div class="col-md-8">
			<div class="card shadow">
				<div class="card-body">
					<div class="row my-3">
						<div class="col">
							<input required type="text" name="name" class="form-control" id="name" placeholder="Name">
						</div>
						<div class="col">
							<input required type="email" name="email" class="form-control" id="email" placeholder="Email"">
							<p data-translate="contactus-2" class="text-danger fs-15 fontRobReg m-0 text-left" id="alertEmail" style="display: none;"></p>
						</div>
					</div>
					<div class="row my-3">
						<div class="col-md-12">
							<textarea required class="form-control" id="message" name="message" rows="10" placeholder="Message""></textarea>
						</div>
					</div>
					<div class="row my-3">
						<div class="col-md-12">
							<!-- <button data-translate="contactus-3" id="submit" type="submit" name="send" class="btn nav-menu-btn-wht-alt w-100 m-0"></button> -->
							<button data-translate="contactus-3" id="submit" onclick="sendJSON()" class="btn nav-menu-btn-wht-alt w-100 m-0"></button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- </form> -->
</div>

<div class="modal fade" id="myModal">
	<div class="modal-dialog modal-dialog-centered modal-lg">
		<div class="modal-content">
			<div class="modal-body pb-5">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<div class="row justify-content-center m-0">
					<p data-translate="contactus-4" class="text-center font-weight-bold fontRobReg mb-0 mt-5 fs-20 pl-lg-4"></p>
				</div>
				<div class="row justify-content-center mt-4">
					<p data-translate="contactus-5" class="fontRobReg mb-0 fs-15 text-center"></p>
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
				<label>Invalid User or Password</label>
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

<script src='js/contactus.js?<?php echo $version; ?>'></script>

<script>

	if (localStorage.lang == 1){
		$('#name').attr('placeholder','Nama');
		$('#email').attr('placeholder','Alamat Email');
		$('#message').attr('placeholder','Pesan');
	}

$(document).ready(function(){

	$("#animate-clickme").animate({top: '+=60px'}, 2000);
	$("#animate-clickme").animate({top: '-=60px'}, 2000);

	setInterval(function(){            
	$("#animate-clickme").animate({top: '+=60px'}, 2000);
	$("#animate-clickme").animate({top: '-=60px'}, 2000);

	},2000); 

	var animateLevelUpTi1;
	var animateLevelUpTi2;
	var animateLevelUpTi3;
	var animateLevelUpTi4;

	runLevelUpAnimation();
	resumeLevelUpAnimation();

	$('#FB_1').on("mouseenter", function () {
	clearAnimateLevelUp();
	$('#FB_1').attr('src','palio_button/assets/Untitled110_20220121183610.png');
	$('#FB_2').attr('src','newAssets/floating_button/button_chat.png');
	$('#FB_3').attr('src','newAssets/floating_button/button_call.png');
	$('#FB_4').attr('src','newAssets/floating_button/button_stream.png');
	}).on("mouseleave", function () {
	resumeLevelUpAnimation();
	});

	$('#FB_2').on("mouseenter", function () {
	clearAnimateLevelUp();
	$('#FB_1').attr('src','newAssets/floating_button/button_cc.png');
	$('#FB_2').attr('src','palio_button/assets/Untitled110_20220121183614.png');
	$('#FB_3').attr('src','newAssets/floating_button/button_call.png');
	$('#FB_4').attr('src','newAssets/floating_button/button_stream.png');
	}).on("mouseleave", function () {
	resumeLevelUpAnimation();
	});

	$('#FB_3').on("mouseenter", function () {
	clearAnimateLevelUp();
	$('#FB_1').attr('src','newAssets/floating_button/button_cc.png');
	$('#FB_2').attr('src','newAssets/floating_button/button_chat.png');
	$('#FB_3').attr('src','palio_button/assets/Untitled110_20220121183621.png');
	$('#FB_4').attr('src','newAssets/floating_button/button_stream.png');
	}).on("mouseleave", function () {
	resumeLevelUpAnimation();
	});

	$('#FB_4').on("mouseenter", function () {
	clearAnimateLevelUp();
	$('#FB_1').attr('src','newAssets/floating_button/button_cc.png');
	$('#FB_2').attr('src','newAssets/floating_button/button_chat.png');
	$('#FB_3').attr('src','newAssets/floating_button/button_call.png');
	$('#FB_4').attr('src','palio_button/assets/Untitled110_20220121183617.png');
	}).on("mouseleave", function () {
	resumeLevelUpAnimation();
	});

	function clearAnimateLevelUp(){
	clearInterval(animateLevelUpIn);
	clearTimeout(animateLevelUpTi1);
	clearTimeout(animateLevelUpTi2);
	clearTimeout(animateLevelUpTi3);
	clearTimeout(animateLevelUpTi4);
	}

	function runLevelUpAnimation(){
	animateLevelUpTi1 = setTimeout(function(){
		$('#FB_4').attr('src','palio_button/assets/Untitled110_20220121183617.png');
		$('#FB_3').attr('src','/newAssets/floating_button/button_call.png');
		$('#FB_2').attr('src','/newAssets/floating_button/button_chat.png');
		$('#FB_1').attr('src','/newAssets/floating_button/button_cc.png');
	}, 1000);

	animateLevelUpTi2 = setTimeout(function(){
		$('#FB_3').attr('src','palio_button/assets/Untitled110_20220121183621.png');
		$('#FB_4').attr('src','/newAssets/floating_button/button_stream.png');
		$('#FB_2').attr('src','/newAssets/floating_button/button_chat.png');
		$('#FB_1').attr('src','/newAssets/floating_button/button_cc.png');
	}, 2000);

	animateLevelUpTi3 = setTimeout(function(){
		$('#FB_2').attr('src','palio_button/assets/Untitled110_20220121183614.png');
		$('#FB_3').attr('src','/newAssets/floating_button/button_call.png');
		$('#FB_4').attr('src','/newAssets/floating_button/button_stream.png');
		$('#FB_1').attr('src','/newAssets/floating_button/button_cc.png');
	}, 3000);

	animateLevelUpTi4 = setTimeout(function(){
		$('#FB_1').attr('src','palio_button/assets/Untitled110_20220121183610.png');
		$('#FB_3').attr('src','/newAssets/floating_button/button_call.png');
		$('#FB_2').attr('src','/newAssets/floating_button/button_chat.png');
		$('#FB_4').attr('src','/newAssets/floating_button/button_stream.png');
	}, 4000);
	}

	function resumeLevelUpAnimation(){

	runLevelUpAnimation();

	animateLevelUpIn = setInterval(function(){   
		runLevelUpAnimation();
	},4000);
	}
});

</script>

<?php if (!empty($errMsg)) : ?>
	<script type="text/javascript">
		var _0x3e73=['show','22840LpDbRK','139wTJzit','2PPfDEx','52709kKVRpG','464747klmYYs','214906NVcbJZ','#myModal2','6115yKdEtn','233547ZFKzeU','54389HCUELi','3rFfodT'];var _0x2d7d=function(_0x41c52c,_0x356f7b){_0x41c52c=_0x41c52c-0x1c4;var _0x3e73f2=_0x3e73[_0x41c52c];return _0x3e73f2;};(function(_0x46ca9a,_0x3915c3){var _0x4d346e=_0x2d7d;while(!![]){try{var _0xe49cee=parseInt(_0x4d346e(0x1c6))+parseInt(_0x4d346e(0x1c7))*parseInt(_0x4d346e(0x1cd))+-parseInt(_0x4d346e(0x1cb))+-parseInt(_0x4d346e(0x1c9))+-parseInt(_0x4d346e(0x1c8))*-parseInt(_0x4d346e(0x1ce))+-parseInt(_0x4d346e(0x1cf))*parseInt(_0x4d346e(0x1c4))+-parseInt(_0x4d346e(0x1ca));if(_0xe49cee===_0x3915c3)break;else _0x46ca9a['push'](_0x46ca9a['shift']());}catch(_0x238c75){_0x46ca9a['push'](_0x46ca9a['shift']());}}}(_0x3e73,0x6c7e6),$(document)['ready'](function(){var _0x40826e=_0x2d7d;$(_0x40826e(0x1cc))['modal'](_0x40826e(0x1c5));}));
	</script>
<?php endif; ?>

<?php if (!empty($succMsg)) : ?>
	<script type="text/javascript">
		var _0xae23=['2035720SvEfrD','modal','#myModal','78425ZnbSrq','1307757QtQCOn','978643fYBjDy','1IzNVti','857736MxUkVD','1vtCqYO','show','97657jhpxKg','95131kjVWCv','ready'];var _0x2160=function(_0x3adc93,_0x3dd9b0){_0x3adc93=_0x3adc93-0xee;var _0xae234f=_0xae23[_0x3adc93];return _0xae234f;};var _0x8b534f=_0x2160;(function(_0x4dfab6,_0x1d559e){var _0x12c5af=_0x2160;while(!![]){try{var _0x1cf466=-parseInt(_0x12c5af(0xee))+-parseInt(_0x12c5af(0xf8))+parseInt(_0x12c5af(0xf1))+parseInt(_0x12c5af(0xef))*-parseInt(_0x12c5af(0xf2))+parseInt(_0x12c5af(0xf9))+-parseInt(_0x12c5af(0xf7))+parseInt(_0x12c5af(0xf4))*parseInt(_0x12c5af(0xfa));if(_0x1cf466===_0x1d559e)break;else _0x4dfab6['push'](_0x4dfab6['shift']());}catch(_0x4402c7){_0x4dfab6['push'](_0x4dfab6['shift']());}}}(_0xae23,0xbcb6b),$(document)[_0x8b534f(0xf3)](function(){var _0x4ae1b0=_0x8b534f;$(_0x4ae1b0(0xf6))[_0x4ae1b0(0xf5)](_0x4ae1b0(0xf0));}));
	</script>
<?php endif; ?>

<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/footer-alt.php'); ?>