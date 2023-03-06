<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/header-alt.php'); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/header-alt-meta.php'); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/index-nav.php'); ?>
<?php
$_SESSION['previous_page'] = $_SESSION['current_page'];
$_SESSION['current_page'] = 4;
require_once($_SERVER['DOCUMENT_ROOT'] . '/state_control.php');

$timeSec = 'v=' . time();
?>

<style>
    @media (min-width: 769px) {
        #bg-index-alt {
            background-image: url('../banner_ib.jpg') !important;
            background-size: cover;
        }

        .head-mbl {
            width: 30% !important;
            height: auto !important;
            margin: 0 auto;
        }
    }

    @media (max-width: 600px) {
        .store {
            max-width: 175px !important;
            margin-left: 13px;
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

        .ss-mbl {
            width: 45% !important;
            height: auto !important;
        }

        .head-mbl {
            width: 30% !important;
            height: auto !important;
            margin: 0 auto;
        }

        #head-img {
            padding: 0;
        }
    }

    .productBanner-alt {
        /* background-image: url('newAssets/product/bi7.webp') !important; */
        background-image: linear-gradient(to bottom, #1799ad, #159db166) !important;
        background-color: unset;
    }
</style>

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
            flex: 0 0 60% !important;
            max-width: 60% !important;
        }

        #p-embed {
            /* margin: 4rem 0 !important; */
            /* margin: 1.5rem 0 !important; */
            padding-top: 6rem;
        }

        .product-desc {
            font-size: 20px !important;
        }

        /* .ss-mbl {
                width: 45% !important;
                height: auto !important;
        } */
    }

    @media screen and (min-width:769px) {
        #mobile-img {
            display: none !important;
        }
    }

    .color-green {
        color: #1799ad;
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
            font-size: 35px !important;
        }
    }

    .img-ss {
        height: 500px;
        width: auto;
    }

    ul.desc-list {
        padding-left: inherit;
    }

    @media(max-width: 767px) {

        .fs-20,
        .fs-18 {
            font-size: 16px;
        }

        h2 {
            margin-top: 15px;
        }

        .fs-35 {
            font-size: 25px;
        }
    }

    .horizontal-slide {
        overflow-x: auto;
        overflow-y: hidden;
        white-space: nowrap;
        display: block;
        -ms-overflow-style: none;
        scrollbar-width: none;
    }

    .horizontal-slide::-webkit-scrollbar {
        display: none;
    }

    .horizontal-slide li {
        display: inline-block;
    }

    #div_sports,
    #div_cook,
    #div_tsel,
    #div_nu,
    #div_gaspol,
    #div_browser {
        scroll-margin: 60px;
    }

    @media screen and (min-width:768px) {
        #tv_image {}

        #tv_video {
            width: 743px;
            margin-top: 15px;
        }
    }

    @media screen and (max-width:768px) {
        #tv_image {
            width: 334px;
            height: 227px;
        }

        #tv_video {
            width: 323px;
            margin-top: 5px;
            height: 194px;
            object-fit: fill;
        }
    }

    #thumbnail-slider .thumb {

        width: 75%;
        height: 75% !important;
    }

    #head-img {
        color: transparent; 
    }

</style>

