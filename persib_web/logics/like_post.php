<?php 

    include_once($_SERVER['DOCUMENT_ROOT'] . '/url_function.php');
    include_once($_SERVER['DOCUMENT_ROOT'] . '/persib_web/logics/chat_dbconn.php');

    $dbconn = paliolite();

    $post_id = $_POST['post_id'];
    $flag_like = $_POST['flag_like'];
    $last_update = $_POST['last_update'];
    $f_pin = $_POST['f_pin'];

    try {
        $query = $dbconn->prepare("INSERT INTO POST_REACTION (POST_ID, F_PIN, FLAG, LAST_UPDATE) VALUES (?,?,?,?) ON DUPLICATE KEY UPDATE FLAG = ?, LAST_UPDATE = ?");
        $query->bind_param("ssssss", $post_id, $f_pin, $flag_like, $last_update, $flag_like, $last_update);
        $status = $query->execute();
        $query->close();

        if($flag_like == '1'){
            $query = $dbconn->prepare("UPDATE POST SET TOTAL_LIKES=TOTAL_LIKES+1 WHERE POST_ID = ?");
            $query->bind_param("s", $post_id);
        } else {
            $query = $dbconn->prepare("UPDATE POST SET TOTAL_LIKES=IF(TOTAL_LIKES<=0,0,TOTAL_LIKES-1) WHERE POST_ID = ?");
            $query->bind_param("s", $post_id);
        }
        $status = $query->execute();
        $query->close();

        echo ' Success ';

    } catch (\Throwable $th) {
        //throw $th;
        echo $th->getMessage();
    }
?>