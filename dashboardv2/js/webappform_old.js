$('#choose-certificate-details').hide();
$('#generate-apk-form').hide();
$('#cert-existing').hide();
$('#dont-have-certificate').hide();
$('#edit-tabs').hide();

$('#generate-apk').click(function () {
    console.log('generate');
    let checkBox = document.getElementById("generate-apk");
    let checkBox_edit = document.getElementById("edit-apk");
    if (checkBox.checked == true) {
        // choose_cert.classList.remove("d-none");
        // apk_form.classList.remove("d-none");
        checkBox_edit.checked = false;
        $('#edit-tabs').hide();
        $('#choose-certificate-details').show();
        $('#generate-apk-form').show();
        $('#generate-apk-form #appId').prop('required', true);
        $('#generate-apk-form #companyName').prop('required', true);
    } else {
        // choose_cert.classList.add("d-none");
        // apk_form.classList.add("d-none");
        $('#choose-certificate-details').hide();
        $('#generate-apk-form').hide();
        $('#cert-existing').hide();
        $('#dont-have-certificate').hide();
        $('#generate-apk-form #appId').prop('required', false);
        $('#generate-apk-form #companyName').prop('required', false);
    }
})

$('#edit-apk').click(function () {
    console.log('edit');
    let checkBox_edit = document.getElementById("edit-apk");
    let checkBox = document.getElementById("generate-apk");
    if (checkBox_edit.checked == true) {
        checkBox.checked = false;
        $('#edit-tabs').show();
        $('#choose-certificate-details').hide();
        $('#generate-apk-form').hide();
        $('#cert-existing').hide();
        $('#dont-have-certificate').hide();
        $('#generate-apk-form #appId').prop('required', false);
        $('#generate-apk-form #companyName').prop('required', false);
    } else {
        $('#edit-tabs').hide();
    }
})

let radioCertif;

function checkCertif() {
    radioCertif = document.querySelector('input[name="check-certif"]:checked').value;
    // // let have_certif = document.getElementById("have-certificate");
    let dont_have_certif = document.getElementById("dont-have-certificate");
    let cert_existing = document.getElementById("cert-existing");

    if (radioCertif == 0) {
        // cert_existing.classList.add("d-none");
        // dont_have_certif.classList.add("d-none");
        $('#cert-existing').hide();
        $('#dont-have-certificate').hide();
    } else if (radioCertif == 1) {
        // cert_existing.classList.remove("d-none");
        // dont_have_certif.classList.add("d-none");
        $('#cert-existing').show();
        $('#dont-have-certificate').hide();
    } else if (radioCertif == 2) {
        // cert_existing.classList.add("d-none");
        // dont_have_certif.classList.remove("d-none");
        $('#cert-existing').hide();
        $('#dont-have-certificate').show();
    }
}

function checkWebview(elementID) {
    var elt = document.getElementById(elementID);
    var valCounter = {};
    // so that it allows form submission again;

    console.log('url', document.getElementById('url_content').value);

    var othercodes = [
        document.getElementById('url_content').value,
        document.getElementById('tab3_mode').value,
    ];
    for (var i = 0; i <= 1; i++) {
        var c = valCounter[othercodes[i]] = (valCounter[othercodes[i]] || 0) + 1;
        if (c > 1 && othercodes[i] != "" && (parseInt(valCounter[othercodes[i]]) == 0 || parseInt(valCounter[othercodes[i]]) == 1 || parseInt(valCounter[othercodes[i]]) == 2 || parseInt(valCounter[othercodes[i]]) == 3)) {
            console.log('webview', valCounter);
            document.getElementById("submit-form").setAttribute("disabled", "disabled");
            // so that it stops form submission;
            // document.getElementById("notification").innerHTML = elt.options[elt.selectedIndex].text + " Subject Already Choosen!";
            alert("You selected duplicate tab contents.");
        }
    }

    // document.getElementById("notification").innerHTML = "";
    document.getElementById("submit-form").removeAttribute("disabled");
}

function checkWebviewEdit(elementID) {
    var elt = document.getElementById(elementID);
    var valCounter = {};
    // so that it allows form submission again;

    // console.log('url',  document.getElementById('edit_url_content').value);

    var othercodes = [
        document.getElementById('edit_url_content').value,
        document.getElementById('edit_tab3_mode').value,
    ];
    for (var i = 0; i <= 1; i++) {
        var c = valCounter[othercodes[i]] = (valCounter[othercodes[i]] || 0) + 1;
        if (c > 1 && othercodes[i] != "" && (parseInt(valCounter[othercodes[i]]) == 0 || parseInt(valCounter[othercodes[i]]) == 1 || parseInt(valCounter[othercodes[i]]) == 2 || parseInt(valCounter[othercodes[i]]) == 3)) {
            console.log('webview', valCounter);
            document.getElementById("submit-form").setAttribute("disabled", "disabled");
            // so that it stops form submission;
            // document.getElementById("notification").innerHTML = elt.options[elt.selectedIndex].text + " Subject Already Choosen!";
            alert("You selected duplicate tab contents.");
        }
    }

    // document.getElementById("notification").innerHTML = "";
    document.getElementById("submit-form").removeAttribute("disabled");
}

function checkOpt(elementID) {
    var elt = document.getElementById(elementID);
    var valCounter = {};
    // so that it allows form submission again;

    let value = document.getElementById(elementID).value;

    console.log(elementID + ', ' + value);

    let fillURL = document.getElementById(elementID + '_url_row');

    var othercodes = [
        document.getElementById('tab1').value,
        document.getElementById('tab2').value,
        document.getElementById('tab3').value,
        document.getElementById('tab4').value,
    ];
    for (var i = 0; i <= 3; i++) {
        var c = valCounter[othercodes[i]] = (valCounter[othercodes[i]] || 0) + 1;
        if (c > 1 && othercodes[i] != "") {

            console.log('tabs', valCounter);
            document.getElementById("submit-form").setAttribute("disabled", "disabled");
            // so that it stops form submission;
            // document.getElementById("notification").innerHTML = elt.options[elt.selectedIndex].text + " Subject Already Choosen!";
            alert("You selected duplicate tab contents.");
            fillURL.innerHTML = '';

            fillURL.classList.add('d-none');
            return false;
        }
    }
    let inputFile = document.getElementById(elementID + '_icon');

    if (elt.value == "") {
        inputFile.setAttribute("disabled", true);
    } else {
        inputFile.removeAttribute("disabled");
    }
    // document.getElementById("notification").innerHTML = "";
    document.getElementById("submit-form").removeAttribute("disabled");

    // value == 1 -> ada insert url
    // value == 3 -> cuma pilih timeline/mixed/grid/commerce
    if (value == 1) {
        // fillURL.classList.remove('d-none');
        let inputhtml = `
            <label class="col-sm-4 col-form-label" for="url_content">Content :</label>

            <div class="col-sm-8">
                <input type="text" list="cars" id="url_content" class="form-control" placeholder="'www.example.com' or pick existing options" class="form-control mb-1" name="url_content" onchange="checkWebview(this.id);">
                <datalist id="cars">
                    <option value="0">Timeline content</option>
                    <option value="1">Grid content</option>
                    <option value="2">Mixed content</option>
                    <option value="3">E-commerce</option>
                </datalist>
            </div>
            `;

        fillURL.innerHTML = inputhtml;

        fillURL.classList.remove('d-none');
    } else if (value == 3) {
        let inputhtml = `
            <label class="col-sm-4 col-form-label" for="tab3_mode">Content :</label>

            <div class="col-sm-8">
            <input type="text" list="cars" id="tab3_mode" class="form-control" placeholder="'www.example.com' or pick existing options" class="form-control mb-1" name="url_content" onchange="checkWebview(this.id);">
            <datalist id="cars">
                <option value="0">Timeline content</option>
                <option value="1">Grid content</option>
                <option value="2">Mixed content</option>
                <option value="3">E-commerce</option>
            </datalist>
            </div>
            `;
        fillURL.innerHTML = inputhtml;
        fillURL.classList.remove('d-none');
    } else {
        // 
        fillURL.innerHTML = '';
        fillURL.classList.add('d-none');
    }
}

function checkOptEdit(elementID) {
    var elt = document.getElementById(elementID);
    var valCounter = {};

    let value = document.getElementById(elementID).value;

    console.log(elementID + ', ' + value);

    let fillURL = document.getElementById(elementID + '_url_row');

    var othercodes = [
        document.getElementById('tab1_edit').value,
        document.getElementById('tab2_edit').value,
        document.getElementById('tab3_edit').value,
        document.getElementById('tab4_edit').value,
    ];
    for (var i = 0; i <= 3; i++) {
        var c = valCounter[othercodes[i]] = (valCounter[othercodes[i]] || 0) + 1;
        if (c > 1 && othercodes[i] != "") {
            document.getElementById("submit-form").setAttribute("disabled", "disabled");
            // so that it stops form submission;
            // document.getElementById("notification").innerHTML = elt.options[elt.selectedIndex].text + " Subject Already Choosen!";
            alert("You selected duplicate tab contents.");
            return false;
        }
    }
    // document.getElementById("notification").innerHTML = "";
    document.getElementById("submit-form").removeAttribute("disabled");
    // so that it allows form submission again;

    if (value == 1) {
        // fillURL.classList.remove('d-none');
        let inputhtml = `
            <label class="col-sm-2 col-form-label" for="edit_url_content">Content :</label>

            <div class="col-sm-5">
                <input type="text" list="cars" id="edit_url_content" class="form-control" placeholder="'www.example.com' or pick existing options" class="form-control mb-1" name="edit_url_content" onchange="checkWebviewEdit(this.id);">
                <datalist id="cars">
                    <option value="0">Timeline content</option>
                    <option value="1">Grid content</option>
                    <option value="2">Mixed content</option>
                    <option value="3">E-commerce</option>
                </datalist>
            </div>
            `;

        fillURL.innerHTML = inputhtml;

        fillURL.classList.remove('d-none');
    } else if (value == 3) {
        let inputhtml = `
            <label class="col-sm-2 col-form-label" for="edit_tab3_mode">Content :</label>

            <div class="col-sm-5">
            <input type="text" list="cars" id="edit_tab3_mode" class="form-control" placeholder="'www.example.com' or pick existing options" class="form-control mb-1" name="url_content" onchange="checkWebviewEdit(this.id);">
            <datalist id="cars">
                <option value="0">Timeline content</option>
                <option value="1">Grid content</option>
                <option value="2">Mixed content</option>
                <option value="3">E-commerce</option>
            </datalist>
            </div>
            `;
        fillURL.innerHTML = inputhtml;
        fillURL.classList.remove('d-none');
    } else {
        // 
        fillURL.innerHTML = '';
        fillURL.classList.add('d-none');
    }
}

