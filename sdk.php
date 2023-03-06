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
/*li.L0,li.L1,li.L2,li.L3,li.L5,li.L6,li.L7,li.L8 { list-style-type: none; }*/
li.L0,li.L1,li.L2,li.L3,li.L5,li.L6,li.L7,li.L8 { list-style-type: decimal; }
/* Alternate shading for lines */
/*li.L1,li.L3,li.L5,li.L7,li.L9 { background: #eee; }*/

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

.nav-pills .nav-link.active, .nav-pills .show>.nav-link, .dropdown-menu {
  background: transparent;
}

@media screen and (max-width: 768px){

  .side-men{
    background-color: #ecf0f5 !important;
    border-right: 0;
    margin-top: 100px;
  }
}

@media screen and (min-width: 769px){

  .side-men{
    background-color: #ecf0f5 !important;
    border-right: 0;
    margin-top: 47px;
  }
}

</style>

<body class="hold-transition skin-black-light fixed sidebar-mini" onload="PR.prettyPrint()" data-spy="scroll" data-target="#menu-side" style="font-family: 'Segoe UI Regular';">
 <div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a class="logo border-0 text-lg-left text-center d-flex justify-content-center justify-content-lg-start pl-4" href="newdashboard.php" style="height: 54px; font-size: 40px; color: #3862D3; background-color: #fff !important;">

      <img class="logo-mini align-self-center" src="./newAssets/new-u-logo-alt.svg" style="height: 30px; width: auto;">

      <img class="logo-lg align-self-center" src="./newAssets/new-u-logo-alt.svg" style="height: 40px; width: auto;">

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
  <aside class="main-sidebar p-0 pb-5 side-men" style="left: 0; bottom: 0; padding-left: 49px !important;">
    <!-- sidebar: style can be found in sidebar.less -->
    <section id="menu-side" class="sidebar" style="overflow-y: auto; position: relative; height: 100%;">
      <!-- Sidebar user panel -->
      <!-- sidebar menu: : style can be found in sidebar.less -->

      <nav id="navbar-example3" class="navbar navbar-light flex-column px-0" style="background-color: #ecf0f5;">
        <nav class="nav nav-pills flex-column text-left w-100">
          <a class="nav-link active" href="#intro">Introduction</a>
          <a class="nav-link active" href="#flutter">Flutter</a>
          <a class="nav-link active" href="#usage">Usage</a>
          <ul class="navbar-nav" style="cursor: pointer;">
            <li class="nav-item dropdown">
              <a class="nav-link active pl-4 dropdown-toggle" data-toggle="dropdown" role="button">Import Package</a>
              <div class="dropdown-menu border-0 px-2">
                <a class="nav-link active pl-4 dropdown-item" href="#depend">Depend</a>
                <a class="nav-link active pl-4 dropdown-item" href="#install">Install</a>
                <a class="nav-link active pl-4 dropdown-item" href="#import">Import</a>
              </div>
            </li>
          </ul>
          <a class="nav-link active" href="#permit">Request Permission</a>
          <a class="nav-link active" href="#example">Example Code</a>
          <ul class="navbar-nav" style="cursor: pointer;">
          <li class="nav-item dropdown">
              <a class="nav-link active pl-4 dropdown-toggle" data-toggle="dropdown" role="button">Live Streaming</a>
              <div class="dropdown-menu border-0 px-2">
                <a class="nav-link active pl-4 dropdown-item" href="#ls">Description</a>
                <a class="nav-link active pl-4 dropdown-item" href="#ls-flutter">Code</a>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link active pl-4 dropdown-toggle" data-toggle="dropdown" role="button">Audio Call</a>
              <div class="dropdown-menu border-0 px-2">
                <a class="nav-link active pl-4 dropdown-item" href="#ac">Description</a>
                <a class="nav-link active pl-4 dropdown-item" href="#ac-flutter">Code</a>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link active pl-4 dropdown-toggle" data-toggle="dropdown" role="button">Video Call</a>
              <div class="dropdown-menu border-0 px-2">
                <a class="nav-link active pl-4 dropdown-item" href="#vc">Description</a>
                <a class="nav-link active pl-4 dropdown-item" href="#vc-flutter">Code</a>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link active pl-4 dropdown-toggle" data-toggle="dropdown" role="button">Screen Sharing</a>
              <div class="dropdown-menu border-0 px-2">
                <a class="nav-link active pl-4 dropdown-item" href="#ss">Description</a>
                <a class="nav-link active pl-4 dropdown-item" href="#ss-flutter">Code</a>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link active pl-4 dropdown-toggle" data-toggle="dropdown" role="button">Whiteboard</a>
              <div class="dropdown-menu border-0 px-2">
                <a class="nav-link active pl-4 dropdown-item" href="#wb">Description</a>
                <a class="nav-link active pl-4 dropdown-item" href="#wb-flutter">Code</a>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link active pl-4 dropdown-toggle" data-toggle="dropdown" role="button">Unified Messaging</a>
              <div class="dropdown-menu border-0 px-2">
                <a class="nav-link active pl-4 dropdown-item" href="#um">Description</a>
                <a class="nav-link active pl-4 dropdown-item" href="#um-flutter">Code</a>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link active pl-4 dropdown-toggle" data-toggle="dropdown" role="button">Chatbot</a>
              <div class="dropdown-menu border-0 px-2">
                <a class="nav-link active pl-4 dropdown-item" href="#cb">Description</a>
                <a class="nav-link active pl-4 dropdown-item" href="#cb-flutter">Code</a>
              </div>
            </li>
          </ul>
          <a class="nav-link active" href="sdk2.php" target="_blank">Android Native</a>
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
            This document provides detailed documentation for the New Universe Service SDK for Android and iOS-based using the Flutter Platform. This document allows developer to implement communication feature quickly and easily. Here are some features provided in this SDK:
          </div>
          <div class="mt-1 mb-2" style="font-size: 16px;">
            <ol>
              <li>Live Streaming</li>
              <li>Audio Call</li>
              <li>Video Call</li>
              <li>Screen Sharing</li>
              <li>White Board</li>
              <li>Unified Messaging</li>
              <li id="flutter">Chat Bot (Soon)</li>
            </ol>
          </div>
        </div> <!-- End Column -->
        <div class="col-lg-2">
          
        </div>
      </div> <!-- End Row -->

      <div class="row">
        <div class="col-lg-10">
          <span style="font-size: 25px;"><b>Flutter</b></span><br>
          <div class="mt-2" style="font-size: 16px;">
            Flutter is a reactive cross-platform mobile development which can be implemented on Android or iOS, Flutter uses dart language in implementation.<br>
            Dart and Flutter have been created by Google since 2017. Why should use flutter?
          </div>
          <div class="mt-4" style="font-size: 18px;">
            <b>Fast Development</b>
          </div>
          <div style="font-size: 16px;">
            Use a rich set of fully-customizable widgets to build native interfaces in minutes.
          </div>
          <div class="mt-4" style="font-size: 18px;">
            <b>Expressive and Flexible UI</b>
          </div>
          <div style="font-size: 16px;">
            Layered architecture allows for full customization, which results in incredibly fast rendering and expressive and flexible designs.
          </div>
          <div class="mt-4" style="font-size: 18px;">
            <b>Native Performance</b>
          </div>
          <div style="font-size: 16px;" id="usage">
            Thus Flutter gives you full native performance on both iOS and Android.<br>
            <a href="https://flutter.dev/">Visit this link for more information</a>
          </div>
        </div> <!-- End Column -->
        <div class="col-lg-2">
          
        </div>
      </div> <!-- End Row -->

      <div class="row mt-4">
        <div class="col-lg-10">
          <span style="font-size: 25px;"><b>Usage</b></span><br>
          <div class="mt-2" style="font-size: 20px;">
            <b>Import Package</b>
          </div>

          <span id="depend">&nbsp;</span>

          <div class="mt-4" style="font-size: 18px;">
            <b>Depend</b>
          </div>
          <div class="mt-2" style="font-size: 16px;">
            Add this to your package's pubspec.yaml file:
          </div>
          <div style="font-size: 15px;">
            <pre class="prettyprint lang-java linenums:1 mt-2 mb-4">
