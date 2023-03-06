<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/header-alt.php'); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/chatbot-meta.php'); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/index-nav.php'); ?>
<?php $page = 'cb';
echo "<script>";
echo "var page = 'cb'";
echo "</script>"; ?>

<script>

  var a = document.getElementById('beta'); //or grab it by tagname etc
  a.href = "sign_up.php?page=" + page;
  var b = document.getElementById('loginbeta'); //or grab it by tagname etc
  b.href = "login.php?page=" + page;

</script>

<header class="productBanner-alt">

	<div class="row px-5 pt-4 mt-3 mb-5 pb-5">
		<div class="col-md-6 d-flex justify-content-center">
			<img src="<?php echo base_url(); ?>newAssets/product/Chatbot/ChatBot.png" alt="" style="width: 80%;" class="img-fluid align-self-center">
		</div>
		<div class="col-md-5 pt-5">
			<h1 class="mb-3 fontRobBold" style="font-size: 40px; color: #262626;">ChatBot</h1>
			<p class="text-left pr-0 pr-lg-5 fs-20" style="font-family: 'Josefin Sans'; color: #262626; font-weight: 300!important;">
			According to research conducted by IBM, up to 80% of daily customer service work can be solved by chatbots.
			Chatbots can respond customer questions <strong>faster than humans</strong> without the need for down-times.
			Speeding up response times allows businesses to allocate employees to less trivial work.</p>
			<!-- <a href="" class="btn nav-menu-btn-alt mx-0">Coming Soon</a> -->
		</div>
	</div>

</header>

<?php //require_once($_SERVER['DOCUMENT_ROOT'] . '/fabmsg.php'); ?>

<?php //require_once($_SERVER['DOCUMENT_ROOT'] . '/fabmsg.php'); ?>

<div class="container-fluid my-5">
	<div class="row flex-column-reverse flex-md-row justify-content-center" data-aos-duration="1000" data-aos="fade-right">
		<div class="col-md-5 d-flex">
			<div class="col-md-12 align-self-center">
				<h2 class="fontRobBold fs-35">Natural Language Processing</h2>
				<br>
				<h3 class="fs-20" style="font-family: 'Josefin Sans'; font-weight: 300!important;">
				Chatbots always learn about customer needs to provide a better response for all customer inquiries.</h3>
			</div>
		</div>
		<div class="col-md-5 d-flex justify-content-center order-last">
			<img src="<?php echo base_url(); ?>newAssets/product/Chatbot/Natural Language.png" alt="" class="img-fluid align-self-center" style="max-height: 300px; width: auto;">
		</div>
	</div>
	<br>
	<div class="row justify-content-center productMidBanner" data-aos-duration="1000" data-aos="fade-right">
		<div class="col-md-5 d-flex justify-content-center py-5">
			<img src="<?php echo base_url(); ?>newAssets/product/Chatbot/Auto reply.png" alt="" class="img-fluid align-self-center" style="max-height: 300px; width: auto;">
		</div>
		<div class="col-md-5 d-flex">
			<div class="col-md-12 align-self-center">
				<h2 class="fontRobBold fs-35">Auto-Reply</h2>
				<br>
				<h3 class="fs-20" style="font-family: 'Josefin Sans'; font-weight: 300!important;">24/7 ready to serve all customer inquiries.</h3>
			</div>
		</div>
	</div>
</div>

