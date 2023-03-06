<link rel="icon" type="image/x-icon" href="newAssets/fav.ico">
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/headerdashboard.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'].'/url_function.php');?>
<?php include_once($_SERVER['DOCUMENT_ROOT'].'/db_conn.php');?>
<?php 

	session_start();

	if(isset($_POST['subscribe'])){
	
		$dbconn = getDBConn();

		//update subscribe
        $query = $dbconn->prepare("UPDATE SUBSCRIBE SET PRODUCT = ?, START_DATE = NOW(), END_DATE = DATE_ADD(NOW(), INTERVAL 30 DAY), STATUS = 0 WHERE COMPANY = ?");
        $query->bind_param("ii", $_POST['subscribe_type'], $_SESSION['id_company']);
        $query->execute();
		$query->close();
		
		redirect(base_url().'paycheckout.php');
  	}

	// session_start();
	
	// 	$period = '';
	// 	$sumPeriod = 0;
	// 	$days = 0;
	// 	$IdFeature = $_GET['id'];
		
	// 	$max_date = $dbconn->prepare("SELECT MAX(a.START_DATE) as VAR_MAX FROM feature_subscribe a, feature b WHERE b.COMPANY = ? AND a.FEATURE = b.ID ");
 	// 	$max_date->bind_param("i",getSession('id_company'));
 	// 	$max_date->execute();
 	// 	$max_date_result = $max_date->get_result()->fetch_assoc();

 	// $title = '';
 	// $cash = '';
 	// $limit = '';
 	// $storage = '';
 	// $err = '';

 	// if (isset($_POST['chooseSubscribe'])) {
 	// 	$feature = $_POST['cb1'];

 	// 	if ($feature == 'Lite') {
 	// 		$title = 'Lite';
 	// 		$cash = '$25';
 	// 		$limit = '50 Peak';
 	// 		$storage = '100 GB';
 	// 	} else if ($feature == 'Growing') {
 	// 		$title = 'Growing';
 	// 		$cash = '$50';
 	// 		$limit = '100 Peak';
 	// 		$storage = '200 GB';
 	// 	}

 	// }

	// if (isset($_POST['submit_period'])) {
	// 	$month = $_POST['cb1'];

	// 	if($month == '1 month'){
	// 		$period = '1 month';
	// 		$sumPeriod = 1;
	// 		$days = 30;
	// 	}else if($month == '6 month'){
	// 		$period = '6 month';
	// 		$sumPeriod = 6;
	// 		$days = 180;
	// 	}else if($month == '1 year'){
	// 		$sumPeriod =12;
	// 		$period = '12 month';
	// 		$days = 360;
	// 	}

	// 	$querygetStart = $dbconn->prepare("SELECT a.start_date + interval 7 DAY as day FROM feature_subscribe a, feature b WHERE b.COMPANY = ? AND a.feature = b.id limit 1");		
	// 	$querygetStart->bind_param("i", getSession('id_company'));
	// 	$querygetStart->execute();
	// 	$resultStart = $querygetStart->get_result()->fetch_assoc();

	// 	$queryUpdate = $dbconn->prepare("UPDATE feature_subscribe a, feature b  SET a.period = ? ,a.expired_date = ? WHERE a.FEATURE = b.ID AND b.COMPANY = ? AND a.START_DATE = ? ");
	// 	$queryUpdate->bind_param("ssis", $period,$resultStart['day'],getSession('id_company'),$max_date_result['VAR_MAX']);
	// 	$queryUpdate->execute();
	// 	if(!$dbconn->commit()){
	// 		echo "Commit gagal di subscribe";
	// 	}

	// 	$changeStatus = $dbconn->prepare("UPDATE company SET status = 2 WHERE id= ?");
	// 	$changeStatus->bind_param("i", getSession('id_company'));
	// 	$changeStatus->execute();

	//        // $runChange = mysqli_query($dbconn, $changeStatus );
		
	// 	if(!$dbconn->commit()){
	// 		echo "Commit gagal di subscribe";
	// 	}
			
 	// 	setSession('status', 2);

 		
		

	// 	$queryFeature = $dbconn->prepare("SELECT a.PRICE, b.ID FROM feature a, feature_subscribe b WHERE a.id = b.feature AND b.expired_date > now() AND a.company  = ? AND b.START_DATE = ? order by a.name ");
	// 	$queryFeature->bind_param("is", getSession('id_company'), $max_date_result['VAR_MAX']);
	// 	$queryFeature->execute();
	// 	$Feature = $queryFeature->get_result();

	// 	//echo '<script>alert("'.$max_date_result['VAR_MAX'].'")</script>';exit();

    // 		//$result=mysqli_query($dbconn, $queryFeature);
	// 	while($row = $Feature->fetch_assoc()){
 		
	// 	 	$price = $row['PRICE'] * $days;

	// 	 	$insertPayment =$dbconn->prepare("INSERT INTO payment (COMPANY, FEATURE_SUBSCRIBE, BILL, IS_PAID) VALUES(?,?,? , 0)");
	// 	 	$insertPayment->bind_param("iii",getSession('id_company'),$row['ID'],$price);
	// 	 	$insertPayment->execute();			

	// 	 	//$runPayment = mysqli_query($dbconn, $insertPayment);

	// 	 	if(!$dbconn->commit()){
	// 	 		echo "Commit gagal di subscribe";
	// 	 	}

	// 	 }
 		
	// 	redirect(base_url().'detail.php');
	// }


