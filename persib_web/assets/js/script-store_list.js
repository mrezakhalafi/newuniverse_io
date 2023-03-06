var data = [];
var dataFiltered = [];

var grid_stack = GridStack.init({
  float: false,
  disableOneColumnMode: true,
  column: 3,
  margin: 2.5,
});

var big_list = new Map();

function isBig($position) {
  var div = Math.floor($position / 9);
  if (big_list.has(div)) {
    return (big_list.get(div) == $position);
  } else {
    var pos = (div * 9) + Math.floor(Math.random() * 8);
    big_list.set(div, pos);
    return (pos == $position);
  }
}

// to randomized array js
function shuffle(array) {
  var currentIndex = array.length, randomIndex;

  // While there remain elements to shuffle...
  while (0 !== currentIndex) {

    // Pick a remaining element...
    randomIndex = Math.floor(Math.random() * currentIndex);
    currentIndex--;

    // And swap it with the current element.
    [array[currentIndex], array[randomIndex]] = [
      array[randomIndex], array[currentIndex]];
  }

  return array;
}

// to get merchants that have products
function nonEmptyMerchants() {
  let xhr = new XMLHttpRequest();
  xhr.open('GET', '/persib_web/logics/non_empty_merchants.php');
  xhr.responseType = 'json';
  xhr.send();
  xhr.onload = function () {
    if (xhr.status != 200) { // analyze HTTP status of the response
      console.log(`Error ${xhr.status}: ${xhr.statusText}`); // e.g. 404: Not Found

    } else { // show the result
      let responseObj = xhr.response; // array
      localStorage.setItem("non_empty_merchant", JSON.stringify(responseObj));
      // alert(`Done, got ${xhr.response.length} bytes`); // response is the server response
    }
  };

  xhr.onerror = function () {
    console.log("Request failed");
  };
}
nonEmptyMerchants();

// to shuffle product order in tab 1
function shuffleMerchants() {
  let all_merchants = dataFiltered; // array of all merchant
  let non_empty_merchants = JSON.parse(localStorage.getItem('non_empty_merchant')); // array of merchant code (that has products)

  let non_empty = [];
  let empty = [];
  all_merchants.forEach(merchant => {
    if (non_empty_merchants.includes(merchant.CODE)) {
      non_empty.push(merchant);
    } else {
      empty.push(merchant);
    }
  });

  // to make the non empty appear based on score, remove shuffle from non-empty
  // return non_empty.concat(shuffle(empty)) // shuffling only merchant with no products
  return shuffle(non_empty).concat(shuffle(empty));
}

function getExtension(filename) {
  var parts = filename.split('.');
  return parts[parts.length - 1];
}
function isVideo(filename) {
  var ext = getExtension(filename);
  switch (ext.toLowerCase()) {
      case 'm4v':
      case 'avi':
      case 'mpg':
      case 'mp4':
          // etc
          return true;
  }
  return false;
}

