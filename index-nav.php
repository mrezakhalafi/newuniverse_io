<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/db_conn.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/session_function.php');
if (isset($_SESSION['id_user'])) {
    include_once($_SERVER['DOCUMENT_ROOT'] . '/session_check.php');
}

if (isset($_POST['submitLogout'])) {
    session_destroy();
    header("Location: index.php");
}

$TLver = 'v=' . time();

$dbconn = getDBConn();

// language
$query = $dbconn->prepare("SELECT VALUE FROM SITE_SETTINGS WHERE PROPERTY = 'LANGUAGE'");
$query->execute();
$lang_setting = $query->get_result()->fetch_assoc();
$language = $lang_setting['VALUE'];
$query->close();

// geoloc
$query = $dbconn->prepare("SELECT VALUE FROM SITE_SETTINGS WHERE PROPERTY = 'GEOLOC'");
$query->execute();
$geoloc = $query->get_result()->fetch_assoc();
$geolocSts = $geoloc['VALUE'];
$query->close();

$_SESSION['language'] = $language;
$_SESSION['geolocSts'] = $geolocSts;
echo "<script>
    localStorage.geolocSts = " . $geolocSts . ";
    localStorage.fixedLanguage = " . $language . ";
    </script>";

?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/palio-button.php'); ?>

<script type="module" src="<?php echo base_url(); ?>translate.js?<?php echo $TLver; ?>"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>countdown.js"></script>

<script>
    <?php if ($geolocSts == 1) { ?>
        // console.log('geoloc ON');

        localStorage.prevGeoloc = localStorage.currentGeoloc;
        localStorage.currentGeoloc = 'ON';

        localStorage.removeItem('switchLang');

        var ONE_HOUR = 3600; //second

        if (localStorage.country_code == null || typeof localStorage.country_code === 'undefined' ||
            localStorage.lastCheck == null || typeof localStorage.lastCheck === 'undefined' || localStorage.getItem("language_dialog") == null ||
            (Math.floor(Date.now() / 1000) - localStorage.lastCheck) > ONE_HOUR) {

            console.log('masih belum pilih cuy')
            geoLoc();
        }

        <?php  } else {
        if ($language == 0) {
        ?>
            localStorage.clear();
            localStorage.prevGeoloc = localStorage.currentGeoloc;
            localStorage.currentGeoloc = 'OFF';

            // console.log('geoloc OFF, EN only');
            localStorage.lang = 0;
            localStorage.lang_visible = 0;
            localStorage.switchLang = 0;
            localStorage.country_code = 'EN';

        <?php } else if ($language == 1) { ?>
            localStorage.clear();
            localStorage.prevGeoloc = localStorage.currentGeoloc;
            localStorage.currentGeoloc = 'OFF';

            // console.log('geoloc OFF, ID only');
            localStorage.lang = 1;
            localStorage.lang_visible = 0;
            localStorage.switchLang = 1;
            localStorage.country_code = 'ID';

    <?php }
    } ?>
</script>

<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>

