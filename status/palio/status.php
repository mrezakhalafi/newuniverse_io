<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/url_function.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/db_conn.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/session_function.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/header-alt.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/header-alt-meta.php');
// require_once($_SERVER['DOCUMENT_ROOT'] . '/palio_browser/logics/chat_dbconn.php');

// if (!isset($_SESSION['id_company'])) {
//   header("Location:" . base_url() . "login.php");
// }

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

$_SESSION['previous_page'] = $_SESSION['current_page'];
$_SESSION['current_page'] = 13;
require_once($_SERVER['DOCUMENT_ROOT'] . '/state_control.php');

$dbconn = getDBConn();

$company_id = $_SESSION['id_company'];
$query = $dbconn->prepare("SELECT * FROM USER_ACCOUNT WHERE COMPANY = ?");
$query->bind_param("i", $company_id);
$query->execute();
$checkSts = $query->get_result()->fetch_assoc();
$userStatus = $checkSts['STATUS'];
$userState = $checkSts['STATE'];
setSession('email', $checkSts['EMAIL_ACCOUNT']);
setSession('password', $checkSts['PASSWORD']);
setSession('id_user', $checkSts['ID']);
$query->close();

// update shop is_verified saat sukses bayar, jika punya shop
if ($userState >= 2) {
  // $palioLiteConn = paliolite();

  // $c_id = (string) $company_id;
  // $qry = $palioLiteConn->prepare("SELECT COUNT(*) AS CNT_ROW FROM SHOP WHERE PALIO_ID = ?");
  // $qry->bind_param("s", $c_id);
  // $qry->execute();
  // $row = $qry->get_result()->fetch_assoc();
  // $num_row = $row["CNT_ROW"];
  // $qry->close();

  // if ($num_row > 0) {
  //   $qry = $palioLiteConn->prepare("UPDATE SHOP SET IS_VERIFIED = 1 WHERE PALIO_ID = ?");
  //   $qry->bind_param("s", $c_id);
  //   $qry->execute();
  //   $qry->close();
  // }
}

$pay_stats = $_GET['status'];

if (!isset($pay_stats)) {
  redirect(base_url());
}

if (isset($_POST['submitLogout'])) {
  session_destroy();
  header("Location: ../../index.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Thank You</title>

  <link href="<?php echo base_url(); ?>bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- <script src='/js/jquery-3.4.1.min.js'></script> -->
<!-- Global site tag (gtag.js) - Google Ads: 689853920 --> <script async src="https://www.googletagmanager.com/gtag/js?id=AW-689853920"></script> <script> window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', 'AW-689853920'); </script>
<!-- Event snippet for Subscribe conversion page --> <script> gtag('event', 'conversion', {'send_to': 'AW-689853920/kQaDCIe4tvwBEOCr-cgC'}); </script>
</head>

<body id="wrap">

  <div class="jumbotron text-center">
    <?php if ($userState >= 2) { ?>
      <h1 id="thankyou-text" class="display-3">Thank You!</h1>
      <p id="content-success-text" class="lead">Your payment has been processed successfully. Please continue to your dashboard to start using our services.</p>
    <?php } else { ?>
      <h1 class="display-3">Oops!</h1>
      <p id="content-failed-text" class="lead">Your payment was not successfully processed. Please try again later or please try a different payment method.</p>
    <?php } ?>
    <hr>
    <p>
      <span id="having-trouble-text">Having trouble?</span> <a id="contact-us-text" href="<?php echo base_url(); ?>contactus.php" style="color: #f0ad4e;">Contact us</a>
      <?php //echo("<br>" . $_POST['data']); 
      ?>
    </p>
    <p class="lead">
      <?php if ($userStatus != 0) { ?>
        <a id="redirect-dashboard-text" href="<?php echo base_url(); ?>dashboardv2/index.php" class="btn btn-warning btn-sm" type="button">Go to Dashboard</a>
        <!-- <button onclick="sendmail();" class="btn btn-warning btn-sm" type="button">Go to Dashboard</button> -->
      <?php } else { ?>
        <a id="redirect-checkout-text" href="<?php echo base_url(); ?>paycheckout.php" class="btn btn-warning btn-sm" type="button">Checkout</a>
      <?php } ?>
    </p>
  </div>
  <div style="margin:60px auto;text-align:center;">
    <hr>
    <img src="https://newuniverse.io/green_newuniverse.png" alt="Palio.io" width="400">
    <br><br>
  </div>

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
                <button type="button" id="close-session-expire" class="btn btn-primary" data-dismiss="modal" style="background-color:#1799ad !important; border: 1px solid #1799ad !important">OK</button>
            </div>
        </div>
    </div>
  </div>

  <form method="POST" id="logoutUser" style="display:none;">
    <button type="submit" name="submitLogout" class="dropdown-item" id="logoutButton">
        <i class="fas fa-sign-out-alt mr-2"></i> Sign out
    </button>
  </form>


</body>
<script>
  localStorage.removeItem("isPaid");

  if (localStorage.lang == 1) {
    $("#thankyou-text").text("Terima Kasih!");
    $("#content-success-text").text("Pembayaranmu telah berhasil diproses. Harap melanjutkan ke dasbormu untuk memulai menggunakan layanan kami.");
    $("#content-failed-text").text("Pembayaranmu telah gagal diproses. Harap coba lagi nanti atau gunakan metode pembayaran yang lain.");
    $("#having-trouble-text").text("Punya masalah?");
    $("#contact-us-text").text("Hubungi kami");
    $("#redirect-dashboard-text").text("Pergi ke Dasbor");
    $("#redirect-checkout-text").text("Periksa");
  }

  $("#close-session-expire").click(function() {
		$('#logoutButton').click();
	})

</script>

</html>