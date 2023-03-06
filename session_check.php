<?php
  include_once($_SERVER['DOCUMENT_ROOT'].'/url_function.php');
  include_once($_SERVER['DOCUMENT_ROOT'].'/session_function.php');
  include_once($_SERVER['DOCUMENT_ROOT'].'/db_conn.php');

  // function checkSession($user_id, $session_token_exist){
  function checkSession($session_token_exist, $user_id){
    $dbconn = getDBConn();

    //check session
    $query= $dbconn->prepare("SELECT * FROM SESSION WHERE SESSION_TOKEN = ? AND USER_ID = ?");
    $query->bind_param("si", $session_token_exist, $user_id);
    $query->execute();
    $session_exist = $query->get_result()->fetch_assoc();
    $query->close();

    if ($session_exist == NULL) {
      echo "<script>alert('You are now logged out');</script>";
      sleep(5);
      doLogout();
    }

  }

  checkSession(getSession('session_token'), getSession('id_user'));

  ?>
