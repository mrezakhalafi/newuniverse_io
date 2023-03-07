<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/db_conn.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/url_function.php'); ?>
<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

$secure = true; // if you only want to receive the cookie over HTTPS
$httponly = true; // prevent JavaScript access to session cookie
$samesite = 'lax';
$maxlifetime = time() + 900;

if (PHP_VERSION_ID < 70300) {
  session_set_cookie_params($maxlifetime, '/; samesite=' . $samesite, $_SERVER['HTTP_HOST'], $secure, $httponly);
} else {
  session_set_cookie_params([
    'lifetime' => $maxlifetime,
    'path' => '/',
    'domain' => $_SERVER['HTTP_HOST'],
    'secure' => $secure,
    'httponly' => $httponly,
    'samesite' => $samesite
  ]);
}
?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/session_function.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/session_check.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/session_delete.php'); ?>
<?php

$version = 'v=' . time();

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

if (!isset($_SESSION['id_company'])) {
  header("Location:" . base_url() . "login.php");
}

if ($_SESSION['id_user'] != '') {
  $email = $_SESSION['email'];
  $showPassword = $_SESSION['password_show'];
  $password = $_SESSION['password'];

  $dbconn = getDBConn();

  $query = $dbconn->prepare("SELECT * FROM USER_ACCOUNT WHERE EMAIL_ACCOUNT = ? ");
  $query->bind_param("s", $email);
  $query->execute();
  $itemUser = $query->get_result()->fetch_assoc();
  $query->close();

  $query = $dbconn->prepare("SELECT * FROM BILLING WHERE COMPANY = ? ORDER BY `CUT_OFF_DATE` DESC LIMIT 1");
  $query->bind_param("s", $itemUser['COMPANY']);
  $query->execute();
  $itemUser2 = $query->get_result()->fetch_assoc();
  $query->close();

  $query = $dbconn->prepare("SELECT * FROM HASH WHERE EMAIL = '$email'");
  $query->execute();
  $itemUser3 = $query->get_result()->fetch_assoc();
  $query->close();

  $msg = "";
  $active = 1;

  if ($itemUser['EMAIL_ACCOUNT'] != '') {

    if ($itemUser['PASSWORD'] != $password) {

      $msg = "Your Password is Incorrect!";

      //echo '<script>alert("Wrong Password")</script>';

    } else if ($itemUser2 != null && strtotime($itemUser2['CUT_OFF_DATE']) < strtotime(date('Y-m-d H:i:s'))) {
      $msg = 'expired';
      // header("Location: dashboard2/");
    } else if ($itemUser['ACTIVE'] == 0 && $itemUser['STATE'] < 2) {
      $msg = "Please Validate Your Email!";
      header("Location: /verifyemail.php");
      die();
    } else if ($itemUser['STATE'] == 2 && $itemUser['ACTIVE'] == 1) {
      $msg = "Please Finish Your Payment!";
      header("Location: /paycheckout.php");
      die();
    } else {

      if ($itemUser['ACTIVE'] == 3 && $itemUser['STATE'] == 2) {
        $msg = "Trial!";
        header("Location: /trialcheckout.php");
        die();
      }
      // else {
      //     $msg = 'ok';
      //     header("Location: index.php");
      // }
    }
  }
}

$dbconn = getDBConn();
$dialogMsg = "";
$id_company = getSession('id_company');
$user_id = getSession('id_user');

$query = $dbconn->prepare("SELECT a.*, b.*, c.* FROM USER_ACCOUNT a, COMPANY_INFO b, COMPANY c WHERE a.COMPANY = b.COMPANY AND b.COMPANY = c.ID AND a.COMPANY = ?");
$query->bind_param("i", $id_company);
$query->execute();
$itemUser = $query->get_result()->fetch_assoc();
$query->close();

// if ($itemUser['STATE'] == 0) {
//   header("Location:" . base_url() . "paycheckout.php");
// }


$query2 = $dbconn->prepare("SELECT * FROM SUBSCRIBE WHERE COMPANY = ?");
$query2->bind_param("i", $id_company);
$query2->execute();
$itemUser2 = $query2->get_result()->fetch_assoc();
$query2->close();

