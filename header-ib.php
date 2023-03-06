<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/url_function.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/session_function.php');
// session_start();
$version = 'v=1.28';

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-3.4.1.min.js?<?php echo ($version); ?>"></script>

  <!-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script> -->

  <!-- rangeslider JS & CSS -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>css/ion.rangeSlider.css?<?php echo ($version); ?>" />
  <script src="<?php echo base_url(); ?>js/ion.rangeSlider.js?<?php echo ($version); ?>"></script>

  <!-- AOS -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/aos.css?<?php echo ($version); ?>">
  <script type="text/javascript" src="<?php echo base_url(); ?>js/aos.js?<?php echo ($version); ?>"></script>


  <!-- Core -->
  <!--   <script async language="JavaScript" type="text/javascript" src="core/message/hmc.js?v=1.3.2.40"></script>
  <script async language="JavaScript" type="text/javascript" src="core/app/app.js?v=1.3.2.40"></script>
  <script async language="JavaScript" type="text/javascript" src="core/app/wsc.js?v=1.3.2.40"></script>
  <script async language="JavaScript" type="text/javascript" src="core/app/jprocess.js?<?php //echo($version);
                                                                                        ?>"></script>
  <script async language="JavaScript" type="text/javascript" src="core/app/jprocess_sync.js?v=1.3.2.40"></script>
  <script async language="JavaScript" type="text/javascript" src="core/app/juploader.js?v=1.3.2.40"></script>
  <script async language="JavaScript" type="text/javascript" src="core/my-lib.js?v=1.3.2.40"></script>
  <script async language="JavaScript" type="text/javascript" src="core/message/message.js?v=1.3.2.40"></script>
  <script async language="JavaScript" type="text/javascript" src="core/message/dataheadercontent.js?v=1.3.2.40"></script>
  <script async language="JavaScript" type="text/javascript" src="core/message/sender.js?v=1.3.2.40"></script>
  <script async language="JavaScript" type="text/javascript" src="core/message/receiver.js?<?php //echo($version);
                                                                                            ?>"></script>
  <script async type="text/javascript" src="core/my-lib.js?v=1.3.2.40"></script>
  <script async type="text/javascript" src="core/my-component.js?v=1.3.2.40"></script>
  <script async type="text/javascript" src="core/message/message.js?v=1.3.2.40"></script>
  <script async type="text/javascript" src="core/message/sender.js?v=1.3.2.40"></script>  -->
  <script src="<?php echo base_url(); ?>js/api_web.js?<?php echo ($version); ?>"></script>

  <!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->

  <script type="text/javascript" src="./js/custom.js?<?php echo ($version); ?>"></script>

  <link rel="icon" type="image/x-icon" href="<?php echo base_url(); ?>ib_logo.ico">

  <!-- code prettify -->
  <script type="text/javascript" src="<?php echo base_url(); ?>js/prettify.js?<?php echo ($version); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>js/lang-kotlin.js?<?php echo ($version); ?>"></script>
  <!-- <link rel="stylesheet" type="text/css" href="./css/prettify.css"> -->

  <link rel="stylesheet" href="<?php echo base_url(); ?>bower_components/font-awesome/css/font-awesome.min.css?<?php echo ($version); ?>">
  <!-- <link rel=”stylesheet” href=”https://use.fontawesome.com/releases/v5.7.0/css/all.css” integrity=”sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ” crossorigin=”anonymous”> -->

  <!-- Bootstrap core CSS -->
  <link href="<?php echo base_url(); ?>bootstrap/css/bootstrap.min.css?<?php echo ($version); ?>" rel="stylesheet">

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
  <!-- <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:300,400&display=swap" rel="stylesheet"> -->

  <!-- Custom styles for this template -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/animate.css?<?php echo ($version); ?>">
  <!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/api_web.css?<?php echo ($version); ?>"> -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/ib.css?<?php echo ($version); ?>">
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

  <!-- Main Quill library -->
  <script src="//cdn.quilljs.com/1.3.6/quill.js"></script>
  <script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>


  <!-- Clipboard.js -->
  <script type="text/javascript" src="<?php echo base_url(); ?>js/clipboard.min.js?<?php echo ($version); ?>"></script>

  <!-- Sticky -->
  <script type="text/javascript" src="<?php echo base_url(); ?>js/sticky.min.js?<?php echo ($version); ?>"></script>
  <!-- <script type="text/javascript" src="./js/zebra_pin.min.js"></script> -->

  <script type="text/javascript">
    //<![CDATA[
    var tlJsHost = ((window.location.protocol == "https:") ? "https://secure.trust-provider.com/" : "http://www.trustlogo.com/");
    document.write(unescape("%3Cscript src='" + tlJsHost + "trustlogo/javascript/trustlogo.js' type='text/javascript'%3E%3C/script%3E"));
    //]]>
  </script>