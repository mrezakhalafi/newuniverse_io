function postData(actionUrl, method, data) {
  var mapForm = $('<form id="mapform" action="' + actionUrl + '" method="' + method.toLowerCase() + '"></form>');
  for (var key in data) {
    if (data.hasOwnProperty(key)) {
      mapForm.append('<input type="hidden" name="' + key + '" id="' + key + '" value="' + data[key] + '" />');
    }
  }
  $('body').append(mapForm);
  mapForm.submit();
}

// $('.carousel').carousel({
//   pause: true,
//   interval: false
// });

var didScroll;
var isSearchHidden = true;
var lastScrollTop = 0;
var delta = 3;
var navbarHeight = $('#header-layout').outerHeight();
var topPosition = 0;
var STORE_ID = "";
var FILTERS = "";

setInterval(function () {
  if (didScroll) {
    hasScrolled();
    didScroll = false;
  }
}, 10);

function headerOut() {
  $('#searchFilter').addClass('d-none');
  navbarHeight = $('#header-layout').outerHeight();
  $('#header-layout').css('top', '0px');
  isSearchHidden = true;
};

function headerOutAndReset() {
  $("#mic").attr("src", "../assets/img/action_mic.png");
  $('#query').val('');
  $('#switchAll').prop('checked', checked);
  setFilterCheckedAll(true);
  $('#searchFilter').addClass('d-none');
  navbarHeight = $('#header-layout').outerHeight();
  $('#header-layout').css('top', '0px');
  isSearchHidden = true;
};

$('#header').click(function () {
  $(document).scrollTop(0);
  if ($('#searchFilter').hasClass('d-none')) {
    $('#searchFilter').removeClass('d-none');
    isSearchHidden = false;
  } else {
    $('#searchFilter').addClass('d-none');
    isSearchHidden = true;
    const query = $('#query').val();

    if (!isFilterCheckedAny()){
      resetFilter();
    } else
    if (isFilterCheckedAny() || query != ""
    ) {
      searchFilter();
    } else if (query == "") {
      var url_string = window.location.href;
      var url = new URL(url_string);
      var paramValue = url.searchParams.get("query");
      if (paramValue != null) {
        searchFilter();
      }
    }
  }
  navbarHeight = $('#header-layout').outerHeight();
  $('#header-layout').css('top', '0px');
  $('#gear').rotate({
    angle: 0,
    animateTo: 180
  });
});

function hasScrolled() {
  var st = $(this).scrollTop();

  // Make sure they scroll more than delta
  if (Math.abs(lastScrollTop - st) <= delta)
    return;

  // If they scrolled down and are past the navbar, add class .nav-up.
  // This is necessary so you never see what is "behind" the navbar.
  if (st > lastScrollTop) {
    if (topPosition - (st - lastScrollTop) < -navbarHeight) {
      topPosition = -navbarHeight;
    } else {
      topPosition = topPosition - (st - lastScrollTop);
    }
    const tp = '' + topPosition + "px";

    // Scroll Down
    $('#header-layout').css('top', tp);
  } else {
    if (topPosition - (st - lastScrollTop) > 0) {
      topPosition = 0;
    } else {
      topPosition = topPosition - (st - lastScrollTop);
    }
    const tp = '' + topPosition + "px";
    // Scroll Up
    if (st + $(window).height() < $(document).height()) {
      $('#header-layout').css('top', tp);
    }
  }

  lastScrollTop = st;
}

function checkVideoViewport() {
  var pattern = /(?:^|\s)simple-modal-button-green(?:\s|$)/
  if (document.activeElement.className.match(pattern)) {
    return;
  }
  $('.carousel-item video, .timeline-image video').each(function () {
    if ($(this).is(":in-viewport")) {
      // pause carousel when video is playing
      $(this).off("play");
      $(this).on("play", function (e) {
        $(this).closest(".carousel").carousel("pause");
      })
      $(this).get(0).play();
      let $videoPlayButton = $(this).parent().find(".video-play");
      $videoPlayButton.addClass("d-none");
    } else {
      // start carousel when video is not playing
      $(this).off("stop pause ended");
      $(this).on("stop pause ended", function (e) {
        $(this).closest(".carousel").carousel();
      });
      $(this).get(0).pause();
    }
  })
  videoReplayOnEnd();
  playVid();
}

document.addEventListener('visibilitychange', function () {
  // document.title = document.visibilityState;
  // console.log(document.visibilityState);

  if (document.visibilityState == "hidden") {
    $('.carousel-item video, .timeline-image video').each(function () {
      $(this).get(0).pause();
      $(this).parent().find(".video-play").removeClass("d-none");
    })
  } else {
    $('.carousel-item video, .timeline-image video').each(function () {
      $(this).get(0).play();
      $(this).parent().find(".video-play").addClass("d-none");
    })
  }

});