?>

  <div class="modal fade" id="subscribeLite">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
      	<div class="modal-body">
      	  <div class="row">
      	    <div class="col-md-12">
      	  	  <label class="title-modal fs-25"><b>Starter</b></label>
      	    </div>
      	  </div>
      	  <div class="row mx-3">
      	    <div class="col-md-12 my-1">
      	    	<span>
      	    	  <i class="fa fa-check fs-20 align-self-center"></i>
      	    	  <b>50 Peak</b> Connections Limit
      	    	</span>
      	    </div>
      	    <div class="col-md-12 my-1">
      	    	<span>
      	    	  <i class="fa fa-check fs-20 align-self-center"></i>
      	    	  <b>100 GB</b> Storage
      	    	</span>
      	    </div>
      	    <div class="col-md-12 my-1">
      	    	<span>
      	    	  <i class="fa fa-check fs-20 align-self-center"></i>
      	    	  <b>Unlimited</b> Data Retention
      	    	</span>
      	    </div>
      	    <div class="col-md-12 my-1">
      	    	<span>
      	    	  <i class="fa fa-check fs-20 align-self-center"></i>
      	    	  <b>All Features</b>
      	    	</span>
      	    </div>
      	  </div>
      	  <div class="row justify-content-center my-3">
      	    <div class="col-md-5">
      	      <ul class="fc-70">
      	      	<li>Live Streaming</li>
      	      	<li>Video Call</li>
      	      	<li>Audio Call</li>
      	      	<li>Screen Sharing</li>
      	      </ul>
      	    </div>
      	    <div class="col-md-5">
      	      <ul class="fc-70">
      	        <li>Whiteboarding</li>
      	        <li>Unified Messaging</li>
      	        <li>Chatbot</li>
      	      </ul>
      	    </div>
      	  </div>
      	  <div class="row float-right mr-1">
      	  	<button type="submit" name="cancel" class="btn nav-menu-btn-alt shadow py-1 px-3 mx-4 fs-15" data-dismiss="modal">
      	  	  Cancel
      	  	</button>
      	  	<button type="button" name="subscribe" class="btn nav-menu-btn-wht-alt py-1 px-3 mx-2 fs-15" data-dismiss="modal" data-toggle="modal" data-target="#modalPay">
      	  	  <!--  data-dismiss="modal" -->
      	  	  Subscribe
      	  	</button>
      	  </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="subscribeGrowing">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
      	<div class="modal-body">
      	  <div class="row">
      	    <div class="col-md-12">
      	  	  <label class="title-modal fs-25"><b>Advance</b></label>
      	    </div>
      	  </div>
      	  <div class="row mx-3">
      	    <div class="col-md-12 my-1">
      	    	<span>
      	    	  <i class="fa fa-check fs-20 align-self-center"></i>
      	    	  <b>100 Peak</b> Connections Limit
      	    	</span>
      	    </div>
      	    <div class="col-md-12 my-1">
      	    	<span>
      	    	  <i class="fa fa-check fs-20 align-self-center"></i>
      	    	  <b>200 GB</b> Storage
      	    	</span>
      	    </div>
      	    <div class="col-md-12 my-1">
      	    	<span>
      	    	  <i class="fa fa-check fs-20 align-self-center"></i>
      	    	  <b>Unlimited</b> Data Retention
      	    	</span>
      	    </div>
      	    <div class="col-md-12 my-1">
      	    	<span>
      	    	  <i class="fa fa-check fs-20 align-self-center"></i>
      	    	  <b>All Features</b>
      	    	</span>
      	    </div>
      	  </div>
      	  <div class="row justify-content-center my-3">
      	    <div class="col-md-5">
      	      <ul class="fc-70">
      	      	<li>Live Streaming</li>
      	      	<li>Video Call</li>
      	      	<li>Audio Call</li>
      	      	<li>Screen Sharing</li>
      	      </ul>
      	    </div>
      	    <div class="col-md-5">
      	      <ul class="fc-70">
      	        <li>Whiteboarding</li>
      	        <li>Unified Messaging</li>
      	        <li>Chatbot</li>
      	      </ul>
      	    </div>
      	  </div>
      	  <div class="row float-right mr-1">
      	  	<button type="submit" name="cancel" class="btn nav-menu-btn-alt shadow py-1 px-3 mx-4 fs-15" data-dismiss="modal">
      	  	  Cancel
      	  	</button>
      	  	<button type="button" name="subscribe" class="btn nav-menu-btn-wht-alt py-1 px-3 mx-2 fs-15" data-dismiss="modal" data-toggle="modal" data-target="#modalPay">
      	  	  <!--  data-dismiss="modal" -->
      	  	  Subscribe
      	  	</button>
      	  </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalPay">
  	<div class="modal-dialog modal-dialog-centered" style="max-width: 650px;">
  		<div class="modal-content">
  			<div class="modal-body fontRobReg px-4">
  				<div class="container-fluid">
  					<div class="row mx-0 my-1">
  						<p class="fs-25 m-0">Bill</p>
  					</div>
  					<div class="row mx-0 mb-2">
  						<p class="fs-20 text-secondary">Subscribe : Growing</p>
  					</div>
  					<div class="row mx-0 my-2" style="border-bottom: 1px solid black;">
  						<p class="fs-18 mb-0">Total</p>
  						<p class="fs-18 ml-auto mb-0">$ 50</p>
  					</div>
  					<div class="row mx-0 my-3">
  						<p class="fs-15 m-0">Payment Method :</p>
  					</div>
  					<div class="row mx-0 mb-3 justify-content-end">
  						<div class="col-md-6 px-0">
  							<button type="submit" class="btn text-light fs-15 h-100" style="background-color: #1A71E8; width: 240px;">Pay with PayPal</button>
  						</div>
  						<div class="col-md-6 px-0 d-flex justify-content-end">
  							<div id="paydiv"></div>
  						</div>
  					</div>
  				</div>
  			</div>
  		</div>
  	</div>
  </div>

	<!-- Content Wrapper. Contains page content -->

	<form method="post">
	<div class="content-wrapper px-3">

		<div class="container">
			<div class="card isi">
				<div class="card-body pt-4">
					<p class="d-inline align-self-center m-0 fs-14" style="color: #707070;"> Subscribe </p>
				</div>
			</div>

			<div class="card my-2">
				<div class="card-body">
					<div class="row m-0 d-flex justify-content-around">
						<!-- <div class="col-4 p-0">
							<div class="card shadow m-3 card-subscribe">
								<div class="card-header p-2" style="min-height: 120px;">
									<div class="row justify-content-center m-2">
										<span class="fontRobReg fs-20" style="color: #1A71E8;">Starter</span>
									</div>
									<div class="row justify-content-center m-2">
										<span class="fontRobReg fs-16">
											<b style="font-size: 30px;">$50</b>/Month
										</span>
									</div>
								</div>
								<div class="card-body justify-content-between py-4 px-2 d-flex flex-column">
									<div class="row m-0 px-4">
										<div class="col-1 d-flex px-1">
											<i class="fa fa-check fs-20 align-self-center" style="color: #355DC9;"></i>
										</div>
										<div class="col-11 px-1">
											<p class="fs-18 m-0" style="font-family: 'Segoe UI Regular';">
												<b>Unlimited</b> Monthly Active User
											</p>
										</div>
									</div>
									<div class="row m-0 px-4">
										<div class="col-1 d-flex px-1">
											<i class="fa fa-check fs-20 align-self-center" style="color: #355DC9;"></i>
										</div>
										<div class="col-11 px-1">
											<p class="fs-18 m-0" style="font-family: 'Segoe UI Regular';">
												<b>Unlimited</b> Connections Limit
											</p>
										</div>
									</div>
									<div class="row m-0 px-4">
										<div class="col-1 d-flex px-1">
											<i class="fa fa-check fs-20 align-self-center" style="color: #355DC9;"></i>
										</div>
										<div class="col-11 px-1">
											<p class="fs-18 m-0" style="font-family: 'Segoe UI Regular';">
												<b>100 GB</b> Storage Quota
											</p>
										</div>
									</div>
									<div class="row m-0 px-4">
										<div class="col-1 d-flex px-1">
											<i class="fa fa-check fs-20 align-self-center" style="color: #355DC9;"></i>
										</div>
										<div class="col-11 px-1">
											<p class="fs-18 m-0" style="font-family: 'Segoe UI Regular';">
												<b>100 GB</b> Bandwith Quota
											</p>
										</div>
									</div>
									<div class="row m-0 px-4">
										<div class="col-1 d-flex px-1">
											<i class="fa fa-check fs-20 align-self-center" style="color: #355DC9;"></i>
										</div>
										<div class="col-11 px-1">
											<p class="fs-18 m-0" style="font-family: 'Segoe UI Regular';">
												<b>Shared Cloud</b>
											</p>
										</div>
									</div>
									<div class="row m-0 px-4">
										<div class="col-1 d-flex px-1">
											<i class="fa fa-check fs-20 align-self-center" style="color: #355DC9;"></i>
										</div>
										<div class="col-11 px-1" id="features" onclick="showhideFeatures()">
											<p class="fs-18 m-0" style="font-family: 'Segoe UI Regular'; cursor: pointer;">
												<b id="features">All</b> Features Access <i class="fa fa-info-circle ml-1 fs-16"></i>
											</p>
											<div class="card shadow p-3 d-none" id="featurediv" style="position: absolute; width: 345px; z-index: 10; margin: -100px 0 0 -40px;">
												<div class="card-body p-0">
													<div class="row m-0">
														<div class="col-6">
															<div class="row">
																<div class="col-1 d-flex px-1">
																	<i class="fa fa-circle fs-15 align-self-center" style="color: #355DC9;"></i>
																</div>
																<div class="col-11 pl-2">
																	<p class="fs-15 m-0" style="font-family: 'Segoe UI Regular';">
																		Live Streaming
																	</p>
																</div>
															</div>
															<div class="row">
																<div class="col-1 d-flex px-1">
																	<i class="fa fa-circle fs-15 align-self-center" style="color: #355DC9;"></i>
																</div>
																<div class="col-11 pl-2">
																	<p class="fs-15 m-0" style="font-family: 'Segoe UI Regular';">
																		Video Call
																	</p>
																</div>
															</div>
															<div class="row">
																<div class="col-1 d-flex px-1">
																	<i class="fa fa-circle fs-15 align-self-center" style="color: #355DC9;"></i>
																</div>
																<div class="col-11 pl-2">
																	<p class="fs-15 m-0" style="font-family: 'Segoe UI Regular';">
																		Audio Call
																	</p>
																</div>
															</div>
														</div>
														<div class="col-6">
															<div class="row">
																<div class="col-1 d-flex px-1">
																	<i class="fa fa-circle fs-15 align-self-center" style="color: #355DC9;"></i>
																</div>
																<div class="col-11 pl-2">
																	<p class="fs-15 m-0" style="font-family: 'Segoe UI Regular';">
																		Screen Sharing
																	</p>
																</div>
															</div>
															<div class="row">
																<div class="col-1 d-flex px-1">
																	<i class="fa fa-circle fs-15 align-self-center" style="color: #355DC9;"></i>
																</div>
																<div class="col-11 pl-2">
																	<p class="fs-15 m-0" style="font-family: 'Segoe UI Regular';">
																		Whiteboarding
																	</p>
																</div>
															</div>
															<div class="row">
																<div class="col-1 d-flex px-1">
																	<i class="fa fa-circle fs-15 align-self-center" style="color: #355DC9;"></i>
																</div>
																<div class="col-11 pl-2">
																	<p class="fs-15 m-0" style="font-family: 'Segoe UI Regular';">
																		Chatbot
																	</p>
																</div>
															</div>
														</div>
													</div>
													<div class="row m-0">
														<div class="col-12 px-1">
															<p class="fs-15 m-0" style="font-family: 'Segoe UI Regular';">
																<i class="fa fa-circle fs-15 align-self-center" style="color: #355DC9;"></i>
																Unified Messaging <span class="font-weight-bold" style="color: #355DC9;">Free</span>
															</p>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="row m-0 justify-content-center">
										<form method="post">
											
											<input type="hidden" name="subscribe_type" value="1">
											<input type="submit" name="subscribe" class="btn nav-menu-btn-wht-alt text-light mt-3 mx-4 w-100" value="Subscribe">
										</form>
										
									</div>
								</div>
							</div>
						</div> -->

						<!-- <div class="col-4 p-0"> -->
						<div>
							<div class="card shadow m-3 card-subscribe">
								
								<div class="card-header p-2" style="height: 130px; width: 385px;">
									<div class="row justify-content-center text-center h-100">
										<span class="fontRobReg align-self-center" style="color: #1A71E8; font-size: 25px;"><b style="font-size: 30px;">$75</b>/Month</span>
									</div>
								</div>
								<div class="card-body justify-content-between py-4 px-2 d-flex flex-column">
									<!-- <div class="row justify-content-center text-center">
										<p class="fontRobReg fs-20 align-self-end m-0 pt-3">
											<span style="font-size: 25px;">$0.00000023</span><br>
											/KB traffic
										</p>
									</div> -->
									<div class="row m-0 px-4">
										<div class="col-1 d-flex px-1">
											<i class="fa fa-check fs-20 align-self-center" style="color: #355DC9;"></i>
										</div>
										<div class="col-10 px-1">
											<p class="fs-18 m-0" style="font-family: 'Segoe UI Regular';">
												<b>10.000</b> Monthly Active User
											</p>
										</div>
									</div>
									<div class="row m-0 px-4">
										<div class="col-1 d-flex px-1">
											<i class="fa fa-check fs-20 align-self-center" style="color: #355DC9;"></i>
										</div>
										<div class="col-10 px-1">
											<p class="fs-18 m-0" style="font-family: 'Segoe UI Regular';">
												<b>10.000 Peak</b> Connections Limit
											</p>
										</div>
									</div>
									<div class="row m-0 px-4">
										<div class="col-1 d-flex px-1">
											<i class="fa fa-check fs-20 align-self-center" style="color: #355DC9;"></i>
										</div>
										<div class="col-10 px-1">
											<p class="fs-18 m-0" style="font-family: 'Segoe UI Regular';">
												<b>200 GB</b> Storage Quota
											</p>
										</div>
									</div>
									<div class="row m-0 px-4">
										<div class="col-1 d-flex px-1">
											<i class="fa fa-check fs-20 align-self-center" style="color: #355DC9;"></i>
										</div>
										<div class="col-10 px-1">
											<p class="fs-18 m-0" style="font-family: 'Segoe UI Regular';">
												<b>100 GB</b> Bandwith Quota
											</p>
										</div>
									</div>
									<div class="row m-0 px-4">
										<div class="col-1 d-flex px-1">
											<i class="fa fa-check fs-20 align-self-center" style="color: #355DC9;"></i>
										</div>
										<div class="col-10 px-1">
											<p class="fs-18 m-0" style="font-family: 'Segoe UI Regular';">
												<b>Unlimited</b> Data Retention
											</p>
										</div>
									</div>
									<div class="row m-0 px-4">
										<div class="col-1 d-flex px-1">
											<i class="fa fa-check fs-20 align-self-start mt-1" style="color: #355DC9;"></i>
										</div>
										<div class="col-11 px-1" id="features" ><!--onclick="showhideFeatures()" -->
											<p class="fs-18 m-0" style="font-family: 'Segoe UI Regular'; ">
												<b id="features">All</b> Features Access 
											</p>
												<div class="card-body p-0">
													<div class="row m-0">
														<div class="col-6">
															<div class="row">
																<div class="col-1 d-flex px-1">
																	<i class="fa fa-circle fs-15 align-self-center" style="color: #355DC9;"></i>
																</div>
																<div class="col-11 pl-2">
																	<p class="fs-15 m-0" style="font-family: 'Segoe UI Regular';">
																		Live Streaming
																	</p>
																</div>
															</div>
															<div class="row">
																<div class="col-1 d-flex px-1">
																	<i class="fa fa-circle fs-15 align-self-center" style="color: #355DC9;"></i>
																</div>
																<div class="col-11 pl-2">
																	<p class="fs-15 m-0" style="font-family: 'Segoe UI Regular';">
																		Video Call
																	</p>
																</div>
															</div>
															<div class="row">
																<div class="col-1 d-flex px-1">
																	<i class="fa fa-circle fs-15 align-self-center" style="color: #355DC9;"></i>
																</div>
																<div class="col-11 pl-2">
																	<p class="fs-15 m-0" style="font-family: 'Segoe UI Regular';">
																		Audio Call
																	</p>
																</div>
															</div>
														</div>
														<div class="col-6">
															<div class="row">
																<div class="col-1 d-flex px-1">
																	<i class="fa fa-circle fs-15 align-self-center" style="color: #355DC9;"></i>
																</div>
																<div class="col-11 pl-2">
																	<p class="fs-15 m-0" style="font-family: 'Segoe UI Regular';">
																		Screen Sharing
																	</p>
																</div>
															</div>
															<div class="row">
																<div class="col-1 d-flex px-1">
																	<i class="fa fa-circle fs-15 align-self-center" style="color: #355DC9;"></i>
																</div>
																<div class="col-11 pl-2">
																	<p class="fs-15 m-0" style="font-family: 'Segoe UI Regular';">
																		Whiteboarding
																	</p>
																</div>
															</div>
															<div class="row">
																<div class="col-1 d-flex px-1">
																	<i class="fa fa-circle fs-15 align-self-center" style="color: #355DC9;"></i>
																</div>
																<div class="col-11 pl-2">
																	<p class="fs-15 m-0" style="font-family: 'Segoe UI Regular';">
																		Unified Messaging
																	</p>
																</div>
															</div>
														</div>
													</div>
													
												</div>
											
										</div>
									</div>
									<div class="row m-0 justify-content-center">
									<form method="post">
											<!-- <input style="background-color: #007bff; color: white;" type="submit" class="btn nav-menu-btn-wht-alt py-1 px-3 w-100 m-0 my-4 fs-16" value="subscribe" name="subscribe"> -->
											<input type="hidden" name="subscribe_type" value="2">
											<input type="submit" name="subscribe" class="btn nav-menu-btn-wht-alt text-light mt-3 mx-4 w-100" value="Subscribe">
										</form>
										<!-- <button type="button" name="submit_period" class="btn nav-menu-btn-wht-alt text-light mt-3 mx-4 w-100" onclick="pindah('paycheckout.php')">Subscribe</button> -->
										<!-- <input type="radio" value="Lite" class="custom-control-input" id="Lite" name="cb1">
										<label class="btn nav-menu-btn-wht-alt text-light mt-3 mx-4 w-100 custom-checkbox" for="Lite" style="cursor: pointer;">
											<span>Subscribe</span>
										</label> -->
									</div>
								</div>
							</div>
						</div>

						<div>
							<div class="card shadow m-3 card-subscribe">
								<div class="card-header p-2" style="height: 130px; width: 385px;">
									<div class="row justify-content-center text-center h-100">
										<span class="fontRobReg align-self-center" style="color: #1A71E8; font-size: 40px;">Custom</span>
									</div>
								</div>
								<div class="card-body justify-content-between py-4 px-2 d-flex flex-column">
									<!-- <div class="row justify-content-center text-center">
										<p class="fontRobReg fs-20 align-self-end m-0 pt-3" style="margin-bottom: 50px;">
											<span style="font-size: 25px;">Custom</span>
										</p>
									</div> -->
									<div class="row m-0 px-4">
										<div class="col-1 d-flex px-1">
											<i class="fa fa-check fs-20 align-self-center" style="color: #355DC9;"></i>
										</div>
										<div class="col-11 px-1">
											<p class="fs-18 m-0" style="font-family: 'Segoe UI Regular';">
												<b>Unlimited</b> Monthly Active User
											</p>
										</div>
									</div>
									<div class="row m-0 px-4">
										<div class="col-1 d-flex px-1">
											<i class="fa fa-check fs-20 align-self-center" style="color: #355DC9;"></i>
										</div>
										<div class="col-11 px-1">
											<p class="fs-18 m-0" style="font-family: 'Segoe UI Regular';">
												<b>Unlimited</b> Connections Limit
											</p>
										</div>
									</div>
									<div class="row m-0 px-4">
										<div class="col-1 d-flex px-1">
											<i class="fa fa-check fs-20 align-self-center" style="color: #355DC9;"></i>
										</div>
										<div class="col-11 px-1">
											<p class="fs-18 m-0" style="font-family: 'Segoe UI Regular';">
												<b>Custom</b> Storage Quota
											</p>
										</div>
									</div>
									<div class="row m-0 px-4">
										<div class="col-1 d-flex px-1">
											<i class="fa fa-check fs-20 align-self-center" style="color: #355DC9;"></i>
										</div>
										<div class="col-11 px-1">
											<p class="fs-18 m-0" style="font-family: 'Segoe UI Regular';">
												<b>Custom</b> Bandwith Quota
											</p>
										</div>
									</div>
									<div class="row m-0 px-4">
										<div class="col-1 d-flex px-1">
											<i class="fa fa-check fs-20 align-self-center" style="color: #355DC9;"></i>
										</div>
										<div class="col-11 px-1">
											<p class="fs-18 m-0" style="font-family: 'Segoe UI Regular';">
												<b>Cloud</b> or<b> On-premise Setup</b>
											</p>
										</div>
									</div>
									<div class="row m-0 px-4">
										<div class="col-1 d-flex px-1">
											<i class="fa fa-check fs-20 align-self-start mt-1" style="color: #355DC9;"></i>
										</div>
										<div class="col-11 px-1" id="features2" >
											<p class="fs-18 m-0" style="font-family: 'Segoe UI Regular'; ">
												<b id="features">Custom</b> Features Access 
											</p>
												<div class="card-body p-0">
													<div class="row m-0 ">
														<div class="col-6">
															<div class="row">
																<div class="col-1 d-flex px-1">
																	<i class="fa fa-circle fs-15 align-self-center" style="color: #355DC9;"></i>
																</div>
																<div class="col-11 pl-2">
																	<p class="fs-15 m-0" style="font-family: 'Segoe UI Regular';">
																		Live Streaming
																	</p>
																</div>
															</div>
															<div class="row">
																<div class="col-1 d-flex px-1">
																	<i class="fa fa-circle fs-15 align-self-center" style="color: #355DC9;"></i>
																</div>
																<div class="col-11 pl-2">
																	<p class="fs-15 m-0" style="font-family: 'Segoe UI Regular';">
																		Video Call
																	</p>
																</div>
															</div>
															<div class="row">
																<div class="col-1 d-flex px-1">
																	<i class="fa fa-circle fs-15 align-self-center" style="color: #355DC9;"></i>
																</div>
																<div class="col-11 pl-2">
																	<p class="fs-15 m-0" style="font-family: 'Segoe UI Regular';">
																		Audio Call
																	</p>
																</div>
															</div>
														</div>
														<div class="col-6">
															<div class="row">
																<div class="col-1 d-flex px-1">
																	<i class="fa fa-circle fs-15 align-self-center" style="color: #355DC9;"></i>
																</div>
																<div class="col-11 pl-2">
																	<p class="fs-15 m-0" style="font-family: 'Segoe UI Regular';">
																		Screen Sharing
																	</p>
																</div>
															</div>
															<div class="row">
																<div class="col-1 d-flex px-1">
																	<i class="fa fa-circle fs-15 align-self-center" style="color: #355DC9;"></i>
																</div>
																<div class="col-11 pl-2">
																	<p class="fs-15 m-0" style="font-family: 'Segoe UI Regular';">
																		Whiteboarding
																	</p>
																</div>
															</div>
															<div class="row">
																<div class="col-1 d-flex px-1">
																	<i class="fa fa-circle fs-15 align-self-center" style="color: #355DC9;"></i>
																</div>
																<div class="col-11 pl-2">
																	<p class="fs-15 m-0" style="font-family: 'Segoe UI Regular';">
																		Unified Messaging
																	</p>
																</div>
															</div>
														</div>
													</div>
													
												</div>
											
										</div>
									</div>
									<div class="row m-0">
										<a href="contactus.php" class="btn nav-menu-btn-alt mt-3 mx-4 w-100" style="border: 1px solid #1A71E8;">Contact Us</a>
									</div>
								</div>
							</div>
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</div>
	</form>
	<!-- /.content-wrapper -->
	
	<script type="text/javascript">

		function showhideFeatures(){
			if ($('#featurediv').hasClass('d-none')) {
				$('#featurediv').removeClass('d-none');
			} else {
				$('#featurediv').addClass('d-none');
			}
		}

		function showhideFeatures2(){
			if ($('#featurediv2').hasClass('d-none')) {
				$('#featurediv2').removeClass('d-none');
			} else {
				$('#featurediv2').addClass('d-none');
			}
		}

		// $('#features').mouseenter(function(){
		// 	showFeatures();
		// });

		// $('#features').mouseleave(function(){
		// 	hideFeatures();
		// });		

		// function showFeatures(){
		// 	$('#featurediv').removeClass('d-none');
		// }

		// function hideFeatures(){
		// 	$('#featurediv').addClass('d-none');
		// }
	</script>
