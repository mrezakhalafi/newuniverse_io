<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Android-SDK Specification</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <!-- <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css"> -->
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
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
  li.L0,
  li.L1,
  li.L2,
  li.L3,
  li.L5,
  li.L6,
  li.L7,
  li.L8 {
    list-style-type: none
  }

  /* Alternate shading for lines */
  li.L1,
  li.L3,
  li.L5,
  li.L7,
  li.L9 {}

  li.L0,
  li.L1,
  li.L2,
  li.L3,
  li.L5,
  li.L6,
  li.L7,
  li.L8 {
    list-style-type: decimal !important;
  }

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
</style>

<body class="hold-transition skin-black-light fixed sidebar-mini" onload="PR.prettyPrint()" data-spy="scroll"
  data-target="#menu-side" style="font-family: 'Segoe UI Regular';">
  <div class="wrapper">

    <header class="main-header">
      <!-- Logo -->
      <a class="logo border-0 text-lg-left text-center d-flex justify-content-center justify-content-lg-start pl-4"
        href="newdashboard.php"
        style="height: 54px; font-size: 40px; color: #3862D3; background-color: #fff !important;">

        <img class="logo-mini align-self-center" src="./newAssets/new-u-logo-alt.svg"
          style="height: 30px; width: auto;">

        <img class="logo-lg align-self-center" src="./newAssets/new-u-logo-alt.svg" style="height: 40px; width: auto;">

      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top" style="padding: 0 0;">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button"
          style="border-left: 1px solid #d2d6de !important; margin-left: -1px !important; border-right: none !important;">
          <span class="sr-only">Toggle navigation</span>
        </a>
      </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar p-0 side-men" style="left: 0; bottom: 0; padding-left: 49px !important;">
      <!-- sidebar: style can be found in sidebar.less -->
      <section id="menu-side" class="sidebar" style="overflow-y: auto; position: relative; height: 100%;">
        <!-- Sidebar user panel -->
        <!-- sidebar menu: : style can be found in sidebar.less -->

        <nav id="navbar-example3" class="navbar navbar-light flex-column px-0" style="background-color: #ecf0f5;">
          <nav class="nav nav-pills flex-column text-left w-100">
            <a class="nav-link active" href="#intro">Introduction</a>
            <a class="nav-link active" href="#dwnld">Download</a>
            <a class="nav-link active" href="#permit">Request Permission</a>
            <a class="nav-link active" href="#example">Example Code</a>
            <ul class="navbar-nav" style="cursor: pointer;">
              <li class="nav-item dropdown">
                <a class="nav-link active pl-4 dropdown-toggle" data-toggle="dropdown" role="button">Live Streaming</a>
                <div class="dropdown-menu border-0 px-2">
                  <a class="nav-link active pl-4 dropdown-item" href="#ls-desc">Description</a>
                  <a class="nav-link active pl-4 dropdown-item" href="#ls-kotlin">Code</a>
                </div>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link active pl-4 dropdown-toggle" data-toggle="dropdown" role="button">Audio Call</a>
                <div class="dropdown-menu border-0 px-2">
                  <a class="nav-link active pl-4 dropdown-item" href="#ac-desc">Description</a>
                  <a class="nav-link active pl-4 dropdown-item" href="#ac-kotlin">Code</a>
                </div>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link active pl-4 dropdown-toggle" data-toggle="dropdown" role="button">Video Call</a>
                <div class="dropdown-menu border-0 px-2">
                  <a class="nav-link active pl-4 dropdown-item" href="#vc-desc">Description</a>
                  <a class="nav-link active pl-4 dropdown-item" href="#vc-kotlin">Code</a>
                </div>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link active pl-4 dropdown-toggle" data-toggle="dropdown" role="button">Screen Sharing</a>
                <div class="dropdown-menu border-0 px-2">
                  <a class="nav-link active pl-4 dropdown-item" href="#ss-desc">Description</a>
                  <a class="nav-link active pl-4 dropdown-item" href="#ss-kotlin">Code</a>
                </div>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link active pl-4 dropdown-toggle" data-toggle="dropdown" role="button">Whiteboard</a>
                <div class="dropdown-menu border-0 px-2">
                  <a class="nav-link active pl-4 dropdown-item" href="#wb-desc">Description</a>
                  <a class="nav-link active pl-4 dropdown-item" href="#wb-kotlin">Code</a>
                </div>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link active pl-4 dropdown-toggle" data-toggle="dropdown" role="button">Unified
                  Messaging</a>
                <div class="dropdown-menu border-0 px-2">
                  <a class="nav-link active pl-4 dropdown-item" href="#um-desc">Description</a>
                  <a class="nav-link active pl-4 dropdown-item" href="#um-kotlin">Code</a>
                </div>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link active pl-4 dropdown-toggle" data-toggle="dropdown" role="button">Chatbot</a>
                <div class="dropdown-menu border-0 px-2">
                  <a class="nav-link active pl-4 dropdown-item" href="#cb-desc">Description</a>
                  <a class="nav-link active pl-4 dropdown-item" href="#cb-desc">Code</a>
                </div>
              </li>
            </ul>
            <a class="nav-link active" href="sdk.php" target="_blank">Flutter</a>
          </nav>
        </nav>

      </section>
      <!-- /.sidebar -->
    </aside>

    <div class="content-wrapper" style="overflow-x: auto;">

      <span id="intro">&nbsp;</span>
      <div class="container mt-5 mx-4">

        <div class="row">
          <div class="col-lg-10">
            <span style="font-size: 25px;"><b>Introduction</b></span><br>
            <div class="mt-2" style="font-size: 16px;">
              This document provides detailed documentation for the New Universe Service SDK for application based on
              Android. This document allows developer to implement communication feature quickly and easily. Here are
              some features provided in this SDK:
            </div>
            <div class="mt-1 mb-2" style="font-size: 16px;">
              <ol>
                <li>Live Streaming</li>
                <li>Audio Call</li>
                <li>Video Call</li>
                <li>Screen Sharing</li>
                <li>White Board</li>
                <li>Unified Messaging</li>
                <li id="dwnld">Chat Bot (Soon)</li>
              </ol>
            </div>
          </div> <!-- End Column -->
          <div class="col-lg-2">

          </div>
        </div> <!-- End Row -->

        <div class="row">
          <div class="col-lg-10">
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
    implementation 'easySoft.co.id:nuSDK:1.0.0 '
}


