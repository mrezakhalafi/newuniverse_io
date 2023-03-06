<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/url_function.php'); ?>
<?php //include_once($_SERVER['DOCUMENT_ROOT'] . '/session_function.php'); ?>
<?php //include_once($_SERVER['DOCUMENT_ROOT'] . '/session_check.php'); ?>
<?php

// $_SESSION['previous_page'] = $_SESSION['current_page'];
// $_SESSION['current_page'] = 14;
// require_once($_SERVER['DOCUMENT_ROOT'] . '/state_control.php');

?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>nexilis Lite Documentation</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <!-- <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css"> -->
    <!-- Font Awesome -->
    <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="icon" type="image/x-icon" href="<?php echo base_url(); ?>palio_logo_round.png">
    <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
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

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script> -->
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
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }
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

    pre .str,
    code .str {
        color: #65B042;
    }

    /* string  - green */
    pre .kwd,
    code .kwd {
        color: #E28964;
    }

    /* keyword - dark pink */
    pre .com,
    code .com {
        color: #AEAEAE;
        font-style: italic;
    }

    /* comment - gray */
    pre .typ,
    code .typ {
        color: #89bdff;
    }

    /* type - light blue */
    pre .lit,
    code .lit {
        color: #3387CC;
    }

    /* literal - blue */
    pre .pun,
    code .pun {
        color: #fff;
    }

    /* punctuation - white */
    pre .pln,
    code .pln {
        color: #fff;
    }

    /* plaintext - white */
    pre .tag,
    code .tag {
        color: #89bdff;
    }

    /* html/xml tag    - light blue */
    pre .atn,
    code .atn {
        color: #bdb76b;
    }

    /* html/xml attribute name  - khaki */
    pre .atv,
    code .atv {
        color: #65B042;
    }

    /* html/xml attribute value - green */
    pre .dec,
    code .dec {
        color: #3387CC;
    }

    /* decimal - blue */

    pre.prettyprint,
    code.prettyprint {
        background-color: #333;
    }

    pre.prettyprint {
        width: 100%;
        margin: 0 auto;
        padding: 1em;
        white-space: pre-wrap;
    }


    /* Specify class=linenums on a pre to get line numbering */
    ol.linenums {
        margin-top: 0;
        margin-bottom: 0;
        color: #AEAEAE;
    }

    /* IE indents via margin-left */
    /*li.L0,li.L1,li.L2,li.L3,li.L5,li.L6,li.L7,li.L8 { list-style-type: none; }*/
    li.L0,
    li.L1,
    li.L2,
    li.L3,
    li.L5,
    li.L6,
    li.L7,
    li.L8 {
        list-style-type: decimal;
    }

    /* Alternate shading for lines */
    /*li.L1,li.L3,li.L5,li.L7,li.L9 { background: #eee; }*/

    @media print {

        pre .str,
        code .str {
            color: #060;
        }

        pre .kwd,
        code .kwd {
            color: #006;
            font-weight: bold;
        }

        pre .com,
        code .com {
            color: #600;
            font-style: italic;
        }

        pre .typ,
        code .typ {
            color: #404;
            font-weight: bold;
        }

        pre .lit,
        code .lit {
            color: #044;
        }

        pre .pun,
        code .pun {
            color: #440;
        }

        pre .pln,
        code .pln {
            color: #000;
        }

        pre .tag,
        code .tag {
            color: #006;
            font-weight: bold;
        }

        pre .atn,
        code .atn {
            color: #404;
        }

        pre .atv,
        code .atv {
            color: #060;
        }
    }

    .table.table-bordered,
    .table.table-bordered th,
    .table.table-bordered tr,
    .table.table-bordered td {
        border: 1px solid #707070 !important;
    }

    html {
        scroll-behavior: unset;
    }

    .nav-link {
        color: #343a40 !important;
        font-weight: bold;
    }

    .nav-link:hover {
        background-color: #f8f9fa !important;
    }

    .nav-link.active {
        background-color: #ccc !important;
    }

    .nav-pills .nav-link.active,
    .nav-pills .show>.nav-link,
    .dropdown-menu {
        background: transparent;
    }

    @media screen and (max-width: 768px) {

        .side-men {
            background-color: #ecf0f5 !important;
            border-right: 0;
            margin-top: 100px;
        }
    }

    @media screen and (min-width: 769px) {

        .side-men {
            background-color: #ecf0f5 !important;
            border-right: 0;
            margin-top: 47px;
        }
    }

    .navbar-nav li:hover>ul.dropdown-menu {
        display: block;
    }

    .dropdown-submenu {
        position: relative;
    }

    .dropdown-submenu>.dropdown-menu {
        top: 0;
        left: 100%;
        margin-top: -6px;
    }

    /* rotate caret on hover */
    .dropdown-menu>li>a:hover:after {
        text-decoration: underline;
        transform: rotate(-90deg);
    }

    .tab-pane {
        /* overflow-y: scroll; */
        width: 100%;
        /* height: 100vh; */
    }

    .row {
        padding-top: 65px !important;
        margin-top: -65px !important;
    }

    @media screen and (max-width: 600px) {

        /* ul.instruction {
            padding-inline-start: 10px !important;
        }

        ol.instruction {
            padding-inline-start: 10px !important;
        } */
        .instruction {
            padding-inline-start: 10px !important;
        }

        .dl-link {
            font-size: 0.9rem;
        }
    }

    .dl-link {
        font-family: 'Segoe UI Regular';
        background-color: #007a87 !important;
        /* background-color: #01686d; */
    }

    .api-tables {
        min-width: 60%;
    }

    .api-tables th {
        background-color: #01686d;
        color: white;
        padding-left: 10px;
    }

    .api-tables tbody,
    .api-tables tbody tr,
    .api-tables tbody tr td {
        border: 1px solid #01686d;
    }

    .api-tables tbody tr td {
        padding: 10px;
    }

    .italic-text {
        font-style: italic;
    }

    hr {
        border-top: 1px solid black;
        margin-top: 0.5rem;
    }

    /* .fixed .content-wrapper {
        position: fixed;
        width: 100%;
    } */

    .switch-main-activity {
        /* float:right; */
        color:cyan !important;
    }

    .switch-main-activity .com{
        color:unset !important;
    }

    strong.highlight .com {
        font-style:unset;
    }
