<link rel="icon" type="image/x-icon" href="newAssets/fav.ico">
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/url_function.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/db_conn.php'); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/header-alt.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/session_function.php'); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/header-alt-meta.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/session_insert.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/api_generator_2.php'); ?>

<?php

if (!isset($_SESSION["id_user"]) || !isset($_SESSION["id_company"])) {
  redirect(base_url());
  die();
}

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

$js_version = 'v=12.2';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (empty($_SESSION)) {
  redirect(base_url() . 'newpricing.php');
}

$_SESSION['previous_page'] = $_SESSION['current_page'];
$_SESSION['current_page'] = 12;
require_once($_SERVER['DOCUMENT_ROOT'] . '/state_control.php');

$dbconn = getDBConn();
$base_url = base_url();
echo "<script>base_url = '" . $base_url . "';</script>";

$company_id = $_SESSION['id_company'];

echo "<script>company_id = '" . $company_id . "';</script>";

$query = $dbconn->prepare("SELECT * FROM USER_ACCOUNT WHERE COMPANY = ?");
$query->bind_param("i", $company_id);
$query->execute();
$dataUser = $query->get_result()->fetch_assoc();
$password = MD5($dataUser['PASSWORD']);
$user_id = $dataUser['ID'];
$userStatus = $dataUser['STATUS'];
$userState = $dataUser['STATE'];
$userActive = $dataUser['ACTIVE'];
$email = $dataUser['EMAIL_ACCOUNT'];
$query->close();

if ($userState == 3 && $userStatus == 1) { // SUBSCRIBE LUNAS
  header('Location: status/palio/status.php');
} elseif ($userState < 2 && $userStatus == 1) { // BELUM VERIFY
  header('Location: verifyemail.php');
} else if (($userStatus == 3 && $userState == 3) || ($userActive == 0 && $userState == 2)) { // TRIAL DILARANG MASUK OR EXPIRED
  header('Location: dashboardv2/index');
}

$email = $_SESSION['email'];
$apikey = base64_encode(microtime() . $email);

$query = $dbconn->prepare("SELECT * FROM COMPANY_INFO WHERE COMPANY = ?");
$query->bind_param("i", $company_id);
$query->execute();
$dataCompany = $query->get_result()->fetch_assoc();
$query->close();

$query = $dbconn->prepare("SELECT * FROM SUBSCRIBE WHERE COMPANY = ? AND STATUS = 0");
$query->bind_param("i", $company_id);
$query->execute();
$subscribe = $query->get_result()->fetch_assoc();
$subscribe_id = $subscribe['ID'];
$query->close();

$query = $dbconn->prepare("SELECT * FROM BILLING WHERE COMPANY = ? AND SUBSCRIBE = ?");
$query->bind_param("ii", $company_id, $subscribe_id);
$query->execute();
$subscriptionData = $query->get_result()->fetch_assoc();
$bill_id = $subscriptionData['ID'];
$active_package = $subscriptionData['CHARGE']; //price for product chosen
$currency = $subscriptionData['CURRENCY'];
echo "<script>transaction_id = '" . $subscriptionData['ORDER_NUMBER'] . "';</script>";
echo "<script>company_id = " . $company_id . ";</script>";
$query->close();

$query = $dbconn->prepare("SELECT * FROM COMPANY WHERE ID = ?");
$query->bind_param("i", $company_id);
$query->execute();
$company = $query->get_result()->fetch_assoc();
$apikey = $company['API_KEY'];
$query->close();

$price_item_amount = sprintf('%0.2f', $subscriptionData['CHARGE']);

if (isset($_POST['cancel'])) {
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

  header("Location: sign_up.php");
}

// pay with paypal
if (isset($_POST['dashboard']) || $userState == 1) {
  $query = $dbconn->prepare("SELECT *, COUNT(*) as cnt FROM BILLING WHERE ID = ?");
  $query->bind_param("i", $bill_id);
  $query->execute();
  $subscriptionData = $query->get_result()->fetch_assoc();
  $cnt = $subscriptionData['cnt'];
  $query->close();

  if ($cnt > 0 && $dataUser['STATUS'] != 1) {
    // $apikey = base64_encode(microtime() . $email);

    // update status company
    $query = $dbconn->prepare("UPDATE COMPANY SET STATUS = 1 WHERE ID = ? AND STATUS = 0");
    $query->bind_param("i", $company_id);
    $query->execute();
    $query->close();

    $query = $dbconn->prepare("SELECT * FROM COMPANY_INFO WHERE COMPANY = ?");
    $query->bind_param("i", $company_id);
    $query->execute();
    $dataCompany = $query->get_result()->fetch_assoc();
    $query->close();

    $query = $dbconn->prepare("SELECT * FROM CREDIT WHERE COMPANY_ID = ?");
    $query->bind_param("i", $company_id);
    $query->execute();
    $credit_data = $query->get_result()->fetch_assoc();
    $query->close();

    $query = $dbconn->prepare("SELECT * FROM BILLING WHERE ID = ?");
    $query->bind_param("i", $bill_id);
    $query->execute();
    $subscriptionData = $query->get_result()->fetch_assoc();
    $subscriptionType = $subscriptionData['ORDER_TYPE'];
    $price_item_amount = $subscriptionData['CHARGE'];
    $orderNumber = $subscriptionData['ORDER_NUMBER'];
    $query->close();

    $msg = "New User";
    $query = $dbconn->prepare("INSERT INTO MESSAGE (COMPANY, USER_ACCOUNT, M_ID, MESSAGE_DATE, MESSAGE_DESC, IS_READ) VALUES (?,?,1, NOW(), ?, NULL)");
    $query->bind_param("iis", $company_id, $user_id, $msg);
    $query->execute();
    $query->close();

    $queryUpdateInfo = $dbconn->prepare("REPLACE INTO COMP_FEATURE (`COMPANY_ID`, `TYPE`, `VALUE`) VALUES (" . $company_id . ",1, 1)");
    // $queryUpdateInfo->bind_param("iii", $company_id, 1, $messaging);
    $queryUpdateInfo->execute();
    $queryUpdateInfo->close();

    $queryUpdateInfo = $dbconn->prepare("REPLACE INTO COMP_FEATURE (`COMPANY_ID`, `TYPE`, `VALUE`) VALUES (" . $company_id . ",2, 1)");
    // $queryUpdateInfo->bind_param("iii", $company_id, 1, $messaging);
    $queryUpdateInfo->execute();
    $queryUpdateInfo->close();

    $queryUpdateInfo = $dbconn->prepare("REPLACE INTO COMP_FEATURE (`COMPANY_ID`, `TYPE`, `VALUE`) VALUES (" . $company_id . ",3 , 1)");
    // $queryUpdateInfo->bind_param("iii", $company_id, 1, $messaging);
    $queryUpdateInfo->execute();
    $queryUpdateInfo->close();

    $queryUpdateInfo = $dbconn->prepare("REPLACE INTO COMP_FEATURE (`COMPANY_ID`, `TYPE`, `VALUE`) VALUES (" . $company_id . ",4 , 1)");
    // $queryUpdateInfo->bind_param("iii", $company_id, 1, $messaging);
    $queryUpdateInfo->execute();
    $queryUpdateInfo->close();

    $queryUpdateInfo = $dbconn->prepare("REPLACE INTO COMP_FEATURE (`COMPANY_ID`, `TYPE`, `VALUE`) VALUES (" . $company_id . ",5 , 1)");
    // $queryUpdateInfo->bind_param("iii", $company_id, 1, $messaging);
    $queryUpdateInfo->execute();
    $queryUpdateInfo->close();

    $queryUpdateInfo = $dbconn->prepare("REPLACE INTO COMP_FEATURE (`COMPANY_ID`, `TYPE`, `VALUE`) VALUES (" . $company_id . ",6 , 1)");
    // $queryUpdateInfo->bind_param("iii", $company_id, 1, $messaging);
    $queryUpdateInfo->execute();
    $queryUpdateInfo->close();

    $queryUpdateInfo = $dbconn->prepare("REPLACE INTO COMP_FEATURE (`COMPANY_ID`, `TYPE`, `VALUE`) VALUES (" . $company_id . ",7 , 1)");
    // $queryUpdateInfo->bind_param("iii", $company_id, 1, $messaging);
    $queryUpdateInfo->execute();
    $queryUpdateInfo->close();

    //update status subscribe
    $query = $dbconn->prepare("UPDATE SUBSCRIBE SET STATUS = 1 WHERE ID = ?");
    $query->bind_param("i", $subscribe_id);
    $query->execute();
    $query->close();

    //update billing
    $query = $dbconn->prepare("UPDATE BILLING SET IS_PAID = 1 WHERE ID = ?");
    $query->bind_param("i", $bill_id);
    $query->execute();
    $query->close();

    //PAYMENT INSERT QUERY
    $query = $dbconn->prepare("INSERT INTO PAYMENT (PAYMENT_METHOD, BILL, COMPANY, USER, PAY_DATE) VALUES ('PAYPAL', ?, ?, ?, NOW())");
    $query->bind_param("iii", $bill_id, $company_id, $user_id);
    $query->execute();
    $query->close();

    $expire_date = strtotime('+30 days') * 1000;

    // // insert apikey to nusdk server
    $api_url = "http://192.168.1.100:8004/webrest/";
    $api_data = array(
      'code' => 'REGBE',
      'data' => array(
        'company_id' => $company_id,
        'name' => $dataCompany['COMPANY_NAME'],
        'api_key' => $apikey,
        'expire_date' => $expire_date,
        'private_key' => $_SESSION['password'],
        'is_trial' => 0,
        'is_anonymous' => 1,
      ),

    );

    $api_options = array(
      'http' => array(
        'header'  =>
        // "Authorization: ".$secretKey."\r\n".
        "Content-type: application/json\r\n",
        'method'  => 'POST',
        'content' => strval(json_encode($api_data))
      )
    );

    $api_stream = stream_context_create($api_options);
    $api_result = file_get_contents($api_url, false, $api_stream);
    $api_json_result = json_decode($api_result);
    // end apikey

    $query = $dbconn->prepare("UPDATE USER_ACCOUNT SET STATUS = 1, STATE = 3 WHERE COMPANY = ?");
    $query->bind_param("i", $company_id);
    $query->execute();
    $query->close();

    if ($credit_data['PREPAID_QUOTA'] < 0) {

      $ce_quota = 17800000 + $credit_data['PREPAID_QUOTA'];

      $query = $dbconn->prepare("UPDATE CREDIT SET CREDIT = 0, PREPAID_QUOTA = 0, CE_QUOTA = ? WHERE COMPANY_ID = ?");
      $query->bind_param("di", $ce_quota, $company_id);
      $query->execute();
      $query->close();
    } else {

      $query = $dbconn->prepare("UPDATE CREDIT SET CE_QUOTA = 17800000 WHERE COMPANY_ID = ?");
      $query->bind_param("i", $company_id);
      $query->execute();
      $query->close();
    }

    function invoiceMail($name, $orderNumber, $orderDate, $item, $price, $method, $dashboard)
    {
      $item = "Up to 5,000,000 Monthly Text Recipients, Up to 50,000 Monthly Image Recipients, Up to 5,000 Monthly Video Recipients, Up to 3,000 Monthly Minutes Livestream Recipients, Up to 50,000 Monthly Minutes 1-1 VoIP Calls, Up to 500 Monthly Minutes 1-1 Video Calls";
      $content = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/template/Payment_copy_01.html');
      $content = str_replace('*NAME*', $name, $content);
      $content = str_replace('*AMOUNT*', $price, $content);
      $content = str_replace('1A2B3C4D5EFFF', $orderNumber, $content);
      $content = str_replace('April 28, 2020', $orderDate, $content);
      $content = str_replace('ITEM1', $item, $content);
      $content = str_replace('$75', $price, $content);
      $content = str_replace('BCA: **** 5808', $method, $content);
      $content = str_replace('http://103.94.169.26:8081/', $dashboard, $content);
      return $content;
    }

    $name = $dataUser['USERNAME'];
    $orderDate = date("F d, Y");
    $price = $active_package;
    $method = 'PAYPAL';
    $dashboard = base_url();
    $content = invoiceMail($name, $orderNumber, $orderDate, $item, $currency . ' ' . $price, $method, $dashboard);

    // EMAIL
    $lowerCaseMail = strtolower($email);

    $mailResp = send_email($email, $email, "Subscription Submission", $content);
    if ($mailResp == "Message has been sent") {
      apiGen();
      insertSession($user_id);
    } else {
      echo $mailResp;
    }
    // require $_SERVER['DOCUMENT_ROOT'] . '/PHPMailer/src/Exception.php';
    // require $_SERVER['DOCUMENT_ROOT'] . '/PHPMailer/src/PHPMailer.php';
    // require $_SERVER['DOCUMENT_ROOT'] . '/PHPMailer/src/SMTP.php';

    // $mail = new PHPMailer();
    // //$mail->SMTPDebug = 2;
    // $mail->isSMTP();
    // $mail->Host       = 'smtp.gmail.com';
    // $mail->SMTPAuth   = true;
    // $mail->Username   = 'support@palio.io';
    // $mail->Password   = '12345easySoft67890';
    // $mail->SMTPSecure = 'tls';
    // $mail->Port       = 587;

    // //Recipients
    // $mail->setFrom('support@palio.io', 'Palio');
    // $mail->addAddress($lowerCaseMail);
    // $mail->addReplyTo('support@palio.io');

    // $mail->isHTML(true);
    // $mail->Subject = 'Subscription Submission';
    // $mail->Body = $content;
    // $mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'] . '/template/PalioEmailConfirmation_files/image003.png', 'ccimage', 'images003.png');

    // if (!$mail->send()) {
    //   $succMsg = "";
    //   $mail->ClearAllRecipients();
    //   $msg = 'Error Mailler: ' . $mail->ErrorInfo;
    //   echo $msg;
    // } else {
    //   $mail->ClearAllRecipients();
    //   $sent = true;

    //   apiGen();
    //   // insert session into db
    //   insertSession($user_id);
    //   redirect(base_url() . 'status/palio/status.php');
    // }
  }
}
// end pay with paypal