document.addEventListener('focusin', function () {
  var pattern = /(?:^|\s)simple-modal-button-green(?:\s|$)/
  if (document.activeElement.className.match(pattern)) {
    $('.carousel-item video, .timeline-image video').each(function () {
      $(this).get(0).pause();
    })
  }
}, true);

function checkVideoCarousel() {
  // play video when active in carousel
  $(".carousel").on("slid.bs.carousel", function (e) {
    if ($(this).find("video").length) {
      if ($(this).find(".carousel-item").hasClass("active")) {
        $(this).find("video").get(0).play();
        let $videoPlayButton = $(this).find(".video-play");
        $videoPlayButton.addClass("d-none");
      } else {
        $(this).find("video").get(0).pause();
      }
    }
  });
  videoReplayOnEnd();
  playVid();
}

function onVideoStop(vid) {
  $(vid).parent().find(".video-play").removeClass("d-none");
}

function onVideoPlay(vid) {
  $(vid).parent().find(".video-play").addClass("d-none");
}

document.querySelectorAll("video.myvid").forEach(vid => {
  vid.addEventListener("stop", function() {
    onVideoStop(vid);
  }, false);
  vid.addEventListener("ended", function() {
    onVideoStop(vid);
  }, false);
  vid.addEventListener("pause", function() {
    onVideoStop(vid);
  }, false);
  vid.addEventListener("play", function() {
    onVideoPlay(vid);
  }, false);
})

var visibleCarousel = new Set();
function checkCarousel(){
  $('.carousel').each(function () {
    if ($(this).is(":in-viewport")) {
      if(!visibleCarousel.has($(this).attr('id'))){
        visibleCarousel.add($(this).attr('id'));
        $(this).carousel('cycle');
      }
    } else {
      if(visibleCarousel.has($(this).attr('id'))){
        visibleCarousel.delete($(this).attr('id'));
        $(this).carousel('pause');
      }
    }
  });
}

$(function () {
  $(window).scroll(function () {
    scrollFunction();
    didScroll = true;

    // play video when is in view
    checkVideoViewport();
    checkVideoCarousel();
    checkCarousel();
  });
});

function scrollFunction() {
  if ($(document).scrollTop() > navbarHeight) {
    if (!isSearchHidden)
      headerOut();
    $("#scroll-top").css('display', 'block');
  } else {
    $("#scroll-top").css('display', 'none');
  }
}

function topFunction(animate) {
  if (animate) {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  } else {
    window.scrollTo({ top: 0 });
  }
}

var productData = [];

var fillTimeline = function ($timeline_div) {
  // console.log($timeline_div);
  $($timeline_div).empty();
  var param_FPin = window.Android.getFPin() ? "&f_pin=" + window.Android.getFPin() : "&f_pin=02b3c7f2db";
  productData.forEach(product => {
    var postDateObj = new Date(product.CREATED_DATE);
    var timelineItem = '<div class="my-2" id=product-"' + product.ID + '">' +
      '<div class="col-sm">' +
      '<div class="timeline-post-header media">' +
      '<a class="d-flex" href="profile?store_id=' + product.STORE_CODE + param_FPin + '">' +
      '<img src="' + product.STORE_THUMB_ID + '" alt="' + product.STORE_NAME + '" class="align-self-start rounded-circle mr-2" style="width:60px; height:60px;">' +
      '</a>' +
      '<div class="media-body">' +
      '<h5 class="store-name">' + product.STORE_NAME + '</h5>' +
      '<p class="prod-timestamp">' + postDateObj.getHours() + ':' + postDateObj.getMinutes() + '</p>' +
      '</div>' +
      '<div class="post-status">' +
      '<img src="../assets/img/ic_public.png" height="20" width="20"/>' +
      '</div>' +
      '<div class="post-status">' +
      '<img src="../assets/img/ic_user.png" height="20" width="20"/>' +
      '</div>' +
      '<div class="post-status">' +
      '<img src="../assets/img/ic_more.png" height="20" width="20"/>' +
      '</div>' +
      '</div>' +
      '</div>' +
      '<div class="col-sm mt-2 timeline-image">' +
      '<a class="timeline-main" onclick="openStore(\'' + element.CODE + '\',\'' + element.LINK + '\');">' +
      '<img class="single-image img-fluid rounded" src="' + product.THUMB_ID + '">' +
      '</a' +
      '</div>' +
      '<div class="col-sm mt-2" class="like-comment-container">' +
      '<div class="like-button" onClick="likeProduct(\'' + element.CODE + '\')">' +
      '<img id=like-' + element.CODE + ' src="../assets/img/jim_likes.png" height="25" width="25"/>' +
      '<div id=like-counter-' + element.CODE + ' class="like-comment-counter">' +
      element.TOTAL_LIKES +
      '</div>' +
      '</div>' +
      '<div class="comment-button">' +
      '<img src="../assets/img/jim_comments.png" height="25" width="25"/>' +
      '<div class="like-comment-counter">' +
      '0' +
      '</div>' +
      '</div>' +
      '<div class="follower-button" onClick="followStore(\'' + element.CODE + '\',\'' + element.STORE_CODE + '\')">' +
      '<img src="../assets/img/person_add.png" height="25" width="25"/>' +
      '<div id=follow-counter-post-' + element.CODE + ' class="like-comment-counter follow-counter-store-' + element.STORE_CODE + '">' +
      element.TOTAL_FOLLOWERS + ' followers' +
      '</div>' +
      '</div>' +
      '</div>' +
      '<div class="col-sm mt-2">' +
      '<h5 class="prod-name">' + product.NAME + '</h5>' +
      '<p class="prod-desc">' + product.DESCRIPTION + '</p>' +
      '</div>' +
      '</div>' +
      '<hr class="my-0">';
    $($timeline_div).append(timelineItem);
  });
  // registerPalioContextMenu();
}


