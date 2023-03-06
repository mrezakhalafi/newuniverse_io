<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/dashboardv2/dashboard_header.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/url_function.php'); ?>
<?php //include_once($_SERVER['DOCUMENT_ROOT'] . '/db_conn.php'); 
?>

<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// state control
$_SESSION['previous_page'] = $_SESSION['current_page'];
$_SESSION['current_page'] = 14;
require_once($_SERVER['DOCUMENT_ROOT'] . '/state_control.php');

function hitAPI($weburl, $logo)
{
    $url = "http://192.168.1.100:8004/webrest/";
    $data = array(
        'code' => 'REGBEM',
        'data' => array(
            'company_id' => $_SESSION['id_company'],
            // 'name' => $cmp_name['COMPANY_NAME'],
            // 'api_key' => $api_key['API_KEY'],
            // 'expire_date' => $exp_date,
            // 'private_key' => $_SESSION['password'],
            // 'is_trial' => $cmp_status['STATUS'],
            'url' => $weburl,
            'logo' => $logo,
        ),

    );

    $options = array(
        'http' => array(
            'header'  =>
            // "Authorization: ".$secretKey."\r\n".
            "Content-type: application/json\r\n",
            'method'  => 'POST',
            'content' => strval(json_encode($data))
        )
    );

    $stream = stream_context_create($options);
    $result = file_get_contents($url, false, $stream);
    $json_result = json_decode($result);
}

function changeTabs()
{
}

// makeAPK($company_web, $company_logo, $app_id, $company_name, $acc, $do_keystore, $app_certificate, $password, $alias, $name, $unit, $org, $city, $state, $code, $tab1, $tab2, $tab3, $tab4, $tab1_icon, $tab2_icon, $tab3_icon, $tab4_icon, $access_model, $fb1_icon, $fb2_icon, $fb3_icon, $fb4_icon, $background, $cpaas_icon, $app_font);
function makeAPK($weburl, $logo, $appid, $compname, $acc, $do_keystore, $keystore, $key_pw, $store_pw, $alias, $common_name, $org_unit, $org_name, $locality, $state_name, $country_code, $content_tab_layout, $tab1, $tab2, $tab3, $tab4, $tab1_icon, $tab2_icon, $tab3_icon, $tab4_icon, $access_model, $fb1_icon, $fb2_icon, $fb3_icon, $fb4_icon, $fb5_icon, $background, $cpaas_icon, $font, $ver_code, $ver_name)
{

    $curl = curl_init();

    $postfields_arr = array();

    if ($do_keystore == 1) {
        if ($keystore == "") {
            $postfields_arr = array(
                //'package_id' => 'com.app.' . $appid, 
                'package_id' => $appid,
                'url' => $weburl,
                'app_name' => $compname,
                'acc' => $acc,
                'logo' => $logo,
                'alias' => $alias,
                'key_password' => $key_pw,
                'store_password' => $store_pw,
                'common_name' => $common_name,
                'organization_unit' => $org_unit,
                'organization_name' => $org_name,
                'locality_name' => $locality,
                'state_name' => $state_name,
                'country' => $country_code
            );
        } else {
            $keystore_path = $_SERVER['DOCUMENT_ROOT'] . '/dashboardv2/uploads/app_certificate/' . $keystore;
            $keystore_curl_file = curl_file_create($keystore_path, pathinfo($keystore_path, PATHINFO_EXTENSION), $keystore);

            $postfields_arr = array(
                //'package_id' => 'com.app.' . $appid, 
                'package_id' => $appid,
                'url' => $weburl,
                'app_name' => $compname,
                'acc' => $acc,
                'logo' => $logo,
                'keystore' => $keystore_curl_file,
                'alias' => $alias,
                'key_password' => $key_pw,
                'store_password' => $store_pw
            );
        }
    } else {
        $postfields_arr = array(
            //'package_id' => 'com.app.' . $appid, 
            'package_id' => $appid,
            'url' => $weburl,
            'app_name' => $compname,
            'logo' => $logo,
            'acc' => $acc,
        );
    }

    $postfields_arr["access_model"] = $access_model;
    // $postfields_arr["active_tabs"] = $active_tabs;
    $postfields_arr["tab3_mode"] = $content_tab_layout;
    $postfields_arr["tab1"] = $tab1;
    $postfields_arr["tab2"] = $tab2;
    $postfields_arr["tab3"] = $tab3;
    $postfields_arr["tab4"] = $tab4;
    $postfields_arr["tab1_icon"] = $tab1_icon;
    $postfields_arr["tab2_icon"] = $tab2_icon;
    $postfields_arr["tab3_icon"] = $tab3_icon;
    $postfields_arr["tab4_icon"] = $tab4_icon;
    $postfields_arr["font"] = $font;
    $postfields_arr["background"] = $background;
    $postfields_arr["logofloat"] = $cpaas_icon;
    $postfields_arr["fb1_icon"] = $fb1_icon;
    $postfields_arr["fb2_icon"] = $fb2_icon;
    $postfields_arr["fb3_icon"] = $fb3_icon;
    $postfields_arr["fb4_icon"] = $fb4_icon;
    $postfields_arr["fb5_icon"] = $fb5_icon;
    $postfields_arr["version_code"] = $ver_code;
    $postfields_arr["version_name"] = $ver_name;

    // echo "<pre>";
    // print_r($postfields_arr);
    // echo "</pre>";

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://id.palio.io:8092/',
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $postfields_arr,
    ));

    $json = curl_exec($curl);
    curl_close($curl);

    $filename = $_SERVER["DOCUMENT_ROOT"] . '/dashboardv2/uploads/' . json_decode($json)->name;
    $filepath = '/dashboardv2/uploads/' . json_decode($json)->name;

    // $filename = $_SERVER["DOCUMENT_ROOT"] . '/dashboardv2/uploads/apk.zip';
    // $filepath = '/dashboardv2/uploads/apk.zip';

    // ini_set('memory_limit', '-1');
    do {
        if (file_exists($filename)) {
            if (ob_get_level()) ob_end_clean();
            header('Content-Description: File Transfer');
            header('Content-Type: application/force-download');
            header("Content-Disposition: attachment; filename=\"" . basename($filename) . "\";");
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filename));
            // ob_clean();
            flush();
            readfile($filename); //showing the path to the server where the file is to be download
            // echo '<a href="'.$filepath.'"></a>';
            redirect('/dashboardv2/index.php');
            exit;
            break;
        }
    } while (!file_exists($filename));

    // sleep(60);
    // curl_exec($curl);
    // curl_close($curl);
    // fflush($fp);
    // fclose($fp);

    // if (file_exists($filename)) {
    //     header('Content-Description: File Transfer');
    //     header('Content-Type: application/octet-stream');
    //     header('Content-Disposition: attachment; filename="' . basename($filename) . '"');
    //     header('Expires: 0');
    //     header('Cache-Control: must-revalidate');
    //     header('Pragma: public');
    //     header('Content-Length: ' . filesize($filename));
    //     readfile($filename);
    //     exit;
    // }
}