-->
	<?php if(!empty($limit)): ?>
		<script type="text/javascript">
			$(document).ready(function(){
				$("#confirmSubscribe").modal("show");
			});
		</script>
	<?php endif; ?>

<script>
/**
 * Define the version of the Google Pay API referenced when creating your
 * configuration
 *
 * @see {@link https://developers.google.com/pay/api/web/reference/request-objects#PaymentDataRequest|apiVersion in PaymentDataRequest}
 */
const baseRequest = {
  apiVersion: 2,
  apiVersionMinor: 0
};

/**
 * Card networks supported by your site and your gateway
 *
 * @see {@link https://developers.google.com/pay/api/web/reference/request-objects#CardParameters|CardParameters}
 * @todo confirm card networks supported by your site and gateway
 */
const allowedCardNetworks = ["AMEX", "DISCOVER", "INTERAC", "JCB", "MASTERCARD", "VISA"];

/**
 * Card authentication methods supported by your site and your gateway
 *
 * @see {@link https://developers.google.com/pay/api/web/reference/request-objects#CardParameters|CardParameters}
 * @todo confirm your processor supports Android device tokens for your
 * supported card networks
 */
const allowedCardAuthMethods = ["PAN_ONLY", "CRYPTOGRAM_3DS"];

/**
 * Identify your gateway and your site's gateway merchant identifier
 *
 * The Google Pay API response will return an encrypted payment method capable
 * of being charged by a supported gateway after payer authorization
 *
 * @todo check with your gateway on the parameters to pass
 * @see {@link https://developers.google.com/pay/api/web/reference/request-objects#gateway|PaymentMethodTokenizationSpecification}
 */
