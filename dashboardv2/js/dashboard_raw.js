if (localStorage.country_code == 'ID') {
    $('#trialprice').html('[TRIAL] [Package: TRIAL Rp0.00]');
} else {
    $('#trialprice').html('[TRIAL] [Package: TRIAL $0.00]');
}
$('a.nav-link[href="billpayment.php"]').removeClass('active');
$('a.nav-link[href="index.php"]').addClass('active');
$('a.nav-link[href="usage.php"]').removeClass('active');
$('a.nav-link[href="support.php"]').removeClass('active');
$('a.nav-link[href="mailbox.php"]').removeClass('active');

function showHide() {
    var $pwd = $("#adminPass");
    if ($pwd.attr('type') === 'password') {
        $pwd.attr('type', 'text');
        $('#showHide').removeClass('fa-eye-slash');
        $('#showHide').addClass('fa-eye');
    } else {
        $pwd.attr('type', 'password');
        $('#showHide').removeClass('fa-eye');
        $('#showHide').addClass('fa-eye-slash');
    }
}

/**
 * Show / Hide Input Type Confirm Password
 **/
function showHide2() {
    var $pwd = $("#newpass_priv");
    if ($pwd.attr('type') === 'password') {
        $pwd.attr('type', 'text');
        $('#showHide2').removeClass('fa-eye-slash');
        $('#showHide2').addClass('fa-eye');
    } else {
        $pwd.attr('type', 'password');
        $('#showHide2').removeClass('fa-eye');
        $('#showHide2').addClass('fa-eye-slash');
    }
}

window.addEventListener('resize', function () {
    if ($(window).width() > 768) {
        $('#billing.card').css('height', $('#account.card').innerHeight());
    }
});

if ($(window).width() > 768) {
    $('#billing.card').css('height', $('#account.card').innerHeight());
}

$(document).ready(function () {

    var $rows = $('.monthly-bill');
    $('#search-bill').keyup(function() {

        var val = '^(?=.*\\b' + $.trim($(this).val()).split(/\s+/).join('\\b)(?=.*\\b') + ').*$',
            reg = RegExp(val, 'i'),
            text;

        $rows.show().filter(function() {
            text = $(this).text().replace(/\s+/g, ' ');
            return !reg.test(text);
        }).hide();
    });

    $('#search-mbl').keyup(function() {

        var val = '^(?=.*\\b' + $.trim($(this).val()).split(/\s+/).join('\\b)(?=.*\\b') + ').*$',
            reg = RegExp(val, 'i'),
            text;

        $rows.show().filter(function() {
            text = $(this).text().replace(/\s+/g, ' ');
            return !reg.test(text);
        }).hide();
    });

    if ($("#um_check").val() == 1) {
        $("#um_check").prop('checked', true);
    } else {
        $("#um_check").prop('checked', false);
    }

    if ($("#voip_check").val() == 1) {
        $("#voip_check").prop('checked', true);

    } else {
        $("#voip_check").prop('checked', false);
    }

    if ($("#ls_check").val() == 1) {
        $("#ls_check").prop('checked', true);
    } else {
        $("#ls_check").prop('checked', false);
    }

    if ($("#web_check").val() == 1) {
        $("#web_check").prop('checked', true);
    } else {
        $("#web_check").prop('checked', false);
    }

    if ($("#im_check").val() == 1) {
        $("#im_check").prop('checked', true);
    } else {
        $("#im_check").prop('checked', false);
    }
    if ($("#email_check").val() == 1) {
        $("#email_check").prop('checked', true);
    } else {
        $("#email_check").prop('checked', false);
    }
    if ($("#sms_check").val() == 1) {
        $("#sms_check").prop('checked', true);
    } else {
        $("#sms_check").prop('checked', false);
    }

    $('#um_check').on('change', function () {
        this.value = this.checked ? 1 : 0;
    }).change();

    $('#voip_check').on('change', function () {
        this.value = this.checked ? 1 : 0;
    }).change();

    $('#ls_check').on('change', function () {
        this.value = this.checked ? 1 : 0;
    }).change();

    $('#web_check').on('change', function () {
        this.value = this.checked ? 1 : 0;
    }).change();

    var maven_uname = "Copy this username to replace maven username in the Palio Lite app level build.gradle file.";
    var maven_pw = "Copy this password to replace maven password in the Palio Lite app level build.gradle file.";

    $("#maven-uname").attr("title", maven_uname);
    $("#maven-pass").attr("title", maven_pw);

    $(".credit-hint").tooltip({
        placement: 'right'
    });




    var services = $("#services").text();

    var res = services.replace("LS", "Live Streaming").replace("VC", "Video Call").replace("AC", "Audio Call").replace("UM", "Unified Messaging").replace("SS", "Screen Sharing").replace("WB", "Whiteboard").replace("CB", "Smart Features");

    $("#services").text(res);

   
});

