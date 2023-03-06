<?php 

    include_once($_SERVER['DOCUMENT_ROOT'] . '/url_function.php');
    include_once($_SERVER['DOCUMENT_ROOT'] . '/persib_web/logics/chat_dbconn.php');

    $dbconn = paliolite();

    $store_code = $_POST['store_code'];
    $flag_follow = $_POST['flag_follow'];
    $last_update = $_POST['last_update'];
    $f_pin = $_POST['f_pin'];

    try {
        if($flag_follow == '1'){
            $query = $dbconn->prepare("INSERT INTO FOLLOW (F_PIN, L_PIN, FOLLOW_DATE, UNFOLLOW_DATE) VALUES (?,?,?,'253402275599') ON DUPLICATE KEY UPDATE FOLLOW_DATE = ?");
            $query->bind_param("ssss", $f_pin, $store_code, $last_update, $last_update);
            $status = $query->execute();
            $query->close();

            // $query = $dbconn->prepare("UPDATE SHOP SET TOTAL_FOLLOWER=TOTAL_FOLLOWER+1 WHERE CODE = ?");
            // $query->bind_param("s", $store_code);
            // $status = $query->execute();
            // $query->close();
        } else {
            $query = $dbconn->prepare("DELETE FROM FOLLOW WHERE F_PIN = ? AND L_PIN = ?");
            $query->bind_param("ss", $f_pin, $store_code);
            $status = $query->execute();
            $query->close();

            // $query = $dbconn->prepare("UPDATE SHOP SET TOTAL_FOLLOWER=IF(TOTAL_FOLLOWER<=0,0,TOTAL_FOLLOWER-1) WHERE CODE = ?");
            // $query->bind_param("s", $store_code);
            // $status = $query->execute();
            // $query->close();
        }

        echo ' Success ';

    } catch (\Throwable $th) {
        //throw $th;
        echo $th->getMessage();
    }
?>