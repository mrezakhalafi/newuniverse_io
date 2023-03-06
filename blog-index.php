<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/header-alt.php'); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/header-alt-meta.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/url_function.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/db_conn.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/index-nav.php'); ?>
<?php

$_SESSION['previous_page'] = $_SESSION['current_page'];
$_SESSION['current_page'] = 6;
require_once($_SERVER['DOCUMENT_ROOT'] . '/state_control.php');

?>
<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$dbconn = getDBConn();

if (isset($_GET["tag"])) {
  $active_tag = $_GET["tag"];
}

$limit_page = 10;
$curr_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$first_page = ($curr_page > 1) ? ($curr_page * $limit_page) - $limit_page : 0;

$previous = $curr_page - 1;
$next = $curr_page + 1;

//GET ALL BLOG POST FROM NEWEST TO OLDEST
$strPosts = "SELECT * FROM BLOG_POST ORDER BY ID DESC";
if (isset($active_tag)) {
  $strPosts = "SELECT bp.*
  FROM BLOG_POST bp
  LEFT JOIN BLOG_TAG bt ON bt.BLOG_ID = bp.ID
  WHERE bt.TAG = '$active_tag'
  ORDER BY bp.ID DESC";
}

$query = $dbconn->set_charset("utf8");
$query = $dbconn->prepare($strPosts);
$query->execute();
$blogpost = $query->get_result();
$query->close();

$total_data = mysqli_num_rows($blogpost);
$total_page = ceil($total_data / $limit_page);