dependencies:
  permission_handler: "2.1.2" //request permission

  dependencies: 
  nus:
    path: ../

            </pre>
          </div>

          <span id="install">&nbsp;</span>

          <div class="mt-4" style="font-size: 18px;">
            <b>Install</b>
          </div>
          <div class="mt-2" style="font-size: 16px;">
            You can install packages from the command line with Flutter:
          </div>
          <div style="font-size: 15px;">
            <pre class="prettyprint lang-kotlin linenums:1 mt-2 mb-4">
$ flutter pub get
            </pre>
          </div>

          <span id="import">&nbsp;</span>

          <div class="mt-4" style="font-size: 18px;">
            <b>Import</b>
          </div>
          <div class="mt-2" style="font-size: 16px;">
            Now in your Dart code, you can use:
          </div>
          <div style="font-size: 15px;">
            <pre class="prettyprint linenums:1 mt-2 mb-4">
import 'package:nus/newuniverse.dart';
            </pre>
          </div>
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

_permissionRequest() async {
  Map&lt;PermissionGroup, PermissionStatus&gt; permissions =
      await PermissionHandler().requestPermissions([
    PermissionGroup.phone, 
    PermissionGroup.storage,
    PermissionGroup.camera,
    PermissionGroup.location,
    PermissionGroup.microphone,
  ]);
  var isGranted = false;
  permissions.forEach((k, v) {
    if (v != PermissionStatus.granted) {
      return;
    }
    isGranted = true;
  });
  if (isGranted) {
    _initialize();
  }
}
   
     ...
          </pre>
        </div> <!-- End Col -->
        <div class="col-lg-2">
          
        </div>
      </div> <!-- End Row -->

      <span id="example">&nbsp;</span>

      <div class="row mt-4">
        <div class="col-lg-10">
          <span style="font-size: 25px;"><b>Example Code</b></span><br>
          <div class="mt-2" style="font-size: 16px;">
           This is an example code of implementing SDK, consider the highlighted line:
          </div>
          

          <span id="ls">&nbsp;</span>

          <div class="mt-4" style="font-size: 20px;">
            <b>Live Streaming</b>
          </div>
          <div style="font-size: 15px;">
            Simple Code to build live streaming feature.
          </div>

          <span id="ls-flutter">&nbsp;</span>

          <div class="mt-4" style="font-size: 18px;">
            <b>Code</b>
          </div>
          <div style="font-size: 15px;">

            <pre class="prettyprint linenums:1 mt-2 mb-4">
