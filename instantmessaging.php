<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/header-alt.php'); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/im-meta.php'); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/index-nav.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/db_conn.php'); ?>
<?php

$_SESSION['previous_page'] = $_SESSION['current_page'];
$_SESSION['current_page'] = 2;
require_once($_SERVER['DOCUMENT_ROOT'] . '/state_control.php');

?>

<style>
  body {
    font-family: Arial, Helvetica, sans-serif;
  }

  * {
    box-sizing: border-box;
  }

  .productBanner-alt{
    background-image: url('newAssets/product/bi6.webp') !important;
    background-color: unset;
  }

  /* Button used to open the contact form - fixed at the bottom of the page */

  .form-popup {
    display: none;
    position: fixed;
    top: 30%;
    border: 1px solid #4285F4;
    z-index: 1;
  }


  /* Add styles to the form container */
  .form-container {
    max-width: 350px;
    padding: 10px;
    background-color: white;
  }

  /* Full-width input fields */
  .form-container input[type=text],
  .form-container input[type=password] {
    width: 100%;
    padding: 15px;
    margin: 5px 0 10px 0;
    border: none;
    background: #f1f1f1;
  }

  /* When the inputs get focus, do something */
  .form-container input[type=text]:focus,
  .form-container input[type=password]:focus {
    background-color: #ddd;
    outline: none;
  }

  @media screen and (max-width:600px) {
    ul.nav-tabs {
      padding-left: 0 !important;
    }

    .nav-tabs {
      display: flex;
    }

    .nav-tabs li {
      display: flex;
      flex: 1;
    }

    .nav-tabs li a {
      flex: 1;
    }
  }

  @media screen and (min-width:768px) {
    .copy-snippet {
      display: block;
    }
  }

  .overlay {
    display: flex;
    position: absolute;
    background-color: white;
    opacity: .4;
    justify-content: center;
    align-items: center;
    color: black;
    right: 0;
    left: 0;
    font-size: 300%;
  }
</style>

<header class="productBanner-alt">

  <div class="row px-5 pt-5 mt-2 mb-5 pb-5">
    <div class="col-md-6 d-flex justify-content-center">
      <img src="<?php echo base_url(); ?>newAssets/product/UM/UM.png" alt="" style="width: 80%;" class="img-fluid align-self-center">
    </div>
    <div class="col-md-5 pt-5">
      <h1 data-translate='unifiedmessage-1' class="mb-3 fontRobBold fs-40" style="color: #262626;"></h1>
      <p data-translate='unifiedmessage-2' class=" text-left pr-0 pr-lg-5" style="font-family: 'Josefin Sans'; font-weight: 300 !important; font-size: 19px; color: #262626;"></p>
      <?php if (!isset($_SESSION['id_company'])) { ?>
        <!-- <a href="newpricing.php#pay" class="btn nav-menu-btn-alt mx-0">Subscription</a> -->
      <?php } ?>
    </div>
  </div>

</header>

