<link rel="icon" type="image/x-icon" href="newAssets/fav.ico">
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/url_function.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/db_conn.php'); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/header-alt.php'); ?>
<?php
if (isset($_SESSION['id_company']) != '') {
    header("Location: index.php");
}

session_start();
// $productstring = $_POST['subscribe_type'];
$productstring = 4;
if (!$productstring) {
    header("Location: /newpricing.php#js-range-slider");
}
$product = (int) $productstring;

// $product = (int)$productstring;
// $productstring = "<script>document.write(localStorage.getItem('subscribe_type'));</script>";
// $product = intval(preg_replace('/[^0-9]+/', '', $productstring)); 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['sign_up'])) {

    $email = $_POST['email'];
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
    if (strlen($pwds) > 0 && substr($pwds, 0, 1) === " " || substr($pwds, strlen($pwds) - 1, strlen($pwds)) === " ") {
        echo ("<script>alert('Your password cannot start or end with a blank space');</script>");
        echo ("<script>window.location = window.location.href;</script>");
        return;
    }

    if (strlen($pwds) < 6 || strlen($pwdscheck) < 6 ) {
        echo ("<script>alert('Your password is less than 6 characters!');</script>");
        echo ("<script>window.location = window.location.href;</script>");
        return;
    }

    if ($pwds != $pwdscheck) {
        echo ("<script>alert('Password does not match!');</script>");
        echo ("<script>window.location = window.location.href;</script>");
        return;
    }

    if ($pwds == null || $pwdscheck== null || $cmpny== null || $usrnm== null || $email == null) {
        echo ("<script>alert('Input cannot be blank!');</script>");
        echo ("<script>window.location = window.location.href;</script>");
        return;
    }

    if($pwds == ''){
        echo("<script>alert('Your password cannot be blank');</script>");
        echo("<script>window.location = window.location.href;</script>");
        return;
    }
    
    $dbconn = getDBConn();
    // $email = $_POST['email'];
    $password = $_POST['pwd'];
    $username = $_POST['username'];
    $company_name = $_POST['companyname'];
    $hash = md5(rand(0, 1000));
    $product_id = $_POST['product_id'];

    // cek email
    $query = $dbconn->prepare("SELECT COUNT(*) as cnt FROM USER_ACCOUNT WHERE EMAIL_ACCOUNT = ?");
    $query->bind_param("s", $email);
    $query->execute();
    $itemUser = $query->get_result()->fetch_assoc();
    $cnt = $itemUser['cnt'];
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
    if (!$itemUser) exit('No rows');

    if ($cnt > 0) {
        $msg = 'Email has already registered!';
    } else {
        // captcha oke
        if ($response->success) {
            $_SESSION['email'] = $email;
            $_SESSION['hash'] = $hash;
            $_SESSION['companyname'] = $company_name;
            $_SESSION['username'] = $username;

            // insert company
            $query = $dbconn->prepare("INSERT INTO COMPANY (DOMAIN, STATUS) VALUES ('easysoft', 1)");
            $query->execute();
            $query->close();

            // select id comp
            $query = $dbconn->prepare("SELECT MAX(ID) AS NEW_ID FROM COMPANY");
            $query->execute();
            $itemUser2 = $query->get_result()->fetch_assoc();
            $company_id = $itemUser2['NEW_ID'];

            $query->close();

            $_SESSION['company_id'] = $company_id;

            //if untuk tombol trial
            if ($_POST['sign_up'] == "Proceed") {
                //insert id product to subscribe table
                $query = $dbconn->prepare("INSERT INTO SUBSCRIBE (COMPANY, PRODUCT, START_DATE, END_DATE, STATUS) VALUES (?, 4, NOW(), DATE_ADD(NOW(), INTERVAL 30 DAY), 3)");
                $query->bind_param("i", $company_id);
                $query->execute();
                $query->close();

                // insert to user account
                $query = $dbconn->prepare("INSERT INTO USER_ACCOUNT (COMPANY, USERNAME, EMAIL_ACCOUNT, PASSWORD, STATUS, HASH, ACTIVE) VALUES (?, ?, ?, MD5(?), 3, ?, 0);");
                $query->bind_param("issss", $company_id, $username, $email, $password, $hash);
                $query->execute();
                if (!$dbconn->commit()) {
                    echo "Commit insert user account gagal ";
                }
                $query->close();
            } else {
                //insert id product to subscribe table
                $query = $dbconn->prepare("INSERT INTO SUBSCRIBE (COMPANY, PRODUCT, START_DATE, END_DATE, STATUS) VALUES (?, ?, NOW(), DATE_ADD(NOW(), INTERVAL 30 DAY), 0)");
                $query->bind_param("ii", $company_id, $product_id);
                $query->execute();
                $query->close();

                // insert to user account
                $query = $dbconn->prepare("INSERT INTO USER_ACCOUNT (COMPANY, USERNAME, EMAIL_ACCOUNT, PASSWORD, STATUS, HASH, ACTIVE) VALUES (?, ?, ?, MD5(?), 0, ?, 0);");
                $query->bind_param("issss", $company_id, $username, $email, $password, $hash);
                $query->execute();
                if (!$dbconn->commit()) {
                    echo "Commit insert user account gagal ";
                }
                $query->close();
            }

            // insert company info
            $query = $dbconn->prepare("INSERT INTO COMPANY_INFO (COMPANY, COMPANY_NAME,CREATED_DATE) VALUES (?, ?, NOW());");
            $query->bind_param("is", $company_id, $company_name);
            $query->execute();
            if (!$dbconn->commit()) {
                echo "Commit insert company info gagal ";
            }
            $query->close();

            ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ // EMAIL ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
            $url = base_url();
            $email = strtolower($_POST['email']);
            $activation_link = "http://103.94.169.26:8081/verify.php?email=" . $email . "&company=" . $company_id . "&hash=" . $hash . "&page=" . $_GET['page'];
            $header = file_get_contents('Palio_Confirmation_Header.html');
            $body = file_get_contents('Palio_Confirmation_Body.html');
            $footer = file_get_contents('Palio_Confirmation_Footer.html');
            $content = $header . $username . $body . $activation_link . $footer;

            sendMail($content, $email);


            ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ // END EMAIL ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

            $page = $_GET['page'];
            redirect(base_url() . "verifyemail.php?page=" . $page);
        } else {
            $msg = 'Please Validate that you are human!';
        }
    }
    // end redirect
    // }

}

