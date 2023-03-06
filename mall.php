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
            /* width: 30% !important; */
            height: 55vh;
            margin: 0 .5em;
            /* margin: 0 auto; */
        }
    }

    @media (max-width: 600px) {
        .store {
            max-width: 175px !important;
            /* margin-left: 13px; */
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
            /* width: 30% !important; */
            height: 30vh;
            margin: 0 auto;
        }

        #head-img {
            padding: 0;
        }

        .img-ss {
            height: 300px;
            width: auto;
        }
    }

    .productBanner-alt {
        background-image: url('newAssets/product/bi7.webp') !important;
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
            font-size: 35px !important;
        }

        .img-ss {
            height: 450px;
            width: auto;
        }
    }



    ul.desc-list {
        padding-left: inherit;
    }
</style>

<header class="productBanner-alt">
    <div class="row px-5 pt-5 mb-5 mt-3" data-aos="fade-up">
        <div class="col-sm-12 d-flex justify-content-center" id="head-img">
            <img src="<?php echo base_url(); ?>newAssets/mall_ss/mall_1.webp" alt="" class="img-fluid align-self-center head-mbl">
            <img src="<?php echo base_url(); ?>newAssets/mall_ss/mall_2.webp" alt="" class="img-fluid align-self-center head-mbl">
        </div>
    </div>
    <div class="row">
        <div class="col-sm-8 mx-auto text-center" data-aos="fade-up">
            <h1 data-translate="mall-1" class="mb-3 fontRobBold fs-35" style="color:#262626;"></h1>
            <p data-translate="mall-2" class="fs-20" style="font-family: 'Josefin Sans'; font-weight: 300 !important; color: #262626;"></p>
            <div class="row">
                <div class="col-11 pl-0 mx-auto">
                    <span data-translate="mall-20"></span>
                    <!-- <img class="store" src="ucaas_assets\img\app_store_editedx.png" style="max-width:185px; height: 52px;"> -->
                </div>
            </div>
        </div>
    </div>
</header>