<div class="container-fluid my-5">
  <div class="row py-5 flex-column-reverse flex-md-row justify-content-center" data-aos-duration="1000" data-aos="fade-right">
    <div class="col-md-5 d-flex">
      <div class="col-md-12 align-self-center">
        <h2 data-translate='unifiedmessage-3' class="fontRobBold fs-35" style="color:#01686d;"></h2>
        <br>
        <h3 data-translate='unifiedmessage-4' class="fs-20" style="font-family: 'Josefin Sans'; font-weight: 300 !important; font-size: 19px;"></h3>
      </div>
    </div>
    <div class="col-md-5 d-flex justify-content-center">
      <img src="<?php echo base_url(); ?>newAssets/product/UM/Multiple Channel.png" alt="" class="img-fluid align-self-center" style="max-height: 270px; width: auto;">
    </div>
  </div>
  <br>
  <div class="row py-5 justify-content-center productMidBanner" data-aos-duration="1000" data-aos="fade-right">
    <div class="col-md-5 d-flex justify-content-center py-5">
      <img src="<?php echo base_url(); ?>newAssets/product/UM/direct _ group chat.png" alt="" class="img-fluid align-self-center" style="max-height: 270px; width: auto;">
    </div>
    <div class="col-md-5 d-flex">
      <div class="col-md-12 align-self-center">
        <h2 data-translate='unifiedmessage-5' class="fontRobBold fs-35" style="color:#01686d;"></h2>
        <br>
        <h3 data-translate='unifiedmessage-6' class="fs-20" style="font-family: 'Josefin Sans'; font-weight: 300 !important; font-size: 19px;"></h3>
      </div>
    </div>
  </div>
  <br>
  <div class="row py-5 flex-column-reverse flex-md-row justify-content-center" data-aos-duration="1000" data-aos="fade-right">
    <div class="col-md-5 d-flex">
      <div class="col-md-12 align-self-center">
        <h2 data-translate='unifiedmessage-7' class="fontRobBold fs-35" style="color:#01686d;"></h2>
        <br>
        <h3 data-translate='unifiedmessage-8' class="fs-20" style="font-family: 'Josefin Sans'; font-weight: 300 !important; font-size: 19px;"></h3>
      </div>
    </div>
    <div class="col-md-5 d-flex justify-content-center py-5">
      <img src="<?php echo base_url(); ?>newAssets/product/UM/Attachment.png" alt="" class="img-fluid align-self-center" style="max-height: 270px; width: auto;">
    </div>
  </div>
  <br>
  <div class="row py-5 justify-content-center productMidBanner" data-aos-duration="1000" data-aos="fade-right">
    <div class="col-md-5 d-flex justify-content-center py-5">
      <img src="<?php echo base_url(); ?>newAssets/product/UM/Various Message Modes.png" alt="" class="img-fluid align-self-center" style="max-height: 270px; width: auto;">
    </div>
    <div class="col-md-5 d-flex">
      <div class="col-md-12 align-self-center">
        <h2 data-translate='unifiedmessage-9' class="fontRobBold fs-35" style="color:#01686d;"></h2>
        <br>
        <p class="my-3" style="font-family: 'Josefin Sans'; font-weight: 300 !important; font-size: 15px;">
          <span data-translate='unifiedmessage-10' class="fs-20 fontRobMed"></span>
          <br><span fs-15 data-translate='unifiedmessage-11'></span><br>
        </p>
        <p class="my-3" style="font-family: 'Josefin Sans'; font-weight: 300 !important; font-size: 15px;">
          <span data-translate='unifiedmessage-12' class="fs-20 fontRobMed"></span> <br><span data-translate='unifiedmessage-13'></span><br>
        </p>
        <p class="my-3" style="font-family: 'Josefin Sans'; font-weight: 300 !important; font-size: 15px;">
          <span data-translate='unifiedmessage-14' class="fs-20 fontRobMed"></span>
          <br><span data-translate='unifiedmessage-15'></span>
        </p>
      </div>
    </div>
  </div>
  <br>
  <div class="row py-5 flex-column-reverse flex-md-row justify-content-center" data-aos-duration="1000" data-aos="fade-right">
    <div class="col-md-5 d-flex">
      <div class="col-md-12 align-self-center">
        <h2 data-translate='unifiedmessage-16' class="fontRobBold fs-35" style="color:#01686d;"></h2>
        <br>
        <h3 data-translate='unifiedmessage-17' class="fs-20" style="font-family: 'Josefin Sans'; font-weight: 300 !important; font-size: 19px;"></h3>
      </div>
    </div>
    <div class="col-md-5 d-flex justify-content-center py-5">
      <img src="<?php echo base_url(); ?>newAssets/product/UM/Sticker.png" alt="" class="img-fluid align-self-center" style="max-height: 270px; width: auto;">
    </div>
  </div>
</div>

<?php //require_once($_SERVER['DOCUMENT_ROOT'] . '/contact-alt-products.php'); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/contact-button.php'); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/footer-alt.php'); ?>