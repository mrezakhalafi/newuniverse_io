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

            // FOR RESET VALUE IF DETECTED DUPLICATE
            $('#'+elementID).val("");

            if (localStorage.lang == 1){
                alert("Anda memilih konten tab duplikat.");
            }else{
                alert("You selected duplicate tab contents.");
            }
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

            // FOR RESET VALUE IF DETECTED DUPLICATE
            $('#'+elementID).val("");

            if (localStorage.lang == 1){
                alert("Anda memilih konten tab duplikat.");
            }else{
                alert("You selected duplicate tab contents.");
            }
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

    let categoryEnabled = document.getElementById('enable_category').checked;

    var othercodes = [
        document.getElementById('tab1').value,
        document.getElementById('tab2').value,
        document.getElementById('tab3').value,
        document.getElementById('tab4').value,
    ];
    for (var i = 0; i <= 3; i++) {
        var c = valCounter[othercodes[i]] = (valCounter[othercodes[i]] || 0) + 1;
        if (c > 1 && othercodes[i] != "" && othercodes[i] != "0") {

            console.log('tabs', valCounter);
            document.getElementById("submit-form").setAttribute("disabled", "disabled");
            // so that it stops form submission;
            // document.getElementById("notification").innerHTML = elt.options[elt.selectedIndex].text + " Subject Already Choosen!";

            // FOR RESET VALUE IF DETECTED DUPLICATE
            $('#'+elementID).val("");

            if (localStorage.lang == 1){
                alert("Anda memilih konten tab duplikat.");
            }else{
                alert("You selected duplicate tab contents.");
            }
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
    let optionsStr = '';

    let defaultCategory = null;

    if (categoryEnabled) {
        let defaultContentOptions = [];
        defaultCategory = document.getElementById(elementID + '-default-content');
        existingCategory.forEach(ex => {
            let str = `<option value="${company_id + "00" + ex.value}">${ex.text}</option>`;

            defaultContentOptions.push(str);
        })

        optionsStr = defaultContentOptions.join("");
    }

    if (value == 1) {
        // fillURL.classList.remove('d-none');

        let inputhtml = "";

        if (localStorage.lang == 1){

            inputhtml = `
                <label class="col-sm-4 col-form-label" for="url_content">Konten <span style="color:red;">*</span> :</label>

                <div class="col-sm-8">
                    <input type="text" list="cars" id="url_content" class="form-control" placeholder="'www.example.com' atau pilih beberapa opsi di bawah" class="form-control mb-1" name="url_content" onchange="checkWebview(this.id);" required>
                    <datalist id="cars">
                        <option value="0">Timeline content</option>
                        <option value="1">Grid content</option>
                        <option value="2">Mixed content</option>
                        <option value="3">E-commerce</option>
                        <option value="4">Video content</option>
                    </datalist>
                </div>
                `;

        }else{

            inputhtml = `
                <label class="col-sm-4 col-form-label" for="url_content">Content <span style="color:red;">*</span> :</label>

                <div class="col-sm-8">
                    <input type="text" list="cars" id="url_content" class="form-control" placeholder="'www.example.com' or pick existing options" class="form-control mb-1" name="url_content" onchange="checkWebview(this.id);" required>
                    <datalist id="cars">
                        <option value="0">Timeline content</option>
                        <option value="1">Grid content</option>
                        <option value="2">Mixed content</option>
                        <option value="3">E-commerce</option>
                        <option value="4">Video content</option>
                    </datalist>
                </div>
                `;

        }

        fillURL.innerHTML = inputhtml;

        fillURL.classList.remove('d-none');

        if (categoryEnabled) {
            let selectCategoryHTML = `
            <label class="col-sm-4 col-form-label" for="url_default_content">Default content category :</label>

            <div class="col-sm-8">
                <select id="url-default-category" class="form-control tab-content" name="url_default_content">
                    <option value="" disabled selected></option>
                    ${optionsStr}
                </select>
            </div>
            `;

            defaultCategory.insertAdjacentHTML('beforeend', selectCategoryHTML);
            defaultCategory.classList.remove('d-none');
        }
    } else if (value == 3) {

        let inputhtml = "";

        if (localStorage.lang == 1){

            inputhtml = `
                <label class="col-sm-4 col-form-label" for="tab3_mode">Konten <span style="color:red;">*</span> :</label>

                <div class="col-sm-8">
                <input type="text" list="cars" id="tab3_mode" class="form-control" placeholder="'www.example.com' atau pilih beberapa opsi di bawah" class="form-control mb-1" name="url_content" onchange="checkWebview(this.id);" required>
                <datalist id="cars">
                    <option value="0">Timeline content</option>
                    <option value="1">Grid content</option>
                    <option value="2">Mixed content</option>
                    <option value="3">E-commerce</option>
                    <option value="4">Video content</option>
                </datalist>
                </div>
                `;

        }else{

            inputhtml = `
                <label class="col-sm-4 col-form-label" for="tab3_mode">Content <span style="color:red;">*</span> :</label>

                <div class="col-sm-8">
                <input type="text" list="cars" id="tab3_mode" class="form-control" placeholder="'www.example.com' or pick existing options" class="form-control mb-1" name="url_content" onchange="checkWebview(this.id);" required>
                <datalist id="cars">
                    <option value="0">Timeline content</option>
                    <option value="1">Grid content</option>
                    <option value="2">Mixed content</option>
                    <option value="3">E-commerce</option>
                    <option value="4">Video content</option>
                </datalist>
                </div>
                `;

        }

        fillURL.innerHTML = inputhtml;
        fillURL.classList.remove('d-none');

        if (categoryEnabled) {
            let selectCategoryHTML = `
            <label class="col-sm-4 col-form-label" for="tab3_default_content">Default content category:</label>

            <div class="col-sm-8">
                <select id="content-default-category" class="form-control tab-content" name="tab3_default_content">
                    <option value="" disabled selected></option>
                    ${optionsStr}
                </select>
            </div>
            `;

            defaultCategory.insertAdjacentHTML('beforeend', selectCategoryHTML);
            defaultCategory.classList.remove('d-none');
        }
    } else {
        // 
        fillURL.innerHTML = '';
        fillURL.classList.add('d-none');

        if (defaultCategory) {
            defaultCategory.innerHTML = '';
            defaultCategory.classList.add('d-none');
        }
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

            // FOR RESET VALUE IF DETECTED DUPLICATE
            $('#'+elementID).val("");
            
            if (localStorage.lang == 1){
                alert("Anda memilih konten tab duplikat.");
            }else{
                alert("You selected duplicate tab contents.");
            }
            return false;
        }
    }
    document.getElementById("submit-form").removeAttribute("disabled");

    if (value == 1) {
        // fillURL.classList.remove('d-none');

        let inputhtml = "";

        if (localStorage.lang == 1){

            inputhtml = `
                <label class="col-sm-4 col-form-label" for="edit_url_content">Konten <span style="color:red;">*</span> :</label>

                <div class="col-sm-8">
                    <input type="text" list="cars" id="edit_url_content" class="form-control" placeholder="'www.example.com' atau pilih beberapa opsi di bawah" class="form-control mb-1" name="edit_url_content" onchange="checkWebviewEdit(this.id);" required>
                    <datalist id="cars">
                        <option value="0">Timeline content</option>
                        <option value="1">Grid content</option>
                        <option value="2">Mixed content</option>
                        <option value="3">E-commerce</option>
                        <option value="4">Video content</option>
                    </datalist>
                </div>
                `;

        }else{

            inputhtml = `
                <label class="col-sm-4 col-form-label" for="edit_url_content">Content <span style="color:red;">*</span> :</label>

                <div class="col-sm-8">
                    <input type="text" list="cars" id="edit_url_content" class="form-control" placeholder="'www.example.com' or pick existing options" class="form-control mb-1" name="edit_url_content" onchange="checkWebviewEdit(this.id);" required>
                    <datalist id="cars">
                        <option value="0">Timeline content</option>
                        <option value="1">Grid content</option>
                        <option value="2">Mixed content</option>
                        <option value="3">E-commerce</option>
                        <option value="4">Video content</option>
                    </datalist>
                </div>
                `;
        }

        fillURL.innerHTML = inputhtml;

        fillURL.classList.remove('d-none');
    } else if (value == 3) {

        let inputhtml = "";

        if (localStorage.lang == 1){

            inputhtml = `
                <label class="col-sm-4 col-form-label" for="edit_tab3_mode">Konten <span style="color:red;">*</span> :</label>

                <div class="col-sm-8">
                <input type="text" list="cars" id="edit_tab3_mode" class="form-control" placeholder="'www.example.com' atau pilih beberapa opsi di bawah" class="form-control mb-1" name="url_content" onchange="checkWebviewEdit(this.id);" required>
                <datalist id="cars">
                    <option value="0">Timeline content</option>
                    <option value="1">Grid content</option>
                    <option value="2">Mixed content</option>
                    <option value="3">E-commerce</option>
                    <option value="4">Video content</option>
                </datalist>
                </div>
                `;

        }else{

            inputhtml = `
                <label class="col-sm-4 col-form-label" for="edit_tab3_mode">Content <span style="color:red;">*</span> :</label>

                <div class="col-sm-8">
                <input type="text" list="cars" id="edit_tab3_mode" class="form-control" placeholder="'www.example.com' or pick existing options" class="form-control mb-1" name="url_content" onchange="checkWebviewEdit(this.id);" required>
                <datalist id="cars">
                    <option value="0">Timeline content</option>
                    <option value="1">Grid content</option>
                    <option value="2">Mixed content</option>
                    <option value="3">E-commerce</option>
                    <option value="4">Video content</option>
                </datalist>
                </div>
                `;

        }

        fillURL.innerHTML = inputhtml;
        fillURL.classList.remove('d-none');
    } else {
        // 
        fillURL.innerHTML = '';
        fillURL.classList.add('d-none');
    }
}

