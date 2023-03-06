<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/url_function.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/db_conn.php'); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/customize_template.php'); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/mail_template.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/session_function.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/encoder.php'); ?>
<?php

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

require './gmail/email.php';

$timeSec = 'v=' . time();

if (!isset($_SESSION["id_company"])) { // no session
  header("Location:" . base_url());
  die();
}

// $_SESSION['previous_page'] = $_SESSION['current_page'];
// $_SESSION['current_page'] = 11;
// require_once($_SERVER['DOCUMENT_ROOT'] . '/state_control.php');

if (isset($_POST['submitLogout'])) {
  session_destroy();
  header("Location: index.php");
  die();
}

$email = $_SESSION['email'];

$checkState = "SELECT * FROM USER_ACCOUNT WHERE EMAIL_ACCOUNT = '$email'";
$checkStateQ = $dbconn->prepare($checkState);
$checkStateQ->execute();
$resultState = $checkStateQ->get_result()->fetch_assoc();
$checkStateQ->close();

if ($resultState["STATE"] == 3) { // already verified
  header("Location: index.php");
  die();
}

// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;

if (isset($_POST['resend_mail'])) {

  // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ EMAIL ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
  $url = base_url();
  $email = $_SESSION['email'];
  $hash = $_SESSION['hash'];
  $company_id = $_SESSION['id_company'];
  $username = $_SESSION['username'];
  $price = $_SESSION['price'];
  $password = $_SESSION['password_show'];
  $secret = $_SESSION['secret'];
  $activation_link = base_url() . "verify.php?h=" . $secret;
  $header = file_get_contents('Palio_Confirmation_Header.html');
  $body = file_get_contents('Palio_Confirmation_Body.html');
  $footer = file_get_contents('Palio_Confirmation_Footer.html');
  // $content = $header.$username.$body.$activation_link.$footer;
  //
  // sendMail($content, $email);
  $content = customizeTemplateRemoteEmailConfirmation($username, $activation_link);
  // sendMailEmailConfirmation($content, $email);
  echo send_email($email, $username, "Palio Email Confirmation", $content);

  // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ END EMAIL ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

}

//To send email
function send_email($email_address, $full_name, $subject, $body)
{
  try {
    // Get the API client and construct the service object.
    $client = getClient();
    $service = new Google_Service_Gmail($client);

    $message = createMessage('support@palio.io', $email_address, $subject, $body);
    sendMessage($service, 'me', $message);

    // For favicon lost after resend email
    echo ('<link rel="icon" type="image/x-icon" href="' . base_url() . 'palio_logo_round.png?v=' . time() . '">');

    return 'Message has been sent';
  } catch (Exception $e) {

    return "Message could not be sent. Mailer Error: {$e}";
  }
}

if (isset($_POST['cancel_registration'])) {
  $company_id = $_SESSION['id_company'];

  $query = $dbconn->prepare("DELETE FROM COMPANY WHERE ID = ?");
  $query->bind_param("i", $company_id);
  $query->execute();
  $query->close();

  $query = $dbconn->prepare("DELETE FROM SUBSCRIBE WHERE COMPANY = ?");
  $query->bind_param("i", $company_id);
  $query->execute();
  $query->close();

  $query = $dbconn->prepare("DELETE FROM USER_ACCOUNT WHERE COMPANY = ?");
  $query->bind_param("i", $company_id);
  $query->execute();
  $query->close();

  $query = $dbconn->prepare("DELETE FROM BILLING WHERE COMPANY = ?");
  $query->bind_param("i", $company_id);
  $query->execute();
  $query->close();

  $query = $dbconn->prepare("DELETE FROM COMPANY_INFO WHERE COMPANY = ?");
  $query->bind_param("i", $company_id);
  $query->execute();
  $query->close();

  unset($_SESSION['password']);
  unset($_SESSION['email']);
  unset($_SESSION['hash']);
  unset($_SESSION['companyname']);
  unset($_SESSION['username']);
  unset($_SESSION['price']);
  unset($_SESSION['id_company']);
  unset($_SESSION['session_token']);
  unset($_SESSION['flag']);

  echo "<script>";
  echo "if (localStorage.lang == 0) {";
  echo "alert('Your registration to newuniverse.io has been cancelled.');";
  echo "}";
  echo "else {";
  echo "alert('Registrasi newuniverse.io anda telah dibatalkan.');";
  echo "}";
  echo "window.location.href = '" . base_url() . "';";
  echo "</script>";
}

?>