$('#ver_name').on('input', function () {
    let rgx = /^[\.0-9]*$/;
    let str = $(this).val();
    if (!rgx.test(str)) {
        document.getElementById("submit-form").setAttribute("disabled", "disabled");
        $('#ver_name_format').removeClass("d-none");
    } else {
        document.getElementById("submit-form").removeAttribute("disabled");
        $('#ver_name_format').addClass("d-none");
    }
});

// $('select.tab-content').each(function() {

// })

$('button#submit-form').click(function () {
    // if (!$(this).is(':disabled')) {
    //     // $('#warningModal').modal('show');
    // }
})


// function existCertificate() {
//     if (checkBoxExist.checked == true) {

//     }
// }

// function newCertificate() {

//     if (checkBoxCertif.checked == true) {
//         // have_certif.classList.add("d-none");
//         cert_existing.classList.add("d-none");
//         dont_have_certif.classList.remove("d-none");

//     } else {
//         // have_certif.classList.remove("d-none");
//         cert_existing.classList.remove("d-none");
//         dont_have_certif.classList.add("d-none");

//     }
// }
// script paling bawah
document.addEventListener('DOMContentLoaded', function () {
    $('a.nav-link[href="billpayment.php"]').removeClass('active');
    $('a.nav-link[href="index.php"]').removeClass('active');
    $('a.nav-link[href="usage.php"]').removeClass('active');
    $('a.nav-link[href="support.php"]').removeClass('active');
    $('a.nav-link[href="mailbox.php"]').removeClass('active');
    $('a.nav-link[href="webappform.php"]').addClass('active');
    $('a.nav-link[href="form_management.php"]').removeClass('active');
}, false);
// var _0x5949 = ['a.nav-link[href=\x22mailbox.php\x22]', '869053cGhRlA', '21730YsPQuM', '371VJiiOA', 'a.nav-link[href=\x22usage.php\x22]', '451680guHajX', 'active', '2027duTcSS', 'removeClass', '19nNedkn', 'addClass', 'a.nav-link[href=\x22index.php\x22]', '252645UCLALp', 'a.nav-link[href=\x22billpayment.php\x22]', '407220gMJjRM', '1XRjAlx', '1202032wQQrMx'];
// var _0x3be9 = function(_0x2d15dc, _0x23667b) {
//     _0x2d15dc = _0x2d15dc - 0x98;
//     var _0x59495d = _0x5949[_0x2d15dc];
//     return _0x59495d;
// };
// var _0xeb4428 = _0x3be9;
// (function(_0x5af5ad, _0x50638f) {
//     var _0x2cbd90 = _0x3be9;
//     while (!![]) {
//         try {
//             var _0x355172 = -parseInt(_0x2cbd90(0x98)) * -parseInt(_0x2cbd90(0x9b)) + -parseInt(_0x2cbd90(0x9d)) * parseInt(_0x2cbd90(0xa1)) + -parseInt(_0x2cbd90(0x9f)) + parseInt(_0x2cbd90(0x99)) + -parseInt(_0x2cbd90(0x9c)) * parseInt(_0x2cbd90(0xa3)) + parseInt(_0x2cbd90(0xa8)) + -parseInt(_0x2cbd90(0xa6));
//             if (_0x355172 === _0x50638f) break;
//             else _0x5af5ad['push'](_0x5af5ad['shift']());
//         } catch (_0x5ceefa) {
//             _0x5af5ad['push'](_0x5af5ad['shift']());
//         }
//     }
// }(_0x5949, 0x94b45), $(_0xeb4428(0xa7))[_0xeb4428(0xa2)](_0xeb4428(0xa0)), $(_0xeb4428(0xa5))[_0xeb4428(0xa2)](_0xeb4428(0xa0)), $(_0xeb4428(0x9e))[_0xeb4428(0xa2)](_0xeb4428(0xa0)), $('a.nav-link[href=\x22support.php\x22]')[_0xeb4428(0xa4)](_0xeb4428(0xa0)), $(_0xeb4428(0x9a))['removeClass'](_0xeb4428(0xa0)));

function btnOption() {
    document.getElementById("myDropdown").classList.toggle("show");
}

window.onclick = function (event) {
    if (!event.target.matches('.dropbtn')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }
}
// $(".small-icon").hide();

// FOUR MAIN BUTTON (DOCKED)
$('#image-preview-1').hide();
$('#image-preview-2').hide();
$('#image-preview-3').hide();
$('#image-preview-4').hide();

// FIVE SMALL BUTTON (DOCKED)
$('#image-preview-5').hide();
$('#image-preview-6').hide();
$('#image-preview-7').hide();
$('#image-preview-8').hide();
$('#image-preview-9').hide();
$('#image-preview-10').hide();

// FIVE SMALL BUTTON (FLOATING & BURGER)
$('#image-preview-11').hide();
$('#image-preview-12').hide();
$('#image-preview-13').hide();
$('#image-preview-14').hide();
$('#image-preview-15').hide();
$('#image-preview-16').hide();

// FOUR MAIN BUTTON (FLOATING & BURGER)
$('#image-preview-17').hide();
$('#image-preview-18').hide();
$('#image-preview-19').hide();
$('#image-preview-20').hide();

// $("#big-icon-5").click(function(){
//     $(".small-icon").toggle();        
// });

// INPUT FILE

// FOUR MAIN BUTTON DIV (DOCKED)
var inputDragElem1 = document.getElementById('big-icon-1');
var inputDragElem2 = document.getElementById('big-icon-2');
var inputDragElem3 = document.getElementById('big-icon-3');
var inputDragElem4 = document.getElementById('big-icon-4');

// FIVE SMALL BUTTON DIV (DOCKED)
var inputDragElem5 = document.getElementById('big-icon-5');
var inputDragElem6 = document.getElementById('small-icon-1');
var inputDragElem7 = document.getElementById('small-icon-2');
var inputDragElem8 = document.getElementById('small-icon-3');
var inputDragElem9 = document.getElementById('small-icon-4');
var inputDragElem10 = document.getElementById('small-icon-5');

// FOUR MAIN BUTTON DIV (FLOATING & BURGER)
var inputDragElem11 = document.getElementById('big-icon-6');
var inputDragElem12 = document.getElementById('big-icon-7');
var inputDragElem13 = document.getElementById('big-icon-8');
var inputDragElem14 = document.getElementById('big-icon-9');

// FIVE SMALL BUTTON DIV (FLOATING & BURGER)
var inputDragElem15 = document.getElementById('floating-button');
var inputDragElem16 = document.getElementById('small-icon-6');
var inputDragElem17 = document.getElementById('small-icon-7');
var inputDragElem18 = document.getElementById('small-icon-8');
var inputDragElem19 = document.getElementById('small-icon-9');
var inputDragElem20 = document.getElementById('small-icon-10');

// FOUR MAIN BUTTON IMAGE (DOCKED)
var imagePreviewUrlElem1 = document.getElementById('image-preview-1');
var imagePreviewUrlElem2 = document.getElementById('image-preview-2');
var imagePreviewUrlElem3 = document.getElementById('image-preview-3');
var imagePreviewUrlElem4 = document.getElementById('image-preview-4');

// FIVE SMALL BUTTON IMAGE (DOCKED)
var imagePreviewUrlElem5 = document.getElementById('image-preview-5');
var imagePreviewUrlElem6 = document.getElementById('image-preview-6');
var imagePreviewUrlElem7 = document.getElementById('image-preview-7');
var imagePreviewUrlElem8 = document.getElementById('image-preview-8');
var imagePreviewUrlElem9 = document.getElementById('image-preview-9');
var imagePreviewUrlElem10 = document.getElementById('image-preview-10');

// FIVE SMALL BUTTON IMAGE (FLOATING & BURGER)
var imagePreviewUrlElem11 = document.getElementById('image-preview-11');
var imagePreviewUrlElem12 = document.getElementById('image-preview-12');
var imagePreviewUrlElem13 = document.getElementById('image-preview-13');
var imagePreviewUrlElem14 = document.getElementById('image-preview-14');
var imagePreviewUrlElem15 = document.getElementById('image-preview-15');
var imagePreviewUrlElem16 = document.getElementById('image-preview-16');