<!-- <div class="container w-content my-3 py-3">
	<div class="row m-0 justify-content-center">
		<div class="col-md-10">
			<div class="owl-carousel">
				<div class="col px-3 py-3 align-items-center">
					<a href="https://www.thedroidsonroids.com/blog/flutter-in-mobile-app-development-pros-and-cons-for-app-owners" target="_blank" class="m-0 mt-auto text-decoration-none d-flex flex-column" style="color: #212529; height: 230px;">
						<div class="row m-0 mb-3">
							<p class="fontRobReg d-inline fs-20 m-0 quotee-alt d-flex">Developers write just one codebase for your 2 apps - covering both Android and iOS platforms.</p>
						</div>
						<div class="row m-0 mt-auto">
							<div class="col-3 d-flex">
								<img src="<?php echo base_url(); ?>newAssets/pers-flutter2.svg" class="img-fluid align-self-center" style="max-width: 50px; height: auto;">
							</div>
							<div class="col-9 d-flex">
								<p class="text-secondary fontRobReg fs-15 align-self-center m-0">
									The Droids on Roids
								</p>
							</div>
						</div>
					</a>
				</div>
				<div class="col px-3 py-3 align-items-center">
					<a href="https://techcrunch.com/2018/12/04/googles-flutter-toolkit-goes-beyond-mobile-with-project-hummingbird/" class="m-0 mt-auto text-decoration-none d-flex flex-column" target="_blank" style="color: #212529; height: 230px;">
						<div class="row m-0 mb-3">
							<p class="fontRobReg d-inline fs-20 m-0 quotee-alt d-flex">From the beginning, we designed Flutter to be a portable UI toolkit, not just a mobile UI toolkit.</p>
						</div>
						<div class="row m-0 mt-auto">
							<div class="col-3 d-flex">
								<img src="<?php echo base_url(); ?>newAssets/pers-flutter5.png" class="img-fluid align-self-center" style="max-width: 50px; height: auto;">
							</div>
							<div class="col-9 d-flex">
								<p class="text-secondary fontRobReg fs-15 align-self-center m-0">
									Google
								</p>
							</div>
						</div>
					</a>
				</div>
				<div class="col px-3 py-3 align-items-center">
					<a href="https://medium.com/swlh/why-businesses-should-start-focusing-on-googles-flutter-and-fuchsia-48e16820f2a9" target="_blank" class="m-0 mt-auto text-decoration-none d-flex flex-column" style="color: #212529; height: 230px;">
						<div class="row m-0 mb-3">
							<p class="fontRobReg d-inline fs-20 m-0 quotee-alt d-flex">And two most prominent players leading the bandwagon today are Google’s Flutter and Fuchsia</p>
						</div>
						<div class="row m-0 mt-auto">
							<div class="col-3 d-flex">
								<img src="<?php echo base_url(); ?>newAssets/flatter-medium.svg" class="img-fluid align-self-center" style="max-width: 50px; height: auto;">
							</div>
							<div class="col-9 d-flex">
								<p class="text-secondary fontRobReg fs-15 align-self-center m-0">
									Albert Smith</br>
									Medium
								</p>
							</div>
						</div>
					</a>
				</div>
				<div class="col px-3 py-3 align-items-center">
					<a href="https://steelkiwi.com/blog/flutter-pros-and-cons-for-seamless-cross-platform-development/" target="_blank" class="m-0 mt-auto text-decoration-none d-flex flex-column" style="color: #212529; height: 230px;">
						<div class="row m-0 mb-3">
							<p class="fontRobReg d-inline fs-20 m-0 quotee-alt d-flex">Flutter doesn't need to use a JavaScript bridge, which improves app startup times and overall performance.</p>
						</div>
						<div class="row m-0 mt-auto">
							<div class="col-3 d-flex">
								<img src="<?php echo base_url(); ?>newAssets/pers-flutter4.png" class="img-fluid align-self-center" style="max-width: 50px; height: auto;">
							</div>
							<div class="col-9 d-flex">
								<p class="text-secondary fontRobReg fs-15 align-self-center m-0">
									Steel Kiwi
								</p>
							</div>
						</div>
					</a>
				</div>
				<div class="col px-3 py-3 align-items-center">
					<a href="https://www.asapdevelopers.com/google-flutter-review/" target="_blank" class="m-0 mt-auto text-decoration-none d-flex flex-column" style="color: #212529; height: 230px;">
						<div class="row m-0 mb-3">
							<p class="fontRobReg d-inline fs-20 m-0 quotee-alt d-flex">Flutter is a very powerful SDK that has gained traction with some industry giants.</p>
						</div>
						<div class="row m-0 mt-auto">
							<div class="col-3 d-flex">
								<img src="<?php echo base_url(); ?>newAssets/pers-flutter3.png" class="img-fluid align-self-center" style="max-width: 50px; height: auto;">
							</div>
							<div class="col-9 d-flex">
								<p class="text-secondary fontRobReg fs-15 align-self-center m-0">
									Asap Developers
								</p>
							</div>
						</div>
					</a>
				</div>

				<div class="col px-3 py-3 align-items-center">
					<a href="https://www.itweb.co.za/content/GxwQDq1AOB5qlPVo" class="m-0 mt-auto text-decoration-none d-flex flex-column" target="_blank" style="color: #212529; height: 230px;">
						<div class="row m-0 mb-3">
							<p class="fontRobReg d-inline fs-20 m-0 quotee-alt d-flex">Flutter being built on Material Design is something that you need to get your head around when you start using the platform.</p>
						</div>
						<div class="row m-0 mt-auto">
							<div class="col-3 d-flex">
								<img src="<?php echo base_url(); ?>newAssets/pers-flutter6.png" class="img-fluid align-self-center" style="max-width: 50px; height: auto;">
							</div>
							<div class="col-9 d-flex">
								<p class="text-secondary fontRobReg fs-15 align-self-center m-0">
									Peter Scheffel</br>
									BBD's Chief Digital Officer
								</p>
							</div>
						</div>
					</a>
				</div>
				<div class="col px-3 py-3 align-items-center">
					<a href="https://appinventiv.com/blog/choose-flutter-for-mvp-development/" class="m-0 mt-auto text-decoration-none d-flex flex-column" target="_blank" style="color: #212529; height: 230px;">
						<div class="row m-0 mb-3">
							<p class="fontRobReg d-inline fs-20 m-0 quotee-alt d-flex">Is the fact that it supports a wide range of widgets along with giving developers the option to customize the widgets.</p>
						</div>
						<div class="row m-0 mt-auto">
							<div class="col-3 d-flex">
								<img src="<?php echo base_url(); ?>newAssets/pers-flutter.png" class="img-fluid align-self-center" style="max-width: 50px; height: auto;">
							</div>
							<div class="col-9 d-flex">
								<p class="text-secondary fontRobReg fs-15 align-self-center m-0">
									Appinventiv
								</p>
							</div>
						</div>
					</a>
				</div>
			</div>
		</div>
	</div>
