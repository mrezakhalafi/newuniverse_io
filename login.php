<link rel="icon" type="image/x-icon" href="newAssets/fav.ico">
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/db_conn.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/url_function.php'); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/header-alt.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/session_function.php'); ?>

<?php

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

$_SESSION['previous_page'] = $_SESSION['current_page'];
$_SESSION['current_page'] = 9;
require_once($_SERVER['DOCUMENT_ROOT'] . '/state_control.php');

$timeSec = 'v=' . time();

$version = 'v=' . time();

// if ($_SESSION['id_user'] != '') {
//     header("Location: dashboardv2/index.php");
// }

unset($_POST);

if (isset($_SESSION['id_user'])) {
    if ($_SESSION['id_user'] != '') {
        $email = $_SESSION['email'];
        $showPassword = $_SESSION['password_show'];
        $password = $_SESSION['password'];

        $dbconn = getDBConn();

        $query = $dbconn->prepare("SELECT * FROM USER_ACCOUNT WHERE EMAIL_ACCOUNT = ? ");
        $query->bind_param("s", $email);
        $query->execute();
        $itemUser = $query->get_result()->fetch_assoc();
        $query->close();

        $query = $dbconn->prepare("SELECT * FROM BILLING WHERE COMPANY = ? ORDER BY `CUT_OFF_DATE` DESC LIMIT 1");
        $query->bind_param("s", $itemUser['COMPANY']);
        $query->execute();
        $itemUser2 = $query->get_result()->fetch_assoc();
        $query->close();

        $query = $dbconn->prepare("SELECT * FROM HASH WHERE EMAIL = '$email'");
        $query->execute();
        $itemUser3 = $query->get_result()->fetch_assoc();
        $query->close();

        $msg = "";
        $active = 1;

        if ($itemUser['EMAIL_ACCOUNT'] != '') {

            if ($itemUser['PASSWORD'] != $password) {

                $msg = "Your Password is Incorrect!";

                //echo '<script>alert("Wrong Password")</script>';

            } else if ($itemUser2 != null && strtotime($itemUser2['CUT_OFF_DATE']) < strtotime(date('Y-m-d H:i:s'))) {
                $msg = 'expired';
                header("Location: dashboard2/");
            } else if ($itemUser['ACTIVE'] == 0 && $itemUser['STATE'] < 2) {
                $msg = "Please Validate Your Email!";
                header("Location: /verifyemail.php");
                die();
        } else if ($itemUser['STATE'] == 2 && $itemUser['ACTIVE'] == 1) {
                $msg = "Please Finish Your Payment!";
                header("Location: /paycheckout.php");
                die();
        } else {

                if ($itemUser['ACTIVE'] == 3 && $itemUser['STATE'] == 2) {
                    $msg = "Trial!";
                    header("Location: trialcheckout.php");
                } else {
                    $msg = 'ok';
                    header("Location: index.php");
                }
            }
        }
    }
}

// if (isset($_POST['login'])) {
//     $dbconn = getDBConn();
//     $email = $_POST['email'];
//     $pass = MD5($_POST['pwd']);

//     $query = $dbconn->prepare("SELECT * FROM USER_ACCOUNT WHERE EMAIL_ACCOUNT = ?");
//     $query->bind_param("s", $email);
//     $query->execute();
//     $itemUser = $query->get_result()->fetch_assoc();
//     $query->close();

//     $msg = "";

//     if ($itemUser['EMAIL_ACCOUNT'] != '') {

//         if ($itemUser['PASSWORD'] != $pass) {

//             $msg = "Invalid User or Password!";

//             //echo '<script>alert("Wrong Password")</script>';

//         } else {
//             setSession('email', $email);
//             setSession('password', $pass);
//             setSession('id_company', $itemUser['COMPANY']);
//             setSession('id_user', $itemUser['ID']);
//             redirect(base_url() . 'dashboardv2/');
//         }
//     } else {
//         //salah

//         $msg = "Account does not exist!";