import 'package:flutter/material.dart';
import 'package:nus/newuniverse.dart';

class Home extends StatefulWidget {
  @override
  State<StatefulWidget> createState() {
    return new HomeState();
  }
}

class HomeState extends State<Home> {
  final _channelController = TextEditingController();

  bool _validateError = false;

  @override
  void initState() {
    super.initState();
    _initialize();
  }

  Future<void> _initialize() async {
    _initNusa();
    _addNusaEvent();
  }

  Future<void> _initNusa() async {
    await NUs.init('abcd_1234', 'tesa');
    NUs.bind();
  }

  Future<void> _addNusaEvent() async {
    NUs.onAudioCallReceiver = (String originator, int state, String message) {
      Navigator.push(
          context,
          MaterialPageRoute(
              builder: (context) =>
                  SmartAudioCall(destination: originator, isInitiator: false)));
    };

    NUs.onVideoCallReceiver = (String originator, int state, String message) {
      Navigator.push(
          context, MaterialPageRoute(builder: (context) => VideoCall()));
    };

    NUs.onMessageCallback = (int messageId, int contentType, int status) {
      print(
          'onMessageCallback -> messageId: $messageId, contentType: $contentType, status: $status');
      
    };

    NUs.onMessageReceiver = (int messageId) {
      print('onMessageReceiver -> messageId: $messageId');
    };

    NUs.onForumCallback = (String name, String message) {
      print('onForumCallback: $name/$message');
    };
  }

  @override
  void dispose() {
    _channelController.dispose();
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
        appBar: AppBar(
          title: Text('NUs Example'),
        ),
        floatingActionButton: new Builder(builder: (BuildContext context) {
          return new FloatingActionButton(
            onPressed: () {
            },
            child: new Icon(Icons.info),
          );
        }),
        body: Center(
          child: Container(
              padding: EdgeInsets.symmetric(horizontal: 8),
              height: 400,
              child: Column(
                children: <Widget>[
                  Row(children: <Widget>[]),
                  Row(children: <Widget>[
                    Expanded(
                        child: TextField(
                      controller: _channelController,
                      decoration: InputDecoration(
                          errorText: _validateError
                              ? 'Destination is mandatory'
                              : null,
                          border: UnderlineInputBorder(
                              borderSide: BorderSide(width: 1)),
                          hintText: 'Destination'),
                    ))
                  ]),
                  Padding(
                      padding: EdgeInsets.symmetric(vertical: 8),
                      child: Row(
                        children: <Widget>[
                          Expanded(
                            child: RaisedButton(
                              onPressed: () => _onInitiate(true),
                              child: Text('Initiate'),
                              color: Colors.blueAccent,
                              textColor: Colors.white,
                            ),
                          )
                        ],
                      )),
                  Padding(
                      padding: EdgeInsets.symmetric(vertical: 8),
                      child: Row(
                        children: <Widget>[
                          Expanded(
                            child: RaisedButton(
                              onPressed: () => _onInitiate(false),
                              child: Text('Join'),
                              color: Colors.blueAccent,
                              textColor: Colors.white,
                            ),
                          )
                        ],
                      ))
                ],
              )),
        ));
  }

  _onInitiate(bool isInitiator) async {
    setState(() {
      _channelController.text.isEmpty
          ? _validateError = true
          : _validateError = false;
    });
    if (_channelController.text.isNotEmpty) {
      <b style="background-color: #002451;">Navigator.push(
          context,
          MaterialPageRoute(
              builder: (context) => LiveStreaming(
                  title: 'TEST',
                  destination: isInitiator ? _channelController.text : null)));</b>
    }
  }

  void _showToast(BuildContext context, String status) {
    final scaffold = Scaffold.of(context);
    scaffold.showSnackBar(
      SnackBar(
        content: Text('User Status : ' + status),
        action: SnackBarAction(
            label: 'Close', onPressed: scaffold.hideCurrentSnackBar),
      ),
    );
  }
}

            </pre>
          </div>



          <span id="ac">&nbsp;</span>

          <div class="mt-2" style="font-size: 20px;">
            <b>Audio Call</b>
          </div>
          <div style="font-size: 15px;">
            Simple Code to build audio call feature.
          </div>

          <span id="ac-flutter">&nbsp;</span>

          <div class="mt-4" style="font-size: 18px;">
            <b>Code</b>
          </div>
          <div style="font-size: 15px;">
           
            <pre class="prettyprint lang-java linenums:1 mt-2 mb-4">