<style>
    .coutndown-header {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
        border-radius: 6px;
        padding: .5rem 1rem;
    }

    .label {
        font-size: .75rem;
        font-weight: 700;
        color: rgba(34, 46, 58, .25);
        /* margin-right: 16px; */
        padding: .5rem 1rem;
    }

    .countdown-header .countdown-six-hours {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-pack: justify;
        -ms-flex-pack: justify;
        justify-content: space-between;
        width: 250px;
    }


    .countdown-header .countdown-six-hours .divider,
    .countdown-header .countdown-six-hours span {
        font-size: 1.75rem;
        font-weight: 700;
        color: #222e3a;
    }

    .countdown-header .countdown-six-hours .count {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
    }

    .countdown-header .countdown-six-hours .divider,
    .countdown-header .countdown-six-hours span {
        font-size: 1.75rem;
        font-weight: 700;
        color: #222e3a;
    }

    @media screen and (min-width: 992px) {
        #countdown-mbl {
            display: none;
        }
    }

    @media screen and (min-width: 991px) and (max-width: 1359px) {

        #usecase-nav,
        #products-navbar,
        #lang-nav {
            margin-top: 9px;
        }

        #login,
        #signup,
        #dashboard-button {
            margin-top: 20px;
        }
    }

    @media screen and (max-width: 1164px) {
        #lang-nav {
            margin-top: 18px;
        }
    }

    @media screen and (min-width: 1360px) {
        #lang-nav {
            margin-top: 10px !important;
        }
    }

    @media screen and (min-width: 991px) and (max-width: 1230px) {
        #dashboard-button {
            /* margin-top: 20px; */
        }
    }

    @media screen and (max-width: 991px) {

        #countdown-label-desktop,
        #countdown-desktop {
            display: none;
        }

    }

    @media screen and (max-width:600px) {
        .navbar-toggler {
            position: absolute;
            right: 20px;
            top: 15px;
        }

        .nav-link {
            padding: .3rem 0;
        }
    }

    @media screen and (min-width:601px) and (max-width:768px) {
        .navbar-toggler {
            position: absolute;
            right: 30px;
            top: 20px;
        }
    }

    @media screen and (min-width:769px) and (max-width:992px) {
        .navbar-toggler {
            position: absolute;
            right: 40px;
            top: 25px;
        }
    }

    .noTitleBar {
        display: none;
    }

    html {
        height: 100%;
        overflow-y: scroll;
        -webkit-overflow-scrolling: touch;
    }

    .html-scroll-modal {
        max-width: 100% !important;
        overflow: hidden !important;
    }
</style>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

<style>
    .nav-menu-btn-wht-alt {
        /* background-color: #002d91!important; color: #fff; margin:5px 10px;
        font-family:'Poppins',sans-serif; font-weight:normal; */
        background-color: #1799ad;
        color: #fff;
        margin: 5px 10px;
        font-family: 'Poppins', sans-serif;
        font-weight: 400 !important;
        border-radius: 10px;
    }

    .nav-menu-btn-wht-alt:hover {
        background-color: #fff;
        color: #1799ad;
        border-style: solid;
        border-color: #1799ad !important;
    }

    .nav-menu-btn-wht-alt-subs {
        /* background-color: #002d91!important; color: #fff; margin:5px 10px;
        font-family:'Poppins',sans-serif; font-weight:normal; */
        background-color: #efb455;
        color: #fff;
        margin: 5px 10px;
        font-family: 'Poppins', sans-serif;
        font-weight: 400 !important;
        border-radius: 10px;
    }

    .nav-menu-btn-wht-alt-subs:hover {
        background-color: #fff;
        color: #efb455;
        border-style: solid;
        border-color: #efb455 !important;
    }

    .nav-menu-btn-wht-alt-index {
        /* background-color: #002d91!important; color: #fff; margin:5px 10px;
        font-family:'Poppins',sans-serif; font-weight:normal; */
        background-color: #fff;
        color: #1799ad;
        margin: 5px 10px;
        font-family: 'Poppins', sans-serif;
        font-weight: 400 !important;
        border-radius: 10px;
        border-style: solid;
        border-color: #1799ad;
    }

    .nav-menu-btn-wht-alt-index:hover {
        background-color: #1799ad !important;
        color: #fff;
    }

    .modal-open .modal {
        overflow-x: hidden !important;
        overflow-y: hidden !important;
    }

    .modal-dialog,
    .modal-content {
        overflow-y: hidden !important;
    }

    .dropdown-toggle::after {
        margin-left: 0.6rem !important;
    }
</style>

</head>