$('#ver_name').on('input', function () {
    let rgx = /^[\.0-9A-Za-z]*$/;
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

class Category {
    constructor(name, classification) {
        this.name = name;
        this.classification = classification;
    }
}

function btnOption() {
    document.getElementById("myDropdown").classList.toggle("show");
}

let enableCategory = document.getElementById("enable_category");

enableCategory.addEventListener("change", function () {
    if (enableCategory.checked) {
        $('#content-categories').removeClass('d-none');
        $('#class-section').removeClass('d-none');
        $('#save-category').removeClass('d-none');
    } else {
        $('#content-categories').addClass('d-none');
        $('#class-section').addClass('d-none');
        $('#save-category').addClass('d-none');
    }
})

let categoryNum = 0;

let add_category = document.getElementById('add-category');

add_category.addEventListener('click', function () {
    addCategory();
})

// let enable_class = document.getElementById('enable_class');

// let add_class = document.getElementById('add-class');

// add_class.addEventListener('click', function () {
//     console.log('sdka');
//     addClass();
// })

// $('input#category-0').on('change input', function () {
//     if ($(this).val().length > 0) {
//         enable_class.disabled = false;
//     } else {
//         enable_class.disabled = true;
//     }
// })

// enable_class.addEventListener("change", function () {
//     if (enable_class.checked) {
//         $('#content-classification').removeClass('d-none');
//         // fillParentOptions();
//     } else {
//         $('#content-classification').addClass('d-none');
//     }
// })

let existingCategory = [];

function fillOptions() {
    let arr = [];

    $('input.category-name').each(function () {
        let category_id = $(this).attr('id').split('-')[1];
        let category_name = $(this).val();

        let content = `
            <option value="${category_id}">${category_name}</option>
        `;

        arr.push(content);
    })

    return arr;
}

function checkPrevCategory() {
    let canAdd = true;
    $('input.category-name').each(function () {

        let category_name = $(this).val();
        if (category_name.trim().length == 0) {
            alert('Please fill existing categories first.');
            canAdd = false;
        }
    })

    return canAdd;
}

function addParentOptions(row) {
    let options_arr = [];
    $('input.category-name').each(function () {
        let category_id = $(this).attr('id').split('-')[1];
        let category_name = $(this).val();
        let obj = {};

        // arr.push(content);
        // if (category_id != row) {
        obj.value = category_id;
        obj.text = category_name;
        options_arr.push(obj);
        // }
    })
    var selections = document.getElementsByClassName('parent-id');
    for (var i = 0; i < selections.length; i++) {
        //console.log(selection);
        while (selections[i].firstChild) {
            selections[i].firstChild.remove();
        }
        for (var j = 0; j < options_arr.length; j++) {
            selections[i].options.add(createOption(options_arr[j].value, options_arr[j].text));
        }
    }

    let parentCol = document.querySelector('#category-row-' + row + ' .parent-col');
    parentCol.classList.remove('d-none');

    let button = document.querySelector('#category-row-' + row + ' .addParent-col');
    button.classList.add('d-none');
}

function createOption(value, label) {
    var option = document.createElement("option");
    option.value = value;
    option.innerHTML = label;

    return option;
}

// var sizes = ["XXL", "XL", "L", "M", "S", "XS"];

// buildDropDowns(sizes);

async function addCategory() {
    let category_arr = document.getElementById('category_arr');

    let canAdd = checkPrevCategory();

    if (!canAdd) {
        return false;
    } else {

        categoryNum++;

        let content = `
    <div class="row category-row" id="category-row-${categoryNum}">
        <div class="col-3">
            <input type="text" id="category-${categoryNum}" class="category-name form-control mb-1" placeholder="Insert category name" style="display:inline-block;">
        </div>
        <div class="col-3 addParent-col">
            <button class="btn btn-yellow" type="button" id="addParent-${categoryNum}" onclick="addParentOptions(${categoryNum});" style="min-width:unset; margin:unset;">
                Add parent
            </button>
        </div>
        <div class="col-3 parent-col d-none">
            <select id="parent-${categoryNum}" class="parent-id form-control mb-1" style="display:inline-block">
            </select>
        </div>
        <div class="col-2">            
            <button class="btn btn-yellow" type="button" id="deleteCategory-${categoryNum}" onclick="deleteCategory(${categoryNum});" style="min-width:unset; background-color: red; margin:unset;">
                X
            </button>
        </div>
    </div>
    `;

        category_arr.insertAdjacentHTML('beforeend', content);
    }
    // category_arr.append(content);
    // let contentDOM = new DOMParser().parseFromString(content, "text/html");

    // category_arr.append(contentDOM);
}

function saveCategory() {
    let options_arr = [];
    let allValid = true;
    $('input.category-name').each(function () {
        let category_id = $(this).attr('id').split('-')[1];
        let category_name = $(this).val();
        let obj = {};

        // arr.push(content);
        // if (category_id != row) {
        obj.value = category_id;
        obj.text = category_name;
        if (obj.text == "") {
            if (!$('#save-category-success').hasClass('d-none')) {
                $('#save-category-success').addClass('d-none');
            }
            $('#save-category-error').removeClass('d-none');
            allValid = false;
            return false;
        } else {
            options_arr.push(obj);
        }
        // }
    })
    if (allValid) {
        if (!$('#save-category-error').hasClass('d-none')) {
            $('#save-category-error').addClass('d-none');
        }
        $('#save-category-success').removeClass('d-none');
        existingCategory = options_arr;
    }
    // existingCategory = options_arr;
    console.log(existingCategory);
}

$('#save-category-btn').click(function () {
    saveCategory();
})

let classNum = 0;

// function addClass() {
//     let class_arr = document.getElementById('class_arr');

//     classNum++;

//     let content = `
//     <div class="row" id="class-row-${classNum}">
//         <div class="col-4">
//             <input type="text" id="class-${classNum}" class="form-control mb-1" placeholder="Insert class name" name="class[${classNum}][name]" style="display:inline-block;">
//         </div>
//         <div class="col-4">
//             <input type="text" id="class-parent-${classNum}" class="form-control mb-1" placeholder="Insert parent name" name="class[${classNum}][parent]" style="display:inline-block;">
//         </div>
//         <div class="col-4">

//             <button class="btn btn-yellow" type="button" id="deleteClass-${classNum}" onclick="deleteClass(${classNum});" style="min-width:unset; background-color: red; margin:unset;">
//                 X
//             </button>
//         </div>
//     </div>
//     `;

//     class_arr.insertAdjacentHTML('beforeend', content);
// }

// function deleteClass(int) {
//     let classId = document.getElementById('class-row-' + int);

//     classId.remove();
// }

function deleteCategory(int) {
    let categoryId = document.getElementById('category-row-' + int);

    categoryId.remove();
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

// FOUR MAIN BUTTON (DOCKED) SESSION 2
$('#image-preview-21').hide();
$('#image-preview-22').hide();
$('#image-preview-23').hide();
$('#image-preview-24').hide();

// FIVE SMALL BUTTON (DOCKED) SESSION 2
$('#image-preview-25').hide();
$('#image-preview-26').hide();
$('#image-preview-27').hide();
$('#image-preview-28').hide();
$('#image-preview-29').hide();
$('#image-preview-30').hide();

// FIVE SMALL BUTTON (FLOATING & BURGER) SESSION 2
$('#image-preview-31').hide();
$('#image-preview-32').hide();
$('#image-preview-33').hide();
$('#image-preview-34').hide();
$('#image-preview-35').hide();
$('#image-preview-36').hide();

// FOUR MAIN BUTTON (FLOATING & BURGER) SESSION 2
$('#image-preview-37').hide();
$('#image-preview-38').hide();
$('#image-preview-39').hide();
$('#image-preview-40').hide();

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

// FOUR MAIN BUTTON DIV (DOCKED) SESSION 2
var inputDragElem21 = document.getElementById('big-icon-21');
var inputDragElem22 = document.getElementById('big-icon-22');
var inputDragElem23 = document.getElementById('big-icon-23');
var inputDragElem24 = document.getElementById('big-icon-24');

// FIVE SMALL BUTTON DIV (DOCKED) SESSION 2
var inputDragElem25 = document.getElementById('big-icon-25');
var inputDragElem26 = document.getElementById('small-icon-21');
var inputDragElem27 = document.getElementById('small-icon-22');
var inputDragElem28 = document.getElementById('small-icon-23');
var inputDragElem29 = document.getElementById('small-icon-24');
var inputDragElem30 = document.getElementById('small-icon-25');

// FOUR MAIN BUTTON DIV (FLOATING & BURGER) SESSION 2
var inputDragElem31 = document.getElementById('big-icon-26');
var inputDragElem32 = document.getElementById('big-icon-27');
var inputDragElem33 = document.getElementById('big-icon-28');
var inputDragElem34 = document.getElementById('big-icon-29');

// FIVE SMALL BUTTON DIV (FLOATING & BURGER) SESSION 2
var inputDragElem35 = document.getElementById('floating-button-2');
var inputDragElem36 = document.getElementById('small-icon-26');
var inputDragElem37 = document.getElementById('small-icon-27');
var inputDragElem38 = document.getElementById('small-icon-28');
var inputDragElem39 = document.getElementById('small-icon-29');
var inputDragElem40 = document.getElementById('small-icon-30');

// FOUR MAIN BUTTON IMAGE (DOCKED) SESSION 2
var imagePreviewUrlElem21 = document.getElementById('image-preview-21');
var imagePreviewUrlElem22 = document.getElementById('image-preview-22');
var imagePreviewUrlElem23 = document.getElementById('image-preview-23');
var imagePreviewUrlElem24 = document.getElementById('image-preview-24');

// FIVE SMALL BUTTON IMAGE (DOCKED) SESSION 2
var imagePreviewUrlElem25 = document.getElementById('image-preview-25');
var imagePreviewUrlElem26 = document.getElementById('image-preview-26');
var imagePreviewUrlElem27 = document.getElementById('image-preview-27');
var imagePreviewUrlElem28 = document.getElementById('image-preview-28');
var imagePreviewUrlElem29 = document.getElementById('image-preview-29');
var imagePreviewUrlElem30 = document.getElementById('image-preview-30');

// FIVE SMALL BUTTON IMAGE (FLOATING & BURGER) SESSION 2
var imagePreviewUrlElem31 = document.getElementById('image-preview-31');
var imagePreviewUrlElem32 = document.getElementById('image-preview-32');
var imagePreviewUrlElem33 = document.getElementById('image-preview-33');
var imagePreviewUrlElem34 = document.getElementById('image-preview-34');
var imagePreviewUrlElem35 = document.getElementById('image-preview-35');
var imagePreviewUrlElem36 = document.getElementById('image-preview-36');

// FOUR MAIN BUTTON IMAGE (FLOATING & BURGER) SESSION 2
var imagePreviewUrlElem37 = document.getElementById('image-preview-37');
var imagePreviewUrlElem38 = document.getElementById('image-preview-38');
var imagePreviewUrlElem39 = document.getElementById('image-preview-39');
var imagePreviewUrlElem40 = document.getElementById('image-preview-40');

var link = new Array(); // ARRAY FOR SAVE BASE64 UPLOAD IMAGES
var link_edit = new Array(); // ARRAY FOR SAVE BASE64 UPLOAD IMAGES
var switching = 0; // FOR KNOWN WHICH ITEM DRAGG FROM (EX : FROM 1 TO 2)

var preventDefault = function (event) {
    event.preventDefault();
    event.stopPropagation();
    return false;
}

// HANDLE FILE INPUT FROM DRAG PICTURES TO PHONE SESSION 1

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

// handledrop
// dragend -> this.id
// var icons = {
// }
// icons.

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

// END OF SESSION 1

// HANDLE FILE INPUT FROM DRAG PICTURES TO PHONE SESSION 2

var handleDrop21 = function (event) {
    var dataTransfer = event.dataTransfer;
    var files = dataTransfer.files;

    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        var reader = new FileReader();

        reader.readAsDataURL(file);
        reader.addEventListener('loadend', function (event, file) {
            imagePreviewUrlElem21.src = this.result;
            $('#plus-21').hide();
            $('#image-preview-21').show();

            if (switching != 0 && link[21] != null) {
                $('#image-preview-' + switching).attr('src', link[21]);

                link[switching] = link[21];

            } else if (switching != 0) {
                $('#image-preview-' + switching).hide();
                $('#plus-' + switching).show();

                link[switching] = null;
            }

            link[21] = this.result;
            $('#file-21').text(this.result);
            checkFile();
            switching = 0;
        });
    }
}

var handleDrop22 = function (event) {
    var dataTransfer = event.dataTransfer;
    var files = dataTransfer.files;

    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        var reader = new FileReader();

        reader.readAsDataURL(file);
        reader.addEventListener('loadend', function (event, file) {
            imagePreviewUrlElem22.src = this.result;
            $('#plus-22').hide();
            $('#image-preview-22').show();

            if (switching != 0 && link[22] != null) {
                $('#image-preview-' + switching).attr('src', link[22]);

                link[switching] = link[22];

            } else if (switching != 0) {
                $('#image-preview-' + switching).hide();
                $('#plus-' + switching).show();

                link[switching] = null;
            }

            link[22] = this.result;
            $('#file-22').text(this.result);
            checkFile();
            switching = 0;
        });
    }
}

var handleDrop23 = function (event) {
    var dataTransfer = event.dataTransfer;
    var files = dataTransfer.files;

    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        var reader = new FileReader();

        reader.readAsDataURL(file);
        reader.addEventListener('loadend', function (event, file) {
            imagePreviewUrlElem23.src = this.result;
            $('#plus-23').hide();
            $('#image-preview-23').show();

            if (switching != 0 && link[23] != null) {
                $('#image-preview-' + switching).attr('src', link[23]);

                link[switching] = link[23];

            } else if (switching != 0) {
                $('#image-preview-' + switching).hide();
                $('#plus-' + switching).show();

                link[switching] = null;
            }

            link[23] = this.result;
            $('#file-23').text(this.result);
            checkFile();
            switching = 0;
        });
    }
}

