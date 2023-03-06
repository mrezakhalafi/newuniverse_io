var data = [];
var dataFiltered = [];
var productImageMap = new Map();
var productImageStateMap = new Map();

var grid_stack = GridStack.init({
    float: false,
    disableOneColumnMode: true,
    column: 3,
    margin: 2.5,
});

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

var gridElements = [];
var fillGridStack = function ($grid) {
    gridElements = [];
    let fpin = new URLSearchParams(window.location.search).get("f_pin");
    if (!fpin) {
        if (window.Android) {
            try {
                fpin = window.Android.getFPin();
            } catch (error) {

            }
        } else {
            fpin = '';
        }
    }
    dataFiltered.forEach((element, i) => {
        var size = 1;
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
                '<div class="inner" onclick="location.href=\'timeline?store_id=' + element.STORE_CODE + (fpin ? ('&f_pin=' + fpin) : '') + '#product-' + element.CODE + '\';">' +
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
        setTimeout(() => {
            $(this).carousel('next');
        }, Math.floor(Math.random() * (1000)) + 1000);
    });
    checkVideoCarousel();
    checkCarousel();
    correctVideoCrop();
    correctImageCrop();
};

function correctVideoCrop() {
    var videos = document.querySelectorAll("video.content-image");
    videos.forEach(function (elem) {
        elem.addEventListener("loadedmetadata", function () {
            if (elem.videoWidth > elem.videoHeight || elem.videoWidth == elem.videoHeight) {
                elem.classList.add("landscape");
            }
        })
    })
}

function correctImageCrop() {
    var images = document.querySelectorAll("img.content-image");
    images.forEach(function (elem) {
        elem.addEventListener("load", function () {
            if (elem.width > elem.height || elem.width == elem.height) {
                elem.classList.add("landscape");
            }
        })
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
function checkCarousel() {
    $('.carousel').each(function () {
        if ($(this).is(":in-viewport")) {
            if (!visibleCarousel.has($(this).attr('id'))) {
                visibleCarousel.add($(this).attr('id'));
                $(this).carousel('cycle');
            }
        } else {
            if (visibleCarousel.has($(this).attr('id'))) {
                visibleCarousel.delete($(this).attr('id'));
                $(this).carousel('pause');
            }
        }
    });
}

// window.onscroll = function () {
//     scrollFunction();
//     checkVideoCarousel();
// };

function scrollFunction() {
    if ($(document).scrollTop() > 20) {
        $("#scroll-top").css('display', 'block');
    } else {
        $("#scroll-top").css('display', 'none');
    }
}

function topFunction() {
    $(document).scrollTop(0);
}

var storeData = null;

function openStore($store_code, $store_link) {
    if (window.Android) {
        if (storeData) {
            window.Android.openStore(storeData);
        }
    } else {
        window.location.href = $store_link;
    }
}

function fetchStoreData() {
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function () {
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
            let dataStore = JSON.parse(xmlHttp.responseText);
            storeData = JSON.stringify(dataStore[0]);

            try {
                if (window.Android) {
                    window.Android.setCurrentStoreData(storeData);
                }
            } catch (err) {
                console.log(err);
            }
        }
    }
    xmlHttp.open("get", "/persib_web/logics/fetch_stores_specific?store_id=" + store_code);
    xmlHttp.send();
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

function goBack() {
    if (window.Android) {
        window.Android.closeView();
    } else {
        window.history.back();
    }
}

$(function () {
    fetchStoreData();
    fetchProducts();
    // fillGridStack('#content-grid');
    PullToRefresh.init({
        mainElement: '#timeline',
        onRefresh: function () {
            window.location.reload();
        }
    });

    let prevStore = sessionStorage.getItem("currentStore");
    let curStore = new URLSearchParams(window.location.search).get("store_id");
    sessionStorage.setItem("currentStore", curStore);

    if (prevStore != curStore || prevStore == null) {
        sessionStorage.setItem("profileTabPos", 0);
        $(".tab-pane#timeline").addClass("show active");
        $(".nav-link#timeline-tab").addClass("active");
        $(".tab-pane#profile").removeClass("show active");
        $(".nav-link#profile-tab").removeClass("active");
    } else {
        let profileTabPos = sessionStorage.getItem("profileTabPos");
        if (profileTabPos != null) {
            if (profileTabPos == 0) {
                $(".tab-pane#timeline").addClass("show active");
                $(".nav-link#timeline-tab").addClass("active");
                $(".tab-pane#profile").removeClass("show active");
                $(".nav-link#profile-tab").removeClass("active");
            } else {
                $(".tab-pane#timeline").removeClass("show active");
                $(".nav-link#timeline-tab").removeClass("active");
                $(".tab-pane#profile").addClass("show active");
                $(".nav-link#profile-tab").addClass("active");
            }
        } else {
            // console.log("no pos set");
            $(".tab-pane#timeline").addClass("show active");
            $(".nav-link#timeline-tab").addClass("active");
            $(".tab-pane#profile").removeClass("show active");
            $(".nav-link#profile-tab").removeClass("active");
        }
    }

    if (window.Android) {
        window.Android.setCurrentStore(store_code, be_id);

        var isInternal = false;
        try {
            isInternal = window.Android.getIsInternal();
        } catch (error) {
        }

        if (isInternal) {
            $("#gear").removeClass("d-none");
            $('#header').click(function () {
                if (window.Android) {
                    let curStore = new URLSearchParams(window.location.search).get("store_id");
                    window.Android.openStoreAdminMenu(curStore);
                }
            });
        } else {
            $("#gear").addClass("d-none");
        }
    }
});

$(".nav-link#timeline-tab").click(function () {
    sessionStorage.setItem("profileTabPos", 0);
});

$(".nav-link#profile-tab").click(function () {
    sessionStorage.setItem("profileTabPos", 1);
});

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
            
            try {
                if (window.Android) {
                    window.Android.setCurrentProductsData(xmlHttp.responseText);
                }
            } catch (err) {
                console.log(err);
            }
        }
    }
    xmlHttp.open("get", "/persib_web/logics/fetch_products?store_id=" + store_id);
    xmlHttp.send();
}