</div> -->

<!-- remarked until source ready ...

<div class="container my-4">
	<div class="row justify-content-center mb-4 mx-0">
		<div class="col-md-9 text-center">
			<p class="fontRobBold fs-35">Simply Practical</p>
			<p class="fs-20" style="font-family: 'Josefin Sans';">Call our API in a single line. We have been
				working hard to ensure the utmost practicality and ease.</p>
		</div>
	</div>



	<div class="row justify-content-center mx-0">
		<div class="col-md-9">

			<ul class="nav nav-tabs border-0 d-flex justify-content-between">
				<li class="nav-item" style="width: 50%;">
					<a id="flutter" class="code-link-tab text-decoration-none d-flex justify-content-center"
						data-toggle="tab" href="#androidiOSCode" role="tab">
						<p class="fontRobReg fs-25 text-center m-0">Android & iOS</p>
					</a>
				</li>
				<li class="nav-item" style="width: 50%;">
					<a id="native" class="code-link-tab active text-decoration-none d-flex justify-content-center"
						data-toggle="tab" href="#androidCode" role="tab">
						<p class="fontRobReg fs-25 text-center m-0">Android</p>
					</a>
				</li>
			</ul><br>

			<div class="tab-content">

			<div id="fluttercode" style="display: none;">

				<div id="flutter-small-tabs">
					<ul class="nav nav-tabs border-0 d-flex justify-content-between">
						<li class="nav-item" style="width: 25%;">
							<a id="flutter-small-tabs-1" class="code-link active text-decoration-none d-flex justify-content-center"
								data-toggle="tab" href="#flutter1" role="tab">
								<p class="fontRobReg fs-15 text-center m-0">flutter 1</p>
							</a>
						</li>
						<li class="nav-item" style="width: 25%;">
							<a id="flutter-small-tabs-2" class="code-link text-decoration-none d-flex justify-content-center"
								data-toggle="tab" href="#flutter2" role="tab">
								<p class="fontRobReg fs-15 text-center m-0">flutter 2</p>
							</a>
						</li>
						<li class="nav-item" style="width: 25%;">
							<a id="flutter-small-tabs-3" class="code-link text-decoration-none d-flex justify-content-center"
								data-toggle="tab" href="#flutter3" role="tab">
								<p class="fontRobReg fs-15 text-center m-0">flutter 3</p>
							</a>
						</li>
						<li class="nav-item" style="width: 25%;">
							<a id="flutter-small-tabs-4" class="code-link text-decoration-none d-flex justify-content-center"
								data-toggle="tab" href="#flutter4" role="tab">
								<p class="fontRobReg fs-15 text-center m-0">flutter 4</p>
							</a>
						</li>
					</ul>


					<button type="button" data-clipboard-action="copy" data-clipboard-target="#LS-androidiOS" style="top: 75%; right: 3%;"
						class="btn btn-dark copy-snippet"><i class="fa fa-copy"></i></button>


				</div>
				<div class="tab-pane active code-fix" id="flutter1" style="display: block;">
					<pre class="prettyprint lang-java linenums:1" id="LS-androidiOS1">
