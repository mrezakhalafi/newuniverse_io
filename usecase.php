<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/header-alt.php'); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/usecase-meta.php'); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/index-nav.php'); ?>
<?php

$_SESSION['previous_page'] = $_SESSION['current_page'];
$_SESSION['current_page'] = 3;
require_once($_SERVER['DOCUMENT_ROOT'] . '/state_control.php');

$timeSec = 'v=' . time();
?>

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">


<style>
	.fontWS {
		font-family: 'Poppins', sans-serif;
	}

	.fontJosefin {
		font-family: 'Poppins', sans-serif;
		font-weight: 300;
	}

	.card {
		border: 0px solid #ccc;
		/* border-radius: 5px !important; */
	}

	.card-body {
		background-color: white;
	}

	.card-body-grey {
		background-color: #f4f4f4 !important;
	}

	.card-header {
		border-bottom: 2px solid #d0cbcb;
		font-family: 'Poppins', sans-serif;
		background-color: rgb(244, 244, 244);
		/* padding: 0.75rem !important; */
	}

	.background-less {
		background-color: #fff !important;
	}

	.card-body {
		font-family: 'Poppins', sans-serif;
		font-size: 16px;
		font-weight: 300;
		/* padding: 0.5rem !important; */
	}

	.btn-link {
		color: #1799ad !important;
		padding: .375rem 0 !important;
		font-family: 'Poppins', sans-serif;
		font-size: 1.1rem;
	}

	.btn-link:hover {
		color: #1799ad !important;
	}

	@media screen and (max-width: 600px) {
		.btn-link {
			font-size: 1.1rem;
		}
	}

	a.anchor {
		display: block;
		position: relative;
		top: -30px;
		visibility: hidden;
	}

	@media (max-width: 767px) {
		.usecase-header {
			font-size: 30px;
		}

		.fs-24 {
			font-size: 20px;
		}
	}
</style>

<script>
	var _0x2d7f = ['1082808qKUwxb', '873197goSIAW', 'removeClass', 'parent', '.card-header\x20h4', 'click', 'mouseout', '.fa-chevron-up', 'ready', '1629328bYBVXX', '507027Ediadp', '1QhKUHD', 'width', 'shown.bs.collapse', 'addClass', '735525dEnIYe', '592789Ediivd', 'fa-chevron-down', 'fa-chevron-up', '244863lqUglR', 'hidden.bs.collapse', 'find', '1qXAywa'];
	var _0x1ea3 = function(_0x396109, _0x1306cd) {
		_0x396109 = _0x396109 - 0x1ed;
		var _0x2d7f50 = _0x2d7f[_0x396109];
		return _0x2d7f50;
	};
	var _0x469051 = _0x1ea3;
	(function(_0x2369bc, _0x53deb3) {
		var _0x1555e1 = _0x1ea3;
		while (!![]) {
			try {
				var _0x42f74d = -parseInt(_0x1555e1(0x1ef)) + -parseInt(_0x1555e1(0x1f0)) * parseInt(_0x1555e1(0x1ee)) + parseInt(_0x1555e1(0x202)) + parseInt(_0x1555e1(0x1f9)) + parseInt(_0x1555e1(0x1fe)) + parseInt(_0x1555e1(0x1ff)) * -parseInt(_0x1555e1(0x1fa)) + parseInt(_0x1555e1(0x1f8));
				if (_0x42f74d === _0x53deb3) break;
				else _0x2369bc['push'](_0x2369bc['shift']());
			} catch (_0x2c41f7) {
				_0x2369bc['push'](_0x2369bc['shift']());
			}
		}
	}(_0x2d7f, 0x8aa8d), $(document)[_0x469051(0x1f7)](function() {
		var _0x27fbe9 = _0x469051;
		$(window)['width']() < 0x3e0 && $('.collapse')['on'](_0x27fbe9(0x1fc), function() {
			var _0x16fa7b = _0x27fbe9;
			$(this)['parent']()[_0x16fa7b(0x1ed)]('.fa-chevron-down')['removeClass'](_0x16fa7b(0x200))[_0x16fa7b(0x1fd)]('fa-chevron-up');
		})['on'](_0x27fbe9(0x203), function() {
			var _0x18bd99 = _0x27fbe9;
			$(this)[_0x18bd99(0x1f2)]()[_0x18bd99(0x1ed)](_0x18bd99(0x1f6))['removeClass']('fa-chevron-up')[_0x18bd99(0x1fd)](_0x18bd99(0x200));
		}), $(window)[_0x27fbe9(0x1fb)]() >= 0x3e0 && ($(_0x27fbe9(0x1f3))['mouseover'](function() {
			var _0x3553a7 = _0x27fbe9;
			$(this)[_0x3553a7(0x1ed)]('a')[_0x3553a7(0x1f4)](), $(this)[_0x3553a7(0x1ed)]('.fa-chevron-down')[_0x3553a7(0x1f1)]('fa-chevron-down')[_0x3553a7(0x1fd)](_0x3553a7(0x201));
		}), $('.card-header\x20h4')[_0x27fbe9(0x1f5)](function() {
			var _0x2dad17 = _0x27fbe9;
			$(this)[_0x2dad17(0x1ed)]('a')['click'](), $(this)[_0x2dad17(0x1ed)](_0x2dad17(0x1f6))[_0x2dad17(0x1f1)](_0x2dad17(0x201))['addClass'](_0x2dad17(0x200));
		}));
	}));
</script>

