<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    
    <!--====== Title ======-->
    <title>GoToMalls</title>
    
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--====== Favicon Icon ======-->
    <!-- <link rel="shortcut icon" href="assets/images/favicon.png" type="image/png"> -->
        
    <!--====== Magnific Popup CSS ======-->
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
        
    <!--====== Slick CSS ======-->
    <link rel="stylesheet" href="assets/css/slick.css">
        
    <!--====== Line Icons CSS ======-->
    <link rel="stylesheet" href="assets/css/LineIcons.css">
        
    <!--====== Bootstrap CSS ======-->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    
    <!--====== Default CSS ======-->
    <link rel="stylesheet" href="assets/css/default.css">
    
    <!--====== Style CSS ======-->
    <link rel="stylesheet" href="assets/css/style.css">

	<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>

    <style>

        body{
            font-family: "Poppins";
        }

        .navbar-area.sticky .navbar .navbar-btn li a.solid {
            border-color: #f14545;
            background-color: #f14545;
            color: #fff;
        }

        .rounded-buttons .rounded-two {
            color: #fff;
            background-color: #1c1c1c;
            border-color: #f14545;
        }

        .navbar-area .navbar .navbar-btn li a {
            border-radius: 100px;
        }

        .back-to-top {
            color: #fff;
            background-color: #1c1c1c;
        }

        .back-to-top:hover {
            color: #fff;
            background-color: #1c1c1c;
        }

        .slider-content .slider-btn li a.rounded-one {
            color: #f14545; 
        }

        .slider-content .slider-btn li a.rounded-one:hover {
          background-color: transparent;
          color: #fff; 
        }

        .slider-content .slider-btn li a.rounded-two {
            background-color: #000000;
            color: #fff;
        }

        .slider-content .slider-btn li a.rounded-two:hover {
          background-color: #f14545;
          color: #fff; 
        }

        .navbar-area.sticky .navbar .navbar-btn li a.solid{
            background-color: white; 
            color: #f14545;
        }

        .navbar-area.sticky .navbar .navbar-btn li a.solid:hover{
            background-color: #f14545; 
            color: white;
        }

        .btn-contactus{
            color: #f14545; 
            border-radius: 50px; 
            font-weight: 700; 
            font-size: 16px; 
            padding: 10px 32px;
            border: 2px solid #f14545;
        }
        
        .btn-contactus:hover{
            color: #FFFFFF;
            background-color: #f14545; 
        }

        @media screen and (max-width:768px) {

            .slider-content{
                height: 1000px;
                text-align: center;
            }

            #phone-main-mobile{
                display: block;
            }
        }

        @media screen and (max-width:768px) {

            .slider-content{
                height: 1000px;
            }

            #phone-1{
                width: 420px;
                margin-top: -164px;
                margin-left: -4px;
                height: 825px;
            }

            #phone-2{
                width: 420px;
                margin-top: -164px;
                margin-left: -4px;
                height: 825px;
            }

            #phone-cover-1{
                max-width: 500px; 
                height: auto;
            }

            #phone-cover-2{
                max-width: 500px; 
                height: auto;
            }

            #phone-main-mobile{
                display: block;
                position: absolute;
                width: 100%;
                margin-top: -550px;
                z-index: 0;
            }
        }

        @media screen and (min-width:768px) {

            #phone-1{
                width: 585px; 
                height: 1150px; 
                margin-left: -5px; 
                margin-top: -225px; 
            }

            #phone-2{
                width: 585px; 
                height: 1150px; 
                margin-left: -5px; 
                margin-top: -225px; 
            }

            #phone-cover-1{
                max-width: 700px; 
                height: 700px;
            }

            #phone-cover-2{
                max-width: 700px; 
                height: 700px;
            }

            #phone-main-mobile{
                display: none;
                z-index: 1000;
            }
        }

        html,
		body {
			max-width: 100%;
			overflow-x: hidden;
		}

    </style>
    
</head>