import 'package:flutter/material.dart';
import 'package:nus/newuniverse.dart';

class Home extends StatefulWidget {
  @override
  State<StatefulWidget> createState() {
    return new HomeState();
  }
}

class HomeState extends State<Home> {
  final _channelController = TextEditingController();

  bool _validateError = false;

  @override
  void initState() {
    super.initState();
    _initialize();
  }

  Future<void> _initialize() async {
    _initNusa();
    _addNusaEvent();
  }

  Future<void> _initNusa() async {
    await NUs.init('abcd_1234', 'tesa');
    NUs.bind();
  }

  Future<void> _addNusaEvent() async {
    NUs.onAudioCallReceiver = (String originator, int state, String message) {
      Navigator.push(
          context,
          MaterialPageRoute(
              builder: (context) =>
                  SmartAudioCall(destination: originator, isInitiator: false)));
    };

    NUs.onVideoCallReceiver = (String originator, int state, String message) {
      Navigator.push(
          context, MaterialPageRoute(builder: (context) => VideoCall()));
    };

    NUs.onMessageCallback = (int messageId, int contentType, int status) {
      print(
          'onMessageCallback -> messageId: $messageId, contentType: $contentType, status: $status');
    };

    NUs.onMessageReceiver = (int messageId) {
      print('onMessageReceiver -> messageId: $messageId');
    };

    NUs.onForumCallback = (String name, String message) {
      print('onForumCallback: $name/$message');
    };
  }

  @override
  void dispose() {
    _channelController.dispose();
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
        appBar: AppBar(
          title: Text('NUs Example'),
        ),
        floatingActionButton: new Builder(builder: (BuildContext context) {
          return new FloatingActionButton(
            onPressed: () {
            },
            child: new Icon(Icons.info),
          );
        }),
        body: Center(
          child: Container(
              padding: EdgeInsets.symmetric(horizontal: 8),
              height: 400,
              child: Column(
                children: <Widget>[
                  Row(children: <Widget>[]),
                  Row(children: <Widget>[
                    Expanded(
                        child: TextField(
                      controller: _channelController,
                      decoration: InputDecoration(
                          errorText: _validateError
                              ? 'Destination is mandatory'
                              : null,
                          border: UnderlineInputBorder(
                              borderSide: BorderSide(width: 1)),
                          hintText: 'Destination'),
                    ))
                  ]),
                  Padding(
                      padding: EdgeInsets.symmetric(vertical: 8),
                      child: Row(
                        children: <Widget>[
                          Expanded(
                            child: RaisedButton(
                              onPressed: () => _onInitiate(true),
                              child: Text('Initiate'),
                              color: Colors.blueAccent,
                              textColor: Colors.white,
                            ),
                          )
                        ],
                      )),
                  Padding(
                      padding: EdgeInsets.symmetric(vertical: 8),
                      child: Row(
                        children: <Widget>[
                          Expanded(
                            child: RaisedButton(
                              onPressed: () => _onInitiate(false),
                              child: Text('Join'),
                              color: Colors.blueAccent,
                              textColor: Colors.white,
                            ),
                          )
                        ],
                      ))
                ],
              )),
        ));
  }

  _onInitiate(bool isInitiator) async {
    setState(() {
      _channelController.text.isEmpty
          ? _validateError = true
          : _validateError = false;
    });
    if (_channelController.text.isNotEmpty) {
      <b style="background-color: #002451;">Navigator.push(
          context,
          MaterialPageRoute(
              builder: (context) =>
                  AudioCall(destination: _channelController.text)));</b>
    }
  }

  void _showToast(BuildContext context, String status) {
    final scaffold = Scaffold.of(context);
    scaffold.showSnackBar(
      SnackBar(
        content: Text('User Status : ' + status),
        action: SnackBarAction(
            label: 'Close', onPressed: scaffold.hideCurrentSnackBar),
      ),
    );
  }
}

            </pre>
          </div>

          <span id="vc">&nbsp;</span>

          <div class="mt-4" style="font-size: 20px;">
            <b>Video Call</b>
          </div>
          <div style="font-size: 15px;">
            Simple Code to build video call feature.
          </div>

          <span id="vc-flutter">&nbsp;</span>

          <div class="mt-4" style="font-size: 18px;">
            <b>Code</b>
          </div>
          <div style="font-size: 15px;">
            <!-- <pre class="prettyprint linenums:1 mt-2 mb-4">