<header class="productBanner-alt">
    <div class="row px-5 pt-5 mb-5 pb-5">
        <div class="col-md-12 pt-5 text-center">
            <h1 data-translate="usocial-1" class="mb-3 fontRobBold fs-35" style="color: white;"></h1>
            <p data-translate="usocial-2" class="text-center pr-0 pr-lg-5 fs-18" style="font-family: 'Poppins',sans-serif; font-weight: 300 !important; color: white;"></p>
            <div class="row">
                <div class="col-12 pl-0">
                    <span data-translate="usocial-20"></span>
                    <!-- <img class="store" src="ucaas_assets\img\app_store_editedx.png" style="max-width:185px; height: 52px;"> -->
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12" id="head-img">
            <!-- <ul class="nav nav-tabs horizontal-slide gx-0">
                <li class="nav-item" onclick="document.getElementById('div_sports').scrollIntoView()" style="cursor: pointer">
                    <img id="sports_icon" src="<?php echo base_url(); ?>nx_sports.png" alt="" class="img-fluid align-self-center" style="height: 160px; margin-left: 20px; margin-right: 20px;" data-bs-toggle="tooltip" data-bs-placement="bottom" title="nexilis Sports">
                </li>
                <li class="nav-item" onclick="document.getElementById('div_cook').scrollIntoView()" style="cursor: pointer">
                    <img id="cook_icon" src="<?php echo base_url(); ?>nx_cook.png" alt="" class="img-fluid align-self-center" style="height: 170px; margin-left: 20px; margin-right: 20px" data-bs-toggle="tooltip" data-bs-placement="bottom" title="nexilis Cook">
                </li>
                <li class="nav-item" onclick="document.getElementById('div_gaspol').scrollIntoView()" style="cursor: pointer">
                    <img id="gaspol_icon" src="<?php echo base_url(); ?>appIcon.png" alt="" class="img-fluid align-self-center" style="height: 160px; margin-left: 20px; margin-right: 20px" data-bs-toggle="tooltip" data-bs-placement="bottom" title="GasPol !">
                </li>
                <li class="nav-item" onclick="document.getElementById('div_browser').scrollIntoView()" style="cursor: pointer">
                    <img id="browser_icon" src="<?php echo base_url(); ?>nx_browser.png" alt="" class="img-fluid align-self-center" style="height: 180px; margin-left: 20px; margin-right: 20px" data-bs-toggle="tooltip" data-bs-placement="bottom" title="nexilis Browser">
                </li>
                <li class="nav-item" onclick="document.getElementById('div_nu').scrollIntoView()" style="cursor: pointer">
                    <img id="nu_icon" src="<?php echo base_url(); ?>logo_nup.png" alt="" class="img-fluid align-self-center" style="height: 170px; margin-left: 20px; margin-right: 20px" data-bs-toggle="tooltip" data-bs-placement="bottom" title="MyNU Community">
                </li>
                <li class="nav-item" onclick="document.getElementById('div_tsel').scrollIntoView()" style="cursor: pointer">
                    <img id="tsel_icon" src="<?php echo base_url(); ?>logo_mtsp.png" alt="" class="img-fluid align-self-center" style="height: 160px; margin-left: 20px; margin-right: 20px" data-bs-toggle="tooltip" data-bs-placement="bottom" title="MyTSel Community">
                </li>
            </ul> -->
            <div style="margin-top: -120px; padding:110px 0;">
                <div id="thumbnail-slider">
                    <div class="inner">
                        <ul>
                            <li class="nav-item" onclick="document.getElementById('div_sports').scrollIntoView()" style="cursor: pointer">
                                <img id="sports_icon" src="<?php echo base_url(); ?>nx_sports.png" alt="" class="img-fluid align-self-center thumb" style="height: 160px; margin-left: 20px; margin-right: 20px;" data-bs-toggle="tooltip" data-bs-placement="bottom" title="nexilis Sports" draggable="false">
                            </li>
                            <li class="nav-item" onclick="document.getElementById('div_cook').scrollIntoView()" style="cursor: pointer">
                                <img id="cook_icon" src="<?php echo base_url(); ?>nx_cook.png" alt="" class="img-fluid align-self-center thumb" style="height: 170px; margin-left: 20px; margin-right: 20px" data-bs-toggle="tooltip" data-bs-placement="bottom" title="nexilis Cook" draggable="false">
                            </li>
                            <!-- <li class="nav-item" onclick="document.getElementById('div_gaspol').scrollIntoView()" style="cursor: pointer">
                                <img id="gaspol_icon" src="<?php echo base_url(); ?>appIcon.png" alt="" class="img-fluid align-self-center thumb" style="height: 160px; margin-left: 20px; margin-right: 20px" data-bs-toggle="tooltip" data-bs-placement="bottom" title="GasPol !" draggable="false">
                            </li> -->
                            <li class="nav-item" onclick="document.getElementById('div_nu').scrollIntoView()" style="cursor: pointer">
                                <img id="nu_icon" src="<?php echo base_url(); ?>logo_nup.png" alt="" class="img-fluid align-self-center thumb" style="height: 170px; margin-left: 20px; margin-right: 20px" data-bs-toggle="tooltip" data-bs-placement="bottom" title="MyNU Community" draggable="false">
                            </li>
                            <li class="nav-item" onclick="document.getElementById('div_tsel').scrollIntoView()" style="cursor: pointer">
                                <img id="tsel_icon" src="<?php echo base_url(); ?>logo_mtsp.png" alt="" class="img-fluid align-self-center thumb" style="height: 160px; margin-left: 20px; margin-right: 20px" data-bs-toggle="tooltip" data-bs-placement="bottom" title="DigiSales" draggable="false">
                            </li>
                            <li class="nav-item" onclick="document.getElementById('div_bi').scrollIntoView()" style="cursor: pointer">
                                <img id="bi_icon" src="<?php echo base_url(); ?>beautfulindonesia.webp" alt="" class="img-fluid align-self-center thumb" style="height: 160px; margin-left: 20px; margin-right: 20px;" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Beautiful Indonesia" draggable="false">
                            </li>
                            <li class="nav-item" onclick="document.getElementById('div_browser').scrollIntoView()" style="cursor: pointer">
                                <img id="browser_icon" src="<?php echo base_url(); ?>nx_browser.png" alt="" class="img-fluid align-self-center thumb" style="height: 180px; margin-left: 20px; margin-right: 20px; margin-top: 20px; margin-left: 35px" data-bs-toggle="tooltip" data-bs-placement="bottom" title="nexilis Browser" draggable="false">
                            </li>
                            <li class="nav-item" onclick="document.getElementById('div_diginets').scrollIntoView()" style="cursor: pointer">
                                <img id="diginets_icon" src="<?php echo base_url(); ?>clean_diginets_logo.png" alt="" class="img-fluid align-self-center thumb" style="height: 170px; margin-left: 20px; margin-right: 20px" data-bs-toggle="tooltip" data-bs-placement="bottom" title="DigiNetS" draggable="false">
                            </li> 
                            <li class="nav-item" onclick="document.getElementById('div_tniad').scrollIntoView()" style="cursor: pointer">
                                <img id="tniad_icon" src="<?php echo base_url(); ?>tniad_logo.png" alt="" class="img-fluid align-self-center thumb" style="height: 180px; margin-left: 20px; margin-right: 20px" data-bs-toggle="tooltip" data-bs-placement="bottom" title="TNIADigiComm" draggable="false">
                            </li>
                            <li class="nav-item" onclick="document.getElementById('div_ib').scrollIntoView()" style="cursor: pointer">
                                <img id="ib_icon" src="<?php echo base_url(); ?>ib_symbol_2.png" alt="" class="img-fluid align-self-center thumb" style="height: 143px; margin-left: 20px; margin-right: 20px" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Indonesia Bisa" draggable="false">
                            </li>
                            <li class="nav-item" onclick="document.getElementById('div_intiapp').scrollIntoView()" style="cursor: pointer">
                                <img id="intiapp_icon" src="<?php echo base_url(); ?>intiapp_logo.png" alt="" class="img-fluid align-self-center thumb" style="height: 160px; margin-left: 20px; margin-right: 20px" data-bs-toggle="tooltip" data-bs-placement="bottom" title="IntiApp" draggable="false">
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>
</header>

