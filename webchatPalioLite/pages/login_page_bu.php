<?php

// WHEN USER OPEN THIS PAGE, CREATE QR CODE
// IF USER SCANS THE QR CODE, CHECK USER STATUS AND REDIRECT TO CHAT_PAGE
include_once($_SERVER['DOCUMENT_ROOT'] . '/webchat/logics/login_chat.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <!--  This file has been downloaded from bootdey.com    @bootdey on twitter -->
  <!--  All snippets are MIT license http://bootdey.com/license -->
  <title>Palio Web Chat</title>
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
      background-color: #01686D;
    }
  </style>
  <script type="text/javascript" src="../assets/js/jquery.min.js"></script>
  <script src="../assets/js/qrcode.js"></script>
</head>

<body>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <body class="bg">

    <div class="co">
      <div style="margin-top: 100px;" class="container bg-white w-75 p-5 text-center shadow">
        <div class="row m-lg-4">
          <div class="col-md-8 order-2">
            <div class="title">To use Palio on your computer:</div>
            <!-- LIST PENGGUNAAN-->
            <ol class="_1TxZR">
              <li>Open your Palio Apps</li>
              <li>Select "Setting Icon" in Your Profile Page and choose Palio Enterprise Web</li>
              <li>Point your phone on the screen to capture the QR Code</li>
              <li>For the best experience use Chrome Browser.</li>
            </ol>
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
        <img src="../assets/img/new_palio_logo.png" id="logoImg">
      </div>
    </div>
    <script>
      new QRCode(document.getElementById("qr"), "<?php echo $_SESSION['web_login']; ?>");
    </script>
    <script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
    <script src="../assets/js/fetch_user_status.js"></script>
    <script>
      console.log(document.getElementById("qr").getAttribute("title"));
    </script>
  </body>

</html>