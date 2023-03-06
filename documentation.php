<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <!-- <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css"> -->
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <!-- <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css"> -->
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <!-- <link rel="stylesheet" href="bower_components/morris.js/morris.css"> -->
  <!-- jvectormap -->
  <!-- <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css"> -->
  <!-- ss -->
  <!-- <link rel="stylesheet" href="./css/prettify.css"> -->
  <!-- Pretify -->
  <script type="text/javascript" src="./js/prettify.js"></script>
  <!-- bootstrap wysihtml5 - text editor -->
  <script src="./js/jquery-3.4.1.js"></script>

  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <script src="bootstrap/js/bootstrap.bundle.min.js"></script>

  <script type="text/javascript" src="./js/animatescroll.js"></script>

  <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

  <!-- apexchart -->
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

  <link rel="stylesheet" type="text/css" href="./css/Chart.css">
  <script type="text/javascript" src="./js/Chart.js"></script>
  <script src="./js/timezones.full.js"></script>
  <link rel="stylesheet" type="text/css" href="./css/custom.css">
  <link rel="stylesheet" type="text/css" href="./css/api_web.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="./fonts/poppins/style.css">

  <!-- SEGOE -->
  <link rel="stylesheet" href="./fonts/segoe-ui/style.css">
</head>

<style>
/* width */
::-webkit-scrollbar {
  width: 5px;
}

/* Track */
::-webkit-scrollbar-track {
  background: #f1f1f1; 
}

/* Handle */
::-webkit-scrollbar-thumb {
  background: #888; 
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #555; 
}

/* THEME FOR PRETTIFY/*
/* Pretty printing styles. Used with prettify.js. */
/* Vim sunburst theme by David Leibovic */

