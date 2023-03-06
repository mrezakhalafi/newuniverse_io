<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/dashboardv2/dashboard_header.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/url_function.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/db_conn.php'); ?>
<?php

session_start();
$email = getSession('email');
$id_company = getSession('id_company');
$id_user = getSession('id_user');

if (isset($_POST['submit'])) {

    $dbconn = getDBConn();
    $summary = $_POST['summary'];
    $method = $_POST['method'];
    $detail = $_POST['detail'];

    //TICKET INSERT QUERY
    $query = $dbconn->prepare("INSERT INTO TICKET (CREATED_TIME, CREATED_BY, SUMMARY, METHOD, DETAIL) VALUES (NOW(), ?, ?, ?, ?)");
    $query->bind_param("isss", $id_user, $summary, $method, $detail);
    $query->execute();
    $query->close();

    //SELECT TICKET NUMBER
    $query = $dbconn->prepare("SELECT * FROM TICKET WHERE CREATED_BY = ? ORDER BY TICKET_NUMBER DESC LIMIT 1");
    $query->bind_param("i", $id_user);
    $query->execute();
    $ticket_number = $query->get_result()->fetch_assoc();
    $query->close();

    $general = (int) $_POST['general'];
    $live_stream = (int) $_POST['livestreaming'];
    $video_call = (int) $_POST['videocall'];
    $audio_call = (int) $_POST['audiocall'];
    $screen_sharing = (int) $_POST['screensharing'];
    $whiteboarding = (int) $_POST['whiteboarding'];
    $unified_messaging = (int) $_POST['unifiedmessaging'];
    $chatbot = (int) $_POST['chatbot'];

    //SDK INSERT QUERY
    $query = $dbconn->prepare("INSERT INTO SDK (TICKET_NUMBER, GENERAL, LIVE_STREAMING, VIDEO_CALL, AUDIO_CALL, SCREEN_SHARING, WHITEBOARDING, UNIFIED_MESSAGING, CHATBOT) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $query->bind_param("iiiiiiiii", $ticket_number['TICKET_NUMBER'], $general, $live_stream, $video_call, $audio_call, $screen_sharing, $whiteboarding, $unified_messaging, $chatbot);
    $query->execute();
    $query->close();
}

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
$username = $query->get_result()->fetch_assoc();
$query->close();

?>

<div class="content-wrapper" id="support-wrapper">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="card-name"><strong>Support</strong></h4>
                </div>
                <div class="col-md-12 col-xl-6">
                    <div class="card" id="create-ticket">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-12 align-self-center">
                                    <h4 class="text-center m-0"><strong>Create Ticket</strong></h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form>
                                <!-- <h4 class="text-center"><strong>Create Ticket</strong></h4> -->
                                <div class="row">
                                    <div class="col-md-12">
                                        What is this issue about?
                                        <input type="textarea" class="form-control" placeholder="Subject">
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-12">
                                        What is your development method?
                                        <div class="row mt-3">
                                            <div class="col-md-5 mx-auto">
                                                <label class="container-check">Flutter
                                                    <input type="checkbox" name="method" value="flutter">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                            <div class="col-md-5 mx-auto">
                                                <label class="container-check">Native Android
                                                    <input type="checkbox" name="method" value="native">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        SDK/API
                                        <div class="row mt-3">
                                            <div class="col-md-5 mx-auto">
                                                <label class="container-check">Live Streaming
                                                    <input type="checkbox" name="livestreaming" value="ls">
                                                    <span class="checkmark"></span>
                                                </label>
                                                <label class="container-check">Video Call
                                                    <input type="checkbox" name="videocall" value="vc">
                                                    <span class="checkmark"></span>
                                                </label>
                                                <label class="container-check">Audio Call
                                                    <input type="checkbox" name="audiocall" value="cb">
                                                    <span class="checkmark"></span>
                                                </label>
                                                <label class="container-check">Screen Sharing
                                                    <input type="checkbox" name="screensharing" value="ss">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                            <div class="col-md-5 mx-auto">
                                                <label class="container-check fontRobReg">Unified Messaging
                                                    <input type="checkbox" name="unifiedmessaging" value="um">
                                                    <span class="checkmark"></span>
                                                </label>
                                                <label class="container-check fontRobReg">Chatbot
                                                    <input type="checkbox" name="chatbot" value="cb">
                                                    <span class="checkmark"></span>
                                                </label>
                                                <label class="container-check fontRobReg">Whiteboard
                                                    <input type="checkbox" name="whiteboarding" value="wb">
                                                    <span class="checkmark"></span>
                                                </label>
                                                <label class="container-check fontRobReg">All Features
                                                    <input type="checkbox" id="selectall" name="general" value="af">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        Describe your issue:
                                        <textarea class="form-control" name="detail" placeholder="Description" rows="2"></textarea>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-12 text-center">
                                        <button class="btn mt-2 btn-yellow" id="submit-ticket" type="submit" value="submit" name="submit">
                                            Submit
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
                                <div class="col-md-12 col-lg-6 align-self-center">
                                    <span style="margin: 0; font-size:1.5rem; font-weight:500;"><strong>Recent Tickets</strong></span>
                                    <button class="btn pull-right" id="search-mbl" data-toggle="modal" data-target="#searchModal">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                                <div class="col-md-6">
                                    <input class="form-control pull-right" id="search-bill" type="text" placeholder="Search..." />
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="tickets-carousel" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <?php foreach ($tickets as $ticket) { ?>
                                            <div class="row mt-2 pb-2 monthly-bill">
                                                <div class="col-md-6">
                                                    <span class="month-year"><strong><?php echo $ticket['TICKET_NUMBER']; ?></strong></span><br>
                                                    Issue: <?php echo $ticket['SUMMARY']; ?><br>
                                                    Created on: <?php echo $ticket['CREATED_TIME']; ?><br>
                                                    By <?php echo $username['USERNAME']; ?>
                                                </div>
                                                <div class="col-md-6 text-right align-self-center">
                                                    <?php if ($ticket['STATUS'] == 0) { ?>
                                                        <button class="btn btn-danger" disabled>
                                                            Unresolved
                                                        </button>
                                                    <?php } else { ?>
                                                        <button class="btn btn-success" disabled>
                                                            Resolved
                                                        </button>
                                                    <?php } ?>
                                                    </button>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a class="ticket-navigation" href="#tickets-carousel" role="button" data-slide="prev"><i class="fas fa-chevron-left"></i> Prev</a>
                            <a class="ticket-navigation" href="#tickets-carousel" role="button" data-slide="next" style="float:right;">Next <i class="fas fa-chevron-right"></i></a>
                        </div>
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

                <input class="form-control py-2 border-right-0 border" name="qm" type="text" placeholder="Search tickets..." id="example-search-input">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="font-size:1rem;">Close</button>
                <button type="submit" class="btn btn-blog">Search</button>
            </div>
            <!-- </form> -->
        </div>
    </div>
</div>

<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/dashboardv2/dashboard_footer.php'); ?>

<script>
    $(document).ready(function() {
        $('a.nav-link[href="billpayment.php"]').removeClass('active');
        $('a.nav-link[href="index.php"]').removeClass('active');
        $('a.nav-link[href="usage.php"]').removeClass('active');
        $('a.nav-link[href="support.php"]').addClass('active');
        $('.carousel').carousel('pause');
    });
</script>