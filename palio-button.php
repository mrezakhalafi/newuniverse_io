<style>
    /* Fixed/sticky icon bar (vertically aligned 50% from the top of the screen) */
    .icon-bar-wrap {
        position: fixed;
        top: 50%;
        z-index: 999;
    }

    @media screen and (orientation:landscape) and (max-width:1024px) {
        .icon-bar-wrap {
            position: fixed;
            top: 30%;
            z-index: 999;
        }
    }

    #main_button {
        z-index: 8888;
    }

    .icon-bar#feature-buttons {
        background-color: rgba(0, 0, 0, 0.2);
        padding: 3px;
        border-radius: 9px !important;
        margin: 2px;
        overflow: hidden;
        border: 1px solid white;
    }

    /* Style the icon bar links */
    .icon-bar#feature-buttons img {
        display: block;
        text-align: center;
        transition: all 0.3s ease;
        color: white;
        font-size: 20px;
        height: 35px;
        width: 35px;
        margin: 5px;
    }

    .palio-button {
        text-align: center;
        margin-left: 6px;
    }

    .palio-button img {
        height: 45px;
        width: 45px;
    }

    body .speechbubble {
        background-color: #26272b;
        color: #9fa2a7;
        font-size: 0.8em;
        line-height: 1.75;
        padding: 15px 25px;
        margin-bottom: 75px;
        cursor: default;
    }

    body .speechbubble {
        border-right: 5px solid;
    }

    body .speechbubble:after {
        content: "";
        margin-top: -30px;
        padding-top: 0px;
        position: relative;
        bottom: -45px;
        left: 0px;
        border-width: 30px 30px 0 0;
        border-style: solid;
        border-color: #26272b transparent;
        display: block;
        width: 0;
    }

    body .speechbubble {
        border-color: #01ad9b;
    }

    .tooltip {
        z-index: 9999 !important;
    }
</style>