<style>
  .btn-link {
    border: none;
    outline: none;
    background: none;
    cursor: pointer;
    color: #0000EE;
    padding: 0;
    text-decoration: underline;
    font-family: inherit;
    font-size: inherit;
  }
</style>


<!DOCTYPE html>
<html lang="en">

<head>
  <!-- <link rel="icon" type="image/x-icon" href="palio_logo_round.png?v=<?= time(); ?>"> -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Email Verification</title>

  <!-- Font-Family CSS -->
  <!-- <link rel="stylesheet" href="https://db.onlinewebfonts.com/c/623c7118249e082fe87a78e08506cb4b?family=Segoe+UI">
    <link rel="stylesheet" href="https://db.onlinewebfonts.com/c/d4d6e1a6527a21185217393c427a52cb?family=Segoe+UI+Semibold"> -->

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="css/custom.css">
  <link rel="stylesheet" type="text/css" href="./css/api_web.css">
  <link rel="icon" type="image/x-icon" href="<?php echo base_url(); ?>palio_logo_round.png?v=<?= time(); ?>">

  <!-- POPPINS -->
  <link rel="stylesheet" href="./fonts/poppins/style.css">

  <style>
    .modal-open {
      max-width: 100% !important;
      overflow: hidden !important;
    }
  </style>

  <!-- Main JS -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url(); ?>js/api_web_raw.js?<?php echo ($version); ?>"></script>

  <!-- Custom JS -->
  <script src="js/custom.js?<?php echo $timeSec; ?>"></script>

  <!-- reCAPTCHA -->
  <script src='https://www.google.com/recaptcha/api.js'></script>

  <!-- check user status -->
  <script>
    var company_id = <?= $_SESSION['id_company']; ?>;
    var _0x41e6 = ['addClass', '#verified', '#verifyemail', 'removeClass', '2YEOfYU', '280203qcYfuS', '28867usszJE', '300549YTMDHK', '65608fHBEsQ', '1858157HVoLXC', 'checkStateUser', '638121KumHNK', 'd-none', '7tgpCqy', '37834jzXDDT', '9NfIoxB'];
    var _0x4a48 = function(_0x49a84f, _0x46ca30) {
      _0x49a84f = _0x49a84f - 0x10c;
      var _0x41e6a0 = _0x41e6[_0x49a84f];
      return _0x41e6a0;
    };
    (function(_0x1f3cdf, _0x1843b6) {
      var _0x21be9e = _0x4a48;
      while (!![]) {
        try {
          var _0xf89e04 = parseInt(_0x21be9e(0x111)) + parseInt(_0x21be9e(0x10d)) * -parseInt(_0x21be9e(0x110)) + parseInt(_0x21be9e(0x10e)) + -parseInt(_0x21be9e(0x114)) + -parseInt(_0x21be9e(0x116)) * parseInt(_0x21be9e(0x10f)) + -parseInt(_0x21be9e(0x117)) * parseInt(_0x21be9e(0x118)) + parseInt(_0x21be9e(0x112));
          if (_0xf89e04 === _0x1843b6) break;
          else _0x1f3cdf['push'](_0x1f3cdf['shift']());
        } catch (_0x196a71) {
          _0x1f3cdf['push'](_0x1f3cdf['shift']());
        }
      }
    }(_0x41e6, 0x6711e));

    function checkuser() {
      var _0x3c61e6 = _0x4a48;
      $['post'](_0x3c61e6(0x113), {
        'company_id': company_id
      }, function(_0x5b32b3) {
        var _0x12e9ee = _0x3c61e6;
        if (_0x5b32b3 == 0x1) $(_0x12e9ee(0x11a))['removeClass'](_0x12e9ee(0x115)), $(_0x12e9ee(0x11b))['addClass'](_0x12e9ee(0x115));
        else _0x5b32b3 == 0x3 ? ($('#verified')[_0x12e9ee(0x10c)](_0x12e9ee(0x115)), $(_0x12e9ee(0x11b))[_0x12e9ee(0x119)](_0x12e9ee(0x115))) : setTimeout(checkuser, 0x7d0);
      });
    }
  </script>

</head>

