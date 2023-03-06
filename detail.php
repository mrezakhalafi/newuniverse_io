<link rel="icon" type="image/x-icon" href="newAssets/fav.ico">
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/headerdashboard.php'); ?>

<?php
	
	// $max_date = $dbconn->prepare("SELECT MAX(a.START_DATE) as VAR_MAX FROM feature_subscribe a, feature b WHERE b.COMPANY = ? AND a.FEATURE = b.ID ");
	// $max_date->bind_param("i",getSession('id_company'));
	// $max_date->execute();
	// $max_date_result = $max_date->get_result()->fetch_assoc();


	// $queryFeature =$dbconn->prepare("SELECT *  from SUBSCRIBE S, PRODUCT P, COMPONENT C, SERVICE SE, SUBSCRIPTION SO, PRICE PI WHERE S.PRODUCT = P.ID AND P.ID=C.PRODUCT AND C.SUBSCRIPTION=SO.ID AND C.SERVICE=SE.ID AND C.PRICE=P.ID AND S.COMPANY = ? AND S.START_DATE = ? order by SE.SERVICE_NAME");
	// $queryFeature->bind_param("is", getSession('id_company'), $max_date_result['VAR_MAX']);
	// $queryFeature->execute(); 
    // $result= $queryFeature->get_result();
	

	// $queryFeature2 =$dbconn->prepare("SELECT *  from SUBSCRIBE S, PRODUCT P, COMPONENT C, SERVICE SE, SUBSCRIPTION SO, PRICE PI WHERE S.PRODUCT = P.ID AND P.ID=C.PRODUCT AND C.SUBSCRIPTION=SO.ID AND C.SERVICE=SE.ID AND C.PRICE=P.ID AND S.COMPANY = ? AND S.START_DATE = ? order by SE.SERVICE_NAME");
	// $queryFeature2->bind_param("is", getSession('id_company'), $max_date_result['VAR_MAX']);
	// $queryFeature2->execute(); 
    // $result2=   $queryFeature2->get_result(); 
	
	$query = $dbconn->prepare("SELECT * FROM BILLING WHERE COMPANY = ? order by DUE_DATE desc limit 1");
	$query->bind_param("i", getSession('id_company'));
	$query->execute();
	$bill2 = $query->get_result()->fetch_assoc();
	$due_date = $bill2["DUE_DATE"];
	$query->close();

