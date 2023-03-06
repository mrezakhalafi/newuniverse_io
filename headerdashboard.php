<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/db_conn.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/url_function.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/session_function.php'); ?>
<?php

  sessionExpire();

  if ($_SESSION['id_company'] == '') {
      header("Location:" . base_url() . "login.php");
  }

  $dbconn = getDBConn();

  $dialogMsg = "";

  $query = $dbconn->prepare("SELECT a.*, b.*, c.* FROM USER_ACCOUNT a, COMPANY_INFO b, COMPANY c WHERE a.COMPANY = b.COMPANY AND b.COMPANY = c.ID AND a.COMPANY = ?");
  $query->bind_param("i", getSession('id_company'));
  $query->execute();
  $itemUser = $query->get_result()->fetch_assoc();
  $query->close();

  $query2 = $dbconn->prepare("SELECT * FROM SUBSCRIBE WHERE COMPANY = ?");
  $query2->bind_param("i", getSession('id_company'));
  $query2->execute();
  $itemUser2 = $query2->get_result()->fetch_assoc();
  $query2->close();

  $query = $dbconn->prepare("SELECT * FROM COMPANY where ID = ?");
  $query->bind_param("i", getSession('id_company'));
  $query->execute();
  $itemCompany = $query->get_result()->fetch_assoc();
  $query->close();

  $query = $dbconn->prepare("SELECT * FROM COMPANY_INFO where company = ? ");
  $query->bind_param("i", getSession('id_company'));
  $query->execute();
  $itemUserDetail = $query->get_result()->fetch_assoc();
  $query->close();

  //all message
  $message = $dbconn->prepare("SELECT * FROM MESSAGE WHERE COMPANY = ? ORDER BY ID DESC");
  $message->bind_param("i", getSession('id_company'));
  $message->execute();
  $itemMessage = $message->get_result();
  $rows = $itemMessage->num_rows;
  $message->close();

  //unread message
  $messagenull = $dbconn->prepare("SELECT * FROM MESSAGE WHERE COMPANY = ? AND IS_READ = 0 ORDER BY ID DESC");
  $messagenull->bind_param("i", getSession('id_company'));
  $messagenull->execute();
  $itemMessageNull = $messagenull->get_result();
  $rowsnull = $itemMessageNull->num_rows;
  $messagenull->close();

  $tempID = array();
  $tempIsRead = array();
  $tempMID = array();

  while ($row = $itemMessage->fetch_assoc()) {
  	array_push($tempID, $row['ID']);
  	array_push($tempIsRead, $row['IS_READ']);
  	array_push($tempMID, $row['M_ID']);
  };

  //current bill CHARGE
  // $query = $dbconn->prepare("SELECT * FROM BILLING WHERE COMPANY = ? AND IS_PAID = 0");
  // $query->bind_param("i", getSession('id_company'));
  // $query->execute();
  // $bill = $query->get_result()->fetch_assoc();
  // $charge = $bill["CHARGE"];
  // $query->close();

  //unpaid bill CHARGE
  $query = $dbconn->prepare("SELECT * FROM BILLING WHERE COMPANY = ? AND IS_PAID = 0");
  $query->bind_param("i", getSession('id_company'));
  $query->execute();
  $bills = $query->get_result();
  $billsrow = $bills->num_rows;
  $query->close();

  //USER
  $query = $dbconn->prepare("SELECT * FROM USER_ACCOUNT WHERE COMPANY = ?");
  $query->bind_param("i", getSession('id_company'));
  $query->execute();
  $user = $query->get_result()->fetch_assoc();
  $query->close();

  // ~~~~~~~~~~~~~~~~~~~~~~~~~~ Update Profile ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
  if (isset($_POST['update_profile'])) {

    $email_account = $_POST['email_account'];
    $company_name = $_POST['company_name'];
    $cnt = 0;

    if ($company_name != $itemUserDetail['COMPANY_NAME']) {
      $queryEmail = $dbconn->prepare("SELECT * FROM COMPANY_INFO WHERE COMPANY_NAME = ?");
      $queryEmail->bind_param("s", $company_name);
      $queryEmail->execute();
      //$runQueryEmail = mysqli_query($dbconn, $queryEmail);
      $resultQueryEmail = $queryEmail->get_result()->fetch_assoc();
      $cnt = $resultQueryEmail['COMPANY_NAME'];
    }

    if ($cnt > 0) {
      $dialogMsg = "Email or Company Name has already Registered!";
    } else {
      //update user info
      $queryUpdateInfo = $dbconn->prepare("UPDATE COMPANY_INFO SET COMPANY_NAME = ? WHERE COMPANY = ?");
      $queryUpdateInfo->bind_param("si", $company_name, $itemUser['COMPANY']);
      $queryUpdateInfo->execute();

      if (!$dbconn->commit()) {
        echo 'commit gagal';
      }

      redirect(base_url() . 'newdashboard.php');
    }
  }
  // ~~~~~~~~~~~~~~~~~~~~~ End Update Profile ~~~~~~~~~~~~~~~~~


  // ~~~~~~~~~~~~~~~~ Update Password ~~~~~~~~~~~~~ //
  if (isset($_POST['update_password'])) {
    $last_password = MD5($_POST['last_password']);
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    //$password = getSession('password');

    $queryGetPass = $dbconn->prepare("SELECT * FROM USER_ACCOUNT WHERE ID = ? ");
    $queryGetPass->bind_param("i", getSession('id_user'));
    $queryGetPass->execute();
    $resultGetPass = $queryGetPass->get_result()->fetch_assoc();

    $password = $resultGetPass['PASSWORD'];

    if ($last_password == $password) {
      if ($confirm_password == $new_password) {
        //update user email
        $queryUpdateCompany = $dbconn->prepare("UPDATE USER_ACCOUNT SET PASSWORD = ? WHERE ID = ?");
        $queryUpdateCompany->bind_param("si", MD5($new_password), getSession('id_user'));
        $queryUpdateCompany->execute();
        if (!$dbconn->commit()) {
          echo 'commit gagal';
        }

        setSession('password', $new_password);

        redirect(base_url() . 'newdashboard.php');
      } else {
        $dialogMsg = "Password is not matched!";
      }
    } else {
      $dialogMsg = "Current Password is incorrect!";
    }
  }
  // ~~~~~~~~~~~~~~~~~ End Update Password ~~~~~~~~~~~~~~ //


  if (isset($_POST['submitLogout'])) {
    doLogout();
  }

