<!--
//login.php
!-->

<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/url_function.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/db_conn.php');

session_start();
$dbconn = getDBConn();
$message = '';

if(isset($_SESSION['user_id'])){
 header('location:chat_index.php');
}

if(isset($_POST["login"])){
    $query = $dbconn->prepare("SELECT * FROM USER_ACCOUNT WHERE USERNAME = ?");
    $query->bind_param("s", $_POST['username']);
    $query->execute();
    $result = $query->get_result();
    $count = $result->num_rows;
    $query->close();

    if($count > 0){
        foreach($result as $row){
            if($_POST["password"]){
                $_SESSION['user_id'] = $row['ID'];
                $_SESSION['username'] = $row['USERNAME'];

                $query = $dbconn->prepare("INSERT INTO LOGIN_DETAILS (USER_ID) VALUES (?)");
                $query->bind_param("i", $row['ID']);
                $query->execute();
                $_SESSION['login_details_id'] = $query->insert_id;
                $query->close();
                
                header("location:chat_index.php");
            }
            else{
                $message = "<label>Wrong Password</label>";
            }
        }
    }
    else{
        $message = "<label>Wrong Username</labe>";
    }
}

?>

<html>  
    <head>  
        <title>Chat Application using PHP Ajax Jquery</title>  
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    </head>  
    <body>  
        <div class="container">
   <br />
   
   <h3 align="center">Chat Application using PHP Ajax Jquery</a></h3><br />
   <br />
   <div class="panel panel-default">
      <div class="panel-heading">Chat Application Login</div>
    <div class="panel-body">
     <form method="post">
      <p class="text-danger"><?php echo $message; ?></p>
      <div class="form-group">
       <label>Enter Username</label>
       <input type="text" name="username" class="form-control" required />
      </div>
      <div class="form-group">
       <label>Enter Password</label>
       <input type="password" name="password" class="form-control" required />
      </div>
      <div class="form-group">
       <input type="submit" name="login" class="btn btn-info" value="Login" />
      </div>
     </form>
    </div>
   </div>
  </div>
    </body>  
</html>