<div class="container-fluid" id="usecase">

	<!-- 1. Customer Service/Helpdesk -->
	<a class="anchor" id="cs"></a>
	<div class="row py-3 mt-5 justify-content-center" data-aos="fade-right">
		<div class="col-md-12">
			<div class="row pt-5 my-4">
				<div class="col-md-5 d-flex order-lg-last justify-content-center mb-2">
					<img src="<?php echo base_url(); ?>cs-1.png" alt="" style="width: 100%;" id="contact-center" class="img-fluid align-self-center">
				</div>
				<div class="col-md-7 my-2">
					<div class="row justify-content-center">
						<div class="col-md-12 mb-4">
							<h1 data-translate="usecase-1" class="text-center fontWS fs-40 usecase-header"></h1>
							<p data-translate="usecase-2" class="text-center fontWS fs-24 text-secondary"></p>
						</div>
					</div>
					<div class="row mx-3">
						<div class="col-md-12">
							<div class="accordion" id="accordionExample13">
								<div class="card">
									<div class="card-header background-less" id="cs3">
										<h4 class="mb-0">
											<a data-translate="usecase-3" class="btn-link collapsed" data-target="#cs3-body" aria-expanded="true" aria-controls="cs3-body">
											</a>
											<!-- <i class="fa fa-chevron-down" style="float: right; margin-top: 10px; color: #01686d"></i> -->
										</h4>
									</div>

									<div id="cs3-body" class="collapse show" aria-labelledby="cs3" data-parent="#accordionExample13">
										<div data-translate="usecase-4" class="card-body">

										</div>
									</div>
								</div>
								<div class="card">
									<div class="card-header background-less" id="cs1">
										<h4 class="mb-0">
											<a data-translate="usecase-5" class="btn-link collapsed" data-target="#cs1-body" aria-expanded="true" aria-controls="cs1-body">
											</a>
											<!-- <i class="fas fa-chevron-down" style="float: right; margin-top: 10px; color: #01686d"></i> -->
										</h4>
									</div>

									<div id="cs1-body" class="collapse show" aria-labelledby="cs1" data-parent="#accordionExample13">
										<div data-translate="usecase-6" class="card-body">

										</div>
									</div>
								</div>
								<div class="card">
									<div class="card-header background-less" id="cs2">
										<h4 class="mb-0">
											<a data-translate="usecase-7" class="btn-link collapsed" data-target="#cs2-body" aria-expanded="true" aria-controls="cs2-body">
											</a>
											<!-- <i class="fas fa-chevron-down" style="float: right; margin-top: 10px; color: #01686d"></i> -->
										</h4>
									</div>

									<div id="cs2-body" class="collapse show" aria-labelledby="cs2" data-parent="#accordionExample13">
										<div data-translate="usecase-8" class="card-body">

										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- 2. Retail -->
	<a class="anchor" id="retail"></a>
	<div class="row py-3 justify-content-center bg-light" data-aos="fade-left">
		<div class="col-md-12">
			<div class="row my-4">
				<div class="col-md-5 d-flex justify-content-center mb-2">
					<img src="retail-1.png" alt="" id="retail-commerce" style="width: 100%;" class="img-fluid align-self-center">
				</div>
				<div class="col-md-7 my-2">
					<div class="row justify-content-center">
						<div class="col-md-12 mb-4">
							<h1 data-translate="usecase-9" class="text-center fontWS fs-40 usecase-header"></h1>
							<p data-translate="usecase-10" class="text-center fontWS fs-24 text-secondary"></p>
						</div>
					</div>
					<div class="row mx-3">
						<div class="col-md-12">
							<div class="accordion" id="accordionExample2">
								<div class="card">
									<div class="card-header" id="retail1">
										<h4 class="mb-0">
											<a data-translate="usecase-11" class="btn-link collapsed" data-target="#retail1-body" aria-expanded="true" aria-controls="retail1-body">
											</a>
											<!-- <i class="fas fa-chevron-down" style="float: right; margin-top: 10px; color: #01686d"></i> -->
										</h4>
									</div>

									<div id="retail1-body" class="collapse show" aria-labelledby="retail1" data-parent="#accordionExample2">
										<div data-translate="usecase-12" class="card-body card-body-grey">

										</div>
									</div>
								</div>
								<div class="card">
									<div class="card-header" id="retail2">
										<h4 class="mb-0">
											<a data-translate="usecase-13" class="btn-link collapsed" data-target="#retail2-body" aria-expanded="true" aria-controls="retail2-body">
											</a>

											<!-- <i class="fas fa-chevron-down" style="float: right; margin-top: 10px; color: #01686d"></i> -->

										</h4>
									</div>

									<div id="retail2-body" class="collapse show" aria-labelledby="retail2" data-parent="#accordionExample2">
										<div data-translate="usecase-14" class="card-body card-body-grey">

										</div>
									</div>
								</div>
								<div class="card">
									<div class="card-header" id="retail3">
										<h4 class="mb-0">
											<a data-translate="usecase-15" class="btn-link collapsed" data-target="#retail3-body" aria-expanded="true" aria-controls="retail3-body">
											</a>
											<!-- <i class="fas fa-chevron-down" style="float: right; margin-top: 10px; color: #01686d"></i> -->

										</h4>
									</div>

									<div id="retail3-body" class="collapse show" aria-labelledby="retail3" data-parent="#accordionExample2">
										<div data-translate="usecase-16" class="card-body card-body-grey">

										</div>
									</div>
								</div>
								<div class="card">
									<div class="card-header" id="retail4">
										<h4 class="mb-0">
											<a data-translate="usecase-17" class="btn-link collapsed" data-target="#retail4-body" aria-expanded="true" aria-controls="retail4-body">
											</a>
											<!-- <i class="fas fa-chevron-down" style="float: right; margin-top: 10px; color: #01686d"></i> -->
										</h4>
									</div>

									<div id="retail4-body" class="collapse show" aria-labelledby="retail4" data-parent="#accordionExample2">
										<div data-translate="usecase-18" class="card-body card-body-grey">

										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- 3. Education -->
	<a class="anchor" id="education"></a>
	<div class="row py-3 justify-content-center" data-aos="fade-right">
		<div class="col-md-12">
			<div class="row my-4">
				<div class="col-md-5 order-lg-last d-flex justify-content-center mb-2">
					<img src="education-1.png" alt="" id="educations" style="width: 100%;" class="img-fluid align-self-center">
				</div>
				<div class="col-md-7 my-2">
					<div class="row justify-content-center">
						<div class="col-md-12 mb-4">
							<h1 data-translate="usecase-19" class="text-center fontWS fs-40 usecase-header"></h1>
							<p data-translate="usecase-20" class="text-center fontWS fs-24 text-secondary"></p>
						</div>
					</div>
					<div class="row mx-3">
						<div class="col-md-12">
							<div class="accordion" id="accordionExample8">
								<div class="card">
									<div class="card-header background-less" id="education1">
										<h4 class="mb-0">
											<a data-translate="usecase-21" class="btn-link collapsed" data-target="#education1-body" aria-expanded="true" aria-controls="education1-body">
											</a>
											<!-- <i class="fas fa-chevron-down" style="float: right; margin-top: 10px; color: #01686d"></i> -->
										</h4>
									</div>

									<div id="education1-body" class="collapse show" aria-labelledby="education1" data-parent="#accordionExample8">
										<div data-translate="usecase-22" class="card-body">

										</div>
									</div>
								</div>
								<div class="card">
									<div class="card-header background-less" id="education2">
										<h4 class="mb-0">
											<a data-translate="usecase-23" class="btn-link collapsed" data-target="#education2-body" aria-expanded="true" aria-controls="education2-body">
											</a>
											<!-- <i class="fas fa-chevron-down" style="float: right; margin-top: 10px; color: #01686d"></i> -->
										</h4>
									</div>

									<div id="education2-body" class="collapse show" aria-labelledby="education2" data-parent="#accordionExample8">
										<div data-translate="usecase-24" class="card-body">

										</div>
									</div>
								</div>
								<div class="card">
									<div class="card-header background-less" id="education3">
										<h4 class="mb-0">
											<a data-translate="usecase-25" class="btn-link collapsed" data-target="#education3-body" aria-expanded="true" aria-controls="education2-body">
											</a>
											<!-- <i class="fas fa-chevron-down" style="float: right; margin-top: 10px; color: #01686d"></i> -->
										</h4>
									</div>

									<div id="education3-body" class="collapse show" aria-labelledby="education3" data-parent="#accordionExample8">
										<div data-translate="usecase-26" class="card-body">
											Students and educators can easily discuss study materials in group video calls equipped with screen sharing and whiteboarding to ensure difficult concepts are communicated effectively.
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- 4. Healthcare -->
	<a class="anchor" id="healthcare"></a>
	<div class="row py-3 justify-content-center bg-light" data-aos="fade-left">
		<div class="col-md-12">
			<div class="row my-4">
				<div class="col-md-5 d-flex justify-content-center mb-2">
					<img src="<?php echo base_url(); ?>healthcare-1.png" id="healthcares" alt="" style="width: 100%;" class="img-fluid align-self-center">
				</div>
				<div class="col-md-7 align-self-center">
					<div class="row justify-content-center">
						<div class="col-md-12 mb-4">
							<h1 data-translate="usecase-27" class="text-center fontWS fs-40 usecase-header"></h1>
							<p data-translate="usecase-28" class="text-center fontWS fs-24 text-secondary"></p>
						</div>
					</div>
					<div class="row mx-3">
						<div class="col-md-12">
							<div class="accordion" id="accordionExample7">
								<div class="card">
									<div class="card-header" id="healthcare1">
										<h4 class="mb-0">
											<a data-translate="usecase-29" class="btn-link collapsed" data-target="#healthcare1-body" aria-expanded="true" aria-controls="healthcare1-body">
											</a>
											<!-- <i class="fas fa-chevron-down" style="float: right; margin-top: 10px; color: #01686d"></i> -->
										</h4>
									</div>

									<div id="healthcare1-body" class="collapse show" aria-labelledby="healthcare1" data-parent="#accordionExample7">
										<div data-translate="usecase-30" class="card-body card-body-grey">

										</div>
									</div>
								</div>
								<div class="card">
									<div class="card-header" id="healthcare2">
										<h4 class="mb-0">
											<a data-translate="usecase-31" class="btn-link collapsed" data-target="#healthcare2-body" aria-expanded="true" aria-controls="healthcare2-body">
											</a>
											<!-- <i class="fas fa-chevron-down" style="float: right; margin-top: 10px; color: #01686d"></i> -->
										</h4>
									</div>

									<div id="healthcare2-body" class="collapse show" aria-labelledby="healthcare2" data-parent="#accordionExample7">
										<div data-translate="usecase-32" class="card-body card-body-grey">

										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- 5. Hospitality -->
	<a class="anchor" id="hospitality"></a>
	<div class="row py-3 justify-content-center" data-aos="fade-right">
		<div class="col-md-12">
			<div class="row my-4">
				<div class="col-md-5 order-lg-last d-flex justify-content-center mb-2">
					<img src="<?php echo base_url(); ?>hospitality-1.png" id="hospitalitys" alt="" style="width: 100%;" class="img-fluid align-self-center">
				</div>
				<div class="col-md-7 my-2">
					<div class="row justify-content-center">
						<div class="col-md-12 mb-4">
							<h1 data-translate="usecase-33" class="text-center fontWS fs-40 usecase-header"></h1>
							<p data-translate="usecase-34" class="text-center fontWS fs-24 text-secondary"></p>
						</div>
					</div>
					<div class="row mx-3">
						<div class="col-md-12">
							<div class="accordion" id="accordionExample3">
								<div class="card">
									<div class="card-header background-less" id="hospitality1">
										<h4 class="mb-0">
											<a data-translate="usecase-35" class="btn-link collapsed" data-target="#hospitality1-body" aria-expanded="true" aria-controls="hospitality1-body">
											</a>
											<!-- <i class="fas fa-chevron-down" style="float: right; margin-top: 10px; color: #01686d"></i> -->

										</h4>
									</div>

									<div id="hospitality1-body" class="collapse show" aria-labelledby="hospitality1" data-parent="#accordionExample3">
										<div data-translate="usecase-36" class="card-body">

										</div>
									</div>
								</div>
								<div class="card">
									<div class="card-header background-less" id="hospitality2">
										<h4 class="mb-0">
											<a data-translate="usecase-37" class="btn-link collapsed" data-target="#hospitality2-body" aria-expanded="true" aria-controls="hospitality2-body">
											</a>
											<!-- <i class="fas fa-chevron-down" style="float: right; margin-top: 10px; color: #01686d"></i> -->

										</h4>
									</div>

									<div id="hospitality2-body" class="collapse show" aria-labelledby="hospitality2" data-parent="#accordionExample3">
										<div data-translate="usecase-38" class="card-body">

										</div>
									</div>
								</div>
								<div class="card">
									<div class="card-header background-less" id="hospitality3">
										<h4 class="mb-0">
											<a data-translate="usecase-39" class="btn-link collapsed" data-target="#hospitality3-body" aria-expanded="true" aria-controls="hospitality3-body">
											</a>
											<!-- <i class="fas fa-chevron-down" style="float: right; margin-top: 10px; color: #01686d"></i> -->
										</h4>
									</div>

									<div id="hospitality3-body" class="collapse show" aria-labelledby="hospitality3" data-parent="#accordionExample3">
										<div data-translate="usecase-40" class="card-body">

										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- 6. Finance -->
	<a class="anchor" id="finance"></a>
	<div class="row py-3 justify-content-center bg-light" data-aos="fade-left">
		<div class="col-md-12">
			<div class="row my-4">
				<div class="col-md-5 d-flex justify-content-center mb-2">
					<img src="financing-1.png" id="finances" alt="" style="width: 100%;" class="img-fluid align-self-center">
				</div>
				<div class="col-md-7 my-2">
					<div class="row justify-content-center">
						<div class="col-md-12 mb-4">
							<h1 data-translate="usecase-41" class="text-center fontWS fs-40 usecase-header"></h1>
							<p data-translate="usecase-42" class="text-center fontWS fs-24 text-secondary"></p>
						</div>
					</div>
					<div class="row mx-3">
						<div class="col-md-12">
							<div class="accordion" id="accordionExample4">
								<div class="card">
									<div class="card-header" id="finance1">
										<h4 class="mb-0">
											<a data-translate="usecase-43" class="btn-link collapsed" data-target="#finance1-body" aria-expanded="true" aria-controls="finance1-body">
											</a>
											<!-- <i class="fas fa-chevron-down" style="float: right; margin-top: 10px; color: #01686d"></i> -->

										</h4>
									</div>

									<div id="finance1-body" class="collapse show" aria-labelledby="finance1" data-parent="#accordionExample4">
										<div data-translate="usecase-44" class="card-body card-body-grey">

										</div>
									</div>
								</div>
								<div class="card">
									<div class="card-header" id="finance2">
										<h4 class="mb-0">
											<a data-translate="usecase-45" class="btn-link collapsed" data-target="#finance2-body" aria-expanded="true" aria-controls="finance2-body">
											</a>
											<!-- <i class="fas fa-chevron-down" style="float: right; margin-top: 10px; color: #01686d"></i> -->
										</h4>
									</div>

									<div id="finance2-body" class="collapse show" aria-labelledby="finance2" data-parent="#accordionExample4">
										<div data-translate="usecase-46" class="card-body card-body-grey">

										</div>
									</div>
								</div>
								<div class="card">
									<div class="card-header" id="finance3">
										<h4 class="mb-0">
											<a data-translate="usecase-47" class="btn-link collapsed" data-target="#finance3-body" aria-expanded="true" aria-controls="finance3-body">
											</a>
											<!-- <i class="fas fa-chevron-down" style="float: right; margin-top: 10px; color: #01686d"></i> -->
										</h4>
									</div>

									<div id="finance3-body" class="collapse show" aria-labelledby="finance3" data-parent="#accordionExample4">
										<div data-translate="usecase-48" class="card-body card-body-grey">

										</div>
									</div>
								</div>
								<div class="card">
									<div class="card-header" id="finance4">
										<h4 class="mb-0">
											<a data-translate="usecase-49" class="btn-link collapsed " data-target="#finance4-body" aria-expanded="true" aria-controls="finance4-body">
											</a>
											<!-- <i class="fas fa-chevron-down" style="float: right; margin-top: 10px; color: #01686d"></i> -->
										</h4>
									</div>

									<div id="finance4-body" class="collapse show" aria-labelledby="finance4" data-parent="#accordionExample4">
										<div data-translate="usecase-50" class="card-body card-body-grey">

										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<!-- 7. Food & Beverages -->
	<a class="anchor" id="food"></a>
	<div class="row py-3 justify-content-center" data-aos="fade-right">
		<div class="col-md-12">
			<div class="row my-4">
				<div class="col-md-5 d-flex order-lg-last justify-content-center mb-2">
					<img src="f_b-1.png" alt="" id="f_b" style="width: 100%;" class="img-fluid align-self-center">
				</div>
				<div class="col-md-7 my-2">
					<div class="row justify-content-center">
						<div class="col-md-12 mb-4">
							<h1 data-translate="usecase-51" class="text-center fontWS fs-40 usecase-header"></h1>
							<p data-translate="usecase-52" class="text-center fontWS fs-24 text-secondary"></p>
						</div>
					</div>
					<div class="row mx-3">
						<div class="col-md-12">
							<div class="accordion" id="accordionExample10">
								<div class="card">
									<div class="card-header background-less" id="food1">
										<h4 class="mb-0">
											<a data-translate="usecase-53" class="btn-link collapsed" data-target="#food1-body" aria-expanded="true" aria-controls="food1-body">
											</a>
											<!-- <i class="fas fa-chevron-down" style="float: right; margin-top: 10px; color: #01686d"></i> -->
										</h4>
									</div>

									<div id="food1-body" class="collapse show" aria-labelledby="food1" data-parent="#accordionExample10">
										<div data-translate="usecase-54" class="card-body">

										</div>
									</div>
								</div>
								<div class="card">
									<div class="card-header background-less" id="food2">
										<h4 class="mb-0">
											<a data-translate="usecase-55" class="btn-link collapsed" data-target="#food2-body" aria-expanded="true" aria-controls="food2-body">
											</a>
											<!-- <i class="fas fa-chevron-down" style="float: right; margin-top: 10px; color: #01686d"></i> -->
										</h4>
									</div>

									<div id="food2-body" class="collapse show" aria-labelledby="food2" data-parent="#accordionExample10">
										<div data-translate="usecase-56" class="card-body">
											Help your customers satisfy their cravings. Users only need to type one word and the Bot will offer the available dishes that they crave.
										</div>
									</div>
								</div>
								<div class="card">
									<div class="card-header background-less" id="food3">
										<h4 class="mb-0">
											<a data-translate="usecase-57" class="btn-link collapsed" data-target="#food3-body" aria-expanded="true" aria-controls="food3-body">
											</a>
											<!-- <i class="fas fa-chevron-down" style="float: right; margin-top: 10px; color: #01686d"></i> -->
										</h4>
									</div>

									<div id="food3-body" class="collapse show" aria-labelledby="food3" data-parent="#accordionExample10">
										<div data-translate="usecase-58" class="card-body">

										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<!-- 8. Enterprise -->
	<a class="anchor" id="enterprise"></a>
	<div class="row py-3 justify-content-center bg-light" data-aos="fade-left">
		<div class="col-md-12">
			<div class="row pt-4">
				<div class="col-md-5 order-lg-last d-flex justify-content-center mb-2">
					<img src="enterprise-1.png" id="enterprises" alt="" style="width: 100%;" class="img-fluid align-self-center">
				</div>
				<div class="col-md-7 order-lg-last my-2">
					<div class="row justify-content-center">
						<div class="col-md-12 mt-4">
							<h1 data-translate="usecase-59" class="text-center fontWS fs-40 usecase-header"></h1>
							<p data-translate="usecase-60" class="text-center fontWS fs-24 text-secondary"></p>
						</div>
					</div>
					<div class="row mx-3">
						<div class="col-md-12">
							<div class="accordion" id="accordionExample1">
								<div class="card">
									<div class="card-header" id="enterprise1">
										<h4 class="mb-0">
											<a data-translate="usecase-61" class="btn-link collapsed" data-target="#enterprise1-body" aria-expanded="false" aria-controls="enterprise1-body">
											</a>


											<!-- <i class="fas fa-chevron-down" style="float: right; margin-top: 10px; color: #01686d;"></i> -->
										</h4>
									</div>

									<div id="enterprise1-body" class="collapse show" aria-labelledby="enterprise1" data-parent="#accordionExample1">
										<div data-translate="usecase-62" class="card-body card-body-grey">

										</div>
									</div>
								</div>
								<div class="card">
									<div class="card-header" id="enterprise2">
										<h4 class="mb-0">
											<a data-translate="usecase-63" class="btn-link collapsed" data-target="#enterprise2-body" aria-expanded="true" aria-controls="enterprise2-body">
											</a>

											<!-- <i class="fas fa-chevron-down" style="float: right; margin-top: 10px; color: #01686d;"></i> -->

										</h4>
									</div>

									<div id="enterprise2-body" class="collapse show" aria-labelledby="enterprise2" data-parent="#accordionExample1">
										<div data-translate="usecase-64" class="card-body card-body-grey">

										</div>
									</div>
								</div>
								<div class="card">
									<div class="card-header" id="enterprise3">
										<h4 class="mb-0">
											<a data-translate="usecase-65" class="btn-link collapsed" data-target="#enterprise3-body" aria-expanded="true" aria-controls="enterprise3-body">
											</a>

											<!-- <i class="fas fa-chevron-down" style="float: right; margin-top: 10px; color: #01686d;"></i> -->

										</h4>
									</div>

									<div id="enterprise3-body" class="collapse show" aria-labelledby="enterprise3" data-parent="#accordionExample1">
										<div data-translate="usecase-66" class="card-body card-body-grey">

										</div>
									</div>
								</div>
								<div class="card">
									<div class="card-header" id="enterprise4">
										<h4 class="mb-0">
											<a data-translate="usecase-67" class="btn-link collapsed" data-target="#enterprise4-body" aria-expanded="true" aria-controls="enterprise4-body">
											</a>

											<!-- <i class="fas fa-chevron-down" style="float: right; margin-top: 10px; color: #01686d;"></i> -->

										</h4>
									</div>

									<div id="enterprise4-body" class="collapse show" aria-labelledby="enterprise4" data-parent="#accordionExample1">
										<div data-translate="usecase-68" class="card-body card-body-grey">

										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- 9. Transportation & Logistics -->
	<a class="anchor" id="transport"></a>
	<div class="row py-3 justify-content-center" data-aos="fade-right">
		<div class="col-md-12">
			<div class="row my-4">
				<div class="col-md-5 d-flex order-lg-last justify-content-center mb-2">
					<img src="logistics-1.png" id="transport_logistic" alt="" style="width: 100%;" class="img-fluid align-self-center">
				</div>
				<div class="col-md-7 my-2">
					<div class="row justify-content-center">
						<div class="col-md-12 mb-4">
							<h1 data-translate="usecase-69" class="text-center fontWS fs-40 usecase-header"></h1>
							<p data-translate="usecase-70" class="text-center fontWS fs-24 text-secondary"></p>
						</div>
					</div>
					<div class="row mx-3">
						<div class="col-md-12">
							<div class="accordion" id="accordionExample9">
								<div class="card">
									<div class="card-header background-less" id="transport1">
										<h4 class="mb-0">
											<a data-translate="usecase-71" class="btn-link collapsed" data-target="#transport1-body" aria-expanded="true" aria-controls="transport1-body">
											</a>
											<!-- <i class="fas fa-chevron-down" style="float: right; margin-top: 10px; color: #01686d"></i> -->
										</h4>
									</div>

									<div id="transport1-body" class="collapse show" aria-labelledby="transport1" data-parent="#accordionExample9">
										<div data-translate="usecase-72" class="card-body">

										</div>
									</div>
								</div>
								<div class="card">
									<div class="card-header background-less" id="transport2">
										<h4 class="mb-0">
											<a data-translate="usecase-73" class="btn-link collapsed" data-target="#transport2-body" aria-expanded="true" aria-controls="transport2-body">
											</a>
											<!-- <i class="fas fa-chevron-down" style="float: right; margin-top: 10px; color: #01686d"></i> -->
										</h4>
									</div>

									<div id="transport2-body" class="collapse show" aria-labelledby="transport2" data-parent="#accordionExample9">
										<div data-translate="usecase-74" class="card-body">

										</div>
									</div>
								</div>
								<div class="card">
									<div class="card-header background-less" id="transport3">
										<h4 class="mb-0">
											<a data-translate="usecase-75" class="btn-link collapsed" data-target="#transport3-body" aria-expanded="true" aria-controls="transport3-body">
											</a>
											<!-- <i class="fas fa-chevron-down" style="float: right; margin-top: 10px; color: #01686d"></i> -->
										</h4>
									</div>

									<div id="transport3-body" class="collapse show" aria-labelledby="transport3" data-parent="#accordionExample9">
										<div data-translate="usecase-76" class="card-body">

										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- 10. Wholesale Distribution -->
	<a class="anchor" id="distribution"></a>
	<div class="row py-3 justify-content-center bg-light" data-aos="fade-left">
		<div class="col-md-12">
			<div class="row my-4">
				<div class="col-md-5 d-flex justify-content-center mb-2">
					<img src="distribution-1.png" alt="" id="wholase_dist" style="width: 100%;" class="img-fluid align-self-center">
				</div>
				<div class="col-md-7 my-2">
					<div class="row justify-content-center">
						<div class="col-md-12 mb-4">
							<h1 data-translate="usecase-77" class="text-center fontWS fs-0 usecase-header"></h1>
							<p data-translate="usecase-78" class="text-center fontWS fs-24 text-secondary"></p>
						</div>
					</div>
					<div class="row mx-3">
						<div class="col-md-12">
							<div class="accordion" id="accordionExample11">
								<div class="card">
									<div class="card-header" id="distribution1">
										<h4 class="mb-0">
											<a data-translate="usecase-79" class="btn-link collapsed" data-target="#distribution1-body" aria-expanded="true" aria-controls="distribution1-body">
											</a>
											<!-- <i class="fas fa-chevron-down" style="float: right; margin-top: 10px; color: #01686d"></i> -->
										</h4>
									</div>

									<div id="distribution1-body" class="collapse show" aria-labelledby="distribution1" data-parent="#accordionExample11">
										<div data-translate="usecase-80" class="card-body card-body-grey">


										</div>
									</div>
								</div>
								<div class="card">
									<div class="card-header" id="distribution2">
										<h4 class="mb-0">
											<a data-translate="usecase-81" class="btn-link collapsed" data-target="#distribution2-body" aria-expanded="true" aria-controls="distribution2-body">
											</a>
											<!-- <i class="fas fa-chevron-down" style="float: right; margin-top: 10px; color: #01686d"></i> -->
										</h4>
									</div>

									<div id="distribution2-body" class="collapse show" aria-labelledby="distribution2" data-parent="#accordionExample11">
										<div data-translate="usecase-82" class="card-body card-body-grey">

										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<!-- 11. Real Estate -->
	<a class="anchor" id="realestate"></a>
	<div class="row py-3 justify-content-center" data-aos="fade-right">
		<div class="col-md-12">
			<div class="row my-4">
				<div class="col-md-5 order-lg-last d-flex justify-content-center mb-2">
					<img src="open-house-1.png" alt="" id="real_estate" style="width: 100%;" class="img-fluid align-self-center">
				</div>
				<div class="col-md-7 my-2">
					<div class="row justify-content-center">
						<div class="col-md-12 mb-4">
							<h1 data-translate="usecase-83" class="text-center fontWS fs-40 usecase-header"></h1>
							<p data-translate="usecase-84" class="text-center fontWS fs-24 text-secondary"></p>
						</div>
					</div>
					<div class="row mx-3">
						<div class="col-md-12">
							<div class="accordion" id="accordionExample6">
								<div class="card">
									<div class="card-header background-less" id="realestate1">
										<h4 class="mb-0">
											<a data-translate="usecase-85" class="btn-link collapsed" data-target="#realestate1-body" aria-expanded="true" aria-controls="realestate1-body">
											</a>
											<!-- <i class="fas fa-chevron-down" style="float: right; margin-top: 10px; color: #01686d"></i> -->
										</h4>
									</div>

									<div id="realestate1-body" class="collapse show" aria-labelledby="realestate1" data-parent="#accordionExample6">
										<div data-translate="usecase-86" class="card-body">

										</div>
									</div>
								</div>
								<div class="card">
									<div class="card-header background-less" id="realestate2">
										<h4 class="mb-0">
											<a data-translate="usecase-87" class="btn-link collapsed" data-target="#realestate2-body" aria-expanded="true" aria-controls="realestate2-body">
											</a>
											<!-- <i class="fas fa-chevron-down" style="float: right; margin-top: 10px; color: #01686d"></i> -->
										</h4>
									</div>

									<div id="realestate2-body" class="collapse show" aria-labelledby="realestate2" data-parent="#accordionExample6">
										<div data-translate="usecase-88" class="card-body">

										</div>
									</div>
								</div>
								<div class="card">
									<div class="card-header background-less" id="realestate3">
										<h4 class="mb-0">
											<a data-translate="usecase-89" class="btn-link collapsed" data-target="#realestate3-body" aria-expanded="true" aria-controls="realestate3-body">
											</a>
											<!-- <i class="fas fa-chevron-down" style="float: right; margin-top: 10px; color: #01686d"></i> -->
										</h4>
									</div>

									<div id="realestate3-body" class="collapse show" aria-labelledby="realestate3" data-parent="#accordionExample6">
										<div data-translate="usecase-90" class="card-body">

										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<!-- 12. Brand -->
	<a class="anchor" id="brand"></a>
	<div class="row py-3 justify-content-center bg-light" data-aos="fade-left">
		<div class="col-md-12">
			<div class="row my-4">
				<div class="col-md-5 d-flex justify-content-center mb-2">
					<img src="brand-1.png" alt="" id="brands" style="width: 100%;" class="img-fluid align-self-center">
				</div>
				<div class="col-md-7 align-self-center">
					<div class="row justify-content-center">
						<div class="col-md-12 mb-4">
							<h1 data-translate="usecase-91" class="text-center fontWS fs-40 usecase-header"></h1>
							<p data-translate="usecase-92" class="text-center fontWS fs-24 text-secondary"></p>
						</div>
					</div>
					<div class="row mx-3">
						<div class="col-md-12">
							<div class="accordion" id="accordionExample12">
								<div class="card">
									<div class="card-header" id="brand1">
										<h4 class="mb-0">
											<a data-translate="usecase-93" class="btn-link collapsed" data-target="#brand1-body" aria-expanded="true" aria-controls="brand1-body">
											</a>
											<!-- <i class="fas fa-chevron-down" style="float: right; margin-top: 10px; color: #01686d"></i> -->
										</h4>
									</div>

									<div id="brand1-body" class="collapse show" aria-labelledby="brand1" data-parent="#accordionExample12">
										<div data-translate="usecase-94" class="card-body card-body-grey">

										</div>
									</div>
								</div>
								<div class="card">
									<div class="card-header" id="brand2">
										<h4 class="mb-0">
											<a data-translate="usecase-95" class="btn-link collapsed" data-target="#brand2-body" aria-expanded="true" aria-controls="brand2-body">
											</a>
											<!-- <i class="fas fa-chevron-down" style="float: right; margin-top: 10px; color: #01686d"></i> -->
										</h4>
									</div>

									<div id="brand2-body" class="collapse show" aria-labelledby="brand2" data-parent="#accordionExample12">
										<div data-translate="usecase-96" class="card-body card-body-grey">

										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>



	<br>
	<br>
	<!-- <hr width="75%"> -->