artifactory_username=easysoft
artifactory_password=AP2bu1aYdZFduSgLot1kLFBBfqS
          </pre>
          </div> <!-- End Column -->
          <div class="col-lg-2">

          </div>
        </div> <!-- End Row -->

        <span id="permit">&nbsp;</span>

        <div class="row mt-4">
          <div class="col-lg-10">
            <span style="font-size: 25px;"><b>Request Permission</b></span><br>
            <div class="mt-2" style="font-size: 16px;">
              To implement functions in this API, developer must implement request for these permissions:
            </div>
            <pre class="prettyprint linenums:1 mt-2 mb-4">
     ...

    &lt;uses-permission android:name="android.permission.ACCESS_NETWORK_STATE"/&gt;
    &lt;uses-permission android:name="android.permission.ACCESS_WIFI_STATE"/&gt;
    &lt;uses-permission android:name="android.permission.CAMERA"/&gt;
    &lt;uses-permission android:name="android.permission.INTERNET"/&gt;
    &lt;uses-permission android:name="android.permission.RECEIVE_BOOT_COMPLETED"/&gt;
    &lt;uses-permission android:name="android.permission.REQUEST_IGNORE_BATTERY_OPTIMIZATIONS"/&gt;
    &lt;uses-permission android:name="android.permission.WAKE_LOCK"/&gt;
    &lt;uses-permission android:name="android.permission.MODIFY_AUDIO_SETTINGS" /&gt;
    &lt;uses-permission android:name="android.permission.RECORD_VIDEO" /&gt;
    &lt;uses-permission android:name="android.permission.RECORD_AUDIO" /&gt;
   
     ...
          </pre>
          </div> <!-- End Col -->
          <div class="col-lg-2">

          </div>
        </div> <!-- End Row -->

        <span id="example">&nbsp;</span>

        <div class="row mt-4">
          <div class="col-lg-10">
            <span id="ls" style="font-size: 25px;"><b>Example Code</b></span><br>


            <div class="mt-4" style="font-size: 20px;">
              <b>Live Streaming</b>
            </div>

            <span id="ls-desc">&nbsp;</span>

            <div class="mt-4" style="font-size: 18px;">
              <b>Description</b>
            </div>
            <div style="font-size: 15px;">
              Simple Code to build live streaming feature.
            </div>

            <span id="ls-kotlin">&nbsp;</span>

            <div class="mt-4" style="font-size: 18px;">
              <b>Code</b>
            </div>
            <div style="font-size: 15px;">
              <pre class="prettyprint linenums:1 mt-2 mb-4">