?>

<!DOCTYPE html>
<html>

<head>
  <title>Paypal Checking</title>
  <!-- bootstrap wysihtml5 - text editor -->
  <!-- jQuery 3 -->
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

  <!-- Bootstrap 3.3.7 -->
  <!-- <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css"> -->
  <link href="<?php echo base_url(); ?>bootstrap/css/bootstrap.min.css?<?php echo ($version); ?>" rel="stylesheet">
  <script src="<?php echo base_url(); ?>bower_components/bootstrap/dist/js/bootstrap.min.js?<?php echo ($version); ?>"></script>

  <!-- Xendit.js -->
  <script type="text/javascript" src="https://js.xendit.co/v1/xendit.min.js"></script>
  <script type="text/javascript" src="./payment_xendit.js?<?php echo ($js_version); ?>"></script>
  <script type="text/javascript">
    // old xnd_public_development_zgOpdmLazyMs4RxZN3T55KtBtcPMe5Jwk41jEI1RuZM017pSwp6PE0TspbvBE3
    // xnd_public_development_qcfW9OvrvG3U0ph6Dc01xNMhKhhW2On4a0l7ZMUS696BBWR8vNbkSKyRZGlOLQ
    Xendit.setPublishableKey('xnd_public_development_qcfW9OvrvG3U0ph6Dc01xNMhKhhW2On4a0l7ZMUS696BBWR8vNbkSKyRZGlOLQ');
  </script>

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

  <script>
    <?php if ($geolocSts == 1) { ?>

      var _0x5050 = ['578wJpNXT', '127SuHDyV', 'prevCountry', '517WfODUp', 'now', '1507160HqedYW', 'Sorry,\x20we\x20are\x20unable\x20to\x20get\x20your\x20current\x20location.', 'undefined', '5541JDdUFH', '1886WHSrab', 'lastCheck', 'prevGeoloc', 'switchLang', 'country_code2', 'lang', 'country_code', 'floor', 'lang_visible', 'currentGeoloc', '5699fjNtKr', '13881nkktBM', '1584823dKtDEF', 'removeItem', '69412tBcoQn', '233PNdHjv'];
      var _0x8a72 = function(_0x134235, _0x63172a) {
        _0x134235 = _0x134235 - 0xd6;
        var _0x50500d = _0x5050[_0x134235];
        return _0x50500d;
      };
      var _0xda65a1 = _0x8a72;
      (function(_0x4ccb29, _0x4e7f94) {
        var _0x4a22bb = _0x8a72;
        while (!![]) {
          try {
            var _0xc6e9cc = parseInt(_0x4a22bb(0xda)) * parseInt(_0x4a22bb(0xe3)) + -parseInt(_0x4a22bb(0xdc)) * -parseInt(_0x4a22bb(0xd6)) + parseInt(_0x4a22bb(0xde)) * parseInt(_0x4a22bb(0xe4)) + parseInt(_0x4a22bb(0xd9)) + -parseInt(_0x4a22bb(0xe0)) + parseInt(_0x4a22bb(0xd7)) + -parseInt(_0x4a22bb(0xee)) * parseInt(_0x4a22bb(0xdb));
            if (_0xc6e9cc === _0x4e7f94) break;
            else _0x4ccb29['push'](_0x4ccb29['shift']());
          } catch (_0x303500) {
            _0x4ccb29['push'](_0x4ccb29['shift']());
          }
        }
      }(_0x5050, 0xd7587), localStorage[_0xda65a1(0xe6)] = localStorage[_0xda65a1(0xed)], localStorage['currentGeoloc'] = 'ON', localStorage[_0xda65a1(0xd8)](_0xda65a1(0xe7)));

      function geoLoc() {
        $['ajax']({
          'url': 'https://api.ipgeolocation.io/ipgeo?apiKey=cacef90bd1af48e5a4e0a97e91439f51',
          'type': 'GET',
          'success': function(_0xd12969) {
            var _0x4ddcde = _0x8a72;
            localStorage[_0x4ddcde(0xdd)] = localStorage[_0x4ddcde(0xea)], localStorage[_0x4ddcde(0xe5)] = Math[_0x4ddcde(0xeb)](Date[_0x4ddcde(0xdf)]() / 0x3e8), (localStorage[_0x4ddcde(0xdd)] != _0xd12969[_0x4ddcde(0xe8)] || localStorage[_0x4ddcde(0xdd)] == null || typeof localStorage[_0x4ddcde(0xdd)] === _0x4ddcde(0xe2)) && (localStorage[_0x4ddcde(0xea)] = _0xd12969['country_code2'], _0xd12969[_0x4ddcde(0xe8)] == 'ID' ? (localStorage[_0x4ddcde(0xec)] = 0x1, (localStorage[_0x4ddcde(0xe9)] != null || typeof localStorage[_0x4ddcde(0xe9)] !== 'undefined') && (localStorage[_0x4ddcde(0xe9)] = 0x0)) : (localStorage[_0x4ddcde(0xe9)] = 0x0, localStorage[_0x4ddcde(0xec)] = 0x0));
          },
          'error': function(_0x61ff9) {
            var _0x3505bb = _0x8a72;
            alert(_0x3505bb(0xe1)), localStorage[_0x3505bb(0xd8)](_0x3505bb(0xe5)), localStorage['lang'] = 0x0, localStorage[_0x3505bb(0xec)] = 0x0, localStorage[_0x3505bb(0xea)] = 'EN';
          }
        });
      }
      var ONE_HOUR = 0xe10;
      (localStorage[_0xda65a1(0xea)] == null || typeof localStorage['country_code'] === _0xda65a1(0xe2) || localStorage[_0xda65a1(0xe5)] == null || typeof localStorage[_0xda65a1(0xe5)] === _0xda65a1(0xe2) || Math[_0xda65a1(0xeb)](Date['now']() / 0x3e8) - localStorage['lastCheck'] > ONE_HOUR) && geoLoc();

      window.onload = function() {
        if (localStorage.country_code == 'ID') {

          if (localStorage.getItem('lang') == 1) {
            <?php if ($currency == 'IDR') { ?>
              var _0xa245 = ['413223egANbd', '1375156HXHFwP', '1264114sKbJjz', '89wjyjxu', '2166rgGALl', '951612CyUrdx', '1374140ZtglDx', '#newpricing-6', '297qZfarW', '577fKlikW', 'Hanya\x20dengan\x20<strong>Rp450<sup>000</sup></strong>\x20biaya\x20langganan\x20per\x20bulan,\x20kamu\x20mendapatkan:'];
              var _0x34b6 = function(_0x2778ed, _0x5b3658) {
                _0x2778ed = _0x2778ed - 0x168;
                var _0xa2456c = _0xa245[_0x2778ed];
                return _0xa2456c;
              };
              var _0x1d2d62 = _0x34b6;
              (function(_0x1591b0, _0x302c44) {
                var _0x2060e6 = _0x34b6;
                while (!![]) {
                  try {
                    var _0x4441c5 = parseInt(_0x2060e6(0x16f)) + -parseInt(_0x2060e6(0x16e)) + -parseInt(_0x2060e6(0x170)) + parseInt(_0x2060e6(0x171)) * -parseInt(_0x2060e6(0x16b)) + parseInt(_0x2060e6(0x168)) + -parseInt(_0x2060e6(0x16c)) * parseInt(_0x2060e6(0x172)) + parseInt(_0x2060e6(0x169));
                    if (_0x4441c5 === _0x302c44) break;
                    else _0x1591b0['push'](_0x1591b0['shift']());
                  } catch (_0x586a11) {
                    _0x1591b0['push'](_0x1591b0['shift']());
                  }
                }
              }(_0xa245, 0xb675c), $(_0x1d2d62(0x16a))['html'](_0x1d2d62(0x16d)));
            <?php } else if ($currency == 'USD') { ?>
              var _0x3d4d = ['html', '2058319dKJWAj', '1hsLOyv', '560730xRkIik', '1LHyZRf', '1RDlTVO', '87cDERMs', '310003UYPdZD', '7477lARYif', '196529hDNEUR', '597355CsVwlv', 'Hanya\x20dengan\x20<strong>$33<sup>50</sup></strong>\x20biaya\x20langganan\x20per\x20bulan,\x20kamu\x20mendapatkan:', '1217IgjjvO', '277WRVpGC'];
              var _0x3638 = function(_0x1f751a, _0x46694e) {
                _0x1f751a = _0x1f751a - 0x1e9;
                var _0x3d4d7e = _0x3d4d[_0x1f751a];
                return _0x3d4d7e;
              };
              var _0x52c9a8 = _0x3638;
              (function(_0x595a76, _0x42bbf1) {
                var _0x29cc9d = _0x3638;
                while (!![]) {
                  try {
                    var _0x228566 = parseInt(_0x29cc9d(0x1ee)) + -parseInt(_0x29cc9d(0x1ef)) + parseInt(_0x29cc9d(0x1f5)) * parseInt(_0x29cc9d(0x1ec)) + -parseInt(_0x29cc9d(0x1f2)) * parseInt(_0x29cc9d(0x1f1)) + parseInt(_0x29cc9d(0x1e9)) * -parseInt(_0x29cc9d(0x1f6)) + -parseInt(_0x29cc9d(0x1eb)) * parseInt(_0x29cc9d(0x1ed)) + parseInt(_0x29cc9d(0x1f4)) * parseInt(_0x29cc9d(0x1ea));
                    if (_0x228566 === _0x42bbf1) break;
                    else _0x595a76['push'](_0x595a76['shift']());
                  } catch (_0x44e0db) {
                    _0x595a76['push'](_0x595a76['shift']());
                  }
                }
              }(_0x3d4d, 0x66556), $('#newpricing-6')[_0x52c9a8(0x1f3)](_0x52c9a8(0x1f0)));
            <?php } else { ?>
              var _0x5380 = ['8933mmiOvg', '126838SQjUNg', '#newpricing-6', '10DEyiAH', '901591IbKogc', '167aqFfTq', '151763BfKKBR', '6025GuUqhC', 'html', '224spllEF', 'Hanya\x20dengan\x20<strong>Rp450<sup>000</sup></strong>\x20biaya\x20langganan\x20per\x20bulan,\x20kamu\x20mendapatkan:', '1583523ltIyri', '67TxXsZA', '22TMkunG'];
              var _0x915a = function(_0x36a787, _0x21e02c) {
                _0x36a787 = _0x36a787 - 0x1e5;
                var _0x5380ba = _0x5380[_0x36a787];
                return _0x5380ba;
              };
              var _0x45b24b = _0x915a;
              (function(_0x499b9d, _0x49ff12) {
                var _0x5c7430 = _0x915a;
                while (!![]) {
                  try {
                    var _0x143853 = parseInt(_0x5c7430(0x1ec)) * parseInt(_0x5c7430(0x1ed)) + -parseInt(_0x5c7430(0x1f1)) + -parseInt(_0x5c7430(0x1e5)) * -parseInt(_0x5c7430(0x1f0)) + parseInt(_0x5c7430(0x1f2)) * -parseInt(_0x5c7430(0x1eb)) + -parseInt(_0x5c7430(0x1ee)) + -parseInt(_0x5c7430(0x1e6)) * parseInt(_0x5c7430(0x1e8)) + parseInt(_0x5c7430(0x1ea));
                    if (_0x143853 === _0x49ff12) break;
                    else _0x499b9d['push'](_0x499b9d['shift']());
                  } catch (_0x2b7b9c) {
                    _0x499b9d['push'](_0x499b9d['shift']());
                  }
                }
              }(_0x5380, 0xddcad), $(_0x45b24b(0x1ef))[_0x45b24b(0x1e7)](_0x45b24b(0x1e9)));
            <?php } ?>
          } else if (localStorage.getItem('lang') == 0) {
            <?php if ($currency == 'IDR') { ?>
              var _0x2525 = ['#newpricing-6', 'For\x20just\x20<strong>Rp450<sup>000</sup></strong>\x20monthly\x20subscription,\x20you\x20get:', '703TzLztb', '100594qbtoJX', '981fKEWFO', '45QAAgbD', 'html', '6xQSIyO', '74193EZdIab', '194555QpJiny', '335116rDbORB', '341440nsjJvN'];
              var _0x184e = function(_0x2523fd, _0x442522) {
                _0x2523fd = _0x2523fd - 0x73;
                var _0x2525de = _0x2525[_0x2523fd];
                return _0x2525de;
              };
              var _0x50c2ab = _0x184e;
              (function(_0x140e6e, _0x10aaa2) {
                var _0x5d95a0 = _0x184e;
                while (!![]) {
                  try {
                    var _0x3d1b82 = -parseInt(_0x5d95a0(0x74)) + -parseInt(_0x5d95a0(0x78)) * -parseInt(_0x5d95a0(0x7d)) + parseInt(_0x5d95a0(0x73)) + -parseInt(_0x5d95a0(0x7e)) + parseInt(_0x5d95a0(0x7a)) * -parseInt(_0x5d95a0(0x7b)) + parseInt(_0x5d95a0(0x75)) + parseInt(_0x5d95a0(0x79));
                    if (_0x3d1b82 === _0x10aaa2) break;
                    else _0x140e6e['push'](_0x140e6e['shift']());
                  } catch (_0x5183fa) {
                    _0x140e6e['push'](_0x140e6e['shift']());
                  }
                }
              }(_0x2525, 0x2dbd9), $(_0x50c2ab(0x76))[_0x50c2ab(0x7c)](_0x50c2ab(0x77)));
            <?php } else if ($currency == 'USD') { ?>
              var _0x1c28 = ['121278zNxjHb', '#newpricing-6', '43gWpcWu', '576789xroLZY', '405895qiNuFF', '12821oFqHho', 'html', '667171DXjiav', '14264nOWNvS', '587392RlkGCK', 'For\x20just\x20<strong>$33<sup>50</sup></strong>\x20monthly\x20subscription,\x20you\x20get:'];
              var _0x2f87 = function(_0x9be88d, _0xf18306) {
                _0x9be88d = _0x9be88d - 0x19f;
                var _0x1c285f = _0x1c28[_0x9be88d];
                return _0x1c285f;
              };
              var _0x1366ec = _0x2f87;
              (function(_0x5732b9, _0x2e3991) {
                var _0x4f7c09 = _0x2f87;
                while (!![]) {
                  try {
                    var _0x40083e = -parseInt(_0x4f7c09(0x1a4)) + parseInt(_0x4f7c09(0x1a6)) * -parseInt(_0x4f7c09(0x1a1)) + parseInt(_0x4f7c09(0x1a8)) + -parseInt(_0x4f7c09(0x1a7)) + parseInt(_0x4f7c09(0x1a2)) + -parseInt(_0x4f7c09(0x1a9)) + parseInt(_0x4f7c09(0x1a0));
                    if (_0x40083e === _0x2e3991) break;
                    else _0x5732b9['push'](_0x5732b9['shift']());
                  } catch (_0x52f126) {
                    _0x5732b9['push'](_0x5732b9['shift']());
                  }
                }
              }(_0x1c28, 0x5215a), $(_0x1366ec(0x1a5))[_0x1366ec(0x19f)](_0x1366ec(0x1a3)));
            <?php } else { ?>
              var _0x4770 = ['156494JdKxvH', '188336Mduznw', 'html', '435365kNxvMl', '#newpricing-6', '1ZQJcCd', '96737THpGlG', '197442xKodVF', '1WJaIyq', '131137XXPKUO', '43463Dlrjiy'];
              var _0x3ec6 = function(_0x4744c3, _0xf90de9) {
                _0x4744c3 = _0x4744c3 - 0x141;
                var _0x477065 = _0x4770[_0x4744c3];
                return _0x477065;
              };
              var _0xaf883c = _0x3ec6;
              (function(_0x2f7089, _0x78bf90) {
                var _0x11a63e = _0x3ec6;
                while (!![]) {
                  try {
                    var _0x4b4712 = -parseInt(_0x11a63e(0x147)) * parseInt(_0x11a63e(0x146)) + parseInt(_0x11a63e(0x149)) + parseInt(_0x11a63e(0x144)) + parseInt(_0x11a63e(0x148)) + parseInt(_0x11a63e(0x143)) * parseInt(_0x11a63e(0x14a)) + parseInt(_0x11a63e(0x145)) + -parseInt(_0x11a63e(0x141));
                    if (_0x4b4712 === _0x78bf90) break;
                    else _0x2f7089['push'](_0x2f7089['shift']());
                  } catch (_0x264d78) {
                    _0x2f7089['push'](_0x2f7089['shift']());
                  }
                }
              }(_0x4770, 0x1c502), $(_0xaf883c(0x142))[_0xaf883c(0x14b)]('For\x20just\x20<strong>Rp450<sup>000</sup></strong>\x20monthly\x20subscription,\x20you\x20get:'));
            <?php } ?>
          }
        } else if (localStorage.country_code != 'ID') {
          <?php if ($currency == 'IDR') { ?>
            var _0x21da = ['1335612wmXUcE', '1jMUXaU', 'html', '43037RSjoUI', '1xhZxnb', '450735ksDLyY', 'For\x20just\x20<strong>Rp450<sup>000</sup></strong>\x20monthly\x20subscription,\x20you\x20get:', '#newpricing-6', '574999BKuCtn', '1013417cfuHYV', '42069vTCmwX', '197738hllGjA', '3PVMprH'];
            var _0x422f = function(_0x5e038f, _0x2cd317) {
              _0x5e038f = _0x5e038f - 0x85;
              var _0x21da6c = _0x21da[_0x5e038f];
              return _0x21da6c;
            };
            var _0x4d0e8e = _0x422f;
            (function(_0x1fc068, _0x2c36e1) {
              var _0x78019d = _0x422f;
              while (!![]) {
                try {
                  var _0x5ad76b = parseInt(_0x78019d(0x88)) * -parseInt(_0x78019d(0x91)) + parseInt(_0x78019d(0x8e)) + parseInt(_0x78019d(0x86)) + parseInt(_0x78019d(0x8a)) * parseInt(_0x78019d(0x85)) + -parseInt(_0x78019d(0x87)) + parseInt(_0x78019d(0x8d)) * -parseInt(_0x78019d(0x8c)) + parseInt(_0x78019d(0x89));
                  if (_0x5ad76b === _0x2c36e1) break;
                  else _0x1fc068['push'](_0x1fc068['shift']());
                } catch (_0x488df2) {
                  _0x1fc068['push'](_0x1fc068['shift']());
                }
              }
            }(_0x21da, 0xd5e1d), $(_0x4d0e8e(0x90))[_0x4d0e8e(0x8b)](_0x4d0e8e(0x8f)));
          <?php } else if ($currency == 'USD') { ?>
            var _0x34cf = ['For\x20just\x20<strong>$33<sup>50</sup></strong>\x20monthly\x20subscription,\x20you\x20get:', '575015iwhcSh', '617YYHvVs', '3IWqgeB', '638805equepD', '710680CThgot', '1009GHkEok', 'html', '144897CCvtlZ', '63QObNpp', '359673MZLfLl'];
            var _0x2e56 = function(_0x4c3495, _0x540c8b) {
              _0x4c3495 = _0x4c3495 - 0x1c1;
              var _0x34cf7e = _0x34cf[_0x4c3495];
              return _0x34cf7e;
            };
            var _0x4e67ac = _0x2e56;
            (function(_0x44b0cf, _0x3d9ef4) {
              var _0x25d23b = _0x2e56;
              while (!![]) {
                try {
                  var _0x4dc35e = -parseInt(_0x25d23b(0x1c9)) + parseInt(_0x25d23b(0x1cb)) * -parseInt(_0x25d23b(0x1c8)) + parseInt(_0x25d23b(0x1c7)) * -parseInt(_0x25d23b(0x1c3)) + parseInt(_0x25d23b(0x1c2)) + -parseInt(_0x25d23b(0x1c4)) + parseInt(_0x25d23b(0x1ca)) + parseInt(_0x25d23b(0x1c6));
                  if (_0x4dc35e === _0x3d9ef4) break;
                  else _0x44b0cf['push'](_0x44b0cf['shift']());
                } catch (_0x518507) {
                  _0x44b0cf['push'](_0x44b0cf['shift']());
                }
              }
            }(_0x34cf, 0x5f448), $('#newpricing-6')[_0x4e67ac(0x1c1)](_0x4e67ac(0x1c5)));
          <?php } else { ?>
            var _0x5c1f = ['8078AJzMpZ', '334318uJkRpC', '41273bNngwC', '#newpricing-6', '46LZTNwI', '199470ofWKap', 'html', '479774rWXcuf', '7892DWMZSJ', 'For\x20just\x20<strong>$33<sup>50</sup></strong>\x20monthly\x20subscription,\x20you\x20get:', '117138ddkehg', '20JXeCyd', '55axxIDQ'];
            var _0x9384 = function(_0x402daf, _0x396f16) {
              _0x402daf = _0x402daf - 0x89;
              var _0x5c1f5e = _0x5c1f[_0x402daf];
              return _0x5c1f5e;
            };
            var _0x44b953 = _0x9384;
            (function(_0x2b50ce, _0x32a779) {
              var _0x504cb4 = _0x9384;
              while (!![]) {
                try {
                  var _0x6928d7 = parseInt(_0x504cb4(0x8b)) + -parseInt(_0x504cb4(0x92)) + -parseInt(_0x504cb4(0x8e)) + -parseInt(_0x504cb4(0x95)) * parseInt(_0x504cb4(0x8c)) + parseInt(_0x504cb4(0x90)) * -parseInt(_0x504cb4(0x91)) + parseInt(_0x504cb4(0x89)) + -parseInt(_0x504cb4(0x8f)) * -parseInt(_0x504cb4(0x93));
                  if (_0x6928d7 === _0x32a779) break;
                  else _0x2b50ce['push'](_0x2b50ce['shift']());
                } catch (_0x14d604) {
                  _0x2b50ce['push'](_0x2b50ce['shift']());
                }
              }
            }(_0x5c1f, 0x3c0a6), $(_0x44b953(0x94))[_0x44b953(0x8a)](_0x44b953(0x8d)));
          <?php } ?>
        }
      }

      <?php  } else {
      if ($language == 0) {
      ?>
        var _0x15a5 = ['362BgnYYV', '15BqBLlA', '16952FTuUnG', 'OFF', '169375cqhRpV', 'lang_visible', 'prevGeoloc', 'country_code', 'switchLang', '7229BvHMHq', '12irkwPG', 'lang', 'currentGeoloc', '1SSRLwh', '106iuzlME', '21557ZFZOmN', '52574BPgOca', '318273AgqbJt'];
        var _0x1d6a = function(_0x5d51a5, _0x4b199f) {
          _0x5d51a5 = _0x5d51a5 - 0x9f;
          var _0x15a50c = _0x15a5[_0x5d51a5];
          return _0x15a50c;
        };
        var _0x35626c = _0x1d6a;
        (function(_0x24218b, _0x36fbd1) {
          var _0x448d33 = _0x1d6a;
          while (!![]) {
            try {
              var _0x177bc5 = parseInt(_0x448d33(0xaa)) + -parseInt(_0x448d33(0xa7)) * -parseInt(_0x448d33(0xaf)) + parseInt(_0x448d33(0xb0)) * parseInt(_0x448d33(0xa3)) + parseInt(_0x448d33(0xa4)) + parseInt(_0x448d33(0xa2)) * -parseInt(_0x448d33(0xa6)) + -parseInt(_0x448d33(0xa5)) + parseInt(_0x448d33(0xa1)) * -parseInt(_0x448d33(0xa8));
              if (_0x177bc5 === _0x36fbd1) break;
              else _0x24218b['push'](_0x24218b['shift']());
            } catch (_0x5f058c) {
              _0x24218b['push'](_0x24218b['shift']());
            }
          }
        }(_0x15a5, 0x349af), localStorage['clear'](), localStorage[_0x35626c(0xac)] = localStorage['currentGeoloc'], localStorage[_0x35626c(0xa0)] = _0x35626c(0xa9), localStorage[_0x35626c(0x9f)] = 0x0, localStorage[_0x35626c(0xab)] = 0x0, localStorage[_0x35626c(0xae)] = 0x0, localStorage[_0x35626c(0xad)] = 'EN');

      <?php } else if ($language == 1) { ?>
        var _0x8094 = ['lang', '724951eLcqrU', 'country_code', '885OOVqAC', 'clear', 'switchLang', '6mqGTBP', '15QbVZLj', '234187xqrgil', 'prevGeoloc', '847130oKdSvU', 'OFF', '166613mFsWLL', '7IDffBz', '6615tYjrtG', 'currentGeoloc', 'lang_visible', '99424FkasvM', '2153vxDkHf'];
        var _0x42a1 = function(_0x5d65f5, _0x30477c) {
          _0x5d65f5 = _0x5d65f5 - 0x103;
          var _0x80949f = _0x8094[_0x5d65f5];
          return _0x80949f;
        };
        var _0x26b9d3 = _0x42a1;
        (function(_0xb95282, _0x18ba1e) {
          var _0x2eb9ac = _0x42a1;
          while (!![]) {
            try {
              var _0x56bebc = parseInt(_0x2eb9ac(0x110)) * parseInt(_0x2eb9ac(0x10b)) + -parseInt(_0x2eb9ac(0x104)) + parseInt(_0x2eb9ac(0x109)) * -parseInt(_0x2eb9ac(0x10f)) + -parseInt(_0x2eb9ac(0x10d)) + -parseInt(_0x2eb9ac(0x114)) + parseInt(_0x2eb9ac(0x106)) * parseInt(_0x2eb9ac(0x115)) + parseInt(_0x2eb9ac(0x10a)) * parseInt(_0x2eb9ac(0x111));
              if (_0x56bebc === _0x18ba1e) break;
              else _0xb95282['push'](_0xb95282['shift']());
            } catch (_0x97c68a) {
              _0xb95282['push'](_0xb95282['shift']());
            }
          }
        }(_0x8094, 0xed7d4), localStorage[_0x26b9d3(0x107)](), localStorage[_0x26b9d3(0x10c)] = localStorage['currentGeoloc'], localStorage[_0x26b9d3(0x112)] = _0x26b9d3(0x10e), localStorage[_0x26b9d3(0x103)] = 0x1, localStorage[_0x26b9d3(0x113)] = 0x0, localStorage[_0x26b9d3(0x108)] = 0x1, localStorage[_0x26b9d3(0x105)] = 'ID');
    <?php }
    } ?>
  </script>

  <style media="screen">
    @media only screen and (min-width: 0px) {
      #bca-button {
        height: 25px;
        min-height: 25px;
        max-height: 30px;
        padding: 5px;
      }

      #bca-button img {
        max-width: 40px;
      }

      #credit-card-button {
        height: 25px;
        min-height: 25px;
        max-height: 30px;
        padding: 5px;
      }
    }

    @media only screen and (min-width: 201px) {
      #bca-button {
        height: 25px;
        min-height: 25px;
        max-height: 55px;
        padding: 5px;
      }

      #bca-button img {
        max-width: 40px;
      }

      #credit-card-button {
        height: 25px;
        min-height: 25px;
        max-height: 55px;
        padding: 5px;
      }
    }

    @media only screen and (min-width: 301px) {
      #bca-button {
        height: 35px;
        min-height: 35px;
        max-height: 55px;
        padding: 5px;
      }

      #bca-button img {
        max-width: 40px;
      }

      #credit-card-button {
        height: 35px;
        min-height: 35px;
        max-height: 55px;
        padding: 5px;
      }
    }

    @media only screen and (min-width: 401px) {
      #bca-button {
        height: 45px;
        min-height: 30px;
        max-height: 55px;
        padding: 10px;
      }

      #bca-button img {
        max-width: 70px;
        position: relative;
        bottom: 7px;
      }

      #credit-card-button {
        height: 45px;
        min-height: 30px;
        max-height: 55px;
        padding: 6px;
      }
    }

    #three-ds-container {
      width: 550px;
      height: 450px;
      line-height: 200px;
      position: fixed;
      top: 25%;
      /* left: 40%; */
      margin-top: -100px;
      /* margin-left: -150px; */
      background-color: #ffffff;
      border-radius: 5px;
      text-align: center;
      z-index: 11;
      /* 1px higher than the overlay layer */
    }

    .overlay {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      height: 100%;
      width: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      z-index: 10;
    }

    #paydiv {
      display: none;
    }

    #pay-with-credit-card {
      background-color: #ffc439;
      color: white;
    }

    #pay-with-credit-card:hover {
      background-color: #DBA830;
      color: white;
    }

    #pay-with-ovo {
      background-color: #ffc439;
      color: white;
    }

    #cancel {
      background-color: grey;
      color: white;
    }


    #pay-with-ovo:hover {
      background-color: #DBA830;
      color: white;
    }

    input[type=text]:focus {
      box-shadow: 0 0 5px #ffc439;
    }

    .alignleft {
      float: left;
    }

    .alignright {
      float: right;
    }

    #sub-benefits {
      border: 3px #01686d solid;
      border-radius: 15px;
      padding: 1em;
    }

    #sub-benefits>ul>li>ul {
      list-style-type: "✓ ";
    }

    .tip {
      font-size: .8em;
    }

    @media only screen and (max-width: 414px) {
      #three-ds-container {
        width: 350px;
      }

      #sample-inline-frame {
        width: 340px;
        height: 450px;
      }
    }
  </style>
  </style>
  <script src="https://unpkg.com/@paypal/paypal-js@2.0.0/dist/paypal.browser.min.js"></script>
  <script>
    $('document').ready(function() {
      if (localStorage.isPaid != '' && localStorage.isPaid == '1') {
        $('#creditModalCenter').modal('show');

        // update state user after success payment
        var js = {
          company_id: <?php echo $company_id ?>,
        };

        function updateState() {
          $.post("state_update", js,
            function(data, status) {
              // alert("Data: " + data + "\nStatus: " + status);
              if (data != "Update success!") {
                updateState();
              } else {
                $('#creditModalCenter').modal('hide');
                location.reload();
              }
            });
        }

        updateState();
        // end update state
      }
    });
  </script>

  <!-- checkout expire after 1 hour -->
  <script>
    $('document').ready(function() {
      function expiredCheckout() {
        var company_id = <?php echo $company_id; ?>;
        $.post("cancelPaycheckout", {
            company_id: company_id
          },
          console.log('Checkout expired in 1 hour!')
        );
      }

      expiredCheckout();
    });
  </script>
