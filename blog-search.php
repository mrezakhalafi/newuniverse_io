<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/header-alt.php'); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/header-alt-meta.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/url_function.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/db_conn.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/index-nav.php'); ?>

<?php

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

$dbconn = getDBConn();

$limit_page = 10;
$curr_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$first_page = ($curr_page > 1) ? ($curr_page * $limit_page) - $limit_page : 0;

$previous = $curr_page - 1;
$next = $curr_page + 1;

//GET BLOG POSTS WITH CORRESPONDING TAGS
if (isset($_GET['src'])) {

    $sTrim = urldecode(trim($_GET['src']));
    $sQuery = "%$sTrim%";
    $query = $dbconn->prepare('SELECT * FROM BLOG_POST WHERE TITLE LIKE ? ORDER BY ID DESC');
    $query->bind_param('s', $sQuery);
    $query->execute();
    $sResult = $query->get_result();
    $query->close();
} else if (isset($_GET['qm'])) {

    $sTrim = urldecode(trim($_GET['qm']));
    $sQuery = "%$sTrim%";
    $query = $dbconn->prepare('SELECT * FROM BLOG_POST WHERE TITLE LIKE ? ORDER BY ID DESC');
    $query->bind_param('s', $sQuery);
    $query->execute();
    $sResult = $query->get_result();
    $query->close();
}

$total_data = mysqli_num_rows($sResult);
$total_page = ceil($total_data / $limit_page);

if (!strpos($sQuery, '"')) {
    $srcquery = "SELECT * FROM BLOG_POST WHERE TITLE LIKE \"" . $sQuery . "\" ORDER BY ID DESC LIMIT $first_page, $limit_page";
    $query2 = $dbconn->set_charset("utf8");
    $query2 = $dbconn->prepare($srcquery);
    $query2->execute();
    $query2Result = $query2->get_result();
    $query2->close();
}
// echo $srcquery;

// $query2 = mysqli_query($dbconn, $srcquery);

//GET CORRECT TAGS FOR BLOG POSTS
$str = "SELECT btl.TAG, bp.ID, bp.IMAGE, bp.TITLE, bp.CONTENT
FROM BLOG_POST bp
LEFT JOIN BLOG_TAG bt on bp.ID = bt.BLOG_ID
LEFT JOIN BLOG_TAGLIST btl on bt.TAG = btl.ID";
$query = $dbconn->prepare($str);
$query->execute();
$tags = $query->get_result();
$query->close();

//GET CORRECT TAGS FOR BLOG POSTS ID
$strID = "SELECT btl.TAG_ID, bp.ID, bp.IMAGE, bp.TITLE, bp.CONTENT
FROM BLOG_POST bp
LEFT JOIN BLOG_TAG bt on bp.ID = bt.BLOG_ID
LEFT JOIN BLOG_TAGLIST btl on bt.TAG = btl.ID";
$queryID = $dbconn->prepare($strID);
$queryID->execute();
$tagsID = $queryID->get_result();
$queryID->close();

$string = "SELECT * FROM BLOG_POST ORDER BY ID DESC LIMIT 1";
if (isset($active_tag)) {
    $strPosts = "SELECT bp.*
  FROM BLOG_POST bp
  LEFT JOIN BLOG_TAG bt ON bt.BLOG_ID = bp.ID
  WHERE bt.TAG = '$active_tag'
  ORDER BY bp.ID DESC LIMIT 1";
}
$query = $dbconn->prepare($string);
$query->execute();
$latest_posts = $query->get_result();
$query->close();

//GET ALL BLOG TAG
$str_tags = "SELECT * FROM BLOG_TAGLIST";
$query = $dbconn->prepare($str_tags);
$query->execute();
$tags_result = $query->get_result();
$query->close();

$tags_arr = array();
while ($tag = $tags_result->fetch_assoc()) {
    $tags_arr[] = $tag;
}

?>

