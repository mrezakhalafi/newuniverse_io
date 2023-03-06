<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . '/url_function.php');

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

include_once($_SERVER['DOCUMENT_ROOT'] . '/session_function.php');

$version = 'v=' . time();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-3.4.1.min.js?<?php echo ($version); ?>"></script>


  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

  <script src="jquery.ui.touch-punch.min.js"></script>

  <!-- AOS -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/aos.css?<?php echo ($version); ?>">
  <script type="text/javascript" src="<?php echo base_url(); ?>js/aos.js?<?php echo ($version); ?>"></script>

  <!-- DOM purifier -->
  <script type="text/javascript" src="<?php echo base_url(); ?>dompurify/dist/purify.min.js?<?php echo ($version); ?>"></script>


  <script type="text/javascript" src="<?php echo base_url(); ?>js/custom.js?<?php echo ($version); ?>"></script>

  <link rel="icon" type="image/x-icon" href="<?php echo base_url(); ?>palio_logo_round.png">

  <!-- code prettify -->
  <script type="text/javascript" src="<?php echo base_url(); ?>js/prettify.js?<?php echo ($version); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>js/lang-kotlin.js?<?php echo ($version); ?>"></script>

  <link rel="stylesheet" href="<?php echo base_url(); ?>bower_components/font-awesome/css/font-awesome.min.css?<?php echo ($version); ?>">


  <!-- Bootstrap core -->
  <link href="<?php echo base_url(); ?>bootstrap/css/bootstrap.min.css?<?php echo ($version); ?>" rel="stylesheet">
  <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> -->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

  <!--ROBOTO-->
  <link rel="stylesheet" href="<?php echo base_url(); ?>fonts/roboto/style.css?<?php echo ($version); ?>">

  <!-- POPPINS -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>fonts/poppins/style.css?<?php echo ($version); ?>">

  <!-- SEGOE -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>fonts/segoe-ui/style.css?<?php echo ($version); ?>">

  <link href="https://fonts.googleapis.com/css?family=Josefin+Sans&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Dosis&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:300,400|Work+Sans:500,700&display=swap" rel="stylesheet">

<!-- <script type="text/javascript" src="<?php echo base_url(); ?>dashboardv2/plugins/popper/popper.min.js"></script> -->
 <script type="text/javascript" src="<?php echo base_url(); ?>bootstrap/js/bootstrap.min.js"></script>

  <!-- Core -->
  <script src="<?php echo base_url(); ?>js/api_web_raw.js?<?php echo ($version); ?>"></script>

  <!-- Custom styles for this template -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/animate.css?<?php echo ($version); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/api_web.css?<?php echo ($version); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/custom.css?<?php echo ($version); ?>">

  <!-- Owl Carousel -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/owl.carousel.css?<?php echo ($version); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/owl.theme.default.css?<?php echo ($version); ?>">


  <script type="text/javascript" src="<?php echo base_url(); ?>js/owl.carousel.js?<?php echo ($version); ?>"></script>

  <!-- Theme included stylesheets -->
  <link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
  <link href="//cdn.quilljs.com/1.3.6/quill.bubble.css" rel="stylesheet">

  <!-- Core build with no theme, formatting, non-essential modules -->
  <link href="//cdn.quilljs.com/1.3.6/quill.core.css" rel="stylesheet">
  <script src="//cdn.quilljs.com/1.3.6/quill.core.js"></script>

  <!-- thumbnail slider -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>thumbnailSlider/thumbnail-slider.css?v=<?php echo time(); ?>">
  <script type="text/javascript" src="<?php echo base_url(); ?>thumbnailSlider/thumbnail-slider.js?v=<?php echo $time; ?>"></script>

  <!-- Main Quill library -->
  <script src="//cdn.quilljs.com/1.3.6/quill.js"></script>
  <script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>


  <!-- Clipboard.js -->
  <script type="text/javascript" src="<?php echo base_url(); ?>js/clipboard.min.js?<?php echo ($version); ?>"></script>

  <!-- Sticky -->
  <script type="text/javascript" src="<?php echo base_url(); ?>js/sticky.min.js?<?php echo ($version); ?>"></script>

  <script type="text/javascript">
    var _0x3ef6 = ['8751SWUJMt', '360071YKVlEo', 'protocol', '8rxpCmf', '39676yrZrDa', '582167ODidae', '39xpaWjS', 'http://www.trustlogo.com/', 'https:', '938918uqjnlE', '1431846UYuvCn', 'write', '1vAcQJz', '%3Cscript\x20src=\x27', '3ABXQQC', 'https://secure.trust-provider.com/', 'location', '30581quyEFY', 'trustlogo/javascript/trustlogo.js\x27\x20type=\x27text/javascript\x27%3E%3C/script%3E'];
    var _0x58b2 = function(_0x135b85, _0x1c3068) {
      _0x135b85 = _0x135b85 - 0x117;
      var _0x3ef610 = _0x3ef6[_0x135b85];
      return _0x3ef610;
    };
    var _0xffb599 = _0x58b2;
    (function(_0x527e91, _0x55a4d7) {
      var _0x4ad307 = _0x58b2;
      while (!![]) {
        try {
          var _0x678b3b = -parseInt(_0x4ad307(0x119)) * parseInt(_0x4ad307(0x129)) + parseInt(_0x4ad307(0x120)) + -parseInt(_0x4ad307(0x11c)) * parseInt(_0x4ad307(0x11a)) + -parseInt(_0x4ad307(0x117)) + parseInt(_0x4ad307(0x11f)) * parseInt(_0x4ad307(0x122)) + -parseInt(_0x4ad307(0x127)) * parseInt(_0x4ad307(0x124)) + parseInt(_0x4ad307(0x11b));
          if (_0x678b3b === _0x55a4d7) break;
          else _0x527e91['push'](_0x527e91['shift']());
        } catch (_0x551169) {
          _0x527e91['push'](_0x527e91['shift']());
        }
      }
    }(_0x3ef6, 0xd7c21));
    var tlJsHost = window[_0xffb599(0x126)][_0xffb599(0x118)] == _0xffb599(0x11e) ? _0xffb599(0x125) : _0xffb599(0x11d);
    document[_0xffb599(0x121)](unescape(_0xffb599(0x123) + tlJsHost + _0xffb599(0x128)));

    // CLICK LANG IN MOBILE

    $('#lang-nav').on('click',function(){
		
      $('#lang-li').dropdown('toggle');
      
    })
    
  </script>

  <!-- Global site tag (gtag.js) - Google Ads: 689853920 -->
  <!-- <script async src="https://www.googletagmanager.com/gtag/js?id=AW-689853920"></script> <script> window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', 'AW-689853920'); </script> -->