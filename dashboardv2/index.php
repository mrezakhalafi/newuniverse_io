<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/dashboardv2/dashboard_header.php'); ?>
<?php

date_default_timezone_set('Asia/Bangkok');

// state control
$_SESSION['previous_page'] = $_SESSION['current_page'];
$_SESSION['current_page'] = 14;
require_once($_SERVER['DOCUMENT_ROOT'] . '/state_control.php');

$version = 'v=1.71';



$dbConnPalioLite = dbConnPalioLite();

$queryVB = $dbconn->prepare("SELECT * FROM VERSION_BE WHERE ID = '1'");
$queryVB->execute();
$dataVB = $queryVB->get_result()->fetch_assoc();
$queryVB->close();

// print_r($dataVB);

unset($_SESSION['bill']);

$company_id = getSession('id_company');
$user_id = getSession('id_user');

$query = $dbconn->prepare("SELECT * FROM BILLING WHERE COMPANY = ? order by DUE_DATE desc limit 1");
$query->bind_param("i", $company_id);
$query->execute();
$bill2 = $query->get_result()->fetch_assoc();
$bill_start_date = $bill2['BILL_DATE'];
$due_date = $bill2["DUE_DATE"];
$currency = $bill2['CURRENCY'];
$_SESSION['charge'] = $bill2['CHARGE'];
$query->close();

//company info product interest
$query = $dbconn->prepare("SELECT * FROM COMPANY_INFO WHERE COMPANY = ? order by CREATED_DATE desc limit 1");
$query->bind_param("i", $company_id);
$query->execute();
$info = $query->get_result()->fetch_assoc();
$interest = $info["PRODUCT_INTEREST"];
$each_service = explode(',', $interest);
$query->close();

// USER CREDIT
$query = $dbconn->prepare("SELECT * FROM CREDIT WHERE USER_ID = ?");
$query->bind_param("i", $_SESSION['id_user']);
$query->execute();
$credit = $query->get_result()->fetch_assoc();
$query->close();


//check due date
// $today = date("Y-m-d H:i:s");
// include '../new_billing.php';
// if ($today > $due_date || $bill2['IS_PAID'] == 0) {
//     newBilling();
// }



//um
$query = $dbconn->prepare("SELECT * FROM COMP_FEATURE WHERE COMPANY_ID = ?");
$query->bind_param("i", $company_id);
$query->execute();
$enabled = $query->get_result();
$query->close();

if ($enabled) {
    foreach ($enabled as $en) {
        if ($en['TYPE'] == 1) {
            $um_enabled = $en['VALUE'];
        } else if ($en['TYPE'] == 2) {
            $voip_enabled = $en['VALUE'];
        } else if ($en['TYPE'] == 3) {
            $ls_enabled = $en['VALUE'];
        } else if ($en['TYPE'] == 4) {
            $web_enabled = $en['VALUE'];
        } else if ($en['TYPE'] == 5) {
            $im_enabled = $en['VALUE'];
        } else if ($en['TYPE'] == 6) {
            $email_enabled = $en['VALUE'];
        } else if ($en['TYPE'] == 7) {
            $sms_enabled = $en['VALUE'];
        }
    }
}

function rupiah($angka)
{

    $hasil_rupiah = number_format($angka, 2, ',', '.');
    return $hasil_rupiah;
}