function fetchProducts($store_id) {
  var xmlHttp = new XMLHttpRequest();
  xmlHttp.onreadystatechange = function () {
    if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
      productData = JSON.parse(xmlHttp.responseText);
      // console.log(productData);
      productData.forEach(storeEntry => {
        if (!storeEntry.THUMB_ID.startsWith("http")) {
          var root = 'http://' + location.host;
          var profPic = "";

          if (storeEntry.THUMB_ID == null || storeEntry.THUMB_ID == "") {
            profPic = "/persib_web/assets/img/palio.png";
          } else {
            profPic = "/palio_browser/images/" + storeEntry.THUMB_ID;
          }
          storeEntry.THUMB_ID = profPic;
        }
      });
      fillTimeline('#pbr-timeline');
    }
  }
  xmlHttp.open("get", "/persib_web/logics/fetch_products?store_id=" + $store_id);
  xmlHttp.send();
}

var storeMap = new Map();
var storeIdMap = new Map();

function fetchStores() {
  // var formData = new FormData();
  // formData.append('f_pin', localStorage.F_PIN);

  var params = location.search
    .substr(1)
    .split("&");
  var fpin = "";
  for (var i = 0; i < params.length; i++) {
    if (params[i].includes('f_pin=')) {
      tmp = params[i].split("=")[1];
      fpin = tmp;
    }
  }

  if (!fpin && window.Android) {
    try {
      fpin = window.Android.getFPin();
    } catch (error) {}
  }

  var xmlHttp = new XMLHttpRequest();
  xmlHttp.onreadystatechange = function () {
    if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
      let data = JSON.parse(xmlHttp.responseText);
      data.forEach(storeEntry => {
        storeMap.set(storeEntry.CODE, JSON.stringify(storeEntry));
        storeIdMap.set("" + storeEntry.ID, storeEntry.CODE);
      });
    }
  }
  if (fpin != "") {
    xmlHttp.open("get", "/persib_web/logics/fetch_stores?f_pin=" + fpin);
  } else {
    xmlHttp.open("get", "/persib_web/logics/fetch_stores");
  }
  xmlHttp.send();
}

function openStore($store_code, $store_link) {
  if (window.Android) {
    if (storeMap.has($store_code)) {
      var storeOpen = storeMap.get($store_code);
      window.Android.openStore(storeOpen);
    }
  } else {
    if ($store_link != "") {
      window.location.href = $store_link;
    } else {
      window.location.href = "/persib_web/pages/profile?store_id=" + $store_code + "&f_pin=02b3c7f2db";
    }
  }
}

var likedPost = [];

function getLikedPosts() {
  if (window.Android) {
    var f_pin = window.Android.getFPin();
    if (f_pin) {
      var xmlHttp = new XMLHttpRequest();
      xmlHttp.onreadystatechange = function () {
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
          let likeData = JSON.parse(xmlHttp.responseText);
          likeData.forEach(product => {
            var productCode = product.POST_ID;
            likedPost.push(productCode);
            $("#like-" + productCode).attr("src", "../assets/img/jim_likes_red.png");
          });
        }
      }
      xmlHttp.open("get", "/persib_web/logics/fetch_posts_liked?f_pin=" + f_pin);
      xmlHttp.send();
    }
  }
}

