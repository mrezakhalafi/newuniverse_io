<?php
  include_once($_SERVER['DOCUMENT_ROOT'].'/url_function.php');
  include_once($_SERVER['DOCUMENT_ROOT'].'/session_function.php');
  include_once($_SERVER['DOCUMENT_ROOT'].'/db_conn.php');

  function insertSession($user_id){
    $dbconn = getDBConn();

    //check if there is a user in this browser with current token
    $query = $dbconn->prepare("SELECT * FROM SESSION WHERE SESSION_TOKEN = ?");
    $query->bind_param("s", $_SESSION['session_token']);
    $query->execute();
    $token = $query->get_result()->fetch_assoc();
    $token_exist = $token['USER_ID'];
    $query->close();

    if($token_exist != null && $token_exist != $user_id){

      // update session
      $query = $dbconn->prepare("UPDATE SESSION SET USER_ID = ? WHERE SESSION_TOKEN = ?");
      $query->bind_param("is", $user_id, $_SESSION['session_token']);
      $query->execute();
      $query->close();

      return True;

      // // session already taken by other user
      // return False;

    } else {
      // delete session
      $query = $dbconn->prepare("DELETE FROM SESSION WHERE USER_ID = ?");
      $query->bind_param("i", $user_id);
      $query->execute();
      $query->close();

      //create session token
      $new_token = sha1(time());

      // insert session
      $query = $dbconn->prepare("INSERT INTO SESSION (USER_ID, SESSION_TOKEN) VALUES (?,?)");
      $query->bind_param("is", $user_id, $new_token);
      $query->execute();
      $query->close();

      //set session with $token
      setSession('session_token', $new_token);

      // session token not used by user
      return True;
    }
    
  }

  ?>
