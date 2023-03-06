<?php
  include_once($_SERVER['DOCUMENT_ROOT'].'/url_function.php');
  include_once($_SERVER['DOCUMENT_ROOT'].'/session_function.php');
  include_once($_SERVER['DOCUMENT_ROOT'].'/db_conn.php');

  function deleteSessionDB($user_id){
    $dbconn = getDBConn();

    // delete session
    $query = $dbconn->prepare("DELETE FROM SESSION WHERE USER_ID = ?");
    $query->bind_param("i", $user_id);
    $query->execute();
    $query->close();

    //delete all session from browser
    doLogout();
  }

  ?>