<div class="container-fluid" id="features-list">
    <div class="row justify-content-center my-auto" id="div_sports" data-aos="fade-bottom">
        <img src="<?php echo base_url(); ?>nx_sports.png" style=" width: 80px; height: 80px; margin-right: 20px; margin-top: 35px">
        <h2 class="fontRobBold fs-35 color-green mt-5">nexilis Sports</h2>
        <div class="col-12 d-flex justify-content-center mt-5 mb-5">
            <img id="tv_image" src="<?php echo base_url(); ?>tv.png" class="img-ss" data-aos="fade-up" data-aos-delay="100" data-aos-offset="200">
            <video id="tv_video" muted src="nexilisSport-add-03q.mp4" style="position: absolute" data-aos="fade-up" data-aos-delay="100" data-aos-offset="200" autoplay loop>
        </div>
        <div class="col-12 d-flex justify-content-center">
            <li class="nav-item" style="list-style-type:none">
                <img src="<?php echo base_url(); ?>sports_2.png" class="img-ss" data-aos="fade-right" data-aos-delay="100" data-aos-offset="200">
            </li>
            <li class="nav-item" style="list-style-type:none">
                <img src="<?php echo base_url(); ?>phone_transparent.png" class="img-ss" data-aos="fade-up" data-aos-delay="300" data-aos-offset="200">
                <video muted src="nexilisSport-animForAd-03a.mp4" style="object-fit: fill; position: absolute; width: 220px; height: 415px; margin-left: -364px; margin-top: 45px; z-index: -200" autoplay loop data-aos="fade-in" data-aos-delay="500" data-aos-offset="200"></video>
            </li>
            <li class="nav-item" style="list-style-type:none">
                <img src="<?php echo base_url(); ?>sports_3.png" class="img-ss" data-aos="fade-left" data-aos-delay="500" data-aos-offset="200">
            </li>
            </ul>
        </div>
        <img src="table.png" style="height: 150px; width: 150%; object-fit: cover; object-position: top; opacity: 0.7; margin-top: -130px; z-index: -99990; margin-bottom: -20px">
    </div>
    <div class="row justify-content-center bg-light my-auto" data-aos="fade-bottom" id="div_cook">
    <img src="<?php echo base_url(); ?>nx_cook.png" style=" width: 80px; height: 80px; margin-right: 20px; margin-top: 35px">
        <h2 class="fontRobBold fs-35 color-green mt-5">nexilis Cook</h2>
        <div class="col-12 d-flex justify-content-center mt-5 mb-5">
            <!-- <ul class="nav nav-tabs horizontal-slide gx-0"> -->
            <li class="nav-item" style="list-style-type:none">
                <img src="<?php echo base_url(); ?>cook_2.png" class="img-ss" data-aos="fade-right" data-aos-delay="100" data-aos-offset="200">
            </li>
            <li class="nav-item" style="list-style-type:none">
                <img src="<?php echo base_url(); ?>phone_transparent.png" class="img-ss" data-aos="fade-up" data-aos-delay="300" data-aos-offset="200">
                <video muted src="video_cook.mp4?v=5" style="object-fit: fill; position: absolute; width: 222px; height: 417px; margin-left: -365px; margin-top: 42px; z-index: -200" autoplay loop data-aos="fade-in" data-aos-delay="500" data-aos-offset="200"></video>
            </li>
            <li class="nav-item" style="list-style-type:none">
                <img src="<?php echo base_url(); ?>cook_3.png" class="img-ss" data-aos="fade-left" data-aos-delay="500" data-aos-offset="200">
            </li>
            <!-- </ul> -->
        </div>
        <img src="table.png" style="height: 150px; width: 150%; object-fit: cover; object-position: top; opacity: 0.7; margin-top: -130px; z-index: -99990; margin-bottom: -20px">
    </div>
    <!-- <div class="row justify-content-center bg-light my-auto" data-aos="fade-bottom" id="div_gaspol">
        <h2 class="fontRobBold fs-35 color-green mt-5">GasPol!</h2>
        <div class="col-12 d-flex justify-content-center mt-5 mb-5">
            <ul class="nav nav-tabs horizontal-slide gx-0">
                <li class="nav-item" style="list-style-type:none">
                    <img src="<?php echo base_url(); ?>gaspol_1.png" class="img-ss" data-aos="fade-right" data-aos-delay="100"  data-aos-offset="200">
                </li>
                <li class="nav-item" style="list-style-type:none">
                    <img src="<?php echo base_url(); ?>phone_transparent.png" class="img-ss" data-aos="fade-up" data-aos-delay="300"  data-aos-offset="200">
                    <video muted src="video_gaspol.mp4?v=5" style="object-fit: fill; position: absolute; width: 222px; height: 417px; margin-left: -365px; margin-top: 42px; z-index: -200" autoplay loop data-aos="fade-in" data-aos-delay="500"  data-aos-offset="200"></video>
                </li>
                <li class="nav-item" style="list-style-type:none">
                    <img src="<?php echo base_url(); ?>gaspol_3.png" class="img-ss" data-aos="fade-left" data-aos-delay="500"  data-aos-offset="200">
                </li>
            </ul>
        </div>
    </div> -->
    <div class="row justify-content-center my-auto" data-aos="fade-bottom" id="div_browser">
        <img src="<?php echo base_url(); ?>nx_browser.png" style=" width: 80px; height: 80px; margin-right: 20px; margin-top: 35px">
        <h2 class="fontRobBold fs-35 color-green mt-5">nexilis Browser</h2>
        <div class="col-12 d-flex justify-content-center mt-5 mb-5" style="margin-left: 80px">
            <!-- <ul class="nav nav-tabs horizontal-slide gx-0"> -->
            <li class="nav-item" style="list-style-type:none">
                <img src="<?php echo base_url(); ?>browser_1.png" class="img-ss" data-aos="fade-right" data-aos-delay="100" data-aos-offset="200">
            </li>
            <li class="nav-item" style="list-style-type:none">
                <!-- <img src="<?php echo base_url(); ?>browser_2.png" class="img-ss" data-aos="fade-right" data-aos-delay="100"  data-aos-offset="200"> -->
                <img src="<?php echo base_url(); ?>phone_transparent.png" class="img-ss" data-aos="fade-up" data-aos-delay="300" data-aos-offset="200">
                <video muted src="video_browser.mp4" style="object-fit: fill; position: absolute; width: 222px; height: 417px; margin-left: -365px; margin-top: 42px; z-index: -200" autoplay loop data-aos="fade-in" data-aos-delay="500" data-aos-offset="200"></video>
            </li>
            <li class="nav-item" style="list-style-type:none">
                <img src="<?php echo base_url(); ?>browser_2.png?v=9" class="img-ss" data-aos="fade-left" data-aos-delay="500" data-aos-offset="200">
            </li>
            <!-- </ul> -->
        </div>
        <img src="table.png" style="height: 150px; width: 150%; object-fit: cover; object-position: top; opacity: 0.7; margin-top: -130px; z-index: -99990; margin-bottom: -20px">
    </div>
    <div class="row justify-content-center bg-light my-auto" id="div_nu" data-aos="fade-bottom">
        <img src="<?php echo base_url(); ?>logo_nup.png" style=" width: 80px; height: 80px; margin-right: 20px; margin-top: 35px">
        <h2 class="fontRobBold fs-35 color-green mt-5">MyNU Community</h2>
        <div class="col-12 d-flex justify-content-center mt-5 mb-5">
            <!-- <ul class="nav nav-tabs horizontal-slide gx-0"> -->
            <li class="nav-item" style="list-style-type:none">
                <img src="<?php echo base_url(); ?>nu_2.png" class="img-ss" data-aos="fade-right" data-aos-delay="100" data-aos-offset="200">
            </li>
            <li class="nav-item" style="list-style-type:none">
                <img src="<?php echo base_url(); ?>phone_transparent.png" class="img-ss" data-aos="fade-up" data-aos-delay="300" data-aos-offset="200">
                <video muted src="video_nu.mp4?v=5" style="object-fit: fill; position: absolute; width: 222px; height: 417px; margin-left: -365px; margin-top: 42px; z-index: -200" autoplay loop data-aos="fade-in" data-aos-delay="500" data-aos-offset="200"></video>
            </li>
            <li class="nav-item" style="list-style-type:none">
                <img src="<?php echo base_url(); ?>nu_3.png" class="img-ss" data-aos="fade-left" data-aos-delay="500" data-aos-offset="200">
            </li>
            <!-- </ul> -->
        </div>
        <img src="table.png" style="height: 150px; width: 150%; object-fit: cover; object-position: top; opacity: 0.7; margin-top: -130px; z-index: -99990; margin-bottom: -20px">
    </div>
    <div class="row justify-content-center my-auto" id="div_tsel">
        <img src="<?php echo base_url(); ?>logo_mtsp.png" style=" width: 80px; height: 80px; margin-right: 20px; margin-top: 35px">
        <h2 class="fontRobBold fs-35 color-green mt-5">DigiSales</h2>
        <div class="col-12 d-flex justify-content-center mt-5 mb-5">
            <!-- <ul class="nav nav-tabs horizontal-slide gx-0"> -->
            <li class="nav-item" style="list-style-type:none">
                <img src="<?php echo base_url(); ?>telkom_2.png" class="img-ss" data-aos="fade-right" data-aos-delay="100" data-aos-offset="200">
            </li>
            <li class="nav-item" style="list-style-type:none">
                <img src="<?php echo base_url(); ?>phone_transparent.png" class="img-ss" data-aos="fade-up" data-aos-delay="300" data-aos-offset="200">
                <video muted src="video_tsel.mp4?v=5" style="object-fit: fill; position: absolute; width: 222px; height: 417px; margin-left: -365px; margin-top: 42px; z-index: -200" autoplay loop data-aos="fade-in" data-aos-delay="500" data-aos-offset="200"></video>
            </li>
            <li class="nav-item" style="list-style-type:none">
                <img src="<?php echo base_url(); ?>digisales_3.png" class="img-ss" data-aos="fade-left" data-aos-delay="500" data-aos-offset="200">
            </li>
            <!-- </ul> -->
        </div>
        <img src="table.png" style="height: 150px; width: 150%; object-fit: cover; object-position: top; opacity: 0.7; margin-top: -130px; z-index: -99990; margin-bottom: -20px">
    </div>
    <div class="row justify-content-center bg-light my-auto" id="div_bi" data-aos="fade-bottom">
        <img src="<?php echo base_url(); ?>beautfulindonesia.webp" style=" width: 80px; height: 80px; margin-right: 20px; margin-top: 35px">
        <h2 class="fontRobBold fs-35 color-green mt-5">Beautiful Indonesia</h2>
        <div class="col-12 d-flex justify-content-center mt-5 mb-5">
            <!-- <ul class="nav nav-tabs horizontal-slide gx-0"> -->
                <li class="nav-item" style="list-style-type:none">
                    <img src="<?php echo base_url(); ?>bi_1.png" class="img-ss" data-aos="fade-right" data-aos-delay="100"  data-aos-offset="200">
                </li>
                <li class="nav-item" style="list-style-type:none">
                    <img src="<?php echo base_url(); ?>phone_transparent.png" class="img-ss" data-aos="fade-up" data-aos-delay="300"  data-aos-offset="200">
                    <video muted src="bi_2.mp4" style="object-fit: fill; position: absolute; width: 222px; height: 417px; margin-left: -365px; margin-top: 42px; z-index: -200" autoplay loop data-aos="fade-in" data-aos-delay="500"  data-aos-offset="200"></video>
                </li>
                <li class="nav-item" style="list-style-type:none">
                    <img src="<?php echo base_url(); ?>bi_3.png" class="img-ss" data-aos="fade-left" data-aos-delay="500"  data-aos-offset="200">
                </li>
            <!-- </ul> -->
        </div>
        <img src="table.png" style="height: 150px; width: 150%; object-fit: cover; object-position: top; opacity: 0.7; margin-top: -130px; z-index: -99990; margin-bottom: -20px">
    </div>
    <div class="row justify-content-center my-auto" id="div_diginets">
        <img src="<?php echo base_url(); ?>clean_diginets_logo.png" style=" width: 80px; height: 80px; margin-right: 20px; margin-top: 35px">
        <h2 class="fontRobBold fs-35 color-green mt-5">DigiNetS</h2>
        <div class="col-12 d-flex justify-content-center mt-5 mb-5">
            <!-- <ul class="nav nav-tabs horizontal-slide gx-0"> -->
                <li class="nav-item" style="list-style-type:none">
                    <img src="<?php echo base_url(); ?>diginets_1.png" class="img-ss" data-aos="fade-right" data-aos-delay="100"  data-aos-offset="200">
                </li>
                <li class="nav-item" style="list-style-type:none">
                    <img src="<?php echo base_url(); ?>phone_transparent.png" class="img-ss" data-aos="fade-up" data-aos-delay="300"  data-aos-offset="200">
                    <video muted src="diginets_2.mp4?v=5" style="object-fit: fill; position: absolute; width: 222px; height: 417px; margin-left: -365px; margin-top: 42px; z-index: -200" autoplay loop data-aos="fade-in" data-aos-delay="500"  data-aos-offset="200"></video>
                </li>
                <li class="nav-item" style="list-style-type:none">
                    <img src="<?php echo base_url(); ?>diginets_3.png" class="img-ss" data-aos="fade-left" data-aos-delay="500"  data-aos-offset="200">
                </li>
            <!-- </ul> -->
        </div>
        <img src="table.png" style="height: 150px; width: 150%; object-fit: cover; object-position: top; opacity: 0.7; margin-top: -130px; z-index: -99990; margin-bottom: -20px">
    </div>
    <div class="row justify-content-center bg-light my-auto" id="div_tniad" data-aos="fade-bottom">
        <img src="<?php echo base_url(); ?>tniad_logo.png" style=" width: 80px; height: 80px; margin-right: 20px; margin-top: 35px">
        <h2 class="fontRobBold fs-35 color-green mt-5">TNIADigiComm</h2>
        <div class="col-12 d-flex justify-content-center mt-5 mb-5">
            <!-- <ul class="nav nav-tabs horizontal-slide gx-0"> -->
                <li class="nav-item" style="list-style-type:none">
                    <img src="<?php echo base_url(); ?>tniad_1.png" class="img-ss" data-aos="fade-right" data-aos-delay="100"  data-aos-offset="200">
                </li>
                <li class="nav-item" style="list-style-type:none">
                    <img src="<?php echo base_url(); ?>phone_transparent.png" class="img-ss" data-aos="fade-up" data-aos-delay="300"  data-aos-offset="200">
                    <video muted src="tniad_2.mp4?v=5" style="object-fit: fill; position: absolute; width: 222px; height: 417px; margin-left: -365px; margin-top: 42px; z-index: -200" autoplay loop data-aos="fade-in" data-aos-delay="500"  data-aos-offset="200"></video>
                </li>
                <li class="nav-item" style="list-style-type:none">
                    <img src="<?php echo base_url(); ?>tniad_3.png" class="img-ss" data-aos="fade-left" data-aos-delay="500"  data-aos-offset="200">
                </li>
            <!-- </ul> -->
        </div>
        <img src="table.png" style="height: 150px; width: 150%; object-fit: cover; object-position: top; opacity: 0.7; margin-top: -130px; z-index: -99990; margin-bottom: -20px">
    </div>
    <div class="row justify-content-center my-auto" id="div_ib">
        <img src="<?php echo base_url(); ?>ib_symbol_2.png" style=" width: 80px; height: 80px; margin-right: 20px; margin-top: 35px">
        <h2 class="fontRobBold fs-35 color-green mt-5">Indonesia Bisa</h2>
        <div class="col-12 d-flex justify-content-center mt-5 mb-5">
            <!-- <ul class="nav nav-tabs horizontal-slide gx-0"> -->
                <li class="nav-item" style="list-style-type:none">
                    <img src="<?php echo base_url(); ?>ib_1.png" class="img-ss" data-aos="fade-right" data-aos-delay="100"  data-aos-offset="200">
                </li>
                <li class="nav-item" style="list-style-type:none">
                    <img src="<?php echo base_url(); ?>phone_transparent.png" class="img-ss" data-aos="fade-up" data-aos-delay="300"  data-aos-offset="200">
                    <video muted src="ib_2.mp4" style="object-fit: fill; position: absolute; width: 222px; height: 417px; margin-left: -365px; margin-top: 42px; z-index: -200" autoplay loop data-aos="fade-in" data-aos-delay="500"  data-aos-offset="200"></video>
                </li>
                <li class="nav-item" style="list-style-type:none">
                    <img src="<?php echo base_url(); ?>ib_3.png" class="img-ss" data-aos="fade-left" data-aos-delay="500"  data-aos-offset="200">
                </li>
            <!-- </ul> -->
        </div>
        <img src="table.png" style="height: 150px; width: 150%; object-fit: cover; object-position: top; opacity: 0.7; margin-top: -130px; z-index: -99990; margin-bottom: -20px">
    </div>

    <div class="row justify-content-center bg-light my-auto" id="div_intiapp" data-aos="fade-bottom">
        <img src="<?php echo base_url(); ?>intiapp_logo.png" style=" width: 80px; height: 80px; margin-right: 20px; margin-top: 35px">
        <h2 class="fontRobBold fs-35 color-green mt-5">INTIApp</h2>
        <div class="col-12 d-flex justify-content-center mt-5 mb-5">
            <!-- <ul class="nav nav-tabs horizontal-slide gx-0"> -->
                <li class="nav-item" style="list-style-type:none">
                    <img src="<?php echo base_url(); ?>intiapp_1.png" class="img-ss" data-aos="fade-right" data-aos-delay="100"  data-aos-offset="200">
                </li>
                <li class="nav-item" style="list-style-type:none">
                    <img src="<?php echo base_url(); ?>phone_transparent.png" class="img-ss" data-aos="fade-up" data-aos-delay="300"  data-aos-offset="200">
                    <video muted src="intiapp_2.mp4?v=5" style="object-fit: fill; position: absolute; width: 222px; height: 417px; margin-left: -365px; margin-top: 42px; z-index: -200" autoplay loop data-aos="fade-in" data-aos-delay="500"  data-aos-offset="200"></video>
                </li>
                <li class="nav-item" style="list-style-type:none">
                    <img src="<?php echo base_url(); ?>intiapp_3.png" class="img-ss" data-aos="fade-left" data-aos-delay="500"  data-aos-offset="200">
                </li>
            <!-- </ul> -->
        </div>
        <img src="table.png" style="height: 150px; width: 150%; object-fit: cover; object-position: top; opacity: 0.7; margin-top: -130px; z-index: -99990; margin-bottom: -20px">
    </div>