var enableFollow = 0;
var showLinkless = 2;
var f_pin = '';
var gridElements = [];
var carouselIntervalId = 0;
var fillGridStack = function ($grid) {
  gridElements = [];
  big_list.clear();
  var baseDelay = 5000;//(Math.max(5, dataFiltered.length) * 1000) / 2;
  // console.table(dataFiltered);
  var $image_type_arr = ["jpg", "jpeg", "png", "webp"];
  var $video_type_arr = ["mp4", "mov", "wmv", 'flv', 'webm', 'mkv', 'gif', 'm4v', 'avi', 'mpg'];
  var ext_re = /(?:\.([^.]+))?$/;

  if (window.Android) {
    try {
      f_pin = window.Android.getFPin();
    } catch (err) {
      console.log(err);
    }
  }

  dataFiltered.forEach((element, idx) => {
    var size = (isBig(idx) ? 2 : 1);
    var imageDivs = '';
    var imageArray = productImageMap.get(element.CODE);
    var delay = Math.floor(Math.random() * (5000)) + 5000;
    if (imageArray) {
        imageArray.forEach((image, j) => {
            if (isVideo(image) && j == 0) {
                imageDivs = imageDivs + '<div class="carousel-item active"><video muted autoplay loop class="content-image"><source src="' + image + '"></video></div>';
                j++;
            } else if (isVideo(image)) {
                imageDivs = imageDivs + '<div class="carousel-item"><video muted loop autoplay class="content-image"><source src="' + image + '"></video></div>';
            } else if (j == 0) {
                imageDivs = imageDivs + '<div class="carousel-item active"><img class="content-image" src="' + image + '"/></div>';
                j++;
            } else {
                imageDivs = imageDivs + '<div class="carousel-item"><img class="content-image" src="' + image + '"/></div>';
            }
        });
        var computed =
            '<div class="inner">' +
            '<div id="store-carousel-' + element.CODE + '" class="carousel slide pointer-event" ' +
            (imageArray.length > 1 ? ('data-ride="carousel" data-interval="' + delay + '"') : ('')) +
            ' data-touch="true">' +
            '<div class="carousel-inner">' +
            imageDivs +
            '</div>' +
            '</div>' +
            '</div>';
        gridElements.push({
            id: element.ID,
            minW: size,
            minH: size,
            maxW: size,
            maxH: size,
            content: computed
        });
    }
});


  // grid_stack.batchUpdate();
  $('#loading').addClass('d-none');

  grid_stack.removeAll();
  grid_stack.load(gridElements, true);
  // grid_stack.commit();
  if (dataFiltered.length == 0) {
    $('#no-stores').removeClass('d-none');
  } else {
    $('#no-stores').addClass('d-none');
  }
  $('.carousel').each(function () {
    $(this).carousel();
    // setTimeout(() => {
    //   $(this).carousel('next');
    // }, Math.floor(Math.random() * (1000)) + 1000);
  });
  checkVideoViewport();
  checkVideoCarousel();
  checkCarousel();
  correctVideoCrop();
  correctImageCrop();
  
  if(carouselIntervalId){
    clearInterval(carouselIntervalId);
  }
  carouselIntervalId = setInterval(function () {
    carouselNext();
  }, 3000);
  // registerPalioContextMenu();
};

var nextCarouselIdx = 0;
var carouselList = [];
function carouselNext(){
  if(carouselList.length <= 0) return;
  let prevIdx = nextCarouselIdx;
  while (!$(carouselList[nextCarouselIdx]).is(":in-viewport")) {
    nextCarouselIdx = nextCarouselIdx + 1;
    if(nextCarouselIdx >= carouselList.length){
      nextCarouselIdx = 0;
    }
    if(nextCarouselIdx == prevIdx) break;
  }
  $(carouselList[nextCarouselIdx]).carousel('next');
  nextCarouselIdx = nextCarouselIdx + 1;
  if(nextCarouselIdx >= carouselList.length){
    nextCarouselIdx = 0;
  }
}



function correctVideoCrop() {
  var videos = document.querySelectorAll("video.content-image");
  videos.forEach(function (elem) {
    elem.addEventListener("loadedmetadata", function () {
      if (elem.videoWidth > elem.videoHeight) {
        elem.classList.add("landscape");
      }
    })
  })
}

function correctImageCrop() {
  var images = document.querySelectorAll("img.content-image");
  images.forEach(function (elem) {
    elem.addEventListener("load", function () {
      if (elem.width > elem.height) {
        elem.classList.add("landscape");
      }
    })
  })
}

function openStoreMenu($storeCode, $storeName) {
  if (window.Android) {
    if (storeMap.has($storeCode)) {
      var storeOpen = storeMap.get($storeCode);
      window.Android.openStoreMenu(storeOpen);
    }
  }
}

function fetchRewardPoints() {
  var xmlHttp = new XMLHttpRequest();
  xmlHttp.onreadystatechange = function () {
    if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
      let resp = JSON.parse(xmlHttp.responseText);
      // console.log(resp);

      if (resp.length > 0) {
        resp.forEach(abc => {
          let storeIndex = dataFiltered.findIndex(dt => dt.CODE == abc.STORE_CODE);
          dataFiltered[storeIndex].REWARD_PTS = abc.AMOUNT;
          // console.log(storeIndex);
        });
      }
    }
  };

  if (window.Android) {
    var f_pin = window.Android.getFPin();
    // var f_pin = "0282aa57c9";
    // var fpin_lokal = "0282aa57c9";
    if (f_pin) {
      xmlHttp.open("get", "/persib_web/logics/fetch_stores_reward_user_raw?f_pin=" + f_pin);
    } else {
      xmlHttp.open("get", "/persib_web/logics/fetch_stores_reward_user_raw");
    }
  } else {
    xmlHttp.open("get", "/persib_web/logics/fetch_stores_reward_user_raw");
    // var f_pin = "0282aa57c9";
    // xmlHttp.open("get", "/persib_web/logics/fetch_stores_reward_user_raw?f_pin=" + f_pin);
  }

  xmlHttp.send();
}

