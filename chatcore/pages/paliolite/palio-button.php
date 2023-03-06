<style>
    /* Fixed/sticky icon bar (vertically aligned 50% from the top of the screen) */
    .icon-bar-wrap {
        position: fixed;
        top: 50%;
        /* right: 0; */
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
        transition: all 1s ease;
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
<script type="text/javascript">
    function checkCustomProtocol(inProtocol, inInstalLink, inTimeOut) {
        var timeout = inTimeOut;
        window.addEventListener('blur', function(e) {
            window.clearTimeout(timeout);
        })
        timeout = window.setTimeout(function() {
            console.log('timeout');
            window.location = inInstalLink;
        }, inTimeOut);

        window.location = inProtocol;
    }
</script>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Video Conference</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12 text-center">
                        Use this button to download the app and join conference room. <br>
                        <span><br></span>
                        <button id="open-vcr" class="btn btn-warning">Join room</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="icon-bar-wrap" id="wrap-all">
    <div class="icon-bar" id="feature-buttons">
        <span id="open-cc" data-translate="palioButton-1" style="cursor: pointer;"></span>
        <span data-translate="palioButton-2"></span>
        <span id="open-vc" data-translate="palioButton-3" style="cursor: pointer;"></span>
        <span id="open-ss" data-translate="palioButton-4"></span>
    </div>
    <div class="palio-button" id="palio-button-1">
        <img src="<?php echo base_url(); ?>newAssets/floating_button/palio_button.png" alt="palio" />
    </div>
</div>


<!-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script> -->
<script>
    var isOutOfViewport = function(elem) {

        // Get element's bounding
        var bounding = elem.getBoundingClientRect();

        // Check if it's out of the viewport on each side
        var out = {};
        out.top = bounding.top < 0;
        out.left = bounding.left < 0;
        out.bottom = bounding.bottom > (window.innerHeight || document.documentElement.clientHeight);
        out.right = bounding.right > (window.innerWidth || document.documentElement.clientWidth);
        out.any = out.top || out.left || out.bottom || out.right;


        return out;

    };

    var elem = document.querySelector('#wrap-all');

    var logViewport = function() {
        var isOut = isOutOfViewport(elem);
        if (isOut.any) {
            // console.log('bottom: ' + isOut.bottom);
            // console.log('right: ' + isOut.right);
            if (isOut.bottom) {
                document.getElementById('wrap-all').style.top = (document.documentElement.clientHeight - document.getElementById('wrap-all').getBoundingClientRect().height) + 'px';
            }
            console.log('Not in the viewport! =(');
        } else {
            console.log('In the viewport! =)');
        }
    };

    $(function() {

        $("body").tooltip({
            selector: '[data-toggle="tooltip"]'
        });
        $("#wrap-all").draggable({
            containment: 'window'
        });
        $("#palio-button-1").click(function() {
            $("#feature-buttons").slideToggle("slow", logViewport);
            // $("#feature-buttons").toggle("slow");
        });
        // $("#open-vcr").click(function() {
        //     // checkCustomProtocol("palio:vcr", "http://192.168.0.56/downloads/palio_installer.exe", 200)

        // });

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