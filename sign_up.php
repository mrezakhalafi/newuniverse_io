<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/url_function.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/db_conn.php'); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/header-alt.php'); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/customize_template.php'); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/mail_template.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/session_function.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/encoder.php'); ?>

<?php

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

require './gmail/email.php';

if (isset($_SESSION['flag']) && $_SESSION['flag'] == 1 && $_SESSION['password_show'] != null) {
    unset($_SESSION['flag']);
}

if (isset($_SESSION['id_company']) && isset($_SESSION['id_user'])) {
    header("Location: index.php");
}

$_SESSION['previous_page'] = $_SESSION['current_page'];
$_SESSION['current_page'] = 10;
require_once($_SERVER['DOCUMENT_ROOT'] . '/state_control.php');

$version = 'v=' . time();
$timeSec = 'v=' . time();


// $price_chosen = 33.50;
$services = "ls,vc,ac,ss,um,wb,cb";
$storage = 100;
$bandwidth = 100;
$type = 'monthly';

$checkPwd = 'T3sB4Y4rN0X3nd1t';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['sign_up']) || isset($_POST['trial'])) {

    if ($_POST['pwd'] != $checkPwd) {
        echo '<script>alert("restricted access");</script>';
        return;
    }

    if (!isset($_SESSION['flag'])) {
        $_SESSION['flag'] = 1;
    } else {
        redirect(base_url());
    }

    if (isset($_POST['country_code'])) {
        if ($_POST['country_code'] == 'ID') {
            $_SESSION['country_code'] = 'ID';
            $currency = 'IDR';
            $price_chosen = 450000.00;
        } else {
            $_SESSION['country_code'] = '';
            $currency = 'USD';
            $price_chosen = 33.50;
        }
    }

    //check session token
    $query = $dbconn->prepare("SELECT * FROM SESSION WHERE SESSION_TOKEN = ?");
    $query->bind_param("s", $_SESSION['session_token']);
    $query->execute();
    $token = $query->get_result()->fetch_assoc();
    $token_exist = $token['USER_ID'];
    $query->close();

    if ($token_exist == null) {

        $email = $_POST['email'];
        $query = $dbconn->prepare("SELECT COUNT(*) AS CNT FROM USER_ACCOUNT WHERE EMAIL_ACCOUNT = ?");
        $query->bind_param("s", $email);
        $query->execute();
        $items = $query->get_result()->fetch_assoc();
        $countEmail = $items['CNT'];
        // $cnt = $items['cnt'];
        $query->close();

        if ($countEmail > 0) {
            echo "<script>";
            echo "alert('Your email has already been registered, please use a different email address');";
            echo "</script>";
            return;
        }

        $cmpny = $_POST['companyname'];
        if (strlen($cmpny) > 0 && substr($cmpny, 0, 1) === " " || substr($cmpny, strlen($cmpny) - 1, strlen($cmpny)) === " ") {
            echo ("<script>alert('Your company name cannot start or end with a blank space');</script>");
            echo ("<script>window.location = window.location.href;</script>");
            return;
        }

        $usrnm = $_POST['username'];
        if (strlen($usrnm) > 0 && substr($usrnm, 0, 1) === " " || substr($usrnm, strlen($usrnm) - 1, strlen($usrnm)) === " ") {
            echo ("<script>alert('Your username cannot start or end with a blank space');</script>");
            echo ("<script>window.location = window.location.href;</script>");
            return;
        }

        $pwds = $_POST['pwd'];
        $pwdscheck = $_POST['pwdcheck'];
        setSession('password_show', $pwds);
        setSession('password', md5($pwds));
        setSession('email', $_POST['email']);
        setSession('price', $price_chosen);
        setSession('username', $_POST['username']);

        if (strlen($pwds) > 0 && substr($pwds, 0, 1) === " " || substr($pwds, strlen($pwds) - 1, strlen($pwds)) === " ") {
            echo ("<script>alert('Your password cannot start or end with a blank space');</script>");
            echo ("<script>window.location = window.location.href;</script>");
            return;
        }

        if (strlen($pwds) < 6 || strlen($pwdscheck) < 6) {
            echo ("<script>alert('Your password is less than 6 characters!');</script>");
            echo ("<script>window.location = window.location.href;</script>");
            return;
        }

        if ($pwds != $pwdscheck) {
            echo ("<script>alert('Password does not match!');</script>");
            echo ("<script>window.location = window.location.href;</script>");
            return;
        }

        if ($pwds == null || $pwdscheck == null || $cmpny == null || $usrnm == null || $email == null) {
            echo ("<script>alert('Input cannot be blank!');</script>");
            echo ("<script>window.location = window.location.href;</script>");
            return;
        }

        if ($pwds == '') {
            echo ("<script>alert('Your password cannot be blank');</script>");
            echo ("<script>window.location = window.location.href;</script>");
            return;
        }

        if (!preg_match('/^[A-Z0-9._-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i', $email)) {
            echo ("<script>alert('Email is not valid!');</script>");
            echo ("<script>window.location = window.location.href;</script>");
            return;
        }

        $dbconn = getDBConn();
        $password = $_POST['pwd'];
        $username = $_POST['username'];
        $company_name = $_POST['companyname'];
        $hash = md5(rand(0, 1000));
        $product_id = 0;

        // cek email
        $query = $dbconn->prepare("SELECT * FROM USER_ACCOUNT WHERE EMAIL_ACCOUNT = ?");
        $query->bind_param("s", $email);
        $query->execute();
        // $itemUser = $query->get_result()->fetch_assoc();
        $counteremail = $query->get_result()->fetch_assoc();
        if ($counteremail != null) {
            echo ("<script>alert('Email has already registered!');</script>");
            echo ("<script>window.location = '" . base_url() . "newpricing.php#pay';</script>");
            return;
        }
        // $cnt = $itemUser['cnt'];
        $msg = "";
        $query->close();
        // end cek email

        // captcha
        // Secret Key ini kita ambil dari halaman Google reCaptcha
        // Sesuai pada catatan saya di STEP 1 nomor 6
        $secret_key = "6LfwcuAUAAAAAPlhqsGI1bRUXzJeFLt8l8OzAPMR";
        // Disini kita akan melakukan komunkasi dengan google recpatcha
        // dengan mengirimkan scret key dan hasil dari response recaptcha nya
        $verify = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret_key . '&response=' . $_POST['g-recaptcha-response']);
        $response = json_decode($verify);
        // end captcha

        // redirect ke page name
        // if (!$itemUser) exit('No rows');

        if ($countEmail > 0) {
            $msg = 'Email has already registered!';
        } else {
            // captcha oke
            if ($response->success) {

                // select an apikey
                $query = $dbconn->prepare("SELECT APIKEY FROM APIKEY ORDER BY ID DESC LIMIT 1");
                $query->execute();
                $apiarray = $query->get_result()->fetch_assoc();
                $apikey = $apiarray['APIKEY'];
                $query->close();

                // insert company
                $query = $dbconn->prepare("INSERT INTO COMPANY (API_KEY, DOMAIN, STATUS) VALUES (?, 'easysoft', 0)");
                $query->bind_param("s", $apikey);
                $query->execute();
                $company_id = $query->insert_id;
                $query->close();

                $_SESSION['id_company'] = $company_id;

                // delete used apikey
                $query = $dbconn->prepare("DELETE FROM APIKEY WHERE APIKEY = ?");
                $query->bind_param("s", $apikey);
                $query->execute();
                $query->close();

                //if untuk tombol trial
                if ($_POST['sign_up'] == "Trial" || $_POST['sign_up'] == "Uji Coba" || $_POST['trial'] == "trial") {
                    //insert id product to subscribe table
                    $query = $dbconn->prepare("INSERT INTO SUBSCRIBE (COMPANY, PRODUCT, START_DATE, END_DATE, STATUS) VALUES (?, ?, NOW(), DATE_ADD(NOW(), INTERVAL 1 DAY), 3)");
                    $query->bind_param("ii", $company_id, $product_id);
                    $query->execute();
                    $subscribe_id = $query->insert_id;
                    $query->close();

                    // insert to user account
                    $query = $dbconn->prepare("INSERT INTO USER_ACCOUNT (COMPANY, USERNAME, EMAIL_ACCOUNT, PASSWORD, STATUS, HASH, ACTIVE) VALUES (?, ?, ?, MD5(?), 3, ?, 0);");
                    $query->bind_param("issss", $company_id, $username, $email, $password, $hash);
                    $query->execute();
                    if (!$dbconn->commit()) {
                        echo "Commit insert user account gagal ";
                    } else {
                        echo "Commit insert user account sukses ";
                    }
                    $user_id = $query->insert_id;
                    $query->close();

                    // update session
                    $query = $dbconn->prepare("UPDATE SESSION SET USER_ID = ? WHERE SESSION_TOKEN = ?");
                    $query->bind_param("is", $user_id, $_SESSION['session_token']);
                    $query->execute();
                    $query->close();

                    setSession("id_user", $user_id);
                } else {
                    //insert id product to subscribe table
                    $query = $dbconn->prepare("INSERT INTO SUBSCRIBE (COMPANY, PRODUCT, START_DATE, END_DATE, STATUS) VALUES (?, ?, NOW(), DATE_ADD(NOW(), INTERVAL 30 DAY), 0)");
                    $query->bind_param("ii", $company_id, $product_id);
                    $query->execute();
                    $subscribe_id = $query->insert_id;
                    $query->close();

                    // insert to user account
                    $query = $dbconn->prepare("INSERT INTO USER_ACCOUNT (COMPANY, USERNAME, EMAIL_ACCOUNT, PASSWORD, STATUS, HASH, ACTIVE) VALUES (?, ?, ?, MD5(?), 1, ?, 0);");
                    $query->bind_param("issss", $company_id, $username, $email, $password, $hash);
                    $query->execute();
                    if (!$dbconn->commit()) {
                        echo "Commit insert user account gagal ";
                    } else {
                        echo "Commit insert user account sukses ";
                    }
                    $user_id = $query->insert_id;
                    $query->close();

                    // update session
                    $query = $dbconn->prepare("UPDATE SESSION SET USER_ID = ? WHERE SESSION_TOKEN = ?");
                    $query->bind_param("is", $user_id, $_SESSION['session_token']);
                    $query->execute();
                    $query->close();
                    setSession("id_user", $user_id);
                    //check order number availability
                    do {
                        $bytes = random_bytes(8);
                        $hexbytes = strtoupper(bin2hex($bytes));
                        $order_number = substr($hexbytes, 0, 15);

                        $query = $dbconn->prepare("SELECT COUNT(*) as counter_bill FROM BILLING WHERE ORDER_NUMBER = ?");
                        $query->bind_param("s", $order_number);
                        $query->execute();
                        $counter = $query->get_result()->fetch_assoc();
                        $counter_bill = $counter['counter_bill'];
                        $query->close();
                    } while ($counter_bill > 0);

                    $query = $dbconn->prepare("INSERT INTO BILLING (ORDER_NUMBER, BILL_DATE, DUE_DATE, COMPANY, SUBSCRIBE, CURRENCY, CHARGE, CUT_OFF_DATE, IS_PAID) VALUES (?, NOW(), DATE_ADD(NOW(), INTERVAL 30 DAY), ?, ?, ?, ?, DATE_ADD(NOW(), INTERVAL 37 DAY), 0)");
                    $query->bind_param("siisd", $order_number, $company_id, $subscribe_id, $currency, $price_chosen);
                    $query->execute();
                    $query->close();

                    setSession('order_number', $order_number);
                }

                // insert company info
                $query = $dbconn->prepare("INSERT INTO COMPANY_INFO (COMPANY, COMPANY_NAME, CREATED_DATE, PRODUCT_INTEREST) VALUES (?, ?, NOW(), ?);");
                $query->bind_param("iss", $company_id, $company_name, $services);
                $query->execute();
                $query->close();

                // insert company info
                $query = $dbconn->prepare("REPLACE INTO CREDIT (USER_ID, COMPANY_ID, CURRENCY) VALUES (?, ?, ?);");
                $query->bind_param("iis", $user_id, $company_id, $currency);
                $query->execute();
                $query->close();

                $feature_count = 7;

                $secret = sha1($hash);
                $_SESSION['secret'] = $secret;

                // insert temporary table
                $query = $dbconn->prepare("INSERT INTO HASH (EMAIL, HASH) VALUES (?, ?);");
                $query->bind_param("ss", $email, $secret);
                $query->execute();
                $query->close();

                // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ // EMAIL ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                $url = base_url();
                $email = strtolower($_POST['email']);
                $activation_link = base_url() . "verify.php?h=" . $secret;
                $header = file_get_contents('Palio_Confirmation_Header.html');
                $body = file_get_contents('Palio_Confirmation_Body.html');
                $footer = file_get_contents('Palio_Confirmation_Footer.html');
                // $content = $header . $username . $body . $activation_link . $footer;
                $content = customizeTemplateRemoteEmailConfirmation($username, $activation_link);
                // sendMail($content, $email);
                // $content = file_get_contents('template/PalioEmailConfirmation.htm');
                // sendMailEmailConfirmation($content, $email);
                echo send_email($email, $email, "Palio Email Confirmation", $content);

                // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ // END EMAIL ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

                redirect(base_url() . "verifyemail.php");
                exit();
            } else {
                $msg = 'Please Validate that you are human!';
                // echo("<script>$('#submit_sign_up').prop('disabled',true);</script>");
            }
        }
        // end redirect
        // }
    } else {
        echo ("<script>if (localStorage.lang == 1){ alert('Anda sudah pernah mendaftar dengan akun yang lain sebelumnya!'); }else{ alert('You already signed up another account!'); };
        window.location.href = 'index.php'</script>");
        exit();
    }
}

