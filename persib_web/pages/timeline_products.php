<?php
if (isset($_REQUEST['store_id'])) {
    $store_id = $_REQUEST['store_id'];
}
if (isset($_REQUEST['f_pin'])) {
    $f_pin = $_REQUEST['f_pin'];
}
if (isset($_REQUEST['filter'])) {
    $filter = $_REQUEST['filter'];
}
if (isset($_REQUEST['query'])) {
    $que = $_REQUEST['query'];
}
$products = include_once($_SERVER['DOCUMENT_ROOT'] . '/persib_web/logics/fetch_posts_raw.php');
if (isset($_REQUEST['store_id'])) {
    $products_final = array();
    //     $filterArr = explode('-', $_REQUEST['filter']);
    foreach ($products as $product) {
        //         foreach ($filterArr as $filter) {
        $filtered = $product["F_PIN"] == $store_id;
        if ($filtered) {
            $products_final[] = $product;
            break;
        }
        //         }
    }
} else {
    $products_final = $products;
}

// shuffle the timeline
// shuffle($products_final);

if (empty($products_final)) {
    echo '<div class="my-2" id="product-0">';
    echo '<div class="col-sm mt-2">';
    echo '<h5 class="prod-name" style="text-align:center;">Tidak ada postingan</h5>';
    echo '</div>';
    echo '</div>';
} else {
    $products_liked_raw = include_once($_SERVER['DOCUMENT_ROOT'] . '/persib_web/logics/fetch_products_liked_raw.php');
    $products_liked = array();
    foreach ($products_liked_raw as $product_liked) {
        $products_liked[] = $product_liked["PRODUCT_CODE"];
    }
    $stores_followed_raw = include_once($_SERVER['DOCUMENT_ROOT'] . '/persib_web/logics/fetch_stores_followed_raw.php');
    $stores_followed = array();
    foreach ($stores_followed_raw as $store_followed) {
        $stores_followed[] = $store_followed["STORE_CODE"];
    }

    $products_commented_raw = include_once($_SERVER['DOCUMENT_ROOT'] . '/persib_web/logics/fetch_products_commented_raw.php');
    $products_commented = array();
    foreach ($products_commented_raw as $product_commented) {
        $products_commented[] = $product_commented["PRODUCT_CODE"];
    }

    $image_type_arr = array("jpg", "JPG", "jpeg", "png", "webp");
    $video_type_arr = array("mp4", "mov", "wmv", 'flv', 'webm', 'mkv', 'gif', 'm4v', 'avi', 'mpg');

    for ($i = 0; $i < count($products_final); $i++) {
        $code = $products_final[$i]["POST_ID"];
        $name = $products_final[$i]["TITLE"];
        $created_date = $products_final[$i]["CREATED_DATE"];
        $category = $products_final[$i]["IFNULL(E.CATEGORY_ID, '0')"];
        $seconds = intval(intval($created_date) / 1000);
        // $printed_date = date("H:i", $seconds);

        // print date
        $date_diff = round((time() - $seconds) / (60 * 60 * 24));
        if ($date_diff == 0) {
            $printed_date = "Hari ini";
        } else if ($date_diff == 1) {
            $printed_date = "Kemarin";
        } else if ($date_diff == 2) {
            $printed_date = "2 hari lalu";
        } else if ($date_diff == 3) {
            $printed_date = "3 hari lalu";
        } else if ($date_diff == 4) {
            $printed_date = "4 hari lalu";
        } else if ($date_diff == 5) {
            $printed_date = "5 hari lalu";
        } else if ($date_diff == 6) {
            $printed_date = "6 hari lalu";
        } else if ($date_diff == 7) {
            $printed_date = "7 hari lalu";
        } else if ($date_diff > 7 && $date_diff < 365) {
            $printed_date = date("j M", $seconds);
        } else if ($date_diff >= 365) {
            $printed_date = date("j M Y", $seconds);
        }

        $store_id = $products_final[$i]["F_PIN"];
        $desc = nl2br($products_final[$i]["DESCRIPTION"]);
        $thumb_id = $products_final[$i]["FILE_ID"];
        $thumb_ids = explode("|", $thumb_id);
        $store_thumb_id = $products_final[$i]["IMAGE"];
        $store_name = $products_final[$i]["POSTER_NAME"];
        // $store_link = $products_final[$i]["STORE_LINK"];
        $total_likes = $products_final[$i]["TOTAL_LIKES"];
        $total_follower = $products_final[$i]["TOTAL_FOLLOWER"];
        // $total_comment = $products_final[$i]["TOTAL_COMMENT"];
        $total_comment = count(include($_SERVER['DOCUMENT_ROOT'] . '/persib_web/logics/fetch_posts_comments.php'));
        $use_adblock = $products_final[$i]["USE_ADBLOCK"];;
        $is_verified = $products_final[$i]["OFFICIAL_ACCOUNT"];

        if (!(substr($store_thumb_id, 0, 4) === "http")) {
            $store_thumb_id = "/filepalio/image/" . $store_thumb_id;
        }


        if (strpos($thumb_id, 'youtube.com/embed/') === false) {
            if ($category == "4") {
                echo '<div class="my-2" id="product-' . $code . '" data-iscontent="true">';
            } else {
                echo '<div class="my-2" id="product-' . $code . '">';
            }
            echo '<div class="col-sm">';
            echo '<div class="timeline-post-header media">';
            echo '<a class="d-flex" href="profile.php?store_id=' . $store_id . '&f_pin=' . $f_pin . '">';
            echo '<img src="' . $store_thumb_id . '" class="align-self-start rounded-circle mr-1">';
            echo '</a>';
            echo '<div class="media-body">';
            if ($is_verified == 1) {
                echo '<h5 class="store-name"><img src="/persib_web/assets/img/ic_official_flag.webp"/>' . $store_name . '</h5>';
            } else if ($is_verified == 2) {
                echo '<h5 class="store-name"><img src="/persib_web/assets/img/ic_verified_flag.png"/>' . $store_name . '</h5>';
            } else {
                echo '<h5 class="store-name">' . $store_name . '</h5>';
            }
            echo '<p class="prod-timestamp">' . $printed_date . '</p>';
            echo '</div>';
            echo '<div class="post-status">';
            echo '<img src="../assets/img/ic_public.png" height="20" width="20"/>';
            echo '</div>';
            echo '<div class="post-status">';
            echo '<img src="../assets/img/ic_user.png" height="20" width="20"/>';
            echo '</div>';
            echo '<div class="post-status" onclick="openProductMenu(\'' . $code . '\')">';
            echo '<img src="../assets/img/ic_more.png" height="20" width="20"/>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '<div class="col-sm mt-2 timeline-image">';
            echo '<a class="timeline-main">';
            if (count($thumb_ids) == 1) {
                // echo '<img class="single-image img-fluid rounded" src="' . $thumb_id . '">';
                $thumb_ext = pathinfo($thumb_ids[0], PATHINFO_EXTENSION);
                $image_name = str_replace($thumb_ext, "", $thumb_ids[0]);
                if (substr($thumb_ids[0], 0, 30) === "https://www.youtube.com/embed/") {
                    echo '<div class="youtube-wrapper">';
                    echo '<iframe src="' . $thumb_ids[0] . '?autoplay=1&mute=1" frameborder="0"></iframe>';
                    echo '</div>';
                } else
                if (in_array($thumb_ext, $image_type_arr)) {
                    echo '<div class="img-placeholder">';
                    echo '<img src="' . $thumb_ids[0] . '" class="img-fluid rounded">';
                    echo '</div>';
                    // echo '<div class="img-placeholder">
                    //     <div class="img-fluid rounded" style="background-image: url(' . $thumb_ids[0] . ')"><img /></div>
                    //     </div>';
                } else if (in_array($thumb_ext, $video_type_arr)) {
                    echo '<div class="video-wrap">';
                    echo '<video muted class="myvid" preload="metadata" poster="' . $image_name . 'webp">';
                    echo '<source src="' . $thumb_ids[0] . '" type="video/' . $thumb_ext . '">';
                    echo '</video>';
                    echo '<div class="video-sound">';
                    echo '<img src="../assets/img/video_mute.png" />';
                    echo '</div>';
                    echo '<div class="video-play d-none">';
                    echo '<img src="../assets/img/video_play.png" />';
                    echo '</div></div>';
                }
            } else {
                $count_thumb_id = count($thumb_ids);
                echo '<div id="carousel-' . $code . '" class="carousel slide pointer-event" data-ride="carousel" data-touch="true">';
                echo '<ol id="ci-' . $code . '" class=' . '"carousel-indicators">';
                for ($j = 0; $j < $count_thumb_id; $j++) {
                    if ($j == 0) {
                        echo '<li data-target="#carousel-' . $code . '" data-slide-to="' . $j . '" class="active"></li>';
                    } else {
                        echo '<li data-target="#carousel-' . $code . '" data-slide-to="' . $j . '"></li>';
                    }
                }
                echo '</ol>';
                echo '<div class="carousel-inner">';
                for ($j = 0; $j < count($thumb_ids); $j++) {
                    if ($j == 0) {
                        echo '<div class="carousel-item active">';
                    } else {
                        echo '<div class="carousel-item">';
                    }
                    echo '<div class="carousel-item-wrap">';
                    $thumb_ext = pathinfo($thumb_ids[$j], PATHINFO_EXTENSION);
                    $image_name = str_replace($thumb_ext, "", $thumb_ids[$j]);
                    if (in_array($thumb_ext, $image_type_arr)) {
                        echo '<img src="' . $thumb_ids[$j] . '" class="img-fluid rounded">';
                    } else if (in_array($thumb_ext, $video_type_arr)) {
                        echo '<div class="video-wrap">';
                        echo '<video muted class="myvid" preload="metadata" poster="' . $image_name . 'webp">';
                        echo '<source src="' . $thumb_ids[$j] . '" type="video/' . $thumb_ext . '">';
                        echo '</video>';
                        echo '<div class="video-sound">';
                        echo '<img src="../assets/img/video_mute.png" />';
                        echo '</div>';
                        echo '<div class="video-play d-none">';
                        echo '<img src="../assets/img/video_play.png" />';
                        echo '</div></div>';
                    }

                    echo '</div></div>';
                }
                echo '</div>';
                echo '<a class="carousel-control-prev" href="#carousel-' . $code . '" data-slide="prev">';
                echo '<span class="carousel-control-prev-icon"></span>';
                echo '</a>';
                echo '<a class="carousel-control-next" href="#carousel-' . $code . '" data-slide="next">';
                echo '<span class="carousel-control-next-icon"></span>';
                echo '</a>';
                echo '</div>';
            }
            echo '</a>';
            echo '</div>';
            echo '<div class="col-sm mt-2" class="like-comment-container">';
            echo '<div class="like-button" onClick="likePost(\'' . $code . '\')">';
            if (in_array($code, $products_liked)) {
                echo '<img id=like-' . $code . ' src="../assets/img/jim_likes_red.png" height="25" width="25"/>';
            } else {
                echo '<img id=like-' . $code . ' src="../assets/img/jim_likes.png" height="25" width="25"/>';
            }
            echo '<div id=like-counter-' . $code . ' class="like-comment-counter">';
            echo $total_likes;
            echo '</div>';
            echo '</div>';
            echo '<div class="comment-button">';
            echo '<a href="comment.php?product_code=' . $code . '">';
            if (in_array($code, $products_commented)) {
                echo '<img class="comment-icon-' . $code . '" src="../assets/img/jim_comments_blue.png" height="25" width="25"/>';
            } else {
                echo '<img class="comment-icon-' . $code . '" src="../assets/img/jim_comments.png" height="25" width="25"/>';
            }
            echo '</a>';
            echo '<div class="like-comment-counter">';
            echo $total_comment;
            echo '</div>';
            echo '</div>';
            echo '<div class="follower-button" onClick="followUser(\'' . $code . '\',\'' . $store_id . '\')">';
            if (in_array($store_id, $stores_followed)) {
                echo '<img class="follow-icon-' . $store_id . '" src="../assets/img/ic_nuc_follow3_check.png" height="25" width="25"/>';
            } else {
                echo '<img class="follow-icon-' . $store_id . '" src="../assets/img/person_add.png" height="25" width="25"/>';
            }
            echo '<div id=follow-counter-post-' . $code . ' class="like-comment-counter follow-counter-store-' . $store_id . '">';
            echo $total_follower . ' pengikut';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '<div class="col-sm mt-2">';
            echo '<h5 class="prod-name">' . $name . '</h5>';
            echo '<p class="prod-desc">' . strip_tags($desc) . '</p>';
            echo '</div>';
            echo '</div>';
            if ($i < count($products_final) - 1) {
                echo '<hr class="my-0">';
            }
        }
    }
}
