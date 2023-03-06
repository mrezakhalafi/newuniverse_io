<link rel="icon" type="image/x-icon" href="newAssets/fav.ico">
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/headerdashboard.php'); ?>
<?php

	$message = $dbconn->prepare("SELECT * FROM MESSAGE WHERE COMPANY = ? order by ID DESC");
	$message->bind_param("i", getSession('id_company'));
  	$message->execute();
  	$itemMessage = $message->get_result();

	$idM = $_GET['id'];
	$message2 = $dbconn->prepare("SELECT * FROM MESSAGE WHERE COMPANY = ? AND ID= ?");
	$message2->bind_param("ii", getSession('id_company'), $idM);
  	$message2->execute();
  	$itemMessage2 = $message2->get_result()->fetch_assoc();

	$updateMessage = $dbconn->prepare("UPDATE MESSAGE SET IS_READ = 1 WHERE COMPANY = ? AND ID= ?");
	$updateMessage->bind_param("ii", getSession('id_company'), $idM);
  	$updateMessage->execute();
	$dbconn->commit();

	$welcome = "Welcome to Palio.io!";
	$payment = "Payment Notice";
	$due_date = "Due Date Reminder";
	$overdue = "Overdue Notice";
	$cutoff_date = "Cut Off Date Reminder";
	$terminate = "Service Termination Notice";

	// $trial = "Reminder: Your trial has expired";
	// $payment= "Payment Success";

	//welcome
	$message1 = "Hey there, <br>
		Welcome!<br>
		Palio.io helps developers in making their applications, so that they stay connected with their application users.<br>

		Welcome to Palio.io! Now you and your team can build and run apps using our sdk.<br>
		Now you can easily build your mobile apps with live streaming, video and VoIP call in less than 15 minutes.<br>
		We support all platforms including iOS, Android, and Kotlin. Here are some resources to help get you started:<br>
		<a href='sdk.php'>SDK Link</a>
		<br>
		We can’t wait to see what you've build!
		<br>
		<br>
		Thank you.<br>
		With Regards<br>
		Palio.io<br>
		";

	//due date reminder
	$message6 = "Dear User...<br>
		Due Date Reminder:<br>
		To continue using our services, you have to make a repayment on .
		<br>
		Thank you.<br>
		With Regards<br>
		Palio.io<br>
		";

	//overdue notice
	$message3 = "Dear User...<br>
		Overdue Reminder:<br>
		Your package has entered a grace period, make sure to finish your payment to continue using our services.
		<br>
		Thank you.<br>
		With Regards<br>
		Palio.io<br>
		";

	//cut off date reminder
	$message4 = "Dear User...<br>
		Cut Off Date Reminder:<br>
		Your package has entered a grace period, and will be terminated on .
		<br>
		Thank you.<br>
		With Regards<br>
		Palio.io<br>
		";

	//termination notice
	$message5 = "Dear User...<br>
		Your package has been terminated on .
		<br>
		If you are interested in using our services again,
		<br>
		Thank you.<br>
		With Regards<br>
		Palio.io<br>
		";

	//payment notice
	$message2 = "Dear User...<br>
		You haven't paid for your package, if you are interested in using our services please finish your payment.
		<br>
		Thank you.<br>
		With Regards<br>
		Palio.io<br>
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
		Palio.io<br>";

  	// $message5 = "Dear user...<br>
	// 	Thank you for your payment transaction on ";
  	$nextMessage5 ="  <br>
		Currently, you have access to all of our API services and we hope that you will be enjoying our best services. To avoid any inconveniences please pay your service bill on the due date in the future. Best of Luck.
		<br>
		<br>
		Thank you.<br>
		With Regards<br>
		Palio.io<br>
		";
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <div class="card m-3">
		<div class="card-body">
			<div class="pull-left align-self-center">
				<span class="ml-1 fs-14" style="color: #707070;">Message</span>
			</div>
		</div>
    </div>

    <!-- <div class="card m-3"> -->
		<div class="card-body d-flex">
			<div class="col-lg-5">
				<ul class="nav nav-tabs" id="tab-msg"  style="max-height: 800px; overflow-y: auto; overflow-x: hidden;">
					<?php while ($row = $itemMessage->fetch_assoc()) { ?>
							<li class="nav-item mb-3 w-100">
								<div class="row">
									<div class="col s12 m6">
										<a href="message.php?id=<?php echo $row['ID']?>" style="color: #707070;">
											<div class="card blue-grey darken-1" style="padding: 20px; border-radius: 20px; margin-right: 15px; <?php if($_GET['id'] == $row['ID']) echo 'box-shadow: 0px 5px #BABEC2;'; ?>">
												<div class="card-content white-text">
													<span class="card-title">Palio.io Team
													<small class="float-right text-muted"><?php echo $row['MESSAGE_DATE'];?></small>
													</span>
													<p style="color: grey;"><small>
														<?php
															if($row['M_ID']==1)echo $welcome;
															else if($row['M_ID']==6)echo $due_date;
															else if($row['M_ID']==2)echo $payment;
															else if($row['M_ID']==3)echo $overdue;//substr($message3, 0, 12)."...[TRIAL]";
															else if($row['M_ID']==4)echo $cutoff_date;//substr($message4, 0, 12)."...[DUE DATE]";
															else if($row['M_ID']==5)echo $terminate;//substr($message5, 0, 12)."...[PAYMENT]";
														?></small>
													</p>
												</div>
												<div class="card-action">
													<small>
													<?php
														if($row['M_ID']==1)echo (substr($message1, 0, 100) . "..." );
														else if($row['M_ID']==2)echo (substr($message2, 0, 100) . "..." );
														else if($row['M_ID']==3)echo (substr($message3, 0, 100) . "..." );
														else if($row['M_ID']==4)echo (substr($message4, 0, 100) . "..." );
														else if($row['M_ID']==5)echo (substr($message5, 0, 50) . "..." );
														else if($row['M_ID']==6)echo (substr($message6, 0, 100) . "..." );
													?></small>
												</div>
											</div>
										</a>
									</div>
								</div>
							</li>
					<?php }?>
				</ul>
				<!-- <ul class="nav nav-tabs" id="tab-msg" style="max-height: 750px; overflow-y: auto;">
					<li class="nav-item mb-3 w-100">
						<a class="media py-2" href="#" style="color: #707070;">
							<div class="media-body" style="font-size: 15px;">
								<h5 class="time-title mb-2" style="font-size: 15px;">John Smith
									<small class="float-right text-muted">2/8/2018</small>
								</h5>
								<p class="mb-0">This is awesome product and, I am very happy with delivery &amp; product packaging..</p>
							</div>
						</a><hr>
					</li>

					<li class="nav-item mb-3 w-100">
						<a class="media py-2" href="#" style="color: #707070;">
							<div class="media-body" style="font-size: 15px;">
								<h5 class="time-title mb-2" style="font-size: 15px;">John Smith
									<small class="float-right text-muted">2/8/2018</small>
								</h5>
								<p class="mb-0">This is awesome product and, I am very happy with delivery &amp; product packaging..</p>
							</div>
						</a><hr>
					</li>

					<li class="nav-item mb-3 w-100">
						<a class="media py-2" href="#" style="color: #707070;">
							<div class="media-body" style="font-size: 15px;">
								<h5 class="time-title mb-2" style="font-size: 15px;">John Smith
									<small class="float-right text-muted">2/8/2018</small>
								</h5>
								<p class="mb-0">This is awesome product and, I am very happy with delivery &amp; product packaging..</p>
							</div>
						</a><hr>
					</li>

					<li class="nav-item mb-3 w-100">
						<a class="media py-2" href="#" style="color: #707070;">
							<div class="media-body" style="font-size: 15px;">
								<h5 class="time-title mb-2" style="font-size: 15px;">John Smith
									<small class="float-right text-muted">2/8/2018</small>
								</h5>
								<p class="mb-0">This is awesome product and, I am very happy with delivery &amp; product packaging..</p>
							</div>
						</a><hr>
					</li>

					<li class="nav-item mb-3 w-100">
						<a class="media py-2" href="#" style="color: #707070;">
							<div class="media-body" style="font-size: 15px;">
								<h5 class="time-title mb-2" style="font-size: 15px;">John Smith
									<small class="float-right text-muted">2/8/2018</small>
								</h5>
								<p class="mb-0">This is awesome product and, I am very happy with delivery &amp; product packaging..</p>
							</div>
						</a><hr>
					</li>

					<li class="nav-item mb-3 w-100">
						<a class="media py-2" href="#" style="color: #707070;">
							<div class="media-body" style="font-size: 15px;">
								<h5 class="time-title mb-2" style="font-size: 15px;">John Smith
									<small class="float-right text-muted">2/8/2018</small>
								</h5>
								<p class="mb-0">This is awesome product and, I am very happy with delivery &amp; product packaging..</p>
							</div>
						</a><hr>
					</li>

					<li class="nav-item mb-3 w-100">
						<a class="media py-2" href="#" style="color: #707070;">
							<div class="media-body" style="font-size: 15px;">
								<h5 class="time-title mb-2" style="font-size: 15px;">John Smith
									<small class="float-right text-muted">2/8/2018</small>
								</h5>
								<p class="mb-0">This is awesome product and, I am very happy with delivery &amp; product packaging..</p>
							</div>
						</a><hr>
					</li>

					<li class="nav-item mb-3 w-100">
						<a class="media py-2" href="#" style="color: #707070;">
							<div class="media-body" style="font-size: 15px;">
								<h5 class="time-title mb-2" style="font-size: 15px;">John Smith
									<small class="float-right text-muted">2/8/2018</small>
								</h5>
								<p class="mb-0">This is awesome product and, I am very happy with delivery &amp; product packaging..</p>
							</div>
						</a><hr>
					</li>

					<li class="nav-item mb-3 w-100">
						<a class="media py-2" href="#" style="color: #707070;">
							<div class="media-body" style="font-size: 15px;">
								<h5 class="time-title mb-2" style="font-size: 15px;">John Smith
									<small class="float-right text-muted">2/8/2018</small>
								</h5>
								<p class="mb-0">This is awesome product and, I am very happy with delivery &amp; product packaging..</p>
							</div>
						</a><hr>
					</li>

					<li class="nav-item mb-3 w-100">
						<a class="media py-2" href="#" style="color: #707070;">
							<div class="media-body" style="font-size: 15px;">
								<h5 class="time-title mb-2" style="font-size: 15px;">John Smith
									<small class="float-right text-muted">2/8/2018</small>
								</h5>
								<p class="mb-0">This is awesome product and, I am very happy with delivery &amp; product packaging..</p>
							</div>
						</a><hr>
					</li>

					<li class="nav-item mb-3 w-100">
						<a class="media py-2" href="#" style="color: #707070;">
							<div class="media-body" style="font-size: 15px;">
								<h5 class="time-title mb-2" style="font-size: 15px;">John Smith
									<small class="float-right text-muted">2/8/2018</small>
								</h5>
								<p class="mb-0">This is awesome product and, I am very happy with delivery &amp; product packaging..</p>
							</div>
						</a><hr>
					</li>

					<li class="nav-item mb-3 w-100">
						<a class="media py-2" href="#" style="color: #707070;">
							<div class="media-body" style="font-size: 15px;">
								<h5 class="time-title mb-2" style="font-size: 15px;">John Smith
									<small class="float-right text-muted">2/8/2018</small>
								</h5>
								<p class="mb-0">This is awesome product and, I am very happy with delivery &amp; product packaging..</p>
							</div>
						</a><hr>
					</li>

					<li class="nav-item mb-3 w-100">
						<a class="media py-2" href="#" style="color: #707070;">
							<div class="media-body" style="font-size: 15px;">
								<h5 class="time-title mb-2" style="font-size: 15px;">John Smith
									<small class="float-right text-muted">2/8/2018</small>
								</h5>
								<p class="mb-0">This is awesome product and, I am very happy with delivery &amp; product packaging..</p>
							</div>
						</a><hr>
					</li>

					<li class="nav-item mb-3 w-100">
						<a class="media py-2" href="#" style="color: #707070;">
							<div class="media-body" style="font-size: 15px;">
								<h5 class="time-title mb-2" style="font-size: 15px;">John Smith
									<small class="float-right text-muted">2/8/2018</small>
								</h5>
								<p class="mb-0">This is awesome product and, I am very happy with delivery &amp; product packaging..</p>
							</div>
						</a><hr>
					</li>
				</ul> -->
			</div>
			<div class="col-lg-7">
				<div class="tab-content">
					<!-- <div id="menu0" class="tab-pane active fs-12" style="background-color: #ECF0F5; padding: 10px;"> -->
						<div class="col scroll-y vhi-100 card bg-white rounded-0 border-0 p-0 invisible-sm" id="mail-content" style="height: 810px;">
							<div class=" p-4">
								<div class="list-unstyled userlist mb-4">
									<div class="item new-item" id="inntroshortprofile">
										<a class="media py-2" data-toggle="modal" data-target="#profilemodal">
											<div class="media-body">
												<h5 class="time-title mb-2 text-dark">Palio.io Team
													<small class="float-right text-muted"><?php echo $itemMessage2['MESSAGE_DATE'];?></small>
												</h5>
												<p style="color: grey;">
													<small>
														<?php
															if($itemMessage2['M_ID']==1)echo $welcome;
															else if($itemMessage2['M_ID']==6)echo $due_date;
															else if($itemMessage2['M_ID']==2)echo $payment;
															else if($itemMessage2['M_ID']==3)echo $overdue;//substr($message3, 0, 12)."...[TRIAL]";
															else if($itemMessage2['M_ID']==4)echo $cutoff_date;//substr($message4, 0, 12)."...[DUE DATE]";
															else if($itemMessage2['M_ID']==5)echo $terminate;//substr($message5, 0, 12)."...[PAYMENT]";
														?>
													</small>
												</p>
												<!-- <p class="mb-0 text-secondry">johnsmith@example.com</p> -->
											</div>
										</a>
									</div>
								</div>
								<br>
								<!-- body -->
								<div class="list-unstyled userlist mb-4">
									<p class="fs-12" style="color: #707070; font-size: 15px; padding: 15px;">
										<?php
											$dataDesc = explode("|", $itemMessage2['MESSAGE_DESC']);
											$dataDesc2 = strtotime($dataDesc[1]);

											$dataAmount = explode("|", $itemMessage2['MESSAGE_DESC']);
											$dataDate = $itemMessage2['MESSAGE_DATE'];
											$dataDate2 = strtotime($dataDate[1]);


											if($itemMessage2['M_ID']==1)echo $message1;
											else if($itemMessage2['M_ID']==2)echo $message2;
											else if($itemMessage2['M_ID']==3)echo $message3;
											else if($itemMessage2['M_ID']==4)echo $message4;
											else if($itemMessage2['M_ID']==5)echo $message5;
											else if($itemMessage2['M_ID']==6)echo $message6;
											// else if($itemMessage2['M_ID']==2)echo $message2.date('d M Y', $dataDesc2).$nextMessage34;
											// else if($itemMessage2['M_ID']==3)echo $message3.date('d M Y', $dataDesc2).$nextMessage34;
											// else if($itemMessage2['M_ID']==4)echo $message4.date('d M Y', $dataDesc2).$nextMessage34;
											// else if($itemMessage2['M_ID']==5)echo $message5.date('d M Y'.$dataDate2).' of $'.$dataAmount[1].$nextMessage5;
										?>
									</p>
								</div>
							</div>
						</div>
					<!-- </div> -->
				</div>
			</div>
		</div>
    <!-- </div> -->

  </div>
  <!-- /.content-wrapper -->

  <script type="text/javascript">
	$('.nav-dashboard.dash').addClass('active');
</script>


<?php require_once($_SERVER['DOCUMENT_ROOT'].'/footerdashboard.php'); ?>