package io.newuniverse.luna

import android.Manifest
import android.content.Intent
import android.content.pm.PackageManager
import android.os.Bundle
import androidx.appcompat.app.AppCompatActivity
import androidx.core.app.ActivityCompat
import androidx.core.content.ContextCompat
import io.newuniverse.nusdk.core.NuSDK
import io.newuniverse.nusdk.livestreaming.LiveStreamingActivity
import kotlinx.android.synthetic.main.audio_call_example.start
import kotlinx.android.synthetic.main.live_streaming_example.*

class LiveStreamingExample : AppCompatActivity() {


    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)

        setContentView(R.layout.live_streaming_example)

        NuSDK.init("abcd_1234", "yayandw")

        bind()

        start.setOnClickListener {
            val intent = Intent(this, LiveStreamingActivity::class.java)
            startActivity(intent)
        }

        join.setOnClickListener {
            val intent = Intent(this, LiveStreamingActivity::class.java)
                .putExtra("Destination", "tesa")
            startActivity(intent)
        }
    }

    private var permissions = arrayOf(
        Manifest.permission.READ_PHONE_STATE,
        Manifest.permission.RECORD_AUDIO,
        Manifest.permission.WRITE_EXTERNAL_STORAGE,
        Manifest.permission.READ_EXTERNAL_STORAGE,
        Manifest.permission.CAMERA,
        Manifest.permission.MODIFY_AUDIO_SETTINGS
    )

    private fun isAllowPermission(): Boolean {
        for (permission in permissions) {
            if (ContextCompat.checkSelfPermission(
                    this,
                    permission
                ) != PackageManager.PERMISSION_GRANTED
            ) {
                ActivityCompat.requestPermissions(this, permissions, 1)
                return false
            }
        }
        return true
    }

    override fun onRequestPermissionsResult(
        requestCode: Int,
        permissions: Array<String?>,
        grantResults: IntArray
    ) {
        super.onRequestPermissionsResult(requestCode, permissions, grantResults)
        if (!isAllowPermission()) {
            finish()
            return
        }
        bind()
    }

    private fun bind() {
        if (ActivityCompat.checkSelfPermission(
                this,
                Manifest.permission.READ_PHONE_STATE
            ) != PackageManager.PERMISSION_GRANTED || ActivityCompat.checkSelfPermission(
                this,
                Manifest.permission.WRITE_EXTERNAL_STORAGE
            ) != PackageManager.PERMISSION_GRANTED
        ) {
            ActivityCompat.requestPermissions(this, permissions, 1)
            return
        }
        NuSDK.bind(this, object : NuSDK.BindListener {
            override fun failed(var1: String?) {

            }

            override fun success() {

            }
        })
    }
}

  </pre>
            </div>


            <span id="ac">&nbsp;</span>
            <div class="mt-2" style="font-size: 20px;">
              <b>Audio Call</b>
            </div>

            <span id="ac-desc">&nbsp;</span>

            <div class="mt-4" style="font-size: 18px;">
              <b>Description</b>
            </div>
            <div style="font-size: 15px;">
              Simple Code to build audio call feature.
            </div>

            <span id="ac-kotlin">&nbsp;</span>

            <div class="mt-4" style="font-size: 18px;">
              <b>Code</b>
            </div>
            <div style="font-size: 15px;">
              <pre class="prettyprint lang-kotlin linenums:1 mt-2 mb-4">
package io.newuniverse.luna

import android.Manifest
import android.content.Intent
import android.content.pm.PackageManager
import android.os.Bundle
import androidx.appcompat.app.AppCompatActivity
import androidx.core.app.ActivityCompat
import androidx.core.content.ContextCompat
import io.newuniverse.nusdk.audio.AudioCallActivity
import io.newuniverse.nusdk.core.NuSDK
import kotlinx.android.synthetic.main.audio_call_example.*

