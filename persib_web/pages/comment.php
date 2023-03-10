<?php
if (!isset($_GET['product_code'])) {
  die();
}
$product = include_once($_SERVER['DOCUMENT_ROOT'] . '/persib_web/logics/fetch_spesific_post.php');
$product_thumb_id = $product[0]["THUMB_ID"];
$product_name = $product[0]["TITLE"];
$product_description = $product[0]["DESCRIPTION"];
$product_date = $product[0]["CREATED_DATE"];
$shop_thumb_id = $product[0]["SHOP_THUMB_ID"];
$seconds = intval(intval($product_date) / 1000);
$printed_date = date("H:i", $seconds);
$date_explode = explode(":", $printed_date);
$hours = (int)$date_explode[0] + 7;
if ($hours >= 24) {
  $hours = $hours - 24;
  $hours = "{$hours}";
  if (strlen($hours) == 1) {
    $hours = "0" . $hours;
  }
}
$printed_date = $hours . ":" . $date_explode[1];

if (!empty($shop_thumb_id) && !(substr($shop_thumb_id, 0, 4) === "http")) {
  $shop_thumb_id = "/filepalio/image/" . $shop_thumb_id;
}
?>
<!doctype html>
<html lang="en">

<head>
  <title>Comment</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;1,100;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="../assets/css/roboto.css" />
  <link rel="stylesheet" href="../assets/css/style-comment.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
  <link rel="stylesheet" href="../assets/css/paliopay.css" />
  <script src="../assets/js/script-data-comment.js?random=<?= time(); ?>"></script>
</head>

