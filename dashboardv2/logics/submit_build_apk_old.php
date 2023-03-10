<?php

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . '/db_conn.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/url_function.php');
$dbconn = getDBConn();

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
        CURLOPT_URL => 'https://newuniverse.io:8092/',
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

    echo ("Berhasil|" . base_url() . "dashboardv2/uploads/" . json_decode($json)->name);

    // $filename = $_SERVER["DOCUMENT_ROOT"] . '/dashboardv2/uploads/combinepdf.zip';

    // echo ("Berhasil|" . base_url() . "dashboardv2/uploads/combinepdf.zip");

    // ini_set('memory_limit', '-1');
    // do {
    //     if (file_exists($filename)) {
    //         header('Content-Description: File Transfer');
    //         header('Content-Type: application/force-download');
    //         header("Content-Disposition: attachment; filename=\"" . basename($filename) . "\";");
    //         header('Content-Transfer-Encoding: binary');
    //         header('Expires: 0');
    //         header('Cache-Control: must-revalidate');
    //         header('Pragma: public');
    //         header('Content-Length: ' . filesize($filename));
    //         ob_clean();
    //         flush();
    //         readfile($filename); //showing the path to the server where the file is to be download
    //         exit;
    //         break;
    //     }
    // } while (!file_exists($filename));

    // sleep(60);
    // redirect('/dashboardv2/index.php');
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

// FILL XHR FROM HERE

$dbconn = getDBConn();
$dbConnPalio = dbConnPalioLite();

$email = $_SESSION['email'];
$id_user = $_SESSION['id_user'];
$id_company = $_SESSION['id_company'];

$company_web = $_POST['company-website'];
$webURL = $company_web;
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

$ver_code = $_POST['ver_code'];

$acc = $api_key['API_KEY'];

// set new URL homepage prefs table
// get BE ID using company ID
$sqlBE = "SELECT ID FROM BUSINESS_ENTITY WHERE COMPANY_ID = '$id_company'";
$query = $dbConnPalio->prepare($sqlBE);
// echo $sqlBE;
$query->execute();
$res = $query->get_result()->fetch_assoc();
$be_id = $res["ID"];
$query->close();

$edit_tabs = $_POST['edit_apk'];