<style>
    .blog-img {
        /* max-height: 275px; */
        width: 330px;
        height: 211px;
        object-fit: cover;
        transition: all 0.5s ease-in-out;
    }

    .blog-img:hover {
        transform: scale(1.1, 1.1)
    }

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

    .home-title {
        font-size: 42px;
        line-height: 51px;
        text-align: center;
        font-weight: 600;
        margin-top: 135px;
    }

    .filter-container {
        margin-bottom: 50px;

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

        .card-title {
            text-align: center;
        }
    }

    @media screen and (max-width:600px) {

        .blog-img {
            width: 280px;
            height: 211px;
            /* max-width: 275px;
            max-height: 275px; */
        }

        .filter-container .row {
            max-width: 90%;
        }

        #pagination-section {
            -webkit-transform: scale(0.90);
        }
    }

    @media screen and (max-width:500px) {

        #pagination-section {
            -webkit-transform: scale(0.80);
        }

    }

    @media screen and (max-width:440px) {

        #pagination-section {
            -webkit-transform: scale(0.70);
        }

    }

    @media screen and (max-width:375px) {

        #pagination-section {
            -webkit-transform: scale(0.65);
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
            /* max-height: 200px; */
            width: 280px;
            height: 211px;
        }
    }

    #latest-post {
        background-color: #e2f3ff;
        border-radius: 10px;
        margin-top: 120px;
    }

    .prv-body {
        font-weight: 300;
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 4;
        -webkit-box-orient: vertical;
    }

    .blog-img {
        border-radius: 15px;
    }

    .latest-tags {
        text-transform: uppercase;
        /* text-align: left; */
    }

    .latest-tags {
        text-transform: uppercase;
        font-size: 0.9rem;
    }

    .card-title {
        height: 25px;
    }

    @media screen and (max-width:1535px) {
        .blog-img {
            width: 280px;
        }
    }

    .card {
        border: none !important;
    }
</style>


<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>
    body {
        font-family: 'Poppins', sans-serif !important;
    }
</style>

<!-- <a href="blog-index.php"> -->
<h1 data-translate="blogindex-10" class="text-center home-title" style="font-family:'Poppins',sans-serif; font-weight: bold !important; color: #1799ad; font-size: 35px">News & Update</h1>
<!-- </a> -->

<div class="container" style="width: 95%">
    <div class="row p-4 mb-3">
        <div class="col-12 text-justify">
            <div class="card py-3" style="border: 1px solid #c5c5c5">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-2 text-center">
                            <img src="bot.png" style="width:100px; height: 100px">
                        </div>
                        <div class="col-12 col-md-10">
                            <p class="mb-0 px-1 text-justify" data-translate="blogindex-15"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<div class="filter-container">
    <div class="row">
        <div class="col-md-12">
            <a data-translate="blogindex-2" name='cat' class="btn dropdown-toggle" href="#" role="button" id="categoryDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:black!important; vertical-align: middle !important; float:left; font-size: 18px">

            </a>
            <div class="dropdown-menu" aria-labelledby="categoryDropdown">
                <a data-translate="blogindex-14" class="dropdown-item" href="blog-index.php" style="font-size: 18px;"></a>
                <?php
                foreach ($tags_arr as $tag) {
                    $tag_id = $tag["ID"];
                    $tag_name = $tag["TAG"];
                    $tag_name_id = $tag["TAG_ID"];
                    echo '<a class="dropdown-item" href="blog-index.php?tag=' . $tag_id . '" style="font-size: 18px;">' . $tag_name . '</a>';
                }
                ?>
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

