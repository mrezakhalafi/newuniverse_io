<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/db_conn.php'); ?>

<?php

$dbconn = getDBConn();

if (isset($_GET['del'])) {
    $id = $_GET['del'];
    echo $id;
    $query1 = $dbconn->prepare('DELETE FROM BLOG_TAG WHERE BLOG_ID = ?');
    $query1->bind_param('i', $id);
    $query1->execute();
    $query1->close();
    $query2 = $dbconn->prepare('DELETE FROM BLOG_POST WHERE ID = ?');
    $query2->bind_param('i', $id);
    $query2->execute();
    $query2->close();
    header('location: blog-index.php');
}

?>