</head>

<body id="invoice">

  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6 mt-5" style="top: -70px;">
        <div class="card mt-5 p-3">
          <div class="card-body">
            <div class="row">
              <div style="text-align: left; width: 100%;"><span id="pay-1" style="color:#F2AD33"><strong>Order details</strong></span><br>
                <br>
                <strong id="pay-2" class="alignleft">Order number:</strong><span class="alignright"><?php echo $subscriptionData['ORDER_NUMBER'] ?></span><br>
                <strong id="pay-3" class="alignleft">Order date:</strong><span class="alignright"><?php echo $subscriptionData['BILL_DATE'] ?></span><br>
                <hr>
              </div><br>

              <div style="text-align: left; width: 100%;"><strong id="pay-7">Palio Lite Package</strong></div>

              <div class="row justify-content-center mx-0 my-3">
                <div class="col-md-12" id="sub-benefits">
                  <p id="newpricing-6">
                  </p>
                  <ul>
                    <li>
                      <span data-translate="newpricing-7"></span>
                      <ul>
                        <li data-translate="newpricing-8"></li>
                        <li data-translate="newpricing-9"></li>
                        <li data-translate="newpricing-10"></li>
                        <li data-translate="newpricing-11"></li>
                        <li data-translate="newpricing-12"></li>
                      </ul>
                    </li>
                    <li>
                      <span data-translate="newpricing-13"></span>
                      <ul>
                        <li><span id="abc-1"></span><sup><a id="head-1" href="#tip-1">(1)</a></sup><span id="or-1"></span></li>
                        <li><span id="abc-2"></span><sup><a id="head-2" href="#tip-2">(2)</a></sup></sup><span id="or-2"></span></li>
                        <li><span id="abc-3"></span><sup><a id="head-3" href="#tip-3">(3)</a></sup></sup><span id="or-3"></span></li>
                        <li><span id="abc-4"></span><sup><a id="head-4" href="#tip-4">(4)</a></sup></sup><span id="or-4"></span></li>
                        <li><span id="abc-5"></span><sup><a id="head-5" href="#tip-5">(5)</a></sup></sup><span id="or-5"></span></li>
                        <li><span id="abc-6"></span><sup><a id="head-6" href="#tip-6">(6)</a></sup></span></li>
                      </ul>
                    </li>
                    <li data-translate="newpricing-20"></li>
                  </ul>
                </div>
              </div>

              <br>
            </div>

            <hr>
            <br>

            <div class="row">
              <div class="col-md-12">
                <ul style="list-style: none; padding-left: .5em;">
                  <li>
                    <sup><a id="tip-1" href="#head-1">(1)</a></sup> <span class="tip" id="abcdesc-1"></span>
                  </li>
                  <li>
                    <sup><a id="tip-2" href="#head-2">(2)</a></sup> <span class="tip" id="abcdesc-2"></span>
                  </li>
                  <li>
                    <sup><a id="tip-3" href="#head-3">(3)</a></sup> <span class="tip" id="abcdesc-3"></span>
                  </li>
                  <li>
                    <sup><a id="tip-4" href="#head-4">(4)</a></sup> <span class="tip" id="abcdesc-4"></span>
                  </li>
                  <li>
                    <sup><a id="tip-5" href="#head-5">(5)</a></sup> <span class="tip" id="abcdesc-5"></span>
                  </li>
                  <li>
                    <sup><a id="tip-6" href="#head-6">(6)</a></sup> <span class="tip" id="abcdesc-6"></span>
                  </li>

                </ul>
              </div>
            </div>

            <hr>
            <br>

            <div class="row">
              <span class="m-0" style="color:#F2AD33"><strong>Bill</strong></span>
            </div>
            <br>
            <!-- <div class="row">
              <span class="fs-20 text-secondary"><span id="pay-8">Package</span> : <?php echo $currency . " " . $price_item_amount; ?></span>
            </div>
            <div class="row mt-3" style="border-bottom: 1px solid black;">
              <p class="fs-18 mb-0">Total</p>
              <p class="fs-18 ml-auto mb-0"><?php echo $currency . " " . $price_item_amount; ?></p>
            </div>
            <div class="row my-4">
              <p id="pay-9" class="fs-15 m-0">Payment Method : </p>
            </div> -->

            <div class="row ml-0 input-group">
              <!-- <p class="fs-18 mb-0">Total</p> -->
              <!-- <p class="fs-18 ml-auto mb-0"><php echo $currencyBill . " " . sprintf('%0.2f', $billAmt); ?></p> -->
              <span class="fs-18 mr-3">Rp</span><input type="text" min="0" maxlength="20" class="form-control form-control fs-16 fontRobReg" id="amount" placeholder="Please input amount. (e.g., 1000000)" name="amount" value="450000.00" readonly="">
            </div>

            <div class="row my-3 justify-content-center">


              <div class="mx-1" id="paydiv"></div>
            </div>

            <form id="form-paypal">
              <div>
                <label style="white-space:nowrap;">
                  <input type="radio" class="pay-intent" id="subscription" name="intent" value="subscription" checked="">
                  <span id="pay-10" style="white-space:normal;">Monthly Subscription (cancel anytime)</span>
                </label>
              </div>

              <div>
                <label style="white-space:nowrap;">
                  <input type="radio" class="pay-intent" id="order" name="intent" value="order">
                  <span id="pay-11" style="white-space:normal;">One Month Only (you will be notified towards end of each billing cycle)</span>
                </label>
              </div>
            </form>


            <div class="row justify-content-center">


              <div class="mx-1" id="paydiv"></div>
            </div>

            <!-- paypal -->
            <form id="form-paypal">
              <div>
                <label style="white-space:nowrap;">
                  <input type="radio" class="pay-intent" id="subscription" name="intent" value="subscription" checked>
                  <span id="pay-10" style="white-space:normal;">Monthly Subscription (cancel anytime)</span>
                </label>
              </div>

              <div>
                <label style="white-space:nowrap;">
                  <input type="radio" class="pay-intent" id="order" name="intent" value="order">
                  <span id="pay-11" style="white-space:normal;">One Month Only (you will be notified towards end of each billing cycle)</span>
                </label>
              </div>
            </form>

            <div id="paypal-button-container"></div>
            <!-- end paypal -->

            <!-- pay with credit card -->
            <button id="credit-card-button" class="btn btn-lg btn-block d-none" style="background-color: #f7f7f7; border-color: #608CA5;" data-toggle="collapse" data-target="#credit-card-form-container">Credit Card / Debit Card</button>
            <div id="credit-card-form-container" class="collapse">

              <form id="credit-card-form" name="creditCardForm" method="post">
                <div class="input-group btn border-70 p-0 mt-4">
                  <input maxlength="16" size="16" type="text" required class="form-control form-control fs-16 fontRobReg" id="credit-card-number" placeholder="Credit Card Number (e.g 4000000000001091)" name="creditCardNumber">
                </div>
                <div class="row input-group btn border-70 p-0 mt-4" style="text-align: left; margin-left: 0px">
                  <div class="col-5 d-flex justify-content-start align-items-center">
                    <p id="exp-month-paycheckout" class="mb-0">Exp Date</p>
                  </div>
                  <div class="col-7">
                    <div class="input-group btn border-70 p-0">
                      <select required class="form-control form-control fs-16 fontRobReg" id="credit-card-exp-month" placeholder="MM" style="border-color: #608CA5" name="creditCardExpMonth">
                        <option>01</option>
                        <option>02</option>
                        <option>03</option>
                        <option>04</option>
                        <option>05</option>
                        <option>06</option>
                        <option>07</option>
                        <option>08</option>
                        <option>09</option>
                        <option>10</option>
                        <option>11</option>
                        <option>12</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-5 d-flex justify-content-start align-items-center mt-3">
                    <p id="exp-year-paycheckout" class="mb-0">Exp Year</p>
                  </div>
                  <div class="col-7 mt-3">
                    <div class="input-group btn border-70 p-0">
                      <input maxlength="4" size="4" type="text" required class="form-control form-control fs-16 fontRobReg" id="credit-card-exp-year" placeholder="YYYY" style="border-color: #608CA5" name="creditCardExpYear">
                    </div>
                  </div>
                  <div class="col-5 d-flex justify-content-start align-items-center mt-3">
                    <p class="mb-0">CVV</p>
                  </div>
                  <div class="col-7 mt-3">
                    <div class="input-group btn border-70 p-0">
                      <input maxlength="3" size="3" type="text" required class="form-control form-control fs-16 fontRobReg" id="credit-card-cvv" placeholder="123" style="border-color: #608CA5" name="creditCardCvv">
                    </div>
                  </div>
                </div>
                <!-- id hidden credit card -->
                <input type="hidden" id="credit-card-amount" name="creditCardAmount" value="<?php echo $price_item_amount; ?>">
                <input type="submit" id="pay-with-credit-card" class="col-md-12 btn nav-menu-btn-wht-alt py-1 px-3 m-0 my-4 fs-16" value="Pay with Credit Card" name="payWithCreditCard">
              </form>
            </div>

            <!-- Loading Modal credit card -->
            <div class="modal hide fade" id="creditModalCenter" tabindex="-1" role="dialog" aria-labelledby="creditModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-body" style="text-align: center;">
                    <span class="fa fa-spinner fa-spin fa-5x"></span><br>
                    Please don't close the browser or refresh the page.
                  </div>
                </div>
              </div>
            </div>

            <hr>
            <form method="post">
              <input type="submit" id="cancel" class="col-md-12 btn nav-menu-btn-wht-alt py-1 px-3 m-0 fs-16" value="CANCEL" name="cancel">
            </form>

            <div>
              <form method="post">
                <input style="display: none;" type="submit" value="Dashboard" name="dashboard" id="todashboard">
              </form>
            </div>

          </div>
        </div>

      </div>
    </div>
  </div>
  <div class="overlay" style="display: none;"></div>
  <div class="row">
    <div class="col-12 d-flex justify-content-center">
      <div id="three-ds-container" style="display: none;">
        <iframe id="sample-inline-frame" name="sample-inline-frame" width="550" height="450"> </iframe>
      </div>
    </div>
  </div>

  <?php $timeSec = "v=" . time(); ?>
  <script type="module" src="<?php echo base_url(); ?>translate.js?<?php echo $timeSec; ?>"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>

  <script>
    if (localStorage.country_code == 'ID') {
      $('#form-paypal').addClass('d-none');
      $('#paypal-button-container').addClass('d-none');
      $('#credit-card-button').removeClass('d-none');
    }

    $(document).ready(function() {

      $('#pay_intent').val('subscription');

      $('.pay-intent').click(function() {
        if ($(this).is(':checked')) {
          // alert($(this).val());
          let radioval = $(this).val();
          $('#pay_intent').val(radioval);
        }
      });

      var _0x49f3 = ['Hingga\x202,5\x20MB\x20untuk\x20setiap\x20video.\x20Untuk\x20setiap\x20video\x20yang\x20dikirim,\x20kredit\x20akan\x20dikurangi\x20dengan\x20jumlah\x20penerima\x20gambar;\x20Misalnya,\x20kamu\x20bisa\x20mengirim\x205\x20video\x20ke\x201.000\x20penerima.', '#abc-2', 'Hingga\x205.000\x20Penerima\x20Video\x20Bulanan', '#abcdesc-2', 'lang', 'Up\x20to\x203\x20minutes\x20livestream\x20to\x201,000\x20recipients.', 'Hingga\x205.000.000\x20Penerima\x20Teks\x20Bulanan', '#or-5', 'right', 'Paket\x20Palio\x20Lite:', '#abcdesc-3', '#abc-3', 'click', '#or-1', '176808yhrTUk', '#or-4', '1672811pXKyaH', 'Nomor\x20Pesanan:', 'Hingga\x20500\x20Menit\x20Bulanan\x201-1\x20Panggilan\x20Video', '#pay-2', '5411WGLGNa', 'Langganan\x20Bulanan\x20(batalkan\x20kapan\x20saja)', ',\x20or', 'Detil\x20Pemesanan:', '167186Kjjiwf', '#pay-8', '#abc-6', 'If\x20you,\x20for\x20example,\x20have\x2010\x20team\x20members,\x20they\x20can\x20have\x205,000\x20(50,000/10)\x20minutes\x20of\x20VoIP\x20Calls\x20between\x20them.', 'Hingga\x203.000\x20Menit\x20Bulanan\x20Penerima\x20Siaran\x20Langsung', '#abcdesc-6', '1sItamt', '415507CxVLZR', 'Up\x20to\x20500\x20Monthly\x20Minutes\x201-1\x20Video\x20Calls', 'Hingga\x2050.000\x20Menit\x20Bulanan\x201-1\x20Panggilan\x20VoIP', 'Up\x20to\x202.5\x20MB\x20for\x20each\x20video.\x20For\x20each\x20video\x20sent,\x20the\x20credit\x20will\x20be\x20deducted\x20by\x20the\x20number\x20of\x20recipients\x20of\x20the\x20image;\x20For\x20example,\x20you\x20can\x20send\x205\x20videos\x20to\x201,000\x20recipients.', '73VzJScX', '1ndqmLv', 'Hingga\x201.000\x20karakter\x20untuk\x20setiap\x20teks.\x20Untuk\x20setiap\x20teks\x20yang\x20dikirim,\x20kredit\x20akan\x20dikurangi\x20dengan\x20jumlah\x20penerima\x20pesan.\x20Misalnya,\x20kamu\x20bisa\x20mengirim\x205.000\x20teks\x20ke\x201.000\x20penerima.', 'Paket', '.credit-hint', '#pay-10', '#or-2', '#abc-4', ',\x20atau', '#abc-1', 'Up\x20to\x2050,000\x20Monthly\x20Image\x20Recipients', '#pay-7', '#abcdesc-1', 'Tanggal\x20Pesanan:', '568070cnnXJw', '#abcdesc-5', '290237rEjQOc', 'Hingga\x2050.000\x20Penerima\x20Gambar\x20Bulanan', '#or-3', 'Up\x20to\x205,000,000\x20Monthly\x20Text\x20Recipients', 'text', 'Hanya\x20Satu\x20Bulan\x20(kamu\x20akan\x20mendapat\x20pemberitahuan\x20mendekati\x20tanggal\x20jatuh\x20tempo)', 'tooltip', '#pay-11', 'a.credit-hint', '#abcdesc-4', '#abc-5', 'Contoh:\x2010\x20anggota\x20tim,\x20mereka\x20dapat\x20memiliki\x20Video\x20Call\x2050\x20(500/10)\x20menit\x20di\x20antara\x20mereka.'];
      var _0x52d1 = function(_0x16f865, _0x10af4b) {
        _0x16f865 = _0x16f865 - 0x149;
        var _0x49f349 = _0x49f3[_0x16f865];
        return _0x49f349;
      };
      var _0x28bfbd = _0x52d1;
      (function(_0x487d3d, _0x4ae0ab) {
        var _0x1826f6 = _0x52d1;
        while (!![]) {
          try {
            var _0x5262eb = parseInt(_0x1826f6(0x183)) * parseInt(_0x1826f6(0x174)) + parseInt(_0x1826f6(0x181)) + -parseInt(_0x1826f6(0x16f)) * -parseInt(_0x1826f6(0x16e)) + parseInt(_0x1826f6(0x15e)) + parseInt(_0x1826f6(0x173)) * parseInt(_0x1826f6(0x164)) + parseInt(_0x1826f6(0x168)) + -parseInt(_0x1826f6(0x160));
            if (_0x5262eb === _0x4ae0ab) break;
            else _0x487d3d['push'](_0x487d3d['shift']());
          } catch (_0x357836) {
            _0x487d3d['push'](_0x487d3d['shift']());
          }
        }
      }(_0x49f3, 0x53020));
      if (localStorage[_0x28bfbd(0x154)] == 0x0) change_lang(), $(_0x28bfbd(0x17c))[_0x28bfbd(0x187)](_0x28bfbd(0x186)), $(_0x28bfbd(0x151))['text'](_0x28bfbd(0x17d)), $('#abc-3')[_0x28bfbd(0x187)]('Up\x20to\x205,000\x20Monthly\x20Video\x20Recipients'), $(_0x28bfbd(0x17a))['text']('Up\x20to\x203,000\x20Monthly\x20Minutes\x20Livestream\x20Recipients'), $(_0x28bfbd(0x14e))[_0x28bfbd(0x187)]('Up\x20to\x2050,000\x20Monthly\x20Minutes\x201-1\x20VoIP\x20Calls'), $(_0x28bfbd(0x16a))[_0x28bfbd(0x187)](_0x28bfbd(0x170)), $('#or-1')['text'](_0x28bfbd(0x166)), $(_0x28bfbd(0x179))[_0x28bfbd(0x187)](_0x28bfbd(0x166)), $(_0x28bfbd(0x185))[_0x28bfbd(0x187)](',\x20or'), $(_0x28bfbd(0x15f))[_0x28bfbd(0x187)](_0x28bfbd(0x166)), $(_0x28bfbd(0x157))[_0x28bfbd(0x187)](_0x28bfbd(0x166)), $(_0x28bfbd(0x17f))[_0x28bfbd(0x187)]('Up\x20to\x201,000\x20chars\x20for\x20each\x20text.\x20For\x20each\x20text\x20sent,\x20the\x20credit\x20will\x20be\x20deducted\x20by\x20the\x20number\x20of\x20recipients\x20of\x20the\x20message.\x20For\x20example,\x20you\x20can\x20send\x205,000\x20texts\x20to\x201,000\x20recipients.'), $(_0x28bfbd(0x153))[_0x28bfbd(0x187)]('Up\x20to\x20250\x20KB\x20for\x20each\x20image.\x20For\x20each\x20image\x20sent,\x20the\x20credit\x20will\x20be\x20deducted\x20by\x20the\x20number\x20of\x20recipients\x20of\x20the\x20image;\x20For\x20example,\x20you\x20can\x20send\x2050\x20images\x20to\x201,000\x20recipients.'), $(_0x28bfbd(0x15a))['text'](_0x28bfbd(0x172)), $(_0x28bfbd(0x14d))[_0x28bfbd(0x187)](_0x28bfbd(0x155)), $(_0x28bfbd(0x182))[_0x28bfbd(0x187)](_0x28bfbd(0x16b)), $(_0x28bfbd(0x16d))[_0x28bfbd(0x187)]('If\x20you,\x20for\x20example,\x20have\x2010\x20team\x20members,\x20they\x20can\x20have\x2050\x20(500/10)\x20minutes\x20of\x20Video\x20Calls\x20between\x20them.');
      else localStorage[_0x28bfbd(0x154)] == 0x1 && (change_lang(), $('#pay-1')['text'](_0x28bfbd(0x167)), $(_0x28bfbd(0x163))[_0x28bfbd(0x187)](_0x28bfbd(0x161)), $('#pay-3')[_0x28bfbd(0x187)](_0x28bfbd(0x180)), $(_0x28bfbd(0x17e))['text'](_0x28bfbd(0x159)), $(_0x28bfbd(0x169))[_0x28bfbd(0x187)](_0x28bfbd(0x176)), $(_0x28bfbd(0x178))[_0x28bfbd(0x187)](_0x28bfbd(0x165)), $(_0x28bfbd(0x14b))[_0x28bfbd(0x187)](_0x28bfbd(0x149)), $('#cancel')['val']('BATAL'), $('#abc-1')[_0x28bfbd(0x187)](_0x28bfbd(0x156)), $(_0x28bfbd(0x151))[_0x28bfbd(0x187)](_0x28bfbd(0x184)), $(_0x28bfbd(0x15b))[_0x28bfbd(0x187)](_0x28bfbd(0x152)), $('#abc-4')[_0x28bfbd(0x187)](_0x28bfbd(0x16c)), $(_0x28bfbd(0x14e))[_0x28bfbd(0x187)](_0x28bfbd(0x171)), $(_0x28bfbd(0x16a))['text'](_0x28bfbd(0x162)), $(_0x28bfbd(0x15d))[_0x28bfbd(0x187)](_0x28bfbd(0x17b)), $(_0x28bfbd(0x179))[_0x28bfbd(0x187)](',\x20atau'), $(_0x28bfbd(0x185))[_0x28bfbd(0x187)](_0x28bfbd(0x17b)), $(_0x28bfbd(0x15f))['text'](_0x28bfbd(0x17b)), $('#or-5')[_0x28bfbd(0x187)](_0x28bfbd(0x17b)), $(_0x28bfbd(0x17f))['text'](_0x28bfbd(0x175)), $(_0x28bfbd(0x153))[_0x28bfbd(0x187)]('Hingga\x20250\x20KB\x20untuk\x20setiap\x20gambar.\x20Untuk\x20setiap\x20gambar\x20yang\x20dikirim,\x20kredit\x20akan\x20dikurangi\x20dengan\x20jumlah\x20penerima\x20gambar;\x20Misalnya,\x20kamu\x20bisa\x20mengirim\x2050\x20gambar\x20ke\x201.000\x20penerima.'), $('#abcdesc-3')[_0x28bfbd(0x187)](_0x28bfbd(0x150)), $(_0x28bfbd(0x14d))[_0x28bfbd(0x187)]('Livestreaming\x20hingga\x203\x20menit\x20untuk\x201.000\x20penonton.'), $('#abcdesc-5')[_0x28bfbd(0x187)]('Contoh:\x20untuk\x2010\x20anggota\x20tim,\x20mereka\x20dapat\x20melakukan\x205.000\x20(50.000\x20/\x2010)\x20menit\x20Panggilan\x20VoIP\x20di\x20antara\x20mereka.'), $('#abcdesc-6')[_0x28bfbd(0x187)](_0x28bfbd(0x14f)));
      $(_0x28bfbd(0x14c))[_0x28bfbd(0x15c)](function(_0x3e6f73) {
        _0x3e6f73['preventDefault']();
      }), $(_0x28bfbd(0x177))[_0x28bfbd(0x14a)]({
        'placement': _0x28bfbd(0x158)
      });
    });


    // to show developer button
    // function appearDev() {
    //   var x = document.getElementById("devonly");
    //   if (x.style.display === "none") {
    //     x.style.display = "block";
    //   } else {
    //     x.style.display = "none";
    //   }
    // }
    // end developer button
  </script>

  <script>
    const company_id = <?php echo $company_id ?>;
    const clientId = "AaIDxN07-OfsTeeqPXhMG-BpfLAVhBah94jfutKGersh9uIKkU5kgupWXiWRDxtfsnFF1rnjYTCeNGCi";
    const components = "buttons";
    let buttons;

    function cleanupBeforeReload() {
      if (buttons) {
        buttons.close();
      }
    }

    function loadAndRender(transactionType) {
      if (transactionType === "order") {
        window
          .paypalLoadScript({
            "client-id": clientId,
            components
          })
          .then(() => {
            render({
              style: {
                shape: "pill",
                color: "gold",
                layout: "vertical",
                label: "pay"
              },
              createOrder: function(data, actions) {
                // please wait modal
                $('#creditModalCenter').modal('show');
                return actions.order.create({
                  purchase_units: [{
                    "description": "Palio.io monthly subscription fee",
                    "amount": {
                      "currency_code": "USD",
                      "value": 33.5
                    }
                  }]
                });
              },
              onCancel: function(data) {
                $('#creditModalCenter').modal('hide');
              },
              onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {
                  // in case internet down after pay to paypal, set the status locally
                  localStorage.isPaid = '1';

                  // update state user after success payment
                  var js = {
                    company_id: company_id,
                  };
                  $.post("state_update", js,
                    function(data, status) {
                      // alert("Data: " + data + "\nStatus: " + status);
                      console.log("Data: " + data + "\nStatus: " + status);
                    });
                  // end update state

                  alert('Transaction completed by ' + details.payer.name.given_name + '!');

                  // redirect to dashboard and store data to db
                  $("#todashboard").click();
                });
              }
            });
          });
      } else {
        window
          .paypalLoadScript({
            "client-id": clientId,
            vault: true,
            intent: "subscription",
            components
          })
          .then(() => {
            render({
              style: {
                shape: "pill",
                color: "gold",
                layout: "vertical",
                label: "subscribe"
              },
              createSubscription: function(data, actions) {
                // please wait modal
                $('#creditModalCenter').modal('show');
                return actions.subscription.create({
                  plan_id: "P-06918665NC7435338MAD2CSI"
                });
              },
              onCancel: function(data) {
                $('#creditModalCenter').modal('hide');
              },
              onApprove: function(data, actions) {
                // in case internet down after pay to paypal, set the status locally
                localStorage.isPaid = '1';

                // update state user after success payment
                var js = {
                  company_id: company_id,
                };
                $.post("state_update", js,
                  function(data, status) {
                    // alert("Data: " + data + "\nStatus: " + status);
                    console.log("Data: " + data + "\nStatus: " + status);
                  });
                // end update state

                alert(data.subscriptionID);

                // redirect to dashboard and store data to db
                $("#todashboard").click();
              }
            });
          });
      }
    }

    const debounce = (func, wait) => {
      let timeout;

      return function executedFunction(...args) {
        const later = () => {
          clearTimeout(timeout);
          func(...args);
        };

        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
      };
    };

    const debouncedLoadAndRender = debounce(loadAndRender, 500);

    function onClickCallback(event) {
      cleanupBeforeReload();
      debouncedLoadAndRender(event.target.value);
    }

    document.querySelectorAll('input[name="intent"]').forEach((radio) => {
      radio.addEventListener("click", onClickCallback);
    });

    function render(options) {
      buttons = paypal.Buttons(options);
      buttons.render("#paypal-button-container").catch((err) => {
        console.warn(
          "Warning - Caught an error when attempting to render component",
          err
        );
      });
    }

    loadAndRender("subscription");
  </script>

