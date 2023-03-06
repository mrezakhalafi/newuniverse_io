<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/header-alt.php'); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/header-alt-meta.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/url_function.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/db_conn.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/index-nav.php'); ?>

<?php

$dbconn = getDBConn();

//GET BLOG POSTS WITH CORRESPONDING TAGS
$string = "SELECT bp.ID, bp.IMAGE, bp.TITLE, bp.CONTENT
FROM new_nus.BLOG_POST bp
INNER JOIN new_nus.BLOG_TAG bt on bp.ID = bt.BLOG_ID
AND bt.TAG = 'Technology'
ORDER BY bp.ID DESC";
$query = $dbconn->prepare($string);
$query->execute();
$blogpost = $query->get_result();
$query->close();

//GET BLOG POSTS WITH CORRESPONDING TAGS (INDO)
$stringID = "SELECT bp.ID, bp.IMAGE, bp.TITLE, bp.CONTENT
FROM new_nus.BLOG_POST bp
INNER JOIN new_nus.BLOG_TAG bt on bp.ID = bt.BLOG_ID
AND bt.TAG_ID = 'Teknologi'
ORDER BY bp.ID DESC";
$queryID = $dbconn->prepare($stringID);
$queryID->execute();
$blogpostID = $queryID->get_result();
$queryID->close();

$query = $dbconn->prepare("SELECT * FROM BLOG_TAG");
$query->execute();
$blogtag = $query->get_result();
$query->close();
?>

<style>
    @media screen and (min-width:992px) {
        .carousel-img {
            padding: 0 !important;
        }

        .carousel-post {
            padding: 0 7rem !important;
        }
    }

    .btn-blog {
        background-color: #1799ad;
        color: #fff;
    }

    .header-img {
        height: auto;
        width: auto;
        /* max-width: 550px; */
        max-width: 100%;
        max-height: 550px;
    }

    .blog-img {
        max-height: 275px;
    }

    .home-title {
        font-size: 42px;
        line-height: 51px;
        text-align: center;
        font-weight: 600;
        margin-top: 175px;
    }

    .filter-container {
        margin-bottom: 120px;

    }

    .filter-container * {
        font-family: 'Poppins', sans-serif;
    }

    .fa {
        font-family: 'FontAwesome' !important;
    }

    .filter-container .row {
        margin: 0 auto;
        max-width: 80%;
    }

    #categoryDropdown>.dropdown-menu {
        left: 0 !important;
    }

    #blog-banner {
        overflow: hidden;
        margin: 150px 0 0 0;
        background-size: cover;
        background-position: bottom;
        /* padding-top:35px; */
    }

    .btn-blog {
        font-size: 1rem;
    }

    #search-mbl {
        display: none;
    }

    .card-text {
        text-align: justify;
    }

    @media screen and (max-width:991px) {
        /* .carousel-img {
      padding: 3rem 0 0 0 !important;
    } */

        #latest-post {
            padding: 1rem !important;
        }

        #search-mbl {
            display: block;
        }

        .input-group {
            display: none;
        }

        #categoryDropdown {
            font-size: 16px;
        }

        #post_body .col-md-4,
        #post_body .col-md-6 {
            flex: 0 0 100% !important;
            max-width: 100%;
        }

        .card-text {
            text-align: center;
        }
    }

    @media screen and (max-width:600px) {

        .blog-img {
            height: auto;
            width: auto;
            max-width: 275px;
            max-height: 275px;
        }

        .filter-container .row {
            max-width: 90%;
        }
    }

    @media screen and (min-width:992px) and (max-width:1279px) {
        #post_body .col-md-4 {
            flex: 0 0 50% !important;
            max-width: 50%;
        }
    }

    @media screen and (min-width:768px) and (max-width:1366px) {
        .carousel-post {
            padding: 3rem !important;
        }

        .btn-blog {
            font-size: 1rem;
        }

        .filter-container .row {
            max-width: 90%;
        }

        .header-img {
            text-align: center;
            height: auto;
            width: auto;
            max-width: 100%;
            max-height: 350px;
        }

        #blog-banner {
            overflow: hidden;
            /* padding: 70px 0 0 0; */
            margin: 150px 0 0 0;
            background-size: cover;
            background-position: bottom;
        }

        .blog-img {
            max-height: 200px;
        }
    }

    #latest-post {
        background-color: rgba(1, 104, 109, 0.2);
        border-radius: 10px;
        margin-top: 120px;
    }
</style>

<a href="blog-index.php">
    <h1 data-translate="blogindex-10" class="text-center home-title" style="font-family:'Poppins', sans-serif; font-weight: bold !important; color: #1799ad; font-size: 35px">News & Update</h1>
</a>

<div class="filter-container">
    <div class="row">
        <div class="col-md-12">
            <a data-translate="blogindex-2" name='cat' class="btn dropdown-toggle" href="#" role="button" id="categoryDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:black!important; vertical-align: middle !important; float:left; font-size: 18px">

            </a>
            <div class="dropdown-menu" aria-labelledby="categoryDropdown">
                <a data-translate="blogindex-3" class="dropdown-item" href="cat-developer.php"></a>
                <a data-translate="blogindex-4" class="dropdown-item" href="cat-business.php"></a>
                <a data-translate="blogindex-5" class="dropdown-item" href="cat-technology.php"></a>
                <a data-translate="blogindex-6" class="dropdown-item" href="cat-product.php"></a>
            </div>
            <form method="GET" action="blog-search.php">
                <div class="input-group col-md-3" style="position: relative; float:right !important;">
                    <input class="form-control py-2 border-right-0 border" name="src" type="text" placeholder="Search News..." id="example-search-input">
                    <span class="input-group-append" onclick="search()">
                        <div class="input-group-text bg-transparent"><i class="fa fa-search"></i></div>
                    </span>
                </div>
            </form>
            <button class="btn" id="search-mbl" data-toggle="modal" data-target="#searchModal" style="position: relative; float:right !important; font-size:16px;">
                <span class="fa fa-search"></span>
            </button>
        </div>
    </div>
