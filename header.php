<?php 

  $version = 'v=1.20';

?>


<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Api Web</title>

  
  <!-- <script type="text/javascript" src="./js/jquery-3.4.1.min.js"></script> -->

  <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

  <!-- AOS -->
  <link rel="stylesheet" type="text/css" href="./css/aos.css">
  <script type="text/javascript" src="./js/aos.js"></script>


  <!-- Core -->
  <script language="JavaScript" type="text/javascript" src="core/message/hmc.js?v=1.3.2.40"></script>
  <script language="JavaScript" type="text/javascript" src="core/app/app.js?v=1.3.2.40"></script>
  <script language="JavaScript" type="text/javascript" src="core/app/wsc.js?v=1.3.2.40"></script>
  <script language="JavaScript" type="text/javascript" src="core/app/jprocess.js?<?php echo($version); ?>"></script>
  <script language="JavaScript" type="text/javascript" src="core/app/jprocess_sync.js?v=1.3.2.40"></script>
  <script language="JavaScript" type="text/javascript" src="core/app/juploader.js?v=1.3.2.40"></script>
  <script language="JavaScript" type="text/javascript" src="core/my-lib.js?v=1.3.2.40"></script>
  <script language="JavaScript" type="text/javascript" src="core/message/message.js?v=1.3.2.40"></script>
  <script language="JavaScript" type="text/javascript" src="core/message/dataheadercontent.js?v=1.3.2.40"></script>
  <script language="JavaScript" type="text/javascript" src="core/message/sender.js?v=1.3.2.40"></script>
  <script language="JavaScript" type="text/javascript" src="core/message/receiver.js?<?php echo($version); ?>"></script>
  <script type="text/javascript" src="core/my-lib.js?v=1.3.2.40"></script>
  <script type="text/javascript" src="core/my-component.js?v=1.3.2.40"></script>
  <script type="text/javascript" src="core/message/message.js?v=1.3.2.40"></script>
  <script type="text/javascript" src="core/message/sender.js?v=1.3.2.40"></script>
  <script src="js/api_web.js?<?php echo($version); ?>"></script>

  <!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->


  <!-- code prettify -->
  <script type="text/javascript" src="./js/prettify.js"></script>
  <script type="text/javascript" src="./js/lang-kotlin.js"></script>
  <!-- <link rel="stylesheet" type="text/css" href="./css/prettify.css"> -->

  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">

  <!-- Bootstrap core CSS -->
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!--ROBOTO-->
  <link rel="stylesheet" href="./assets/fonts/roboto/style.css">

  <!-- POPPINS -->
  <link rel="stylesheet" href="./assets/fonts/poppins/style.css">

  <!-- SEGOE -->
  <link rel="stylesheet" href="./assets/fonts/segoe-ui/style.css">

  <!-- Custom styles for this template -->
  <link rel="stylesheet" type="text/css" href="./css/animate.css">
  <link rel="stylesheet" type="text/css" href="./css/api_web.css">
  <link rel="stylesheet" type="text/css" href="./css/custom.css">

  <!-- Owl Carousel -->
  <link rel="stylesheet" type="text/css" href="./css/owl.carousel.css">
  <link rel="stylesheet" type="text/css" href="./css/owl.theme.default.css">
  <script type="text/javascript" src="./js/owl.carousel.js"></script>

  <!-- Clipboard.js -->
  <script type="text/javascript" src="./js/clipboard.min.js"></script>


</head>

<body data-spy="scroll" data-target=".navbar" onload="PR.prettyPrint()" style="overflow-x: hidden;">

  <!-- Navigation -->
  <nav class="navbar navbar-expand-md navbar-dark fixed-top px-0" id="navtop">
    <div class="container" style="max-width: 90%">
      <a class="navbar-brand fontRobReg" href="index.php">
        <img src="./assets/new-u-logo.svg" id="logoImg">
      </a>
      <button class="navbar-toggler navbar-toggler-right" style="background-color: #213458;" type="button" data-toggle="collapse" data-target="#navbar-section" aria-controls="navbar-section" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbar-section">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item dropdown position-static">
            <a class="nav-link nav-menu-link text-dark dropdown-toggle fontRobReg  fs-18" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Products</a>
            <div class="dropdown-menu py-2 w-100">
              <div class="d-lg-flex justify-content-around w-100">
                  <div class="col d-flex justify-content-start text-left text-lg-center p-0">
                    <a class="dropdown-item fontRobReg fs-18 py-2" href="livestream.php" style="display: inline;  color: #03528C;">Live Streaming</a> 
                  </div>
                  <div class="col d-flex justify-content-start text-left text-lg-center p-0">
                    <a class="dropdown-item fontRobReg fs-18 py-2" href="videocall.php" style="display: inline;  color: #03528C;">Video Call</a>
                  </div>
                  <div class="col d-flex justify-content-start text-left text-lg-center p-0">
                    <a class="dropdown-item fontRobReg fs-18 py-2" href="voip.php" style="display: inline;  color: #03528C;">Audio Call</a>
                  </div>
                  <div class="col d-flex justify-content-start text-left text-lg-center p-0">
                    <a class="dropdown-item fontRobReg fs-18 py-2" href="screenshare.php" style="display: inline;  color: #03528C;">Screen Sharing</a>
                  </div>
                  <div class="col d-flex justify-content-start text-left text-lg-center p-0">
                    <a class="dropdown-item fontRobReg fs-18 py-2" href="whiteboard.php" style="display: inline;  color: #03528C;">Whiteboarding</a>
                  </div>
                  <div class="col d-flex justify-content-start text-left text-lg-center p-0">
                    <a class="dropdown-item fontRobReg fs-18 py-2" href="im.php" style="display: inline;  color: #03528C;">Unified Messaging</a>
                  </div>
                  <div class="col d-flex justify-content-start text-left text-lg-center p-0">
                    <a class="dropdown-item fontRobReg fs-18 py-2" href="chatbot.php" style="display: inline;  color: #03528C;">ChatBot</a>
                  </div>
              </div>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link nav-menu-link text-dark fontRobReg fs-18" href="usecase.php">Use Case</a>
          </li>
          <li class="nav-item">
            <a class="nav-link nav-menu-link text-dark fontRobReg fs-18" href="newpricing.php">Pricing</a>
          </li>
          <li class="nav-item">
            <a class="btn nav-menu-btn" href="login.php">Login</a>
          </li>
          <li class="nav-item">
            <a class="btn nav-menu-btn" href="contactus.php">Contact Us</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>