class AudioCallExample : AppCompatActivity() {

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)

        setContentView(R.layout.audio_call_example)

        NuSDK.init("abcd_1234", "yayandw")

        bind()

        NuSDK.registerAudioCallReceiver { var1, var2, var3, var4 ->
            val intent = Intent(var1, AudioCallActivity::class.java)
                .putExtra("Originator", var2)
            var1.startActivity(intent)
        }

        start.setOnClickListener {
            val intent = Intent(this, AudioCallActivity::class.java)
                .putExtra("Destination", "tesa")
            startActivity(intent)
        }
    }

    private var permissions = arrayOf(
        Manifest.permission.READ_PHONE_STATE,
        Manifest.permission.RECORD_AUDIO,
        Manifest.permission.WRITE_EXTERNAL_STORAGE,
        Manifest.permission.READ_EXTERNAL_STORAGE,
        Manifest.permission.MODIFY_AUDIO_SETTINGS
    )

    private fun isAllowPermission(): Boolean {
        for (permission in permissions) {
            if (ContextCompat.checkSelfPermission(
                    this,
                    permission
                ) != PackageManager.PERMISSION_GRANTED
            ) {
                ActivityCompat.requestPermissions(this, permissions, 1)
                return false
            }
        }
        return true
    }

    override fun onRequestPermissionsResult(
        requestCode: Int,
        permissions: Array<String?>,
        grantResults: IntArray
    ) {
        super.onRequestPermissionsResult(requestCode, permissions, grantResults)
        if (!isAllowPermission()) {
            finish()
            return
        }
        bind()
    }

    private fun bind() {
        if (ActivityCompat.checkSelfPermission(
                this,
                Manifest.permission.READ_PHONE_STATE
            ) != PackageManager.PERMISSION_GRANTED || ActivityCompat.checkSelfPermission(
                this,
                Manifest.permission.WRITE_EXTERNAL_STORAGE
            ) != PackageManager.PERMISSION_GRANTED
        ) {
            ActivityCompat.requestPermissions(this, permissions, 1)
            return
        }
        NuSDK.bind(this, object : NuSDK.BindListener {
            override fun success() {

            }

            override fun failed(sMessage: String) {

            }
        })
    }
}
            </pre>
            </div>

            <span id="vc">&nbsp;</span>
            <div class="mt-2" style="font-size: 20px;">
              <b>Video Call</b>
            </div>

            <span id="vc-desc">&nbsp;</span>

            <div class="mt-4" style="font-size: 18px;">
              <b>Description</b>
            </div>
            <div style="font-size: 15px;">
              Simple Code to build audio call feature.
            </div>

            <span id="vc-kotlin">&nbsp;</span>

            <div class="mt-4" style="font-size: 18px;">
              <b>Code</b>
            </div>
            <div style="font-size: 15px;">
              <pre class="prettyprint lang-kotlin linenums:1 mt-2 mb-4">
package io.newuniverse.luna

import android.Manifest
import android.content.Intent
import android.content.pm.PackageManager
import android.os.Bundle
import androidx.appcompat.app.AppCompatActivity
import androidx.core.app.ActivityCompat
import androidx.core.content.ContextCompat
import io.newuniverse.nusdk.core.NuSDK
import io.newuniverse.nusdk.video.VideoCallActivity
import kotlinx.android.synthetic.main.video_call_example.*