?>

<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Palio | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="/newdashboard/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/newdashboard/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="/newdashboard/bower_components/Ionicons/css/ionicons.min.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="/newdashboard/bower_components/jvectormap/jquery-jvectormap.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="/newdashboard/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/newdashboard/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="/newdashboard/dist/css/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <style media="screen">
    .nav-tabs-custom>.nav-tabs>li.active {
      border-top-color: #f39c12;
    }
    .box {
      border-top: 3px solid #f39c12;
    }
    .box.box-primary {
      border-top-color: #f39c12;
    }
    .example-modal .modal {
      position: relative;
      top: auto;
      bottom: auto;
      right: auto;
      left: auto;
      display: block;
      z-index: 1;
    }

    .example-modal .modal {
      background: transparent !important;
    }
  </style>
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-yellow sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="<?php echo base_url(); ?>index.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>P</b>.io</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Palio</b>.io</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <!-- Menu toggle button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success"><?php echo $rowsnull; ?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have <?php echo $rowsnull; ?> messages</li>
              <li>
                <!-- inner menu: contains the messages -->
                <ul class="menu">
                  <?php for ($i = 0; $i < count($tempID); $i++) { ?>
                    <li style="<?php if ($tempIsRead[$i] == 0) { echo ('display: block;'); } else { echo ('display: none;'); } ?>"><!-- start message -->
                      <a href="/newdashboard/message.php?id=<?php echo $tempID[$i]; ?>">
                        <div class="pull-left">
                          <!-- User Image -->
                          <img src="/newdashboard/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                        </div>
                        <!-- Message title and timestamp -->
                        <h4>
                          Support Team
                          <!-- <small><i class="fa fa-clock-o"></i> 5 mins</small> -->
                        </h4>
                        <!-- The message -->
                        <?php
                          if ($tempMID[$i] == 1) {
                            echo ("<p>Welcome, " . $user["USERNAME"] . "! Thank you for trusting PalioSDK! Feel free to contact us if you have any question related to our services.<p>");
                          } elseif ($tempMID[$i] == 2) {
                            echo ("<p>Notice: Dear " . $user["USERNAME"] . ", we have not received your payment. Please make a payment immediately to continue using our services.</p>");
                          } elseif ($tempMID[$i] == 6) {
                            echo ("<p>Reminder: Dear " . $user["USERNAME"] . ", your selected package will be overdue on " . $bill["DUE_DATE"] . ".</p>");
                          } elseif ($tempMID[$i] == 3) {
                            echo ("<p>Notice: Dear " . $user["USERNAME"] . ", you have missed your monthly payment. Please make a payment immediately to continue using our services.</p>");
                          }
                          elseif ($tempMID[$i] == 4) {
                            echo ("<p>Reminder: Dear " . $user["USERNAME"] . ", your selected package will be cut off on " . $bill["CUT_OFF_DATE"] . ".</p>");
                          }
                          elseif ($tempMID[$i] == 5) {
                            echo ("<p>Notice: Dear " . $user["USERNAME"] . ", your package has been terminated. Thank you for using our services.</p>");
                          }
                        ?>
                      </a>
                    </li>
                  <?php } ?>
                  <!-- end message -->
                </ul>
                <!-- /.menu -->
              </li>
              <li class="footer"><a href="/newdashboard/mailbox.php">See All Messages</a></li>
            </ul>
          </li>
          <!-- /.messages-menu -->

          <!-- Notifications Menu -->
          <li class="dropdown notifications-menu">
            <!-- Menu toggle button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning"><?php echo $billsrow; ?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have <?php echo $billsrow; ?> unpaid bills</li>
              <li>
                <!-- Inner Menu: contains the notifications -->
                <ul class="menu">
                  <?php foreach ($bills as $charge) { ?>
                    <li><!-- start notification -->
                      <a href="/newdashboard/bills.php">
                        <i class="fa fa-warning text-yellow"></i> <?php echo $charge['CHARGE']; ?>
                      </a>
                    </li>
                  <?php } ?>
                  <!-- end notification -->
                </ul>
              </li>
              <li class="footer"><a href="/newdashboard/bills.php">View all</a></li>
            </ul>
          </li>
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="/newdashboard/dist/img/logo.png" class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs"><?php echo $itemUser['USERNAME']; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="/newdashboard/dist/img/logo.png" class="img-circle" alt="User Image">

                <p>
                  <?php echo $itemUser['USERNAME']; ?><br>
                  <small><?php echo $itemUser['COMPANY_NAME']; ?></small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <button type="button" class="btn btn-default btn-flat" data-toggle="modal" data-target="#modal-default">Profile</button>
                </div>
                <div class="pull-right">
                  <form method="post">
                    <button type="submit" class="btn btn-default btn-flat" name="submitLogout">Sign out</button>
                  </form>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar Menu -->
      <ul id="sidebar" class="sidebar-menu" data-widget="tree">
        <li class="header">Main Navigation</li>
        <!-- Optionally, you can add icons to the links -->
        <li id="overview" class="sidebar-btn"><a href="<?php echo base_url(); ?>newdashboard.php"><i class="fa fa-dashboard"></i> <span>Overview</span></a></li>
        <li id="usage" class="sidebar-btn"><a href="/newdashboard/usage.php"><i class="fa fa-pie-chart"></i> <span>Usage</span></a></li>
        <li id="bill" class="sidebar-btn"><a href="/newdashboard/bills.php"><i class="fa fa-dollar"></i> <span>Bill & Payment</span></a></li>
        <li id="support" class="sidebar-btn"><a href="/newdashboard/support.php"><i class="fa fa-users"></i> <span>Support</span></a></li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

<script>
  // Add active class to the current button (highlight it)
  var header = document.getElementById("sidebar");
  var btns = header.getElementsByClassName("sidebar-btn");
  for (var i = 0; i < btns.length; i++) {
    btns[i].addEventListener("click", function() {
      var current = document.getElementsByClassName("active");
      current[0].className = current[0].className.replace(" active", "");
      this.className += " active";
    });
  }
</script>
