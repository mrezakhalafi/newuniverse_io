<?php session_start(); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'].'/url_function.php');?>
<?php include_once($_SERVER['DOCUMENT_ROOT'].'/db_conn.php');?>
<?php include_once($_SERVER['DOCUMENT_ROOT'].'/session_insert.php');?>
<?php include_once($_SERVER['DOCUMENT_ROOT'].'/encoder.php');?>
<?php

    $_SESSION['previous_page'] = $_SESSION['current_page'];
    $_SESSION['current_page'] = 10;
    require_once($_SERVER['DOCUMENT_ROOT'] . '/state_control.php');

    $timeSec = 'v=' . time();

    if (isset($_GET['h']) && !empty($_GET['h'])) {

        $dbconn = getDBConn();
        $hash = $_GET['h'];

        $query = $dbconn->prepare("SELECT * FROM HASH WHERE HASH = ?");
        $query->bind_param("s", $hash);
        $query->execute();
        $h = $query->get_result()->fetch_assoc();
        $email = $h['EMAIL'];
        $query->close();

        $query = $dbconn->prepare("SELECT * FROM USER_ACCOUNT WHERE EMAIL_ACCOUNT = ?");
        $query->bind_param("s", $email);
        $query->execute();
        $itemUser = $query->get_result()->fetch_assoc();
        $query->close();

        $id = $itemUser['ACTIVE'];
        $trial = $itemUser['STATUS'];
        $company_id = $itemUser['COMPANY'];
        $password = $itemUser['PASSWORD'];
        $user_id = $itemUser['ID'];

        if ($id == 0) {

            if ($trial == 3) {
                $active = 3;
                $query = $dbconn->prepare("UPDATE USER_ACCOUNT SET ACTIVE = ?, STATE = 2 WHERE EMAIL_ACCOUNT = ?");
                $query->bind_param("is", $active, $email);
                $query->execute();
                $dbconn->commit();
                $query->close();

                $query = $dbconn->prepare("DELETE FROM HASH WHERE HASH = ?");
                $query->bind_param('s', $hash);
                $query->execute();
                $query->close();

                if ($_SESSION['password_show'] == null) {
                    redirect(base_url() . 'login.php');
                } else {
                    setSession('id_user', $user_id);
                    insertSession($user_id);

                    echo "<script language='javascript'>";
                    echo "location.href = 'trialcheckout.php';";
                    echo "</script>";
                }
            } else {
                $active = 1;
                $query = $dbconn->prepare("UPDATE USER_ACCOUNT SET ACTIVE = ?, STATE = 2 WHERE EMAIL_ACCOUNT = ?");
                $query->bind_param("is", $active, $email);
                $query->execute();
                $dbconn->commit();
                $query->close();

                $query = $dbconn->prepare("DELETE FROM HASH WHERE HASH = ?");
                $query->bind_param('s', $hash);
                $query->execute();
                $query->close();

                if ($_SESSION['password_show'] == null) {
                    redirect(base_url() . 'login.php');
                } else {
                    setSession('id_user', $user_id);
                    insertSession($user_id);

                    echo "<script language='javascript'>";
                    echo "location.href = 'paycheckout.php';";
                    echo "</script>";
                }
            }
        } else {
            if ($_SESSION['password_show'] != null) {
                echo '<script language="javascript">';
                echo 'alert("Your account might have been activated or not registered due to registration cancellation or verification expiration.");';
                echo 'location.href = "dashboardv2/index.php";';
                echo '</script>';
            } else {
                echo '<script language="javascript">';
                echo 'alert("Your account might have been activated or not registered due to registration cancellation or verification expiration. Please login or register.");';
                echo 'location.href = "index.php";';
                echo '</script>';
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Email Verification</title>

    <!-- Font-Family CSS -->
    <!-- <link rel="stylesheet" href="https://db.onlinewebfonts.com/c/623c7118249e082fe87a78e08506cb4b?family=Segoe+UI">
    <link rel="stylesheet" href="https://db.onlinewebfonts.com/c/d4d6e1a6527a21185217393c427a52cb?family=Segoe+UI+Semibold"> -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/custom.css">
    <link rel="stylesheet" type="text/css" href="./css/api_web.css">

    <!-- POPPINS -->
    <link rel="stylesheet" href="./fonts/poppins/style.css">

    <!-- Main JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>

    <!-- Custom JS -->
    <script src="js/custom.js?<?php echo $timeSec; ?>"></script>

    <!-- reCAPTCHA -->
    <script src='https://www.google.com/recaptcha/api.js'></script>

</head>
<body>
</body>
</html>
