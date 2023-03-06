<ul>
    <li id="all-store" class='has-story'>
    <div class="story">
        <img src="../assets/img/AllStore.png">
    </div>
    <span class="user">Postingan</span>
    </li>
    <?php
    $stores = include_once($_SERVER['DOCUMENT_ROOT'] . '/persib_web/logics/fetch_person_official_raw.php');
    // if (isset($_REQUEST['filter'])) {
    //     $stores_final = array();
    //     $filterArr = explode('-', $_REQUEST['filter']);
    //     foreach ($stores as $store) {
    //         foreach ($filterArr as $filter) {
    //             $filtered = $store["CATEGORY"] == $filter;
    //             if ($filtered) {
    //                 $stores_final[] = $store;
    //                 break;
    //             }
    //         }
    //     }
    // }
    // else {
        $stores_final = $stores;
    // }
    for ($i = 0; $i < count($stores_final); $i++) {
    $idStore = $stores_final[$i]["F_PIN"];
    $codeStore = $stores_final[$i]["F_PIN"];
    $urlStore = $stores_final[$i]["IMAGE"];
    $nameStore = $stores_final[$i]["NAME"];
    $is_verified = $stores_final[$i]["OFFICIAL_ACCOUNT"];
    $is_live_streaming = 0;//$stores_final[$i]["IS_LIVE_STREAMING"];

    if(empty($urlStore)){
        $urlStore = "/persib_web/assets/img/ic_person_boy.png";
    } else
    if (substr($urlStore, 0, 4) !== "http") {
        $urlStore = "/filepalio/image/" . $urlStore;
    }

    echo '<li id="store-' . $codeStore .  '" class="has-story">';
    // echo "<a href='timeline.php?store_id=" . $idStore . "'>";
    echo "<div class='story'>";
    echo "<img src='$urlStore'>";
    
    if ($is_live_streaming > 0) {
        // echo '<div class="icon-live">';
        echo '<img class="icon-live" src="/persib_web/assets/img/live_indicator.png"/>';
        // echo '</div>';
    }

    echo "</div>";
    // echo "</a>";
    if($is_verified == 1){
        echo "<span class='user'><img src='/persib_web/assets/img/ic_official_flag.webp'/>" . $nameStore . "</span>";
    } else if($is_verified == 2){
        echo "<span class='user'><img src='/persib_web/assets/img/ic_verified_flag.png'/>" . $nameStore . "</span>";
    } else {
        echo "<span class='user'>" . $nameStore . "</span>";
    }
    echo "</li>";
    }
    ?>
</ul>