Navigator.push(
    context,
    MaterialPageRoute(
        builder: (context) => VideoCall(
          destination: _channelController.text,
        )
    )
);
            </pre> -->
            <pre class="prettyprint linenums:1 mt-2 mb-4">
import 'package:flutter/material.dart';
import 'package:nus/newuniverse.dart';

class Home extends StatefulWidget {
  @override
  State<StatefulWidget> createState() {
    return new HomeState();
  }
}

class HomeState extends State<Home> {
  final _channelController = TextEditingController();

  bool _validateError = false;

  @override
  void initState() {
    super.initState();
    _initialize();
  }

  Future<void> _initialize() async {
    _initNusa();
    _addNusaEvent();
  }

  Future<void> _initNusa() async {
    await NUs.init('abcd_1234', 'tesa');
    NUs.bind();
  }

  Future<void> _addNusaEvent() async {
    NUs.onAudioCallReceiver = (String originator, int state, String message) {
      Navigator.push(
          context,
          MaterialPageRoute(
              builder: (context) =>
                  SmartAudioCall(destination: originator, isInitiator: false)));
    };

    NUs.onVideoCallReceiver = (String originator, int state, String message) {
      Navigator.push(
          context, MaterialPageRoute(builder: (context) => VideoCall()));
    };

    NUs.onMessageCallback = (int messageId, int contentType, int status) {
      print(
          'onMessageCallback -> messageId: $messageId, contentType: $contentType, status: $status');
    };

    NUs.onMessageReceiver = (int messageId) {
      print('onMessageReceiver -> messageId: $messageId');
    };

    NUs.onForumCallback = (String name, String message) {
      print('onForumCallback: $name/$message');
    };
  }

  @override
  void dispose() {
    _channelController.dispose();
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
        appBar: AppBar(
          title: Text('NUs Example'),
        ),
        floatingActionButton: new Builder(builder: (BuildContext context) {
          return new FloatingActionButton(
            onPressed: () {
            },
            child: new Icon(Icons.info),
          );
        }),
        body: Center(
          child: Container(
              padding: EdgeInsets.symmetric(horizontal: 8),
              height: 400,
              child: Column(
                children: <Widget>[
                  Row(children: <Widget>[]),
                  Row(children: <Widget>[
                    Expanded(
                        child: TextField(
                      controller: _channelController,
                      decoration: InputDecoration(
                          errorText: _validateError
                              ? 'Destination is mandatory'
                              : null,
                          border: UnderlineInputBorder(
                              borderSide: BorderSide(width: 1)),
                          hintText: 'Destination'),
                    ))
                  ]),
                  Padding(
                      padding: EdgeInsets.symmetric(vertical: 8),
                      child: Row(
                        children: <Widget>[
                          Expanded(
                            child: RaisedButton(
                              onPressed: () => _onInitiate(true),
                              child: Text('Initiate'),
                              color: Colors.blueAccent,
                              textColor: Colors.white,
                            ),
                          )
                        ],
                      )),
                  Padding(
                      padding: EdgeInsets.symmetric(vertical: 8),
                      child: Row(
                        children: <Widget>[
                          Expanded(
                            child: RaisedButton(
                              onPressed: () => _onInitiate(false),
                              child: Text('Join'),
                              color: Colors.blueAccent,
                              textColor: Colors.white,
                            ),
                          )
                        ],
                      ))
                ],
              )),
        ));
  }

  _onInitiate(bool isInitiator) async {
    setState(() {
      _channelController.text.isEmpty
          ? _validateError = true
          : _validateError = false;
    });
    if (_channelController.text.isNotEmpty) {
      <b style="background-color: #002451;">Navigator.push(
          context,
          MaterialPageRoute(
              builder: (context) =>
                  VideoCall(destination: _channelController.text)));</b>
    }
  }

  void _showToast(BuildContext context, String status) {
    final scaffold = Scaffold.of(context);
    scaffold.showSnackBar(
      SnackBar(
        content: Text('User Status : ' + status),
        action: SnackBarAction(
            label: 'Close', onPressed: scaffold.hideCurrentSnackBar),
      ),
    );
  }
}


            </pre>
          </div>
          <span id="ss">&nbsp;</span>

          <div class="mt-4" style="font-size: 20px;">
            <b>Screen Sharing</b>
          </div>
          <div style="font-size: 15px;">
            Simple Code to build screen sharing feature.
          </div>

          <span id="ss-flutter">&nbsp;</span>

          <div class="mt-4" style="font-size: 18px;">
            <b>Code</b>
          </div>
          <div style="font-size: 15px;">
            <pre class="prettyprint linenums:1 mt-2 mb-4">
