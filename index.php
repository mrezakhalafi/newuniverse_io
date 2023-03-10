<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/header-alt.php'); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/header-alt-meta.php'); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/index-nav.php'); ?>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$_SESSION['previous_page'] = $_SESSION['current_page'];
$_SESSION['current_page'] = 1;
include($_SERVER['DOCUMENT_ROOT'] . '/state_control.php');

$timeSec = 'v=' . time();

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

<script>
    // AOS
    // <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
</script>


<style>
    html {
        scroll-padding-top: 140px;
        /* height of sticky header */
    }

    #banner-img-mbl-2 {
        visibility: hidden;
    }

    @media screen and (min-width:1025px) {
        #mobile-img {
            display: none !important;
        }

        #banner-img-mbl-2 {
            visibility: visible;
            /* width: 2000px; */
            /* margin-top: -27rem;  */
            width: 95%;
            margin-top: -10%;
        }
    }

    @media screen and (min-width:2600px) {
        #mobile-img {
            display: none !important;
        }

        #banner-img-mbl-2 {
            visibility: visible;
            width: 2300px;
            margin-top: -24rem;
            /* width: 95%; */
            /* margin-top: -24rem;  */
        }
    }


    @media screen and (min-width: 1367px) {
        #ctoa-row {
            margin-top: 130px;
        }

        #row-connect {
            margin: 3rem 0 !important;
        }

        #row-embed {
            padding: 3rem 0 !important;
        }

        #p-embed {
            margin: 1.5rem 0 !important;
        }

        #main-col {
            flex: 0 0 58.333333% !important;
            max-width: 58.333333% !important;
        }


        .ctoa-content-link {
            font-size: 19px;
        }
    }

    @media screen and (min-width: 1400px) {
        #ctoa-row {
            margin-top: 150px;
        }
    }

    /* @media screen and (min-width: 1600px) {
        #ctoa-row {
            margin-top: -20px;
        }
    } */

    /* @media screen and (min-width: 1900px) {
        #ctoa-row {
            margin-top: -20px;
        }
    } */

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

        #call-to-action {
            top: -1rem;
        }

        a.ctoa-content {
            font-size: 22px;
        }

        #header-title-row {
            bottom: 1rem;
        }
    }


    @media (max-width:1024px) {
        #bg-index-alt {
            background-image: linear-gradient(to bottom, #1799ad, #159db166) !important;
            /* background-image: url('newAssets/product/bi8.webp'); */
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
        }

        #banner-img-mbl {
            max-height: 500px;
            margin: 0 auto;
            width: fit-content;
        }
    }

    @media (max-width:768px) {
        #banner-img-mbl {
            max-height: 450px;
            margin: 2em auto;
        }

        #button-top {
            margin-top: 30px;
            display: block !important;
        }

        #p-heading {
            bottom: 2.75em;
            position: relative;
        }

        /* #notice {
          margin-top: 10em;
        } */
    }

    @media (max-width:1366px) {
        #banner-img-mbl {
            max-height: 700px;
            margin: 2em auto;
            width: 700px;
        }
    }

    @media screen and (max-width:600px) {
        #main-col {
            flex: 0 0 80% !important;
            max-width: 80% !important;
            top: -4.6em;
        }

        .ctoa-content-link {
            font-size: 16px;
        }

        #banner-img-mbl {
            max-height: 300px;
            margin: 2em auto;
            width: auto;
        }
    }

    .img-centered {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        padding-left: 13rem;
    }

    #img-container {
        position: relative;
        text-align: center;
    }

    @media screen and (min-width: 1367px) {
        #cu-img {
            max-width: 700px;
            height: auto;
        }

        #p-img {
            margin: 3rem 0 4rem 0 !important;
        }
    }

    @media screen and (max-width:1366px) {
        #cu-img {
            max-width: 600px;
            height: auto;
        }

        #line1,
        #line2 {
            font-size: 20px !important;
        }

        .img-centered {
            padding-left: 11.5rem !important;
        }

        #row-container {
            width: 50% !important;
        }

        #p-img {
            margin: 3rem 0 4rem 0 !important;
        }
    }

    @media screen and (max-width:600px) {
        #header-row {
            top: 7.5rem;
            position: relative;
        }

        #p-heading {
            font-size: 28px;
            bottom: 2em;
            position: relative;
        }

        .ctoa-content {
            font-size: 20px;
        }

        #p-embed {
            font-size: 22px;
            top: 1em;
            position: relative;
        }

        #call-to-action .fs-20 {
            font-size: 20px;
        }

        #call-to-action .fs-23 {
            font-size: 20px;
        }

        #cu-img {
            max-width: 100%;
            height: auto;
        }

        .img-centered {
            padding-left: 8rem !important;
        }

        #line1,
        #line2 {
            font-size: 15px !important;
        }

        #cu-logo {
            width: 50px !important;
            height: 50px !important;
        }

        #playstore-logo {
            width: 175px !important;
        }

        .img-centered {
            padding-top: 20px !important;
            padding-left: 8rem !important;
        }

        #row-container {
            width: 85% !important;
        }

        #p-img {
            margin: 0.4rem 0 !important;
        }

        #bg-index-alt {
            margin-top: -7em;
            /* background-color: #002d91!important; */
            background-image: linear-gradient(to bottom, #1799ad, #159db166) !important
        }
    }

    @media screen and (min-width: 360px) and (max-width:599px) {

        #line1 {
            margin-bottom: 0 !important;
        }

        .img-centered {
            padding-left: 7rem !important;
        }

        #row-container {
            width: 90% !important;
        }
    }

    @media screen and (min-width:768px) {
        #row-container {
            width: 100%;
        }

        #img-centered {
            padding-left: 13rem !important;
        }

        #p-img {
            margin: 2rem 0 3rem 0 !important;
        }

    }
</style>

<style>
    .available-now {
        background: #01686d;
        background-image: -webkit-linear-gradient(top, #01686d, #00595c);
        background-image: -moz-linear-gradient(top, #01686d, #00595c);
        background-image: -ms-linear-gradient(top, #01686d, #00595c);
        background-image: -o-linear-gradient(top, #01686d, #00595c);
        background-image: linear-gradient(to bottom, #01686d, #00595c);
        -webkit-border-radius: 8;
        -moz-border-radius: 8;
        border-radius: 8px;
        -webkit-box-shadow: 0px 8px 10px #333333;
        -moz-box-shadow: 0px 8px 10px #333333;
        box-shadow: 0px 8px 10px #333333;
        color: #ffffff;
        font-size: 20px;
        padding: 10px 20px 10px 20px;
        text-decoration: none;
        -webkit-appearance: none;
    }

    .available-now:hover {
        background: #008387;
        background-image: -webkit-linear-gradient(top, #008387, #016f73);
        background-image: -moz-linear-gradient(top, #008387, #016f73);
        background-image: -ms-linear-gradient(top, #008387, #016f73);
        background-image: -o-linear-gradient(top, #008387, #016f73);
        background-image: linear-gradient(to bottom, #008387, #016f73);
        text-decoration: none;
        color: #ffffff;
    }

    @media screen and (min-width: 1367px) {
        #row-connect {
            margin: 4rem 0 !important;
            /* margin: 3rem 0 !important; */
        }

        #call-to-action {
            top: 3rem;
        }

        #row-embed {
            padding: 4rem 0 !important;
            /* padding: 3rem 0 !important; */
        }

        #p-embed {
            margin: 2rem 0 !important;
            /* margin: 1.5rem 0 !important; */
            position: relative;
            top: -20px;
        }

        #main-col {
            flex: 0 0 66.666667% !important;
            max-width: 66.666667% !important;
        }

        #bg-index-alt {
            padding-bottom: 19em;
            /* background-color: #002d91!important; */
            background-image: linear-gradient(to bottom, #1799ad, #159db166) !important
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
            position: relative;
            top: -30px;
        }

        .product-desc {
            font-size: 20px !important;
        }
    }

    .color-green {
        color: #23272a;
        /* color: #01686d; */
        /* color: #002d91!important; */
    }

    .color-yellow {
        color: #002d91 !important;
    }

    @media (min-width:1025px) and (max-width: 1366px) {
        /* .spec {
            flex: 0 0 45% !important;
            max-width: 45% !important;
        } */

        .col-xl-7#whole-content {
            -ms-flex: 0 0 50%;
            flex: 0 0 50%;
            max-width: 50%;
        }

        #whole-content {
            top: 2rem;
        }

        #p-heading {
            font-size: 30px;
        }

        #p-embed,
        #call-to-action * {
            top: .25rem;
            font-size: 20px;
            position: relative;
        }

        .ctoa-content-link {
            font-size: 18px !important;
        }

        #ctoa-row {
            top: 3.25rem;
            position: relative;
        }
    }

    @media (min-width:768px) and (max-width:1024px) {
        #header-row {
            top: 6rem;
            position: relative;
        }

        .ctoa-content-link {
            font-size: 19px;
        }
    }

    .h1,
    .h2,
    .h3,
    .h4,
    .h5,
    .h6,
    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        font-weight: 500 !important;
    }

    b,
    strong {
        font-weight: 700;
    }
</style>

<style>
    /* reja = 768px */
    /* dio = 1000px */
    /* pak yudo = 2100px */
    /* pak yudo = 2300px */

    @media (max-width: 767px) {
        #banner1 {
            font-size: 16px !important;
        }

        .embed {
            font-size: 16px !important;
        }

        #banner2 {
            font-size: 16px !important;
            padding: 29px !important;
        }

        .tryit {
            font-size: 16px !important;
        }

        #btn_info {
            margin-top: -30px;
        }

        #banner3 {
            font-size: 16px !important;
        }

        .cs {
            font-size: 16px !important;
        }

        .main-header {
            font-size: 24px !important;
        }

        .worried {
            font-size: 22px !important;
        }

        .custom {
            font-size: 26px !important;
        }
    }

    @media (min-width: 2100px) {
        #header-row {
            margin-bottom: 105px;
        }
    }

    @media (min-width: 2300px) {
        #header-row {
            margin-bottom: 220px;
        }
    }

    @media (min-width: 2250px) {
        #header-row {
            margin-bottom: 185px;
        }
    }

    @media (min-width: 768px) {
        #animate2 {
            margin-left: -400px;
        }
    }

    @media (max-width: 1000px) {
        #animate2 {
            margin-left: -300px;
        }
    }

    @media (min-width: 768px) {
        #animate3 {
            margin-left: -200px;
        }
    }

    @media (max-width: 1000px) {
        #animate3 {
            margin-left: -160px;
        }
    }

    @media (min-width: 768px) {
        #animate4 {
            margin-left: -185px;
        }
    }

    @media (max-width: 1000px) {
        #animate4 {
            margin-left: -150px;
        }
    }

    /* FOR RELATIVE ABSOLUTE  */

    /* TAB */
    @media (min-width: 768px) {

        #ctoa-row {
            top: 55rem;
            position: absolute;
            width: 100%;
        }

        #whole-content {
            position: relative;
            margin-bottom: 335px;
        }

        /* .single-features {
            border-radius: 20px;
        } */

    }

    /* LAPTOP */
    @media (min-width: 1024px) {

        #ctoa-row {
            top: 22rem;
            position: absolute;
            width: 100%;
        }

        #whole-content {
            position: relative;
            margin-bottom: 335px;
        }

    }

    /* PC */
    @media (min-width: 1600px) {

        #ctoa-row {
            top: 26rem;
            position: absolute;
            width: 100%;
        }

        #whole-content {
            position: relative;
            margin-bottom: 300px;
        }

        #banner-img-mbl-2 {
            visibility: visible;
            /* width: 2000px; */
            /* margin-top: -27rem; */
            width: 75%;
            margin-top: -5%;
        }

    }

    .poppins {
        font-family: 'Poppins', sans-serif;
    }

    /* SOUNDWAVES */

    .soundwave {
        position: absolute;
        top: 150px;
        margin-left: -256px;
        margin-top: 140px;
        transform: translate(-50%, 0);
        background: #fff;
        z-index: 2;
    }

    @media (min-width: 1600px) {
        .soundwave {
            margin-left: -235px;
        }
    }

    .sound-icon {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .sound-wave {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .sound-wave .bar {
        display: block;
        width: 3px;
        margin-right: 2px;
        border-radius: 50px;
        height: 70px;
        background: #FFA03E;
        animation: sound 0ms -800ms linear infinite alternate;
        transition: height 0.8s;
    }

    .sound-wave .bar2 {
        display: block;
        width: 3px;
        margin-right: 2px;
        border-radius: 50px;
        height: 70px;

        @include breakpoint(max-sm) {
            height: 40px;
        }

        background: $theme-orange;
        animation: sound2 0ms -800ms linear infinite alternate;
        transition: height 0.8s;
    }

    @keyframes sound {
        0% {
            opacity: .35;
            height: 6px;
        }

        100% {
            opacity: 1;
            height: 64px;

            @include breakpoint(max-sm) {
                height: 40px;
            }
        }
    }

    @keyframes sound2 {
        0% {
            opacity: .35;
            height: 6px;
        }

        100% {
            opacity: 1;
            height: 70px;

            @include breakpoint(max-sm) {
                height: 40px;
            }
        }
    }

    .bar:nth-child(1) {
        height: 2px;
        animation-duration: 474ms;
    }

    .bar:nth-child(2) {
        height: 10px;
        animation-duration: 433ms;
    }

    .bar:nth-child(3) {
        height: 18px;
        animation-duration: 407ms;
    }

    .bar:nth-child(4) {
        height: 26px;
        animation-duration: 458ms;
    }

    .bar:nth-child(5) {
        height: 30px;
        animation-duration: 400ms;
    }

    .bar:nth-child(6) {
        height: 32px;
        animation-duration: 427ms;
    }

    .bar:nth-child(7) {
        height: 34px;
        animation-duration: 441ms;
    }

    .bar:nth-child(8) {
        height: 36px;
        animation-duration: 419ms;
    }

    .bar:nth-child(9) {
        height: 40px;
        animation-duration: 487ms;
    }

    .bar:nth-child(10) {
        height: 46px;
        animation-duration: 442ms;
    }

    .bar:nth-child(11) {
        height: 2px;
        animation-duration: 474ms;
    }

    .bar:nth-child(12) {
        height: 10px;
        animation-duration: 433ms;
    }

    .bar:nth-child(13) {
        height: 18px;
        animation-duration: 407ms;
    }

    .bar:nth-child(14) {
        height: 26px;
        animation-duration: 458ms;
    }

    .bar:nth-child(15) {
        height: 30px;
        animation-duration: 400ms;
    }

    .bar:nth-child(16) {
        height: 32px;
        animation-duration: 427ms;
    }

    .bar:nth-child(17) {
        height: 34px;
        animation-duration: 441ms;
    }

    .bar:nth-child(18) {
        height: 36px;
        animation-duration: 419ms;
    }

    .bar:nth-child(19) {
        height: 40px;
        animation-duration: 487ms;
    }

    .bar:nth-child(20) {
        height: 46px;
        animation-duration: 442ms;
    }

    .bar:nth-child(21) {
        height: 2px;
        animation-duration: 474ms;
    }

    .bar:nth-child(22) {
        height: 10px;
        animation-duration: 433ms;
    }

    .bar:nth-child(23) {
        height: 18px;
        animation-duration: 407ms;
    }

    .bar:nth-child(24) {
        height: 26px;
        animation-duration: 458ms;
    }

    .bar:nth-child(25) {
        height: 30px;
        animation-duration: 400ms;
    }

    .bar:nth-child(26) {
        height: 32px;
        animation-duration: 427ms;
    }

    .bar:nth-child(27) {
        height: 34px;
        animation-duration: 441ms;
    }

    .bar:nth-child(28) {
        height: 36px;
        animation-duration: 419ms;
    }

    .bar:nth-child(29) {
        height: 40px;
        animation-duration: 487ms;
    }

    .bar:nth-child(30) {
        height: 46px;
        animation-duration: 442ms;
    }

    .bar:nth-child(31) {
        height: 32px;
        animation-duration: 427ms;
    }

    .bar:nth-child(32) {
        height: 34px;
        animation-duration: 441ms;
    }

    .bar:nth-child(33) {
        height: 36px;
        animation-duration: 419ms;
    }

    .bar:nth-child(34) {
        height: 40px;
        animation-duration: 487ms;
    }

    .bar:nth-child(35) {
        height: 46px;
        animation-duration: 442ms;
    }

    @media(max-width: 1367px) {
        #p-heading {
            font-size: 21px;
        }
    }

    @media(max-width: 900px) {
        #p-heading {
            font-size: 34px;
        }
    }

    @media(max-width: 767px) {
        #p-heading {
            font-size: 22px;
        }

        .fs-18 {
            font-size: 18px;
        }
    }

    @media(max-width: 767px) {
        .padding-left-mobile {
            padding-left: 15% !important;
        }
    }

    @media(max-width: 767px) {
        .sub_check {
            font-size: 16px;
        }

        #btn_download,
        #btn_info {
            font-size: 16px;
        }

        .fs-20 {
            font-size: 18px;
        }
    }

    @media(min-width: 767px) {
        .sub_check {
            font-size: 18px;
        }

        #btn_download,
        #btn_info {
            font-size: 18px;
        }
    }

    h2 {
        font-size: 1.5rem !important;
    }

    .btn-link {
        color: #1799ad !important;
        padding: .375rem 0 !important;
        font-family: 'Poppins', sans-serif;
        font-size: 1.1rem;
    }

    .card-header {
        border-bottom: 2px solid #d0cbcb;
        font-family: 'Poppins', sans-serif;
        background-color: rgb(244, 244, 244);
        padding: 0.75rem !important;
    }

    .card {
        border: none !important;
    }

    #navbar-example4 .nav-link,
    #navbar-example5 .nav-link {
        color: black;
    }

    #navbar-example4 .nav-link.active,
    #navbar-example5 .nav-link.active {
        color: white;
        background-color: #1799ad
    }