//
//
//
//
//
//		    _             _ _       _     _        ____                    _
//		   / \__   ____ _(_) | __ _| |__ | | ___  / ___|  ___   ___  _ __ | |
//		  / _ \ \ / / _` | | |/ _` | '_ \| |/ _ \ \___ \ / _ \ / _ \| '_ \| |
//		 / ___ \ V / (_| | | | (_| | |_) | |  __/  ___) | (_) | (_) | | | |_|
//		/_/   \_\_/ \__,_|_|_|\__,_|_.__/|_|\___| |____/ \___/ \___/|_| |_(_)
//
//
//
//
//
//
//

					</pre>

				</div>
				<div class="tab-pane code-fix" id="flutter2" style="display: none;">
					<pre class="prettyprint lang-java linenums:1" id="LS-androidiOS2">
//
//
//
//
//
//		    _             _ _       _     _        ____                    _
//		   / \__   ____ _(_) | __ _| |__ | | ___  / ___|  ___   ___  _ __ | |
//		  / _ \ \ / / _` | | |/ _` | '_ \| |/ _ \ \___ \ / _ \ / _ \| '_ \| |
//		 / ___ \ V / (_| | | | (_| | |_) | |  __/  ___) | (_) | (_) | | | |_|
//		/_/   \_\_/ \__,_|_|_|\__,_|_.__/|_|\___| |____/ \___/ \___/|_| |_(_)
//
//
//
//
//
//
//

					</pre>
				</div>
				<div class="tab-pane code-fix" id="flutter3" style="display: none;">
					<pre class="prettyprint lang-java linenums:1" id="LS-androidiOS3">
//
//
//
//
//
//		    _             _ _       _     _        ____                    _
//		   / \__   ____ _(_) | __ _| |__ | | ___  / ___|  ___   ___  _ __ | |
//		  / _ \ \ / / _` | | |/ _` | '_ \| |/ _ \ \___ \ / _ \ / _ \| '_ \| |
//		 / ___ \ V / (_| | | | (_| | |_) | |  __/  ___) | (_) | (_) | | | |_|
//		/_/   \_\_/ \__,_|_|_|\__,_|_.__/|_|\___| |____/ \___/ \___/|_| |_(_)
//
//
//
//
//
//
//

					</pre>
				</div>
				<div class="tab-pane code-fix" id="flutter4" style="display: none;">
					<pre class="prettyprint lang-java linenums:1" id="LS-androidiOS4">