const tokenizationSpecification = {
  type: 'PAYMENT_GATEWAY',
  parameters: {
    'gateway': 'example',
    'gatewayMerchantId': 'exampleGatewayMerchantId'
  }
};

/**
 * Describe your site's support for the CARD payment method and its required
 * fields
 *
 * @see {@link https://developers.google.com/pay/api/web/reference/request-objects#CardParameters|CardParameters}
 */
const baseCardPaymentMethod = {
  type: 'CARD',
  parameters: {
    allowedAuthMethods: allowedCardAuthMethods,
    allowedCardNetworks: allowedCardNetworks
  }
};

/**
 * Describe your site's support for the CARD payment method including optional
 * fields
 *
 * @see {@link https://developers.google.com/pay/api/web/reference/request-objects#CardParameters|CardParameters}
 */
const cardPaymentMethod = Object.assign(
  {},
  baseCardPaymentMethod,
  {
    tokenizationSpecification: tokenizationSpecification
  }
);

/**
 * An initialized google.payments.api.PaymentsClient object or null if not yet set
 *
 * @see {@link getGooglePaymentsClient}
 */
let paymentsClient = null;

/**
 * Configure your site's support for payment methods supported by the Google Pay
 * API.
 *
 * Each member of allowedPaymentMethods should contain only the required fields,
 * allowing reuse of this base request when determining a viewer's ability
 * to pay and later requesting a supported payment method
 *
 * @returns {object} Google Pay API version, payment methods supported by the site
 */
