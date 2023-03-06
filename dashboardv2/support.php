<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/dashboardv2/dashboard_header.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/url_function.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/db_conn.php'); ?>
<?php

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

// state control
$_SESSION['previous_page'] = $_SESSION['current_page'];
$_SESSION['current_page'] = 14;
require_once($_SERVER['DOCUMENT_ROOT'] . '/state_control.php');

$email = getSession('email');
$id_company = getSession('id_company');
$id_user = getSession('id_user');

// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;
require $_SERVER['DOCUMENT_ROOT'] . '/gmail/email.php';

//SELECT * TICKET
$query = $dbconn->prepare("SELECT * FROM TICKET WHERE CREATED_BY = ?");
$query->bind_param("i", $id_user);
$query->execute();
$tickets = $query->get_result();
$query->close();

//SELECT USER_NAME TICKET
$query = $dbconn->prepare("SELECT * FROM USER_ACCOUNT WHERE ID = ?");
$query->bind_param("i", $id_user);
$query->execute();
$userData = $query->get_result()->fetch_assoc();
$username = $userData['USERNAME'];
$userMail = $userData['EMAIL_ACCOUNT'];
$query->close();

function send_email($email_address, $email_dest, $subject, $body)
{
    try {
        // Get the API client and construct the service object.
        $client = getClient();
        $service = new Google_Service_Gmail($client);

        $message = createMessage('support@palio.io', $email_dest, $subject, $body);
        sendMessage($service, 'support@palio.io', $message);


        echo "<script>";
        echo "if (localStorage.lang == 0) {";
        echo "alert('Thank you for submitting your ticket. We will get back to you as soon as we can!');";
        echo "}";
        echo "else {";
        echo "alert('Terima kasih telah mengajukan tiket anda. Kami akan kembali pada anda secepatnya!');";
        echo "}";
        echo "window.location.href = 'support.php';";
        // echo "<meta http-equiv='refresh' content='0'>";
        // echo "if ( window.history.replaceState ) {
        //     window.history.replaceState( null, null, window.location.href );
        // }";
        echo "</script>";

        // header("Location: support.php");

        // return 'Message has been sent';

    } catch (Exception $e) {

        return "Message could not be sent. Mailer Error: {$e}";
    }
}