?>


	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper px-3">

		<div class="container px-3">
			<div class="card isi">
				<div class="card-body pt-4">
					<p class="d-inline align-self-center m-0 fs-14 fc-70"><b> Info </b></p>
				</div>
			</div>

			<div class="card my-2">
				<div class="card-body p-3">

					<div class="row align-items-center p-0 m-0">
						<div class="col-md-2">
							<p class="align-bottom fs-12" style="color: #707070;">Username</p>
						</div>
						<div class="col-md-5">
							<p class="fs-12"><?php echo $itemUser['USERNAME']; ?></p>
						</div>
					</div>
					<hr class="mt-0">
					<div class="row align-items-center p-0 m-0">
						<div class="col-md-2">
							<p class="align-bottom fs-12" style="color: #707070;">Company Name</p>
						</div>
						<div class="col-md-5">
							<p class="fs-12"><?php echo $itemUser['COMPANY_NAME']; ?></p>
						</div>
					</div>
					<hr class="mt-0">
					<div class="row align-items-center p-0 m-0">
						<div class="col-md-2">
							<p class="align-bottom fs-12" style="color: #707070;">Email</p>
						</div>
						<div class="col-md-5">
							<p class="fs-12"><?php echo $itemUser['EMAIL_ACCOUNT']; ?></p>
						</div>
					</div>
					<hr class="mt-0">
					<div class="row align-content-center p-0 m-0">
						<div class="col-md-2">
							<p class="align-bottom fs-12" style="color: #707070;">API Key</p>
						</div>
						<div class="col-md-9">
							<p class="fs-12" id="apikey"><?php echo $itemUser['API_KEY']; ?></p>
						</div>
						<button onclick="copyElementText()" type="button" class="btn btn-primary" style="background-color: #01686d; margin-bottom: 10px;"><i class="fa fa-copy"></i></button>
					</div>
					<hr class="mt-0">
					<div class="row align-content-center p-0 m-0">
						<div class="col-md-2">
							<p class="align-bottom fs-12" style="color: #707070;">Status</p>
						</div>
						<div class="col-md-5">
							<p class="fs-12" style="color: #01686d;">
							<?php 
								if($itemUser2['STATUS'] == 1 && $itemUser2['PRODUCT'] == 1){
									echo "[ACTIVE] [Package: $50]";
								}else if ($itemUser2['STATUS'] == 1 && $itemUser2['PRODUCT'] == 2) {
									echo "[ACTIVE] [Package: $75]";
								}else if ($itemUser2['STATUS'] == 1 && $itemUser2['PRODUCT'] == 3) {
									echo "[ACTIVE] [Package: CUSTOM]";
								} else if($itemUser2['STATUS'] == 0 && $itemUser2['PRODUCT'] == 1){
									echo "[SUSPENDED] [Package: $50]";
								}else if ($itemUser2['STATUS'] == 0 && $itemUser2['PRODUCT'] == 2) {
									echo "[SUSPENDED] [Package: $75]";
								}else if ($itemUser2['STATUS'] == 0 && $itemUser2['PRODUCT'] == 3) {
									echo "[SUSPENDED] [Package: CUSTOM]";
								}else {
									echo "[TRIAL] [Package: TRIAL]";
								}
								?>
							</p>
						</div>
					</div>
					<hr class="mt-0">
					<div class="row align-content-center p-0 m-0">
						<div class="col-md-2">
							<p class="align-bottom fs-12" style="color: #707070;">Create Time</p>
						</div>
						<div class="col-md-5">
							<p  class="fs-12"><?php echo $itemUser['CREATED_DATE']; ?></p>
						</div>
					</div>
					<hr class="mt-0">
					<div class="row align-content-center p-0 m-0">
						<div class="col-md-2">
							<p class="align-bottom fs-12" style="color: #707070;">End of Service</p>
						</div>
						<div class="col-md-5">
							<p class="fs-12" style="color: #01686d;">
							<?php 
								echo $due_date;
								?>
							</p>
						</div>
					</div>
					<hr class="mt-0">
					<!-- <div class="row align-content-center p-0 m-0">
						<div class="col-md-2">
							<p class="align-bottom fs-12" style="color: #707070;">Historical Usage</p>
						</div>
						<div class="col-md-5">
							<a href="usage.php?day=y&company_id=<?php echo getSession('id_company')?>" class="btn text-light py-0 px-1" style="background-color: #01686d;"><i class="fa fa-line-chart"></i></a>
							
						</div>
					</div> -->
					<div class="row align-content-center p-0 m-0">
						<div class="col-md-2">
							<p class="align-bottom fs-12" style="color: #707070;">
						<?php if($itemUser['STATUS'] != 0) {
								echo "Change Package";
							  }else{
							  	echo "Trial";
							  }
							?>
							</p>
						</div>
						<div class="col-md-8">
							<button class="btn text-light py-0 fs-13 mb-2" style="background-color: #01686d;" onclick="pindah('subscribe.php')" disabled>
								Subscribe
							</button>
							<?php /*
    								while ($row = $result->fetch_assoc()) { ?>

    									<?php if(strtoupper($row['NAME']) == 'LIVE STREAMING'){ 
    										?> 
    									<?php } ?>

    									<?php if(strtoupper($row['NAME']) == 'CHAT BOT'){ 
    										?>
    										<!-- <img src="assets/probot.png" style="max-height: 30px; width: auto;"> -->
    										<p class="d-inline-block ml-2 mr-5 fs-12"> ChatBot</p>
    										<!-- </br> -->
    									<?php } ?>

    									<?php if(strtoupper($row['NAME']) == 'LIVE STREAMING'){ 
    										?>
    										<!-- <img src="assets/probot.png" style="max-height: 30px; width: auto;"> -->
    										<p class="d-inline-block ml-2 mr-5 fs-12"> Live Streaming</p>
    										<!-- </br> -->
    									<?php } ?>


    									<?php if(strtoupper($row['NAME']) == 'VIDEO CALL'){ 
    										?>
    										<!-- <img src="assets/video-call.png" style="max-height: 30px; width: auto;"> -->
    										<p class="d-inline-block ml-2 mr-5 fs-12"> Video Call</p>
    										<!-- </br> -->
    									<?php } ?>

    									<?php if(strtoupper($row['NAME']) == 'VOIP CALL'){ 

    										?>
    										<!-- <img src="assets/pvoip.png" style="max-height: 30px; width: auto;"> -->
    										<p class="d-inline-block ml-2 mr-5 fs-12"> VoIP Call</p>
    										<!-- </br> -->
    									<?php } ?>

    									<?php if(strtoupper($row['NAME']) == 'INSTANT MESSAGING'){ 

    										?>
    										<!-- <img src="assets/pchat.png" style="max-height: 30px; width: auto;"> -->
    										<p class="d-inline-block ml-2 mr-5 fs-12"> Instant Messaging</p>
    										<!-- </br> -->
    									<?php  }?>

    									<?php if(strtoupper($row['NAME']) == 'SCREEN SHARING'){ 

    										?>
    										<!-- <img src="assets/pvoip.png" style="max-height: 30px; width: auto;"> -->
    										<p class="d-inline-block ml-2 mr-5 fs-12"> Screen Sharing</p>
    										<!-- </br> -->
    									<?php } ?>

    									<?php if(strtoupper($row['NAME']) == 'WHITE BOARDING'){ 

    										?>
    										<!-- <img src="assets/pvoip.png" style="max-height: 30px; width: auto;"> -->
    										<p class="d-inline-block ml-2 mr-5 fs-12"> White Boarding</p>
    										<!-- </br> -->
    									<?php } } */ ?>
						</div>
						<!-- <?php 
/*							$row2 = $result2->fetch_assoc();
								if($row2['NAME'] == ''){ ?>

								<div class="col-md-2">
									<a href="feature.php" class="btn text-light py-0 float-right fs-13 mb-2" style="background-color: #1A71E8;">Change 
									<?php if($itemUser['STATUS'] != 0) {
											echo "Subscribe";
								  		}else{
								  			echo "Trial";
								  			}
										?>
									</a>
								</div>
							
							<?php } 
*/ ?> -->

						<div class="col-md-2"></div>
						
					</div>
					<hr class="mt-0">
				</div>
			</div>

		</div>

	</div>
	<!-- /.content-wrapper -->

<script type="text/javascript">
		$('.nav-dashboard.det').addClass('active');
	</script>
	<script>
		function copyElementText() {
			var text = document.getElementById("apikey").innerText;
			var elem = document.createElement("textarea");
			document.body.appendChild(elem);
			elem.value = text;
			elem.select();
			document.execCommand("copy");
			document.body.removeChild(elem);
		}
	</script>

<?php require_once($_SERVER['DOCUMENT_ROOT'].'/footerdashboard.php'); ?>
