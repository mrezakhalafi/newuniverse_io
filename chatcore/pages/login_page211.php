<?php

// WHEN USER OPEN THIS PAGE, CREATE QR CODE
// IF USER SCANS THE QR CODE, CHECK USER STATUS AND REDIRECT TO CHAT_PAGE
include_once($_SERVER['DOCUMENT_ROOT'] . '/chatcore/logics/login_chat.php');

$env = $_GET['env'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <!--  This file has been downloaded from bootdey.com    @bootdey on twitter -->
  <!--  All snippets are MIT license http://bootdey.com/license -->
  <title>Qmera Web Chat</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"> -->
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
  <style type="text/css">
    body {
      margin: 0px;
      height: 100%;
      width: 100%;
      position: absolute;
      background: #ffffff;
    }

    .content {
      margin: auto;
      width: 65%;
      text-align: center;
      background: white;
      margin-top: 100px;
      padding: 64px 60px 110px;
      box-shadow: 0 17px 50px 0 rgba(0, 0, 0, .19), 0 12px 15px 0 rgba(0, 0, 0, .24);
      border-radius: 4px;
    }

    .content img {
      width: 100%;
      box-shadow: 2px 1px 4px 1px;

    }

    .back {
      background: #FFFFFF;
      width: 100%;
      height: 222px;
    }

    .co {
      width: 100%;
      position: absolute;
    }

    .bc {
      display: flex;
    }

    .kiri {
      max-width: 556px;
      float: left;
    }

    .kanan {
      max-width: 264px;
      margin-left: 200px;
      float: left;
    }

    .title {
      color: #55636b;
      font-size: 28px;
      font-weight: 300;
      line-height: normal;
      vertical-align: baseline;
      text-align: left;
      margin-bottom: 52px;
      font-family: Segoe UI, Helvetica Neue, Helvetica, Lucida Grande, Arial, Ubuntu, Cantarell, Fira Sans, sans-serif;
    }

    ._1TxZR {
      text-align: left;
      padding: 0 0 0 24px;
      margin: 0;

      list-style: none;
      list-style-type: decimal;
      font: inherit;
      font-size: inherit;
      font-size: 100%;
      vertical-align: baseline;
      outline: none;
      font-family: Segoe UI, Helvetica Neue, Helvetica, Lucida Grande, Arial, Ubuntu, Cantarell, Fira Sans, sans-serif;
      color: #4b4b4b;
      text-rendering: optimizeLegibility;
      font-size: 18px;
      line-height: 28px;

    }

    li {
      margin-top: 18px;
    }

    .logo img {
      width: auto;
      height: 80px;
    }

    .logo {
      width: 78%;
      margin: auto;
      padding-top: 20px;
    }

    .logo a {
      text-decoration: none;
      font-family: Segoe UI, Helvetica Neue, Helvetica, Lucida Grande, Arial, Ubuntu, Cantarell, Fira Sans, sans-serif;
      color: white;
      font-size: 12px;
    }

    .l {
      float: left;
      background-color: #FFFFFF;
      border-radius: 80px;
      padding: 1px 2px;
    }

    .j {
      float: left;
      padding-left: 10px;
      font-style: bold;
    }

    #qr>img {
      width: 100%;
      height: 100%;
      -webkit-box-shadow: none;
    }

    .bg {
      background-color: #6945a5;
    }
  </style>
  <script type="text/javascript" src="../assets/js/jquery.min.js"></script>
  <script src="../assets/js/qrcode.js"></script>
</head>

<body>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <body class="bg">

    <div class="co">
      <div style="margin-top: 100px;" class="container bg-white w-75 p-5 shadow">
        <div class="row m-lg-4">
          <div class="col-md-8 order-2">
            <div class="title">To use <?php if ($_GET["env"] == '0') { 
                  echo "catchUp";
                } else { 
                  echo "Qmera Lite";
                }
                ?> on your computer:</div>
            <!-- LIST PENGGUNAAN-->
            <ol class="_1TxZR mb-5">
              <li>Open your 
                <?php if ($_GET["env"] == '0') { 
                  echo "catchUp";
                } else { 
                  echo "Qmera Lite";
                }
                ?> mobile app.</li>
              <li>Open settings menu by pressing 
              <?php if ($_GET["env"] == '0') { 
                  echo "catchUp logo on the upper left corner, and go to \"Login to catchUp Web\".";
                } else { 
                  echo "burger menu on the upper right corner, go to \"Settings\", and go to \"Login to Qmera Web\".";
                }
                ?></li>
              <li>Aim your phone camera to the QR Code</li>
            </ol>

            <h4>Note:</h4>
            <ul class="_1TxZR">
              <li>For the best experience use Chrome Browser.</li>
              <li>If you haven't installed 
                <?php if ($_GET["env"] == '0') { 
                  echo "catchUp";
                } else { 
                  echo "Qmera Lite";
                }
                ?>, please do so.</li>
            </ul>

            <?php if ($_GET["env"] == '0') { ?>
              <a name="linkgp" href="https://play.google.com/store/apps/details?id=io.newuniverse.catchup" target="_blank"><img alt="Get it on Google Play" src="https://play.google.com/intl/en_us/badges/static/images/badges/en_badge_web_generic.png" style="max-width: 200px;" /></a>
            <?php } ?>
            <!-- <img class="store" src="..\..\ucaas_assets\img\app_store_editedx.png" style="max-width:185px; height: 52px;"> -->
          </div>
          <!-- QR CODE -->
          <div class="col-md-4 order-lg-2 mb-5">
            <div id="qr"></div>
            <div class="loader logo" id="loader"></div>
          </div>
        </div>
      </div>
    </div>
    <!-- LOGO ATAS-->
    <div class="back">
      <div class="logo">
      <?php if ($_GET["env"] == '0') { ?>
        <img src="../assets/img/cu_logo.webp" id="logoImg">
        <?php } else { ?>
          <img src="../assets/img/palio.png" id="logoImg">
          <?php } ?>
      </div>
    </div>
    <script>
      new QRCode(document.getElementById("qr"), "<?php echo $_SESSION['web_login']; ?>");
    </script>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript">
      $(function() {
        $(".heading-compose").click(function() {
          $(".side-two").css({
            "left": "0"
          });
        });

        $(".newMessage-back").click(function() {
          $(".side-two").css({
            "left": "-100%"
          });
        });
      })
    </script>
    <?php if($env == 0){ ?>
      <script type="text/javascript">localStorage.setItem("env", 0);</script>
    <?php } else { ?>
      <script type="text/javascript">localStorage.setItem("env", 1);</script>
    <?php } ?>
    <script src="../assets/js/fetch_user_status.js"></script>
    <script>
      console.log(document.getElementById("qr").getAttribute("title"));
    </script>
  </body>

</html>