// FOUR MAIN BUTTON IMAGE (FLOATING & BURGER)
var imagePreviewUrlElem17 = document.getElementById('image-preview-17'); //6-17
var imagePreviewUrlElem18 = document.getElementById('image-preview-18'); //7-18
var imagePreviewUrlElem19 = document.getElementById('image-preview-19'); //8-19
var imagePreviewUrlElem20 = document.getElementById('image-preview-20'); //9-20

var link = new Array(); // ARRAY FOR SAVE BASE64 UPLOAD IMAGES
var switching = 0; // FOR KNOWN WHICH ITEM DRAGG FROM (EX : FROM 1 TO 2)

var preventDefault = function (event) {
    event.preventDefault();
    event.stopPropagation();
    return false;
}

// HANDLE FILE INPUT FROM DRAG PICTURES TO PHONE 

var handleDrop1 = function (event) {
    var dataTransfer = event.dataTransfer;
    var files = dataTransfer.files;

    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        var reader = new FileReader();

        reader.readAsDataURL(file);
        reader.addEventListener('loadend', function (event, file) {
            imagePreviewUrlElem1.src = this.result;
            $('#plus-1').hide();
            $('#image-preview-1').show();

            if (switching != 0 && link[1] != null) {
                $('#image-preview-' + switching).attr('src', link[1]);

                link[switching] = link[1];

            } else if (switching != 0) {
                $('#image-preview-' + switching).hide();
                $('#plus-' + switching).show();

                link[switching] = null;
            }

            link[1] = this.result;
            $('#file-1').text(this.result);
            checkFile();
            switching = 0;
        });
    }
}

var handleDrop2 = function (event) {
    var dataTransfer = event.dataTransfer;
    var files = dataTransfer.files;

    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        var reader = new FileReader();

        reader.readAsDataURL(file);
        reader.addEventListener('loadend', function (event, file) {
            imagePreviewUrlElem2.src = this.result;
            $('#plus-2').hide();
            $('#image-preview-2').show();

            if (switching != 0 && link[2] != null) {
                $('#image-preview-' + switching).attr('src', link[2]);

                link[switching] = link[2];

            } else if (switching != 0) {
                $('#image-preview-' + switching).hide();
                $('#plus-' + switching).show();

                link[switching] = null;
            }

            link[2] = this.result;
            $('#file-2').text(this.result);
            checkFile();
            switching = 0;
        });
    }
}

var handleDrop3 = function (event) {
    var dataTransfer = event.dataTransfer;
    var files = dataTransfer.files;

    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        var reader = new FileReader();

        reader.readAsDataURL(file);
        reader.addEventListener('loadend', function (event, file) {
            imagePreviewUrlElem3.src = this.result;
            $('#plus-3').hide();
            $('#image-preview-3').show();

            if (switching != 0 && link[3] != null) {
                $('#image-preview-' + switching).attr('src', link[3]);

                link[switching] = link[3];

            } else if (switching != 0) {
                $('#image-preview-' + switching).hide();
                $('#plus-' + switching).show();

                link[switching] = null;
            }

            link[3] = this.result;
            $('#file-3').text(this.result);
            checkFile();
            switching = 0;
        });
    }
}

var handleDrop4 = function (event) {
    var dataTransfer = event.dataTransfer;
    var files = dataTransfer.files;

    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        var reader = new FileReader();

        reader.readAsDataURL(file);
        reader.addEventListener('loadend', function (event, file) {
            imagePreviewUrlElem4.src = this.result;
            $('#plus-4').hide();
            $('#image-preview-4').show();

            if (switching != 0 && link[4] != null) {
                $('#image-preview-' + switching).attr('src', link[4]);

                link[switching] = link[4];

            } else if (switching != 0) {
                $('#image-preview-' + switching).hide();
                $('#plus-' + switching).show();

                link[switching] = null;
            }

            link[4] = this.result;
            $('#file-4').text(this.result);
            checkFile();
            switching = 0;
        });
    }
}

var handleDrop5 = function (event) {
    var dataTransfer = event.dataTransfer;
    var files = dataTransfer.files;

    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        var reader = new FileReader();

        reader.readAsDataURL(file);
        reader.addEventListener('loadend', function (event, file) {
            imagePreviewUrlElem5.src = this.result;
            $('#plus-5').hide();
            $('#image-preview-5').show();

            if (switching != 0 && link[5] != null) {
                $('#image-preview-' + switching).attr('src', link[5]);

                link[switching] = link[5];

            } else if (switching != 0) {
                $('#image-preview-' + switching).hide();
                $('#plus-' + switching).show();

                link[switching] = null;
            }

            link[5] = this.result;
            $('#file-5').text(this.result);
            checkFile();
            switching = 0;
        });
    }
}

var handleDrop6 = function (event) {
    var dataTransfer = event.dataTransfer;
    var files = dataTransfer.files;

    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        var reader = new FileReader();

        reader.readAsDataURL(file);
        reader.addEventListener('loadend', function (event, file) {
            imagePreviewUrlElem6.src = this.result;
            $('#plus-6').hide();
            $('#image-preview-6').show();

            if (switching != 0 && link[6] != null) {
                $('#image-preview-' + switching).attr('src', link[6]);

                link[switching] = link[6];

            } else if (switching != 0) {
                $('#image-preview-' + switching).hide();
                $('#plus-' + switching).show();

                link[switching] = null;
            }

            link[6] = this.result;
            $('#file-6').text(this.result);
            checkFile();
            switching = 0;
        });
    }
}

var handleDrop7 = function (event) {
    var dataTransfer = event.dataTransfer;
    var files = dataTransfer.files;

    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        var reader = new FileReader();

        reader.readAsDataURL(file);
        reader.addEventListener('loadend', function (event, file) {
            imagePreviewUrlElem7.src = this.result;
            $('#plus-7').hide();
            $('#image-preview-7').show();

            if (switching != 0 && link[7] != null) {
                $('#image-preview-' + switching).attr('src', link[7]);

                link[switching] = link[7];

            } else if (switching != 0) {
                $('#image-preview-' + switching).hide();
                $('#plus-' + switching).show();

                link[switching] = null;
            }

            link[7] = this.result;
            $('#file-7').text(this.result);
            checkFile();
            switching = 0;
        });
    }
}

var handleDrop8 = function (event) {
    var dataTransfer = event.dataTransfer;
    var files = dataTransfer.files;

    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        var reader = new FileReader();

        reader.readAsDataURL(file);
        reader.addEventListener('loadend', function (event, file) {
            imagePreviewUrlElem8.src = this.result;
            $('#plus-8').hide();
            $('#image-preview-8').show();

            if (switching != 0 && link[8] != null) {
                $('#image-preview-' + switching).attr('src', link[8]);

                link[switching] = link[8];

            } else if (switching != 0) {
                $('#image-preview-' + switching).hide();
                $('#plus-' + switching).show();

                link[switching] = null;
            }

            link[8] = this.result;
            $('#file-8').text(this.result);
            checkFile();
            switching = 0;
        });
    }
}

var handleDrop9 = function (event) {
    var dataTransfer = event.dataTransfer;
    var files = dataTransfer.files;

    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        var reader = new FileReader();

        reader.readAsDataURL(file);
        reader.addEventListener('loadend', function (event, file) {
            imagePreviewUrlElem9.src = this.result;
            $('#plus-9').hide();
            $('#image-preview-9').show();

            if (switching != 0 && link[9] != null) {
                $('#image-preview-' + switching).attr('src', link[9]);

                link[switching] = link[9];

            } else if (switching != 0) {
                $('#image-preview-' + switching).hide();
                $('#plus-' + switching).show();

                link[switching] = null;
            }

            link[9] = this.result;
            $('#file-9').text(this.result);
            checkFile();
            switching = 0;
        });
    }
}

var handleDrop10 = function (event) {
    var dataTransfer = event.dataTransfer;
    var files = dataTransfer.files;

    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        var reader = new FileReader();

        reader.readAsDataURL(file);
        reader.addEventListener('loadend', function (event, file) {
            imagePreviewUrlElem10.src = this.result;
            $('#plus-10').hide();
            $('#image-preview-10').show();

            if (switching != 0 && link[10] != null) {
                $('#image-preview-' + switching).attr('src', link[10]);

                link[switching] = link[10];

            } else if (switching != 0) {
                $('#image-preview-' + switching).hide();
                $('#plus-' + switching).show();

                link[switching] = null;
            }

            link[10] = this.result;
            $('#file-10').text(this.result);
            checkFile();
            switching = 0;
        });
    }
}

var handleDrop11 = function (event) {
    var dataTransfer = event.dataTransfer;
    var files = dataTransfer.files;

    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        var reader = new FileReader();

        reader.readAsDataURL(file);
        reader.addEventListener('loadend', function (event, file) {
            imagePreviewUrlElem17.src = this.result;
            $('#plus-17').hide();
            $('#image-preview-17').show();

            if (switching != 0 && link[17] != null) {
                $('#image-preview-' + switching).attr('src', link[17]);

                link[switching] = link[17];

            } else if (switching != 0) {
                $('#image-preview-' + switching).hide();
                $('#plus-' + switching).show();

                link[switching] = null;
            }

            link[17] = this.result;
            $('#file-17').text(this.result);
            checkFile();
            switching = 0;
        });
    }
}