//To send email
function send_email($email_address, $email_dest, $subject, $body)
{
    try {
        // Get the API client and construct the service object.
        $client = getClient();
        $service = new Google_Service_Gmail($client);

        $message = createMessage('support@palio.io', $email_dest, $subject, $body);
        sendMessage($service, 'support@palio.io', $message);

        return 'Message has been sent';
    } catch (Exception $e) {

        return "Message could not be sent. Mailer Error: {$e}";
    }
}

$timeSec = 'v=' . time();

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>nexilis Sign Up</title>

    <!-- Font-Family CSS -->
    <!-- <link rel="stylesheet" href="https://db.onlinewebfonts.com/c/623c7118249e082fe87a78e08506cb4b?family=Segoe+UI">
    <link rel="stylesheet" href="https://db.onlinewebfonts.com/c/d4d6e1a6527a21185217393c427a52cb?family=Segoe+UI+Semibold"> -->

    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/custom.css">
    <link rel="stylesheet" type="text/css" href="./css/api_web.css">
    <link rel="icon" type="image/x-icon" href="<?php echo base_url(); ?>palio_logo_round.png">

    <!-- POPPINS -->
    <link rel="stylesheet" href="./fonts/poppins/style.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>

    <!-- Main JS -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
    <!-- <script src="bootstrap/js/bootstrap.min.js"></script> -->

    <!-- Custom JS -->
    <script src="js/custom.js?<?php echo $timeSec; ?>"></script>


    <!-- reCAPTCHA -->
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script type="module" src="<?php echo base_url(); ?>translate.js?<?php echo $timeSec; ?>"></script>

    <style>
        #passwarn {
            display: none;
        }

        .g-recaptcha {
            overflow: auto;
        }

        @media (max-width: 600px) {
            #login-text {
                /* display: none; */
                font-size: 9px !important;
            }
        }

        .navbar-nav .dropdown-menu {
            position: absolute !important;
        }

        @media (max-width: 410px) {
            #btn-login {
                font-size: 15px;
            }
        }

        @media (max-width: 386px) {
            #btn-login {
                font-size: 13px;
            }
        }

        @media (max-width: 372px) {
            #btn-login {
                font-size: 11px;
            }
        }

        @media (max-width: 363px) {
            #btn-login {
                font-size: 7px;
            }
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

    <nav class="navbar navbar-expand-lg fixed-top px-0" id="navtop-alt" style="transition: top 0.3s;">
        <div class="container" style="max-width: 90%">
            <a class="navbar-brand fs-30 text-white txt-decor-none" href="<?php echo base_url(); ?>" style="margin-left: -21px !important">
                <!-- <img src="<?php echo base_url(); ?>newAssets/home.png" id="homeLogo" style="max-height: 30px;"> -->
                <img src="<?php echo base_url(); ?>green_newuniverse.png" id="logoImg">
            </a>
            <ul class="nav navbar-nav ml-auto text-center fontRobReg">
                <li class="nav-item mx-1 d-flex justify-content-center align-items-center">
                    <strong><span id="login-text" data-translate="signup-1" class="navbar-text navbar-right fs-16"></span></strong>
                </li>
                <li class="nav-item mx-1 d-flex justify-content-center align-items-center">
                    <button id="btn-login" data-translate="signup-2" onclick="pindah('login.php')" class="btn nav-menu-btn-wht-alt fs-16 py-1 px-3"></button>
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

    <div class="modal fade" id="myModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <label class="title-modal">Invalid User or Password</label>
                    <p class="text-modal fs-20"><?php if (!empty($msg)) {
                                                    echo $msg;
                                                } else {
                                                    echo "error";
                                                } ?></p>
                </div>
            </div>
        </div>
    </div>

    <div class="container" style="margin-top: 5.5rem !important">
        <div class="row mt-5 pt-4 mb-5 justify-content-center">
            <div class="mt-5 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                <!-- <img alt="Under Maintenane" src="newAssets/under-maintenance.png" /> -->

                <form method="POST" enctype="multipart/form-data">
                    <h3 class="text-left fontRobReg fc-70 fs-30 mt-4">
                        <!-- <strong>Subscribe</strong> -->
                        <strong data-translate="signup-3"></strong>
                    </h3>

                    <!-- username -->
                    <div class="input-group btn border-70 p-0 mt-4">
                        <input minlength="6" style="width: 100%" type="text" required class="form-control form-control fs-18 fontRobReg border-0" id="username" placeholder="Username" name="username" value="<?php if (isset($_POST['sign_up'])) {
                                                                                                                                                                                                                    echo ($_POST['username']);
                                                                                                                                                                                                                } else {
                                                                                                                                                                                                                    echo ('');
                                                                                                                                                                                                                } ?>">
                    </div>
                    <!-- <p data-translate="signup-4" class="text-danger fs-15 fontRobReg m-0 text-left" id="alertEmpty1" style="display: none;"></p> -->
                    <p class="text-danger fs-15 fontRobReg m-0 text-left" id="alertEmpty1" data-translate="signup-15" style="display: none;">This fields is required.</p>

                    <!-- company name -->
                    <div class="input-group btn border-70 p-0 mt-4">
                        <input type="text" style="width: 100%" required class="form-control form-control fs-18 fontRobReg border-0" id="companyname" placeholder="Company Name" name="companyname" value="<?php if (isset($_POST['sign_up'])) {
                                                                                                                                                                                                                echo ($_POST['companyname']);
                                                                                                                                                                                                            } else {
                                                                                                                                                                                                                echo ('');
                                                                                                                                                                                                            } ?>">
                    </div>
                    <p class="text-danger fs-15 fontRobReg m-0 text-left" id="alertEmpty2" data-translate="signup-15" style="display: none;">This fields is required.</p>

                    <!-- email -->
                    <div class="input-group btn border-70 p-0 mt-4">
                        <input type="email" style="width: 100%" required class="form-control form-control fs-18 fontRobReg border-0" id="email" placeholder="Email" name="email" value="<?php if (isset($_POST['sign_up'])) {
                                                                                                                                                                                            echo ($_POST['email']);
                                                                                                                                                                                        } else {
                                                                                                                                                                                            echo ('');
                                                                                                                                                                                        } ?>">
                    </div>
                    <p data-translate="signup-6" class="text-danger fs-15 fontRobReg m-0 text-left" id="alertEmail" style="display: none;"></p>
                    <p class="fs-15 fontRobReg m-0 text-left" id="alertExisting" style="display: none;"></p>
                    <p class="text-danger fs-15 fontRobReg m-0 text-left" id="alertEmpty3" data-translate="signup-15" style="display: none;">This fields is required.</p>

                    <!-- password -->
                    <div class="input-group btn border-70 p-0 mt-4">
                        <input type="password" required class="form-control fs-18 fontRobReg border-0" id="passwordTF" placeholder="Password" name="pwd" minlength="6">
                        <div class="input-group-append">
                            <button type="button" class="btn py-0 px-3" onclick="showhide()">
                                <i class="fa fa-eye-slash fs-20" id="showhide"></i>
                            </button>
                        </div>
                    </div>
                    <p class="text-danger fs-15 fontRobReg m-0 text-left" id="alertEmpty4" data-translate="signup-15" style="display: none;">This fields is required.</p>

                    <div class="input-group p-0 mt-4">

                        <progress id="progress" value="0" max="100" style="width:100%;">70</progress>
                        <p class="fontRobReg">
                            <span data-translate="signup-7" class="fs-18"></span>: <span id="progresslabel" class="fontRobReg"></span>
                            <br><small data-translate="signup-8" id="passwarn" style="color: red;"></small>
                            <small data-translate="signup-14" id="passForbiddenChar" style="color: red; display:none;"></small>
                        </p>
                    </div>

                    <!-- confirm password -->
                    <div class="input-group btn border-70 p-0">
                        <input type="password" required class="form-control fs-18 fontRobReg border-0" id="passwordTFconfirm" placeholder="Confirm Password" name="pwdcheck" minlength="6">
                        <div class="input-group-append">
                            <button type="button" class="btn py-0 px-3" onclick="showhide2()">
                                <i class="fa fa-eye-slash fs-20" id="showhide2"></i>
                            </button>
                        </div>
                    </div>
                    <p class="text-danger fs-15 fontRobReg m-0 text-left" id="alertEmpty5" data-translate="signup-15" style="display: none;">This fields is required.</p>
                    <p data-translate="signup-9" class="text-danger fs-15 fontRobReg m-0 mb-4 text-left" id="alertPasswordMatch" style="display: none;"></p>

                    <input type="hidden" name="country_code" id="country_code">
                    <div class="d-flex mt-4 justify-content-center">
                        <div class="g-recaptcha fontRobReg" data-callback="recaptcha_callback" data-sitekey="6LfwcuAUAAAAAH-LdFc1VWsjtCh3587QBskw5I44"></div>
                    </div>
                    <p class="text-danger fs-15 fontRobReg m-0 text-left" id="alertEmpty6" data-translate="signup-15" style="display: none;">This fields is required.</p>
                    <div class="row d-flex justify-content-center">
                        <input type="submit" id="submit_sign_up" class="col-5 col-md-5 mx-auto btn nav-menu-btn-wht-alt my-4 fs-18" value="Sign Up" name="sign_up">
                        <input type="submit" id="trial_sign_up" class="col-5 col-md-5 mx-auto btn nav-menu-btn-wht-alt-subs my-4 fs-18" value="Trial" name="sign_up">
                    </div>

                    <!-- trial developer only -->
                    <form method="post">
                        <input style="display: none;" type="submit" value="trial" name="trial" id="totrial">
                        <input style="display: none;" type="submit" value="Sign Up" name="sign_up" id="tosubscription">
                    </form>
                    <!-- end trial developer only -->

                </form>
                <div class="text-left fs-18 fontRobReg fc-70 mt-2">
                    <span data-translate="signup-10"></span>
                    <a data-translate="signup-11" class="text-decoration-none" href="termsofservice.php">
                        <a data-translate="signup-12" class="text-decoration-none" href="privacypolicy-nu.php">
                            <a data-translate="signup-13" class="text-decoration-none" href="usepolicy.php"> </a>.
                </div>
            </div>
        </div>
    </div>

    <!-- sign up warning Modal -->
    <div class="modal hide fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Oops, we're sorry!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="text-align: center;">
                    <img onclick="subsClick();" alt="Under Maintenane" src="newAssets/under-maintenance.png" /><br>
                    Sorry we cannot process your payment now. Meanwhile, you can use the trial version of Palio Lite.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- trial warning Modal -->
    <div class="modal hide fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Oops, we're sorry!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="text-align: center;">
                    <img onclick="trialClick();" id="trialImage" alt="Under Maintenane" src="newAssets/under-maintenance.png" /><br>
                    Sorry we cannot process your trial now. Please come back later.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <!-- DOM purifier -->
    <script type="text/javascript" src="<?php echo base_url(); ?>dompurify/dist/purify.min.js"></script>

    <script src="js/sign_up_raw.js?<?php echo $version; ?>"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            <?php if ($_SESSION['geolocSts'] == 0 && $_SESSION['language'] == 1) { ?>
                var _0xc9e7 = ['val', '#country_code', '826992vdcOKe', '1390278ZdKiqu', '1404572fZmqBd', '616630sXpvmU', '1235327PDhoXI', '5loJtsk', '19fFfouG', '20590yWCptG', '461759AMGINa'];
                var _0xbc71 = function(_0x210e21, _0x4ab3d4) {
                    _0x210e21 = _0x210e21 - 0x151;
                    var _0xc9e7a7 = _0xc9e7[_0x210e21];
                    return _0xc9e7a7;
                };
                var _0x20b6d7 = _0xbc71;
                (function(_0x45ad5e, _0xd83c60) {
                    var _0x1168df = _0xbc71;
                    while (!![]) {
                        try {
                            var _0x5075c7 = -parseInt(_0x1168df(0x159)) * -parseInt(_0x1168df(0x158)) + parseInt(_0x1168df(0x156)) + -parseInt(_0x1168df(0x154)) + parseInt(_0x1168df(0x155)) + parseInt(_0x1168df(0x153)) + parseInt(_0x1168df(0x152)) + parseInt(_0x1168df(0x15a)) * -parseInt(_0x1168df(0x157));
                            if (_0x5075c7 === _0xd83c60) break;
                            else _0x45ad5e['push'](_0x45ad5e['shift']());
                        } catch (_0x1fdefd) {
                            _0x45ad5e['push'](_0x45ad5e['shift']());
                        }
                    }
                }(_0xc9e7, 0xb663e), $(_0x20b6d7(0x151))[_0x20b6d7(0x15b)]('ID'));
            <?php } else if ($_SESSION['geolocSts'] == 0 && $_SESSION['language'] == 0) { ?>
                var _0x318a = ['270STmdkA', '2874GNddlT', '1065201bnoODG', '4KTmnaG', '130RLfyiM', '#country_code', '133876FCodUU', '3467qZpzcI', '466629rGPAYh', '17tVkJmo', '714599olaNro', 'val', '80968zJyxYm'];
                var _0x5c1a = function(_0x30fa68, _0x16ce80) {
                    _0x30fa68 = _0x30fa68 - 0xd4;
                    var _0x318aee = _0x318a[_0x30fa68];
                    return _0x318aee;
                };
                var _0x3e1aa9 = _0x5c1a;
                (function(_0x1fa3be, _0x5921e7) {
                    var _0x3a7ae0 = _0x5c1a;
                    while (!![]) {
                        try {
                            var _0x41755d = parseInt(_0x3a7ae0(0xd4)) * parseInt(_0x3a7ae0(0xda)) + -parseInt(_0x3a7ae0(0xdc)) + -parseInt(_0x3a7ae0(0xe0)) * -parseInt(_0x3a7ae0(0xdd)) + parseInt(_0x3a7ae0(0xde)) * parseInt(_0x3a7ae0(0xdb)) + parseInt(_0x3a7ae0(0xd5)) + parseInt(_0x3a7ae0(0xd7)) + parseInt(_0x3a7ae0(0xd6)) * -parseInt(_0x3a7ae0(0xd9));
                            if (_0x41755d === _0x5921e7) break;
                            else _0x1fa3be['push'](_0x1fa3be['shift']());
                        } catch (_0x29d8b8) {
                            _0x1fa3be['push'](_0x1fa3be['shift']());
                        }
                    }
                }(_0x318a, 0x8ec51), $(_0x3e1aa9(0xdf))[_0x3e1aa9(0xd8)]('EN'));
            <?php } else if ($_SESSION['geolocSts'] == 1) { ?>
                var _0x251f = ['1gWhzfE', '3159bDhqCg', '141730HughON', '255316GyDPzP', '259153OolgTJ', '#country_code', '187630mnNFXZ', 'val', '1lUVBWY', '2iuCOuJ', '812471YtFrZU', '3SAPZFu', '789nxiIfy', '370618Hscpzg'];
                var _0x5ad0 = function(_0x429ea3, _0x29dfd0) {
                    _0x429ea3 = _0x429ea3 - 0x1bf;
                    var _0x251f05 = _0x251f[_0x429ea3];
                    return _0x251f05;
                };
                var _0x191fd0 = _0x5ad0;
                (function(_0x1167d8, _0x5cd7c5) {
                    var _0x1de3c4 = _0x5ad0;
                    while (!![]) {
                        try {
                            var _0x585d4f = -parseInt(_0x1de3c4(0x1c6)) + -parseInt(_0x1de3c4(0x1cb)) * parseInt(_0x1de3c4(0x1bf)) + -parseInt(_0x1de3c4(0x1c7)) * parseInt(_0x1de3c4(0x1c3)) + -parseInt(_0x1de3c4(0x1c5)) * -parseInt(_0x1de3c4(0x1cc)) + parseInt(_0x1de3c4(0x1c0)) * -parseInt(_0x1de3c4(0x1c9)) + -parseInt(_0x1de3c4(0x1c2)) + parseInt(_0x1de3c4(0x1c1)) * parseInt(_0x1de3c4(0x1c4));
                            if (_0x585d4f === _0x5cd7c5) break;
                            else _0x1167d8['push'](_0x1167d8['shift']());
                        } catch (_0x5524a4) {
                            _0x1167d8['push'](_0x1167d8['shift']());
                        }
                    }
                }(_0x251f, 0x7dd87));
                if (localStorage['country_code'] == 'ID') $(_0x191fd0(0x1c8))[_0x191fd0(0x1ca)]('ID');
                else localStorage['country_code'] != 'ID' && $('#country_code')[_0x191fd0(0x1ca)]('EN');
                var _0x251f = ['1gWhzfE', '3159bDhqCg', '141730HughON', '255316GyDPzP', '259153OolgTJ', '#country_code', '187630mnNFXZ', 'val', '1lUVBWY', '2iuCOuJ', '812471YtFrZU', '3SAPZFu', '789nxiIfy', '370618Hscpzg'];
                var _0x5ad0 = function(_0x429ea3, _0x29dfd0) {
                    _0x429ea3 = _0x429ea3 - 0x1bf;
                    var _0x251f05 = _0x251f[_0x429ea3];
                    return _0x251f05;
                };
                var _0x191fd0 = _0x5ad0;
                (function(_0x1167d8, _0x5cd7c5) {
                    var _0x1de3c4 = _0x5ad0;
                    while (!![]) {
                        try {
                            var _0x585d4f = -parseInt(_0x1de3c4(0x1c6)) + -parseInt(_0x1de3c4(0x1cb)) * parseInt(_0x1de3c4(0x1bf)) + -parseInt(_0x1de3c4(0x1c7)) * parseInt(_0x1de3c4(0x1c3)) + -parseInt(_0x1de3c4(0x1c5)) * -parseInt(_0x1de3c4(0x1cc)) + parseInt(_0x1de3c4(0x1c0)) * -parseInt(_0x1de3c4(0x1c9)) + -parseInt(_0x1de3c4(0x1c2)) + parseInt(_0x1de3c4(0x1c1)) * parseInt(_0x1de3c4(0x1c4));
                            if (_0x585d4f === _0x5cd7c5) break;
                            else _0x1167d8['push'](_0x1167d8['shift']());
                        } catch (_0x5524a4) {
                            _0x1167d8['push'](_0x1167d8['shift']());
                        }
                    }
                }(_0x251f, 0x7dd87));
                if (localStorage['country_code'] == 'ID') $(_0x191fd0(0x1c8))[_0x191fd0(0x1ca)]('ID');
                else localStorage['country_code'] != 'ID' && $('#country_code')[_0x191fd0(0x1ca)]('EN');
            <?php } ?>
        });
    </script>

    <?php if (!empty($msg)) : ?>
        <script type="text/javascript">
            var _0x5876 = ['show', '4489TYgXRb', '3wBOCYZ', '4103dxWdqI', '237558mdGUOD', '79523kRiaqO', '63MRtwtO', '950211xngdmV', '1egZkcL', '806145iVuBSr', '172607vGyUBK', '#myModal'];
            var _0x5ad8 = function(_0x8da776, _0xe1c791) {
                _0x8da776 = _0x8da776 - 0x1b2;
                var _0x5876f2 = _0x5876[_0x8da776];
                return _0x5876f2;
            };
            (function(_0x599add, _0xd829d7) {
                var _0x5b14db = _0x5ad8;
                while (!![]) {
                    try {
                        var _0x27b413 = -parseInt(_0x5b14db(0x1b9)) + parseInt(_0x5b14db(0x1ba)) * parseInt(_0x5b14db(0x1b2)) + parseInt(_0x5b14db(0x1b6)) * parseInt(_0x5b14db(0x1bd)) + -parseInt(_0x5b14db(0x1b4)) + -parseInt(_0x5b14db(0x1b8)) * parseInt(_0x5b14db(0x1b5)) + parseInt(_0x5b14db(0x1b3)) + parseInt(_0x5b14db(0x1b7));
                        if (_0x27b413 === _0xd829d7) break;
                        else _0x599add['push'](_0x599add['shift']());
                    } catch (_0x3b8fbb) {
                        _0x599add['push'](_0x599add['shift']());
                    }
                }
            }(_0x5876, 0x9a3a4), $(document)['ready'](function() {
                var _0x2295fa = _0x5ad8;
                $(_0x2295fa(0x1bb))['modal'](_0x2295fa(0x1bc)), checkEmptyUname(), checkEmptyCompany(), checkPasswordMatch(), checkEmail(), doCheck();
            }));
        </script>
    <?php endif; ?>