class VideoCallExample : AppCompatActivity() {

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)

        setContentView(R.layout.video_call_example)

        NuSDK.init("abcd_1234", "yayandw")

        bind()

        NuSDK.registerVideoCallReceiver { var1, var2, var3, var4 ->
            val intent: Intent = Intent(var1, VideoCallActivity::class.java)
                .putExtra("Originator", var2)
                .addFlags(Intent.FLAG_ACTIVITY_NEW_TASK)
            var1.startActivity(intent)
        }

        start.setOnClickListener {
            val intent = Intent(this, VideoCallActivity::class.java)
                .putExtra("Destination", "tesa")
            startActivity(intent)
        }
    }

    private var permissions = arrayOf(
        Manifest.permission.CAMERA,
        Manifest.permission.READ_PHONE_STATE,
        Manifest.permission.RECORD_AUDIO,
        Manifest.permission.WRITE_EXTERNAL_STORAGE,
        Manifest.permission.READ_EXTERNAL_STORAGE,
        Manifest.permission.MODIFY_AUDIO_SETTINGS
    )

    private fun isAllowPermission(): Boolean {
        for (permission in permissions) {
            if (ContextCompat.checkSelfPermission(
                    this,
                    permission
                ) != PackageManager.PERMISSION_GRANTED
            ) {
                ActivityCompat.requestPermissions(this, permissions, 1)
                return false
            }
        }
        return true
    }

    override fun onRequestPermissionsResult(
        requestCode: Int,
        permissions: Array<String?>,
        grantResults: IntArray
    ) {
        super.onRequestPermissionsResult(requestCode, permissions, grantResults)
        if (!isAllowPermission()) {
            finish()
            return
        }
        bind()
    }

    private fun bind() {
        if (ActivityCompat.checkSelfPermission(
                this,
                Manifest.permission.READ_PHONE_STATE
            ) != PackageManager.PERMISSION_GRANTED || ActivityCompat.checkSelfPermission(
                this,
                Manifest.permission.WRITE_EXTERNAL_STORAGE
            ) != PackageManager.PERMISSION_GRANTED
        ) {
            ActivityCompat.requestPermissions(this, permissions, 1)
            return
        }
        NuSDK.bind(this, object : NuSDK.BindListener {
            override fun success() {

            }

            override fun failed(sMessage: String) {

            }
        })
    }

}
            </pre>
            </div>

            <span id="ss">&nbsp;</span>

            <div class="mt-4" style="font-size: 20px;">
              <b>Screen Sharing</b>
            </div>

            <span id="ss-desc">&nbsp;</span>

            <div class="mt-4" style="font-size: 18px;">
              <b>Description</b>
            </div>
            <div style="font-size: 15px;">
              Simple Code to build screen sharing feature.
            </div>

            <span id="ss-kotlin">&nbsp;</span>

            <div class="mt-4" style="font-size: 18px;">
              <b>Code</b>
            </div>
            <div style="font-size: 15px;">
              <pre class="prettyprint linenums:1 mt-2 mb-4">
package io.newuniverse.luna

import android.Manifest
import android.content.Intent
import android.content.pm.PackageManager
import android.os.Bundle
import androidx.appcompat.app.AppCompatActivity
import androidx.core.app.ActivityCompat
import androidx.core.content.ContextCompat
import io.newuniverse.nusdk.core.NuSDK
import io.newuniverse.nusdk.screensharing.ScreenSharingActivity
import kotlinx.android.synthetic.main.audio_call_example.start
import kotlinx.android.synthetic.main.live_streaming_example.join
import kotlinx.android.synthetic.main.screen_sharing_example.*