</style>

<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<style>
    .carousel-indicators button {
        width: 19px !important;
        height: 19px !important;
        border-radius: 50%;
        background-color: #FFFFFF !important;
    }

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

    #btn_download {
        background-color: #23272a;
        color: #FFFFFF;
    }

    #btn_download:hover {
        background-color: transparent;
        color: #23272a;
    }

    #btn_info {
        background-color: transparent;
        color: #23272a;
    }

    #btn_info:hover {
        background-color: #23272a;
        color: #FFFFFF;
    }

    #download-sample-code,
    #download-sample-code-2 {
        background-color: #1799ad !important;
        color: #FFFFFF;
    }

    #download-sample-code:hover,
    #download-sample-code-2:hover {
        background-color: #FFFFFF !important;
        color: #1799ad !important;
        border: 1px solid #1799ad !important;
    }

    #clouds {
        margin-top: 300px;
        padding: 100px 0;
        position: absolute;
        width: 100%;
    }

    /*Time to finalise the cloud shape*/
    .cloud {
        width: 200px;
        height: 60px;
        background: #fff;

        border-radius: 200px;
        -moz-border-radius: 200px;
        -webkit-border-radius: 200px;

        position: relative;
    }

    .cloud:before,
    .cloud:after {
        content: '';
        position: absolute;
        background: #fff;
        width: 100px;
        height: 80px;
        position: absolute;
        top: -15px;
        left: 10px;

        border-radius: 100px;
        -moz-border-radius: 100px;
        -webkit-border-radius: 100px;

        -webkit-transform: rotate(30deg);
        transform: rotate(30deg);
        -moz-transform: rotate(30deg);
    }

    .cloud:after {
        width: 120px;
        height: 120px;
        top: -55px;
        left: auto;
        right: 15px;
    }

    /*Time to animate*/
    .x1 {
        -webkit-animation: moveclouds 15s linear infinite;
        -moz-animation: moveclouds 15s linear infinite;
        -o-animation: moveclouds 15s linear infinite;
    }

    /*variable speed, opacity, and position of clouds for realistic effect*/
    .x2 {
        left: 400px;

        -webkit-transform: scale(0.6);
        -moz-transform: scale(0.6);
        transform: scale(0.6);
        opacity: 0.6;
        /*opacity proportional to the size*/

        /*Speed will also be proportional to the size and opacity*/
        /*More the speed. Less the time in 's' = seconds*/
        -webkit-animation: moveclouds 25s linear infinite;
        -moz-animation: moveclouds 25s linear infinite;
        -o-animation: moveclouds 25s linear infinite;
    }

    .x3 {
        left: -250px;
        top: -200px;

        -webkit-transform: scale(0.8);
        -moz-transform: scale(0.8);
        transform: scale(0.8);
        opacity: 0.8;
        /*opacity proportional to the size*/

        -webkit-animation: moveclouds 20s linear infinite;
        -moz-animation: moveclouds 20s linear infinite;
        -o-animation: moveclouds 20s linear infinite;
    }

    .x4 {
        left: 670px;
        top: -250px;

        -webkit-transform: scale(0.75);
        -moz-transform: scale(0.75);
        transform: scale(0.75);
        opacity: 0.75;
        /*opacity proportional to the size*/

        -webkit-animation: moveclouds 18s linear infinite;
        -moz-animation: moveclouds 18s linear infinite;
        -o-animation: moveclouds 18s linear infinite;
    }

    .x5 {
        left: -150px;
        top: -150px;

        -webkit-transform: scale(0.8);
        -moz-transform: scale(0.8);
        transform: scale(0.8);
        opacity: 0.8;
        /*opacity proportional to the size*/

        -webkit-animation: moveclouds 20s linear infinite;
        -moz-animation: moveclouds 20s linear infinite;
        -o-animation: moveclouds 20s linear infinite;
    }

    @-webkit-keyframes moveclouds {
        0% {
            margin-left: 1000px;
        }

        100% {
            margin-left: -1000px;
        }
    }

    @-moz-keyframes moveclouds {
        0% {
            margin-left: 1000px;
        }

        100% {
            margin-left: -1000px;
        }
    }

    @-o-keyframes moveclouds {
        0% {
            margin-left: 1000px;
        }

        100% {
            margin-left: -1000px;
        }
    }

    .carousel-control-prev-icon {
        background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23fff' viewBox='0 0 8 8'%3E%3Cpath d='M5.25 0l-4 4 4 4 1.5-1.5-2.5-2.5 2.5-2.5-1.5-1.5z'/%3E%3C/svg%3E") !important;
    }

    .carousel-control-next-icon {
        background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23fff' viewBox='0 0 8 8'%3E%3Cpath d='M2.75 0l-1.5 1.5 2.5 2.5-2.5 2.5 1.5 1.5 4-4-4-4z'/%3E%3C/svg%3E") !important;
    }

    img.screenshot {
        max-height: 300px;
        width: auto;
    }

    .carousel-control-prev:hover,
    .carousel-control-next:hover {
        text-decoration: none;
        outline: 0;
        opacity: 1;
    }
</style>

<header id="bg-index-alt" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
    <!-- <div id="clouds"> -->
    <!-- <div class="cloud x1"></div> -->
    <!-- Time for multiple clouds to dance around -->
    <!-- <div class="cloud x2"></div> -->
    <!-- <div class="cloud x3"></div> -->
    <!-- <div class="cloud x4"></div> -->
    <!-- <div class="cloud x5"></div> -->
    <!-- </div> -->
    <div class=" pt-4 pb-5">
        <div class="row justify-content-center" id="header-row">

            <!-- <div class="row justify-content-center"> -->
            <div class="col-12 col-md-12 col-lg-12 col-xl-12 py-5 mt-5 text0cenbt" id="whole-content">
                <div class="row text-center" id="row-connect">
                    <div class="col-12" id="header-title-row">
                        <p data-translate="index-1" id="p-heading" class="mx-auto fontRobBold fs-35" style="color: white; margin-top: 25px"></p>
                        <!-- <p data-translate="index-2" class="fontRobReg fs-18" id="p-embed" style="color:#262626;"></p> -->
                    </div>
                </div>

                <div class="row text-center" id="mobile-img">
                    <img id="banner-img-mbl" src="<?php echo base_url(); ?>homepage1.png" style="" />
                </div>
                <div class="d-flex justify-content-center">
                    <img id="banner-img-mbl-2" src="homepage_long2.png" height="auto" style="position:absolute; margin-left: 45px; " />
                </div>
                <div class="row d-flex justify-content-center text-center" id="ctoa-row" style="margin-bottom: 130px;">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="carousel-inner" style="z-index: 11">

                            <div class="carousel-item active" style="height: 100%; padding: 10px;">
                                <div class="row">
                                    <div class="col-1 col-md-1 col-lg-3"></div>
                                    <div id="hero" class="col-10 col-md-10 col-lg-6 d-flex justify-content-center" style="border-radius: 20px; padding: 15px; background: white">
                                        <div class="row p-4">
                                            <div class="col-12">
                                                <p data-translate="index-2" style="font-family: 'Poppins',sans-serif; color: black; font-size: 18px; padding: 12px" id="banner1"></p>
                                            </div>
                                            <div class="col-12">
                                                <p data-translate="index-49" style="font-family: 'Poppins',sans-serif; color: black; font-size: 18px; padding: 12px" id="banner1"></p>
                                            </div>
                                            <div class="col-12 col-md-6 mt-2">
                                                <a href="#practical"><button class="btn btn-warning" data-translate="index-78" id="btn_info" style="position: relative; border: 1px solid #23272a; border-radius: 20px; width: 75%; margin-bottom: 10px">See More</button></a>
                                            </div>
                                            <div class="col-12 col-md-6 mt-2">
                                                <a href="<?php echo base_url(); ?>usocial_new.php"><button data-translate="index-79" class="btn btn-warning" id="btn_download" style="border: 1px solid #23272a; border-radius: 20px; width: 75%">Download App</button></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-1 col-md-1 col-lg-3"></div>
                                </div>
                            </div>
                            <!-- <div class="carousel-item" style="height: 100%; padding: 5.5px">
                                <div class="row">
                                    <div class="col-1 col-md-1 col-lg-3"></div>
                                    <div id="hero" class="col-10 col-md-10 col-lg-6 d-flex justify-content-center" style="border-radius: 20px; background: rgba(255,255,255, 0.5)">
                                        <div style="padding: 5px">
                                            <p data-translate="index-49" class="fontRobReg fs-18" style="font-family: 'Poppins',sans-serif; color:#000000; padding-top: 30px; font-size: 22px;" id="banner2"></p>
                                            <div class="row mt-4 mb-5">
                                                <div class="col-12 col-md-6">
                                                    <a href="#practical"><button class="btn btn-warning" data-translate="index-78" id="btn_info" style="position: relative; border: 1px solid #01686d; border-radius: 20px; width: 220px; margin-bottom: 10px">See More</button></a>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <a href="<?php echo base_url(); ?>usocial.php"><button data-translate="index-79" class="btn btn-warning" id="btn_download" style="border: 1px solid #01686d; border-radius: 20px; width: 220px">Download App</button></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-1 col-md-1 col-lg-3"></div>
                                </div>
                            </div>
                            <div class="carousel-item" style="height: 100%; padding: 10px">
                                <div class="row">
                                    <div class="col-1 col-md-1 col-lg-3"></div>
                                    <div id="hero" class="col-10 col-md-10 col-lg-6 d-flex justify-content-center" style="border-radius: 20px; padding: 15px;  background: rgba(255,255,255, 0.5)">
                                        <p data-translate="index-4" class="fs-30" id="banner3" style="font-family: 'Poppins',sans-serif; color:#000000; font-size: 22px; padding: 29px"></p>
                                    </div>
                                    <div class="col-1 col-md-1 col-lg-3"></div>
                                </div>
                            </div> -->
                        </div>
                        <!-- <p data-translate="index-49" class="fontRobReg fs-18" style="color:#262626;"></p>
                        <a data-translate="index-50" href="#practical" class="fontRobReg fs-18" style="color:#262626;"></a><br>
                        <a data-translate="index-52" href="<?php echo base_url(); ?>usocial.php" class="fontRobReg fs-18" style="color:#262626;"></a> -->
                    </div>
                </div>
            </div>

            <!-- </div> -->
        </div>
    </div>
    <!-- <div class="carousel-indicators" style="z-index: 13; bottom: 80px; position: absolute">
        <button type="button" style="position: absolute; margin-top: 20px; margin-right: 60px" data-bs-target="#bg-index-alt" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" style="position: absolute; margin-top: 20px" data-bs-target="#bg-index-alt" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" style="position: absolute; margin-top: 20px; margin-left: 60px" data-bs-target="#bg-index-alt" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div> -->

</header>


<!-- <div class="container-fluid my-5 py-3">

    <div class="row justify-content-center text-center m-0">
        <div class="col-md-10">
            <p data-translate="index-4" class="fs-30" id="sales-line" style="font-family: 'Poppins',sans-serif; font-style:italic; color:#01686d;">
            </p>
        </div>
    </div>
</div> -->
<!-- <div class="container-fluid py-5" id="midBanner" style="background-color: #f5f5f5;">
    <div class="row justify-content-center mt-5 mb-4">
        <p class="fontRobBold fs-35 text-center" style="color: #202124;">Made for Developers</p>
    </div>
    <div class="row mb-5 justify-content-center">
        <div class="col-md-10">
            <div class="row m-0">
                <div class="col-md-4 px-5">
                    <div class="row justify-content-center mb-5">
                        <img src="newAssets/Flexible-mfd-index.svg" class="align-self-center fixpic-35" alt="Flexible_Design">
                    </div>
                    <div class="row justify-content-center text-center">
                        <h1 class="fs-20 fontRobReg" style="color: #20272a;">Flexible Design</h1>
                    </div>
                </div>
                <div class="col-md-4 px-5">
                    <div class="row justify-content-center mb-5">
                        <img src="newAssets/EasyAdopt-mfd-index.svg" class="align-self-center fixpic-35" alt="Easy_to_Adopt">
                    </div>
                    <div class="row justify-content-center text-center">
                        <h1 class="fs-20 fontRobReg" style="color: #20272a;">Easy to Adopt</h1>
                    </div>
                </div>
                <div class="col-md-4 px-5">
                    <div class="row justify-content-center mb-5">
                        <img src="newAssets/Freestart-mfd-index.svg" class="align-self-center fixpic-35" alt="Start_at_$0">
                    </div>
                    <div class="row justify-content-center text-center">
                        <h1 class="fs-20 fontRobReg" style="color: #20272a;">Best Price</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->
