<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/db_conn.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/url_function.php'); ?>

<?php

if (!isset($_SESSION['password']) || (isset($_SESSION['password']) && $_SESSION['password'] != md5('T3sB4Y4rN0X3nd1t'))) {
    header("Location:" . base_url());
  }

$dbconn = getDBConn();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    echo $id;
    $query1 = $dbconn->prepare('DELETE FROM BLOG_TAG WHERE BLOG_ID = ?');
    $query1->bind_param('i', $id);
    $query1->execute();
    $query1->close();
    $query2 = $dbconn->prepare('DELETE FROM BLOG_POST WHERE ID = ?');
    $query2->bind_param('i', $id);
    $query2->execute();
    $query2->close();
    header('Location: ' . base_url() . 'blog-index.php');
}

?>