class ScreenSharingExample : AppCompatActivity() {


    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)

        setContentView(R.layout.screen_sharing_example)

        NuSDK.init("abcd_1234", "tesa")

        bind()

        start.setOnClickListener {
            val intent = Intent(this, ScreenSharingActivity::class.java)
                .putExtra("Destination", input.text.toString())
            startActivity(intent)
        }

        join.setOnClickListener {
            val intent = Intent(this, ScreenSharingActivity::class.java)
                .putExtra("Originator", input.text.toString())
            startActivity(intent)
        }
    }

    private var permissions = arrayOf(
        Manifest.permission.READ_PHONE_STATE,
        Manifest.permission.RECORD_AUDIO,
        Manifest.permission.WRITE_EXTERNAL_STORAGE,
        Manifest.permission.READ_EXTERNAL_STORAGE,
        Manifest.permission.MODIFY_AUDIO_SETTINGS
    )

    private fun isAllowPermission(): Boolean {
        for (permission in permissions) {
            if (ContextCompat.checkSelfPermission(
                    this,
                    permission
                ) != PackageManager.PERMISSION_GRANTED
            ) {
                ActivityCompat.requestPermissions(this, permissions, 1)
                return false
            }
        }
        return true
    }

    override fun onRequestPermissionsResult(
        requestCode: Int,
        permissions: Array<String?>,
        grantResults: IntArray
    ) {
        super.onRequestPermissionsResult(requestCode, permissions, grantResults)
        if (!isAllowPermission()) {
            finish()
            return
        }
        bind()
    }

    private fun bind() {
        if (ActivityCompat.checkSelfPermission(
                this,
                Manifest.permission.READ_PHONE_STATE
            ) != PackageManager.PERMISSION_GRANTED || ActivityCompat.checkSelfPermission(
                this,
                Manifest.permission.WRITE_EXTERNAL_STORAGE
            ) != PackageManager.PERMISSION_GRANTED
        ) {
            ActivityCompat.requestPermissions(this, permissions, 1)
            return
        }
        NuSDK.bind(this, object : NuSDK.BindListener {
            override fun failed(var1: String?) {

            }

            override fun success() {

            }
        })
    }
}

            </pre>
            </div>
            <span id="wb">&nbsp;</span>

            <div class="mt-4" style="font-size: 20px;">
              <b>White Board</b>
            </div>

            <span id="wb-desc">&nbsp;</span>

            <div class="mt-4" style="font-size: 18px;">
              <b>Description</b>
            </div>
            <div style="font-size: 15px;">
              Simple Code to build white board feature.
            </div>


            <span id="wb-kotlin">&nbsp;</span>

            <div class="mt-4" style="font-size: 18px;">
              <b>Code</b>
            </div>
            <div style="font-size: 15px;">
              <pre class="prettyprint linenums:1 mt-2 mb-4">
package io.newuniverse.luna

import android.Manifest
import android.content.Intent
import android.content.pm.PackageManager
import android.os.Bundle
import androidx.appcompat.app.AppCompatActivity
import androidx.core.app.ActivityCompat
import androidx.core.content.ContextCompat
import io.newuniverse.nusdk.core.NuSDK
import io.newuniverse.nusdk.whiteboard.WhiteboardActivity
import kotlinx.android.synthetic.main.audio_call_example.start
import kotlinx.android.synthetic.main.live_streaming_example.*

class WhiteboardExample : AppCompatActivity() {

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)

        setContentView(R.layout.white_board_example)

        NuSDK.init("abcd_1234", "yayandw")

        bind()

        start.setOnClickListener {
            val intent = Intent(this, WhiteboardActivity::class.java)
                .putExtra("Destination", "tesa")
            startActivity(intent)
        }

        join.setOnClickListener {
            val intent = Intent(this, WhiteboardActivity::class.java)
                .putExtra("Join", "tesa")
            startActivity(intent)
        }

    }

    private var permissions = arrayOf(
        Manifest.permission.READ_PHONE_STATE,
        Manifest.permission.WRITE_EXTERNAL_STORAGE,
        Manifest.permission.READ_EXTERNAL_STORAGE,
        Manifest.permission.MODIFY_AUDIO_SETTINGS
    )

    private fun isAllowPermission(): Boolean {
        for (permission in permissions) {
            if (ContextCompat.checkSelfPermission(
                    this,
                    permission
                ) != PackageManager.PERMISSION_GRANTED
            ) {
                ActivityCompat.requestPermissions(this, permissions, 1)
                return false
            }
        }
        return true
    }

    override fun onRequestPermissionsResult(
        requestCode: Int,
        permissions: Array<String>,
        grantResults: IntArray
    ) {
        super.onRequestPermissionsResult(requestCode, permissions, grantResults)
        if (!isAllowPermission()) {
            finish()
            return
        }
        bind()
    }

    private fun bind() {
        if (ActivityCompat.checkSelfPermission(
                this,
                Manifest.permission.READ_PHONE_STATE
            ) != PackageManager.PERMISSION_GRANTED || ActivityCompat.checkSelfPermission(
                this,
                Manifest.permission.WRITE_EXTERNAL_STORAGE
            ) != PackageManager.PERMISSION_GRANTED
        ) {
            ActivityCompat.requestPermissions(this, permissions, 1)
            return
        }
        NuSDK.bind(this, object : NuSDK.BindListener {
            override fun success() {

            }

            override fun failed(sMessage: String) {

            }
        })
    }
}
            </pre>
            </div>

            <span id="um">&nbsp;</span>

            <div class="mt-4" style="font-size: 20px;">
              <b>Unified Messaging</b>
            </div>

            <span id="um-desc">&nbsp;</span>

            <div class="mt-4" style="font-size: 18px;">
              <b>Description</b>
            </div>
            <div style="font-size: 15px;">
              Simple Code to build unified messaging feature.
            </div>

            <span id="um-kotlin">&nbsp;</span>

            <div class="mt-4" style="font-size: 18px;">
              <b>Code</b>
            </div>
            <div style="font-size: 15px;">
              <pre class="prettyprint linenums:1 mt-2 mb-4">