$strPosts2 = mysqli_query($dbconn, "SELECT * FROM BLOG_POST ORDER BY ID DESC LIMIT $first_page, $limit_page");
if (isset($active_tag)) {
  $strPosts2 = mysqli_query($dbconn, "SELECT bp.*
  FROM BLOG_POST bp
  LEFT JOIN BLOG_TAG bt ON bt.BLOG_ID = bp.ID
  WHERE bt.TAG = '$active_tag'
  ORDER BY bp.ID DESC LIMIT $first_page, $limit_page");
}

// print_r($blogpost->num_rows);

// SECTION MEMCACHE

$memcache = new Memcache;
$memcache->connect('127.0.0.1', 11211) or die("Could not connect");
$tags_result = unserialize($memcache->get('tags_result'));

if ($tags_result == false) {

  // GET ALL BLOG TAG
  $str_tags = "SELECT * FROM BLOG_TAGLIST";
  $query = $dbconn->prepare($str_tags);
  $query->execute();
  $tags_result = $query->get_result();

  $memcache->set('tags_result', serialize($tags_result), false, 10);

  $query->close();
  // $memcache->close();
}

// END SECTION MEMCACHE

$tags_arr = array();
$list_cat_id = array();

while ($tag = $tags_result->fetch_assoc()) {
  $tags_arr[] = $tag;
}

// PREVENT FILL CATEGORY IN SEARCH BAR

if (isset($_GET['tag'])) {

  foreach ($tags_arr as $tag) {
    array_push($list_cat_id, $tag['ID']);
  }

  if (!in_array($_GET['tag'], $list_cat_id)) {
    header("Location: https://newuniverse.io/blog-index.php");
  }
}

$tags = unserialize($memcache->get('tags'));

if ($tags == false) {

  //GET CORRECT TAGS FOR BLOG POSTS
  $str = "SELECT btl.TAG, bp.ID, bp.IMAGE, bp.TITLE, bp.CONTENT
  FROM BLOG_POST bp
  LEFT JOIN BLOG_TAG bt on bp.ID = bt.BLOG_ID
  LEFT JOIN BLOG_TAGLIST btl on bt.TAG = btl.ID";
  $query = $dbconn->prepare($str);
  $query->execute();
  $tags = $query->get_result();

  $memcache->set('tags', serialize($tags), false, 10);

  $query->close();
}

// print_r(mysqli_num_rows($tags));

$tagsID = unserialize($memcache->get('tagsID'));

if ($tagsID == false) {

  //GET CORRECT TAGS FOR BLOG POSTS ID
  $strID = "SELECT btl.TAG_ID, bp.ID, bp.IMAGE, bp.TITLE, bp.CONTENT
  FROM BLOG_POST bp
  LEFT JOIN BLOG_TAG bt on bp.ID = bt.BLOG_ID
  LEFT JOIN BLOG_TAGLIST btl on bt.TAG = btl.ID";
  $queryID = $dbconn->prepare($strID);
  $queryID->execute();
  $tagsID = $queryID->get_result();

  $memcache->set('tagsID', serialize($tagsID), false, 10);

  $queryID->close();
}

// GET 3 LATEST BLOG POSTS
// $string = "SELECT * FROM (
//     SELECT * FROM BLOG_POST ORDER BY ID DESC LIMIT 3
//   ) sub
//   ORDER BY ID ASC";
$string = "SELECT * FROM BLOG_POST ORDER BY ID DESC LIMIT 1";
if (isset($active_tag)) {
  $strPosts = "SELECT bp.*
  FROM BLOG_POST bp
  LEFT JOIN BLOG_TAG bt ON bt.BLOG_ID = bp.ID
  WHERE bt.TAG = '$active_tag'
  ORDER BY bp.ID DESC LIMIT 1";
}
$query = $dbconn->set_charset("utf8");
$query = $dbconn->prepare($string);
$query->execute();
$latest_posts = $query->get_result();
$query->close();

?>

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<title>nexilis Blog - newuniverse.io</title>

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

  .header-img {
    object-fit: cover;
    transition: all 0.5s ease-in-out;
  }

  .header-img:hover {
    transform: scale(1.1, 1.1)
  }

  @media screen and (min-width:992px) {
    .carousel-img {
      padding: 0 !important;
    }

    .carousel-post {
      padding: 0 7rem !important;
    }

    .card-img {
      /* min-height: 300px; */
      display: flex;
      align-items: center;
    }
  }

  .btn-blog {
    background-color: #1799ad;
    color: #fff;
  }

  .header-img {
    width: 400px;
    height: 250px;
    /* border-bottom-left-radius: 10px;
    border-top-left-radius: 10px; */
  }

  .home-title {
    font-size: 42px;
    line-height: 51px;
    text-align: center;
    font-weight: 600;
    margin-top: 135px;
  }

  .filter-container {
    /* margin-bottom: 120px; */

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

    .prv-tags {
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

    .carousel-post {
      padding: 3rem !important;
      text-align: left !important;
    }
  }

  @media screen and (min-width:768px) and (max-width:1366px) {
    .carousel-post {
      padding: 3rem !important;
      text-align: center;
    }

    .btn-blog {
      font-size: 1rem;
    }

    .filter-container .row {
      max-width: 90%;
    }

    .header-img {
      height: auto;
      /* width: auto; */
      max-width: 100%;
      /* max-height: 100%; */
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
    margin-top: 50px;
  }

  .prv-tags {
    text-transform: uppercase;
    /* text-align: left; */
  }

  .prv-body {
    font-weight: 300;
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: 4;
    -webkit-box-orient: vertical;
    /* height: 80px; */
  }

  .latest-tags {
    text-transform: uppercase;
    font-size: 0.9rem;
  }

  .headline {
    color: black;
  }

  .footerBanner-alt {
    /* position: fixed;
    width: 100%;
    bottom: 0; */
  }

  .blog-img {
    border-radius: 15px;
  }

  .card-title {
    height: 25px;
  }

  @media screen and (max-width:1535px) {
    .blog-img {
      width: 280px;
    }
  }

  .scroll-html {
    max-width: 100%;
    overflow: hidden;
  }

  .card {
    border: none !important;
  }
</style>

<!-- <a href="blog-index.php"> -->
<h1 class="text-center home-title" data-translate="blogindex-10" style="font-family:'Poppins',sans-serif; font-weight: bold !important; color: #1799ad; font-size: 35px;">News & Update</h1>
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
              <p class="mb-0 px-1 text-justify" style="font-family: 'Poppins', sans-serif !important;" data-translate="blogindex-15"></p>
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

      <?php if (isset($_GET['tag'])) :

        foreach ($tags_arr as $tag) {
          $tag_id = $tag["ID"];

          if ($tag_id == $_GET['tag']) {
            $tag_name = $tag["TAG"];
            $tag_name_id = $tag["TAG_ID"];
          }
        } ?>

        <a name='cat' class="btn dropdown-toggle" href="#" role="button" id="categoryDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:black!important; vertical-align: middle !important; float:left; font-family:'Poppins',sans-serif; font-size: 18px;"><?= $tag_name ?>
        <?php else : ?>
          <a data-translate="blogindex-2" name='cat' class="btn dropdown-toggle" href="#" role="button" id="categoryDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:black!important; vertical-align: middle !important; float:left; font-family:'Poppins',sans-serif; font-size: 18px;">
          <?php endif; ?>

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

          <form id="search-box">
            <div class="input-group col-md-3" style="position: relative; float:right !important;">
              <input name='src' class="form-control py-2 border-right-0 border" type="text" placeholder="Search News..." id="example-search-input">
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
        </div>
        <div class="modal-body">

          <input class="form-control py-2 border-right-0 border" name="qm" type="text" placeholder="Search News..." id="example-search-input-mobile">

        </div>
        <div class="modal-footer">
          <button data-translate="blogindex-8" type="button" class="btn btn-secondary" data-dismiss="modal" style="font-size:1rem;"></button>
          <button data-translate="blogindex-9" type="button" onclick="search()" class="btn btn-blog"></button>
        </div>
      </form>
    </div>
  </div>
</div>


<div class="container blog-content mb-4 <?= isset($active_tag) ? "d-none" : "" ?>" id="latest-post">
  <?php foreach ($latest_posts as $lp) { ?>
    <div class="row align-items-center my-5 py-4">
      <div class="col-lg-6 text-center carousel-img">
        <img class="img-fluid mb-4 mb-lg-0 header-img" src="https://newuniverse.io/blog/uploads/<?php echo ($lp['IMAGE']); ?>" style="border-radius: 15px">
      </div>
      <div class="col-lg-6 carousel-post" style="text-align: center">
        <p class="josefin-sans headline latest-tags" style="font-size: 14px;">
          <?php
          $tag_arr = array();
          $index = 0;
          foreach ($tags as $tag) {
            if ($tag['ID'] == $lp['ID']) {
              $tag_arr[$index] = $tag['TAG'];
              $index++;
            }
          }
          $tag_str = implode(", ", $tag_arr);
          ?>
          <span id="blog-category" style="color:#1799ad; font-weight: bold">
            <?= $tag_str; ?>
          </span>

          <?php
          $tag_arr_id = array();
          $indeks = 0;
          foreach ($tagsID as $tag_id) {
            if ($tag_id['ID'] == $lp['ID']) {
              $tag_arr_id[$indeks] = $tag_id['TAG_ID'];
              $indeks++;
            }
          }
          $tag_str_id = implode(", ", $tag_arr_id);
          ?>
          <span id="blog-category_id">
            <?= $tag_str_id; ?>
          </span>
        </p>
        <a href="<?php echo base_url(); ?>blog-content.php?id=<?php echo ($lp['ID']); ?>" class="blog-title-links">
          <h4 class="fontRobBold headline work-sans-font mt-3 mb-4" style="font-size: 14px;"><?php echo ($lp['TITLE']); ?></h4>
        </a>
        <p class="headline fs-14 josefin-sans">
          <?php
          // echo strip_tags(mb_strimwidth(urldecode(base64_decode($lp['CONTENT'])), 0, 250, "...")); 
          if ($lp["SUMMARY"] == null || $lp["SUMMARY"] == "") {
            echo strip_tags(mb_strimwidth(urldecode(base64_decode($lp['CONTENT'])), 0, 250, "..."));
          } else {
            echo strip_tags(urldecode(base64_decode($lp['SUMMARY'])));
          }
          ?>
        </p>
        <a data-translate="blogindex-7" style="font-size: 14px;" class="btn btn-blog" href="<?php echo base_url(); ?>blog-content.php?id=<?php echo ($lp['ID']); ?>"></a>
      </div>
      <!-- /.col-md-4 -->
    </div>
  <?php } ?>
</div>

<div class="container blog-content">
  <!-- Content Row -->
  <h4 id="most-recent" style="color:#5e5e5e; font-weight: bold; margin-bottom: 20px">Most Recent</h4>
  <div class="col-md-12">
    <div class="row justify-content-center" id="post_body">
      <!-- /.col-md-4 -->
      <div class="col-12 mt-5 <?= $blogpost->num_rows == 0 ? "" : "d-none" ?>" style="margin-bottom: 200px !important">
        <h5 id="no-post" class="text-center" data-translate="blogindex-13" style="font-size: 25px">There are no posts in this category.</h5>
      </div>
      <?php
      while ($bp = mysqli_fetch_array($strPosts2)) {
      ?>
        <div class="col-md-4 mb-3 blog-post" id="card-<?php echo $bp['ID']; ?>">
          <?php
          // if (($key + 1) % 5 == 0 || ($key + 2) % 5 == 0) {
          //   echo "<script type='text/javascript'>";
          //   echo "var card = document.getElementById('card-" . $key . "');";
          //   echo "card.classList.add('col-md-6');";
          //   echo "card.classList.remove('col-md-4');";
          //   echo "</script>";
          // }
          ?>
          <div class="card h-100 text-center">
            <div class="card-body" style="border-bottom: 1px solid #c5c5c5">
              <div class="card-img mb-3">
                <a href="<?php echo base_url(); ?>blog-content.php?id=<?php echo ($bp['ID']); ?>" class="mx-auto">
                  <img src="https://newuniverse.io/blog/uploads/<?php echo ($bp['IMAGE']); ?>" class="blog-img mx-auto" style="border-radius: 15px !important">
                </a>
              </div>
              <p class="josefin-sans prv-tags" style="font-size:14px">
                <?php
                $tag_arr2 = array();
                $index = 0;
                foreach ($tags as $tag) {
                  if ($tag['ID'] == $bp['ID']) {
                    $tag_arr2[$index] = $tag['TAG'];
                    $index++;
                  }
                }
                $tag_str2 = implode(", ", $tag_arr2);
                // echo $tag_str2;
                ?>
                <span class="blog-category_prv" style="color:#1799ad; font-weight: bold">
                  <?= $tag_str2; ?>
                </span>

                <?php
                $tag_arr_id2 = array();
                $indexes = 0;
                foreach ($tagsID as $tagID) {
                  if ($tagID['ID'] == $bp['ID']) {
                    $tag_arr_id2[$indexes] = $tagID['TAG_ID'];
                    $indexes++;
                  }
                }
                $tag_str_id2 = implode(", ", $tag_arr_id2);
                // echo $tag_str_id2;
                ?>
                <span class="blog-category_prv_id" style="color:#1799ad; font-weight: bold">
                  <?= $tag_str_id2; ?>
                </span>
              </p>
              <a href="<?php echo base_url(); ?>blog-content.php?id=<?php echo ($bp['ID']); ?>" class="blog-title-links">
                <h5 class="card-title work-sans-font fontRobBold mt-3 mb-4" style="font-size:15px">
                  <?php echo (mb_strimwidth($bp['TITLE'], 0, 60, "...")); ?>
                </h5>
              </a>
              <p class="card-text fs-14 josefin-sans prv-body" style="height: 84px">
                <?php
                if ($bp["SUMMARY"] == null || $bp["SUMMARY"] == "") {
                  echo strip_tags(mb_strimwidth(urldecode(base64_decode($bp['CONTENT'])), 0, 250, "..."));
                } else {
                  echo strip_tags(urldecode(base64_decode($bp['SUMMARY'])));
                }
                ?>
              </p>
              <a data-translate="blogindex-7" style="font-size: 14px;" class="btn btn-blog mt-3 mb-2" href="<?php echo base_url(); ?>blog-content.php?id=<?php echo ($bp['ID']); ?>"></a>
            </div>
          </div>
        </div>
      <?php
      }
      ?>
    </div>

    <!-- PAGINATION -->
    <?php
    $catID = $_GET['tag'];
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
                                                                    echo "href='?page=1'";
                                                                  } ?>>
                      <i class="fa fa-angle-left" style="font-size:16px"></i><i class="fa fa-angle-left" style="font-size:16px"></i>
                    </a>
                  </li>
                </div>
                <div class="col p-0">
                  <li class="page-item">
                    <a id="prev-text" class="page-link" <?php if ($curr_page > 1) {
                                                          echo "href='?page=$previous'";
                                                        } ?>>
                      <i class="fa fa-angle-left" style="font-size:16px"></i>
                    </a>
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

                        $link .= "<li class=\"page-item\" style=\"width: 100%\"><a class=\"page-link\" style=\"background-color: #1799ad; color: white\" href=\"?page=" . $x . "\">" . $x . "</a></li>";
                        $is_first_active = 1;
                      } else if (!isset($_GET['page']) && $is_first_active == 1) {

                        $link .= "<li class=\"page-item\" style=\"width: 100%\"><a class=\"page-link\" href=\"?page=" . $x . "\">" . $x . "</a></li>";
                      } else {

                        if ($x == $_GET['page']) {
                          if ($x == $total_page - 2) { // PAGE KE 5, DARI TOTAL PAGE 7
                            $y = $x - 1;
                            $link .= "<li class=\"page-item\" style=\"width: 100%\"><a class=\"page-link\" href=\"?page=" . $y . "\">" . $y . "</a></li><li class=\"page-item\" style=\"width: 100%\"><a class=\"page-link\" style=\"background-color: #1799ad; color: white\" href=\"?page=" . $x . "\">" . $x . "</a></li>";
                          } else if ($x == $total_page - 1) { // PAGE KE 6, DARI TOTAL PAGE 7
                            $y = $x - 1;
                            $z = $y - 1;
                            $link .= "<li class=\"page-item\" style=\"width: 100%\"><a class=\"page-link\" href=\"?page=" . $z . "\">" . $z . "</a></li><li class=\"page-item\" style=\"width: 100%\"><a class=\"page-link\" href=\"?page=" . $y . "\">" . $y . "</a></li><li class=\"page-item\" style=\"width: 100%\"><a class=\"page-link\" style=\"background-color: #1799ad; color: white\" href=\"?page=" . $x . "\">" . $x . "</a></li>";
                          } else if ($x == $total_page) { // PAGE KE 7, DARI TOTAL PAGE 7
                            $y = $x - 1;
                            $z = $y - 1;
                            $w = $z - 1;
                            $link .= "<li class=\"page-item\" style=\"width: 100%\"><a class=\"page-link\" href=\"?page=" . $w . "\">" . $w . "</a></li><li class=\"page-item\" style=\"width: 100%\"><a class=\"page-link\" href=\"?page=" . $z . "\">" . $z . "</a></li><li class=\"page-item\" style=\"width: 100%\"><a class=\"page-link\" href=\"?page=" . $y . "\">" . $y . "</a></li><li class=\"page-item\" style=\"width: 100%\"><a class=\"page-link\" style=\"background-color: #1799ad; color: white\" href=\"?page=" . $x . "\">" . $x . "</a></li>";
                          } else {
                            $link .= "<li class=\"page-item\" style=\"width: 100%\"><a class=\"page-link\" style=\"background-color: #1799ad; color: white\" href=\"?page=" . $x . "\">" . $x . "</a></li>";
                          }
                        } else {
                          $link .= "<li class=\"page-item\" style=\"width: 100%\"><a class=\"page-link\" href=\"?page=" . $x . "\">" . $x . "</a></li>";
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
                                                          echo "href='?page=$next'";
                                                        } ?>><i class="fa fa-angle-right" style="font-size:16px"></i></a>
                  </li>
                </div>
                <div class="col p-0">
                  <li class="page-item" style="width: 38px">
                    <a id="next-to-last-text" class="page-link" <?php if ($curr_page < $total_page) {
                                                                  echo "href='?page=$total_page'";
                                                                } ?>>
                      <i class="fa fa-angle-right" style="font-size:16px"></i><i class="fa fa-angle-right" style="font-size:16px"></i>
                    </a>
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
                                                                    echo "href='?page=1&tag=$catID'";
                                                                  } ?>><i class="fa fa-angle-left" style="font-size:16px"></i><i class="fa fa-angle-left" style="font-size:16px"></i></a>
                  </li>
                </div>
                <div class="col p-0">
                  <li class="page-item">
                    <a id="prev-text" class="page-link" <?php if ($curr_page > 1) {
                                                          echo "href='?page=$previous&tag=$catID'";
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

                        $link .= "<li class=\"page-item\" style=\"width: 100%\"><a class=\"page-link\" style=\"background-color: #1799ad; color: white\" href=\"?page=" . $x . "&tag=$catID\">" . $x . "</a></li>";
                        $is_first_active = 1;
                      } else if (!isset($_GET['page']) && $is_first_active == 1) {

                        $link .= "<li class=\"page-item\" style=\"width: 100%\"><a class=\"page-link\" href=\"?page=" . $x . "&tag=$catID\">" . $x . "</a></li>";
                      } else {

                        if ($x == $_GET['page']) {
                          if ($x == $total_page - 2) { // PAGE KE 5, DARI TOTAL PAGE 7
                            $y = $x - 1;
                            $link .= "<li class=\"page-item\" style=\"width: 100%\"><a class=\"page-link\" href=\"?page=" . $y . "&tag=$catID\">" . $y . "</a></li><li class=\"page-item\" style=\"width: 100%\"><a class=\"page-link\" style=\"background-color: #1799ad; color: white\" href=\"?page=" . $x . "&tag=$catID\">" . $x . "</a></li>";
                          } else if ($x == $total_page - 1) { // PAGE KE 6, DARI TOTAL PAGE 7
                            $y = $x - 1;
                            $z = $y - 1;
                            $link .= "<li class=\"page-item\" style=\"width: 100%\"><a class=\"page-link\" href=\"?page=" . $z . "&tag=$catID\">" . $z . "</a></li><li class=\"page-item\" style=\"width: 100%\"><a class=\"page-link\" href=\"?page=" . $y . "&tag=$catID\">" . $y . "</a></li><li class=\"page-item\" style=\"width: 100%\"><a class=\"page-link\" style=\"background-color: #1799ad; color: white\" href=\"?page=" . $x . "&tag=$catID\">" . $x . "</a></li>";
                          } else if ($x == $total_page) { // PAGE KE 7, DARI TOTAL PAGE 7
                            $y = $x - 1;
                            $z = $y - 1;
                            $w = $z - 1;
                            $link .= "<li class=\"page-item\" style=\"width: 100%\"><a class=\"page-link\" href=\"?page=" . $w . "&tag=$catID\">" . $w . "</a></li><li class=\"page-item\" style=\"width: 100%\"><a class=\"page-link\" href=\"?page=" . $z . "&tag=$catID\">" . $z . "</a></li><li class=\"page-item\" style=\"width: 100%\"><a class=\"page-link\" href=\"?page=" . $y . "&tag=$catID\">" . $y . "</a></li><li class=\"page-item\" style=\"width: 100%\"><a class=\"page-link\" style=\"background-color: #1799ad; color: white\" href=\"?page=" . $x . "&tag=$catID\">" . $x . "</a></li>";
                          } else {
                            $link .= "<li class=\"page-item\" style=\"width: 100%\"><a class=\"page-link\" style=\"background-color: #1799ad; color: white\" href=\"?page=" . $x . "&tag=$catID\">" . $x . "</a></li>";
                          }
                        } else {
                          $link .= "<li class=\"page-item\" style=\"width: 100%\"><a class=\"page-link\" href=\"?page=" . $x . "&tag=$catID\">" . $x . "</a></li>";
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
                                                          echo "href='?page=$next&tag=$catID'";
                                                        } ?>><i class="fa fa-angle-right" style="font-size:16px"></i></a>
                  </li>
                </div>
                <div class="col p-0">
                  <li class="page-item" style="width: 38px">
                    <a id="next-to-last-text" class="page-link" <?php if ($curr_page < $total_page) {
                                                                  echo "href='?page=$total_page&tag=$catID'";
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
    ?>
    <!-- END PAGINATION -->
    <?php if (isset($_SESSION['id_company']) && $_SESSION['id_company'] == 598) {
    ?>
      <h5 class="text-center josefin-sans mb-4"><a href="blog-post-new.php">Add new blog post</a></h5>
    <?php } ?>
  </div>
</div>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/contact-button.php'); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/footer-alt.php'); ?>
<footer class="footerBanner-alt"></footer>

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

  if (localStorage.lang == 1) {
    $('#example-search-input').attr('placeholder', 'Cari Berita...');
  }

  function search() {

    var query = $('#example-search-input').val();
    var queryMobile = $('#example-search-input-mobile').val();

    console.log("SEARCH", query);

    if (/\S/.test(query)) {
      location.href = "/blog-search?src=" + query;
    } else if (/\S/.test(queryMobile)) {
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

  $('#search-box').submit(function(e) {
    e.preventDefault();
    search();
  })

  if (localStorage.lang == 1) {
    $("#most-recent").text("Terbaru");
    $("#blog-category").addClass("d-none");
    $("#blog-category_id").removeClass("d-none");

    $(".blog-category_prv").addClass("d-none");
    $(".blog-category_prv_id").removeClass("d-none");

    // $('#next-text').text("Berikutnya");
    // $('#prev-text').text("Sebelumnya");
  } else {
    $("#most-recent").text("Most Recent");
    $("#blog-category").removeClass("d-none");
    $("#blog-category_id").addClass("d-none");

    $(".blog-category_prv").removeClass("d-none");
    $(".blog-category_prv_id").addClass("d-none");

    // $('#next-text').text("Next");
    // $('#prev-text').text("Prev");
  }

  $("#change-lang-EN").click(function() {
    console.log("Inggris");

    $("#most-recent").text("Most Recent");
    $("#blog-category").removeClass("d-none");
    $("#blog-category_id").addClass("d-none");

    $(".blog-category_prv").removeClass("d-none");
    $(".blog-category_prv_id").addClass("d-none");

    $('#example-search-input').attr('placeholder', 'Search News...');
    // $('#next-text').text("Next");
    // $('#prev-text').text("Prev");

  });

  $("#change-lang-ID").click(function() {
    console.log("Indonesia");

    $("#most-recent").text("Terbaru");
    $("#blog-category").addClass("d-none");
    $("#blog-category_id").removeClass("d-none");

    $(".blog-category_prv").addClass("d-none");
    $(".blog-category_prv_id").removeClass("d-none");

    $('#example-search-input').attr('placeholder', 'Cari Berita...');
    // $('#next-text').text("Berikutnya");
    // $('#prev-text').text("Sebelumnya");

  });
</script>

<script>
  $('#searchModal').on('shown.bs.modal', function(e) {
    $("html").addClass("scroll-html");
    $("body").addClass("scroll-html");
    $("#searchModal").css("height", "100vh");
  });

  $('#searchModal').on('hidden.bs.modal', function(e) {
    $("html").removeClass("scroll-html");
    $("body").removeClass("scroll-html");
    $("#searchModal").css("height", "");
  });
</script>