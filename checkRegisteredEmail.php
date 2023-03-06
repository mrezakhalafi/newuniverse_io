<?php include_once($_SERVER['DOCUMENT_ROOT'].'/url_function.php');?>
<?php include_once($_SERVER['DOCUMENT_ROOT'].'/db_conn.php');?>
<?php include_once($_SERVER['DOCUMENT_ROOT'].'/session_function.php');?>

<?php
    header('Content-Type: application/json');
    
    if (isset($_GET['email']) && isset($_GET['password']) && isset($_GET['response'])) {
       $dbconn = getDBConn();
       $email = $_GET['email'];
       $password = $_GET['password'];
       $response = $_GET['response'];

       $query= $dbconn->prepare("SELECT COUNT(*) as cnt FROM company WHERE EMAIL_ACCOUNT = ?");
       $query->bind_param("s", $email);
       $query->execute();
       $itemUser = $query->get_result()->fetch_assoc();
       $cnt = $itemUser['cnt'];
       $msg = "";


       $query->close();

        if(!$itemUser) exit('No rows');

        if($cnt > 0) {
            $msg = 'Email has already registered!';
        } else {

             if($response->success){
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;

                redirect(base_url()."name.php"); 

            } else {
                $msg = 'Please Validate that you are human!';
            }

        }
    }

?>