<body style="overflow-x: hidden">
    <p hidden>
        Live Streaming
        Video Call
        Chat
        Audio Call
        Chatbot
        Call SDK
        Video Call SDK
    </p>

    <!-- <div id="dialog-confirm" title="Change language?" style="display:none;">
        <p>We detect that you are accessing newuniverse.io from Indonesia. Would you like to change the language to Bahasa Indonesia?</p>
        <hr>
        <p>Kami mendeteksi kamu melakukan akses ke newuniverse.io dari Indonesia. Apakah kamu ingin menggunakan Bahasa Indonesia?</p>
    </div> -->

    <div class="modal" tabindex="-1" role="dialog" id="dialog-confirm" data-backdrop="static" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <!-- <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div> -->
                <div class="modal-body">
                    <p data-translate="indexnav-33"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" id="dialog-confirm-yes" data-translate="indexnav-34" class="btn btn-primary" data-dismiss="modal" style="background-color:#1799ad !important; border: 1px solid #1799ad !important">Yes</button>
                    <button type="button" id="dialog-confirm-no" data-translate="indexnav-35" class="btn btn-secondary">No</button>
                </div>
            </div>
        </div>
    </div>

    <!-- session expire modal -->
    <div class="modal" tabindex="-1" id="modal-session-expire" data-backdrop="static" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div> -->
                <div class="modal-body">
                    You are now logged out.
                </div>
                <div class="modal-footer">
                    <button type="button" id="close-session-expire" class="btn btn-sm btn-primary" data-dismiss="modal" style="background-color:#1799ad !important; border: 1px solid #1799ad !important">OK</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top px-0" id="navtop-alt" style="transition: top 0.3s;">
        <div id="menu-navbar" class="container" style="max-width: 100%">
            <a class="navbar-brand fontRobReg me-0" href="<?php echo base_url(); ?>">
                <!-- <img src="<?php echo base_url(); ?>newAssets/home.png" id="homeLogo" style="max-height: 30px;"> -->
                <img src="<?php echo base_url(); ?>green_newuniverse.png" id="logoImg">
            </a>
            <button id="navbar-main" class="navbar-toggler navbar-toggler-right" style="background-color: #1799ad !important;" type="button" data-toggle="collapse" data-target="#navbar-section" aria-controls="navbar-section" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse pt-2" id="navbar-section">
                <ul class="navbar-nav ml-auto d-flex justify-content-center align-items-start">
                    <li class="nav-item dropdown position-static" id="usecase-li">
                        <a data-translate="indexnav-9" style="font-size: 18px !important; margin-right: 0px;" class="nav-link nav-menu-link dropdown-toggle fontRobReg fs-20 greenText" id="usecase-nav" aria-haspopup="true" aria-expanded="false" href="<?php echo base_url(); ?>usecase.php"></a>
                        <div class="dropdown-menu" id="usecase-menu" aria-labelledby="dropdownMenuButton">
                            <div class="col d-flex justify-content-start p-0">
                                <a data-translate="indexnav-10" class="dropdown-item fontRobReg fs-20 py-2 greenText" href="<?php echo base_url(); ?>usecase.php#cs" style="display: inline;  color: #1a73e8;"></a>
                            </div>
                            <div class="col d-flex justify-content-start p-0">
                                <a data-translate="indexnav-11" class="dropdown-item fontRobReg fs-20 py-2 greenText" href="<?php echo base_url(); ?>usecase.php#retail" style="display: inline;  color: #1a73e8;"></a>
                            </div>
                            <div class="col d-flex justify-content-start p-0">
                                <a data-translate="indexnav-12" class="dropdown-item fontRobReg fs-20 py-2 greenText" href="<?php echo base_url(); ?>usecase.php#education" style="display: inline;  color: #1a73e8;"></a>
                            </div>
                            <div class="col d-flex justify-content-start p-0">
                                <a data-translate="indexnav-13" class="dropdown-item fontRobReg fs-20 py-2 greenText" href="<?php echo base_url(); ?>usecase.php#healthcare" style="display: inline;  color: #1a73e8;"></a>
                            </div>
                            <div class="col d-flex justify-content-start p-0">
                                <a data-translate="indexnav-14" class="dropdown-item fontRobReg fs-20 py-2 greenText" href="<?php echo base_url(); ?>usecase.php#hospitality" style="display: inline;  color: #1a73e8;"></a>
                            </div>
                            <div class="col d-flex justify-content-start p-0">
                                <a data-translate="indexnav-15" class="dropdown-item fontRobReg fs-20 py-2 greenText" href="<?php echo base_url(); ?>usecase.php#finance" style="display: inline;  color: #1a73e8;"></a>
                            </div>
                            <div class="col d-flex justify-content-start p-0">
                                <a data-translate="indexnav-16" class="dropdown-item fontRobReg fs-20 py-2 greenText" href="<?php echo base_url(); ?>usecase.php#food" style="display: inline;  color: #1a73e8;"></a>
                            </div>
                            <div class="col d-flex justify-content-start p-0">
                                <a data-translate="indexnav-17" class="dropdown-item fontRobReg fs-20 py-2 greenText" href="<?php echo base_url(); ?>usecase.php#enterprise" style="display: inline;  color: #1a73e8;"></a>
                            </div>
                            <div class="col d-flex justify-content-start p-0">
                                <a data-translate="indexnav-18" class="dropdown-item fontRobReg fs-20 py-2 greenText" href="<?php echo base_url(); ?>usecase.php#transport" style="display: inline;  color: #1a73e8;"></a>
                            </div>
                            <div class="col d-flex justify-content-start p-0">
                                <a data-translate="indexnav-19" class="dropdown-item fontRobReg fs-20 py-2 greenText" href="<?php echo base_url(); ?>usecase.php#distribution" style="display: inline;  color: #1a73e8;"></a>
                            </div>
                            <div class="col d-flex justify-content-start p-0">
                                <a data-translate="indexnav-20" class="dropdown-item fontRobReg fs-20 py-2 greenText" href="<?php echo base_url(); ?>usecase.php#realestate" style="display: inline;  color: #1a73e8;"></a>
                            </div>
                            <div class="col d-flex justify-content-start p-0">
                                <a data-translate="indexnav-21" class="dropdown-item fontRobReg fs-20 py-2 greenText" href="<?php echo base_url(); ?>usecase.php#brand" style="display: inline;  color: #1a73e8;"></a>
                            </div>

                        </div>
                    </li>

                    <li class="nav-item" id="solutions-li">
                        <a id="products-navbar" href="usocial_new.php" data-translate="indexnav-22" style="font-size: 18px !important; margin-right: 0px;" class="nav-link nav-menu-link fontRobReg fs-20 greenText" role="button" aria-haspopup="true" aria-expanded="false">Products</a>
                        <!-- <div class="dropdown-menu" id="solutions-menu" aria-labelledby="dropdownMenuButton">
                            <div class="col d-flex justify-content-start p-0">
                                <a data-translate="indexnav-23" href="usocial.php" class="dropdown-item fontRobReg fs-20 py-2 greenText" style="display: inline;  color: #1a73e8;"></a>
                            </div>
                        </div> -->
                    </li>

                    <li class="nav-item" id="solutions-li">
                        <a id="smartfeatures-nav" href="smartfeatures.php" data-translate="indexnav-31" style="font-size: 18px !important; margin-right: 0px;" class="nav-link nav-menu-link fontRobReg fs-20 greenText" role="button" aria-haspopup="true" aria-expanded="false">Smart Features</a>
                    </li>

                    <li class="nav-item d-none">
                        <a data-translate="indexnav-24" class="nav-link nav-menu-link fontRobReg fs-18 greenText" href="<?php echo base_url(); ?>newpricing.php" style="color: #1a73e8;"></a>
                    </li>

                    <?php if (isset($_SESSION['password']) && $_SESSION['password'] == md5('T3sB4Y4rN0X3nd1t')) { ?>
                        <li class="nav-item dropdown position-static" id="blog-li">
                            <a id="nu-nav" style="font-size: 18px !important; margin-right: 0px;" class="nav-link nav-menu-link dropdown-toggle fontRobReg fs-20 greenText" aria-haspopup="true" aria-expanded="false" data-translate="indexnav-30">News & Update</a>
                            <div class="dropdown-menu" id="blog-menu" aria-labelledby="dropdownMenuButton">
                                <div class="col d-flex justify-content-start p-0">
                                    <a class="dropdown-item fontRobReg fs-20 py-2 greenText" href="<?php echo base_url(); ?>blog-index.php" style="display: inline;  color: #1a73e8;" data-translate="indexnav-30">News & Update</a>
                                </div>
                                <div class="col d-flex justify-content-start p-0">
                                    <a id="newpost" class="dropdown-item fontRobReg fs-20 py-2 greenText" href="<?php echo base_url(); ?>blog-post-new.php" style="display: inline;  color: #1a73e8;" data-translate="indexnav-32"></a>
                                </div>
                            </div>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item">
                            <a id="nu-nav" class="nav-link nav-menu-link fontRobReg fs-18 greenText" href="<?php echo base_url(); ?>blog-index.php" style="color: #1a73e8;" data-translate="indexnav-30">News & Update</a>
                        </li>
                    <?php } ?>

                    <?php if (!isset($_SESSION['id_user'])) { ?>

                        <li class="nav-item">
                            <a data-translate="indexnav-25" href="<?php echo base_url(); ?>login.php" id="login" style="font-size: 18px !important" class="btn nav-menu-btn-wht-alt-index">Login</a>
                        </li>
                        <li class="nav-item">
                            <a data-translate="indexnav-26" href="sign_up.php" id="signup" style="font-size: 18px !important;" class="btn nav-menu-btn-wht-alt-subs">Subscription</a>
                        </li>

                    <?php } else { ?>

                        <li class="nav-item">
                            <a id="dashboard-button" data-translate="indexnav-27" class="btn nav-menu-btn-wht-alt" href="<?php echo base_url(); ?>dashboardv2/" style="font-size:16px !important;">Dashboard</a>
                        </li>

                    <?php } ?>

                    <li class="nav-item dropdown position-static pb-3" id="lang-li" style="display: static">
                        <a data-translate="indexnav-28" style="font-size: 18px !important; margin-right: 0px;" class="nav-link nav-menu-link dropdown-toggle fontRobReg fs-20 greenText" id="lang-nav" role="button" aria-haspopup="true" aria-expanded="false">

                        </a>
                        <div class="dropdown-menu" id="lang-menu" aria-labelledby="dropdownMenuButton">
                            <div class="col d-flex justify-content-start p-0">
                                <a class="dropdown-item fontRobReg fs-20 py-2 greenText" id="change-lang-EN" role="button" style="display: inline;  color: #1a73e8;">
                                    EN
                                </a>
                            </div>
                            <div class="col d-flex justify-content-start p-0">
                                <a class="dropdown-item fontRobReg fs-20 py-2 greenText" id="change-lang-ID" role="button" style="display: inline;  color: #1a73e8;">
                                    ID
                                </a>
                            </div>
                        </div>
                    </li>

                </ul>

            </div>
            <br>
        </div>
    </nav>

    <form method="POST" id="logoutUser" style="display:none;">
        <button type="submit" name="submitLogout" class="dropdown-item" id="logoutButton">
            <i class="fas fa-sign-out-alt mr-2"></i> Sign out
        </button>
    </form>



    <script>
        /** index nav */
        <?php if (isset($_SESSION['id_user'])) { ?>

            window.onload = function() {
                console.log("inactivity")
                resetTimer();
                inactivityTime();
                checkVisible();
                PR.prettyPrint();
            }
        <?php } else { ?>

            window.onload = function() {
                PR.prettyPrint();
                checkVisible();
            }

        <?php } ?>

        // FOR DROPDOWN NAVBAR AUTO CLOSE WHILE SCROLLING

        document.addEventListener("scroll", toggleDropdown);

        function toggleDropdown(event) {

            // CLOSE NAVBAR ONLY ON POTRAIT MODE
            // IN CASE SCROLL OCCURS ON ORIENTATION CHANGE

            if (window.innerWidth > window.innerHeight) {

                console.log("Landscape ini.");

                // Nothing

            } else {

                if ($('#navbar-section').hasClass('show')) {

                    $('#navbar-section').removeClass('show');

                }
            }

        }

        function checkiOS() {
            return [
                'iPad Simulator',
                'iPhone Simulator',
                'iPod Simulator',
                'iPad',
                'iPhone',
                'iPod'
            ].includes(navigator.platform) || (navigator.userAgent.includes("Mac") && "ontouchend" in document)
        }

        // alert(navigator.platform);

        window.addEventListener("orientationchange", (event) => {

            $('.navbar-collapse').collapse('hide');

            // if (checkiOS()){

            //     if ((window.innerHeight > window.innerWidth)) { 
            //         // alert("iOS Landscape");

            //         setTimeout(function(){
            //         console.log($('#menu-navbar .navbar-collapse').hasClass('show'));

            //         if ($('.navbar-collapse').hasClass('show')){

            //             console.log("MASUK SINI");

            //             $('#menu-navbar').css('overflow-y','scroll');
            //             $('#menu-navbar').css('height','100vh');
            //             $('body, html').css('overflow-y','hidden');

            //             $( "#menu-navbar" ).animate({
            //                 scrollTop: "+400",
            //             });

            //         }
            //     },500); 
            //     }

            //     if ((window.innerHeight < window.innerWidth)) { 
            //         // alert("iOS Potrait");

            //         $('#menu-navbar').css('overflow-y','');
            //         $('#menu-navbar').css('height','');
            //         $('body, html').css('overflow-y','');
            //     }
            // }

        });

        $(".navbar-collapse").on("show.bs.collapse", function() {

            if (window.matchMedia("(orientation: landscape)").matches) {

                $('#menu-navbar').css('overflow-y', 'scroll');
                $('#menu-navbar').css('height', '100vh');
                $('body, html').css('overflow-y', 'hidden');

                $("#menu-navbar").animate({
                    scrollTop: "+400",
                });

                // if (document.documentElement.scrollTop < 75){
                $('#lang-li').attr('style', 'padding-bottom: 65px !important');
                // }

            }

        });

        $(".navbar-collapse").on("hide.bs.collapse", function() {

            if (window.matchMedia("(orientation: landscape)").matches) {
                $('#menu-navbar').css('overflow-y', '');
                $('#menu-navbar').css('height', '');
                $('body, html').css('overflow-y', '');
            }

            $('#lang-li').attr('style', 'padding-bottom: 0 !important');

        });

        $('#lang-nav').on('click', function() {

            if (window.matchMedia("(orientation: landscape)").matches) {

                $("#menu-navbar").animate({
                    scrollTop: "+300",
                });
            }
        });

        // screen.orientation.onchange = function (){

        //     if ((screen.orientation.type.match(/\w+/)[0] == 'landscape')) {
        //         // console.log("Landscape");

        //         console.log("SINI", $('#menu-navbar .navbar-collapse').hasClass('show'));

        //         setTimeout(function(){
        //             console.log($('#menu-navbar .navbar-collapse').hasClass('show'));

        //             if ($('.navbar-collapse').hasClass('show')){

        //                 console.log("MASUK SINI");

        //                 $('#menu-navbar').css('overflow-y','scroll');
        //                 $('#menu-navbar').css('height','100vh');
        //                 $('body, html').css('overflow-y','hidden');

        //                 $( "#menu-navbar" ).animate({
        //                     scrollTop: "+300",
        //                 });

        //             }
        //         },500); 
        //     }

        //     if ((screen.orientation.type.match(/\w+/)[0] == 'portrait')) {
        //         // alert("Potrait");

        //         $('#menu-navbar').css('overflow-y','');
        //         $('#menu-navbar').css('height','');
        //         $('body, html').css('overflow-y','');
        //     }
        // };
    </script>