<body>

  <nav class="navbar navbar-expand-md fixed-top background px-0 py-1 fc-70" id="navtop-alt">
    <div class="container" style="max-width: 90%">
      <a class="navbar-brand fs-30 text-white txt-decor-none" href="index.php">
        <!-- <img src="<?php echo base_url(); ?>newAssets/home.png" id="homeLogo" style="max-height: 30px;"> -->
        <img src="<?php echo base_url(); ?>green_newuniverse.png" id="logoImg">
      </a>
    </div>
  </nav>

  <form method="POST" id="logoutUser" style="display:none;">
    <button type="submit" name="submitLogout" class="dropdown-item" id="logoutButton">
      <i class="fas fa-sign-out-alt mr-2"></i> Sign out
    </button>
  </form>

  <div id="verifyemail" class="container">
    <div class="row mt-5">
      <div class="mt-5 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-5 offset-lg-4 col-xl-6 offset-xl-2">

        <?php // echo $_SESSION; 
        ?>
        <br><br><br>

        <p id="p-1">Thank you for signing up, please check your email to activate your account.</p>

        <p id="p-2">
          If you do not receive the confirmation email within a few minutes of signing up, please check your spam/junk mail folder just in case
          the confirmation email got delivered there instead of your inbox. If so, select the confirmation message and mark it as "Not Spam",
          which should allow future messages to get through.
        </p>

        <p id="p-3">
          Should you fail to verify within an hour, your account will be deleted and you will have to register again.
        </p>

        <form method="post">
          <button type="submit" name="resend_mail" class="btn-link" id="p-4">
            Click here if you don't receive the verification mail.
          </button>
        </form>

        <span id="p-5">Or,</span> <br><br>

        <form method="post">
          <button type="submit" name="cancel_registration" class="btn-link" id="p-6">
            click here if you want to cancel your registration.
          </button>
        </form>

      </div>
    </div>
  </div>

  <div id="verified" class="container d-none">
    <div class="row mt-5">
      <div class="mt-5 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-5 offset-lg-4 col-xl-6 offset-xl-2">
        <br><br><br>

        <span id="p-7">Thank you, your email has been verified.</span><br><br>

      </div>
    </div>
  </div>

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
          <button type="button" id="close-session-expire" class="btn btn-primary" data-dismiss="modal" style="background-color:#1799ad !important; border: 1px solid #1799ad !important">OK</button>
        </div>
      </div>
    </div>
  </div>

</body>

<script>
  function checkuser() {
    var company_id = <?= $_SESSION['id_company']; ?>;
    $.post("checkStateUser", {
        company_id: company_id
      },
      function(data) {
        if (data == 1) {
          // location.href = 'paycheckout.php';
          $('#verified').removeClass('d-none');
          $('#verifyemail').addClass('d-none');
        } else if (data == 3) {
          // location.href = 'trialcheckout.php';
          $('#verified').removeClass('d-none');
          $('#verifyemail').addClass('d-none');
        } else {
          setTimeout(checkuser, 2000);
        }
      }
    );
  }


  $(document).ready(function() {
    inactivityTime();
    checkuser();

    $('#modal-session-expire').on('shown.bs.modal', function(e) {
      $("html").addClass("modal-open");
      $("body").addClass("modal-open");
      $("#modal-session-expire").css("height", "100vh");
    });

    $('#modal-session-expire').on('hidden.bs.modal', function(e) {
      $("html").removeClass("modal-open");
      $("body").removeClass("modal-open");
      $("#modal-session-expire").css("height", "");
    });

    function expiredVerify() {
      var company_id = <?php echo $_SESSION['id_company']; ?>;
      $.post("cancelVerify", {
          company_id: company_id
        },
        console.log('Verification expired in 1 hour!')
      );
    }

    expiredVerify();
  });

  if (localStorage.lang == 1) {

    $('#p-1').text('Terima kasih telah mendaftar, silakan periksa email Anda untuk mengaktifkan akun Anda.');
    $('#p-2').text('Jika Anda tidak menerima email konfirmasi dalam beberapa menit setelah mendaftar, harap periksa folder email spam/sampah Anda untuk berjaga-jaga email konfirmasi dikirim ke sana, bukan kotak masuk Anda. Jika sudah, pilih pesan konfirmasi dan tandai sebagai "Bukan Spam", yang seharusnya memungkinkan pesan di masa depan untuk melewatinya.');
    $('#p-3').text('Jika Anda gagal memverifikasi dalam waktu satu jam, akun Anda akan dihapus dan Anda harus mendaftar lagi.');
    $('#p-4').text('Klik di sini jika Anda tidak menerima email verifikasi.');
    $('#p-5').text('Atau,');
    $('#p-6').text('klik di sini jika Anda ingin membatalkan pendaftaran Anda.');
    $('#p-7').text('Terima kasih, email Anda telah diverifikasi.');

  }
</script>

</html>