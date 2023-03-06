<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/url_function.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/db_conn.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/session_function.php'); ?>
<?php

$company_id = $_GET['company_id'];
$lang = 'EN';

if (isset($_GET['lang'])){
    $lang = $_GET['lang'];
}

$dbconn = getDBConn();

$query = $dbconn->prepare("SELECT a.SERVICE_TYPE, a.FROM, GROUP_CONCAT(DISTINCT TRIM(a.TO) SEPARATOR ', ') AS `TO`, COUNT(a.CONTENT_ID) AS `RECIPIENTS`, a.CONTENT_ID, DATE_FORMAT(a.CREATED_AT, '%d %M %Y %H:%i:%s') AS CREATED_AT, a.DURATION, a.RATE_AMOUNT 
FROM USAGE_DETAIL a, USAGE_SUMMARY b 
WHERE a.USAGE_SUMMARY = b.ID 
AND b.COMPANY_ID = ?
GROUP BY a.CONTENT_ID");
$query->bind_param("i", $company_id);
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

        $toArr = explode(', ', $res['TO']);
        if (sizeof($toArr) > 5) {
            $res['TO'] = '5+ recipients';
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

        $toArr = explode(', ', $res['TO']);
        if (sizeof($toArr) > 5) {
            $res['TO'] = '5+ recipients';
        }
        $resEdit[] = $res;
    }

}

$query->close();
echo json_encode($resEdit);


?>