<body>
  <div id="header-layout" class="sticky-top">
    <div id="header" class="row justify-content-between">
      <div class="col-auto">
        <i class="fas fa-arrow-left" style="color: white;" onclick="goBack()"></i>
        &ensp;
        <span id="header-title" class="align-middle">Komentar</h4>
      </div>
    </div>
  </div>

  <div id="content-comment" style="margin-bottom: 50px;">
    <div class="row mx-0">
      <div class="col-2">
        <img alt="Profile Photo" class="rounded-circle my-3" style="height:50px; width:50px; cursor:pointer; object-position: center; background: grey; object-fit: cover;" id="display-pic" src="<?php echo $shop_thumb_id; ?>">
      </div>
      <div class="col-10 text-break">
        <div style="font-weight: bold;" class="mt-3 mb-1 mr-3">
          <?php echo $product_name; ?>
        </div>
        <div style="font-weight: 300;" class="my-1 mr-3">
          <!-- <div class="prod-desc"><?php //echo $product_description; ?></div> -->
          <div class="prod-desc <?php
            if (strlen($product_description) > 50) {
              echo "truncate mb-3";
            }
          ?>">
            <?php echo $product_description; ?>
          </div>
          <?php
            if (strlen($product_description) > 50) {
              echo '<span class="truncate-read-more" style="color:#999999;">Selengkapnya...</span>';
            }
          ?>
        </div>
        <div style="font-weight: 300; color: grey;" class="my-1">
          <?php echo $printed_date; ?>
        </div>
      </div>
    </div>
    <hr style="border-top: 3px solid #bbb;" class="ml-3 mr-3">
    <?php
    $comments = include_once($_SERVER['DOCUMENT_ROOT'] . '/persib_web/logics/fetch_posts_comments.php');

    echo '<script>var data_comment_dum = ' . json_encode($comments) . '</script>';

    function getReplies($reffs, $sub)
    {
      ${"j" . $sub} = 0;
      foreach ($reffs as $reff) {
        ${"comment_id_reff" . $sub} = $reff["COMMENT_ID"];
        ${"f_pin_reff" . $sub} = $reff["F_PIN"];
        ${"comment_text_reff" . $sub} = $reff["COMMENT"];
        ${"created_date_reff" . $sub} = $reff["CREATED_DATE"];

        ${"seconds_reff" . $sub} = intval(intval(${"created_date_reff" . $sub}) / 1000);
        ${"printed_date_reff" . $sub} = date("H:i", ${"seconds_reff" . $sub});
        ${"date_explode_reff" . $sub} = explode(":", ${"printed_date_reff" . $sub});
        ${"hours_reff" . $sub} = (int)${"date_explode_reff" . $sub}[0] + 7;
        if (${"hours_reff" . $sub} >= 24) {
          ${"hours_reff" . $sub} = ${"hours_reff" . $sub} - 24;
          ${"hours_reff" . $sub} = "{" . ${"hours_reff" . $sub} . "}";
          if (strlen(${"hours_reff" . $sub}) == 1) {
            ${"hours_reff" . $sub} = "0" . ${"hours_reff" . $sub};
          }
        }
        ${"printed_date_reff" . $sub} = ${"hours_reff" . $sub} . ":" . ${"date_explode_reff" . $sub}[1];
        ${"parameter_reply_reff" . $sub} = "true," . "'user-name-reff-" . $sub . ${"j" . $sub} . "'," . "'" . ${'comment_id_reff' . $sub} . "'";
        ${"parameter_profile_reff" . $sub} = "'" . ${"f_pin_reff" . $sub} . "'";
        echo '<div class="row ml-5 mr-0 my-0 comments">';
        echo '<div class="commentId" style="display: none;">' . ${'comment_id_reff' . $sub} . '</div>';
        echo '<div class="fPin" style="display: none;">' . ${"f_pin_reff" . $sub} . '</div>';
        echo '<div class="col-2">';
        echo '<img onclick="showProfile(' . ${"parameter_profile_reff" . $sub} . ')" id="user-thumb-reff-' . $sub . ${"j" . $sub} . '" alt="Profile Photo" class="rounded-circle my-3" style="height:40px; width:40px; cursor:pointer; object-position: center; background: grey; object-fit: cover;" id="display-pic" src="../assets/img/ic_person_boy.png">';
        echo '</div>';
        echo '<div class="col-10 text-break">';
        echo '<div style="font-weight: bold;" class="mt-3 mb-1 mr-3"><span id="user-name-reff-' . $sub . ${"j" . $sub} . '"></span><span style="font-weight: 300;"> ' . ${"comment_text_reff" . $sub} . '</h4></div>';
        echo '<div style="font-weight: 100; color: grey;" class="my-1">' . ${"printed_date_reff" . $sub} . '&emsp;<span style="font-weight: 300;" onclick="onReply(' . ${"parameter_reply_reff" . $sub} . ');">Balas</span></div>';
        echo '</div>';
        echo '</div>';

        echo ('<script>getDisplayNameReff("' . ${"f_pin_reff" . $sub} . '","' . $sub . '","' . ${"j" . $sub} . '")</script>');
        echo ('<script>getThumbIdReff("' . ${"f_pin_reff" . $sub} . '","' . $sub . '","' . ${"j" . $sub} . '")</script>');
        ${"reffs" . $sub} = include($_SERVER['DOCUMENT_ROOT'] . '/persib_web/logics/fetch_posts_comments.php');
        if (count(${"reffs" . $sub}) > 0) {
          getReplies(${"reffs" . $sub}, $sub + 1);
        }
        ${"j" . $sub}++;
      }
    }

    $i = 0;
    foreach ($comments as $comment) {
      $comment_id = $comment["COMMENT_ID"];
      $product_code = $comment["PRODUCT_CODE"];
      $f_pin = $comment["F_PIN"];
      $comment_text = $comment["COMMENT"];
      $created_date = $comment["CREATED_DATE"];

      $seconds = intval(intval($created_date) / 1000);
      $printed_date = date("H:i", $seconds);
      $date_explode = explode(":", $printed_date);
      $hours = (int)$date_explode[0] + 7;
      if ($hours >= 24) {
        $hours = $hours - 24;
        $hours = "{$hours}";
        if (strlen($hours) == 1) {
          $hours = "0" . $hours;
        }
      }
      $printed_date = $hours . ":" . $date_explode[1];
      $parameter_reply = "true," . "'user-name-" . $i . "'," . "'$comment_id'";
      $parameter_profile = "'" . $f_pin . "'";
      echo '<div class="row mx-0 comments">';
      echo '<div class="commentId" style="display: none;">' . $comment_id . '</div>';
      echo '<div class="fPin" style="display: none;">' . $f_pin . '</div>';
      echo '<div class="col-2">';
      echo '<img onclick="showProfile(' . $parameter_profile . ')" id="user-thumb-' . $i . '" alt="Profile Photo" class="rounded-circle my-3" style="height:50px; width:50px; cursor:pointer; object-position: center; background: grey; object-fit: cover;" id="display-pic" src="../assets/img/ic_person_boy.png">';
      echo '</div>';
      echo '<div class="col-10 text-break">';
      echo '<div style="font-weight: bold;" class="mt-3 mb-1 mr-3"><span id="user-name-' . $i . '"></span><span style="font-weight: 300;"> ' . $comment_text . '</h4></div>';
      echo '<div style="font-weight: 100; color: grey;" class="my-1">' . $printed_date . '&emsp;<span style="font-weight: 300;" onclick="onReply(' . $parameter_reply . ');">Balas</span></div>';
      echo '</div>';
      echo '</div>';

      echo ('<script>getDisplayName("' . $f_pin . '","' . $i . '")</script>');
      echo ('<script>getThumbId("' . $f_pin . '","' . $i . '")</script>');
      $reffs = include($_SERVER['DOCUMENT_ROOT'] . '/persib_web/logics/fetch_posts_comments.php');
      if (count($reffs) > 0) {
        getReplies($reffs, 1);
      }
      $i++;
    }
    ?>
  </div>

  <div class="row fixed-bottom py-2" style="background-color: #e0e0e0;">
    <div style="width: 100%; height: 40px; background: #b0bec6;" class="d-none row mb-2 pt-2" id="reply-div">
      <div class="col-10" style="color: grey; font-weight: 300; padding-left: 40px;" id="content-reply">
      </div>
      <div class="col-2 text-right">
        <i class="fas fa-times" style="color: white;" onclick="onReply(false);"></i>
      </div>
    </div>
    <div class="col-10 pl-4">
      <input type="text" name="message" id="input" placeholder="Tulis Komentar" onclick="onFocusInput()" class="border-0 px-3 py-2 rounded shadow-sm">
    </div>
    <div class="col-2 px-0">
      <div id="buttond_send" class="px-3 py-2" onclick="commentProduct('<?php echo $product_code; ?>')">
        <img src="../assets/img/arrow_send.png" id="triangle-right">
      </div>
    </div>
  </div>
  <script src="../assets/js/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <!-- <script type="text/javascript" src="../assets/js/pulltorefresh.js"></script> -->
  <script src="../assets/js/update-score.js?random=<?= time(); ?>"></script>
   <script src="../assets/js/script-comment.js?random=<?= time(); ?>"></script>
</body>

</html>