<div class="container p-3">
    <div class="row justify-content-center m-0 pb-4 gx-5">
        <p class="fontRobBold fs-35 text-center" data-translate="index-87" style="color: #1799ad; margin-top: 25px; margin-bottom: 25px">Why <i>newuniverse.io?</i></p>
        <div class="col-12 col-md-12 col-lg-4 mt-4 mb-4">
            <div class="p-4 shadow" style="border-radius: 15px; background-color: #f5f5f5; height: 100%">
                <div class="row">
                    <div class="col-2">
                        <img src="stats_icon.png" alt="" style="width: 40px; height: 40px; margin: 5px; margin-left: -2px">
                    </div>
                    <div class="col-10">
                        <h4 data-translate="index-80" class="mb-0" style="color: #1799ad; font-size: 20px; font-weight: bold !important; font-family: 'Poppins'">
                            </h5>
                            <p data-translate="index-81" class="mb-0 mt-3" style="font-size: 14px"></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-12 col-lg-4 mt-4 mb-4">
            <div class="p-4 shadow" style="border-radius: 15px; background-color: #f5f5f5; height: 100%">
                <div class="row">
                    <div class="col-2">
                        <img src="money_icon.png" alt="" style="width: 40px; height: 40px; margin: 5px; margin-left: -2px">
                    </div>
                    <div class="col-10">
                        <h4 data-translate="index-82" class="mb-0" style="color: #1799ad; font-size: 20px; font-weight: bold !important; font-family: 'Poppins'">
                            </h5>
                            <p data-translate="index-83" class="mb-0 mt-3" style="font-size: 14px"></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-12 col-lg-4 mt-4 mb-4">
            <div class="p-4 shadow" style="border-radius: 15px; background-color: #f5f5f5; height: 100%">
                <div class="row">
                    <div class="col-2">
                        <img src="cs_icon.png" alt="" style="width: 40px; height: 40px; margin: 5px; margin-left: -2px">
                    </div>
                    <div class="col-10">
                        <h4 data-translate="index-84" class="mb-0" style="color: #1799ad; font-size: 20px; font-weight: bold !important; font-family: 'Poppins'">
                            </h5>
                            <p data-translate="index-85" class="mb-0 mt-3" style="font-size: 14px; margin-top: 10px"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid" id="features-list" style="background-color: #1799ad !important">
    <div class="row justify-content-center my-auto" data-aos="fade-right" data-aos-offset="200">
        <div class="col-8">
            <div class="row">
                <div class="row justify-content-center" style="padding: 0px">
                    <p class="fontRobBold fs-35 text-center" data-translate="index-86" style="color: white;">Our Features</p>
                </div>
                <div id="carouselExampleControls" class="carousel slide">
                    <div class="carousel-indicators" style="z-index: 13; bottom: 30px; position: absolute">
                        <button type="button" style="position: absolute; margin-top: 20px; margin-right: 60px" data-bs-target="#carouselExampleControls" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" style="position: absolute; margin-top: 20px" data-bs-target="#carouselExampleControls" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" style="position: absolute; margin-top: 20px; margin-left: 60px" data-bs-target="#carouselExampleControls" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner" role="listbox">
                        <div class="carousel-item active">
                            <div class="row mx-2">
                                <div class="single-features col-md-12 col-lg-5 col-xxl-4 d-flex justify-content-center mx-auto m-2" style="height: 480px; background-color: white; border-radius: 20px">
                                    <div id="carousel-part-1" style="width: 30px; height: 30px; border-radius: 20px; background-color: #23272a; color: white; margin-top: 47px; padding-top: 3px; margin-right: 20px; font-weight: bold" class="text-center">1</div>
                                    <h2 id="carousel-header-1" data-translate="index-48" class="fontRobBold fs-36 color-green main-header mt-5"></h2>
                                    <!-- <img src="<?php echo base_url(); ?>ls-split.png?v=2" id="live-stream-image" style="position:absolute; width: 450px;  margin-left: -30px; margin-top: 215px; height: auto; " data-aos="fade-right" data-aos-delay="300"  data-aos-offset="200"> -->
                                    <img src="<?php echo base_url(); ?>ls-split2.png" id="live-stream-image2" style="position:absolute; width: 320px; height: auto; margin-top: 60px; transform: scale(0.65)" data-aos="fade-down" data-aos-delay="600" data-aos-offset="200">
                                    <img src="<?php echo base_url(); ?>ls-split3.png" id="live-stream-image3" style="position:absolute; width: 360px; margin-top: 70px; height: auto; transform: scale(0.65)" data-aos="fade-up" data-aos-delay="900" data-aos-offset="200">
                                    <!-- <img src="<?php echo base_url(); ?>Animate2.png" id="animate1" style="position: fixed; margin-left: -240px; width: 65px; margin-top: 40px; z-index: -5; " data-aos="zoom-in-down" data-aos-delay="900"  data-aos-offset="200">
                                    <img src="<?php echo base_url(); ?>Animate1.png" id="animate2" style="position: fixed; width: 65px; margin-left: 170px; z-index: -5; margin-top: 12s0px; " data-aos="zoom-in-down" data-aos-delay="900"  data-aos-offset="200"> -->
                                    <p id="carousel-text-1" style="padding: 25px; font-size: 14px; color: black; position: absolute; margin-top: 365px;" class="text-center" data-translate="index-5"></p>
                                </div>
                                <div class="single-features col-md-12 col-lg-5 col-xxl-4 d-flex justify-content-center mx-auto m-2" style="height: 480px; background-color: white; border-radius: 20px">
                                    <div id="carousel-part-2" style="width: 30px; height: 30px; border-radius: 20px; background-color: #23272a; color: white; margin-top: 47px; padding-top: 3px; margin-right: 20px; font-weight: bold" class="text-center">2</div>
                                    <h2 id="carousel-header-2" data-translate="index-8" class="fontRobBold fs-36 color-green main-header mt-5"></h2>
                                    <!-- <img src="<?php echo base_url(); ?>vidcall-3.png" id="video-call-image3" style="position:absolute; width: 450px; margin-top: 160px; height: auto; " data-aos="fade-left" data-aos-delay="300" data-aos-offset="200"> -->
                                    <img src="<?php echo base_url(); ?>vidcall-1.png" id="video-call-image" style="position:absolute; width: 450px; margin-top: 40px; margin-left: -100px; height: auto; transform: scale(0.65)" data-aos="fade-up" data-aos-delay="600" data-aos-offset="200">
                                    <img src="<?php echo base_url(); ?>vidcall-2.png?v=2" id="video-call-image2" style="position:absolute; width: 490px; margin-top: 65px; height: auto; margin-left: -60px; transform: scale(0.65)" data-aos="fade-left" data-aos-delay="300" data-aos-offset="200">
                                    <p id="carousel-text-2" style="padding: 25px; font-size: 14px; color: black; position: absolute; margin-top: 365px;" class="text-center" data-translate="index-9"></p>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="row mx-2">
                                <div class="single-features col-md-12 col-lg-5 col-xxl-4 d-flex justify-content-center mx-auto m-2" style="height: 480px; background-color: white; border-radius: 20px">
                                    <div id="carousel-part-3" style="width: 30px; height: 30px; border-radius: 20px; background-color: #23272a; color: white; margin-top: 47px; padding-top: 3px; margin-right: 20px; font-weight: bold" class="text-center">3</div>
                                    <h2 id="carousel-header-3" data-translate="index-59" class="fontRobBold fs-36 color-green main-header mt-5"></h2>
                                    <div class="soundwave-wrap" data-aos="fade-down" data-aos-offset="200" style="transform: scale(0.65)">
                                        <div class="soundwave" style="background-color: transparent" data-aos="fade-in" data-aos-delay="900" data-aos-offset="200">
                                            <div class='sound-icon'>
                                                <div class='sound-wave'>
                                                    <!-- <i class='bar'></i> <i class='bar'></i> <i class='bar'></i> <i class='bar'></i>
                                                    <i class='bar'></i> <i class='bar'></i> <i class='bar'></i> <i class='bar'></i>
                                                    <i class='bar'></i> <i class='bar'></i> <i class='bar'></i> <i class='bar'></i> -->
                                                    <i class='bar'></i> <i class='bar'></i> <i class='bar'></i> <i class='bar'></i>
                                                    <i class='bar'></i> <i class='bar'></i> <i class='bar'></i> <i class='bar'></i>
                                                    <i class='bar'></i> <i class='bar'></i> <i class='bar'></i> <i class='bar'></i>
                                                    <i class='bar'></i> <i class='bar'></i> <i class='bar'></i> <i class='bar'></i>
                                                    <i class='bar'></i> <i class='bar'></i> <i class='bar'></i> <i class='bar'></i>
                                                    <i class='bar'></i> <i class='bar'></i> <i class='bar'></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <img src="<?php echo base_url(); ?>audio-call-2.png?v=2" id="audio-call-image" style="position:absolute; width: 500px; margin-top: 220px; margin-left: -50px; height: auto; " data-aos="fade-up" data-aos-delay="300" data-aos-offset="200"> -->
                                    <img src="<?php echo base_url(); ?>audio-call-3.png" id="audio-call-image2" style="position:absolute; width: 380px; margin-top: 45px; margin-left: -25px; height: auto; transform: scale(0.65)" data-aos="fade-down" data-aos-delay="600" data-aos-offset="200">
                                    <img src="<?php echo base_url(); ?>audio-call-1.png" id="audio-call-image3" style="position:absolute; width: 360px; margin-top: 105px; height: auto; transform: scale(0.65)" data-aos="fade-up" data-aos-delay="900" data-aos-offset="200">
                                    <p id="carousel-text-3" style="padding: 25px; font-size: 14px; color: black; position: absolute; margin-top: 365px;" class="text-center" data-translate="index-60"></p>
                                </div>
                                <div class="single-features col-md-12 col-lg-5 col-xxl-4 d-flex justify-content-center mx-auto m-2" style="height: 480px; background-color: white; border-radius: 20px">
                                    <div id="carousel-part-4" style="width: 30px; height: 30px; border-radius: 20px; background-color: #23272a; color: white; margin-top: 47px; padding-top: 3px; margin-right: 20px; font-weight: bold" class="text-center">4</div>
                                    <h2 id="carousel-header-4" data-translate="index-14" class="fontRobBold fs-36 color-green main-header mt-5"></h2>
                                    <!-- <img src="<?php echo base_url(); ?>screen-sharing-1.png?v=2" id="screen-sharing-image" style="position:absolute; width: 460px; margin-top: 175px; margin-left: -50px; height: auto; " data-aos="fade-up" data-aos-delay="300" data-aos-offset="200"> -->
                                    <img src="<?php echo base_url(); ?>screen-sharing-2.png" id="screen-sharing-image2" style="position:absolute; margin-top: 1px; width: 520px; margin-left: -15px; height: auto; transform: scale(0.65)" data-aos="fade-down" data-aos-delay="600" data-aos-offset="200">
                                    <p id="carousel-text-4" style="padding: 25px; font-size: 14px; color: black; position: absolute; margin-top: 365px;" class="text-center" data-translate="index-15"></p>

                                    <div class="graphbar1" style="position: absolute; margin-top: 252px; margin-left: -135px; width: 10px; background-color: black; height: 30px; transform: scale(0.65)" data-aos="fade-in" data-aos-delay="900" data-aos-offset="200"></div>
                                    <div class="graphbar2" style="position: absolute; margin-top: 235px; margin-left: -115px; width: 10px; background-color: black; height: 50px; transform: scale(0.65)" data-aos="fade-in" data-aos-delay="900" data-aos-offset="200"></div>
                                    <div class="graphbar3" style="position: absolute; margin-top: 219px; margin-left: -90px; width: 10px; background-color: black; height: 70px; transform: scale(0.65)" data-aos="fade-in" data-aos-delay="900" data-aos-offset="200"></div>
                                    <div class="graphbar4" style="position: absolute; margin-top: 244px; margin-left: -68px; width: 10px; background-color: black; height: 40px; transform: scale(0.65)" data-aos="fade-in" data-aos-delay="900" data-aos-offset="200"></div>

                                    <div class="graphbar5" style="position: absolute; margin-top: 210px; margin-left: 75px; width: 10px; background-color: black; height: 30px; transform: scale(0.65)" data-aos="fade-in" data-aos-delay="900" data-aos-offset="200"></div>
                                    <div class="graphbar6" style="position: absolute; margin-top: 193px; margin-left: 98px; width: 10px; background-color: black; height: 50px; transform: scale(0.65)" data-aos="fade-in" data-aos-delay="900" data-aos-offset="200"></div>
                                    <div class="graphbar7" style="position: absolute; margin-top: 177px; margin-left: 122px; width: 10px; background-color: black; height: 70px; transform: scale(0.65)" data-aos="fade-in" data-aos-delay="900" data-aos-offset="200"></div>
                                    <div class="graphbar8" style="position: absolute; margin-top: 202px; margin-left: 143px; width: 10px; background-color: black; height: 40px; transform: scale(0.65)" data-aos="fade-in" data-aos-delay="900" data-aos-offset="200"></div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="row mx-2">
                                <div class="single-features col-md-12 col-lg-5 col-xxl-4 d-flex justify-content-center mx-auto m-2" style="height: 480px; background-color: white; border-radius: 20px">
                                    <div id="carousel-part-5" style="width: 30px; height: 30px; border-radius: 20px; background-color: #23272a; color: white; margin-top: 47px; padding-top: 3px; margin-right: 20px; font-weight: bold" class="text-center">5</div>
                                    <h2 id="carousel-header-5" data-translate="index-16" class="fontRobBold fs-36 color-green main-header mt-5"></h2>
                                    <!-- <img src="<?php echo base_url(); ?>instant-1.png?v=2"  id="instant-messaging-image" style="position:absolute; width: 510px; margin-top: 236px; height: auto; margin-left: 40px; " data-aos="fade-up" data-aos-delay="300" data-aos-offset="200"> -->
                                    <img src="<?php echo base_url(); ?>instant-2.png" id="instant-messaging-image2" style="position:absolute; width: 510px; margin-top: 15px; height: auto; margin-left: 40px; transform: scale(0.65)" data-aos="fade-right" data-aos-delay="600" data-aos-offset="200">
                                    <img src="<?php echo base_url(); ?>instant-3a.png" id="instant-messaging-image3a" style="position:absolute; width: 250px; margin-top: 75px; margin-left: -240px; height: auto; transform: scale(0.65)" data-aos="fade-down" data-aos-delay="900" data-aos-offset="200">
                                    <img src="<?php echo base_url(); ?>instant-3b.png" id="instant-messaging-image3b" style="position:absolute; width: 250px; margin-top: 35px; margin-left: 240px; height: auto; transform: scale(0.65)" data-aos="fade-down" data-aos-delay="900" data-aos-offset="200">
                                    <p id="carousel-text-5" style="padding: 25px; font-size: 14px; color: black; position: absolute; margin-top: 365px;" class="text-center" data-translate="index-17"></p>
                                </div>
                                <div class="single-features col-md-12 col-lg-5 col-xxl-4 d-flex justify-content-center mx-auto m-2" style="height: 480px; background-color: white; border-radius: 20px">
                                    <div id="carousel-part-6" style="width: 30px; height: 30px; border-radius: 20px; background-color: #23272a; color: white; margin-top: 47px; padding-top: 3px; margin-right: 20px; font-weight: bold" class="text-center">6</div>
                                    <h2 id="carousel-header-6" data-translate="index-10" class="fontRobBold fs-36 color-green main-header mt-5"></h2>
                                    <!-- <img src="<?php echo base_url(); ?>smart-1.png?v=2" id="smart-feature-image" style="position:absolute; width: 550px; margin-top: 111px; margin-left: -10px; height: auto; " data-aos="fade-up" data-aos-delay="300" data-aos-offset="200"> -->
                                    <img src="<?php echo base_url(); ?>smart-2.png" id="smart-feature2-image" style="position:absolute; width: 530px; margin-top: -5px; margin-left: -55px; height: auto; transform: scale(0.65)" data-aos="fade-up" data-aos-delay="600" data-aos-offset="200">
                                    <img src="<?php echo base_url(); ?>gear.gif" id="smart-feature3-image" style="position:absolute; width: 50px; margin-top: 175px; margin-left: -220px; height: auto; transform: scale(0.65)" data-aos="fade-up" data-aos-delay="600" data-aos-offset="200">
                                    <img src="<?php echo base_url(); ?>lamp.png" id="smart-feature4-image" style="position:absolute; width: 50px; margin-top: 135px; margin-left: 148px; height: auto; transform: scale(0.65)" data-aos="fade-up" data-aos-delay="600" data-aos-offset="200">
                                    <p id="carousel-text-6" style="padding: 25px; font-size: 14px; color: black; position: absolute; margin-top: 365px;" class="text-center" data-translate="index-11"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev" style="margin-left: -100px; margin-top: 100px">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next" style="margin-right: -100px; margin-top: 100px">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