function likeProduct($productCode) {
  var score = parseInt($('#like-counter-' + $productCode).text());
  var isLiked = false;
  if (likedPost.includes($productCode)) {
    likedPost = likedPost.filter(p => p !== $productCode);
    $("#like-" + $productCode).attr("src", "../assets/img/jim_likes.png");
    if (score > 0) {
      $('#like-counter-' + $productCode).text(score - 1);
    }
    isLiked = false;
  } else {
    likedPost.push($productCode);
    $("#like-" + $productCode).attr("src", "../assets/img/jim_likes_red.png");
    $('#like-counter-' + $productCode).text(score + 1);
    isLiked = true;
  }

  //TODO send like to backend
  if (window.Android) {
    var f_pin = window.Android.getFPin();
    var curTime = (new Date()).getTime();

    var formData = new FormData();

    formData.append('product_code', $productCode);
    formData.append('f_pin', f_pin);
    formData.append('last_update', curTime);
    formData.append('flag_like', (isLiked ? 1 : 0));

    let xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function () {
      if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
        // console.log(xmlHttp.responseText);
        updateScore($productCode);
      }
    }
    xmlHttp.open("post", "/persib_web/logics/like_product");
    xmlHttp.send(formData);
  }
}

function likePost($productCode) {
  var score = parseInt($('#like-counter-' + $productCode).text());
  var isLiked = false;
  if (likedPost.includes($productCode)) {
    likedPost = likedPost.filter(p => p !== $productCode);
    $("#like-" + $productCode).attr("src", "../assets/img/jim_likes.png");
    if (score > 0) {
      $('#like-counter-' + $productCode).text(score - 1);
    }
    isLiked = false;
  } else {
    likedPost.push($productCode);
    $("#like-" + $productCode).attr("src", "../assets/img/jim_likes_red.png");
    $('#like-counter-' + $productCode).text(score + 1);
    isLiked = true;
  }

  //TODO send like to backend
  if (window.Android) {
    var f_pin = window.Android.getFPin();
    var curTime = (new Date()).getTime();

    var formData = new FormData();

    formData.append('post_id', $productCode);
    formData.append('f_pin', f_pin);
    formData.append('last_update', curTime);
    formData.append('flag_like', (isLiked ? 1 : 0));

    let xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function () {
      if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
        // console.log(xmlHttp.responseText);
        updateScore($productCode);
      }
    }
    xmlHttp.open("post", "/persib_web/logics/like_post");
    xmlHttp.send(formData);
  }
}

var followedStore = [];

function getFollowedUsers() {
  if (window.Android) {
    var f_pin = window.Android.getFPin();
    if (f_pin) {
      var xmlHttp = new XMLHttpRequest();
      xmlHttp.onreadystatechange = function () {
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
          let followData = JSON.parse(xmlHttp.responseText);
          followData.forEach(store => {
            var storeCode = store.L_PIN;
            followedStore.push(storeCode);
            $(".follow-icon-" + storeCode).attr("src", "../assets/img/ic_nuc_follow3_check.png");
          });
        }
      }
      xmlHttp.open("get", "/persib_web/logics/fetch_users_followed?f_pin=" + f_pin);
      xmlHttp.send();
    }
  }
}

function followStore($productCode, $storeCode) {
  var score = parseInt($('#follow-counter-post-' + $productCode).text().slice(0, -9));
  var isFollowed = false;
  if (followedStore.includes($storeCode)) {
    followedStore = followedStore.filter(p => p !== $storeCode);
    $(".follow-icon-" + $storeCode).attr("src", "../assets/img/person_add.png");
    if (score > 0) {
      $('.follow-counter-store-' + $storeCode).text((score - 1) + " pengikut");
    }
    isFollowed = false;
  } else {
    followedStore.push($storeCode);
    $(".follow-icon-" + $storeCode).attr("src", "../assets/img/ic_nuc_follow3_check.png");
    $('.follow-counter-store-' + $storeCode).text((score + 1) + " pengikut");
    isFollowed = true;
  }

  //TODO send like to backend
  if (window.Android) {
    var f_pin = window.Android.getFPin();
    var curTime = (new Date()).getTime();

    var formData = new FormData();

    formData.append('store_code', $storeCode);
    formData.append('f_pin', f_pin);
    formData.append('last_update', curTime);
    formData.append('flag_follow', (isFollowed ? 1 : 0));

    let xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function () {
      if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
        // console.log(xmlHttp.responseText);
        updateScoreShop($storeCode);
      }
    }
    xmlHttp.open("post", "/persib_web/logics/follow_store");
    xmlHttp.send(formData);
  }
}

