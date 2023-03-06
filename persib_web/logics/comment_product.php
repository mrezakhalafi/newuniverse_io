<?php 

    include_once($_SERVER['DOCUMENT_ROOT'] . '/url_function.php');
    include_once($_SERVER['DOCUMENT_ROOT'] . '/persib_web/logics/chat_dbconn.php');

    $dbconn = paliolite();

    $product_code = $_POST['product_code'];
    $comment = $_POST['comment'];
    $last_update = $_POST['last_update'];
    $f_pin = $_POST['f_pin'];
    $reply_id = null;
    if (isset($_POST['reply_id'])) {
        $reply_id = $_POST['reply_id'];
    }
    $comment_id = $f_pin . $last_update;

    try {
        $query = $dbconn->prepare("INSERT INTO POST_COMMENT (COMMENT_ID, POST_ID, F_PIN, COMMENT, CREATED_DATE, REF_COMMENT_ID) VALUES (?,?,?,?,?,?)");
        $query->bind_param("ssssss", $comment_id, $product_code, $f_pin, $comment, $last_update, $reply_id);
        $status = $query->execute();
        $query->close();

        echo 'Success Comment';

    } catch (\Throwable $th) {
        //throw $th;
        echo $th->getMessage();
    }
?>