var handleDrop12 = function (event) {
    var dataTransfer = event.dataTransfer;
    var files = dataTransfer.files;


    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        var reader = new FileReader();

        reader.readAsDataURL(file);
        reader.addEventListener('loadend', function (event, file) {
            imagePreviewUrlElem18.src = this.result;
            $('#plus-18').hide();
            $('#image-preview-18').show();

            if (switching != 0 && link[18] != null) {
                $('#image-preview-' + switching).attr('src', link[18]);

                link[switching] = link[18];

            } else if (switching != 0) {
                $('#image-preview-' + switching).hide();
                $('#plus-' + switching).show();

                link[switching] = null;
            }

            link[18] = this.result;
            $('#file-18').text(this.result);
            checkFile();
            switching = 0;
        });
    }
}

var handleDrop13 = function (event) {
    var dataTransfer = event.dataTransfer;
    var files = dataTransfer.files;

    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        var reader = new FileReader();

        reader.readAsDataURL(file);
        reader.addEventListener('loadend', function (event, file) {
            imagePreviewUrlElem19.src = this.result;
            $('#plus-19').hide();
            $('#image-preview-19').show();

            if (switching != 0 && link[19] != null) {
                $('#image-preview-' + switching).attr('src', link[19]);

                link[switching] = link[19];

            } else if (switching != 0) {
                $('#image-preview-' + switching).hide();
                $('#plus-' + switching).show();

                link[switching] = null;
            }

            link[19] = this.result;
            $('#file-19').text(this.result);
            checkFile();
            switching = 0;
        });
    }
}

var handleDrop14 = function (event) {
    var dataTransfer = event.dataTransfer;
    var files = dataTransfer.files;

    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        var reader = new FileReader();

        reader.readAsDataURL(file);
        reader.addEventListener('loadend', function (event, file) {
            imagePreviewUrlElem20.src = this.result;
            $('#plus-20').hide();
            $('#image-preview-20').show();

            if (switching != 0 && link[20] != null) {
                $('#image-preview-' + switching).attr('src', link[20]);

                link[switching] = link[20];

            } else if (switching != 0) {
                $('#image-preview-' + switching).hide();
                $('#plus-' + switching).show();

                link[switching] = null;
            }

            link[20] = this.result;
            $('#file-20').text(this.result);
            checkFile();
            switching = 0;
        });
    }
}

var handleDrop15 = function (event) {
    var dataTransfer = event.dataTransfer;
    var files = dataTransfer.files;

    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        var reader = new FileReader();

        reader.readAsDataURL(file);
        reader.addEventListener('loadend', function (event, file) {
            imagePreviewUrlElem11.src = this.result;
            $('#plus-11').hide();
            $('#image-preview-11').show();

            if (switching != 0 && link[11] != null) {
                $('#image-preview-' + switching).attr('src', link[11]);

                link[switching] = link[11];

            } else if (switching != 0) {
                $('#image-preview-' + switching).hide();
                $('#plus-' + switching).show();

                link[switching] = null;
            }

            link[11] = this.result;
            $('#file-11').text(this.result);
            checkFile();
            switching = 0;
        });
    }
}

var handleDrop16 = function (event) {
    var dataTransfer = event.dataTransfer;
    var files = dataTransfer.files;

    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        var reader = new FileReader();

        reader.readAsDataURL(file);
        reader.addEventListener('loadend', function (event, file) {
            imagePreviewUrlElem12.src = this.result;
            $('#plus-12').hide();
            $('#image-preview-12').show();

            if (switching != 0 && link[12] != null) {
                $('#image-preview-' + switching).attr('src', link[12]);

                link[switching] = link[12];

            } else if (switching != 0) {
                $('#image-preview-' + switching).hide();
                $('#plus-' + switching).show();

                link[switching] = null;
            }

            link[12] = this.result;
            $('#file-12').text(this.result);
            checkFile();
            switching = 0;
        });
    }
}

var handleDrop17 = function (event) {
    var dataTransfer = event.dataTransfer;
    var files = dataTransfer.files;

    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        var reader = new FileReader();

        reader.readAsDataURL(file);
        reader.addEventListener('loadend', function (event, file) {
            imagePreviewUrlElem13.src = this.result;
            $('#plus-13').hide();
            $('#image-preview-13').show();

            if (switching != 0 && link[13] != null) {
                $('#image-preview-' + switching).attr('src', link[13]);

                link[switching] = link[13];

            } else if (switching != 0) {
                $('#image-preview-' + switching).hide();
                $('#plus-' + switching).show();

                link[switching] = null;
            }

            link[13] = this.result;
            $('#file-13').text(this.result);
            checkFile();
            switching = 0;
        });
    }
}

var handleDrop18 = function (event) {
    var dataTransfer = event.dataTransfer;
    var files = dataTransfer.files;

    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        var reader = new FileReader();

        reader.readAsDataURL(file);
        reader.addEventListener('loadend', function (event, file) {
            imagePreviewUrlElem14.src = this.result;
            $('#plus-14').hide();
            $('#image-preview-14').show();

            if (switching != 0 && link[14] != null) {
                $('#image-preview-' + switching).attr('src', link[14]);

                link[switching] = link[14];

            } else if (switching != 0) {
                $('#image-preview-' + switching).hide();
                $('#plus-' + switching).show();

                link[switching] = null;
            }

            link[14] = this.result;
            $('#file-14').text(this.result);
            checkFile();
            switching = 0;
        });
    }
}

var handleDrop19 = function (event) {
    var dataTransfer = event.dataTransfer;
    var files = dataTransfer.files;

    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        var reader = new FileReader();

        reader.readAsDataURL(file);
        reader.addEventListener('loadend', function (event, file) {
            imagePreviewUrlElem15.src = this.result;
            $('#plus-15').hide();
            $('#image-preview-15').show();

            if (switching != 0 && link[15] != null) {
                $('#image-preview-' + switching).attr('src', link[15]);

                link[switching] = link[15];

            } else if (switching != 0) {
                $('#image-preview-' + switching).hide();
                $('#plus-' + switching).show();

                link[switching] = null;
            }

            link[15] = this.result;
            $('#file-15').text(this.result);
            checkFile();
            switching = 0;
        });
    }
}

var handleDrop20 = function (event) {
    var dataTransfer = event.dataTransfer;
    var files = dataTransfer.files;

    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        var reader = new FileReader();

        reader.readAsDataURL(file);
        reader.addEventListener('loadend', function (event, file) {
            imagePreviewUrlElem16.src = this.result;
            $('#plus-16').hide();
            $('#image-preview-16').show();

            if (switching != 0 && link[16] != null) {
                $('#image-preview-' + switching).attr('src', link[16]);

                link[switching] = link[16];

            } else if (switching != 0) {
                $('#image-preview-' + switching).hide();
                $('#plus-' + switching).show();

                link[switching] = null;
            }

            link[16] = this.result;
            $('#file-16').text(this.result);
            checkFile();
            switching = 0;
        });
    }
}

inputDragElem1.addEventListener('dragstart', function (event) {

    switching = 1;
    console.log(switching);

}, false);

inputDragElem1.addEventListener('dragover', function (event) {

    preventDefault(event);
    clearBorder();
    $('#big-icon-1').css('background-color', '#f2ad33');

});

inputDragElem1.addEventListener('dragenter', preventDefault);
inputDragElem1.addEventListener('drop', function (event) {

    preventDefault(event);
    handleDrop1(event);
    clearBlur();
    clearBorder();

    // switching = 0;

}, false);

inputDragElem2.addEventListener('dragstart', function (event) {

    switching = 2;
    console.log(switching);

}, false);

inputDragElem2.addEventListener('dragover', function (event) {

    preventDefault(event);
    clearBorder();
    $('#big-icon-2').css('background-color', '#f2ad33');

});

inputDragElem2.addEventListener('dragenter', preventDefault);
inputDragElem2.addEventListener('drop', function (event) {

    preventDefault(event);
    handleDrop2(event);
    clearBlur();
    clearBorder();

    // switching = 0;

}, false);

inputDragElem3.addEventListener('dragstart', function (event) {

    switching = 3;
    console.log(switching);

}, false);

inputDragElem3.addEventListener('dragover', function (event) {

    preventDefault(event);
    clearBorder();
    $('#big-icon-3').css('background-color', '#f2ad33');

});

inputDragElem3.addEventListener('dragenter', preventDefault);
inputDragElem3.addEventListener('drop', function (event) {

    preventDefault(event);
    handleDrop3(event);
    clearBlur();
    clearBorder();

    // switching = 0;

}, false);

inputDragElem4.addEventListener('dragstart', function (event) {

    switching = 4;
    console.log(switching);

}, false);

inputDragElem4.addEventListener('dragover', function (event) {

    preventDefault(event);
    clearBorder();
    $('#big-icon-4').css('background-color', '#f2ad33');

});

inputDragElem4.addEventListener('dragenter', preventDefault);
inputDragElem4.addEventListener('drop', function (event) {

    preventDefault(event);
    handleDrop4(event);
    clearBlur();
    clearBorder();

    // switching = 0;

}, false);

inputDragElem5.addEventListener('dragstart', function (event) {

    switching = 5;
    console.log(switching);

}, false);

inputDragElem5.addEventListener('dragover', function (event) {

    preventDefault(event);
    clearBorder();
    $('#main-center').css('background-color', '#f2ad33');

});
inputDragElem5.addEventListener('dragenter', preventDefault);
inputDragElem5.addEventListener('drop', function (event) {

    preventDefault(event);
    handleDrop5(event);
    clearBlur();
    clearBorder();

    // switching = 0;

}, false);

inputDragElem6.addEventListener('dragstart', function (event) {

    switching = 6;
    console.log(switching);

}, false);

