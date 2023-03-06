<!doctype html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Project</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link href="../assets/css/tab3-style.css?random=<?= time(); ?>" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>

    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/jQueryRotate.js"></script>
    <script src="../assets/js/jquery.validate.js"></script>
    <script src="../assets/js/isInViewport.min.js"></script>
    <link rel="stylesheet" href="../assets/css/style-store_list.css?random=<?= time(); ?>">
    <link rel="stylesheet" href="../assets/css/gridstack.min.css" />
    <link rel="stylesheet" href="../assets/css/gridstack-extra.min.css" />
    <script type="text/javascript" src="../assets/js/gridstack-static.js"></script>
    <script type="text/javascript" src="../assets/js/pulltorefresh.js"></script>
</head>
<?php
  $rand_bg = rand(1,10) . ".png";
?>
<body style="background-image:url('/persib_web/assets/img/lbackground_<?php echo $rand_bg;?>'); background-size: 100% auto; background-repeat: repeat-y;">
    <div class="container-fluid">
        <div class="col-12">
            <div class="row" style="padding: 10px 0 10px 0;">
                <div class="col-1">
                    <div id="header-logo-box" onclick="openSettings()">
                        <img id="header-logo" class="header-icon" src="../assets/img/persib_logo.png">
                    </div>
                </div>
                <div class="col-10 d-flex align-items-center justify-content-center text-white pl-2 pr-2">
                    <form action="search-result.html" method=POST style="width: 90%;">
                        <div class="d-flex align-items-center div-search">
                            <input placeholder="" type="text" class="form-control search-box" name="search-bar" onclick="onFocusSearch()" value="<?= $query; ?>">
                        </div>
                    </form>
                </div>
                <!-- <div class="col-1">
                    <img class="float-end" src="../assets/img/psb_settings.png" style="width:30px">
                </div> -->
            </div>
        </div>
    </div>
    <div class="pt-3 box">
        <div id="container">
            <div id="loading">
                <div class="col-sm mt-2">
                    <h5 class="prod-name" style="text-align:center;">Sedang memuat. Tunggu sebentar...</h5>
                </div>
            </div>
            <div class="d-none" id="no-stores">
                <div class="col-sm mt-2">
                    <h5 class="prod-name" style="text-align:center;">Belum ada produk</h5>
                </div>
            </div>
            <div id="content-grid" class="grid-stack grid-stack-3">
            </div>
        </div>
        <script>
            const search = <?php if (isset($_GET['query'])) {
                                echo '"' . $_GET['query'] . '"';
                            } else {
                                echo "null";
                            } ?>;
            const filter = <?php if (isset($_GET['filter'])) {
                                echo '"' . $_GET['filter'] . '"';
                            } else {
                                echo "null";
                            } ?>;
        </script>
        <script type="text/javascript" src="../assets/js/script-filter.js?random=<?= time(); ?>"></script>
        <script type="text/javascript" src="../assets/js/script-store_list.js?random=<?= time(); ?>"></script>
    </div>
    <div class="bg-grey stack-top" style="display: none;" id="stack-top">
        <div class="container small-text">
            <div class="bg-white row py-3">
                <div class="col-6" style="font-weight:500;">Popular</div>
                <div class="col-6">
                    <img class="float-end" src="../assets/img/icons/Check-(Orange).png" style="width: 15px; height: 15px;"></img>
                </div>
            </div>
            <div class="bg-white row py-3" style="margin-top: 1px;">
                <div class="col-6" style="font-weight:500;">Date Added (New to Old)</div>
            </div>
            <div class="bg-white row py-3" style="margin-top: 1px;">
                <div class="col-6" style="font-weight:500;">Followers</div>
            </div>
        </div>
    </div>
    <!-- FOOTER -->

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
<script>
    function myFunction() {
        var x = document.getElementById("stack-top");
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
    }
</script>

</html>