function copyElementText() {
    var text = document.getElementById("apikey").innerText.trim();
    // console.log(text);
    var elem = document.createElement("textarea");
    document.body.appendChild(elem);
    elem.value = text;
    elem.select();
    document.execCommand("copy");
    document.body.removeChild(elem);
    $("#copied-acc").show();
    let timeout = setTimeout(function () {
        $("#copied-acc").hide();
    }, 3000);
    // $('#copyapi').attr('value', 'Copied').attr("disabled", "disabled");
}

function copyElementText2() {
    var text = document.getElementById("adminpass").innerText.trim();
    // console.log(text);
    var elem = document.createElement("textarea");
    document.body.appendChild(elem);
    elem.value = text;
    elem.select();
    document.execCommand("copy");
    document.body.removeChild(elem);
    $("#copied-int-pass").show();
    let timeout = setTimeout(function () {
        $("#copied-int-pass").hide();
    }, 3000);
    // $('#copyinternalpass').attr('value', 'Copied').attr("disabled", "disabled");
}

function copyElementText3() {
    var text = document.getElementById("maven_username").innerText.trim();
    // console.log(text);
    var elem = document.createElement("textarea");
    document.body.appendChild(elem);
    elem.value = text;
    elem.select();
    document.execCommand("copy");
    document.body.removeChild(elem);
    $("#copied-maven-uname").show();
    let timeout = setTimeout(function () {
        $("#copied-maven-uname").hide();
    }, 3000);
    // $('#copyusername').attr('value', 'Copied').attr("disabled", "disabled");
}

function copyElementText4() {
    var text = document.getElementById("maven_password").innerText.trim();
    // console.log(text);
    var elem = document.createElement("textarea");
    document.body.appendChild(elem);
    elem.value = text;
    elem.select();
    document.execCommand("copy");
    document.body.removeChild(elem);
    $("#copied-maven-pass").show();
    let timeout = setTimeout(function () {
        $("#copied-maven-pass").hide();
    }, 3000);
    // $('#copypassword').attr('value', 'Copied').attr("disabled", "disabled");
}



