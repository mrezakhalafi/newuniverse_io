<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/header-palio.php'); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/header-alt-meta.php'); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/index-nav.php'); ?>

<style>
    @media (max-width: 600px) {
        .store {
            max-width: 125px !important;
        }
    }

    @media screen and (min-width: 1367px) {
        #row-connect {
            margin: 3rem 0 !important;
        }

        #row-embed {
            padding: 3rem 0 !important;
            margin-top: 10rem;
        }

        #p-embed {
            margin: 1.5rem 0 !important;
        }

        #main-col {
            flex: 0 0 58.333333% !important;
            max-width: 58.333333% !important;
        }


        .fs-35 {
            font-size: 43px !important;
        }
    }

    @media screen and (min-width:768px) {
        .btn-m-top {
            margin-top: 3rem !important;
        }

        .btn-smaller {
            font-size: 1rem !important;
        }
    }

    @media screen and (max-width:1366px) {
        #sales-line {
            font-size: 24px !important;
        }
    }


    @media screen and (min-width:601px) {
        #bg-index-alt {
            background-color: #f2ad33;
            background-image: url('../newAssets/banner awal-01.jpg');
        }
    }

    @media screen and (max-width:600px) {
        #main-col {
            flex: 0 0 80% !important;
            max-width: 80% !important;
        }
    }
</style>

<script type="text/javascript" src="<?php echo base_url(); ?>countdown.js"></script>

<script>
    // countdown script
    // Set the date we're counting down to
    var countDownDate = new Date(countdown_time).getTime();

    // Update the count down every 1 second
    var x = setInterval(function() {

        // Get today's date and time
        var now = new Date().getTime();

        // Find the distance between now and the count down date
        var distance = countDownDate - now;

        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Output the result in an element with id="demo"
        document.getElementById("daysmodal").innerHTML = days + "Days";
        document.getElementById("hoursmodal").innerHTML = hours;
        document.getElementById("minutesmodal").innerHTML = minutes;
        document.getElementById("secondsmodal").innerHTML = seconds;

        // If the count down is over, write some text
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("exlabelmodal").style.display = "none";
            document.getElementById("excountdownmodal").style.display = "none";
        }
    }, 1000);
</script>

<style>
    @media screen and (min-width: 1367px) {
        #row-connect {
            margin: 4rem 0 !important;
            /* margin: 3rem 0 !important; */
        }

        #row-embed {
            padding: 4rem 0 !important;
            /* padding: 3rem 0 !important; */
        }

        #p-embed {
            margin: 2rem 0 !important;
            /* margin: 1.5rem 0 !important; */
        }

        #main-col {
            flex: 0 0 66.666667% !important;
            max-width: 66.666667% !important;
        }

        .fs-35 {
            font-size: 43px !important;
        }
    }

    @media screen and (min-width:768px) {
        .btn-m-top {
            margin-top: 3rem !important;
        }

        .btn-smaller {
            font-size: 1rem !important;
        }
    }

    @media screen and (min-width:601px) and (max-width:1366px) {
        #sales-line {
            font-size: 24px !important;
        }

        #main-col {
            flex: 0 0 50% !important;
            max-width: 50% !important;
        }

        #p-embed {
            /* margin: 4rem 0 !important; */
            /* margin: 1.5rem 0 !important; */
            padding-top: 5rem;
        }

        .product-desc {
            font-size: 20px !important;
        }
    }

    @media screen and (min-width:769px) {
        #mobile-img {
            display: none !important;
        }
    }

    .color-green {
        color: #01686d;
    }

    .color-yellow {
        color: #f2ad33;
    }

    .fa-circle {
        font-size: 10px;
        font-weight: 500;
    }

    @media (max-width:576px) {
        #header {
            font-size: 28px !important;
        }
    }

    @media (min-width:768px) {
        #header {
            font-size: 36px !important;
        }
    }

    @media (min-width:1024px) {
        #header {
            font-size: 40px !important;
        }
    }
    .card-yellow {
        background-color: #f2ad33;
        padding: 30px !important;
    }
    .btn-green {
        border-radius: 10px;
        background-color: #007a87;
        color: white;
    }
</style>