inputDragElem6.addEventListener('dragover', function (event) {

    preventDefault(event);
    clearBorder();
    $('#small-icon-1').css('background-color', '#f2ad33');

});

inputDragElem6.addEventListener('dragenter', preventDefault);
inputDragElem6.addEventListener('drop', function (event) {

    preventDefault(event);
    handleDrop6(event);
    clearBlur();
    clearBorder();

    // switching = 0;

}, false);

inputDragElem7.addEventListener('dragstart', function (event) {

    switching = 7;
    console.log(switching);

}, false);

inputDragElem7.addEventListener('dragover', function (event) {

    preventDefault(event);
    clearBorder();
    $('#small-icon-2').css('background-color', '#f2ad33');

});
inputDragElem7.addEventListener('dragenter', preventDefault);
inputDragElem7.addEventListener('drop', function (event) {

    preventDefault(event);
    handleDrop7(event);
    clearBlur();
    clearBorder();

    // switching = 0;

}, false);

inputDragElem8.addEventListener('dragstart', function (event) {

    switching = 8;
    console.log(switching);

}, false);

inputDragElem8.addEventListener('dragover', function (event) {

    preventDefault(event);
    clearBorder();
    $('#small-icon-3').css('background-color', '#f2ad33');

});

inputDragElem8.addEventListener('dragenter', preventDefault);
inputDragElem8.addEventListener('drop', function (event) {

    preventDefault(event);
    handleDrop8(event);
    clearBlur();
    clearBorder();

    // switching = 0;

}, false);

inputDragElem9.addEventListener('dragstart', function (event) {

    switching = 9;
    console.log(switching);

}, false);

inputDragElem9.addEventListener('dragover', function (event) {

    preventDefault(event);
    clearBorder();
    $('#small-icon-4').css('background-color', '#f2ad33');

});

inputDragElem9.addEventListener('dragenter', preventDefault);
inputDragElem9.addEventListener('drop', function (event) {

    preventDefault(event);
    handleDrop9(event);
    clearBlur();
    clearBorder();

    // switching = 0;

}, false);

inputDragElem10.addEventListener('dragstart', function (event) {

    switching = 10;
    console.log(switching);

}, false);

inputDragElem10.addEventListener('dragover', function (event) {

    preventDefault(event);
    clearBorder();
    $('#small-icon-5').css('background-color', '#f2ad33');

});

inputDragElem10.addEventListener('dragenter', preventDefault);
inputDragElem10.addEventListener('drop', function (event) {

    preventDefault(event);
    handleDrop10(event);
    clearBlur();
    clearBorder();

    // switching = 0;

}, false);

inputDragElem11.addEventListener('dragstart', function (event) {

    switching = 17;
    console.log(switching);

}, false);

inputDragElem11.addEventListener('dragover', function (event) {

    preventDefault(event);
    clearBorder();
    $('#big-icon-6').css('background-color', '#f2ad33');

});

inputDragElem11.addEventListener('dragenter', preventDefault);
inputDragElem11.addEventListener('drop', function (event) {

    preventDefault(event);
    handleDrop11(event);
    clearBlur();
    clearBorder();

    // switching = 0;

}, false);

inputDragElem12.addEventListener('dragstart', function (event) {

    switching = 18;
    console.log(switching);

}, false);

inputDragElem12.addEventListener('dragover', function (event) {

    preventDefault(event);
    clearBorder();
    $('#big-icon-7').css('background-color', '#f2ad33');

});

inputDragElem12.addEventListener('dragenter', preventDefault);
inputDragElem12.addEventListener('drop', function (event) {

    preventDefault(event);
    handleDrop12(event);
    clearBlur();
    clearBorder();

    // switching = 0;

}, false);

inputDragElem13.addEventListener('dragstart', function (event) {

    switching = 19;
    console.log(switching);

}, false);

inputDragElem13.addEventListener('dragover', function (event) {

    preventDefault(event);
    clearBorder();
    $('#big-icon-8').css('background-color', '#f2ad33');

});

inputDragElem13.addEventListener('dragenter', preventDefault);
inputDragElem13.addEventListener('drop', function (event) {

    preventDefault(event);
    handleDrop13(event);
    clearBlur();
    clearBorder();

    // switching = 0;

}, false);

inputDragElem14.addEventListener('dragstart', function (event) {

    switching = 20;
    console.log(switching);

}, false);

inputDragElem14.addEventListener('dragover', function (event) {

    preventDefault(event);
    clearBorder();
    $('#big-icon-9').css('background-color', '#f2ad33');

});

inputDragElem14.addEventListener('dragenter', preventDefault);
inputDragElem14.addEventListener('drop', function (event) {

    preventDefault(event);
    handleDrop14(event);
    clearBlur();
    clearBorder();

    // switching = 0;

}, false);

inputDragElem15.addEventListener('dragstart', function (event) {

    switching = 11;
    console.log(switching);

}, false);

inputDragElem15.addEventListener('dragover', function (event) {

    preventDefault(event);
    clearBorder();
    $('#floating-button').css('background-color', '#f2ad33');

});

inputDragElem15.addEventListener('dragenter', preventDefault);
inputDragElem15.addEventListener('drop', function (event) {

    preventDefault(event);
    handleDrop15(event);
    clearBlur();
    clearBorder();

    // switching = 0;

}, false);

inputDragElem16.addEventListener('dragstart', function (event) {

    switching = 12;
    console.log(switching);

}, false);

inputDragElem16.addEventListener('dragover', function (event) {

    preventDefault(event);
    clearBorder();
    $('#small-icon-6').css('background-color', '#f2ad33');

});

inputDragElem16.addEventListener('dragenter', preventDefault);
inputDragElem16.addEventListener('drop', function (event) {

    preventDefault(event);
    handleDrop16(event);
    clearBlur();
    clearBorder();

    // switching = 0;

}, false);

inputDragElem17.addEventListener('dragstart', function (event) {

    switching = 13;
    console.log(switching);

}, false);

inputDragElem17.addEventListener('dragover', function (event) {

    preventDefault(event);
    clearBorder();
    $('#small-icon-7').css('background-color', '#f2ad33');

});

inputDragElem17.addEventListener('dragenter', preventDefault);
inputDragElem17.addEventListener('drop', function (event) {

    preventDefault(event);
    handleDrop17(event);
    clearBlur();
    clearBorder();

    // switching = 0;

}, false);

inputDragElem18.addEventListener('dragstart', function (event) {

    switching = 14;
    console.log(switching);

}, false);

inputDragElem18.addEventListener('dragover', function (event) {

    preventDefault(event);
    clearBorder();
    $('#small-icon-8').css('background-color', '#f2ad33');

});

inputDragElem18.addEventListener('dragenter', preventDefault);
inputDragElem18.addEventListener('drop', function (event) {

    preventDefault(event);
    handleDrop18(event);
    clearBlur();
    clearBorder();

    // switching = 0;

}, false);

inputDragElem19.addEventListener('dragstart', function (event) {

    switching = 15;
    console.log(switching);

}, false);

inputDragElem19.addEventListener('dragover', function (event) {

    preventDefault(event);
    clearBorder();
    $('#small-icon-9').css('background-color', '#f2ad33');

});

inputDragElem19.addEventListener('dragenter', preventDefault);
inputDragElem19.addEventListener('drop', function (event) {

    preventDefault(event);
    handleDrop19(event);
    clearBlur();
    clearBorder();

    // switching = 0;

}, false);

inputDragElem20.addEventListener('dragstart', function (event) {

    switching = 16;
    console.log(switching);

}, false);

inputDragElem20.addEventListener('dragover', function (event) {

    preventDefault(event);
    clearBorder();
    $('#small-icon-10').css('background-color', '#f2ad33');

});

inputDragElem20.addEventListener('dragenter', preventDefault);
inputDragElem20.addEventListener('drop', function (event) {

    preventDefault(event);
    handleDrop20(event);
    clearBlur();
    clearBorder();

    // switching = 0;

}, false);

// FOR BLUE OUTSIDE WHILE DRAGGIN PICTURES

let outside = document.getElementById('generate-apk-form');

outside.addEventListener('dragover', function (event) {
    preventDefault(event);
    $('.main-sidebar').css('opacity', '0.2');
    $('.left-side').css('opacity', '0.2');
    $('.blur').css('opacity', '0.2');
    $('#outside-text').removeClass('d-none');
});
outside.addEventListener('dragenter', preventDefault);
outside.addEventListener('drop', function (event) {
    preventDefault(event);

    $('#image-preview-' + switching).attr('src', '');
    $('#image-preview-' + switching).hide();
    $('#plus-' + switching).show();
    $('#outside-text').addClass('d-none');

    if (switching == 1) {
        link[1] = null;
    } else if (switching == 2) {
        link[2] = null;
    } else if (switching == 3) {
        link[3] = null;
    } else if (switching == 4) {
        link[4] = null;
    } else if (switching == 5) {
        link[5] = null;
    } else if (switching == 6) {
        link[6] = null;
    } else if (switching == 7) {
        link[7] = null;
    } else if (switching == 8) {
        link[8] = null;
    } else if (switching == 9) {
        link[9] = null;
    } else if (switching == 10) {
        link[10] = null;
    } else if (switching == 11) {
        link[11] = null;
    } else if (switching == 12) {
        link[12] = null;
    } else if (switching == 13) {
        link[13] = null;
    } else if (switching == 14) {
        link[14] = null;
    } else if (switching == 15) {
        link[15] = null;
    } else if (switching == 16) {
        link[16] = null;
    } else if (switching == 17) {
        link[17] = null;
    } else if (switching == 18) {
        link[18] = null;
    } else if (switching == 19) {
        link[19] = null;
    } else if (switching == 20) {
        link[20] = null;
    }

    switching = 0;
    checkFile();
    clearBlur();
    clearBorder();

}, false);

