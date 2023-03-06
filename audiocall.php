<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/header-alt.php'); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/audiocall-meta.php'); ?>
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

  .productBanner-alt{
    background-image: url('newAssets/product/bi4.webp') !important;
    background-color: unset;
  }

  * {
    box-sizing: border-box;
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

  <div class="row px-5 pt-5 mb-5 pb-5">
    <div class="col-md-6 d-flex justify-content-center">
      <img src="<?php echo base_url(); ?>newAssets/product/Audio Call/Voice Call.png" alt="" style="width: 80%;" class="img-fluid align-self-center">
    </div>
    <div class="col-md-6 pt-5">
      <h1 data-translate="audiocall-1" class="mb-3 fontRobBold" style="font-size: 40px; color: #262626;"></h1>
      <p data-translate="audiocall-2" class="text-left pr-0 pr-lg-5 fs-20" style="font-family: 'Josefin Sans'; font-weight: 300 !important; color:#262626;">
        <?php if (!isset($_SESSION['id_company'])) { ?>
          <!-- <a href="newpricing.php#pay" class="btn nav-menu-btn-alt mx-0">Subscription</a> -->
        <?php } ?>
    </div>
  </div>

</header>

<div class="container-fluid my-5">
  <div class="row flex-column-reverse flex-md-row justify-content-center" data-aos-duration="1000" data-aos="fade-right">
    <div class="col-md-5 d-flex">
      <div class="col-md-12 align-self-center">
        <h2 data-translate="audiocall-3" class="fontRobBold fs-35" style="color:#01686d;"></h2>
        <br>
        <h3 data-translate="audiocall-4" class="fs-20" style="font-family: 'Josefin Sans'; font-weight: 300 !important;"></h3>
      </div>
    </div>
    <div class="col-md-5 d-flex justify-content-center order-last">
      <img src="<?php echo base_url(); ?>newAssets/product/Audio Call/Crystal clear.png" alt="" class="img-fluid align-self-center" style="max-height: 270px; width: auto;">
    </div>
  </div>
  <br>
  <div class="row justify-content-center productMidBanner" data-aos-duration="1000" data-aos="fade-right">
    <div class="col-md-5 d-flex justify-content-center my-3 py-5">
      <img src="<?php echo base_url(); ?>newAssets/product/Audio Call/1-1.png" alt="" class="img-fluid align-self-center" style="max-height: 270px; width: auto;">
    </div>
    <div class="col-md-5 d-flex">
      <div class="col-md-12 align-self-center">
        <h2 data-translate="audiocall-5" class="fontRobBold fs-35" style="color:#01686d;"></h2>
        <br>
        <h3 data-translate="audiocall-6" class="fs-20" style="font-family: 'Josefin Sans'; font-weight: 300 !important;"></h3>
      </div>
    </div>
  </div>
  <br>
  <div class="row flex-column-reverse flex-md-row justify-content-center" data-aos-duration="1000" data-aos="fade-right">
    <div class="col-md-5 d-flex">
      <div class="col-md-12 align-self-center">
        <h2 data-translate="audiocall-7" class="fontRobBold fs-35" style="color:#01686d;"></h2>
        <br>
        <h3 data-translate="audiocall-8" class="fs-20" style="font-family: 'Josefin Sans'; font-weight: 300 !important;"></h3>
      </div>
    </div>
    <div class="col-md-5 d-flex justify-content-center order-last my-3 py-5">
      <img src="<?php echo base_url(); ?>newAssets/product/Audio Call/Screensharing.png" alt="" class="img-fluid align-self-center" style="max-height: 270px; width: auto;">
    </div>
  </div>
  <br>
  <div class="row justify-content-center productMidBanner" data-aos-duration="1000" data-aos="fade-right">
    <div class="col-md-5 d-flex justify-content-center my-3 py-5">
      <img src="<?php echo base_url(); ?>newAssets/product/Audio Call/Whiteboarding.png" alt="" class="img-fluid align-self-center" style="max-height: 270px; width: auto;">
    </div>
    <div class="col-md-5 d-flex">
      <div class="col-md-12 align-self-center">
        <h2 data-translate="audiocall-9" class="fontRobBold fs-35" style="color:#01686d;"></h2>
        <br>
        <h3 data-translate="audiocall-10" class="fs-20" style="font-family: 'Josefin Sans'; font-weight: 300 !important;"></h3>
      </div>
    </div>
  </div>
  <br>
  <div class="row flex-column-reverse flex-md-row justify-content-center" data-aos-duration="1000" data-aos="fade-right">
    <div class="col-md-5 d-flex">
      <div class="col-md-12 align-self-center">
        <h2 data-translate="audiocall-11" class="fontRobBold fs-35" style="color:#01686d;"></h2>
        <br>
        <h3 data-translate="audiocall-12" class="fs-20" style="font-family: 'Josefin Sans'; font-weight: 300 !important;"></h3>
      </div>
    </div>
    <div class="col-md-5 d-flex justify-content-center order-last my-3 py-5">
      <img src="<?php echo base_url(); ?>newAssets/product/Audio Call/pbx.png" alt="" class="img-fluid align-self-center" style="max-height: 270px; width: auto;">
    </div>
  </div>
</div>




<?php //require_once($_SERVER['DOCUMENT_ROOT'] . '/contact-alt-products.php'); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/contact-button.php'); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/footer-alt.php'); ?>