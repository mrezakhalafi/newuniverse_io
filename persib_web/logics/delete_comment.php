<?php 

    include_once($_SERVER['DOCUMENT_ROOT'] . '/url_function.php');
    include_once($_SERVER['DOCUMENT_ROOT'] . '/persib_web/logics/chat_dbconn.php');

    $dbconn = paliolite();

    $comment_id = $_POST['comment_id'];

    try {
        $query = $dbconn->prepare("DELETE FROM POST_COMMENT WHERE COMMENT_ID='$comment_id' OR REF_COMMENT_ID='$comment_id'");
        $status = $query->execute();
        $query->close();

        echo 'Success Delete Comment';

    } catch (\Throwable $th) {
        //throw $th;
        echo $th->getMessage();
    }
?>