$query = $dbconn->prepare("SELECT us.COMPANY_ID, SUM(TEXT_RECIPIENT) AS TEXT, SUM(IMG_RECIPIENT) AS DOC, SUM(VIDEO_RECIPIENT) AS VIDEO, SUM(LS_MINUTES) AS LS, SUM(VOIP_MINUTES) AS VOIP, SUM(VC_MINUTES) AS VIDCALL, b.BILL_DATE, b.DUE_DATE, b.CUT_OFF_DATE
FROM USAGE_SUMMARY us, BILLING b 
WHERE us.COMPANY_ID = ? AND b.IS_PAID = 1 AND b.COMPANY = us.COMPANY_ID AND (us.CREATED_AT BETWEEN DATE(b.BILL_DATE) AND DATE(b.CUT_OFF_DATE))
AND (CURDATE() BETWEEN DATE(b.BILL_DATE) AND DATE(b.CUT_OFF_DATE))");
$query->bind_param("i", $_SESSION['id_company']);
$query->execute();
$usage_data = $query->get_result()->fetch_assoc();
$query->close();

//TOTAL UNPAID BILL
$query = $dbconn->prepare("SELECT SUM(CHARGE) AS TOTAL FROM BILLING WHERE COMPANY = ? AND IS_PAID = 0");
$query->bind_param("i", $company_id);
$query->execute();
$total_bill = $query->get_result()->fetch_assoc(); //GET COLUMNS
$query->close();

$query = $dbconn->prepare("SELECT * FROM USER_ACCOUNT WHERE ID = ?");
$query->bind_param("i", $user_id);
$query->execute();
$userID = $query->get_result()->fetch_assoc();
$query->close();

//update company logo
if (isset($_POST['changeCompanyLogo'])) {

    // print_r($_FILES);

    $logo_filename = $_FILES['company-logo']['name'];

    try {

        $targetbase64 = '';

        if (isset($_FILES['company-logo']) && $_FILES['company-logo']['name'] != '') {
            $check = getimagesize($_FILES["company-logo"]["tmp_name"]);
            if ($check !== false) {
                $default_name = $_FILES["company-logo"]["name"];
                $file_ext = strtolower(pathinfo($default_name, PATHINFO_EXTENSION));
                $name = $id_company . '_' . strval(time()) . '.' . $file_ext;
                $target_dir = getcwd() . '/uploads/logo/';
                // $target_file = $target_dir . $_FILES["company-logo"]["name"];
                $target_file = $target_dir . $name;
                // $targetbase64 = $target_file;

                // Select file type
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                // Valid file extensions
                $extensions_arr = array("jpg", "jpeg", "png", "gif", "webp");

                // Check extension
                if (in_array($imageFileType, $extensions_arr)) {
                    // Upload file
                    move_uploaded_file($_FILES['company-logo']['tmp_name'], $target_dir . $name);
                }
            }


            //   update logo path
            $queryUpdateCompanyLogo = $dbconn->prepare("UPDATE COMPANY_INFO SET COMPANY_LOGO = ? WHERE COMPANY = ?");
            $queryUpdateCompanyLogo->bind_param("si", $name, $id_company);
            $queryUpdateCompanyLogo->execute();
            $queryUpdateCompanyLogo->close();

            // copy to pmall
            // $hexFileName = bin2hex($logo_filename);
            // $hexNameFull = substr($hexFileName, 0, 15) . '.' . $imageFileType;

            // copy($target_file, $_SERVER["DOCUMENT_ROOT"] . '/qiosk_web/images/' . $hexNameFull);
            // $connection = ssh2_connect('192.168.1.100', 2309);
            // $ssh_local_file = '/var/www/html/qmera/dashboardv2/assets/uploads/logo/' . $_FILES["company-logo"]["name"];
            // ssh2_auth_password($connection, 'easysoft', '5z2mQ6r+$74LJXa*');
            // ssh2_scp_send($connection, $ssh_local_file, '/var/www/html/palio.io/qiosk_web/images/' . $from . '-' . $hex . '.' . $fileType, 0777);

            // update shop logo
            $updateShopName = $dbConnPalioLite->prepare("UPDATE SHOP s SET s.THUMB_ID = ? WHERE s.PALIO_ID = ?");
            $updateShopName->bind_param("si", $hexNameFull, $id_company);
            $updateShopName->execute();
            $updateShopName->close();

            // get image path string
            $fname = $target_file;

            // quality
            $per = 0.6;

            // get extension type
            $type = pathinfo($fname, PATHINFO_EXTENSION);

            //Generate new size parameters
            list($width, $height) = getimagesize($fname);
            $new_w = $width * $per;
            $new_h = $height * $per;

            // Load image
            $output = imagecreatetruecolor($new_w, $new_h);

            // handle transparency
            imagealphablending($output, false);
            imagesavealpha($output, true);
            $transparent = imagecolorallocatealpha($output, 255, 255, 255, 127);
            imagefilledrectangle($output, 0, 0, $new_w, $new_h, $transparent);

            // create image resource
            if ($type == 'jpg' || $type == 'jpeg') {
                $source = imagecreatefromjpeg($fname);
            } else if ($type == 'png') {
                $source = imagecreatefrompng($fname);
            } else if ($type == 'gif') {
                $source = imagecreatefromgif($fname);
            }

            // Resize the source image to new size
            imagecopyresampled($output, $source, 0, 0, 0, 0, $new_w, $new_h, $width, $height);

            // get base64 from image resource
            if ($type == 'jpg' || $type == 'jpeg') {
                ob_start();
                imagejpeg($output);
                $contents = base64_encode(ob_get_clean());
            } else if ($type == 'png') {
                ob_start();
                imagepng($output);
                $contents = base64_encode(ob_get_clean());
            } else if ($type == 'gif') {
                ob_start();
                imagegif($output);
                $contents = base64_encode(ob_get_clean());
            }

            // echo "<script>
            // console.log('" . $contents . "');
            // </script>";

            // insert company logo to nusdk server
            $company_id = $id_company;
            $api_url = "http://192.168.1.100:8004/webrest/";
            $api_data = array(
                'code' => 'UPLLG',
                'data' => array(
                    'company_id' => $company_id,
                    'filename' => $name,
                    'data' => $contents,
                ),
            );

            $api_options = array(
                'http' => array(
                    'header'  => "Content-type: application/json\r\n",
                    'method'  => 'POST',
                    'content' => strval(json_encode($api_data))
                )
            );

            $api_stream = stream_context_create($api_options);
            $api_result = file_get_contents($api_url, false, $api_stream);
            $api_json_result = json_decode($api_result);

            if (http_response_code() != 200) {
                throw new Exception('Company logo update failed, please try again!');
            }
        }
    } catch (Exception $ex) {
        echo "<script language='javascript'>";
        echo "alert('" . $ex->getMessage() . "');";
        echo "window.location.href='index.php';";
        echo "</script>";
    }

    if (!isset($ex)) {
        echo "<script>";
        echo "window.location.href='index.php';";
        echo "</script>";
    }
}

//update company name
if (isset($_POST['changeCompanyName'])) {

    echo ('<script>');
    echo ('if (localStorage.lang == 0) {');
    echo ('alert("Company Name has been changed.")');
    echo ('}else{');
    echo ('alert("Nama Perusahaan telah diganti.")');
    echo ('}');
    echo ('</script>');

    $company_name = $_POST['inputCompanyName'];

    if ($company_name != trim($company_name)) {
        echo "<script>alert('Company Name is Invalid. Try another one.');</script>";
    }
    // else if (strpos($company_name, ' ')) {
    //     echo "<script>alert('Company Name is Invalid. Try another one.');</script>";
    // }
    else {
        try {

            if (isset($_POST['inputCompanyName']) && $_POST['inputCompanyName'] != '') {
                // update user info
                $queryUpdateInfo = $dbconn->prepare("UPDATE COMPANY_INFO SET COMPANY_NAME = ? WHERE COMPANY = ?");
                $queryUpdateInfo->bind_param("si", $company_name,  $id_company);
                $queryUpdateInfo->execute();
                $queryUpdateInfo->close();

                // $shopPalioId = strval($id_company);
                // update shop name
                $updateShopName = $dbConnPalioLite->prepare("UPDATE SHOP s SET s.NAME = ? WHERE s.PALIO_ID = ?");
                $updateShopName->bind_param("ss", $company_name, $id_company);
                $updateShopName->execute();
                $updateShopName->close();

                $company_id = $id_company;
                $api_url = "http://192.168.1.100:8004/webrest/";
                $api_data = array(
                    'code' => 'UPTNM',
                    'data' => array(
                        'company_id' => $company_id,
                        'name' => $company_name
                    ),

                );

                $api_options = array(
                    'http' => array(
                        'header'  => "Content-type: application/json\r\n",
                        'method'  => 'POST',
                        'content' => strval(json_encode($api_data))
                    )
                );

                $api_stream = stream_context_create($api_options);
                $api_result = file_get_contents($api_url, false, $api_stream);
                $api_json_result = json_decode($api_result);

                if (http_response_code() != 200) {
                    throw new Exception('Password update failed, please try again!');
                }
            }
        } catch (Exception $ex) {
            echo "<script language='javascript'>";
            echo "alert('" . $ex->getMessage() . "');";
            echo "window.location.href='index.php';";
            echo "</script>";
        }
    }

    if (!isset($ex)) {
        echo "<script>";
        echo "window.location.href='index.php';";
        echo "</script>";
    }
}

//update user name
if (isset($_POST['changeUserName'])) {


    echo ('<script>');
    echo ('if (localStorage.lang == 0) {');
    echo ('alert("User Name has been changed.")');
    echo ('}else{');
    echo ('alert("Nama Pengguna telah diganti.")');
    echo ('}');
    echo ('</script>');

    $newUser = $_POST['inputUserName'];

    if ($newUser != trim($newUser)) {
        echo "<script>alert('Username Invalid. Try another one.');</script>";
    }
    // else if (strpos($newUser, ' ')) {
    //     echo "<script>alert('Username Invalid. Try another one.');</script>";
    // }
    else {
        try {

            if ($newUser != '') {
                $queryUpdateCompany = $dbconn->prepare("UPDATE USER_ACCOUNT SET USERNAME = ? WHERE ID = ?");
                $queryUpdateCompany->bind_param("si", $newUser, getSession('id_user'));
                $queryUpdateCompany->execute();
                $queryUpdateCompany->close();
            }
        } catch (Exception $ex) {
            echo "<script language='javascript'>";
            echo "alert('" . $ex->getMessage() . "');";
            echo "window.location.href='index.php';";
            echo "</script>";
        }
    }

    if (!isset($ex)) {
        echo "<script>";
        echo "window.location.href='index.php';";
        echo "</script>";
    }
}

// update adm pass
if (isset($_POST['changeAdmPass'])) {

    echo ('<script>');
    echo ('if (localStorage.lang == 0) {');
    echo ('alert("Admin Password has been changed.")');
    echo ('}else{');
    echo ('alert("Kata sandi Admin telah diganti.")');
    echo ('}');
    echo ('</script>');

    $adminPass = $_POST['adminPass'];

    if ($adminPass != trim($adminPass)) {
        echo "<script> if (localStorage.lang == 0) {";
        echo "alert('Admin Password Invalid. Try another one.');";
        echo "}";
        echo "else {";
        echo "alert('Kata Sandi Admin Tidak sah. Coba kata sandi lain.');";
        echo "} </script>";
    } else if (strpos($adminPass, ' ')) {
        echo "<script> if (localStorage.lang == 0) {";
        echo "alert('Admin Password Invalid. Try another one.');";
        echo "}";
        echo "else {";
        echo "alert('Kata Sandi Admin Tidak sah. Coba kata sandi lain.');";
        echo "} </script>";
    } else {
        try {

            if ($adminPass != '') {

                //update user email
                $queryUpdateCompany = $dbconn->prepare("UPDATE USER_ACCOUNT SET PASSWORD = ? WHERE ID = ?");
                $queryUpdateCompany->bind_param("si", MD5($adminPass), getSession('id_user'));
                $queryUpdateCompany->execute();
                $queryUpdateCompany->close();

                // setSession('password', MD5($adminPass));
                // setSession('password_show', $adminPass);

                // insert priv key to nusdk server
                $company_id = $id_company;
                $api_url = "http://192.168.1.100:8004/webrest/";
                $api_data = array(
                    'code' => 'ADMPASS',
                    'data' => array(
                        'private_key' => md5($adminPass),
                        'company_id' => $company_id,
                    ),

                );

                $api_options = array(
                    'http' => array(
                        'header'  => "Content-type: application/json\r\n",
                        'method'  => 'POST',
                        'content' => strval(json_encode($api_data))
                    )
                );

                $api_stream = stream_context_create($api_options);
                $api_result = file_get_contents($api_url, false, $api_stream);
                $api_json_result = json_decode($api_result);

                if (http_response_code() != 200) {
                    throw new Exception('Password update failed, please try again!');
                } else {
                    setSession('password', MD5($adminPass));
                    setSession('password_show', $adminPass);
                }
            }
        } catch (Exception $ex) {
            echo "<script language='javascript'>";
            echo "alert('" . $ex->getMessage() . "');";
            echo "window.location.href='index.php';";
            echo "</script>";
        }
    }

    if (!isset($ex)) {
        echo "<script>";
        echo "window.location.href='index.php';";
        echo "</script>";
    }
}

// update internal pass
if (isset($_POST['changeIntPass'])) {

    echo ('<script>');
    echo ('if (localStorage.lang == 0) {');
    echo ('alert("Internal Password has been changed.")');
    echo ('}else{');
    echo ('alert("Kata sandi Internal telah diganti.")');
    echo ('}');
    echo ('</script>');

    $new_password_priv = $_POST['inputPass_priv'];

    if ($new_password_priv != trim($new_password_priv)) {
        echo "<script> if (localStorage.lang == 0) {";
        echo "alert('Internal Password Invalid. Try another one.');";
        echo "}";
        echo "else {";
        echo "alert('Kata Sandi Intern Tidak sah. Coba kata sandi lain.');";
        echo "} </script>";
    } else if (strpos($new_password_priv, ' ')) {
        echo "<script> if (localStorage.lang == 0) {";
        echo "alert('Internal Password Invalid. Try another one.');";
        echo "}";
        echo "else {";
        echo "alert('Kata Sandi Intern Tidak sah. Coba kata sandi lain.');";
        echo "} </script>";
    } else {
        try {

            if ($new_password_priv != '') {

                //update user email
                $queryUpdateCompany = $dbconn->prepare("UPDATE COMPANY_INFO SET PRIVATE_PASSWORD = ? WHERE COMPANY = ?");
                $queryUpdateCompany->bind_param("si", $new_password_priv, $id_company);
                $queryUpdateCompany->execute();
                $queryUpdateCompany->close();

                // insert priv key to nusdk server
                $company_id = $id_company;
                $api_url = "http://192.168.1.100:8004/webrest/";
                $api_data = array(
                    'code' => 'INTPASS',
                    'data' => array(
                        'company_id' => $company_id,
                        'private_key' => md5($new_password_priv),
                    ),

                );

                $api_options = array(
                    'http' => array(
                        'header'  => "Content-type: application/json\r\n",
                        'method'  => 'POST',
                        'content' => strval(json_encode($api_data))
                    )
                );

                $api_stream = stream_context_create($api_options);
                $api_result = file_get_contents($api_url, false, $api_stream);
                $api_json_result = json_decode($api_result);

                if (http_response_code() != 200) {
                    throw new Exception('Internal password update failed, please try again!');
                }
            }
        } catch (Exception $ex) {
            echo "<script language='javascript'>";
            echo "alert('" . $ex->getMessage() . "');";
            echo "window.location.href='index.php';";
            echo "</script>";
        }
    }

    if (!isset($ex)) {
        echo "<script>";
        echo "window.location.href='index.php';";
        echo "</script>";
    }
}

// update support email
if (isset($_POST['changeSuppEmail'])) {

    $new_supp_email = $_POST['new_supp_email'];

    try {

        if ($new_supp_email != '') {

            if ($new_supp_email == $itemUser['EMAIL_ACCOUNT']) {
                echo "<script language='javascript'>";
                echo " if (localStorage.lang == 1){
                    alert('Email Bantuan tidak bisa sama dengan email anda.');
                }else{
                    alert('Email support cannot be same like your account email.');
                }";
                echo "window.location.href='index.php';";
                echo "</script>";
            } else {

                $queryUpdateInfo = $dbconn->prepare("UPDATE COMPANY_INFO SET SUPPORT_EMAIL = ? WHERE COMPANY = ?");
                $queryUpdateInfo->bind_param("si", $new_supp_email,  $id_company);
                $queryUpdateInfo->execute();
                $queryUpdateInfo->close();

                // insert priv key to nusdk server
                $company_id = $id_company;
                $api_url = "http://192.168.1.100:8004/webrest/";
                $api_data = array(
                    'code' => 'EMLSUP',
                    'data' => array(
                        'company_id' => $company_id,
                        'email' => $new_supp_email,
                    ),

                );

                $api_options = array(
                    'http' => array(
                        'header'  => "Content-type: application/json\r\n",
                        'method'  => 'POST',
                        'content' => strval(json_encode($api_data))
                    )
                );

                $api_stream = stream_context_create($api_options);
                $api_result = file_get_contents($api_url, false, $api_stream);
                $api_json_result = json_decode($api_result);

                echo ('<script>
                if (localStorage.lang == 1){
                    alert("Akun Email untuk Bantuan berhasil diganti.");
                }else{
                    alert("Email Account for Support has been changed.");
                }
                </script>');

                if (http_response_code() != 200) {
                    throw new Exception('Support email update failed, please try again!');
                }
            }
        }
    } catch (Exception $ex) {
        echo "<script language='javascript'>";
        echo "alert('" . $ex->getMessage() . "');";
        echo "window.location.href='index.php';";
        echo "</script>";
    }

    if (!isset($ex)) {
        echo "<script>";
        echo "window.location.href='index.php';";
        echo "</script>";
    }
}

if (isset($_POST['feature_update'])) {

    echo ('<script>alert("Feature Update has been changed.")</script>');

    $company_id = $id_company;


    $vcall = (int) $_POST['voip-vcall'];
    $livestream = (int) $_POST['ls-os'];
    $web_access = (int) $_POST['web-access'];
    $messaging = (int) $_POST['im_check'];
    $email_check = (int) $_POST['email_check'];
    $sms = (int) $_POST['sms_check'];

    $complete = true;

    try {

        //VCALL
        $api_url = "http://192.168.1.100:8004/webrest/";
        $api_data = array(
            'code' => 'FTRACC',
            'data' => array(

                'company_id' => $company_id,
                'user_type' => 0,
                'type' => '2',
                'value' => $vcall,
            ),
        );

        $api_options = array(
            'http' => array(
                'header'  => "Content-type: application/json\r\n",
                'method'  => 'POST',
                'content' => strval(json_encode($api_data))
            )
        );

        $api_stream = stream_context_create($api_options);
        $api_result = file_get_contents($api_url, false, $api_stream);
        $api_json_result = json_decode($api_result);

        if (http_response_code() != 200) {
            throw new Exception('Feature settings update failed, please try again.');
            $complete = false;
        } else {
            $queryUpdateInfo = $dbconn->prepare("REPLACE INTO COMP_FEATURE (`COMPANY_ID`, `TYPE`, `VALUE`) VALUES (" . $company_id . ",2 ," . $vcall . ")");
            $queryUpdateInfo->execute();
            $queryUpdateInfo->close();
        }

        //LS-OS
        $api_url = "http://192.168.1.100:8004/webrest/";
        $api_data = array(
            'code' => 'FTRACC',
            'data' => array(
                'company_id' => $company_id,
                'user_type' => 0,
                'type' => '3',
                'value' => $livestream,
            ),
        );

        $api_options = array(
            'http' => array(
                'header'  => "Content-type: application/json\r\n",
                'method'  => 'POST',
                'content' => strval(json_encode($api_data))
            )
        );

        $api_stream = stream_context_create($api_options);
        $api_result = file_get_contents($api_url, false, $api_stream);
        $api_json_result = json_decode($api_result);

        if (http_response_code() != 200) {
            throw new Exception('Feature settings update failed, please try again.');
            $complete = false;
        } else {
            $queryUpdateInfo = $dbconn->prepare("REPLACE INTO COMP_FEATURE (`COMPANY_ID`, `TYPE`, `VALUE`) VALUES (" . $company_id . ",3 ," . $livestream . ")");
            $queryUpdateInfo->execute();
            $queryUpdateInfo->close();
        }

        // WEB-ACCESS
        $api_url = "http://192.168.1.100:8004/webrest/";
        $api_data = array(
            'code' => 'FTRACC',
            'data' => array(
                'company_id' => $company_id,
                'user_type' => 0,
                'type' => '4',
                'value' => $web_access,
            ),
        );

        $api_options = array(
            'http' => array(
                'header'  => "Content-type: application/json\r\n",
                'method'  => 'POST',
                'content' => strval(json_encode($api_data))
            )
        );

        $api_stream = stream_context_create($api_options);
        $api_result = file_get_contents($api_url, false, $api_stream);
        $api_json_result = json_decode($api_result);

        if (http_response_code() != 200) {
            throw new Exception('Feature settings update failed, please try again.');
            $complete = false;
        } else {
            $queryUpdateInfo = $dbconn->prepare("REPLACE INTO COMP_FEATURE (`COMPANY_ID`, `TYPE`, `VALUE`) VALUES (" . $company_id . ",4," . $web_access . ")");
            $queryUpdateInfo->execute();
            $queryUpdateInfo->close();
        }

        // INSTANT MESSAGING
        $api_url = "http://192.168.1.100:8004/webrest/";
        $api_data = array(
            'code' => 'FTRACC',
            'data' => array(
                'company_id' => $company_id,
                'user_type' => 0,
                'type' => '5',
                'value' => $messaging,
            ),
        );

        $api_options = array(
            'http' => array(
                'header'  => "Content-type: application/json\r\n",
                'method'  => 'POST',
                'content' => strval(json_encode($api_data))
            )
        );

        $api_stream = stream_context_create($api_options);
        $api_result = file_get_contents($api_url, false, $api_stream);
        $api_json_result = json_decode($api_result);

        if (http_response_code() != 200) {
            throw new Exception('Feature settings update failed, please try again.');
            $complete = false;
        } else {
            $queryUpdateInfo = $dbconn->prepare("REPLACE INTO COMP_FEATURE (`COMPANY_ID`, `TYPE`, `VALUE`) VALUES (" . $company_id . ",5," . $messaging . ")");
            $queryUpdateInfo->execute();
            $queryUpdateInfo->close();
        }


        // EMAIL
        $api_url = "http://192.168.1.100:8004/webrest/";
        $api_data = array(
            'code' => 'FTRACC',
            'data' => array(
                'company_id' => $company_id,
                'user_type' => 0,
                'type' => '6',
                'value' => $email_check,
            ),
        );

        $api_options = array(
            'http' => array(
                'header'  => "Content-type: application/json\r\n",
                'method'  => 'POST',
                'content' => strval(json_encode($api_data))
            )
        );

        $api_stream = stream_context_create($api_options);
        $api_result = file_get_contents($api_url, false, $api_stream);
        $api_json_result = json_decode($api_result);

        if (http_response_code() != 200) {
            throw new Exception('Feature settings update failed, please try again.');
            $complete = false;
        } else {
            $queryUpdateInfo = $dbconn->prepare("REPLACE INTO COMP_FEATURE (`COMPANY_ID`, `TYPE`, `VALUE`) VALUES (" . $company_id . ",6," . $email_check . ")");
            $queryUpdateInfo->execute();
            $queryUpdateInfo->close();
        }


        // SMS
        $api_url = "http://192.168.1.100:8004/webrest/";
        $api_data = array(
            'code' => 'FTRACC',
            'data' => array(
                'company_id' => $company_id,
                'user_type' => 0,
                'type' => '7',
                'value' => $sms,
            ),
        );

        $api_options = array(
            'http' => array(
                'header'  => "Content-type: application/json\r\n",
                'method'  => 'POST',
                'content' => strval(json_encode($api_data))
            )
        );

        $api_stream = stream_context_create($api_options);
        $api_result = file_get_contents($api_url, false, $api_stream);
        $api_json_result = json_decode($api_result);

        if (http_response_code() != 200) {
            throw new Exception('Feature settings update failed, please try again.');
            $complete = false;
        } else {
            $queryUpdateInfo = $dbconn->prepare("REPLACE INTO COMP_FEATURE (`COMPANY_ID`, `TYPE`, `VALUE`) VALUES (" . $company_id . ",7," . $sms . ")");
            $queryUpdateInfo->execute();
            $queryUpdateInfo->close();
        }
    } catch (Exception $ex) {
        echo "<script language='javascript'>";
        echo "alert('" . $ex->getMessage() . "');";
        echo "window.location.href='index.php';";
        echo "</script>";
    }


    if ($complete && !isset($ex)) {
        redirect(base_url() . "dashboardv2/");
    }
}

$query = $dbconn->prepare("SELECT a.*, b.*, c.* FROM USER_ACCOUNT a, COMPANY_INFO b, COMPANY c WHERE a.COMPANY = b.COMPANY AND b.COMPANY = c.ID AND a.COMPANY = ?");
$query->bind_param("i", $id_company);
$query->execute();
$itemUser = $query->get_result()->fetch_assoc();
$query->close();

?>

<style media="screen">
    a {
        color: #007A87;
    }

    @media (max-width:1366px) {
        #docs-title {
            font-size: 18px;
        }

        .docs-section {
            font-size: 13px;
        }
    }

    #service-info li {
        padding: 0.5rem 0 !important;
    }

    @media (min-width: 768px) {
        .row.row-eq-height {
            display: flex;
            flex-wrap: wrap;
        }
    }

    .border-70 {
        border: 1px solid #707070;
        border-radius: 7px;
    }

    .docs-section .form-control {
        border: 1px solid #707070;
        border-radius: 7px;
    }

    .docs-section .input-group .form-control {
        border: unset;
    }

    .save-settings {
        background-color: #1799ad;
        color: white;
        /* float: right; */
        vertical-align: middle;
        padding: 4px 10px;
    }

    .save-settings:hover {
        background-color: #95f1ff;
        color: black;
    }

    #passwarn,
    #passwarn2 {
        display: none;
    }

    body {
        font-size: 14px;
    }