//         //echo '<script>alert("Email not registered")</script>';
//     }
// }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>nexilis Login</title>

    <!-- Font-Family CSS
    <link rel="stylesheet" href="https://db.onlinewebfonts.com/c/623c7118249e082fe87a78e08506cb4b?family=Segoe+UI">
    <link rel="stylesheet" href="https://db.onlinewebfonts.com/c/d4d6e1a6527a21185217393c427a52cb?family=Segoe+UI+Semibold">
     -->

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css"> -->
    <link rel="icon" type="image/x-icon" href="<?php echo base_url(); ?>palio_logo_round.png">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/custom.css">
    <link rel="stylesheet" type="text/css" href="./css/api_web.css">

    <!-- POPPINS -->
    <link rel="stylesheet" href="./fonts/poppins/style.css">

    <!-- Main JS -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
    <!-- <script src="bootstrap/js/bootstrap.min.js"></script> -->

    <!-- Custom JS -->
    <script src="js/custom.js?<?php echo $timeSec; ?>"></script>

    <script type="module" src="<?php echo base_url(); ?>translate.js?<?php echo $timeSec; ?>"></script>

    <style>
        @media (max-width: 600px) {
            #login-text {
                /* display: none; */
                font-size: 9px !important;
            }
        }

        .navbar-brand {
            margin-right: 0rem !important;
            margin-left: -20px !important;
        }

        @media (max-width: 410px) {
            #btn-sign-in {
                font-size: 12px;
            }
        }

        @media (max-width: 386px) {
            #btn-sign-in {
                font-size: 10px;
            }
        }

        @media (max-width: 372px) {
            #btn-sign-in {
                font-size: 8px;
            }
        }

        @media (min-width: 410px) {
            #btn-sign-in {
                font-size: 16px;
            }
        }

        @media (min-width: 425px) {
            #btn-sign-in {
                font-size: 18px;
            }
        }

        .navbar-nav .dropdown-menu {
            position: absolute !important;
        }

        input::-ms-reveal,
        input::-ms-clear {
            display: none;
        }

        ::-ms-reveal {
            display: none;
        }
    </style>

</head>