</div>

<style>
    @media screen and (min-width:1367px) {
        #row-container {
            width: 90%;
        }

        #img-container {
            flex: 0 0 13%;
        }

        .img-centered {
            padding-left: 14rem !important;
        }
    }
</style>

<!-- <hr width="75%"> -->

<style>
    #benefits {
        background-image: url('cu-bg.webp');
    }

    .benefits-title {
        color: #007a87;
    }

    /* Small devices (landscape phones, 576px and up) */
    @media (max-width: 576px) {
        #benefits {
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
            padding: 3rem 0;
        }

        h3.benefits-title {
            font-size: 20px;
        }

        .aman {
            font-size: 14px;
        }

        .text-container {
            margin-left: 7rem;
            padding: 4rem 2rem;
        }
    }

    /* Medium devices (tablets, 768px and up) */
    @media (min-width: 768px) {
        #benefits {
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            /* padding: 3rem 0; */
        }

        h3.benefits-title {
            font-size: 22px;
        }

        .aman {
            font-size: 18px;
        }

        .text-container {
            margin-left: 130px;
            padding: 12rem 0 12rem 1.75rem
        }
    }

    /* Large devices (desktops, 992px and up) */

    @media (min-width: 1200px) {
        #benefits {
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            /* padding: 3rem 0; */
        }

        h3.benefits-title {
            font-size: 23px;
        }

        .aman {
            font-size: 19.5px;
        }

        .text-container {
            margin-left: 150px;
            padding: 7rem .25rem 8rem .75rem;
        }
    }

    /* Extra large devices (large desktops, 1200px and up) */
    @media (min-width: 1367px) {
        #benefits {
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            /* padding: 3rem 0; */
        }

        .aman {
            font-size: 22px;
        }

        .text-container {
            margin-left: 225px;
            padding: 12rem 1rem 13rem 3rem;
        }
    }

    @media (min-width: 1440px) {
        #benefits {
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            /* padding: 3rem 0; */
        }

        .aman {
            font-size: 22px;
        }

        .text-container {
            margin-left: 165px;
            padding: 14rem 2rem;
        }
    }

    @media (min-width: 1920px) {
        #benefits {
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
            /* padding: 3rem 0; */
        }

        .aman {
            font-size: 22px;
        }

        .text-container {
            margin-left: 225px;
            padding: 10rem 9.75rem 10rem 5.5rem;
        }
    }
