<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/url_function.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/db_conn.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/session_function.php'); ?>
<?php

$company_id = $_GET['company_id'];
$lang = 'EN';

if (isset($_GET['lang'])){
    $lang = $_GET['lang'];
}

$type = $_GET['content_type'];

if ($type == '0') {
    $content_id = $_GET['content_id'];
} else if ($type == '1') {
    $content_id = base64_decode($_GET['content_id']);
}

$dbconn = getDBConn();

$query = $dbconn->prepare("SELECT ud.SERVICE_TYPE, ud.FROM, ud.TO, ud.CONTENT_ID, ud.DURATION, DATE_FORMAT(ud.CREATED_AT, '%d %M %Y %H:%i:%s') AS CREATED_AT, ud.RATE_AMOUNT
FROM USAGE_DETAIL ud, USAGE_SUMMARY us
WHERE ud.CONTENT_ID = ?
AND ud.USAGE_SUMMARY = us.ID");
$query->bind_param("s", $content_id);
$query->execute();
$result = $query->get_result();

$resArr = array();
foreach($result as $set) {
    $resArr[] = $set;
}

$resEdit = array();

if ($lang == 'EN'){

    foreach($resArr as $res) {
        if ($res['SERVICE_TYPE'] == 1) {
            $res['SERVICE_TYPE'] = 'TEXT';
            $res['DURATION'] = '-';
            $res['HIDDEN_CONTENT_ID'] = '';
        } else if ($res['SERVICE_TYPE'] == 2) {
            $res['SERVICE_TYPE'] = 'DOCUMENTS & IMAGES';
            $res['DURATION'] = '-';
            $res['HIDDEN_CONTENT_ID'] = '';
        } else if ($res['SERVICE_TYPE'] == 3) {
            $res['SERVICE_TYPE'] = 'VIDEO';
            $res['DURATION'] = '-';
            $res['HIDDEN_CONTENT_ID'] = '';
        } else if ($res['SERVICE_TYPE'] == 4) {
            $res['TO'] = '-';
            $res['SERVICE_TYPE'] = 'LIVE STREAMING';
            $res['HIDDEN_CONTENT_ID'] = $res['CONTENT_ID'];
            $res['CONTENT_ID'] = substr(base64_encode($res['HIDDEN_CONTENT_ID']), 0 ,23);
        } else if ($res['SERVICE_TYPE'] == 5) {
            $res['TO'] = '-';
            $res['SERVICE_TYPE'] = 'VOIP CALL';
            $res['HIDDEN_CONTENT_ID'] = $res['CONTENT_ID'];
            $res['CONTENT_ID'] = substr(base64_encode($res['HIDDEN_CONTENT_ID']), 0 ,23);
        } else if ($res['SERVICE_TYPE'] == 6) {
            $res['TO'] = '-';
            $res['SERVICE_TYPE'] = 'VIDEO CALL';
            $res['HIDDEN_CONTENT_ID'] = $res['CONTENT_ID'];
            $res['CONTENT_ID'] = substr(base64_encode($res['HIDDEN_CONTENT_ID']), 0 ,23);
        }

        $resEdit[] = $res;
    }


}else if ($lang == 'ID'){

    foreach($resArr as $res) {
        if ($res['SERVICE_TYPE'] == 1) {
            $res['SERVICE_TYPE'] = 'TEKS';
            $res['DURATION'] = '-';
            $res['HIDDEN_CONTENT_ID'] = '';
        } else if ($res['SERVICE_TYPE'] == 2) {
            $res['SERVICE_TYPE'] = 'DOKUMEN & GAMBAR';
            $res['DURATION'] = '-';
            $res['HIDDEN_CONTENT_ID'] = '';
        } else if ($res['SERVICE_TYPE'] == 3) {
            $res['SERVICE_TYPE'] = 'VIDEO';
            $res['DURATION'] = '-';
            $res['HIDDEN_CONTENT_ID'] = '';
        } else if ($res['SERVICE_TYPE'] == 4) {
            $res['TO'] = '-';
            $res['SERVICE_TYPE'] = 'SIARAN LANGSUNG';
            $res['HIDDEN_CONTENT_ID'] = $res['CONTENT_ID'];
            $res['CONTENT_ID'] = substr(base64_encode($res['HIDDEN_CONTENT_ID']), 0 ,23);
        } else if ($res['SERVICE_TYPE'] == 5) {
            $res['TO'] = '-';
            $res['SERVICE_TYPE'] = 'PANGGILAN VOIP';
            $res['HIDDEN_CONTENT_ID'] = $res['CONTENT_ID'];
            $res['CONTENT_ID'] = substr(base64_encode($res['HIDDEN_CONTENT_ID']), 0 ,23);
        } else if ($res['SERVICE_TYPE'] == 6) {
            $res['TO'] = '-';
            $res['SERVICE_TYPE'] = 'PANGGILAN VIDEO';
            $res['HIDDEN_CONTENT_ID'] = $res['CONTENT_ID'];
            $res['CONTENT_ID'] = substr(base64_encode($res['HIDDEN_CONTENT_ID']), 0 ,23);
        }

        $resEdit[] = $res;
    }
}

$query->close();
echo json_encode($resEdit);


?>