<body>

    <div class="modal fade" id="myModal" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body fontRobReg">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <label data-translate="login-7"></label>
                    <p data-translate="login-1" class="fs-20 fc-70 mt-1"></p>
                    <!-- <button type="button" class="btn btn-default btn-modal fs-15" data-dismiss="modal">Confirm</button> -->
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="myModal2" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body fontRobReg">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <label data-translate="login-7"></label>
                    <p data-translate="login-1" class="fs-20 fc-70 mt-1"></p>
                    <!-- <button type="button" class="btn btn-default btn-modal fs-15" data-dismiss="modal">Confirm</button> -->
                </div>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-dark fixed-top px-0" id="navtop-alt" style="transition: top 0.3s;">
        <div class="container" style="max-width: 90%">
            <a class="navbar-brand txt-decor-none" href="<?php echo base_url(); ?>">
                <!-- <img src="<?php echo base_url(); ?>newAssets/home.png" id="homeLogo" style="max-height: 30px;"> -->
                <img src="<?php echo base_url(); ?>green_newuniverse.png" id="logoImg">
            </a>
            <ul class="nav navbar-nav ml-auto text-center fontRobReg">
                <li class="nav-item mx-1 d-flex justify-content-center align-items-center">
                    <span id="login-text" class="navbar-text navbar-right fs-16 mt-1" style="color: rgba(0, 0, 0, 1) !important;"><strong data-translate="login-2"></strong></span>
                </li>
                <li class="nav-item mx-1 d-flex justify-content-center align-items-center">
                    <!-- <button data-translate="login-3" onclick="pindah('newpricing.php#pay')" class="btn nav-menu-btn-wht-alt fs-16 py-1 px-3"></button> -->
                    <a href="sign_up.php" id="btn-sign-in" data-translate="login-3" class="btn nav-menu-btn-wht-alt-subs fs-18 py-1 px-3"></a>
                </li>
                <li class="nav-item dropdown position-static d-flex justify-content-center align-items-center" id="lang-li">
                    <a data-translate="indexnav-28" style="font-size: 18px !important; margin-right: 0px;" class="nav-link nav-menu-link dropdown-toggle fontRobReg fs-20 greenText" id="lang-nav" role="button" aria-haspopup="true" aria-expanded="false">

                    </a>
                    <div class="dropdown-menu" id="lang-menu" aria-labelledby="dropdownMenuButton">
                        <div class="col d-flex justify-content-start p-0">
                            <a class="dropdown-item fontRobReg fs-20 py-2 greenText" id="change-lang-EN" role="button" style="display: inline;  color: #1a73e8;">
                                EN
                            </a>
                        </div>
                        <div class="col d-flex justify-content-start p-0">
                            <a class="dropdown-item fontRobReg fs-20 py-2 greenText" id="change-lang-ID" role="button" style="display: inline;  color: #1a73e8;">
                                ID
                            </a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container" style="margin-top: 4.5rem">
        <div class="row text-center" style="margin-top: 100px">
            <div class="mt-5 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-4 offset-lg-4">
                <form id="loginForm">
                    <h3 class="text-left fontRobReg fc-70 fs-30 mt-5">
                        <strong data-translate="login-8">Login</strong>
                    </h3>
                    <div class="input-group btn border-70 p-0 mt-4">
                        <input type="text" onkeydown="return event.keyCode !== 32" required class="form-control fs-16 fontRobReg border-0" style="font-size: 100%" id="emailTF" placeholder="Email" name="email">
                    </div>
                    <p data-translate="login-4" class="text-danger fs-15 fontRobReg m-0 text-left d-none" id="alertEmail"></p>
                    <p class="text-danger fs-15 fontRobReg m-0 text-left d-none" id="emptyEmail"></p>
                    <div class="input-group btn border-70 p-0 mt-4">
                        <input type="password" onkeydown="return event.keyCode !== 32" required class="form-control fs-16 fontRobReg border-0" style="font-size: 100%" id="passwordTF" placeholder="Password" name="pwd" onclick="checkEmail();">
                        <div class="input-group-append">
                            <button type="button" class="btn py-0 px-3" onclick="showhide()"><i class="fa fa-eye-slash fs-20" id="showhide"></i></button>
                        </div>
                    </div>
                    <p class="text-danger fs-15 fontRobReg m-0 text-left d-none" id="emptyPass"></p>
                    <div class="text-right mb-3 mt-3">
                        <a data-translate="login-5" href="forgot.php" class="fontRobReg" style="font-size: 1rem; color: #3862D3;"></a>
                    </div>
                    <button data-translate="login-6" type="button" id="loginBTN" name="login" class="btn nav-menu-btn-wht-alt py-1 px-3 w-100 m-0 fs-18">
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="<?php echo base_url(); ?>dompurify/dist/purify.min.js"></script>

    <script src="js/login_raw.js?<?php echo $version; ?>"></script>

    <?php if (!empty($msg)) : ?>
        <script type="text/javascript">
            var _0x33ed = ['1338941yeMlJK', '1oWqBAZ', '1275523iGruIu', 'show', '82242UILwdJ', '387500iIUCVQ', '1356822zojQwA', 'modal', '71511InEvQr', '#myModal', '129514LQFhTq', 'ready'];
            var _0x3221 = function(_0x11e020, _0x4dd195) {
                _0x11e020 = _0x11e020 - 0x15c;
                var _0x33edfb = _0x33ed[_0x11e020];
                return _0x33edfb;
            };
            var _0x3722d6 = _0x3221;
            (function(_0x3bb24b, _0x213a91) {
                var _0x5329a5 = _0x3221;
                while (!![]) {
                    try {
                        var _0x49b85a = parseInt(_0x5329a5(0x15f)) + -parseInt(_0x5329a5(0x15c)) * -parseInt(_0x5329a5(0x167)) + -parseInt(_0x5329a5(0x161)) + parseInt(_0x5329a5(0x15d)) + parseInt(_0x5329a5(0x163)) + -parseInt(_0x5329a5(0x160)) + -parseInt(_0x5329a5(0x165));
                        if (_0x49b85a === _0x213a91) break;
                        else _0x3bb24b['push'](_0x3bb24b['shift']());
                    } catch (_0x513046) {
                        _0x3bb24b['push'](_0x3bb24b['shift']());
                    }
                }
            }(_0x33ed, 0xda5ad), $(document)[_0x3722d6(0x166)](function() {
                var _0x28b979 = _0x3722d6;
                $(_0x28b979(0x164))[_0x28b979(0x162)](_0x28b979(0x15e));
            }));
        </script>
    <?php endif; ?>