if (!isset($_POST['generate-apk']) && !isset($_POST['edit_apk'])) {

    // if (!isset($generate_apk) && !isset($edit_tabs)) {
    // echo 'EDIT URL';
    // insert into webform table
    $ver_code = $ver_code + 1;
    $query = $dbconn->prepare("REPLACE INTO WEBFORM (EMAIL, USER_ID, COMPANY_ID, WEB_URL, VERSION_CODE) VALUES (?,?,?,?,?)");
    $query->bind_param("siisi", $email, $id_user, $id_company, $company_web, $ver_code);
    $query->execute();
    $query->close();
    // hitAPI($company_url, '');
    echo 'Berhasil|0';
} else if (isset($generate_apk) && $generate_apk == 1) {
    // echo 'GENERATE';

    $company_name = $_POST['company-name'];
    $app_id = $_POST['app-id'];

    // get company logo
    $query = $dbconn->prepare("SELECT * FROM COMPANY_INFO WHERE COMPANY = '$id_company'");
    $query->execute();
    $res = $query->get_result()->fetch_assoc();
    $company_logo = $res["COMPANY_LOGO"];
    $query->close();
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
            $app_url = '';

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

            if (isset($_POST['url_content'])) {
                $app_url = $_POST['url_content'];
                $sql .= ", APP_URL";
            }

            //     $sqlInsertURL = "
            //     INSERT INTO PREFS (`BE`, `KEY`, `VALUE`) 
            //     VALUES 
            //     (
            //         $be_id, 
            //         'app_builder_url_first_tab', 
            //         '$app_url'
            //     ) ON DUPLICATE KEY 
            //     UPDATE 
            //     `VALUE` = '$app_url'
            //     ";

            //     $query = $dbConnPalio->prepare($sqlInsertURL);
            //     $query->execute();
            //     $query->close();
            // }

            // content tab layout
            if (isset($_POST['tab3_mode'])) {
                $content_tab_layout = $_POST['tab3_mode'];
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

            print_r($_FILES['background']);

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
            if (isset($_POST['url_content'])) {
                $sql .= ", '$app_url'";
            }

            if (isset($_POST['tab3_mode'])) {
                $sql .= ", '$content_tab_layout'";
            }

            $tab_arr = array();

            if (isset($_POST['tab1']) && trim($_POST['tab1']) !== "") {
                $sql .= ", '$tab1'";
                array_push($tab_arr, $tab1);
            }
            if (isset($_POST['tab2']) && trim($_POST['tab2']) !== "") {
                $sql .= ", '$tab2'";
                array_push($tab_arr, $tab2);
            }
            if (isset($_POST['tab3']) && trim($_POST['tab3']) !== "") {
                $sql .= ", '$tab3'";
                array_push($tab_arr, $tab3);
            }
            if (isset($_POST['tab1']) && trim($_POST['tab4']) !== "") {
                $sql .= ", '$tab4'";
                array_push($tab_arr, $tab4);
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
            // $query->execute();
            // $query->close();

            // echo 'fb1:' . $fb1_icon;
            // echo '<br>';
            // echo 'fb2:' . $fb2_icon;
            // echo '<br>';
            // echo 'fb3:' . $fb3_icon;
            // echo '<br>';
            // echo 'fb4:' . $fb4_icon;
            // echo '<br>';

            $tab_sequence = implode(',', $tab_arr);

            if ($query->execute()) {

                $sqlInsertTab = "
                    INSERT INTO PREFS (`BE`, `KEY`, `VALUE`) 
                    VALUES 
                    (
                        $be_id, 
                        'app_builder_custom_tab', 
                        '$tab_sequence'
                    ) ON DUPLICATE KEY 
                    UPDATE 
                    `VALUE` = '$tab_sequence'
                    ";

                $queryTab = $dbConnPalio->prepare($sqlInsertTab);
                $queryTab->execute();
                $queryTab->close();

                if (isset($_POST['tab3_mode'])) {
                    $sqlInsertTab3 = "
                        INSERT INTO PREFS (`BE`, `KEY`, `VALUE`) 
                        VALUES 
                        (
                            $be_id, 
                            'app_builder_url_third_tab', 
                            '$content_tab_layout'
                        ) ON DUPLICATE KEY 
                        UPDATE 
                        `VALUE` = '$content_tab_layout'
                        ";

                    $queryUrl = $dbConnPalio->prepare($sqlInsertTab3);
                    $queryUrl->execute();
                    $queryUrl->close();
                }

                if (isset($_POST['url_content'])) {
                    $sqlInsertURL = "
                        INSERT INTO PREFS (`BE`, `KEY`, `VALUE`) 
                        VALUES 
                        (
                            $be_id, 
                            'app_builder_url_first_tab', 
                            '$app_url'
                        ) ON DUPLICATE KEY 
                        UPDATE 
                        `VALUE` = '$app_url'
                        ";

                    $queryUrl = $dbConnPalio->prepare($sqlInsertURL);
                    $queryUrl->execute();
                    $queryUrl->close();
                }

                hitAPI($company_web, $company_logo);
                makeAPK($app_url, $company_logo, $app_id, $company_name, $acc, $do_keystore, $app_certificate, $key_password, $store_password, $alias, $name, $unit, $org, $city, $state, $code, $content_tab_layout, $tab1, $tab2, $tab3, $tab4, $tab1_icon, $tab2_icon, $tab3_icon, $tab4_icon, $access_model, $fb1_icon, $fb2_icon, $fb3_icon, $fb4_icon, $fb5_icon, $background, $cpaas_icon, $app_font, $ver_code, $ver_name);

                $query->close();
            }

            // $query->execute();

            // function makeAPK($weburl, $logo, $appid, $compname, $acc, $do_keystore, $keystore, $pw, $alias, $common_name, $org_unit, $org_name, $locality, $state_name, $country_code, $tab1, $tab2, $tab3, $tab4, $tab1_icon, $tab2_icon, $tab3_icon, $tab4_icon, $access_model, $background)
            // redirect(base_url() . 'dashboardv2/index.php');
        } else {
            echo '<script>alert("Please upload your company logo first via the Overview page.");</script>';
        }
    }
} else if (!isset($generate_apk) && isset($edit_tabs) && $edit_tabs == 1) {
    // echo 'CUMA EDIT COY';

    $tab_arr = array();

    if (isset($_POST['tab1_edit']) && trim($_POST['tab1_edit']) !== "") {
        array_push($tab_arr, $_POST['tab1_edit']);
    }
    if (isset($_POST['tab2_edit']) && trim($_POST['tab2_edit']) !== "") {
        array_push($tab_arr, $_POST['tab2_edit']);
    }
    if (isset($_POST['tab3_edit']) && trim($_POST['tab3_edit']) !== "") {
        array_push($tab_arr, $_POST['tab3_edit']);
    }
    if (isset($_POST['tab1_edit']) && trim($_POST['tab4_edit']) !== "") {
        array_push($tab_arr, $_POST['tab4_edit']);
    }

    $tab_sequence = implode(',', $tab_arr);

    $sqlChangeTab = "
        INSERT INTO PREFS (`BE`, `KEY`, `VALUE`) 
        VALUES 
        (
            $be_id, 
            'app_builder_custom_tab', 
            '$tab_sequence'
        ) ON DUPLICATE KEY 
        UPDATE 
        `VALUE` = '$tab_sequence'
        ";

    $query = $dbConnPalio->prepare($sqlChangeTab);
    $query->execute();
    $query->close();



    if (isset($_POST['edit_url_content'])) {
        $app_url = $_POST['edit_url_content'];

        $sqlInsertURL = "
        INSERT INTO PREFS (`BE`, `KEY`, `VALUE`) 
        VALUES 
        (
            $be_id, 
            'app_builder_url_first_tab', 
            '$app_url'
        ) ON DUPLICATE KEY 
        UPDATE 
        `VALUE` = '$app_url'
        ";

        $query = $dbConnPalio->prepare($sqlInsertURL);
        $query->execute();
        $query->close();
    }

    if (isset($_POST['edit_tab3_mode'])) {
        $edit_tab3_mode = $_POST['edit_tab3_mode'];

        $sqlInsertTab3 = "
        INSERT INTO PREFS (`BE`, `KEY`, `VALUE`) 
        VALUES 
        (
            $be_id, 
            'app_builder_url_third_tab', 
            '$edit_tab3_mode'
        ) ON DUPLICATE KEY 
        UPDATE 
        `VALUE` = '$edit_tab3_mode'
        ";

        $queryUrl = $dbConnPalio->prepare($sqlInsertTab3);
        $queryUrl->execute();
        $queryUrl->close();
    }

    // if (!isset($generate_apk) && !isset($edit_tabs)) {
    // echo 'EDIT URL';
    // insert into webform table
    // $ver_code = $ver_code + 1;
    // $query = $dbconn->prepare("REPLACE INTO WEBFORM (EMAIL, USER_ID, COMPANY_ID, WEB_URL, VERSION_CODE) VALUES (?,?,?,?,?)");
    // $query->bind_param("siisi", $email, $id_user, $id_company, $company_web, $ver_code);
    // $query->execute();
    // $query->close();

    // redirect(base_url() . 'dashboardv2/index.php');
    echo 'Berhasil|1';
}
