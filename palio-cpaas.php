<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/header-alt.php'); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/header-alt-meta.php'); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/palio-nav.php'); ?>

<div class="container-fluid my-5" id="features-list">
    <div class="row justify-content-center bg-light my-auto" data-aos="fade-left">
        <div class="col-md-11" style="margin-top:4rem;">
            <div class="row">
                <div class="col-md-5 order-lg-1 text-center mx-auto">
                    <!-- <img src="<?php echo base_url(); ?>newAssets/homepage/livestreaming.gif" class="img-fluid ls"> -->
                    <!-- <video src="livestreaming.mp4" type="video/mp4" playsinline autoplay muted loop style="max-height: 500px;"></video> -->
                    <img src="<?php echo base_url(); ?>newAssets/product/Live Streaming/Live Streaming.png" alt="" style="width: 80%;" class="img-fluid align-self-center">
                </div>
                <div class="col-md-5 order-lg-2 features-desc my-auto mx-auto">
                    <h2 class="fontRobBold fs-35 color-green">Live Streaming</h2>
                    <br>
                    <h3 class="fs-24 fontRobReg product-desc">
                        Live video streaming service has <strong>revolutionized</strong> how businesses communicate with their customers.
                        The use of livestreaming services will allow companies to engage and maintain an <strong>open relationship</strong>
                        with their audiences.
                    </h3>
                    <div class="btn-m-top ">
                        <!-- <button class="btn nav-menu-btn-alt shadow m-2 btn-smaller" onclick="pindah('livestream.php')">Lebih lanjut</button> -->
                        <?php if (!isset($_SESSION['id_company'])) { ?>
                            <!-- <button class="btn nav-menu-btn-wht-alt shadow m-2 btn-smaller" onclick="pindah('sign_up.php')">Sign Up</button> -->
                        <?php } ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="row justify-content-center my-auto" data-aos="fade-right">
        <div class="col-md-11">
            <div class="row">
                <div class="col-md-5 order-lg-2  text-center mx-auto">
                    <!-- <img src="<?php echo base_url(); ?>newAssets/homepage/video-call.gif" class="img-fluid"> -->
                    <!-- <video src="<?php echo base_url(); ?>newAssets/homepage/video-call.gif" playsinline autoplay muted loop style="max-height: 500px;"></video> -->
                    <!-- <source src="videocall.mp4" type="video/mp4"> -->
                    <!-- </video> -->
                    <img src="<?php echo base_url(); ?>newAssets/product/Video call/Video Call.png" alt="" style="width: 80%;" class="img-fluid align-self-center">
                </div>
                <div class="col-md-5 order-lg-1 features-desc my-auto mx-auto">
                    <h2 class="fontRobBold fs-35 color-green">Video Call</h2>
                    <br>
                    <h3 class="fs-24 fontRobReg product-desc">
                        Video call technology now plays <strong>a larger role</strong> within the customer service industry.
                        There's an old adage in customer service that a real person, whose smiling face the customer can see,
                        <strong>always wins</strong>.
                    </h3>
                    <div class="btn-m-top">
                        <!-- <button class="btn nav-menu-btn-alt shadow m-2 btn-smaller" onclick="pindah('videocall.php')">Lebih lanjut</button> -->
                        <?php //if (!isset($_SESSION['id_company'])) { 
                        ?>
                        <!-- <button class="btn nav-menu-btn-wht-alt shadow m-2 btn-smaller" onclick="pindah('sign_up.php')">Sign Up</button> -->
                        <?php //} 
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center bg-light" data-aos="fade-left">
        <div class="col-md-11">
            <div class="row">
                <div class="col-md-5 order-lg-1  text-center mx-auto">
                    <!-- <img src="<?php echo base_url(); ?>newAssets/homepage/audiocall.png" class="img-fluid ac"> -->
                    <img src="<?php echo base_url(); ?>newAssets/product/Audio Call/Voice Call.png" alt="" style="width: 80%;" class="img-fluid align-self-center">
                </div>
                <div class="col-md-5 order-lg-2 features-desc my-auto mx-auto">
                    <h2 class="fontRobBold fs-35 color-green">Audio Call</h2>
                    <br>
                    <h3 class="fs-24 fontRobReg product-desc">
                        With the available voice call features, your business can resolve issues <strong>faster</strong>, measure and improve
                        phone support operations, and deliver <strong>better customer experience</strong> across every channel.
                        It's <strong>easy</strong> to set up without hiring additional technicians, or managing new vendors.
                    </h3>
                    <div class="btn-m-top">
                        <!-- <button class="btn nav-menu-btn-alt shadow m-2 btn-smaller" onclick="pindah('audiocall.php')">Lebih lanjut</button> -->
                        <?php //if (!isset($_SESSION['id_company'])) { 
                        ?>
                        <!-- <button class="btn nav-menu-btn-wht-alt shadow m-2 btn-smaller" onclick="pindah('sign_up.php')">Sign Up</button> -->
                        <?php //} 
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center my-auto" data-aos="fade-right">
        <div class="col-md-10">
            <div class="row">
                <div class="col-md-5 order-lg-2 text-center mx-auto">
                    <!-- <img src="<?php echo base_url(); ?>newAssets/homepage/unifiedmessaging.png" class="img-fluid um"> -->
                    <img src="<?php echo base_url(); ?>newAssets/product/UM/UM.png" alt="" style="width: 80%;" class="img-fluid align-self-center">
                </div>
                <div class="col-md-5 order-lg-1 features-desc my-auto mx-auto">
                    <h2 class="fontRobBold fs-35 color-green">Unified Messaging</h2>
                    <br>
                    <h3 class="fs-24 fontRobReg product-desc">
                        You can <strong>easily implement</strong> various features in your apps such as groups with multiple topics,
                        media attachments, secret messages, self-destructing messages, acknowledgemenets,
                        and many others.
                    </h3>
                    <div class="btn-m-top">
                        <!-- <button class="btn nav-menu-btn-alt shadow m-2 btn-smaller" onclick="pindah('instantmessaging.php')">Lebih lanjut</button> -->
                        <?php //if (!isset($_SESSION['id_company'])) { 
                        ?>
                        <!-- <button class="btn nav-menu-btn-wht-alt shadow m-2 btn-smaller" onclick="pindah('sign_up.php')">Sign Up</button> -->
                        <?php //} 
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center bg-light my-auto" data-aos="fade-left">
        <div class="col-md-10">
            <div class="row">
                <div class="col-md-5 order-lg-1 text-center mx-auto">
                    <!-- <img src="<?php echo base_url(); ?>newAssets/homepage/screensharing.png" class="img-fluid um"> -->
                    <img src="<?php echo base_url(); ?>newAssets/product/Screensharing/Screensharing.png" alt="" style="width: 80%;" class="img-fluid align-self-center">
                </div>
                <div class="col-md-5 order-lg-2 features-desc my-auto mx-auto">
                    <h2 class="fontRobBold fs-35 color-green">Screen Sharing</h2>
                    <br>
                    <h3 class="fs-24 fontRobReg product-desc">
                        Enhance your demos and training, or guide your customer by <strong>allowing them to view</strong>
                        your screen from theirs in <strong>real-time</strong>.
                    </h3>
                    <div class="btn-m-top">
                        <!-- <button class="btn nav-menu-btn-alt shadow m-2 btn-smaller" onclick="pindah('screenshare.php')">Lebih lanjut</button> -->
                        <?php //if (!isset($_SESSION['id_company'])) { 
                        ?>
                        <!-- <button class="btn nav-menu-btn-wht-alt shadow m-2 btn-smaller" onclick="pindah('sign_up.php')">Sign Up</button> -->
                        <?php //} 
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center my-auto" data-aos="fade-right">
        <div class="col-md-10">
            <div class="row">
                <div class="col-md-5 order-lg-2 text-center mx-auto">
                    <!-- <img src="<?php echo base_url(); ?>newAssets/homepage/chatbot.png" class="img-fluid cb"> -->
                    <img src="<?php echo base_url(); ?>newAssets/product/Chatbot/ChatBot.png" alt="" style="width: 80%;" class="img-fluid align-self-center">
                </div>
                <div class="col-md-5 order-lg-1 features-desc my-auto mx-auto">
                    <h2 class="fontRobBold fs-35 color-green">Chat-bot</h2>
                    <br>
                    <h3 class="fs-24 fontRobReg product-desc">
                        According to research conducted by IBM, up to 80% of daily customer service work can be solved by chatbots.
                        Chatbots can respond to customer questions <strong>faster than humans</strong> without the need for down times.
                        Speeding up response times allows businesses to allocate employees to less trivial work.
                    </h3>
                    <div class="btn-m-top">
                        <!-- <button class="btn nav-menu-btn-alt shadow m-2 btn-smaller" onclick="pindah('chatbot.php')">Lebih lanjut</button> -->
                        <?php //if (!isset($_SESSION['id_company'])) { 
                        ?>
                        <!-- <button class="btn nav-menu-btn-wht-alt shadow m-2 btn-smaller">Coming Soon</button> -->
                        <?php //} 
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center my-auto py-4 bg-light" data-aos="fade-left">
        <div class="col-md-10">
            <div class="row">
                <div class="col-md-5 order-lg-1 text-center mx-auto">
                    <!-- <img src="<?php echo base_url(); ?>newAssets/homepage/whiteboarding.png" class="img-fluid wb"> -->
                    <img src="<?php echo base_url(); ?>newAssets/product/Video call/Whiteboarding.png" alt="" style="width: 80%;" class="img-fluid align-self-center">
                </div>
                <div class="col-md-5 order-lg-2 features-desc my-auto mx-auto">
                    <h2 class="fontRobBold fs-35 color-green">Whiteboard</h2>
                    <br>
                    <h3 class="fs-24 fontRobReg product-desc">
                        A <strong>collaborative</strong> tool to facilitate communication by allowing users to <strong>write and sketch</strong>
                        on a shared whiteboard space.
                    </h3>
                    <div class="btn-m-top">
                        <!-- <button class="btn nav-menu-btn-alt shadow m-2 btn-smaller" onclick="pindah('whiteboard.php')">Lebih lanjut</button> -->
                        <?php //if (!isset($_SESSION['id_company'])) { 
                        ?>
                        <!-- <button class="btn nav-menu-btn-wht-alt shadow m-2 btn-smaller" onclick="pindah('sign_up.php')">Sign Up</button> -->
                        <?php //} 
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/palio-contact-cpaas.php');
?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/palio-footer.php'); ?>