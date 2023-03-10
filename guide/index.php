<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . '/url_function.php');

$from = '';
$from = $_GET['from'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Nexilis Android SDK</title>

  <link rel="icon" type="image/x-icon" href="<?php echo base_url(); ?>palio_logo_round.png">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <!-- prettify -->
  <link rel="stylesheet" href="prettify-sunburst.css">

  <style>
    body {
      position: relative;
    }

    table#reasonCode {
      border-top: 1px solid black;
      border-bottom: 1px solid black;
    }

    table#reasonCode,
    th,
    td {
      padding: 5px 10px;
      vertical-align: baseline;
    }

    .highlight-blue {
      color: #6aa4d9;
    }

    .screenshot {
      max-height: 500px;
      width: auto;
    }

    :target::before {
      content: "";
      display: block;
      height: 70px;
      /* fixed header height*/
      margin: -70px 0 0;
      /* negative fixed header height */
    }

    [class*=sidebar-dark-] {
      background-color: white;
    }

    .layout-navbar-fixed .wrapper .sidebar-dark-primary .brand-link:not([class*=navbar]) {
      background-color: white;
    }

    [class*=sidebar-dark] .brand-link {
      border-bottom: 0;
    }

    .navbar-dark {
      background-color: white;
      border-color: #dee2e6;
      ;
    }

    [class*=sidebar-dark-] .nav-treeview>.nav-item>.nav-link {
      color: black;
    }

    .sidebar-dark-primary .nav-sidebar>.nav-item>.nav-link.active {
      background-color: #1799ad;
    }

    [class*=sidebar-dark-] .nav-treeview>.nav-item>.nav-link:hover {
      background-color: #95f1ff;
      color: black;
    }

    [class*=sidebar-dark-] .nav-treeview>.nav-item>.nav-link.active:hover {
      background-color: #1799ad;
      color: white;
    }

    [class*=sidebar-dark-] .nav-treeview>.nav-item>.nav-link.active {
      background-color: #1799ad !important;
      color: white;
    }

    .navbar-dark .navbar-nav .nav-link {
      color: black;
      border-radius: .25rem;
    }

    .navbar-dark .navbar-nav .show>.nav-link {
      color: black;
    }

    #pfp-mini {
      max-height: 100%;
      width: auto;
      border-radius: 7px;
      margin-left: 5px;
    }

    .navbar-dark .navbar-nav .nav-link:focus {
      color: black;
    }

    .navbar-dark .navbar-nav .nav-link:hover {
      background-color: #95f1ff;
      color: black;
    }

    [class*=sidebar-dark-] .nav-sidebar>.nav-item.menu-open>.nav-link {
      background-color: #1799ad !important;
      color: white;
    }

    [class*=sidebar-dark-] .nav-sidebar>.nav-item>.nav-link:focus {
      color: white;
    }

    @media (max-width:768px) {
      #copyright-footer {
        text-align: center;
      }
    }

    @media (min-width: 1024px) {
      #slogan {
        float: right;
      }
    }

    .brand-link .brand-image {
      float: none !important;
    }
  </style>
</head>