var handleDrop24 = function (event) {
    var dataTransfer = event.dataTransfer;
    var files = dataTransfer.files;

    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        var reader = new FileReader();

        reader.readAsDataURL(file);
        reader.addEventListener('loadend', function (event, file) {
            imagePreviewUrlElem24.src = this.result;
            $('#plus-24').hide();
            $('#image-preview-24').show();

            if (switching != 0 && link[24] != null) {
                $('#image-preview-' + switching).attr('src', link[24]);

                link[switching] = link[24];

            } else if (switching != 0) {
                $('#image-preview-' + switching).hide();
                $('#plus-' + switching).show();

                link[switching] = null;
            }

            link[24] = this.result;
            $('#file-24').text(this.result);
            checkFile();
            switching = 0;
        });
    }
}

var handleDrop25 = function (event) {
    var dataTransfer = event.dataTransfer;
    var files = dataTransfer.files;

    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        var reader = new FileReader();

        reader.readAsDataURL(file);
        reader.addEventListener('loadend', function (event, file) {
            imagePreviewUrlElem25.src = this.result;
            $('#plus-25').hide();
            $('#image-preview-25').show();

            if (switching != 0 && link[25] != null) {
                $('#image-preview-' + switching).attr('src', link[25]);

                link[switching] = link[25];

            } else if (switching != 0) {
                $('#image-preview-' + switching).hide();
                $('#plus-' + switching).show();

                link[switching] = null;
            }

            link[25] = this.result;
            $('#file-25').text(this.result);
            checkFile();
            switching = 0;
        });
    }
}

var handleDrop26 = function (event) {
    var dataTransfer = event.dataTransfer;
    var files = dataTransfer.files;

    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        var reader = new FileReader();

        reader.readAsDataURL(file);
        reader.addEventListener('loadend', function (event, file) {
            imagePreviewUrlElem26.src = this.result;
            $('#plus-26').hide();
            $('#image-preview-26').show();

            if (switching != 0 && link[26] != null) {
                $('#image-preview-' + switching).attr('src', link[26]);

                link[switching] = link[26];

            } else if (switching != 0) {
                $('#image-preview-' + switching).hide();
                $('#plus-' + switching).show();

                link[switching] = null;
            }

            link[26] = this.result;
            $('#file-26').text(this.result);
            checkFile();
            switching = 0;
        });
    }
}

var handleDrop27 = function (event) {
    var dataTransfer = event.dataTransfer;
    var files = dataTransfer.files;

    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        var reader = new FileReader();

        reader.readAsDataURL(file);
        reader.addEventListener('loadend', function (event, file) {
            imagePreviewUrlElem27.src = this.result;
            $('#plus-27').hide();
            $('#image-preview-27').show();

            if (switching != 0 && link[27] != null) {
                $('#image-preview-' + switching).attr('src', link[27]);

                link[switching] = link[27];

            } else if (switching != 0) {
                $('#image-preview-' + switching).hide();
                $('#plus-' + switching).show();

                link[switching] = null;
            }

            link[27] = this.result;
            $('#file-27').text(this.result);
            checkFile();
            switching = 0;
        });
    }
}

var handleDrop28 = function (event) {
    var dataTransfer = event.dataTransfer;
    var files = dataTransfer.files;

    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        var reader = new FileReader();

        reader.readAsDataURL(file);
        reader.addEventListener('loadend', function (event, file) {
            imagePreviewUrlElem28.src = this.result;
            $('#plus-28').hide();
            $('#image-preview-28').show();

            if (switching != 0 && link[28] != null) {
                $('#image-preview-' + switching).attr('src', link[28]);

                link[switching] = link[28];

            } else if (switching != 0) {
                $('#image-preview-' + switching).hide();
                $('#plus-' + switching).show();

                link[switching] = null;
            }

            link[28] = this.result;
            $('#file-28').text(this.result);
            checkFile();
            switching = 0;
        });
    }
}

var handleDrop29 = function (event) {
    var dataTransfer = event.dataTransfer;
    var files = dataTransfer.files;

    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        var reader = new FileReader();

        reader.readAsDataURL(file);
        reader.addEventListener('loadend', function (event, file) {
            imagePreviewUrlElem29.src = this.result;
            $('#plus-29').hide();
            $('#image-preview-29').show();

            if (switching != 0 && link[29] != null) {
                $('#image-preview-' + switching).attr('src', link[29]);

                link[switching] = link[29];

            } else if (switching != 0) {
                $('#image-preview-' + switching).hide();
                $('#plus-' + switching).show();

                link[switching] = null;
            }

            link[29] = this.result;
            $('#file-29').text(this.result);
            checkFile();
            switching = 0;
        });
    }
}

var handleDrop30 = function (event) {
    var dataTransfer = event.dataTransfer;
    var files = dataTransfer.files;

    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        var reader = new FileReader();

        reader.readAsDataURL(file);
        reader.addEventListener('loadend', function (event, file) {
            imagePreviewUrlElem30.src = this.result;
            $('#plus-30').hide();
            $('#image-preview-30').show();

            if (switching != 0 && link[30] != null) {
                $('#image-preview-' + switching).attr('src', link[30]);

                link[switching] = link[30];

            } else if (switching != 0) {
                $('#image-preview-' + switching).hide();
                $('#plus-' + switching).show();

                link[switching] = null;
            }

            link[30] = this.result;
            $('#file-30').text(this.result);
            checkFile();
            switching = 0;
        });
    }
}

var handleDrop31 = function (event) {
    var dataTransfer = event.dataTransfer;
    var files = dataTransfer.files;

    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        var reader = new FileReader();

        reader.readAsDataURL(file);
        reader.addEventListener('loadend', function (event, file) {
            imagePreviewUrlElem37.src = this.result;
            $('#plus-37').hide();
            $('#image-preview-37').show();

            if (switching != 0 && link[37] != null) {
                $('#image-preview-' + switching).attr('src', link[37]);

                link[switching] = link[37];

            } else if (switching != 0) {
                $('#image-preview-' + switching).hide();
                $('#plus-' + switching).show();

                link[switching] = null;
            }

            link[37] = this.result;
            $('#file-37').text(this.result);
            checkFile();
            switching = 0;
        });
    }
}

var handleDrop32 = function (event) {
    var dataTransfer = event.dataTransfer;
    var files = dataTransfer.files;


    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        var reader = new FileReader();

        reader.readAsDataURL(file);
        reader.addEventListener('loadend', function (event, file) {
            imagePreviewUrlElem38.src = this.result;
            $('#plus-38').hide();
            $('#image-preview-38').show();

            if (switching != 0 && link[38] != null) {
                $('#image-preview-' + switching).attr('src', link[38]);

                link[switching] = link[38];

            } else if (switching != 0) {
                $('#image-preview-' + switching).hide();
                $('#plus-' + switching).show();

                link[switching] = null;
            }

            link[38] = this.result;
            $('#file-38').text(this.result);
            checkFile();
            switching = 0;
        });
    }
}

var handleDrop33 = function (event) {
    var dataTransfer = event.dataTransfer;
    var files = dataTransfer.files;

    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        var reader = new FileReader();

        reader.readAsDataURL(file);
        reader.addEventListener('loadend', function (event, file) {
            imagePreviewUrlElem39.src = this.result;
            $('#plus-39').hide();
            $('#image-preview-39').show();

            if (switching != 0 && link[39] != null) {
                $('#image-preview-' + switching).attr('src', link[39]);

                link[switching] = link[39];

            } else if (switching != 0) {
                $('#image-preview-' + switching).hide();
                $('#plus-' + switching).show();

                link[switching] = null;
            }

            link[39] = this.result;
            $('#file-39').text(this.result);
            checkFile();
            switching = 0;
        });
    }
}

var handleDrop34 = function (event) {
    var dataTransfer = event.dataTransfer;
    var files = dataTransfer.files;

    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        var reader = new FileReader();

        reader.readAsDataURL(file);
        reader.addEventListener('loadend', function (event, file) {
            imagePreviewUrlElem40.src = this.result;
            $('#plus-40').hide();
            $('#image-preview-40').show();

            if (switching != 0 && link[40] != null) {
                $('#image-preview-' + switching).attr('src', link[40]);

                link[switching] = link[40];

            } else if (switching != 0) {
                $('#image-preview-' + switching).hide();
                $('#plus-' + switching).show();

                link[switching] = null;
            }

            link[40] = this.result;
            $('#file-40').text(this.result);
            checkFile();
            switching = 0;
        });
    }
}

var handleDrop35 = function (event) {
    var dataTransfer = event.dataTransfer;
    var files = dataTransfer.files;

    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        var reader = new FileReader();

        reader.readAsDataURL(file);
        reader.addEventListener('loadend', function (event, file) {
            imagePreviewUrlElem31.src = this.result;
            $('#plus-31').hide();
            $('#image-preview-31').show();

            if (switching != 0 && link[31] != null) {
                $('#image-preview-' + switching).attr('src', link[31]);

                link[switching] = link[31];

            } else if (switching != 0) {
                $('#image-preview-' + switching).hide();
                $('#plus-' + switching).show();

                link[switching] = null;
            }

            link[31] = this.result;
            $('#file-31').text(this.result);
            checkFile();
            switching = 0;
        });
    }
}

var handleDrop36 = function (event) {
    var dataTransfer = event.dataTransfer;
    var files = dataTransfer.files;

    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        var reader = new FileReader();

        reader.readAsDataURL(file);
        reader.addEventListener('loadend', function (event, file) {
            imagePreviewUrlElem32.src = this.result;
            $('#plus-32').hide();
            $('#image-preview-32').show();

            if (switching != 0 && link[32] != null) {
                $('#image-preview-' + switching).attr('src', link[32]);

                link[switching] = link[32];

            } else if (switching != 0) {
                $('#image-preview-' + switching).hide();
                $('#plus-' + switching).show();

                link[switching] = null;
            }

            link[32] = this.result;
            $('#file-32').text(this.result);
            checkFile();
            switching = 0;
        });
    }
}

var handleDrop37 = function (event) {
    var dataTransfer = event.dataTransfer;
    var files = dataTransfer.files;

    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        var reader = new FileReader();

        reader.readAsDataURL(file);
        reader.addEventListener('loadend', function (event, file) {
            imagePreviewUrlElem33.src = this.result;
            $('#plus-33').hide();
            $('#image-preview-33').show();

            if (switching != 0 && link[33] != null) {
                $('#image-preview-' + switching).attr('src', link[33]);

                link[switching] = link[33];

            } else if (switching != 0) {
                $('#image-preview-' + switching).hide();
                $('#plus-' + switching).show();

                link[switching] = null;
            }

            link[33] = this.result;
            $('#file-33').text(this.result);
            checkFile();
            switching = 0;
        });
    }
}

var handleDrop38 = function (event) {
    var dataTransfer = event.dataTransfer;
    var files = dataTransfer.files;

    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        var reader = new FileReader();

        reader.readAsDataURL(file);
        reader.addEventListener('loadend', function (event, file) {
            imagePreviewUrlElem34.src = this.result;
            $('#plus-34').hide();
            $('#image-preview-34').show();

            if (switching != 0 && link[34] != null) {
                $('#image-preview-' + switching).attr('src', link[34]);

                link[switching] = link[34];

            } else if (switching != 0) {
                $('#image-preview-' + switching).hide();
                $('#plus-' + switching).show();

                link[switching] = null;
            }

            link[34] = this.result;
            $('#file-34').text(this.result);
            checkFile();
            switching = 0;
        });
    }
}