</div>


<!-- 3. Customer Service/Helpdesk -->
<div class="bg-light" style="margin-top: -55px">
    <div class="container">
        <a class="anchor" id="cs"></a>
        <div class="row py-3 mt-5 justify-content-center" data-aos="fade-right">
            <div class="col-md-12">
                <div class="row pt-5 my-4">
                    <div class="col-md-5 d-flex order-lg-last justify-content-center mb-2">
                        <img src="<?php echo base_url(); ?>cs-1.png" alt="" style="width: 90%;" id="contact-center" class="img-fluid align-self-center">
                    </div>
                    <div class="col-md-7 my-2">
                        <div class="row justify-content-center">
                            <div class="col-md-12 mb-4">
                                <h1 data-translate="usecase-1" class="text-center fontWS fs-34 usecase-header"></h1>
                                <p data-translate="usecase-2" class="text-center fontWS fs-20 text-secondary"></p>
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

                                        <div id="cs3-body" class="collapse show" aria-labelledby="cs3" data-parent="#accordionExample13" style="background-color: rgba(0,0,0,.03)">
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

                                        <div id="cs1-body" class="collapse show" aria-labelledby="cs1" data-parent="#accordionExample13" style="background-color: rgba(0,0,0,.03)">
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

                                        <div id="cs2-body" class="collapse show" aria-labelledby="cs2" data-parent="#accordionExample13" style="background-color: rgba(0,0,0,.03)">
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
    </div>
</div>

<!-- 2. Retail -->
<div class="container">
    <a class="anchor" id="retail"></a>
    <div class="row py-3 justify-content-center" data-aos="fade-left">
        <div class="col-md-12">
            <div class="row my-4">
                <div class="col-md-5 d-flex justify-content-center mb-2">
                    <img src="retail-1.png" alt="" id="retail-commerce" style="width: 90%;" class="img-fluid align-self-center">
                </div>
                <div class="col-md-7 my-2">
                    <div class="row justify-content-center">
                        <div class="col-md-12 mb-4">
                            <h1 data-translate="usecase-9" class="text-center fontWS fs-34 usecase-header"></h1>
                            <p data-translate="usecase-10" class="text-center fontWS fs-20 text-secondary"></p>
                        </div>
                    </div>
                    <div class="row mx-3">
                        <div class="col-md-12">
                            <div class="accordion" id="accordionExample2">
                                <div class="card">
                                    <div class="card-header" id="retail1" style="background-color: white">
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
                                    <div class="card-header" id="retail2" style="background-color: white">
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
                                    <div class="card-header" id="retail3" style="background-color: white">
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
                                    <div class="card-header" id="retail4" style="background-color: white">
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
</div>

<!-- 1. Food & Beverages -->
<div class="bg-light">
    <div class="container">
        <div class="row py-3 justify-content-center" data-aos="fade-right">
            <div class="col-md-12">
                <div class="row my-4">
                    <div class="col-md-5 d-flex order-lg-last justify-content-center mb-2">
                        <img src="f_b-1.png" alt="" id="f_b" style="width: 90%;" class="img-fluid align-self-center">
                    </div>
                    <div class="col-md-7 my-2">
                        <div class="row justify-content-center">
                            <div class="col-md-12 mb-4">
                                <h1 data-translate="usecase-51" class="text-center fontWS fs-34 usecase-header"></h1>
                                <p data-translate="usecase-52" class="text-center fontWS fs-20 text-secondary"></p>
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

                                        <div id="food1-body" class="collapse show" aria-labelledby="food1" data-parent="#accordionExample10" style="background-color: rgba(0,0,0,.03)">
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

                                        <div id="food2-body" class="collapse show" aria-labelledby="food2" data-parent="#accordionExample10" style="background-color: rgba(0,0,0,.03)">
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

                                        <div id="food3-body" class="collapse show" aria-labelledby="food3" data-parent="#accordionExample10" style="background-color: rgba(0,0,0,.03)">
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
    </div>
</div>

<!-- <div class="container-fluid py-5" style="background-color: #f5f5f5;">
    <div class="row justify-content-center m-0">
        <div class="col-md-8">
            <div class="row justify-content-center text-center">
                <p class="fontRobReg fs-30"><b style="font-weight: bold">Subscribe</b> to our Live API and get our chat API for <span class="fontRobBold fcMainBlue fs-30">BEST PRICE</span></p>
            </div>
            <div class="row justify-content-center text-center">
                <div class="col-md-12">
                    <p class="fontRobReg fs-25">We give away our chat API so you don’t have to waste your budget for just an <b style="font-weight: bold">"in-app chat"</b></p>
                </div>
            </div>
        </div>
    </div>
</div> -->

<!-- <div class="row justify-content-center bg-light my-auto py-5" data-aos="fade-right" data-aos-offset="200">
        <div class="col-md-10">
            <div class="row">
                <div class="col-md-5 order-lg-2 d-flex justify-content-center mx-auto" style="height: 500px">
                    <img src="<?php echo base_url(); ?>whiteboard-1.png" id="white-board-image" style="position:absolute; width: 580px; margin-top: -27px; margin-left: -20px; height: auto; " data-aos="fade-down" data-aos-delay="300" data-aos-offset="200">
                    <img src="<?php echo base_url(); ?>whiteboard-2.png" id="white-board-image2" style="position:absolute; width: 580px; margin-top: -27px; margin-left: -20px; height: auto; " data-aos="fade-right" data-aos-delay="600" data-aos-offset="200">
                    <img src="<?php echo base_url(); ?>whiteboard-3.png" id="white-board-image3" style="position:absolute; width: 580px; margin-top: -27px; margin-left: -20px; height: auto; " data-aos="fade-up" data-aos-delay="900" data-aos-offset="200">
                </div>
                <div class="col-md-5 order-lg-1 features-desc my-auto mx-auto">
                    <h2 data-translate="index-18" class="fontRobBold fs-48 color-green main-header"></h2>
                    <br>
                    <h3 data-translate="index-19" style="line-height: 1.6" class="fs-18 fontRobReg product-desc"></h3>
                </div>
            </div>
        </div>
    </div> -->

<!-- <div class="row justify-content-center bg-light my-auto py-5" data-aos="fade-right">
        <div class="col-md-10">
            <div class="row">
                <div class="col-md-5 order-lg-2 text-center mx-auto">
                    <img src="<?php echo base_url(); ?>newAssets/homepage/ASP_6.png" class="img-fluid um">
                </div>
                <div class="col-md-5 order-lg-1 features-desc my-auto mx-auto">
                    <h2 data-translate="index-43" class="fontRobBold fs-35 color-green"></h2>
                    <br>
                    <h3 data-translate="index-44" class="fs-20 fontRobReg product-desc"></h3>
                </div>
            </div>
        </div>
    </div> -->
</div>


<style>
    @media screen and (max-width:600px) {
        ul.nav-tabs {
            padding-left: 0 !important;
        }

        .nav-tabs {
            display: flex;
        }

        .nav-tabs li {
            display: flex;
            flex: 1;
        }

        .nav-tabs li a {
            flex: 1;
        }
    }

    @media screen and (min-width:768px) {
        .copy-snippet {
            display: block;
        }
    }

    #lite-header {
        width: 100%;
        background-color: #01686d;
        border-radius: 10px;
        color: white;
    }

    #nusdklite-small-tabs .nav,
    #nusdklite-small-tabs-ios .nav {
        border-radius: 10px 10px 0 0;
    }

    .code-fix {
        border-radius: 0 0 10px 10px;
    }

    a.anchor {
        display: block;
        position: relative;
        top: -40px;
        visibility: hidden;
    }

    @media (max-width: 600px) {
        #lite-header .palionav {
            width: 100%;
            padding-right: 0;
            padding-left: 0;
            margin-right: auto;
            margin-left: auto;
        }

        .mobile-practical {
            position: relative;
            width: 100%;
            padding-right: 0;
            padding-left: 0;
        }
    }

    .switch-main-activity {
        /* float:right; */
        color: cyan !important;
    }

    .switch-main-activity .com {
        color: unset !important;
    }

    strong.highlight .com {
        font-style: unset;
    }
</style>


<a class="anchor" id="practical"></a>
<!-- practical android -->
<div class="container-fluid py-5 my-5">
    <div class="row justify-content-center mb-4 mx-0">
        <div class="col-md-10 text-center">
            <p data-translate="index-20" class="fontRobBold fs-35"></p>
            <p data-translate="index-21" class="fs-20" style="font-family: 'Poppins',sans-serif; font-weight: 300 !important;">
            </p>

            <p data-translate="index-22" class="fs-20" style="font-family: 'Poppins',sans-serif; font-weight: 300 !important;"></p>
        </div>
    </div>

    <div class="row justify-content-center mb-4 mx-0">
        <div class="col-md-12 text-center">
            <div class="palionav">
                <ul class="nav px-4 justify-content-center text-center">
                    <li class="nav-item align-self-center">
                        <span data-translate="index-23" class="mt-5 text-center instructions-head" style="font-family: 'Poppins',sans-serif !important; font-weight:300; font-size:1.75rem"></span>
                    </li>
                    <li class="nav-item dropdown" id="platform-li">
                        <a class="nav-link nav-menu-link dropdown-toggle fontRobReg" id="platform-nav" role="button" aria-haspopup="true" aria-expanded="false" style="font-size: 25px;">
                            <img id="selected-version" src="<?php echo base_url(); ?>newAssets/android3d.png" style="max-height:40px; width: auto;">
                        </a>

                        <div class="dropdown-menu" id="platform-menu" aria-labelledby="dropdownMenuButton">
                            <div class="col d-flex justify-content-start p-0">
                                <a class="dropdown-item fontRobReg fs-20 py-2 greenText" id="lite-android" role="button" style="display: inline;  color: #1799ad !important;">Android</a>
                            </div>
                            <div class="col d-flex justify-content-start p-0">
                                <a class="dropdown-item fontRobReg fs-20 py-2 greenText" id="lite-iOS" role="button" style="display: inline;  color: #1799ad !important;">iOS</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="practical-android">
        <div class="row col-md-7 mx-auto py-3 px-3 mb-5" id="nusdklite-guide-tab" style="background-color: #159db166; border: 3px #ccc solid; border-radius: 15px; font-family:'Poppins',sans-serif;">
            <p><strong data-translate="index-24"></strong></p>

            <ol>
                <li data-translate="index-25">

                </li>
                <li data-translate="index-26">

                </li>
                <li data-translate="index-27">

                </li>
                <li data-translate="index-88">

                </li>
                <li data-translate="index-28">

                </li>
                <li data-translate="index-29">

                </li>
                <li data-translate="index-30">

                </li>
                <li data-translate="index-31">

                </li>
            </ol>

            <span data-translate="index-32">

            </span>


        </div>

        <div class="row justify-content-center mx-0">
            <div class="col-sm-10 mobile-practical">



                <br>

                <div class="tab-content">

                    <style>
                        #nusdklite-small-tabs .nav-tabs {
                            overflow-x: auto;
                            overflow-y: hidden;
                            flex-wrap: nowrap;
                        }

                        #nusdklite-small-tabs .nav-tabs>li {
                            float: none;
                        }

                        @media screen and (min-width: 992px) {
                            #nusdklite-small-tabs .nav-tabs>li {
                                min-width: 25%;
                            }

                            #nusdklite-small-tabs .nav {
                                /* height: 80px; */
                                align-items: center;
                            }
                        }

                        #nusdklite-small-tabs .nav-tabs>li p {
                            font-size: 15px !important;
                        }

                        .code-link.active {
                            background-color: #1799ad !important;
                        }

                        .nav-item .code-link span.super {
                            font-weight: bold;
                        }
                    </style>

                    <div id="nusdklitecode" style="display: block;">

                        <div id="nusdklite-small-tabs">
                            <ul class="nav nav-tabs border-0 d-flex justify-content-between">



                                <li class="nav-item">
                                    <a id="nusdklite-small-tabs-1" class="code-link active text-decoration-none d-flex justify-content-center" data-toggle="tab" href="#nusdklite1" role="tab">
                                        <span class="fontRobReg super fs-16 text-center m-0" id="mainactivity-title">Nexilis Android SDK</span>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a id="nusdklite-small-tabs-3" style="height: 100%" class="code-link text-decoration-none d-flex justify-content-center" data-toggle="tab" href="#nusdklite3" role="tab">
                                        <span class="fontRobReg super fs-16 text-center m-0">build.gradle(:app)</span>
                                    </a>
                                </li>

                                <!-- <li class="nav-item d-none">
                                    <a id="nusdklite-small-tabs-1" class="code-link text-decoration-none d-flex justify-content-center" data-toggle="tab" href="#nusdklite1" role="tab">
                                        <span class="fontRobReg super fs-16 text-center m-0" id="mainactivity-title">MainActivity.java (Floating)</span>
                                    </a>
                                </li> -->

                                <li class="nav-item">
                                    <a id="nusdklite-small-tabs-5" class="code-link text-decoration-none d-flex justify-content-center" data-toggle="tab" href="#nusdklite5" role="tab">
                                        <span class="fontRobReg super fs-16 text-center m-0" id="mainactivity-title-burger">MainActivity.java</span>
                                    </a>
                                </li>

                                <li class="nav-item d-none">
                                    <a id="nusdklite-small-tabs-styles" class="code-link text-decoration-none d-flex justify-content-center" data-toggle="tab" href="#nusdklite-styles" role="tab">
                                        <span class="fontRobReg super fs-16 text-center m-0">styles.xml</span>
                                    </a>
                                </li>
                                <li class="nav-item d-none">
                                    <a id="nusdklite-small-tabs-proguard" class="code-link text-decoration-none d-flex justify-content-center" data-toggle="tab" href="#nusdklite-proguard" role="tab">
                                        <span class="fontRobReg super fs-16 text-center m-0">proguard-rules.pro</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a id="nusdklite-small-tabs-disclaimer" style="height: 100%" class="code-link text-decoration-none d-flex justify-content-center" data-toggle="tab" href="#nusdklite0" role="tab">
                                        <span data-translate="index-46" class="fontRobReg super fs-16 text-center m-0"></span>
                                    </a>
                                </li>

                            </ul>
                        </div>

                        <div class="tab-pane active code-fix" id="nusdklite-styles" style="display: none;">
                            <pre class="prettyprint lang-xml" id="LS-nusdklite-styles">