</style>

<body class="hold-transition skin-black-light fixed sidebar-mini" onload="PR.prettyPrint()" data-spy="scroll" data-target="#menu-side" style="font-family: 'Segoe UI Regular';">
    <div class="wrapper">

        <header class="main-header">
            <!-- Logo -->
            <a class="logo border-0 text-lg-left text-center d-flex justify-content-center justify-content-lg-start pl-4" href="<?php echo base_url(); ?>" style="height: 54px; font-size: 40px; color: #3862D3; background-color: #fff !important;">

                <img class="logo-mini align-self-center" src="<?php echo base_url(); ?>palio_logo_round.png" style="height: 30px; width: auto;">

                <img class="logo-lg align-self-center" src="<?php echo base_url(); ?>newuniverse.png" style="height: 40px; width: auto;">

            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" style="padding: 0 0;">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button" style="border-left: 1px solid #d2d6de !important; margin-left: -1px !important; border-right: none !important;">
                    <span class="sr-only">Toggle navigation</span>
                </a>
            </nav>
        </header>
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar p-0 pb-5 side-men" style="left: 0; bottom: 0; padding-left:50px !important;">
            <!-- sidebar: style can be found in sidebar.less -->
            <section id="menu-side" class="sidebar" style="overflow-y: auto; position: relative; height: 100%;">
                <!-- Sidebar user panel -->
                <!-- sidebar menu: : style can be found in sidebar.less -->

                <nav id="navbar-example3" class="navbar navbar-light flex-column px-0" style="background-color: #ecf0f5;">
                    <nav class="nav nav-pills flex-column text-left w-100">

                        <div class="dropdown show">
                            <a class="btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span style="font-family: 'Segoe UI Regular'; font-size:16px; font-weight:bold;">nexilis Lite</span>
                            </a>

                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="background-color: #fff;">
                                <a class="dropdown-item" href="guide_paliolite.php">nexilis Lite</a>
                            </div>
                        </div>
                        <!-- <a class="nav-link quickstart-link" href="#quickstart">Quickstart guide</a>

                        <a class="nav-link sdk-link" href="#sdk">SDK & Code sample</a> -->

                        <a class="nav-link nusdk-link" id="nusdk-link">nexilis Lite</a>
                        <a class="nav-link pl-4 quickstart-link" id="paliolite-link" href="#palio-lite">Quickstart guide - Android</a>
                        <a class="nav-link pl-4 quickstart-link-ios" id="paliolite-link-ios" href="#palio-lite-ios">Quickstart guide - iOS</a>
                        <!-- <a class="nav-link pl-4 quickstart-link" id="themes-link" href="#themes">Customization</a> -->
                        <!-- <a class="nav-link nusdk-link" id="restapi-link" href="#restapi-lite">HTTP REST API</a> -->

                        <a class="nav-link nusdk-link" id="nusdk-link">API</a>
                        <a class="nav-link pl-4 quickstart-link" href="#api-broadcast">Push Notification / Broadcast</a>
                        <a class="nav-link pl-4 quickstart-link" href="#api-email">Email</a>
                        <a class="nav-link pl-4 quickstart-link" href="#api-message">Message</a>
                        <a class="nav-link pl-4 quickstart-link" href="#api-call">VoIP / Video Call</a>


                        <!-- <a class="nav-link pl-4 quickstart-link" id="quickstart-android-link" href="#quickstart-android">Quickstart guide</a>
                        <a class="nav-link pl-4 sdk-link" id="sdk-android-link" href="#sdk-android">SDK & Code sample</a> -->


                        <!-- <a class="nav-link" data-toggle="collapse" data-target="#apiRef" aria-expanded="false" aria-controls="apiRef" href="#">API Reference</a>
                        <div class="collapse pl-2" id="apiRef">
                            <a class="nav-link api-link" href="newdocumentation.php">Android Native</a>
                            <a class="nav-link api-link" href="newdocumentation-flutter.php">Flutter</a>
                        </div> -->
                    </nav>
                </nav>

            </section>
            <!-- /.sidebar -->
        </aside>

        <div class="content-wrapper pl-5 mt-5">


            <div class="row mb-3">
                <div class="col-lg-10 px-4 py-3">
                    <!-- <p style="font-style:italic;"><strong style="text-decoration:underline;">Disclaimer:</strong><br></p>
                    <p style="font-style:italic;">For user security and privacy reasons, nexilis for Android will not run under the following conditions:</p>
                    <ol style="font-style:italic;">
                        <li>Rooted devices </li>
                        <li>Emulators</li>
                        <li>Android version below 6.0 (API 23). Please make sure you have set <strong>minSdkVersion 23</strong> in your <strong>build.gradle (:app)</strong></li>
                    </ol>
                    <p style="font-style:italic;">If you need to debug your application, please remark the nexilis Initialization method call from your MainActivity.</p>
                    <p style="font-style:italic;">For user satisfaction, all features provided in nexilis have been tested to meet certain performance, reliability, and availability standards. If you need to test these features (Audio Call, Video Call, Conference, Online Seminar, etc.), please download <a href="https://play.google.com/store/apps/details?id=io.newuniverse.catchup">catchUp from Google Play Store</a>. catchUp is a Social Media built entirely on top of newuniverse.io to demonstrate nexilis's performance, reliability, and availability standards.</p> -->
                    <pre class="prettyprint mt-2 mb-4">
