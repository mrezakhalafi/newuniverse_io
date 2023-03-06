<style>
    /* Fixed/sticky icon bar (vertically aligned 50% from the top of the screen) */
    .icon-bar-wrap {
        position: fixed;
        top: 50%;
        right: 0;
        z-index: 999;
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
</style>


<div class="icon-bar-wrap" id="wrap-all">
    <div class="icon-bar" id="feature-buttons">
        <span id="open-cc" data-translate="palioButton-1" style="cursor: pointer;"></span>
        <span data-translate="palioButton-2"></span>
        <span data-translate="palioButton-3"></span>
        <span data-translate="palioButton-4"></span>
    </div>
    <div class="palio-button" id="palio-button-1">
        <img src="<?php echo base_url(); ?>newAssets/floating_button/palio_button.png" alt="palio" />
    </div>
</div>



<script>
    $(function() {
        // $("#wrap-all").draggable({
        //     containment: 'window'
        // });
        $("body").tooltip({
            selector: '[data-toggle="tooltip"]'
        });
        $("#palio-button-1").click(function() {
            $("#feature-buttons").slideToggle("slow")
        });
        // document.getElementById("palio-button-1").addEventListener("touchstart", tapHandler);
        // var tapedTwice = false;

        // function tapHandler(event) {
        //     if (!tapedTwice) {
        //         tapedTwice = true;
        //         setTimeout(function() {
        //             tapedTwice = false
        //         }, 500);
        //         return false
        //     }
        //     event.preventDefault();
        //     $("#feature-buttons").slideToggle("slow")
        // }
    });
</script>