<?php include_once($_SERVER['DOCUMENT_ROOT'].'/db_conn.php');?>
<?php
    function StringInputCleaner($data)
    {
        //remove space bfore and after
        $data = trim($data); 
        //remove slashes
        $data = stripslashes($data); 
        $data=(filter_var($data, FILTER_SANITIZE_STRING));
        return $data;
    }
    
    $username = '';
    if (isset($_GET['username'])) {
        $username =  $_GET['username'];
    } else {
        $username = '';
    }
    $dbconn = getDBConn();
    if(!$dbconn){
        die("Connection failed: " . $dbconn->error);
    }
    $username = StringInputCleaner($username);

    echo $username;
    $query = $dbconn->prepare("INSERT INTO REDIRECT_COUNT (username, fb_redirect, tw_redirect, ig_redirect, li_redirect,time_redirect)
    VALUES (?,0,0,1,0,NOW())");
    $query->bind_param("s", $username);
    $query->execute();
    $query->close();

    header('location: https://www.instagram.com/palio_sdk/');
?>