function sendMail($body, $destination)
{
    require $_SERVER['DOCUMENT_ROOT'] . '/PHPMailer/src/Exception.php';
    require $_SERVER['DOCUMENT_ROOT'] . '/PHPMailer/src/PHPMailer.php';
    require $_SERVER['DOCUMENT_ROOT'] . '/PHPMailer/src/SMTP.php';

    //$email=$_POST['email'];
    //$msg=$_POST['message'];


    $succMsg = "";
    $errMsg = "";

    if ($destination != "") {

        $mail = new PHPMailer();
        //$mail->SMTPDebug = 2;
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'support@palio.io';
        $mail->Password   = '12345easySoft67890';
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        //Recipients
        $mail->setFrom('support@palio.io', 'Palio');
        $mail->addAddress($destination);
        $mail->addReplyTo('support@palio.io');

        $mail->isHTML(true);
        $mail->Subject = 'Palio Email Confirmation';
        $mail->Body = $body;

        if (!$mail->send()) {
            $mail->ClearAllRecipients();
            $succMsg = $mail->ErrorInfo;
        } else {
            $mail->ClearAllRecipients();
            $succMsg = "Email has been sent successfully.";
        }
    } else {
        $errMsg = "Please fill all the form!";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Palio Sign Up</title>

    <!-- Font-Family CSS -->
    <!-- <link rel="stylesheet" href="https://db.onlinewebfonts.com/c/623c7118249e082fe87a78e08506cb4b?family=Segoe+UI">
    <link rel="stylesheet" href="https://db.onlinewebfonts.com/c/d4d6e1a6527a21185217393c427a52cb?family=Segoe+UI+Semibold"> -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/custom.css">
    <link rel="stylesheet" type="text/css" href="./css/api_web.css">

    <!-- POPPINS -->
    <link rel="stylesheet" href="./fonts/poppins/style.css">

    <!-- Main JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>

    <!-- Custom JS -->
    <script src="js/custom.js"></script>

    <!-- reCAPTCHA -->
    <script src='https://www.google.com/recaptcha/api.js'></script>

</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark fixed-top px-0" id="navtop-alt" style="transition: top 0.3s;">
        <div class="container" style="max-width: 90%">
            <a class="navbar-brand fs-30 text-white txt-decor-none" href="index.php">
                <img src="main_logo.png" id="logoImg">
            </a>
            <ul class="nav navbar-nav ml-auto text-center fontRobReg">
                <li class="nav-item mx-1">
                    <span class="navbar-text navbar-right fs-13 mt-1">Already have an account?</span>
                </li>
                <li class="nav-item mx-1">
                    <button onclick="pindah('login.php')" class="btn nav-menu-btn-wht-alt fs-16 py-1 px-3">Login</button>
                </li>
            </ul>
        </div>
    </nav>

    <div class="modal fade" id="myModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <label class="title-modal">Prompt</label>
                    <p class="text-modal fs-20"><?php if (!empty($msg)) {
                                                    echo $msg;
                                                } else {
                                                    echo "error";
                                                } ?></p>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row mt-5">
            <div class="mt-5 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-5 offset-lg-4 col-xl-4 offset-xl-4">
                <form method="POST">
                    <h3 class="text-left fontRobReg fc-70 fs-30 mt-4">
                        <!-- <strong>Subscribe</strong> -->
                        <strong>Sign Up</strong>
                    </h3>
                    <!-- username -->
                    <div class="input-group btn border-70 p-0 mt-4">
                        <input minlength="6" type="text" required class="form-control form-control fs-16 fontRobReg border-0" id="username" placeholder="Username" name="username" value="<?php if (isset($_POST['sign_up'])) {
                                                                                                                                                                                                echo ($_POST['username']);
                                                                                                                                                                                            } else {
                                                                                                                                                                                                echo ('');
                                                                                                                                                                                            } ?>">
                    </div>
                    <p class="text-danger fs-15 fontRobReg m-0 text-left" id="alertEmpty1" style="display: none;">Username is required.</p>

                    <!-- company name -->
                    <div class="input-group btn border-70 p-0 mt-4">
                        <input type="text" required class="form-control form-control fs-16 fontRobReg border-0" id="companyname" placeholder="Company Name" name="companyname" value="<?php if (isset($_POST['sign_up'])) {
                                                                                                                                                                                                                        echo ($_POST['companyname']);
                                                                                                                                                                                                                    } else {
                                                                                                                                                                                                                        echo ('');
                                                                                                                                                                                                                    } ?>">
                    </div>
                    <p class="text-danger fs-15 fontRobReg m-0 text-left" id="alertEmpty2" style="display: none;">Company name is required.</p>

                    <!-- email -->
                    <div class="input-group btn border-70 p-0 mt-4">
                        <input type="email" required class="form-control form-control fs-16 fontRobReg border-0" id="email" placeholder="Email" name="email" value="<?php if (isset($_POST['sign_up'])) {
                                                                                                                                                                                                        echo ($_POST['email']);
                                                                                                                                                                                                    } else {
                                                                                                                                                                                                        echo ('');
                                                                                                                                                                                                    } ?>">
                    </div>
                    <p class="text-danger fs-15 fontRobReg m-0 text-left" id="alertEmail" style="display: none;">Please use a valid email.</p>

                    <!-- password -->
                    <div class="input-group btn border-70 p-0 mt-4">
                        <input type="password" required class="form-control fs-16 fontRobReg border-0" id="passwordTF" placeholder="Password" name="pwd" minlength="6">
                        <div class="input-group-append">
                            <button type="button" class="btn py-0 px-3" onclick="showhide()">
                                <i class="fa fa-eye-slash fs-20" id="showhide"></i>
                            </button>
                        </div>
                        
                    </div>

                    <div class="input-group p-0 mt-4">
                        
                        <progress id="progress" value="0" max="100" style="width:100%;">70</progress>
                        <p class="fontRobReg">
                            Password strength: <span id="progresslabel" class="fontRobReg"></span>
                        </p>
                    </div>

                    <!-- confirm password -->
                    <div class="input-group btn border-70 p-0">
                        <input type="password" oninput="checkPasswordMatch(); doCheck();" required class="form-control fs-16 fontRobReg border-0" id="passwordTFconfirm" placeholder="Confirm Password" name="pwdcheck" minlength="6">
                       
                        
                    </div>
                    <p class="text-danger fs-15 fontRobReg m-0 mb-4 text-left" id="alertPasswordMatch" style="display: none;">Passwords do not match.</p>


                    

                    <!-- id product hidden -->
                    <input type="hidden" id="product_id" name="product_id" value="<?php echo $product; ?>">

                   
                    <div class="d-flex mt-4 justify-content-center">
                        <div class="g-recaptcha fontRobReg" data-callback="captchaResponse" data-sitekey="6LfwcuAUAAAAAH-LdFc1VWsjtCh3587QBskw5I44"></div>
                        
                    </div>
                    <input type="submit" id="submit_sign_up" class="btn nav-menu-btn-wht-alt py-1 px-3 w-100 m-0 my-4 fs-16" value="Proceed" name="sign_up" onclick="Process_form();">
                    
                </form>
                <div class="text-left fs-14 fontRobReg fc-70 mt-2">
                    By clicking the sign up button, you agree to our
                    <a class="text-decoration-none" href="termsofservice.php"> terms of service</a>,
                    <a class="text-decoration-none" href="privacypolicy.php"> privacy policy</a> and
                    <a class="text-decoration-none" href="usepolicy.php"> acceptable use policy</a>.
                </div>
            </div>
        </div>
    </div>

    <script>

    </script>

    <script type="text/javascript">

        var email = false;
        var company = false;
        var password123 = false;
        var username = false;
        var gResponse = false;

        $(document).ready(function() {
            $('#submit_sign_up').prop('disabled',true);
            $("#passwordTFconfirm").keyup(checkPasswordMatch);
            $('#passwordTF').keyup(function(){
                if($(this).val()) {
                    $('#passwordTFconfirm').val('');
                }
            });
        });

        $("input").on('change', doCheck);
        $("#username").on('input', checkEmptyUname);
        $("#companyname").on('input', checkEmptyCompany);
        $("#passwordTFconfirm").on('input', checkPasswordMatch);
        // $("#passwordTFconfirm").on('keydown', checkPasswordMatch);
        $("#email").on('input', checkEmail);


        function captchaResponse() {
            if(grecaptcha.getResponse().length !== 0){
                gResponse = true;   
            }
        }

        function doCheck(){
            if(email == true && company == true && password123 == true && username == true && pw_strength >= 50 && gResponse == true){
                $('#submit_sign_up').prop('disabled',false);
            } else {
                $('#submit_sign_up').prop('disabled',true);
            }
            // alert("horray");
        }

        function checkEmail() {

            var val = $('#email').val();

            var regExEmail = /^[A-Z0-9._-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;

            if (regExEmail.test(val)) {

                $('#alertEmail').css('display', 'none');
                email = true;
            } else {

                $('#alertEmail').css('display', 'block');
                email = false;
            }

        }

        function checkEmptyUname() {

            var val = $('#username').val();

            var regExEmptyUname = /\S+/i;

            if (regExEmptyUname.test(val)) {

                $('#alertEmpty1').css('display', 'none');
                username = true;

            } else {

                $('#alertEmpty1').css('display', 'block');
                username = false;
            }
        }

        function checkEmptyCompany() {

            var val = $('#companyname').val();

            var regExEmpty = /\S+/i;

            if (regExEmpty.test(val)) {

                $('#alertEmpty2').css('display', 'none');
                company = true;
            } else {

                $('#alertEmpty2').css('display', 'block');
                company = false;
            }
        }

        function checkPasswordMatch() {
            var password = $("#passwordTF").val();
            var confirmPassword = $("#passwordTFconfirm").val();

            if (password != confirmPassword) {
                $("#alertPasswordMatch").css('display', 'block');
                // $('#submit_sign_up').prop('disabled',true);
                password123 = false;
            } else {
                $("#alertPasswordMatch").css('display', 'none');
                // $('#submit_sign_up').prop('disabled',false);
                password123 = true;
            }
        }

        var pw_strength;
        var password = document.getElementById("passwordTF");
        password.addEventListener('keyup', function() {

            var pwd = password.value;

            // Reset if password length is zero
            if (pwd.length === 0) {
                document.getElementById("progresslabel").innerHTML = "";
                document.getElementById("progress").value = "0";
                return;
            }

            // Check progress
            var prog = [/[$@$!%*#?&]/, /[A-Z]/, /[0-9]/, /[a-z]/]
                .reduce((memo, test) => memo + test.test(pwd), 0);

            // Length must be at least 8 chars
            if(prog > 2 && pwd.length > 7){
                prog++;
            }

            // Display it
            var progress = "";
            var strength = "";
            switch (prog) {
                case 0:
                case 1:
                case 2:
                strength = "<span style='color: red;'>25% - Weak</span>";
                progress = "25";
                pw_strength = 25;
                break;
                case 3:
                strength = "50% - Medium";
                progress = "50";
                pw_strength = 50;
                break;
                case 4:
                strength = "75% - Medium";
                progress = "75";
                pw_strength = 75;
                break;
                case 5:
                strength = "100% - Strong";
                progress = "100";
                pw_strength = 100;
                break;
            }
            document.getElementById("progresslabel").innerHTML = strength;
            document.getElementById("progress").value = progress;
            console.log("strength: " + pw_strength);
        });
    </script>

    <?php if (!empty($msg)) : ?>
        <script type="text/javascript">
            $(document).ready(function() {
                $("#myModal").modal("show");
            });
        </script>
    <?php endif; ?>

</body>

</html>
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>