var handleDrop39 = function (event) {
    var dataTransfer = event.dataTransfer;
    var files = dataTransfer.files;

    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        var reader = new FileReader();

        reader.readAsDataURL(file);
        reader.addEventListener('loadend', function (event, file) {
            imagePreviewUrlElem35.src = this.result;
            $('#plus-35').hide();
            $('#image-preview-35').show();

            if (switching != 0 && link[35] != null) {
                $('#image-preview-' + switching).attr('src', link[35]);

                link[switching] = link[35];

            } else if (switching != 0) {
                $('#image-preview-' + switching).hide();
                $('#plus-' + switching).show();

                link[switching] = null;
            }

            link[35] = this.result;
            $('#file-35').text(this.result);
            checkFile();
            switching = 0;
        });
    }
}

var handleDrop40 = function (event) {
    var dataTransfer = event.dataTransfer;
    var files = dataTransfer.files;

    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        var reader = new FileReader();

        reader.readAsDataURL(file);
        reader.addEventListener('loadend', function (event, file) {
            imagePreviewUrlElem36.src = this.result;
            $('#plus-36').hide();
            $('#image-preview-36').show();

            if (switching != 0 && link[36] != null) {
                $('#image-preview-' + switching).attr('src', link[36]);

                link[switching] = link[36];

            } else if (switching != 0) {
                $('#image-preview-' + switching).hide();
                $('#plus-' + switching).show();

                link[switching] = null;
            }

            link[36] = this.result;
            $('#file-36').text(this.result);
            checkFile();
            switching = 0;
        });
    }
}

inputDragElem21.addEventListener('dragstart', function (event) {

    switching = 21;
    console.log(switching);

}, false);

inputDragElem21.addEventListener('dragover', function (event) {

    preventDefault(event);
    clearBorder();
    $('#big-icon-21').css('background-color', '#f2ad33');

});

inputDragElem21.addEventListener('dragenter', preventDefault);
inputDragElem21.addEventListener('drop', function (event) {

    preventDefault(event);
    handleDrop21(event);
    clearBlur();
    clearBorder();

    // switching = 0;

}, false);

inputDragElem22.addEventListener('dragstart', function (event) {

    switching = 22;
    console.log(switching);

}, false);

inputDragElem22.addEventListener('dragover', function (event) {

    preventDefault(event);
    clearBorder();
    $('#big-icon-22').css('background-color', '#f2ad33');

});

inputDragElem22.addEventListener('dragenter', preventDefault);
inputDragElem22.addEventListener('drop', function (event) {

    preventDefault(event);
    handleDrop22(event);
    clearBlur();
    clearBorder();

    // switching = 0;

}, false);

inputDragElem23.addEventListener('dragstart', function (event) {

    switching = 23;
    console.log(switching);

}, false);

inputDragElem23.addEventListener('dragover', function (event) {

    preventDefault(event);
    clearBorder();
    $('#big-icon-23').css('background-color', '#f2ad33');

});

inputDragElem23.addEventListener('dragenter', preventDefault);
inputDragElem23.addEventListener('drop', function (event) {

    preventDefault(event);
    handleDrop23(event);
    clearBlur();
    clearBorder();

    // switching = 0;

}, false);

inputDragElem24.addEventListener('dragstart', function (event) {

    switching = 24;
    console.log(switching);

}, false);

inputDragElem24.addEventListener('dragover', function (event) {

    preventDefault(event);
    clearBorder();
    $('#big-icon-24').css('background-color', '#f2ad33');

});

inputDragElem24.addEventListener('dragenter', preventDefault);
inputDragElem24.addEventListener('drop', function (event) {

    preventDefault(event);
    handleDrop24(event);
    clearBlur();
    clearBorder();

    // switching = 0;

}, false);

inputDragElem25.addEventListener('dragstart', function (event) {

    switching = 25;
    console.log(switching);

}, false);

inputDragElem25.addEventListener('dragover', function (event) {

    preventDefault(event);
    clearBorder();
    $('#main-center-2').css('background-color', '#f2ad33');

});
inputDragElem25.addEventListener('dragenter', preventDefault);
inputDragElem25.addEventListener('drop', function (event) {

    preventDefault(event);
    handleDrop25(event);
    clearBlur();
    clearBorder();

    // switching = 0;

}, false);

inputDragElem26.addEventListener('dragstart', function (event) {

    switching = 26;
    console.log(switching);

}, false);

inputDragElem26.addEventListener('dragover', function (event) {

    preventDefault(event);
    clearBorder();
    $('#small-icon-21').css('background-color', '#f2ad33');

});

inputDragElem26.addEventListener('dragenter', preventDefault);
inputDragElem26.addEventListener('drop', function (event) {

    preventDefault(event);
    handleDrop26(event);
    clearBlur();
    clearBorder();

    // switching = 0;

}, false);

inputDragElem27.addEventListener('dragstart', function (event) {

    switching = 27;
    console.log(switching);

}, false);

inputDragElem27.addEventListener('dragover', function (event) {

    preventDefault(event);
    clearBorder();
    $('#small-icon-22').css('background-color', '#f2ad33');

});
inputDragElem27.addEventListener('dragenter', preventDefault);
inputDragElem27.addEventListener('drop', function (event) {

    preventDefault(event);
    handleDrop27(event);
    clearBlur();
    clearBorder();

    // switching = 0;

}, false);

inputDragElem28.addEventListener('dragstart', function (event) {

    switching = 28;
    console.log(switching);

}, false);

inputDragElem28.addEventListener('dragover', function (event) {

    preventDefault(event);
    clearBorder();
    $('#small-icon-23').css('background-color', '#f2ad33');

});

inputDragElem28.addEventListener('dragenter', preventDefault);
inputDragElem28.addEventListener('drop', function (event) {

    preventDefault(event);
    handleDrop28(event);
    clearBlur();
    clearBorder();

    // switching = 0;

}, false);

inputDragElem29.addEventListener('dragstart', function (event) {

    switching = 29;
    console.log(switching);

}, false);

inputDragElem29.addEventListener('dragover', function (event) {

    preventDefault(event);
    clearBorder();
    $('#small-icon-24').css('background-color', '#f2ad33');

});

inputDragElem29.addEventListener('dragenter', preventDefault);
inputDragElem29.addEventListener('drop', function (event) {

    preventDefault(event);
    handleDrop29(event);
    clearBlur();
    clearBorder();

    // switching = 0;

}, false);

inputDragElem30.addEventListener('dragstart', function (event) {

    switching = 30;
    console.log(switching);

}, false);

inputDragElem30.addEventListener('dragover', function (event) {

    preventDefault(event);
    clearBorder();
    $('#small-icon-25').css('background-color', '#f2ad33');

});

inputDragElem30.addEventListener('dragenter', preventDefault);
inputDragElem30.addEventListener('drop', function (event) {

    preventDefault(event);
    handleDrop30(event);
    clearBlur();
    clearBorder();

    // switching = 0;

}, false);

inputDragElem31.addEventListener('dragstart', function (event) {

    switching = 37;
    console.log(switching);

}, false);

inputDragElem31.addEventListener('dragover', function (event) {

    preventDefault(event);
    clearBorder();
    $('#big-icon-26').css('background-color', '#f2ad33');

});

inputDragElem31.addEventListener('dragenter', preventDefault);
inputDragElem31.addEventListener('drop', function (event) {

    preventDefault(event);
    handleDrop31(event);
    clearBlur();
    clearBorder();

    // switching = 0;

}, false);

inputDragElem32.addEventListener('dragstart', function (event) {

    switching = 38;
    console.log(switching);

}, false);

inputDragElem32.addEventListener('dragover', function (event) {

    preventDefault(event);
    clearBorder();
    $('#big-icon-27').css('background-color', '#f2ad33');

});

inputDragElem32.addEventListener('dragenter', preventDefault);
inputDragElem32.addEventListener('drop', function (event) {

    preventDefault(event);
    handleDrop32(event);
    clearBlur();
    clearBorder();

    // switching = 0;

}, false);

inputDragElem33.addEventListener('dragstart', function (event) {

    switching = 39;
    console.log(switching);

}, false);

inputDragElem33.addEventListener('dragover', function (event) {

    preventDefault(event);
    clearBorder();
    $('#big-icon-28').css('background-color', '#f2ad33');

});

inputDragElem33.addEventListener('dragenter', preventDefault);
inputDragElem33.addEventListener('drop', function (event) {

    preventDefault(event);
    handleDrop33(event);
    clearBlur();
    clearBorder();

    // switching = 0;

}, false);

inputDragElem34.addEventListener('dragstart', function (event) {

    switching = 40;
    console.log(switching);

}, false);

inputDragElem34.addEventListener('dragover', function (event) {

    preventDefault(event);
    clearBorder();
    $('#big-icon-29').css('background-color', '#f2ad33');

});

inputDragElem34.addEventListener('dragenter', preventDefault);
inputDragElem34.addEventListener('drop', function (event) {

    preventDefault(event);
    handleDrop34(event);
    clearBlur();
    clearBorder();

    // switching = 0;

}, false);

inputDragElem35.addEventListener('dragstart', function (event) {

    switching = 31;
    console.log(switching);

}, false);

inputDragElem35.addEventListener('dragover', function (event) {

    preventDefault(event);
    clearBorder();
    $('#floating-button-2').css('background-color', '#f2ad33');

});

inputDragElem35.addEventListener('dragenter', preventDefault);
inputDragElem35.addEventListener('drop', function (event) {

    preventDefault(event);
    handleDrop35(event);
    clearBlur();
    clearBorder();

    // switching = 0;

}, false);

inputDragElem36.addEventListener('dragstart', function (event) {

    switching = 32;
    console.log(switching);

}, false);

inputDragElem36.addEventListener('dragover', function (event) {

    preventDefault(event);
    clearBorder();
    $('#small-icon-26').css('background-color', '#f2ad33');

});

inputDragElem36.addEventListener('dragenter', preventDefault);
inputDragElem36.addEventListener('drop', function (event) {

    preventDefault(event);
    handleDrop36(event);
    clearBlur();
    clearBorder();

    // switching = 0;

}, false);

inputDragElem37.addEventListener('dragstart', function (event) {

    switching = 33;
    console.log(switching);

}, false);

inputDragElem37.addEventListener('dragover', function (event) {

    preventDefault(event);
    clearBorder();
    $('#small-icon-27').css('background-color', '#f2ad33');

});

inputDragElem37.addEventListener('dragenter', preventDefault);
inputDragElem37.addEventListener('drop', function (event) {

    preventDefault(event);
    handleDrop37(event);
    clearBlur();
    clearBorder();

    // switching = 0;

}, false);

inputDragElem38.addEventListener('dragstart', function (event) {

    switching = 34;
    console.log(switching);

}, false);

inputDragElem38.addEventListener('dragover', function (event) {

    preventDefault(event);
    clearBorder();
    $('#small-icon-28').css('background-color', '#f2ad33');

});

inputDragElem38.addEventListener('dragenter', preventDefault);
inputDragElem38.addEventListener('drop', function (event) {

    preventDefault(event);
    handleDrop38(event);
    clearBlur();
    clearBorder();

    // switching = 0;

}, false);

inputDragElem39.addEventListener('dragstart', function (event) {

    switching = 35;
    console.log(switching);

}, false);

inputDragElem39.addEventListener('dragover', function (event) {

    preventDefault(event);
    clearBorder();
    $('#small-icon-29').css('background-color', '#f2ad33');

});

inputDragElem39.addEventListener('dragenter', preventDefault);
inputDragElem39.addEventListener('drop', function (event) {

    preventDefault(event);
    handleDrop39(event);
    clearBlur();
    clearBorder();

    // switching = 0;

}, false);