<div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 9999">
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

                    <input class="form-control py-2 border-right-0 border" name="qm" type="text" placeholder="Search News..." id="example-search-input-mobile">

                </div>
                <div class="modal-footer">
                    <button data-translate="blogindex-8" type="button" class="btn btn-secondary" data-dismiss="modal" style="font-size:1rem;"></button>
                    <button data-translate="blogindex-9" type="button" onclick="searchMobile()" class="btn btn-blog"></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="container blog-content">
    <h4 style="color:#5e5e5e; font-weight: bold; margin-bottom: 20px"><span data-translate="blogindex-17">Search Result for keyword :</span> <?= $_GET['src'] ? urldecode($_GET['src']) : urldecode($_GET['qm']) ?></h4>
    <!-- Content Row -->
    <div class="row justify-content-center" id="post_body">

        <?php if ($total_data > 0 && isset($query2Result)) : ?>
            <?php while ($sr = $query2Result->fetch_assoc()) { ?>
                <div class="col-md-4 mb-3 blog-post" id="card-<?php echo $sr['ID']; ?>">
                    <?php

                    // if (($key + 1) % 5 == 0 || ($key + 2) % 5 == 0) {
                    //     echo "<script type='text/javascript'>";
                    //     // echo "$('#" . $key . "').addClass('col-md-6').removeClass('col-md-4');";
                    //     echo "var card = document.getElementById('card-" . $key . "');";
                    //     echo "card.classList.add('col-md-6');";
                    //     echo "card.classList.remove('col-md-4');";
                    //     echo "</script>";
                    // }
                    ?>
                    <div class="card h-100 text-center">
                        <div class="card-body">
                            <img src="https://newuniverse.io/blog/uploads/<?php echo ($sr['IMAGE']); ?>" class="blog-img mb-3">
                            <p class="josefin-sans headline latest-tags" style="font-size: 14px;">
                                <?php
                                $tag_arr = array();
                                $index = 0;
                                foreach ($tags as $tag) {
                                    if ($tag['ID'] == $sr['ID']) {
                                        $tag_arr[$index] = $tag['TAG'];
                                        $index++;
                                    }
                                }
                                $tag_str = implode(", ", $tag_arr);
                                ?>
                                <span class="blog-category" style="color:#1799ad; font-weight: bold">
                                    <?= $tag_str; ?>
                                </span>

                                <?php
                                $tag_arr_id = array();
                                $indeks = 0;
                                foreach ($tagsID as $tag_id) {
                                    if ($tag_id['ID'] == $sr['ID']) {
                                        $tag_arr_id[$indeks] = $tag_id['TAG_ID'];
                                        $indeks++;
                                    }
                                }
                                $tag_str_id = implode(", ", $tag_arr_id);
                                ?>
                                <span class="blog-category_id" style="color:#1799ad; font-weight: bold">
                                    <?= $tag_str_id; ?>
                                </span>
                            </p>
                            <a href="<?php echo base_url(); ?>blog-content.php?id=<?php echo ($sr['ID']); ?>" class="blog-title-links">
                                <h5 class="card-title fontRobBold fs-14 mt-3 mb-4">
                                    <!-- <?php echo ($sr['TITLE']); ?> -->
                                    <?php echo (mb_strimwidth($sr['TITLE'], 0, 60, "...")); ?>
                                </h5>
                            </a>
                            <p class="card-text fs-14 josefin-sans prv-body" style="height: 84px">
                                <?php

                                if ($sr["SUMMARY"] == null || $sr["SUMMARY"] == "") {
                                    echo strip_tags(mb_strimwidth(urldecode(base64_decode($sr['CONTENT'])), 0, 250, "..."));
                                } else {
                                    echo strip_tags(urldecode(base64_decode($sr['SUMMARY'])));
                                }

                                ?>
                            </p>
                            <a data-translate="blogindex-7" style="font-size: 14px" class="btn btn-blog mt-3 mb-2" href="<?php echo base_url(); ?>blog-content.php?id=<?php echo ($sr['ID']); ?>"></a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        <?php else : ?>
            <div class="row">
                <div class="col-12 m-5" style="margin-bottom: 200px !important">
                    <div style="font-size: 25px" data-translate="blogindex-16">No result available. Try search something else.</div>
                </div>
            </div>
        <?php endif; ?>

    </div>

    <!-- PAGINATION -->
    <?php
    $catID = $_GET['tag'];
    $catSRC = $_GET['src'];
    if ($total_data > 1 && isset($query2Result)) {
        if (!isset($_GET['tag'])) {
    ?>
            <div id="pagination-section" class="row pb-3">
                <div class="col-12 text-center">
                    <ul class="pagination justify-content-center mb-0">
                        <div class="row">
                            <?php if ($curr_page != 1) { ?>
                                <div class="col p-0">
                                    <li class="page-item" style="width: 38px">
                                        <a id="prev-to-first-text" class="page-link" <?php if ($curr_page > 1) {
                                                                                            echo "href='?page=1&src=$catSRC'";
                                                                                        } ?>><i class="fa fa-angle-left" style="font-size:16px"></i><i class="fa fa-angle-left" style="font-size:16px"></i></a>
                                    </li>
                                </div>
                                <div class="col p-0">
                                    <li class="page-item">
                                        <a id="prev-text" class="page-link" <?php if ($curr_page > 1) {
                                                                                echo "href='?page=$previous&src=$catSRC'";
                                                                            } ?>><i class="fa fa-angle-left" style="font-size:16px"></i></a>
                                    </li>
                                </div>
                            <?php } ?>
                            <div class="col p-0 d-flex">
                                <?php
                                $link = "";
                                $is_first_active = 0;

                                if ($total_page >= 1 && $curr_page <= $total_page) {
                                    $counter = 1;
                                    $link = "";

                                    if ($curr_page + 3 > $total_page) {
                                        $showPage = $total_page;
                                    } else {
                                        $showPage = $curr_page + 3;
                                    }

                                    for ($x = $curr_page; $x <= $showPage; $x++) {

                                        if ($counter < $limit_page) {

                                            if (!isset($_GET['page']) && $is_first_active == 0) {

                                                $link .= "<li class=\"page-item\" style=\"width: 100%\"><a class=\"page-link\" style=\"background-color: #1799ad; color: white\" href=\"?page=" . $x . "&src=$catSRC\">" . $x . "</a></li>";
                                                $is_first_active = 1;
                                            } else if (!isset($_GET['page']) && $is_first_active == 1) {

                                                $link .= "<li class=\"page-item\" style=\"width: 100%\"><a class=\"page-link\" href=\"?page=" . $x . "&src=$catSRC\">" . $x . "</a></li>";
                                            } else {

                                                if ($x == $_GET['page']) {
                                                    if ($total_page >= 4) {
                                                        if ($x == $total_page - 2) { // PAGE KE 2, DARI TOTAL PAGE 4 YG MUNCUL
                                                            $y = $x - 1;
                                                            $link .= "<li class=\"page-item\" style=\"width: 100%\"><a class=\"page-link\" href=\"?page=" . $y . "&src=$catSRC\">" . $y . "</a></li><li class=\"page-item\" style=\"width: 100%\"><a class=\"page-link\" style=\"background-color: #1799ad; color: white\" href=\"?page=" . $x . "&src=$catSRC\">" . $x . "</a></li>";
                                                        } else if ($x == $total_page - 1) { // PAGE KE 3, DARI TOTAL PAGE 4 YG MUNCUL
                                                            $y = $x - 1;
                                                            $z = $y - 1;
                                                            $link .= "<li class=\"page-item\" style=\"width: 100%\"><a class=\"page-link\" href=\"?page=" . $z . "&src=$catSRC\">" . $z . "</a></li><li class=\"page-item\" style=\"width: 100%\"><a class=\"page-link\" href=\"?page=" . $y . "&src=$catSRC\">" . $y . "</a></li><li class=\"page-item\" style=\"width: 100%\"><a class=\"page-link\" style=\"background-color: #1799ad; color: white\" href=\"?page=" . $x . "&src=$catSRC\">" . $x . "</a></li>";
                                                        } else if ($x == $total_page) { // PAGE KE 4, DARI TOTAL PAGE 4 YG MUNCUL
                                                            $y = $x - 1;
                                                            $z = $y - 1;
                                                            $w = $z - 1;
                                                            $link .= "<li class=\"page-item\" style=\"width: 100%\"><a class=\"page-link\" href=\"?page=" . $w . "&src=$catSRC\">" . $w . "</a></li><li class=\"page-item\" style=\"width: 100%\"><a class=\"page-link\" href=\"?page=" . $z . "&src=$catSRC\">" . $z . "</a></li><li class=\"page-item\" style=\"width: 100%\"><a class=\"page-link\" href=\"?page=" . $y . "&src=$catSRC\">" . $y . "</a></li><li class=\"page-item\" style=\"width: 100%\"><a class=\"page-link\" style=\"background-color: #1799ad; color: white\" href=\"?page=" . $x . "&src=$catSRC\">" . $x . "</a></li>";
                                                        } else {
                                                            $link .= "<li class=\"page-item\" style=\"width: 100%\"><a class=\"page-link\" style=\"background-color: #1799ad; color: white\" href=\"?page=" . $x . "&src=$catSRC\">" . $x . "</a></li>";
                                                        }
                                                    } else if ($total_page == 3) {
                                                        if ($x == $total_page - 1) { // PAGE KE 2, DARI TOTAL PAGE 3 YG MUNCUL
                                                            $y = $x - 1;
                                                            $link .= "<li class=\"page-item\" style=\"width: 100%\"><a class=\"page-link\" href=\"?page=" . $y . "&src=$catSRC\">" . $y . "</a></li><li class=\"page-item\" style=\"width: 100%\"><a class=\"page-link\" style=\"background-color: #1799ad; color: white\" href=\"?page=" . $x . "&src=$catSRC\">" . $x . "</a></li>";
                                                        } else if ($x == $total_page) { // PAGE KE 3, DARI TOTAL PAGE 3 YG MUNCUL
                                                            $y = $x - 1;
                                                            $z = $y - 1;
                                                            $link .= "<li class=\"page-item\" style=\"width: 100%\"><a class=\"page-link\" href=\"?page=" . $z . "&src=$catSRC\">" . $z . "</a></li><li class=\"page-item\" style=\"width: 100%\"><a class=\"page-link\" href=\"?page=" . $y . "&src=$catSRC\">" . $y . "</a></li><li class=\"page-item\" style=\"width: 100%\"><a class=\"page-link\" style=\"background-color: #1799ad; color: white\" href=\"?page=" . $x . "&src=$catSRC\">" . $x . "</a></li>";
                                                        } else {
                                                            $link .= "<li class=\"page-item\" style=\"width: 100%\"><a class=\"page-link\" style=\"background-color: #1799ad; color: white\" href=\"?page=" . $x . "&src=$catSRC\">" . $x . "</a></li>";
                                                        }
                                                    } else if ($total_page == 2) {
                                                        if ($x == $total_page) {
                                                            $y = $x - 1;
                                                            $link .= "<li class=\"page-item\" style=\"width: 100%\"><a class=\"page-link\" href=\"?page=" . $y . "&src=$catSRC\">" . $y . "</a></li><li class=\"page-item\" style=\"width: 100%\"><a class=\"page-link\" style=\"background-color: #1799ad; color: white\" href=\"?page=" . $x . "&src=$catSRC\">" . $x . "</a></li>";
                                                        } else {
                                                            $link .= "<li class=\"page-item\" style=\"width: 100%\"><a class=\"page-link\" style=\"background-color: #1799ad; color: white\" href=\"?page=" . $x . "&src=$catSRC\">" . $x . "</a></li>";
                                                        }
                                                    } else {
                                                        $link .= "<li class=\"page-item\" style=\"width: 100%\"><a class=\"page-link\" style=\"background-color: #1799ad; color: white\" href=\"?page=" . $x . "&src=$catSRC\">" . $x . "</a></li>";
                                                    }
                                                } else {
                                                    $link .= "<li class=\"page-item\" style=\"width: 100%\"><a class=\"page-link\" href=\"?page=" . $x . "&src=$catSRC\">" . $x . "</a></li>";
                                                }
                                            }
                                        }
                                        $counter++;
                                    }
                                }

                                echo $link;
                                ?>
                            </div>
                            <?php if ($curr_page != $total_page) { ?>
                                <div class="col p-0">
                                    <li class="page-item">
                                        <a id="next-text" class="page-link" <?php if ($curr_page < $total_page) {
                                                                                echo "href='?page=$next&src=$catSRC'";
                                                                            } ?>><i class="fa fa-angle-right" style="font-size:16px"></i></a>
                                    </li>
                                </div>
                                <div class="col p-0">
                                    <li class="page-item" style="width: 38px">
                                        <a id="next-to-last-text" class="page-link" <?php if ($curr_page < $total_page) {
                                                                                        echo "href='?page=$total_page&src=$catSRC'";
                                                                                    } ?>><i class="fa fa-angle-right" style="font-size:16px"></i><i class="fa fa-angle-right" style="font-size:16px"></i></a>
                                    </li>
                                </div>
                            <?php } ?>
                        </div>
                    </ul>
                </div>
            </div>
        <?php
        } else {
        ?>
            <div id="pagination-section" class="row pb-3">
                <div class="col-12 text-center">
                    <ul class="pagination justify-content-center mb-0">
                        <div class="row">
                            <?php if ($curr_page != 1) { ?>
                                <div class="col p-0">
                                    <li class="page-item" style="width: 38px">
                                        <a id="prev-to-first-text" class="page-link" <?php if ($curr_page > 1) {
                                                                                            echo "href='?page=1&tag=$catID&src=$catSRC'";
                                                                                        } ?>><i class="fa fa-angle-left" style="font-size:16px"></i><i class="fa fa-angle-left" style="font-size:16px"></i></a>
                                    </li>
                                </div>
                                <div class="col p-0">
                                    <li class="page-item">
                                        <a id="prev-text" class="page-link" <?php if ($curr_page > 1) {
                                                                                echo "href='?page=$previous&tag=$catID&src=$catSRC'";
                                                                            } ?>><i class="fa fa-angle-left" style="font-size:16px"></i></a>
                                    </li>
                                </div>
                            <?php } ?>
                            <div class="col p-0 d-flex">
                                <?php
                                $link = "";
                                $is_first_active = 0;

                                if ($total_page >= 1 && $curr_page <= $total_page) {
                                    $counter = 1;
                                    $link = "";

                                    if ($curr_page + 3 > $total_page) {
                                        $showPage = $total_page;
                                    } else {
                                        $showPage = $curr_page + 3;
                                    }

                                    for ($x = $curr_page; $x <= $showPage; $x++) {

                                        if ($counter < $limit_page) {

                                            if (!isset($_GET['page']) && $is_first_active == 0) {

                                                $link .= "<li class=\"page-item\" style=\"width: 100%\"><a class=\"page-link\" style=\"background-color: #1799ad; color: white\" href=\"?page=" . $x . "&tag=$catID&src=$catSRC\">" . $x . "</a></li>";
                                                $is_first_active = 1;
                                            } else if (!isset($_GET['page']) && $is_first_active == 1) {

                                                $link .= "<li class=\"page-item\" style=\"width: 100%\"><a class=\"page-link\" href=\"?page=" . $x . "&tag=$catID&src=$catSRC\">" . $x . "</a></li>";
                                            } else {

                                                if ($x == $_GET['page']) {
                                                    if ($total_page >= 4) {
                                                        if ($x == $total_page - 2) { // PAGE KE 2, DARI TOTAL PAGE 4 YG MUNCUL
                                                            $y = $x - 1;
                                                            $link .= "<li class=\"page-item\" style=\"width: 100%\"><a class=\"page-link\" href=\"?page=" . $y . "&src=$catSRC&tag=$catID\">" . $y . "</a></li><li class=\"page-item\" style=\"width: 100%\"><a class=\"page-link\" style=\"background-color: #1799ad; color: white\" href=\"?page=" . $x . "&src=$catSRC&tag=$catID\">" . $x . "</a></li>";
                                                        } else if ($x == $total_page - 1) { // PAGE KE 3, DARI TOTAL PAGE 4 YG MUNCUL
                                                            $y = $x - 1;
                                                            $z = $y - 1;
                                                            $link .= "<li class=\"page-item\" style=\"width: 100%\"><a class=\"page-link\" href=\"?page=" . $z . "&src=$catSRC&tag=$catID\">" . $z . "</a></li><li class=\"page-item\" style=\"width: 100%\"><a class=\"page-link\" href=\"?page=" . $y . "&src=$catSRC&tag=$catID\">" . $y . "</a></li><li class=\"page-item\" style=\"width: 100%\"><a class=\"page-link\" style=\"background-color: #1799ad; color: white\" href=\"?page=" . $x . "&src=$catSRC&tag=$catID\">" . $x . "</a></li>";
                                                        } else if ($x == $total_page) { // PAGE KE 4, DARI TOTAL PAGE 4 YG MUNCUL
                                                            $y = $x - 1;
                                                            $z = $y - 1;
                                                            $w = $z - 1;
                                                            $link .= "<li class=\"page-item\" style=\"width: 100%\"><a class=\"page-link\" href=\"?page=" . $w . "&src=$catSRC&tag=$catID\">" . $w . "</a></li><li class=\"page-item\" style=\"width: 100%\"><a class=\"page-link\" href=\"?page=" . $z . "&src=$catSRC&tag=$catID\">" . $z . "</a></li><li class=\"page-item\" style=\"width: 100%\"><a class=\"page-link\" href=\"?page=" . $y . "&src=$catSRC&tag=$catID\">" . $y . "</a></li><li class=\"page-item\" style=\"width: 100%\"><a class=\"page-link\" style=\"background-color: #1799ad; color: white\" href=\"?page=" . $x . "&src=$catSRC&tag=$catID\">" . $x . "</a></li>";
                                                        } else {
                                                            $link .= "<li class=\"page-item\" style=\"width: 100%\"><a class=\"page-link\" style=\"background-color: #1799ad; color: white\" href=\"?page=" . $x . "&src=$catSRC&tag=$catID\">" . $x . "</a></li>";
                                                        }
                                                    } else if ($total_page == 3) {
                                                        if ($x == $total_page - 1) { // PAGE KE 2, DARI TOTAL PAGE 3 YG MUNCUL
                                                            $y = $x - 1;
                                                            $link .= "<li class=\"page-item\" style=\"width: 100%\"><a class=\"page-link\" href=\"?page=" . $y . "&src=$catSRC&tag=$catID\">" . $y . "</a></li><li class=\"page-item\" style=\"width: 100%\"><a class=\"page-link\" style=\"background-color: #1799ad; color: white\" href=\"?page=" . $x . "&src=$catSRC&tag=$catID\">" . $x . "</a></li>";
                                                        } else if ($x == $total_page) { // PAGE KE 3, DARI TOTAL PAGE 3 YG MUNCUL
                                                            $y = $x - 1;
                                                            $z = $y - 1;
                                                            $link .= "<li class=\"page-item\" style=\"width: 100%\"><a class=\"page-link\" href=\"?page=" . $z . "&src=$catSRC&tag=$catID\">" . $z . "</a></li><li class=\"page-item\" style=\"width: 100%\"><a class=\"page-link\" href=\"?page=" . $y . "&src=$catSRC&tag=$catID\">" . $y . "</a></li><li class=\"page-item\" style=\"width: 100%\"><a class=\"page-link\" style=\"background-color: #1799ad; color: white\" href=\"?page=" . $x . "&src=$catSRC&tag=$catID\">" . $x . "</a></li>";
                                                        } else {
                                                            $link .= "<li class=\"page-item\" style=\"width: 100%\"><a class=\"page-link\" style=\"background-color: #1799ad; color: white\" href=\"?page=" . $x . "&src=$catSRC&tag=$catID\">" . $x . "</a></li>";
                                                        }
                                                    } else if ($total_page == 2) {
                                                        if ($x == $total_page) {
                                                            $y = $x - 1;
                                                            $link .= "<li class=\"page-item\" style=\"width: 100%\"><a class=\"page-link\" href=\"?page=" . $y . "&src=$catSRC&tag=$catID\">" . $y . "</a></li><li class=\"page-item\" style=\"width: 100%\"><a class=\"page-link\" style=\"background-color: #1799ad; color: white\" href=\"?page=" . $x . "&src=$catSRC&tag=$catID\">" . $x . "</a></li>";
                                                        } else {
                                                            $link .= "<li class=\"page-item\" style=\"width: 100%\"><a class=\"page-link\" style=\"background-color: #1799ad; color: white\" href=\"?page=" . $x . "&src=$catSRC&tag=$catID\">" . $x . "</a></li>";
                                                        }
                                                    } else {
                                                        $link .= "<li class=\"page-item\" style=\"width: 100%\"><a class=\"page-link\" style=\"background-color: #1799ad; color: white\" href=\"?page=" . $x . "&src=$catSRC&tag=$catID\">" . $x . "</a></li>";
                                                    }
                                                } else {
                                                    $link .= "<li class=\"page-item\" style=\"width: 100%\"><a class=\"page-link\" href=\"?page=" . $x . "&src=$catSRC&tag=$catID\">" . $x . "</a></li>";
                                                }
                                            }
                                        }
                                        $counter++;
                                    }
                                }

                                echo $link;
                                ?>
                            </div>
                            <?php if ($curr_page != $total_page) { ?>
                                <div class="col p-0">
                                    <li class="page-item">
                                        <a id="next-text" class="page-link" <?php if ($curr_page < $total_page) {
                                                                                echo "href='?page=$next&tag=$catID&src=$catSRC'";
                                                                            } ?>><i class="fa fa-angle-right" style="font-size:16px"></i></a>
                                    </li>
                                </div>
                                <div class="col p-0">
                                    <li class="page-item" style="width: 38px">
                                        <a id="next-to-last-text" class="page-link" <?php if ($curr_page < $total_page) {
                                                                                        echo "href='?page=$total_page&tag=$catID&src=$catSRC'";
                                                                                    } ?>><i class="fa fa-angle-right" style="font-size:16px"></i><i class="fa fa-angle-right" style="font-size:16px"></i></a>
                                    </li>
                                </div>
                            <?php } ?>
                        </div>
                    </ul>
                </div>
            </div>
    <?php
        }
    }
    ?>
    <!-- END PAGINATION -->
</div>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/contact-button.php'); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/footer-alt.php'); ?>
<footer class="footerBanner-alt"></footer>

