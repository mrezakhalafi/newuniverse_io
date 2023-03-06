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

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

$post_id = $_GET["id"];

$dbconn = getDBConn();
//select blog post 
$query = $dbconn->set_charset("utf8");
$query = $dbconn->prepare("SELECT * FROM BLOG_POST WHERE ID = '$post_id'");
// $query->bind_param("s", $post_id);
// $query->
$query->execute();
$blog_post = $query->get_result()->fetch_assoc();
$query->close();

$sources = array();
if ($blog_post["URL"] != null && $blog_post["URL"] != "") {
  array_push($sources, '<a href="' . $blog_post["URL"] . '">Source</a>');
}
if ($blog_post["URL2"] != null && $blog_post["URL2"] != "") {
  array_push($sources, '<a href="' . $blog_post["URL2"] . '">Source 2</a>');
}
if ($blog_post["URL3"] != null && $blog_post["URL3"] != "") {
  array_push($sources, '<a href="' . $blog_post["URL3"] . '">Source 3</a>');
}

// print_r($sources);

$strTags = "SELECT btl.TAG
FROM BLOG_TAG bt
LEFT JOIN BLOG_TAGLIST btl ON btl.ID = bt.TAG
WHERE bt.BLOG_ID = '$post_id'";
$query2 = $dbconn->prepare($strTags);
$query2->execute();
$tags = $query2->get_result();
$query2->close();

$strTagsID = "SELECT btl.TAG_ID
FROM BLOG_TAG bt
LEFT JOIN BLOG_TAGLIST btl ON btl.ID = bt.TAG
WHERE bt.BLOG_ID = '$post_id'";
$queryID = $dbconn->prepare($strTagsID);
$queryID->execute();
$tagsID = $queryID->get_result();
$queryID->close();

foreach ($tags as $tag) {
  $tag_arr[$index] = $tag['TAG'];
  $index++;
}
$tag_str = implode(", ", $tag_arr);
print_r($tag_str);

//get related posts
$string = "SELECT DISTINCT tb.ID, tb.IMAGE, tb.TITLE, tb.CONTENT, tb.SUMMARY, tb.TAG
FROM 
(SELECT bp.TITLE, bp.CONTENT, bp.SUMMARY, bp.ID, bp.IMAGE, btl.TAG
FROM BLOG_POST bp 
INNER JOIN BLOG_TAG bt 
ON bp.ID=bt.BLOG_ID 
INNER JOIN BLOG_TAGLIST btl
ON btl.ID = bt.TAG
WHERE bp.ID != '$post_id' AND btl.TAG = '$tag_str') 
tb LIMIT 6";
$query3 = $dbconn->prepare($string);
// $query3->bind_param('i', $post_id);
$query3->execute();
$rel_posts = $query3->get_result();
$query3->close();


// mb_convert_encoding($str, "SJIS");
?>

<style>
  html {
    height: 100%;
  }

  .blog-img {
    /* max-height: 275px; */
    width: 363px;
    height: 211px;
    border-radius: 15px;
    object-fit: cover;
  }

  p {
    font-family: 'Poppins', sans-serif;
    font-size: 14px;
  }

  h1,
  h2,
  h3,
  h4,
  h5 {
    font-family: 'Poppins', sans-serif;
  }

  h3 {
    font-family: 'Poppins', sans-serif;
    font-size: 26px;
  }

  h5 {
    font-family: 'Poppins', sans-serif;
    font-size: 26px;
  }

  ul {
    font-size: 14px;
  }

  #blog-content {
    margin-top: 50px;
  }

  .btn-danger,
  .btn-primary {
    padding: 3px 5px;
  }

  #text-content * {
    font-family: 'Poppins', sans-serif;
  }

  @media screen and (max-width:600px) {

    #delete-post,
    #edit-post {
      display: none;
    }

    .btn-danger,
    .btn-primary {
      padding: 2px 8px;
    }

    #blog-content,
    #related-posts {
      max-width: 85% !important;
    }

    #text-content * {
      text-align: justify;
      font-family: 'Poppins', sans-serif;
    }

    .blog-img {
      /* max-width: 100% !important;
      height: auto !important; */
      width: 100%;
      height: 211px;
      border-radius: 15px;
    }
  }

  @media screen and (max-width: 991px) {
    #blog-content {
      margin-top: 100px !important;
    }
  }

  .btn-blog {
    background-color: #01686d;
    color: #fff;
  }

  #blog-content {
    max-width: 55%;
    margin-top: 7rem;
  }

  #tags,
  #author-date {
    text-transform: uppercase;
    font-size: 16px;
    font-weight: 300;
  }

  #text-content {
    font-weight: 300 !important;
  }

  @media screen and (min-width:768px) and (max-width:1366px) {
    .blog-img {
      /* max-height: 200px; */
      width: 100%;
      height: 211px;
      border-radius: 15px;
    }

    #rel-posts .col-md-4 {
      flex: 0 0 50% !important;
      max-width: 50% !important;
    }

    .card-img {
      /* min-height: 300px; */
      display: flex;
      align-items: center;
    }

    #blog-content,
    #related-posts {
      max-width: 65% !important;
    }
  }

  #related-posts {
    max-width: 75%;
  }

  #post-main-img {
    max-width: 100% !important;
    height: auto;
  }

  .prv-body p {
    font-weight: 300;
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
  }

  @media screen and (min-width: 1024px) {
    .card-img {
      /* min-height: 300px; */
      display: flex;
      align-items: center;
    }
  }

  #post-main-img {
    transition: all 0.5s ease-in-out;
  }

  #post-main-img:hover {
    transform: scale(1.1, 1.1);
  }

  .blog-img {
    transition: all 0.5s ease-in-out;
  }

  .blog-img:hover {
    transform: scale(1.05, 1.05);
  }

  .card {
    border: none !important;
  }