function checkVideoViewport() {
  $('.carousel-item video, .timeline-image video').each(function () {
    if ($(this).is(":in-viewport")) {
      // pause carousel when video is playing
      $(this).off("play");
      $(this).on("play", function (e) {
        $(this).closest(".carousel").carousel("pause");
      })
      $(this).get(0).play();
    } else {
      // start carousel when video is not playing
      $(this).off("stop pause ended");
      $(this).on("stop pause ended", function (e) {
        $(this).closest(".carousel").carousel();
      });
      $(this).get(0).pause();
    }
  })
}

function checkVideoCarousel() {
  // play video when active in carousel
  $(".carousel").on("slid.bs.carousel", function (e) {
    if ($(this).find("video").length) {
      if ($(this).find(".carousel-item").hasClass("active")) {
        $(this).find("video").get(0).play();
      } else {
        $(this).find("video").get(0).pause();
      }
    }
  });
}

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

// start periodic when window in focus
$(window).focus(function () {
  //do something
  console.log("focus in, periodic on");
  refreshId = setInterval(function () {
    updateStoreViewer();
  }, 10000);
  if(carouselIntervalId){
    clearInterval(carouselIntervalId);
  }
  carouselIntervalId = setInterval(function () {
    carouselNext();
  }, 3000);
});

// stop periodic when window out of focus
$(window).blur(function () {
  //do something
  clearInterval(refreshId);
  if(carouselIntervalId){
    clearInterval(carouselIntervalId);
    carouselIntervalId = 0;
  }
  console.log("lost focus, periodic die.");
});

var refreshId = 0;
$(function () {
  // fillGridStack('#content-grid');
  registerPulldown();
  $(window).scroll(function () {
    scrollFunction();
    didScroll = true;

    // play video when is in view
    checkVideoViewport();
    checkVideoCarousel();
    checkCarousel();
  });
  // if (localStorage.getItem("store_data") !== null && localStorage.getItem("store_pics_data") !== null) {
  //   prefetchStores();
  // }
  fillFilter();
  // getFollowSetting();
  getShowLinklessSetting();
  // fetchStores();
  fetchProducts();
  updateStoreViewer();
});

var storeMap = new Map();

function prefetchStores() {
  data = JSON.parse(localStorage.getItem("store_data"));
  filterStoreData(filter, search);
  dataFiltered.forEach(storeEntry => {
    storeMap.set(storeEntry.CODE, JSON.stringify(storeEntry));

    $thumb_ids = storeEntry.THUMB_ID.split("|");
    $thumb_ids.forEach(function (thumbid, index) {
      if (!thumbid.startsWith("http")) {
        var root = 'http://' + location.host;
        var profPic = "";

        if (thumbid == null || thumbid == "") {
          profPic = "/persib_web/assets/img/palio.png";
        } else {
          // profpic = root + ":2809/file/image/" + storeEntry.THUMB_ID;
          profPic = "/palio_browser/images/" + thumbid;
        }
        $thumb_ids[index] = profPic;
      }
    });
    productImageMap.set(storeEntry.CODE, $thumb_ids);
  });
  // dataFiltered = [];
  // dataFiltered = dataFiltered.concat(data);

  var productData = JSON.parse(localStorage.getItem("store_pics_data"));
  productData.forEach(storeEntry => {
    $thumb_ids = storeEntry.THUMB_ID.split("|");
    $thumb_ids.forEach(function (thumbid, index) {
      if (!thumbid.startsWith("http")) {
        var root = 'http://' + location.host;
        var profPic = "";

        if (thumbid == null || thumbid == "") {
          profPic = "/persib_web/assets/img/palio.png";
        } else {
          // profpic = root + ":2809/file/image/" + storeEntry.THUMB_ID;
          profPic = "/palio_browser/images/" + thumbid;
        }
        $thumb_ids[index] = profPic;
      }
    });
    if (!productImageMap.has(storeEntry.STORE_CODE)) {
      productImageMap.set(storeEntry.STORE_CODE, $thumb_ids);
    } else if (productImageMap.get(storeEntry.STORE_CODE).length < 3) {
      productImageMap.set(storeEntry.STORE_CODE, productImageMap.get(storeEntry.STORE_CODE).concat($thumb_ids));
    }
  });
  fillGridStack('#content-grid');
}