$query = $dbconn->prepare("SELECT * FROM COMPANY where ID = ?");
$query->bind_param("i", $id_company);
$query->execute();
$itemCompany = $query->get_result()->fetch_assoc();
$query->close();

$query = $dbconn->prepare("SELECT * FROM COMPANY_INFO where company = ? ");
$query->bind_param("i", $id_company);
$query->execute();
$itemUserDetail = $query->get_result()->fetch_assoc();
$query->close();

//all message
$message = $dbconn->prepare("SELECT * FROM MESSAGE WHERE COMPANY = ? ORDER BY ID DESC");
$message->bind_param("i", $id_company);
$message->execute();
$itemMessage = $message->get_result();
$rows = $itemMessage->num_rows;
$message->close();

//unread message
$messagenull = $dbconn->prepare("SELECT * FROM MESSAGE WHERE COMPANY = ? AND IS_READ IS NULL ORDER BY ID DESC");
$messagenull->bind_param("i", $id_company);
$messagenull->execute();
$itemMessageNull = $messagenull->get_result();
$rowsnull = $itemMessageNull->num_rows;
$messagenull->close();

$tempID = array();
$tempIsRead = array();
$tempMID = array();

while ($row = $itemMessage->fetch_assoc()) {
  array_push($tempID, $row['ID']);
  array_push($tempIsRead, $row['IS_READ']);
  array_push($tempMID, $row['M_ID']);
};

//unpaid bill CHARGE
$query = $dbconn->prepare("SELECT * FROM BILLING WHERE COMPANY = ? AND IS_PAID = 0");
$query->bind_param("i", $id_company);
$query->execute();
$bills = $query->get_result();
$billsrow = $bills->num_rows;
$query->close();

//USER
$query = $dbconn->prepare("SELECT * FROM USER_ACCOUNT WHERE COMPANY = ?");
$query->bind_param("i", $id_company);
$query->execute();
$user = $query->get_result()->fetch_assoc();
$query->close();

//USERNAME
$query = $dbconn->prepare("SELECT * FROM USER_ACCOUNT WHERE ID = ?");
$query->bind_param("i", $user_id);
$query->execute();
$userID = $query->get_result()->fetch_assoc();
$query->close();

date_default_timezone_set("Asia/Bangkok");
// echo date_default_timezone_get();

$query = $dbconn->prepare("SELECT * FROM BILLING WHERE COMPANY = ? order by DUE_DATE desc limit 1");
$query->bind_param("i", $id_company);
$query->execute();
$bill2 = $query->get_result()->fetch_assoc();
$bill_start_date = $bill2['BILL_DATE'];
$due_date = $bill2["DUE_DATE"];
$currency = $bill2['CURRENCY'];
$_SESSION['charge'] = $bill2['CHARGE'];
$query->close();

//check due date
$today = date("Y-m-d H:i:s");
include '../new_billing.php';

// echo "today " . $today;
// echo "duedate " . $due_date;
if ($today > $due_date || $bill2['IS_PAID'] == 0) {
  echo "CHECKOUT";
  newBilling();
  die();
}

if ($user['STATE'] < 2 || $user['STATE'] == null) {
  header("Location:" . base_url() . "verifyemail.php");
}

if (isset($_POST['submitLogout'])) {
  // delete session
  deleteSessionDB($user_id);
}

$ver = 'v=1.03';

// GET EXISTING BACKGROUND

$dbConnPalioLite = dbConnPalioLite();

$query = $dbConnPalioLite->prepare("SELECT * FROM PREFS WHERE BE = '$id_company'");
$query->execute();
$background = $query->get_result()->fetch_assoc();
$query->close();