if (isset($_POST['submit'])) {

    $dbconn = getDBConn();
    $summary = $_POST['summary'];
    $method = $_POST['method'];
    $detail = $_POST['detail'];

    //TICKET INSERT QUERY
    $query = $dbconn->prepare("INSERT INTO TICKET (CREATED_TIME, CREATED_BY, SUMMARY, METHOD, DETAIL) VALUES (NOW(), ?, ?, ?, ?)");
    $query->bind_param("isss", $id_user, $summary, $method, $detail);
    $query->execute();
    $ticket_number = $query->insert_id;
    $query->close();

    $mcc = (int) $_POST['mcc'];
    $pn = (int) $_POST['pn'];
    $um = (int) $_POST['um'];
    $lvs = (int) $_POST['lvs'];
    $vidcall = (int) $_POST['vidcall'];
    $voip = (int) $_POST['voip'];
    $others = (int) $_POST['others'];

    $problemArea = array();

    if ($mcc == 1) {
        array_push($problemArea, 'Mobile Contact Center');
    }

    if ($pn == 1) {
        array_push($problemArea, 'Push Notification');
    }

    if ($um == 1) {
        array_push($problemArea, 'Unified Messaging');
    }

    if ($lvs == 1) {
        array_push($problemArea, 'Live Video Streaming');
    }

    if ($vidcall == 1) {
        array_push($problemArea, 'Video Call');
    }

    if ($voip == 1) {
        array_push($problemArea, 'VoIP Call');
    }

    if ($others == 1) {
        array_push($problemArea, 'Others');
    }


    //SDK INSERT QUERY
    $query = $dbconn->prepare("INSERT INTO SDK (TICKET_NUMBER, MOBILE_CONTACT_CENTERS, PUSH_NOTIFICATIONS, UNIFIED_MESSAGING, LIVE_VIDEO_STREAMING, VIDEO_CALL, VOIP_CALL, OTHERS) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $query->bind_param("iiiiiiii", $ticket_number, $mcc, $pn, $um, $lvs, $vidcall, $voip, $others);
    $query->execute();
    $query->close();

    $content = 'Username: ' . $username . '<br>Email: ' . $userMail . '<br>Subject: ' . $summary . '<br>Dev. Method: ' . $method . '<br>Problem Area: ' . implode(', ', $problemArea) . '<br>Detail: ' . $detail;
    $lowerCaseMail = strtolower($userMail);
    // $content = 'Username: ' . $username . '<br>Email: ' . $userMail . '<br>Subject: ' . $summary . '<br>Dev. Method: ' . $method . '<br>Detail: ' . $detail;

    // require $_SERVER['DOCUMENT_ROOT'] . '/PHPMailer/src/Exception.php';
    // require $_SERVER['DOCUMENT_ROOT'] . '/PHPMailer/src/PHPMailer.php';
    // require $_SERVER['DOCUMENT_ROOT'] . '/PHPMailer/src/SMTP.php';

    // $mail = new PHPMailer();
    // //$mail->SMTPDebug = 2;
    // $mail->isSMTP();
    // $mail->Host       = 'smtp.gmail.com';
    // $mail->SMTPAuth   = true;
    // $mail->Username   = 'support@palio.io';
    // $mail->Password   = '12345easySoft67890';
    // $mail->SMTPSecure = 'tls';
    // $mail->Port       = 587;

    // //Recipients
    // $mail->setFrom('support@palio.io', 'Palio');
    // $mail->addAddress('support@palio.io');
    // $mail->addReplyTo('support@palio.io');

    // $mail->isHTML(true);
    // $mail->Subject = 'Support Ticket';
    // $mail->Body = $content;

    // if (!$mail->send()) {
    //     $succMsg = "";
    //     $mail->ClearAllRecipients();
    //     $msg = 'Error Mailler: ' . $mail->ErrorInfo;
    //     echo $msg;
    //     echo "<script>console.log('" . $msg . "');</script>";
    // } else {
    //     $mail->ClearAllRecipients();
    //     $sent = true;
    //     echo "<script>";
    //     echo "alert('Thank you for submitting your ticket. We will get back to you as soon as we can!');";
    //     echo "window.location.href='support.php';";
    //     echo "</script>";
    //     //   redirect(base_url() . 'dashboardv2/support.php');
    // }

    send_email('support@palio.io', 'support@palio.io', 'Support Ticket', $content);
}

$version = 'v=' . time();
?>

<style>
    @media screen and (min-width:768px) {
        #search-ticket {
            float: right;
        }
    }

    @media screen and (max-width: 600px) {
        iframe[src*=youtube] {
            display: block;
            margin: 0 auto;
            height: auto;
            max-width: 100%;
            padding-bottom: 10px;
        }
    }

    html,
    body {
        max-width: 100%;
        overflow-x: hidden;
    }
</style>

<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>

<style>
    body {
        font-family: 'Poppins', sans-serif;
    }
</style>