function getFollowSetting() {
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      dataFollowSetting = JSON.parse(xhr.responseText);

      // console.log(data);
      enableFollow = dataFollowSetting;
    }
  };
  xhr.open("get", "/persib_web/logics/fetch_stores_settings?param=stats");
  xhr.send();
}

function getShowLinklessSetting() {
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      dataShowLinklessSetting = JSON.parse(xhr.responseText);

      // console.log(data);
      showLinkless = dataShowLinklessSetting;
    }
  };
  xhr.open("get", "/persib_web/logics/fetch_stores_settings?param=show_linkless");
  xhr.send();
}

function fetchStores() {
  // var formData = new FormData();
  // formData.append('f_pin', localStorage.F_PIN);

  var xmlHttp = new XMLHttpRequest();
  xmlHttp.onreadystatechange = function () {
    if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
      data = JSON.parse(xmlHttp.responseText);
      filterStoreData(filter, search);
      dataFiltered.forEach(storeEntry => {
        storeMap.set(storeEntry.CODE, JSON.stringify(storeEntry));

        $thumb_ids = storeEntry.THUMB_ID.split("|");
        $thumb_ids.forEach(function (thumbid, index) {
          if (!thumbid.startsWith("http")) {
            var root = 'http://' + location.host;
            var profPic = "";

            if (thumbid == null || thumbid == "") {
              profPic = "/persib_web/assets/img/palio.png";
            } else {
              // profpic = root + ":2809/file/image/" + storeEntry.THUMB_ID;
              profPic = "/palio_browser/images/" + thumbid;
            }
            $thumb_ids[index] = profPic;
          }
        });
        productImageMap.set(storeEntry.CODE, $thumb_ids);
      });
      // dataFiltered = [];
      // dataFiltered = dataFiltered.concat(data);
      localStorage.setItem("store_data", xmlHttp.responseText);
      fetchProductPics();

    }
  }

  if (window.Android) {
    var f_pin = window.Android.getFPin();
    if (f_pin) {
      xmlHttp.open("get", "/persib_web/logics/fetch_stores?f_pin=" + f_pin);
    } else {
      xmlHttp.open("get", "/persib_web/logics/fetch_stores");
    }
  } else {
    xmlHttp.open("get", "/persib_web/logics/fetch_stores");
    // var f_pin = "0282aa57c9";
    // xmlHttp.open("get", "/persib_web/logics/fetch_stores?f_pin=" + f_pin);
  }

  xmlHttp.send();
}

function fetchProducts() {
  // var formData = new FormData();
  // formData.append('f_pin', localStorage.F_PIN);

  var xmlHttp = new XMLHttpRequest();
  xmlHttp.onreadystatechange = function () {
      if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
          data = JSON.parse(xmlHttp.responseText);
          // $('#post-count').text(data.length);
          data.forEach(productEntry => {
              if (!productEntry.THUMB_ID.startsWith("http")) {
                  var root = 'http://' + location.host;
              }
              // console.log(productEntry.THUMB_ID);
              var thumbs = productEntry.THUMB_ID.split("|");
              thumbs.forEach(image => {
                  if (!productImageMap.has(productEntry.CODE)) {
                      productImageMap.set(productEntry.CODE, [image]);
                  } else {
                      productImageMap.set(productEntry.CODE, productImageMap.get(productEntry.CODE).concat([image]));
                  }
              });
          });
          dataFiltered = [];
          dataFiltered = dataFiltered.concat(data);
          fillGridStack('#content-grid');
          
          // try {
          //     if (window.Android) {
          //         window.Android.setCurrentProductsData(xmlHttp.responseText);
          //     }
          // } catch (err) {
          //     console.log(err);
          // }
      }
  }
  xmlHttp.open("get", "/persib_web/logics/fetch_products?store_id=17b0ae770cd");
  xmlHttp.send();
}