<div class="icon-bar-wrap gx-0" id="wrap-all" style="z-index: 9999">
    <div class="icon-bar" style="width: 53px; height: 173px" id="feature-buttons">
        <span id="buttons-1" data-translate="palioButton-1" onmouseenter="hideClickMe()" onmouseleave="showClickMe()"></span>
        <a href="chatcore/pages/login_page.php?env=1" target="_blank"><span data-translate="palioButton-2" onmouseenter="hideClickMe()" onmouseleave="showClickMe()"></span></a>
        <span id="buttons-3" data-translate="palioButton-3" onmouseenter="hideClickMe()" onmouseleave="showClickMe()"></span>
        <span id="buttons-4" data-translate="palioButton-4" onmouseenter="hideClickMe()" onmouseleave="showClickMe()"></span>
    </div>
    <div class="palio-button" id="palio-button-1" style="width: 45px; height: 45px; font-family: 'Poppins', sans-serif">
        <img src="<?php echo base_url(); ?>newAssets/floating_button/palio_button.png" alt="palio" id="main_button" />
        <div id="video-1" style="pointer-events:none">
            <video id="video-play-1" src="hadi-1.mp4" playsInline style="opacity: 0.9; position:absolute; margin-top: -55px; margin-left: -41px; width: 80px; height: 80px; border-radius: 100px; object-fit: cover; object-position: 20% 30%" loop autoplay muted></video>
        </div>
        <div id="streaming-1" style="pointer-events:none">
            <video id="streaming-play-1" src="matrix-1.mp4" playsInline style="opacity: 0.8; position:absolute; margin-top: -75px; margin-left: -51px; width: 100px; height: 100px; border-radius: 100px; object-fit: cover" loop autoplay muted></video>
        </div>
        <div id="bot-icon-1">
            <img src="bot.png" style="opacity: 0.8; position:absolute; margin-top: 90px; margin-left: -210px; width: 100px; height: 100px; border-radius: 100px; z-index: 6000">
        </div>
        <div id="bot-icon-2">
            <img src="bot.png" style="opacity: 0.8; position:absolute; margin-top: 80px; margin-left: -51px; width: 100px; height: 100px; border-radius: 100px; z-index: 6000">
        </div>
        <div id="bot-icon-3">
            <img src="bot.png" style="opacity: 0.8; position:absolute; margin-top: -10px; margin-left: -51px; width: 100px; height: 100px; border-radius: 100px; z-index: 6000">
        </div>
        <div class="arrow-animation-1">
            <img src="arrow-green.png" alt="" style="width: 150px; height: 150px; position: absolute; opacity: 0.8; margin-top: 55px; margin-left: -80px">
        </div>
        <div class="arrow-animation-2">
            <img src="arrow-green.png" alt="" style="width: 150px; height: 150px; position: absolute; opacity: 0.8; margin-top: 40px; margin-left: -30px">
        </div>
        <div class="arrow-animation-3">
            <img src="arrow-green.png" alt="" style="width: 150px; height: 150px; position: absolute; opacity: 0.8; margin-top: -45px; margin-left: -30px; z-index: -999">
        </div>
        <div id="images-CC" style="position:absolute; width: 265px; margin-left: -261px; margin-top: 156px">
            <div style="opacity: 0.9; background-color: white; color: #FFFFFF; border-radius: 20px">
                <p id="text-CC" data-translate="palioButton-8" style="padding: 10px; font-size: 14px; text-align: center; color: black">Provide your customers with an advanced <span style="color: #01686d"><b>Contact Center</b></span> directly from your app. Engage with your customers through Video/VoIP Call or a simple text Chat...</p>
            </div>
        </div>
        <div id="images-VC" style="position:absolute; width: 265px; margin-left: -100px; margin-top: 148px">
            <div style="opacity: 0.9; background-color: white; color: #FFFFFF; border-radius: 20px">
                <p id="text-VC" data-translate="palioButton-9" style="padding: 10px; font-size: 14px; text-align: center; color: black">Additionally you can provide your customers with <span style="color: #01686d"><b>VoIP and Video Call</b></span> to increase their loyalty...</p>
            </div>
        </div>
        <div id="images-LS" style="position:absolute; width: 310px; margin-left: -130px; margin-top: 60px">
            <div style="opacity: 0.9; background-color: white; color: #FFFFFF; border-radius: 20px">
                <p id="text-LS" data-translate="palioButton-10" style="padding: 10px; font-size: 14px; text-align: center; color: black">Announce and advertise new products, discounts, and other promotional contents by <span style="color: #01686d"><b>Live Streaming</b></span> them directly to your customers...</p>
            </div>
        </div>
        <!-- <div id="images-1" style="margin-left: 210px">
            <img id="images-play-1" src="keyboard.jpg" style="opacity: 0.7; position:absolute; margin-top: -23px; margin-left: -237px; width: 200px; height: 120px; border-radius: 5px">
        </div> -->
        <div id="images-2" style="position:absolute; width: 199px; margin-left: -216px; margin-top: -268px">
            <div id="images-play-2" style="opacity: 0.9; background-color: rgba(0, 0, 0, 0.8); color: #FFFFFF; border-radius: 20px">
                <p data-translate="palioButton-11" style="padding: 10px; font-size: 12px; text-align: left; color: #14c314">Azka: Good afternoon, any recommendations for the best food in this place?</p>
            </div>
        </div>
        <div id="images-3" style="position:absolute; width: 220px; margin-left: -235px; margin-top: -191px">
            <div id="images-play-3" style="opacity: 0.9; background-color: rgba(0, 0, 0, 0.8); color: #FFFFFF; border-radius: 20px">
                <img src="newAssets/bakso.webp" style="width: 90%; height: auto; border-radius: 10px; margin-top: 10px">
                <p data-translate="palioButton-12" style="padding: 10px; font-size: 12px; text-align: left; color: #c3bf14">Deddy: Currently the best menu at our place is Rib Meatballs, currently there is a 20% discount promo just for today 😄</p>
            </div>
        </div>
        <div id="images-4" style="position:absolute; width: 190px; margin-left: -205px; margin-top: 46px">
            <div id="images-play-4" style="opacity: 0.79; background-color: rgba(0, 0, 0, 0.8); color: #FFFFFF; border-radius: 20px">
                <p data-translate="palioButton-13" style="padding: 10px; font-size: 12px; text-align: left; color: #14c314">Azka: Wow interesting, may i order three servings? 😍</p>
            </div>
        </div>
        <div id="video-2" style="pointer-events:none">
            <video id="video-play-2" src="bayu-1.mp4" playsInline style="opacity: 0.9; position:absolute; margin-top: -55px; margin-left: -38px; width: 80px; height: 80px; border-radius: 100px; object-fit: cover; object-position: 20% 20%" loop autoplay muted></video>
        </div>
        <div id="video-3" style="pointer-events:none">
            <video id="video-play-3" src="matrix-5.mp4" playsInline style="opacity: 0.9; position:absolute; margin-top: -55px; margin-left: -40px; width: 80px; height: 80px; border-radius: 100px; object-fit: cover; object-position: 20% 30%" loop autoplay muted></video>
        </div>
        <div id="video-4" style="pointer-events:none">
            <video id="video-play-4" src="dio-1.mp4" playsInline style="opacity: 0.9; position:absolute; margin-top: -55px; margin-left: -37px; width: 80px; height: 80px; border-radius: 100px; object-fit: cover; object-position: 20% 20%" loop autoplay muted></video>
        </div>
    </div>
    <div class="clickme-animation mb-5 pb-5" style="width: 100px; height: 100px; margin-top: -350px; margin-left: 50px; position:absolute">
        <img src="clickme-animation.png" alt="" style="width: 150px; height: 150px; position: absolute; opacity: 0.8" id="animate-clickme">
    </div>