<body class="hold-transition layout-fixed layout-navbar-fixed layout-footer-fixed" data-bs-spy="scroll" data-bs-target="#sidenav" data-bs-offset="70">
  <div class="wrapper">

    <!-- Preloader -->
    <div class="preloader d-none flex-column justify-content-center align-items-center">
      <!-- <img class="animation__wobble" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60"> -->
    </div>

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-dark">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item" style="margin-left: 10px">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i style="font-size: 20px" class="fas fa-bars"></i></a>
        </li>
        <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li> -->
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item dropdown d-none">
          <a class="nav-link d-flex align-items-center" id="username-dropdown" data-toggle="dropdown" href="#">
            <span id="username-top" style="font-size: 18px">qmerademo7341</span>
            <!-- <img src="http://newuniverse.com/dashboardv2/uploads/logo/Nyangami 4.jpg" id="pfp-mini"> -->
          </a>
          <div class="dropdown-menu dropdown-menu dropdown-menu-right">
            <!-- <button class="dropdown-item" data-toggle="modal" data-target="#profile-modal">
              <i class="fas fa-user mr-2"></i> Profile
            </button> -->
            <form method="POST" id="logoutUser">
              <button type="submit" name="submitLogout" class="dropdown-item" id="logoutButton">
                <i class="fas fa-sign-out-alt mr-2"></i> <span data-translate="dashside-8">Sign out</span>
              </button>
            </form>
          </div>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="https://newuniverse.io" class="brand-link text-center">
        <img src="/green_newuniverse.png" alt="AdminLTE Logo" class="brand-image" style="opacity: .8">
        <!-- <span class="brand-text font-weight-light">AdminLTE 3</span> -->
      </a>

      <!-- Sidebar -->
      <div class="sidebar">

        <!-- SidebarSearch Form -->
        <div class="form-inline mt-3 d-none">
          <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-sidebar">
                <i class="fas fa-search fa-fw"></i>
              </button>
            </div>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2" id="sidenav">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item menu-open">
              <a href="#head" class="nav-link active">
                <p>
                  Nexilis Android SDK
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="#installation" class="nav-link">
                    <p>Installation</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#initialize-client" class="nav-link">
                    <p>Initializing the Client</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#initialize-chat" class="nav-link">
                    <p>Initiating a Chat</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#initialize-voip" class="nav-link">
                    <p>Initiating a VoIP Call</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#initialize-video" class="nav-link">
                    <p>Initiating a Video Call</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#initialize-voipvideo" class="nav-link">
                    <p>Initiating a VoIP/Video Call</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#initialize-ls" class="nav-link">
                    <p>Initiating a Livestream</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#initialize-seminar" class="nav-link">
                    <p>Initiating a Webinar</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#notification-center" class="nav-link">
                    <p>Notification Center</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#initialize-counter" class="nav-link">
                    <p>Unread Message Counter</p>
                  </a>
                </li>
              </ul>
            </li>

          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header" style="visibility:hidden;">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Dashboard v2</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Dashboard v2</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content mb-5">

        <div class="container-fluid mt-3">
          <div class="row">
            <div class="col-sm-12">

              <?php if ($from == 1) : ?>
                <a href="<?= base_url(); ?>dashboardv2/support.php" style="text-decoration: none"><span style="font-family:'Josefin Sans', sans-serif">&lt;&lt; <span id="back-inbox-text">Back to Support</span></span></a>
              <?php elseif ($from == 2) : ?>
                <a href="<?= base_url(); ?>dashboardv2/mailbox.php" style="text-decoration: none"><span style="font-family:'Josefin Sans', sans-serif">&lt;&lt; <span id="back-inbox-text">Back to Mailbox</span></span></a>
              <?php endif; ?>

              <h1 id="head" class="mt-3">Nexilis Android SDK</h1>
              <hr style="border-top: 2px solid blue; opacity: 1;">
              <p>
                The Nexilis Android SDK provides access to the Nexilis API for any Android applications. The most recent version of the Nexilis Android SDK can be found on a Maven Repository.
              </p>

              <div id="installation">
                <h4 class="mt-5">Installation</h4>
                <p>
                  Please include the following lines into your <i>app\build.gradle</i> file to add the required Nexilis dependencies in your existing project.
                </p>
                <pre class="prettyprint">

  android {
    defaultConfig {
        minSdkVersion 23 // Android SDK version 23 or later is required
        multiDexEnabled true
    }

    compileOptions {
        sourceCompatibility JavaVersion.VERSION_1_8
        targetCompatibility JavaVersion.VERSION_1_8
    }

    android {
    packagingOptions {
          doNotStrip "*/armeabi-v7a/*.so"
          doNotStrip "*/arm64-v8a/*.so"

          exclude 'META-INF/DEPENDENCIES'
          exclude 'META-INF/LICENSE'
          exclude 'META-INF/LICENSE.txt'
          exclude 'META-INF/license.txt'
          exclude 'META-INF/NOTICE'
          exclude 'META-INF/NOTICE.txt'
          exclude 'META-INF/notice.txt'
          exclude 'META-INF/ASL2.0'
      }
  }

  repositories {
    maven {
        url "***REPLACE***WITH***NEXILIS***ARTIFACTORY***"
        credentials {
            username = "***REPLACE***WITH***YOUR***MAVEN***USERNAME***"
            password = "***REPLACE***WITH***YOUR***MAVEN***PASSWORD***"
        }
    }
  }

  dependencies {
    // *** Add nexilis Lite dependencies ***
    implementation('**REPLACE*WITH*VERSION*LIBRARY**') {
        exclude group: 'org.apache.httpcomponents'
        transitive = true
        }
    }

            </pre>

                <p>
                  If you want to optimize or obfuscate your project, please make sure to add the following lines into your <i>proguard-rules.pro</i> file.
                </p>
                <pre class="prettyprint">

  -verbose
  -optimizationpasses 14
  -allowaccessmodification
  -overloadaggressively
  -flattenpackagehierarchy
  -keeppackagenames doNotKeepAThing

  -obfuscationdictionary dictionary.txt
  -classobfuscationdictionary classdictionary.txt

  # *******************************************************************************************************
  -keep class * { native <methods>; }
  -keep class androidx.core.app.** { public *; }
  -keep class com.google.android.** { *; }
  -keep class com.google.mlkit.** { *; }
  -keep interface com.google.android.** { *; }

  -keep public class javax.mail.** { *; }
  -keep public class com.sun.mail.** { *; }
  -keep public class org.apache.harmony.** { *; }

  # *******************************************************************************************************
  -keep class net.sqlcipher.** { *; }
  -keep public class * implements com.bumptech.glide.module.GlideModule
  -keep public class * extends com.bumptech.glide.module.AppGlideModule
  -keep public enum com.bumptech.glide.load.ImageHeaderParser$** { **[] $VALUES; public *; }
            </pre>
              </div>
              <div id="initialize-client">
                <h4 class="mt-5">Initializing the Client</h4>
                <p>
                  Import the following libraries into your <i>MainActivity.java</i> file.
                </p>
                <pre class="prettyprint lang-java">

  import io.nexilis.service.Callback;
  import io.nexilis.service.API;
            </pre>

                <p>
                  Add the <i>API.connect</i> method to start Nexilis’s background service on the Client side and connect to the Nexilis Server.
                </p>
                <pre class="prettyprint lang-java">

  API.connect("***REPLACE***WITH***YOUR***NEXILIS***ACCOUNT***", this, new Callback() {
    @Override
    public void onSuccess(final String NexilisUserID) {
        // Handle onSuccess event here.
        // This callback will be triggered automatically when the Nexilis service is 
        // successfully started, and the Client connected to the Server.
    }

    @Override
    public void onFailed(final String reasonCode) {
        // Handle onFailed event here.
        // This callback will be triggered automatically when there is an issue during
        // the execution of API.connect method.
    }
  });
              </pre>

                <p>
                  The <span class="highlight-blue">NexilisUserID</span> will be generated automatically when the Nexilis service has been initiated successfully for the first time. You can bind a <span class="highlight-blue">NexilisUserID</span> with a User ID on the application level. For example, a <span class="highlight-blue">NexilisUserID</span> (User001) can be mapped into a corresponding Application User ID (John Doe), thereby keeping your application level User ID inaccessible to Nexilis while still being able to monitor your user activities.
                </p>

                <p>
                  The following <span class="highlight-blue">reasonCode</span> will be passed to an <i>onFailed</i> callback when Nexilis encounters an issue during the execution of the <i>API.connect</i> method.
                </p>

                <table id="reasonCode">
                  <thead>
                    <th>reasonCode</th>
                    <th>Description</th>
                  </thead>
                  <tbody>
                    <tr>
                      <td>02</td>
                      <td>Your trial period has expired. Please subscribe to keep using Nexilis service</td>
                    </tr>
                    <tr>
                      <td>03</td>
                      <td>Your monthly subscription bill has not been fully paid. Please pay your monthly subscription in full to keep using Nexilis service</td>
                    </tr>
                    <tr>
                      <td>04</td>
                      <td>Your Customer Engagement Credit has run out and your Prepaid Credit Balance is empty. Please top up your Prepaid Credit Balance to keep using Nexilis service</td>
                    </tr>
                    <tr>
                      <td>23</td>
                      <td>Android version not supported</td>
                    </tr>
                    <tr>
                      <td>91</td>
                      <td>Invalid username</td>
                    </tr>
                    <tr>
                      <td>92</td>
                      <td>Username is empty</td>
                    </tr>
                    <tr>
                      <td>93</td>
                      <td>The required overlay permission is not granted</td>
                    </tr>
                    <tr>
                      <td>94</td>
                      <td>Unregistered user</td>
                    </tr>
                    <tr>
                      <td>95</td>
                      <td>Invalid Service mode is not valid (1/2/3)</td>
                    </tr>
                    <tr>
                      <td>96</td>
                      <td>Activity is null</td>
                    </tr>
                    <tr>
                      <td>97</td>
                      <td>Empty account</td>
                    </tr>
                    <tr>
                      <td>98</td>
                      <td>Your account doesn't match</td>
                    </tr>
                    <tr>
                      <td>99</td>
                      <td>An error occurred</td>
                    </tr>
                    <tr>
                      <td>101</td>
                      <td>Unable to access the server. Please check your connection and try again.</td>
                    </tr>
                    <tr>
                      <td>102</td>
                      <td>Duplicate username</td>
                    </tr>
                    <tr>
                      <td>103</td>
                      <td>Empty username</td>
                    </tr>
                    <tr>
                      <td>104</td>
                      <td>Username is too short</td>
                    </tr>
                    <tr>
                      <td>105</td>
                      <td>Username is too long</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <h4 class="mt-5" id="initialize-chat">Initiating a Chat</h4>
              <pre class="prettyprint lang-java">

  API.openChat();
                </pre>

              <p>
                Call <i>API.openChat()</i> method from your application to start a 1-1 or a Group Conversation. This method will display the following <i>screen</i> that gives users the option to open old Conversations, start a new Conversation with another user in their Contact List, or start a new Group Conversation.
              </p>
              <img class="screenshot" src="img/initiate_chat.png?v=<?= time(); ?>" />

              <h4 class="mt-5" id="initialize-voip">Initiating a VoIP Call</h4>
              <pre class="prettyprint lang-java">

  API.openAudioCall();
                </pre>

              <p>
                Call <i>API.openAudioCall</i> method from your application to start an Audio Call session with another user. This method will display the following <i>screen</i> that allows users to pick someone in their Contact List that they want to call. Once the Audio call session has been established, the participants may add/call another user to join and turn the session into a group call.
              </p>
              <img class="screenshot" src="img/initiate_voip.png?v=<?= time(); ?>" />

              <h4 class="mt-5" id="initialize-video">Initiating a Video Call</h4>
              <pre class="prettyprint lang-java">

  API.openVideoCall();
                </pre>

              <p>
                Call <i>API.openVideoCall</i> method from your application to start an Video Call session with another user. This method will display the following <i>screen</i> that allows users to pick someone in their Contact List that they want to call. Once the Video call session has been established, the participants may add/call another user to join and turn the session into a group call.
              </p>
              <img class="screenshot" src="img/initiate_videocall.png?v=<?= time(); ?>" />

              <h4 class="mt-5" id="initialize-voipvideo">Initiating a VoIP/Video Call</h4>
              <pre class="prettyprint lang-java">

  API.openCall();
                </pre>

              <p>
                Call <i>API.openCall</i> method from your application to start an Audio or Video Call session with another user. This method will display the following <i>screen</i> that allows users to pick someone in their Contact List that they want to call. Once the Video call session has been established, the participants may add/call another user to join and turn the session into a group call.
              </p>
              <img class="screenshot" src="img/initiate_voipvideo.png?v=<?= time(); ?>" />

              <h4 class="mt-5" id="initialize-ls">Initiating a Livestreaming</h4>
              <pre class="prettyprint lang-java">

  API.openLiveStreaming();
                </pre>

              <p>
                Call <i>API.openLiveStreaming</i> method from your application to start a Live Streaming session. This method display the following <i>screen</i> where the user can specify:
              </p>
              <ul>
                <li>The Target Audience</li>
                <li>The Notification Type (Push Notification or In-App)</li>
                <li>The Title and Tagline of the Live Stream</li>
              </ul>
              <p>
                Once the Live Stream session is successfully initiated, the Target Audience will receive a Notification with an option to join/watch the streaming session.
              </p>
              <img class="screenshot" src="img/initiate_ls.png?v=<?= time(); ?>" />

              <h4 class="mt-5" id="initialize-seminar">Initiating a Webinar</h4>
              <pre class="prettyprint lang-java">

  API.openSeminar();
                </pre>

              <p>
                Call <i>API.openSeminar</i> method from your application to start a Webinar session. This method display the following <i>screen</i> where the user can specify:
              </p>
              <ul>
                <li>The Target Audience</li>
                <li>The Notification Type (Push Notification or In-App)</li>
                <li>The Title and Tagline of the Seminar</li>
              </ul>
              <p>
                Once the Webinar session is successfully initiated, the Target Audience will receive a Notification with an option to join/watch the webinar session. Like other Webinar software, members of the audience may (digitally) raise their hand to signify that they have something to say, and moderators may give members of the audience a chance to speak by allowing them to speak in the session.
              </p>
              <img class="screenshot" src="img/initiate_seminar.png?v=<?= time(); ?>" />

              <h4 class="mt-5" id="notification-center">Initiating a Notification Center</h4>
              <pre class="prettyprint lang-java">

  API.openNotificationCenter();
                </pre>

              <p>
                Call <i>API.openNotificationCenter</i> method to display the Notification Center where the user can view incoming notifications containing information on new products, new policies, and product education. The backend API enables the developers to implement push notifications, in-app messages, and Call to Actions (CTAs) based on specific business processes and events.
              </p>
              <img class="screenshot" src="img/notification_center.png?v=<?= time(); ?>" />

              <h4 class="mt-5" id="initialize-counter">Unread Message Counter</h4>
              <pre class="prettyprint lang-xml">

  &lt;io.nexilis.service.view.CounterView
      android:layout_width="30dp"
      android:layout_height="30dp"
      app:pb_background_color="#FF0000"
      app:pb_text_color="#FFFFFF"
      app:layout_constraintLeft_toLeftOf="parent"
      app:layout_constraintRight_toRightOf="parent"
      app:layout_constraintBottom_toTopOf="@id/text"/&gt;
                </pre>

              <p>
                Add the xml element above to display the number of unread incoming messages. You can place it anywhere in your layout (.xml) file.
              </p>
            </div>
          </div>
        </div>

      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">
      <div class="container-fluid">
        <div class="row" id="copyright-footer">
          <div class="col-12 col-lg-6">
            <strong>Copyright &copy; 2022 nexilis.</strong>
            All rights reserved.
          </div>
          <div class="col-12 col-lg-6">
            <strong><span id="slogan"><span style="color:black;">Customer Engagement, </span><span style="color:#f2ad33;">Made Easy</span></span></strong>
          </div>
        </div>
      </div>
    </footer>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->
  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
  <!-- overlayScrollbars -->
  <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.js"></script>
  <script src="run_prettify.js"></script>
  <script>
    function hotfixScrollSpy() {
      var dataSpyList = [].slice.call(document.querySelectorAll('[data-spy="scroll"]'))
      let curScroll = getCurrentScroll();
      dataSpyList.forEach(function(dataSpyEl) {
        let offsets = bootstrap.ScrollSpy.getInstance(dataSpyEl)['_offsets'];
        for (let i = 0; i < offsets.length; i++) {
          offsets[i] += curScroll;
        }
      })
    }

    function getCurrentScroll() {
      return window.pageYOffset || document.documentElement.scrollTop;
    }

    addEventListener('load', function(event) {
      PR.prettyPrint();
      // $('body').scrollspy({ target: '#sidenav' })
      hotfixScrollSpy();
    }, false);
  </script>
</body>

</html>

<script>
  // var navVal = 0;

  // $(".navbar-nav").on("click", function() {

  //   if (navVal == 1) {
  //     navVal = 0;
  //     $(".brand-image").removeClass("d-none");
  //   } else {
  //     navVal = 1;
  //     $(".brand-image").addClass("d-none");
  //   }
  //   console.log(navVal);

  // });

  // $('.main-sidebar').hover(function() {

  //     setTimeout(function() {
  //       if ($('.sidebar').hasClass('os-host-scrollbar-horizontal-hidden')) {
  //         $('.brand-image').removeClass('d-none');
  //       } else {
  //         $('.brand-image').addClass('d-none');
  //       }
  //     }, 270);


  //   },

  //   function() {
  //     setTimeout(function() {
  //       if ($('.sidebar').hasClass('os-host-scrollbar-horizontal-hidden')) {
  //         $('.brand-image').removeClass('d-none');
  //       } else {

  //         $('.brand-image').addClass('d-none');
  //       }
  //     }, 270);

  //   });
</script>