$session_company = $_SESSION['id_company'];

$dbConnPalio = dbConnPalioLite();

$query_one = $dbconn->prepare("SELECT wf.WEB_URL, wf.VERSION_CODE FROM WEBFORM wf WHERE wf.COMPANY_ID = " . $session_company . "
ORDER BY CREATED_AT DESC LIMIT 1");
$query_one->execute();
$query_one_result = $query_one->get_result()->fetch_assoc();
$query_one->close();

$ver_code = 1;

// $ver_code = $query_one_result["VERSION_CODE"];

if ($query_one_result['WEB_URL'] == null) {
    $webURL = "";
} else {
    $webURL = $query_one_result["WEB_URL"];
    $ver_code = intval($query_one_result["VERSION_CODE"]);
}

if (isset($_POST['submit'])) {

    $dbconn = getDBConn();

    $email = $_SESSION['email'];
    $id_user = $_SESSION['id_user'];
    $id_company = $_SESSION['id_company'];

    $company_web = $_POST['company-website'];
    $company_web = preg_replace('#^https?://#', '', rtrim($company_web, '/'));
    $generate_apk = $_POST['generate-apk']; // check if user want to generate apk
    $alias_existing = $_POST['inputAlias-existing'];
    $keypassword_existing = $_POST['keyPassword-existing'];
    $storepassword_existing = $_POST['storePassword-existing'];

    $query_dua = $dbconn->prepare("SELECT API_KEY FROM COMPANY WHERE ID = ?");
    $query_dua->bind_param("i", $_SESSION['id_company']);
    $query_dua->execute();
    $api_key = $query_dua->get_result()->fetch_assoc();
    $query_dua->close();

    $acc = $api_key['API_KEY'];
    

    $company_name = $_POST['company-name'];
    $app_id = $_POST['app-id'];

    // get company logo
    $query = $dbconn->prepare("SELECT * FROM COMPANY_INFO WHERE COMPANY = '$id_company'");
    $query->execute();
    $res = $query->get_result()->fetch_assoc();
    $company_logo = $res["COMPANY_LOGO"];
    $query->close();

    // set new URL homepage prefs table
    // get BE ID using company ID
    $query = $dbConnPalio->prepare("SELECT ID FROM BUSINESS_ENTITY WHERE COMPANY_ID = '$id_company'");
    $query->execute();
    $res = $query->get_result()->fetch_assoc();
    $be_id = $res["ID"];
    $query->close();

    $sqlInsertURL = "
    INSERT INTO PREFS (`BE`, `KEY`, `VALUE`) 
    VALUES 
    (
        $be_id, 
        'app_builder_url_first_tab', 
        '$company_web'
    ) ON DUPLICATE KEY 
    UPDATE 
    `VALUE` = '$company_web'
    ";

    $query = $dbConnPalio->prepare($sqlInsertURL);
    $query->execute();
    $query->close();

    if ($generate_apk != 1) {
        // insert into webform table
        $query = $dbconn->prepare("REPLACE INTO WEBFORM (EMAIL, USER_ID, COMPANY_ID, WEB_URL) VALUES (?,?,?,?)");
        $query->bind_param("siis", $email, $id_user, $id_company, $company_web);
        $query->execute();
        $query->close();

        // hitAPI($company_web, '');
        // redirect(base_url() . 'dashboardv2/');
    }

    // echo '<a href="/dashboardv2/uploads/app_certificate/palioBrowser.keystore"></a>';
    // header("/dashboardv2/uploads/fb_icon/392_02.png");
    // header('Content-disposition: attachment; filename="/dashboardv2/uploads/fb_icon/392_02.png"');
    // echo $sqlInsertURL;
    // $connection = ssh2_connect('192.168.1.100', 2309);
    // ssh2_auth_password($connection, 'easysoft', '*347e^!VU4y+#hAP');

    // $ssh_local_file = '/var/www/html/palio.io/dashboardv2/uploads/logo/' . $company_logo;
    // ssh2_scp_send($connection, $ssh_local_file, '/apps/lcs/paliolite/server/image/' . $company_logo, 0777);

    // check if user want to generate certif
    // 0 = default cert
    // 1 = upload cert
    // 2 = new cert
    $generate_certif = $_POST['check-certif'];

    $do_keystore = 0;
    $app_certificate = "";
    $password = "";
    $alias = "";
    $name = "";
    $unit = "";
    $org = "";
    $city = "";
    $state = "";
    $code = "";


    if (isset($_POST['check-certif'])) {
        if ($company_logo != null) {
            $sql = "REPLACE INTO WEBFORM (EMAIL, USER_ID, COMPANY_ID, WEB_URL, GENERATE_APK, COMPANY_NAME, APP_ID, COMPANY_LOGO";

            if ($generate_certif == 1) {
                // save file in db
                if (move_uploaded_file($_FILES['app-certificate']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/dashboardv2/uploads/app_certificate/' . $_FILES['app-certificate']['name'])) {
                    $app_certificate = $_FILES['app-certificate']['name'];


                    // insert into webform table
                    // $query = $dbconn->prepare("REPLACE INTO WEBFORM (EMAIL, USER_ID, COMPANY_ID, WEB_URL, GENERATE_APK, COMPANY_NAME, APP_ID, COMPANY_LOGO, APP_CERTIFICATE, ALIAS, PASSWORD) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
                    // $query->bind_param("siisissssss", $email, $id_user, $id_company, $company_web, $generate_apk, $company_name, $app_id, $company_logo, $app_certificate, $alias_existing, md5($password_existing));

                    $sql .= ", APP_CERTIFICATE, ALIAS, KEY_PASSWORD, STORE_PASSWORD";

                    // do makeAPK
                    // makeAPK($company_web, $company_logo, $app_id, $company_name, $acc, 1, $app_certificate, $password_existing, $alias_existing, "", "", "", "", "", "");
                    $do_keystore = 1;
                    $key_password = $keypassword_existing;
                    $store_password = $storepassword_existing;
                    $alias = $alias_existing;
                }
            } else if ($generate_certif == 2) {

                // insert into webform table
                $inputAlias = $_POST['inputAlias'];
                $keyPassword = $_POST['keyPassword'];
                $storePassword = $_POST['storePassword'];
                $inputValidity = $_POST['inputValidity'];
                $inputName = $_POST['inputName'];
                $inputUnit = $_POST['inputUnit'];
                $inputOrg = $_POST['inputOrg'];
                $inputCity = $_POST['inputCity'];
                $inputState = $_POST['inputState'];
                $inputCode = $_POST['inputCode'];

                // insert into webform table
                // $query = $dbconn->prepare("REPLACE INTO WEBFORM (EMAIL, USER_ID, COMPANY_ID, WEB_URL, GENERATE_APK, COMPANY_NAME, APP_ID, COMPANY_LOGO, APP_CERTIFICATE, NEW_CERTIFICATE, ALIAS, PASSWORD, VALIDITY, FULL_NAME, ORGANIZATIONAL_UNIT, ORGANIZATION, CITY, STATE, COUNTRY_CODE) VALUES ('$email', '$id_user', '$id_company', '$company_web', $generate_apk, '$company_name', '$app_id', '$company_logo', '', $generate_certif, '$inputAlias', '$inputPassword', $inputValidity, '$inputName', '$inputUnit', '$inputOrg', '$inputCity', '$inputState', '$inputCode')");

                $sql .= ", APP_CERTIFICATE, NEW_CERTIFICATE, ALIAS, KEY_PASSWORD, STORE_PASSWORD, VALIDITY, FULL_NAME, ORGANIZATIONAL_UNIT, ORGANIZATION, CITY, STATE, COUNTRY_CODE";

                // do makeAPK
                // makeAPK($company_web, $company_logo, $app_id, $company_name, $acc, 1, "", $inputPassword, $inputAlias, $inputName, $inputUnit, $inputOrg, $inputCity, $inputState, $inputCode);

                $do_keystore = 1;
                $key_password = $keyPassword;
                $store_password = $storePassword;
                $alias = $inputAlias;
                $name = $inputName;
                $unit = $inputUnit;
                $org = $inputOrg;
                $city = $inputCity;
                $state = $inputState;
                $code = $inputCode;
            } else if ($generate_certif == 0) {
                // $query = $dbconn->prepare("REPLACE INTO WEBFORM (EMAIL, USER_ID, COMPANY_ID, WEB_URL, GENERATE_APK, COMPANY_NAME, APP_ID, COMPANY_LOGO) VALUES (?,?,?,?,?,?,?,?)");
                // $query->bind_param("siisisss", $email, $id_user, $id_company, $company_web, $generate_apk, $company_name, $app_id, $company_logo);
                // makeAPK($company_web, $company_logo, $app_id, $company_name, $acc, 0, "", "", "", "", "", "", "", "", "");

            }

            $active_tabs = 0;

            // $tab1_active = isset($_POST['tab1_active']) && $_POST['tab1_active'] == 1;
            // $tab2_active = isset($_POST['tab2_active']) && $_POST['tab2_active'] == 1;
            // $tab3_active = isset($_POST['tab3_active']) && $_POST['tab3_active'] == 1;
            // $tab4_active = isset($_POST['tab4_active']) && $_POST['tab4_active'] == 1;

            // if ($tab1_active == true) {
            //     $active_tabs++;
            // }
            // if ($tab2_active == true) {
            //     $active_tabs++;
            // }
            // if ($tab3_active == true) {
            //     $active_tabs++;
            // }
            // if ($tab4_active == true) {
            //     $active_tabs++;
            // }

            // $sql .= ", ACTIVE_TABS";

            $tab1 = "";
            $tab2 = "";
            $tab3 = "";
            $tab4 = "";

            $content_tab_layout = 0;

            $tab1_icon = "";
            $tab2_icon = "";
            $tab3_icon = "";
            $tab4_icon = "";

            $fb1_icon = "";
            $fb2_icon = "";
            $fb3_icon = "";
            $fb4_icon = "";
            $fb5_icon = "";

            $access_model = 0;

            $background = "";

            $cpaas_icon = "";
            $app_font = 0;

            $ver_name = "";
            $ver_code = $ver_code + 1;

            // content tab layout
            if (isset($_POST['content_tab_layout'])) {
                $content_tab_layout = $_POST['content_tab_layout'];
                $sql .= ", CONTENT_TAB_LAYOUT";
            }

            // check tab order
            if (isset($_POST['tab1']) && trim($_POST['tab1']) !== "") {
                $tab1 = $_POST['tab1'];
                $sql .= ", TAB1";
            }
            if (isset($_POST['tab2']) && trim($_POST['tab2']) !== "") {
                $tab2 = $_POST['tab2'];
                $sql .= ", TAB2";
            }
            if (isset($_POST['tab3']) && trim($_POST['tab3']) !== "") {
                $tab3 = $_POST['tab3'];
                $sql .= ", TAB3";
            }
            if (isset($_POST['tab1']) && trim($_POST['tab4']) !== "") {
                $tab4 = $_POST['tab4'];
                $sql .= ", TAB4";
            }

            // check tab icon
            if (isset($_FILES['tab1_icon']) && $_FILES['tab1_icon']['size'] != 0) {
                // No file was selected for upload, your (re)action goes here
                if (move_uploaded_file($_FILES['tab1_icon']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/dashboardv2/uploads/tab_icon/' . $id_company . '_' . $_FILES['tab1_icon']['name'])) {
                    $sql .= ", TAB1_ICON";
                    $tab1_icon = $id_company . '_' . $_FILES['tab1_icon']['name'];
                }
            }
            if (isset($_FILES['tab2_icon']) && $_FILES['tab2_icon']['size'] != 0) {
                // No file was selected for upload, your (re)action goes here
                if (move_uploaded_file($_FILES['tab2_icon']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/dashboardv2/uploads/tab_icon/' . $id_company . '_' . $_FILES['tab2_icon']['name'])) {
                    $sql .= ", TAB2_ICON";
                    $tab2_icon = $id_company . '_' . $_FILES['tab2_icon']['name'];
                }
            }
            if (isset($_FILES['tab3_icon']) && $_FILES['tab3_icon']['size'] != 0) {
                // No file was selected for upload, your (re)action goes here
                if (move_uploaded_file($_FILES['tab3_icon']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/dashboardv2/uploads/tab_icon/' . $id_company . '_' . $_FILES['tab3_icon']['name'])) {
                    $sql .= ", TAB3_ICON";
                    $tab3_icon = $id_company . '_' . $_FILES['tab3_icon']['name'];
                }
            }
            if (isset($_FILES['tab4_icon']) && $_FILES['tab4_icon']['size'] != 0) {
                // No file was selected for upload, your (re)action goes here
                if (move_uploaded_file($_FILES['tab4_icon']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/dashboardv2/uploads/tab_icon/' . $id_company . '_' . $_FILES['tab4_icon']['name'])) {
                    $sql .= ", TAB4_ICON";
                    $tab4_icon = $id_company . '_' . $_FILES['tab4_icon']['name'];
                }
            }

            if (isset($_POST['access_model'])) {
                $access_model = intval($_POST['access_model']);
                $sql .= ", ACCESS_MODEL";
            }

            // fb icon
            if ($_FILES['fb1_icon']['size'] != 0) {
                // No file was selected for upload, your (re)action goes here
                if (move_uploaded_file($_FILES['fb1_icon']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/dashboardv2/uploads/fb_icon/' . $id_company . '_' . $_FILES['fb1_icon']['name'])) {
                    $sql .= ", FBUTTON1";
                    $fb1_icon = $id_company . '_' . $_FILES['fb1_icon']['name'];
                }
            }
            if ($_FILES['fb2_icon']['size'] != 0) {
                // No file was selected for upload, your (re)action goes here
                if (move_uploaded_file($_FILES['fb2_icon']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/dashboardv2/uploads/fb_icon/' . $id_company . '_' . $_FILES['fb2_icon']['name'])) {
                    $sql .= ", FBUTTON2";
                    $fb2_icon = $id_company . '_' . $_FILES['fb2_icon']['name'];
                }
            }
            if ($_FILES['fb3_icon']['size'] != 0) {
                // No file was selected for upload, your (re)action goes here
                if (move_uploaded_file($_FILES['fb3_icon']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/dashboardv2/uploads/fb_icon/' . $id_company . '_' . $_FILES['fb3_icon']['name'])) {
                    $sql .= ", FBUTTON3";
                    $fb3_icon = $id_company . '_' . $_FILES['fb3_icon']['name'];
                }
            }
            if ($_FILES['fb4_icon']['size'] != 0) {
                // No file was selected for upload, your (re)action goes here
                if (move_uploaded_file($_FILES['fb4_icon']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/dashboardv2/uploads/fb_icon/' . $id_company . '_' . $_FILES['fb4_icon']['name'])) {
                    $sql .= ", FBUTTON4";
                    $fb4_icon = $id_company . '_' . $_FILES['fb4_icon']['name'];
                }
            }
            if ($_FILES['fb5_icon']['size'] != 0) {
                // No file was selected for upload, your (re)action goes here
                if (move_uploaded_file($_FILES['fb5_icon']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/dashboardv2/uploads/fb_icon/' . $id_company . '_' . $_FILES['fb5_icon']['name'])) {
                    $sql .= ", FBUTTON5";
                    $fb4_icon = $id_company . '_' . $_FILES['fb5_icon']['name'];
                }
            }

            // if ($_FILES['background']['size'] != 0) {
            //     if (move_uploaded_file($_FILES['background']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/dashboardv2/uploads/background/' . $id_company . '_' . $_FILES['background']['name'])) {
            //         $background = $id_company . '_' . $_FILES['background']['name'];
            //         $sql .= ", APP_BG";
            //     }
            // }
            $jumlahFile = count($_FILES['background']['name']);

            if ($jumlahFile > 0) {
                $folderUpload = $_SERVER['DOCUMENT_ROOT'] . '/dashboardv2/uploads/background';
                $list_bg = "";
                for ($i = 0; $i < $jumlahFile; $i++) {
                    $namaFile = $_FILES['background']['name'][$i];
                    $lokasiTmp = $_FILES['background']['tmp_name'][$i];

                    # kita tambahkan uniqid() agar nama gambar bersifat unik
                    $namaBaru = $id_company . '_' . $namaFile;
                    $lokasiBaru = "{$folderUpload}/{$namaBaru}";
                    if (move_uploaded_file($lokasiTmp, $lokasiBaru)) {
                        if ($i > 0) {
                            $list_bg .= "," . $namaBaru;
                        } else {
                            $list_bg .= $namaBaru;
                        }
                    }
                }
                $background = $list_bg;
                $sql .= ", APP_BG";
            }

            if ($_FILES['cpaas_icon']['size'] != 0) {
                if (move_uploaded_file($_FILES['cpaas_icon']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/dashboardv2/uploads/logofloat/' . $id_company . '_' . $_FILES['cpaas_icon']['name'])) {
                    $cpaas_icon = $id_company . '_' . $_FILES['cpaas_icon']['name'];
                    $sql .= ", CPAAS_ICON";
                }
            }

            if (isset($_POST['app_font'])) {
                $app_font = intval($_POST['app_font']);
                $sql .= ", FONT";
            }

            if (isset($_POST['ver_name']) && $_POST['ver_name'] != "") {
                $ver_name = $_POST['ver_name'];
                $sql .= ", VERSION_NAME, VERSION_CODE";
            }

            $sql .= ") VALUES (";

            if ($generate_certif == 0) {
                // nothing
                $sql .= "'$email', '$id_user', '$id_company', '$company_web', '$generate_apk', '$company_name', '$app_id', '$company_logo'";
            } else if ($generate_certif == 1) {
                $sql .= "'$email', '$id_user', '$id_company', '$company_web', '$generate_apk', '$company_name', '$app_id', '$company_logo', '$app_certificate', '$alias_existing', '" . md5($keypassword_existing) . "', '" . md5($storepassword_existing) . "'";
            } else if ($generate_certif == 2) {
                $sql .= "'$email', '$id_user', '$id_company', '$company_web', $generate_apk, '$company_name', '$app_id', '$company_logo', '', $generate_certif, '$inputAlias', '" . md5($key_password) . "','" . md5($store_password) . "', $inputValidity, '$inputName', '$inputUnit', '$inputOrg', '$inputCity', '$inputState', '$inputCode'";
            }

            // $sql .= ", $active_tabs";

            if (isset($_POST['content_tab_layout'])) {
                $sql .= ", $content_tab_layout";
            }

            if (isset($_POST['tab1']) && trim($_POST['tab1']) !== "") {
                $sql .= ", '$tab1'";
            }
            if (isset($_POST['tab2']) && trim($_POST['tab2']) !== "") {
                $sql .= ", '$tab2'";
            }
            if (isset($_POST['tab3']) && trim($_POST['tab3']) !== "") {
                $sql .= ", '$tab3'";
            }
            if (isset($_POST['tab1']) && trim($_POST['tab4']) !== "") {
                $sql .= ", '$tab4'";
            }

            // check tab icon
            if (isset($_FILES['tab1_icon']) && $_FILES['tab1_icon']['size'] != 0) {
                // No file was selected for upload, your (re)action goes here
                $tab1_icon = $id_company . '_' . $_FILES['tab1_icon']['name'];
                $sql .= ", '$tab1_icon'";
            }
            if (isset($_FILES['tab2_icon']) && $_FILES['tab2_icon']['size'] != 0) {
                // No file was selected for upload, your (re)action goes here
                $tab2_icon = $id_company . '_' . $_FILES['tab2_icon']['name'];
                $sql .= ", '$tab2_icon'";
            }
            if (isset($_FILES['tab3_icon']) && $_FILES['tab3_icon']['size'] != 0) {
                // No file was selected for upload, your (re)action goes here
                $tab3_icon = $id_company . '_' . $_FILES['tab3_icon']['name'];
                $sql .= ", '$tab3_icon'";
            }
            if (isset($_FILES['tab4_icon']) && $_FILES['tab4_icon']['size'] != 0) {
                // No file was selected for upload, your (re)action goes here
                $tab4_icon = $id_company . '_' . $_FILES['tab4_icon']['name'];
                $sql .= ", '$tab4_icon'";
            }

            if (isset($_POST['access_model'])) {
                $sql .= ", '$access_model'";
            }

            if ($_FILES['fb1_icon']['size'] != 0) {
                // No file was selected for upload, your (re)action goes here
                $fb1_icon = $id_company . '_' . $_FILES['fb1_icon']['name'];
                $sql .= ", '$fb1_icon'";
            }
            if ($_FILES['fb2_icon']['size'] != 0) {
                // No file was selected for upload, your (re)action goes here
                $fb2_icon = $id_company . '_' . $_FILES['fb2_icon']['name'];
                $sql .= ", '$fb2_icon'";
            }
            if ($_FILES['fb3_icon']['size'] != 0) {
                // No file was selected for upload, your (re)action goes here
                $fb3_icon = $id_company . '_' . $_FILES['fb3_icon']['name'];
                $sql .= ", '$fb3_icon'";
            }
            if ($_FILES['fb4_icon']['size'] != 0) {
                // No file was selected for upload, your (re)action goes here
                $fb4_icon = $id_company . '_' . $_FILES['fb4_icon']['name'];
                $sql .= ", '$fb4_icon'";
            }
            if ($_FILES['fb5_icon']['size'] != 0) {
                // No file was selected for upload, your (re)action goes here
                $fb5_icon = $id_company . '_' . $_FILES['fb5_icon']['name'];
                $sql .= ", '$fb5_icon'";
            }

            if ($_FILES['background']['size'] != 0) {
                $sql .= ", '$background'";
            }

            if ($_FILES['cpaas_icon']['size'] != 0) {
                $sql .= ", '$cpaas_icon'";
            }

            if (isset($_POST['app_font'])) {
                $sql .= ", '$app_font'";
            }

            if (isset($_POST['ver_name']) && $_POST['ver_name'] != "") {
                $sql .= ", '$ver_name', $ver_code";
            }

            $sql .= ")";

            // echo $sql;
            // echo "<pre>";
            // echo print_r($_POST);
            // echo "</pre>";
            $query = $dbconn->prepare($sql);
            $query->execute();
            $query->close();

            // echo 'fb1:' . $fb1_icon;
            // echo '<br>';
            // echo 'fb2:' . $fb2_icon;
            // echo '<br>';
            // echo 'fb3:' . $fb3_icon;
            // echo '<br>';
            // echo 'fb4:' . $fb4_icon;
            // echo '<br>';


            // function makeAPK($weburl, $logo, $appid, $compname, $acc, $do_keystore, $keystore, $pw, $alias, $common_name, $org_unit, $org_name, $locality, $state_name, $country_code, $tab1, $tab2, $tab3, $tab4, $tab1_icon, $tab2_icon, $tab3_icon, $tab4_icon, $access_model, $background)
            // hitAPI($company_web, $company_logo);
            makeAPK($company_web, $company_logo, $app_id, $company_name, $acc, $do_keystore, $app_certificate, $key_password, $store_password, $alias, $name, $unit, $org, $city, $state, $code, $content_tab_layout, $tab1, $tab2, $tab3, $tab4, $tab1_icon, $tab2_icon, $tab3_icon, $tab4_icon, $access_model, $fb1_icon, $fb2_icon, $fb3_icon, $fb4_icon, $fb5_icon, $background, $cpaas_icon, $app_font, $ver_code, $ver_name);
            // redirect(base_url() . 'dashboardv2/index.php');
        } else {
            echo '<script>alert("Please upload your company logo first via the Overview page.");</script>';
        }
    }
}



?>

<!-- Pretify -->
<script type="text/javascript" src="<?php echo base_url(); ?>js/prettify.js"></script>

<style>
    @media screen and (min-width:768px) {
        #search-ticket {
            float: right;
        }
    }

    @media screen and (max-width: 600px) {
        iframe[src*=youtube] {
            display: block;
            margin: 0 auto;
            height: auto;
            max-width: 100%;
            padding-bottom: 10px;
        }
    }

    /* THEME FOR PRETTIFY/*
/* Pretty printing styles. Used with prettify.js. */
    /* Vim sunburst theme by David Leibovic */

    pre .str,
    code .str {
        color: #65B042;
    }

    /* string  - green */
    pre .kwd,
    code .kwd {
        color: #E28964;
    }

    /* keyword - dark pink */
    pre .com,
    code .com {
        color: #AEAEAE;
        font-style: italic;
    }

    /* comment - gray */
    pre .typ,
    code .typ {
        color: #89bdff;
    }

    /* type - light blue */
    pre .lit,
    code .lit {
        color: #3387CC;
    }

    /* literal - blue */
    pre .pun,
    code .pun {
        color: #fff;
    }

    /* punctuation - white */
    pre .pln,
    code .pln {
        color: #fff;
    }

    /* plaintext - white */
    pre .tag,
    code .tag {
        color: #89bdff;
    }

    /* html/xml tag    - light blue */
    pre .atn,
    code .atn {
        color: #bdb76b;
    }

    /* html/xml attribute name  - khaki */
    pre .atv,
    code .atv {
        color: #65B042;
    }

    /* html/xml attribute value - green */
    pre .dec,
    code .dec {
        color: #3387CC;
    }

    /* decimal - blue */

    pre.prettyprint,
    code.prettyprint {
        background-color: #333;
    }

    pre.prettyprint {
        width: 100%;
        margin: 0 auto;
        padding: 1em;
        white-space: pre-wrap;
    }


    /* Specify class=linenums on a pre to get line numbering */
    ol.linenums {
        margin-top: 0;
        margin-bottom: 0;
        color: #AEAEAE;
    }

    /* IE indents via margin-left */
    /*li.L0,li.L1,li.L2,li.L3,li.L5,li.L6,li.L7,li.L8 { list-style-type: none; }*/
    li.L0,
    li.L1,
    li.L2,
    li.L3,
    li.L5,
    li.L6,
    li.L7,
    li.L8 {
        list-style-type: decimal;
    }

    /* Alternate shading for lines */
    /*li.L1,li.L3,li.L5,li.L7,li.L9 { background: #eee; }*/

    @media print {

        pre .str,
        code .str {
            color: #060;
        }

        pre .kwd,
        code .kwd {
            color: #006;
            font-weight: bold;
        }

        pre .com,
        code .com {
            color: #600;
            font-style: italic;
        }

        pre .typ,
        code .typ {
            color: #404;
            font-weight: bold;
        }

        pre .lit,
        code .lit {
            color: #044;
        }

        pre .pun,
        code .pun {
            color: #440;
        }

        pre .pln,
        code .pln {
            color: #000;
        }

        pre .tag,
        code .tag {
            color: #006;
            font-weight: bold;
        }

        pre .atn,
        code .atn {
            color: #404;
        }

        pre .atv,
        code .atv {
            color: #060;
        }
    }

    @media (min-width: 1200px) {
        .content-wrapper>.content>.container-fluid {
            padding: 0 5rem 0 3.5rem;
        }

        #generate-apk-form>.row>.col-md-6.left,
        .left {
            padding-right: 3rem;
        }

        #generate-apk-form>.row>.col-md-6.right,
        .right {
            padding-left: 3rem;
        }
    }

    .card {
        padding: 2.25rem;
    }

    .card-body {
        padding: 0;
    }

    .col-form-label {
        font-size: .8rem;
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
    }

    /* On mouse-over, add a grey background color */
    .genapkcheckbox:hover input~.checkmark {
        background-color: #FA9E57;
    }

    /* When the checkbox is checked, add a blue background */
    .genapkcheckbox input:checked~.checkmark {
        background-color: #FA9E57;
    }

    /* Create the checkmark/indicator (hidden when not checked) */
    .checkmark:after {
        content: "";
        position: absolute;
        display: none;
    }

    /* Show the checkmark when checked */
    .genapkcheckbox input:checked~.checkmark:after {
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

    .radio-item {
        display: inline-block;
        position: relative;
        padding: 0 6px;
        margin: 10px 0 0;
    }

    .radio-item input[type='radio'] {
        display: none;
    }

    .radio-item label:before {
        content: " ";
        display: inline-block;
        position: relative;
        top: 5px;
        margin: 0 5px 0 0;
        width: 20px;
        height: 20px;
        border-radius: 11px;
        border: 1px solid black;
        background-color: transparent;
    }

    .radio-item input[type=radio]:checked+label:after {
        border-radius: 11px;
        width: 12px;
        height: 12px;
        position: absolute;
        top: 9px;
        left: 10px;
        content: " ";
        display: block;
        background: #FA9E57;
    }
</style>

<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>

<style>
    body {
        font-family: 'Poppins', sans-serif;
    }
</style>

<div class="content-wrapper" id="support-wrapper">
    <div class="content">
        <div class="container-fluid">
            <form method="POST" id="submit_form" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-12 col-xl-12">

                        <div class="card" id="create-ticket">
                            <h4 class="card-name">WebApp Form</h4>
                            <div class="card-body">
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <h6><strong>NEXILIS FLOATING BUTTON</strong></h6>
                                        <p>To embed nexilis Floating Button to your website, please register your website address in the form below first.<br>
                                            <!-- <span>Note: No protocol (<strong>http://</strong> or <strong>https://</strong>) needed</span> -->
                                        </p>
                                        <input type="textarea" id="companyWebsite" class="form-control mb-3" name="company-website" placeholder="Website URL" required value="<?php echo $webURL; ?>">

                                        <p>Once you have registered your website, add the following line to the <strong>&lt;head&gt;</strong> section of any web page you want to embed the floating button to.</p>

                                        <pre class="prettyprint linenums:1 mt-2 mb-4" style="color:lightgray;">
&lt;script src="https://id.palio.io/palio_button/embeddedbutton.js"&gt;&lt;/script&gt;</pre>

                                        <p>Example:</p>

                                        <pre class="prettyprint linenums:1 mt-2 mb-4" style="color:lightgray;">
&lt;!DOCTYPE html&gt;
&lt;html&gt;
    &lt;head&gt;
        &lt;!-- ... your HTML code here --&gt;

        &lt;!-- If you're using JQuery, make sure to add nexilis Floating Button after it's called --&gt;
        &lt;script src="https://id.palio.io/palio_button/embeddedbutton.js"&gt;&lt;/script&gt;
    &lt;/head&gt;
    &lt;body&gt;
        &lt;!-- ... your HTML code here --&gt;
    &lt;/body&gt;
&lt;/html&gt;
                                        </pre>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <label class="genapkcheckbox" for="generate-apk"> I want to generate apk
                                            <input onclick="generateApk();" type="checkbox" id="generate-apk" name="generate-apk" value="1">
                                            <span class="checkmark"></span>
                                        </label><br>
                                    </div>
                                </div>

                                <div id="generate-apk-form">
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <p style="font-size:.85rem;">Please make sure you have uploaded a company logo at the dashboard's <a href="/dashboardv2/index">main page</a>.</p>
                                        </div>
                                    </div>

                                    <div class="row mb-5">
                                        <div class="col-sm-12 col-md-6 left">
                                            <label for="companyName">Your company name :</label>
                                            <input type="textarea" id="companyName" class="form-control" name="company-name" placeholder="Company Name">
                                        </div>
                                        <div class="col-sm-12 col-md-6 right">
                                            <label for="appId">Your app id :</label>
                                            <input type="textarea" id="appId" class="form-control" name="app-id" placeholder="App Id">
                                        </div>
                                    </div>

                                    <h6><strong>APK Settings</strong></h6>

                                    <div class="row mt-3">
                                        <div class="col-md-12">
                                            <p style="font-size:.85rem;">
                                                In this section you can change the content of tabs and change tab icons. Nexilis default tab icons will be used if you don't upload a custom icon.
                                                <br>
                                                <strong>Note:</strong> You can't select the same option for different tabs.
                                            </p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <!-- <div class="col-sm-1">
                                            <label class="genapkcheckbox d-flex align-items-center" for="tab1-active">
                                                <input type="checkbox" id="tab1-active" name="tab1_active" value="1" checked>
                                                <span class="checkmark"></span>
                                            </label>
                                        </div> -->

                                        <label class="col-sm-2 col-form-label" for="tab1">Tab 1 content :</label>

                                        <div class="col-sm-4">
                                            <select id="tab1" class="form-control tab-content" name="tab1" onchange="checkOpt(this.id);">
                                                <option value="1" selected>Home Page</option>
                                                <option value="2">Chats & Groups</option>
                                                <option value="3">Content Posting</option>
                                                <option value="4">Settings & User Profile</option>
                                                <option value="">Unused</option>
                                            </select>
                                        </div>
                                        <label class="col-sm-2 col-form-label" for="tab1_icon">Home Page icon :</label>

                                        <div class="col-sm-4">
                                            <input type="file" id="tab1_icon" class="form-control" name="tab1_icon">
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <!-- <div class="col-sm-1">
                                            <label class="genapkcheckbox d-flex align-items-center" for="tab2-active">
                                                <input type="checkbox" id="tab2-active" name="tab2_active" value="1" checked>
                                                <span class="checkmark"></span>
                                            </label>
                                        </div> -->
                                        <label class="col-sm-2 col-form-label" for="tab2">Tab 2 content :</label>

                                        <div class="col-sm-4">
                                            <select id="tab2" class="form-control tab-content" name="tab2" onchange="checkOpt(this.id);">
                                                <option value="1">Home Page</option>
                                                <option value="2" selected>Chats & Groups</option>
                                                <option value="3">Content Posting</option>
                                                <option value="4">Settings & User Profile</option>
                                                <option value="">Unused</option>
                                            </select>
                                        </div>
                                        <label class="col-sm-2 col-form-label" for="tab2_icon">Chats & Groups icon :</label>

                                        <div class="col-sm-4">
                                            <input type="file" id="tab2_icon" class="form-control" name="tab2_icon">
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <!-- <div class="col-sm-1">
                                            <label class="genapkcheckbox d-flex align-items-center" for="tab3-active">
                                                <input type="checkbox" id="tab3-active" name="tab3_active" value="1" checked>
                                                <span class="checkmark"></span>
                                            </label>
                                        </div> -->
                                        <label class="col-sm-2 col-form-label" for="tab3">Tab 3 content :</label>

                                        <div class="col-sm-4">
                                            <select id="tab3" class="form-control tab-content" name="tab3" onchange="checkOpt(this.id);">
                                                <option value="1">Home Page</option>
                                                <option value="2">Chats & Groups</option>
                                                <option value="3" selected>Content Posting</option>
                                                <option value="4">Settings & User Profile</option>
                                                <option value="">Unused</option>
                                            </select>
                                        </div>
                                        <label class="col-sm-2 col-form-label" for="tab3_icon">Content Posting icon :</label>

                                        <div class="col-sm-4">
                                            <input type="file" id="tab3_icon" class="form-control" name="tab3_icon">
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <!-- <div class="col-sm-1">
                                            <label class="genapkcheckbox d-flex align-items-center" for="tab4-active">
                                                <input type="checkbox" id="tab4-active" name="tab4_active" value="1" checked>
                                                <span class="checkmark"></span>
                                            </label>
                                        </div> -->
                                        <label class="col-sm-2 col-form-label" for="tab4">Tab 4 content :</label>

                                        <div class="col-sm-4">
                                            <select id="tab4" class="form-control tab-content" name="tab4" onchange="checkOpt(this.id);">
                                                <option value="1">Home Page</option>
                                                <option value="2">Chats & Groups</option>
                                                <option value="3">Content Posting</option>
                                                <option value="4" selected>Settings & User Profile</option>
                                                <option value="">Unused</option>
                                            </select>
                                        </div>
                                        <label class="col-sm-2 col-form-label" for="tab4_icon">Settings & User Profile icon :</label>

                                        <div class="col-sm-4">
                                            <input type="file" id="tab4_icon" class="form-control" name="tab4_icon">
                                        </div>
                                    </div>
                                    <div class="row mt-5">
                                        <div class="col-md-12">
                                            <p style="font-size:.85rem;">
                                                Select the view layout for Home Page.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-2 col-form-label" for="content-tab-layout">Content layout :</label>

                                        <div class="col-sm-4">
                                            <!-- <input type="file" id="tab3_icon" class="form-control" name="tab3_icon"> -->
                                            <select class="form-control" name="content_tab_layout" id="content-tab-layout">
                                                <option value="0" selected>Rows only</option>
                                                <option value="1">Grid</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mt-5">
                                        <div class="col-md-12">
                                            <p style="font-size:.85rem;">
                                                <strong>Access model</strong> setting allows you to change how you can access CPaaS features.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-2 col-form-label" for="access_model">Access model :</label>

                                        <div class="col-sm-4">
                                            <!-- <input type="file" id="tab3_icon" class="form-control" name="tab3_icon"> -->
                                            <select class="form-control" name="access_model">
                                                <option value="0" selected>Floating button</option>
                                                <option value="1">Docked</option>
                                                <option value="2">Hamburger Menu</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mt-5">
                                        <div class="col-md-12">
                                            <p style="font-size:.85rem;">
                                                You can change the icons for floating buttons here.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-2 col-form-label" for="fb1_icon">Instant Messaging icon :</label>

                                        <div class="col-sm-4">
                                            <input type="file" id="fb1_icon" class="form-control" name="fb1_icon">
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <label class="col-sm-2 col-form-label" for="fb2_icon">A/V Call icon :</label>

                                        <div class="col-sm-4">
                                            <input type="file" id="fb2_icon" class="form-control" name="fb2_icon">
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <label class="col-sm-2 col-form-label" for="fb3_icon">Contact Center icon :</label>

                                        <div class="col-sm-4">
                                            <input type="file" id="fb3_icon" class="form-control" name="fb3_icon">
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <label class="col-sm-2 col-form-label" for="fb4_icon">Streaming & Seminar icon :</label>

                                        <div class="col-sm-4">
                                            <input type="file" id="fb4_icon" class="form-control" name="fb4_icon">
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <label class="col-sm-2 col-form-label" for="fb5_icon">Create Post icon :</label>

                                        <div class="col-sm-4">
                                            <input type="file" id="fb5_icon" class="form-control" name="fb5_icon">
                                        </div>
                                    </div>
                                    <div class="row mt-5">
                                        <div class="col-md-12">
                                            <p style="font-size:.85rem;">
                                                <strong>CPaaS icon</strong> changes the icon used on the "access model" setting. Nexilis default icon will be used if you don't upload a custom icon.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-2 col-form-label" for="cpaas_icon">CPaaS Icon :</label>

                                        <div class="col-sm-4">
                                            <input type="file" id="cpaas_icon" class="form-control" name="cpaas_icon">
                                        </div>
                                    </div>
                                    <div class="row mt-5">
                                        <label class="col-sm-2 col-form-label" for="app_font">Font :</label>

                                        <div class="col-sm-4">
                                            <!-- <input type="file" id="tab3_icon" class="form-control" name="tab3_icon"> -->
                                            <select class="form-control" name="app_font">
                                                <option value="0">Poppins</option>
                                                <option value="1">Roboto</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-md-12">
                                            <p style="font-size:.85rem;">
                                                You can upload multiple backgrounds by selecting multiple files in the file explorer window and click "open".
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-2 col-form-label" for="background">Background wallpaper :</label>

                                        <div class="col-sm-4">
                                            <input type="file" id="background" class="form-control" accept="image/*" name="background[]" multiple>
                                        </div>
                                    </div>

                                    <div class="row mt-5">
                                        <div class="col-md-12">
                                            <p style="font-size:.85rem;">
                                                Input your desired version name here. For simplicity, please use an easily recognizable pattern such as <strong>1.0.0, 1.0.1, 1.0.2,</strong> etc.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-2 col-form-label" for="ver_name">Version name :</label>

                                        <div class="col-sm-4">
                                            <input type="text" id="ver_name" class="form-control mb-1" name="ver_name">
                                            <p id="ver_name_format" style="font-size:.85rem; color:red;" class="d-none">
                                                Please use only numbers and dots.
                                            </p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="card" id="choose-certificate-details">
                            <div class="card-body">
                                <div class="row mt-3">
                                    <div class="col-md-12 radio-item">
                                        <input onclick="checkCertif()" type="radio" id="generate-default-certif" name="check-certif" value="0" checked>
                                        <label for="generate-default-certif"> Let nexilis generate a default certificate for you</label><br>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-12 radio-item">
                                        <input onclick="checkCertif()" type="radio" id="exist-certif" name="check-certif" value="1">
                                        <label for="exist-certif"> I already have my own certificate</label><br>
                                    </div>
                                </div>

                                <div id="cert-existing">
                                    <div class="row mt-3">
                                        <label class="col-sm-2 col-form-label" for="appCertificate">Your app certificate :</label>

                                        <div class="col-sm-4">
                                            <input type="file" id="appCertificate" class="form-control" name="app-certificate" placeholder="App Certificate">
                                        </div>
                                        <label class="col-sm-2 col-form-label" for="inputAlias-existing">Alias :</label>

                                        <div class="col-sm-4">
                                            <input type="textarea" id="inputAlias-existing" class="form-control" name="inputAlias-existing">
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <label for="inputPassword" class="col-sm-2 col-form-label">Key password</label>
                                        <div class="col-sm-4">
                                            <input type="password" class="form-control" id="keyPassword-existing" name="keyPassword-existing">
                                        </div>
                                        <label for="inputConfirmPassword" class="col-sm-2 col-form-label">Key store password</label>
                                        <div class="col-sm-4">
                                            <input type="password" class="form-control" id="storePassword-existing" name="storePassword-existing">
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-12 radio-item">
                                        <input onclick="checkCertif()" type="radio" id="generate-new-certif" name="check-certif" value="2">
                                        <label for="generate-new-certif"> I want to create a new certificate</label><br>
                                    </div>
                                </div>

                                <div id="dont-have-certificate">
                                    <div class="col mt-3">
                                        <div class="form-group row align-items-center">
                                            <label for="inputAlias" class="col-sm-3 col-md-1 col-form-label">Alias</label>
                                            <div class="col-sm-9 col-md-5 left">
                                                <input type="text" class="form-control" id="inputAlias" name="inputAlias">
                                            </div>
                                            <div class="col-md-6"></div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <label for="inputPassword" class="col-sm-3 col-md-1 col-form-label">Key Password</label>
                                            <div class="col-sm-9 col-md-5 left">
                                                <input type="password" class="form-control" id="keyPassword" name="keyPassword">
                                            </div>
                                            <label for="inputConfirmPassword" class="col-sm-3 col-md-1 col-form-label">Key Store Password</label>
                                            <div class="col-sm-9 col-md-5 right">
                                                <input type="password" class="form-control" id="storePassword" name="storePassword">
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <label for="inputValidity" class="col-sm-3 col-md-1 col-form-label">Validity (years)</label>
                                            <div class="col-sm-9 col-md-5 left">
                                                <input type="number" class="form-control" id="inputValidity" name="inputValidity">
                                            </div>
                                            <div class="col-md-6"></div>
                                        </div>

                                        <hr>

                                        <div class="form-group row align-items-center">
                                            <label for="inputName" class="col-sm-3 col-md-1 col-form-label">First and Last name</label>
                                            <div class="col-sm-9 col-md-5 left">
                                                <input type="text" class="form-control" id="inputName" name="inputName">
                                            </div>
                                            <label for="inputCity" class="col-sm-3 col-md-1 col-form-label">City or Locality</label>
                                            <div class="col-sm-9 col-md-5 right">
                                                <input type="text" class="form-control" id="inputCity" name="inputCity">
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <label for="inputUnit" class="col-sm-3 col-md-1 col-form-label">Organizational Unit</label>
                                            <div class="col-sm-9 col-md-5 left">
                                                <input type="text" class="form-control" id="inputUnit" name="inputUnit">
                                            </div>
                                            <label for="inputState" class="col-sm-3 col-md-1  col-form-label">State or Province</label>
                                            <div class="col-sm-9 col-md-5 right">
                                                <input type="text" class="form-control" id="inputState" name="inputState">
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <label for="inputOrg" class="col-sm-3 col-md-1 col-form-label">Organization Name</label>
                                            <div class="col-sm-9 col-md-5 left">
                                                <input type="text" class="form-control" id="inputOrg" name="inputOrg">
                                            </div>

                                            <label for="inputCode" class="col-sm-3 col-md-1 col-form-label">Country Code (XX)</label>
                                            <div class="col-sm-9 col-md-5 right">
                                                <input type="text" class="form-control" id="inputCode" name="inputCode">
                                            </div>
                                        </div>
                                        <!-- <div class="form-group row align-items-center">
                                                
                                            </div>
                                            <div class="form-group row align-items-center">
                                            </div>
                                            <div class="form-group row align-items-center">
                                            </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4 d-flex justify-content-end">
                    <div class="col-md-12 text-center">
                        <button class="btn mt-2 mb-5 btn-yellow" id="submit-form" type="submit" value="submit" name="submit">
                            SUBMIT
                        </button>
                    </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="warningModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <p>
                    Please don't close this window while we're building your apk.
                </p>
            </div>
            <!-- </form> -->
        </div>
    </div>
</div>
</div>

<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/dashboardv2/dashboard_footer.php'); ?>

<script src="js/support.js?<?php echo $version; ?>"></script>

<script>
    $('#choose-certificate-details').hide();
    $('#generate-apk-form').hide();
    $('#cert-existing').hide();
    $('#dont-have-certificate').hide();

    function generateApk() {
        var checkBox = document.getElementById("generate-apk");
        var choose_cert = document.getElementById("choose-certificate-details");
        var apk_form = document.getElementById("generate-apk-form");

        if (checkBox.checked == true) {
            // choose_cert.classList.remove("d-none");
            // apk_form.classList.remove("d-none");
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
    }

    function checkCertif() {
        let radioCertif = document.querySelector('input[name="check-certif"]:checked').value;
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

    function checkOpt(elementID) {
        var elt = document.getElementById(elementID);
        var valCounter = {};

        var othercodes = [
            document.getElementById('tab1').value,
            document.getElementById('tab2').value,
            document.getElementById('tab3').value,
            document.getElementById('tab4').value,
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
        let inputFile = document.getElementById(elementID + '_icon');

        if (elt.value == "") {
            inputFile.setAttribute("disabled", true);
        }else {
            inputFile.removeAttribute("disabled");
        }
        // document.getElementById("notification").innerHTML = "";
        document.getElementById("submit-form").removeAttribute("disabled");
        // so that it allows form submission again;
    }

    $('#ver_name').on('input', function() {
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

    $('button#submit-form').click(function() {
        if (!$(this).is(':disabled')) {
            // $('#warningModal').modal('show');
        }
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
</script>

<script>
    // script paling bawah
    document.addEventListener('DOMContentLoaded', function() {
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
</script>