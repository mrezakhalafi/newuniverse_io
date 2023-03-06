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
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400;1,500;1,600&display=swap" rel="stylesheet">
  <style type="text/css">
    body {
      margin: 0px;
      height: 100%;
      width: 100%;
      position: absolute;
      background: #ffffff;
      font-family: 'Poppins';
      letter-spacing: 1px;
    }

    #qr>img {
      width: 100%;
      height: 100%;
    }

    #qr {
      border: white solid 25px;
      /* padding: 50px; */
      height: 35vh;
      width: 35vh;
    }

    .font-light {
      font-weight: 300 !important;
    }

    .font-regular {
      font-weight: 400 !important;
    }

    .font-medium {
      font-weight: 500 !important;
    }

    .font-semibold {
      font-weight: 600 !important;
    }

    .text-purple {
      color: #6945A5;
    }
  </style>
  <script type="text/javascript" src="../assets/js/jquery.min.js"></script>
  <script src="../assets/js/qrcode.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body class="d-flex align-items-center">
  <div class="col">
    <div class="row" style="background-color: #6945A5;">
      <div class="col" style="margin-left: 40vh; margin-right: 20vh;">
        <div class="row">
          <div class="col-3 m-5">
            <div id="qr"></div>
            <script>
              new QRCode(document.getElementById("qr"), "<?php echo $_SESSION['web_login']; ?>");
            </script>
          </div>
          <div class="col-8 bg-white" style="padding-right: 5rem; padding-left: 5rem;">
            <div class="row">
              <img src="/qmera_button/assets/palio_button.png" height="90rem">
            </div>
            <div class="row mt-4">
              <div>
                <p class="font-medium" style="font-size: 30px;">To use Qmera Lite on your computer</p>
                <div>
                  <ol type="1" style="padding-inline-start: 20px;">
                    <li>Open your Qmera Lite mobile app.</li>
                    <li>Open settings menu by pressing burger menu on the upper right corner, go to "Settings", and go to "Login to Qmera Web".</li>
                    <li>Aim your phone camera to the QR Code.</li>
                  </ol>
                </div>
              </div>
            </div>
            <div class="row mt-4">
              <div>
                <p class="font-medium" style="font-size: 25px;">Note:</p>
                <ol type="1" style="padding-inline-start: 20px;">
                  <li>For the best experience, use Chrome browser.</li>
                  <li>If you haven't installed Qmera Lite, please do so.</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<?php if ($env == 0) { ?>
  <script type="text/javascript">
    localStorage.setItem("env", 0);
  </script>
<?php } else { ?>
  <script type="text/javascript">
    localStorage.setItem("env", 1);
  </script>
<?php } ?>
<script src="../assets/js/fetch_user_status.js"></script>

</html>