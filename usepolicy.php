<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/header-alt.php'); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/header-alt-meta.php'); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/index-nav.php'); ?>
<?php 

    $_SESSION['previous_page'] = $_SESSION['current_page'];
    $_SESSION['current_page'] = 8;
   require_once($_SERVER['DOCUMENT_ROOT'] . '/state_control.php');

?>

<header class="bannerNav">

</header>

<?php //require_once($_SERVER['DOCUMENT_ROOT'].'/fabmsg.php'); 
?>

<div class="container pt-5">
	<div class="col-md-12 pt-5">

		<div class="row justify-content-center my-5">
			<p data-translate="index-237" class="fontRobBold fs-26"></p>
		</div>
		<p data-translate="index-238" class="fontRobLite">
		
		</p>
		<ol class="fontRobLite mb-5">
			<li class="my-3">
				<span data-translate="index-239"></span>
				<ol type="a">
					<li data-translate="index-240" class="my-2">
						
					</li>
					<li data-translate="index-241" class="my-2">
						
					</li>
					<li data-translate="index-242" class="my-2">
						
					</li>
					<li data-translate="index-243" class="my-2">
						
					</li>
					<li data-translate="index-244" class="my-2">
						
					</li>
					<li data-translate="index-245" class="my-2">
						
					</li>
					<li data-translate="index-246" class="my-2">
						
					</li>
				</ol>
			</li>
			<li data-translate="index-247" class="my-3">
				
			</li>
			<li data-translate="index-248" class="my-3">
				
			</li>
			<li class="my-3">
				<span data-translate="index-249"></span>
				<ol type="a">
					<li data-translate="index-250" class="my-2">
						<!-- post any content that: is unlawful, harassing, tortious, defamatory, pornographic, libelous or invasive of another’s privacy; you do not have a right to transmit under any law or under contractual or fiduciary relationships; poses or creates a privacy or security risk to any person; infringes any intellectual property or other proprietary rights of any party; contains software viruses or any other computer code, files or programs designed to interrupt, destroy or limit the functionality of any computer software or hardware or telecommunications equipment; or in the sole judgment of nexilis, is objectionable or which restricts or inhibits any other person from using or enjoying the Service, or which may expose nexilis or its users to any harm or liability of any type; -->
					</li>
					<li data-translate="index-251" class="my-2">
						<!-- interfere with or disrupt the Services or servers or networks connected to the nexilis Services, or disobey any requirements, procedures, policies or regulations of networks connected to the Service; -->
					</li>
					<li data-translate="index-252" class="my-2">
						<!-- violate any applicable local, state, national, or international law, or any regulations having the force of law; -->
					</li>
					<li data-translate="index-253" class="my-2">
						<!-- further or promote any criminal activity or enterprise or provide instructional information about illegal activities; or -->
					</li>
					<li data-translate="index-254" class="my-2">
						<!-- obtain or attempt to access or otherwise obtain any materials or information through any means not intentionally made available or provided for through the Services. -->
					</li>
				</ol>
			</li>
			<li data-translate="index-255" class="my-3">
				<!-- <Strong>Privacy</Strong>. If you use the Services to collect, display or transmit any personal information about your users, you will prominently display a privacy policy that complies with all applicable laws and that makes it clear to users what data you collect and how you will use, display or share that data. You will collect and use user data only in accordance with your privacy policy and all applicable laws and regulations. You agree to comply, and require that your users comply, with all applicable laws, whether federal, state, local or international, relating to the privacy of communication for all parties to a conversation, including, when required, advising all participants in a recorded video chat that the video chat is being recorded. -->
			</li>
		</ol>
	</div>
</div>

<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/footer-alt.php'); ?>

<script>

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