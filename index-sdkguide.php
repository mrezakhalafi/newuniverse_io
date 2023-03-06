<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . '/url_function.php');

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
    <link rel="stylesheet" href="guide/plugins/fontawesome-free/css/all.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="guide/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="guide/dist/css/adminlte.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <!-- prettify -->
    <link rel="stylesheet" href="guide/prettify-sunburst.css">

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
            background-color: white !important;
            color: black !important;
        }

        [class*=sidebar-dark-] .nav-treeview>.nav-item>.nav-link.active {
            background-color: #1799ad !important;
            color: white !important;
        }

        [class*=sidebar-dark-] .nav-treeview>.nav-item>.nav-link:hover {
            background-color: #95f1ff;
            color: black !important;
        }

        [class*=sidebar-dark-] .nav-treeview>.nav-item>.nav-link.active:hover {
            background-color: #1799ad !important;
            color: white !important;
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
            color: black;
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

            #toggle-sidebar {
                display: none;
            }
        }
    </style>
</head>

<!--  data-bs-spy="scroll" data-bs-target="#sidenav" data-bs-offset="70" -->

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader d-none flex-column justify-content-center align-items-center">
            <!-- <img class="animation__wobble" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60"> -->
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-dark">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item" id="toggle-sidebar">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
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
            <a onclick="event.preventDefault()" class="brand-link">
                <img src="/green_newuniverse.png" alt="AdminLTE Logo" class="brand-image" style="opacity: .8">
                <!-- <span class="brand-text font-weight-light">AdminLTE 3</span> -->
            </a>

            <!-- Sidebar -->
            <div class="sidebar" style="overflow-y: hidden !important">

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
                            <!-- <a href="#head" class="nav-link active">
                                <p>
                                    Nexilis Android SDK
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a> -->
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a id="href-initialize-chat" href="#initialize-chat" class="nav-link active">
                                        <p>Initiating a Chat</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a id="href-initialize-voip" href="#initialize-voip" class="nav-link">
                                        <p>Initiating a VoIP Call</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a id="href-initialize-video" href="#initialize-video" class="nav-link">
                                        <p>Initiating a Video Call</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a id="href-initialize-voipvideo" href="#initialize-voipvideo" class="nav-link">
                                        <p>Initiating a VoIP/Video Call</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a id="href-initialize-ls" href="#initialize-ls" class="nav-link">
                                        <p>Initiating a Livestream</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a id="href-initialize-seminar" href="#initialize-seminar" class="nav-link">
                                        <p>Initiating a Webinar</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a id="href-notification-center" href="#notification-center" class="nav-link">
                                        <p>Notification Center</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a id="href-initialize-counter" href="#initialize-counter" class="nav-link">
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
            <div class="content-header d-none" style="visibility:hidden;">
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
                        <div class="col-12">
                            <!-- data-bs-spy="scroll" data-bs-target="#navbar-example5" -->
                            <div class="scrollspy-example-2">
                                <!-- <h4 id="head">Nexilis Android SDK</h4>
                                            <hr style="border-top: 2px solid blue; opacity: 1;">
                                            <p>
                                                The Nexilis Android SDK provides access to the Nexilis API for any Android applications. The most recent version of the Nexilis Android SDK can be found on a Maven Repository.
                                            </p> -->
                                <div class="row sections my-5" id="initialize-chat">
                                    <h5>Initiating a Chat</h5>
                                    <pre class="prettyprint lang-java">

    API.openChat();
                    </pre>

                                    <p>
                                        Call <i>API.openChat()</i> method from your application to start a 1-1 or a Group Conversation. This method will display the following <i>screen</i> that gives users the option to open old Conversations, start a new Conversation with another user in their Contact List, or start a new Group Conversation.
                                    </p>
                                    <img class="screenshot" src="guide/img/initiate_chat.png?v=<?= time(); ?>" />
                                </div>

                                <div class="row sections my-5" id="initialize-voip">
                                    <h5>Initiating a VoIP Call</h5>
                                    <pre class="prettyprint lang-java">

    API.openAudioCall();
                    </pre>

                                    <p>
                                        Call <i>API.openAudioCall</i> method from your application to start an Audio Call session with another user. This method will display the following <i>screen</i> that allows users to pick someone in their Contact List that they want to call. Once the Audio call session has been established, the participants may add/call another user to join and turn the session into a group call.
                                    </p>
                                    <img class="screenshot" src="guide/img/initiate_voip.png?v=<?= time(); ?>" />
                                </div>

                                <div class="row sections my-5" id="initialize-video">
                                    <h5>Initiating a Video Call</h5>
                                    <pre class="prettyprint lang-java">

    API.openVideoCall();
                    </pre>

                                    <p>
                                        Call <i>API.openVideoCall</i> method from your application to start an Video Call session with another user. This method will display the following <i>screen</i> that allows users to pick someone in their Contact List that they want to call. Once the Video call session has been established, the participants may add/call another user to join and turn the session into a group call.
                                    </p>
                                    <img class="screenshot" src="guide/img/initiate_videocall.png?v=<?= time(); ?>" />
                                </div>

                                <div class="row sections my-5" id="initialize-voipvideo">
                                    <h5>Initiating a VoIP/Video Call</h5>
                                    <pre class="prettyprint lang-java">

    API.openCall();
                        </pre>

                                    <p>
                                        Call <i>API.openCall</i> method from your application to start an Audio or Video Call session with another user. This method will display the following <i>screen</i> that allows users to pick someone in their Contact List that they want to call. Once the Video call session has been established, the participants may add/call another user to join and turn the session into a group call.
                                    </p>
                                    <img class="screenshot" src="guide/img/initiate_voipvideo.png?v=<?= time(); ?>" />
                                </div>

                                <div class="row sections my-5" id="initialize-ls">
                                    <h5>Initiating a Live Stream</h5>
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
                                    <img class="screenshot" src="guide/img/initiate_ls.png?v=<?= time(); ?>" />
                                </div>

                                <div class="row sections my-5" id="initialize-seminar">
                                    <h5>Initiating a Webinar</h5>
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
                                    <img class="screenshot" src="guide/img/initiate_seminar.png?v=<?= time(); ?>" />
                                </div>

                                <div class="row sections my-5" id="notification-center">
                                    <h5>Initiating a Notification Center</h5>
                                    <pre class="prettyprint lang-java">

    API.openNotificationCenter();
                    </pre>

                                    <p>
                                        Call <i>API.openNotificationCenter</i> method to display the Notification Center where the user can view incoming notifications containing information on new products, new policies, and product education. The backend API enables the developers to implement push notifications, in-app messages, and Call to Actions (CTAs) based on specific business processes and events.
                                    </p>
                                    <img class="screenshot" src="guide/img/notification_center.png?v=<?= time(); ?>" />
                                </div>

                                <div class="row sections my-5" id="initialize-counter">
                                    <h5>Unread Message Counter</h5>
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
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="guide/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="guide/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <!-- overlayScrollbars -->
    <script src="guide/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="guide/dist/js/adminlte.js"></script>
    <script src="guide/run_prettify.js"></script>
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

        $("a.nav-link").each(function() {
            $(this).click(function(e) {
                e.preventDefault();
                console.log($(this).attr("id"));
                let id = $(this).attr("id").substr(5);
                $('html, body').animate({
                    scrollTop: $('#' + id).offset().top - 25,
                    complete: function() {
                        $(this).addClass("active");
                        $("a.nav-link:not(#" + $(this).attr("id") + ")").removeClass('active');
                    }
                }, 100);
            })
        })

        addEventListener('load', function(event) {
            PR.prettyPrint();
            // $('body').scrollspy({ target: '#sidenav' })
            // hotfixScrollSpy();

            const sections = document.getElementsByClassName("sections");

            const observer = new IntersectionObserver((entries) => {
                for (const entry of entries)
                    if (entry.isIntersecting) {
                        console.log(entry.target.id);
                        document.querySelector("a.nav-link#href-" + entry.target.id).classList.add("active");
                        $("a.nav-link:not(#href-" + entry.target.id + ")").removeClass('active');
                    }
            }, {
                // rootMargin: "-50% 0px"
            });
            for (let i = 0; i < sections.length; i++)
                observer.observe(sections[i]);

            // var section = document.querySelectorAll(".sections");
            // var sections = {};
            // var i = 0;

            // Array.prototype.forEach.call(section, function(e) {
            //     sections[e.id] = e.offsetTop;
            // });

            // window.onscroll = function() {
            //     var scrollPosition = document.documentElement.scrollTop || document.body.scrollTop;

            //     for (i in sections) {
            //         if (sections[i] <= scrollPosition) {
            //             document.querySelector('a.nav-link.active').classList.remove("active");
            //             document.querySelector('a.nav-link[href*=' + i + ']').classList.add("active");
            //         }
            //     }
            // };
        }, false);
    </script>
</body>

</html>