inputDragElem40.addEventListener('dragstart', function (event) {

    switching = 36;
    console.log(switching);

}, false);

inputDragElem40.addEventListener('dragover', function (event) {

    preventDefault(event);
    clearBorder();
    $('#small-icon-30').css('background-color', '#f2ad33');

});

inputDragElem40.addEventListener('dragenter', preventDefault);
inputDragElem40.addEventListener('drop', function (event) {

    preventDefault(event);
    handleDrop40(event);
    clearBlur();
    clearBorder();

    // switching = 0;

}, false);

// END OF SESSION 2

// FOR BLUE OUTSIDE WHILE DRAGGIN PICTURES

// SESSION 1

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

// END OF SESSION 1

// SESSION 2

let outsideTwo = document.getElementById('generate-apk-form-2');

outsideTwo.addEventListener('dragover', function (event) {
    preventDefault(event);
    $('.main-sidebar').css('opacity', '0.2');
    $('.left-side').css('opacity', '0.2');
    $('.blur').css('opacity', '0.2');
    $('#outside-text-2').removeClass('d-none');
});
outsideTwo.addEventListener('dragenter', preventDefault);
outsideTwo.addEventListener('drop', function (event) {
    preventDefault(event);

    $('#image-preview-' + switching).attr('src', '');
    $('#image-preview-' + switching).hide();
    $('#plus-' + switching).show();
    $('#outside-text-2').addClass('d-none');

    if (switching == 21) {
        link[21] = null;
    } else if (switching == 22) {
        link[22] = null;
    } else if (switching == 23) {
        link[23] = null;
    } else if (switching == 24) {
        link[24] = null;
    } else if (switching == 25) {
        link[25] = null;
    } else if (switching == 26) {
        link[26] = null;
    } else if (switching == 27) {
        link[27] = null;
    } else if (switching == 28) {
        link[28] = null;
    } else if (switching == 29) {
        link[29] = null;
    } else if (switching == 30) {
        link[30] = null;
    } else if (switching == 31) {
        link[31] = null;
    } else if (switching == 32) {
        link[32] = null;
    } else if (switching == 33) {
        link[33] = null;
    } else if (switching == 34) {
        link[34] = null;
    } else if (switching == 35) {
        link[35] = null;
    } else if (switching == 36) {
        link[36] = null;
    } else if (switching == 37) {
        link[37] = null;
    } else if (switching == 38) {
        link[38] = null;
    } else if (switching == 39) {
        link[39] = null;
    } else if (switching == 40) {
        link[40] = null;
    }

    // if (switching != 0) {
    //     link[switching] = null;
    // }

    switching = 0;
    checkFile();
    clearBlur();
    clearBorder();

}, false);

// END OF SESSION 2

// CONSOLE.LOG AFTER DRAGGING PICTURES

// SESSION 1

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
var splashscreen = '';
var certificate = "";

// SESSION 2

var tab1_2 = "";
var tab2_2 = "";
var tab3_2 = "";
var tab4_2 = "";

var cpaas_edit = "";
var messaging_edit = "";
var call_edit = "";
var contact_edit = "";
var post_edit = "";
var streaming_edit = "";

var background_edit = [];

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

    // SESSION 1
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
        streaming_edit = null;
    }

    // END OF SESSION 1

    // SESSION 2

    if (link[21] != null || link[37] != null) {
        if (link[21] != null) {
            tab1_2 = link[21];
        } else if (link[37] != null) {
            tab1_2 = link[37];
        }
    } else {
        tab1_2 = null;
    }

    if (link[22] != null || link[38] != null) {
        if (link[22] != null) {
            tab2_2 = link[22];
        } else if (link[38] != null) {
            tab2_2 = link[38];
        }
    } else {
        tab2_2 = null;
    }

    if (link[23] != null || link[39] != null) {
        if (link[23] != null) {
            tab3_2 = link[23];
        } else if (link[39] != null) {
            tab3_2 = link[39];
        }
    } else {
        tab3_2 = null;
    }

    if (link[24] != null || link[40] != null) {
        if (link[24] != null) {
            tab4_2 = link[24];
        } else if (link[40] != null) {
            tab4_2 = link[40];
        }
    } else {
        tab4_2 = null;
    }

    if (link[25] != null || link[31] != null) {
        if (link[25] != null) {
            cpaas_edit = link[25];
        } else if (link[31] != null) {
            cpaas_edit = link[31];
        }
    } else {
        cpaas_edit = null;
    }

    if (link[30] != null || link[34] != null) {
        if (link[30] != null) {
            messaging_edit = link[30];
        } else if (link[34] != null) {
            messaging_edit = link[34];
        }
    } else {
        messaging_edit = null;
    }

    if (link[29] != null || link[35] != null) {
        if (link[29] != null) {
            call_edit = link[29];
        } else if (link[35] != null) {
            call_edit = link[35];
        }
    } else {
        call_edit = null;
    }

    if (link[26] != null || link[32] != null) {
        if (link[26] != null) {
            contact_edit = link[26];
        } else if (link[32] != null) {
            contact_edit = link[32];
        }
    } else {
        contact_edit = null;
    }

    if (link[27] != null || link[33] != null) {
        if (link[27] != null) {
            post_edit = link[27];
        } else if (link[33] != null) {
            post_edit = link[33];
        }
    } else {
        post_edit = null;
    }

    if (link[28] != null || link[36] != null) {
        if (link[28] != null) {
            streaming_edit = link[28];
        } else if (link[36] != null) {
            streaming_edit = link[36];
        }
    } else {
        streaming_edit = null;
    }

    // END OF SESSION 2

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
    $('#outside-text-2').addClass('d-none');
}

// WHEN DROP PICTURE BACKGROUND HIGHLIGHT DISSAPEAR