/**
For user satisfaction, all features provided in nexilis have been tested to meet certain performance, reliability, and availability standards. If you need to test these features (Audio Call, Video Call, Conference, Online Seminar, etc.), please download <strong><a href="https://play.google.com/store/apps/details?id=io.newuniverse.catchup">Nexilis</a></strong> from Google Play Store. <strong><a href="https://play.google.com/store/apps/details?id=io.newuniverse.catchup">Nexilis</a></strong> is a Social Media built entirely using newuniverse.io to demonstrate nexilis's performance, reliability, and availability standards.

=====================
NOTES
=====================
For user security and privacy reasons, newuniverse.io for Android will not work in the following environments:
1. Rooted Devices
2. Emulators
3. Android devices version below 6.0 (API 23). You need to set minSdkVersion 23 in your build.gradle (:app)
4. Especially for the minimum SDK version below 23 (Android OS version 6.0) there needs to be additional code on the Androidmanifest.xml
<xmp><uses-sdk tools::overrideLibrary="
    io.nexilis.nexilisbutton,
    androidx.camera.view,
    androidx.camera.camera2,
    androidx.camera.lifecycle,
    androidx.camera.core "/></xmp>

=====================
Layout Customization
=====================
You can customize the look and layout of our live streaming, online seminar, and audio-video call features. To do so, follow these steps:
1. Download file activity layout (.xml) files dari link: <strong><a id="activity-layout" style="cursor:pointer;" href="downloads/res-pb.zip">res-pb.zip</a></strong>
2. Extract res-pb.zip into your project folder -> app -> src -> main.
3. Edit the gradle.properties configuration following the example below:
	android {
    		...
    
    		sourceSets {
        		main {
            			res.srcDirs = ['src/main/res', 'src/main/res-pb']
        		}
		}

	}
3. Edit the activity layouts as you nIf you are building your app with proguard, add the lines below in your <strong>proguard-rules.pro</strong> file.eed.

Notice:
Please refrain from deleting view components or altering their id's as it may cause errors in the application.

=====================
proguard-rules.pro
=====================
If you are building your app with proguard, add the lines below in your <strong>proguard-rules.pro</strong> file.
-keep class * {native<methods>;}
-keep class androidx.core.app.** {public *;}
-keep class com.google.android.** {*;}
-keep class com.google.mlkit.** {*;}
-keep interface com.google.android.** {*;}
-keep public class javax.mail.** {*;}
-keep public class com.sun.mail.** {*;}
-keep public class org.apache.harmony.** {*;}
# ************************************
-keep class net.sqlcipher.** {*;} 
-keep public class * implements com.bumptech.glide.module.GlideModule
-keep public class * extends com.bumptech.glide.module.AppGlideModule
-keep public enum com.bumptech.glide.load.ImageHeaderParser$* {*[] $VALUES; public *;}
*/
                        </pre>
                </div>
                <div class="col-lg-2"></div>
            </div>
            <div class="row my-4" id="palio-lite">
                <div class="col-lg-10">
                    <h2><strong>nexilis Lite</strong></h2>
                    <h3>Quickstart Guide - Android</h3>
                    <p><strong>Just follow the simple instructions below to embed nexilis Lite into your mobile application.</strong></p>
                    <ol class="instruction">
                        <li>Create a new Android Studio Project or open an existing Project in Android Studio. Please make sure to use an API version 23 or later as your SDK.</li>
                        <li>
                            Modify your module-level build.gradle according to the example below. Don’t forget to use your own Maven credentials for the username and password variables.
                            <pre class="prettyprint linenums:1 mt-2 mb-4">// Please make sure you have set minSdkVersion to 23.