$('#new_supp_email').keyup(function () {
    var suppEmail = $("#new_supp_email").val();

    var regExEmail = /^[A-Z0-9._-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;

    if (suppEmail.length > 0 && regExEmail.test(suppEmail)) {
        $("#emailWarning").hide();
        $("#submitSuppEmail").prop('disabled', false);
        // console.log('suppEmail: ' + support_email);
    } else {
        $("#emailWarning").show();
        $("#submitSuppEmail").prop('disabled', true);
        // console.log('suppEmail: ' + support_email);
    }
});

var invalidChar = /[\"'`´’‘;=-]/;

$('#companyname').keyup(function () {
    if (invalidChar.test($(this).val())) {
        $('#submitCompName').prop('disabled', true);
        $('#compNameWarning').show();
    } else {
        $('#submitCompName').prop('disabled', false);
        $('#compNameWarning').hide();
    }
});

$('#username').keyup(function () {
    if (invalidChar.test($(this).val())) {
        $('#submitUserName').prop('disabled', true);
        $('#userNameWarning').show();
    } else {
        $('#submitUserName').prop('disabled', false);
        $('#userNameWarning').hide();
    }
});

// admin pass
var pw_strength;
var pwValidChar = false;
var password = document.getElementById("adminPass");
password.addEventListener('keyup', function () {

    var pwd = password.value;

    if (pwd.length === 0) {
        document.getElementById("progresslabel").innerHTML = "";
        // document.getElementById("progress").value = "0";
        return;
    }

    var prog = [/[$@!%*#?&]/, /[A-Z]/, /[0-9]/, /[a-z]/]
        .reduce((memo, test) => memo + test.test(pwd), 0);

    var invalidChar = /[\"'`´’‘;=-]/;

    if (prog > 2 && pwd.length > 7) {
        prog++;
    }

    // Display it
    // var progress = "";
    var strength = "";
    switch (prog) {
        case 0:
        case 1:
            strength = "<span style='color: red;'>Strength: 25% - Weak</span>";
            pw_strength = 25;
            $('#passwarn').css('display', 'block');
            $('#submitAdmPass').prop('disabled', true);
            break;
        case 2:
            strength = "Strength: 50% - Medium";
            // progress = "50";
            pw_strength = 50;
            $('#passwarn').css('display', 'none');
            $('#submitAdmPass').prop('disabled', true);
            break;
        case 3:
        case 4:

            if (!invalidChar.test(pwd)) {
                strength = "Strength: 75% - Medium";
                // progress = "75";
                pw_strength = 75;
                $('#passwarn').css('display', 'none');
                $('#submitAdmPass').prop('disabled', false);
                $('#passForbiddenChar').css('display', 'none');
            } else {
                strength = "Strength: 75% - Medium";
                // progress = "75";
                pw_strength = 75;
                $('#passForbiddenChar').css('display', 'block');
                $('#submitAdmPass').prop('disabled', true);
            }
            break;
        case 5:

            if (!invalidChar.test(pwd)) {
                strength = "Strength: 100% - Strong";
                // progress = "100";
                pw_strength = 100;
                $('#passwarn').css('display', 'none');
                $('#submitAdmPass').prop('disabled', false);
                $('#passForbiddenChar').css('display', 'none');
            } else {
                strength = "Strength: 100% - Strong";
                // progress = "100";
                pw_strength = 100;
                $('#passForbiddenChar').css('display', 'block');
                $('#submitAdmPass').prop('disabled', true);
            }
            break;
    }
    document.getElementById("progresslabel").innerHTML = strength;
    // console.log("strength: " + pw_strength);
});

// int pass
var pw_strength_1;
var pwValidChar_1 = false;
var passwordInt = document.getElementById("newpass_priv");
passwordInt.addEventListener('keyup', function () {

    var pwd = passwordInt.value;

    if (pwd.length === 0) {
        document.getElementById("progresslabel2").innerHTML = "";
        // document.getElementById("progress2").value = "0";
        return;
    }

    var prog = [/[$@!%*#?&]/, /[A-Z]/, /[0-9]/, /[a-z]/]
        .reduce((memo, test) => memo + test.test(pwd), 0);

    var invalidChar = /[\"'`´’‘;=-]/;

    if (prog > 2 && pwd.length > 7) {
        prog++;
    }

    // Display it
    // var progress = "";
    var strength = "";
    switch (prog) {
        case 0:
        case 1:
            strength = "<span style='color: red;'>Strength: 25% - Weak</span>";
            pw_strength = 25;
            $('#passwarn2').css('display', 'block');
            $('#submitIntPass').prop('disabled', true);
            break;
        case 2:
            strength = "Strength: 50% - Medium";
            // progress = "50";
            pw_strength = 50;
            $('#passwarn2').css('display', 'none');
            $('#submitIntPass').prop('disabled', true);

            break;
        case 3:
        case 4:

            if (!invalidChar.test(pwd)) {
                strength = "Strength: 75% - Medium";
                // progress = "75";
                pw_strength = 75;
                $('#passwarn2').css('display', 'none');
                $('#submitIntPass').prop('disabled', false);
                $('#passForbiddenChar2').css('display', 'none');
            } else {
                strength = "Strength: 75% - Medium";
                // progress = "75";
                pw_strength = 75;
                $('#passForbiddenChar2').css('display', 'block');
                $('#submitIntPass').prop('disabled', true);
            }
            break;
        case 5:

            if (!invalidChar.test(pwd)) {
                strength = "Strength: 100% - Strong";
                // progress = "100";
                pw_strength = 100;
                $('#passwarn2').css('display', 'none');
                $('#submitIntPass').prop('disabled', false);
                $('#passForbiddenChar2').css('display', 'none');
            } else {
                strength = "Strength: 100% - Strong";
                // progress = "100";
                pw_strength = 100;
                $('#passForbiddenChar2').css('display', 'block');
                $('#submitIntPass').prop('disabled', true);
            }
            break;
    }
    document.getElementById("progresslabel2").innerHTML = strength;
    // console.log("strength: " + pw_strength);
});

$("#company_logo_first").change(function (e) {
    var file = e.target.files[0]; //FileList object
    var reader = new FileReader();

    new Compressor(file, {
        quality: 0.9,
        maxWidth: 640,
        maxHeight: 480,
        success(result) {
            // see preview of the compressed image
            var imageUrl = URL.createObjectURL(result);
            document.querySelector("#companyLogo_img").src = imageUrl;

            // //Read the image
            reader.readAsDataURL(result);
        },
        error(err) {
            // console.log(err.message);
        },
    });
    // reader.readAsDataURL(e.target.files[0]);
});



$("#company-logo").change(function (e) {
    var file = e.target.files[0]; //FileList object
    var picReader = new FileReader();

    var fileSize = $(this).get(0).files[0].size;
    // // console.log("img size: " + fileSize);

    // if file > 2 MB
    if (fileSize > 2097152) {
        alert("Please limit your file size to 2 MB or less.");
        // $("#uploadLogo").attr('disabled', 'true');
        $(this).val(null);
    } else {

        // $("#uploadLogo").attr('disabled', 'false');
        //Only pics
        if (!file.type.match('image'))
            return;

        // base64 the image
        picReader.addEventListener("load", function (event) {
            var picFile = event.target;
            var base64result = picFile.result.split(",")[1]

        });

        // compress the image
        new Compressor(file, {
            quality: 0.9,
            maxWidth: 640,
            maxHeight: 480,
            success(result) {
                // see preview of the compressed image
                var imageUrl = URL.createObjectURL(result);
                document.querySelector("#logo-preview").src = imageUrl;

                // //Read the image
                picReader.readAsDataURL(result);
            },
            error(err) {
                // console.log(err.message);
            },
        });
    }

});

var inactivityTime = function () {
    var time;
    window.onload = resetTimer;
    // DOM Events
    document.onload = resetTimer;
    document.onmousemove = resetTimer;
    document.onmousedown = resetTimer; // touchscreen presses
    document.ontouchstart = resetTimer;
    document.onclick = resetTimer; // touchpad clicks
    document.onkeydown = resetTimer; // onkeypress is deprectaed
    document.addEventListener('scroll', resetTimer, true); // improved; see comments


    function logout() {
        alert("You are now logged out.");
        $('#logoutButton').click();
    }

    function resetTimer() {
        clearTimeout(time);
        // console.log('timer jalan');
        time = setTimeout(logout, 600000); // 5 minutes
        // 1000 milliseconds = 1 second
    }
};

function checkVisible() {

    if (localStorage.currentGeoloc == 'ON') {
        if (localStorage.country_code == 'ID') {
            $("#lang-li").css("display", "block");
            $("#id-office").css("display", "block");
            $("#gb-office").css("display", "block");
        } else if (localStorage.country_code != 'ID') {
            $("#lang-li").css("display", "none");
            $("#id-office").css("display", "none");
            $("#gb-office").css("display", "block");
        }
    } else if (localStorage.currentGeoloc == 'OFF') {
        if (localStorage.country_code == 'ID') {
            $("#lang-li").css("display", "none");
            $("#id-office").css("display", "block");
            $("#gb-office").css("display", "none");
        } else if (localStorage.country_code != 'ID') {
            $("#lang-li").css("display", "none");
            $("#id-office").css("display", "none");
            $("#gb-office").css("display", "block");
        }
    }
    // // console.log('checkVisible');
}

function geoLoc() {

    $.ajax({
        url: 'https://api.ipgeolocation.io/ipgeo?apiKey=cacef90bd1af48e5a4e0a97e91439f51',
        type: 'GET',
        success: function (response) {
            // console.log('checking loc');
            localStorage.prevCountry = localStorage.country_code;
            localStorage.lastCheck = Math.floor(Date.now() / 1000); // epoch second

            if (localStorage.prevCountry != response.country_code2 || localStorage.prevCountry == null || typeof localStorage.prevCountry === 'undefined') {
                localStorage.country_code = response.country_code2;
                if (response.country_code2 == 'ID') {
                    localStorage.lang_visible = 1;
                    if (localStorage.lang != null || typeof localStorage.lang !== 'undefined') {
                        localStorage.lang = 0;
                    }
                } else {
                    localStorage.lang = 0;
                    localStorage.lang_visible = 0;
                }
            }
        },
        error: function (error) {
            alert('Sorry, we are unable to get your current location.');
            localStorage.removeItem('lastCheck');
            localStorage.lang = 0;
            localStorage.lang_visible = 0;
            localStorage.country_code = 'EN';
        }
    });
}

/** dashboard header raw */
// <?php if (isset($_SESSION['id_user'])) { ?>
//     var inactivityTime = function() {
//       var time;
//       window.onload = resetTimer;
//       // DOM Events
//       document.onload = resetTimer;
//       document.onmousemove = resetTimer;
//       document.onmousedown = resetTimer; // touchscreen presses
//       document.ontouchstart = resetTimer;
//       document.onclick = resetTimer; // touchpad clicks
//       document.onkeydown = resetTimer; // onkeypress is deprectaed
//       document.addEventListener('scroll', resetTimer, true); // improved; see comments


//       function logout() {
//         alert("You are now logged out.");
//         $('#logoutButton').click();
//       }

//       function resetTimer() {
//         clearTimeout(time);
//         // console.log('timer jalan');
//         time = setTimeout(logout, 600000); // 5 minutes
//         // 1000 milliseconds = 1 second
//       }
//     };

//     window.onload = function() {
//       inactivityTime();

//       <?php if ($bill2['CURRENCY'] == 'IDR' && $user['STATUS'] != 3) { ?>
//         document.getElementById('packagePrice').innerHTML = parseFloat(document.getElementById('packagePrice').innerHTML).toLocaleString('id', {
//           minimumFractionDigits: 2,
//           maximumFractionDigits: 2,
//         });
//         document.getElementById('topupAmt').innerHTML = parseFloat(document.getElementById('topupAmt').innerHTML).toLocaleString('id', {
//           minimumFractionDigits: 2,
//           maximumFractionDigits: 2,
//         });
//       <?php } else if ($bill2['CURRENCY'] == 'USD' && $user['STATUS'] != 3) { ?>
//         document.getElementById('packagePrice').innerHTML = parseFloat(document.getElementById('packagePrice').innerHTML).toLocaleString('en-US', {
//           minimumFractionDigits: 2,
//           maximumFractionDigits: 2,
//         });
//         document.getElementById('topupAmt').innerHTML = parseFloat(document.getElementById('topupAmt').innerHTML).toLocaleString('en-US', {
//           minimumFractionDigits: 2,
//           maximumFractionDigits: 2,
//         });
//       <?php } else if ($user['STATUS'] != 3) { ?>
//         if (localStorage.country_code == 'ID') {
//           document.getElementById('packagePrice').innerHTML = parseFloat(document.getElementById('packagePrice').innerHTML).toLocaleString('id', {
//             minimumFractionDigits: 2,
//             maximumFractionDigits: 2,
//           });
//           document.getElementById('topupAmt').innerHTML = parseFloat(document.getElementById('topupAmt').innerHTML).toLocaleString('id', {
//             minimumFractionDigits: 2,
//             maximumFractionDigits: 2,
//           });
//         } else if (localStorage.country_code != 'ID') {
//           document.getElementById('packagePrice').innerHTML = parseFloat(document.getElementById('packagePrice').innerHTML).toLocaleString('id', {
//             minimumFractionDigits: 2,
//             maximumFractionDigits: 2,
//           });
//           document.getElementById('topupAmt').innerHTML = parseFloat(document.getElementById('topupAmt').innerHTML).toLocaleString('en-US', {
//             minimumFractionDigits: 2,
//             maximumFractionDigits: 2,
//           });
//         }
//       <?php } ?>
//     }
//   <?php } ?>




//   <?php if ($geolocSts == 1) { ?>
//     console.log('geoloc ON');

//     localStorage.prevGeoloc = localStorage.currentGeoloc;
//     localStorage.currentGeoloc = 'ON';

//     localStorage.removeItem('switchLang');

//     var ONE_HOUR = 3600; //second

//     if (localStorage.country_code == null || typeof localStorage.country_code === 'undefined' || localStorage.lastCheck == null || typeof localStorage.lastCheck === 'undefined' || (Math.floor(Date.now() / 1000) - localStorage.lastCheck) > ONE_HOUR) {
//       geoLoc();
//     }

//     <?php  } else {
//     if ($language == 0) {
//     ?>
//       localStorage.clear();
//       localStorage.prevGeoloc = localStorage.currentGeoloc;
//       localStorage.currentGeoloc = 'OFF';

//       console.log('geoloc OFF, EN only');
//       localStorage.lang = 0;
//       localStorage.lang_visible = 0;
//       localStorage.switchLang = 0;
//       localStorage.country_code = 'EN';

//     <?php } else if ($language == 1) { ?>
//       localStorage.clear();
//       localStorage.prevGeoloc = localStorage.currentGeoloc;
//       localStorage.currentGeoloc = 'OFF';

//       console.log('geoloc OFF, ID only');
//       localStorage.lang = 1;
//       localStorage.lang_visible = 0;
//       localStorage.switchLang = 1;
//       localStorage.country_code = 'ID';

//   <?php }
//   } ?>

/** generate overview chart */
// <?php if ($usage_data != null) { ?>
//     var ut = <?php echo $usage_data['TEXT']; ?>;
//     var ui = <?php echo $usage_data['DOC']; ?>;
//     var uv = <?php echo $usage_data['VIDEO']; ?>;
//     var ls = <?php echo $usage_data['LS']; ?>;
//     var vo = <?php echo $usage_data['VOIP']; ?>;
//     var vc = <?php echo $usage_data['VIDCALL']; ?>;

//     let text = [];
//     let image = [];
//     let video = [];
//     let ls_min = [];
//     let voip_min = [];
//     let vc_min = [];
//     let created_at = [];
//     text.push(ut);
//     image.push(ui);
//     video.push(uv);
//     ls_min.push(ls);
//     voip_min.push(vo);
//     vc_min.push(vc);
//     created_at.push($(".usage-period").text());
// <?php } else { ?>
//     let text = [0];
//     let image = [0];
//     let video = [0];
//     let ls_min = [0];
//     let voip_min = [0];
//     let vc_min = [0];
//     let created_at = [];
//     created_at.push($(".usage-period").text());
// <?php } ?>

// var ctx = document.getElementById('myUsage');
// var myChart = new Chart(ctx, {
// type: 'bar',
// data: {
//     labels: [''],
//     datasets: [{
//         label: 'Text Recipient',
//         backgroundColor: '#ED553B',
//         borderColor: '#ED553B',
//         data: text,
//         fill: false
//     }, {
//         label: 'Documents & Images Recipient',
//         backgroundColor: '#F6D55C',
//         borderColor: '#F6D55C',
//         data: image,
//         fill: false
//     }, {
//         label: 'Video Recipient',
//         backgroundColor: '#3CAEA3',
//         borderColor: '#3CAEA3',
//         data: video,
//         fill: false
//     }, {
//         label: 'Livestream Minutes',
//         backgroundColor: '#20639B',
//         borderColor: '#20639B',
//         data: ls_min,
//         fill: false
//     }, {
//         label: 'VoIP Calls Minutes',
//         backgroundColor: '#173F5F',
//         borderColor: '#173F5F',
//         data: voip_min,
//         fill: false
//     }, {
//         label: 'Video Calls Minutes',
//         backgroundColor: '#9966FF',
//         borderColor: '#9966FF',
//         data: vc_min,
//         fill: false
//     }]
// },
// options: {
//     maintainAspectRatio: false,
//     responsive: true,
//     title: {
//         display: false,
//         text: 'Chart.js Line Chart'
//     },
//     tooltips: {
//         mode: 'index',
//         intersect: false,
//     },
//     hover: {
//         mode: 'nearest',
//         intersect: true
//     },
//     scales: {
//         xAxes: [{
//             display: true,
//             scaleLabel: {
//                 display: false,
//                 labelString: 'Month'
//             }
//         }],
//         yAxes: [{
//             display: true,
//             scaleLabel: {
//                 display: true,
//                 labelString: 'Usage'
//             },
//             ticks: {
//                 suggestedMin: 0
//             }
//         }]
//     }
// }
// });

/** guide palio */
// $(document).ready(function() {
//     $("#paliolite-link").addClass("active");
//     $("#customization-link").removeClass("active");
//     $("#nusdk-link").removeClass("active");
//     $("#restapi-link").removeClass("active");
// });

// var docHeight = document.documentElement.offsetHeight;

// [].forEach.call(
//     document.querySelectorAll('*'),
//     function(el) {
//         if (el.offsetHeight > docHeight) {
//             console.log(el);
//         }
//     }
// );
// $('body').scrollspy({
//     target: '#menu-side'
// });

// $('.main-extend').click(function(e) {
//         e.preventDefault();
//         e.stopPropagation();
// 		$('#mainActivity-extend').show();
// 		$('#mainActivity-nonextend').hide();
// 	});

// 	$('.main-non-extend').click(function(e) {
//         e.preventDefault();
//         e.stopPropagation();
// 		$('#mainActivity-extend').hide();
// 		$('#mainActivity-nonextend').show();
// 	});

// $(window).on('activate.bs.scrollspy', function() {

//     var item = $('#menu-side').find(".active").last();
//     item.animatescroll({
//         element: '#menu-side',
//         padding: 500
//     });
    
// });

// var url = window.location.pathname;
// $('#active-guide').text(url);