<div class="content-wrapper" id="support-wrapper">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="card-name"><strong data-translate="dashport-1">Documentation</strong></h4>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header" style="border-bottom: 0;">
                            <a href="<?php echo base_url(); ?>../guide/index.php">
                                <h5 data-translate="dashport-2">nexilis Lite Guide</h5>

                                <iframe width="640" height="360" src="https://www.youtube.com/embed/fuW5AR2-rf0" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h4 class="card-name"><strong data-translate="dashport-3">Support Ticket</strong></h4>
                </div>
                <div class="col-md-12 col-xl-6">
                    <div class="card" id="create-ticket">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-12 align-self-center">
                                    <h4 class="text-center m-0"><strong data-translate="dashport-4">Create Ticket</strong></h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form name="ticket_form" method="POST" id="submit_ticket">
                                <!-- <h4 class="text-center"><strong>Create Ticket</strong></h4> -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <span data-translate="dashport-5">What is this issue about?</span>
                                        <input type="textarea" id="ticketTitle" maxlength="60" class="form-control" name="summary" placeholder="Subject" required>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-12">
                                        <span data-translate="dashport-6">What is your development method?</span>
                                        <div class="row mt-3">
                                            <div class="col-md-5 mx-auto">
                                                <label class="container-check">Flutter
                                                    <input type="radio" name="method" value="flutter" checked>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                            <div class="col-md-5 mx-auto">
                                                <label class="container-check">Native Android
                                                    <input type="radio" name="method" value="native">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <span data-translate="dashport-7">Problem Area</span>
                                        <div class="row mt-3">
                                            <div class="col-md-5 mx-auto">
                                                <label class="container-check fontRobReg">Mobile Contact Center
                                                    <input type="checkbox" id="mcc" name="mcc" value="1" checked onchange="checkFunction(this);">
                                                    <span class="checkmark"></span>
                                                </label>
                                                <label class="container-check">Push Notification
                                                    <input type="checkbox" id="pn" name="pn" value="1" onchange="checkFunction(this);">
                                                    <span class="checkmark"></span>
                                                </label>
                                                <label class="container-check">Unified Messaging
                                                    <input type="checkbox" id="um" name="um" value="1" onchange="checkFunction(this);">
                                                    <span class="checkmark"></span>
                                                </label>
                                                <label class="container-check">Live Video Streaming
                                                    <input type="checkbox" id="lvs" name="lvs" value="1" onchange="checkFunction(this);">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                            <div class="col-md-5 mx-auto">
                                                <label class="container-check fontRobReg">Video Call
                                                    <input type="checkbox" id="vidcall" name="vidcall" value="1" onchange="checkFunction(this);">
                                                    <span class="checkmark"></span>
                                                </label>
                                                <label class="container-check fontRobReg">VoIP Call
                                                    <input type="checkbox" id="voip" name="voip" value="1" onchange="checkFunction(this);">
                                                    <span class="checkmark"></span>
                                                </label>
                                                <label class="container-check fontRobReg">Others
                                                    <input type="checkbox" id="others" name="others" value="1" onchange="checkFunction(this);">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <span data-translate="dashport-8">Describe your issue:</span>
                                        <textarea class="form-control" id="ticketDetail" name="detail" maxlength="60" placeholder="Description" rows="2" required></textarea>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-12 text-center">
                                        <small id="forbiddenChar" style="color: red; display:none;" data-translate="dashport-11">Please refrain from using these symbols in your support ticket: " ' ` ´ ’ ‘ ; = -</small><br>
                                        <!--   -->
                                        <button class="btn mt-2 btn-yellow" id="submit-ticket" type="submit" value="submit" name="submit" disabled>
                                            <span data-translate="dashport-10">Submit</span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-xl-6">
                    <div class="card" id="recent-tickets">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-6">
                                    <span style="margin: 0; font-size:1.5rem; font-weight:500;"><strong data-translate="dashport-12">Recent Tickets</strong></span>
                                    <!-- <button class="btn pull-right" id="search-mbl" data-toggle="modal" data-target="#searchModal">
                                        <i class="fas fa-search"></i>
                                    </button> -->
                                </div>
                                <div class="col-6">
                                    <input class="form-control" id="search-ticket" type="text" placeholder="Search ticket by issue..." />
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row mt-2" id="no-tickets">
                                <div class="col-md-12">
                                    <h4 class="text-center" data-translate="dashport-13">No Recent Tickets</h4>
                                </div>
                            </div>
                            <?php foreach ($tickets as $ticket) { ?>

                                <div class="row mt-2 pb-2 monthly-bill">
                                    <div class="col-md-6">
                                        <span class="month-year"><strong><?php echo $ticket['TICKET_NUMBER']; ?></strong></span><br>
                                        <span data-translate="dashport-14">Issue:</span> <span class="ticket-name"><?php echo $ticket['SUMMARY']; ?></span><br>
                                        <span data-translate="dashport-15">Created on:</span> <?php echo $ticket['CREATED_TIME']; ?><br>
                                        <span data-translate="dashport-16">By</span> <?php echo $userData['USERNAME'];
                                            ?>
                                    </div>
                                    <div class="col-md-6 text-right align-self-center">
                                        <?php if ($ticket['STATUS'] == 0) { ?>
                                            <button class="btn btn-danger" disabled>
                                                <span data-translate="dashport-17">Unresolved</span>
                                            </button>
                                        <?php } else { ?>
                                            <button class="btn btn-success" disabled>
                                                <span data-translate="dashport-18">Resolved</span>
                                            </button>
                                        <?php } ?>
                                        </button>
                                    </div>
                                </div>
                            <?php } ?>
                            <!-- </div> -->
                            <!-- </div> -->
                            <!-- </div> -->
                        </div>
                        <!-- <div class="card-footer">
                            <a class="ticket-navigation" href="#tickets-carousel" role="button" data-slide="prev"><i class="fas fa-chevron-left"></i> Prev</a>
                            <a class="ticket-navigation" href="#tickets-carousel" role="button" data-slide="next" style="float:right;">Next <i class="fas fa-chevron-right"></i></a>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <!-- <form method="GET" action="blog_search.php"> -->
            <!-- <div class="modal-header">
            </div> -->
            <div class="modal-body">

                <input class="form-control py-2 border-right-0 border" name="qm" type="text" placeholder="Search tickets by issue..." id="example-search-input">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="font-size:1rem;" data-translate="dashport-19">Close</button>
                <button type="submit" class="btn btn-blog" data-translate="dashport-20">Search</button>
            </div>
            <!-- </form> -->
        </div>
    </div>
