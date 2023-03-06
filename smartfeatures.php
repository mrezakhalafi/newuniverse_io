<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/header-alt.php'); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/smartfeatures-meta.php'); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/index-nav.php'); ?>
<?php

$_SESSION['previous_page'] = $_SESSION['current_page'];
$_SESSION['current_page'] = 2;
require_once($_SERVER['DOCUMENT_ROOT'] . '/state_control.php');

?>

<!-- <link rel=”stylesheet” href=”https://use.fontawesome.com/releases/v5.7.0/css/all.css” integrity=”sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ” crossorigin=”anonymous”> -->
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

<style>
  #preview-img {
    transition: all 0.5s ease-in-out;
  }

  #preview-img:hover {
    transform: scale(1.1, 1.1)
  }

  .fontWS {
    font-family: 'Work Sans';
  }

  .fontJosefin {
    font-family: 'Josefin Sans';
    font-weight: 300;
  }

  .productBanner-alt {
    /* background-image: url('newAssets/product/bi7.webp') !important; */
    background-image: linear-gradient(to bottom, #1799ad, #159db166) !important;
    background-color: unset;
  }

  .card {
    border: 0px solid #ccc;
    border-bottom: 2px solid #d0cbcb !important;
    /* border-radius: 5px !important; */
  }

  .card-body {
    background-color: white;
  }

  .card-body-grey {
    background-color: #f4f4f4 !important;
  }

  .card-header {
    /* border-bottom: 2px solid #d0cbcb !important; */
    /* font-family: 'Work Sans'; */
    background-color: rgb(244, 244, 244);
    /* padding: 0.75rem !important; */
    border: none !important;
  }

  .background-less {
    background-color: #fff !important;
  }

  .card-body {
    font-family: 'Poppins';
    font-size: 1rem;
    font-weight: 400;
    padding: 1rem !important;
  }

  .btn-link {
    /* color: #01686d !important; */
    color: black !important;
    padding: .375rem 0 !important;
    font-family: 'Poppins';
    font-weight: bold;
    font-size: 1.3rem;
  }

  .btn-link:hover {
    color: #f2ad33;
  }

  @media screen and (max-width: 600px) {
    .btn-link {
      font-size: 1.1rem;
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

  #preview-img {
    border-radius: 20px;
  }

  .image-top {
    max-width: 500px;
  }

  @media screen and (max-width: 600px) {
    .image-top {
      max-width: 320px;
    }
  }
</style>

<script>
  // var 
  $(document).ready(function() {

    // if ($(window).width() < 992) {
    $('.collapse').on('shown.bs.collapse', function() {
      $(this).parent().find(".fa-chevron-down").removeClass("fa-chevron-down").addClass("fa-chevron-up");
    }).on('hidden.bs.collapse', function() {
      $(this).parent().find(".fa-chevron-up").removeClass("fa-chevron-up").addClass("fa-chevron-down");
    });
    // }

    // if ($(window).width() >= 992) {
    $('.collapse').on('shown.bs.collapse', function() {
      console.log("show", $(this).attr("id"));
      if ($(this).attr("id") == "retail5-body") {
        $("#preview-img").attr("src", "/newAssets/smartfeatures/portrait-man-face-scann.jpg");
      } else if ($(this).attr("id") == "retail6-body") {
        $("#preview-img").attr("src", "/newAssets/smartfeatures/cat-dog.png");
      } else if ($(this).attr("id") == "retail7-body") {
        $("#preview-img").attr("src", "/newAssets/smartfeatures/summarization.jpeg");
      } else if ($(this).attr("id") == "retail2-body") {
        $("#preview-img").attr("src", "/newAssets/smartfeatures/crowdcounting.png");
      } else if ($(this).attr("id") == "retail8-body") {
        $("#preview-img").attr("src", "/newAssets/smartfeatures/Web_Crawler.jpg");
      } else if ($(this).attr("id") == "retail4-body") {
        $("#preview-img").attr("src", "/newAssets/smartfeatures/speechtotext.png");
      } else if ($(this).attr("id") == "retail9-body") {
        $("#preview-img").attr("src", "/newAssets/smartfeatures/translation.png");
      } else if ($(this).attr("id") == "retail10-body") {
        $("#preview-img").attr("src", "/newAssets/smartfeatures/cbppg.jpeg");
      }
      $(this).parent().find(".fa-chevron-down").removeClass("fa-chevron-down").addClass("fa-chevron-up");
    }).on('hidden.bs.collapse', function() {
      console.log("hide", $(this).attr("id"));
      $(this).parent().find(".fa-chevron-up").removeClass("fa-chevron-up").addClass("fa-chevron-down");
    });
    // }
  });
</script>

<header class="productBanner-alt">

  <div class="row px-5 pt-4 mt-3 mb-5 pb-5">
    <div class="col-md-6 d-flex justify-content-center">
      <img src="<?php echo base_url(); ?>newAssets/product/Chatbot/ChatBot.png" alt="" class="img-fluid align-self-center image-top">
    </div>
    <div class="col-md-5 pt-5">
      <h1 data-translate="smartfeatures-19" class="mb-3 fontRobBold" style="font-size: 40px; color: white;"></h1>
      <p data-translate="smartfeatures-20" class="text-left pr-0 pr-lg-5 fs-20" style="font-family: 'Josefin Sans'; color: white;">
      <p data-translate="smartfeatures-38" class="text-left mt-4 pr-0 pr-lg-5 fs-20" style="font-family: 'Josefin Sans'; color: white;">
      </p>
    </div>
  </div>

</header>

<div class="container-fluid my-5">
  <!-- <div class="row flex-column-reverse flex-md-row justify-content-center" data-aos-duration="1000" data-aos="fade-right">
    <div class="col-md-5 d-flex">
      <div class="col-md-12 align-self-center">
        <h2 data-translate="smartfeatures-3" class="fontRobBold fs-35"></h2>
        <br>
        <h3 data-translate="smartfeatures-4" class="fs-20" style="font-family: 'Josefin Sans'; font-weight: 300!important;"></h3>
      </div>
    </div>
    <div class="col-md-5 d-flex justify-content-center order-last">
      <img src="<?php echo base_url(); ?>newAssets/product/Chatbot/Auto reply.png" alt="" class="img-fluid align-self-center" style="max-height: 300px; width: auto;">
    </div>
  </div>
  <br>
  <div class="row justify-content-center productMidBanner" data-aos-duration="1000" data-aos="fade-right">
    <div class="col-md-5 d-flex justify-content-center py-5">
      <img src="<?php echo base_url(); ?>newAssets/product/Video call/1-1.png" alt="" class="img-fluid align-self-center" style="max-height: 300px; width: auto;">
    </div>
    <div class="col-md-5 d-flex">
      <div class="col-md-12 align-self-center">
        <h2 data-translate="smartfeatures-5" class="fontRobBold fs-35"></h2>
        <br>
        <h3 data-translate="smartfeatures-6" class="fs-20" style="font-family: 'Josefin Sans'; font-weight: 300!important;"></h3>
      </div>
    </div>
  </div>
  <br> -->
  <div class="row px-5 mb-5 pb-5">
    <div class="col-md-12 pt-5 text-center">
      <h1 data-translate="smartfeatures-37" class="mb-3 fontRobBold" style="font-size: 2rem;"></h1>
      <!-- <p data-translate="usocial-2" class="text-center pr-0 pr-lg-5 fs-18" style="font-family: 'Poppins',sans-serif; font-weight: 300 !important; color: white;"></p> -->

    </div>
  </div>
  <div class="row flex-column-reverse flex-md-row justify-content-center" data-aos-duration="1000" data-aos="fade-right">
    <div class="col-md-5 d-flex">
      <div class="accordion col-md-12 align-self-center" id="accordionExample2">
        <!-- <div class="card">
          <div class="card-header background-less" id="retail1" data-toggle="collapse" data-target="#retail1-body" aria-expanded="true" aria-controls="retail1-body">
            <h4 class="mb-0">
              <a class="btn-link collapsed">
                <span data-translate="smartfeatures-7"></span>
                <i class="fas fa-chevron-down" style="float: right; margin-top: 10px; color: black; font-size: 1.3rem;"></i></a>
            </h4>
          </div>

          <div id="retail1-body" class="collapse" aria-labelledby="retail1" data-parent="#accordionExample2">
            <div class="card-body">
              <h3 data-translate="smartfeatures-8" class="fs-20" style="font-family: 'Josefin Sans'; font-weight: 300!important;"></h3>
              <br>
              <h3 data-translate="smartfeatures-9" class="fs-20" style="font-family: 'Josefin Sans'; font-weight: 300!important;"></h3>
              <br>
              <h3 data-translate="smartfeatures-10" class="fs-20" style="font-family: 'Josefin Sans'; font-weight: 300!important;"></h3>
              <br>
              <h3 data-translate="smartfeatures-11" class="fs-20" style="font-family: 'Josefin Sans'; font-weight: 300!important;"></h3>
              <br>
              <h3 data-translate="smartfeatures-12" class="fs-20" style="font-family: 'Josefin Sans'; font-weight: 300!important;"></h3>
            </div>
          </div>
        </div> -->
        <div class="card">
          <div class="card-header background-less" id="retail5" data-toggle="collapse" data-target="#retail5-body" aria-expanded="true" aria-controls="retail2-body">
            <h4 class="mb-0">
              <a class="btn-link collapsed">
                <span data-translate="smartfeatures-21"></span>
                <i class="fas fa-chevron-up" style="float: right; margin-top: 10px; color: black; font-size: 1.3rem;"></i></a>

            </h4>
          </div>

          <div id="retail5-body" class="collapse show" aria-labelledby="retail5" data-parent="#accordionExample2">
            <div data-translate="smartfeatures-22" class="card-body"></div>
          </div>
        </div>
        <div class="card">
          <div class="card-header background-less" id="retail6" data-toggle="collapse" data-target="#retail6-body" aria-expanded="true" aria-controls="retail6-body">
            <h4 class="mb-0">
              <a class="btn-link collapsed">
                <span data-translate="smartfeatures-23"></span>
                <i class="fas fa-chevron-down" style="float: right; margin-top: 10px; color: black; font-size: 1.3rem;"></i></a>

            </h4>
          </div>

          <div id="retail6-body" class="collapse" aria-labelledby="retail6" data-parent="#accordionExample2">
            <div data-translate="smartfeatures-24" class="card-body"></div>
          </div>
        </div>
        <div class="card">
          <div class="card-header background-less" id="retail7" data-toggle="collapse" data-target="#retail7-body" aria-expanded="true" aria-controls="retail7-body">
            <h4 class="mb-0">
              <a class="btn-link collapsed">
                <span data-translate="smartfeatures-25"></span>
                <i class="fas fa-chevron-down" style="float: right; margin-top: 10px; color: black; font-size: 1.3rem;"></i></a>

            </h4>
          </div>

          <div id="retail7-body" class="collapse" aria-labelledby="retail7" data-parent="#accordionExample2">
            <div data-translate="smartfeatures-26" class="card-body"></div>
          </div>
        </div>
        <div class="card">
          <div class="card-header background-less" id="retail2" data-toggle="collapse" data-target="#retail2-body" aria-expanded="true" aria-controls="retail2-body">
            <h4 class="mb-0">
              <a class="btn-link collapsed">
                <span data-translate="smartfeatures-13"></span>
                <i class="fas fa-chevron-down" style="float: right; margin-top: 10px; color: black; font-size: 1.3rem;"></i></a>

            </h4>
          </div>

          <div id="retail2-body" class="collapse" aria-labelledby="retail2" data-parent="#accordionExample2">
            <div data-translate="smartfeatures-14" class="card-body"></div>
          </div>
        </div>
        <div class="card">
          <div class="card-header background-less" id="retail8" data-toggle="collapse" data-target="#retail8-body" aria-expanded="true" aria-controls="retail8-body">
            <h4 class="mb-0">
              <a class="btn-link collapsed">
                <span data-translate="smartfeatures-29"></span>
                <i class="fas fa-chevron-down" style="float: right; margin-top: 10px; color: black; font-size: 1.3rem;"></i></a>

            </h4>
          </div>

          <div id="retail8-body" class="collapse" aria-labelledby="retail8" data-parent="#accordionExample2">
            <div data-translate="smartfeatures-30" class="card-body"></div>
          </div>
        </div>

        <div class="card">
          <div class="card-header background-less" id="retail4" data-toggle="collapse" data-target="#retail4-body" aria-expanded="true" aria-controls="retail4-body">
            <h4 class="mb-0">
              <a class="btn-link collapsed">
                <span data-translate="smartfeatures-17"></span>
                <i class="fas fa-chevron-down" style="float: right; margin-top: 10px; color: black; font-size: 1.3rem;"></i></a>
            </h4>
          </div>

          <div id="retail4-body" class="collapse" aria-labelledby="retail4" data-parent="#accordionExample2">
            <div data-translate="smartfeatures-18" class="card-body"></div>
          </div>
        </div>

        <div class="card">
          <div class="card-header background-less" id="retail9" data-toggle="collapse" data-target="#retail9-body" aria-expanded="true" aria-controls="retail9-body">
            <h4 class="mb-0">
              <a class="btn-link collapsed">
                <span data-translate="smartfeatures-33"></span>
                <i class="fas fa-chevron-down" style="float: right; margin-top: 10px; color: black; font-size: 1.3rem;"></i></a>
            </h4>
          </div>

          <div id="retail9-body" class="collapse" aria-labelledby="retail9" data-parent="#accordionExample2">
            <div data-translate="smartfeatures-34" class="card-body"></div>
          </div>
        </div>
        <div class="card">
          <div class="card-header background-less" id="retail10" data-toggle="collapse" data-target="#retail10-body" aria-expanded="true" aria-controls="retail10-body">
            <h4 class="mb-0">
              <a class="btn-link collapsed">
                <span data-translate="smartfeatures-35"></span>
                <i class="fas fa-chevron-down" style="float: right; margin-top: 10px; color: black; font-size: 1.3rem;"></i></a>
            </h4>
          </div>

          <div id="retail10-body" class="collapse" aria-labelledby="retail10" data-parent="#accordionExample2">
            <div data-translate="smartfeatures-36" class="card-body"></div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-5 d-flex justify-content-center order-last">
      <img src="/newAssets/smartfeatures/portrait-man-face-scann.jpg" id="preview-img" alt="" class="img-fluid align-self-center" style="max-height: 350px; width: auto;">
    </div>
  </div>
  <br>

  <hr>
</div>

<?php //require_once($_SERVER['DOCUMENT_ROOT'] . '/contact-alt-products.php'); 
?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/contact-button.php'); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/footer-alt.php'); ?>
<footer class="footerBanner-alt"></footer>

<script>
  $(document).ready(function() {

    var animateLevelUpTi1;
    var animateLevelUpTi2;
    var animateLevelUpTi3;
    var animateLevelUpTi4;

    // runLevelUpAnimation();
    // resumeLevelUpAnimation();

    // $('#FB_1').on("mouseenter", function() {
    //   clearAnimateLevelUp();
    //   $('#FB_1').attr('src', 'palio_button/assets/Untitled110_20220121183610.png');
    //   $('#FB_2').attr('src', 'newAssets/floating_button/button_chat.png');
    //   $('#FB_3').attr('src', 'newAssets/floating_button/button_call.png');
    //   $('#FB_4').attr('src', 'newAssets/floating_button/button_stream.png');
    // }).on("mouseleave", function() {
    //   resumeLevelUpAnimation();
    // });

    // $('#FB_2').on("mouseenter", function() {
    //   clearAnimateLevelUp();
    //   $('#FB_1').attr('src', 'newAssets/floating_button/button_cc.png');
    //   $('#FB_2').attr('src', 'palio_button/assets/Untitled110_20220121183614.png');
    //   $('#FB_3').attr('src', 'newAssets/floating_button/button_call.png');
    //   $('#FB_4').attr('src', 'newAssets/floating_button/button_stream.png');
    // }).on("mouseleave", function() {
    //   resumeLevelUpAnimation();
    // });

    // $('#FB_3').on("mouseenter", function() {
    //   clearAnimateLevelUp();
    //   $('#FB_1').attr('src', 'newAssets/floating_button/button_cc.png');
    //   $('#FB_2').attr('src', 'newAssets/floating_button/button_chat.png');
    //   $('#FB_3').attr('src', 'palio_button/assets/Untitled110_20220121183621.png');
    //   $('#FB_4').attr('src', 'newAssets/floating_button/button_stream.png');
    // }).on("mouseleave", function() {
    //   resumeLevelUpAnimation();
    // });

    // $('#FB_4').on("mouseenter", function() {
    //   clearAnimateLevelUp();
    //   $('#FB_1').attr('src', 'newAssets/floating_button/button_cc.png');
    //   $('#FB_2').attr('src', 'newAssets/floating_button/button_chat.png');
    //   $('#FB_3').attr('src', 'newAssets/floating_button/button_call.png');
    //   $('#FB_4').attr('src', 'palio_button/assets/Untitled110_20220121183617.png');
    // }).on("mouseleave", function() {
    //   resumeLevelUpAnimation();
    // });

    function clearAnimateLevelUp() {
      clearInterval(animateLevelUpIn);
      clearTimeout(animateLevelUpTi1);
      clearTimeout(animateLevelUpTi2);
      clearTimeout(animateLevelUpTi3);
      clearTimeout(animateLevelUpTi4);
    }

    function runLevelUpAnimation() {
      animateLevelUpTi1 = setTimeout(function() {
        $('#FB_4').attr('src', 'palio_button/assets/Untitled110_20220121183617.png');
        $('#FB_3').attr('src', '/newAssets/floating_button/button_call.png');
        $('#FB_2').attr('src', '/newAssets/floating_button/button_chat.png');
        $('#FB_1').attr('src', '/newAssets/floating_button/button_cc.png');
      }, 1000);

      animateLevelUpTi2 = setTimeout(function() {
        $('#FB_3').attr('src', 'palio_button/assets/Untitled110_20220121183621.png');
        $('#FB_4').attr('src', '/newAssets/floating_button/button_stream.png');
        $('#FB_2').attr('src', '/newAssets/floating_button/button_chat.png');
        $('#FB_1').attr('src', '/newAssets/floating_button/button_cc.png');
      }, 2000);

      animateLevelUpTi3 = setTimeout(function() {
        $('#FB_2').attr('src', 'palio_button/assets/Untitled110_20220121183614.png');
        $('#FB_3').attr('src', '/newAssets/floating_button/button_call.png');
        $('#FB_4').attr('src', '/newAssets/floating_button/button_stream.png');
        $('#FB_1').attr('src', '/newAssets/floating_button/button_cc.png');
      }, 3000);

      animateLevelUpTi4 = setTimeout(function() {
        $('#FB_1').attr('src', 'palio_button/assets/Untitled110_20220121183610.png');
        $('#FB_3').attr('src', '/newAssets/floating_button/button_call.png');
        $('#FB_2').attr('src', '/newAssets/floating_button/button_chat.png');
        $('#FB_4').attr('src', '/newAssets/floating_button/button_stream.png');
      }, 4000);
    }

    function resumeLevelUpAnimation() {

      runLevelUpAnimation();

      animateLevelUpIn = setInterval(function() {
        runLevelUpAnimation();
      }, 4000);
    }

  });
</script>