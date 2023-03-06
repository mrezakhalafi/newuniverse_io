<?php include_once($_SERVER['DOCUMENT_ROOT'].'/url_function.php');?>
<?php include_once($_SERVER['DOCUMENT_ROOT'].'/db_conn.php');?>
<?php include_once($_SERVER['DOCUMENT_ROOT'].'/session_function.php');?>
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/header-alt.php'); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/header-alt-meta.php'); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/mailchimp/Mailchimp.php'); ?>

<?php 
    $url = base_url();
    session_start();
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    $dbconn = getDBConn();
    $dbconn2 = getDBConnCore();


    if(isset($_POST['submit'])){

        $email = $_POST['email'];

        //alert : email looks fake or invalid, please enter a real email address

        // test mailchimp account
        $api_key = '23903a3c6df5bcf09f7477e69abe66a1-us19';
        $list_id = '809f212969';
        
        // Palio mailchimp api
        // $api_key = 'fab0bda699cb183c67097632c3cb0e9f-us4';
        // $list_id = 'a06aa96801';

        $data_center = substr($api_key,strpos($api_key,'-')+1);

        $url = 'https://'. $data_center .'.api.mailchimp.com/3.0/lists/'. $list_id .'/members';

        $json = json_encode([
            'email_address' => $email,
            'status'        => 'subscribed', //pass 'subscribed' or 'pending'
        ]);

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_USERPWD, 'user:' . $api_key);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        $result = curl_exec($ch);
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        var_dump( $status_code );
        // echo $result . "<br>";
        // echo $_POST['email'] . "<br>";
        // echo $_POST['fname'] . "<br>";
        // echo $_POST['lname'] . "<br>";
        

    }

?>

<!DOCTYPE html>
<html>
<head>
  <title>Mailchimp Test</title>
  <!-- <script id="mcjs">!function(c,h,i,m,p){m=c.createElement(h),p=c.getElementsByTagName(h)[0],m.async=1,m.src=i,p.parentNode.insertBefore(m,p)}(document,"script","https://chimpstatic.com/mcjs-connected/js/users/86d35bc7d3b2dafddd6a1cf8e/bdb3b735b1d2696f4acdaf5b3.js");</script> -->
</head>
<body>
    
    <div>

        <h1>Mailchimp tester</h1>
        <h2><?php echo $url; ?></h2>

        <form method="post">
            <!-- First Name: <input type="text" name="fname"><br>
            Last Name: <input type="text" name="lname"><br> -->
            E-mail: <input type="email" name="email"><br>
            <input type="submit" name="submit" value="submit">
        </form>

    </div>

</body>
</html>