import 'package:flutter/material.dart';
import 'package:nus/newuniverse.dart';

class Home extends StatefulWidget {
  @override
  State<StatefulWidget> createState() {
    return new HomeState();
  }
}

class HomeState extends State<Home> {
  final _channelController = TextEditingController();

  bool _validateError = false;

  @override
  void initState() {
    super.initState();
    _initialize();
  }

  Future<void> _initialize() async {
    _initNusa();
    _addNusaEvent();
  }

  Future<void> _initNusa() async {
    await NUs.init('abcd_1234', 'tesa');
    NUs.bind();
  }

  Future<void> _addNusaEvent() async {
    NUs.onAudioCallReceiver = (String originator, int state, String message) {
      Navigator.push(
          context,
          MaterialPageRoute(
              builder: (context) =>
                  SmartAudioCall(destination: originator, isInitiator: false)));
    };

    NUs.onVideoCallReceiver = (String originator, int state, String message) {
      Navigator.push(
          context, MaterialPageRoute(builder: (context) => VideoCall()));
    };

    NUs.onMessageCallback = (int messageId, int contentType, int status) {
      print(
          'onMessageCallback -> messageId: $messageId, contentType: $contentType, status: $status'); 
    };

    NUs.onMessageReceiver = (int messageId) {
      print('onMessageReceiver -> messageId: $messageId');
    };

    NUs.onForumCallback = (String name, String message) {
      print('onForumCallback: $name/$message');
    };
  }

  @override
  void dispose() {
    _channelController.dispose();
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
        appBar: AppBar(
          title: Text('NUs Example'),
        ),
        floatingActionButton: new Builder(builder: (BuildContext context) {
          return new FloatingActionButton(
            onPressed: () {
            },
            child: new Icon(Icons.info),
          );
        }),
        body: Center(
          child: Container(
              padding: EdgeInsets.symmetric(horizontal: 8),
              height: 400,
              child: Column(
                children: <Widget>[
                  Row(children: <Widget>[]),
                  Row(children: <Widget>[
                    Expanded(
                        child: TextField(
                      controller: _channelController,
                      decoration: InputDecoration(
                          errorText: _validateError
                              ? 'Destination is mandatory'
                              : null,
                          border: UnderlineInputBorder(
                              borderSide: BorderSide(width: 1)),
                          hintText: 'Destination'),
                    ))
                  ]),
                  Padding(
                      padding: EdgeInsets.symmetric(vertical: 8),
                      child: Row(
                        children: <Widget>[
                          Expanded(
                            child: RaisedButton(
                              onPressed: () => _onInitiate(true),
                              child: Text('Initiate'),
                              color: Colors.blueAccent,
                              textColor: Colors.white,
                            ),
                          )
                        ],
                      )),
                  Padding(
                      padding: EdgeInsets.symmetric(vertical: 8),
                      child: Row(
                        children: <Widget>[
                          Expanded(
                            child: RaisedButton(
                              onPressed: () => _onInitiate(false),
                              child: Text('Join'),
                              color: Colors.blueAccent,
                              textColor: Colors.white,
                            ),
                          )
                        ],
                      ))
                ],
              )),
        ));
  }

  _onInitiate(bool isInitiator) async {
    setState(() {
      _channelController.text.isEmpty
          ? _validateError = true
          : _validateError = false;
    });
    if (_channelController.text.isNotEmpty) {
      <b style="background-color: #002451;">Navigator.push(
          context,
          MaterialPageRoute(
              builder: (context) => ScreenSharing(
                  destination: _channelController.text,
                  isInitiator: isInitiator)));</b>
    }
  }

  void _showToast(BuildContext context, String status) {
    final scaffold = Scaffold.of(context);
    scaffold.showSnackBar(
      SnackBar(
        content: Text('User Status : ' + status),
        action: SnackBarAction(
            label: 'Close', onPressed: scaffold.hideCurrentSnackBar),
      ),
    );
  }
}

            </pre>
          </div>

          <span id="wb">&nbsp;</span>

          <div class="mt-4" style="font-size: 20px;">
            <b>White Board</b>
          </div>
          <div style="font-size: 15px;">
            Simple Code to build white board feature.
          </div>

          <span id="wb-flutter">&nbsp;</span>

          <div class="mt-4" style="font-size: 18px;">
            <b>Code</b>
          </div>
          <div style="font-size: 15px;">
     
            <pre class="prettyprint linenums:1 mt-2 mb-4">