android {
    packagingOptions {
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

// Add the following lines to include the newuniverse.io repository into your app
repositories {
    maven {
        url "https://newuniverse.io/artifactory/nexilis-libs"
        credentials {
            username = "***REPLACE***WITH***YOUR***MAVEN***USERNAME***"
            password = "***REPLACE***WITH***YOUR***MAVEN***PASSWORD***"
        }
    }
}

dependencies {
    // *** Add nexilis Lite dependencies ***
    implementation('**REPLACE*WITH*VERSION*LIBRARY**') {
        transitive = true
    }
}
                            </pre>
                        </li>
                        <li>
                            Synchronize your Project with Gradle Files.
                        </li>
                        <li>
                            Modify the MainActivity.java file.
                            <pre class="prettyprint lang-java linenums:1" id="LS-nusdklite1">
<button type="button" data-clipboard-action="copy" data-clipboard-target="#LS-nusdklite1" class="btn btn-dark copy-snippet mx-1"><i class="fa fa-copy"></i></button>
/***********************************************************************************************************
If you are using <strong class="highlight" style="font-style:unset !important;">Native Android</strong> for your app, please follow the sample code below.

If you are using <strong class="highlight" style="font-style:unset !important;">Flutter</strong>, please refer to <strong><a href="#" role="button" class="highlight switch-main-activity to-flutter">Option-2</a></strong>.
************************************************************************************************************/
package com.example.FloatingButtonSampleCode;

import android.app.Activity;
import android.os.Bundle;
import android.widget.Toast;

import io.nexilis.nexilisbutton.Callback;
import io.nexilis.nexilisbutton.Nexilis;

public class MainActivity extends Activity {

    @Override
    public void onCreate(Bundle bundle) {
        super.onCreate(bundle);
        setContentView(R.layout.activity_main);
 
        /*************************************
         Connect to our server with your newuniverse.io Account, and implement the required Callback.
         Please Subscribe or contact us to get your newuniverse.io Account.
         Do not share your newuniverse.io Account or ever give it out to someone outside your organization.
         ************************************/
        /** 
        * nexilis.connect (String nexilisAccount, Activity RegisteredActivity, int nexilisButtonMode, boolean UserMayModifyUID, Callback ConnectCallback) 
        * 
        * nexilisAccount 		: Your Nexilis.io Account. 
        * RegisteredActivity 	: Android's Activity class that is used to register the Nexilis Button 
        * nexilisButtonMode 	: The flag that determines when the Nexilis Button should appear. 
        * 		1 = Within registered Activity, (Nexilis Button only appears when users are in the registered activity) 
        * 		2 = Within App (Nexilis Button always appears as long as user is in the App), 
        * 		3 = Always On (Nexilis Button always appears even if the application process is closed) 
        * UserMayModifyUID 	: Sets whether users are allowed to change the Nexilis UserID. 
        * 		true = enabled, 
        * 		false = disabled 
        * ConnectCallback	: The callback interface to be invoked when calling the method connect. 
        * 		You need to implement onSuccess(String nexilisUserID) & onFailed(String reasonCode) to handle the RESULT. 
        * 
        */
        Nexilis.connect("***REPLACE***WITH***YOUR***NEXILIS***ACCOUNT***", this,1, new Callback() {
 
            @Override
            public void onSuccess(final String NexilisUserID) {
                /**************************************
                The NexilisUserId parameter is generated automatically, will act and can be mapped to a User ID on the application level.
                For example, the Nexilis User ID (e.g. User001) can be mapped into the corresponding Application User ID (e.g. John Doe),
                so you don't have to share your Application User ID with Nexilis while still being able to monitor your user activities.
                **************************************/
                runOnUiThread(new Runnable() {
                    @Override
                    public void run() {
                        Toast.makeText(getBaseContext(), "Your User ID: " + NexilisUserID, Toast.LENGTH_LONG).show();
                    }
                });
            }
 
            @Override
            public void onFailed(final String reasonCode) {
                /**
                 * reasonCode 	: Returns a code based on the status of the function connect called.
                 * 		2:Your trial subscription has expired. Please subscribe to continue using Nexilis.
                 * 		3:Your monthly subscription is not paid in full. Please pay your monthly subscription bill to continue using Nexilis service.
                 * 		4:Your Customer Engagement Credit has run out and your Prepaid Credit Balance is empty. Please top-up your Prepaid Credit Balance to continue using Nexilis
                 *      23:Unsupported Android version
                 * 		93:Missing the required overlay permission
                 * 		95:Invalid Nexilis Button Mode (1,2,3)
                 * 		96:Activity is null
                 * 		97:Account is empty
                 * 		98:Your account didn't match
                 * 		99:Something went wrong
                 */
                runOnUiThread(new Runnable() {
                    @Override
                    public void run() {
                        Toast.makeText(getBaseContext(), reasonCode, Toast.LENGTH_LONG).show();
                    }
                });
            }
        });
 

        /**
         * 
         * An OPTIONAL Method to change your Nexilis User ID
         * You can call this method anytime after Nexilis.connect calls onSuccess
         * 
         * String ResponCode = Nexilis.changeUsername(String NewUserID)
         * 
         * ResponCode 	: Returns a code based on the status of the function call.
         * 		00:Success
         *      23:Unsupported Android version
         * 		96:Activity is null
         * 		97:Account is empty
         * 		101:Unable to access server. Check your connection and try again later
         * 		102:Duplicate username
         * 		103:Username is empty
         * 		104:Username length is too short
         * 		105:Username length is too long
         * 		106:Illegal State. Be sure to call Nexilis.connect and #callback state onSuccess called
         * NewUserID	: Desired User ID
         */
    }
}
</pre>
<pre class="prettyprint lang-java linenums:1" id="LS-nusdklite1-nonextend-flutter" style="display:none;">
<button type="button" data-clipboard-action="copy" data-clipboard-target="#LS-nusdklite1-nonextend-flutter" class="btn btn-dark copy-snippet mx-1"><i class="fa fa-copy"></i></button>
/***********************************************************************************************************
If you are using <strong class="highlight" style="font-style:unset !important;">Flutter</strong> for your app, please follow the sample code below.

If you are using <strong class="highlight" style="font-style:unset !important;">Native Android</strong>, please refer to <strong><a href="#" role="button" class="highlight switch-main-activity to-native">Option-1</a></strong>.
************************************************************************************************************/
package com.example.nexilislitesamplecode;

import android.app.Activity;
import android.os.Bundle;
import android.widget.TextView;
import android.widget.Toast;

import io.flutter.embedding.android.FlutterActivity;

import io.newuniverse.nexilisbutton.Callback;
import io.newuniverse.nexilisbutton.nexilis;

public class MainActivity extends FlutterActivity {

    @Override
    public void onCreate(Bundle bundle) {
        super.onCreate(bundle);
        setContentView(R.layout.activity_main);
 
        /*************************************
         Connect to our server with your newuniverse.io Account, and implement the required Callback.
         Please Subscribe or contact us to get your newuniverse.io Account.
         Do not share your newuniverse.io Account or ever give it out to someone outside your organization.
         ************************************/
        /** 
        * nexilis.connect (String nexilisAccount, Activity RegisteredActivity, int nexilisButtonMode, boolean UserMayModifyUID, Callback ConnectCallback) 
        * 
        * nexilisAccount 		: Your newuniverse.io Account. 
        * RegisteredActivity 	: Android's Activity class that is used to register the nexilis Button 
        * nexilisButtonMode 	: The flag that determines when the nexilis Button should appear. 
        * 		1 = Within registered Activity, (nexilis Button only appears when users are in the registered activity) 
        * 		2 = Within App (nexilis Button always appears as long as user is in the App), 
        * 		3 = Always On (nexilis Button always appears even if the application process is closed) 
        * UserMayModifyUID 	: Sets whether users are allowed to change the nexilis UserID. 
        * 		true = enabled, 
        * 		false = disabled 
        * ConnectCallback	: The callback interface to be invoked when calling the method connect. 
        * 		You need to implement onSuccess(String nexilisUserID) & onFailed(String reasonCode) to handle the RESULT. 
        * 
        */
        Nexilis.connect("***REPLACE***WITH***YOUR***NEXILIS***ACCOUNT***", this, 2, true, new Callback() {

            @Override
            public void onSuccess(final String nexilisUserID) {
                /**************************************
                 The userId parameter required by the onSuccess method, which is generated automatically, will act as 
                 as a user's nexilis User ID and it can be mapped to a User ID on the application level.
                 For example, the nexilis User ID (e.g. User001) can be mapped into the corresponding Application User ID (e.g. John Doe),
                 so you don't have to share your Application User ID with newuniverse.io while still being able to monitor your user activities.
                 **************************************/
                /* do something */
                runOnUiThread(new Runnable() {
                    @Override
                    public void run() {
                        Toast.makeText(getBaseContext(), "Your nexilis User ID: " + nexilisUserID, Toast.LENGTH_LONG).show();
                    }
                });
            }
 
            @Override
            public void onFailed(final String reasonCode) {
                /**
                 * reasonCode 	: Returns a code based on the status of the function connect called.
                 * 		2:Your trial subscription has expired. Please subscribe to continue using newuniverse.io.
                 * 		3:Your monthly subscription is not paid in full. Please pay your monthly subscription bill to continue using newuniverse.io service.
                 * 		4:Your Customer Engagement Credit has run out and your Prepaid Credit Balance is empty. Please top-up your Prepaid Credit Balance to continue using newuniverse.io
                 *      23:Unsupported Android version
                 * 		93:Missing the required overlay permission
                 * 		95:Invalid nexilis Button Mode (1,2,3)
                 * 		96:Activity is null
                 * 		97:Account is empty
                 * 		98:Your account didn't match
                 * 		99:Something went wrong
                 */
                /* do something */
                runOnUiThread(new Runnable() {
                    @Override
                    public void run() {
                        Toast.makeText(getBaseContext(), reasonCode, Toast.LENGTH_LONG).show();
                    }
                });
            }
        });
 

        /**
         * 
         * An OPTIONAL Method to change your nexilis User ID
         * You can call this method anytime after nexilis.connect calls onSuccess
         * 
         * String ResponCode = nexilis.changeUsername(String NewUserID)
         * 
         * ResponCode 	: Returns a code based on the status of the function call.
         * 		00:Success
         *      23:Unsupported Android version
         * 		96:Activity is null
         * 		97:Account is empty
         * 		101:Unable to access server. Check your connection and try again later
         * 		102:Duplicate username
         * 		103:Username is empty
         * 		104:Username length is too short
         * 		105:Username length is too long
         * 		106:Illegal State. Be sure to call nexilis.connect and #callback state onSuccess called
         * NewUserID	: Desired User ID
         */
        String ResponCode = nexilis.changeUsername("***REPLACE***WITH***NEW***USERID***");
    }
}

</pre>
                        </li>
                        <li>
                            Build your project. If you encounter a Manifest Merger error while building your project, refer to the Notes section at the top of this guide.
                        </li>
                        <li>
                            Run the app from your Android Device and allow the app the permissions that it asks for.
                        </li>
                    </ol>
                </div>
            </div>
            <div class="row my-4" id="palio-lite-ios">
                <div class="col-lg-10">
                    <h3>Quickstart Guide - iOS</h3>
                    <ol class="instruction">
                        <li>Create a new Flutter Project, or open an existing Project in Android Studio. Please make sure your Android Studio already has Flutter Plugin installed, if not, please refer to <a href="https://flutter.dev/docs/get-started/">this</a> guide.</li>
                        <li>
                        Modify your <strong>pubspec.yaml</strong> file according to the example below.
                            <pre class="prettyprint linenums:1 mt-2 mb-4">
name: sample_application_nexilis_lite
description: A new Flutter application.

# The following line prevents the package from being accidentally published to
# pub.dev using `pub publish`. This is preferred for private packages.
publish_to: 'none' # Remove this line if you wish to publish to pub.dev

# The following defines the version and build number for your application.
# A version number is three numbers separated by dots, like 1.2.43
# followed by an optional build number separated by a +.
# Both the version and the builder number may be overridden in flutter
# build by specifying --build-name and --build-number, respectively.
# In Android, build-name is used as versionName while build-number used as versionCode.
# Read more about Android versioning at https://developer.android.com/studio/publish/versioning
# In iOS, build-name is used as CFBundleShortVersionString while build-number used as CFBundleVersion.
# Read more about iOS versioning at
# https://developer.apple.com/library/archive/documentation/General/Reference/InfoPlistKeyReference/Articles/CoreFoundationKeys.html
version: 1.0.0+1

environment:
  sdk: ">=2.7.0 <3.0.0"

dependencies:
  flutter:
    sdk: flutter


  # The following adds the Cupertino Icons font to your application.
  # Use with the CupertinoIcons class for iOS style icons.
  cupertino_icons: ^1.0.0
  <strong>nexilis_lite: ^0.0.1-dev.1</strong>

dev_dependencies:
  flutter_test:
    sdk: flutter

# For information on the generic Dart part of this file, see the
# following page: https://dart.dev/tools/pub/pubspec

# The following section is specific to Flutter.
flutter:

  # The following line ensures that the Material Icons font is
  # included with your application, so that you can use the icons in
  # the material Icons class.
  uses-material-design: true

  # To add assets to your application, add an assets section, like this:
  # assets:
  #   - images/a_dot_burr.jpeg
  #   - images/a_dot_ham.jpeg

  # An image asset can refer to one or more resolution-specific "variants", see
  # https://flutter.dev/assets-and-images/#resolution-aware.

  # For details regarding adding assets from package dependencies, see
  # https://flutter.dev/assets-and-images/#from-packages

  # To add custom fonts to your application, add a fonts section here,
  # in this "flutter" section. Each entry in this list should have a
  # "family" key with the font family name, and a "fonts" key with a
  # list giving the asset and other descriptors for the font. For
  # example:
  # fonts:
  #   - family: Schyler
  #     fonts:
  #       - asset: fonts/Schyler-Regular.ttf
  #       - asset: fonts/Schyler-Italic.ttf
  #         style: italic
  #   - family: Trajan Pro
  #     fonts:
  #       - asset: fonts/TrajanPro.ttf
  #       - asset: fonts/TrajanPro_Bold.ttf
  #         weight: 700
  #
  # For details regarding fonts from package dependencies,
  # see https://flutter.dev/custom-fonts/#from-packages
                            </pre>
                        </li>
                        <li>
                        Synchronize your Project with the newly modified pubspec.yaml file.
                        </li>
                        <li>
                        Modify your <strong>main.dart</strong> file according to the example provided below. Make sure you are using your nexilis Account to connect to newuniverse.io.
                        <pre class="prettyprint linenums:1 mt-2 mb-4">
import 'package:flutter/material.dart';
import 'dart:async';

import 'package:flutter/services.dart';
import 'package:nexilis_lite/nexilis_button.dart';
import 'package:nexilis_lite/nexilis_lite.dart';

void main() {
  runApp(MyApp());
}

class MyApp extends StatefulWidget {
  @override
  _MyAppState createState() => _MyAppState();
}

class _MyAppState extends State<MyApp> {
  String _platformVersion = 'Unknown';

  @override
  void initState() {
    super.initState();
    initPlatformState();
  }

  // Platform messages are asynchronous, so we initialize in an async method.
  Future<void> initPlatformState() async {
    String platformVersion;
    // Platform messages may fail, so we use a try/catch PlatformException.
    // We also handle the message potentially returning null.
    try {
      platformVersion =
          await nexilisLite.platformVersion ?? 'Unknown platform version';
    } on PlatformException {
      platformVersion = 'Failed to get platform version.';
    }

    // If the widget was removed from the tree while the asynchronous platform
    // message was in flight, we want to discard the reply rather than calling
    // setState to update our non-existent appearance.
    if (!mounted) return;

    setState(() {
      _platformVersion = platformVersion;
    });
  }

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      home: Scaffold(
        appBar: AppBar(
          title: const Text('Plugin example app'),
        ),
        body: Stack(
          children: [
            nexilisButton(
                xpos: 0,
                ypos: 0,
                apiKey:
                    '***REPLACE***WITH***YOUR***NEXILIS***ACCOUNT***'),
          ],
        ),
      ),
    );
  }
}
                        </pre>
                        </li>
                        <li>
                        Build your project and make sure you\'re not using any emulator.
                            
                        </li>
                        <li>
                        Run the app on your iOS device, and allow the app the permissions that it asks for.
                        </li>
                    </ol>
                </div>
            </div>
            <div class="row my-4" id="api-broadcast">
                <div class="col-lg-10">
                    <h3>Quickstart Guide - API Broadcast</h3>
                    <p>Everything about sending broadcast to single or multiple destinations.</p>
                    <hr>
                    <p><strong>POST</strong> Send Broadcast</p>
                    <p style="background-color: #ddd; padding: 10px">https://newuniverse.io/api/services/broadcast</p>
                    <p><strong>You can use this endpoint to send broadcast to single or multiple target.</strong></p>
                    <table>
                        <tr>
                            <th>Property</th>
                            <th>type</th>
                            <th>Required</th>
                        </tr>
                        <tr>
                            <td>sender</td>
                            <td>string</td>
                            <td>true</td>
                        </tr>
                        <tr>
                            <td>target_audience</td>
                            <td>string</td>
                            <td>true</td>
                        </tr>
                        <tr>
                            <td>destinations</td>
                            <td>string / file</td>
                            <td>false</td>
                        </tr>
                        <tr>
                            <td>broadcast_type</td>
                            <td>string</td>
                            <td>true</td>
                        </tr>
                        <tr>
                            <td>broadcast_mode</td>
                            <td>string</td>
                            <td>true</td>
                        </tr>
                        <tr>
                            <td>start_date</td>
                            <td>string</td>
                            <td>true</td>
                        </tr>
                        <tr>
                            <td>end_date</td>
                            <td>string</td>
                            <td>false</td>
                        </tr>
                        <tr>
                            <td>category</td>
                            <td>string</td>
                            <td>true</td>
                        </tr>
                        <tr>
                            <td>title</td>
                            <td>string</td>
                            <td>true</td>
                        </tr>
                        <tr>
                            <td>message</td>
                            <td>string</td>
                            <td>true</td>
                        </tr>
                        <tr>
                            <td>file</td>
                            <td>file</td>
                            <td>false</td>
                        </tr>
                        <tr>
                            <td>form_id</td>
                            <td>string</td>
                            <td>false</td>
                        </tr>
                    </table>
                    <hr>
                    <p><strong>Description</strong></p>
                    <table>
                        <tr>
                            <td><b>sender</b></td>
                            <td>FPIN of the sender.</td>
                        </tr>
                        <tr>
                            <td><b>target_audience</b></td>
                            <td>Your broadcast audience category.<br><br>
                                1 = Customer,<br>
                                2 = Team members,<br>
                                3 = All users,<br>
                                4 = Specific group,<br>
                                5 = Specific user 
                            </td>
                        </tr>
                        <tr>
                            <td><b>destinations</b></td>
                            <td>Your broadcast destination.<br><br>
                                If your audience category is 4/5, then you can attach your broadcast goals. Destinations are in the form of FPIN for specific users, and GROUP_ID for specific groups.<br><br>
                                Note: If there is only 1 group / user then you can directly write the FPIN / GROUP_ID in string form, but if the broadcast destination is more than 1 user / group, you must write the FPIN / GROUP_ID in a .txt file and separated by commas.<br>
                            </td>
                        </tr>
                        <tr>
                            <td><b>broadcast_type</b></td>
                            <td>Broadcast type.<br><br>
                                1 = Push Notifications,<br>
                                2 = In-App Notifications 
                            </td>
                        </tr>
                        <tr>
                            <td><b>broadcast_mode</b></td>
                            <td>Broadcast period.<br><br>
                                1 = Once,<br>
                                2 = Daily,<br>
                                3 = Weekly,<br>
                                4 = Monthly
                            </td>
                        </tr>
                        <tr>
                            <td><b>start_date</b></td>
                            <td>Broadcast delivery date.<br><br>
                                Note: Date format is YYYY/MM/DD HH:MM:SS. 
                            </td>
                        </tr>
                        <tr>
                            <td><b>end_date</b></td>
                            <td>Broadcast end date.<br><br>
                                Note: Date format is YYYY/MM/DD HH:MM:SS. If your broadcast period is daily, weekly or monthly, you are required to fill in this parameter. 
                            </td>
                        </tr>
                        <tr>
                            <td><b>category</b></td>
                            <td>The type of content you send in a broadcast.<br><br>
                                0 = Text,<br>
                                1 = Image,<br>
                                2 = Videos,<br>
                                3 = Files / Documents
                            </td>
                        </tr>
                        <tr>
                            <td><b>title</b></td>
                            <td>Broadcast title.</td>
                        </tr>
                        <tr>
                            <td><b>message</b></td>
                            <td>Broadcast message.</td>
                        </tr>
                        <tr>
                            <td><b>file</b></td>
                            <td>Image, video, or document.</td>
                        </tr>
                        <tr>
                            <td><b>form_id</b></td>
                            <td>Survey content.</td>
                        </tr>
                    </table>
                    <hr>
                    <p><strong>Example</strong></p>
                    
                            <pre class="prettyprint linenums:1 mt-2 mb-4">