function getGoogleIsReadyToPayRequest() {
  return Object.assign(
      {},
      baseRequest,
      {
        allowedPaymentMethods: [baseCardPaymentMethod]
      }
  );
}

/**
 * Configure support for the Google Pay API
 *
 * @see {@link https://developers.google.com/pay/api/web/reference/request-objects#PaymentDataRequest|PaymentDataRequest}
 * @returns {object} PaymentDataRequest fields
 */
function getGooglePaymentDataRequest() {
  const paymentDataRequest = Object.assign({}, baseRequest);
  paymentDataRequest.allowedPaymentMethods = [cardPaymentMethod];
  paymentDataRequest.transactionInfo = getGoogleTransactionInfo();
  paymentDataRequest.merchantInfo = {
    // @todo a merchant ID is available for a production environment after approval by Google
    // See {@link https://developers.google.com/pay/api/web/guides/test-and-deploy/integration-checklist|Integration checklist}
    // merchantId: '01234567890123456789',
    merchantName: 'Example Merchant'
  };
  return paymentDataRequest;
}

/**
 * Return an active PaymentsClient or initialize
 *
 * @see {@link https://developers.google.com/pay/api/web/reference/client#PaymentsClient|PaymentsClient constructor}
 * @returns {google.payments.api.PaymentsClient} Google Pay API client
 */
