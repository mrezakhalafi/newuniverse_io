<style>
	#quickguide-android,
	#flutter-ios-text,
	#flutter-android-text {
		font-family: 'Josefin Sans', sans-serif;
	}

	#quickguide-android {
		display: none;
	}

	#quickguide-flutter-ios,
	#quickguide-flutter-android {
		display: none;
	}

	#flutter-guide-tab {
		display: none;
	}

	.download-button-flutter {
		display: none;
	}

	@media screen and (max-width:600px) {

		#quickguide-android,
		#flutter-ios-text,
		#flutter-android-text {
			padding: 2rem !important;
			overflow-x: auto !important;
			overflow-wrap: normal;
		}

		#quickguide-android,
		#flutter-ios-text,
		#flutter-android-text {
			font-size: 18px !important;
		}
	}
</style>

<script>
	$(document).ready(function() {

		if ($("#fluttercode").css('display', 'block')) {
			$('#flutter-guide-tab').css('display', 'flex');
			$('#flutter-guide-tab-content').css('display', 'block');
			$('#quickguide-flutter-android').css('display', 'block');
			$('#quickguide-android').css('display', 'none');
			$('.download-button-flutter').css('display', 'flex');
			$('#download-button-android').css('display', 'none');

			$('#nusdklite-guide-tab').css('display', 'none');
			$('.instructions-head').css('display', 'block');
		} else if ($("#nativecode").css('display', 'block')) {
			$('#flutter-guide-tab').css('display', 'none');
			$('#quickguide-flutter-android').css('display', 'none');
			$('#quickguide-flutter-ios').css('display', 'none');
			$('#flutter-ios').removeClass('active');
			$('#flutter-android').addClass('active');
			$('#flutter-guide-tab-content').css('display', 'none');
			$('#quickguide-android').css('display', 'block');
			$('.download-button-flutter').css('display', 'none');
			$('#download-button-android').css('display', 'flex');

			$('#nusdklite-guide-tab').css('display', 'none');
			$('.instructions-head').css('display', 'block');
		} else if ($("#nusdklitecode").css('display', 'block')) {
			$('#flutter-guide-tab').css('display', 'none');
			$('#quickguide-flutter-android').css('display', 'none');
			$('#quickguide-flutter-ios').css('display', 'none');
			$('#flutter-ios').removeClass('active');
			$('#flutter-android').addClass('active');
			$('#flutter-guide-tab-content').css('display', 'none');
			$('#quickguide-android').css('display', 'none');

			$('#nusdklite-guide-tab').css('display', 'block');
			$('.instructions-head').css('display', 'block');
		}

		$('#flutter').click(function() {
			if ($(this).hasClass("coming-soon")) {
				$('#flutter-guide-tab').css('display', 'none');
				$('#quickguide-flutter-android').css('display', 'none');
				$('#quickguide-flutter-ios').css('display', 'none');
				$('#flutter-ios').removeClass('active');
				$('#flutter-android').addClass('active');
				$('#flutter-guide-tab-content').css('display', 'none');
				$('#quickguide-android').css('display', 'none');

				$('#nusdklite-guide-tab').css('display', 'none');
				$('.instructions-head').css('display', 'none');
			} else {
				$('#flutter-guide-tab').css('display', 'flex');
				$('#flutter-guide-tab-content').css('display', 'block');
				$('#quickguide-flutter-android').css('display', 'block');
				$('#quickguide-android').css('display', 'none');
				$('.download-button-flutter').css('display', 'flex');
				$('#download-button-android').css('display', 'none');

				$('#nusdklite-guide-tab').css('display', 'none');
				$('.instructions-head').css('display', 'block');
			}
		});

		$('#native').click(function() {
			if ($(this).hasClass("coming-soon")) {
				$('#flutter-guide-tab').css('display', 'none');
				$('#quickguide-flutter-android').css('display', 'none');
				$('#quickguide-flutter-ios').css('display', 'none');
				$('#flutter-ios').removeClass('active');
				$('#flutter-android').addClass('active');
				$('#flutter-guide-tab-content').css('display', 'none');
				$('#quickguide-android').css('display', 'none');

				$('#nusdklite-guide-tab').css('display', 'none');
				$('.instructions-head').css('display', 'none');
			} else {
				$('#flutter-guide-tab').css('display', 'none');
				$('#quickguide-flutter-android').css('display', 'none');
				$('#quickguide-flutter-ios').css('display', 'none');
				$('#flutter-ios').removeClass('active');
				$('#flutter-android').addClass('active');
				$('#flutter-guide-tab-content').css('display', 'none');
				$('#quickguide-android').css('display', 'block');
				$('.download-button-flutter').css('display', 'none');
				$('#download-button-android').css('display', 'flex');

				$('#nusdklite-guide-tab').css('display', 'none');
				$('.instructions-head').css('display', 'block');
			}
		});

		$('#lite').click(function() {
			$('#flutter-guide-tab').css('display', 'none');
			$('#quickguide-flutter-android').css('display', 'none');
			$('#quickguide-flutter-ios').css('display', 'none');
			$('#flutter-ios').removeClass('active');
			$('#flutter-android').addClass('active');
			$('#flutter-guide-tab-content').css('display', 'none');
			$('#quickguide-android').css('display', 'none');

			$('#nusdklite-guide-tab').css('display', 'block');
			$('.instructions-head').css('display', 'block');
		});

		$('#flutter-android').click(function() {
			$('#quickguide-flutter-android').css('display', 'block');
			$('#quickguide-flutter-ios').css('display', 'none');
		});

		$('#flutter-ios').click(function() {
			$('#quickguide-flutter-android').css('display', 'none');
			$('#quickguide-flutter-ios').css('display', 'block');
		});
	});
</script>

<br><br>

<hr width="75%"><br>
<div class="container mb-5" id="ourContact">

	<div class="row">
		<div class="col-md-12">
			<div class="row justify-content-center text-center my-3 px-3">
				<h1 data-translate="contactaltproducts-1" class="fontRobBold greenText fs-30"></h1>
			</div>
		</div>
	</div>
	<div class="row justify-content-center">
		<div class="col-md-10 text-center">
			<p data-translate="contactaltproducts-2" class="fontRobReg fs-20"></p>
			<h4 data-translate="contactaltproducts-3" class="fontRobBold text-center"></h4>
			<p data-translate="contactaltproducts-4" class="fontRobReg fs-20 mt-2"></p>
		</div>
	</div>
	<div class="row justify-content-center">
		<div class="col-md-3 text-center my-3 px-3">
			<a data-translate="contactaltproducts-5" href="contactus.php" class="btn nav-menu-btn-wht-alt my-2 w-100 mx-0 shadow fs-16"></a>
		</div>
	</div>
</div>