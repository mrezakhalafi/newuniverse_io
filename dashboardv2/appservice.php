<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/dashboardv2/dashboard_header.php'); ?>

<?php 

// state control
$_SESSION['previous_page'] = $_SESSION['current_page'];
$_SESSION['current_page'] = 14;
require_once($_SERVER['DOCUMENT_ROOT'] . '/state_control.php');

$dbConnPalio = dbConnPalioLite();

$sqlBE = "SELECT ID FROM BUSINESS_ENTITY WHERE COMPANY_ID = '$id_company'";
$query = $dbConnPalio->prepare($sqlBE);
$query->execute();
$res = $query->get_result()->fetch_assoc();
$be_id = $res["ID"];
$query->close();

// get service accounts

// find HMS
$sqlSA = "SELECT COUNT(*) AS HMS FROM `SERVICE_ACCOUNTS` WHERE `BUSINESS_ENTITY` = $be_id AND `TYPE` = 0";
$query = $dbConnPalio->prepare($sqlSA);
$query->execute();
$res = $query->get_result()->fetch_assoc();
$query->close();
$hms_enabled = $res["HMS"];

// FIND FCM
$sqlSA = "SELECT COUNT(*) AS FCM FROM `SERVICE_ACCOUNTS` WHERE `BUSINESS_ENTITY` = $be_id AND `TYPE` = 1";
$query = $dbConnPalio->prepare($sqlSA);
$query->execute();
$res = $query->get_result()->fetch_assoc();
$query->close();
$fcm_enabled = $res["FCM"];
?>


<style>
    .card {
        padding: 2.5rem;
    }

    .genapkcheckbox {
        display: block;
        position: relative;
        padding-left: 35px;
        margin-bottom: 12px;
        cursor: pointer;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    /* Hide the browser's default checkbox */
    .genapkcheckbox input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
        height: 0;
        width: 0;
    }

    /* Create a custom checkbox */
    .checkmark {
        position: absolute;
        top: 0;
        left: 0;
        height: 25px;
        width: 25px;
        border: .5px solid black;
        background-color: white;
        border-radius: 5px;
    }

    .checkmark-small {
        position: absolute;
        top: 0;
        left: 0;
        height: 20px;
        width: 20px;
        border: .5px solid black;
        background-color: white;
        border-radius: 5px;
    }

    /* On mouse-over, add a grey background color */
    .genapkcheckbox:hover input~.checkmark,
    .genapkcheckbox input~.checkmark-small:hover {
        background-color: #1799ad;
    }

    /* When the checkbox is checked, add a blue background */
    .genapkcheckbox input:checked~.checkmark,
    .genapkcheckbox input:checked~.checkmark-small {
        background-color: #1799ad;
    }

    /* Create the checkmark/indicator (hidden when not checked) */
    .checkmark:after,
    .checkmark-small:after {
        content: "";
        position: absolute;
        display: none;
    }

    /* Show the checkmark when checked */
    .genapkcheckbox input:checked~.checkmark:after,
    .genapkcheckbox input:checked~.checkmark-small:after {
        display: block;
    }

    /* Style the checkmark/indicator */
    .genapkcheckbox .checkmark:after {
        left: 9px;
        top: 5px;
        width: 5px;
        height: 10px;
        border: solid white;
        border-width: 0 3px 3px 0;
        -webkit-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        transform: rotate(45deg);
    }

    .genapkcheckbox .checkmark-small:after {
        left: 6px;
        top: 3px;
        width: 5px;
        height: 10px;
        border: solid white;
        border-width: 0 3px 3px 0;
        -webkit-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        transform: rotate(45deg);
    }

    html,
    body {
        max-width: 100%;
        overflow-x: hidden;
    }
</style>