import 'package:flutter/material.dart';
import 'package:nus/newuniverse.dart';

class Home extends StatefulWidget {
  @override
  State<StatefulWidget> createState() {
    return new HomeState();
  }
}

class HomeState extends State<Home> {
  final _channelController = TextEditingController();

  bool _validateError = false;

  @override
  void initState() {
    super.initState();
    _initialize();
  }

  Future<void> _initialize() async {
    _initNusa();
    _addNusaEvent();
  }

  Future<void> _initNusa() async {
    await NUs.init('abcd_1234', 'tesa');
    NUs.bind();
  }

  Future<void> _addNusaEvent() async {
    NUs.onAudioCallReceiver = (String originator, int state, String message) {
      Navigator.push(
          context,
          MaterialPageRoute(
              builder: (context) =>
                  SmartAudioCall(destination: originator, isInitiator: false)));
    };

    NUs.onVideoCallReceiver = (String originator, int state, String message) {
      Navigator.push(
          context, MaterialPageRoute(builder: (context) => VideoCall()));
    };

    NUs.onMessageCallback = (int messageId, int contentType, int status) {
      print(
          'onMessageCallback -> messageId: $messageId, contentType: $contentType, status: $status'); 
    };

    NUs.onMessageReceiver = (int messageId) {
      print('onMessageReceiver -> messageId: $messageId');
    };

    NUs.onForumCallback = (String name, String message) {
      print('onForumCallback: $name/$message');
    };
  }

  @override
  void dispose() {
    _channelController.dispose();
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
        appBar: AppBar(
          title: Text('NUs Example'),
        ),
        floatingActionButton: new Builder(builder: (BuildContext context) {
          return new FloatingActionButton(
            onPressed: () {
              
            },
            child: new Icon(Icons.info),
          );
        }),
        body: Center(
          child: Container(
              padding: EdgeInsets.symmetric(horizontal: 8),
              height: 400,
              child: Column(
                children: <Widget>[
                  Row(children: <Widget>[]),
                  Row(children: <Widget>[
                    Expanded(
                        child: TextField(
                      controller: _channelController,
                      decoration: InputDecoration(
                          errorText: _validateError
                              ? 'Destination is mandatory'
                              : null,
                          border: UnderlineInputBorder(
                              borderSide: BorderSide(width: 1)),
                          hintText: 'Destination'),
                    ))
                  ]),
                  Padding(
                      padding: EdgeInsets.symmetric(vertical: 8),
                      child: Row(
                        children: <Widget>[
                          Expanded(
                            child: RaisedButton(
                              onPressed: () => _onInitiate(true),
                              child: Text('Initiate'),
                              color: Colors.blueAccent,
                              textColor: Colors.white,
                            ),
                          )
                        ],
                      )),
                  Padding(
                      padding: EdgeInsets.symmetric(vertical: 8),
                      child: Row(
                        children: <Widget>[
                          Expanded(
                            child: RaisedButton(
                              onPressed: () => _onInitiate(false),
                              child: Text('Join'),
                              color: Colors.blueAccent,
                              textColor: Colors.white,
                            ),
                          )
                        ],
                      ))
                ],
              )),
        ));
  }

  _onInitiate(bool isInitiator) async {
    setState(() {
      _channelController.text.isEmpty
          ? _validateError = true
          : _validateError = false;
    });
    if (_channelController.text.isNotEmpty) {
      <b style="background-color: #002451;">Navigator.push(
          context,
          MaterialPageRoute(
              builder: (context) => WhiteBoard(
                  destination: _channelController.text,
                  isInitiator: isInitiator)));</b>
    }
  }

  void _showToast(BuildContext context, String status) {
    final scaffold = Scaffold.of(context);
    scaffold.showSnackBar(
      SnackBar(
        content: Text('User Status : ' + status),
        action: SnackBarAction(
            label: 'Close', onPressed: scaffold.hideCurrentSnackBar),
      ),
    );
  }
}

            </pre>
          </div>

          <span id="um">&nbsp;</span>

          <div class="mt-4" style="font-size: 20px;">
            <b>Unified Messaging</b>
          </div>
          <div style="font-size: 15px;">
            Simple Code to build unified messaging feature.
          </div>

          <span id="um-flutter">&nbsp;</span>

          <div class="mt-4" style="font-size: 18px;">
            <b>Code</b>
          </div>
          <div style="font-size: 15px;">
            <pre class="prettyprint linenums:1 mt-2 mb-4">
