<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/url_function.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/chatcore/logics/chat_dbconn.php');
session_start();

// not logged in yet
if (!isset($_SESSION['web_login'])) {
	redirect(base_url() . 'chatcore/pages/login_page.php');
}

// logout
if (isset($_POST['submit'])) {
	$dbconn = newnus();

	$query = $dbconn->prepare("SELECT * FROM WEB_LOGIN WHERE QR_CODE = ?");
	$query->bind_param("s", $_SESSION['web_login']);
	$query->execute();
	$user = $query->get_result()->fetch_assoc();
	$query->close();

	$query = $dbconn->prepare("DELETE FROM WEB_LOGIN WHERE F_PIN = ? AND FLAG = 1");
	$query->bind_param("s", $user['F_PIN']);
	$query->execute();
	$query->close();

	session_destroy();
	if($user['FLAG'] == 1){
		redirect(base_url() . 'chatcore/pages/login_page.php?env=1');
	} else {
		redirect(base_url() . 'chatcore/pages/login_page.php?env=null');
	}
	
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
	<title>Qmera Web Chat</title>
	<!-- <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script> -->
	<!-- <script src="/chatcore/assets/js/jquery-3.6.0.min.js"></script> -->
	<script src="/chatcore/assets/js/jquery-3.6.0.min.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
	<!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous"> -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css" crossorigin="anonymous">
	<link rel="stylesheet" href="../../assets/css/style.css">
</head>

<body>

	<div class="container-fluid" id="main-container">
		<div class="row h-100">
			<div class="col-12 col-sm-5 col-md-4 d-flex flex-column" id="chat-list-area" style="position:relative; max-height: 100%; overflow-y: auto;">

				<!-- Navbar -->
				<div class="row d-flex flex-row align-items-center p-2" id="navbar">
					<img alt="Profile Photo" class="img-fluid rounded-circle mr-2" style="height:50px; width:50px; cursor:pointer; object-fit:cover;" onclick="showProfileSettings()" id="display-pic">
					<div class="w-50">
						<div class="text-white font-weight-bold" id="username"></div>
						<div id="connect-status"></div>
						<div class="text-white" id="status-text"></div>
					</div>
					<div class="nav-item dropdown ml-auto">
						<i class="fa fa-users text-white" onclick="showFriendList()"></i>
					</div>
					<div class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-v text-white"></i></a>
						<div class="dropdown-menu dropdown-menu-right">
							<a class="dropdown-item" href="#" onclick="showGroupList()">View Groups</a>
							<a class="dropdown-item" href="#" id="broadcast-modal-toggle" data-toggle="modal" data-target="#broadcast-modal">Broadcast Message</a>
							<form method='POST'>
								<input type="submit" class="dropdown-item" name="submit" id="submit" value="Log Out">
							</form>
						</div>
					</div>
				</div>

				<!-- search chatlist -->
				<!-- <div class="row" id="search-chatlist-area">
					<input type="text" id="search-chatlist-input" placeholder="Search or start new chat" class="flex-grow-1 border-0 px-3 py-2 my-3 rounded shadow-sm">
				</div> -->

				<!-- Chat List -->
				<div class="row" id="chat-list" style="overflow:auto;"></div>

				<!-- Profile Settings -->
				<div class="d-flex flex-column w-100 h-100" id="profile-settings">
					<div class="row d-flex flex-row align-items-center p-2 m-0" style="background:#f2ad33; min-height:65px;">
						<i class="fas fa-arrow-left p-2 mx-3 my-1 text-white" style="font-size: 1.5rem; cursor: pointer;" onclick="hideProfileSettings()"></i>
						<div class="text-white font-weight-bold">Profile</div>
					</div>
					<div class="d-flex flex-column" style="overflow:auto;">
						<img alt="Profile Photo" class="img-fluid rounded-circle my-5 justify-self-center mx-auto" id="profile-pic">
						<input type="file" id="profile-pic-input" class="d-none" disabled>
						<div class="bg-white px-3 py-2">
							<div class="text-muted mb-2"><label for="input-name" style="font-size: small; color: #f2ad33;">Your Name</label></div>
							<input type="text" name="name" id="input-name" class="w-100 border-0 py-2 profile-input" disabled>
						</div>
						<div class="text-muted p-3 small">
							This is not your username or pin. This name will be visible to your contacts.
						</div>
						<!-- <div class="bg-white px-3 py-2">
							<div class="text-muted mb-2"><label for="input-about">About</label></div>
							<input type="text" name="name" id="input-about" value="" class="w-100 border-0 py-2 profile-input" disabled>
						</div> -->
					</div>

				</div>

				<!-- Friend list -->
				<div class="row" id="friend-list" style="overflow:auto;">
					<!-- <div class="row d-flex flex-row align-items-center p-2 m-0" style="background:#f2ad33; min-height:65px;">
						<i class="fas fa-arrow-left p-2 mx-3 my-1 text-white" style="font-size: 1.5rem; cursor: pointer;" onclick="hideFriendList()"></i>
						<div class="text-white font-weight-bold">New chat</div>
					</div> -->

				</div>

				<div class="row" id="group-list" style="overflow:auto;"></div>
				<div class="row" id="complaint-history" style="overflow:auto;"></div>

			</div>

			<!-- Message Area -->
			<div class="d-none d-sm-flex flex-column col-12 col-sm-7 col-md-8 p-0 h-100" id="message-area">
				<div class="w-100 h-100 overlay"></div>

				<!-- Navbar -->
				<div class="row d-flex flex-row align-items-center p-2 m-0 w-100" id="navbar">
					<div class="d-block d-sm-none">
						<i class="fas fa-arrow-left p-2 mr-2 text-white" style="font-size: 1.5rem; cursor: pointer;" onclick="showChatList()"></i>
					</div>
					<a href="#"><img src="https://via.placeholder.com/400x400" alt="Profile Photo" class="rounded-circle mr-2" style="height:50px; width:50px;" id="pic" onclick="showInfo()"></a>
					<div class="d-flex flex-column">
						<div class="text-white font-weight-bold" id="name"></div>
						<div class="text-white small" id="details"></div>
					</div>
					<div class="d-flex flex-row align-items-center ml-auto">
						<!-- <input type="text" class="form-control d-none" id="search-msg" placeholder="Search messages" aria-label="Search messages" aria-describedby="basic-addon2">
						<a href="#" id="open-search"><i class="fas fa-search mx-3 text-white d-none d-md-block"></i></a> -->
						<i class="fas fa-paperclip mx-3 text-white d-block dropdown-toggle" id="open-attachment" data-toggle="dropdown" data-target="attachments"></i>
						<div id="attachments" class="dropdown-menu dropdown-menu-right">
							<label class="dropdown-item" for="file">Insert File</label>
							<input type="file" id="file" name="send_file" class="d-none">
						</div>
						<!-- <a href="#"><i class="fas fa-ellipsis-v mr-2 mx-sm-3 text-white"></i></a> -->
						<div class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-v text-white"></i></a>
							<div class="dropdown-menu dropdown-menu-right">
								<a class="dropdown-item" href="#" onclick="blockUser();" id="block-user"></a>
								<a class="dropdown-item" href="#" id="delete-conversation">Delete Conversation</a>
								<a class="dropdown-item" href="#" onclick="finishComplain();" id="finish-complain">Finish Conversation</a>
							</div>
						</div>
					</div>
				</div>

				<!-- block status -->
				<div class="row flex-row align-items-center justify-content-center p-2 m-0 w-100 d-none" id="block-bar" style="background-color:#a00000;">
					<div class="d-flex flex-column">
						<div class="text-white font-weight-bold d-none mx-auto" id="you-blocked">You are blocked by this user.</div>
						<div class="text-white font-weight-bold d-none mx-auto" id="you-are-blocked">You blocked this user.</div>
					</div>
				</div>

				<!-- call center conversation -->
				<div class="row flex-row align-items-center justify-content-center p-2 m-0 w-100 d-none" id="cc-bar" style="background-color:#ADD8E6;">
					<div class="d-flex flex-column">
						<div class="text-secondary font-weight-bold mx-auto" id="cc-convo">CALL CENTER CONVERSATION</div>
					</div>
				</div>
				
				<!-- Messages -->
				<div class="d-flex flex-column" id="messages"></div>
				<div class="d-none flex-column border-0" id="document" style="background-color: #ccc;">
					<div class="flex-grow-1 m-3 rounded border border-dark" id="mediaNotif" style="background-color: #fff;">
						<div id="RemoveMediaNotif" class="RemoveMediaNotif" style="margin-right: 10px; float:right;">X</div><span id="preview-img"></span>
						<span id='document-name'>Your Document</span>
					</div>
				</div>
				<div class="d-none flex-column border-0" id="urlPreview" style="background-color: #ccc;">
					<div class="flex-grow-1 m-3 rounded border border-dark" id="urlPreviewInner" style="background-color: #fff;">
						<div class="row m-2">
							<div class="col-sm-2 align-self-center text-center">
								<img id="website-icon" src=" ../assets/img/document.png" class="mx-auto" style="height:100px; width: auto;">
							</div>
							<div class="col-sm-10 align-self-center">
								<h5 id="website-title">Test Website</h5>
								<p id="website-description">This is a test Webstie</p>
							</div>
						</div>
					</div>
				</div>
				<!-- <div class="d-none flex-column border-0" id="reply-preview" style="background-color: #ccc;">
					<div class="flex-grow-1 m-3 rounded border border-dark" id="mediaNotif" style="background-color: #fff;">
						<div id="RemoveReplyPreview" class="RemoveReplyPreview" style="margin-right: 10px; float:right;"><i class="fas fa-times"></i></div>
						<span>msg here</span>
					</div>
				</div> -->

				<!-- Input -->
				<div style="background-color: #ccc;color: #ccc;height: 10px;"></div>
				<div class="d-none justify-self-end align-items-center flex-row" id="input-area">
					<!-- <a href="#"><i class="far fa-smile text-muted px-3" style="font-size:1.5rem;"></i></a> -->
					<textarea type="text" name="message" id="input" placeholder="Type a message" class="flex-grow-1 border-0 px-3 py-2 ml-3 my-3 rounded shadow-sm"></textarea>
					<!-- <i class="fas fa-paperclip mx-3 text-muted" id="open-file" style="cursor:pointer;">
						<input type="file" id="file" name="send_file" class="d-none">
					</i> -->
					<i class="fas fa-paper-plane text-muted mx-3" style="cursor:pointer;" onclick="sendMessage()"></i>
				</div>
			</div>

			<!-- info area -->
			<div class="col-12 col-sm-5 col-md-4 d-none flex-column" id="info-area" style="position:relative; max-height: 100%;">

				<div class="d-flex flex-column w-100 h-100" id="info-detail">
					<div class="row d-flex flex-row align-items-center p-2 m-0" style="background:#f2ad33; min-height:65px;">
						<i class="fas fa-times p-2 mx-3 my-1 text-white" style="font-size: 1.5rem; cursor: pointer;" onclick="hideInfo()"></i>
						<div class="text-white font-weight-bold" id="person-or-group-info"></div>
					</div>
					<div class="d-flex flex-column" style="overflow:auto;">
						<img alt="Profile Photo" class="img-fluid rounded-circle my-5 justify-self-center mx-auto" id="person-profile-pic">
						<!-- <input type="file" id="person-profile-pic" class="d-none" disabled> -->
						<div class="bg-white px-3 py-2">
							<input type="text" name="name" id="person-name" class="w-100 border-0 py-2 profile-input" disabled>
						</div>
						<div class="bg-white px-3 py-2">
							<div class="text-muted mb-2"><label for="person-about">About</label></div>
							<input type="text" name="name" id="person-about" value="" class="w-100 border-0 py-2 profile-input" disabled>
						</div>
						<div class="bg-white px-3 py-2 d-none" id="members-section" style="overflow: auto;">
							<div class="text-muted mb-2"><label for="person-about">Members</label></div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="broadcast-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Broadcast Message</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="broadcast-form">
						<div class="form-group" id="form-target-audience">
							<label for="broadcast-target-audience" class="col-form-label">Target Audience</label>
							<select class="form-control" id="broadcast-target-audience">
								<option value="1">Customer</option>
								<option value="2">Team Member</option>
								<option value="3">All Users</option>
								<option value="4">Group</option>
								<option value="5">Specific User</option>
							</select>
						</div>
						<div class="form-group d-none" id="form-participants">
							<label for="broadcast-participants" class="col-form-label">Participants*</label><br>
							<div class="input-group mb-2">
								<input disabled class="form-control mb-2" id="broadcast-participants"></input>
								<div class="input-group-append">
									<button class="btn btn-outline-secondary" type="button" id="delete-participants"><i class="fas fa-times"></i></button>
								</div>
							</div>
							<select id="participant-list" class="form-control"></select>
						</div>
						<div class="form-group d-none" id="form-target-group">
							<label for="broadcast-target-group" class="col-form-label">Group*</label><br>
							<div class="input-group mb-2">
								<input disabled class="form-control" id="broadcast-target-group"></input>
								<div class="input-group-append">
									<button class="btn btn-outline-secondary" type="button" id="delete-groups"><i class="fas fa-times"></i></button>
								</div>
							</div>
							<select id="target-group-list" class="form-control"></select>
						</div>
						<div class="form-group" id="form-broadcast-type">
							<label for="broadcast-type" class="col-form-label">Broadcast Type</label>
							<select class="form-control" id="broadcast-type">
								<option value="1">Push Notification</option>
								<option value="2">In-App</option>
							</select>
						</div>
						<div class="form-group" id="form-broadcast-mode">
							<label for="broadcast-mode" class="col-form-label">Broadcast Mode</label>
							<select class="form-control" id="broadcast-mode">
								<option value="1">One-Time</option>
								<option value="2">Daily</option>
								<option value="3">Weekly</option>
								<option value="4">monthly</option>
							</select>
						</div>
						<div class="form-group" id="form-start-date">
							<label for="broadcast-start-date" class="col-form-label">Starting Date</label>
							<!-- <input type="datetime-local" class="form-control" id="broadcast-start"> -->
							<div class="row">
								<div class="col-md-6">
									<input type="date" class="form-control" id="broadcast-start-date">
								</div>
								<div class="col-md-4">
									<input type="time" class="form-control" id="broadcast-start-time">
								</div>
							</div>
						</div>
						<div class="form-group d-none" id="form-end-date">
							<label for="broadcast-end-date" class="col-form-label">Ending Date</label>
							<!-- <input type="datetime-local" class="form-control" id="broadcast-end"> -->
							<div class="row">
								<div class="col-md-6">
									<input type="date" class="form-control" id="broadcast-end-date">
								</div>
								<div class="col-md-4">
									<input type="time" class="form-control" id="broadcast-end-time">
								</div>
							</div>
						</div>
						<div class="form-group" id="form-broadcast-title">
							<label for="broadcast-title" class="col-form-label">Title*</label>
							<input type="text" class="form-control" id="broadcast-title" placeholder="Enter Title">
						</div>
						<div class="form-group" id="form-broadcast-msg">
							<label for="broadcast-msg" class="col-form-label">Message*</label>
							<textarea class="form-control" id="broadcast-msg" placeholder="Enter message..."></textarea>
						</div>
						<div class="form-group" id="form-broadcast-file">
							<label for="broadcast-file" class="col-form-label">File Upload *</label>
							<input type="file" class="form-control" id="broadcast-file"></textarea>
						</div>
						<div class="form-group" id="form-broadcast-link">
							<label for="broadcast-link" class="col-form-label">Link (optional)</label>
							<textarea class="form-control" id="broadcast-link" placeholder="Enter Link"></textarea>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal" id="close-broadcast">Close</button>
					<button type="button" class="btn btn-primary" id="submit-broadcast">Broadcast</button>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="broadcast-modal-result" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Broadcast Message</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					Broadcast sent!
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>

	<!-- chat with representative modal -->
	<div class="modal d-none" id="complain-modal" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Call Center</h5>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">
							<img id="complain-thumb" src="" style="width: 200px; height: 200px;">
						</div>
						<div class="col-md-6 align-self-center">
							<span>Name : </span><span id="complain-name"></span><br>
							<span>Request Type : </span><span>Chat</span><br>
							<span>Identity Number : </span><span>-</span>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" id="complain-acc" class="btn btn-primary">I'll handle this customer</button>
					<button type="button" id="complain-rej" class="btn btn-secondary">Pass to another representative</button>
				</div>
			</div>
		</div>
	</div>

	<!-- call center modal for CS staff -->
	<div class="modal fade" id="cc-staff" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content px-2">
				<div class="modal-body">
					<div class="row my-2" id="cc-center" style="cursor:pointer;">
						<div class="col-md-12 btn-light">
							Contact Call Center
						</div>
					</div>
					<div class="row my-2" id="cc-history" style="cursor:pointer;">
						<div class="col-md-12 btn-light">
							Contact Center History
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script> -->
	<script type="module" src="<?php echo base_url(); ?>translate.js?v=1.111"></script>
	<?php
	require_once('palio-button.php'); 
	
	$ver = '1.14';
	?>

	
	<script src="../../assets/js/date-utils.js"></script>
	<script src="../../assets/js/datastore.js"></script>
	<script src="../../assets/js/fetch_messages.js"></script>
	<script src="../../assets/js/fetch_bot_messages.js"></script>
	<script src="../../assets/js/fetch_users.js"></script>
	<script src="../../assets/js/fetch_user_profile.js"></script>
	<script src="../../assets/js/fetch_group_member.js"></script>
	<script src="../../assets/js/fetch_group.js"></script>
	<script src="../../assets/js/fetch_subgroup.js"></script>
	<script src="../../assets/js/fetch_discussion.js"></script>
	<script src="../../assets/js/fetch_block_status.js"></script>
	<script src="../../assets/js/paliolite/fetch_company_alias.js"></script>
	<script src="../../assets/js/paliolite/fetch_complaint.js"></script>
	<script src="../../assets/js/paliolite/fetch_complaint_history.js"></script>
	<script src="../../assets/js/paliolite/fetch_user_type.js"></script>
	<script src="../../assets/js/paliolite/fetch_friend_list.js"></script>
	<script src="../../assets/js/fetch_message_periodic.js"></script>
	<script src="../../assets/js/fetch_user_periodic.js"></script>
	<script src="../../assets/js/fetch_group_periodic.js"></script>
	<script src="../../assets/js/fetch_discussion_periodic.js"></script>
	<script src="../../assets/js/paliolite/fetch_notif_periodic.js"></script>
	<script src="../../assets/js/paliolite/script.js?r=<?= time(); ?>"></script>

</body>

</html>