// CONSOLE.LOG AFTER DRAGGING PICTURES

var tab1 = "";
var tab2 = "";
var tab3 = "";
var tab4 = "";

var cpaas = "";
var messaging = "";
var call = "";
var contact = "";
var post = "";
var streaming = "";

var background = [];
var certificate = "";

function checkFile() {
    // console.log("Foto 1 (Homepage) = ", link[1]); // Homepage Icon
    // console.log("Foto 2 (Chats) = ", link[2]); // Chats & Groups Icon
    // console.log("Foto 3 (Content) = ", link[3]); // Content Posting Icon
    // console.log("Foto 4 (Settings) = ", link[4]); // Settings & Profile Icon

    // console.log("Foto 5 (CPAAS) = ", link[5]); // CPAAS Icon
    // console.log("Foto 6 (Messaging) = ", link[6]); // Instant Messaging Icon
    // console.log("Foto 7 (A/V Call) = ", link[7]); // A/V Call Icon
    // console.log("Foto 8 (Contact Center)= ", link[8]); // Contact Center Icon
    // console.log("Foto 9 (Streaming) = ", link[9]); // Streaming & Seminar Icon
    // console.log("Foto 10 (Post) = ", link[10]); // Create Post Icon

    // console.log("Foto 11 (CPAAS) = ", link[11]); // CPAAS Icon
    // console.log("Foto 12 (Messaging) = ", link[12]); // Instant Messaging Icon
    // console.log("Foto 13 (A/V Call) = ", link[13]); // A/V Call Icon
    // console.log("Foto 14 (Contact Center)= ", link[14]); // Contact Center Icon
    // console.log("Foto 15 (Streaming) = ", link[15]); // Streaming & Seminar Icon
    // console.log("Foto 16 (Post) = ", link[16]); // Create Post Icon

    // console.log("Foto 17 (Homepage) = ", link[17]); // Homepage Icon
    // console.log("Foto 18 (Chats) = ", link[18]); // Chats & Groups Icon
    // console.log("Foto 19 (Content) = ", link[19]); // Content Posting Icon
    // console.log("Foto 20 (Settings) = ", link[20]); // Settings & Profile Icon

    if (link[1] != null || link[17] != null) {
        if (link[1] != null) {
            tab1 = link[1];
        } else if (link[17] != null) {
            tab1 = link[17];
        }
    } else {
        tab1 = null;
    }

    if (link[2] != null || link[18] != null) {
        if (link[2] != null) {
            tab2 = link[2];
        } else if (link[18] != null) {
            tab2 = link[18];
        }
    } else {
        tab2 = null;
    }

    if (link[3] != null || link[19] != null) {
        if (link[3] != null) {
            tab3 = link[3];
        } else if (link[19] != null) {
            tab3 = link[19];
        }
    } else {
        tab3 = null;
    }

    if (link[4] != null || link[20] != null) {
        if (link[4] != null) {
            tab4 = link[4];
        } else if (link[20] != null) {
            tab4 = link[20];
        }
    } else {
        tab4 = null;
    }

    if (link[5] != null || link[11] != null) {
        if (link[5] != null) {
            cpaas = link[5];
        } else if (link[11] != null) {
            cpaas = link[11];
        }
    } else {
        cpaas = null;
    }

    if (link[10] != null || link[14] != null) {
        if (link[10] != null) {
            messaging = link[10];
        } else if (link[14] != null) {
            messaging = link[14];
        }
    } else {
        messaging = null;
    }

    if (link[9] != null || link[15] != null) {
        if (link[9] != null) {
            call = link[9];
        } else if (link[15] != null) {
            call = link[15];
        }
    } else {
        call = null;
    }

    if (link[6] != null || link[12] != null) {
        if (link[6] != null) {
            contact = link[6];
        } else if (link[12] != null) {
            contact = link[12];
        }
    } else {
        contact = null;
    }

    if (link[7] != null || link[13] != null) {
        if (link[7] != null) {
            post = link[7];
        } else if (link[13] != null) {
            post = link[13];
        }
    } else {
        post = null;
    }

    if (link[8] != null || link[16] != null) {
        if (link[8] != null) {
            streaming = link[8];
        } else if (link[16] != null) {
            streaming = link[16];
        }
    } else {
        streaming = null;
    }

    // FINAL RESULT
    // console.log("Tab 1 = ", tab1);
    // console.log("Tab 2 = ", tab2);
    // console.log("Tab 3 = ", tab3);
    // console.log("Tab 4 = ", tab4);
    // console.log("CPaaS = ", cpaas);
    // console.log("Messaging = ", messaging);
    // console.log("Call = ", call);
    // console.log("Contact = ", contact);
    // console.log("Post = ", post);
    // console.log("Streaming = ", streaming);

    // console.log("Background = ", background);
    // console.log("Certificate = ", certificate);
}

// WHEN DROP PICTURE BLUR OUTSIDE DISSAPEAR

function clearBlur() {
    $('.main-sidebar').css('opacity', '1');
    $('.left-side').css('opacity', '1');
    $('.blur').css('opacity', '1');
    $('#outside-text').addClass('d-none');
}

// WHEN DROP PICTURE BACKGROUND HIGHLIGHT DISSAPEAR

function clearBorder() {
    $('#big-icon-1').css('background-color', '#d7d7d7');
    $('#big-icon-2').css('background-color', '#d7d7d7');
    $('#big-icon-3').css('background-color', '#d7d7d7');
    $('#big-icon-4').css('background-color', '#d7d7d7');
    $('#main-center').css('background-color', 'grey');
    $('#big-icon-6').css('background-color', '#d7d7d7');
    $('#big-icon-7').css('background-color', '#d7d7d7');
    $('#big-icon-8').css('background-color', '#d7d7d7');
    $('#big-icon-9').css('background-color', '#d7d7d7');
    $('#floating-button').css('background-color', 'grey');
    $('#small-icon-1').css('background-color', '#d7d7d7');
    $('#small-icon-2').css('background-color', '#d7d7d7');
    $('#small-icon-3').css('background-color', '#d7d7d7');
    $('#small-icon-4').css('background-color', '#d7d7d7');
    $('#small-icon-5').css('background-color', '#d7d7d7');
    $('#small-icon-6').css('background-color', '#d7d7d7');
    $('#small-icon-7').css('background-color', '#d7d7d7');
    $('#small-icon-8').css('background-color', '#d7d7d7');
    $('#small-icon-9').css('background-color', '#d7d7d7');
    $('#small-icon-10').css('background-color', '#d7d7d7');
}


function btnOption() {
    document.getElementById("myDropdown").classList.toggle("show");
}

window.onclick = function (event) {
    if (!event.target.matches('.dropbtn')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }
}


$(".docked-content").hide();
$("#burger-area").hide();
$("#sub-docked-button").hide();
$("#sub-docked-button-2").hide();
$("#sub-burger-button").hide();

function selectTabMenu() {

    var menuType = $('#menuType').val();

    if (menuType == 0) {
        $("#palio-balloon").show();
        $(".docked-content").hide();
        $(".docked-content-2").show();
        $("#burger-area").hide();
        $("#sub-floating-button").show();
        $("#sub-floating-button-2").show();
        $("#sub-docked-button").hide();
        $("#sub-docked-button-2").hide();
        $("#sub-burger-button").hide();
    } else if (menuType == 1) {
        $("#palio-balloon").hide();
        $(".docked-content").show();
        $(".docked-content-2").hide();
        $("#burger-area").hide();
        $("#sub-floating-button").hide();
        $("#sub-floating-button-2").hide();
        $("#sub-docked-button").show();
        $("#sub-docked-button-2").show();
        $("#sub-burger-button").hide();
    } else {
        $("#palio-balloon").hide();
        $(".docked-content").hide();
        $(".docked-content-2").show();
        $("#burger-area").show();
        $("#sub-floating-button").hide();
        $("#sub-floating-button-2").hide();
        $("#sub-docked-button").hide();
        $("#sub-docked-button-2").hide();
        $("#sub-burger-button").show();
    }

    // CLEAR ALL IMAGES WHILE SWITCH CPAAS MODEL
    link[1] = null;
    link[2] = null;
    link[3] = null;
    link[4] = null;
    link[5] = null;
    link[6] = null;
    link[7] = null;
    link[8] = null;
    link[9] = null;
    link[10] = null;
    link[11] = null;
    link[12] = null;
    link[13] = null;
    link[14] = null;
    link[15] = null;
    link[16] = null;
    link[17] = null;
    link[18] = null;
    link[19] = null;
    link[20] = null;

    $('#image-preview-1').hide();
    $('#image-preview-1').attr('src', '');
    $('#image-preview-2').hide();
    $('#image-preview-2').attr('src', '');
    $('#image-preview-3').hide();
    $('#image-preview-3').attr('src', '');
    $('#image-preview-4').hide();
    $('#image-preview-4').attr('src', '');
    $('#image-preview-5').hide();
    $('#image-preview-5').attr('src', '');
    $('#image-preview-6').hide();
    $('#image-preview-6').attr('src', '');
    $('#image-preview-7').hide();
    $('#image-preview-7').attr('src', '');
    $('#image-preview-8').hide();
    $('#image-preview-8').attr('src', '');
    $('#image-preview-9').hide();
    $('#image-preview-9').attr('src', '');
    $('#image-preview-10').hide();
    $('#image-preview-10').attr('src', '');
    $('#image-preview-11').hide();
    $('#image-preview-11').attr('src', '');
    $('#image-preview-12').hide();
    $('#image-preview-12').attr('src', '');
    $('#image-preview-13').hide();
    $('#image-preview-13').attr('src', '');
    $('#image-preview-14').hide();
    $('#image-preview-14').attr('src', '');
    $('#image-preview-15').hide();
    $('#image-preview-15').attr('src', '');
    $('#image-preview-16').hide();
    $('#image-preview-16').attr('src', '');
    $('#image-preview-17').hide();
    $('#image-preview-17').attr('src', '');
    $('#image-preview-18').hide();
    $('#image-preview-18').attr('src', '');
    $('#image-preview-19').hide();
    $('#image-preview-19').attr('src', '');
    $('#image-preview-20').hide();
    $('#image-preview-20').attr('src', '');

    $('#plus-1').show();
    $('#plus-2').show();
    $('#plus-3').show();
    $('#plus-4').show();
    $('#plus-5').show();
    $('#plus-6').show();
    $('#plus-7').show();
    $('#plus-8').show();
    $('#plus-9').show();
    $('#plus-10').show();
    $('#plus-11').show();
    $('#plus-12').show();
    $('#plus-13').show();
    $('#plus-14').show();
    $('#plus-15').show();
    $('#plus-16').show();
    $('#plus-17').show();
    $('#plus-18').show();
    $('#plus-19').show();
    $('#plus-20').show();

}