</style>

<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>

<style>
    /* input:placeholder-shown{
        font-size: 9px;
    } */

    html,
    body {
        max-width: 100%;
        overflow-x: hidden;
    }

    input::-ms-reveal,
    input::-ms-clear {
        display: none;
    }

    ::-ms-reveal {
        display: none;
    }

    #toCheckout:hover {
        color: #efb455 !important;
        background-color: white !important;
        border-color: #efb455 !important;
    }

    ;
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="row row-eq-height">
                        <div class="col-xl-8 col-lg-12">
                            <h4 class="card-name" style="font-size:2rem"><strong data-translate="dashindex-1">Account Overview<?php //foreach ($result as $row) { var_dump($row['START_TIME']); }
                                                                                                                                ?></strong></h4>
                            <div class="card" id="account">
                                <div class="row">
                                    <div class="col-md-4 justify-content-center text-center">
                                        <form method="POST" enctype="multipart/form-data">
                                            <div class="row mb-3 justify-content-center">
                                                <div class="col-10 col-md-12 col-xl-12 my-auto docs-section">
                                                    <?php if ($itemUser['COMPANY_LOGO'] !=  null) { ?>
                                                        <img class="profile-pic img-responsive mx-auto" id="logo-preview" src="<?php echo base_url(); ?>dashboardv2/uploads/logo/<?php echo $itemUser['COMPANY_LOGO']; ?>">
                                                    <?php } else { ?>
                                                        <img class="profile-pic img-responsive mx-auto" id="logo-preview" src="assets/logomark_regular_small-new.png">
                                                    <?php } ?>
                                                    <div class="form-group mb-0">
                                                        <label for="company-logo" data-translate="dashindex-3">Change Company Logo</label>
                                                        <div class="input-group border-70">

                                                            <label for="company-logo" class="btn" style="position: absolute; z-index: 20">
                                                                <button data-translate="dashindex-35" style="border: 1px solid grey; pointer-events: none" type="button">Choose File</button>
                                                            </label>
                                                            <input id="no-chosen" type="text" style="margin-top: 5px; padding-left: 130px; border-radius: 20px; background-color: transparent !important" class="form-control border-70" readonly value="No file chosen.">
                                                            <input id="file-upload-name" type="text" style="margin-top: 5px; padding-left: 130px; border-radius: 20px; background-color: transparent !important" class="form-control border-70 d-none" readonly>

                                                            <!-- <span id="no-chosen" style="margin-top: 12px; position: absolute; margin-left: 130px" data-translate="dashindex-36">No file chosen.</span> -->
                                                            <!-- <span id="file-upload-name" style="margin-top: 12px; position: absolute; margin-left: 130px"></span> -->



                                                            <input type="file" accept="image/*" class="form-control d-none" id="company-logo" name="company-logo" style="overflow: hidden">

                                                            <div class="input-group-append">
                                                                <button class="btn pull-left save-settings" type="submit" name="changeCompanyLogo" id="uploadLogo" disabled>
                                                                    <i class="fa fa-save"></i>
                                                                </button>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <small style="color: red;" data-translate="dashindex-4">Please limit logo file size to a maximum of 2 MB.</small>
                                                </div>
                                            </div>
                                        </form>
                                        <form method="POST" enctype="multipart/form-data">
                                            <div class="row justify-content-center">
                                                <div class="col-10 col-md-12 col-xl-12 my-auto docs-section">
                                                    <div class="form-group">
                                                        <label for="companyname" data-translate="dashindex-5">Company Name</label>
                                                        <div class="input-group border-70">
                                                            <input type="text" class="form-control" id="companyname" name="inputCompanyName" value="<?php echo $itemUserDetail['COMPANY_NAME']; ?>">
                                                            <div class="input-group-append">
                                                                <button class="btn pull-left save-settings" type="submit" name="changeCompanyName" id="submitCompName" disabled>
                                                                    <i class="fa fa-save"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <small id="compNameWarning" style="color: red; display:none;" data-translate="dashindex-6">You may only use underscore for a special character/symbol.</small>
                                                    </div>

                                                </div>
                                            </div>
                                        </form>
                                        <form method="POST" enctype="multipart/form-data">
                                            <div class="row justify-content-center">
                                                <div class="col-10 col-md-12 col-xl-12 my-auto docs-section">
                                                    <div class="form-group">
                                                        <label for="username" data-translate="dashindex-7">User Name</label>
                                                        <div class="input-group border-70">
                                                            <input type="text" class="form-control border-70" id="username" name="inputUserName" value="<?php echo $userID['USERNAME']; ?>">
                                                            <div class="input-group-append">
                                                                <button class="btn pull-left save-settings" type="submit" name="changeUserName" id="submitUserName" disabled>
                                                                    <i class="fa fa-save"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <small id="userNameWarning" style="color: red;  display:none;" data-translate="dashindex-8">You may only use underscore for a special character/symbol.</small>
                                                    </div>

                                                </div>
                                            </div>
                                        </form>
                                        <form method="POST" enctype="multipart/form-data">
                                            <div class="row justify-content-center">
                                                <div class="col-10 col-md-12 col-xl-12 my-auto docs-section">
                                                    <div class="form-group">
                                                        <label for="adminPass" data-translate="dashindex-9">Admin Password</label>
                                                        <div class="input-group border-70">
                                                            <input type="password" class="form-control" id="adminPass" name="adminPass" value="<?php echo $_SESSION['password_show']; ?>">
                                                            <div class="input-group-append">
                                                                <button type="button" class="btn py-0 px-3" onclick="showHide();">
                                                                    <i class="fa fa-eye-slash fs-20" id="showHide"></i>
                                                                </button>
                                                                <button class="btn pull-left save-settings" type="submit" name="changeAdmPass" id="submitAdmPass" disabled>
                                                                    <i class="fa fa-save"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <span id="progresslabel" class="fontRobReg"></span>
                                                        <small data-translate="signup-8" id="passwarn" style="color: red;">Password must be 6 characters long consisting at least a lowercase and uppercase letter, a number, and a special character ( @ $ ! % * # ? & )</small>
                                                        <small data-translate="signup-14" id="passForbiddenChar" style="color: red; display:none;">Please refrain from using these symbols in your password: " ' ` ´ ’ ‘ ; = -</small>
                                                    </div>

                                                </div>
                                            </div>
                                        </form>
                                        <form method="POST" enctype="multipart/form-data">
                                            <div class="row justify-content-center">
                                                <div class="col-10 col-md-12 col-xl-12 my-auto docs-section">
                                                    <div class="form-group">
                                                        <label for="newpass_priv" data-translate="dashindex-10">Internal Password</label>
                                                        <div class="input-group border-70">
                                                            <input type="password" class="form-control" id="newpass_priv" name="inputPass_priv" value="<?php echo $itemUserDetail['PRIVATE_PASSWORD']; ?>">
                                                            <div class="input-group-append">
                                                                <button type="button" class="btn py-0 px-3" onclick="showHide2();">
                                                                    <i class="fa fa-eye-slash fs-20" id="showHide2"></i>
                                                                </button>
                                                                <button class="btn pull-left save-settings" type="submit" name="changeIntPass" id="submitIntPass" disabled>
                                                                    <i class="fa fa-save"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <span id="progresslabel2" class="fontRobReg"></span>
                                                        <small data-translate="signup-8" id="passwarn2" style="color: red;">Password must be 6 characters long consisting at least a lowercase and uppercase letter, a number, and a special character ( @ $ ! % * # ? & )</small>
                                                        <small data-translate="signup-14" id="passForbiddenChar2" style="color: red; display:none;">Please refrain from using these symbols in your password: " ' ` ´ ’ ‘ ; = -</small>
                                                    </div>

                                                </div>
                                            </div>
                                        </form>
                                        <form method="POST" enctype="multipart/form-data">
                                            <div class="row justify-content-center">
                                                <div class="col-10 col-md-12 col-xl-12 my-auto docs-section">
                                                    <div class="form-group">
                                                        <label for="new_supp_email" data-translate="dashindex-11">Email account for Support</label>
                                                        <div class="input-group border-70">
                                                            <?php if ($itemUserDetail['SUPPORT_EMAIL'] != null) { ?>
                                                                <input type="email" class="form-control" id="new_supp_email" name="new_supp_email" style="font-size: 12px" value="<?php echo $itemUserDetail['SUPPORT_EMAIL']; ?>"><br>
                                                            <?php } else { ?>
                                                                <input type="email" class="form-control" id="new_supp_email" name="new_supp_email" style="font-size: 12px" placeholder="No Email Registered"><br>
                                                            <?php } ?>
                                                            <div class="input-group-append">
                                                                <button class="btn pull-left save-settings" type="submit" name="changeSuppEmail" id="submitSuppEmail" disabled>
                                                                    <i class="fa fa-save"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <small id="emailWarning" style="color: red; display:none;" data-translate="dashindex-12">Please input a valid email address.</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <!-- <button type="submit" name="update_company_settings" class="btn btn-yellow text-center">Save Changes</button> -->
                                        <!-- </form> -->
                                        <!-- <span class="josefin-sans text-center" id="overview-email"><strong><?php echo $itemUser['EMAIL_ACCOUNT']; ?></strong></span> -->
                                    </div>
                                    <div class="col-md-8">
                                        <ul class="josefin-sans mx-auto" id="service-info">
                                            <li>
                                                <strong data-translate="dashindex-37">Email: <a href="#" class="credit-hint" id="maven-email">(?)</a>:</strong><br>
                                                <span id="email_username" style="font-weight: 700" class="mb-0 mt-1"><?= $itemUser['EMAIL_ACCOUNT'] ?></span>
                                                <button class="btn pull-left" id="copyemail" onclick="copyElementText6()" type="button" name="button">
                                                    <i class="fa fa-copy"></i>
                                                </button>
                                                <span data-translate="dashindex-14" id="copied-maven-email" class="text-success" style="display:none;">Copied!</span>
                                            </li>
                                            <li>
                                                <strong data-translate="dashindex-13">newuniverse.io Account:</strong><br>
                                                <span class="pull-left"><?php echo (str_repeat('*', strlen($itemUser['API_KEY']))); ?></span>
                                                <span class="pull-left d-none" id="apikey"><?php echo $itemUser['API_KEY']; ?></span>
                                                <button class="btn pull-left" id="copyapi" onclick="copyElementText()" type="button" name="button">
                                                    <i class="fa fa-copy"></i>
                                                </button>
                                                <span data-translate="dashindex-14" id="copied-acc" class="text-success" style="display:none;">Copied!</span>
                                            </li>
                                            <li>
                                                <strong data-translate="dashindex-15">Maven Username <a href="#" class="credit-hint" id="maven-uname">(?)</a>:</strong><br>
                                                <span class="pull-left">
                                                    <?php if ($user['STATUS'] == 3) {
                                                        echo (str_repeat('*', strlen("nexilis-client")));
                                                    } else {
                                                        echo (str_repeat('*', strlen("nexilis-client")));
                                                    } ?>
                                                </span>
                                                <span class="pull-left d-none" id="maven_username">
                                                    <?php if ($user['STATUS'] == 3) { ?>
                                                        <!-- paliotrial -->
                                                        <!-- nexilis-client -->
                                                        temp-nexilis-client
                                                    <?php } else { ?>
                                                        <!-- palioclient -->
                                                        <!-- nexilis-client -->
                                                        temp-nexilis-client
                                                    <?php } ?>
                                                </span>
                                                <button class="btn pull-left" id="copyusername" onclick="copyElementText3()" type="button" name="button">
                                                    <i class="fa fa-copy"></i>
                                                </button>
                                                <span data-translate="dashindex-14" id="copied-maven-uname" class="text-success" style="display:none;">Copied!</span>
                                            </li>
                                            <li>
                                                <strong data-translate="dashindex-16">Maven Password <a href="#" class="credit-hint" id="maven-pass">(?)</a>:</strong><br>
                                                <span class="pull-left">
                                                    <?php if ($user['STATUS'] == 3) {
                                                        echo (str_repeat('*', strlen("AP2CSuA9bsdCpY9DSMg5yA8XpbTcX386rk1Dqy")));
                                                    } else {
                                                        echo (str_repeat('*', strlen("AP3mBqYr9jGRcR9pyk9TmWK8E5mAXNdTayuXSm")));
                                                    } ?>
                                                </span>
                                                <span class="pull-left d-none" id="maven_password">
                                                    <?php if ($user['STATUS'] == 3) { ?>
                                                        <!-- AP2CSuA9bsdCpY9DSMg5yA8XpbTcX386rk1Dqy -->
                                                        <!-- AP5TcZ3XLw7SdewqKiVozPuHqUH -->
                                                        AP6ZuWCxBVTzLGiUjfacryBiwPQ
                                                    <?php } else { ?>
                                                        <!-- AP3mBqYr9jGRcR9pyk9TmWK8E5mAXNdTayuXSm -->
                                                        <!-- AP5TcZ3XLw7SdewqKiVozPuHqUH -->
                                                        AP6ZuWCxBVTzLGiUjfacryBiwPQ
                                                    <?php } ?>
                                                </span>
                                                <button class="btn pull-left" id="copypassword" onclick="copyElementText4()" type="button" name="button">
                                                    <i class="fa fa-copy"></i>
                                                </button>
                                                <span data-translate="dashindex-14" id="copied-maven-pass" class="text-success" style="display:none;">Copied!</span>
                                            </li>
                                            <li>
                                                <strong data-translate="dashindex-17">Version Library<a href="#" class="credit-hint" id="maven-be">(?)</a>:</strong><br>
                                                <span class="mb-0 mt-1"><?php echo (str_repeat('*', strlen($dataVB['VERSION_CODE']))); ?></span>
                                                <span id="be_version" class="mb-0 mt-1 d-none">
                                                    <?= $dataVB['VERSION_CODE'] ?>
                                                </span>
                                                <button class="btn pull-left" id="copypassword" onclick="copyElementText5()" type="button" name="button">
                                                    <i class="fa fa-copy"></i>
                                                </button>
                                                <span data-translate="dashindex-14" id="copied-maven-be" class="text-success" style="display:none;">Copied!</span>
                                            </li>
                                            <li>
                                                <strong data-translate="dashindex-18"></strong>
                                                <br>
                                                <a href="<?php echo base_url(); ?>downloads/PalioLiteSampleCode.zip" class="btn pull-left" style="background-color: #1799ad; color: white; padding-top: 0; padding-bottom: 0;" data-translate="dashindex-21">Download</a>
                                                <br>
                                            </li>
                                            <li>
                                                <strong data-translate="dashindex-19">Selected Service(s):</strong><br>

                                                Mobile Contact Centers,
                                                Push Notifications,
                                                In-app Messaging,
                                                Live Video Streaming,
                                                Video & VoIP Calls

                                            </li>
                                            <li>
                                                <?php if ($today > $due_date) { ?>
                                                    <?php

                                                    echo "Your subscription is over.";
                                                    ?>
                                                    <a id="btn-subscribe-dashboard" data-translate="dashindex-20" href="billpayment.php" class="btn pull-left" type="button" name="button" style="background-color: #efb455; color: white; padding-top: 0; padding-bottom: 0;">
                                                        SUBSCRIBE
                                                    </a>
                                                <?php } else { ?>
                                                    <form method="post">
                                                        <strong data-translate="dashindex-22">Subscription Status:</strong><br>
                                                        <?php
                                                        if ($user['STATUS'] == 3) {
                                                            echo "<span id='trialprice'></span>";
                                                            echo ("<a href='" . base_url() . "checkout.php' id='toCheckout' class='btn pull-left' type='button' name='button' style='background-color: #efb455; color: white; padding-top: 0; padding-bottom: 0;'>SUBSCRIBE</a>");
                                                        } else {
                                                            echo "[<span data-translate='dashindex-33'>ACTIVE</span>] [<span data-translate='dashindex-34'>Package:</span> " . ($bill2['CURRENCY'] == 'USD' ? "$" : "Rp ") . "<span id='packagePrice'>" . rupiah($bill2['CHARGE']) . "</span>]";
                                                            // echo ("<a href='billpayment.php' class='btn pull-left' type='button' name='button' style='background-color: #1799ad; color: white; padding-top: 0; padding-bottom: 0;'>SUBSCRIBE</a>");
                                                        }
                                                        ?>
                                                    </form>

                                                    <?php

                                                    // FOR CONVERT ENGLISH TO INDONESIA

                                                    function translateDay($day)
                                                    {

                                                        $hari = $day;

                                                        switch ($hari) {
                                                            case 'Sunday':
                                                                $hari_ini = "Minggu";
                                                                break;

                                                            case 'Monday':
                                                                $hari_ini = "Senin";
                                                                break;

                                                            case 'Tuesday':
                                                                $hari_ini = "Selasa";
                                                                break;

                                                            case 'Wednesday':
                                                                $hari_ini = "Rabu";
                                                                break;

                                                            case 'Thursday':
                                                                $hari_ini = "Kamis";
                                                                break;

                                                            case 'Friday':
                                                                $hari_ini = "Jumat";
                                                                break;

                                                            case 'Saturday':
                                                                $hari_ini = "Sabtu";
                                                                break;

                                                            default:
                                                                $hari_ini = "Tidak di ketahui";
                                                                break;
                                                        }

                                                        return $hari_ini;
                                                    }

                                                    function translateMonth($month)
                                                    {

                                                        $month = $month;

                                                        switch ($month) {
                                                            case 'January':
                                                                $bulan_ini = "Januari";
                                                                break;

                                                            case 'February':
                                                                $bulan_ini = "Februari";
                                                                break;

                                                            case 'March':
                                                                $bulan_ini = "Maret";
                                                                break;

                                                            case 'April':
                                                                $bulan_ini = "April";
                                                                break;

                                                            case 'May':
                                                                $bulan_ini = "Mei";
                                                                break;

                                                            case 'June':
                                                                $bulan_ini = "Juni";
                                                                break;

                                                            case 'July':
                                                                $bulan_ini = "Juli";
                                                                break;

                                                            case 'August':
                                                                $bulan_ini = "Agustus";
                                                                break;

                                                            case 'September':
                                                                $bulan_ini = "September";
                                                                break;

                                                            case 'October':
                                                                $bulan_ini = "Oktober";
                                                                break;

                                                            case 'November':
                                                                $bulan_ini = "November";
                                                                break;

                                                            case 'December':
                                                                $bulan_ini = "Desember";
                                                                break;

                                                            default:
                                                                $bulan_ini = "Tidak di ketahui";
                                                                break;
                                                        }

                                                        return $bulan_ini;
                                                    }

                                                    $dayIndo = translateDay(date("l", strtotime($bill2['DUE_DATE'])));
                                                    $dateIndo = date("d", strtotime($bill2['DUE_DATE']));
                                                    $monthIndo = translateMonth(date("F", strtotime($bill2['DUE_DATE'])));
                                                    $yearIndo = date("Y", strtotime($bill2['DUE_DATE']));

                                                    ?>

                                                    <strong id="expiry-date-ID" class="d-none"><small style="color: red;"><span data-translate="dashindex-23">Expiry Date :</span> <?php echo $dayIndo . ', ' . $dateIndo . ' ' . $monthIndo . ' ' . $yearIndo . ', ' . date("H:i A", strtotime($bill2['DUE_DATE'])); ?> </small></strong>
                                                    <strong id="expiry-date-EN" class=""><small style="color: red;"><span data-translate="dashindex-23">Expiry Date :</span> <?php echo date("l, d F Y", strtotime($bill2['DUE_DATE'])) . ', ' . date("H:i A", strtotime($bill2['DUE_DATE'])); ?> </small></strong>

                                                    <?php if ($user['STATUS'] == 3) { ?>

                                                        <small style="font-style:italic;">
                                                            <p id="trial-account">
                                                                The trial account is meant to show you how quick and easy it is to embed nexilis's features to your applications,
                                                                making 24 hours more than enough.
                                                            </p>
                                                            <p id="evaluate-features-EN">
                                                                If you need to evaluate the features and performance of newuniverse.io, you can download <a href="https://play.google.com/store/apps/details?id=io.newuniverse.catchup" target="_blank">catchUp</a>
                                                                and use all of its features for free. catchUp is a unified social media with Live Streaming, Video Conference, Unified Messaging features built entirely using newuniverse.io.
                                                            </p>
                                                            <p id="evaluate-features-ID" class="d-none">
                                                                Jika anda ingin mengevaluasi fitur dan performa newuniverse.io, anda dapat mengunduh <a href="https://play.google.com/store/apps/details?id=io.newuniverse.catchup" target="_blank">catchUp</a> dan menggunakan semua fiturnya dengan gratis. catchUp adalah media sosial yang digabungkan dengan fitur Live Streaming, Video Conference, Unified Messaging yang dibangun secara keseluruhan menggunakan newuniverse.io
                                                            </p>
                                                        </small>

                                                    <?php } else { ?>

                                                        <small style="font-style:italic;">
                                                            <p style="margin-bottom: 0px !important;">
                                                                <span data-translate="dashindex-31">We will charge</span>
                                                                <?php if ($currency == 'USD') { ?>
                                                                    $0.000265 per KB
                                                                <?php } else if ($currency != 'USD') { ?>
                                                                    Rp 3975 per MB
                                                                <?php } ?>

                                                                <span data-translate="dashindex-30">
                                                                    for any excess traffic once your Customer Engagement Credit runs out, and
                                                                    the amount will be deducted from your Prepaid Credit balance. Your Prepaid Credit balance will only be used
                                                                    when your Customer Engagement Credit runs out. <br> <br>

                                                                    You may topup your Prepaid Credit balance anytime, and it has no expiry date.
                                                                </span>
                                                            </p>
                                                        </small>

                                                    <?php } ?>
                                                <?php } ?>
                                            </li>
                                            <?php if ($user['STATUS'] == 3) { ?>
                                                <li class="d-none">
                                                <?php } else { ?>
                                                <li>
                                                <?php } ?>
                                                <strong data-translate="dashindex-24">Your Prepaid Credit Balance:</strong><br>

                                                <?php echo (($credit['CURRENCY'] == 'USD' ? "$" : "Rp ") . ' <span id="topupAmt">' . rupiah($credit['CREDIT']) . '</span>'); ?>
                                                <a data-translate="dashindex-25" href='../topup.php' class='btn pull-left' type='button' name='button' style='background-color: #1799ad; color: white; padding-top: 0; padding-bottom: 0;'>TOP UP</a><br>

                                                </li>
                                                <li>
                                                    <div class="row">
                                                        <div class="col-12 my-auto docs-section">
                                                            <form method="POST" id="feature_enable">
                                                                <div class="form-group">
                                                                    <label data-translate="dashindex-26">Services/Features</label>
                                                                    <label class="container-check">Instant Messaging
                                                                        <input id="im_check" type="checkbox" name="im_check" value="<?php echo $im_enabled; ?>">
                                                                        <span class="checkmark"></span>
                                                                    </label>
                                                                    <label class="container-check">SMS
                                                                        <input id="sms_check" type="checkbox" name="sms_check" value="<?php echo $sms_enabled; ?>">
                                                                        <span class="checkmark"></span>
                                                                    </label>
                                                                    <label class="container-check">Email
                                                                        <input id="email_check" type="checkbox" name="email_check" value="<?php echo $email_enabled; ?>">
                                                                        <span class="checkmark"></span>
                                                                    </label>
                                                                    <label class="container-check">VoIP & Video Call
                                                                        <input id="voip_check" type="checkbox" name="voip-vcall" value="<?php echo $voip_enabled; ?>">
                                                                        <span class="checkmark"></span>
                                                                    </label>
                                                                    <label class="container-check">Live Streaming & Webinar
                                                                        <input id="ls_check" type="checkbox" name="ls-os" value="<?php echo $ls_enabled; ?>">
                                                                        <span class="checkmark"></span>
                                                                    </label>
                                                                    <label class="container-check">Web Access
                                                                        <input id="web_check" type="checkbox" name="web-access" value="<?php echo $web_enabled; ?>">
                                                                        <span class="checkmark"></span>
                                                                    </label>
                                                                </div>
                                                                <button id="feature_update" data-translate="dashindex-27" type="submit" name="feature_update" class="btn btn-yellow text-center" disabled>Save Settings</button>
                                                        </div>
                                                    </div>
                                                </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.col-md-6 -->
                        <div class="col-xl-4 col-lg-12" style="height:100%;">
                            <h4 class="card-name" style="font-size:2rem"><strong data-translate="dashindex-2">Billing</strong></h4>
                            <div class="card" id="billing">
                                <div class="row my-auto">
                                    <div class="col-md-12 text-center">
                                        <img class="img-responsive mx-auto mb-3" src="assets/cost_saving@2x.png">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <a class="btn btn-green" style="width: 100%; height:100%;" href="billpayment.php">
                                            <?php
                                            if ($total_bill['TOTAL'] == '') {
                                                echo "<span data-translate='dashindex-32'>No unpaid bills</span>";
                                            } else {
                                                echo "$" . $total_bill['TOTAL'];
                                            }
                                            ?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <h4 class="card-name" style="width: 100%" data-translate="dashindex-28"><strong>Recent Usage</strong></h4>

                            <div class="card card-info" id="recent-usage">
                                <div class="card-body">
                                    <!-- <canvas id="myUsage"></canvas> -->
                                    <div id="chart-EN" class="chart-container" style="position: relative; min-height:50vh;">
                                        <canvas id="myUsage"></canvas>
                                        <!-- <canvas id="myUsageID"></canvas> -->
                                    </div>
                                    <div id="chart-ID" class="chart-container" style="position: relative; min-height:50vh;">
                                        <canvas id="myUsageID"></canvas>
                                        <!-- <canvas id="myUsageID"></canvas> -->
                                    </div>
                                    <span class="chart-info" style="font-style:normal">
                                        <span data-translate="dashindex-29">Subscription period:</span> <span class="usage-period"><span id="period-start-date"><?php echo date('d F Y', strtotime($bill2['BILL_DATE'])) ?></span> - <span id="period-end-date"><?= date('d F Y', strtotime($bill2['DUE_DATE'])); ?></span></span>
                                    </span>
                                    <!-- <span class="chart-info" style="float:right;">Total usage: <span class="usage-total"><?php //echo ($byte != NULL ? $byte : "0"); 
                                                                                                                                ?> KB</span></span> -->
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>

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
                <img onclick="subsClick();" alt="Under Maintenane" src="<?php echo base_url(); ?>newAssets/under-maintenance.png" /><br>
                Sorry we cannot process your payment now. Meanwhile, you can use the trial version of nexilis Lite.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/dashboardv2/dashboard_footer.php'); ?>


<!-- ./wrapper -->

<script src="js/dashboard.js?<?php echo $version; ?>"></script>

<script>
    var oldCompanyName = $('#companyname').val();
    var oldusername = $('#username').val();
    var oldEmailSupport = $('#new_supp_email').val();

    $("#companyname").bind("change keyup input", function() {

        if ($('#companyname').val() != oldCompanyName) {
            $("#submitCompName").attr('disabled', false);

        } else {
            $("#submitCompName").attr('disabled', true);

        }

    });

    $("#username").bind("change keyup input", function() {

        if ($('#username').val() != oldusername) {
            $("#submitUserName").attr('disabled', false);
        } else {
            $("#submitUserName").attr('disabled', true);
        }

    });

    $("#new_supp_email").bind("change keyup input", function() {

        if (($('#new_supp_email').val() != oldEmailSupport) && (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test($('#new_supp_email').val()))) {

            $("#submitSuppEmail").attr('disabled', false);

        } else {

            $("#submitSuppEmail").attr('disabled', true);

        }

    });

    $("#company-logo").bind("change", function() {

        $("#uploadLogo").attr('disabled', false);

    });

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

    $("#change-lang-EN").click(function() {
        localStorage.lang = 0;
        var enStartDate = '<?= date('d F Y', strtotime($bill2['BILL_DATE'])) ?>';
        var enEndDate = '<?= date('d F Y', strtotime($bill2['DUE_DATE'])); ?>';

        $("#period-start-date").text(enStartDate);
        $("#period-end-date").text(enEndDate);
        $("#lang-nav").text('EN');
        $('#new_supp_email').attr('placeholder', 'No Email Registered');
        $('#chart-EN').removeClass('d-none');
        $('#chart-ID').addClass('d-none');

        $('#expiry-date-ID').addClass('d-none');
        $('#expiry-date-EN').removeClass('d-none');
        $('#no-chosen').attr('value', 'No file chosen.');

        $("#trial-account").text("The trial account is meant to show you how quick and easy it is to embed nexilis's features to your applications, making 24 hours more than enough.");
        $("#evaluate-features-ID").addClass("d-none");
        $("#evaluate-features-EN").removeClass("d-none");
        $("#toCheckout").text("SUBSCRIBE");
        $("#btn-subscribe-dashboard").text("SUBSCRIBE");
        change_lang();
    });

    $("#change-lang-ID").click(function() {
        localStorage.lang = 1;

        <?php
        function dateIndonesia($tanggal)
        {
            $bulan = array(
                1 => 'Januari',
                'Februari',
                'Maret',
                'April',
                'Mei',
                'Juni',
                'Juli',
                'Agustus',
                'September',
                'Oktober',
                'November',
                'Desember'
            );
            $pecahkan = explode('-', $tanggal);
            return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
        }
        ?>

        var indStartDate = '<?php echo dateIndonesia(date('Y-m-d', strtotime($bill2['BILL_DATE']))); ?>';
        var indEndDate = '<?php echo dateIndonesia(date('Y-m-d', strtotime($bill2['DUE_DATE']))); ?>';

        $("#period-start-date").text(indStartDate);
        $("#period-end-date").text(indEndDate);
        $("#lang-nav").text('ID');
        $('#new_supp_email').attr('placeholder', 'Email tidak terdaftar');
        $('#chart-EN').addClass('d-none');
        $('#chart-ID').removeClass('d-none');

        $('#expiry-date-ID').removeClass('d-none');
        $('#expiry-date-EN').addClass('d-none');
        $('#no-chosen').attr('value', 'Belum ada berkas.');

        $("#trial-account").text("Akun masa percobaan dibuat untuk menunjukkan pada anda seberapa cepat dan mudahnya untuk menanamkan fitur nexilis pada aplikasi anda, dalam kurun waktu 24 jam.");
        $("#evaluate-features-ID").removeClass("d-none");
        $("#evaluate-features-EN").addClass("d-none");
        $("#toCheckout").text("BERLANGGANAN");
        $("#btn-subscribe-dashboard").text("BERLANGGANAN");
        change_lang();
    });

    if (localStorage.lang == 1) {

        <?php
        function indDate($tanggal)
        {
            $bulan = array(
                1 => 'Januari',
                'Februari',
                'Maret',
                'April',
                'Mei',
                'Juni',
                'Juli',
                'Agustus',
                'September',
                'Oktober',
                'November',
                'Desember'
            );
            $pecahkan = explode('-', $tanggal);
            return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
        }
        ?>

        var indStartDate = '<?php echo indDate(date('Y-m-d', strtotime($bill2['BILL_DATE']))); ?>';
        var indEndDate = '<?php echo indDate(date('Y-m-d', strtotime($bill2['DUE_DATE']))); ?>';

        $("#period-start-date").text(indStartDate);
        $("#period-end-date").text(indEndDate);
        $('#new_supp_email').attr('placeholder', 'Email tidak terdaftar');
        $('#chart-EN').addClass('d-none');
        $('#chart-ID').removeClass('d-none');

        $('#expiry-date-ID').removeClass('d-none');
        $('#expiry-date-EN').addClass('d-none');
        $('#no-chosen').attr('value', 'Belum ada berkas.');

        $("#trial-account").text("Akun masa percobaan dibuat untuk menunjukkan pada anda seberapa cepat dan mudahnya untuk menanamkan fitur nexilis pada aplikasi anda, dalam kurun waktu 24 jam.");
        $("#evaluate-features-ID").removeClass("d-none");
        $("#evaluate-features-EN").addClass("d-none");
        $("#toCheckout").text("BERLANGGANAN");
        $("#btn-subscribe-dashboard").text("BERLANGGANAN");
    } else {
        $('#chart-EN').removeClass('d-none');
        $('#chart-ID').addClass('d-none');

        $('#expiry-date-ID').addClass('d-none');
        $('#expiry-date-EN').removeClass('d-none');
    }

    $('#company-logo').change(function(e) {
        e.preventDefault();

        $('#no-chosen').hide();
        $('#file-upload-name').removeClass('d-none');
        $('#file-upload-name').attr('value', this.files[0].name);
    });

    <?php if ($usage_data != null) { ?>
        let text = [];
        let image = [];
        let video = [];
        let ls_min = [];
        let voip_min = [];
        let vc_min = [];
        let created_at = [];
        text.push(<?php echo $usage_data['TEXT']; ?>);
        image.push(<?php echo $usage_data['DOC']; ?>);
        video.push(<?php echo $usage_data['VIDEO']; ?>);
        ls_min.push(<?php echo $usage_data['LS']; ?>);
        voip_min.push(<?php echo $usage_data['VOIP']; ?>);
        vc_min.push(<?php echo $usage_data['VIDCALL']; ?>);
        created_at.push($(".usage-period").text());
    <?php } else { ?>
        let text = [0];
        let image = [0];
        let video = [0];
        let ls_min = [0];
        let voip_min = [0];
        let vc_min = [0];
        let created_at = [];
        created_at.push($(".usage-period").text());
    <?php } ?>

    var _0x54bb = ['1JmdehV', 'Documents\x20&\x20Images\x20Recipient', '#F6D55C', 'Month', '#173F5F', '1099177PuiMch', 'nearest', 'index', 'myUsage', '#20639B', 'getElementById', '1mCGLQb', '141473VQNROl', '4299HFteLW', '1HSCJAD', 'Usage', '#ED553B', '1286389gkvhOj', '#9966FF', 'Text\x20Recipient', '#3CAEA3', 'Livestream\x20Minutes', '1460631SCSxLW', '339WeNkTG', '159952RwDgXJ', '1778801aCHVwV'];
    var _0x5f13 = function(_0x434f95, _0x51c9a6) {
        _0x434f95 = _0x434f95 - 0xe5;
        var _0x54bb0c = _0x54bb[_0x434f95];
        return _0x54bb0c;
    };
    var _0x484487 = _0x5f13;
    (function(_0x3c09cd, _0x15edbe) {
        var _0x3efea1 = _0x5f13;
        while (!![]) {
            try {
                var _0x5ce487 = -parseInt(_0x3efea1(0xef)) + parseInt(_0x3efea1(0xe8)) * parseInt(_0x3efea1(0xf1)) + -parseInt(_0x3efea1(0xf0)) * -parseInt(_0x3efea1(0xe5)) + parseInt(_0x3efea1(0xf6)) + -parseInt(_0x3efea1(0xfd)) + -parseInt(_0x3efea1(0xfc)) * parseInt(_0x3efea1(0xed)) + -parseInt(_0x3efea1(0xee)) * parseInt(_0x3efea1(0xfe));
                if (_0x5ce487 === _0x15edbe) break;
                else _0x3c09cd['push'](_0x3c09cd['shift']());
            } catch (_0x3bfd8b) {
                _0x3c09cd['push'](_0x3c09cd['shift']());
            }
        }
    }(_0x54bb, 0xe6b36));
    var ctx = document[_0x484487(0xfb)](_0x484487(0xf9)),
        myChart = new Chart(ctx, {
            'type': 'bar',
            'data': {
                'labels': [''],
                'datasets': [{
                    'label': _0x484487(0xea),
                    'backgroundColor': _0x484487(0xe7),
                    'borderColor': '#ED553B',
                    'data': text,
                    'fill': ![]
                }, {
                    'label': _0x484487(0xf2),
                    'backgroundColor': _0x484487(0xf3),
                    'borderColor': _0x484487(0xf3),
                    'data': image,
                    'fill': ![]
                }, {
                    'label': 'Video\x20Recipient',
                    'backgroundColor': _0x484487(0xeb),
                    'borderColor': _0x484487(0xeb),
                    'data': video,
                    'fill': ![]
                }, {
                    'label': _0x484487(0xec),
                    'backgroundColor': _0x484487(0xfa),
                    'borderColor': _0x484487(0xfa),
                    'data': ls_min,
                    'fill': ![]
                }, {
                    'label': 'VoIP\x20Calls\x20Minutes',
                    'backgroundColor': _0x484487(0xf5),
                    'borderColor': '#173F5F',
                    'data': voip_min,
                    'fill': ![]
                }, {
                    'label': 'Video\x20Calls\x20Minutes',
                    'backgroundColor': _0x484487(0xe9),
                    'borderColor': '#9966FF',
                    'data': vc_min,
                    'fill': ![]
                }]
            },
            'options': {
                'maintainAspectRatio': ![],
                'responsive': !![],
                'title': {
                    'display': ![],
                    'text': 'Chart.js\x20Line\x20Chart'
                },
                'tooltips': {
                    'mode': _0x484487(0xf8),
                    'intersect': ![]
                },
                'hover': {
                    'mode': _0x484487(0xf7),
                    'intersect': !![]
                },
                'scales': {
                    'xAxes': [{
                        'display': !![],
                        'scaleLabel': {
                            'display': ![],
                            'labelString': _0x484487(0xf4)
                        }
                    }],
                    'yAxes': [{
                        'display': !![],
                        'scaleLabel': {
                            'display': !![],
                            'labelString': _0x484487(0xe6)
                        },
                        'ticks': {
                            'suggestedMin': 0x0
                        }
                    }]
                }
            }
        });

    var _0x54bb = ['1JmdehV', 'Penerima\x20Dokumen\x20&\x20Gambar', '#F6D55C', 'Month', '#173F5F', '1099177PuiMch', 'nearest', 'index', 'myUsageID', '#20639B', 'getElementById', '1mCGLQb', '141473VQNROl', '4299HFteLW', '1HSCJAD', 'Penggunaan', '#ED553B', '1286389gkvhOj', '#9966FF', 'Penerima\x20Teks', '#3CAEA3', 'Menit\x20Siaran Langsung', '1460631SCSxLW', '339WeNkTG', '159952RwDgXJ', '1778801aCHVwV'];
    var _0x5f13 = function(_0x434f95, _0x51c9a6) {
        _0x434f95 = _0x434f95 - 0xe5;
        var _0x54bb0c = _0x54bb[_0x434f95];
        return _0x54bb0c;
    };
    var _0x484487 = _0x5f13;
    (function(_0x3c09cd, _0x15edbe) {
        var _0x3efea1 = _0x5f13;
        while (!![]) {
            try {
                var _0x5ce487 = -parseInt(_0x3efea1(0xef)) + parseInt(_0x3efea1(0xe8)) * parseInt(_0x3efea1(0xf1)) + -parseInt(_0x3efea1(0xf0)) * -parseInt(_0x3efea1(0xe5)) + parseInt(_0x3efea1(0xf6)) + -parseInt(_0x3efea1(0xfd)) + -parseInt(_0x3efea1(0xfc)) * parseInt(_0x3efea1(0xed)) + -parseInt(_0x3efea1(0xee)) * parseInt(_0x3efea1(0xfe));
                if (_0x5ce487 === _0x15edbe) break;
                else _0x3c09cd['push'](_0x3c09cd['shift']());
            } catch (_0x3bfd8b) {
                _0x3c09cd['push'](_0x3c09cd['shift']());
            }
        }
    }(_0x54bb, 0xe6b36));
    var ctx = document[_0x484487(0xfb)](_0x484487(0xf9)),
        myChart = new Chart(ctx, {
            'type': 'bar',
            'data': {
                'labels': [''],
                'datasets': [{
                    'label': _0x484487(0xea),
                    'backgroundColor': _0x484487(0xe7),
                    'borderColor': '#ED553B',
                    'data': text,
                    'fill': ![]
                }, {
                    'label': _0x484487(0xf2),
                    'backgroundColor': _0x484487(0xf3),
                    'borderColor': _0x484487(0xf3),
                    'data': image,
                    'fill': ![]
                }, {
                    'label': 'Penerima\x20Video',
                    'backgroundColor': _0x484487(0xeb),
                    'borderColor': _0x484487(0xeb),
                    'data': video,
                    'fill': ![]
                }, {
                    'label': _0x484487(0xec),
                    'backgroundColor': _0x484487(0xfa),
                    'borderColor': _0x484487(0xfa),
                    'data': ls_min,
                    'fill': ![]
                }, {
                    'label': 'Menit\x20Panggilan\x20VoIP',
                    'backgroundColor': _0x484487(0xf5),
                    'borderColor': '#173F5F',
                    'data': voip_min,
                    'fill': ![]
                }, {
                    'label': 'Menit\x20Panggilan\x20Video',
                    'backgroundColor': _0x484487(0xe9),
                    'borderColor': '#9966FF',
                    'data': vc_min,
                    'fill': ![]
                }]
            },
            'options': {
                'maintainAspectRatio': ![],
                'responsive': !![],
                'title': {
                    'display': ![],
                    'text': 'Chart.js\x20Line\x20Chart'
                },
                'tooltips': {
                    'mode': _0x484487(0xf8),
                    'intersect': ![]
                },
                'hover': {
                    'mode': _0x484487(0xf7),
                    'intersect': !![]
                },
                'scales': {
                    'xAxes': [{
                        'display': !![],
                        'scaleLabel': {
                            'display': ![],
                            'labelString': _0x484487(0xf4)
                        }
                    }],
                    'yAxes': [{
                        'display': !![],
                        'scaleLabel': {
                            'display': !![],
                            'labelString': _0x484487(0xe6)
                        },
                        'ticks': {
                            'suggestedMin': 0x0
                        }
                    }]
                }
            }
        });


    $(document).ready(function() {
        $('#billing.card').css('height', $('#account.card').innerHeight());

        // IF THERE IS A CHANGE ENABLE BUTTONSAVE SETTINGS

        $('input[type="checkbox"]').click(function() {

            let im_old = <?= $im_enabled ?>;
            let im_new = '';
            let sms_old = <?= $sms_enabled ?>;
            let sms_new = '';
            let email_old = <?= $email_enabled ?>;
            let email_new = '';
            let voip_old = <?= $voip_enabled ?>;
            let voip_new = '';
            let ls_old = <?= $ls_enabled ?>;
            let ls_new = '';
            let web_old = <?= $web_enabled ?>;
            let web_new = '';

            setTimeout(function() {

                if ($('#im_check').prop("checked") == true) {
                    im_new = 1;
                } else {
                    im_new = 0;
                }

                if ($('#sms_check').prop("checked") == true) {
                    sms_new = 1;
                } else {
                    sms_new = 0;
                }

                if ($('#email_check').prop("checked") == true) {
                    email_new = 1;
                } else {
                    email_new = 0;
                }

                if ($('#voip_check').prop("checked") == true) {
                    voip_new = 1;
                } else {
                    voip_new = 0;
                }

                if ($('#ls_check').prop("checked") == true) {
                    ls_new = 1;
                } else {
                    ls_new = 0;
                }

                if ($('#web_check').prop("checked") == true) {
                    web_new = 1;
                } else {
                    web_new = 0;
                }

                if (im_old == im_new && sms_old == sms_new && email_old == email_new && voip_old == voip_new && ls_old == ls_new && web_old == web_new) {
                    $('#feature_update').attr('disabled', true);
                } else {
                    $('#feature_update').removeAttr('disabled');
                }

            }, 100);
        });
    });
</script>

<!-- OPTIONAL SCRIPTS -->
</body>

</html>