</div>

<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/dashboardv2/dashboard_footer.php'); ?>

<script src="js/support_raw.js?<?php echo $version; ?>"></script>

<script>
    var _0x5949 = ['a.nav-link[href=\x22mailbox.php\x22]', '869053cGhRlA', '21730YsPQuM', '371VJiiOA', 'a.nav-link[href=\x22usage.php\x22]', '451680guHajX', 'active', '2027duTcSS', 'removeClass', '19nNedkn', 'addClass', 'a.nav-link[href=\x22index.php\x22]', '252645UCLALp', 'a.nav-link[href=\x22billpayment.php\x22]', '407220gMJjRM', '1XRjAlx', '1202032wQQrMx'];
    var _0x3be9 = function(_0x2d15dc, _0x23667b) {
        _0x2d15dc = _0x2d15dc - 0x98;
        var _0x59495d = _0x5949[_0x2d15dc];
        return _0x59495d;
    };
    var _0xeb4428 = _0x3be9;
    (function(_0x5af5ad, _0x50638f) {
        var _0x2cbd90 = _0x3be9;
        while (!![]) {
            try {
                var _0x355172 = -parseInt(_0x2cbd90(0x98)) * -parseInt(_0x2cbd90(0x9b)) + -parseInt(_0x2cbd90(0x9d)) * parseInt(_0x2cbd90(0xa1)) + -parseInt(_0x2cbd90(0x9f)) + parseInt(_0x2cbd90(0x99)) + -parseInt(_0x2cbd90(0x9c)) * parseInt(_0x2cbd90(0xa3)) + parseInt(_0x2cbd90(0xa8)) + -parseInt(_0x2cbd90(0xa6));
                if (_0x355172 === _0x50638f) break;
                else _0x5af5ad['push'](_0x5af5ad['shift']());
            } catch (_0x5ceefa) {
                _0x5af5ad['push'](_0x5af5ad['shift']());
            }
        }
    }(_0x5949, 0x94b45), $(_0xeb4428(0xa7))[_0xeb4428(0xa2)](_0xeb4428(0xa0)), $(_0xeb4428(0xa5))[_0xeb4428(0xa2)](_0xeb4428(0xa0)), $(_0xeb4428(0x9e))[_0xeb4428(0xa2)](_0xeb4428(0xa0)), $('a.nav-link[href=\x22support.php\x22]')[_0xeb4428(0xa4)](_0xeb4428(0xa0)), $(_0xeb4428(0x9a))['removeClass'](_0xeb4428(0xa0)));
</script>

<script> 

    // $('#lang-nav').hover(function(){
    //     $('#lang-menu').dropdown("show");
    //     }, function(){
    //     $('#lang-menu').dropdown("hide");
    // });

    // $('#lang-menu').hover(function(){
    //     $('#lang-menu').dropdown("show");
    //     }, function(){
    //     $('#lang-menu').dropdown("hide");
    // });

    $("#change-lang-EN").click(function () {
		localStorage.lang = 0;
		$("#lang-nav").text('EN');
        $('#ticketTitle').attr('placeholder','Subject');
        $('#ticketDetail').attr('placeholder','Description');
        $('#search-ticket').attr('placeholder','Search ticket by issue...');
		change_lang();
	});

	$("#change-lang-ID").click(function () {
		localStorage.lang = 1;
		$("#lang-nav").text('ID');
        $('#ticketTitle').attr('placeholder','Subjek');
        $('#ticketDetail').attr('placeholder','Deskripsi');
        $('#search-ticket').attr('placeholder','Cari tiket');
		change_lang();
	});  

    if (localStorage.lang == 1){
        $('#ticketTitle').attr('placeholder','Subjek');
        $('#ticketDetail').attr('placeholder','Deskripsi');
        $('#search-ticket').attr('placeholder','Cari tiket');
    }

</script>