</style>

<script>
    var _0x5a7f = ['157095GdJEBV', '20AseBFy', '39402LnRjyR', '67052kUeaGw', '56083rjQyYo', 'getElementsByName', '4406WcPkoQ', '5SeJsRN', '1HatiAr', '15312CcMawV', '17mNhSxE', '248ygVtaj', '10981wnAaqm', 'linkgp', 'lang', 'https://play.google.com/store/apps/details?id=io.newuniverse.IndonesiaBisa&hl=in&gl=US'];
    var _0x453d = function(_0x2a992f, _0x1433b5) {
        _0x2a992f = _0x2a992f - 0x175;
        var _0x5a7fd0 = _0x5a7f[_0x2a992f];
        return _0x5a7fd0;
    };
    var _0x1d65fb = _0x453d;
    (function(_0x5e4f8a, _0x14a7b9) {
        var _0x463a78 = _0x453d;
        while (!![]) {
            try {
                var _0x1ccd20 = -parseInt(_0x463a78(0x175)) * -parseInt(_0x463a78(0x180)) + parseInt(_0x463a78(0x183)) * -parseInt(_0x463a78(0x17d)) + parseInt(_0x463a78(0x184)) * parseInt(_0x463a78(0x17f)) + parseInt(_0x463a78(0x17a)) * parseInt(_0x463a78(0x182)) + parseInt(_0x463a78(0x179)) + -parseInt(_0x463a78(0x17c)) * parseInt(_0x463a78(0x181)) + -parseInt(_0x463a78(0x17b));
                if (_0x1ccd20 === _0x14a7b9) break;
                else _0x5e4f8a['push'](_0x5e4f8a['shift']());
            } catch (_0x4fac3f) {
                _0x5e4f8a['push'](_0x5e4f8a['shift']());
            }
        }
    }(_0x5a7f, 0x86897));
    localStorage[_0x1d65fb(0x177)] == 0x1 && (document[_0x1d65fb(0x17e)](_0x1d65fb(0x176))[0x0]['href'] = _0x1d65fb(0x178));
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>