<button type="button" data-clipboard-action="copy" data-clipboard-target="#LS-nusdklite-styles" class="btn btn-dark copy-snippet mx-1"><i class="fa fa-copy"></i></button>
&lt;!-- If you are using Flutter, please modify the relevant tags in your <strong>styles.xml</strong> file as shown in the code below. --&gt;
&lt;?xml version="1.0" encoding="utf-8"?&gt;
&lt;resources&gt;
    &lt;style name="LaunchTheme" parent="Theme.MaterialComponents.DayNight.DarkActionBar"&gt;
        &lt;item name="android:windowBackground"&gt;@drawable/launch_background&lt;/item&gt;
    &lt;/style&gt;
    &lt;style name="NormalTheme" parent="Theme.MaterialComponents.DayNight.DarkActionBar"&gt;
        &lt;item name="android:windowBackground"&gt;@android:color/white&lt;/item&gt;
    &lt;/style&gt;
&lt;/resources&gt;








</pre>
                        </div>
                        <div class="tab-pane active code-fix" id="nusdklite0" style="display: none;">
                            <pre class="prettyprint lang-java" id="LS-nusdklite0">
/**
For user satisfaction, all features provided in nexilis have been tested to meet certain performance, reliability, and availability standards. If you need to test these features (Audio Call, Video Call, Conference, Online Seminar, etc.), please download <strong>Nexilis</a></strong> from Google Play Store. <strong>Nexilis</a></strong> is a Social Media built entirely using newuniverse.io to demonstrate nexilis's performance, reliability, and availability standards.

=====================
NOTES
=====================
For user security and privacy reasons, newuniverse.io for Android will not work in the following environments:
1. Rooted Devices
2. Emulators
3. Android devices version below 6.0 (API 23). You need to set minSdkVersion 23 in your build.gradle (:app)
4. Especially for the minimum SDK version below 23 (Android OS Version 6.0) there needs to be additional code on the Androidmanifest.xml
<xmp><uses-sdk tools::overrideLibrary="
    io.nexilis.nexilisbutton,
    androidx.camera.view,
    androidx.camera.camera2,
    androidx.camera.lifecycle,
    androidx.camera.core "/></xmp>

=====================
Layout Customization
=====================
You can customize the look and layout of our live streaming, online seminar, and audio-video call features. To do so, follow these steps:
1. Download file activity layout (.xml) files dari link: <strong><a id="activity-layout" style="cursor:pointer;">res-pb.zip</a></strong>
2. Extract res-pb.zip into your project folder -> app -> src -> main.
3. Edit the gradle.properties configuration following the example below:
    android {
            ...
    
            sourceSets {
                main {
                        res.srcDirs = ['src/main/res', 'src/main/res-pb']
                }
        }

    }
3. Edit the activity layouts as you need.

Notice:
Please refrain from deleting view components or altering their id's as it may cause errors in the application.


=====================
proguard-rules.pro
=====================

Jika kamu melakukan build aplikasi menggunakan proguard, tambahkan baris-baris kode di bawah ini pada file <strong>proguard-rules.pro.</strong> 

#*******************************************************************************************************
-verbose
-optimizationpasses 14
-allowaccessmodification
-overloadaggressively
-flattenpackagehierarchy
-keeppackagenames doNotKeepAThing

-obfuscationdictionary dictionary.txt
-classobfuscationdictionary classdictionary.txt

# *******************************************************************************************************
-keep class * { native <methods>; }
-keep class androidx.core.app.** { public *; }
-keep class com.google.android.** { *; }
-keep class com.google.mlkit.** { *; }
-keep interface com.google.android.** { *; }

-keep public class javax.mail.** { *; }
-keep public class com.sun.mail.** { *; }
-keep public class org.apache.harmony.** { *; }

# *******************************************************************************************************
-keep class net.sqlcipher.** { *; }
-keep public class * implements com.bumptech.glide.module.GlideModule
-keep public class * extends com.bumptech.glide.module.AppGlideModule
-keep public enum com.bumptech.glide.load.ImageHeaderParser$** { **[] $VALUES; public *; }
                                                                                                                    </pre>
                            <pre class="prettyprint lang-java" id="LS-nusdklite0_ID">
/**
Untuk menjaga kepuasan pelanggan, seluruh fitur yang disediakan nexilis telah diuji untuk memenuhi kriteria performa, kehandalan dan ketersediaan. Jika kamu ingin menguji fitur-fitur dimaksud (Audio Call, Video Call, Conference, Online Seminar, dll.) kamu bisa mengunduh <strong><a href="https://play.google.com/store/apps/details?id=io.newuniverse.catchup">catchUp</a></strong> dari Google Play Store. <strong><a href="https://play.google.com/store/apps/details?id=io.newuniverse.catchup">catchUp</a></strong> adalah Media Sosial yang dibangun sepenuhnya menggunakan newuniverse.io untuk menunjukkan fitur dan standar performa dan kehandalan dari newuniverse.io

=====================
NOTES
=====================
Untuk alasan Keamanan dan Privasi pengguna, newuniverse.io untuk Android tidak akan dapat berjalan pada kondisi berikut:
    1. Rooted Devices
    2. Emulators
    3. Perangkat Android dengan version dibawah 6.0 (API 23). Pastikan kamu sudah menentukan minSdkVersion 23 didalam build.gradle (:app)
    4. Aplikasi yang melakukan backup & restore data pada infrastruktur backup. Pastikan kamu sudah menentukan 3 variabel berikut didalam Manifest file mu
    android:allowBackup="false"
    android:fullBackupOnly="false"
    android:fullBackupContent="false"


=====================
Layout Customization
=====================
Kamu dapat mengubah tampilan dan layout dari fitur live streaming, online seminar, dan audio-video call. Ikuti Langkah-langkah berikut untuk melakukan perubahan tersebut:
1. Download file activity layout (.xml) dari link: <strong><a id="activity-layout" style="cursor:pointer;">res-pb.zip</a></strong>
2. Extract res-pb.zip kedalam folder project mu -> app -> src -> main.
3. Ubah konfigurasi file gradle.properties sesuai contoh dibawah ini.
	android {
    		...
    
    		sourceSets {
        		main {
            			res.srcDirs = ['src/main/res', 'src/main/res-pb']
        		}
		}

	}
4. Ubah activity layout sesuai kebutuhanmu.

Catatan:
Hindari menghapus view components atau mengubah id komponen karena akan mengakibatkan error pada application.
  

=====================
proguard-rules.pro
=====================

Jika kamu melakukan build aplikasi menggunakan proguard, tambahkan baris-baris kode di bawah ini pada file proguard-rules.pro. 

#*******************************************************************************************************
-verbose
-optimizationpasses 14
-allowaccessmodification
-overloadaggressively
-flattenpackagehierarchy
-keeppackagenames doNotKeepAThing

-obfuscationdictionary dictionary.txt
-classobfuscationdictionary classdictionary.txt

# *******************************************************************************************************
-keep class * { native <methods>; }
-keep class androidx.core.app.** { public *; }
-keep class com.google.android.** { *; }
-keep class com.google.mlkit.** { *; }
-keep interface com.google.android.** { *; }

-keep public class javax.mail.** { *; }
-keep public class com.sun.mail.** { *; }
-keep public class org.apache.harmony.** { *; }

# *******************************************************************************************************
-keep class net.sqlcipher.** { *; }
-keep public class * implements com.bumptech.glide.module.GlideModule
-keep public class * extends com.bumptech.glide.module.AppGlideModule
-keep public enum com.bumptech.glide.load.ImageHeaderParser$** { **[] $VALUES; public *; }
                                                                                                                    </pre>
                        </div>

                        <div class="tab-pane active code-fix" id="nusdklite1" style="display: block;">

                            <iframe id="inlineFrameExample" src="index-sdkguide.php" style="height:400px; width:100%;">
                            </iframe>
                        </div>


                        <div class="tab-pane active code-fix" id="nusdklite5" style="display: none;">

                            <pre class="prettyprint lang-java linenums:1" id="LS-nusdklite5">
<button type="button" data-clipboard-action="copy" data-clipboard-target="#LS-nusdklite5" class="btn btn-dark copy-snippet mx-1"><i class="fa fa-copy"></i></button>package com.example.PalioLiteSampleCode;

import android.app.Activity;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuItem;
import android.widget.Toast;

import io.nexilis.nexilisbutton.Callback;
import io.nexilis.nexilisbutton.Nexilis;

public class MainActivity extends Activity {

    @Override
    public void onCreate(Bundle bundle) {
        super.onCreate(bundle);
        setContentView(R.layout.activity_main);

        /*************************************
         Connect to our server with your newuniverse.io Account, and implement the required Callback.
         Please Subscribe or contact us to get your newuniverse.io Account.
         Do not share your newuniverse.io Account or ever give it out to someone outside your organization.
         ************************************/
        /**
         * API.connect (String NexilisAccount, Activity RegisteredActivity, int NexilisButtonMode, boolean UserMayModifyUID, Callback ConnectCallback)
         *
         * NexilisAccount 		: Your Nexilis.io Account.
         * RegisteredActivity       	: Android's Activity class that is used to register the Nexilis Button
         * NexilisButtonMode 	        : The flag that determines when the Nexilis Button should appear.
         *              0 = Disabled Nexilis Button
         * 		1 = Within registered Activity, (Nexilis Button only appears when users are in the registered activity)
         * 		2 = Within App (Nexilis Button always appears as long as user is in the App),
         * 		3 = Always On (Nexilis Button always appears even if the application process is closed)
         * UserMayModifyUID 	: Sets whether users are allowed to change the Nexilis UserID.
         * 		true = enabled,
         * 		false = disabled
         * ConnectCallback	: The callback interface to be invoked when calling the method connect.
         * 		You need to implement onSuccess(String NexilisUserID) & onFailed(String reasonCode) to handle the RESULT.
         *
         */
        API.connect("***REPLACE***WITH***YOUR***NEXILIS***ACCOUNT***", this, 0, new Callback() {
            @Override
            public void onSuccess(final String NexilisUserID) {
                // Handle onSuccess event here.
                // This callback will be triggered automatically when the Nexilis service is
                // successfully started, and the Client connected to the Server.
            }

            @Override
            public void onFailed(final String reasonCode) {
                // Handle onFailed event here.
                // This callback will be triggered automatically when there is an issue during
                // the execution of API.connect method.
            }
        });

        /**
         *
         * An OPTIONAL Method to change your Nexilis User ID
         * You can call this method anytime after API.connect calls onSuccess
         *
         * String ResponCode = Nexilis.changeUsername(String NewUserID)
         *
         * ResponCode 	: Returns a code based on the status of the function call.
         * 		00:Success
         *		23:Unsupported Android version
         * 		94:Unregistered User
         * 		96:Activity is null
         * 		97:Account is empty
         * 		101:Unable to access server. Check your connection and try again later
         * 		102:Duplicate username
         * 		103:Username is empty
         * 		104:Username length is too short
         * 		105:Username length is too long
         * 		106:Illegal State. Be sure call API.connect and #callback state onSuccess called
         * NewUserID	: Desired User ID
         */
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_main, menu);
        return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        // Handle action bar item clicks here. The action bar will
        // automatically handle clicks on the Home/Up button, so long
        // as you specify a parent activity in AndroidManifest.xml.
        int id = item.getItemId();

        //noinspection SimplifiableIfStatement
        if (id == R.id.action_cc) {
            API.openContactCenter();
            return true;
        }
        if (id == R.id.action_chats) {
            API.openChat();
            return true;
        }
        if (id == R.id.action_call) {
            API.openCall();
            return true;
        }
        if (id == R.id.action_ls) {
            API.openOptionsStreaming();
            return true;
        }
        if (id == R.id.action_settings) {
            API.openSettings();
            return true;
        }

        return super.onOptionsItemSelected(item);
    }
}
</pre>
                        </div>



                        <div class="tab-pane active code-fix" id="nusdklite-proguard" style="display: none;">
                            <pre class="prettyprint lang-java linenums:1" id="LS-nusdklite-proguard">
<button type="button" data-clipboard-action="copy" data-clipboard-target="#LS-nusdklite-proguard" class="btn btn-dark copy-snippet"><i class="fa fa-copy"></i></button>
// If you are building your app with proguard, add these lines in your <strong>proguard-rules.pro</strong> file.
-dontwarn io.newuniverse.SDK.**
-keep class io.newuniverse.SDK.** { *;}
-keep interface io.newuniverse.SDK.** { *; }
-keep class * implements io.newuniverse.SDK.** { *;}

-keep class net.sqlcipher.** { *; }                              
                               
                               
                               
                               
                               
                               
                               
                               
                               
                               
                               
                               
                                                                                                                    </pre>
                        </div>

                        <div class="tab-pane code-fix" id="nusdklite3" style="display: none;">
                            <pre class="prettyprint lang-java linenums:1" id="LS-nusdklite3">