function clearBorder() {

    // FOR SESSION 1

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

    // END OF SESSION 1

    // FOR SESSION 2

    $('#big-icon-21').css('background-color', '#d7d7d7');
    $('#big-icon-22').css('background-color', '#d7d7d7');
    $('#big-icon-23').css('background-color', '#d7d7d7');
    $('#big-icon-24').css('background-color', '#d7d7d7');
    $('#main-center-2').css('background-color', 'grey');
    $('#big-icon-26').css('background-color', '#d7d7d7');
    $('#big-icon-27').css('background-color', '#d7d7d7');
    $('#big-icon-28').css('background-color', '#d7d7d7');
    $('#big-icon-29').css('background-color', '#d7d7d7');
    $('#floating-button-2').css('background-color', 'grey');
    $('#small-icon-21').css('background-color', '#d7d7d7');
    $('#small-icon-22').css('background-color', '#d7d7d7');
    $('#small-icon-23').css('background-color', '#d7d7d7');
    $('#small-icon-24').css('background-color', '#d7d7d7');
    $('#small-icon-25').css('background-color', '#d7d7d7');
    $('#small-icon-26').css('background-color', '#d7d7d7');
    $('#small-icon-27').css('background-color', '#d7d7d7');
    $('#small-icon-28').css('background-color', '#d7d7d7');
    $('#small-icon-29').css('background-color', '#d7d7d7');
    $('#small-icon-30').css('background-color', '#d7d7d7');

    // END OF SESSION 2
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

$(".docked-content-3").hide();
$("#burger-area-2").hide();
$("#sub-docked-button-3").hide();
$("#sub-docked-button-4").hide();
$("#sub-burger-button-2").hide();

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

        $('#show_fb_options').addClass('d-none');
        $('#show_fb_options').html('');

        let fb_pp_radio = `
        <label class="col-sm-4 col-form-label" for="access_model">Use Floating Button image as Profile Pict. :</label>

        <div class="col-sm-8">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="fb_pp" id="fb_pp1" value="1">
                <label class="form-check-label" for="fb_pp1">Yes</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="fb_pp" id="fb_pp0" value="0" checked>
                <label class="form-check-label" for="fb_pp0">No</label>
            </div>
        </div>
        `

        $('#fb_pp_options').html(fb_pp_radio);
        $('#fb_pp_options').removeClass('d-none');
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

        let show_fb_radio = `
        <label class="col-sm-4 col-form-label" for="access_model">Show Floating Button :</label>

        <div class="col-sm-8">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="show_fb" id="show_fb1" value="1">
                <label class="form-check-label" for="show_fb1">Yes</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="show_fb" id="show_fb0" value="0" checked>
                <label class="form-check-label" for="show_fb0">No</label>
            </div>
        </div>`

        let fb_pp_radio = `
        <label class="col-sm-4 col-form-label" for="access_model">Use Floating Button image as Profile Pict. :</label>

        <div class="col-sm-8">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="fb_pp" id="fb_pp1" value="1">
                <label class="form-check-label" for="fb_pp1">Yes</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="fb_pp" id="fb_pp0" value="0" checked>
                <label class="form-check-label" for="fb_pp0">No</label>
            </div>
        </div>
        `

        $('#fb_pp_options').html(fb_pp_radio);
        $('#fb_pp_options').removeClass('d-none');


        $('#show_fb_options').html(show_fb_radio);
        $('#show_fb_options').removeClass('d-none');
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

        $('#show_fb_options').addClass('d-none');
        $('#show_fb_options').html('');

        $('#fb_pp_options').html('');
        $('#fb_pp_options').addClass('d-none');
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

function selectTabMenuTwo() {

    var menuTypeTwo = $('#menuTypeTwo').val();

    if (menuTypeTwo == 0) {
        $("#palio-balloon-2").show();
        $(".docked-content-3").hide();
        $(".docked-content-4").show();
        $("#burger-area-2").hide();
        $("#sub-floating-button-3").show();
        $("#sub-floating-button-4").show();
        $("#sub-docked-button-3").hide();
        $("#sub-docked-button-4").hide();
        $("#sub-burger-button-2").hide();

        $('#show_fb_options_2').addClass('d-none');
        $('#show_fb_options_2').html('');

        let fb_pp_radio_two = `
        <label class="col-sm-4 col-form-label" for="access_model_edit">Use Floating Button image as Profile Pict. :</label>

        <div class="col-sm-8">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="fb_pp_1" id="fb_pp3" value="1">
                <label class="form-check-label" for="fb_pp3">Yes</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="fb_pp_1" id="fb_pp2" value="0" checked>
                <label class="form-check-label" for="fb_pp2">No</label>
            </div>
        </div>
        `

        $('#fb_pp_options_2').html(fb_pp_radio_two);
        $('#fb_pp_options_2').removeClass('d-none');
    } else if (menuTypeTwo == 1) {
        $("#palio-balloon-2").hide();
        $(".docked-content-3").show();
        $(".docked-content-4").hide();
        $("#burger-area-2").hide();
        $("#sub-floating-button-3").hide();
        $("#sub-floating-button-4").hide();
        $("#sub-docked-button-3").show();
        $("#sub-docked-button-4").show();
        $("#sub-burger-button-2").hide();

        let show_fb_radio_two = `
        <label class="col-sm-4 col-form-label" for="access_model_edit">Show Floating Button :</label>

        <div class="col-sm-8">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="show_fb_edit" id="show_fb_two1" value="1">
                <label class="form-check-label" for="show_fb_two1">Yes</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="show_fb_edit" id="show_fb_two0" value="0" checked>
                <label class="form-check-label" for="show_fb_two0">No</label>
            </div>
        </div>`

        let fb_pp_radio_two = `
        <label class="col-sm-4 col-form-label" for="access_model_edit">Use Floating Button image as Profile Pict. :</label>

        <div class="col-sm-8">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="fb_pp_edit" id="fb_pp_two1" value="1">
                <label class="form-check-label" for="fb_pp_two1">Yes</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="fb_pp_edit" id="fb_pp_two0" value="0" checked>
                <label class="form-check-label" for="fb_pp_two0">No</label>
            </div>
        </div>
        `

        $('#fb_pp_options_2').html(show_fb_radio_two);
        $('#fb_pp_options_2').removeClass('d-none');


        $('#show_fb_options_2').html(fb_pp_radio_two);
        $('#show_fb_options_2').removeClass('d-none');
    } else {
        $("#palio-balloon-2").hide();
        $(".docked-content-3").hide();
        $(".docked-content-4").show();
        $("#burger-area-2").show();
        $("#sub-floating-button-3").hide();
        $("#sub-floating-button-4").hide();
        $("#sub-docked-button-3").hide();
        $("#sub-docked-button-4").hide();
        $("#sub-burger-button-2").show();

        $('#show_fb_options_2').addClass('d-none');
        $('#show_fb_options_2').html('');

        $('#fb_pp_options_2').html('');
        $('#fb_pp_options_2').addClass('d-none');
    }

    // CLEAR ALL IMAGES WHILE SWITCH CPAAS MODEL

    // SESSION 2

    link[21] = null;
    link[22] = null;
    link[23] = null;
    link[24] = null;
    link[25] = null;
    link[26] = null;
    link[27] = null;
    link[28] = null;
    link[29] = null;
    link[30] = null;
    link[31] = null;
    link[32] = null;
    link[33] = null;
    link[34] = null;
    link[35] = null;
    link[36] = null;
    link[37] = null;
    link[38] = null;
    link[39] = null;
    link[40] = null;

    // END OF CLEAR ALL IMAGES WHILE SWITCH CPAAS MODEL

    $('#image-preview-21').hide();
    $('#image-preview-21').attr('src', '');
    $('#image-preview-22').hide();
    $('#image-preview-22').attr('src', '');
    $('#image-preview-23').hide();
    $('#image-preview-23').attr('src', '');
    $('#image-preview-24').hide();
    $('#image-preview-24').attr('src', '');
    $('#image-preview-25').hide();
    $('#image-preview-25').attr('src', '');
    $('#image-preview-26').hide();
    $('#image-preview-26').attr('src', '');
    $('#image-preview-27').hide();
    $('#image-preview-27').attr('src', '');
    $('#image-preview-28').hide();
    $('#image-preview-28').attr('src', '');
    $('#image-preview-29').hide();
    $('#image-preview-29').attr('src', '');
    $('#image-preview-30').hide();
    $('#image-preview-30').attr('src', '');
    $('#image-preview-31').hide();
    $('#image-preview-31').attr('src', '');
    $('#image-preview-32').hide();
    $('#image-preview-32').attr('src', '');
    $('#image-preview-33').hide();
    $('#image-preview-33').attr('src', '');
    $('#image-preview-34').hide();
    $('#image-preview-34').attr('src', '');
    $('#image-preview-35').hide();
    $('#image-preview-35').attr('src', '');
    $('#image-preview-36').hide();
    $('#image-preview-36').attr('src', '');
    $('#image-preview-37').hide();
    $('#image-preview-37').attr('src', '');
    $('#image-preview-38').hide();
    $('#image-preview-38').attr('src', '');
    $('#image-preview-39').hide();
    $('#image-preview-39').attr('src', '');
    $('#image-preview-40').hide();
    $('#image-preview-40').attr('src', '');

    $('#plus-21').show();
    $('#plus-22').show();
    $('#plus-23').show();
    $('#plus-24').show();
    $('#plus-25').show();
    $('#plus-26').show();
    $('#plus-27').show();
    $('#plus-28').show();
    $('#plus-29').show();
    $('#plus-30').show();
    $('#plus-31').show();
    $('#plus-32').show();
    $('#plus-33').show();
    $('#plus-34').show();
    $('#plus-35').show();
    $('#plus-36').show();
    $('#plus-37').show();
    $('#plus-38').show();
    $('#plus-39').show();
    $('#plus-40').show();

    // END SESSION 2

}

// SELECT FILE FROM BUTTON + IN PHONE (SESSION 1)

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

// END OF SELECT FILE FROM BUTTON + IN PHONE (SESSION 1)

// SELECT FILE FROM BUTTON + IN PHONE (SESSION 2)

var loadFile21 = function (event) {
    var reader = new FileReader();
    reader.onload = function () {
        ;
        $('#plus-21').hide();
        $('#image-preview-21').attr('src', reader.result);
        $('#image-preview-21').show();
        link[21] = reader.result;
        checkFile();
    };
    reader.readAsDataURL(event.target.files[0]);
}

var loadFile22 = function (event) {
    var reader = new FileReader();
    reader.onload = function () {
        ;
        $('#plus-22').hide();
        $('#image-preview-22').attr('src', reader.result);
        $('#image-preview-22').show();
        link[22] = reader.result;
        checkFile();
    };
    reader.readAsDataURL(event.target.files[0]);
}

var loadFile23 = function (event) {
    var reader = new FileReader();
    reader.onload = function () {
        ;
        $('#plus-23').hide();
        $('#image-preview-23').attr('src', reader.result);
        $('#image-preview-23').show();
        link[23] = reader.result;
        checkFile();
    };
    reader.readAsDataURL(event.target.files[0]);
}

var loadFile24 = function (event) {
    var reader = new FileReader();
    reader.onload = function () {
        ;
        $('#plus-24').hide();
        $('#image-preview-24').attr('src', reader.result);
        $('#image-preview-24').show();
        link[24] = reader.result;
        checkFile();
    };
    reader.readAsDataURL(event.target.files[0]);
}

var loadFile25 = function (event) {
    var reader = new FileReader();
    reader.onload = function () {
        ;
        $('#plus-25').hide();
        $('#image-preview-25').attr('src', reader.result);
        $('#image-preview-25').show();
        link[25] = reader.result;
        checkFile();
    };
    reader.readAsDataURL(event.target.files[0]);
}

var loadFile26 = function (event) {
    var reader = new FileReader();
    reader.onload = function () {
        ;
        $('#plus-26').hide();
        $('#image-preview-26').attr('src', reader.result);
        $('#image-preview-26').show();
        link[26] = reader.result;
        checkFile();
    };
    reader.readAsDataURL(event.target.files[0]);
}

var loadFile27 = function (event) {
    var reader = new FileReader();
    reader.onload = function () {
        ;
        $('#plus-27').hide();
        $('#image-preview-27').attr('src', reader.result);
        $('#image-preview-27').show();
        link[27] = reader.result;
        checkFile();
    };
    reader.readAsDataURL(event.target.files[0]);
}

var loadFile28 = function (event) {
    var reader = new FileReader();
    reader.onload = function () {
        ;
        $('#plus-28').hide();
        $('#image-preview-28').attr('src', reader.result);
        $('#image-preview-28').show();
        link[28] = reader.result;
        checkFile();
    };
    reader.readAsDataURL(event.target.files[0]);
}

var loadFile29 = function (event) {
    var reader = new FileReader();
    reader.onload = function () {
        ;
        $('#plus-29').hide();
        $('#image-preview-29').attr('src', reader.result);
        $('#image-preview-29').show();
        link[29] = reader.result;
        checkFile();
    };
    reader.readAsDataURL(event.target.files[0]);
}


var loadFile30 = function (event) {
    var reader = new FileReader();
    reader.onload = function () {
        ;
        $('#plus-30').hide();
        $('#image-preview-30').attr('src', reader.result);
        $('#image-preview-30').show();
        link[30] = reader.result;
        checkFile();
    };
    reader.readAsDataURL(event.target.files[0]);
}

var loadFile31 = function (event) {
    var reader = new FileReader();
    reader.onload = function () {
        ;
        $('#plus-31').hide();
        $('#image-preview-31').attr('src', reader.result);
        $('#image-preview-31').show();
        link[31] = reader.result;
        checkFile();
    };
    reader.readAsDataURL(event.target.files[0]);
}

var loadFile32 = function (event) {
    var reader = new FileReader();
    reader.onload = function () {
        ;
        $('#plus-32').hide();
        $('#image-preview-32').attr('src', reader.result);
        $('#image-preview-32').show();
        link[32] = reader.result;
        checkFile();
    };
    reader.readAsDataURL(event.target.files[0]);
}

var loadFile33 = function (event) {
    var reader = new FileReader();
    reader.onload = function () {
        ;
        $('#plus-33').hide();
        $('#image-preview-33').attr('src', reader.result);
        $('#image-preview-33').show();
        link[33] = reader.result;
        checkFile();
    };
    reader.readAsDataURL(event.target.files[0]);
}

var loadFile34 = function (event) {
    var reader = new FileReader();
    reader.onload = function () {
        ;
        $('#plus-34').hide();
        $('#image-preview-34').attr('src', reader.result);
        $('#image-preview-34').show();
        link[34] = reader.result;
        checkFile();
    };
    reader.readAsDataURL(event.target.files[0]);
}

var loadFile35 = function (event) {
    var reader = new FileReader();
    reader.onload = function () {
        ;
        $('#plus-35').hide();
        $('#image-preview-35').attr('src', reader.result);
        $('#image-preview-35').show();
        link[35] = reader.result;
        checkFile();
    };
    reader.readAsDataURL(event.target.files[0]);
}

var loadFile36 = function (event) {
    var reader = new FileReader();
    reader.onload = function () {
        ;
        $('#plus-36').hide();
        $('#image-preview-36').attr('src', reader.result);
        $('#image-preview-36').show();
        link[36] = reader.result;
        checkFile();
    };
    reader.readAsDataURL(event.target.files[0]);
}

var loadFile37 = function (event) {
    var reader = new FileReader();
    reader.onload = function () {
        ;
        $('#plus-37').hide();
        $('#image-preview-37').attr('src', reader.result);
        $('#image-preview-37').show();
        link[37] = reader.result;
        checkFile();
    };
    reader.readAsDataURL(event.target.files[0]);
}

var loadFile38 = function (event) {
    var reader = new FileReader();
    reader.onload = function () {
        ;
        $('#plus-38').hide();
        $('#image-preview-38').attr('src', reader.result);
        $('#image-preview-38').show();
        link[38] = reader.result;
        checkFile();
    };
    reader.readAsDataURL(event.target.files[0]);
}

var loadFile39 = function (event) {
    var reader = new FileReader();
    reader.onload = function () {
        ;
        $('#plus-39').hide();
        $('#image-preview-39').attr('src', reader.result);
        $('#image-preview-39').show();
        link[39] = reader.result;
        checkFile();
    };
    reader.readAsDataURL(event.target.files[0]);
}

var loadFile40 = function (event) {
    var reader = new FileReader();
    reader.onload = function () {
        ;
        $('#plus-40').hide();
        $('#image-preview-40').attr('src', reader.result);
        $('#image-preview-40').show();
        link[40] = reader.result;
        checkFile();
    };
    reader.readAsDataURL(event.target.files[0]);
}
// END OF SELECT FILE FROM BUTTON + IN PHONE (SESSION 2)

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
                                <img src="` + background[background.length - 1] + `" class="small-prev-` + background.length + `" style="width: 100%; height: 100%">
                            </div>`;

            $('#small-prev-slot').append(newPreview);

            $('#phone-bg').attr('src', reader.result);
            checkFile();
        };
        reader.readAsDataURL(file);
    })

    console.log("loop", background);

}

var backgroundFileEdit = function (event) {

    console.log("loop", background);

    if (event.target.files.length == 0) {
        background_edit = [];
        $('#small-prev-slot-edit').html("");
        $('#phone-bg-edit').attr('src', "");
    }

    console.log("e.target", event.target.files);

    Array.from(event.target.files).forEach(file => {
        var reader = new FileReader();
        reader.onload = function () {
            background_edit.push(reader.result);

            // LOOP IMAGE PREVIEW BACKGROUND

            var newPreview = `<div class="col-sm-6 col-md-4 col-lg-2 m-2" style="height: 140px; border: 1px dashed #6a6a6a; margin-left: 5px">
                                <img src="` + background_edit[background_edit.length - 1] + `" class="small-prev-` + background_edit.length + `" style="width: 100%; height: 100%">
                            </div>`;

            $('#small-prev-slot-edit').append(newPreview);

            $('#phone-bg-edit').attr('src', reader.result);
            checkFile();
        };
        reader.readAsDataURL(file);
    })

    console.log("loop", background_edit);

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

    // console.log("P", base64_link);

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

// check splash screen size
let ss_input = document.querySelector('input#splashscreen');

// $image_type_arr = array("jpg", "jpeg", "png", "webp");
//     $video_type_arr = array("mp4", "mov", "wmv", 'flv', 'webm', 'mkv', 'gif', 'm4v', 'avi', 'mpg');

let img_type_arr = ["jpg", "jpeg", "png", "webp"];
let vid_type_arr = ["mp4", "mov", "wmv", 'flv', 'webm', 'mkv', 'gif', 'm4v', 'avi', 'mpg'];

ss_input.addEventListener('change', (event) => {
    const target = event.target;
    let reader = new FileReader();
    reader.onload = function () {
        splashscreen = reader.result;
    }
    if (target.files && target.files[0]) {

        const maxAllowedSize = 33554432; // 32 MB
        if (target.files[0].size > maxAllowedSize) {
            // Here you can ask your users to load correct file
            target.value = '';
            alert('File too large! Please limit it to 32 MB or less.');
        } else {
            reader.readAsDataURL(target.files[0]);
        }
    }
})

let existing_bg = "";
let existing_bg_edit = "";

// SET BACKGROUND TO RECENT BACKGROUND SECTION

$('#use-old-bg').on('change', function () {

    if ($(this).is(':checked')) {
        $('#old-bg-list').removeClass('d-none');
        $('#section-background').hide();

        existing_bg = $('#old-bg-hidden').val();
    } else {
        $('#old-bg-list').addClass('d-none');
        $('#section-background').show();

        existing_bg = "";
    }
});

$('#use-old-bg-2').on('change', function () {

    if ($(this).is(':checked')) {
        $('#old-bg-list-2').removeClass('d-none');
        $('#section-background-2').hide();

        existing_bg_edit = $('#old-bg-hidden-2').val();
    } else {
        $('#old-bg-list-2').addClass('d-none');
        $('#section-background-2').show();

        existing_bg_edit = "";
    }
});

//JSON CHECKBOX & VALIDATION
let huawei_checkbox = document.querySelector("#include_hms");
let gps_checkbox = document.querySelector("#include_gps");

huawei_checkbox.addEventListener("change", (e) => {
    console.log('huawei', huawei_checkbox.checked)
    if (huawei_checkbox.checked) {
        $("#huawei_json").removeClass("d-none");
        // $("#gps_json").addClass("d-none");
        // document.querySelector("input#gps_pushkit").value = "";
    } else {
        $("#huawei_json").addClass("d-none");
        document.querySelector("input#huawei_pushkit").value = "";
    }
})

gps_checkbox.addEventListener("change", (e) => {
    console.log('gps', gps_checkbox.checked)
    if (gps_checkbox.checked) {
        $("#gps_json").removeClass("d-none");
        // $("#huawei_json").addClass("d-none");
        // document.querySelector("input#huawei_pushkit").value = "";
    } else {
        $("#gps_json").addClass("d-none");
        document.querySelector("input#gps_pushkit").value = "";
    }
})

function onChangeHuawei(event) {
    var reader = new FileReader();
    reader.onload = validatePackageNameHuawei;
    reader.readAsText(event.target.files[0]);
}

function validatePackageNameHuawei(event){
    // console.log(event.target.result);

    let appId = document.querySelector("input#appId").value;

    let isJSONValid = event.target.result.includes(appId);
    console.log("isJSONValidHuawei", isJSONValid);

    let huawei_warning = document.querySelector("#huawei_pushkit_validation");

    if (!isJSONValid) {
        huawei_warning.classList.remove("d-none");
        document.querySelector("input#huawei_pushkit").value = "";
    } else {
        huawei_warning.classList.add("d-none");
    }
}

function onChangeGPS(event) {
    var reader = new FileReader();
    reader.onload = validatePackageNameGPS;
    reader.readAsText(event.target.files[0]);
}

function validatePackageNameGPS(event){
    // console.log(event.target.result);

    let appId = document.querySelector("input#appId").value;

    let isJSONValid = event.target.result.includes(appId);
    console.log("isJSONValidGPS", isJSONValid);

    let gps_warning = document.querySelector("#gps_pushkit_validation");

    if (!isJSONValid) {
        gps_warning.classList.remove("d-none");
        document.querySelector("input#gps_pushkit").value = "";
    } else {
        gps_warning.classList.add("d-none");
    }
}

document.getElementById('huawei_pushkit').addEventListener('change', onChangeHuawei);
// document.getElementById('gps_pushkit').addEventListener('change', onChangeGPS);
// END JSON VALIDATION

// $('#ver_name').on('input', function () {
//     let rgx = /^[\.0-9A-Za-z]*$/;
//     let str = $(this).val();
//     if (!rgx.test(str)) {
//         document.getElementById("submit-form").setAttribute("disabled", "disabled");
//         $('#ver_name_format').removeClass("d-none");
//     } else {
//         document.getElementById("submit-form").removeAttribute("disabled");
//         $('#ver_name_format').addClass("d-none");
//     }
// });

// SEND FORM

function sendData() {

    let formInvalid = true;
    let whichInvalid = "";

    // if ($('#generate-apk').is(':checked')) {

    // console.log('MANA COK', document.getElementById('url_content').value);

    var formData = new FormData();

    // DECLARE VAR FROM VAL

    var companyWebsite = $('#companyWebsite').val();
    var companyName = $('#companyName').val();
    var appId = $('#appId').val();

    var tab1_page = $('#tab1').val() != '0' ? $('#tab1').val() : '';
    var tab2_page = $('#tab2').val() != '0' ? $('#tab2').val() : '';
    var tab3_page = $('#tab3').val() != '0' ? $('#tab3').val() : '';
    var tab4_page = $('#tab4').val() != '0' ? $('#tab4').val() : '';

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
    var menuTypeTwo = $('#menuTypeTwo').val();
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

    if (splashscreen != '') {
        // console.log('ss', splashscreen);

        let ss_file = newFormat(splashscreen);

        formData.append('splashscreen', ss_file);
    }

    // SESSION 1

    var enable_sms = 0;
    if ($('#enable_sms').is(':checked')) {
        enable_sms = 1;
    }

    var enable_osint = 0;
    if ($('#enable_osint').is(':checked')) {
        enable_osint = 1;
    }
    var enable_scan = 0;
    if ($('#enable_scan').is(':checked')) {
        enable_scan = 1;
    }
    var enable_email = 0;
    if ($('#enable_email').is(':checked')) {
        enable_email = 1;
    }
    var enable_loc = 0;
    if ($('#enable_loc').is(':checked')) {
        enable_loc = 1;
    }

    var nx_im_theme = $("#nx_im_theme").val();
    var nx_ac_theme = $("#nx_ac_theme").val();
    var nx_vc_theme = $("#nx_vc_theme").val();
    var nx_ls_theme = $("#nx_ls_theme").val();
    var nx_sm_theme = $("#nx_sm_theme").val();

    // SESSION 2

    var enable_sms_edit = 0;
    if ($('#enable_sms_edit').is(':checked')) {
        enable_sms_edit = 1;
    }

    var enable_osint_edit = 0;
    if ($('#enable_osint_edit').is(':checked')) {
        enable_osint_edit = 1;
    }
    var enable_scan_edit = 0;
    if ($('#enable_scan_edit').is(':checked')) {
        enable_scan_edit = 1;
    }
    var enable_email_edit = 0;
    if ($('#enable_email_edit').is(':checked')) {
        enable_email_edit = 1;
    }

    var nx_im_theme_edit = $("#nx_im_theme_edit").val();
    var nx_ac_theme_edit = $("#nx_ac_theme_edit").val();
    var nx_vc_theme_edit = $("#nx_vc_theme_edit").val();
    var nx_ls_theme_edit = $("#nx_ls_theme_edit").val();
    var nx_sm_theme_edit = $("#nx_sm_theme_edit").val();

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

    if(!generate_apk && !edit_apk){
        formInvalid = false;
        if (localStorage.lang == 1) {
            whichInvalid = "Mohon pilih buat atau edit APK";
        } else {
            whichInvalid = "Please choose to build or edit existing APK";
        }
    }

    if (generate_apk && !edit_apk) {
        

        $('#generate-apk-form :required').each(function() {
            if ($(this).val() === ''|| $(this).val() === null) {
                formInvalid = false;   
                let fieldId = $(this).attr("id");
                // if (fieldName == "tab1" || fieldName == "tab2" || fieldName == "tab3" || fieldName == "tab4" ||
                // fieldName == "tab1_edit" || fieldName == "tab2_edit" || fieldName == "tab3_edit" || fieldName == "tab4_edit") {
                //     fieldName = localStorage.lang == 1 ? "Konten Tab" : "Tab content";
                // } else if (fieldName == "userAccess") {
                //     fieldName = localStorage.lang == 1 ? "Nama perusahaan" : "Company name";
                // }
                console.log("FIELD ID", fieldId);
                let fieldName = "";
                switch(fieldId) {
                    case "tab1":
                    case "tab2":
                    case "tab3":
                    case "tab4":
                    case "tab1_edit":
                    case "tab2_edit":
                    case "tab3_edit":
                    case "tab4_edit":                        
                        fieldName = localStorage.lang == 1 ? "Konten Tab" : "Tab content";
                        break;
                    case "appId":
                        fieldName = localStorage.lang == 1 ? "App ID" : "App ID";
                        break;
                    case "companyName":
                        fieldName = localStorage.lang == 1 ? "Nama perusahaan" : "Company name";
                        break;
                    case "ver_name":
                        fieldName = localStorage.lang == 1 ? "Nama versi" : "Version name";
                        break;    
                    default:
                        fieldName = localStorage.lang == 1 ? "Ada field yang" : "A field";
                        break;
                }
                console.log("FIELD NAME", fieldName);
                if (localStorage.lang == 1) {
                    whichInvalid = fieldName + " belum terisi atau salah";
                } else {
                    whichInvalid = fieldName + " is yet to be filled or invalid";
                }
                return false;
            }
        })
        
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
        formData.append('enable_sms', enable_sms);
        formData.append('enable_osint', enable_osint);
        formData.append('enable_scan', enable_scan);
        formData.append('enable_email', enable_email);
        formData.append('enable_loc', enable_loc);
        formData.append("nx_im_theme", nx_im_theme);
        formData.append("nx_ac_theme", nx_ac_theme);
        formData.append("nx_vc_theme", nx_vc_theme);
        formData.append("nx_ls_theme", nx_ls_theme);
        formData.append("nx_sm_theme", nx_sm_theme);

        if (document.querySelector("input#huawei_pushkit").files.length > 0) {
            formData.append("huawei_pushkit", $("input#huawei_pushkit")[0].files[0]);
            if ($("input#huawei_client_id").val() != "") {
                formData.append("huawei_clientID", $("input#huawei_client_id").val());
            } else {
                alert("Please input your App Gallery Client Secret");
                return false;
            }
        }

        if (document.querySelector("input#include_gps").checked) {
            formData.append("gps_pushkit", 1);
        }
        // if (document.querySelector("input#gps_pushkit").files.length > 0) {
        //     formData.append("gps_pushkit", $("input#gps_pushkit")[0].files[0]);
            // if ($("input#gps_client_id").val() != "") {
            //     formData.append("gps_clientID", $("input#gps_client_id").val());
            // } else {
            //     alert("Please input your Google Firebase Project ID");
            //     return false;
            // }            
        // }

        if (menuType == 1) {
            let showFB = $('input[name="show_fb"]:checked').val();
            formData.append('show_fb', showFB);
        }

        if (menuType == 0 || menuType == 1) {
            let fbPP = $('input[name="fb_pp"]:checked').val();
            formData.append('fb_pp', fbPP);
        }

        if (background_wall.length > 0) {
            for (var i = 0; i < background_wall.length; i++) {
                formData.append('background[]', background_wall[i]);
            }
        } else if (existing_bg != "") {
            formData.append('background', btoa(existing_bg));
        }

        let time = new Date().getTime().toString();

        let enableCategory = document.getElementById('enable_category');
        // let enableClass = document.getElementById('enable_class');

        let category_arr = [];


        if (enableCategory.checked) {
            console.log('adskm')


            $('#category_arr .category-row').each(function () {
                let category = {};

                let id = $(this).find('input.category-name').attr('id').split('-')[1];
                let category_name = $(this).find('input.category-name').val();
                let parent_id = "";
                let parent_enabled = $(this).find('.parent-col').length > 0 && !$(this).find('.parent-col').hasClass('d-none');
                console.log(id, parent_enabled);
                if (parent_enabled) {
                    parent_id = $(this).find('select.parent-id').val();
                }

                category.ID = company_id + "00" + id;
                category.NAME = category_name;
                if (parent_id !== "") {
                    category.PARENT = company_id + "00" + parent_id;
                } else {
                    category.PARENT = "";
                }

                category_arr.push(category);
            })

            console.log(category_arr);

            formData.append('enable_category', enableCategory.value)
            formData.append('category', btoa(JSON.stringify(category_arr)));


        }

        let urlContent = document.getElementById('url-default-category');
        let tab3Content = document.getElementById('content-default-category');

        if (urlContent != null) {
            formData.append('url_default_content', urlContent.value);
        }

        if (tab3Content != null) {
            formData.append('tab3_default_content', tab3Content.value);
        }

        // console.log(category_arr);

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
        console.log('EDIT')
        $('#generate-apk-form-2 :required').each(function() {
            if ($(this).val() === '' || $(this).val() === null) {
                formInvalid = false;   
                let fieldId = $(this).attr("id");
                // if (fieldName == "tab1" || fieldName == "tab2" || fieldName == "tab3" || fieldName == "tab4" ||
                // fieldName == "tab1_edit" || fieldName == "tab2_edit" || fieldName == "tab3_edit" || fieldName == "tab4_edit") {
                //     fieldName = localStorage.lang == 1 ? "Konten Tab" : "Tab content";
                // } else if (fieldName == "userAccess") {
                //     fieldName = localStorage.lang == 1 ? "Nama perusahaan" : "Company name";
                // }
                console.log("FIELD ID", fieldId);
                let fieldName = "";
                switch(fieldId) {
                    case "tab1":
                    case "tab2":
                    case "tab3":
                    case "tab4":
                    case "tab1_edit":
                    case "tab2_edit":
                    case "tab3_edit":
                    case "tab4_edit":                        
                        fieldName = localStorage.lang == 1 ? "Konten Tab" : "Tab content";
                        break;
                    case "appId":
                        fieldName = localStorage.lang == 1 ? "App ID" : "App ID";
                        break;
                    case "companyName":
                        fieldName = localStorage.lang == 1 ? "Nama perusahaan" : "Company name";
                        break;
                    case "ver_name":
                        fieldName = localStorage.lang == 1 ? "Nama versi" : "Version name";
                        break;    
                    default:
                        fieldName = localStorage.lang == 1 ? "Ada field yang" : "A field";
                        break;
                }
                console.log("FIELD NAME", fieldName);
                if (localStorage.lang == 1) {
                    whichInvalid = fieldName + " belum terisi atau salah";
                } else {
                    whichInvalid = fieldName + " is yet to be filled or invalid";
                }
                return false;
            }
        })

        // EDIT SECTION AND ADD USER ACCESS

        let edit_apk_val = $('#edit-apk').val();
        var app_font_edit = $('#app_font_edit').val();

        formData.append('edit_apk', edit_apk_val);

        var user_access = $('#userAccess').val();
        var tab1_edit = $('#tab1_edit').val() != '0' ? $('#tab1_edit').val() : '';
        var tab2_edit = $('#tab2_edit').val() != '0' ? $('#tab2_edit').val() : '';
        var tab3_edit = $('#tab3_edit').val() != '0' ? $('#tab3_edit').val() : '';
        var tab4_edit = $('#tab4_edit').val() != '0' ? $('#tab4_edit').val() : '';

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

        if (tab1_2) {
            var tab1_icon_edit = newFormat(tab1_2);
        } else {
            var tab1_icon_edit = "";
        }

        if (tab2_2) {
            var tab2_icon_edit = newFormat(tab2_2);
        } else {
            var tab2_icon_edit = "";
        }

        if (tab3_2) {
            var tab3_icon_edit = newFormat(tab3_2);
        } else {
            var tab3_icon_edit = "";
        }

        if (tab4_2) {
            var tab4_icon_edit = newFormat(tab4_2);
        } else {
            var tab4_icon_edit = "";
        }

        if (cpaas_edit) {
            var cpaas_icon_edit = newFormat(cpaas_edit);
        } else {
            var cpaas_icon_edit = "";
        }

        if (messaging_edit) {
            var fb1_icon_edit = newFormat(messaging_edit);
        } else {
            var fb1_icon_edit = "";
        }

        if (call_edit) {
            var fb2_icon_edit = newFormat(call_edit);
        } else {
            var fb2_icon_edit = "";
        }

        if (contact_edit) {
            var fb3_icon_edit = newFormat(contact_edit);
        } else {
            var fb3_icon_edit = "";
        }

        if (post_edit) {
            var fb4_icon_edit = newFormat(post_edit);
        } else {
            var fb4_icon_edit = "";
        }

        if (streaming_edit) {
            var fb5_icon_edit = newFormat(streaming_edit);
        } else {
            var fb5_icon_edit = "";
        }

        formData.append('tab1_edit', tab1_edit);
        formData.append('tab2_edit', tab2_edit);
        formData.append('tab3_edit', tab3_edit);
        formData.append('tab4_edit', tab4_edit);

        formData.append('user_access', user_access);
        formData.append('tab1_icon_edit', tab1_icon_edit);
        formData.append('tab2_icon_edit', tab2_icon_edit);
        formData.append('tab3_icon_edit', tab3_icon_edit);
        formData.append('tab4_icon_edit', tab4_icon_edit);
        formData.append('cpaas_icon_edit', cpaas_icon_edit);
        formData.append('fb1_icon_edit', fb1_icon_edit);
        formData.append('fb2_icon_edit', fb2_icon_edit);
        formData.append('fb3_icon_edit', fb3_icon_edit);
        formData.append('fb4_icon_edit', fb4_icon_edit);
        formData.append('fb5_icon_edit', fb5_icon_edit);
        formData.append('access_model_edit', menuTypeTwo);
        formData.append('app_font_edit', app_font_edit);
        formData.append('enable_sms_edit', enable_sms_edit);
        formData.append('enable_osint_edit', enable_osint_edit);
        formData.append('enable_scan_edit', enable_scan_edit);
        formData.append('enable_email_edit', enable_email_edit);
        formData.append("nx_im_theme_edit", nx_im_theme_edit);
        formData.append("nx_ac_theme_edit", nx_ac_theme_edit);
        formData.append("nx_vc_theme_edit", nx_vc_theme_edit);
        formData.append("nx_ls_theme_edit", nx_ls_theme_edit);
        formData.append("nx_sm_theme_edit", nx_sm_theme_edit);

        if (menuTypeTwo == 1) {
            let showFBEdit = $('input[name="show_fb_edit"]:checked').val();
            formData.append('show_fb_edit', showFBEdit);
        }

        if (menuTypeTwo == 0 || menuTypeTwo == 1) {
            let fbPPEdit = $('input[name="fb_pp_edit"]:checked').val();
            formData.append('fb_pp_edit', fbPPEdit);
        }

        if (background_edit.length > 0) {
            console.log("bg", background_edit);
            var background_wall_edit = [];

            for (var i = 0; i < background_edit.length; i++) {
                background_wall_edit.push(newFormat(background_edit[i]));
            }

            console.log("BACK" + background_wall_edit);

        } else {
            var background_wall_edit = "";
        }

        if (background_wall_edit.length > 0) {
            for (var i = 0; i < background_wall_edit.length; i++) {
                formData.append('background_edit[]', background_wall_edit[i]);
            }
        } else if (existing_bg_edit != "") {
            formData.append('background_edit', btoa(existing_bg_edit));
        }
    }

    // XMLHTTP PROCESS

    for (var pair of formData.entries()) {
        console.log(pair[0] + ', ' + pair[1]);
    }

    if (formInvalid) {
        // GET LOADING START BUILD TIME

        const getStartBuild = new Date();
        var hoursBuild = getStartBuild.getHours();
        var minutesBuild = getStartBuild.getMinutes();

        var getEndBuild = new Date();
        getEndBuild.setMinutes(getEndBuild.getMinutes() + 15);
        var hoursEnd = getEndBuild.getHours();
        var minutesEnd = getEndBuild.getMinutes();

        if (localStorage.lang == 1){
            $('#build-start-time').html('Waktu awal build <span style="background-color: #1a73e8; padding: 5px; padding-left: 15px; margin-left: 60px; padding-right: 15px; color: white; border-radius: 20px"><b>' + hoursBuild + " : " + minutesBuild + '</b></span>');
            $('#build-end-time').html('Estimasi selesai build <span style="background-color: #28a745; padding: 5px; padding-left: 15px; margin-left: 25px; padding-right: 15px; color: white; border-radius: 20px"><b>' + hoursEnd + " : " + minutesEnd + '</b>');
        }else{
            $('#build-start-time').html('Build start time <span style="background-color: #1a73e8; padding: 5px; padding-left: 15px; margin-left: 60px; padding-right: 15px; color: white; border-radius: 20px"><b>' + hoursBuild + " : " + minutesBuild + '</b></span>');
            $('#build-end-time').html('Estimated end time <span style="background-color: #28a745; padding: 5px; padding-left: 15px; margin-left: 25px; padding-right: 15px; color: white; border-radius: 20px"><b>' + hoursEnd + " : " + minutesEnd + '</b>');
        }

        $('#warningModal').modal('show');

        console.log('NAPA MASIH SINI')

        let xmlHttp = new XMLHttpRequest();
        xmlHttp.timeout = 900000; // 15min
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
                } else {

                    setTimeout(function() {
                        $('#warningModal').modal('hide');
                    }, 2000);
                    
                    setTimeout(function() {
                        // alert("Build Failed. Error Code : " + response[1]);

                        if (localStorage.lang == 1){
                            alert("Build Gagal, Harap coba lagi.");
                        }else{
                            alert("Build Failed, Please try again.");
                        }
                    }, 3000);

                }
            }
        }
        xmlHttp.onerror = function() {
            $('#warningModal').modal('hide');

            if (localStorage.lang == 0){
                alert("Please check your network and try refreshing the page.");
            } else {
                alert("Mohon periksa koneksi Anda dan coba refresh halaman ini.")
            }
        }

        // try {
            xmlHttp.open("post", "logics/submit_build_apk_dev");
            xmlHttp.send(formData);
        // } catch (e) {
        //     console.log("SEND ERR", e);
        // }
    } else {
        alert(whichInvalid);

        return false;
    }

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
            // let downloadLink = document.createElement('a');
            // downloadLink.href = fileName;
            // downloadLink.click();
            // location.reload();


            break;
        }

        // location.reload();
    } catch (e) {
        // handle file not found here
    }
}