var followedUser = [];

function getFollowedUser() {
  if (window.Android) {
    var f_pin = window.Android.getFPin();
    if (f_pin) {
      var xmlHttp = new XMLHttpRequest();
      xmlHttp.onreadystatechange = function () {
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
          let followData = JSON.parse(xmlHttp.responseText);
          followData.forEach(store => {
            var storeCode = store.STORE_CODE;
            followedUser.push(storeCode);
            $(".follow-icon-" + storeCode).attr("src", "../assets/img/ic_nuc_follow3_check.png");
          });
        }
      }
      xmlHttp.open("get", "/persib_web/logics/fetch_stores_followed?f_pin=" + f_pin);
      xmlHttp.send();
    }
  }
}

function followUser($productCode, $storeCode) {
  var score = parseInt($('#follow-counter-post-' + $productCode).text().slice(0, -9));
  var isFollowed = false;
  if (followedUser.includes($storeCode)) {
    followedUser = followedUser.filter(p => p !== $storeCode);
    $(".follow-icon-" + $storeCode).attr("src", "../assets/img/person_add.png");
    if (score > 0) {
      $('.follow-counter-store-' + $storeCode).text((score - 1) + " pengikut");
    }
    isFollowed = false;
  } else {
    followedUser.push($storeCode);
    $(".follow-icon-" + $storeCode).attr("src", "../assets/img/ic_nuc_follow3_check.png");
    $('.follow-counter-store-' + $storeCode).text((score + 1) + " pengikut");
    isFollowed = true;
  }

  //TODO send like to backend
  if (window.Android) {
    var f_pin = window.Android.getFPin();
    var curTime = (new Date()).getTime();

    var formData = new FormData();

    formData.append('store_code', $storeCode);
    formData.append('f_pin', f_pin);
    formData.append('last_update', curTime);
    formData.append('flag_follow', (isFollowed ? 1 : 0));

    let xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function () {
      if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
        // console.log(xmlHttp.responseText);
        updateScoreUser($storeCode);
      }
    }
    xmlHttp.open("post", "/persib_web/logics/follow_user");
    xmlHttp.send(formData);
  }
}

var commentedProducts = [];

function getCommentedPosts() {
  if (window.Android) {
    var f_pin = window.Android.getFPin();
    if (f_pin) {
    //   console.log("GETCOMMENTED");
      var xmlHttp = new XMLHttpRequest();
      xmlHttp.onreadystatechange = function () {
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
          let likeData = JSON.parse(xmlHttp.responseText);
          likeData.forEach(product => {
            var productCode = product.POST_ID;
            commentedProducts.push(productCode);
            $(".comment-icon-" + productCode).attr("src", "../assets/img/jim_comments_blue.png");
          });
        }
      }
      xmlHttp.open("get", "/persib_web/logics/fetch_posts_commented?f_pin=" + f_pin);
      xmlHttp.send();
    }
  }
}

var postsData = [];

function getUserPosts() {
  if (window.Android) {
    var f_pin = window.Android.getFPin();
    if (f_pin) {
    //   console.log("GETCOMMENTED");
      var xmlHttp = new XMLHttpRequest();
      xmlHttp.onreadystatechange = function () {
        if (xmlHttp.readyState == 4){
          console.log(xmlHttp.responseText);
        }
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
          postsData = JSON.parse(xmlHttp.responseText);
          console.log(postsData);
        }
      }
      xmlHttp.open("get", "/persib_web/logics/fetch_posts_json?f_pin=" + f_pin+"&filter=1-2");
      xmlHttp.send();
    }
  }
}
function getPersons() {
  if (window.Android) {
    var f_pin = window.Android.getFPin();
    if (f_pin) {
    //   console.log("GETCOMMENTED");
      var xmlHttp = new XMLHttpRequest();
      xmlHttp.onreadystatechange = function () {
        if (xmlHttp.readyState == 4){
          console.log(xmlHttp.responseText);
        }
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
          postsData = JSON.parse(xmlHttp.responseText);
          console.log(postsData);
        }
      }
      xmlHttp.open("get", "/persib_web/logics/fetch_person_official_json?f_pin=" + f_pin+"&filter=1-2");
      xmlHttp.send();
    }
  }
}

$('#switchAll').click(function () {
  setFilterCheckedAll($('#switchAll').is(':checked'));
});

function checkSwitch(checked) {
  $('#switchAll').prop('checked', checked);
}