pre .str, code .str { color: #65B042; } /* string  - green */
pre .kwd, code .kwd { color: #E28964; } /* keyword - dark pink */
pre .com, code .com { color: #AEAEAE; font-style: italic; } /* comment - gray */
pre .typ, code .typ { color: #89bdff; } /* type - light blue */
pre .lit, code .lit { color: #3387CC; } /* literal - blue */
pre .pun, code .pun { color: #fff; } /* punctuation - white */
pre .pln, code .pln { color: #fff; } /* plaintext - white */
pre .tag, code .tag { color: #89bdff; } /* html/xml tag    - light blue */
pre .atn, code .atn { color: #bdb76b; } /* html/xml attribute name  - khaki */
pre .atv, code .atv { color: #65B042; } /* html/xml attribute value - green */
pre .dec, code .dec { color: #3387CC; } /* decimal - blue */

pre.prettyprint, code.prettyprint {
	background-color: #333;
}

pre.prettyprint {
	width: 100%;
	margin: 0 auto;
	padding: 1em;
	white-space: pre-wrap;
}


/* Specify class=linenums on a pre to get line numbering */
ol.linenums { margin-top: 0; margin-bottom: 0; color: #AEAEAE; } /* IE indents via margin-left */
li.L0,li.L1,li.L2,li.L3,li.L5,li.L6,li.L7,li.L8 { list-style-type: none }
/* Alternate shading for lines */
li.L1,li.L3,li.L5,li.L7,li.L9 { }

li.L0, li.L1, li.L2, li.L3,
li.L5, li.L6, li.L7, li.L8 {
  list-style-type: decimal !important;
}

@media print {
  pre .str, code .str { color: #060; }
  pre .kwd, code .kwd { color: #006; font-weight: bold; }
  pre .com, code .com { color: #600; font-style: italic; }
  pre .typ, code .typ { color: #404; font-weight: bold; }
  pre .lit, code .lit { color: #044; }
  pre .pun, code .pun { color: #440; }
  pre .pln, code .pln { color: #000; }
  pre .tag, code .tag { color: #006; font-weight: bold; }
  pre .atn, code .atn { color: #404; }
  pre .atv, code .atv { color: #060; }
}

.table.table-bordered, .table.table-bordered th, .table.table-bordered tr, .table.table-bordered td{
  border: 1px solid #707070 !important;
}

html{
  scroll-behavior: unset;
}

.nav-link{
  color: #343a40 !important;
  font-weight : bold;
}

.nav-link:hover{
  background-color: #f8f9fa !important;
}

.nav-link.active{
  background-color: #ccc !important;
}

@media screen and (max-width: 768px){

  .side-men{
    background-color: #1A72E8 !important;
    border-right: 0;
    margin-top: 115px;
  }
}

@media screen and (min-width: 769px){

  .side-men{
    background-color: #1A72E8 !important;
    border-right: 0;
    margin-top: 55px;
  }
}

</style>

<body id="ini-scroll" class="hold-transition skin-black-light fixed sidebar-mini" onload="PR.prettyPrint()" data-spy="scroll" data-target="#navbar-example3" data-offset="0" style="font-family: 'Segoe UI Regular' !important; position: relative;">
 <div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a class="logo border-0 text-left" href="newdashboard.php" style="height: 54px; font-size: 40px; color: #3862D3; background-color: #1A72E8">
      <img src="./newAssets/new-u-logo-alt.svg" style="height: 55px; width: auto;">
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top p-0" style="background-color: #1A72E8">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button" style="border-left: 1px solid #d2d6de !important; margin-left: -1px !important; border-right: none !important;">
        <span class="sr-only">Toggle navigation</span>
      </a>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar" style="left: 0; bottom: 0;">
    <!-- sidebar: style can be found in sidebar.less -->
    <section id="menu-side" class="sidebar" style="overflow-y: auto; position: relative; height: 100%;">
      <!-- Sidebar user panel -->
      <!-- sidebar menu: : style can be found in sidebar.less -->

      <nav id="navbar-example3" class="navbar navbar-light bg-light flex-column px-0">
        <nav class="nav nav-pills flex-column text-left w-100">
          <a class="nav-link active" href="#introduction">Introduction</a>
          <a class="nav-link" href="#">Register Company</a>
          <a class="nav-link" href="#download">Download</a>
          <a class="nav-link" href="#reqpermission">Request Permission</a>
          <a class="nav-link" href="#howtostart">How to Start API</a>
          <a class="nav-link" href="#listofapi">List of API</a>
          <a class="nav-link ml-2" href="#contact">Contact</a>
          <a class="nav-link ml-4" href="#addcontact">Add Contact</a>
          <a class="nav-link ml-2" href="#audio">Audio Call</a>
          <a class="nav-link ml-4" href="#initaudio">Initiate Audio Call</a>
          <a class="nav-link ml-4" href="#regaudio">Register Audio Call Receiver</a>
          <a class="nav-link ml-4" href="#accaudio">Accept Audio Call</a>
          <a class="nav-link ml-4" href="#rejectaudio">Reject Audio Call</a>
          <a class="nav-link ml-4" href="#endaudio">End Audio Call</a>
          <a class="nav-link ml-2" href="#video">Video Call</a>
          <a class="nav-link ml-4" href="#initvideo">Initiate Video Call</a>
          <a class="nav-link ml-4" href="#regvideo">Register Video Call Receiver</a>
          <a class="nav-link ml-4" href="#accvideo">Accept Video Call</a>
          <a class="nav-link ml-4" href="#rejectvideo">Reject Video Call</a>
          <a class="nav-link ml-4" href="#endvideo">End Video Call</a>
          <a class="nav-link ml-2" href="#ls">Live Streaming</a>
          <a class="nav-link ml-4" href="#startls">Start Live Streaming</a>
          <a class="nav-link ml-4" href="#getlslist">Get Live Streaming List</a>
          <a class="nav-link ml-4" href="#joinls">Join Live Streaming</a>
          <a class="nav-link ml-4" href="#leftls">Left Live Streaming</a>
          <a class="nav-link ml-4" href="#endls">End Live Streaming</a>
          <a class="nav-link ml-2" href="#im">Instant Messaging</a>
          <a class="nav-link ml-4" href="#sendim">Send Message</a>
          <a class="nav-link ml-4" href="#regim">Register Message Receiver</a>
          <a class="nav-link ml-4" href="#imreceiver">Message Receiver</a>
          <a class="nav-link ml-4" href="#imstatus">Message Status</a>
          <a class="nav-link ml-4" href="#uploadstatus">Upload Status</a>
          <a class="nav-link ml-4" href="#sendtyping">Send Typing</a>
          <a class="nav-link ml-4" href="#regtyping">Register Typing Receiver</a>
          <a class="nav-link ml-4" href="#typingreceiver">Typing Receiver</a>
          <a class="nav-link ml-2" href="#forumchnl">Forum and Channel</a>
          <a class="nav-link ml-4" href="#crtforum">Create Forum</a>
          <a class="nav-link ml-4" href="#updtforumname">Update Forum Name</a>
          <a class="nav-link ml-4" href="#updtforumdesc">Update Forum Description</a>
          <a class="nav-link ml-4" href="#updtforumpict">Update Forum Picture</a>
          <a class="nav-link ml-4" href="#joinforum">Join Forum</a>
          <a class="nav-link ml-4" href="#leaveforum">Leave Forum</a>
          <a class="nav-link ml-4" href="#rmforum">Remove Forum</a>
          <a class="nav-link ml-4" href="#addmmbr">Add Member</a>
          <a class="nav-link ml-4" href="#rmmmbr">Remove Member</a>
          <a class="nav-link ml-4" href="#setadm">Set Admin</a>
          <a class="nav-link ml-4" href="#rmadm">Remove Admin</a>
          <a class="nav-link ml-4" href="#addtopic">Add Topic</a>
          <a class="nav-link ml-4" href="#rmtopic">Remove Topic</a>
          <a class="nav-link ml-4" href="#regforumcb">Register Forum Callback</a>
          <a class="nav-link ml-4" href="#forumcb">Forum Callback</a>
        </nav>
      </nav>
    </section>
    <!-- /.sidebar -->
  </aside>

  <div class="content-wrapper" style="height: 100% !important;">

    <span id="introduction">&nbsp;</span>
    
    <div class="container mx-4 mt-5">
      <div class="row">
        <div class="col-lg-12">
          <span style="font-size: 25px;"><b>Introduction</b></span><br>
          <div class="mt-2" style="font-size: 16px;">
            This document provides detailed documentation for the New Universe Service API (nuSDK) Specification.
            This API allows developer to implement communication feature quickly and easily.
            Here are some features provided in this API:
          </div>
          <div class="mt-1 mb-2" style="font-size: 16px;">
            1. Contact<br>2. Audio Call<br>3. Video Call<br>4. Live Streaming<br>5. Instant Messaging<br><span id="download">6. Forum and Channel</span>
          </div>
        </div> <!-- End Col -->
      </div> <!-- End Row -->


      <div class="row mt-4">
        <div class="col-lg-11">
          <span style="font-size: 25px;"><b>Download</b></span><br>
          <div class="mt-2" style="font-size: 16px;">
            Download API with Use Gradle:
          </div>
          <pre class="prettyprint linenums:1 mt-2 mb-4">
repositories {
        google()
        jcenter()

        maven {
            url "http://202.158.33.27:8040/artifactory/libs-release-local"
            credentials {
                username = "${artifactory_username}"
                password = "${artifactory_password}"
            }
        }
    }

dependencies {
    implementation 'easySoft.co.id:nuSDK:1.0.3'
}

artifactory_username = easysoft
artifactory_password = AP2bu1aYdZFduSgLot1kLFBBfqS
          </pre>
        </div> <!-- End Col -->
      </div> <!-- End Row -->

      <span id="reqpermission">&nbsp;</span>

      <div class="row mt-4">
        <div class="col-lg-11">
          <span style="font-size: 25px;"><b>Request Permission</b></span><br>
          <div class="mt-2" style="font-size: 16px;">
           To implement functions in this API, developer must implement request for these permissions:
          </div>
          <pre class="prettyprint linenums:1 mt-2 mb-4">
&lt;manifest xmlns:android="http://schemas.android.com/apk/res/android"
          package="easySoft.co.id.app"&gt;

    &lt;uses-permission android:name="android.permission.ACCESS_NETWORK_STATE"/&gt;
    &lt;uses-permission android:name="android.permission.ACCESS_WIFI_STATE"/&gt;
    &lt;uses-permission android:name="android.permission.CAMERA"/&gt;
    &lt;uses-permission android:name="android.permission.WRITE_EXTERNAL_STORAGE"/&gt;
    &lt;uses-permission android:name="android.permission.INTERNET"/&gt;
    &lt;uses-permission android:name="android.permission.RECEIVE_BOOT_COMPLETED"/&gt;
    &lt;uses-permission android:name="android.permission.REQUEST_IGNORE_BATTERY_OPTIMIZATIONS"/&gt;
    &lt;uses-permission android:name="android.permission.WAKE_LOCK"/&gt;
    &lt;uses-permission android:name="android.permission.MODIFY_AUDIO_SETTINGS" /&gt;
    &lt;uses-permission android:name="android.permission.RECORD_VIDEO" /&gt;
    &lt;uses-permission android:name="android.permission.RECORD_AUDIO" /&gt;
   
     ...

&lt;/manifest&gt;
          </pre>
        </div> <!-- End Col -->
      </div> <!-- End Row -->

      <span id="howtostart">&nbsp;</span>

      <div class="row mt-4">
        <div class="col-lg-11">
          <span style="font-size: 25px;"><b>How to Start API</b></span><br>
          <div class="mt-2" style="font-size: 16px;">
           This example code to start API:
          </div>
          <pre class="prettyprint linenums:1 mt-2 mb-4">
...

override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_main_example)

                        . . . 


        nuSDK.setUsername(userName)
        nuSDK.setAPIKey(apiKey)
        nuSDK.setURL("http://192.168.0.31/NUs/Service/")
        nuSDK.bind(this, object : nuSDK.BindListener {
                override fun success() {
                    this@MainExampleActivity.runOnUiThread(Runnable {
                        textView?.text = "Success "+ userName
                        progressBar?.visibility = View.INVISIBLE
                    })
                }

                override fun failed(message: String?) {
                    textView?.text = message
                    progressBar?.visibility = View.INVISIBLE
                }
        })
             
}

...
          </pre>
        </div> <!-- End Col -->
      </div> <!-- End Row -->

      <span id="listofapi">&nbsp;</span>

      <div class="row mt-4">
        <div class="col-lg-12">


          <span id="contact" style="font-size: 25px;"><b>List of API</b></span><br>
          <div id="addcontact" class="mt-2" style="font-size: 20px;">
            <b>Contact</b>
          </div>
          <div class="mt-2" style="font-size: 18px;">
            <b>Add Contact</b>
          </div>
          <div style="font-size: 15px;">
            Function to add contact with input parameter userName.
          </div>
          <div style="font-size: 15px;">
            Method:
          </div>
          <div style="font-size: 15px;">
            <i>API.addContact(String userName);</i>
          </div>
          <div style="font-size: 15px;">
            Input Parameter:
          </div>
          <table class="table table-bordered w-75 border-70" style="font-size: 15px;">
            <thead class="text-center">
              <tr>
                <th>Field</th>
                <th>Type</th>
                <th>Description</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>userName</td>
                <td>String</td>
                <td>
                  Unique identification of user who will added to contact such as name, email, phone number, or others
                </td>
              </tr>
            </tbody>
          </table>

          <span id="audio">&nbsp;</span>

          <div id="initaudio" class="mt-4" style="font-size: 20px;">
            <b>Audio Call</b>
          </div>
          <div class="mt-2" style="font-size: 18px;">
            <b>Initiate Audio Call</b>
          </div>
          <div style="font-size: 15px;">
            Function to initiate audio call with input parameters userName and initiateAudioCallBack.
          </div>
          <div style="font-size: 15px;">
            Method:
          </div>
          <div style="font-size: 15px;">
            <i>API.initiateAudioCall(String userName, Interface initiateAudioCallBack);</i>
          </div>
          <div style="font-size: 15px;">
            Input Parameter:
          </div>
          <table class="table table-bordered w-75" style="font-size: 15px;">
            <thead class="text-center">
              <tr>
                <th>Field</th>
                <th>Type</th>
                <th>Description</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>userName</td>
                <td>String</td>
                <td>
                  Unique identification of user who will added to contact such as name, email, phone number, or others
                </td>
              </tr>
              <tr>
                <td>initiateAudioCallBack</td>
                <td>Interface</td>
                <td>
                  A callback interface when initiating audio call
                </td>
              </tr>
            </tbody>
          </table>
          <div style="font-size: 15px;">
           initiateAudioCallBack:
          </div>
          <table class="table table-bordered w-75" style="font-size: 15px;">
            <thead class="text-center">
              <tr>
                <th>Field</th>
                <th>Type</th>
                <th>Description</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>userName</td>
                <td>String</td>
                <td>
                  Unique identification of user who will added to contact such as name, email, phone number, or others
                </td>
              </tr>
              <tr>
                <td>state</td>
                <td>Integer</td>
                <td>
                  State flow that determine which initiateAudioCallBack will be called
                </td>
              </tr>
              <tr>
                <td>message</td>
                <td>String</td>
                <td>
                  String data as needed separated by commas
                </td>
              </tr>
            </tbody>
          </table>
          <div style="font-size: 15px;">
          state:
          </div>
          <table class="table table-bordered w-50" style="font-size: 15px;">
            <thead class="text-center">
              <tr>
                <th>Value</th>
                <th>Description</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="text-center">1</td>
                <td>Offline</td>
              </tr>
              <tr>
                <td class="text-center">2</td>
                <td>User Not Found</td>
              </tr>
              <tr>
                <td class="text-center">3</td>
                <td>Busy</td>
              </tr>
              <tr>
                <td class="text-center">4</td>
                <td>Audio Ringing</td>
              </tr>
              <tr>
                <td class="text-center">5</td>
                <td>Audio Connected</td>
              </tr>
              <tr>
                <td class="text-center">6</td>
                <td>Audio Terminate</td>
              </tr>
            </tbody>
          </table>

          <span id="regaudio">&nbsp;</span>

          <div class="mt-4" style="font-size: 18px;">
            <b>Register Audio Call Receiver</b>
          </div>
          <div style="font-size: 15px;">
            Function to register audio call on audioCallReceiver.
          </div>
          <div style="font-size: 15px;">
            Method:
          </div>
          <div style="font-size: 15px;">
            <i>API.registerAudioCallReceiver(Interface audioCallReceiver);</i>
          </div>
          <div style="font-size: 15px;">
            Input Parameter:
          </div>
          <table class="table table-bordered w-75" style="font-size: 15px;">
            <thead class="text-center">
              <tr>
                <th>Field</th>
                <th>Type</th>
                <th>Description</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>audioCallReceiver</td>
                <td>Interface</td>
                <td>
                  A callback interface when receiving audio call
                </td>
              </tr>
            </tbody>
          </table>
          <div style="font-size: 15px;">
            audioCallReceiver:
          </div>
          <table class="table table-bordered w-75" style="font-size: 15px;">
            <thead class="text-center">
              <tr>
                <th>Field</th>
                <th>Type</th>
                <th>Description</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>userName</td>
                <td>String</td>
                <td>
                  Unique identification of user who will called such as name, email, phone number, or others.
                </td>
              </tr>
            </tbody>
          </table>

          <span id="accaudio">&nbsp;</span>

          <div class="mt-4" style="font-size: 18px;">
            <b>Accept Audio Call</b>
          </div>
          <div style="font-size: 15px;">
            Function to accept audio call with input paramenter acceptAudioCallBack.
          </div>
          <div style="font-size: 15px;">
            Method:
          </div>
          <div style="font-size: 15px;">
            <i>API.acceptAudioCall(Interface acceptAudioCallBack);</i>
          </div>
          <div style="font-size: 15px;">
            Input Parameter:
          </div>
          <table class="table table-bordered w-75" style="font-size: 15px;">
            <thead class="text-center">
              <tr>
                <th>Field</th>
                <th>Type</th>
                <th>Description</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>acceptAudioCallBack</td>
                <td>Interface</td>
                <td>
                  A callback interface when accepting audio call
                </td>
              </tr>
            </tbody>
          </table>
          <div style="font-size: 15px;">
            acceptAudioCallBack:
          </div>
          <table class="table table-bordered w-75" style="font-size: 15px;">
            <thead class="text-center">
              <tr>
                <th>Field</th>
                <th>Type</th>
                <th>Description</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>state</td>
                <td>Integer</td>
                <td>
                  State flow that determine which acceptAudioCallBack will be called
                </td>
              </tr>
              <tr>
                <td>message</td>
                <td>String</td>
                <td>
                  String data as needed separated by commas
                </td>
              </tr>
            </tbody>
          </table>
          <div style="font-size: 15px;">
          state:
          </div>
          <table class="table table-bordered w-50" style="font-size: 15px;">
            <thead class="text-center">
              <tr>
                <th>Value</th>
                <th>Description</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="text-center">1</td>
                <td>Offline</td>
              </tr>
              <tr>
                <td class="text-center">2</td>
                <td>User Not Found</td>
              </tr>
              <tr>
                <td class="text-center">3</td>
                <td>Busy</td>
              </tr>
              <tr>
                <td class="text-center">4</td>
                <td>Audio Ringing</td>
              </tr>
              <tr>
                <td class="text-center">5</td>
                <td>Audio Connected</td>
              </tr>
              <tr>
                <td class="text-center">6</td>
                <td>Audio Terminate</td>
              </tr>
            </tbody>
          </table>

          <span id="rejectaudio">&nbsp;</span>

          <div class="mt-4" style="font-size: 18px;">
            <b>Reject Audio Call</b>
          </div>
          <div style="font-size: 15px;">
            Function to reject incoming audio call.
          </div>
          <div style="font-size: 15px;">
            Method:
          </div>
          <div style="font-size: 15px;">
            <i>API.rejectAudioCall();</i>
          </div>

          <span id="endaudio">&nbsp;</span>

          <div class="mt-4" style="font-size: 18px;">
            <b>End Audio Call</b>
          </div>
          <div style="font-size: 15px;">
           Function to end ongoing audio call.
          </div>
          <div style="font-size: 15px;">
            Method:
          </div>
          <div style="font-size: 15px;">
            <i>API.endAudioCall();</i>
          </div>

          <span id="video">&nbsp;</span>

          <div id="initvideo" class="mt-4" style="font-size: 20px;">
            <b>Video Call</b>
          </div>
          <div class="mt-2" style="font-size: 18px;">
            <b>Initiate Video Call</b>
          </div>
          <div style="font-size: 15px;">
            Function to initiate audio call with input parameters userName and initiateVideoCallBack.
          </div>
          <div style="font-size: 15px;">
            Method:
          </div>
          <div style="font-size: 15px;">
            <i>API.initiateVideoCall(String userName, Interface initiateVideoCallBack);</i>
          </div>
          <div style="font-size: 15px;">
            Input Parameter:
          </div>
          <table class="table table-bordered w-75" style="font-size: 15px;">
            <thead class="text-center">
              <tr>
                <th>Field</th>
                <th>Type</th>
                <th>Description</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>userName</td>
                <td>String</td>
                <td>
                  Unique identification of user who will added to contact such as name, email, phone number, or others
                </td>
              </tr>
              <tr>
                <td>initiateVideoCallBack</td>
                <td>Interface</td>
                <td>
                  A callback interface when initiating video call
                </td>
              </tr>
            </tbody>
          </table>
          <div style="font-size: 15px;">
            initiateVideoCallBack:
          </div>
          <table class="table table-bordered w-75" style="font-size: 15px;">
            <thead class="text-center">
              <tr>
                <th>Field</th>
                <th>Type</th>
                <th>Description</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>userName</td>
                <td>String</td>
                <td>
                  Unique identification of user who will added to contact such as name, email, phone number, or others
                </td>
              </tr>
              <tr>
                <td>state</td>
                <td>Integer</td>
                <td>
                  State that determine which initiateVideoCallBack will be called
                </td>
              </tr>
              <tr>
                <td>message</td>
                <td>String</td>
                <td>
                  String data as needed separated by commas
                </td>
              </tr>
            </tbody>
          </table>
          <div style="font-size: 15px;">
            state:
          </div>
          <table class="table table-bordered w-50" style="font-size: 15px;">
            <thead class="text-center">
              <tr>
                <th>Value</th>
                <th>Description</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="text-center">1</td>
                <td>Offline</td>
              </tr>
              <tr>
                <td class="text-center">2</td>
                <td>User Not Found</td>
              </tr>
              <tr>
                <td class="text-center">3</td>
                <td>Busy</td>
              </tr>
              <tr>
                <td class="text-center">4</td>
                <td>Video Ringing</td>
              </tr>
              <tr>
                <td class="text-center">5</td>
                <td>Video Connected</td>
              </tr>
              <tr>
                <td class="text-center">6</td>
                <td>Video Terminate</td>
              </tr>
            </tbody>
          </table>

          <span id="regvideo">&nbsp;</span>

          <div class="mt-4" style="font-size: 18px;">
            <b>Register Video Call Receiver</b>
          </div>
          <div style="font-size: 15px;">
            Function to register video call on videoCallReceiver.
          </div>
          <div style="font-size: 15px;">
            Method:
          </div>
          <div style="font-size: 15px;">
            <i>API.RegisterVideoCallReceiver(Interface videoCallReceiver);</i>
          </div>
          <div style="font-size: 15px;">
            Input Parameter:
          </div>
          <table class="table table-bordered w-75" style="font-size: 15px;">
            <thead class="text-center">
              <tr>
                <th>Field</th>
                <th>Type</th>
                <th>Description</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>videoCallReceiver</td>
                <td>Interface</td>
                <td>
                  A callback interface when receiving video call
                </td>
              </tr>
            </tbody>
          </table>
          <div style="font-size: 15px;">
            videoCallReceiver:
          </div>
          <table class="table table-bordered w-75" style="font-size: 15px;">
            <thead class="text-center">
              <tr>
                <th>Field</th>
                <th>Type</th>
                <th>Description</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>userName</td>
                <td>String</td>
                <td>
                  Unique identification of user who will called such as name, email, phone number, or others
                </td>
              </tr>
            </tbody>
          </table>

          <span id="accvideo">&nbsp;</span>

          <div class="mt-4" style="font-size: 18px;">
            <b>Accept Video Call</b>
          </div>
          <div style="font-size: 15px;">
            Function to accept video call with input parameter acceptVideoCallBack.
          </div>
          <div style="font-size: 15px;">
            Method:
          </div>
          <div style="font-size: 15px;">
            <i>API.acceptVideoCall(Interface acceptVideoCallBack);</i>
          </div>
          <div style="font-size: 15px;">
            Input Parameter:
          </div>
          <table class="table table-bordered w-75" style="font-size: 15px;">
            <thead class="text-center">
              <tr>
                <th>Field</th>
                <th>Type</th>
                <th>Description</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>acceptVideoCallBack</td>
                <td>Interface</td>
                <td>
                  A callback interface when accepting video call
                </td>
              </tr>
            </tbody>
          </table>
          <div style="font-size: 15px;">
            acceptVideoCallBack:
          </div>
          <table class="table table-bordered w-75" style="font-size: 15px;">
            <thead class="text-center">
              <tr>
                <th>Field</th>
                <th>Type</th>
                <th>Description</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>state</td>
                <td>Integer</td>
                <td>
                  State that determine which acceptVideoCallBack will be called
                </td>
              </tr>
              <tr>
                <td>message</td>
                <td>String</td>
                <td>
                  String data as needed separated by commas
                </td>
              </tr>
            </tbody>
          </table>
          <div style="font-size: 15px;">
            state:
          </div>
          <table class="table table-bordered w-50" style="font-size: 15px;">
            <thead class="text-center">
              <tr>
                <th>Value</th>
                <th>Description</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="text-center">1</td>
                <td>Offline</td>
              </tr>
              <tr>
                <td class="text-center">2</td>
                <td>User Not Found</td>
              </tr>
              <tr>
                <td class="text-center">3</td>
                <td>Busy</td>
              </tr>
              <tr>
                <td class="text-center">4</td>
                <td>Video Ringing</td>
              </tr>
              <tr>
                <td class="text-center">5</td>
                <td>Video Connected</td>
              </tr>
              <tr>
                <td class="text-center">6</td>
                <td>Video Terminate</td>
              </tr>
            </tbody>
          </table>

          <span id="rejectvideo">&nbsp;</span>

          <div class="mt-4" style="font-size: 18px;">
            <b>Reject Video Call</b>
          </div>
          <div style="font-size: 15px;">
            Function to reject incoming video call.
          </div>
          <div style="font-size: 15px;">
            Method:
          </div>
          <div style="font-size: 15px;">
            <i>API.rejectVideoCall ();</i>
          </div>

          <span id="endvideo">&nbsp;</span>

          <div class="mt-4" style="font-size: 18px;">
            <b>End Video Call</b>
          </div>
          <div style="font-size: 15px;">
            Function to end ongoing audio call.
          </div>
          <div style="font-size: 15px;">
            Method:
          </div>
          <div style="font-size: 15px;">
            <i>API.endVideoCall();</i>
          </div>

          <span id="ls">&nbsp;</span>

          <div id="startls" class="mt-4" style="font-size: 20px;">
            <b>Live Streaming</b>
          </div>
          <div class="mt-2" style="font-size: 18px;">
            <b>Start Live Streaming</b>
          </div>
          <div style="font-size: 15px;">
            Function to start live streaming with input parameters title and startLiveStreamingCallBack.
          </div>
          <div style="font-size: 15px;">
            Method:
          </div>
          <div style="font-size: 15px;">
            <i>API.startLiveStreaming(String title, Interface startLiveStreamingCallBack);</i>
          </div>
          <div style="font-size: 15px;">
            Input Parameter:
          </div>
          <table class="table table-bordered w-75" style="font-size: 15px;">
            <thead class="text-center">
              <tr>
                <th>Field</th>
                <th>Type</th>
                <th>Description</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>title</td>
                <td>String</td>
                <td>
                  Live streaming title entered by user
                </td>
              </tr>
              <tr>
                <td>startLiveStreamingCallBack</td>
                <td>Interface</td>
                <td>
                  A callback interface when starting live streaming
                </td>
              </tr>
            </tbody>
          </table>
          <div style="font-size: 15px;">
            startLiveStreamingCallBack:
          </div>
          <table class="table table-bordered w-75" style="font-size: 15px;">
            <thead class="text-center">
              <tr>
                <th>Field</th>
                <th>Type</th>
                <th>Description</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>userName</td>
                <td>String</td>
                <td>
                  Unique identification of user who live streaming such as name, email, phone number, or others
                </td>
              </tr>
              <tr>
                <td>state</td>
                <td>Integer</td>
                <td>
                  State that determine which startLiveStreamingCallBack will be called
                </td>
              </tr>
              <tr>
                <td>localView</td>
                <td>View</td>
                <td>
                  View containing user image/video
                </td>
              </tr>
              <tr>
                <td>message</td>
                <td>String</td>
                <td>
                  String data as needed separated by commas
                </td>
              </tr>
            </tbody>
          </table>
          <div style="font-size: 15px;">
            state:
          </div>
          <table class="table table-bordered w-50" style="font-size: 15px;">
            <thead class="text-center">
              <tr>
                <th>Value</th>
                <th>Description</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="text-center">1</td>
                <td>Offline</td>
              </tr>
              <tr>
                <td class="text-center">2</td>
                <td>Terminate</td>
              </tr>
            </tbody>
          </table>

          <span id="getlslist">&nbsp;</span>

          <div class="mt-4" style="font-size: 18px;">
            <b>Get Live Streaming List</b>
          </div>
          <div style="font-size: 15px;">
            Function to get user list when seeing live streaming.
          </div>
          <div style="font-size: 15px;">
            Method:
          </div>
          <div style="font-size: 15px;">
            <i>API.getLiveStreamingList();</i>
          </div>
          <div style="font-size: 15px;">
            Input Parameter:
          </div>

          <span id="joinls">&nbsp;</span>

          <div class="mt-4" style="font-size: 18px;">
            <b>Join Live Streaming</b>
          </div>
          <div style="font-size: 15px;">
            Function to join live streaming with input parameters userName and joinLiveStreamingCallBack.
          </div>
          <div style="font-size: 15px;">
            Method:
          </div>
          <div style="font-size: 15px;">
            <i>API.joinLiveStreaming(String title, Interface joinLiveStreamingCallBack);</i>
          </div>
          <div style="font-size: 15px;">
            Input Parameter:
          </div>
          <table class="table table-bordered w-75" style="font-size: 15px;">
            <thead class="text-center">
              <tr>
                <th>Field</th>
                <th>Type</th>
                <th>Description</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>userName</td>
                <td>String</td>
                <td>
                  Unique identification of user who join live streaming such as name, email, phone number, or others
                </td>
              </tr>
              <tr>
                <td>joinLiveStreamingCallBack</td>
                <td>Interface</td>
                <td>
                  A callback interface when joining live streaming
                </td>
              </tr>
            </tbody>
          </table>
          <div style="font-size: 15px;">
            joinLiveStreamingCallBack:
          </div>
          <table class="table table-bordered w-75" style="font-size: 15px;">
            <thead class="text-center">
              <tr>
                <th>Field</th>
                <th>Type</th>
                <th>Description</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>userName</td>
                <td>String</td>
                <td>
                  Unique identification of user who join live streaming such as name, email, phone number, or others
                </td>
              </tr>
              <tr>
                <td>state</td>
                <td>Integer</td>
                <td>
                  State that determine which joinLiveStreamingCallBack will be called
                </td>
              </tr>
              <tr>
                <td>remoteView</td>
                <td>View</td>
                <td>
                  View containing other?s user image/video
                </td>
              </tr>
              <tr>
                <td>message</td>
                <td>String</td>
                <td>
                  String data as needed separated by commas
                </td>
              </tr>
            </tbody>
          </table>
          <div style="font-size: 15px;">
            state:
          </div>
          <table class="table table-bordered w-50" style="font-size: 15px;">
            <thead class="text-center">
              <tr>
                <th>Value</th>
                <th>Description</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="text-center">1</td>
                <td>Offline</td>
              </tr>
              <tr>
                <td class="text-center">2</td>
                <td>Terminate</td>
              </tr>
            </tbody>
          </table>

          <span id="leftls">&nbsp;</span>

          <div class="mt-4" style="font-size: 18px;">
            <b>Left Live Streaming</b>
          </div>
          <div style="font-size: 15px;">
            Function to left live streaming with input parameter userName.
          </div>
          <div style="font-size: 15px;">
            Method:
          </div>
          <div style="font-size: 15px;">
            <i>API.leftLiveStreaming(String userName);</i>
          </div>
          <div style="font-size: 15px;">
            Input Parameter:
          </div>
          <table class="table table-bordered w-75" style="font-size: 15px;">
            <thead class="text-center">
              <tr>
                <th>Field</th>
                <th>Type</th>
                <th>Description</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>userName</td>
                <td>String</td>
                <td>
                  Unique identification of user who join live streaming such as name, email, phone number, or others
                </td>
              </tr>
            </tbody>
          </table>

          <span id="endls">&nbsp;</span>

          <div class="mt-4" style="font-size: 18px;">
            <b>End Live Streaming</b>
          </div>
          <div style="font-size: 15px;">
            Function to end ongoing live streaming.
          </div>
          <div style="font-size: 15px;">
            Method:
          </div>
          <div style="font-size: 15px;">
            <i>API.endLiveStreaming();</i>
          </div>

          <span id="im">&nbsp;</span>

          <div id="sendim" class="mt-4" style="font-size: 20px;">
            <b>Instant Messaging</b>
          </div>
          <div class="mt-2" style="font-size: 18px;">
            <b>Send Message</b>
          </div>
          <div style="font-size: 15px;">
            Function to send message with input parameters are destination, content, type, uri, messageCallback.
          </div>
          <div style="font-size: 15px;">
            Method:
          </div>
          <div style="font-size: 15px;">
            <i>API.sendMessage(destination, content, type, uri, messageCallback);</i>
          </div>
          <div style="font-size: 15px;">
            Input Parameter:
          </div>
          <table class="table table-bordered w-75" style="font-size: 15px;">
            <thead class="text-center">
              <tr>
                <th>Field</th>
                <th>Type</th>
                <th>Description</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>destination</td>
                <td>String</td>
                <td>
                  Message recipient id
                </td>
              </tr>
              <tr>
                <td>content</td>
                <td>String</td>
                <td>
                  Message text
                </td>
              </tr>
              <tr>
                <td>type</td>
                <td>Integer</td>
                <td>
                  Destination type
                </td>
              </tr>
              <tr>
                <td>uri</td>
                <td>Uri</td>
                <td>
                  Path file when user attach an attachment
                </td>
              </tr>
              <tr>
                <td>messageCallback</td>
                <td>Interface</td>
                <td>
                  A callback interface when sending message
                </td>
              </tr>
            </tbody>
          </table>
          <div style="font-size: 15px;">
            type:
          </div>
          <table class="table table-bordered w-50" style="font-size: 15px;">
            <thead class="text-center">
              <tr>
                <th>Value</th>
                <th>Description</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="text-center">0</td>
                <td>Personal</td>
              </tr>
              <tr>
                <td class="text-center">1</td>
                <td>Group</td>
              </tr>
            </tbody>
          </table>
          <div style="font-size: 15px;">
            messageCallback:
          </div>
          <table class="table table-bordered w-50" style="font-size: 15px;">
            <thead class="text-center">
              <tr>
                <th>Value</th>
                <th>Description</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="text-center">0</td>
                <td>Message Status</td>
              </tr>
              <tr>
                <td class="text-center">1</td>
                <td>Upload Status</td>
              </tr>
            </tbody>
          </table>

          <span id="regim">&nbsp;</span>

          <div class="mt-4" style="font-size: 18px;">
            <b>Register Message Receiver</b>
          </div>
          <div style="font-size: 15px;">
            Function to register message receiver with input parameter is messageReceiver.
          </div>
          <div style="font-size: 15px;">
            Method:
          </div>
          <div style="font-size: 15px;">
            <i>API.registerMessageReceiver(Interface messageReceiver);</i>
          </div>
          <div style="font-size: 15px;">
            Input Parameter:
          </div>
          <table class="table table-bordered w-75" style="font-size: 15px;">
            <thead class="text-center">
              <tr>
                <th>Field</th>
                <th>Type</th>
                <th>Description</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>messageReceiver</td>
                <td>Interface</td>
                <td>
                  A callback interface when receiving message
                </td>
              </tr>
            </tbody>
          </table>

          <span id="imreceiver">&nbsp;</span>

          <div class="mt-4" style="font-size: 18px;">
            <b>Message Receiver</b>
          </div>
          <div style="font-size: 15px;">
            Function to receive message with input parameters are messageID, originator, destination, content, type, filename.
          </div>
          <div style="font-size: 15px;">
            Method:
          </div>
          <div style="font-size: 15px;">
            <i>API.messageReceiver(messageID, originator, destination, content, type, filename);</i>
          </div>
          <div style="font-size: 15px;">
            Input Parameter:
          </div>
          <table class="table table-bordered w-75" style="font-size: 15px;">
            <thead class="text-center">
              <tr>
                <th>Field</th>
                <th>Type</th>
                <th>Description</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>messageID</td>
                <td>String</td>
                <td>
                  Unique identifier number for message
                </td>
              </tr>
              <tr>
                <td>originator</td>
                <td>String</td>
                <td>
                  Message sender id
                </td>
              </tr>
              <tr>
                <td>destination</td>
                <td>String</td>
                <td>
                  Message recipient id
                </td>
              </tr>
              <tr>
                <td>type</td>
                <td>Integer</td>
                <td>
                  Destination type
                </td>
              </tr>
              <tr>
                <td>Content</td>
                <td>String</td>
                <td>
                  Message text
                </td>
              </tr>
              <tr>
                <td>filename</td>
                <td>String</td>
                <td>
                  Name of file that user attaches to a message
                </td>
              </tr>
            </tbody>
          </table>
          <div style="font-size: 15px;">
            type:
          </div>
          <table class="table table-bordered w-50" style="font-size: 15px;">
            <thead class="text-center">
              <tr>
                <th>Value</th>
                <th>Description</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="text-center">0</td>
                <td>Personal</td>
              </tr>
              <tr>
                <td class="text-center">1</td>
                <td>Group</td>
              </tr>
            </tbody>
          </table>

          <span id="imstatus">&nbsp;</span>

          <div class="mt-4" style="font-size: 18px;">
            <b>Message Status</b>
          </div>
          <div style="font-size: 15px;">
            A callback interface for message status with input parameters are messageID, callbackType, status.
          </div>
          <div style="font-size: 15px;">
            Method:
          </div>
          <div style="font-size: 15px;">
            <i>API.messageCallback(String messageID, int callbackType, int status);</i>
          </div>
          <div style="font-size: 15px;">
            Input Parameter:
          </div>
          <table class="table table-bordered w-75" style="font-size: 15px;">
            <thead class="text-center">
              <tr>
                <th>Field</th>
                <th>Type</th>
                <th>Description</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>messageID</td>
                <td>String</td>
                <td>
                  Unique identifier number for message
                </td>
              </tr>
              <tr>
                <td>callbackType</td>
                <td>Integer</td>
                <td>
                  Type of callback
                </td>
              </tr>
              <tr>
                <td>status</td>
                <td>Integer</td>
                <td>
                  Delivery status of message
                </td>
              </tr>
            </tbody>
          </table>
          <div style="font-size: 15px;">
            callbackType:
          </div>
          <table class="table table-bordered w-50" style="font-size: 15px;">
            <thead class="text-center">
              <tr>
                <th>Value</th>
                <th>Description</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="text-center">0</td>
                <td>Message Status Callback</td>
              </tr>
              <tr>
                <td class="text-center">1</td>
                <td>Upload Status Callback</td>
              </tr>
            </tbody>
          </table>
          <div style="font-size: 15px;">
            status:
          </div>
          <table class="table table-bordered w-50" style="font-size: 15px;">
            <thead class="text-center">
              <tr>
                <th>Value</th>
                <th>Description</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="text-center">0</td>
                <td>Pending</td>
              </tr>
              <tr>
                <td class="text-center">1</td>
                <td>Sent</td>
              </tr>
              <tr>
                <td class="text-center">2</td>
                <td>Delivered</td>
              </tr>
              <tr>
                <td class="text-center">3</td>
                <td>Read</td>
              </tr>
            </tbody>
          </table>

          <span id="uploadstatus">&nbsp;</span>

          <div class="mt-4" style="font-size: 18px;">
            <b>Upload Status</b>
          </div>
          <div style="font-size: 15px;">
            A callback interface for upload status with input parameters are messageID, callbackType, status.
          </div>
          <div style="font-size: 15px;">
            Method:
          </div>
          <div style="font-size: 15px;">
            <i>API.messageCallback(String messageID, int callbackType, int status);</i>
          </div>
          <div style="font-size: 15px;">
            Input Parameter:
          </div>
          <table class="table table-bordered w-75" style="font-size: 15px;">
            <thead class="text-center">
              <tr>
                <th>Field</th>
                <th>Type</th>
                <th>Description</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>messageID</td>
                <td>String</td>
                <td>
                  Unique identifier number for message
                </td>
              </tr>
              <tr>
                <td>callbackType</td>
                <td>Integer</td>
                <td>
                  Type of callback
                </td>
              </tr>
              <tr>
                <td>status</td>
                <td>Integer</td>
                <td>
                  Upload status of message file
                </td>
              </tr>
            </tbody>
          </table>
          <div style="font-size: 15px;">
            callbackType:
          </div>
          <table class="table table-bordered w-50" style="font-size: 15px;">
            <thead class="text-center">
              <tr>
                <th>Value</th>
                <th>Description</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="text-center">0</td>
                <td>Message Status Callback</td>
              </tr>
              <tr>
                <td class="text-center">1</td>
                <td>Upload Status Callback</td>
              </tr>
            </tbody>
          </table>

          <span id="sendtyping">&nbsp;</span>

          <div class="mt-4" style="font-size: 18px;">
            <b>Send Typing</b>
          </div>
          <div style="font-size: 15px;">
            Function to send typing with input parameters are destination and type.
          </div>
          <div style="font-size: 15px;">
            Method:
          </div>
          <div style="font-size: 15px;">
            <i>API.sendTyping(String destination, int type);</i>
          </div>
          <div style="font-size: 15px;">
            Input Parameter:
          </div>
          <table class="table table-bordered w-75" style="font-size: 15px;">
            <thead class="text-center">
              <tr>
                <th>Field</th>
                <th>Type</th>
                <th>Description</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>destination</td>
                <td>String</td>
                <td>
                  Message recipient id
                </td>
              </tr>
              <tr>
                <td>type</td>
                <td>Integer</td>
                <td>
                  Destination type
                </td>
              </tr>
            </tbody>
          </table>
          <div style="font-size: 15px;">
            type:
          </div>
          <table class="table table-bordered w-50" style="font-size: 15px;">
            <thead class="text-center">
              <tr>
                <th>Value</th>
                <th>Description</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="text-center">0</td>
                <td>Personal</td>
              </tr>
              <tr>
                <td class="text-center">1</td>
                <td>Group</td>
              </tr>
            </tbody>
          </table>

          <span id="regtyping">&nbsp;</span>

          <div class="mt-4" style="font-size: 18px;">
            <b>Register Typing Receiver</b>
          </div>
          <div style="font-size: 15px;">
            A Function to register typing receiver with input parameter is typingReceiver.
          </div>
          <div style="font-size: 15px;">
            Method:
          </div>
          <div style="font-size: 15px;">
            <i>API.registerTypingReceiver(Interface typingReceiver);</i>
          </div>
          <div style="font-size: 15px;">
            Input Parameter:
          </div>
          <table class="table table-bordered w-75" style="font-size: 15px;">
            <thead class="text-center">
              <tr>
                <th>Field</th>
                <th>Type</th>
                <th>Description</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>typingReceiver</td>
                <td>String</td>
                <td>
                  A callback interface when user is typing
                </td>
              </tr>
            </tbody>
          </table>

          <span id="typingreceiver">&nbsp;</span>

          <div class="mt-4" style="font-size: 18px;">
            <b>Typing Receiver</b>
          </div>
          <div style="font-size: 15px;">
            Function to receive typing information with input parameter is time.
          </div>
          <div style="font-size: 15px;">
            Method:
          </div>
          <div style="font-size: 15px;">
            <i>API.typingReceiver(time);</i>
          </div>
          <div style="font-size: 15px;">
            Input Parameter:
          </div>
          <table class="table table-bordered w-75" style="font-size: 15px;">
            <thead class="text-center">
              <tr>
                <th>Field</th>
                <th>Type</th>
                <th>Description</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>time</td>
                <td>Timestamp</td>
                <td>
                  Interval time when user typing
                </td>
              </tr>
            </tbody>
          </table>

          <span id="forumchnl">&nbsp;</span>

          <div id="crtforum" class="mt-4" style="font-size: 20px;">
            <b>Forum and Channel</b>
          </div>
          <div class="mt-2" style="font-size: 18px;">
            <b>Create Forum</b>
          </div>
          <div style="font-size: 15px;">
            Function to create a forum with input parameters are title, isOpen, description, picture.
          </div>
          <div style="font-size: 15px;">
            Method:
          </div>
          <div style="font-size: 15px;">
            <i>API.createForum(String title, Integer isOpen, String description, String picture);</i>
          </div>
          <div style="font-size: 15px;">
            Input Parameter:
          </div>
          <table class="table table-bordered w-75" style="font-size: 15px;">
            <thead class="text-center">
              <tr>
                <th>Field</th>
                <th>Type</th>
                <th>Description</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>title</td>
                <td>String</td>
                <td>
                 Title of forum
                </td>
              </tr>
              <tr>
                <td>isOpen</td>
                <td>Integer</td>
                <td>
                 Integer value for identifying group or channel
                </td>
              </tr>
              <tr>
                <td>description</td>
                <td>String</td>
                <td>
                 Description of forum
                </td>
              </tr>
              <tr>
                <td>picture</td>
                <td>Uri</td>
                <td>
                 Path file when user upload picture
                </td>
              </tr>
            </tbody>
          </table>
          <div style="font-size: 15px;">
            isOpen:
          </div>
          <table class="table table-bordered w-50" style="font-size: 15px;">
            <thead class="text-center">
              <tr>
                <th>Value</th>
                <th>Description</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="text-center">0</td>
                <td>Group</td>
              </tr>
              <tr>
                <td class="text-center">1</td>
                <td>Channel</td>
              </tr>
            </tbody>
          </table>

          <span id="updtforumname">&nbsp;</span>

          <div class="mt-4" style="font-size: 18px;">
            <b>Update Forum Name</b>
          </div>
          <div style="font-size: 15px;">
            Function to update a forum name with input parameters are forumName and title.
          </div>
          <div style="font-size: 15px;">
            Method:
          </div>
          <div style="font-size: 15px;">
            <i>API.updateForumDescription(String forumName, String description);</i>
          </div>
          <div style="font-size: 15px;">
            Input Parameter:
          </div>
          <table class="table table-bordered w-75" style="font-size: 15px;">
            <thead class="text-center">
              <tr>
                <th>Field</th>
                <th>Type</th>
                <th>Description</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>forumName</td>
                <td>String</td>
                <td>
                  Unique identifier name for forum
                </td>
              </tr>
              <tr>
                <td>title</td>
                <td>String</td>
                <td>
                  Title of forum that input by user
                </td>
              </tr>
            </tbody>
          </table>

          <span id="updtforumdesc">&nbsp;</span>

          <div class="mt-4" style="font-size: 18px;">
            <b>Update Forum Description</b>
          </div>
          <div style="font-size: 15px;">
            Function to update a forum description with input parameters are forumName and description.
          </div>
          <div style="font-size: 15px;">
            Method:
          </div>
          <div style="font-size: 15px;">
            <i>API.updateForumDescription(String forumName, String description);</i>
          </div>
          <div style="font-size: 15px;">
            Input Parameter:
          </div>
          <table class="table table-bordered w-75" style="font-size: 15px;">
            <thead class="text-center">
              <tr>
                <th>Field</th>
                <th>Type</th>
                <th>Description</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>forumName</td>
                <td>String</td>
                <td>
                  Unique identifier name for forum
                </td>
              </tr>
              <tr>
                <td>description</td>
                <td>String</td>
                <td>
                  Description of forum
                </td>
              </tr>
            </tbody>
          </table>

          <span id="updtforumpict">&nbsp;</span>

          <div class="mt-4" style="font-size: 18px;">
            <b>Update Forum Picture</b>
          </div>
          <div style="font-size: 15px;">
            Function to update a forum picture with input parameters are forumName and picture.
          </div>
          <div style="font-size: 15px;">
            Method:
          </div>
          <div style="font-size: 15px;">
            <i>API.updateForumPicture(String forumName, Uri picture);</i>
          </div>
          <div style="font-size: 15px;">
            Input Parameter:
          </div>
          <table class="table table-bordered w-75" style="font-size: 15px;">
            <thead class="text-center">
              <tr>
                <th>Field</th>
                <th>Type</th>
                <th>Description</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>forumName</td>
                <td>String</td>
                <td>
                  Unique identifier name for forum
                </td>
              </tr>
              <tr>
                <td>picture</td>
                <td>Uri</td>
                <td>
                  Path file when user upload picture
                </td>
              </tr>
            </tbody>
          </table>

          <span id="joinforum">&nbsp;</span>

          <div class="mt-4" style="font-size: 18px;">
            <b>Join Forum</b>
          </div>
          <div style="font-size: 15px;">
            Function to join a forum with input parameter is forumName.
          </div>
          <div style="font-size: 15px;">
            Method:
          </div>
          <div style="font-size: 15px;">
            <i>API.joinForum(String forumName);</i>
          </div>
          <div style="font-size: 15px;">
            Input Parameter:
          </div>
          <table class="table table-bordered w-75" style="font-size: 15px;">
            <thead class="text-center">
              <tr>
                <th>Field</th>
                <th>Type</th>
                <th>Description</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>forumName</td>
                <td>String</td>
                <td>
                  Unique identifier name for forum
                </td>
              </tr>
            </tbody>
          </table>

          <span id="leaveforum">&nbsp;</span>

          <div class="mt-4" style="font-size: 18px;">
            <b>Leave Forum</b>
          </div>
          <div style="font-size: 15px;">
            Function to leave a forum with input parameters are forumName and userName.
          </div>
          <div style="font-size: 15px;">
            Method:
          </div>
          <div style="font-size: 15px;">
            <i>API.leaveForum(String forumName, String userName);</i>
          </div>
          <div style="font-size: 15px;">
            Input Parameter:
          </div>
          <table class="table table-bordered w-75" style="font-size: 15px;">
            <thead class="text-center">
              <tr>
                <th>Field</th>
                <th>Type</th>
                <th>Description</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>forumName</td>
                <td>String</td>
                <td>
                  Unique identifier name for forum
                </td>
              </tr>
              <tr>
                <td>userName</td>
                <td>String</td>
                <td>
                  Unique identification of user who want to leave a forum such as name, email, phone number, or others.
                </td>
              </tr>
            </tbody>
          </table>

          <span id="rmforum">&nbsp;</span>

          <div class="mt-4" style="font-size: 18px;">
            <b>Remove Forum</b>
          </div>
          <div style="font-size: 15px;">
            Function to remove a forum with input parameter is forumName.
          </div>
          <div style="font-size: 15px;">
            Method:
          </div>
          <div style="font-size: 15px;">
            <i>API.removeForum(String forumName);</i>
          </div>
          <div style="font-size: 15px;">
            Input Parameter:
          </div>
          <table class="table table-bordered w-75" style="font-size: 15px;">
            <thead class="text-center">
              <tr>
                <th>Field</th>
                <th>Type</th>
                <th>Description</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>forumName</td>
                <td>String</td>
                <td>
                  A unique identifier name of forum
                </td>
              </tr>
            </tbody>
          </table>

          <span id="addmmbr">&nbsp;</span>

          <div class="mt-4" style="font-size: 18px;">
            <b>Add Member</b>
          </div>
          <div style="font-size: 15px;">
            Function to add member to forum with input parameters are forumName and userName.
          </div>
          <div style="font-size: 15px;">
            Method:
          </div>
          <div style="font-size: 15px;">
            <i>API.sendMessage(String forumName,String userName);</i>
          </div>
          <div style="font-size: 15px;">
            Input Parameter:
          </div>
          <table class="table table-bordered w-75" style="font-size: 15px;">
            <thead class="text-center">
              <tr>
                <th>Field</th>
                <th>Type</th>
                <th>Description</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>forumName</td>
                <td>String</td>
                <td>
                  A unique identifier name of forum
                </td>
              </tr>
              <tr>
                <td>userName</td>
                <td>String</td>
                <td>
                  Unique identification of user who will add to forum such as name, email, phone number, or others.
                </td>
              </tr>
            </tbody>
          </table>

          <span id="rmmmbr">&nbsp;</span>

          <div class="mt-4" style="font-size: 18px;">
            <b>Remove Member</b>
          </div>
          <div style="font-size: 15px;">
            Function to remove member a forum with input parameters are forumName and userName.
          </div>
          <div style="font-size: 15px;">
            Method:
          </div>
          <div style="font-size: 15px;">
            <i>API.removeMember(String forumName,String userName);</i>
          </div>
          <div style="font-size: 15px;">
            Input Parameter:
          </div>
          <table class="table table-bordered w-75" style="font-size: 15px;">
            <thead class="text-center">
              <tr>
                <th>Field</th>
                <th>Type</th>
                <th>Description</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>forumName</td>
                <td>String</td>
                <td>
                  A unique identifier name of forum
                </td>
              </tr>
              <tr>
                <td>userName</td>
                <td>String</td>
                <td>
                  Unique identification of user who will remove from forum such as name, email, phone number, or others.
                </td>
              </tr>
            </tbody>
          </table>

          <span id="setadm">&nbsp;</span>

          <div class="mt-4" style="font-size: 18px;">
            <b>Set Admin</b>
          </div>
          <div style="font-size: 15px;">
            Function to set admin a forum with input parameters are forumName and userName.
          </div>
          <div style="font-size: 15px;">
            Method:
          </div>
          <div style="font-size: 15px;">
            <i>API.setAdmin(String forumName,String userName);</i>
          </div>
          <div style="font-size: 15px;">
            Input Parameter:
          </div>
          <table class="table table-bordered w-75" style="font-size: 15px;">
            <thead class="text-center">
              <tr>
                <th>Field</th>
                <th>Type</th>
                <th>Description</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>forumName</td>
                <td>String</td>
                <td>
                  A unique identifier name of forum
                </td>
              </tr>
              <tr>
                <td>userName</td>
                <td>String</td>
                <td>
                  Unique identification of user who will set as Admin forum such as name, email, phone number, or others.
                </td>
              </tr>
            </tbody>
          </table>

          <span id="rmadm">&nbsp;</span>

          <div class="mt-4" style="font-size: 18px;">
            <b>Remove Admin</b>
          </div>
          <div style="font-size: 15px;">
            Function to remove admin a forum with input parameters are forumName and userName.
          </div>
          <div style="font-size: 15px;">
            Method:
          </div>
          <div style="font-size: 15px;">
            <i>API.removeAdmin(String forumName,String userName);</i>
          </div>
          <div style="font-size: 15px;">
            Input Parameter:
          </div>
          <table class="table table-bordered w-75" style="font-size: 15px;">
            <thead class="text-center">
              <tr>
                <th>Field</th>
                <th>Type</th>
                <th>Description</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>forumName</td>
                <td>String</td>
                <td>
                  A unique identifier name of forum
                </td>
              </tr>
              <tr>
                <td>userName</td>
                <td>String</td>
                <td>
                  Unique identification of user who will remove as Admin forum such as name, email, phone number, or others.
                </td>
              </tr>
            </tbody>
          </table>

          <span id="addtopic">&nbsp;</span>

          <div class="mt-4" style="font-size: 18px;">
            <b>Add Topic</b>
          </div>
          <div style="font-size: 15px;">
            Function to add topic a forum with input parameters are title and parent.
          </div>
          <div style="font-size: 15px;">
            Method:
          </div>
          <div style="font-size: 15px;">
            <i>API.addTopic(String title, String parent);</i>
          </div>
          <div style="font-size: 15px;">
            Input Parameter:
          </div>
          <table class="table table-bordered w-75" style="font-size: 15px;">
            <thead class="text-center">
              <tr>
                <th>Field</th>
                <th>Type</th>
                <th>Description</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>title</td>
                <td>String</td>
                <td>
                  Title of topic that input by user
                </td>
              </tr>
              <tr>
                <td>parent</td>
                <td>String</td>
                <td>
                  Unique identification of user as parent of topic such as name, email, phone number, or others.
                </td>
              </tr>
            </tbody>
          </table>

          <span id="rmtopic">&nbsp;</span>

          <div class="mt-4" style="font-size: 18px;">
            <b>Remove Topic</b>
          </div>
          <div style="font-size: 15px;">
            Function to remove topic a forum with input parameters are forumName and parent.
          </div>
          <div style="font-size: 15px;">
            Method:
          </div>
          <div style="font-size: 15px;">
            <i>API.removeTopic(String forumName, String parent);</i>
          </div>
          <div style="font-size: 15px;">
            Input Parameter:
          </div>
          <table class="table table-bordered w-75" style="font-size: 15px;">
            <thead class="text-center">
              <tr>
                <th>Field</th>
                <th>Type</th>
                <th>Description</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>forumName</td>
                <td>String</td>
                <td>
                  A unique identifier name of topic
                </td>
              </tr>
              <tr>
                <td>parent</td>
                <td>String</td>
                <td>
                  Unique identification of user as parent of topic such as name, email, phone number, or others.
                </td>
              </tr>
            </tbody>
          </table>

          <span id="regforumcb">&nbsp;</span>

          <div class="mt-4" style="font-size: 18px;">
            <b>Register Forum Callback</b>
          </div>
          <div style="font-size: 15px;">
            Function to register forum callback with input parameters is forumCallback
          </div>
          <div style="font-size: 15px;">
            Method:
          </div>
          <div style="font-size: 15px;">
            <i>API.registerForumCallback(Interface forumCallback);</i>
          </div>
          <div style="font-size: 15px;">
            Input Parameter:
          </div>
          <table class="table table-bordered w-75" style="font-size: 15px;">
            <thead class="text-center">
              <tr>
                <th>Field</th>
                <th>Type</th>
                <th>Description</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>forumCallback</td>
                <td>String</td>
                <td>
                  Interface callback
                </td>
              </tr>
            </tbody>
          </table>

          <span id="forumcb">&nbsp;</span>

          <div class="mt-4" style="font-size: 18px;">
            <b>Forum Callback</b>
          </div>
          <div style="font-size: 15px;">
            Function to send notify when user update information or member forum with input parameters are forumName and data.
          </div>
          <div style="font-size: 15px;">
            Method:
          </div>
          <div style="font-size: 15px;">
            <i>API.forumCallback(String forumName,String data);</i>
          </div>
          <div style="font-size: 15px;">
            Input Parameter:
          </div>
          <table class="table table-bordered w-75" style="font-size: 15px;">
            <thead class="text-center">
              <tr>
                <th>Field</th>
                <th>Type</th>
                <th>Description</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>forumName</td>
                <td>String</td>
                <td>
                  A unique identifier name of forum
                </td>
              </tr>
              <tr>
                <td>data</td>
                <td>String</td>
                <td>
                  String data as needed separated by commas
                </td>
              </tr>
            </tbody>
          </table>
          <div style="font-size: 15px;">
            data:
          </div>
          <table class="table table-bordered w-50" style="font-size: 15px;">
            <thead class="text-center">
              <tr>
                <th>Field</th>
                <th>Description</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>type</td>
                <td>Type of transaction</td>
              </tr>
              <tr>
                <td>response</td>
                <td>Response code and data from service</td>
              </tr>
            </tbody>
          </table>
          <div style="font-size: 15px;">
            type:
          </div>
          <table class="table table-bordered w-50" style="font-size: 15px;">
            <thead class="text-center">
              <tr>
                <th>Value</th>
                <th>Description</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="text-center">0</td>
                <td>Create Forum</td>
              </tr>
              <tr>
                <td class="text-center">1</td>
                <td>Add Member</td>
              </tr>
              <tr>
                <td class="text-center">2</td>
                <td>Remove Member</td>
              </tr>
              <tr>
                <td class="text-center">3</td>
                <td>Set Admin</td>
              </tr>
              <tr>
                <td class="text-center">4</td>
                <td>Remove Admin</td>
              </tr>
              <tr>
                <td class="text-center">5</td>
                <td>Update Forum Name</td>
              </tr>
              <tr>
                <td class="text-center">6</td>
                <td>Update Forum Description</td>
              </tr>
              <tr>
                <td class="text-center">7</td>
                <td>Update Forum Picture</td>
              </tr>
              <tr>
                <td class="text-center">8</td>
                <td>Add Topic</td>
              </tr>
              <tr>
                <td class="text-center">9</td>
                <td>Remove Topic</td>
              </tr>
              <tr>
                <td class="text-center">10</td>
                <td>Leave Forum</td>
              </tr>
              <tr>
                <td class="text-center">11</td>
                <td>Remove Forum</td>
              </tr>
            </tbody>
          </table>


        </div> <!-- End Col -->
      </div> <!-- End Row -->
    </div> <!-- End Container -->    
  </div> <!-- End Wrapper -->


  
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
   immediately after the control sidebar -->
   <div class="control-sidebar-bg"></div>
 </div>
 <!-- ./wrapper -->

 <script type="text/javascript">

  $('body').scrollspy({ target: '#navbar-example3' });

 	$(window).on('activate.bs.scrollspy', function () {

      var item = $('#menu-side').find(".active").last();
      item.animatescroll({element: '#menu-side', padding:500});
      
  });
 </script>

 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>

 <!-- jQuery 3 -->
 <!-- <script src="bower_components/jquery/dist/jquery.min.js"></script> -->
 <!-- jQuery UI 1.11.4 -->
 <script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
 <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
 <script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<!-- <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script> -->
<!-- Morris.js charts -->
<script src="bower_components/raphael/raphael.min.js"></script>
<script src="bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<!-- <script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script> -->
<!-- <script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script> -->
<!-- jQuery Knob Chart -->
<script src="bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<!-- <script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script> -->
<!-- Slimscroll -->
<!-- <script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script> -->
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="dist/js/pages/dashboard.js"></script> -->
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>

</body>
</html>