</body>

<script>
  function demoFromHTML() {
    var pdf = new jsPDF('p', 'pt', 'letter');
    // source can be HTML-formatted string, or a reference
    // to an actual DOM element from which the text will be scraped.
    source = $('#invoice')[0];

    localStorage.capture = source.outerHTML;
    localStorage.username = "<?php echo $dataUser['USERNAME']; ?>";
    localStorage.orderdate = "<?php echo date("F d, Y"); ?>";
    localStorage.product = "<?php echo $dataCompany['PRODUCT_INTEREST']; ?>";
    localStorage.price = "<?php echo $price_item_amount; ?>";
    localStorage.email = "<?php echo $email; ?>";
    localStorage.ordernumber = "<?php echo $subscriptionData['ORDER_NUMBER']; ?>";

  }

  demoFromHTML();

  if (localStorage.lang == 1) {
    $("#credit-card-button").text("Kartu Kredit / Kartu Debit");
    $("#pay-with-credit-card").attr('value', 'Bayar dengan Kartu Kredit');
    $('#exp-month-paycheckout').text('Bulan Kadaluarsa');
    $('#exp-year-paycheckout').text('Tahun Kadaluarsa');
  }

  $("#credit-card-number").bind("change space keyup", function() {
    $(this).val($(this).val().replace(/[^0-9]/g, ''));
  });

  $("#credit-card-exp-year").bind("change space keyup", function() {
    $(this).val($(this).val().replace(/[^0-9]/g, ''));
  });

  $("#credit-card-cvv").bind("change space keyup", function() {
    $(this).val($(this).val().replace(/[^0-9]/g, ''));
  });
</script>

</html>