$('.checkbox-filter-cat').click(function () {
  if (!$(this).is(':checked')) {
    checkSwitch(false);
  } else if (isFilterCheckedAll()
  ) {
    checkSwitch(true);
  }
});

function fillFilter(){
  var url_string = window.location.href;
  var url = new URL(url_string);
  console.log(url.searchParams);
  var searchValue = url.searchParams.get("query");
  if(searchValue != null){
    $('#query').val(searchValue);
  }
  var filterValue = url.searchParams.get("filter");
  if(filterValue != null){
    filterArr = filterValue.split("-");
    filterArr.forEach(filterId => {
      $('#checkboxFilter-'+filterId).prop('checked', true);
    });
  }
  var filterGear = document.getElementById("gear");
  // if (filterValue || searchValue) {
  //   filterGear.classList.add("filter-yellow");
  // } else {
  //   filterGear.classList.remove("filter-yellow");
  // }
}

function resetFilter() {
  $('#query').val('');
  $('#switchAll').prop('checked', true);
  setFilterCheckedAll(true);
  if (!isSearchHidden) {
    headerOut();
  }
  searchFilter();
}

function onClickHasStory() {
  $(".has-story").click(function (e) {
    e.preventDefault();
    if (this.id == "all-store") {
      STORE_ID = "";
      searchFilter();
    } else {
      let prev_STORE_ID = STORE_ID;
      STORE_ID = this.id.split("-")[1];
      // fetchProductCount(STORE_ID, prev_STORE_ID);
      searchFilter();
    }
    // searchFilter();
  });
}

function fetchProductCount(store_id, prev_STORE_ID) {
  var xmlHttp = new XMLHttpRequest();
  xmlHttp.onreadystatechange = function () {
    if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
      let data = JSON.parse(xmlHttp.responseText);
      if (data != null && data > 0) {
        searchFilter();
      } else {
        var f_pin = "";
        try {
          fpin = window.Android.getFPin();
        } catch (error) {}

        if (storeIdMap.has(store_id)) {
          var $store_code = storeIdMap.get(store_id);
          if(data != null && data == -1){
            openStore($store_code, "");
          } else {
            if (f_pin) {
              window.location.href = "profile.php?f_pin=" + f_pin + "&store_id=" + $store_code;
            } else {
              window.location.href = "profile.php?store_id=" + $store_code;
            }
          }
        } else {
          if(data != null && data == -1){
            openStore(store_id, "");
          } else {
            if (f_pin) {
              window.location.href = "profile.php?f_pin=" + f_pin + "&store_id=" + store_id;
            } else {
              window.location.href = "profile.php?store_id=" + store_id;
            }
          }
        }
        STORE_ID = prev_STORE_ID;
      }
      // console.log(data);
    }
  }
  xmlHttp.open("get", "/persib_web/logics/fetch_store_product_count?store_id=" + store_id);
  xmlHttp.send();
}

function highlightStore() {
  if (STORE_ID != "") {
    selected_id = "#store-" + STORE_ID;
    // todo: kalo store ga ada
  } else {
    selected_id = '#all-store';
  }
  $(selected_id).toggleClass("selected");
}

function searchFilter() {
  // console.log("here");
  var selected_id = "";
  $('.has-story').removeClass("selected");
  var dest = window.location.href;
  var product_dest = "timeline_products.php";
  var filter_dest = "timeline_story_container.php";
  var params = "";
  const query = $('#query').val();
  var filter = "";
  var filterGear = document.getElementById("gear");
  // if ($('#switchAll').is(':checked') && query == "") {
  //   filterGear.classList.remove("filter-yellow");
  // } else {
  //   filterGear.classList.add("filter-yellow");
  // }

  if (!$('#switchAll').is(':checked')) {
    filter = getFilterCheckboxValue();
  }
  if (dest.includes('#')) {
    dest = dest.split('#')[0]
  }
  if (dest.includes('?')) {
    dest = dest.split('?')[0];
  }
  if (STORE_ID != "") {
    params = params + "?store_id=" + STORE_ID;
  }
  if (query != "" || filter != "") {
    if (!params.includes("?")) {
      params = params + "?";
    } else {
      params = params + "&";
    }
  }
  if (query != "") {
    let urlEncodedQuery = encodeURIComponent(query);
    params = params + "query=" + urlEncodedQuery;
    if (filter != "") {
      params = params + "&";
    }
  }
  if (filter != "") {
    let urlEncodedFilter = encodeURIComponent(filter);
    params = params + "filter=" + urlEncodedFilter;
  }
  if (window.Android) {
    var f_pin = window.Android.getFPin();
    if (f_pin) {
      if (!params.includes("?")) {
        params = params + "?f_pin=" + f_pin;
      } else {
        params = params + "&f_pin=" + f_pin;
      }
    }
  }
  console.log("params " + params);
  dest = dest + params;
  product_dest = product_dest + params;
  filter_dest = filter_dest + params;
  // window.location.href = dest;
  console.log("filter " + filter + " x " + FILTERS);
  if (filter != FILTERS) {
    $.get(filter_dest, function (data) {
      $('#story-container').html(data);
      highlightStore();
      onClickHasStory();
    });
  } else {
    highlightStore();
  }
  $.get(product_dest, function (data) {
    $('#pbr-timeline').html(data);
    redrawLikeFollowComment();
    window.history.replaceState(null, "", dest);
    // registerPalioContextMenu();
    reinitCarousel();
    hideProdDesc();
    toggleProdDesc();
    setCurrentStore(STORE_ID);
    checkVideoViewport();
    checkCarousel();
    toggleVideoMute();
    fetchProductMap(params);
  });
}