<button type="button" data-clipboard-action="copy" data-clipboard-target="#LS-nusdklite3" class="btn btn-dark copy-snippet"><i class="fa fa-copy"></i></button>// Please make sure you have set minSdkVersion to 23.
android {
   packagingOptions {
        doNotStrip "*/armeabi-v7a/*.so"
        doNotStrip "*/arm64-v8a/*.so"

        exclude 'META-INF/DEPENDENCIES'
        exclude 'META-INF/LICENSE'
        exclude 'META-INF/LICENSE.txt'
        exclude 'META-INF/license.txt'
        exclude 'META-INF/NOTICE'
        exclude 'META-INF/NOTICE.txt'
        exclude 'META-INF/notice.txt'
        exclude 'META-INF/ASL2.0'
    }
}

// Add the following lines to include the newuniverse.io repository into your app
repositories {
    maven {
        url "https://newuniverse.io/artifactory/nexilis-libs"
        credentials {
            username = "***REPLACE***WITH***YOUR***MAVEN***USERNAME***"
            password = "***REPLACE***WITH***YOUR***MAVEN***PASSWORD***"
        }
    }
}

dependencies {
    // *** Add nexilis Lite dependencies ***
    implementation('**REPLACE*WITH*VERSION*LIBRARY**') {
        exclude group: 'org.apache.httpcomponents'
        transitive = true
    }
}</pre>
                            <!-- implementation 'com.google.android.material:material:1.3.0'
    implementation 'androidx.constraintlayout:constraintlayout:2.0.4'
    implementation 'com.google.android.gms:play-services-vision:20.1.3'
    implementation 'com.google.android.exoplayer:exoplayer:2.15.1'

    implementation('com.google.apis:google-api-services-gmail:v1-rev98-1.25.0') {
        exclude group: 'org.apache.httpcomponents'
        transitive = true
    }
    implementation('com.github.bumptech.glide:glide:4.12.0@aar') {
        transitive = true
    }
    implementation('net.zetetic:android-database-sqlcipher:4.4.3@aar') {
        transitive = true
    } -->
                        </div>

                    </div>
                    <!-- end nusdklitecode -->
                    <!-- end coming soon -->



                </div>


                <div class="row mt-4">
                    <div class="col-md-7 text-center mx-auto" style="font-family: 'Poppins',sans-serif;">
                        <?php if (empty($_SESSION['id_user']) || $_SESSION['id_user'] == '') { ?>
                            <button data-translate="index-33" id='download-sample-code' class="btn nav-menu-btn-alt mx-auto"></button>
                        <?php } else { ?>
                            <a data-translate="index-33" href="<?php echo base_url(); ?>downloads/PalioLiteSampleCode.zip?<?php echo $timeSec; ?>" id='download-sample-code-2' type="button" class="btn nav-menu-btn-alt mx-auto"></a>
                        <?php } ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div id="practical-ios" class="d-none">


        <div class="row col-md-7 mx-auto py-3 px-3 mb-5" id="nusdklite-guide-tab" style="background-color: #159db166; border: 3px #ccc solid; border-radius: 15px;">
            <p><strong data-translate="index-24" style="font-family:'Poppins',sans-serif;"></strong></p>

            <ol style="font-family:'Poppins',sans-serif;">
                <li data-translate="index-25">

                </li>
                <li data-translate="index-53">

                </li>

                <li data-translate="index-54">

                </li>
                <li data-translate="index-55">

                </li>
                <li data-translate="index-58">

                </li>
                <li data-translate="index-56">

                </li>
                <li data-translate="index-57">

                </li>
                <!-- <li data-translate="index-31">

                </li> -->
            </ol>

            <span data-translate="index-32">

            </span>


        </div>

        <div class="row justify-content-center mx-0">
            <div class="col-sm-10 mobile-practical">



                <br>

                <div class="tab-content">

                    <style>
                        #nusdklite-small-tabs-ios .nav-tabs {
                            overflow-x: auto;
                            overflow-y: hidden;
                            flex-wrap: nowrap;
                        }

                        #nusdklite-small-tabs-ios .nav-tabs>li {
                            float: none;
                        }

                        @media screen and (min-width: 992px) {
                            #nusdklite-small-tabs-ios .nav-tabs>li {
                                min-width: 50%;
                            }

                            #nusdklite-small-tabs-ios .nav {
                                /* height: 80px; */
                                align-items: center;
                            }
                        }

                        #nusdklite-small-tabs-ios .nav-tabs>li p {
                            font-size: 15px !important;
                        }

                        .code-link.active {
                            background-color: #1799ad !important;
                        }

                        .nav-item .code-link span.super {
                            font-weight: bold;
                        }
                    </style>

                    <div id="nusdklitecode" style="display: block;">

                        <div id="nusdklite-small-tabs-ios">
                            <ul class="nav nav-tabs border-0 d-flex justify-content-between">

                                <li class="nav-item" style="width: 100%">
                                    <a id="nusdklite-small-tabs-1-ios" class="code-link active text-decoration-none d-flex justify-content-center" data-toggle="tab" href="#nusdklite1-ios" role="tab">
                                        <span class="fontRobReg super fs-16 text-center m-0" id="mainactivity-title-ios">pubspec.yaml</span>
                                    </a>
                                </li>

                                <li class="nav-item" style="width: 100%">
                                    <a id="nusdklite-small-tabs-3-ios" class="code-link text-decoration-none d-flex justify-content-center" data-toggle="tab" href="#nusdklite3-ios" role="tab">
                                        <span class="fontRobReg super fs-16 text-center m-0">main.dart</span>
                                    </a>
                                </li>

                                <li class="nav-item d-none">
                                    <a id="nusdklite-small-tabs-styles" class="code-link text-decoration-none d-flex justify-content-center" data-toggle="tab" href="#nusdklite-styles" role="tab">
                                        <span class="fontRobReg super fs-16 text-center m-0">styles.xml</span>
                                    </a>
                                </li>
                                <li class="nav-item d-none">
                                    <a id="nusdklite-small-tabs-proguard" class="code-link text-decoration-none d-flex justify-content-center" data-toggle="tab" href="#nusdklite-proguard" role="tab">
                                        <span class="fontRobReg super fs-16 text-center m-0">proguard-rules.pro</span>
                                    </a>
                                </li>
                                <li class="nav-item d-none">
                                    <a id="nusdklite-small-tabs-disclaimer-ios" class="code-link text-decoration-none d-flex justify-content-center" data-toggle="tab" href="#nusdklite0-ios" role="tab">
                                        <span data-translate="index-46" class="fontRobReg super fs-16 text-center m-0"></span>
                                    </a>
                                </li>

                            </ul>
                        </div>

                        <div class="tab-pane active code-fix" id="nusdklite-styles" style="display: none;">
                            <pre class="prettyprint lang-xml" id="LS-nusdklite-styles">
<button type="button" data-clipboard-action="copy" data-clipboard-target="#LS-nusdklite-styles" class="btn btn-dark copy-snippet mx-1"><i class="fa fa-copy"></i></button>
IOS

&lt;!-- If you are using Flutter, please modify the relevant tags in your <strong>styles.xml</strong> file as shown in the code below. --&gt;
&lt;?xml version="1.0" encoding="utf-8"?&gt;
&lt;resources&gt;
    &lt;style name="LaunchTheme" parent="Theme.MaterialComponents.DayNight.DarkActionBar"&gt;
        &lt;item name="android:windowBackground"&gt;@drawable/launch_background&lt;/item&gt;
    &lt;/style&gt;
    &lt;style name="NormalTheme" parent="Theme.MaterialComponents.DayNight.DarkActionBar"&gt;
        &lt;item name="android:windowBackground"&gt;@android:color/white&lt;/item&gt;
    &lt;/style&gt;
&lt;/resources&gt;








</pre>
                        </div>
                        <div class="tab-pane active code-fix" id="nusdklite0-ios" style="display: none;">
                            <pre class="prettyprint lang-java" id="LS-nusdklite0-ios">
IOS

/**
<!-- For user satisfaction, all features provided in nexilis have been tested to meet certain performance, reliability, and availability standards. If you need to test these features (Audio Call, Video Call, Conference, Online Seminar, etc.), please download <strong></strong> from Google Play Store. <strong><a href="https://play.google.com/store/apps/details?id=io.newuniverse.catchup">catchUp</a></strong> is a Social Media built entirely using newuniverse.io to demonstrate nexilis's performance, reliability, and availability standards. -->
For user satisfaction, all features provided in nexilis have been tested to meet certain performance, reliability, and availability standards. If you need to test these features (Audio Call, Video Call, Conference, Online Seminar, etc.), please download <strong>Nexilis</strong> from Google Play Store. <strong><a href="">Nexilis</a></strong> is a Social Media built entirely using newuniverse.io to demonstrate nexilis's performance, reliability, and availability standards.

=====================
NOTES
=====================
For user security and privacy reasons, newuniverse.io for Android will not work in the following environments:
1. Rooted Devices
2. Emulators
3. Android devices version below 6.0 (API 23). You need to set minSdkVersion 23 in your build.gradle (:app)
4. Applications that uses the backup and restore infrastructure. Please make sure you have the following 3 lines of code in your Manifest file:
android:allowBackup="false"
android:fullBackupOnly="false"
android:fullBackupContent="false"


=====================
Layout Customization
=====================
You can customize the look and layout of our live streaming, online seminar, and audio-video call features. To do so, follow these steps:
1. Download the activity layout (.xml) files by clicking this link: <strong><a id="activity-layout" href="">activity_layouts.zip</a></strong>
2. Extract the .xml files into your project folder -> app -> src -> main -> res -> layout folder.
3. Edit the activity layouts as you need.

Notice:
Please refrain from deleting view components or altering their id's as it may cause errors in the application.

=====================
proguard-rules.pro
=====================
If you are building your app with proguard, add the lines below in your <strong>proguard-rules.pro</strong> file.
-dontwarn io.newuniverse.SDK.**
-keep class io.newuniverse.SDK.** { *;}
-keep interface io.newuniverse.SDK.** { *; }
-keep class * implements io.newuniverse.SDK.** { *;}

-keep class net.sqlcipher.** { *; } 

*/
 





                                                                                                                    </pre>
                            <pre class="prettyprint lang-java" id="LS-nusdklite0_ID-ios">
iOS

/**
Untuk menjaga kepuasan pelanggan, seluruh fitur yang disediakan nexilis telah diuji untuk memenuhi kriteria performa, kehandalan dan ketersediaan. Jika kamu ingin menguji fitur-fitur dimaksud (Audio Call, Video Call, Conference, Online Seminar, dll.) kamu bisa mengunduh <strong><a href="https://play.google.com/store/apps/details?id=io.newuniverse.catchup">catchUp</a></strong> dari Google Play Store. <strong><a href="https://play.google.com/store/apps/details?id=io.newuniverse.catchup">catchUp</a></strong> adalah Media Sosial yang dibangun sepenuhnya menggunakan Palio.io untuk menunjukkan fitur dan standar performa dan kehandalan dari Palio.io

=====================
NOTES
=====================
Untuk alasan Keamanan dan Privasi pengguna, newuniverse.io untuk Android tidak akan dapat berjalan pada kondisi berikut:
    1. Rooted Devices
    2. Emulators
    3. Perangkat Android dengan version dibawah 6.0 (API 19). Pastikan kamu sudah menentukan minSdkVersion 19 didalam build.gradle (:app)
    4. Aplikasi yang melakukan backup & restore data pada infrastruktur backup. Pastikan kamu sudah menentukan 3 variabel berikut didalam Manifest file mu
    android:allowBackup="false"
    android:fullBackupOnly="false"
    android:fullBackupContent="false"

=====================
Layout Customization
=====================
Kamu dapat mengubah tampilan dan layout live streaming, online seminar, dan audio-video call features.Ikuti Langkah-langkah berikut untuk melakukan perubahan tsb:
1. Download file activity layout (.xml) files dari link: <strong><a id="activity-layout" style="cursor:pointer;">activity_layouts.zip</a></strong>
2. Extract file .xml kedalam folder project mu -> app -> src -> main -> res -> layout folder.
3. Ubah activity layouts sesuai kebutuhanmu.

Catatan:
Hindari menghapus view components atau mengubah id komponen karena akan mengakibatkan error pada application.
  

=====================
proguard-rules.pro
=====================
Jika kamu melakukan build aplikasi menggunakan proguard, tambahkan baris-baris kode di bawah ini pada file <strong>proguard-rules.pro</strong>.
-dontwarn io.newuniverse.SDK.**
-keep class io.newuniverse.SDK.** { *;}
-keep interface io.newuniverse.SDK.** { *; }
-keep class * implements io.newuniverse.SDK.** { *;}

-keep class net.sqlcipher.** { *; } 
*/

 





                                                                                                                    </pre>
                        </div>

                        <div class="tab-pane active code-fix" id="nusdklite1-ios" style="display: none;">

                            <pre class="prettyprint linenums:1" id="LS-nusdklite1-ios">
<button type="button" data-clipboard-action="copy" data-clipboard-target="#LS-nusdklite1-ios" class="btn btn-dark copy-snippet mx-1"><i class="fa fa-copy"></i></button>
name: sample_application_nexilis_lite
description: A new Flutter application.

# The following line prevents the package from being accidentally published to
# pub.dev using `pub publish`. This is preferred for private packages.
publish_to: 'none' # Remove this line if you wish to publish to pub.dev

# The following defines the version and build number for your application.
# A version number is three numbers separated by dots, like 1.2.43
# followed by an optional build number separated by a +.
# Both the version and the builder number may be overridden in flutter
# build by specifying --build-name and --build-number, respectively.
# In Android, build-name is used as versionName while build-number used as versionCode.
# Read more about Android versioning at https://developer.android.com/studio/publish/versioning
# In iOS, build-name is used as CFBundleShortVersionString while build-number used as CFBundleVersion.
# Read more about iOS versioning at
# https://developer.apple.com/library/archive/documentation/General/Reference/InfoPlistKeyReference/Articles/CoreFoundationKeys.html
version: 1.0.0+1

environment:
  sdk: ">=2.7.0 <3.0.0"

dependencies:
  flutter:
    sdk: flutter


  # The following adds the Cupertino Icons font to your application.
  # Use with the CupertinoIcons class for iOS style icons.
  cupertino_icons: ^1.0.0
  <strong>nexilis_lite: ^0.0.1-dev.1</strong>

dev_dependencies:
  flutter_test:
    sdk: flutter

# For information on the generic Dart part of this file, see the
# following page: https://dart.dev/tools/pub/pubspec

# The following section is specific to Flutter.
flutter:

  # The following line ensures that the Material Icons font is
  # included with your application, so that you can use the icons in
  # the material Icons class.
  uses-material-design: true

  # To add assets to your application, add an assets section, like this:
  # assets:
  #   - images/a_dot_burr.jpeg
  #   - images/a_dot_ham.jpeg

  # An image asset can refer to one or more resolution-specific "variants", see
  # https://flutter.dev/assets-and-images/#resolution-aware.

  # For details regarding adding assets from package dependencies, see
  # https://flutter.dev/assets-and-images/#from-packages

  # To add custom fonts to your application, add a fonts section here,
  # in this "flutter" section. Each entry in this list should have a
  # "family" key with the font family name, and a "fonts" key with a
  # list giving the asset and other descriptors for the font. For
  # example:
  # fonts:
  #   - family: Schyler
  #     fonts:
  #       - asset: fonts/Schyler-Regular.ttf
  #       - asset: fonts/Schyler-Italic.ttf
  #         style: italic
  #   - family: Trajan Pro
  #     fonts:
  #       - asset: fonts/TrajanPro.ttf
  #       - asset: fonts/TrajanPro_Bold.ttf
  #         weight: 700
  #
  # For details regarding fonts from package dependencies,
  # see https://flutter.dev/custom-fonts/#from-packages