if (isset($background['VALUE'])) {
  $oldBG = $background['VALUE'];
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>nexilis | Dashboard</title>

  <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-3.4.1.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>

  <style>
    body {
      font-family: 'Poppins', sans-serif !important;
    }

    .scroll-html-modal {
      max-width: 100% !important;
      overflow: hidden !important;
    }
  </style>
  <link rel="icon" type="image/x-icon" href="<?php echo base_url(); ?>palio_logo_round.png">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- custom css -->
  <link rel="stylesheet" href="css/custom.css?<?php echo time(); ?>">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- Google Font: Work Sans + Josefin Sans -->
  <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:300,300i,400,400i,500,500i,600,600i,700,700i|Work+Sans:400,400i,500,500i,600,600i,700,700i&display=swap" rel="stylesheet">
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- DataTables -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">

  <style>
    /* width */
    ::-webkit-scrollbar {
      width: 5px;
    }

    /* Track */
    ::-webkit-scrollbar-track {
      background: #f1f1f1;
    }

    /* Handle */
    ::-webkit-scrollbar-thumb {
      background: #888;
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
      background: #555;
    }
  </style>

  <script src="js/dashboard.js?<?php echo $version; ?>"></script>
  <script type="module" src="<?php echo base_url(); ?>translate.js?<?php echo time(); ?>"></script>

  <!-- Global site tag (gtag.js) - Google Ads: 689853920 -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=AW-689853920"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());
    gtag('config', 'AW-689853920');
  </script>
  <!-- <script src="/embeddedbutton.js"></script> -->
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to to the body tag
to get the desired effect
|---------------------------------------------------------|
|LAYOUT OPTIONS | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->

<body class="hold-transition sidebar-mini d-none">
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">

        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            <span class="badge badge-warning navbar-badge"><?php echo ($billsrow + $rowsnull); ?></span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header"><?php echo ($billsrow + $rowsnull); ?> <span data-translate="dashside-9">Notifications</span></span>
            <div class="dropdown-divider"></div>
            <a href="mailbox.php" class="dropdown-item">
              <i class="fas fa-envelope mr-2"></i> <?php echo $rowsnull; ?> <span data-translate="dashside-10">new messages</span>
              <!-- <span class="float-right text-muted text-sm">3 mins</span> -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="billpayment.php" class="dropdown-item">
              <i class="fas fa-file mr-2"></i> <?php echo $billsrow; ?> <span data-translate="dashside-11">unpaid bills</span>
              <!-- <span class="float-right text-muted text-sm">12 hours</span> -->
            </a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link" id="username-dropdown" data-toggle="dropdown" href="#">
            <span id="username-top" style="font-size: 18px"><?php echo $itemUser['USERNAME']; ?></span>
            <?php if ($itemUserDetail['COMPANY_LOGO'] !=  null) { ?>
              <img src="<?php echo base_url(); ?>dashboardv2/uploads/logo/<?php echo $itemUserDetail['COMPANY_LOGO']; ?>" id="pfp-mini">
            <?php } else { ?>
              <img src="assets/logomark_regular_small-new.png" id="pfp-mini">
            <?php } ?>
          </a>
          <div class="dropdown-menu dropdown-menu dropdown-menu-right">
            <!-- <button class="dropdown-item" data-toggle="modal" data-target="#profile-modal">
              <i class="fas fa-user mr-2"></i> Profile
            </button> -->
            <form method="POST" id="logoutUser">
              <button type="submit" name="submitLogout" class="dropdown-item" id="logoutButton">
                <i class="fas fa-sign-out-alt mr-2"></i> <span data-translate="dashside-8">Sign out</span>
              </button>
            </form>
          </div>
        </li>
        <li class="nav-item dropdown" id="lang-li" style="margin-left: 20px; margin-right: 20px; cursor:pointer">
          <a data-translate="indexnav-28" data-toggle="dropdown" style="font-size: 18px !important; margin-right: 0px; color: grey" class="nav-link nav-menu-link dropdown-toggle fontRobReg fs-20 greenText" id="lang-nav" role="button" aria-haspopup="true" aria-expanded="false">
          </a>
          <div class="dropdown-menu" id="lang-menu" aria-labelledby="dropdownMenuButton" style="width: auto">
            <div class="col d-flex justify-content-start p-0">
              <a class="dropdown-item fontRobReg fs-20 py-2 greenText" id="change-lang-EN" role="button" style="display: inline;  color: black;">
                EN
              </a>
            </div>
            <div class="col d-flex justify-content-start p-0">
              <a class="dropdown-item fontRobReg fs-20 py-2 greenText" id="change-lang-ID" role="button" style="display: inline;  color: black;">
                ID
              </a>
            </div>
          </div>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- session expire modal -->
    <div class="modal" tabindex="-1" id="modal-session-expire" data-backdrop="static">
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
            <button type="button" id="close-session-expire" class="btn btn-sm btn-primary" style="background-color:#1799ad !important; border: 1px solid #1799ad !important">OK</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="<?php echo base_url(); ?>" class="brand-link">
        <!-- <img src="<?php echo base_url(); ?>newAssets/home-green.png" id="homeLogo" class="brand-image my-1" style="max-height: 30px;"> -->
        <img src="assets/logomark_regular_small.png" alt="Palio Logo" class="brand-image img-circle elevation-3 my-1" style="opacity: .8;">
        <span class="brand-text text-center"><strong>newuniverse.io</strong></span>
        <!-- <img src="assets/palio_logo.png" class="brand-image" style="max-height: 35px; width: auto;"> -->
      </a>

      <!-- Sidebar -->
      <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2" style="font-size: 18px">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
              <a href="index.php" class="nav-link active">
                <i class="fas fa-home nav-icon"></i>
                <p data-translate="dashside-1">
                  <!-- Overview -->
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="usage.php" class="nav-link">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p data-translate="dashside-2">
                  <!-- Usage -->
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="billpayment.php" class="nav-link">
                <i class="nav-icon fas fa-dollar-sign"></i>
                <p data-translate="dashside-3">
                  <!-- Bill & Payment -->
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="mailbox.php" class="nav-link">
                <i class="nav-icon fas fa-envelope"></i>
                <p data-translate="dashside-4">
                  <!-- Mailbox -->
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="support.php" class="nav-link">
                <i class="nav-icon fas fa-question"></i>
                <p data-translate="dashside-5">
                  <!-- Support -->
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="webappform.php" class="nav-link">
                <i class="nav-icon fab fa-wpforms"></i>
                <p data-translate="dashside-6">
                  <!-- URL Form -->
                </p>
              </a>
            </li>
            <!-- <li class="nav-item">
              <a href="appservice.php" class="nav-link">
                <i class="nav-icon fab fa-pushed"></i>
                <p>
                  FCM
                </p>
              </a>
            </li> -->
            <li class="nav-item">
              <a href="form_management.php" class="nav-link">
                <div class="row">
                  <div class="col-2">
                    <i style="margin-top: 5px" class="nav-icon fab fa-wpforms"></i>
                  </div>
                  <div class="col-10">
                    <p data-translate="dashside-7">
                      <!-- Digital Form<br>Management -->
                    </p>
                  </div>
                </div>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <script>
      <?php if (isset($_SESSION['id_user'])) { ?>
        var _0x420e = ['onmousemove', 'onclick', '1OKerZe', 'onmousedown', '4549CQmZix', '1092354VPvGTu', 'You\x20are\x20now\x20logged\x20out.', 'click', 'onkeydown', '1CLOFUJ', '1111594ZVPAQD', '1332369AWjVPg', '327UcYMWx', '70808RAOJOJ', 'scroll', 'addEventListener', '3179VDGBIM', '#logoutButton', 'ontouchstart', '1010111OOhHVU', '61NonpJP'];
        var _0x4933 = function(_0x2ea942, _0x3760d6) {
          _0x2ea942 = _0x2ea942 - 0x81;
          var _0x420e20 = _0x420e[_0x2ea942];
          return _0x420e20;
        };
        (function(_0x19af8a, _0x4e4688) {
          var _0x39a688 = _0x4933;
          while (!![]) {
            try {
              var _0x4d4ba4 = parseInt(_0x39a688(0x94)) * parseInt(_0x39a688(0x83)) + parseInt(_0x39a688(0x87)) * parseInt(_0x39a688(0x8c)) + parseInt(_0x39a688(0x86)) * parseInt(_0x39a688(0x91)) + parseInt(_0x39a688(0x8d)) + -parseInt(_0x39a688(0x8a)) * parseInt(_0x39a688(0x93)) + -parseInt(_0x39a688(0x95)) + -parseInt(_0x39a688(0x92));
              if (_0x4d4ba4 === _0x4e4688) break;
              else _0x19af8a['push'](_0x19af8a['shift']());
            } catch (_0x3c0c29) {
              _0x19af8a['push'](_0x19af8a['shift']());
            }
          }
        }(_0x420e, 0xdce0c));
        var inactivityTime = function() {
          var _0x4613f8 = _0x4933,
            _0xc3d3b2;
          window['onload'] = _0x507f30, document['onload'] = _0x507f30, document[_0x4613f8(0x88)] = _0x507f30, document[_0x4613f8(0x8b)] = _0x507f30, document[_0x4613f8(0x85)] = _0x507f30, document[_0x4613f8(0x89)] = _0x507f30, document[_0x4613f8(0x90)] = _0x507f30, document[_0x4613f8(0x82)](_0x4613f8(0x81), _0x507f30, !![]);

          function _0xa7981f() {
            var _0x35a5c4 = _0x4613f8;
            alert(_0x35a5c4(0x8e)), $(_0x35a5c4(0x84))[_0x35a5c4(0x8f)]();
          }

          function _0x507f30() {
            clearTimeout(_0xc3d3b2), _0xc3d3b2 = setTimeout(_0xa7981f, 0x927c0);
          }
        };

        window.onload = function() {
          inactivityTime();

          <?php if ($bill2['CURRENCY'] == 'IDR' && $user['STATUS'] != 3) { ?>
            var _0x4464 = ['1246398Nryjig', '1098630ftrPYG', 'innerHTML', '4FBYYln', '935839iCdaap', '28PUYLuO', 'packagePrice', '726983vgzIiP', 'getElementById', 'toLocaleString', '24337cmMDEa', '4fhoDjl', 'topupAmt', '267649sUlHqu', '254888UqfJsm'];
            var _0x2d32 = function(_0x12bf2a, _0x118401) {
              _0x12bf2a = _0x12bf2a - 0x173;
              var _0x4464c5 = _0x4464[_0x12bf2a];
              return _0x4464c5;
            };
            var _0x5218e6 = _0x2d32;
            (function(_0x27958b, _0x424085) {
              var _0x357463 = _0x2d32;
              while (!![]) {
                try {
                  var _0x3cc8ff = -parseInt(_0x357463(0x17e)) * -parseInt(_0x357463(0x180)) + -parseInt(_0x357463(0x173)) + -parseInt(_0x357463(0x17a)) + -parseInt(_0x357463(0x181)) * -parseInt(_0x357463(0x176)) + parseInt(_0x357463(0x177)) + parseInt(_0x357463(0x178)) * parseInt(_0x357463(0x17d)) + -parseInt(_0x357463(0x174));
                  if (_0x3cc8ff === _0x424085) break;
                  else _0x27958b['push'](_0x27958b['shift']());
                } catch (_0x4b5f8d) {
                  _0x27958b['push'](_0x27958b['shift']());
                }
              }
            }(_0x4464, 0x9b214), document[_0x5218e6(0x17b)](_0x5218e6(0x179))[_0x5218e6(0x175)] = parseFloat(document[_0x5218e6(0x17b)](_0x5218e6(0x179))[_0x5218e6(0x175)])[_0x5218e6(0x17c)]('id', {
              'minimumFractionDigits': 0x2,
              'maximumFractionDigits': 0x2
            }), document[_0x5218e6(0x17b)](_0x5218e6(0x17f))[_0x5218e6(0x175)] = parseFloat(document['getElementById']('topupAmt')[_0x5218e6(0x175)])[_0x5218e6(0x17c)]('id', {
              'minimumFractionDigits': 0x2,
              'maximumFractionDigits': 0x2
            }));
          <?php } else if ($bill2['CURRENCY'] == 'USD' && $user['STATUS'] != 3) { ?>
            var _0x25ef = ['118623TaJzEU', 'innerHTML', '23jTxvXl', '11230jmxude', '669233GvjeeG', '38011UDZxYu', '39XlXUAu', 'toLocaleString', 'packagePrice', 'getElementById', 'topupAmt', '39veUvYH', '13464kyOagL', 'en-US', '1GoGTtd', '723395IPuusm', '831989UrSWbm'];
            var _0x27c6 = function(_0x3d9e67, _0xc2b382) {
              _0x3d9e67 = _0x3d9e67 - 0x111;
              var _0x25ef7f = _0x25ef[_0x3d9e67];
              return _0x25ef7f;
            };
            var _0x2a4916 = _0x27c6;
            (function(_0x143a69, _0x4c3cb8) {
              var _0x205da5 = _0x27c6;
              while (!![]) {
                try {
                  var _0xd7fcd2 = parseInt(_0x205da5(0x118)) * -parseInt(_0x205da5(0x112)) + parseInt(_0x205da5(0x11d)) + -parseInt(_0x205da5(0x11f)) * -parseInt(_0x205da5(0x120)) + parseInt(_0x205da5(0x121)) + -parseInt(_0x205da5(0x11c)) + parseInt(_0x205da5(0x11b)) * -parseInt(_0x205da5(0x11a)) + -parseInt(_0x205da5(0x111)) * -parseInt(_0x205da5(0x117));
                  if (_0xd7fcd2 === _0x4c3cb8) break;
                  else _0x143a69['push'](_0x143a69['shift']());
                } catch (_0x2217a2) {
                  _0x143a69['push'](_0x143a69['shift']());
                }
              }
            }(_0x25ef, 0x6d65f), document[_0x2a4916(0x115)]('packagePrice')['innerHTML'] = parseFloat(document[_0x2a4916(0x115)](_0x2a4916(0x114))[_0x2a4916(0x11e)])[_0x2a4916(0x113)](_0x2a4916(0x119), {
              'minimumFractionDigits': 0x2,
              'maximumFractionDigits': 0x2
            }), document[_0x2a4916(0x115)](_0x2a4916(0x116))['innerHTML'] = parseFloat(document[_0x2a4916(0x115)]('topupAmt')[_0x2a4916(0x11e)])[_0x2a4916(0x113)]('en-US', {
              'minimumFractionDigits': 0x2,
              'maximumFractionDigits': 0x2
            }));
          <?php } else if ($user['STATUS'] != 3) { ?>
            var _0x36fb = ['topupAmt', '247012nOTbNs', 'getElementById', '156751eIJtwO', '389522tEleHT', '2tlEShW', '995482LhPKiJ', '227uJjMMu', 'country_code', 'innerHTML', '220836kiBmEb', 'toLocaleString', 'en-US', '472209oNZIZG', '4754oohnHd', 'packagePrice'];
            var _0x563a = function(_0x4d85c5, _0x35ae64) {
              _0x4d85c5 = _0x4d85c5 - 0x9f;
              var _0x36fbd9 = _0x36fb[_0x4d85c5];
              return _0x36fbd9;
            };
            var _0x12a4f2 = _0x563a;
            (function(_0x2778d1, _0x2a9938) {
              var _0x2b84ae = _0x563a;
              while (!![]) {
                try {
                  var _0x53dd05 = -parseInt(_0x2b84ae(0xac)) + -parseInt(_0x2b84ae(0xa6)) + -parseInt(_0x2b84ae(0xa7)) * -parseInt(_0x2b84ae(0xa3)) + parseInt(_0x2b84ae(0xa9)) * parseInt(_0x2b84ae(0xa0)) + -parseInt(_0x2b84ae(0xa8)) + parseInt(_0x2b84ae(0x9f)) + parseInt(_0x2b84ae(0xa5));
                  if (_0x53dd05 === _0x2a9938) break;
                  else _0x2778d1['push'](_0x2778d1['shift']());
                } catch (_0x2591f4) {
                  _0x2778d1['push'](_0x2778d1['shift']());
                }
              }
            }(_0x36fb, 0x9194e));
            if (localStorage[_0x12a4f2(0xaa)] == 'ID') document[_0x12a4f2(0xa4)](_0x12a4f2(0xa1))[_0x12a4f2(0xab)] = parseFloat(document['getElementById'](_0x12a4f2(0xa1))[_0x12a4f2(0xab)])[_0x12a4f2(0xad)]('id', {
              'minimumFractionDigits': 0x2,
              'maximumFractionDigits': 0x2
            }), document[_0x12a4f2(0xa4)](_0x12a4f2(0xa2))[_0x12a4f2(0xab)] = parseFloat(document[_0x12a4f2(0xa4)](_0x12a4f2(0xa2))['innerHTML'])[_0x12a4f2(0xad)]('id', {
              'minimumFractionDigits': 0x2,
              'maximumFractionDigits': 0x2
            });
            else localStorage['country_code'] != 'ID' && (document['getElementById'](_0x12a4f2(0xa1))[_0x12a4f2(0xab)] = parseFloat(document[_0x12a4f2(0xa4)](_0x12a4f2(0xa1))[_0x12a4f2(0xab)])['toLocaleString']('id', {
              'minimumFractionDigits': 0x2,
              'maximumFractionDigits': 0x2
            }), document[_0x12a4f2(0xa4)](_0x12a4f2(0xa2))[_0x12a4f2(0xab)] = parseFloat(document['getElementById'](_0x12a4f2(0xa2))['innerHTML'])[_0x12a4f2(0xad)](_0x12a4f2(0xae), {
              'minimumFractionDigits': 0x2,
              'maximumFractionDigits': 0x2
            }));
          <?php } ?>
        }
      <?php } ?>




      <?php if ($geolocSts == 1) { ?>
        var _0x35a5 = ['168268lVsBGw', '992854KvLzRZ', 'lastCheck', '4591lQZzEC', '1nbzGxE', 'floor', 'country_code', 'currentGeoloc', '198634FiDcNu', '403612RlGHkz', '186918WbqoTr', '351385SQlPiJ', 'undefined', '2qOUiUr', '86GRsmNy'];
        var _0x5bfb = function(_0x301c5c, _0x529ef4) {
          _0x301c5c = _0x301c5c - 0x8c;
          var _0x35a515 = _0x35a5[_0x301c5c];
          return _0x35a515;
        };
        var _0x1cf666 = _0x5bfb;
        (function(_0x105670, _0x1b4d68) {
          var _0x554cdc = _0x5bfb;
          while (!![]) {
            try {
              var _0x40958d = parseInt(_0x554cdc(0x93)) + parseInt(_0x554cdc(0x98)) * parseInt(_0x554cdc(0x8d)) + parseInt(_0x554cdc(0x94)) + parseInt(_0x554cdc(0x92)) + parseInt(_0x554cdc(0x95)) + -parseInt(_0x554cdc(0x97)) * parseInt(_0x554cdc(0x99)) + -parseInt(_0x554cdc(0x9a)) * parseInt(_0x554cdc(0x8e));
              if (_0x40958d === _0x1b4d68) break;
              else _0x105670['push'](_0x105670['shift']());
            } catch (_0x3006ca) {
              _0x105670['push'](_0x105670['shift']());
            }
          }
        }(_0x35a5, 0x324a1), localStorage['prevGeoloc'] = localStorage[_0x1cf666(0x91)], localStorage[_0x1cf666(0x91)] = 'ON', localStorage['removeItem']('switchLang'));
        var ONE_HOUR = 0xe10;
        (localStorage['country_code'] == null || typeof localStorage[_0x1cf666(0x90)] === _0x1cf666(0x96) || localStorage[_0x1cf666(0x8c)] == null || typeof localStorage[_0x1cf666(0x8c)] === _0x1cf666(0x96) || Math[_0x1cf666(0x8f)](Date['now']() / 0x3e8) - localStorage['lastCheck'] > ONE_HOUR) && geoLoc();

        <?php  } else {
        if ($language == 0) {

        ?>
          var _0x5abb = ['167hIGFlJ', '8842EOayDa', '407772ewZdLp', '1TmWibq', 'switchLang', 'clear', '1GgYeAX', '1791943NGugQK', '1428326sAeBTM', 'lang_visible', '16401unhvea', '9lqTnnj', '107639Lljmeo', 'lang', '832851zkVJXr', '13MaKQRk', 'currentGeoloc'];
          var _0xaf8e = function(_0x1af948, _0x3d41f9) {
            _0x1af948 = _0x1af948 - 0xc7;
            var _0x5abbd5 = _0x5abb[_0x1af948];
            return _0x5abbd5;
          };
          var _0x528127 = _0xaf8e;
          (function(_0x211d7a, _0x3af8a0) {
            var _0x2bae8c = _0xaf8e;
            while (!![]) {
              try {
                var _0x5581a1 = parseInt(_0x2bae8c(0xd6)) + -parseInt(_0x2bae8c(0xca)) + -parseInt(_0x2bae8c(0xd2)) * -parseInt(_0x2bae8c(0xd7)) + -parseInt(_0x2bae8c(0xc8)) * -parseInt(_0x2bae8c(0xc9)) + parseInt(_0x2bae8c(0xd3)) * -parseInt(_0x2bae8c(0xd4)) + parseInt(_0x2bae8c(0xd0)) * parseInt(_0x2bae8c(0xce)) + -parseInt(_0x2bae8c(0xcb)) * parseInt(_0x2bae8c(0xcf));
                if (_0x5581a1 === _0x3af8a0) break;
                else _0x211d7a['push'](_0x211d7a['shift']());
              } catch (_0x46e05a) {
                _0x211d7a['push'](_0x211d7a['shift']());
              }
            }
          }(_0x5abb, 0xbf0ca), localStorage[_0x528127(0xcd)](), localStorage['prevGeoloc'] = localStorage[_0x528127(0xc7)], localStorage['currentGeoloc'] = 'OFF', localStorage[_0x528127(0xd5)] = 0x0, localStorage[_0x528127(0xd1)] = 0x0, localStorage[_0x528127(0xcc)] = 0x0, localStorage['country_code'] = 'EN');

        <?php } else if ($language == 1) { ?>
          var _0x87e5 = ['4HASZXv', 'currentGeoloc', '1609RxThMM', 'OFF', '274662aakULo', '2fIDuII', '709hqhniJ', '523MUSFbT', '89zytYDC', 'lang_visible', 'switchLang', 'lang', '21364NwDIQZ', 'prevGeoloc', '65423UbXDqd', '62949vmxKNe', '383053MAdxkB'];
          var _0x1e2b = function(_0x90e98d, _0x3fb757) {
            _0x90e98d = _0x90e98d - 0x161;
            var _0x87e560 = _0x87e5[_0x90e98d];
            return _0x87e560;
          };
          var _0x138ddd = _0x1e2b;
          (function(_0x1cc3fd, _0xad9fa4) {
            var _0x22e260 = _0x1e2b;
            while (!![]) {
              try {
                var _0x53350b = -parseInt(_0x22e260(0x169)) * -parseInt(_0x22e260(0x16c)) + -parseInt(_0x22e260(0x167)) + parseInt(_0x22e260(0x163)) * -parseInt(_0x22e260(0x16e)) + -parseInt(_0x22e260(0x162)) * parseInt(_0x22e260(0x161)) + parseInt(_0x22e260(0x16b)) + -parseInt(_0x22e260(0x16a)) * parseInt(_0x22e260(0x171)) + parseInt(_0x22e260(0x170));
                if (_0x53350b === _0xad9fa4) break;
                else _0x1cc3fd['push'](_0x1cc3fd['shift']());
              } catch (_0x4b3031) {
                _0x1cc3fd['push'](_0x1cc3fd['shift']());
              }
            }
          }(_0x87e5, 0x3f059), localStorage['clear'](), localStorage[_0x138ddd(0x168)] = localStorage['currentGeoloc'], localStorage[_0x138ddd(0x16d)] = _0x138ddd(0x16f), localStorage[_0x138ddd(0x166)] = 0x1, localStorage[_0x138ddd(0x164)] = 0x0, localStorage[_0x138ddd(0x165)] = 0x1, localStorage['country_code'] = 'ID');

      <?php }
      } ?>
    </script>