function getGooglePaymentsClient() {
  if ( paymentsClient === null ) {
    paymentsClient = new google.payments.api.PaymentsClient({environment: 'TEST'});
  }
  return paymentsClient;
}

/**
 * Initialize Google PaymentsClient after Google-hosted JavaScript has loaded
 *
 * Display a Google Pay payment button after confirmation of the viewer's
 * ability to pay.
 */
function onGooglePayLoaded() {
  const paymentsClient = getGooglePaymentsClient();
  paymentsClient.isReadyToPay(getGoogleIsReadyToPayRequest())
      .then(function(response) {
        if (response.result) {
          addGooglePayButton();
          // @todo prefetch payment data to improve performance after confirming site functionality
          // prefetchGooglePaymentData();
        }
      })
      .catch(function(err) {
        // show error in developer console for debugging
        console.error(err);
      });
}

/**
 * Add a Google Pay purchase button alongside an existing checkout button
 *
 * @see {@link https://developers.google.com/pay/api/web/reference/request-objects#ButtonOptions|Button options}
 * @see {@link https://developers.google.com/pay/api/web/guides/brand-guidelines|Google Pay brand guidelines}
 */
function addGooglePayButton() {
  const paymentsClient = getGooglePaymentsClient();
  const button =
      paymentsClient.createButton({onClick: onGooglePaymentButtonClicked});
  document.getElementById('paydiv').appendChild(button);
}