</pre>

                            <pre class="prettyprint lang-java linenums:1" id="LS-nusdklite1_ID" style="display:none;">
<button type="button" data-clipboard-action="copy" data-clipboard-target="#LS-nusdklite1_ID" class="btn btn-dark copy-snippet mx-1"><i class="fa fa-copy"></i></button>

</pre>

                            <pre class="prettyprint lang-java linenums:1" id="LS-nusdklite1-nonextend-flutter-ios" style="display:none;">
<button type="button" data-clipboard-action="copy" data-clipboard-target="#LS-nusdklite1-nonextend-flutter-ios" class="btn btn-dark copy-snippet mx-1"><i class="fa fa-copy"></i></button>
IOS

/***********************************************************************************************************
If you are using <strong class="highlight" style="font-style:unset !important;">Flutter</strong> for your app, please follow the sample code below.

If you are using <strong class="highlight" style="font-style:unset !important;">Native Android</strong>, please refer to <strong><a href="#" role="button" class="highlight switch-main-activity to-native-ios">Option-1</a></strong>.
************************************************************************************************************/
package com.example.FloatingButtonSampleCode;

import android.app.Activity;
import android.os.Bundle;
import android.widget.Toast;

import io.nexilis.nexilisbutton.Callback;
import io.nexilis.nexilisbutton.Nexilis;

public class MainActivity extends Activity {

    @Override
    public void onCreate(Bundle bundle) {
        super.onCreate(bundle);
        setContentView(R.layout.activity_main);
 
        /*************************************
         Connect to our server with your newuniverse.io Account, and implement the required Callback.
         Please Subscribe or contact us to get your newuniverse.io Account.
         Do not share your newuniverse.io Account or ever give it out to someone outside your organization.
         ************************************/
        /** 
        * API.connect (String NexilisAccount, Activity RegisteredActivity, int NexilisButtonMode, boolean UserMayModifyUID, Callback ConnectCallback) 
        * 
        * NexilisAccount 		: Your Nexilis.io Account. 
        * RegisteredActivity 	: Android's Activity class that is used to register the Nexilis Button 
        * NexilisButtonMode 	: The flag that determines when the Nexilis Button should appear. 
        * 		1 = Within registered Activity, (Nexilis Button only appears when users are in the registered activity) 
        * 		2 = Within App (Nexilis Button always appears as long as user is in the App), 
        * 		3 = Always On (Nexilis Button always appears even if the application process is closed) 
        * UserMayModifyUID 	: Sets whether users are allowed to change the Nexilis UserID. 
        * 		true = enabled, 
        * 		false = disabled 
        * ConnectCallback	: The callback interface to be invoked when calling the method connect. 
        * 		You need to implement onSuccess(String NexilisUserID) & onFailed(String reasonCode) to handle the RESULT. 
        * 
        */
        API.connect("***REPLACE***WITH***YOUR***NEXILIS***ACCOUNT***", this,1, new Callback() {

            @Override
            public void onSuccess(final String NexilisUserID) {
                /**************************************
                 The NexilisUserId is generated automatically and can be mapped to a User ID on the application level.
                 Forand can be mapped into the corresponding Application User ID (e.g. John Doe),
                 so you don't have to share your Application User ID with Palio.io while still being able to monitor your user activities.
                 **************************************/
                /* do something */
                runOnUiThread(new Runnable() {
                    @Override
                    public void run() {
                        Toast.makeText(getBaseContext(), "Your Palio User ID: " + PalioUserID, Toast.LENGTH_LONG).show();
                    }
                });
            }
 
            @Override
            public void onFailed(final String reasonCode) {
                /**
                 * reasonCode 	: Returns a code based on the status of the function connect called.
                 * 		2:Your trial subscription has expired. Please subscribe to continue using Palio.io.
                 * 		3:Your monthly subscription is not paid in full. Please pay your monthly subscription bill to continue using Palio.io service.
                 * 		4:Your Customer Engagement Credit has run out and your Prepaid Credit Balance is empty. Please top-up your Prepaid Credit Balance to continue using Palio.io
                 *              23:Unsupported Android version
                 * 		93:Missing the required overlay permission
                 * 		95:Invalid Palio Button Mode (1,2,3)
                 * 		96:Activity is null
                 * 		97:Account is empty
                 * 		98:Your account didn't match
                 * 		99:Something went wrong
                 */
                /* do something */
                runOnUiThread(new Runnable() {
                    @Override
                    public void run() {
                        Toast.makeText(getBaseContext(), reasonCode, Toast.LENGTH_LONG).show();
                    }
                });
            }
        });
 

        /**
         * 
         * An OPTIONAL Method to change your Palio User ID
         * You can call this method anytime after Palio.connect calls onSuccess
         * 
         * String ResponCode = Palio.changeUsername(String NewUserID)
         * 
         * ResponCode 	: Returns a code based on the status of the function call.
         * 		00:Success
         *              23:Unsupported Android version
         * 		96:Activity is null
         * 		97:Account is empty
         * 		101:Unable to access server. Check your connection and try again later
         * 		102:Duplicate username
         * 		103:Username is empty
         * 		104:Username length is too short
         * 		105:Username length is too long
         * 		106:Illegal State. Be sure to call Palio.connect and #callback state onSuccess called
         * NewUserID	: Desired User ID
         */
        String ResponCode = Palio.changeUsername("***REPLACE***WITH***NEW***USERID***");
    }
}

</pre>

                            <pre class="prettyprint lang-java linenums:1" id="LS-nusdklite1-nonextend_ID" style="display:none;">
<button type="button" data-clipboard-action="copy" data-clipboard-target="#LS-nusdklite1-nonextend_ID" class="btn btn-dark copy-snippet mx-1"><i class="fa fa-copy"></i></button>

</pre>

                        </div>
                        <div class="tab-pane active code-fix" id="nusdklite-proguard" style="display: none;">
                            <pre class="prettyprint lang-java linenums:1" id="LS-nusdklite-proguard">
<button type="button" data-clipboard-action="copy" data-clipboard-target="#LS-nusdklite-proguard" class="btn btn-dark copy-snippet"><i class="fa fa-copy"></i></button>
// If you are building your app with proguard, add these lines in your <strong>proguard-rules.pro</strong> file.
-dontwarn io.newuniverse.SDK.**
-keep class io.newuniverse.SDK.** { *;}
-keep interface io.newuniverse.SDK.** { *; }
-keep class * implements io.newuniverse.SDK.** { *;}

-keep class net.sqlcipher.** { *; }                              
                               
                               
                               
                               
                               
                               
                               
                               
                               
                               
                               
                               
                                                                                                                    </pre>
                        </div>

                        <div class="tab-pane active code-fix" id="nusdklite3-ios" style="display: block;">
                            <pre class="prettyprint lang-java linenums:1" id="LS-nusdklite3-ios">
<button type="button" data-clipboard-action="copy" data-clipboard-target="#LS-nusdklite3-ios" class="btn btn-dark copy-snippet"><i class="fa fa-copy"></i></button>
import 'package:flutter/material.dart';
import 'dart:async';

import 'package:flutter/services.dart';
import 'package:nexilis_lite/nexilis_button.dart';
import 'package:nexilis_lite/nexilis_lite.dart';

void main() {
  runApp(MyApp());
}

class MyApp extends StatefulWidget {
  @override
  _MyAppState createState() => _MyAppState();
}

class _MyAppState extends State<MyApp> {
  String _platformVersion = 'Unknown';

  @override
  void initState() {
    super.initState();
    initPlatformState();
  }

  // Platform messages are asynchronous, so we initialize in an async method.
  Future<void> initPlatformState() async {
    String platformVersion;
    // Platform messages may fail, so we use a try/catch PlatformException.
    // We also handle the message potentially returning null.
    try {
      platformVersion =
          await NexilisLite.platformVersion ?? 'Unknown platform version';
    } on PlatformException {
      platformVersion = 'Failed to get platform version.';
    }

    // If the widget was removed from the tree while the asynchronous platform
    // message was in flight, we want to discard the reply rather than calling
    // setState to update our non-existent appearance.
    if (!mounted) return;

    setState(() {
      _platformVersion = platformVersion;
    });
  }

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      home: Scaffold(
        appBar: AppBar(
          title: const Text('Plugin example app'),
        ),
        body: Stack(
          children: [
            NexilisButton(
                xpos: 0,
                ypos: 0,
                apiKey:
                    '***REPLACE***WITH***YOUR***NEXILIS***ACCOUNT***'),
          ],
        ),
      ),
    );
  }
}
                                                                                                                    </pre>
                        </div>

                    </div>
                    <!-- end nusdklitecode -->
                    <!-- end coming soon -->



                </div>


                <div class="row mt-4">
                    <div class="col-md-7 text-center mx-auto">
                        <?php if (empty($_SESSION['id_user']) || $_SESSION['id_user'] == '') { ?>
                            <button data-translate="index-33" id='download-sample-code' class="btn nav-menu-btn-alt mx-auto"></button>
                        <?php } else { ?>
                            <a data-translate="index-33" href="<?php echo base_url(); ?>downloads/PalioLiteSampleCode40.zip?<?php echo $timeSec; ?>" type="button" class="btn nav-menu-btn-alt mx-auto"></a>
                        <?php } ?>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <style>
        .card-img-top {
            height: 110px;
            width: auto;
        }

        .carousel-indicators {
            bottom: -30px;
            z-index: 9999 !important;
        }

        .carousel-indicators li {
            background-color: gray;
        }

        .carousel-control-prev-icon {
            background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%236c757d' viewBox='0 0 8 8'%3E%3Cpath d='M5.25 0l-4 4 4 4 1.5-1.5-2.5-2.5 2.5-2.5-1.5-1.5z'/%3E%3C/svg%3E");
        }

        .carousel-control-next-icon {
            background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%236c757d' viewBox='0 0 8 8'%3E%3Cpath d='M2.75 0l-1.5 1.5 2.5 2.5-2.5 2.5 1.5 1.5 4-4-4-4z'/%3E%3C/svg%3E");
        }

        hr#solutions {
            border-top: 3px solid rgba(0, 0, 0, .1);
        }

        .nav-menu-btn-yellow {
            font-weight: 400 !important;
            border-radius: 10px;
            background-color: #002d91 !important;
            color: #fff;
        }

        .nav-menu-btn-yellow:hover {
            background-color: #fff;
            color: #002d91 !important;
            border-style: solid;
            border-color: #002d91 !important;
        }

        @media screen and (max-width: 438px) {
            #carousel-part-1 {
                margin-top: 35px !important;
            }

            #carousel-header-1 {
                margin-top: 38px !important;
                font-size: 20px !important;
            }

            #live-stream-image2 {
                width: 200px !important;
                margin-top: 115px !important;
            }

            #live-stream-image3 {
                width: 240px !important;
                margin-top: 110px !important;
                margin-left: 0px !important;
            }

            #carousel-text-1 {
                margin-top: 330px !important;
            }

            #carousel-part-2 {
                margin-top: 37px !important;
            }

            #carousel-header-2 {
                margin-top: 38px !important;
            }

            #video-call-image {
                width: 330px !important;
                margin-top: 80px !important;
                margin-left: -50px !important;
            }

            #video-call-image2 {
                width: 370px !important;
                margin-top: 95px !important;
                margin-left: -20px !important;
            }

            #carousel-text-2 {
                margin-top: 330px !important;
            }

            #carousel-part-3 {
                margin-top: 30px !important;
            }

            #carousel-header-3 {
                margin-top: 31px !important;
            }

            #audio-call-image2 {
                width: 260px !important;
                margin-left: -2px !important;
                margin-top: 73px !important;
            }

            #audio-call-image3 {
                width: 240px !important;
                margin-top: 120px !important;
                margin-left: 13px !important;
            }

            .soundwave {
                margin-top: 63px !important;
                margin-left: -212px !important;
            }

            #carousel-text-3 {
                margin-top: 320px !important;
            }

            #carousel-part-4 {
                margin-top: 30px !important;
            }

            #carousel-header-4 {
                margin-top: 32px !important;
                font-size: 23px !important;
            }

            #screen-sharing-image2 {
                width: 400px !important;
                margin-top: 40px !important;
            }

            #carousel-text-4 {
                margin-top: 320px !important;
            }

            .graphbar1 {
                width: 8px !important;
                margin-top: 228px !important;
                margin-left: -104px !important;
            }

            .graphbar2 {
                width: 8px !important;
                margin-top: 212px !important;
                margin-left: -87px !important;
            }

            .graphbar3 {
                width: 8px !important;
                margin-top: 195px !important;
                margin-left: -69px !important;
            }

            .graphbar4 {
                width: 8px !important;
                margin-top: 220px !important;
                margin-left: -51px !important;
            }

            .graphbar5 {
                width: 8px !important;
                margin-top: 196px !important;
                margin-left: 57px !important;
            }

            .graphbar6 {
                width: 8px !important;
                margin-top: 179px !important;
                margin-left: 75px !important;
            }

            .graphbar7 {
                width: 8px !important;
                margin-top: 163px !important;
                margin-left: 93px !important;
            }

            .graphbar8 {
                width: 8px !important;
                margin-top: 188px !important;
                margin-left: 112px !important;
            }

            #carousel-part-5 {
                margin-top: 37px !important;
            }

            #carousel-header-5 {
                margin-top: 42px !important;
                font-size: 19px !important;
            }

            #instant-messaging-image2 {
                width: 300px !important;
                margin-top: 120px !important;
                margin-left: 20px !important;
            }

            #instant-messaging-image3a {
                width: 140px !important;
                margin-top: 160px !important;
                margin-left: -147px !important;
            }

            #instant-messaging-image3b {
                width: 140px !important;
                margin-top: 130px !important;
                margin-left: 135px !important;
            }

            #carousel-text-5 {
                margin-top: 330px !important;
            }

            #carousel-part-6 {
                margin-top: 37px !important;
            }

            #carousel-header-6 {
                margin-top: 39px !important;
                font-size: 23px !important;
            }

            #smart-feature2-image {
                width: 300px !important;
                margin-top: 90px !important;
                margin-left: -10px !important;
            }

            #smart-feature3-image {
                width: 35px !important;
                margin-top: 180px !important;
                margin-left: -105px !important;
            }

            #smart-feature4-image {
                width: 35px !important;
                margin-top: 160px !important;
                margin-left: 105px !important;
            }

            #carousel-text-6 {
                margin-top: 330px !important;
            }
        }
    </style>