curl --location --request POST 'https://newuniverse.io/api/services/broadcast' \
--form 'sender="02c093470c"' \
--form 'target_audience="5"' \
--form 'destinations="02c09347a"' \
--form 'broadcast_type="1"' \
--form 'broadcast_mode="1"' \
--form 'start_date="2021/02/12 00:00:00"' \
--form 'category="3"' \
--form 'title="title"' \
--form 'message="message"' \
--form 'file=@"/PATH/document.txt"'
                            </pre>
                    <hr>
                    <p><strong>Response</strong></p>
                    
                            <pre class="prettyprint linenums:1 mt-2 mb-4">
{"message" : "Broadcast was sent."}
                            </pre>
                        
                </div>
            </div>
            <div class="row my-4" id="api-email">
                <div class="col-lg-10">
                    <h3>Quickstart Guide - API Email</h3>
                    <p>Everything about sending email to single or multiple destinations.</p>
                    <hr>
                    <p><strong>POST</strong> Send Email</p>
                    <p style="background-color: #ddd; padding: 10px">https://newuniverse.io/api/services/email</p>
                    <p><strong>You can use this endpoint to send emails to single or multiple email addresses.</strong></p>
                    <table>
                        <tr>
                            <th>Property</th>
                            <th>type</th>
                            <th>Required</th>
                        </tr>
                        <tr>
                            <td>subject</td>
                            <td>string</td>
                            <td>true</td>
                        </tr>
                        <tr>
                            <td>destinations</td>
                            <td>string / file</td>
                            <td>true</td>
                        </tr>
                        <tr>
                            <td>body</td>
                            <td>string</td>
                            <td>true</td>
                        </tr>
                        <tr>
                            <td>attachments</td>
                            <td>file</td>
                            <td>false</td>
                        </tr>
                    </table>
                    <hr>
                    <p><strong>Description</strong></p>
                    <table>
                        <tr>
                            <td><b>subject</b></td>
                            <td>Subject email.</td>
                        </tr>
                        <tr>
                            <td><b>destinations</b></td>
                            <td>If there is only 1 email destination, then you can directly write the email in string form, but if the email destination is more than 1, you must write the emails in a .txt file and separated by commas.</td>
                        </tr>
                        <tr>
                            <td><b>body</b></td>
                            <td>Email body.</td>
                        </tr>
                        <tr>
                            <td><b>attachments</b></td>
                            <td>Attachment files.</td>
                        </tr>
                    </table>
                    <hr>
                    <p>Example</p>
                    
                            <pre class="prettyprint linenums:1 mt-2 mb-4">