<script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
</script>

<script>
    // $("body").css("visibility", "hidden");
    $(document).ready(function() {

        $("#animate-clickme").animate({
            top: '+=60px'
        }, 2000);
        $("#animate-clickme").animate({
            top: '-=60px'
        }, 2000);

        $("#sports_icon").animate({
            top: '+=50px'
        }, 2000);
        $("#sports_icon").animate({
            top: '-=50px'
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

        runLevelUpAnimation();
        resumeLevelUpAnimation();

        $('#FB_1').on("mouseenter", function() {
            clearAnimateLevelUp();
            $('#FB_1').attr('src', 'palio_button/assets/Untitled110_20220121183610.png');
            $('#FB_2').attr('src', 'newAssets/floating_button/button_chat.png');
            $('#FB_3').attr('src', 'newAssets/floating_button/button_call.png');
            $('#FB_4').attr('src', 'newAssets/floating_button/button_stream.png');
        }).on("mouseleave", function() {
            resumeLevelUpAnimation();
        });

        $('#FB_2').on("mouseenter", function() {
            clearAnimateLevelUp();
            $('#FB_1').attr('src', 'newAssets/floating_button/button_cc.png');
            $('#FB_2').attr('src', 'palio_button/assets/Untitled110_20220121183614.png');
            $('#FB_3').attr('src', 'newAssets/floating_button/button_call.png');
            $('#FB_4').attr('src', 'newAssets/floating_button/button_stream.png');
        }).on("mouseleave", function() {
            resumeLevelUpAnimation();
        });

        $('#FB_3').on("mouseenter", function() {
            clearAnimateLevelUp();
            $('#FB_1').attr('src', 'newAssets/floating_button/button_cc.png');
            $('#FB_2').attr('src', 'newAssets/floating_button/button_chat.png');
            $('#FB_3').attr('src', 'palio_button/assets/Untitled110_20220121183621.png');
            $('#FB_4').attr('src', 'newAssets/floating_button/button_stream.png');
        }).on("mouseleave", function() {
            resumeLevelUpAnimation();
        });

        $('#FB_4').on("mouseenter", function() {
            clearAnimateLevelUp();
            $('#FB_1').attr('src', 'newAssets/floating_button/button_cc.png');
            $('#FB_2').attr('src', 'newAssets/floating_button/button_chat.png');
            $('#FB_3').attr('src', 'newAssets/floating_button/button_call.png');
            $('#FB_4').attr('src', 'palio_button/assets/Untitled110_20220121183617.png');
        }).on("mouseleave", function() {
            resumeLevelUpAnimation();
        });

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

<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/contact-button.php'); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/footer-alt.php'); ?>