//
//
//
//
//
//		    _             _ _       _     _        ____                    _
//		   / \__   ____ _(_) | __ _| |__ | | ___  / ___|  ___   ___  _ __ | |
//		  / _ \ \ / / _` | | |/ _` | '_ \| |/ _ \ \___ \ / _ \ / _ \| '_ \| |
//		 / ___ \ V / (_| | | | (_| | |_) | |  __/  ___) | (_) | (_) | | | |_|
//		/_/   \_\_/ \__,_|_|_|\__,_|_.__/|_|\___| |____/ \___/ \___/|_| |_(_)
//
//
//
//
//
//
//

					</pre>
				</div>

				<br>

				<div class="row justify-content-center text-center">
						<div class="col-md-12">

							<?php //if(!getSession('id_company')){
							?>

							<?php //} else {
							?>

							<a class="btn nav-menu-btn-wht-alt-download" href="#">Download Flutter Source</a>

							<?php //}
							?>

						</div>
				</div>

				<br>


			</div>

			<div id="nativecode" style="display: block;">

				<div id="native-small-tabs">
					<ul class="nav nav-tabs border-0 d-flex justify-content-between">
						<li class="nav-item" style="width: 25%;">
							<a id="native-small-tabs-1" class="code-link active text-decoration-none d-flex justify-content-center"
								data-toggle="tab" href="#native1" role="tab">
								<p class="fontRobReg fs-15 text-center m-0">native 1</p>
							</a>
						</li>
						<li class="nav-item" style="width: 25%;">
							<a id="native-small-tabs-2" class="code-link text-decoration-none d-flex justify-content-center"
								data-toggle="tab" href="#native2" role="tab">
								<p class="fontRobReg fs-15 text-center m-0">native 2</p>
							</a>
						</li>
						<li class="nav-item" style="width: 25%;">
							<a id="native-small-tabs-3" class="code-link text-decoration-none d-flex justify-content-center"
								data-toggle="tab" href="#native3" role="tab">
								<p class="fontRobReg fs-15 text-center m-0">native 3</p>
							</a>
						</li>
						<li class="nav-item" style="width: 25%;">
							<a id="native-small-tabs-4" class="code-link text-decoration-none d-flex justify-content-center"
								data-toggle="tab" href="#native4" role="tab">
								<p class="fontRobReg fs-15 text-center m-0">native 4</p>
							</a>
						</li>
					</ul>
					<button type="button" data-clipboard-action="copy" data-clipboard-target="#LS-androidiOS" style="top: 75%; right: 3%;"
						class="btn btn-dark copy-snippet"><i class="fa fa-copy"></i></button>
				</div>
				<div class="tab-pane active code-fix" id="native1" style="display: block;">
					<pre class="prettyprint lang-java linenums:1" id="LS-android1">
//
//
//
//
//
//		    _             _ _       _     _        ____                    _
//		   / \__   ____ _(_) | __ _| |__ | | ___  / ___|  ___   ___  _ __ | |
//		  / _ \ \ / / _` | | |/ _` | '_ \| |/ _ \ \___ \ / _ \ / _ \| '_ \| |
//		 / ___ \ V / (_| | | | (_| | |_) | |  __/  ___) | (_) | (_) | | | |_|
//		/_/   \_\_/ \__,_|_|_|\__,_|_.__/|_|\___| |____/ \___/ \___/|_| |_(_)
//
//
//
//
//
//
//

					</pre>


				</div>
				<div class="tab-pane code-fix" id="native2" style="display: none;">
					<pre class="prettyprint lang-java linenums:1" id="LS-android2">
//
//
//
//
//
//		    _             _ _       _     _        ____                    _
//		   / \__   ____ _(_) | __ _| |__ | | ___  / ___|  ___   ___  _ __ | |
//		  / _ \ \ / / _` | | |/ _` | '_ \| |/ _ \ \___ \ / _ \ / _ \| '_ \| |
//		 / ___ \ V / (_| | | | (_| | |_) | |  __/  ___) | (_) | (_) | | | |_|
//		/_/   \_\_/ \__,_|_|_|\__,_|_.__/|_|\___| |____/ \___/ \___/|_| |_(_)
//
//
//
//
//
//
//

					</pre>
				</div>
				<div class="tab-pane code-fix" id="native3" style="display: none;">
					<pre class="prettyprint lang-java linenums:1" id="LS-android3">
//
//
//
//
//
//		    _             _ _       _     _        ____                    _
//		   / \__   ____ _(_) | __ _| |__ | | ___  / ___|  ___   ___  _ __ | |
//		  / _ \ \ / / _` | | |/ _` | '_ \| |/ _ \ \___ \ / _ \ / _ \| '_ \| |
//		 / ___ \ V / (_| | | | (_| | |_) | |  __/  ___) | (_) | (_) | | | |_|
//		/_/   \_\_/ \__,_|_|_|\__,_|_.__/|_|\___| |____/ \___/ \___/|_| |_(_)
//
//
//
//
//
//
//

					</pre>
				</div>
				<div class="tab-pane code-fix" id="native4" style="display: none;">
					<pre class="prettyprint lang-java linenums:1" id="LS-android4">