curl --location --request POST 'https://newuniverse.io/api/services/email' \
--form 'destinations="email@domain.com"' \
--form 'subject="subject"' \
--form 'body="body"' \
--form 'attachments=@"/PATH/document.txt"'
                            </pre>
                    <hr>
                    <p><strong>Response</strong></p>
                    
                            <pre class="prettyprint linenums:1 mt-2 mb-4">
{"message" : "Email was sent."}
                            </pre>
                        
                </div>
            </div>
            <div class="row my-4" id="api-message">
                <div class="col-lg-10">
                    <h3>Quickstart Guide - API Message</h3>
                    <p>Everything about sending message to user or group.</p>
                    <hr>
                    <p><strong>POST</strong> Send Message</p>
                    <p style="background-color: #ddd; padding: 10px">https://newuniverse.io/api/services/message</p>
                    <p><strong>You can use this endpoint to send messages to user / group.</strong></p>
                    <table>
                        <tr>
                            <th>Property</th>
                            <th>type</th>
                            <th>Required</th>
                        </tr>
                        <tr>
                            <td>originator</td>
                            <td>string</td>
                            <td>true</td>
                        </tr>
                        <tr>
                            <td>destination</td>
                            <td>string</td>
                            <td>true</td>
                        </tr>
                        <tr>
                            <td>content</td>
                            <td>string</td>
                            <td>true</td>
                        </tr>
                        <tr>
                            <td>file</td>
                            <td>file</td>
                            <td>false</td>
                        </tr>
                    </table>
                    <hr>
                    <p><strong>Description</strong></p>
                    <table>
                        <tr>
                            <td><b>originator</b></td>
                            <td>FPIN of the originator.</td>
                        </tr>
                        <tr>
                            <td><b>destination</b></td>
                            <td>FPIN of the destination.</td>
                        </tr>
                        <tr>
                            <td><b>content</b></td>
                            <td>Content of the message.</td>
                        </tr>
                        <tr>
                            <td><b>file</b></td>
                            <td>Attachment files.</td>
                        </tr>
                    </table>
                    <hr>
                    <p>Example</p>
                    
                            <pre class="prettyprint linenums:1 mt-2 mb-4">