// SELECT FILE FROM BUTTON + IN PHONE 

var loadFile1 = function (event) {
    var reader = new FileReader();
    reader.onload = function () {
        ;
        $('#plus-1').hide();
        $('#image-preview-1').attr('src', reader.result);
        $('#image-preview-1').show();
        link[1] = reader.result;
        checkFile();
    };
    reader.readAsDataURL(event.target.files[0]);
}

var loadFile2 = function (event) {
    var reader = new FileReader();
    reader.onload = function () {
        ;
        $('#plus-2').hide();
        $('#image-preview-2').attr('src', reader.result);
        $('#image-preview-2').show();
        link[2] = reader.result;
        checkFile();
    };
    reader.readAsDataURL(event.target.files[0]);
}

var loadFile3 = function (event) {
    var reader = new FileReader();
    reader.onload = function () {
        ;
        $('#plus-3').hide();
        $('#image-preview-3').attr('src', reader.result);
        $('#image-preview-3').show();
        link[3] = reader.result;
        checkFile();
    };
    reader.readAsDataURL(event.target.files[0]);
}

var loadFile4 = function (event) {
    var reader = new FileReader();
    reader.onload = function () {
        ;
        $('#plus-4').hide();
        $('#image-preview-4').attr('src', reader.result);
        $('#image-preview-4').show();
        link[4] = reader.result;
        checkFile();
    };
    reader.readAsDataURL(event.target.files[0]);
}

var loadFile5 = function (event) {
    var reader = new FileReader();
    reader.onload = function () {
        ;
        $('#plus-5').hide();
        $('#image-preview-5').attr('src', reader.result);
        $('#image-preview-5').show();
        link[5] = reader.result;
        checkFile();
    };
    reader.readAsDataURL(event.target.files[0]);
}

var loadFile6 = function (event) {
    var reader = new FileReader();
    reader.onload = function () {
        ;
        $('#plus-6').hide();
        $('#image-preview-6').attr('src', reader.result);
        $('#image-preview-6').show();
        link[6] = reader.result;
        checkFile();
    };
    reader.readAsDataURL(event.target.files[0]);
}

var loadFile7 = function (event) {
    var reader = new FileReader();
    reader.onload = function () {
        ;
        $('#plus-7').hide();
        $('#image-preview-7').attr('src', reader.result);
        $('#image-preview-7').show();
        link[7] = reader.result;
        checkFile();
    };
    reader.readAsDataURL(event.target.files[0]);
}

var loadFile8 = function (event) {
    var reader = new FileReader();
    reader.onload = function () {
        ;
        $('#plus-8').hide();
        $('#image-preview-8').attr('src', reader.result);
        $('#image-preview-8').show();
        link[8] = reader.result;
        checkFile();
    };
    reader.readAsDataURL(event.target.files[0]);
}

var loadFile9 = function (event) {
    var reader = new FileReader();
    reader.onload = function () {
        ;
        $('#plus-9').hide();
        $('#image-preview-9').attr('src', reader.result);
        $('#image-preview-9').show();
        link[9] = reader.result;
        checkFile();
    };
    reader.readAsDataURL(event.target.files[0]);
}


var loadFile10 = function (event) {
    var reader = new FileReader();
    reader.onload = function () {
        ;
        $('#plus-10').hide();
        $('#image-preview-10').attr('src', reader.result);
        $('#image-preview-10').show();
        link[10] = reader.result;
        checkFile();
    };
    reader.readAsDataURL(event.target.files[0]);
}

var loadFile11 = function (event) {
    var reader = new FileReader();
    reader.onload = function () {
        ;
        $('#plus-11').hide();
        $('#image-preview-11').attr('src', reader.result);
        $('#image-preview-11').show();
        link[11] = reader.result;
        checkFile();
    };
    reader.readAsDataURL(event.target.files[0]);
}

var loadFile12 = function (event) {
    var reader = new FileReader();
    reader.onload = function () {
        ;
        $('#plus-12').hide();
        $('#image-preview-12').attr('src', reader.result);
        $('#image-preview-12').show();
        link[12] = reader.result;
        checkFile();
    };
    reader.readAsDataURL(event.target.files[0]);
}

var loadFile13 = function (event) {
    var reader = new FileReader();
    reader.onload = function () {
        ;
        $('#plus-13').hide();
        $('#image-preview-13').attr('src', reader.result);
        $('#image-preview-13').show();
        link[13] = reader.result;
        checkFile();
    };
    reader.readAsDataURL(event.target.files[0]);
}

var loadFile14 = function (event) {
    var reader = new FileReader();
    reader.onload = function () {
        ;
        $('#plus-14').hide();
        $('#image-preview-14').attr('src', reader.result);
        $('#image-preview-14').show();
        link[14] = reader.result;
        checkFile();
    };
    reader.readAsDataURL(event.target.files[0]);
}

var loadFile15 = function (event) {
    var reader = new FileReader();
    reader.onload = function () {
        ;
        $('#plus-15').hide();
        $('#image-preview-15').attr('src', reader.result);
        $('#image-preview-15').show();
        link[15] = reader.result;
        checkFile();
    };
    reader.readAsDataURL(event.target.files[0]);
}

var loadFile16 = function (event) {
    var reader = new FileReader();
    reader.onload = function () {
        ;
        $('#plus-16').hide();
        $('#image-preview-16').attr('src', reader.result);
        $('#image-preview-16').show();
        link[16] = reader.result;
        checkFile();
    };
    reader.readAsDataURL(event.target.files[0]);
}

var loadFile17 = function (event) {
    var reader = new FileReader();
    reader.onload = function () {
        ;
        $('#plus-17').hide();
        $('#image-preview-17').attr('src', reader.result);
        $('#image-preview-17').show();
        link[17] = reader.result;
        checkFile();
    };
    reader.readAsDataURL(event.target.files[0]);
}

var loadFile18 = function (event) {
    var reader = new FileReader();
    reader.onload = function () {
        ;
        $('#plus-18').hide();
        $('#image-preview-18').attr('src', reader.result);
        $('#image-preview-18').show();
        link[18] = reader.result;
        checkFile();
    };
    reader.readAsDataURL(event.target.files[0]);
}

var loadFile19 = function (event) {
    var reader = new FileReader();
    reader.onload = function () {
        ;
        $('#plus-19').hide();
        $('#image-preview-19').attr('src', reader.result);
        $('#image-preview-19').show();
        link[19] = reader.result;
        checkFile();
    };
    reader.readAsDataURL(event.target.files[0]);
}

var loadFile20 = function (event) {
    var reader = new FileReader();
    reader.onload = function () {
        ;
        $('#plus-20').hide();
        $('#image-preview-20').attr('src', reader.result);
        $('#image-preview-20').show();
        link[20] = reader.result;
        checkFile();
    };
    reader.readAsDataURL(event.target.files[0]);
}

var backgroundFile = function (event) {

    console.log("loop", background);

    if (event.target.files.length == 0) {
        background = [];
        $('#small-prev-slot').html("");
        $('#phone-bg').attr('src', "");
    }

    console.log("e.target", event.target.files);

    Array.from(event.target.files).forEach(file => {
        var reader = new FileReader();
        reader.onload = function () {
            background.push(reader.result);

            // LOOP IMAGE PREVIEW BACKGROUND

            var newPreview = `<div class="col-sm-6 col-md-4 col-lg-2 m-2" style="height: 140px; border: 1px dashed #6a6a6a; margin-left: 5px">
                                <img src="`+background[background.length-1]+`" class="small-prev-`+background.length+`" style="width: 100%; height: 100%">
                            </div>`;

            $('#small-prev-slot').append(newPreview);

            $('#phone-bg').attr('src', reader.result);
            checkFile();
        };
        reader.readAsDataURL(file);
    })

    console.log("loop", background);

}