<script>
    var query = `<?= urldecode($_GET['src']) ?>`;

    if (query != "" && query != null) {
        $('#example-search-input').val(query);
        $('#example-search-input-mobile').val(query);
    }

    function search() {

        var query = $('#example-search-input').val();

        if (/\S/.test(query)) {
            location.href = "/blog-search?src=" + query;
        }

    }

    function searchMobile() {

        var queryMobile = $('#example-search-input-mobile').val();

        if (/\S/.test(queryMobile)) {
            location.href = "/blog-search?src=" + queryMobile;
        }

    }

    var input = document.getElementById("example-search-input");

    input.addEventListener("keypress", function(event) {

        var query = $('#example-search-input').val();

        if (event.key === "Enter") {

            if (!/\S/.test(query)) {
                event.preventDefault();
                return false;

            }
        }
    });

    var inputMobile = document.getElementById("example-search-input-mobile");

    inputMobile.addEventListener("keypress", function(event) {

        var query = $('#example-search-input-mobile').val();

        if (event.key === "Enter") {


            if (query == "") {
                event.preventDefault();
                return false;

            }

        }
    });

    if (localStorage.lang == 1) {
        $('#example-search-input').attr('placeholder', 'Cari Berita...')
        $('#example-search-input-mobile').attr('placeholder', 'Cari Berita...')
    }

    if (localStorage.lang == 1) {
        $(".blog-category").addClass("d-none");
        $(".blog-category_id").removeClass("d-none");

        $(".blog-category_prv").addClass("d-none");
        $(".blog-category_prv_id").removeClass("d-none");
    } else {
        $(".blog-category").removeClass("d-none");
        $(".blog-category_id").addClass("d-none");

        $(".blog-category_prv").removeClass("d-none");
        $(".blog-category_prv_id").addClass("d-none");
    }

    $("#change-lang-EN").click(function() {
        console.log("Inggris");

        $(".blog-category").removeClass("d-none");
        $(".blog-category_id").addClass("d-none");

        $(".blog-category_prv").removeClass("d-none");
        $(".blog-category_prv_id").addClass("d-none");
    });

    $("#change-lang-ID").click(function() {
        console.log("Indonesia");

        $(".blog-category").addClass("d-none");
        $(".blog-category_id").removeClass("d-none");

        $(".blog-category_prv").addClass("d-none");
        $(".blog-category_prv_id").removeClass("d-none");
    });

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

        var animateLevelUpTi1;
        var animateLevelUpTi2;
        var animateLevelUpTi3;
        var animateLevelUpTi4;

        runLevelUpAnimation();
        resumeLevelUpAnimation();

        $('#FB_1').on("mouseenter", function() {
            clearAnimateLevelUp();
            $('#FB_1').attr('src', 'palio_button/assets/Untitled110_20220121183610.png');
            $('#FB_2').attr('src', 'newAssets/floating_button/button_chat.png');
            $('#FB_3').attr('src', 'newAssets/floating_button/button_call.png');
            $('#FB_4').attr('src', 'newAssets/floating_button/button_stream.png');
        }).on("mouseleave", function() {
            resumeLevelUpAnimation();
        });

        $('#FB_2').on("mouseenter", function() {
            clearAnimateLevelUp();
            $('#FB_1').attr('src', 'newAssets/floating_button/button_cc.png');
            $('#FB_2').attr('src', 'palio_button/assets/Untitled110_20220121183614.png');
            $('#FB_3').attr('src', 'newAssets/floating_button/button_call.png');
            $('#FB_4').attr('src', 'newAssets/floating_button/button_stream.png');
        }).on("mouseleave", function() {
            resumeLevelUpAnimation();
        });

        $('#FB_3').on("mouseenter", function() {
            clearAnimateLevelUp();
            $('#FB_1').attr('src', 'newAssets/floating_button/button_cc.png');
            $('#FB_2').attr('src', 'newAssets/floating_button/button_chat.png');
            $('#FB_3').attr('src', 'palio_button/assets/Untitled110_20220121183621.png');
            $('#FB_4').attr('src', 'newAssets/floating_button/button_stream.png');
        }).on("mouseleave", function() {
            resumeLevelUpAnimation();
        });

        $('#FB_4').on("mouseenter", function() {
            clearAnimateLevelUp();
            $('#FB_1').attr('src', 'newAssets/floating_button/button_cc.png');
            $('#FB_2').attr('src', 'newAssets/floating_button/button_chat.png');
            $('#FB_3').attr('src', 'newAssets/floating_button/button_call.png');
            $('#FB_4').attr('src', 'palio_button/assets/Untitled110_20220121183617.png');
        }).on("mouseleave", function() {
            resumeLevelUpAnimation();
        });

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