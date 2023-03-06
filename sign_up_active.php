<link rel="icon" type="image/x-icon" href="newAssets/fav.ico">
<?php include_once($_SERVER['DOCUMENT_ROOT'].'/url_function.php');?>
<?php include_once($_SERVER['DOCUMENT_ROOT'].'/db_conn.php');?>
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/header-alt.php'); ?>
<?php 
    session_start();
    // $productstring = $_POST['subscribe_type'];
    $productstring = 4;
    if(!$productstring){
        header("Location: /newpricing.php#js-range-slider");
    }
    $product = (int)$productstring;

    // $product = (int)$productstring;
    // $productstring = "<script>document.write(localStorage.getItem('subscribe_type'));</script>";
    // $product = intval(preg_replace('/[^0-9]+/', '', $productstring)); 
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    if(isset($_POST['sign_up'])){
        
        $dbconn = getDBConn();
        $email = $_POST['email'];
        $password = $_POST['pwd'];
        $username = $_POST['username'];
        $company_name = $_POST['companyname'];
        $hash = md5(rand(0, 1000));
        $product_id = $_POST['product_id'];

            // cek email
        $query= $dbconn->prepare("SELECT COUNT(*) as cnt FROM USER_ACCOUNT WHERE EMAIL_ACCOUNT = ?");
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
        $verify = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret_key.'&response='.$_POST['g-recaptcha-response']);
        $response = json_decode($verify);
            // end captcha

        // redirect ke page name
        if(!$itemUser) exit('No rows');
        
        if($cnt > 0) {
            $msg = 'Email has already registered!';
        } else {
            // captcha oke
        if($response->success){
                $_SESSION['email'] = $email;
                $_SESSION['hash'] = $hash;
                $_SESSION['companyname'] = $company_name;

                // insert company
                $query = $dbconn->prepare("INSERT INTO COMPANY (DOMAIN, STATUS) VALUES ('easysoft', 1)");
                $query->execute();
                $query->close();

                // select id comp
                $query= $dbconn->prepare("SELECT MAX(ID) AS NEW_ID FROM COMPANY");
                $query->execute();
                $itemUser2 = $query->get_result()->fetch_assoc();
                $company_id = $itemUser2['NEW_ID'];
                
                $query->close();
                
                $_SESSION['company_id'] = $company_id;

                //if untuk tombol trial
                if($_POST['sign_up'] == "Proceed"){
                    //insert id product to subscribe table
                    $query = $dbconn->prepare("INSERT INTO SUBSCRIBE (COMPANY, PRODUCT, START_DATE, END_DATE, STATUS) VALUES (?, 4, NOW(), DATE_ADD(NOW(), INTERVAL 30 DAY), 3)");
                    $query->bind_param("i", $company_id);
                    $query->execute();
                    $query->close();

                    // insert to user account
                    $query = $dbconn->prepare("INSERT INTO USER_ACCOUNT (COMPANY, USERNAME, EMAIL_ACCOUNT, PASSWORD, STATUS, HASH, ACTIVE) VALUES (?, ?, ?, MD5(?), 3, ?, 0);");
                    $query->bind_param("issss", $company_id, $username, $email, $password, $hash);
                    $query->execute();
                    if(!$dbconn->commit()){
                        echo "Commit insert user account gagal ";
                    }
                    $query->close();

                }else{
                    //insert id product to subscribe table
                    $query = $dbconn->prepare("INSERT INTO SUBSCRIBE (COMPANY, PRODUCT, START_DATE, END_DATE, STATUS) VALUES (?, ?, NOW(), DATE_ADD(NOW(), INTERVAL 30 DAY), 0)");
                    $query->bind_param("ii", $company_id, $product_id);
                    $query->execute();
                    $query->close();

                    // insert to user account
                    $query = $dbconn->prepare("INSERT INTO USER_ACCOUNT (COMPANY, USERNAME, EMAIL_ACCOUNT, PASSWORD, STATUS, HASH, ACTIVE) VALUES (?, ?, ?, MD5(?), 0, ?, 0);");
                    $query->bind_param("issss", $company_id, $username, $email, $password, $hash);
                    $query->execute();
                    if(!$dbconn->commit()){
                        echo "Commit insert user account gagal ";
                    }
                    $query->close();
                    
                }

                // insert company info
                $query = $dbconn->prepare("INSERT INTO COMPANY_INFO (COMPANY, COMPANY_NAME,CREATED_DATE) VALUES (?, ?, NOW());");
                $query->bind_param("is", $company_id, $company_name);
                $query->execute();
                if(!$dbconn->commit()){
                    echo "Commit insert company info gagal ";
                }
                $query->close();

                //     ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ // EMAIL ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                // $url = base_url();
                $email = strtolower($_POST['email']);
                // require $_SERVER['DOCUMENT_ROOT'].'/PHPMailer/src/Exception.php';
                // require $_SERVER['DOCUMENT_ROOT'].'/PHPMailer/src/PHPMailer.php';
                // require $_SERVER['DOCUMENT_ROOT'].'/PHPMailer/src/SMTP.php';
        
                // $mail = new PHPMailer();
                // $mail->isSMTP();        
                // $mail->Host       = 'smtp.gmail.com';  
                // $mail->SMTPAuth   = true;                             
                // $mail->Username   = 'support@palio.io';                
                // $mail->Password   = '2020easySoft';
                // $mail->SMTPSecure = 'tls';         
                // $mail->Port       = 587;                     
        
                // //Recipients
                // $mail->setFrom('support@palio.io', 'Palio');
                // $mail->addAddress($email);
                // $mail->addReplyTo('support@palio.io');
        
                // $mail->isHTML(true);
                // $mail->Subject = 'Email Verification Submission';
                // /*$mail->Body = 'Thanks for signing up! <br> Your account has been created, you can login after you have activated your account by pressing the url below.
                // <br>
        
                // Please click this link to activate your account: <br>
                // <a href="'. $url .'verify.php?email='.$email.'&company='.$company_id.'&hash='.$hash.'&page='.$_GET['page'].'"> Activate Account </a> <br>
                // <br>
                // Or, using your email and password : <br>
                // email : '.$email. ' <br>
                // password : '.$password.' <br>
                // ';*/
				
				// $mail->Body = 'Thanks for signing up! <br> Your account has been created, you can login after you have activated your account by pressing the url below.
                // <br>
        
                // Please click this link to activate your account: <br>
                // <a href="http://103.94.169.26:8081/verify.php?email='.$email.'&company='.$company_id.'&hash='.$hash.'&page='.$_GET['page'].'"> Activate Account </a> <br>
                // <br>
                // Or, using your email and password : <br>
                // email : '.$email. ' <br>
                // password : '.$password.' <br>
                // ';
				
                // if(!$mail->send()){
                //     $succMsg = "";
                //     $mail->ClearAllRecipients();
                //     $msg = 'Error : '.$mail->ErrorInfo;
                // } else {
                //     $mail->ClearAllRecipients();
                //     $sent = true;
                // }
                //     ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ // END EMAIL ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

                // redirect(base_url()."verifyemail.php"); 
                redirect("http://103.94.169.26:8081/verify.php?email=".$email."&company=".$company_id."&hash=".$hash."&page=".$_GET['page']);
                    
        } else {
                $msg = 'Please Validate that you are human!';
        }

        }
        // end redirect

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

    <nav class="navbar navbar-expand-md fixed-top background px-0 py-1 fc-70" id="navtop-alt" style="transition: top 0.3s; height: auto !important; border-radius: unset !important; box-shadow: unset !important;">
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
                    <p class="text-modal fs-20"><?php if(!empty($msg)){echo $msg;}else{echo "error";} ?></p>
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
                        <input type="text" required class="form-control form-control fs-16 fontRobReg border-0" id="username" placeholder="Username" name="username" value="<?php if(isset($_POST['sign_up'])){echo($_POST['username']);}else{echo('');} ?>">
                    </div>
                    <p class="text-danger fs-15 fontRobReg m-0 text-left" id="alertEmpty1" style="display: none;">Username is required.</p>

                    <!-- company name -->
                    <div class="input-group btn border-70 p-0 mt-4">
                        <input type="text" required class="form-control form-control fs-16 fontRobReg border-0" id="companyname" placeholder="Company Name" name="companyname" onclick="checkEmptyUname();" value="<?php if(isset($_POST['sign_up'])){echo($_POST['companyname']);}else{echo('');} ?>">
                    </div>
                    <p class="text-danger fs-15 fontRobReg m-0 text-left" id="alertEmpty2" style="display: none;">Company name is required.</p>

                    <!-- email -->
                    <div class="input-group btn border-70 p-0 mt-4">
                        <input type="email" required class="form-control form-control fs-16 fontRobReg border-0" id="email" placeholder="Email" name="email" onclick="checkEmptyCompany();" value="<?php if(isset($_POST['sign_up'])){echo($_POST['email']);}else{echo('');} ?>">
                    </div>
                    <p class="text-danger fs-15 fontRobReg m-0 text-left" id="alertEmail" style="display: none;">Please use a valid email.</p>
                    
                    <!-- password -->
                    <div class="input-group btn border-70 p-0 my-4">
                    	<input type="password" required class="form-control fs-16 fontRobReg border-0" id="passwordTF" placeholder="Password" name="pwd" onclick="checkEmail();" minlength="6">
                    	<div class="input-group-append">
	                        <button type="button" class="btn py-0 px-3" onclick="showhide()">
	                        	<i class="fa fa-eye-slash fs-20" id="showhide"></i>
	                        </button>
	                    </div>
                    </div>
                    
                    <!-- company domain -->
                    <!-- <div class="input-group btn border-70 p-0 mt-4">
                        <input type="text" required class="form-control form-control fs-16 fontRobReg border-0" id="companydomain" placeholder="Company Domain" name="companydomain" value="<?php if(isset($_POST['sign_up'])){echo($_POST['companydomain']);}else{echo('');} ?>">
                    </div> -->
                    <!-- phone -->
                    <!-- <div class="input-group btn border-70 p-0 mt-4">
                        <input type="text" required class="form-control form-control fs-16 fontRobReg border-0" id="phonenumber" placeholder="Phone Number" name="phonenumber" value="<?php if(isset($_POST['sign_up'])){echo($_POST['phonenumber']);}else{echo('');} ?>">
                    </div>
                    <p class="text-danger fs-15 fontRobReg m-0 text-left" id="alertPhone" style="display: none;">Please use a valid phone number.</p> -->

                    
                    <!-- product interest -->
                    <!-- <div class="input-group btn border-70 p-0 mt-4">
                        <input type="text" required class="form-control form-control fs-16 fontRobReg border-0" id="productinterest" placeholder="Product Interest" name="productinterest" onclick="checkEmptyCompany();" value="<?php if(isset($_POST['sign_up'])){echo($_POST['productinterest']);}else{echo('');} ?>">
                    </div>
                    <p class="text-danger fs-15 fontRobReg m-0 text-left" id="alertEmpty3" style="display: none;">Product interest is required.</p> -->

                    <!-- id product hidden -->
                    <input type="hidden" id="product_id" name="product_id" value="<?php echo $product; ?>">
                    
                    <!-- development type -->
                    <!-- <div class="input-group btn border-70 p-0 mt-4">
                        <input type="text" required class="form-control form-control fs-16 fontRobReg border-0" id="developmenttype" placeholder="Development Type" name="developmenttype" onclick="checkEmptyProduct();" value="<?php if(isset($_POST['sign_up'])){echo($_POST['developmenttype']);}else{echo('');} ?>">
                    </div>
                    <p class="text-danger fs-15 fontRobReg m-0 text-left" id="alertEmpty4" style="display: none;">Development type is required.</p> -->

                    <!-- industry type -->
                    <!-- <div class="input-group btn border-70 p-0 mt-4">
                        <input type="text" required class="form-control form-control fs-16 fontRobReg border-0" id="industrytype" placeholder="Industry" onclick="checkEmptyDev();" name="industrytype">
                    </div>
                    <p class="text-danger fs-15 fontRobReg m-0 text-left" id="alertEmpty5" style="display: none;">Industry type is required.</p>
                    <br/> -->
                    <!-- captcha -->
                    <div class="d-flex justify-content-center">
                        <div class="g-recaptcha fontRobReg" data-sitekey="6LfwcuAUAAAAAH-LdFc1VWsjtCh3587QBskw5I44"></div>
                        <!-- <input type="text" class="w-50 p-2 btn text-left my-auto fs-20 border-70 ff-segoe-ui" id="captcha" name="captcha" placeholder="Captcha">
                        <div id="captcha_image" class="mx-3 mt-2"></div>
                    <input type="hidden" id="cpc" name="cpc">
                        <button type="button" onclick="createCaptcha()" class="btn fs-25 mb-1 p-2">
                            <span class="fa fa-refresh"></span>
                        </button> -->
                    </div>
                    <input type="submit" class="btn nav-menu-btn-wht-alt py-1 px-3 w-100 m-0 my-4 fs-16" value="Proceed" name="sign_up">
                    <!-- <input type="submit" class="btn nav-menu-btn-wht-alt py-1 px-3 w-100 m-0 my-4 fs-16" value="Subscribe" name="sign_up"> -->
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

    <script type="text/javascript">

        function checkEmail(){

            var val = $('#email').val();

            var regExEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;

            if (regExEmail.test(val)) {

                $('#alertEmail').css('display', 'none');

            }else{

                $('#alertEmail').css('display', 'block');

            }

        }

        function checkEmptyUname(){

            var val = $('#username').val();

            var regExEmptyUname = /\S+/i;

            if (regExEmptyUname.test(val)) {

                $('#alertEmpty1').css('display', 'none');

            }else{

                $('#alertEmpty1').css('display', 'block');

            }
        }

        function checkEmptyCompany(){

            var val = $('#companyname').val();

            var regExEmpty = /\S+/i;

            if (regExEmpty.test(val)) {

                $('#alertEmpty2').css('display', 'none');

            }else{

                $('#alertEmpty2').css('display', 'block');

            }
        }                   

        
    </script>

<?php if(!empty($msg)): ?>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#myModal").modal("show");
        });
    </script>
<?php endif; ?>

</body>
</html>
<script>
    if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
    }
</script>