</style>

<div class="mx-auto py-5" id="blog-content">

  <div class="row">

    <!-- Post Content Column -->
    <div class="col-lg-12 mt-4 mx-auto">

      <p class="text-center" id="tags" style="font-size:14px;">
        <?php
        $tag_arr = array();
        $index = 0;
        foreach ($tags as $tag) {
          $tag_arr[$index] = $tag['TAG'];
          $index++;
        }
        $tag_str = implode(", ", $tag_arr);
        ?>
        <span id="cat-en"><?= $tag_str; ?></span>
        <!-- <br> -->
        <?php
        $tag_arr_id = array();
        $indexID = 0;
        foreach ($tagsID as $tagID) {
          $tag_arr_id[$indexID] = $tagID['TAG_ID'];
          $indexID++;
        }
        $tag_str_id = implode(", ", $tag_arr_id);
        ?>
        <span id="cat-id"><?= $tag_str_id; ?></span>
      </p>

      <!-- Title -->
      <h1 class="my-4 work-sans-font text-center" id="title" style="font-size:48px;"><strong><?php echo $blog_post['TITLE']; ?></strong></h1>

      <!-- Author -->
      <p class="mt-5 mb-2 text-center" id="author-date" style="font-size: 14px;">
        <a href="blog-index.php"><span data-translate="blogindex-12">nexilis Team</span></a> |
        <span id="enid-date"><?php echo (date('d F Y', strtotime($blog_post['DATE']))) ?></span><br>
      </p>
      <div class="text-center my-3">
        <?php if (isset($_SESSION['password']) && $_SESSION['password'] == md5('T3sB4Y4rN0X3nd1t')) { ?>
          <a href="blog-delete.php?id=<?php echo ($post_id);
                                      ?>" class="btn btn-danger mx-1" style="font-size: 18px;"><span class="fa fa-times"></span> <span id="delete-post">Delete Post</span></a>
          <a href="blog-edit.php?id=<?php echo ($post_id);
                                    ?>" class="btn btn-primary mx-1" style="font-size: 18px;"><span class="fa fa-pencil-square-o"></span> <span id="edit-post">Edit Post</span></a>
        <?php } ?>
      </div>


      <!-- Preview Image -->
      <div class="text-center">
        <img class="mx-auto" src="https://newuniverse.io/blog/uploads/<?php echo ($blog_post['IMAGE2']); ?>" alt="" id="post-main-img" style="border-radius: 15px">
      </div>
      <hr>

      <div id="text-content">
        <?php echo urldecode((base64_decode($blog_post['CONTENT']))); ?>
      </div>

      <div id="source-url">
        <?php echo implode(" | ", $sources); ?>
      </div>
      <hr>



    </div>

  </div>
</div>
<div class="mx-auto py-1" id="related-posts">
  <div class="row">

    <!-- Post Content Column -->
    <div class="col-lg-12 mt-4 mx-auto">

      <h3 class="text-center" data-translate="blogindex-11">Related Posts</h3>

      <div class="row justify-content-center" id="rel-posts">


        <?php foreach ($rel_posts as $key => $rp) { ?>

          <div class="col-md-4 mb-2 blog-post">
            <div class="card h-100 text-center">
              <div class="card-body">
                <div class="card-img mb-4">
                  <a href="<?php echo base_url(); ?>blog-content.php?id=<?php echo ($rp['ID']); ?>" class="mx-auto">
                    <img src="https://newuniverse.io/blog/uploads/<?php echo ($rp['IMAGE']); ?>" class="blog-img mx-auto">
                  </a>
                </div>
                <div class="prv-title mb-4">
                  <a href="<?php echo base_url(); ?>blog-content.php?id=<?php echo ($rp['ID']); ?>" class="blog-title-links">
                    <h5 class="card-title fontRobBold" style="font-size: 16px"><?php echo ($rp['TITLE']); ?>
                    </h5>
                    <span id="blog-category" style="color:#1799ad; font-weight: bold; text-transform:uppercase">
                      <?= $rp['TAG'] ?>
                    </span>
                  </a>
                </div>
                <div class="prv-body mb-2">
                  <p class="card-text fs-14 josefin-sans">
                    <?php
                    if ($rp["SUMMARY"] == null || $rp["SUMMARY"] == "") {
                      echo strip_tags(mb_strimwidth(urldecode(base64_decode($rp['CONTENT'])), 0, 250, "..."));
                    } else {
                      echo strip_tags(urldecode(base64_decode($rp['SUMMARY'])));
                    }
                    ?>
                  </p>
                </div>
                <!-- <a href="<?php //echo base_url(); 
                              ?>blog-content.php?id=<?php //echo ($rp['ID']); 
                                                    ?>" class="btn btn-blog">Read More</a> -->
              </div>
            </div>
          </div>

        <?php } ?>

      </div>
    </div>

  </div>