//
//
//
//
//
//		    _             _ _       _     _        ____                    _
//		   / \__   ____ _(_) | __ _| |__ | | ___  / ___|  ___   ___  _ __ | |
//		  / _ \ \ / / _` | | |/ _` | '_ \| |/ _ \ \___ \ / _ \ / _ \| '_ \| |
//		 / ___ \ V / (_| | | | (_| | |_) | |  __/  ___) | (_) | (_) | | | |_|
//		/_/   \_\_/ \__,_|_|_|\__,_|_.__/|_|\___| |____/ \___/ \___/|_| |_(_)
//
//
//
//
//
//
//

					</pre>
				</div>

				<br>

				<div class="row justify-content-center text-center">
						<div class="col-md-12">

							<?php //if(!getSession('id_company')){
							?>



							<?php //} else {
							?>

							<a class="btn nav-menu-btn-wht-alt-download" href="./LiveStreaming.zip">Download Native android Source</a>

							<?php //}
							?>

						</div>
				</div>

				<br>


			</div>

			</div>

		</div>

	</div>
</div>
-->

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
</script>

<script>
	if ($("#native").hasClass("active")) {
		$("#native-small-tabs-1").addClass("active");
		$("#native-small-tabs").css("display", "block");
	}

	$("#flutter").click(function() {
		$("#fluttercode").css("display", "block");
		$("#nativecode").css("display", "none");
		$("#flutter-small-tabs-1").addClass("active");
		$("#flutter-small-tabs-2").removeClass("active");
		$("#flutter-small-tabs-3").removeClass("active");
		$("#flutter-small-tabs-4").removeClass("active");
		$("#flutter1").css("display", "block");
		$("#flutter2").css("display", "none");
		$("#flutter3").css("display", "none");
		$("#flutter4").css("display", "none");
	});

	$("#native").click(function() {
		$("#nativecode").css("display", "block");
		$("#fluttercode").css("display", "none");
		$("#native-small-tabs-1").addClass("active");
		$("#native-small-tabs-2").removeClass("active");
		$("#native-small-tabs-3").removeClass("active");
		$("#native-small-tabs-4").removeClass("active");
		$("#native1").css("display", "block");
		$("#native2").css("display", "none");
		$("#native3").css("display", "none");
		$("#native4").css("display", "none");
	});

	$("#native-small-tabs-1").click(function() {
		$("#native1").css("display", "block");
		$("#native2").css("display", "none");
		$("#native3").css("display", "none");
		$("#native4").css("display", "none");
	});

	$("#native-small-tabs-2").click(function() {
		$("#native2").css("display", "block");
		$("#native3").css("display", "none");
		$("#native4").css("display", "none");
		$("#native1").css("display", "none");
	});

	$("#native-small-tabs-3").click(function() {
		$("#native3").css("display", "block");
		$("#native4").css("display", "none");
		$("#native1").css("display", "none");
		$("#native2").css("display", "none");
	});

	$("#native-small-tabs-4").click(function() {
		$("#native4").css("display", "block");
		$("#native1").css("display", "none");
		$("#native2").css("display", "none");
		$("#native3").css("display", "none");
	});

	$("#flutter-small-tabs-1").click(function() {
		$("#flutter1").css("display", "block");
		$("#flutter2").css("display", "none");
		$("#flutter3").css("display", "none");
		$("#flutter4").css("display", "none");
	});

	$("#flutter-small-tabs-2").click(function() {
		$("#flutter2").css("display", "block");
		$("#flutter1").css("display", "none");
		$("#flutter3").css("display", "none");
		$("#flutter4").css("display", "none");
	});

	$("#flutter-small-tabs-3").click(function() {
		$("#flutter3").css("display", "block");
		$("#flutter1").css("display", "none");
		$("#flutter2").css("display", "none");
		$("#flutter4").css("display", "none");
	});

	$("#flutter-small-tabs-4").click(function() {
		$("#flutter4").css("display", "block");
		$("#flutter1").css("display", "none");
		$("#flutter2").css("display", "none");
		$("#flutter3").css("display", "none");
	});
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

<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/contact-alt.php'); ?>

<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/footer-alt.php'); ?>
