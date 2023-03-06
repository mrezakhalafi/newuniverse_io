<?php
include_once('url_function.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/db_conn.php');
?>


<?php
session_start();

$dbconn = getDBConn();

// geoloc
$query = $dbconn->prepare("SELECT VALUE FROM SITE_SETTINGS WHERE PROPERTY = 'GEOLOC'");
$query->execute();
$geoloc = $query->get_result()->fetch_assoc();
$geolocSts = $geoloc['VALUE'];
$query->close();

// language
$query = $dbconn->prepare("SELECT VALUE FROM SITE_SETTINGS WHERE PROPERTY = 'LANGUAGE'");
$query->execute();
$lang_setting = $query->get_result()->fetch_assoc();
$language = $lang_setting['VALUE'];
$query->close();

$_SESSION['language'] = $language;
$_SESSION['geolocSts'] = $geolocSts;

function setSession($name, $val)
{
    $_SESSION[$name] = $val;
}

function getSession($name)
{
    if (isset($_SESSION[$name])) {

        $val = $_SESSION[$name];
        return $val;
    }

    return "";
}

function deleteSession($name)
{
    #   session_unset($_SESSION[$name]);
    session_unset();
    session_destroy();
}


function doLogout()
{
    deleteSession('session_token');
    deleteSession('email');
    deleteSession('password');
    deleteSession('id_user');
    deleteSession('id_company');
    deleteSession('company_name');
    deleteSession('flag');
    // redirect(base_url() . 'login.php');
    redirect(base_url());
}

function set_flash_session($name, $value)
{
    $_SESSION[$name] = $value;
}

function session_exist($name)
{
    return isset($_SESSION[$name]);
}

function get_flash_session($name)
{
    if (isset($_SESSION[$name])) {
        $value = $_SESSION[$name];
        unset($_SESSION[$name]);
        return $value;
    }
    return "";
}

?>