/**
 * Provide Google Pay API with a payment amount, currency, and amount status
 *
 * @see {@link https://developers.google.com/pay/api/web/reference/request-objects#TransactionInfo|TransactionInfo}
 * @returns {object} transaction info, suitable for use as transactionInfo property of PaymentDataRequest
 */
function getGoogleTransactionInfo() {
  return {
    countryCode: 'US',
    currencyCode: 'USD',
    totalPriceStatus: 'FINAL',
    // set to cart total
    totalPrice: '1.00'
  };
}

/**
 * Prefetch payment data to improve performance
 *
 * @see {@link https://developers.google.com/pay/api/web/reference/client#prefetchPaymentData|prefetchPaymentData()}
 */
function prefetchGooglePaymentData() {
  const paymentDataRequest = getGooglePaymentDataRequest();
  // transactionInfo must be set but does not affect cache
  paymentDataRequest.transactionInfo = {
    totalPriceStatus: 'NOT_CURRENTLY_KNOWN',
    currencyCode: 'USD'
  };
  const paymentsClient = getGooglePaymentsClient();
  paymentsClient.prefetchPaymentData(paymentDataRequest);
}

/**
 * Show Google Pay payment sheet when Google Pay payment button is clicked
 */
function onGooglePaymentButtonClicked() {
  const paymentDataRequest = getGooglePaymentDataRequest();
  paymentDataRequest.transactionInfo = getGoogleTransactionInfo();

  const paymentsClient = getGooglePaymentsClient();
  paymentsClient.loadPaymentData(paymentDataRequest)
      .then(function(paymentData) {
        // handle the response
        processPayment(paymentData);
      })
      .catch(function(err) {
        // show error in developer console for debugging
        console.error(err);
      });
}

/**
 * Process payment data returned by the Google Pay API
 *
 * @param {object} paymentData response from Google Pay API after user approves payment
 * @see {@link https://developers.google.com/pay/api/web/reference/response-objects#PaymentData|PaymentData object reference}
 */
function processPayment(paymentData) {
  // show returned data in developer console for debugging
    console.log(paymentData);
  // @todo pass payment token to your gateway to process payment
  paymentToken = paymentData.paymentMethodData.tokenizationData.token;
}

</script>

<script async
  src="https://pay.google.com/gp/p/js/pay.js"
  onload="onGooglePayLoaded()"></script>

<?php require_once($_SERVER['DOCUMENT_ROOT'].'/footerdashboard.php'); ?>