curl --location --request POST 'https://newuniverse.io/api/services/message' \
--form 'originator="02c093470c"' \
--form 'destination="02c093470b"' \
--form 'content="This is the message"' \
--form 'file=@"PATH/document.txt"'
                            </pre>
                    <hr>
                    <p><strong>Response</strong></p>
                    
                            <pre class="prettyprint linenums:1 mt-2 mb-4">
{"message" : "Message was sent."}
                            </pre>
                        
                </div>
            </div>
            <div class="row my-4" id="api-call">
                <div class="col-lg-10">
                    <h3>Quickstart Guide - API VoIP / Video Call</h3>
                    <p>Everything about starting VoIP or Video Call.</p>
                    <hr>
                    <p><strong>POST</strong> Start VoIP / Video Call</p>
                    <p style="background-color: #ddd; padding: 10px">https://newuniverse.io/api/services/vcall</p>
                    <p><strong>You can use this endpoint to do VoIP or Video Call.</strong></p>
                    <table>
                        <tr>
                            <th>Property</th>
                            <th>type</th>
                            <th>Required</th>
                        </tr>
                        <tr>
                            <td>api_key</td>
                            <td>string</td>
                            <td>true</td>
                        </tr>
                        <tr>
                            <td>user_id</td>
                            <td>string</td>
                            <td>true</td>
                        </tr>
                        <tr>
                            <td>room_name</td>
                            <td>string</td>
                            <td>true</td>
                        </tr>
                        <tr>
                            <td>camera</td>
                            <td>integer</td>
                            <td>true</td>
                        </tr>
                    </table>
                    <hr>
                    <p><strong>Description</strong></p>
                    <table>
                        <tr>
                            <td><b>api_key</b></td>
                            <td>nexilis account from nexilis Web Dashboard.</td>
                        </tr>
                        <tr>
                            <td><b>user_id</b></td>
                            <td>FPIN of the initiator.</td>
                        </tr>
                        <tr>
                            <td><b>room_name</b></td>
                            <td>The name of the room.</td>
                        </tr>
                        <tr>
                            <td><b>camera</b></td>
                            <td>If you are going to do voice call, set the camera to 0 and 1 for the video call.</td>
                        </tr>
                    </table>
                    <hr>
                    <p>Example</p>
                    
                            <pre class="prettyprint linenums:1 mt-2 mb-4">