<body>
    <section class="navbar-area sticky">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg">
                       
                        <a class="navbar-brand" href="#">
                            <!-- <img src="assets/images/logo.svg" alt="Logo"> -->
                            <div class="row">
                                <img src="assets/images/appIcon.png" style="width: 50px; height: 50px; margin-left: 10px">
                                <h2 style="color: #1c1c1c; margin-left: 15px">GoToMalls</h2>
                            </div>
                        </a>
                        
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTwo" aria-controls="navbarTwo" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse sub-menu-bar" id="navbarTwo">
                            <ul class="navbar-nav m-auto">
                                <li class="nav-item active"><a class="page-scroll" href="#home">Home</a></li>
                                <li class="nav-item"><a class="page-scroll" href="#features">Features</a></li>
                                <li class="nav-item"><a class="page-scroll" href="#apps-preview">Apps Preview</a></li>
                                <!-- <li class="nav-item"><a class="page-scroll" href="#contact">Contact</a></li> -->
                            </ul>
                        </div>
                        
                        <div class="navbar-btn d-none d-sm-inline-block">
                            <ul>
                                <li><a class="solid btn-download" href="#">Download</a></li>
                            </ul>
                        </div>
                    </nav> <!-- navbar -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>
    
    <!--====== SLIDER PART START ======-->

    <section id="home" class="slider_area">
        <div id="carouselThree" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselThree" data-slide-to="0" class="active"></li>
                <!-- <li data-target="#carouselThree" data-slide-to="1"></li> -->
            </ol>

            <div class="carousel-inner">
                <div class="carousel-item active" style="background-color: #f14545">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="slider-content">
                                    <h1 class="title">New shop apps has been launch!</h1>
                                    <p class="text">Apps description must be written here</p>
                                    <ul class="slider-btn rounded-buttons">
                                        <li><a class="main-btn rounded-one" href="#">Get Started</a></li>
                                        <li><a class="main-btn rounded-two" href="#">DOWNLOAD</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div> <!-- row -->
                    </div> <!-- container -->
                    <div class="slider-image-box d-none d-lg-flex align-items-end">
                        <div class="slider-image">
                            <!-- <img src="assets/images/slider/1.png" alt="Hero"> -->
                            <img src="assets/images/new-phone.png" id="phone-main" style="margin-bottom: 100px" alt="Hero">
                            <!-- <img src="assets/images/phone-capture.png" style="position: absolute; width: 250px; height: 470px; margin-left: -400px"> -->
                        </div> <!-- slider-imgae -->
                    </div> <!-- slider-imgae box -->

                    <img src="assets/images/new-phone.png" id="phone-main-mobile" style="margin-bottom: 100px" alt="Hero">
                </div> <!-- carousel-item -->
            </div>

            <!-- <a class="carousel-control-prev" href="#carouselThree" role="button" data-slide="prev">
                <i class="lni lni-arrow-left"></i>
            </a>
            <a class="carousel-control-next" href="#carouselThree" role="button" data-slide="next">
                <i class="lni lni-arrow-right"></i>
            </a> -->
        </div>
    </section>

    <!--====== SLIDER PART ENDS ======-->
    
    <!--====== FEATRES TWO PART START ======-->

    <section id="features" class="features-area">
        <div class="container">
            <h2 class="text-center mb-5">Features</h2>
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-6 col-md-2">
                    <img src="assets/images/fb1.png">
                    <p class="text-center mt-2"><b>Features 1</b></p>
                    <p class="text-center mt-3" style="color: grey">Written features description</p>
                </div>
                <div class="col-6 col-md-2">
                    <img src="assets/images/fb2.png">
                    <p class="text-center mt-2"><b>Features 2</b></p>
                    <p class="text-center mt-3" style="color: grey">Written features description</p>
                </div>
                <div class="col-6 col-md-2">
                    <img src="assets/images/fb3.png">
                    <p class="text-center mt-2"><b>Features 3</b></p>
                    <p class="text-center mt-3" style="color: grey">Written features description</p>
                </div>
                <div class="col-6 col-md-2">
                    <img src="assets/images/fb4.png">
                    <p class="text-center mt-2"><b>Features 4</b></p>
                    <p class="text-center mt-3" style="color: grey">Written features description</p>
                </div>
                <div class="col-6 col-md-2">
                    <img src="assets/images/fb5.png">
                    <p class="text-center mt-2"><b>Features 5</b></p>
                    <p class="text-center mt-3" style="color: grey">Written features description</p>
                </div>
                <div class="col-md-1"></div>
            </div>
            
        </div> <!-- container -->
    </section>

    <!--====== FEATRES TWO PART ENDS ======-->
    
    <!--====== PORTFOLIO PART START ======-->

    <section id="apps-preview" class="portfolio-area portfolio-four pb-100">
        <h2 class="text-center">Apps Preview</h2>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-12 col-md-4 d-flex justify-content-center">
                <img src="assets/images/phone.png" id="phone-cover-1">
                <iframe id="phone-1" src="../nexilis/pages/tab1-main?f_pin=02e1a6e817" style="position: absolute; -webkit-transform:scale(0.5);-moz-transform-scale(0.5);"></iframe>
            </div>
            <div class="col-12 col-md-4 d-flex justify-content-center">
                <img src="assets/images/phone.png" id="phone-cover-2">
                <iframe id="phone-2" src="../nexilis/pages/tab3-main?f_pin=02e1a6e817" style="position: absolute; -webkit-transform:scale(0.5);-moz-transform-scale(0.5);"></iframe>
            </div>
            <div class="col-md-2"></div>
        </div> <!-- container -->
        <p class="text-center mt-3" style="color: grey">You can operate this phone to explore GoToMalls previews.</p>
    </section>

    <!--====== PORTFOLIO PART ENDS ======-->
    
    <!--====== PRINICNG START ======-->

    <!-- <section id="pricing" class="pricing-area ">
        <div class="container">
            
        </div>
    </section> -->

    <!--====== PRINICNG ENDS ======-->
    
    <!--====== ABOUT PART START ======-->

    <!-- <section id="about" class="about-area">
        <div class="container">
            
        </div>
    </section> -->

    <!--====== ABOUT PART ENDS ======-->
    
    <!--====== FOOTER PART START ======-->

    <section id="contact" class="footer-dark" style="background-color: #000000">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="footer-logo text-center">
                        <a class="mt-30" href=""><img src="assets/images/appIcon.png" alt="Logo" style="width: 90px"></a><br>
                        <p class="mt-3" style="color: #FFFFFF; font-size: 24px"><b>GoToMalls</b></p>
                        <button class="btn btn-light mt-5 btn-contactus">CONTACT US</button>
                    </div> <!-- footer logo -->
                    <ul class="social text-center mt-60">
                        <!-- <li><a href="https://facebook.com/uideckHQ"><i class="lni lni-facebook-filled"></i></a></li>
                        <li><a href="https://twitter.com/uideckHQ"><i class="lni lni-twitter-original"></i></a></li>
                        <li><a href="https://instagram.com/uideckHQ"><i class="lni lni-instagram-original"></i></a></li>
                        <li><a href="#"><i class="lni lni-linkedin-original"></i></a></li> -->
                    </ul> <!-- social -->
                    <div class="footer-support text-center" style="color: #FFFFFF">
                        <span class="number">Phone : +081234567890</span><br>
                        <span class="mail">Email : support@gotomalls.com</span>
                    </div>
                    <div class="copyright text-center mt-35" style="color: grey; font-size: 12px; margin-bottom: 60px">
                        <!-- <p class="text">Designed by <a href="https://uideck.com" rel="nofollow">UIdeck</a> and Built-with <a rel="nofollow" href="https://ayroui.com">Ayro UI</a> </p> -->
                        <span>Privacy Policy</span> | <span>Terms of Service</span>
                    </div> <!--  copyright -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>

    <!--====== FOOTER PART ENDS ======-->
    
    <!--====== BACK TOP TOP PART START ======-->

    <a href="#" class="back-to-top"><i class="lni lni-chevron-up"></i></a>

    <!--====== BACK TOP TOP PART ENDS ======-->    

    <!--====== PART START ======-->

<!--
    <section class="">
        <div class="container">
            <div class="row">
                <div class="col-lg-">
                    
                </div>
            </div>
        </div>
    </section>
-->

    <!--====== PART ENDS ======-->




    <!--====== Jquery js ======-->
    <script src="assets/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="assets/js/vendor/modernizr-3.7.1.min.js"></script>
    
    <!--====== Bootstrap js ======-->
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    
    <!--====== Slick js ======-->
    <script src="assets/js/slick.min.js"></script>
    
    <!--====== Magnific Popup js ======-->
    <script src="assets/js/jquery.magnific-popup.min.js"></script>
    
    <!--====== Ajax Contact js ======-->
    <script src="assets/js/ajax-contact.js"></script>
    
    <!--====== Isotope js ======-->
    <script src="assets/js/imagesloaded.pkgd.min.js"></script>
    <script src="assets/js/isotope.pkgd.min.js"></script>
    
    <!--====== Scrolling Nav js ======-->
    <script src="assets/js/jquery.easing.min.js"></script>
    <script src="assets/js/scrolling-nav.js"></script>
    
    <!--====== Main js ======-->
    <script src="assets/js/main.js"></script>
    
</body>

</html>