function updateStoreViewer() {
  var xmlHttp = new XMLHttpRequest();
  xmlHttp.onreadystatechange = function () {
    if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
      let dataStoreViewer = JSON.parse(xmlHttp.responseText);
      dataStoreViewer.forEach(storeEntry => {
        if (storeEntry.IS_LIVE_STREAMING > 0) {
          $('#live-' + storeEntry.CODE).removeClass('d-none');
        } else {
          $('#live-' + storeEntry.CODE).addClass('d-none');
        }
        $('#visitor-' + storeEntry.CODE + ' span.visitor-amt').html('' + new Intl.NumberFormat('en-US', {
          maximumFractionDigits: 1,
          notation: "compact"
        }).format(storeEntry.TOTAL_VISITOR));
        $('#visitor-' + storeEntry.CODE + ' span.follower-amt').html('' + new Intl.NumberFormat('en-US', {
          maximumFractionDigits: 1,
          notation: "compact"
        }).format(storeEntry.TOTAL_FOLLOWER));
      });
    }
  }

  if (window.Android) {
    var f_pin = window.Android.getFPin();
    if (f_pin) {
      xmlHttp.open("get", "/persib_web/logics/fetch_stores?f_pin=" + f_pin);
    } else {
      xmlHttp.open("get", "/persib_web/logics/fetch_stores");
    }
  } else {
    xmlHttp.open("get", "/persib_web/logics/fetch_stores");
  }

  xmlHttp.send();
}

var productImageMap = new Map();
var productImageCountMap = new Map();

function fetchProductPics() {
  // var formData = new FormData();
  // formData.append('f_pin', localStorage.F_PIN);

  var xmlHttp = new XMLHttpRequest();
  xmlHttp.onreadystatechange = function () {
    if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
      var productData = JSON.parse(xmlHttp.responseText);
      productData.forEach(storeEntry => {
        if(storeEntry.IS_SHOW == "0") return;
        if (productImageCountMap.has(storeEntry.STORE_CODE) && productImageCountMap.get(storeEntry.STORE_CODE) >= 3) {
          return;
        }

        $thumb_ids = storeEntry.THUMB_ID.split("|");
        $thumb_ids.forEach(function (thumbid, index) {
          if (!thumbid.startsWith("http")) {
            var root = 'http://' + location.host;
            var profPic = "";

            if (thumbid == null || thumbid == "") {
              profPic = "/persib_web/assets/img/palio.png";
            } else {
              // profpic = root + ":2809/file/image/" + storeEntry.THUMB_ID;
              profPic = "/palio_browser/images/" + thumbid;
            }
            $thumb_ids[index] = profPic;
          }
        });
        if (!productImageMap.has(storeEntry.STORE_CODE)) {
          productImageMap.set(storeEntry.STORE_CODE, $thumb_ids);
        } else {
          productImageMap.set(storeEntry.STORE_CODE, productImageMap.get(storeEntry.STORE_CODE).concat($thumb_ids));
        }
        
        if (!productImageCountMap.has(storeEntry.STORE_CODE)) {
          productImageCountMap.set(storeEntry.STORE_CODE, 1);
        } else {
          productImageCountMap.set(storeEntry.STORE_CODE, productImageCountMap.get(storeEntry.STORE_CODE) + 1);
        }
      });
      localStorage.setItem("store_pics_data", xmlHttp.responseText);
      fillGridStack('#content-grid');
    }
  }
  xmlHttp.open("get", "/persib_web/logics/fetch_products_image");
  xmlHttp.send();
}

var hiddenStores = [];
function filterStoreData($filterCategory, $filterSearch) {
  if (window.Android) {
    try {
      hiddenStores = window.Android.getHiddenStores().split(",");
    } catch (error) {

    }
  }

  dataFiltered = [];
  data.forEach(storeEntry => {
    if(showLinkless == 2 || (showLinkless == 1 && !storeEntry.LINK) || (showLinkless == 0 && storeEntry.LINK)){
      var isMatchCategory = false;
      if ($filterCategory) {
        var categoryArray = $filterCategory.split("-");
        isMatchCategory = categoryArray.indexOf(storeEntry.CATEGORY + "") > -1;
      } else {
        isMatchCategory = true;
      }

      var isMatchSearch = false;
      if ($filterSearch) {
        isMatchSearch = isMatchSearch || storeEntry.NAME.toLowerCase().includes($filterSearch.toLowerCase());
        isMatchSearch = isMatchSearch || storeEntry.DESCRIPTION.toLowerCase().includes($filterSearch.toLowerCase());
        isMatchSearch = isMatchSearch || storeEntry.LINK.toLowerCase().includes($filterSearch.toLowerCase());
      } else {
        isMatchSearch = true;
      }

      if (isMatchCategory && isMatchSearch && !hiddenStores.includes(storeEntry.CODE)) {
          dataFiltered.push(storeEntry);
      }
    }

  });
  fetchRewardPoints();
}