</div>

<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/footer-alt.php'); ?>

<script>
  if (localStorage.lang == 1) {
    <?php
    function indoDate($tanggal)
    {
      $bulan = array(
        1 => 'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
      );
      $pecahkan = explode('-', $tanggal);
      return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
    }
    ?>
    var idDate = '<?php echo indoDate(date('Y-m-d', strtotime($blog_post['DATE']))); ?>';

    $("#cat-id").removeClass("d-none");
    $("#cat-en").addClass("d-none");
    $("#enid-date").text(idDate);
  } else {
    var enDate = '<?php echo (date('d F Y', strtotime($blog_post['DATE']))) ?>';

    $("#cat-id").addClass("d-none");
    $("#cat-en").removeClass("d-none");
    $("#enid-date").text(enDate);
  }

  $("#change-lang-EN").click(function() {
    console.log("Inggris");
    var enDate = '<?php echo (date('d F Y', strtotime($blog_post['DATE']))) ?>';

    $("#cat-id").addClass("d-none");
    $("#cat-en").removeClass("d-none");
    $("#enid-date").text(enDate);
  });

  $("#change-lang-ID").click(function() {
    console.log("Indonesia");
    <?php
    function dateIndo($tanggal)
    {
      $bulan = array(
        1 => 'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
      );
      $pecahkan = explode('-', $tanggal);
      return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
    }
    ?>
    var idDate = '<?php echo dateIndo(date('Y-m-d', strtotime($blog_post['DATE']))); ?>';

    $("#cat-id").removeClass("d-none");
    $("#cat-en").addClass("d-none");
    $("#enid-date").text(idDate);
  });
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

    var animateLevelUpTi1;
    var animateLevelUpTi2;
    var animateLevelUpTi3;
    var animateLevelUpTi4;

    // runLevelUpAnimation();
    // resumeLevelUpAnimation();

    // $('#FB_1').on("mouseenter", function () {
    //   clearAnimateLevelUp();
    //   $('#FB_1').attr('src','palio_button/assets/Untitled110_20220121183610.png');
    //   $('#FB_2').attr('src','newAssets/floating_button/button_chat.png');
    //   $('#FB_3').attr('src','newAssets/floating_button/button_call.png');
    //   $('#FB_4').attr('src','newAssets/floating_button/button_stream.png');
    // }).on("mouseleave", function () {
    //   resumeLevelUpAnimation();
    // });

    // $('#FB_2').on("mouseenter", function () {
    //   clearAnimateLevelUp();
    //   $('#FB_1').attr('src','newAssets/floating_button/button_cc.png');
    //   $('#FB_2').attr('src','palio_button/assets/Untitled110_20220121183614.png');
    //   $('#FB_3').attr('src','newAssets/floating_button/button_call.png');
    //   $('#FB_4').attr('src','newAssets/floating_button/button_stream.png');
    // }).on("mouseleave", function () {
    //   resumeLevelUpAnimation();
    // });

    // $('#FB_3').on("mouseenter", function () {
    //   clearAnimateLevelUp();
    //   $('#FB_1').attr('src','newAssets/floating_button/button_cc.png');
    //   $('#FB_2').attr('src','newAssets/floating_button/button_chat.png');
    //   $('#FB_3').attr('src','palio_button/assets/Untitled110_20220121183621.png');
    //   $('#FB_4').attr('src','newAssets/floating_button/button_stream.png');
    // }).on("mouseleave", function () {
    //   resumeLevelUpAnimation();
    // });

    // $('#FB_4').on("mouseenter", function () {
    //   clearAnimateLevelUp();
    //   $('#FB_1').attr('src','newAssets/floating_button/button_cc.png');
    //   $('#FB_2').attr('src','newAssets/floating_button/button_chat.png');
    //   $('#FB_3').attr('src','newAssets/floating_button/button_call.png');
    //   $('#FB_4').attr('src','palio_button/assets/Untitled110_20220121183617.png');
    // }).on("mouseleave", function () {
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