var certificateFile = function (event) {
    var reader = new FileReader();
    reader.onload = function () {
        ;
        certificate = reader.result;
        checkFile();
    };
    reader.readAsDataURL(event.target.files[0]);
}


// SCRIPT CONVERT BASE64 TO OBJECT

function dataURLtoFile(dataurl, filename) {
    var arr = dataurl.split(','),
        mime = arr[0].match(/:(.*?);/)[1],
        bstr = atob(arr[1]),
        n = bstr.length,
        u8arr = new Uint8Array(n);

    while (n--) {
        u8arr[n] = bstr.charCodeAt(n);
    }

    return new File([u8arr], filename, {
        type: mime
    });
}

// NEW FORMAT BASE 64 FOR APPEND

function newFormat(base64_link) {

    console.log("P", base64_link);

    var format = base64_link.split(";");

    if (format[0].slice(-4) == "jpeg" || format[0].slice(-4) == "webp") {
        var ext = format[0].slice(-4);
    } else {
        var ext = format[0].slice(-3);
    }

    var rand = Math.floor(Math.random() * 1000000000000);

    var converted_link = dataURLtoFile(base64_link, rand + "." + ext);

    return converted_link;
}

// SEND FORM

function sendData() {

    // if ($('#generate-apk').is(':checked')) {

    // console.log('MANA COK', document.getElementById('url_content').value);

    var formData = new FormData();

    // DECLARE VAR FROM VAL

    var companyWebsite = $('#companyWebsite').val();
    var companyName = $('#companyName').val();
    var appId = $('#appId').val();

    var tab1_page = $('#tab1').val();
    var tab2_page = $('#tab2').val();
    var tab3_page = $('#tab3').val();
    var tab4_page = $('#tab4').val();

    // if (tab1_page == 1) {
    //     tab1_page = document.getElementById('tab1_url').value;
    // }
    // if (tab2_page == 1) {
    //     tab2_page = document.getElementById('tab2_url').value;
    // }
    // if (tab3_page == 1) {
    //     tab3_page = document.getElementById('tab3_url').value;
    // }
    // if (tab4_page == 1) {
    //     tab4_page = document.getElementById('tab4_url').value;
    // }

    if (tab1) {
        var tab1_icon = newFormat(tab1);
    } else {
        var tab1_icon = "";
    }

    if (tab2) {
        var tab2_icon = newFormat(tab2);
    } else {
        var tab2_icon = "";
    }

    if (tab3) {
        var tab3_icon = newFormat(tab3);
    } else {
        var tab3_icon = "";
    }

    if (tab4) {
        var tab4_icon = newFormat(tab4);
    } else {
        var tab4_icon = "";
    }

    if (cpaas) {
        var cpaas_icon = newFormat(cpaas);
    } else {
        var cpaas_icon = "";
    }

    if (messaging) {
        var fb1_icon = newFormat(messaging);
    } else {
        var fb1_icon = "";
    }

    if (call) {
        var fb2_icon = newFormat(call);
    } else {
        var fb2_icon = "";
    }

    if (contact) {
        var fb3_icon = newFormat(contact);
    } else {
        var fb3_icon = "";
    }

    if (post) {
        var fb4_icon = newFormat(post);
    } else {
        var fb4_icon = "";
    }

    if (streaming) {
        var fb5_icon = newFormat(streaming);
    } else {
        var fb5_icon = "";
    }

    // var content_tab_layout = $('#content-tab-layout').val();
    let tab3_mode_elm = document.getElementById('tab3_mode');
    let url_content_elm = document.getElementById('url_content');

    let tab3_mode = '';
    let url_content = '';

    if (tab3_mode_elm != null) {
        tab3_mode = $('#tab3_mode').val();
        formData.append('tab3_mode', tab3_mode);
    }
    // console.log(url_content_elm);
    if (url_content_elm != null) {
        url_content = url_content_elm.value;
        formData.append('url_content', url_content);
    }

    var menuType = $('#menuType').val();
    var app_font = $('#app_font').val();

    if (background.length > 0) {
        console.log("bg", background);
        var background_wall = [];

        for (var i = 0; i < background.length; i++) {
            background_wall.push(newFormat(background[i]));
        }

        console.log("BACK" + background_wall);

    } else {
        var background_wall = "";
    }

    var ver_name = $('#ver_name').val();
    // var generate_apk = $('#generate-apk').val();

    var generate_default_certif = radioCertif;
    if (radioCertif == null || radioCertif == "") {
        generate_default_certif = '0';
    }

    if (certificate) {
        var app_certificate = newFormat(certificate);
    } else {
        var app_certificate = "";
    }

    var keyPassword_existing = $('#keyPassword-existing').val();
    var inputAlias_existing = $('#inputAlias-existing').val();
    var storePassword_existing = $('#storePassword-existing').val();

    var inputAlias = $('#inputAlias').val();
    var keyPassword = $('#keyPassword').val();
    var inputValidity = $('#inputValidity').val();
    var storePassword = $('#storePassword').val();
    var inputName = $('#inputName').val();
    var inputUnit = $('#inputUnit').val();
    var inputOrg = $('#inputOrg').val();
    var inputCity = $('#inputCity').val();
    var inputState = $('#inputState').val();
    var inputCode = $('#inputCode').val();

    let edit_apk = $('#edit-apk').is(':checked');
    let generate_apk = $('#generate-apk').is(':checked');

    // CONSOLE.LOG

    // FORM DATA APPEND

    formData.append('company-website', companyWebsite);
    formData.append('ver_code', ver_code);

    if (generate_apk && !edit_apk) {
        let gen_apk_val = $('#generate-apk').val();
        formData.append('generate-apk', gen_apk_val);
        formData.append('company-name', companyName);
        formData.append('app-id', appId);

        formData.append('tab1', tab1_page);
        formData.append('tab2', tab2_page);
        formData.append('tab3', tab3_page);
        formData.append('tab4', tab4_page);

        formData.append('tab1_icon', tab1_icon);
        formData.append('tab2_icon', tab2_icon);
        formData.append('tab3_icon', tab3_icon);
        formData.append('tab4_icon', tab4_icon);
        formData.append('cpaas_icon', cpaas_icon);
        formData.append('fb1_icon', fb1_icon);
        formData.append('fb2_icon', fb2_icon);
        formData.append('fb3_icon', fb3_icon);
        formData.append('fb4_icon', fb4_icon);
        formData.append('fb5_icon', fb5_icon);
        formData.append('access_model', menuType);
        formData.append('app_font', app_font);

        for (var i = 0; i < background_wall.length; i++) {
            formData.append('background[]', background_wall[i]);
        }

        formData.append('ver_name', ver_name);

        formData.append('check-certif', generate_default_certif);

        formData.append('app-certificate', app_certificate);
        formData.append('keyPassword-existing', keyPassword_existing);
        formData.append('inputAlias-existing', inputAlias_existing);
        formData.append('storePassword-existing', storePassword_existing);

        formData.append('inputAlias', inputAlias);
        formData.append('keyPassword', keyPassword);
        formData.append('inputValidity', inputValidity);
        formData.append('storePassword', storePassword);
        formData.append('inputName', inputName);
        formData.append('inputUnit', inputUnit);
        formData.append('inputOrg', inputOrg);
        formData.append('inputCity', inputCity);
        formData.append('inputState', inputState);
        formData.append('inputCode', inputCode);
    } else if (!generate_apk && edit_apk) {
        let edit_apk_val = $('#edit-apk').val();
        formData.append('edit_apk', edit_apk_val);

        var tab1_edit = $('#tab1_edit').val();
        var tab2_edit = $('#tab2_edit').val();
        var tab3_edit = $('#tab3_edit').val();
        var tab4_edit = $('#tab4_edit').val();

        let tab3_mode_elm = document.getElementById('edit_tab3_mode');
        let url_content_elm = document.getElementById('edit_url_content');

        let tab3_mode = '';
        let url_content = '';

        if (tab3_mode_elm != null) {
            tab3_mode = tab3_mode_elm.value;
            formData.append('edit_tab3_mode', tab3_mode);
        }
        // console.log(url_content_elm);
        if (url_content_elm != null) {
            url_content = url_content_elm.value;
            formData.append('edit_url_content', url_content);
        }

        formData.append('tab1_edit', tab1_edit);
        formData.append('tab2_edit', tab2_edit);
        formData.append('tab3_edit', tab3_edit);
        formData.append('tab4_edit', tab4_edit);
    }

    // XMLHTTP PROCESS

    for (var pair of formData.entries()) {
        console.log(pair[0] + ', ' + pair[1]);
    }

    $('#warningModal').modal('toggle');

    let xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function () {

        if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
            console.log(xmlHttp.responseText);

            let response = xmlHttp.responseText.split("|");

            if (response[0] == "Berhasil") {
                let fileName = response[1];

                if (parseInt(fileName) != 1 && parseInt(fileName) != 0) {

                    background = [];
                    downloadFiles(fileName);

                }

                window.location.href = "/dashboardv2/index.php";
            } else {
                console.log("Gagal");
            }
        }
    }

    xmlHttp.open("post", "logics/submit_build_apk");
    xmlHttp.send(formData);

    // } else {
    //     $('#submit_form').submit();
    // }

}

async function downloadFiles(fileName) {
    try {
        $('#warningModal').modal('toggle');
        for (let i = 0;; i++) {
            const req = await fetch(fileName);
            const reader = req.body.getReader();
            window.location.href = fileName;
            break;
        }
    } catch (e) {
        // handle file not found here
    }
}