import 'package:flutter/material.dart';
import 'package:nus/newuniverse.dart';

class Home extends StatefulWidget {
  @override
  State<StatefulWidget> createState() {
    return new HomeState();
  }
}

class HomeState extends State<Home> {
  final _channelController = TextEditingController();

  bool _validateError = false;

  @override
  void initState() {
    super.initState();
    _initialize();
  }

  Future<void> _initialize() async {
    _initNusa();
    _addNusaEvent();
  }

  Future<void> _initNusa() async {
    await NUs.init('abcd_1234', 'tesa');
    NUs.bind();
  }

  Future<void> _addNusaEvent() async {
    NUs.onAudioCallReceiver = (String originator, int state, String message) {
      Navigator.push(
          context,
          MaterialPageRoute(
              builder: (context) =>
                  SmartAudioCall(destination: originator, isInitiator: false)));
    };

    NUs.onVideoCallReceiver = (String originator, int state, String message) {
      Navigator.push(
          context, MaterialPageRoute(builder: (context) => VideoCall()));
    };

    NUs.onMessageCallback = (int messageId, int contentType, int status) {
      print(
          'onMessageCallback -> messageId: $messageId, contentType: $contentType, status: $status');
    };

    NUs.onMessageReceiver = (int messageId) {
      print('onMessageReceiver -> messageId: $messageId');

    };

    NUs.onForumCallback = (String name, String message) {
      print('onForumCallback: $name/$message');
    };
  }

  @override
  void dispose() {
    _channelController.dispose();
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
        appBar: AppBar(
          title: Text('NUs Example'),
        ),
        floatingActionButton: new Builder(builder: (BuildContext context) {
          return new FloatingActionButton(
            onPressed: () {
            },
            child: new Icon(Icons.info),
          );
        }),
        body: Center(
          child: Container(
              padding: EdgeInsets.symmetric(horizontal: 8),
              height: 400,
              child: Column(
                children: <Widget>[
                  Row(children: <Widget>[]),
                  Row(children: <Widget>[
                    Expanded(
                        child: TextField(
                      controller: _channelController,
                      decoration: InputDecoration(
                          errorText: _validateError
                              ? 'Destination is mandatory'
                              : null,
                          border: UnderlineInputBorder(
                              borderSide: BorderSide(width: 1)),
                          hintText: 'Destination'),
                    ))
                  ]),
                  Padding(
                      padding: EdgeInsets.symmetric(vertical: 8),
                      child: Row(
                        children: <Widget>[
                          Expanded(
                            child: RaisedButton(
                              onPressed: () => _onInitiate(true),
                              child: Text('Initiate'),
                              color: Colors.blueAccent,
                              textColor: Colors.white,
                            ),
                          )
                        ],
                      )),
                  Padding(
                      padding: EdgeInsets.symmetric(vertical: 8),
                      child: Row(
                        children: <Widget>[
                          Expanded(
                            child: RaisedButton(
                              onPressed: () => _onInitiate(false),
                              child: Text('Join'),
                              color: Colors.blueAccent,
                              textColor: Colors.white,
                            ),
                          )
                        ],
                      ))
                ],
              )),
        ));
  }
  _onInitiate(bool isInitiator) async {
    setState(() {
      _channelController.text.isEmpty
          ? _validateError = true
          : _validateError = false;
    });
    if (_channelController.text.isNotEmpty) {
      <b style="background-color: #002451;">Navigator.push(
          context,
          MaterialPageRoute(
              builder: (context) =>
                  UnifiedMessaging(destination: _channelController.text)));</b>
    }
  }

  void _showToast(BuildContext context, String status) {
    final scaffold = Scaffold.of(context);
    scaffold.showSnackBar(
      SnackBar(
        content: Text('User Status : ' + status),
        action: SnackBarAction(
            label: 'Close', onPressed: scaffold.hideCurrentSnackBar),
      ),
    );
  }
}

            </pre>
          </div>

          <span id="cb">&nbsp;</span>

          <div class="mt-4" style="font-size: 20px;">
            <b>Chat Bot</b>
          </div>
          <div style="font-size: 15px;">
            Simple Code to build chat bot feature.
          </div>

          <span id="cb-flutter">&nbsp;</span>

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

  $('body').scrollspy({ target: '#menu-side' });

  $(window).on('activate.bs.scrollspy', function () {

      var item = $('#menu-side').find(".active").last();
      item.animatescroll({element: '#menu-side', padding:500});
      
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