curl --location --request POST 'https://newuniverse.io/api/services/vcall' \
--header 'Content-Type: application/x-www-form-urlencoded' \
--data-urlencode 'api_key=E8E05077943A6961E969AEA202F5AF2D3FD3961B12E13AA9066500CDFADXXXXX' \
--data-urlencode 'user_id=02c093470b' \
--data-urlencode 'room_name=Room Name' \
--data-urlencode 'camera=1'
                            </pre>
                        
                </div>
            </div>
        </div>
    </div>
    <div class="control-sidebar-bg"></div>
    </div>
    <!-- </div> -->

    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
   immediately after the control sidebar -->
    <!-- <div class="control-sidebar-bg"></div> -->

    <!-- </div>  -->

    <script type="text/javascript">
       $(document).ready(function() {
    $("#paliolite-link").addClass("active");
    $("#customization-link").removeClass("active");
    $("#nusdk-link").removeClass("active");
    $("#restapi-link").removeClass("active");
});

var docHeight = document.documentElement.offsetHeight;

[].forEach.call(
    document.querySelectorAll('*'),
    function(el) {
        if (el.offsetHeight > docHeight) {
            console.log(el);
        }
    }
);
$('body').scrollspy({
    target: '#menu-side'
});

$('.to-flutter').click(function (e) {
		e.preventDefault();
        e.stopPropagation();
		$('#mainactivity-title').text('MainActivity.java (Option 2)');
		$('#LS-nusdklite1-nonextend-flutter').show();
		$('#LS-nusdklite1').hide();
	});

	$('.to-native').click(function (e) {
		e.preventDefault();
        e.stopPropagation();
		$('#mainactivity-title').text('MainActivity.java (Option 1)');
		$('#LS-nusdklite1').show();
		$('#LS-nusdklite1-nonextend-flutter').hide();
	});

$(window).on('activate.bs.scrollspy', function() {

    var item = $('#menu-side').find(".active").last();
    item.animatescroll({
        element: '#menu-side',
        padding: 500
    });
    
});

var url = window.location.pathname;
$('#active-guide').text(url);
    </script>

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
    <!-- <script src="bower_components/raphael/raphael.min.js"></script> -->
    <!-- <script src="bower_components/morris.js/morris.min.js"></script> -->
    <!-- Sparkline -->
    <!-- <script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script> -->
    <!-- jvectormap -->
    <!-- <script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script> -->
    <!-- <script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script> -->
    <!-- jQuery Knob Chart -->
    <!-- <script src="bower_components/jquery-knob/dist/jquery.knob.min.js"></script> -->
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