</div>


<hr width="100%">

<div class="container-fluid my-4 py-4">
    <div class="row justify-content-center m-0">
        <div class="col-md-8">
            <div class="row justify-content-center text-center">
                <p data-translate="index-36" class="fontRobBold fs-30 worried"></p>
            </div>
        </div>
    </div>
</div>

<hr width="100%">

<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
    AOS.init();
</script>

<script type="text/javascript">
    /** index activity layout links */
    <?php if (isset($_SESSION['id_user'])) { ?>
        var _0x4ecd = ['67UZuvAn', '1879mDCzks', '1fRsmQr', '#activity-layout', '3769LIdroX', '3320JiqHEK', '44438DSbNAV', '165664WyCpkL', 'downloads/res-pb.zip', 'click', '40kWPDLc', '430751gFKbFW', 'href', '99PeFkIX', '196826TBBmcY'];
        var _0x67afd8 = _0x17a2;

        function _0x17a2(_0x9db426, _0x5d4353) {
            return _0x17a2 = function(_0x4ecdaf, _0x17a2ed) {
                _0x4ecdaf = _0x4ecdaf - 0x158;
                var _0x200cc3 = _0x4ecd[_0x4ecdaf];
                return _0x200cc3;
            }, _0x17a2(_0x9db426, _0x5d4353);
        }(function(_0x23b14f, _0x121499) {
            var _0x34d8f9 = _0x17a2;
            while (!![]) {
                try {
                    var _0x72536d = -parseInt(_0x34d8f9(0x160)) + -parseInt(_0x34d8f9(0x15f)) * -parseInt(_0x34d8f9(0x164)) + parseInt(_0x34d8f9(0x158)) * parseInt(_0x34d8f9(0x15b)) + -parseInt(_0x34d8f9(0x161)) + parseInt(_0x34d8f9(0x159)) + parseInt(_0x34d8f9(0x15a)) * parseInt(_0x34d8f9(0x15e)) + -parseInt(_0x34d8f9(0x15c)) * parseInt(_0x34d8f9(0x165));
                    if (_0x72536d === _0x121499) break;
                    else _0x23b14f['push'](_0x23b14f['shift']());
                } catch (_0x48c497) {
                    _0x23b14f['push'](_0x23b14f['shift']());
                }
            }
        }(_0x4ecd, 0x1f155), $(_0x67afd8(0x15d))[_0x67afd8(0x163)](function() {
            var _0x1f1d06 = _0x67afd8;
            $(this)['prop'](_0x1f1d06(0x166), _0x1f1d06(0x162));
        }));
    <?php } else { ?>
        var _0xf868 = ['184741OkdLIN', '62750ZYdcfG', '6tEbDRE', '15XPuVqn', '#activity-layout', '301951DcpYad', '75396ORFagF', '1OZEfMV', 'Mohon\x20lakukan\x20registrasi\x20terlebih\x20dahulu\x20sebelum\x20mengunduh\x20kode\x20sampel!', '56458XKeNTH', 'lang', '7oLYdGo', '2169yQQijX', '234005zufKEy'];

        function _0xeed4(_0xfe3302, _0x46ffcd) {
            return _0xeed4 = function(_0xf8688, _0xeed4ed) {
                _0xf8688 = _0xf8688 - 0x98;
                var _0x1ecbf1 = _0xf868[_0xf8688];
                return _0x1ecbf1;
            }, _0xeed4(_0xfe3302, _0x46ffcd);
        }
        var _0x5459a8 = _0xeed4;
        (function(_0x42b0e1, _0x5cf2ca) {
            var _0x3949ab = _0xeed4;
            while (!![]) {
                try {
                    var _0x44376f = parseInt(_0x3949ab(0xa2)) + -parseInt(_0x3949ab(0x98)) * parseInt(_0x3949ab(0x9a)) + -parseInt(_0x3949ab(0xa4)) * -parseInt(_0x3949ab(0x9d)) + parseInt(_0x3949ab(0xa3)) + parseInt(_0x3949ab(0x9e)) * parseInt(_0x3949ab(0x9f)) + -parseInt(_0x3949ab(0x9c)) + -parseInt(_0x3949ab(0x9b)) * parseInt(_0x3949ab(0xa0));
                    if (_0x44376f === _0x5cf2ca) break;
                    else _0x42b0e1['push'](_0x42b0e1['shift']());
                } catch (_0x59bebb) {
                    _0x42b0e1['push'](_0x42b0e1['shift']());
                }
            }
        }(_0xf868, 0x4396a), $(_0x5459a8(0xa1))['click'](function() {
            var _0x16dd79 = _0x5459a8;
            localStorage[_0x16dd79(0x99)] == 0x0 ? alert('Please\x20sign\x20up\x20first\x20before\x20downloading\x20the\x20sample\x20code!') : alert(_0x16dd79(0xa5)), location['href'] = 'sign_up.php';
        }));
    <?php } ?>
</script>

<!-- ANIMATION SECTION -->

<script>
    $(document).ready(function() {

        // var scrollSpy = new bootstrap.ScrollSpy(document.body, {
        //     target: '#navbar-example3'
        // })

        // $("#animate-clickme").animate({
        //     top: '+=60px'
        // }, 2000);
        // $("#animate-clickme").animate({
        //     top: '-=60px'
        // }, 2000);

        // setInterval(function() {
        //     $("#animate1").animate({
        //         top: '+=60px'
        //     }, 2000);
        //     $("#animate1").animate({
        //         top: '-=60px'
        //     }, 2000);
        //     $("#animate2").animate({
        //         top: '-=60px'
        //     }, 2000);
        //     $("#animate2").animate({
        //         top: '+=60px'
        //     }, 2000);
        //     $("#animate-clickme").animate({
        //         top: '+=60px'
        //     }, 2000);
        //     $("#animate-clickme").animate({
        //         top: '-=60px'
        //     }, 2000);

        // }, 2000);

        // var animateLevelUpTi1;
        // var animateLevelUpTi2;
        // var animateLevelUpTi3;
        // var animateLevelUpTi4;

        // runLevelUpAnimation();
        // resumeLevelUpAnimation();

        // $('#FB_1').on("mouseenter", function() {
        //     clearAnimateLevelUp();
        //     $('#FB_1').attr('src', 'palio_button/assets/Untitled110_20220121183610.png');
        //     $('#FB_2').attr('src', 'newAssets/floating_button/button_chat.png');
        //     $('#FB_3').attr('src', 'newAssets/floating_button/button_call.png');
        //     $('#FB_4').attr('src', 'newAssets/floating_button/button_stream.png');
        // }).on("mouseleave", function() {
        //     resumeLevelUpAnimation();
        // });

        // $('#FB_2').on("mouseenter", function() {
        //     clearAnimateLevelUp();
        //     $('#FB_1').attr('src', 'newAssets/floating_button/button_cc.png');
        //     $('#FB_2').attr('src', 'palio_button/assets/Untitled110_20220121183614.png');
        //     $('#FB_3').attr('src', 'newAssets/floating_button/button_call.png');
        //     $('#FB_4').attr('src', 'newAssets/floating_button/button_stream.png');
        // }).on("mouseleave", function() {
        //     resumeLevelUpAnimation();
        // });

        // $('#FB_3').on("mouseenter", function() {
        //     clearAnimateLevelUp();
        //     $('#FB_1').attr('src', 'newAssets/floating_button/button_cc.png');
        //     $('#FB_2').attr('src', 'newAssets/floating_button/button_chat.png');
        //     $('#FB_3').attr('src', 'palio_button/assets/Untitled110_20220121183621.png');
        //     $('#FB_4').attr('src', 'newAssets/floating_button/button_stream.png');
        // }).on("mouseleave", function() {
        //     resumeLevelUpAnimation();
        // });

        // $('#FB_4').on("mouseenter", function() {
        //     clearAnimateLevelUp();
        //     $('#FB_1').attr('src', 'newAssets/floating_button/button_cc.png');
        //     $('#FB_2').attr('src', 'newAssets/floating_button/button_chat.png');
        //     $('#FB_3').attr('src', 'newAssets/floating_button/button_call.png');
        //     $('#FB_4').attr('src', 'palio_button/assets/Untitled110_20220121183617.png');
        // }).on("mouseleave", function() {
        //     resumeLevelUpAnimation();
        // });

        // function clearAnimateLevelUp() {
        //     clearInterval(animateLevelUpIn);
        //     clearTimeout(animateLevelUpTi1);
        //     clearTimeout(animateLevelUpTi2);
        //     clearTimeout(animateLevelUpTi3);
        //     clearTimeout(animateLevelUpTi4);
        // }

        // function runLevelUpAnimation() {
        //     animateLevelUpTi1 = setTimeout(function() {
        //         $('#FB_4').attr('src', 'palio_button/assets/Untitled110_20220121183617.png');
        //         $('#FB_3').attr('src', '/newAssets/floating_button/button_call.png');
        //         $('#FB_2').attr('src', '/newAssets/floating_button/button_chat.png');
        //         $('#FB_1').attr('src', '/newAssets/floating_button/button_cc.png');
        //     }, 1000);

        //     animateLevelUpTi2 = setTimeout(function() {
        //         $('#FB_3').attr('src', 'palio_button/assets/Untitled110_20220121183621.png');
        //         $('#FB_4').attr('src', '/newAssets/floating_button/button_stream.png');
        //         $('#FB_2').attr('src', '/newAssets/floating_button/button_chat.png');
        //         $('#FB_1').attr('src', '/newAssets/floating_button/button_cc.png');
        //     }, 2000);

        //     animateLevelUpTi3 = setTimeout(function() {
        //         $('#FB_2').attr('src', 'palio_button/assets/Untitled110_20220121183614.png');
        //         $('#FB_3').attr('src', '/newAssets/floating_button/button_call.png');
        //         $('#FB_4').attr('src', '/newAssets/floating_button/button_stream.png');
        //         $('#FB_1').attr('src', '/newAssets/floating_button/button_cc.png');
        //     }, 3000);

        //     animateLevelUpTi4 = setTimeout(function() {
        //         $('#FB_1').attr('src', 'palio_button/assets/Untitled110_20220121183610.png');
        //         $('#FB_3').attr('src', '/newAssets/floating_button/button_call.png');
        //         $('#FB_2').attr('src', '/newAssets/floating_button/button_chat.png');
        //         $('#FB_4').attr('src', '/newAssets/floating_button/button_stream.png');
        //     }, 4000);
        // }

        // function resumeLevelUpAnimation() {

        //     runLevelUpAnimation();

        //     animateLevelUpIn = setInterval(function() {
        //         runLevelUpAnimation();
        //     }, 4000);
        // }

        var images_ls = [
            "<?php echo base_url(); ?>ls-phone-1.png",
            "<?php echo base_url(); ?>ls-phone-2.png",
        ]

        var images_vc_1 = [
            "<?php echo base_url(); ?>vidcall-1.png",
            "<?php echo base_url(); ?>vidcall-1a.png",
        ]

        var images_vc_2 = [
            "<?php echo base_url(); ?>vidcall-2.png?v=2",
            "<?php echo base_url(); ?>vidcall-2a.png?v=2",
        ]

        var images_cetris = [
            "<?php echo base_url(); ?>cetris 2.png",
            "<?php echo base_url(); ?>cetris.png",
        ]

        var lamp = [
            "visible",
            "hidden"
        ]

        var images_board = [
            "<?php echo base_url(); ?>whiteboard-3.png",
            "<?php echo base_url(); ?>whiteboard-3a.png",
        ]

        var images_main = [
            "<?php echo base_url(); ?>homepage_long1.png",
            "<?php echo base_url(); ?>homepage_long2.png",
        ]

        var images_main_long = [
            "<?php echo base_url(); ?>homepage1.png",
            "<?php echo base_url(); ?>homepage2.png",
        ]

        var current = 0;

        setInterval(function() {

            $('#banner-img-mbl').attr('src', images_main_long[current]);
            $('#banner-img-mbl-2').attr('src', images_main[current]);
            $('#live-stream-image2').attr('src', images_ls[current]);
            $('#video-call-image').attr('src', images_vc_1[current]);
            $('#video-call-image2').attr('src', images_vc_2[current]);
            $('#smart-feature4-image').css('visibility', lamp[current]);
            $('#white-board-image3').attr('src', images_board[current]);

            $('.cetris').attr('src', images_cetris[current]);

            current = (current < images_ls.length - 1) ? current + 1 : 0;
        }, 1000);

        var time;

        $('.carousel').bind('slide.bs.carousel', function(e) {
            $('.carousel-inner').css("z-index", '11');
            clearTimeout(time);

            time = setTimeout(function() {
                $('.carousel-inner').css("z-index", '13');
            }, 2000);

        });

        var color = 0;

        var color_graph = [
            "darkred",
            "darkgreen",
            "darkblue",
            "orange",
            "purple",
        ]

        setInterval(function() {

            $(".graphbar1").css('background-color', color_graph[color + 3]);
            $(".graphbar2").css('background-color', color_graph[color + 2]);
            $(".graphbar3").css('background-color', color_graph[color + 1]);
            $(".graphbar4").css('background-color', color_graph[color]);
            $(".graphbar5").css('background-color', color_graph[color + 3]);
            $(".graphbar6").css('background-color', color_graph[color + 2]);
            $(".graphbar7").css('background-color', color_graph[color + 1]);
            $(".graphbar8").css('background-color', color_graph[color]);

            color = (color < color_graph.length - 1) ? color + 1 : 0;
        }, 1000);

    });
</script>

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

        var images_f_b = [
            "<?php echo base_url(); ?>f_b-1.png",
            "<?php echo base_url(); ?>f_b-2.png",
        ]

        var current = 0;

        setInterval(function() {
            $('#contact-center').attr('src', images_cs[current]);
            $('#retail-commerce').attr('src', images_retail[current]);
            $('#f_b').attr('src', images_f_b[current]);

            current = (current < images_retail.length - 1) ? current + 1 : 0;
        }, 1000);

    });

    // SECTION ARROW ACTIVE NOT DISSAPEAR AFTER SWITCHING

    $('.carousel-control-prev').on('click', function() {

        $('.carousel-control-prev').css('opacity', '1');

        setTimeout(function() {
            $('.carousel-control-prev').css('opacity', '0.5');
        }, 1000);

    })

    $('.carousel-control-next').on('click', function() {

        $('.carousel-control-next').css('opacity', '1');

        setTimeout(function() {
            $('.carousel-control-next').css('opacity', '0.5');
        }, 1000);

    })

    $(".carousel-control-prev").hover(function() {

        $(this).css("opacity", "1");
    }, function() {
        $(this).css("opacity", "0.5");

    });

    $(".carousel-control-next").hover(function() {

        $(this).css("opacity", "1");
    }, function() {
        $(this).css("opacity", "0.5");

    });
</script>

<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/contact-alt.php'); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/contact-button.php'); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/footer-alt.php'); ?>
<footer class="footerBanner-alt"></footer>