function voiceSearch() {
  if (window.Android) {
    $isVoice = window.Android.toggleVoiceSearch();
    toggleVoiceButton($isVoice);
  }
}

function submitVoiceSearch($searchQuery) {
  // console.log("submitVoiceSearch " + $searchQuery);
  $('#query').val($searchQuery);
  searchFilter();
}

function toggleVoiceButton($isActive) {
  if ($isActive) {
    $("#mic").attr("src", "../assets/img/action_mic_blue.png");
  } else {
    $("#mic").attr("src", "../assets/img/action_mic.png");
  }
}

$('#searchFilterForm-a').validate({
  rules: {
    'category[]': {
      required: true
    }
  },
  messages: {
    'category[]': {
      required: '<div class="alert alert-danger" role="alert">Pilih minimal salah satu filter di atas</div>',
    },
  },
  submitHandler: function (form) {
    searchFilter();
  },
  errorClass: 'help-block',
  errorPlacement: function (error, element) {
    if (element.attr('name') == 'category[]') {

      error.insertAfter('#checkboxGroup');
    }
  }

});

function hasStoreId() {
  var tmp = "";
  var params = location.search
    .substr(1)
    .split("&");
  var id = "#all-store";
  var filter = "";
  for (var i = 0; i < params.length; i++) {
    if (params[i].includes('store_id=')) {
      tmp = params[i].split("=")[1];
      STORE_ID = tmp;
    } else if (params[i].includes('filter=')) {
      tmp = params[i].split("=")[1];
      FILTERS = tmp;
    }
  }
  highlightStore();
  const scrollLeft = $(id).position()['left'];
  $("#story-container ul").scrollLeft(scrollLeft);
  if (location.href.includes('#product')) {
    var product_id = '#' + location.href.split('#')[1]
    $(product_id)[0].scrollIntoView();
  }
}

hasStoreId();
onClickHasStory();

if (performance.navigation.type == 2) {
  location.reload(true);
}

function redrawLikeFollowComment() {
  likedPost.forEach(productCode => {
    $("#like-" + productCode).attr("src", "../assets/img/jim_likes_red.png");
  });
  followedStore.forEach(storeCode => {
    $(".follow-icon-" + storeCode).attr("src", "../assets/img/ic_nuc_follow3_check.png");
  });
  commentedProducts.forEach(productCode => {
    $(".comment-icon-" + productCode).attr("src", "../assets/img/jim_comments_blue.png");
  });
}

function reinitCarousel() {
  $('.carousel').each(function () {
    $(this).carousel();
  });
}

function horizontalScrollPos() {
  let selectedPos = document.querySelector('.has-story.selected').offsetLeft;
  document.querySelector('#story-container ul').scrollBy({
    left: selectedPos,
    behavior: 'smooth'
  });
}

function setCurrentStore($store_id) {
  if (storeIdMap.has($store_id)) {
    var $store_code = storeIdMap.get($store_id);
    if (storeMap.has($store_code) && window.Android) {
      var storeOpen = JSON.parse(storeMap.get($store_code));
      if (storeOpen.IS_VERIFIED == 1 && !storeOpen.LINK) {
        window.Android.setCurrentStore($store_code, storeOpen.BE_ID);
      } else {
        window.Android.setCurrentStore('', '');
      }
    }
  }
}

function hideProdDesc() {
  $(".prod-desc").each(function () {
    if ($(this).text().length > 50) {
      $(this).toggleClass("truncate");
      let toggleText = document.createElement("span");
      toggleText.innerHTML = "Selengkapnya...";
      toggleText.classList.add("truncate-read-more");
      $(this).parent().append(toggleText);
    }
  });
}