function openStore($store_code, $store_link) {
  if (window.Android) {
    if (storeMap.has($store_code)) {
      var storeOpen = storeMap.get($store_code);
      
      var xmlHttp = new XMLHttpRequest();
      xmlHttp.onreadystatechange = function () {
          if (xmlHttp.readyState == 4) {
            if(xmlHttp.status == 200){
              let dataStore = JSON.parse(xmlHttp.responseText);
              storeData = JSON.stringify(dataStore[0]);
            }
            window.Android.openStore(storeOpen);
          }
      }
      xmlHttp.open("get", "/persib_web/logics/fetch_stores_specific?store_id=" + $store_code);
      xmlHttp.send();
    }
  } else {
    window.location.href = $store_link;
  }
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
        let dataVisitStore = JSON.parse(xmlHttp.responseText);
        $('#visitor-' + $store_code + ' span').html('' + new Intl.NumberFormat('en-US', {
          maximumFractionDigits: 1,
          notation: "compact"
        }).format(dataVisitStore[0].TOTAL_VISITOR));
      }
    }
    xmlHttp.open("post", "/persib_web/logics/visit_store");
    xmlHttp.send(formData);
  }
}

var mouseY = 0;
var startMouseY = 0;

function registerPulldown() {
  PullToRefresh.init({
    mainElement: '#content-grid',
    onRefresh: function () {
      window.location.reload();
    }
  });
}

var didScroll;
var isSearchHidden = true;
var lastScrollTop = 0;
var delta = 1;
var navbarHeight = $('#header-layout').outerHeight();
var topPosition = 0;

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
  // if(Math.abs(lastScrollTop - st) <= delta)
  //     return;

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

$(function () {
  $(window).scroll(function () {
    scrollFunction();
    didScroll = true;
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

function topFunction() {
  $('body,html').animate({
    scrollTop: 0
  }, 500);
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
}

function resetFilter() {
  var needRefresh = false;
  if ($('#query').val() || !$("#switchAll").is(':checked')) {
    needRefresh = true;
  }
  $("#mic").attr("src", "../assets/img/action_mic.png");
  $('#query').val('');
  $('#switchAll').prop('checked', true);
  setFilterCheckedAll(true);
  if (!isSearchHidden) {
    headerOut();
  }
  if (needRefresh) {
    searchFilter();
  }
}

function searchFilter() {
  $('#loading').removeClass('d-none');
  setTimeout(function() {
    // console.log("here");
    var dest = "";
    const query = $('#query').val();
    var filter = "";
    var filterGear = document.getElementById("gear");
    if ($('#switchAll').is(':checked') && query == "") {
      filterGear.classList.remove("filter-yellow");
    } else {
      filterGear.classList.add("filter-yellow");
    }
    if (!$('#switchAll').is(':checked')) {
      filter = getFilterCheckboxValue();
    }
    if (dest.includes('?query') || dest.includes('?filter')) {
      dest = dest.split('?')[0];
    }
    if (dest.includes('&')) {
      dest = dest.split('&')[0];
    }
    if (query != "" || filter != "") {
      if (!dest.includes("?")) {
        dest = dest + "?";
      } else {
        dest = dest = "&";
      }
    }
    if (query != "") {
      let urlEncodedQuery = encodeURIComponent(query);
      dest = dest + "query=" + urlEncodedQuery;
      if (filter != "") {
        dest = dest + "&";
      }
    }
    if (filter != "") {
      let urlEncodedFilter = encodeURIComponent(filter);
      dest = dest + "filter=" + urlEncodedFilter;
    }
    // window.location.href = dest;
    if (!dest) dest = "?"
    history.pushState({
      'search': query,
      'filter': filter
    }, "Palio Browser", dest);
    filterStoreData(filter, query);
    fillGridStack('#content-grid');
  }, 0);
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

function pauseAll() {
  $('.carousel-item video, .timeline-image video').each(function () {
      $(this).get(0).pause();
  })
  visibleCarousel.clear();
  $('.carousel').each(function(){
    $(this).carousel('pause');
  })
  if(carouselIntervalId){
    clearInterval(carouselIntervalId);
    carouselIntervalId = 0;
  }
}

function resumeAll(){
  checkVideoViewport();
  checkVideoCarousel();
  checkCarousel();
  if(carouselIntervalId){
    clearInterval(carouselIntervalId);
  }
  carouselIntervalId = setInterval(function () {
    carouselNext();
  }, 3000);
}

function openSettings(){
  if(window.Android){
    window.Android.openPalioSettings();
  }
}

$('#searchFilterForm').validate({
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