package io.newuniverse.luna

import android.Manifest
import android.content.Intent
import android.content.pm.PackageManager
import android.os.Bundle
import androidx.appcompat.app.AppCompatActivity
import androidx.core.app.ActivityCompat
import androidx.core.content.ContextCompat
import io.newuniverse.nusdk.core.NuSDK
import io.newuniverse.nusdk.um.EditorActivity
import kotlinx.android.synthetic.main.audio_call_example.*

class UnifiedMessagingExample : AppCompatActivity() {

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)

        setContentView(R.layout.unified_messaging_example)

        NuSDK.init("abcd_1234", "yayandw")

        bind()

        start.setOnClickListener {
            val intent = Intent(this, EditorActivity::class.java)
                .putExtra("Destination", "tesa")
            startActivity(intent)
        }
    }

    private var permissions = arrayOf(
        Manifest.permission.READ_PHONE_STATE,
        Manifest.permission.WRITE_EXTERNAL_STORAGE,
        Manifest.permission.READ_EXTERNAL_STORAGE,
        Manifest.permission.MODIFY_AUDIO_SETTINGS
    )

    private fun isAllowPermission(): Boolean {
        for (permission in permissions) {
            if (ContextCompat.checkSelfPermission(
                    this,
                    permission
                ) != PackageManager.PERMISSION_GRANTED
            ) {
                ActivityCompat.requestPermissions(this, permissions, 1)
                return false
            }
        }
        return true
    }

    override fun onRequestPermissionsResult(
        requestCode: Int,
        permissions: Array<String?>,
        grantResults: IntArray
    ) {
        super.onRequestPermissionsResult(requestCode, permissions, grantResults)
        if (!isAllowPermission()) {
            finish()
            return
        }
        bind()
    }

    private fun bind() {
        if (ActivityCompat.checkSelfPermission(
                this,
                Manifest.permission.READ_PHONE_STATE
            ) != PackageManager.PERMISSION_GRANTED || ActivityCompat.checkSelfPermission(
                this,
                Manifest.permission.WRITE_EXTERNAL_STORAGE
            ) != PackageManager.PERMISSION_GRANTED
        ) {
            ActivityCompat.requestPermissions(this, permissions, 1)
            return
        }
        NuSDK.bind(this, object : NuSDK.BindListener {
            override fun failed(var1: String?) {

            }

            override fun success() {

            }
        })
    }

}

            </pre>
            </div>

            <span id="cb">&nbsp;</span>

            <div class="mt-4" style="font-size: 20px;">
              <b>Chat Bot</b>
            </div>

            <span id="cb-desc">&nbsp;</span>

            <div class="mt-4" style="font-size: 18px;">
              <b>Description</b>
            </div>
            <div style="font-size: 15px;">
              Simple Code to build chat bot feature.
            </div>

            <span id="cb-kotlin">&nbsp;</span>

            <div class="mt-4" style="font-size: 18px;">
              <b>Code</b>
            </div>
            <div style="font-size: 15px;">
              <pre class="prettyprint linenums:1 mt-2 mb-4">
//Soon
            </pre>
            </div>

          </div> <!-- End Column -->
          <div class="col-lg-2">

          </div>
        </div> <!-- End Row -->

      </div> <!-- End Container -->
    </div> <!-- End Content -->

    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
   immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>

  </div> <!-- End Wrapper -->

  <script type="text/javascript">
    $('body').scrollspy({
      target: '#menu-side'
    });

    $(window).on('activate.bs.scrollspy', function () {

      var item = $('#menu-side').find(".active").last();
      item.animatescroll({
        element: '#menu-side',
        padding: 500
      });

    });
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