</body>

</html>

<script>
    if (localStorage.lang == 1) {
        $('#passwordTF').attr('placeholder', 'Kata Sandi');

        $('#emailTF').attr('oninvalid', 'this.setCustomValidity("Harap isi bidang ini.")');
        $('#emailTF').attr('onchange', 'this.setCustomValidity("")');

        $('#passwordTF').attr('oninvalid', 'this.setCustomValidity("Harap isi bidang ini.")');
        $('#passwordTF').attr('onchange', 'this.setCustomValidity("")');

        $('#emptyEmail').text("Harap isi bidang ini.");
        $('#emptyPass').text("Harap isi bidang ini.");
    }

    var email = document.getElementById("emailTF");

    email.addEventListener("keypress", function(event) {
        if (event.key === "Enter") {
            document.getElementById("emailTF").blur();
        }
    });

    var password = document.getElementById("passwordTF");

    password.addEventListener("keypress", function(event) {
        if (event.key === "Enter") {
            document.getElementById("passwordTF").blur();
        }
    });

    $("#change-lang-EN").click(function() {
        localStorage.lang = 0;
        $('#emailTF').attr('placeholder', 'Email');
        $('#passwordTF').attr('placeholder', 'Password');

        $('#emailTF').attr('oninvalid', 'this.setCustomValidity("Please fill out this field.")');
        $('#emailTF').attr('onchange', 'this.setCustomValidity("")');

        $('#passwordTF').attr('oninvalid', 'this.setCustomValidity("Please fill out this field.")');
        $('#passwordTF').attr('onchange', 'this.setCustomValidity("")');

        $('#emptyEmail').text("Please fill out this field.");
        $('#emptyPass').text("Please fill out this field.");

        change_lang();
    });

    $("#change-lang-ID").click(function() {
        localStorage.lang = 1;
        $('#emailTF').attr('placeholder', 'Alamat Email');
        $('#passwordTF').attr('placeholder', 'Kata Sandi');

        $('#emailTF').attr('oninvalid', 'this.setCustomValidity("Harap isi bidang ini.")');
        $('#emailTF').attr('onchange', 'this.setCustomValidity("")');

        $('#passwordTF').attr('oninvalid', 'this.setCustomValidity("Harap isi bidang ini.")');
        $('#passwordTF').attr('onchange', 'this.setCustomValidity("")');

        $('#emptyEmail').text("Harap isi bidang ini.");
        $('#emptyPass').text("Harap isi bidang ini.");

        change_lang();
    });
</script>

<script>
    $('#loginBTN').on('touchstart', function() {
        $('#loginBTN').css('background-color', '#fff');
        $('#loginBTN').css('color', '#1799ad');
    });

    $('#loginBTN').on('touchend', function() {
        $('#loginBTN').css('background-color', '#1799ad');
        $('#loginBTN').css('color', '#fff');
    });

    $("#emailTF").bind("change paste keyup", function() {
        var logEmailVal = $(this).val();

        if (logEmailVal != 0) {
            $("#emptyEmail").addClass("d-none");
        } else {
            $("#emptyEmail").removeClass("d-none");
        }
    });

    $("#passwordTF").bind("change paste keyup", function() {
        var logPassVal = $(this).val();

        if (logPassVal != 0) {
            $("#emptyPass").addClass("d-none");
        } else {
            $("#emptyPass").removeClass("d-none");
        }
    });
</script>