<header id="bg-index-alt">
    <div class="container pt-4 pb-5">
        <div class="row justify-content-center py-3 my-5">
            <div class="col-md-5 py-5" id="main-col">
                <div class="row text-center" id="row-connect">
                    <div class="col-12">
                        <p class="fontRobBold" style="color:#262626;" id="header">Your App + Your Patients
                        </p>
                    </div>
                </div>
                <div class="row text-center" id="mobile-img">
                    <div class="col-12">

                        <img src="<?php echo base_url(); ?>newAssets/homepage/banner-img-mbl.png" style="max-height: 300px;" />
                    </div>
                </div>
                <div class="row text-center" id="row-embed">
                    <div class="col-12">

                        <p class="fontRobReg fs-32 mt-3" id="p-embed" style="color:#262626; font-size: 20px;">
                            A white-label, Patient-Engagement, Telemedicine app that helps grow your medical practice revenues and personalize patient care
                        </p>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-12 mx-auto text-center">
                        <img alt='Get it on Google Play' src='https://play.google.com/intl/en_us/badges/static/images/badges/en_badge_web_generic.png' style='max-width: 200px;' />
                        <!-- <a href='https://play.google.com/store/apps/details?id=io.newuniverse.IndonesiaBisa&hl=en_US&pcampaignid=pcampaignidMKT-Other-global-all-co-prtnr-py-PartBadge-Mar2515-1'><img alt='Get it on Google Play' src='https://play.google.com/intl/en_us/badges/static/images/badges/en_badge_web_generic.png' style='max-width: 200px;' /></a> -->
                        <img class="mx-auto store" src="ucaas_assets\img\app_store_editedx.png" style="max-width:185px; height: 52px;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/fabmsg.php'); ?>

<div class="container-fluid my-5 py-3">

    <div class="row justify-content-center text-center m-0">
        <div class="col-md-8">
            <!-- <img src="<?php echo base_url(); ?>newAssets/endtoend.png" class="img-fluid align-self-center"> -->
            <p class="fs-30" id="sales-line" style="font-family: 'Work Sans'; font-style:italic; color:#01686d;">
                With your app your patients can
            </p>
            <div class="row justify-content-center my-5">
                <div class="col-md-3">
                    <div class="card">
                        <img src="<?php echo base_url(); ?>newAssets/telemed/view-staff-profile.png" class="mx-auto" style="width: 100px; height:auto;">
                        <h5 class="card-title mt-2">
                            View Medical Staff
                        </h5>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <img src="<?php echo base_url(); ?>newAssets/telemed/book-appointments.png" class="mx-auto" style="width: 100px; height:auto;">
                        <h5 class="card-title mt-2">
                            Book Appointments
                        </h5>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <img src="<?php echo base_url(); ?>newAssets/telemed/ask-questions.png" class="mx-auto" style="width: 100px; height:auto;">
                        <h5 class="card-title mt-2">
                            Ask Questions
                        </h5>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <img src="<?php echo base_url(); ?>newAssets/telemed/consult-via-video.png" class="mx-auto" style="width: 100px; height:auto;">
                        <h5 class="card-title mt-2">
                            Consult via Video
                        </h5>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-3">
                    <div class="card">
                        <img src="<?php echo base_url(); ?>newAssets/telemed/make-payments.png" class="mx-auto" style="width: 100px; height:auto;">
                        <h5 class="card-title mt-2">
                            Make Payments
                        </h5>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <img src="<?php echo base_url(); ?>newAssets/telemed/receive-mobile-notifications.png" class="mx-auto" style="width: 100px; height:auto;">
                        <h5 class="card-title mt-2">
                            Receive Mobile Notifications
                        </h5>
                    </div>
                </div>
                <!-- <div class="col-md-3">
                    <div class="card">
                        <img src="<?php echo base_url(); ?>newAssets/telemed/ask-questions.png" class="mx-auto" style="width: 100px; height:auto;">
                        <h5 class="card-title mt-2">
                            Ask Questions
                        </h5>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <img src="<?php echo base_url(); ?>newAssets/telemed/consult-via-video.png" class="mx-auto" style="width: 100px; height:auto;">
                        <h5 class="card-title mt-2">
                            Consult via Video
                        </h5>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</div>