</div>



<script>
    var userAgent = /PalioBrowser/.test(navigator.userAgent);

    if (userAgent) {
        $('#wrap-all').hide();
    } else {
        $('#wrap-all').show();
    }
</script>

<script>
    $(document).ready(function() {
        $("#animate-clickme").animate({
            top: '+=60px'
        }, 2000);
        $("#animate-clickme").animate({
            top: '-=60px'
        }, 2000);

        setInterval(function() {
            $("#animate-clickme").animate({
                top: '+=60px'
            }, 2000);
            $("#animate-clickme").animate({
                top: '-=60px'
            }, 2000);

        }, 2000);
    })

    var exampleEl, tooltipFB;
    var overrideFlag = false;

    var tapedTwice = false;

    $('#video-1').hide();
    $('#video-2').hide();
    $('#video-3').hide();
    $('#video-4').hide();
    $('#images-CC').hide();
    $('#images-LS').hide();
    $('#images-VC').hide();
    // $('#images-1').hide();
    $('#images-2').hide();
    $('#images-3').hide();
    $('#images-4').hide();
    $('#streaming-1').hide();
    $('#bot-icon-1').hide();
    $('#bot-icon-2').hide();
    $('#bot-icon-3').hide();
    $('.arrow-animation-1').hide();
    $('.arrow-animation-2').hide();
    $('.arrow-animation-3').hide();

    function tapHandler(event) {

        // event.preventDefault();
        // if (!tapedTwice) {
        //     tapedTwice = true;
        //     setTimeout(function() {
        //         tapedTwice = false
        //     }, 500);
        //     return false
        // } else {
        //     $("#feature-buttons").slideToggle("slow")
        // }

    }

    function openVideo() {
        $('.icon-bar-wrap').css('left', '50%');
        // $('.clickme-animation').hide();
        $('#feature-buttons').hide();
        $('#video-1').fadeIn();

        $('#video-play-1').animate({
            marginTop: '-130px'
        }, 500);
        $('#video-play-2').animate({
            marginTop: '6px'
        }, 500);
        $('#video-play-3').animate({
            marginLeft: '-108px'
        }, 500);
        $('#video-play-4').animate({
            marginLeft: '27'
        }, 500);

        $('#video-2').fadeIn();
        $('#video-3').fadeIn();
        $('#video-4').fadeIn();
        $('#images-CC').hide();
        // $('#images-1').hide();
        $('#images-2').hide();
        $('#images-3').hide();
        $('#images-4').hide();
        $('#streaming-1').hide();
        $('#images-CC').hide();
        $('#images-LS').hide();
        $('#images-VC').show();
        $('#bot-icon-2').show();
        $('#bot-icon-1').hide();
        $('#bot-icon-3').hide();
        $('.arrow-animation-1').hide();
        $('.arrow-animation-2').show();
        $('.arrow-animation-3').hide();
        animateDiv();

        $('.tooltip').remove();
    }

    var animateChat1;
    var animateChat2;
    var animateChat3;
    var animateChat4;

    function openChat() {
        $('.icon-bar-wrap').css('left', '80%');
        // $('.clickme-animation').hide();
        $('#feature-buttons').hide();
        $('#video-1').hide();
        $('#video-2').hide();
        $('#video-3').hide();
        $('#video-4').hide();
        $('#images-CC').show();
        $('#images-LS').hide();
        $('#images-VC').hide();
        $('#streaming-1').hide();
        $('#bot-icon-1').show();
        $('#bot-icon-2').hide();
        $('#bot-icon-3').hide();
        $('.arrow-animation-1').show();
        $('.arrow-animation-2').hide();
        $('.arrow-animation-3').hide();
        // $('#images-1').show();
        animateChat1 = setTimeout(imagesTwo, 500);
        animateChat2 = setTimeout(imagesThree, 1000);
        animateChat3 = setTimeout(imagesFour, 1500);
        // animateChat4 = setTimeout(imagesOne, 2000);
        animateDivChat();

        $('.tooltip').remove();
    }

    // function imagesOne() {
    //     // $('#images-1').fadeIn();
    //     $('#images-1').show();
    //     $('#images-1').css('opacity', 0);
    //     $('#images-1').animate({
    //         marginLeft: '0px',
    //         opacity: 1
    //     }, 500);
    // }

    function imagesTwo() {
        $('#images-2').fadeIn();
        // $('#images-2').show();
        // $('#images-2').css('opacity',0);
        // $('#images-2').animate({ marginLeft: '-216px', opacity: 1}, 500);
    }

    function imagesThree() {
        $('#images-3').fadeIn();
        // $('#images-3').show();
        // $('#images-3').css('opacity',0);
        // $('#images-3').animate({ marginLeft: '-235px', opacity: 1}, 500);
    }

    function imagesFour() {
        $('#images-4').fadeIn();
        // $('#images-4').show();
        // $('#images-4').css('opacity',0);
        // $('#images-4').animate({ marginLeft: '-171px', opacity: 1}, 500);
    }

    function openStreaming() {
        $('.icon-bar-wrap').css('left', '50%');
        // $('.clickme-animation').hide();
        $('#feature-buttons').hide();
        $('#video-1').hide();
        $('#video-2').hide();
        $('#video-3').hide();
        $('#video-4').hide();
        $('#images-CC').hide();
        // $('#images-1').hide();
        $('#images-2').hide();
        $('#images-3').hide();
        $('#images-4').hide();
        $('#streaming-play-1').animate({
            marginTop: '-155px'
        }, 500);
        $('#streaming-1').fadeIn();
        $('#images-CC').hide();
        $('#images-LS').show();
        $('#images-VC').hide();
        $('#bot-icon-1').hide();
        $('#bot-icon-2').hide();
        $('#bot-icon-3').show();
        $('.arrow-animation-1').hide();
        $('.arrow-animation-2').hide();
        $('.arrow-animation-3').show();
        animateDiv();

        $('.tooltip').remove();
    }

    function makeNewPosition() {

        var h = $(window).height() - 150;
        var w = $(window).width() - 120;

        var nh = Math.floor(Math.random() * h);
        var nw = Math.floor(Math.random() * w);

        return [nh, nw];

    }

    function animateDiv() {
        $('.clickme-animation').hide();
        var newq = makeNewPosition();
        $('#wrap-all').animate({
            top: newq[0],
            left: newq[1]
        }, 7000, function() {
            animateDiv();
        });

    };

    function makeNewPositionChat() {

        var h = $(window).height() - 50;
        var w = $(window).width() - 50;

        // // console.log("H="+h);
        // // console.log("W="+w);

        var nh = Math.floor(Math.random() * h);
        var nw = Math.floor(Math.random() * w);

        while (nh < 250 || nh > 300) {
            nh = Math.floor(Math.random() * w);
        }

        while (nw < 210) {
            nw = Math.floor(Math.random() * w);
        }

        return [nh, nw];

    }

    function animateDivChat() {
        $('.clickme-animation').hide();
        var newq = makeNewPositionChat();

        // console.log("H=" + newq[0]);
        // console.log("W=" + newq[1]);

        $('#wrap-all').animate({
            top: newq[0],
            left: newq[1]
        }, 7000, function() {
            animateDivChat();
        });

    };

    function hideClickMe() {
        $('#animate-clickme').hide();
    }

    function showClickMe() {
        $('#animate-clickme').show();
    }

    $("#video-1").on("mouseenter", function() {
        $('#wrap-all').stop();
    }).on("mouseleave", function() {
        animateDiv();
    });

    $("#video-2").on("mouseenter", function() {
        $('#wrap-all').stop();
    }).on("mouseleave", function() {
        animateDiv();
    });

    $("#video-3").on("mouseenter", function() {
        $('#wrap-all').stop();
    }).on("mouseleave", function() {
        animateDiv();
    });

    $("#video-4").on("mouseenter", function() {
        $('#wrap-all').stop();
    }).on("mouseleave", function() {
        animateDiv();
    });

    $("#streaming-1").on("mouseenter", function() {
        $('#wrap-all').stop();
    }).on("mouseleave", function() {
        animateDiv();
    });

    // $("#images-1").on("mouseenter", function() {
    //     $('#wrap-all').stop();
    // }).on("mouseleave", function() {
    //     animateDiv();
    // });

    $("#images-2").on("mouseenter", function() {
        $('#wrap-all').stop();
    }).on("mouseleave", function() {
        animateDiv();
    });

    $("#images-3").on("mouseenter", function() {
        $('#wrap-all').stop();
    }).on("mouseleave", function() {
        animateDiv();
    });

    $("#images-4").on("mouseenter", function() {
        $('#wrap-all').stop();
    }).on("mouseleave", function() {
        animateDiv();
    });

    $("#images-CC").on("mouseenter", function() {
        $('#wrap-all').stop();
    }).on("mouseleave", function() {
        animateDiv();
    });

    $("#images-VC").on("mouseenter", function() {
        $('#wrap-all').stop();
    }).on("mouseleave", function() {
        animateDiv();
    });

    $("#images-LS").on("mouseenter", function() {
        $('#wrap-all').stop();
    }).on("mouseleave", function() {
        animateDiv();
    });

    $("#bot-icon-1").on("mouseenter", function() {
        $('#wrap-all').stop();
    }).on("mouseleave", function() {
        animateDiv();
    });

    $("#bot-icon-2").on("mouseenter", function() {
        $('#wrap-all').stop();
    }).on("mouseleave", function() {
        animateDiv();
    });

    $("#bot-icon-3").on("mouseenter", function() {
        $('#wrap-all').stop();
    }).on("mouseleave", function() {
        animateDiv();
    });

    $(".arrow-animation-1").on("mouseenter", function() {
        $('#wrap-all').stop();
    }).on("mouseleave", function() {
        animateDiv();
    });

    $(".arrow-animation-2").on("mouseenter", function() {
        $('#wrap-all').stop();
    }).on("mouseleave", function() {
        animateDiv();
    });

    $(".arrow-animation-3").on("mouseenter", function() {
        $('#wrap-all').stop();
    }).on("mouseleave", function() {
        animateDiv();
    });

    $("#main_button").on("mouseenter", function() {
        $('#wrap-all').stop();
        // }).on("mouseleave", function () {
        //     animateDiv();
    });

    if (localStorage.lang == 0) {
        $('#text-CC').html('Provide your customers with an advanced <span style="color: #01686d"><b>Contact Center</b></span> directly from your app. Engage with your customers through Video/VoIP Call or a simple text Chat...');
        $('#text-VC').html('Additionally you can provide your customers with  <span style="color: #01686d"><b>VoIP and Video Call</b></span> to increase their loyalty...');
        $('#text-LS').html('Announce and advertise new products, discounts, and other promotional contents by <span style="color: #01686d"><b>Live Streaming</b></span> them directly to your customers...');
    } else if (localStorage.lang == 1) {
        $('#text-CC').html('Berikan <span style="color: #01686d"><b>Pusat Kontak</b></span> lanjutan kepada pelanggan Anda langsung dari aplikasi Anda. Terlibat dengan pelanggan Anda melalui Panggilan Video/VoIP atau Obrolan teks sederhana...');
        $('#text-VC').html('Selain itu, Anda dapat memberikan <span style="color: #01686d"><b>VoIP dan Panggilan Video</b></span> kepada pelanggan Anda untuk meningkatkan loyalitas mereka...');
        $('#text-LS').html('Umumkan dan iklankan produk baru, diskon, dan konten promosi lainnya dengan <span style="color: #01686d"><b>Siaran Langsung</b></span> langsung ke pelanggan Anda...');
    }

    var hoverChat, animateChat, mainToggle1, hoverVideo, animateVideo, mainToggle2, hoverStreaming, animateStreaming, mainToggle3, repeat;

    function cycleFB() {

        // console.log('1', animateChat);

        clearTimeout(repeat);

        hoverChat = setTimeout(function() {
            // console.log('override?', overrideFlag);
            if (overrideFlag == false) {
                // console.log('hover chat');
                $('#FB_1').attr('src', 'palio_button/assets/Untitled110_20220121183610.png');
                $('#FB_2').attr('src', 'newAssets/floating_button/button_chat.png');
                $('#FB_3').attr('src', 'newAssets/floating_button/button_call.png');
                $('#FB_4').attr('src', 'newAssets/floating_button/button_stream.png');
                clearTimeout(hoverChat);
            }
        }, 9000);

        animateChat = setTimeout(function() {
            // console.log('override?', overrideFlag);
            if (overrideFlag == false) {
                // console.log('animate chat');
                openChat();
                clearTimeout(animateChat);
            }
        }, 10000);

        mainToggle1 = setTimeout(function() {
            // console.log('override?', overrideFlag);
            if (overrideFlag == false) {
                // console.log('main toggle 1');
                mainButtonToggle("down");
                clearTimeout(mainToggle1);
            }
        }, 20000);

        hoverVideo = setTimeout(function() {
            // console.log('override?', overrideFlag);
            if (overrideFlag == false) {
                // console.log('hover video');
                $('#FB_1').attr('src', 'newAssets/floating_button/button_cc.png');
                $('#FB_2').attr('src', 'newAssets/floating_button/button_chat.png');
                $('#FB_3').attr('src', 'palio_button/assets/Untitled110_20220121183621.png');
                $('#FB_4').attr('src', 'newAssets/floating_button/button_stream.png');
                clearTimeout(hoverVideo);
            }
        }, 24000);

        animateVideo = setTimeout(function() {
            // console.log('override?', overrideFlag);
            if (overrideFlag == false) {
                // console.log('open video');
                openVideo();
                clearTimeout(animateVideo);
            }
        }, 25000);

        mainToggle2 = setTimeout(function() {
            // console.log('override?', overrideFlag);
            if (overrideFlag == false) {
                // console.log('maintoggle 2');
                mainButtonToggle("down");
                clearTimeout(mainToggle2);
            }
        }, 35000);

        hoverStreaming = setTimeout(function() {
            // console.log('override?', overrideFlag);
            if (overrideFlag == false) {
                // console.log('hover stream');
                $('#FB_1').attr('src', 'newAssets/floating_button/button_cc.png');
                $('#FB_2').attr('src', 'newAssets/floating_button/button_chat.png');
                $('#FB_3').attr('src', 'newAssets/floating_button/button_call.png');
                $('#FB_4').attr('src', 'palio_button/assets/Untitled110_20220121183617.png');
                clearTimeout(hoverStreaming);
            }
        }, 39000);

        animateStreaming = setTimeout(function() {
            // console.log('override?', overrideFlag);
            if (overrideFlag == false) {
                // console.log('open stream');
                openStreaming();
                clearTimeout(animateStreaming);
            }
        }, 40000);

        mainToggle3 = setTimeout(function() {
            // console.log('override?', overrideFlag);
            if (overrideFlag == false) {
                // console.log('main togle 3');
                mainButtonToggle("down");
                clearTimeout(mainToggle3);
            }
        }, 50000);

        repeat = setTimeout(function() {
            // console.log('override?', overrideFlag);
            if (overrideFlag == false) {
                // console.log('repeat');
                cycleFB();
                clearTimeout(repeat);
            }
        }, 50100);
    }

    function mainButtonToggle(dir) {

        // STOP ANIMATION WHILE TOGGLE BUTTON

        // console.log(dir);

        clearTimeout(animateChat1);
        clearTimeout(animateChat2);
        clearTimeout(animateChat3);
        clearTimeout(animateChat4);

        // $("#feature-buttons").slideToggle("slow")
        if (dir == "up") {
            let iconBar = document.querySelector('.icon-bar-wrap .icon-bar');
            $("#feature-buttons").slideUp({
                duration: "slow",
                start: function() {

                    iconBar.classList.add("sliding");
                },
                done: function() {
                    iconBar.classList.remove("sliding");
                    // $('.tooltip').remove();
                    $('[data-toggle="tooltip"]').tooltip("hide");
                    if (iconBar.style.display == "none") {
                        $('.clickme-animation').hide();
                    }
                }
            });

            // FOR RESET TO LEFT (CLOSE ONLY == SAME AS MOBILE)
            $("#wrap-all").css('left', '0px');

        } else {

            let wrapAll = document.querySelector("#wrap-all");
            let pos = wrapAll.getBoundingClientRect().bottom + 177;
            console.log('POS', pos);

            // SLIDE UP BEFORE EXPAND IN BOTTOM (TENGGELEM)

            if (pos > window.innerHeight) {
                console.log("OVERFLOW")
                wrapAll.style.bottom = "";
                wrapAll.style.top = (window.innerHeight - 222) + "px";
            }
            // $("body").tooltip({
            //     selector: '[data-toggle="tooltip"]'
            // });
            $('[data-toggle="tooltip"]').tooltip("enable");
            let iconBar = document.querySelector('.icon-bar-wrap .icon-bar');
            $("#feature-buttons").slideDown({
                duration: "slow",
                start: function() {
                    iconBar.classList.add("sliding");
                },
                done: function() {
                    console.log("DONE")
                    iconBar.classList.remove("sliding");
                    // $(".tooltip").remove();
                    if (iconBar.style.display != "none") {
                        $('.clickme-animation').show();
                    }
                }
            });

        }
        // $('.clickme-animation').toggle();
        $('#video-1').hide();
        $('#video-2').hide();
        $('#video-3').hide();
        $('#video-4').hide();
        $('#images-CC').hide();
        $('#images-VC').hide();
        $('#images-LS').hide();
        // $('#images-1').hide();
        $('#images-2').hide();
        $('#images-3').hide();
        $('#images-4').hide();
        $('#streaming-1').hide();
        $('#wrap-all').stop();
        $('#bot-icon-1').hide();
        $('#bot-icon-2').hide();
        $('#bot-icon-3').hide();

        // FOR RESET TO LEFT (MAYBE BUTUH)
        // $("#wrap-all").css('left', '0px');

        $('.arrow-animation-1').hide();
        $('.arrow-animation-2').hide();
        $('.arrow-animation-3').hide();
        $('#FB_1').attr('src', 'newAssets/floating_button/button_cc.png');
        $('#FB_2').attr('src', 'newAssets/floating_button/button_chat.png');
        $('#FB_3').attr('src', 'newAssets/floating_button/button_call.png');
        $('#FB_4').attr('src', 'newAssets/floating_button/button_stream.png');

        $('#video-play-1').css('margin-top', '-55px');
        $('#video-play-2').css('margin-top', '-55px');
        $('#video-play-3').css('margin-left', '-40px');
        $('#video-play-4').css('margin-left', '-37px');

        // $('#images-1').css('margin-left', '210px');
        // $('#images-2').css('margin-left','-6px');
        // $('#images-3').css('margin-left','-35px');
        // $('#images-4').css('margin-left','39px');

        $('#streaming-play-1').css('margin-top', '-75px');
    }

    // $( window ).on( "orientationchange", function( event ) {

    //     $("#wrap-all").css('top', '60px');
    //     $("#wrap-all").css('left', '0px');

    // });

    var xPos = 0;
    var isDrag = 0;

    

    $(function() {



        $("body").tooltip({
            selector: '[data-toggle="tooltip"]'
        });

        $('[data-toggle="tooltip"]').on("show.bs.tooltip", function() {
            console.log("show");
        })
        $('[data-toggle="tooltip"]').on("inserted.bs.tooltip", function() {
            console.log("insert");
        })
        $('[data-toggle="tooltip"]').on("shown.bs.tooltip", function() {
            console.log("shown");
        })
        $('[data-toggle="tooltip"]').on("hide.bs.tooltip", function() {
            console.log("hide");
        })
        $('[data-toggle="tooltip"]').on("hidden.bs.tooltip", function() {
            console.log("hidden");
        })
        // try {
        //     exampleEl = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        //     tooltipFB = new bootstrap.Tooltip(exampleEl)
        // } catch (e) {
            
        // }

        $("#wrap-all").draggable({
            scroll: false,
            containment: 'window',
            start: function(event, ui) {
                $('[data-toggle="tooltip"]').tooltip("hide");
            },
            drag: function() {
                var offset = $(this).offset();
                xPos = offset.left;

                isDrag = 1;

                // $("[data-toggle='tooltip']").tooltip('update');

            },
            stop: function() {

                console.log("DROP");

                isDrag = 0;
            }
        });

        $("#main_button").mouseup(function() {
            let iconBar = document.querySelector('.icon-bar-wrap .icon-bar');
            if ((xPos == 0 || isDrag == 0) && !iconBar.classList.contains("sliding")) {
                overrideFlag = true;
                console.log("DISPLAY", iconBar.style.display);
                if (iconBar.style.display == 'none') {
                    mainButtonToggle('down');
                } else {
                    mainButtonToggle('up');
                }
            }
        });

        $('#buttons-1').click(function() {
            overrideFlag = true;
            openChat();
        })

        $('#buttons-3').click(function() {
            overrideFlag = true;
            openVideo();
        })

        $('#buttons-4').click(function() {
            overrideFlag = true;
            openStreaming();
        })
        document.getElementById("palio-button-1").addEventListener("touchstart", tapHandler);

        // setInterval(function() {
        //     cycleFB();
        // }, 60000);

        var hasTouchScreen = false;

        if ("maxTouchPoints" in navigator) {
            hasTouchScreen = navigator.maxTouchPoints > 0;
        } else if ("msMaxTouchPoints" in navigator) {
            hasTouchScreen = navigator.msMaxTouchPoints > 0;
        } else {
            var mQ = window.matchMedia && matchMedia("(pointer:coarse)");
            if (mQ && mQ.media === "(pointer:coarse)") {
                hasTouchScreen = !!mQ.matches;
            } else if ('orientation' in window) {
                hasTouchScreen = true; // deprecated, but good fallback
            } else {
                // Only as a last resort, fall back to user agent sniffing
                var UA = navigator.userAgent;
                hasTouchScreen = (
                    /\b(BlackBerry|webOS|iPhone|IEMobile)\b/i.test(UA) ||
                    /\b(Android|Windows Phone|iPad|iPod)\b/i.test(UA)
                );
            }
        }

        // console.log(hasTouchScreen);
        if (hasTouchScreen == false) {
            // Do something here. 
            cycleFB();
        }

        document.addEventListener('visibilitychange', function() {
            if (document.hidden) {
                // tab is now inactive
                // temporarily clear timer using clearInterval() / clearTimeout()

                // hoverChat, animateChat, mainToggle1, hoverVideo, animateVideo, mainToggle2, hoverStreaming, animateStreaming, mainToggle3, repeat;
                // console.log('CLEAR');
                clearTimeout(hoverChat);
                clearTimeout(animateChat);
                clearTimeout(mainToggle1);
                clearTimeout(hoverVideo);
                clearTimeout(animateVideo);
                clearTimeout(mainToggle2);
                clearTimeout(hoverStreaming);
                clearTimeout(animateStreaming);
                clearTimeout(mainToggle3);
                clearTimeout(repeat);
                mainButtonToggle("down");
                $(".clickme-animation").css("display", "block");
            } else {
                // tab is active again
                // restart timers
                // console.log('RESTART');
                cycleFB();
                $(".clickme-animation").css("display", "block");
            }
        });

        window.addEventListener("resize", function() {
            mainButtonToggle("down");
            document.querySelector(".icon-bar-wrap").style.position = "fixed";
            document.querySelector(".icon-bar-wrap").style.top = "30%";
            document.querySelector(".icon-bar-wrap").style.left = "0";
        })
    });
</script>