function changeStoreSettings($newSettings) {
    let dataStoreSettings = JSON.parse($newSettings);

    if (dataStoreSettings.STORE == null || dataStoreSettings.IS_SHOW == null) {
        showAlert("Gagal mengubah pengaturan. Coba lagi nanti.")
        return;
    }

    $store_code = dataStoreSettings.STORE;
    $is_show = dataStoreSettings.IS_SHOW;

    var formData = new FormData();

    formData.append('store_code', $store_code);
    formData.append('is_show', $is_show);

    if ($store_code) {
        let xmlHttp = new XMLHttpRequest();
        xmlHttp.onreadystatechange = function () {
            if (xmlHttp.readyState == 4) {
                if (xmlHttp.status == 200) {
                    showAlert("Berhasil mengubah pengaturan.");
                    fetchStoreData();
                } else {
                    showAlert("Gagal mengubah pengaturan. Coba lagi nanti.");
                }
            }
        }
        xmlHttp.open("post", "/persib_web/logics/change_store_settings");
        xmlHttp.send(formData);
    }
}

function changeStoreShowcaseSettings($newSettings) {
    $dataShowcaseSettings = JSON.parse($newSettings);

    if ($dataShowcaseSettings == null) {
        showAlert("Gagal mengubah pengaturan. Coba lagi nanti.")
        return;
    }

    var settingsData = "";
    $dataShowcaseSettings.forEach(store_setting => {
        var storeSettingsData = "".concat(store_setting["PRODUCT_CODE"],"~",store_setting["IS_SHOW"]);
        if(settingsData == ""){
            settingsData = storeSettingsData;
        } else {
            settingsData = settingsData.concat(",",storeSettingsData);
        }
    });

    var formData = new FormData();

    formData.append('settings_data', settingsData);

    let xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function () {
        if (xmlHttp.readyState == 4) {
            console.log(xmlHttp.responseText);
            if (xmlHttp.status == 200) {
                showAlert("Berhasil mengubah pengaturan.");
                fetchProducts();
            } else {
                showAlert("Gagal mengubah pengaturan. Coba lagi nanti.");
            }
        }
    }
    xmlHttp.open("post", "/persib_web/logics/change_store_showcase_settings");
    xmlHttp.send(formData);
}

function showAlert(word) {
    if (window.Android) {
        window.Android.showAlert(word);
    } else {
        console.log(word);
    }
}