<div class="content-wrapper" id="support-wrapper">
    <div class="content">
        <div class="container-fluid">

            <div class="card">
                <h4 class="card-name">
                    FCM Integration
                </h4>
                <div class="card-body">
                    <div class="row mt-5">
                        <div class="col-md-12">
                            <p style="font-size:.85rem;" id="text-desc">
                            If you wish to enable Google Firebase Cloud Messaging (FCM), check the following box. Uncheck them to disable.
                            </p>
                        </div>
                    </div>

                    <div class="row d-none">
                        <label class="genapkcheckbox" for="include_hms" style="font-size:.8rem;">
                            <input type="checkbox" id="include_hms" name="include_hms" value="1" <?= $hms_enabled == 1 ? "checked" : ""?>>
                            <span class="checkmark-small"></span>
                        </label>
                        <span id="include-hms" style="font-weight: bold">Enable HMS</span>
                    </div>
                    <div class="row d-none" id="huawei_json">

                        <div class="col-sm-6">
                            <!-- <input type="file" id="huawei_pushkit" class="form-control mb-1" name="huawei_pushkit"> -->
                            <div class="input-group">

                                <label for="huawei_pushkit" class="btn" style="position: absolute; z-index: 20">
                                    <button id="btn-choose-file" style="border: 1px solid grey; pointer-events: none" type="button">Choose File</button>
                                </label>
                                <input id="no-chosen" type="text" style="padding-left: 130px; border-radius: 0.5rem; background-color: transparent !important" class="form-control" readonly value="No file chosen.">
                                <input id="file-upload-name" type="text" style="padding-left: 130px; border-radius: 0.5rem; background-color: transparent !important" class="form-control d-none" readonly>

                                <input type="file" accept="image/*" class="form-control d-none" id="huawei_pushkit" name="huawei_pushkit" style="overflow: hidden">

                            </div>
                            <p id="huawei_pushkit_validation" style="font-size:.85rem; color:red;" class="d-none">
                                Please make sure your JSON includes a matching package name or app id.
                            </p>
                        </div>

                        <div class="col-sm-6">
                            <input type="text" id="huawei_client_id" class="form-control mb-1" name="huawei_client_id" placeholder="App Gallery Client Secret">
                            <p id="huawei_client_secret_EN" style="font-size:12px;">
                                Please input your Huawei App Gallery OAuth 2.0 Client Secret as shown <a href="https://developer.huawei.com/consumer/en/doc/development/HMSCore-Guides/android-config-agc-0000001050170137#section125831926193110">here</a>.
                            </p>
                            <p id="huawei_client_secret_ID" style="font-size:12px;" class="d-none">
                                Harap masukkan OAuth Galeri Aplikasi Huawei 2.0 Rahasia Klien anda seperti yang ditunjukkan <a href="https://developer.huawei.com/consumer/en/doc/development/HMSCore-Guides/android-config-agc-0000001050170137#section125831926193110">di sini</a>.
                            </p>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <label class="genapkcheckbox" for="include_gps" style="font-size:.8rem;">
                            <input type="checkbox" id="include_gps" name="include_gps" value="1" <?= $fcm_enabled == 1 ? "checked" : ""?>>
                            <span class="checkmark-small"></span>
                        </label>
                        <span id="include-gps" style="font-weight: bold">Enable FCM</span>
                    </div>
                    <div class="row d-none" id="gps_json">

                        <!-- <div class="col-sm-10">
                            <input type="file" id="gps_pushkit" class="form-control mb-1" name="gps_pushkit">
                            <p id="gps_pushkit_validation" style="font-size:.85rem; color:red;" class="d-none">
                                Please make sure your JSON includes a matching package name or app id.
                            </p>
                        </div> -->
                        <!-- <div class="col-sm-6">
                            <input type="text" id="gps_client_id" class="form-control mb-1" name="gps_client_id">
                            <p style="font-size:12px;">
                                Please input your Google Firebase Project ID.
                            </p>
                        </div> -->
                    </div>
                    <div class="row mt-4 d-flex justify-content-end">
                        <div class="col-md-12 text-center">
                            <button class="btn mt-2 mb-5 btn-yellow" disabled type="button" id="submit-form" onclick="checkSendData()" data-translate="dashform-50">
                                SUBMIT
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
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
        $('#submit-form').attr('disabled', false);

        if (gps_checkbox.checked) {
            $("#gps_json").removeClass("d-none");
            // $("#huawei_json").addClass("d-none");
            // document.querySelector("input#huawei_pushkit").value = "";
        } else {
            $("#gps_json").addClass("d-none");
            // document.querySelector("input#gps_pushkit").value = "";
        }

    })

    function onChangeHuawei(event) {
        var reader = new FileReader();
        reader.onload = validatePackageNameHuawei;
        reader.readAsText(event.target.files[0]);
    }

    function validatePackageNameHuawei(event) {
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

    function validatePackageNameGPS(event) {
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

    // document.getElementById('huawei_pushkit').addEventListener('change', onChangeHuawei);
    // document.getElementById('gps_pushkit').addEventListener('change', onChangeGPS);
    // END JSON VALIDATION

    function checkSendData() {

        sendData();

        // if ($('#include_hms').is(':checked')) {

        //     sendData();


        // } else if ($('#include_gps').is(':checked')) {


        //     sendData();


        // } 
        // else {

        //     if (localStorage.lang == 1) {
        //         alert("Harap ceklis salah satu opsi.");
        //     } else {
        //         alert("Please check one of the option.");
        //     }

        // }

    }

    function sendData() {
        var formData = new FormData();

        // if (huawei_checkbox.checked) {
        //     if (document.querySelector("input#huawei_pushkit").files.length > 0) {
        //         formData.append("huawei_pushkit", $("input#huawei_pushkit")[0].files[0]);
        //         if ($("input#huawei_client_id").val() != "") {
        //             formData.append("huawei_clientID", $("input#huawei_client_id").val());
        //         } else {

        //             if (localStorage.lang == 1) {
        //                 alert("Harap masukan App Gallery Client Secret terlebih dahulu");
        //             } else {
        //                 alert("Please input your App Gallery Client Secret");
        //             }

        //             return false;
        //         }
        //     } else {

        //         if (localStorage.lang == 1) {
        //             alert("Harap masukan file JSON terlebih dahulu");
        //         } else {
        //             alert("Please input your JSON file");
        //         }

        //         return false;
        //     }
        // } else {
        //     formData.append("huawei_pushkit", 0);
        // }

        if (gps_checkbox.checked) {
            // if (document.querySelector("input#gps_pushkit").files.length > 0) {
                formData.append("gps_pushkit", 1);
                // if ($("input#gps_client_id").val() != "") {
                //     formData.append("gps_clientID", $("input#gps_client_id").val());
                // } else {
                //     alert("Please input your Google Firebase Project ID");
                //     return false;
                // }
            // } else {
            //     alert("Please input your JSON file");
            //     return false;
            // }

            
            let xmlHttp = new XMLHttpRequest();
            xmlHttp.timeout = 900000; // 15min
            xmlHttp.onreadystatechange = function() {

                if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
                    console.log(xmlHttp.responseText);

                    if (xmlHttp.responseText == "Success") {
                        if (localStorage.lang == 0) {
                            alert("You enable FCM.");    
                        }
                        else {
                            alert("Anda mengaktifkan FCM.");
                        }
                        window.location.reload();
                    }
                }
            }
            xmlHttp.onerror = function() {


                if (localStorage.lang == 0) {
                    alert("Please check your network and try refreshing the page.");
                } else {
                    alert("Mohon periksa koneksi Anda dan coba refresh halaman ini.")
                }
            }

            // try {
            xmlHttp.open("post", "logics/submit_hms_fms");
            xmlHttp.send(formData);

        } else {

            formData.append("gps_pushkit", 0);

            let xmlHttp = new XMLHttpRequest();
            xmlHttp.timeout = 900000; // 15min
            xmlHttp.onreadystatechange = function() {

                if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
                    console.log(xmlHttp.responseText);

                    if (xmlHttp.responseText == "Success") {
                        if (localStorage.lang == 0) {
                            alert("You disabled FCM.");    
                        }
                        else {
                            alert("Anda menonaktifkan FCM.");
                        }
                        window.location.reload();
                    }
                }
            }
            xmlHttp.onerror = function() {


                if (localStorage.lang == 0) {
                    alert("Please check your network and try refreshing the page.");
                } else {
                    alert("Mohon periksa koneksi Anda dan coba refresh halaman ini.")
                }
            }

            // try {
            xmlHttp.open("post", "logics/submit_hms_fms");
            xmlHttp.send(formData);
        }
    }

    // $('#lang-nav').hover(function(){  
    //     $('#lang-menu').dropdown("show");
    //     }, function(){
    //     $('#lang-menu').dropdown("hide");
    // });

    // $('#lang-menu').hover(function(){
    //     $('#lang-menu').dropdown("show");
    //     }, function(){
    //     $('#lang-menu').dropdown("hide");
    // });

    $("#change-lang-ID").click(function() {
        localStorage.lang = 1;
        $("#lang-nav").text('ID');
        $('.card-name').text("Integrasi FCM");
        $('#include-hms').text("Masukan HMS");
        $('#include-gps').text("Masukan FCM");
        $('#text-desc').text("Jika Anda ingin menyertakan layanan Google Firebase Cloud Messaging (FCM), centang kotak berikut di bawah dan masukkan informasi yang diperlukan.");
        change_lang();
        $("#btn-choose-file").text("Pilih Berkas");
        $("#no-chosen").attr("value", "Tidak ada file dipilih.");
        $("#huawei_pushkit_validation").text("Harap pastikan JSON anda mencakup nama paket atau kode aplikasi yang sesuai.");
        $("#huawei_client_id").attr("placeholder", "Rahasia Klien Galeri Aplikasi");
        $("#huawei_client_secret_EN").addClass("d-none"); 
        $("#huawei_client_secret_ID").removeClass("d-none"); 
    });

    if (localStorage.lang == 1) {
        $('.card-name').text("Integrasi FCM");
        $('#include-hms').text("Masukan HMS");
        $('#include-gps').text("Masukan FCM");
        $('#text-desc').text("Jika Anda ingin menyertakan layanan Google Firebase Cloud Messaging (FCM), centang kotak berikut di bawah dan masukkan informasi yang diperlukan.");
        $("#btn-choose-file").text("Pilih Berkas");
        $("#no-chosen").attr("value", "Tidak ada file dipilih.");
        $("#huawei_pushkit_validation").text("Harap pastikan JSON anda mencakup nama paket atau kode aplikasi yang sesuai.");
        $("#huawei_client_id").attr("placeholder", "Rahasia Klien Galeri Aplikasi");
        $("#huawei_client_secret_EN").addClass("d-none"); 
        $("#huawei_client_secret_ID").removeClass("d-none"); 
    }

    $("#change-lang-EN").click(function() {
        localStorage.lang = 0;
        $("#lang-nav").text('EN');
        $('.card-name').text("FCM Integration");
        $('#include-hms').text("Enable HMS");
        $('#include-gps').text("Enable FCM");
        $('#text-desc').text("If you wish to enable Google Firebase Cloud Messaging (FCM), check the following boxes below and input the required information. Uncheck them to disable.");
        change_lang();
        $("#btn-choose-file").text("Choose File");
        $("#no-chosen").attr("value", "No file chosen.");
        $("#huawei_pushkit_validation").text("Please make sure your JSON includes a matching package name or app id.");
        $("#huawei_client_id").attr("placeholder", "App Gallery Client Secret");
        $("#huawei_client_secret_EN").removeClass("d-none"); 
        $("#huawei_client_secret_ID").addClass("d-none"); 
    });

    $('a.nav-link[href="billpayment.php"]').removeClass('active');
    $('a.nav-link[href="index.php"]').removeClass('active');
    $('a.nav-link[href="usage.php"]').removeClass('active');
    $('a.nav-link[href="support.php"]').removeClass('active');
    $('a.nav-link[href="mailbox.php"]').removeClass('active');
    $('a.nav-link[href="appservice.php"]').addClass('active');

    $('#huawei_pushkit').change(function (e) {
        e.preventDefault();

        $('#no-chosen').hide();
        $('#file-upload-name').removeClass('d-none');
        $('#file-upload-name').attr('value',this.files[0].name);
    });
</script>

<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/dashboardv2/dashboard_footer.php'); ?>