<div class="container-fluid" id="features-list">
    <div class="row justify-content-center my-auto" data-aos="fade-right">
        <div class="col-md-11">
            <div class="row">
                <div class="col-md-7 order-md-2 text-center mx-auto">
                    <img src="<?php echo base_url(); ?>newAssets/mall_ss/mall_3.webp" class="img-ss">
                    <img src="<?php echo base_url(); ?>newAssets/mall_ss/mall_4.webp" class="img-ss">
                    <img src="<?php echo base_url(); ?>newAssets/mall_ss/mall_5.webp" class="img-ss">
                </div>
                <div class="col-md-5 order-md-1 features-desc my-auto mx-auto">
                    <h2 data-translate="mall-3" class="fontRobBold fs-35 color-green"></h2>
                    <br>
                    <ul class="desc-list">
                        <li>
                            <h3 class="fs-24 fontRobReg product-desc">
                                <span data-translate="mall-4"></span>
                            </h3>
                        </li>
                        <li>
                            <h3 class="fs-24 fontRobReg product-desc">
                                <span data-translate="mall-5"></span>
                            </h3>
                        </li>
                        <li>
                            <h3 class="fs-24 fontRobReg product-desc">
                                <span data-translate="mall-6"></span>
                            </h3>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
    <div class="row justify-content-center bg-light my-auto" data-aos="fade-left">
        <div class="col-md-11">
            <div class="row">
                <div class="col-md-5 order-md-1  text-center mx-auto">
                    <img src="<?php echo base_url(); ?>newAssets/mall_ss/mall_6.webp" class="img-ss">
                    <img src="<?php echo base_url(); ?>newAssets/homepage/livestreaming.gif" class="img-ss">
                </div>
                <div class="col-md-5 order-md-2 features-desc my-auto mx-auto">
                    <h2 data-translate="mall-7" class="fontRobBold fs-35 color-green"></h2>
                    <br>
                    <ul class="desc-list">
                        <li>
                            <h3 class="fs-24 fontRobReg product-desc">
                                <span data-translate="mall-8"></span>
                            </h3>
                        </li>
                        <li>
                            <h3 class="fs-24 fontRobReg product-desc">
                                <span data-translate="mall-9"></span>
                            </h3>
                        </li>
                        <li>
                            <h3 class="fs-24 fontRobReg product-desc">
                                <span data-translate="mall-10"></span>
                            </h3>
                        </li>
                        <!-- <li>
                            <h3 class="fs-24 fontRobReg product-desc">
                                <span data-translate="mall-11"></span>
                            </h3>
                        </li>
                        <li>
                            <h3 class="fs-24 fontRobReg product-desc">
                                <span data-translate="mall-12"></span>
                            </h3>
                        </li> -->
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center my-auto" data-aos="fade-right">
        <div class="col-md-11">
            <div class="row">
                <div class="col-md-7 order-md-2  text-center mx-auto">
                    <img src="<?php echo base_url(); ?>newAssets/CCx_7.png" class="img-ss">
                    <!-- <img src="<?php //echo base_url(); 
                                    ?>newAssets/ib_ss/Picture06.webp" class="img-ss ss-mbl"> -->
                    <!-- <img src="<?php //echo base_url(); 
                                    ?>newAssets/ib_ss/Picture07.webp" class="img-ss ss-mbl"> -->
                </div>
                <div class="col-md-5 order-md-1 features-desc my-auto mx-auto">
                    <h2 data-translate="mall-13" class="fontRobBold fs-35 color-green"></h2>
                    <br>
                    <ul class="desc-list">
                        <li>
                            <h3 class="fs-24 fontRobReg product-desc mb-4">
                                <span data-translate="mall-14"></span>
                            </h3>
                        </li>
                        <li>
                            <h3 class="fs-24 fontRobReg product-desc">
                                <span data-translate="mall-15"></span>
                            </h3>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center bg-light my-auto" data-aos="fade-left">
        <div class="col-md-10">
            <div class="row">
                <!-- <div class="col-md-7 order-md-1 text-center mx-auto"> -->
                <!-- <img src="<?php //echo base_url(); 
                                ?>newAssets/ib_ss/Picture08.webp" class="img-ss ss-mbl">
                        <img src="<?php //echo base_url(); 
                                    ?>newAssets/ib_ss/Picture09.webp" class="img-ss ss-mbl"> -->
                <!-- </div> -->
                <div class="col-md-8 order-md-2 features-desc my-auto mx-auto">
                    <h2 data-translate="mall-16" class="fontRobBold fs-35 color-green"></h2>
                    <br>
                    <ul class="desc-list">
                        <li>
                            <h3 class="fs-24 fontRobReg product-desc">
                                <span data-translate="mall-17"></span>
                            </h3>
                        </li>
                        <li>
                            <h3 class="fs-24 fontRobReg product-desc">
                                <span data-translate="mall-18"></span>
                            </h3>
                        </li>
                        <li>
                            <h3 class="fs-24 fontRobReg product-desc">
                                <span data-translate="mall-19"></span>
                            </h3>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="practical" class="container-fluid py-4 my-4">
    <div class="row justify-content-center mb-4 mx-0">
        <div class="col-md-9 text-center">
            <p data-translate="mall-21" class="fontRobBold fs-35"></p>
            <!-- <p data-translate="newpricing-24" class="fs-20" style="font-family: 'Josefin Sans'; font-weight: 300 !important;">
            </p>

            <p data-translate="newpricing-25" class="fs-20" style="font-family: 'Josefin Sans'; font-weight: 300 !important;"></p> -->
        </div>
    </div>

    <div class="row justify-content-center mx-0">
        <div class="col-sm-10 mobile-practical">
            <style>
                #nusdklite-small-tabs .nav-tabs {
                    overflow-x: auto;
                    overflow-y: hidden;
                    flex-wrap: nowrap;
                }

                #nusdklite-small-tabs .nav {
                    border-radius: 10px 10px 0 0;
                }

                #nusdklite-small-tabs .nav-tabs>li {
                    float: none;
                }

                @media screen and (min-width: 992px) {
                    #nusdklite-small-tabs .nav-tabs>li {
                        min-width: 50%;
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
                    background-color: #005d62;
                }

                .nav-item .code-link span.super {
                    font-weight: bold;
                }
            </style>

            <div id="nusdklite-small-tabs">
                <ul class="nav nav-tabs border-0 d-flex justify-content-between">

                    <li class="nav-item">
                        <a id="merchant-website-tab" class="code-link active text-decoration-none d-flex justify-content-center" data-toggle="tab" href="#merchant-website" role="tab">
                            <span data-translate="mall-22" class="fontRobReg super fs-16 text-center m-0"></span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a id="buyer-tab" class="code-link text-decoration-none d-flex justify-content-center" data-toggle="tab" href="#buyer" role="tab">
                            <span data-translate="mall-23" class="fontRobReg super fs-16 text-center m-0" id="mainactivity-title"></span>
                        </a>
                    </li>

                </ul>
            </div>
            <div class="tab-pane active text-center" id="merchant-website">
                <img src="/newAssets/merchant_website.webp" class="mt-5" style="width: 700px; height: auto;" />
            </div>
            <div class="tab-pane text-center d-none" id="buyer">
                <img src="/newAssets/pembeli.webp" class="mt-5" style="width: 700px; height: auto;" />
            </div>
        </div>
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

<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/contact-button.php'); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/footer-alt.php'); ?>