function toggleProdDesc() {
  $(".truncate-read-more").each(function () {
    $(this).click(function () {
      // console.log("read more");
      $(this).parent().find(".prod-desc").toggleClass("truncate");
      if ($(this).text() == "Selengkapnya...") {
        $(this).text("Sembunyikan");
      } else {
        $(this).text("Selengkapnya...");
      }
    });
  });
}

function toggleVideoMute() {
  $(".video-sound").each(function () {
    $(this).click(function (e) {
      e.stopPropagation();
      let $videoElement = $(this).parent().find("video.myvid");
      if ($videoElement.prop("muted")) {
        $videoElement.prop("muted", false);
        $(this).find("img").attr("src", "../assets/img/video_unmute.png");
      } else {
        $videoElement.prop("muted", true);
        $(this).find("img").attr("src", "../assets/img/video_mute.png");
      }
    });
  });
}

function videoMuteAll() {
  $(".video-sound").each(function () {
    let $videoElement = $(this).parent().find("video.myvid");
    $videoElement.prop("muted", true);
    $(this).find("img").attr("src", "../assets/img/video_mute.png");
  });
}

var productMap = new Map();

function fetchProductMap(str) {
  // var formData = new FormData();
  // formData.append('f_pin', localStorage.F_PIN);

  var params = "";
  if (str == "") {
    params = location.search;
  } else {
    params = str;
  }

  var xmlHttp = new XMLHttpRequest();
  xmlHttp.onreadystatechange = function () {
    if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
      let data = JSON.parse(xmlHttp.responseText);
      data.forEach(productEntry => {
        productMap.set(productEntry.CODE, JSON.stringify(productEntry));
      });
    }
  }
  xmlHttp.open("get", "/persib_web/logics/fetch_products_json" + params);
  xmlHttp.send();
}

function openProductMenu($productCode) {
  if (window.Android) {
    if (productMap.has($productCode)) {
      var productOpen = productMap.get($productCode);
      window.Android.openProductMenu(productOpen);
    }
  }
}

function videoReplayOnEnd() {
  // $("video.myvid").on('ended', function() {
  //   console.log("video ended");
  //   let $videoPlayButton = $(this).parent().find(".video-play");
  //   $videoPlayButton.removeClass("d-none");
  // })
  $(".myvid").each(function (i, obj) {
    $(this).on('ended', function () {
      // console.log("video ended");
      let $videoPlayButton = $(this).parent().find(".video-play");
      $videoPlayButton.removeClass("d-none");
    })
  })
}

function playVid() {
  $("div.video-play").each(function () {
    $(this).click(function (e) {
      e.stopPropagation();
      $(this).parent().find("video.myvid").get(0).play();
      $(this).addClass("d-none");
    })
  })
}

function pauseAll() {
  $('.carousel-item video, .timeline-image video').each(function () {
      $(this).get(0).pause();
  })
  visibleCarousel.clear();
  $('.carousel').each(function(){
    $(this).carousel('pause');
  })
}

function resumeAll(){
  checkVideoViewport();
  checkVideoCarousel();
  checkCarousel();
}

function visitStore($store_code, $f_pin, $is_entering) {
  var formData = new FormData();

  formData.append('store_code', $store_code);
  formData.append('f_pin', $f_pin);
  formData.append('flag_visit', ($is_entering ? 1 : 0));

  if ($store_code && $f_pin) {
    let xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function () {
      if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
        // console.log(xmlHttp.responseText);
      }
    }
    xmlHttp.open("post", "/persib_web/logics/visit_store");
    xmlHttp.send(formData);
  }
}

function openSettings(){
  if(window.Android){
    window.Android.openPalioSettings();
  }
}

$(function () {
  //   PullToRefresh.init({
  //     mainElement: '#pbr-timeline',
  //     onRefresh: function () {
  //       window.location.reload();
  //     }
  //   });
  getLikedPosts();
  getFollowedUsers();
  getCommentedPosts();
  fillFilter();
  fetchStores();
  fetchProductMap("");
  checkVideoViewport();
  checkVideoCarousel();
  checkCarousel();
  hideProdDesc();
  toggleProdDesc();
  toggleVideoMute();
  videoReplayOnEnd();
  playVid();

  if (STORE_ID != "") {
    setCurrentStore(STORE_ID);
  }
});

window.onload = (event) => {
  horizontalScrollPos();
};

$(window).on('unload', function () {
  $(window).scrollTop(0);
});
window.onunload = function () {
  window.scrollTo(0, 0);
}
if ('scrollRestoration' in history) {
  history.scrollRestoration = 'manual';
}