</div>

<div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="GET" action="blog-search.php">
                <div class="modal-header">
                    <!-- <h5 class="modal-title" id="exampleModalLabel">Search News...</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button> -->
                </div>
                <div class="modal-body">

                    <input class="form-control py-2 border-right-0 border" name="qm" type="text" placeholder="Search News..." id="example-search-input">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" style="font-size:1rem;">Close</button>
                    <button type="submit" class="btn btn-blog">Search</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="container-fluid blog-content">
    <!-- Content Row -->
    <div class="row justify-content-center" id="post_body">
        <!-- /.col-md-4 -->
        <?php foreach ($blogpost as $key => $bp) { ?>
            <div class="col-md-4 mb-3 blog-post" id="card-<?php echo $key; ?>">
                <?php

                if (($key + 1) % 5 == 0 || ($key + 2) % 5 == 0) {
                    echo "<script type='text/javascript'>";
                    // echo "$('#" . $key . "').addClass('col-md-6').removeClass('col-md-4');";
                    echo "var card = document.getElementById('card-" . $key . "');";
                    echo "card.classList.add('col-md-6');";
                    echo "card.classList.remove('col-md-4');";
                    echo "</script>";
                }
                ?>
                <div class="card h-100 text-center">
                    <div class="card-body">
                        <img src="<?php echo base_url(); ?>blog/uploads/<?php echo ($bp['IMAGE']); ?>" class="blog-img mb-3">
                        <a href="<?php echo base_url(); ?>blog-content.php?id=<?php echo ($bp['ID']); ?>" class="blog-title-links">
                            <h5 class="card-title fontRobBold" style="font-size: 14px" ><?php echo ($bp['TITLE']); ?>
                            </h5>
                        </a>
                        <p class="josefin-sans">
                            <?php foreach ($blogtag as $bt) {
                                if ($bt['BLOG_ID'] == $bp['ID']) { ?>
                                    <?php echo ($bt['TAG']); ?>
                            <?php }
                            }
                            ?>
                        </p>
                        <p class="card-text text-justify fs-14 josefin-sans"><?php echo strip_tags(mb_strimwidth(base64_decode($bp['CONTENT']), 0, 150, "...")); ?></p>
                        <a data-translate="blogindex-7" style="font-size: 14px" href="<?php echo base_url(); ?>blog-content.php?id=<?php echo ($bp['ID']); ?>" class="btn btn-blog"></a>
                    </div>
                </div>
            </div>
        <?php } ?>

    </div>

    <div class="row justify-content-center" id="post_ID_body">
        <!-- /.col-md-4 -->
        <?php foreach ($blogpostID as $key => $bpd) { ?>
            <div class="col-md-4 mb-3 blog-post" id="card-<?php echo $key; ?>">
                <?php

                if (($key + 1) % 5 == 0 || ($key + 2) % 5 == 0) {
                    echo "<script type='text/javascript'>";
                    // echo "$('#" . $key . "').addClass('col-md-6').removeClass('col-md-4');";
                    echo "var card = document.getElementById('card-" . $key . "');";
                    echo "card.classList.add('col-md-6');";
                    echo "card.classList.remove('col-md-4');";
                    echo "</script>";
                }
                ?>
                <div class="card h-100 text-center">
                    <div class="card-body">
                        <img src="<?php echo base_url(); ?>blog/uploads/<?php echo ($bpd['IMAGE']); ?>" class="blog-img mb-3">
                        <a href="<?php echo base_url(); ?>blog-content.php?id=<?php echo ($bpd['ID']); ?>" class="blog-title-links">
                            <h5 class="card-title fontRobBold" style="font-size: 14px" ><?php echo ($bpd['TITLE']); ?>
                            </h5>
                        </a>
                        <p class="josefin-sans">
                            <?php foreach ($blogtag as $bt) {
                                if ($bt['BLOG_ID'] == $bpd['ID']) { ?>
                                    <?php echo ($bt['TAG_ID']); ?>
                            <?php }
                            }
                            ?>
                        </p>
                        <p class="card-text text-justify fs-14 josefin-sans"><?php echo strip_tags(mb_strimwidth(base64_decode($bpd['CONTENT']), 0, 150, "...")); ?></p>
                        <a data-translate="blogindex-7" style="font-size: 14px" href="<?php echo base_url(); ?>blog-content.php?id=<?php echo ($bpd['ID']); ?>" class="btn btn-blog"></a>
                    </div>
                </div>
            </div>
        <?php } ?>

    </div>
</div>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/contact-button.php'); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/footer-alt.php'); ?>

<script>

if (localStorage.lang == 1){
    $('#example-search-input').attr('placeholder','Cari Berita...');

    $("#post_body").addClass("d-none");
    $("#post_ID_body").removeClass("d-none");
}
else {
    $("#post_body").removeClass("d-none");
    $("#post_ID_body").addClass("d-none");
}

function search(){

    var query = $('#example-search-input').val();

    location.href = "/blog-search?src="+query;

}

$("#change-lang-EN").click(function() {
    console.log("Inggris");

    $("#post_body").removeClass("d-none");
    $("#post_ID_body").addClass("d-none");
});

$("#change-lang-ID").click(function() {
    console.log("Indonesia");

    $("#post_body").addClass("d-none");
    $("#post_ID_body").removeClass("d-none");
});

</script>