</body>

</html>
<script>
    var _0x5244 = ['1DZGUfM', '105714ThJahw', '1689389kmPtJd', '713632fbBwwM', '7PxrQMR', 'location', '716008TokwCj', '11658qWIjPc', '155203qWVszi', '2chKvPU', 'replaceState', '1103dyoBde', '240UhwyLA', 'history'];
    var _0x3cd6 = function(_0x53e616, _0x8b647b) {
        _0x53e616 = _0x53e616 - 0x64;
        var _0x5244c3 = _0x5244[_0x53e616];
        return _0x5244c3;
    };
    var _0x195253 = _0x3cd6;
    (function(_0x10cf52, _0x18c616) {
        var _0x2d1768 = _0x3cd6;
        while (!![]) {
            try {
                var _0xa9aa12 = -parseInt(_0x2d1768(0x65)) + parseInt(_0x2d1768(0x68)) * -parseInt(_0x2d1768(0x67)) + -parseInt(_0x2d1768(0x70)) + -parseInt(_0x2d1768(0x6b)) * -parseInt(_0x2d1768(0x6a)) + parseInt(_0x2d1768(0x6e)) + parseInt(_0x2d1768(0x66)) * parseInt(_0x2d1768(0x71)) + -parseInt(_0x2d1768(0x6f)) * -parseInt(_0x2d1768(0x6d));
                if (_0xa9aa12 === _0x18c616) break;
                else _0x10cf52['push'](_0x10cf52['shift']());
            } catch (_0x2593b5) {
                _0x10cf52['push'](_0x10cf52['shift']());
            }
        }
    }(_0x5244, 0x61fe7));
    window[_0x195253(0x6c)]['replaceState'] && window[_0x195253(0x6c)][_0x195253(0x69)](null, null, window[_0x195253(0x64)]['href']);

    $("#change-lang-EN").click(function() {
        localStorage.lang = 0;
        $('#username').attr('placeholder', 'Username');
        $('#companyname').attr('placeholder', 'Company Name');
        $('#email').attr('placeholder', 'Email');
        $('#passwordTF').attr('placeholder', 'Password');
        $('#passwordTFconfirm').attr('placeholder', 'Confirm Password');
        $('#submit_sign_up').attr('value', 'Sign Up');
        $('#trial_sign_up').attr('value', 'Trial');
        $("#alertExisting").text("This email is available.");
        change_lang();
    });

    $("#change-lang-ID").click(function() {
        localStorage.lang = 1;
        $('#username').attr('placeholder', 'Nama Pengguna');
        $('#companyname').attr('placeholder', 'Nama Perusahaan');
        $('#email').attr('placeholder', 'Alamat Email');
        $('#passwordTF').attr('placeholder', 'Kata Sandi');
        $('#passwordTFconfirm').attr('placeholder', 'Konfirmasi Kata Sandi');
        $('#submit_sign_up').attr('value', 'Daftar');
        $('#trial_sign_up').attr('value', 'Uji Coba');
        $("#alertExisting").text("Email ini tersedia.");
        change_lang();
    });
</script>