</div>

<!-- <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script> -->

<!-- <script src="/fontawesome/js/all.js"></script> -->

<script>
	$(document).ready(function() {

		var images_cs = [
			"<?php echo base_url(); ?>cs-1.png",
			"<?php echo base_url(); ?>cs-2.png",
		]

		var images_retail = [
			"<?php echo base_url(); ?>retail-1.png",
			"<?php echo base_url(); ?>retail-2.png",
		]

		var images_education = [
			"<?php echo base_url(); ?>education-1.png",
			"<?php echo base_url(); ?>education-2.png",
		]

		var images_healthcare = [
			"<?php echo base_url(); ?>healthcare-1.png",
			"<?php echo base_url(); ?>healthcare-2.png",
		]

		var images_hospitality = [
			"<?php echo base_url(); ?>hospitality-1.png",
			"<?php echo base_url(); ?>hospitality-2.png",
		]

		var images_financing = [
			"<?php echo base_url(); ?>financing-1.png",
			"<?php echo base_url(); ?>financing-2.png",
		]

		var images_f_b = [
			"<?php echo base_url(); ?>f_b-1.png",
			"<?php echo base_url(); ?>f_b-2.png",
		]

		var images_enterprise = [
			"<?php echo base_url(); ?>enterprise-1.png",
			"<?php echo base_url(); ?>enterprise-2.png",
		]

		var images_logistic = [
			"<?php echo base_url(); ?>logistics-1.png",
			"<?php echo base_url(); ?>logistics-2.png",
		]

		var images_distribution = [
			"<?php echo base_url(); ?>distribution-1.png",
			"<?php echo base_url(); ?>distribution-2.png",
		]

		var images_real_estate = [
			"<?php echo base_url(); ?>open-house-1.png",
			"<?php echo base_url(); ?>open-house-2.png",
		]

		var images_brand = [
			"<?php echo base_url(); ?>brand-1.png",
			"<?php echo base_url(); ?>brand-2.png",
		]

		var current = 0;

		setInterval(function() {

			$('#contact-center').attr('src', images_cs[current]);
			$('#retail-commerce').attr('src', images_retail[current]);
			$('#educations').attr('src', images_education[current]);
			$('#healthcares').attr('src', images_healthcare[current]);
			$('#hospitalitys').attr('src', images_hospitality[current]);
			$('#finances').attr('src', images_financing[current]);
			$('#f_b').attr('src', images_f_b[current]);
			$('#enterprises').attr('src', images_enterprise[current]);
			$('#transport_logistic').attr('src', images_logistic[current]);
			$('#wholase_dist').attr('src', images_distribution[current]);
			$('#real_estate').attr('src', images_real_estate[current]);
			$('#brands').attr('src', images_brand[current]);

			current = (current < images_retail.length - 1) ? current + 1 : 0;
		}, 1000);

		$("#animate-clickme").animate({
			top: '+=60px'
		}, 2000);
		$("#animate-clickme").animate({
			top: '-=60px'
		}, 2000);

		setInterval(function() {
			$("#animate-clickme").animate({
				top: '+=60px'
			}, 2000);
			$("#animate-clickme").animate({
				top: '-=60px'
			}, 2000);

		}, 2000);


		var animateLevelUpTi1;
		var animateLevelUpTi2;
		var animateLevelUpTi3;
		var animateLevelUpTi4;

		// runLevelUpAnimation();
		// resumeLevelUpAnimation();

		// $('#FB_1').on("mouseenter", function () {
		//         clearAnimateLevelUp();
		//         $('#FB_1').attr('src','palio_button/assets/Untitled110_20220121183610.png');
		//         $('#FB_2').attr('src','newAssets/floating_button/button_chat.png');
		//         $('#FB_3').attr('src','newAssets/floating_button/button_call.png');
		//         $('#FB_4').attr('src','newAssets/floating_button/button_stream.png');
		//     }).on("mouseleave", function () {
		//         resumeLevelUpAnimation();
		//     });

		//     $('#FB_2').on("mouseenter", function () {
		//        clearAnimateLevelUp();
		//         $('#FB_1').attr('src','newAssets/floating_button/button_cc.png');
		//         $('#FB_2').attr('src','palio_button/assets/Untitled110_20220121183614.png');
		//         $('#FB_3').attr('src','newAssets/floating_button/button_call.png');
		//         $('#FB_4').attr('src','newAssets/floating_button/button_stream.png');
		//     }).on("mouseleave", function () {
		//         resumeLevelUpAnimation();
		//     });

		//     $('#FB_3').on("mouseenter", function () {
		//        clearAnimateLevelUp();
		//         $('#FB_1').attr('src','newAssets/floating_button/button_cc.png');
		//         $('#FB_2').attr('src','newAssets/floating_button/button_chat.png');
		//         $('#FB_3').attr('src','palio_button/assets/Untitled110_20220121183621.png');
		//         $('#FB_4').attr('src','newAssets/floating_button/button_stream.png');
		//     }).on("mouseleave", function () {
		//         resumeLevelUpAnimation();
		//     });

		//     $('#FB_4').on("mouseenter", function () {
		//        clearAnimateLevelUp();
		//         $('#FB_1').attr('src','newAssets/floating_button/button_cc.png');
		//         $('#FB_2').attr('src','newAssets/floating_button/button_chat.png');
		//         $('#FB_3').attr('src','newAssets/floating_button/button_call.png');
		//         $('#FB_4').attr('src','palio_button/assets/Untitled110_20220121183617.png');
		//     }).on("mouseleave", function () {
		//         resumeLevelUpAnimation();
		//     });

		function clearAnimateLevelUp() {
			clearInterval(animateLevelUpIn);
			clearTimeout(animateLevelUpTi1);
			clearTimeout(animateLevelUpTi2);
			clearTimeout(animateLevelUpTi3);
			clearTimeout(animateLevelUpTi4);
		}

		function runLevelUpAnimation() {
			animateLevelUpTi1 = setTimeout(function() {
				$('#FB_4').attr('src', 'palio_button/assets/Untitled110_20220121183617.png');
				$('#FB_3').attr('src', '/newAssets/floating_button/button_call.png');
				$('#FB_2').attr('src', '/newAssets/floating_button/button_chat.png');
				$('#FB_1').attr('src', '/newAssets/floating_button/button_cc.png');
			}, 1000);

			animateLevelUpTi2 = setTimeout(function() {
				$('#FB_3').attr('src', 'palio_button/assets/Untitled110_20220121183621.png');
				$('#FB_4').attr('src', '/newAssets/floating_button/button_stream.png');
				$('#FB_2').attr('src', '/newAssets/floating_button/button_chat.png');
				$('#FB_1').attr('src', '/newAssets/floating_button/button_cc.png');
			}, 2000);

			animateLevelUpTi3 = setTimeout(function() {
				$('#FB_2').attr('src', 'palio_button/assets/Untitled110_20220121183614.png');
				$('#FB_3').attr('src', '/newAssets/floating_button/button_call.png');
				$('#FB_4').attr('src', '/newAssets/floating_button/button_stream.png');
				$('#FB_1').attr('src', '/newAssets/floating_button/button_cc.png');
			}, 3000);

			animateLevelUpTi4 = setTimeout(function() {
				$('#FB_1').attr('src', 'palio_button/assets/Untitled110_20220121183610.png');
				$('#FB_3').attr('src', '/newAssets/floating_button/button_call.png');
				$('#FB_2').attr('src', '/newAssets/floating_button/button_chat.png');
				$('#FB_4').attr('src', '/newAssets/floating_button/button_stream.png');
			}, 4000);
		}

		function resumeLevelUpAnimation() {

			runLevelUpAnimation();

			animateLevelUpIn = setInterval(function() {
				runLevelUpAnimation();
			}, 4000);
		}

	});
</script>

<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/contact-alt.php'); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/contact-button.php'); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/footer-alt.php'); ?>
<footer class="footerBanner-alt"></footer>