<div class="container mt-5" id="features-list">
    <div class="row justify-content-center bg-light my-auto" data-aos="fade-left">
        <div class="col-md-11">
            <div class="row">
                <div class="col-md-6 order-lg-1 text-center mx-auto">
                    <!-- <img src="<?php echo base_url(); ?>newAssets/homepage/livestreaming.gif" class="img-fluid ls"> -->
                    <video src="livestreaming.mp4" type="video/mp4" playsinline autoplay muted loop style="max-height: 500px;"></video>

                </div>
                <div class="col-md-6 order-lg-2 features-desc my-auto mx-auto">
                    <h2 class="fontRobBold fs-35 color-green">Doctor Listing & Profiles</h2>
                    <br>
                    <h3 class="fs-24 fontRobReg product-desc">Help your patients make informed choices. Display listing of all
                        consultants and staff members at your healthcare organization for patients to connect with.
                    </h3>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center my-auto" data-aos="fade-right">
        <div class="col-md-11">
            <div class="row">
                <div class="col-md-6 order-lg-2  text-center mx-auto">
                    <img src="<?php echo base_url(); ?>newAssets/homepage/video-call.gif" class="img-fluid">
                    <!-- <video src="<?php echo base_url(); ?>newAssets/homepage/video-call.gif" playsinline autoplay muted loop style="max-height: 500px;"></video> -->
                    <!-- <source src="videocall.mp4" type="video/mp4"> -->
                    <!-- </video> -->
                </div>
                <div class="col-md-6 order-lg-1 features-desc my-auto mx-auto">
                    <h2 class="fontRobBold fs-35 color-green">Text Consultations</h2>
                    <br>
                    <h3 class="fs-24 fontRobReg product-desc">Getting the right answers was never this easy. You app will allow patients to ask questions and get second opinions,
                        whenever they need, wherever they are. Want to charge your patients for the advice - that's possible too, all through the app.
                    </h3>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center bg-light" data-aos="fade-left">
        <div class="col-md-11">
            <div class="row">
                <div class="col-md-6 order-lg-1  text-center mx-auto">
                    <img src="<?php echo base_url(); ?>newAssets/homepage/audiocall.png" class="img-fluid ac">
                </div>
                <div class="col-md-6 order-lg-2 features-desc my-auto mx-auto">
                <h2 class="fontRobBold fs-35 color-green">Telehealth and Video Consultations</h2>
                    <br>
                    <h3 class="fs-24 fontRobReg product-desc">A white-labeled Telehealth solution built for your practice. 
                        Follow-ups get easier with Video Consultations than ever before. Patients can book a session, consult via video 
                        and receive a consultation summary directly through the app. Patients can also pay you directly through the app. 
                        Telehealth opens up a whole new revenue stream for your clinic practice.
                    </h3>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center my-auto" data-aos="fade-right">
        <div class="col-md-10">
            <div class="row">
                <div class="col-md-6 order-lg-2 text-center mx-auto">
                    <img src="<?php echo base_url(); ?>newAssets/homepage/unifiedmessaging.png" class="img-fluid um">
                </div>
                <div class="col-md-6 order-lg-1 features-desc my-auto mx-auto">
                <h2 class="fontRobBold fs-35 color-green">Accept Online Payments</h2>
                    <br>
                    <h3 class="fs-24 fontRobReg product-desc">
                        Easily accept online payments for Appointments, Care Plans or Question services within the app.
                    </h3>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center bg-light my-auto" data-aos="fade-left">
        <div class="col-md-10">
            <div class="row">
                <div class="col-md-6 order-lg-1 text-center mx-auto">
                    <img src="<?php echo base_url(); ?>newAssets/homepage/screensharing.png" class="img-fluid um">
                </div>
                <div class="col-md-6 order-lg-2 features-desc my-auto mx-auto">
                    <h2 class="fontRobBold fs-35 color-green">Upload Medical Records</h2>
                    <br>
                    <h3 class="fs-24 fontRobReg product-desc">Sharing medical reports is a breeze. Medical Reports are stored securely in the cloud and we also support DICOM images.</h3>
                   
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center my-auto" data-aos="fade-right">
        <div class="col-md-10">
            <div class="row">
                <div class="col-md-6 order-lg-2 text-center mx-auto">
                    <img src="<?php echo base_url(); ?>newAssets/homepage/chatbot.png" class="img-fluid cb">
                </div>
                <div class="col-md-6 order-lg-1 features-desc my-auto mx-auto">
                    <h2 class="fontRobBold fs-35 color-green">Push Notifications</h2>
                    <br>
                    <h3 class="fs-24 fontRobReg product-desc">
                    With your own app you can now send push notifications directly to your patients. Your patients receive push notifications for appointments, care plan reviews, blog updates and other relevant events. SMS, Email notifications are also available.
                    </h3>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="row justify-content-center my-auto py-4 bg-light" data-aos="fade-left">
        <div class="col-md-10">
            <div class="row">
                <div class="col-md-5 order-lg-1 text-center mx-auto">
                    <img src="<?php echo base_url(); ?>newAssets/homepage/whiteboarding.png" class="img-fluid wb">
                </div>
                <div class="col-md-5 order-lg-2 features-desc my-auto mx-auto">
                    <h2 class="fontRobBold fs-35 color-green">Whiteboard</h2>
                    <br>
                    <h3 class="fs-24 fontRobReg product-desc">A collaborative tool to facilitate communication by allowing users to write and sketch on a shared whiteboard space.</h3>
                    
                    </div>
                </div>
            </div>
        </div>
    </div> -->
</div>
<div class="container-fluid py-3 mt-5" style="margin-top: 100px; background-color:#f4f4f4;">
        <div class="row">
            <div class="col-lg-4 mx-auto">
                <div class="card card-lg card-yellow text-center">
                    <div class="card-body">
                        <img class="text-center" src="ucaas_assets/img/enterprise/Group 10.png" style="height: 20px; width: auto; margin: 1rem 0 1.5rem 0;">

                        <h1 class="fontRobReg card-text">
                            Add-on to your Virtual Practice.
                            <!-- Kami siap untuk mengubah kehidupan kerja Anda. -->
                        </h1>

                    </div>
                    <div class="card-footer">
                        <a class="btn btn-green" href="contactus.php">Contact Sales</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

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

<?php //require_once($_SERVER['DOCUMENT_ROOT'] . '/palio-contact.php');
?>

<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/footer-alt.php'); ?>