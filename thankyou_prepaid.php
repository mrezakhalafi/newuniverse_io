<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/url_function.php');
$version = 'v=1';

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="title" content="Palio.io - Customer Engagement Made Easy">
    <meta name="description" content="Palio.io is a simple communication API and UI Kit, designed to be easily embeded into your mobile apps. Build Customer Engagement in minutes and start maximizing communication experience directly to your customer." />
    <meta name="keywords" content="Contact Center, Push Notification, In-App Messaging, Live Streaming, Video Call, Chat, Audio Call, Chatbot, VoIP Call, Video Call, Communication API and UI Kit">
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:site" content="@palio_sdk" />
    <meta name="author" content="">
    <meta property="og:title" content="Palio.io - Simple in-app Communication API and UI Kit" />
    <meta property="og:description" content="Palio.io is a simple communication API and UI Kit, designed to be easily embeded into your mobile apps. Build Customer Engagement in minutes and start maximizing communication experience directly to your customer." />
    <meta property="og:url" content="https://Palio.io/" />
    <meta property="og:image" content="https://Palio.io/assets/new-u-logo-alt.svg" />

    <title>Palio.io - Customer Engagement Made Easy</title>

    <link href="<?php echo base_url(); ?>bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src='/js/jquery-3.4.1.min.js'></script>

    <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-3.4.1.min.js?<?php echo ($version); ?>"></script>

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <script src="jquery.ui.touch-punch.min.js"></script>

    <!-- <script src="taphold.js"></script> -->
    <!-- rangeslider JS & CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/ion.rangeSlider.css?<?php echo ($version); ?>" />
    <script src="<?php echo base_url(); ?>js/ion.rangeSlider.js?<?php echo ($version); ?>"></script>

    <!-- AOS -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/aos.css?<?php echo ($version); ?>">
    <script type="text/javascript" src="<?php echo base_url(); ?>js/aos.js?<?php echo ($version); ?>"></script>
    <script src="<?php echo base_url(); ?>js/api_web.js?<?php echo ($version); ?>"></script>

    <!-- DOM purifier -->
    <script type="text/javascript" src="<?php echo base_url(); ?>dompurify/dist/purify.min.js?<?php echo ($version); ?>"></script>


    <script type="text/javascript" src="<?php echo base_url(); ?>js/custom.js?<?php echo ($version); ?>"></script>

    <link rel="icon" type="image/x-icon" href="<?php echo base_url(); ?>palio_logo_round.png">

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

<body id="wrap">

    <div class="jumbotron text-center">
        <h1 class="display-3">Thank You!</h1>
        <p class="lead">Your payment has been processed successfully.</p>
    </div>
    <div style="margin:60px auto;text-align:center;">
        <hr>
        <img src="new_palio_logo.png" alt="Palio.io" width="200">
        <br><br>
    </div>


</body>

</html>t