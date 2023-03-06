<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/dashboardv2/dashboard_header.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/url_function.php'); ?>
<?php //include_once($_SERVER['DOCUMENT_ROOT'] . '/db_conn.php'); 
?>

<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// state control
$_SESSION['previous_page'] = $_SESSION['current_page'];
$_SESSION['current_page'] = 14;
require_once($_SERVER['DOCUMENT_ROOT'] . '/state_control.php');

$session_company = $_SESSION['id_company'];

$dbConnPalio = dbConnPalioLite();

$query_one = $dbconn->prepare("SELECT wf.WEB_URL, wf.VERSION_CODE FROM WEBFORM wf WHERE wf.COMPANY_ID = " . $session_company . "
ORDER BY CREATED_AT DESC LIMIT 1");
$query_one->execute();
$query_one_result = $query_one->get_result()->fetch_assoc();
$query_one->close();

$ver_code = 1;

// $ver_code = $query_one_result["VERSION_CODE"];

if ($query_one_result['WEB_URL'] == null) {
    $webURL = "";
} else {
    $webURL = $query_one_result["WEB_URL"];
    $ver_code = intval($query_one_result["VERSION_CODE"]);
}

?>

<!-- Pretify -->
<script type="text/javascript" src="<?php echo base_url(); ?>js/prettify.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>

<style>
    @media screen and (min-width:768px) {
        #search-ticket {
            float: right;
        }
    }

    @media screen and (max-width: 600px) {
        iframe[src*=youtube] {
            display: block;
            margin: 0 auto;
            height: auto;
            max-width: 100%;
            padding-bottom: 10px;
        }
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

    @media (min-width: 1200px) {
        .content-wrapper>.content>.container-fluid {
            padding: 0 5rem 0 3.5rem;
        }

        #generate-apk-form>.row>.col-md-6.left,
        .left {
            padding-right: 3rem;
        }

        #generate-apk-form>.row>.col-md-6.right,
        .right {
            padding-left: 3rem;
        }
    }

    .card {
        padding: 2.25rem;
    }

    .card-body {
        padding: 0;
    }

    .col-form-label {
        font-size: .8rem;
    }

    .genapkcheckbox {
        display: block;
        position: relative;
        padding-left: 35px;
        margin-bottom: 12px;
        cursor: pointer;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    /* Hide the browser's default checkbox */
    .genapkcheckbox input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
        height: 0;
        width: 0;
    }

    /* Create a custom checkbox */
    .checkmark {
        position: absolute;
        top: 0;
        left: 0;
        height: 25px;
        width: 25px;
        border: .5px solid black;
        background-color: white;
    }

    /* On mouse-over, add a grey background color */
    .genapkcheckbox:hover input~.checkmark {
        background-color: #FA9E57;
    }

    /* When the checkbox is checked, add a blue background */
    .genapkcheckbox input:checked~.checkmark {
        background-color: #FA9E57;
    }

    /* Create the checkmark/indicator (hidden when not checked) */
    .checkmark:after {
        content: "";
        position: absolute;
        display: none;
    }

    /* Show the checkmark when checked */
    .genapkcheckbox input:checked~.checkmark:after {
        display: block;
    }

    /* Style the checkmark/indicator */
    .genapkcheckbox .checkmark:after {
        left: 9px;
        top: 5px;
        width: 5px;
        height: 10px;
        border: solid white;
        border-width: 0 3px 3px 0;
        -webkit-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        transform: rotate(45deg);
    }

    .radio-item {
        display: inline-block;
        position: relative;
        padding: 0 6px;
        margin: 10px 0 0;
    }

    .radio-item input[type='radio'] {
        display: none;
    }

    .radio-item label:before {
        content: " ";
        display: inline-block;
        position: relative;
        top: 5px;
        margin: 0 5px 0 0;
        width: 20px;
        height: 20px;
        border-radius: 11px;
        border: 1px solid black;
        background-color: transparent;
    }

    .radio-item input[type=radio]:checked+label:after {
        border-radius: 11px;
        width: 12px;
        height: 12px;
        position: absolute;
        top: 9px;
        left: 10px;
        content: " ";
        display: block;
        background: #FA9E57;
    }

    .contact-center {
        width: 150px;
        margin-left: 125px;
        margin-top: -554px;
        font-family: "Poppins", sans-serif;
        font-size: 10px;
        color: grey;
    }

    .message {
        width: 150px;
        margin-left: 141px;
        margin-top: 13px;
        font-family: "Poppins", sans-serif;
        font-size: 10px;
        color: grey;
    }
    .call {
        width: 150px;
        margin-left: 152px;
        margin-top: 16px;
        font-family: "Poppins", sans-serif;
        font-size: 10px;
        color: grey;
    }
    .new-post {
        width: 150px;
        margin-left: 139px;
        margin-top: 13px;
        font-family: "Poppins", sans-serif;
        font-size: 10px;
        color: grey;
    }
    .live-streaming {
        width: 150px;
        margin-left: 125px;
        margin-top: 13px;
        font-family: "Poppins", sans-serif;
        font-size: 10px;
        color: grey;
    }

    .contact-center-2 {
        width: 50px;
        margin-left: 88px;
        margin-top: -285px;
        font-family: "Poppins", sans-serif;
        font-size: 10px;
        color: grey;
        text-align: center;
    }

    .message-2 {
        width: 150px;
        margin-left: 80px;
        margin-top: -70px;
        font-family: "Poppins", sans-serif;
        font-size: 10px;
        color: grey;
    }

    .call-2 {
        width: 50px;
        margin-left: 176px;
        margin-top: -63px;
        font-family: "Poppins", sans-serif;
        font-size: 10px;
        color: grey;
        text-align: center;
    }

    .new-post-2 {
        width: 150px;
        margin-left: 167px;
        margin-top: -14px;
        font-family: "Poppins", sans-serif;
        font-size: 10px;
        color: grey;
    }
    .live-streaming-2 {
        width: 50px;
        margin-left: 264px;
        margin-top: -7px;
        font-family: "Poppins", sans-serif;
        font-size: 10px;
        color: grey;
        text-align: center;
    }
        
</style>

<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>

<style>
    body {
        font-family: 'Poppins', sans-serif;
    }
</style>

<div class="content-wrapper" id="support-wrapper">
    <div class="content">
        <div class="container-fluid">
            <form method="POST" id="submit_form" enctype="multipart/form-data" class="mb-0">
                <div class="row">
                    <div class="col-md-12 col-xl-12">

                        <div class="card" id="create-ticket">
                            <h4 class="card-name">WebApp Form</h4>
                            <div class="card-body">
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <h6><strong>NEXILIS FLOATING BUTTON</strong></h6>
                                        <p>To embed nexilis Floating Button to your website, please register your website address in the form below first.<br>
                                            <!-- <span>Note: No protocol (<strong>http://</strong> or <strong>https://</strong>) needed</span> -->
                                        </p>
                                        <input type="textarea" id="companyWebsite" class="form-control mb-3" name="company-website" placeholder="Website URL" required value="<?php echo $webURL; ?>">

                                        <p>Once you have registered your website, add the following line to the <strong>&lt;head&gt;</strong> section of any web page you want to embed the floating button to.</p>

                                        <pre class="prettyprint linenums:1 mt-2 mb-4" style="color:lightgray;">
&lt;script src="https://id.palio.io/palio_button/embeddedbutton.js"&gt;&lt;/script&gt;</pre>

                                        <p>Example:</p>

                                        <pre class="prettyprint linenums:1 mt-2 mb-4" style="color:lightgray;">
&lt;!DOCTYPE html&gt;
&lt;html&gt;
    &lt;head&gt;
        &lt;!-- ... your HTML code here --&gt;

        &lt;!-- If you're using JQuery, make sure to add nexilis Floating Button after it's called --&gt;
        &lt;script src="https://id.palio.io/palio_button/embeddedbutton.js"&gt;&lt;/script&gt;
    &lt;/head&gt;
    &lt;body&gt;
        &lt;!-- ... your HTML code here --&gt;
    &lt;/body&gt;
&lt;/html&gt;
                                        </pre>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <label class="genapkcheckbox" for="generate-apk"> I want to generate apk
                                            <input onclick="generateApk();" type="checkbox" id="generate-apk" name="generate-apk" value="1">
                                            <span class="checkmark"></span>
                                        </label><br>
                                    </div>
                                </div>

                                <div id="generate-apk-form">
                                    <div class="row mb-3 blur">
                                        <div class="col-md-12">
                                            <p style="font-size:.85rem;">Please make sure you have uploaded a company logo at the dashboard's <a href="/dashboardv2/index">main page</a>.</p>
                                        </div>
                                    </div>

                                    <div class="row mb-5 blur">
                                        <div class="col-sm-12 col-md-6 left">
                                            <label for="companyName">Your company name :</label>
                                            <input type="textarea" id="companyName" class="form-control" name="company-name" placeholder="Company Name">
                                        </div>
                                        <div class="col-sm-12 col-md-6 right">
                                            <label for="appId">Your app id :</label>
                                            <input type="textarea" id="appId" class="form-control" name="app-id" placeholder="App Id">
                                        </div>
                                    </div>

                                    <h6 class="blur"><strong>APK Settings</strong></h6>

                                    <div class="row mt-3 blur">
                                        <div class="col-md-12">
                                            <p style="font-size:.85rem;">
                                                In this section you can change the content of tabs and change tab icons. Nexilis default tab icons will be used if you don't upload a custom icon.
                                                <br>
                                                <strong>Note:</strong> You can't select the same option for different tabs.
                                            </p>
                                        </div>
                                    </div>

                                    <div class="row">    
                                    <div class="col-12 col-md-6 left-side">
                                        <div class="row">
                                            <!-- <div class="col-sm-1">
                                                <label class="genapkcheckbox d-flex align-items-center" for="tab1-active">
                                                    <input type="checkbox" id="tab1-active" name="tab1_active" value="1" checked>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div> -->

                                            <label class="col-sm-4 col-form-label" for="tab1">Tab 1 content :</label>

                                            <div class="col-sm-8">
                                                <select id="tab1" class="form-control tab-content" name="tab1" onchange="checkOpt(this.id);">
                                                    <option value="1" selected>Home Page</option>
                                                    <option value="2">Chats & Groups</option>
                                                    <option value="3">Content Posting</option>
                                                    <option value="4">Settings & User Profile</option>
                                                    <option value="">Unused</option>
                                                </select>
                                            </div>
                                            <!-- <label class="col-sm-2 col-form-label" for="tab1_icon">Home Page icon :</label> -->

                                            <div class="col-sm-4 d-none">
                                                <input type="file" id="tab1_icon" class="form-control" name="tab1_icon" onchange="loadFile1(event)">
                                                <input type="file" id="tab5_icon" class="form-control" name="tab5_icon" onchange="loadFile17(event)">
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <!-- <div class="col-sm-1">
                                                <label class="genapkcheckbox d-flex align-items-center" for="tab2-active">
                                                    <input type="checkbox" id="tab2-active" name="tab2_active" value="1" checked>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div> -->
                                            <label class="col-sm-4 col-form-label" for="tab2">Tab 2 content :</label>

                                            <div class="col-sm-8">
                                                <select id="tab2" class="form-control tab-content" name="tab2" onchange="checkOpt(this.id);">
                                                    <option value="1">Home Page</option>
                                                    <option value="2" selected>Chats & Groups</option>
                                                    <option value="3">Content Posting</option>
                                                    <option value="4">Settings & User Profile</option>
                                                    <option value="">Unused</option>
                                                </select>
                                            </div>
                                            <!-- <label class="col-sm-2 col-form-label" for="tab2_icon">Chats & Groups icon :</label> -->

                                            <div class="col-sm-4 d-none">
                                                <input type="file" id="tab2_icon" class="form-control" name="tab2_icon" onchange="loadFile2(event)">
                                                <input type="file" id="tab6_icon" class="form-control" name="tab6_icon" onchange="loadFile18(event)">
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <!-- <div class="col-sm-1">
                                                <label class="genapkcheckbox d-flex align-items-center" for="tab3-active">
                                                    <input type="checkbox" id="tab3-active" name="tab3_active" value="1" checked>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div> -->
                                            <label class="col-sm-4 col-form-label" for="tab3">Tab 3 content :</label>

                                            <div class="col-sm-8">
                                                <select id="tab3" class="form-control tab-content" name="tab3" onchange="checkOpt(this.id);">
                                                    <option value="1">Home Page</option>
                                                    <option value="2">Chats & Groups</option>
                                                    <option value="3" selected>Content Posting</option>
                                                    <option value="4">Settings & User Profile</option>
                                                    <option value="">Unused</option>
                                                </select>
                                            </div>
                                            <!-- <label class="col-sm-2 col-form-label" for="tab3_icon">Content Posting icon :</label> -->

                                            <div class="col-sm-4 d-none">
                                                <input type="file" id="tab3_icon" class="form-control" name="tab3_icon" onchange="loadFile3(event)">
                                                <input type="file" id="tab7_icon" class="form-control" name="tab7_icon" onchange="loadFile19(event)">
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <!-- <div class="col-sm-1">
                                                <label class="genapkcheckbox d-flex align-items-center" for="tab4-active">
                                                    <input type="checkbox" id="tab4-active" name="tab4_active" value="1" checked>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div> -->
                                            <label class="col-sm-4 col-form-label" for="tab4">Tab 4 content :</label>

                                            <div class="col-sm-8">
                                                <select id="tab4" class="form-control tab-content" name="tab4" onchange="checkOpt(this.id);">
                                                    <option value="1">Home Page</option>
                                                    <option value="2">Chats & Groups</option>
                                                    <option value="3">Content Posting</option>
                                                    <option value="4" selected>Settings & User Profile</option>
                                                    <option value="">Unused</option>
                                                </select>
                                            </div>
                                            <!-- <label class="col-sm-2 col-form-label" for="tab4_icon">Settings & User Profile icon :</label> -->

                                            <div class="col-sm-4 d-none">
                                                <input type="file" id="tab4_icon" class="form-control" name="tab4_icon" onchange="loadFile4(event)">
                                                <input type="file" id="tab8_icon" class="form-control" name="tab8_icon" onchange="loadFile20(event)">
                                            </div>
                                        </div>
                                        <div class="row mt-5">
                                            <div class="col-md-12">
                                                <p style="font-size:.85rem;">
                                                    Select the view layout for Home Page.
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label class="col-sm-4 col-form-label" for="content-tab-layout">Content layout :</label>

                                            <div class="col-sm-8">
                                                <!-- <input type="file" id="tab3_icon" class="form-control" name="tab3_icon"> -->
                                                <select class="form-control" name="content_tab_layout" id="content-tab-layout">
                                                    <option value="0" selected>Rows only</option>
                                                    <option value="1">Grid</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mt-5">
                                            <div class="col-md-12">
                                                <p style="font-size:.85rem;">
                                                    <strong>Access model</strong> setting allows you to change how you can access CPaaS features.
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label class="col-sm-4 col-form-label" for="access_model">Access model :</label>
                                                    <div class="col-sm-8">
                                                        <!-- <input type="file" id="tab3_icon" class="form-control" name="tab3_icon"> -->
                                                        <select class="form-control" name="access_model" onchange="selectTabMenu()" id="menuType">
                                                            <option value="0" selected>Floating button</option>
                                                            <option value="1">Docked</option>
                                                            <option value="2">Hamburger Menu</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <!-- <div class="row mt-5">
                                                    <div class="col-md-12">
                                                        <p style="font-size:.85rem;">
                                                            You can change the icons for floating buttons here.
                                                        </p>
                                                    </div>
                                                </div> -->
                                                <!-- <div class="row">
                                                    <label class="col-sm-2 col-form-label" for="fb1_icon">Instant Messaging icon :</label> -->

                                                    <div class="col-sm-4 d-none">
                                                        <input type="file" id="fb1_icon" class="form-control" name="fb1_icon" onchange="loadFile10(event)">
                                                        <input type="file" id="fb8_icon" class="form-control" name="fb8_icon" onchange="loadFile12(event)">
                                                    </div>
                                                <!-- </div>
                                                <div class="row mt-3">
                                                    <label class="col-sm-2 col-form-label" for="fb2_icon">A/V Call icon :</label> -->

                                                    <div class="col-sm-4 d-none">
                                                        <input type="file" id="fb2_icon" class="form-control" name="fb2_icon" onchange="loadFile9(event)">
                                                        <input type="file" id="fb9_icon" class="form-control" name="fb9_icon" onchange="loadFile14(event)">
                                                    </div>
                                                <!-- </div>
                                                <div class="row mt-3">
                                                    <label class="col-sm-2 col-form-label" for="fb3_icon">Contact Center icon :</label> -->

                                                    <div class="col-sm-4 d-none">
                                                        <input type="file" id="fb3_icon" class="form-control" name="fb3_icon" onchange="loadFile6(event)">
                                                        <input type="file" id="fb7_icon" class="form-control" name="fb7_icon" onchange="loadFile15(event)">
                                                    </div>
                                                <!-- </div>
                                                <div class="row mt-3">
                                                    <label class="col-sm-2 col-form-label" for="fb4_icon">Streaming & Seminar icon :</label> -->

                                                    <div class="col-sm-4 d-none">
                                                        <input type="file" id="fb4_icon" class="form-control" name="fb4_icon" onchange="loadFile8(event)">
                                                        <input type="file" id="fb10_icon" class="form-control" name="fb10_icon" onchange="loadFile13(event)">
                                                    </div>
                                                <!-- </div>
                                                <div class="row mt-3">
                                                    <label class="col-sm-2 col-form-label" for="fb5_icon">Create Post icon :</label> -->

                                                    <div class="col-sm-4 d-none">
                                                        <input type="file" id="fb5_icon" class="form-control" name="fb5_icon" onchange="loadFile7(event)">
                                                        <input type="file" id="fb11_icon" class="form-control" name="fb11_icon" onchange="loadFile16(event)">
                                                    </div>
                                                <!-- </div> -->
                                                <!-- <div class="row mt-5">
                                                    <div class="col-md-12">
                                                        <p style="font-size:.85rem;">
                                                            <strong>CPaaS icon</strong> changes the icon used on the "access model" setting. Nexilis default icon will be used if you don't upload a custom icon.
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <label class="col-sm-4 col-form-label" for="cpaas_icon">CPaaS Icon :</label> -->

                                                    <div class="col-sm-8 d-none">
                                                        <input type="file" id="cpaas_icon" class="form-control" name="cpaas_icon" onchange="loadFile5(event)">
                                                        <input type="file" id="cpaas_icon2" class="form-control" name="cpaas_icon2" onchange="loadFile11(event)">
                                                    </div>
                                                <!-- </div> -->
                                                <div class="row mt-5">
                                                    <label class="col-sm-4 col-form-label" for="app_font">Font :</label>

                                                    <div class="col-sm-8">
                                                        <!-- <input type="file" id="tab3_icon" class="form-control" name="tab3_icon"> -->
                                                        <select class="form-control" id="app_font" name="app_font">
                                                            <option value="0">Poppins</option>
                                                            <option value="1">Roboto</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row mt-3">
                                                    <div class="col-md-12">
                                                        <p style="font-size:.85rem;">
                                                            You can upload multiple backgrounds by selecting multiple files in the file explorer window and click "open".
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <label class="col-sm-4 col-form-label" for="background">Background wallpaper :</label>

                                                    <div class="col-sm-8">
                                                        <input type="file" id="background" class="form-control" accept="image/*" name="background[]" multiple onchange="backgroundFile(event)">
                                                    </div>
                                                </div>

                                                <div class="row mt-5">
                                                    <div class="col-md-12">
                                                        <p style="font-size:.85rem;">
                                                            Input your desired version name here. For simplicity, please use an easily recognizable pattern such as <strong>1.0.0, 1.0.1, 1.0.2,</strong> etc.
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <label class="col-sm-4 col-form-label" for="ver_name">Version name :</label>

                                                    <div class="col-sm-8">
                                                        <input type="text" id="ver_name" class="form-control mb-1" name="ver_name">
                                                        <p id="ver_name_format" style="font-size:.85rem; color:red;" class="d-none">
                                                            Please use only numbers and dots.
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!-- START PHONE SIMULATOR -->
                                            <div class="col-xxl-2"></div>
                                            <div id="phone-simulator" class="col-12 col-md-6 col-xxl-4">
                                                <div style="width: 400px; height: 800px">
                                                    <p style="font-size: 20px; margin-top: 50px" class="text-center"><b>CPaaS</b> in app Preview</p>
                                                    <p style="font-size: 16px" class="text-center">Change <b>CPaaS</b> model in Access Model option.</p>
                                                    <img src="assets/note-5.webp" style="width: 100%; height: auto;" alt="">

                                                    <!-- START BURGER AREA -->
                                                    <div id="burger-area" style="width: 232px; margin-left: 85px; height: 40px; margin-top: -486; background-color: grey; position: absolute">
                                                        <div class="shadow" style="background-color: #d7d7d7; position: absolute; margin-left: 117px; width: 115px; height: 140px; margin-top: 10px; padding-top: 7px">
                                                            <div id="burger-1" style="font-size: 10px; padding: 5px"><b>Contact Center</b></div>
                                                            <div id="burger-2" style="font-size: 10px; padding: 5px"><b>Instant Messaging</b></div>
                                                            <div id="burger-3" style="font-size: 10px; padding: 5px"><b>A/V Call</b></div>
                                                            <div id="burger-4" style="font-size: 10px; padding: 5px"><b>New Post</b></div>
                                                            <div id="burger-5" style="font-size: 10px; padding: 5px"><b>Live Streaming</b></div>
                                                        </div>
                                                    </div>
                                                    <!-- END BURGER AREA -->

                                                    <!-- START DOCKED AREA -->
                                                    <div class="docked-content row gx-0" style="position: absolute; margin-top: -119px; margin-left: 85px; background-color: #d7d7d7; width: 232px; height: 45px; z-index: 999">
                                                        <label for="tab1_icon" style="display: contents">
                                                            <div id="big-icon-1" class="col-2 d-flex justify-content-center msg-icon pt-2" style="width: 60px; height: 45px; border-right: 1px solid grey; z-index: 1000">
                                                                <span id="plus-1" style="margin-top: -5px; font-size: 25px">+</span>
                                                                <img id="image-preview-1" class="image-preview" src="" width="30" height="30"/>
                                                            </div>
                                                        </label>
                                                        <label for="tab2_icon" style="display: contents">
                                                            <div id="big-icon-2" class="col-2 d-flex justify-content-center smile-icon pt-2" style="width: 60px; height: 45px; z-index: 1000">
                                                                <span id="plus-2" style="margin-top: -5px; font-size: 25px">+</span>
                                                                <img id="image-preview-2" class="image-preview" src="" width="30" height="30"/>
                                                            </div>
                                                        </label>
                                                    
                                                        <div class="col-4 d-flex justify-content-center">
                                                            <div id="main-center" class="d-flex justify-content-center justify-align-center align-self-center" style="width: 60px; height: 60px; background-color: grey; margin-top: -30px; border-radius: 50%">
                                                                <div class="row gx-0 d-flex justify-content-center">
                                                                    <div class="small-icon gx-0 justify-content-center" style="width: 260px; height: 80px; position: absolute">
                                                                        <label for="fb3_icon" style="display: contents">
                                                                            <div id="small-icon-1" class="small-icon-1 d-flex justify-content-center" style="position: absolute; margin-top: -80px; background-color: #d7d7d7; border-radius: 50%; width: 40px; height: 40px; margin-left: 110px">
                                                                                <span id="plus-6" style="margin-top: 10px; font-size: 15px">+</span>
                                                                                <img id="image-preview-6" class="image-preview" src="" style="margin-top: 10px" width="20px" height="20px"/>
                                                                            </div>
                                                                        </label>
                                                                        <label for="fb5_icon" style="display: contents">
                                                                            <div id="small-icon-2" class="small-icon-2 d-flex justify-content-center" style="position: absolute; margin-top: -25px; margin-left: 180px; background-color: #d7d7d7; border-radius: 50%; width: 40px; height: 40px">
                                                                                <span id="plus-7" style="margin-top: 10px; font-size: 15px">+</span>
                                                                                <img id="image-preview-7" class="image-preview" src="" style="margin-top: 10px" width="20px" height="20px"/>
                                                                            </div>
                                                                        </label>
                                                                        <label for="fb4_icon" style="display: contents">
                                                                            <div id="small-icon-3" class="small-icon-3 d-flex justify-content-center" style="position: absolute; margin-top: -65px; margin-left: 150px; background-color: #d7d7d7; border-radius: 50%; width: 40px; height: 40px">
                                                                                <span id="plus-8" style="margin-top: 10px; font-size: 15px">+</span>
                                                                                <img id="image-preview-8" class="image-preview" src="" style="margin-top: 10px" width="20px" height="20px"/>
                                                                            </div>
                                                                        </label>
                                                                        <label for="fb2_icon" style="display: contents">
                                                                            <div id="small-icon-4" class="small-icon-4 d-flex justify-content-center" style="position: absolute; margin-top: -65px; margin-left: 70px; background-color: #d7d7d7; border-radius: 50%; width: 40px; height: 40px">
                                                                                <span id="plus-9" style="margin-top: 10px; font-size: 15px">+</span>
                                                                                <img id="image-preview-9" class="image-preview" src="" style="margin-top: 10px" width="20px" height="20px"/>
                                                                            </div>
                                                                        </label>
                                                                        <label for="fb1_icon" style="display: contents">
                                                                            <div id="small-icon-5" class="small-icon-5 d-flex justify-content-center" style="position: absolute; margin-top: -25px; margin-left: 40px; background-color: #d7d7d7; border-radius: 50%; width: 40px; height: 40px">
                                                                                <span id="plus-10" style="margin-top: 10px; font-size: 15px">+</span>
                                                                                <img id="image-preview-10" class="image-preview" src="" style="margin-top: 10px" width="20px" height="20px"/>
                                                                            </div>
                                                                        </label>
                                                                    </div>
                                                                    <label for="cpaas_icon" style="display: contents">
                                                                        <div id="big-icon-5" style="z-index: 1000">
                                                                            <div id="plus-5" style="padding-top: 12px; font-size: 25px">+</div>
                                                                            <img id="image-preview-5" class="image-preview" src="" width="60" height="60"/>
                                                                        </div>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                        
                                                        <label for="tab3_icon" style="display: contents;">
                                                            <div id="big-icon-3" class="col-2 d-flex justify-content-center home-icon pt-2" style="width: 60px; height: 45px; border-right: 1px solid grey; z-index: 1000">
                                                                <span id="plus-3" style="margin-top: -5px; font-size: 25px">+</span>
                                                                <img id="image-preview-3" class="image-preview" src="" width="30" height="30"/>
                                                            </div>
                                                        </label>
                                                        <label for="tab4_icon" style="display: contents; z-index: 1000">
                                                            <div id="big-icon-4" class="col-2 d-flex justify-content-center settings-icon pt-2" style="width: 60px; height: 45px">
                                                                <span id="plus-4" style="margin-top: -5px; font-size: 25px">+</span>
                                                                <img id="image-preview-4" class="image-preview" src="" width="30" height="30"/>
                                                            </div>
                                                        </label>
                                                    </div>
                                                    <!-- END DOCKED AREA -->

                                                    <!-- START DOCKED AREA 2 -->
                                                    <div class="docked-content-2 row gx-0" style="position: absolute; margin-top: -119px; margin-left: 85px; background-color: #d7d7d7; width: 232px; height: 45px; z-index: 999">
                                                        <label for="tab5_icon" style="display: contents">
                                                            <div id="big-icon-6" class="col-3 d-flex justify-content-center msg-icon pt-2" style="width: 60px; height: 45px; border-right: 1px solid grey; z-index: 1000">
                                                                <span id="plus-17" style="margin-top: -5px; font-size: 25px">+</span>
                                                                <img id="image-preview-17" class="image-preview" src="" width="30" height="30"/>
                                                            </div>
                                                        </label>
                                                        <label for="tab6_icon" style="display: contents">
                                                            <div id="big-icon-7" class="col-3 d-flex justify-content-center smile-icon pt-2" style="width: 60px; height: 45px; border-right: 1px solid grey; z-index: 1000">
                                                                <span id="plus-18" style="margin-top: -5px; font-size: 25px">+</span>
                                                                <img id="image-preview-18" class="image-preview" src="" width="30" height="30"/>
                                                            </div>
                                                        </label>
                                                        <label for="tab7_icon" style="display: contents;">
                                                            <div id="big-icon-8" class="col-3 d-flex justify-content-center home-icon pt-2" style="width: 60px; height: 45px; border-right: 1px solid grey; z-index: 1000">
                                                                <span id="plus-19" style="margin-top: -5px; font-size: 25px">+</span>
                                                                <img id="image-preview-19" class="image-preview" src="" width="30" height="30"/>
                                                            </div>
                                                        </label>
                                                        <label for="tab8_icon" style="display: contents; z-index: 1000">
                                                            <div id="big-icon-9" class="col-3 d-flex justify-content-center settings-icon pt-2" style="width: 60px; height: 45px">
                                                                <span id="plus-20" style="margin-top: -5px; font-size: 25px">+</span>
                                                                <img id="image-preview-20" class="image-preview" src="" width="30" height="30"/>
                                                            </div>
                                                        </label>
                                                    </div>
                                                    <!-- END DOCKED AREA 2 -->

                                                    <!-- START FLOATING AREA -->
                                                    <div id="palio-balloon">
                                                        <div class="small_icon gx-0 justify-content-center" style="width: 260px; height: 80px; position: absolute; margin-left: 150px; margin-top: -390px">
                                                            <label for="fb8_icon" style="display: contents">
                                                                <div id="small-icon-6" class="small-icon-1 d-flex justify-content-center" style="position: absolute; margin-top: -80px; background-color: #d7d7d7; border-radius: 50%; width: 40px; height: 40px; margin-left: 110px">
                                                                    <span id="plus-12" style="margin-top: 10px; font-size: 15px">+</span>
                                                                    <img id="image-preview-12" class="image-preview" src="" style="margin-top: 10px" width="20px" height="20px"/>
                                                                </div>
                                                            </label>
                                                            <label for="fb10_icon" style="display: contents">
                                                                <div id="small-icon-7" class="small-icon-2 d-flex justify-content-center" style="position: absolute; margin-top: 55px; margin-left: 110px; background-color: #d7d7d7; border-radius: 50%; width: 40px; height: 40px">
                                                                    <span id="plus-13" style="margin-top: 10px; font-size: 15px">+</span>
                                                                    <img id="image-preview-13" class="image-preview" src="" style="margin-top: 10px" width="20px" height="20px"/>
                                                                </div>
                                                            </label>
                                                            <label for="fb9_icon" style="display: contents">
                                                                <div id="small-icon-8" class="small-icon-3 d-flex justify-content-center" style="position: absolute; margin-top: -35px; margin-left: 110px; background-color: #d7d7d7; border-radius: 50%; width: 40px; height: 40px">
                                                                    <span id="plus-14" style="margin-top: 10px; font-size: 15px">+</span>
                                                                    <img id="image-preview-14" class="image-preview" src="" style="margin-top: 10px" width="20px" height="20px"/>
                                                                </div>
                                                            </label>
                                                            <label for="fb7_icon" style="display: contents">
                                                                <div id="small-icon-9" class="small-icon-4 d-flex justify-content-center" style="position: absolute; margin-top: 10px; margin-left: 110px; background-color: #d7d7d7; border-radius: 50%; width: 40px; height: 40px">
                                                                    <span id="plus-15" style="margin-top: 10px; font-size: 15px">+</span>
                                                                    <img id="image-preview-15" class="image-preview" src="" style="margin-top: 10px" width="20px" height="20px"/>
                                                                </div>
                                                            </label>
                                                            <label for="fb11_icon" style="display: contents">
                                                                <div id="small-icon-10" class="small-icon-5 d-flex justify-content-center" style="position: absolute; margin-top: 100px; margin-left: 110px; background-color: #d7d7d7; border-radius: 50%; width: 40px; height: 40px">
                                                                    <span id="plus-16" style="margin-top: 10px; font-size: 15px">+</span>
                                                                    <img id="image-preview-16" class="image-preview" src="" style="margin-top: 10px" width="20px" height="20px"/>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <label for="cpaas_icon2" style="display: contents">
                                                            <div id="floating-button" style="z-index: 1000; background-color: grey; width: 60px; height: 60px; border-radius: 50%; text-align: center; margin-top: -240px; margin-left: 240px; position: absolute">
                                                                <div id="plus-11" style="padding-top: 12px; font-size: 25px">+</div>
                                                                <img id="image-preview-11" class="image-preview" src="" width="60" height="60"/>
                                                            </div>
                                                        </label>
                                                    </div>    

                                                    <!-- END FLOATING AREA -->
                                                    <p class="text-center mt-3">Click "<b>+</b>" to upload Icon.</p>
                                                    <p class="text-center"><b>Drag</b> and <b>Drop</b> Icon to set Icon Position.</p>

                                                    <div id="sub-floating-button">
                                                        <div class="contact-center gx-0 d-flex justify-content-center">
                                                            <p>Contact Center</p>
                                                        </div>
                                                        <div class="message gx-0 d-flex justify-content-center">
                                                            <p>Message</p>
                                                        </div>
                                                        <div class="call gx-0 d-flex justify-content-center">
                                                            <p>Call</p>
                                                        </div>
                                                        <div class="new-post gx-0 d-flex justify-content-center">
                                                            <p>New Post</p>
                                                        </div>
                                                        <div class="live-streaming gx-0 d-flex justify-content-center">
                                                            <p>Live Streaming</p>
                                                        </div>
                                                    </div>

                                                    <div id="sub-docked-button">
                                                        <div class="contact-center-2 gx-0 d-flex justify-content-center">
                                                            <p>Message</p>
                                                        </div>
                                                        <div class="message-2 gx-0 d-flex justify-content-center">
                                                            <p>Call</p>
                                                        </div>
                                                        <div class="call-2 gx-0 d-flex justify-content-center">
                                                            <p>Contact Center</p>
                                                        </div>
                                                        <div class="new-post-2 gx-0 d-flex justify-content-center">
                                                            <p>Post</p>
                                                        </div>
                                                        <div class="live-streaming-2 gx-0 d-flex justify-content-center">
                                                            <p>Live Streaming</p>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <!-- END PHONE SIMULATOR -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card col-12" id="choose-certificate-details">
                            <div class="card-body">
                                <div class="row mt-3">
                                    <div class="col-md-12 radio-item">
                                        <input onclick="checkCertif()" type="radio" id="generate-default-certif" name="check-certif" value="0" checked>
                                        <label for="generate-default-certif"> Let nexilis generate a default certificate for you</label><br>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-12 radio-item">
                                        <input onclick="checkCertif()" type="radio" id="exist-certif" name="check-certif" value="1">
                                        <label for="exist-certif"> I already have my own certificate</label><br>
                                    </div>
                                </div>

                                <div id="cert-existing">
                                    <div class="row mt-3">
                                        <label class="col-sm-2 col-form-label" for="appCertificate">Your app certificate :</label>

                                        <div class="col-sm-4">
                                            <input type="file" id="appCertificate" class="form-control" name="app-certificate" placeholder="App Certificate" onchange="certificateFile(event)">
                                        </div>
                                        <label class="col-sm-2 col-form-label" for="inputAlias-existing">Alias :</label>

                                        <div class="col-sm-4">
                                            <input type="textarea" id="inputAlias-existing" class="form-control" name="inputAlias-existing">
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <label for="inputPassword" class="col-sm-2 col-form-label">Key password</label>
                                        <div class="col-sm-4">
                                            <input type="password" class="form-control" id="keyPassword-existing" name="keyPassword-existing">
                                        </div>
                                        <label for="inputConfirmPassword" class="col-sm-2 col-form-label">Key store password</label>
                                        <div class="col-sm-4">
                                            <input type="password" class="form-control" id="storePassword-existing" name="storePassword-existing">
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-12 radio-item">
                                        <input onclick="checkCertif()" type="radio" id="generate-new-certif" name="check-certif" value="2">
                                        <label for="generate-new-certif"> I want to create a new certificate</label><br>
                                    </div>
                                </div>

                                <div id="dont-have-certificate">
                                    <div class="col mt-3">
                                        <div class="form-group row align-items-center">
                                            <label for="inputAlias" class="col-sm-3 col-md-1 col-form-label">Alias</label>
                                            <div class="col-sm-9 col-md-5 left">
                                                <input type="text" class="form-control" id="inputAlias" name="inputAlias">
                                            </div>
                                            <div class="col-md-6"></div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <label for="inputPassword" class="col-sm-3 col-md-1 col-form-label">Key Password</label>
                                            <div class="col-sm-9 col-md-5 left">
                                                <input type="password" class="form-control" id="keyPassword" name="keyPassword">
                                            </div>
                                            <label for="inputConfirmPassword" class="col-sm-3 col-md-1 col-form-label">Key Store Password</label>
                                            <div class="col-sm-9 col-md-5 right">
                                                <input type="password" class="form-control" id="storePassword" name="storePassword">
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <label for="inputValidity" class="col-sm-3 col-md-1 col-form-label">Validity (years)</label>
                                            <div class="col-sm-9 col-md-5 left">
                                                <input type="number" class="form-control" id="inputValidity" name="inputValidity">
                                            </div>
                                            <div class="col-md-6"></div>
                                        </div>

                                        <hr>

                                        <div class="form-group row align-items-center">
                                            <label for="inputName" class="col-sm-3 col-md-1 col-form-label">First and Last name</label>
                                            <div class="col-sm-9 col-md-5 left">
                                                <input type="text" class="form-control" id="inputName" name="inputName">
                                            </div>
                                            <label for="inputCity" class="col-sm-3 col-md-1 col-form-label">City or Locality</label>
                                            <div class="col-sm-9 col-md-5 right">
                                                <input type="text" class="form-control" id="inputCity" name="inputCity">
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <label for="inputUnit" class="col-sm-3 col-md-1 col-form-label">Organizational Unit</label>
                                            <div class="col-sm-9 col-md-5 left">
                                                <input type="text" class="form-control" id="inputUnit" name="inputUnit">
                                            </div>
                                            <label for="inputState" class="col-sm-3 col-md-1  col-form-label">State or Province</label>
                                            <div class="col-sm-9 col-md-5 right">
                                                <input type="text" class="form-control" id="inputState" name="inputState">
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <label for="inputOrg" class="col-sm-3 col-md-1 col-form-label">Organization Name</label>
                                            <div class="col-sm-9 col-md-5 left">
                                                <input type="text" class="form-control" id="inputOrg" name="inputOrg">
                                            </div>

                                            <label for="inputCode" class="col-sm-3 col-md-1 col-form-label">Country Code (XX)</label>
                                            <div class="col-sm-9 col-md-5 right">
                                                <input type="text" class="form-control" id="inputCode" name="inputCode">
                                            </div>
                                        </div>
                                        <!-- <div class="form-group row align-items-center">
                                                
                                            </div>
                                            <div class="form-group row align-items-center">
                                            </div>
                                            <div class="form-group row align-items-center">
                                            </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4 d-flex justify-content-end">
                    <div class="col-md-12 text-center">
                        <!-- <button class="btn mt-2 mb-5 btn-yellow" id="submit-form" type="submit" value="submit" name="submit">
                            SUBMIT
                        </button> -->
                        <button class="btn mt-2 mb-5 btn-yellow" type="button" id="submit-form" onclick="sendData()">
                            SUBMIT
                        </button>
                    </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="warningModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <p>
                    Please don't close this window while we're building your apk.
                </p>
            </div>
            <!-- </form> -->
        </div>
    </div>
</div>

<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/dashboardv2/dashboard_footer.php'); ?>

<script src="js/support.js?<?php echo $version; ?>"></script>

<script>
    $('#choose-certificate-details').hide();
    $('#generate-apk-form').hide();
    $('#cert-existing').hide();
    $('#dont-have-certificate').hide();

    function generateApk() {
        var checkBox = document.getElementById("generate-apk");
        var choose_cert = document.getElementById("choose-certificate-details");
        var apk_form = document.getElementById("generate-apk-form");

        if (checkBox.checked == true) {
            // choose_cert.classList.remove("d-none");
            // apk_form.classList.remove("d-none");
            $('#choose-certificate-details').show();
            $('#generate-apk-form').show();
            $('#generate-apk-form #appId').prop('required', true);
            $('#generate-apk-form #companyName').prop('required', true);
        } else {
            // choose_cert.classList.add("d-none");
            // apk_form.classList.add("d-none");
            $('#choose-certificate-details').hide();
            $('#generate-apk-form').hide();
            $('#cert-existing').hide();
            $('#dont-have-certificate').hide();
            $('#generate-apk-form #appId').prop('required', false);
            $('#generate-apk-form #companyName').prop('required', false);
        }
    }

    let radioCertif;

    function checkCertif() {
        radioCertif = document.querySelector('input[name="check-certif"]:checked').value;
        // // let have_certif = document.getElementById("have-certificate");
        let dont_have_certif = document.getElementById("dont-have-certificate");
        let cert_existing = document.getElementById("cert-existing");

        if (radioCertif == 0) {
            // cert_existing.classList.add("d-none");
            // dont_have_certif.classList.add("d-none");
            $('#cert-existing').hide();
            $('#dont-have-certificate').hide();
        } else if (radioCertif == 1) {
            // cert_existing.classList.remove("d-none");
            // dont_have_certif.classList.add("d-none");
            $('#cert-existing').show();
            $('#dont-have-certificate').hide();
        } else if (radioCertif == 2) {
            // cert_existing.classList.add("d-none");
            // dont_have_certif.classList.remove("d-none");
            $('#cert-existing').hide();
            $('#dont-have-certificate').show();
        }
    }

    function checkOpt(elementID) {
        var elt = document.getElementById(elementID);
        var valCounter = {};

        var othercodes = [
            document.getElementById('tab1').value,
            document.getElementById('tab2').value,
            document.getElementById('tab3').value,
            document.getElementById('tab4').value,
        ];
        for (var i = 0; i <= 3; i++) {
            var c = valCounter[othercodes[i]] = (valCounter[othercodes[i]] || 0) + 1;
            if (c > 1 && othercodes[i] != "") {
                document.getElementById("submit-form").setAttribute("disabled", "disabled");
                // so that it stops form submission;
                // document.getElementById("notification").innerHTML = elt.options[elt.selectedIndex].text + " Subject Already Choosen!";
                alert("You selected duplicate tab contents.");
                return false;
            }
        }
        let inputFile = document.getElementById(elementID + '_icon');

        if (elt.value == "") {
            inputFile.setAttribute("disabled", true);
        }else {
            inputFile.removeAttribute("disabled");
        }
        // document.getElementById("notification").innerHTML = "";
        document.getElementById("submit-form").removeAttribute("disabled");
        // so that it allows form submission again;
    }

    $('#ver_name').on('input', function() {
        let rgx = /^[\.0-9]*$/;
        let str = $(this).val();
        if (!rgx.test(str)) {
            document.getElementById("submit-form").setAttribute("disabled", "disabled");
            $('#ver_name_format').removeClass("d-none");
        } else {
            document.getElementById("submit-form").removeAttribute("disabled");
            $('#ver_name_format').addClass("d-none");
        }
    });

    // $('select.tab-content').each(function() {

    // })

    $('button#submit-form').click(function() {
        if (!$(this).is(':disabled')) {
            // $('#warningModal').modal('show');
        }
    })


    // function existCertificate() {
    //     if (checkBoxExist.checked == true) {

    //     }
    // }

    // function newCertificate() {

    //     if (checkBoxCertif.checked == true) {
    //         // have_certif.classList.add("d-none");
    //         cert_existing.classList.add("d-none");
    //         dont_have_certif.classList.remove("d-none");

    //     } else {
    //         // have_certif.classList.remove("d-none");
    //         cert_existing.classList.remove("d-none");
    //         dont_have_certif.classList.add("d-none");

    //     }
    // }
</script>

<script>
    // script paling bawah
    document.addEventListener('DOMContentLoaded', function() {
        $('a.nav-link[href="billpayment.php"]').removeClass('active');
        $('a.nav-link[href="index.php"]').removeClass('active');
        $('a.nav-link[href="usage.php"]').removeClass('active');
        $('a.nav-link[href="support.php"]').removeClass('active');
        $('a.nav-link[href="mailbox.php"]').removeClass('active');
        $('a.nav-link[href="webappform.php"]').addClass('active');
        $('a.nav-link[href="form_management.php"]').removeClass('active');
    }, false);
    // var _0x5949 = ['a.nav-link[href=\x22mailbox.php\x22]', '869053cGhRlA', '21730YsPQuM', '371VJiiOA', 'a.nav-link[href=\x22usage.php\x22]', '451680guHajX', 'active', '2027duTcSS', 'removeClass', '19nNedkn', 'addClass', 'a.nav-link[href=\x22index.php\x22]', '252645UCLALp', 'a.nav-link[href=\x22billpayment.php\x22]', '407220gMJjRM', '1XRjAlx', '1202032wQQrMx'];
    // var _0x3be9 = function(_0x2d15dc, _0x23667b) {
    //     _0x2d15dc = _0x2d15dc - 0x98;
    //     var _0x59495d = _0x5949[_0x2d15dc];
    //     return _0x59495d;
    // };
    // var _0xeb4428 = _0x3be9;
    // (function(_0x5af5ad, _0x50638f) {
    //     var _0x2cbd90 = _0x3be9;
    //     while (!![]) {
    //         try {
    //             var _0x355172 = -parseInt(_0x2cbd90(0x98)) * -parseInt(_0x2cbd90(0x9b)) + -parseInt(_0x2cbd90(0x9d)) * parseInt(_0x2cbd90(0xa1)) + -parseInt(_0x2cbd90(0x9f)) + parseInt(_0x2cbd90(0x99)) + -parseInt(_0x2cbd90(0x9c)) * parseInt(_0x2cbd90(0xa3)) + parseInt(_0x2cbd90(0xa8)) + -parseInt(_0x2cbd90(0xa6));
    //             if (_0x355172 === _0x50638f) break;
    //             else _0x5af5ad['push'](_0x5af5ad['shift']());
    //         } catch (_0x5ceefa) {
    //             _0x5af5ad['push'](_0x5af5ad['shift']());
    //         }
    //     }
    // }(_0x5949, 0x94b45), $(_0xeb4428(0xa7))[_0xeb4428(0xa2)](_0xeb4428(0xa0)), $(_0xeb4428(0xa5))[_0xeb4428(0xa2)](_0xeb4428(0xa0)), $(_0xeb4428(0x9e))[_0xeb4428(0xa2)](_0xeb4428(0xa0)), $('a.nav-link[href=\x22support.php\x22]')[_0xeb4428(0xa4)](_0xeb4428(0xa0)), $(_0xeb4428(0x9a))['removeClass'](_0xeb4428(0xa0)));
</script>

<!-- SCRIPT SIMULATOR -->

<script>
    // $(".small-icon").hide();

    // FOUR MAIN BUTTON (DOCKED)
    $('#image-preview-1').hide();
    $('#image-preview-2').hide();
    $('#image-preview-3').hide();
    $('#image-preview-4').hide();

    // FIVE SMALL BUTTON (DOCKED)
    $('#image-preview-5').hide();
    $('#image-preview-6').hide();
    $('#image-preview-7').hide();
    $('#image-preview-8').hide();
    $('#image-preview-9').hide();
    $('#image-preview-10').hide();

    // FIVE SMALL BUTTON (FLOATING & BURGER)
    $('#image-preview-11').hide();
    $('#image-preview-12').hide();
    $('#image-preview-13').hide();
    $('#image-preview-14').hide();
    $('#image-preview-15').hide();
    $('#image-preview-16').hide();

    // FOUR MAIN BUTTON (FLOATING & BURGER)
    $('#image-preview-17').hide();
    $('#image-preview-18').hide();
    $('#image-preview-19').hide();
    $('#image-preview-20').hide();

    // $("#big-icon-5").click(function(){
    //     $(".small-icon").toggle();        
    // });

    // INPUT FILE

    // FOUR MAIN BUTTON DIV (DOCKED)
    var inputDragElem1 = document.getElementById('big-icon-1');
    var inputDragElem2 = document.getElementById('big-icon-2');
    var inputDragElem3 = document.getElementById('big-icon-3');
    var inputDragElem4 = document.getElementById('big-icon-4');

    // FIVE SMALL BUTTON DIV (DOCKED)
    var inputDragElem5 = document.getElementById('big-icon-5');
    var inputDragElem6 = document.getElementById('small-icon-1');
    var inputDragElem7 = document.getElementById('small-icon-2');
    var inputDragElem8 = document.getElementById('small-icon-3');
    var inputDragElem9 = document.getElementById('small-icon-4');
    var inputDragElem10 = document.getElementById('small-icon-5');

    // FOUR MAIN BUTTON DIV (FLOATING & BURGER)
    var inputDragElem11 = document.getElementById('big-icon-6');
    var inputDragElem12 = document.getElementById('big-icon-7');
    var inputDragElem13 = document.getElementById('big-icon-8');
    var inputDragElem14 = document.getElementById('big-icon-9');

    // FIVE SMALL BUTTON DIV (FLOATING & BURGER)
    var inputDragElem15 = document.getElementById('floating-button');
    var inputDragElem16 = document.getElementById('small-icon-6');
    var inputDragElem17 = document.getElementById('small-icon-7');
    var inputDragElem18 = document.getElementById('small-icon-8');
    var inputDragElem19 = document.getElementById('small-icon-9');
    var inputDragElem20 = document.getElementById('small-icon-10');

    // FOUR MAIN BUTTON IMAGE (DOCKED)
    var imagePreviewUrlElem1 = document.getElementById('image-preview-1');
    var imagePreviewUrlElem2 = document.getElementById('image-preview-2');
    var imagePreviewUrlElem3 = document.getElementById('image-preview-3');
    var imagePreviewUrlElem4 = document.getElementById('image-preview-4');

    // FIVE SMALL BUTTON IMAGE (DOCKED)
    var imagePreviewUrlElem5 = document.getElementById('image-preview-5');
    var imagePreviewUrlElem6 = document.getElementById('image-preview-6');
    var imagePreviewUrlElem7 = document.getElementById('image-preview-7');
    var imagePreviewUrlElem8 = document.getElementById('image-preview-8');
    var imagePreviewUrlElem9 = document.getElementById('image-preview-9');
    var imagePreviewUrlElem10 = document.getElementById('image-preview-10');

    // FIVE SMALL BUTTON IMAGE (FLOATING & BURGER)
    var imagePreviewUrlElem11 = document.getElementById('image-preview-11');
    var imagePreviewUrlElem12 = document.getElementById('image-preview-12');
    var imagePreviewUrlElem13 = document.getElementById('image-preview-13');
    var imagePreviewUrlElem14 = document.getElementById('image-preview-14');
    var imagePreviewUrlElem15 = document.getElementById('image-preview-15');
    var imagePreviewUrlElem16 = document.getElementById('image-preview-16');

    // FOUR MAIN BUTTON IMAGE (FLOATING & BURGER)
    var imagePreviewUrlElem17 = document.getElementById('image-preview-17'); //6-17
    var imagePreviewUrlElem18 = document.getElementById('image-preview-18'); //7-18
    var imagePreviewUrlElem19 = document.getElementById('image-preview-19'); //8-19
    var imagePreviewUrlElem20 = document.getElementById('image-preview-20'); //9-20

    var link = new Array(); // ARRAY FOR SAVE BASE64 UPLOAD IMAGES
    var switching = 0; // FOR KNOWN WHICH ITEM DRAGG FROM (EX : FROM 1 TO 2)

    var preventDefault = function(event) {
        event.preventDefault();
        event.stopPropagation();
        return false;
    }

    // HANDLE FILE INPUT FROM DRAG PICTURES TO PHONE 

    var handleDrop1 = function(event) {
        var dataTransfer = event.dataTransfer;
        var files = dataTransfer.files;

        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            var reader = new FileReader();

            reader.readAsDataURL(file);
            reader.addEventListener('loadend', function(event, file) {
                imagePreviewUrlElem1.src = this.result;
                $('#plus-1').hide();
                $('#image-preview-1').show();

                if (switching != 0 && link[1] != null){
                    $('#image-preview-'+switching).attr('src', link[1]);

                    link[switching] = link[1];

                }else if(switching != 0){
                    $('#image-preview-'+switching).hide();
                    $('#plus-'+switching).show();
                    
                    link[switching] = null;
                }

                link[1] = this.result;
                $('#file-1').text(this.result);
                checkFile();
            });
        }
    }

    var handleDrop2 = function(event) {
        var dataTransfer = event.dataTransfer;
        var files = dataTransfer.files;

        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            var reader = new FileReader();

            reader.readAsDataURL(file);
            reader.addEventListener('loadend', function(event, file) {
                imagePreviewUrlElem2.src = this.result;
                $('#plus-2').hide();
                $('#image-preview-2').show();

                if (switching != 0 && link[2] != null){
                    $('#image-preview-'+switching).attr('src', link[2]);

                    link[switching] = link[2];

                }else if(switching != 0){
                    $('#image-preview-'+switching).hide();
                    $('#plus-'+switching).show();
                    
                    link[switching] = null;
                }

                link[2] = this.result;
                $('#file-2').text(this.result);
                checkFile();
            });
        }
    }

    var handleDrop3 = function(event) {
        var dataTransfer = event.dataTransfer;
        var files = dataTransfer.files;

        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            var reader = new FileReader();

            reader.readAsDataURL(file);
            reader.addEventListener('loadend', function(event, file) {
                imagePreviewUrlElem3.src = this.result;
                $('#plus-3').hide();
                $('#image-preview-3').show();

                if (switching != 0 && link[3] != null){
                    $('#image-preview-'+switching).attr('src', link[3]);

                    link[switching] = link[3];

                }else if(switching != 0){
                    $('#image-preview-'+switching).hide();
                    $('#plus-'+switching).show();
                    
                    link[switching] = null;
                }

                link[3] = this.result;
                $('#file-3').text(this.result);
                checkFile();
            });
        }
    }

    var handleDrop4 = function(event) {
        var dataTransfer = event.dataTransfer;
        var files = dataTransfer.files;

        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            var reader = new FileReader();

            reader.readAsDataURL(file);
            reader.addEventListener('loadend', function(event, file) {
                imagePreviewUrlElem4.src = this.result;
                $('#plus-4').hide();
                $('#image-preview-4').show();

                if (switching != 0 && link[4] != null){
                    $('#image-preview-'+switching).attr('src', link[4]);

                    link[switching] = link[4];

                }else if(switching != 0){
                    $('#image-preview-'+switching).hide();
                    $('#plus-'+switching).show();
                    
                    link[switching] = null;
                }

                link[4] = this.result;
                $('#file-4').text(this.result);
                checkFile();
            });
        }
    }

    var handleDrop5 = function(event) {
        var dataTransfer = event.dataTransfer;
        var files = dataTransfer.files;

        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            var reader = new FileReader();

            reader.readAsDataURL(file);
            reader.addEventListener('loadend', function(event, file) {
                imagePreviewUrlElem5.src = this.result;
                $('#plus-5').hide();
                $('#image-preview-5').show();

                if (switching != 0 && link[5] != null){
                    $('#image-preview-'+switching).attr('src', link[5]);

                    link[switching] = link[5];

                }else if(switching != 0){
                    $('#image-preview-'+switching).hide();
                    $('#plus-'+switching).show();
                    
                    link[switching] = null;
                }

                link[5] = this.result;
                $('#file-5').text(this.result);
                checkFile();
            });
        }
    }

    var handleDrop6 = function(event) {
        var dataTransfer = event.dataTransfer;
        var files = dataTransfer.files;

        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            var reader = new FileReader();

            reader.readAsDataURL(file);
            reader.addEventListener('loadend', function(event, file) {
                imagePreviewUrlElem6.src = this.result;
                $('#plus-6').hide();
                $('#image-preview-6').show();
               
                if (switching != 0 && link[6] != null){
                    $('#image-preview-'+switching).attr('src', link[6]);

                    link[switching] = link[6];

                }else if(switching != 0){
                    $('#image-preview-'+switching).hide();
                    $('#plus-'+switching).show();
                    
                    link[switching] = null;
                }

                link[6] = this.result;
                $('#file-6').text(this.result);
                checkFile();
            });
        }
    }

    var handleDrop7 = function(event) {
        var dataTransfer = event.dataTransfer;
        var files = dataTransfer.files;

        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            var reader = new FileReader();

            reader.readAsDataURL(file);
            reader.addEventListener('loadend', function(event, file) {
                imagePreviewUrlElem7.src = this.result;
                $('#plus-7').hide();
                $('#image-preview-7').show();
                
                if (switching != 0 && link[7] != null){
                    $('#image-preview-'+switching).attr('src', link[7]);

                    link[switching] = link[7];

                }else if(switching != 0){
                    $('#image-preview-'+switching).hide();
                    $('#plus-'+switching).show();
                    
                    link[switching] = null;
                }

                link[7] = this.result;
                $('#file-7').text(this.result);
                checkFile();
            });
        }
    }

    var handleDrop8 = function(event) {
        var dataTransfer = event.dataTransfer;
        var files = dataTransfer.files;

        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            var reader = new FileReader();

            reader.readAsDataURL(file);
            reader.addEventListener('loadend', function(event, file) {
                imagePreviewUrlElem8.src = this.result;
                $('#plus-8').hide();
                $('#image-preview-8').show();
                
                if (switching != 0 && link[8] != null){
                    $('#image-preview-'+switching).attr('src', link[8]);

                    link[switching] = link[8];

                }else if(switching != 0){
                    $('#image-preview-'+switching).hide();
                    $('#plus-'+switching).show();
                    
                    link[switching] = null;
                }

                link[8] = this.result;
                $('#file-8').text(this.result);
                checkFile();
            });
        }
    }

    var handleDrop9 = function(event) {
        var dataTransfer = event.dataTransfer;
        var files = dataTransfer.files;

        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            var reader = new FileReader();

            reader.readAsDataURL(file);
            reader.addEventListener('loadend', function(event, file) {
                imagePreviewUrlElem9.src = this.result;
                $('#plus-9').hide();
                $('#image-preview-9').show();
                
                if (switching != 0 && link[9] != null){
                    $('#image-preview-'+switching).attr('src', link[9]);

                    link[switching] = link[9];

                }else if(switching != 0){
                    $('#image-preview-'+switching).hide();
                    $('#plus-'+switching).show();
                    
                    link[switching] = null;
                }

                link[9] = this.result;
                $('#file-9').text(this.result);
                checkFile();
            });
        }
    }

    var handleDrop10 = function(event) {
        var dataTransfer = event.dataTransfer;
        var files = dataTransfer.files;

        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            var reader = new FileReader();

            reader.readAsDataURL(file);
            reader.addEventListener('loadend', function(event, file) {
                imagePreviewUrlElem10.src = this.result;
                $('#plus-10').hide();
                $('#image-preview-10').show();
               
                if (switching != 0 && link[10] != null){
                    $('#image-preview-'+switching).attr('src', link[10]);

                    link[switching] = link[10];

                }else if(switching != 0){
                    $('#image-preview-'+switching).hide();
                    $('#plus-'+switching).show();
                    
                    link[switching] = null;
                }

                link[10] = this.result;
                $('#file-10').text(this.result);
                checkFile();
            });
        }
    }

    var handleDrop11 = function(event) {
        var dataTransfer = event.dataTransfer;
        var files = dataTransfer.files;

        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            var reader = new FileReader();

            reader.readAsDataURL(file);
            reader.addEventListener('loadend', function(event, file) {
                imagePreviewUrlElem17.src = this.result;
                $('#plus-17').hide();
                $('#image-preview-17').show();
               
                if (switching != 0 && link[17] != null){
                    $('#image-preview-'+switching).attr('src', link[17]);

                    link[switching] = link[17];

                }else if(switching != 0){
                    $('#image-preview-'+switching).hide();
                    $('#plus-'+switching).show();
                    
                    link[switching] = null;
                }

                link[17] = this.result;
                $('#file-17').text(this.result);
                checkFile();
            });
        }
    }

    var handleDrop12 = function(event) {
        var dataTransfer = event.dataTransfer;
        var files = dataTransfer.files;

        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            var reader = new FileReader();

            reader.readAsDataURL(file);
            reader.addEventListener('loadend', function(event, file) {
                imagePreviewUrlElem18.src = this.result;
                $('#plus-18').hide();
                $('#image-preview-18').show();
               
                if (switching != 0 && link[18] != null){
                    $('#image-preview-'+switching).attr('src', link[18]);

                    link[switching] = link[18];

                }else if(switching != 0){
                    $('#image-preview-'+switching).hide();
                    $('#plus-'+switching).show();
                    
                    link[switching] = null;
                }

                link[18] = this.result;
                $('#file-18').text(this.result);
                checkFile();
            });
        }
    }

    var handleDrop13 = function(event) {
        var dataTransfer = event.dataTransfer;
        var files = dataTransfer.files;

        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            var reader = new FileReader();

            reader.readAsDataURL(file);
            reader.addEventListener('loadend', function(event, file) {
                imagePreviewUrlElem19.src = this.result;
                $('#plus-19').hide();
                $('#image-preview-19').show();
               
                if (switching != 0 && link[19] != null){
                    $('#image-preview-'+switching).attr('src', link[19]);

                    link[switching] = link[19];

                }else if(switching != 0){
                    $('#image-preview-'+switching).hide();
                    $('#plus-'+switching).show();
                    
                    link[switching] = null;
                }

                link[19] = this.result;
                $('#file-19').text(this.result);
                checkFile();
            });
        }
    }

    var handleDrop14 = function(event) {
        var dataTransfer = event.dataTransfer;
        var files = dataTransfer.files;

        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            var reader = new FileReader();

            reader.readAsDataURL(file);
            reader.addEventListener('loadend', function(event, file) {
                imagePreviewUrlElem20.src = this.result;
                $('#plus-20').hide();
                $('#image-preview-20').show();
               
                if (switching != 0 && link[20] != null){
                    $('#image-preview-'+switching).attr('src', link[20]);

                    link[switching] = link[20];

                }else if(switching != 0){
                    $('#image-preview-'+switching).hide();
                    $('#plus-'+switching).show();
                    
                    link[switching] = null;
                }

                link[20] = this.result;
                $('#file-20').text(this.result);
                checkFile();
            });
        }
    }

    var handleDrop15 = function(event) {
        var dataTransfer = event.dataTransfer;
        var files = dataTransfer.files;

        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            var reader = new FileReader();

            reader.readAsDataURL(file);
            reader.addEventListener('loadend', function(event, file) {
                imagePreviewUrlElem11.src = this.result;
                $('#plus-11').hide();
                $('#image-preview-11').show();
               
                if (switching != 0 && link[11] != null){
                    $('#image-preview-'+switching).attr('src', link[11]);

                    link[switching] = link[11];

                }else if(switching != 0){
                    $('#image-preview-'+switching).hide();
                    $('#plus-'+switching).show();
                    
                    link[switching] = null;
                }

                link[11] = this.result;
                $('#file-11').text(this.result);
                checkFile();
            });
        }
    }

    var handleDrop16 = function(event) {
        var dataTransfer = event.dataTransfer;
        var files = dataTransfer.files;

        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            var reader = new FileReader();

            reader.readAsDataURL(file);
            reader.addEventListener('loadend', function(event, file) {
                imagePreviewUrlElem12.src = this.result;
                $('#plus-12').hide();
                $('#image-preview-12').show();
               
                if (switching != 0 && link[12] != null){
                    $('#image-preview-'+switching).attr('src', link[12]);

                    link[switching] = link[12];

                }else if(switching != 0){
                    $('#image-preview-'+switching).hide();
                    $('#plus-'+switching).show();
                    
                    link[switching] = null;
                }

                link[12] = this.result;
                $('#file-12').text(this.result);
                checkFile();
            });
        }
    }

    var handleDrop17 = function(event) {
        var dataTransfer = event.dataTransfer;
        var files = dataTransfer.files;

        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            var reader = new FileReader();

            reader.readAsDataURL(file);
            reader.addEventListener('loadend', function(event, file) {
                imagePreviewUrlElem13.src = this.result;
                $('#plus-13').hide();
                $('#image-preview-13').show();
               
                if (switching != 0 && link[13] != null){
                    $('#image-preview-'+switching).attr('src', link[13]);

                    link[switching] = link[13];

                }else if(switching != 0){
                    $('#image-preview-'+switching).hide();
                    $('#plus-'+switching).show();
                    
                    link[switching] = null;
                }

                link[13] = this.result;
                $('#file-13').text(this.result);
                checkFile();
            });
        }
    }

    var handleDrop18 = function(event) {
        var dataTransfer = event.dataTransfer;
        var files = dataTransfer.files;

        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            var reader = new FileReader();

            reader.readAsDataURL(file);
            reader.addEventListener('loadend', function(event, file) {
                imagePreviewUrlElem14.src = this.result;
                $('#plus-14').hide();
                $('#image-preview-14').show();
               
                if (switching != 0 && link[14] != null){
                    $('#image-preview-'+switching).attr('src', link[14]);

                    link[switching] = link[14];

                }else if(switching != 0){
                    $('#image-preview-'+switching).hide();
                    $('#plus-'+switching).show();
                    
                    link[switching] = null;
                }

                link[14] = this.result;
                $('#file-14').text(this.result);
                checkFile();
            });
        }
    }

    var handleDrop19 = function(event) {
        var dataTransfer = event.dataTransfer;
        var files = dataTransfer.files;

        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            var reader = new FileReader();

            reader.readAsDataURL(file);
            reader.addEventListener('loadend', function(event, file) {
                imagePreviewUrlElem15.src = this.result;
                $('#plus-15').hide();
                $('#image-preview-15').show();
               
                if (switching != 0 && link[15] != null){
                    $('#image-preview-'+switching).attr('src', link[15]);

                    link[switching] = link[15];

                }else if(switching != 0){
                    $('#image-preview-'+switching).hide();
                    $('#plus-'+switching).show();
                    
                    link[switching] = null;
                }

                link[15] = this.result;
                $('#file-15').text(this.result);
                checkFile();
            });
        }
    }

    var handleDrop20 = function(event) {
        var dataTransfer = event.dataTransfer;
        var files = dataTransfer.files;

        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            var reader = new FileReader();

            reader.readAsDataURL(file);
            reader.addEventListener('loadend', function(event, file) {
                imagePreviewUrlElem16.src = this.result;
                $('#plus-16').hide();
                $('#image-preview-16').show();
               
                if (switching != 0 && link[16] != null){
                    $('#image-preview-'+switching).attr('src', link[16]);

                    link[switching] = link[16];

                }else if(switching != 0){
                    $('#image-preview-'+switching).hide();
                    $('#plus-'+switching).show();
                    
                    link[switching] = null;
                }

                link[16] = this.result;
                $('#file-16').text(this.result);
                checkFile();
            });
        }
    }

    inputDragElem1.addEventListener('dragstart', function(event){

        switching = 1;
        console.log(switching);

    }, false);

    inputDragElem1.addEventListener('dragover', function(event){

        preventDefault(event);
        clearBorder();
        $('#big-icon-1').css('background-color','#f2ad33');

    });

    inputDragElem1.addEventListener('dragenter', preventDefault);
    inputDragElem1.addEventListener('drop', function(event) {
       
        preventDefault(event);
        handleDrop1(event);
        clearBlur();
        clearBorder();
       
    }, false);

    inputDragElem2.addEventListener('dragstart', function(event){
       
        switching = 2;
        console.log(switching);

    }, false);

    inputDragElem2.addEventListener('dragover', function(event){

        preventDefault(event);
        clearBorder();
        $('#big-icon-2').css('background-color','#f2ad33');

    });

    inputDragElem2.addEventListener('dragenter', preventDefault);
    inputDragElem2.addEventListener('drop', function(event) {
       
        preventDefault(event);
        handleDrop2(event);
        clearBlur();
        clearBorder();
       
    }, false);

    inputDragElem3.addEventListener('dragstart', function(event){
        
        switching = 3;
        console.log(switching);

    }, false);

    inputDragElem3.addEventListener('dragover', function(event){

        preventDefault(event);
        clearBorder();
        $('#big-icon-3').css('background-color','#f2ad33');

    });

    inputDragElem3.addEventListener('dragenter', preventDefault);
    inputDragElem3.addEventListener('drop', function(event) {
        
        preventDefault(event);
        handleDrop3(event);
        clearBlur();
        clearBorder();

    }, false);

    inputDragElem4.addEventListener('dragstart', function(event){
        
        switching = 4;
        console.log(switching);

    }, false);

    inputDragElem4.addEventListener('dragover', function(event){

        preventDefault(event);
        clearBorder();
        $('#big-icon-4').css('background-color','#f2ad33');

    });

    inputDragElem4.addEventListener('dragenter', preventDefault);
    inputDragElem4.addEventListener('drop', function(event) {
        
        preventDefault(event);
        handleDrop4(event);
        clearBlur();
        clearBorder();

    }, false);

    inputDragElem5.addEventListener('dragstart', function(event){
        
        switching = 5;
        console.log(switching);

    }, false);

    inputDragElem5.addEventListener('dragover', function(event){

        preventDefault(event);
        clearBorder();
        $('#main-center').css('background-color','#f2ad33');

    });
    inputDragElem5.addEventListener('dragenter', preventDefault);
    inputDragElem5.addEventListener('drop', function(event) {
        
        preventDefault(event);
        handleDrop5(event);
        clearBlur();
        clearBorder();

    }, false);

    inputDragElem6.addEventListener('dragstart', function(event){
        
        switching = 6;
        console.log(switching);

    }, false);

    inputDragElem6.addEventListener('dragover', function(event){

        preventDefault(event);
        clearBorder();
        $('#small-icon-1').css('background-color','#f2ad33');

    });

    inputDragElem6.addEventListener('dragenter', preventDefault);
    inputDragElem6.addEventListener('drop', function(event) {
        
        preventDefault(event);
        handleDrop6(event);
        clearBlur();
        clearBorder();

    }, false);

    inputDragElem7.addEventListener('dragstart', function(event){
        
        switching = 7;
        console.log(switching);

    }, false);

    inputDragElem7.addEventListener('dragover', function(event){

        preventDefault(event);
        clearBorder();
        $('#small-icon-2').css('background-color','#f2ad33');

    });
    inputDragElem7.addEventListener('dragenter', preventDefault);
    inputDragElem7.addEventListener('drop', function(event) {
        
        preventDefault(event);
        handleDrop7(event);
        clearBlur();
        clearBorder();

    }, false);

    inputDragElem8.addEventListener('dragstart', function(event){
        
        switching = 8;
        console.log(switching);

    }, false);

    inputDragElem8.addEventListener('dragover', function(event){

        preventDefault(event);
        clearBorder();
        $('#small-icon-3').css('background-color','#f2ad33');

    });

    inputDragElem8.addEventListener('dragenter', preventDefault);
    inputDragElem8.addEventListener('drop', function(event) {
        
        preventDefault(event);
        handleDrop8(event);
        clearBlur();
        clearBorder();

    }, false);

    inputDragElem9.addEventListener('dragstart', function(event){
        
        switching = 9;
        console.log(switching);

    }, false);

    inputDragElem9.addEventListener('dragover', function(event){

        preventDefault(event);
        clearBorder();
        $('#small-icon-4').css('background-color','#f2ad33');

    });

    inputDragElem9.addEventListener('dragenter', preventDefault);
    inputDragElem9.addEventListener('drop', function(event) {
        
        preventDefault(event);
        handleDrop9(event);
        clearBlur();
        clearBorder();

    }, false);

    inputDragElem10.addEventListener('dragstart', function(event){
        
        switching = 10;
        console.log(switching);

    }, false);

    inputDragElem10.addEventListener('dragover', function(event){

        preventDefault(event);
        clearBorder();
        $('#small-icon-5').css('background-color','#f2ad33');

    });

    inputDragElem10.addEventListener('dragenter', preventDefault);
    inputDragElem10.addEventListener('drop', function(event) {
        
        preventDefault(event);
        handleDrop10(event);
        clearBlur();
        clearBorder();

    }, false);

    inputDragElem11.addEventListener('dragstart', function(event){
        
        switching = 17;
        console.log(switching);

    }, false);

    inputDragElem11.addEventListener('dragover', function(event){

        preventDefault(event);
        clearBorder();
        $('#big-icon-6').css('background-color','#f2ad33');

    });

    inputDragElem11.addEventListener('dragenter', preventDefault);
    inputDragElem11.addEventListener('drop', function(event) {
        
        preventDefault(event);
        handleDrop11(event);
        clearBlur();
        clearBorder();

    }, false);

    inputDragElem12.addEventListener('dragstart', function(event){
        
        switching = 18;
        console.log(switching);

    }, false);

    inputDragElem12.addEventListener('dragover', function(event){

        preventDefault(event);
        clearBorder();
        $('#big-icon-7').css('background-color','#f2ad33');

    });

    inputDragElem12.addEventListener('dragenter', preventDefault);
    inputDragElem12.addEventListener('drop', function(event) {
        
        preventDefault(event);
        handleDrop12(event);
        clearBlur();
        clearBorder();

    }, false);

    inputDragElem13.addEventListener('dragstart', function(event){
        
        switching = 19;
        console.log(switching);

    }, false);

    inputDragElem13.addEventListener('dragover', function(event){

        preventDefault(event);
        clearBorder();
        $('#big-icon-8').css('background-color','#f2ad33');

    });

    inputDragElem13.addEventListener('dragenter', preventDefault);
    inputDragElem13.addEventListener('drop', function(event) {
        
        preventDefault(event);
        handleDrop13(event);
        clearBlur();
        clearBorder();

    }, false);

    inputDragElem14.addEventListener('dragstart', function(event){
        
        switching = 20;
        console.log(switching);

    }, false);

    inputDragElem14.addEventListener('dragover', function(event){

        preventDefault(event);
        clearBorder();
        $('#big-icon-9').css('background-color','#f2ad33');

    });

    inputDragElem14.addEventListener('dragenter', preventDefault);
    inputDragElem14.addEventListener('drop', function(event) {
        
        preventDefault(event);
        handleDrop14(event);
        clearBlur();
        clearBorder();

    }, false);

    inputDragElem15.addEventListener('dragstart', function(event){
        
        switching = 11;
        console.log(switching);

    }, false);

    inputDragElem15.addEventListener('dragover', function(event){

        preventDefault(event);
        clearBorder();
        $('#floating-button').css('background-color','#f2ad33');

    });

    inputDragElem15.addEventListener('dragenter', preventDefault);
    inputDragElem15.addEventListener('drop', function(event) {
        
        preventDefault(event);
        handleDrop15(event);
        clearBlur();
        clearBorder();

    }, false);

    inputDragElem16.addEventListener('dragstart', function(event){
        
        switching = 12;
        console.log(switching);

    }, false);

    inputDragElem16.addEventListener('dragover', function(event){

        preventDefault(event);
        clearBorder();
        $('#small-icon-6').css('background-color','#f2ad33');

    });

    inputDragElem16.addEventListener('dragenter', preventDefault);
    inputDragElem16.addEventListener('drop', function(event) {
        
        preventDefault(event);
        handleDrop16(event);
        clearBlur();
        clearBorder();

    }, false);

    inputDragElem17.addEventListener('dragstart', function(event){
        
        switching = 13;
        console.log(switching);

    }, false);

    inputDragElem17.addEventListener('dragover', function(event){

        preventDefault(event);
        clearBorder();
        $('#small-icon-7').css('background-color','#f2ad33');

    });

    inputDragElem17.addEventListener('dragenter', preventDefault);
    inputDragElem17.addEventListener('drop', function(event) {
        
        preventDefault(event);
        handleDrop17(event);
        clearBlur();
        clearBorder();

    }, false);

    inputDragElem18.addEventListener('dragstart', function(event){
        
        switching = 14;
        console.log(switching);

    }, false);

    inputDragElem18.addEventListener('dragover', function(event){

        preventDefault(event);
        clearBorder();
        $('#small-icon-8').css('background-color','#f2ad33');

    });

    inputDragElem18.addEventListener('dragenter', preventDefault);
    inputDragElem18.addEventListener('drop', function(event) {
        
        preventDefault(event);
        handleDrop18(event);
        clearBlur();
        clearBorder();

    }, false);

    inputDragElem19.addEventListener('dragstart', function(event){
        
        switching = 15;
        console.log(switching);

    }, false);

    inputDragElem19.addEventListener('dragover', function(event){

        preventDefault(event);
        clearBorder();
        $('#small-icon-9').css('background-color','#f2ad33');

    });

    inputDragElem19.addEventListener('dragenter', preventDefault);
    inputDragElem19.addEventListener('drop', function(event) {
        
        preventDefault(event);
        handleDrop19(event);
        clearBlur();
        clearBorder();

    }, false);

    inputDragElem20.addEventListener('dragstart', function(event){
        
        switching = 16;
        console.log(switching);

    }, false);

    inputDragElem20.addEventListener('dragover', function(event){

        preventDefault(event);
        clearBorder();
        $('#small-icon-10').css('background-color','#f2ad33');

    });

    inputDragElem20.addEventListener('dragenter', preventDefault);
    inputDragElem20.addEventListener('drop', function(event) {
        
        preventDefault(event);
        handleDrop20(event);
        clearBlur();
        clearBorder();

    }, false);

    // FOR BLUE OUTSIDE WHILE DRAGGIN PICTURES

    let outside = document.getElementById('generate-apk-form');
    
    outside.addEventListener('dragover', function(event) {
        preventDefault(event);
        $('.main-sidebar').css('opacity','0.2');
        $('.left-side').css('opacity','0.2');
        $('.blur').css('opacity','0.2');
    });
    outside.addEventListener('dragenter', preventDefault);
    outside.addEventListener('drop', function(event) {
        preventDefault(event);
        
        $('#image-preview-'+switching).attr('src','');
        $('#image-preview-'+switching).hide();
        $('#plus-'+switching).show();

        if (switching == 1){
            link[1] = null;
        }else if(switching == 2){
            link[2] = null;
        }else if(switching == 3){
            link[3] = null;
        }else if(switching == 4){
            link[4] = null;
        }else if(switching == 5){
            link[5] = null;
        }else if(switching == 6){
            link[6] = null;
        }else if(switching == 7){
            link[7] = null;
        }else if(switching == 8){
            link[8] = null;
        }else if(switching == 9){
            link[9] = null;
        }else if(switching == 10){
            link[10] = null;
        }else if (switching == 11){
            link[11] = null;
        }else if(switching == 12){
            link[12] = null;
        }else if(switching == 13){
            link[13] = null;
        }else if(switching == 14){
            link[14] = null;
        }else if(switching == 15){
            link[15] = null;
        }else if(switching == 16){
            link[16] = null;
        }else if(switching == 17){
            link[17] = null;
        }else if(switching == 18){
            link[18] = null;
        }else if(switching == 19){
            link[19] = null;
        }else if(switching == 20){
            link[20] = null;
        }



        switching = 0;
        checkFile();
        clearBlur();
        clearBorder();

    }, false);

    // CONSOLE.LOG AFTER DRAGGING PICTURES

    var tab1 = "";
    var tab2 = "";
    var tab3 = "";
    var tab4 = "";

    var cpaas = "";
    var messaging = "";
    var call = "";
    var contact = "";
    var post = "";
    var streaming = "";

    const background = [];
    var certificate = "";

    function checkFile(){
        // console.log("Foto 1 (Homepage) = ", link[1]); // Homepage Icon
        // console.log("Foto 2 (Chats) = ", link[2]); // Chats & Groups Icon
        // console.log("Foto 3 (Content) = ", link[3]); // Content Posting Icon
        // console.log("Foto 4 (Settings) = ", link[4]); // Settings & Profile Icon

        // console.log("Foto 5 (CPAAS) = ", link[5]); // CPAAS Icon
        // console.log("Foto 6 (Messaging) = ", link[6]); // Instant Messaging Icon
        // console.log("Foto 7 (A/V Call) = ", link[7]); // A/V Call Icon
        // console.log("Foto 8 (Contact Center)= ", link[8]); // Contact Center Icon
        // console.log("Foto 9 (Streaming) = ", link[9]); // Streaming & Seminar Icon
        // console.log("Foto 10 (Post) = ", link[10]); // Create Post Icon

        // console.log("Foto 11 (CPAAS) = ", link[11]); // CPAAS Icon
        // console.log("Foto 12 (Messaging) = ", link[12]); // Instant Messaging Icon
        // console.log("Foto 13 (A/V Call) = ", link[13]); // A/V Call Icon
        // console.log("Foto 14 (Contact Center)= ", link[14]); // Contact Center Icon
        // console.log("Foto 15 (Streaming) = ", link[15]); // Streaming & Seminar Icon
        // console.log("Foto 16 (Post) = ", link[16]); // Create Post Icon

        // console.log("Foto 17 (Homepage) = ", link[17]); // Homepage Icon
        // console.log("Foto 18 (Chats) = ", link[18]); // Chats & Groups Icon
        // console.log("Foto 19 (Content) = ", link[19]); // Content Posting Icon
        // console.log("Foto 20 (Settings) = ", link[20]); // Settings & Profile Icon

        if (link[1] != null || link[17] != null){
            if(link[1] != null){
                tab1 = link[1];
            }else if(link[17] != null){
                tab1 = link[17];
            }
        }else{
            tab1 = null;
        }

        if (link[2] != null || link[18] != null){
            if(link[2] != null){
                tab2 = link[2];
            }else if(link[18] != null){
                tab2 = link[18];
            }
        }else{
            tab2 = null;
        }

        if (link[3] != null || link[19] != null){
            if(link[3] != null){
                tab3 = link[3];
            }else if(link[19] != null){
                tab3 = link[19];
            }
        }else{
            tab3 = null;
        }

        if (link[4] != null || link[20] != null){
            if(link[4] != null){
                tab4 = link[4];
            }else if(link[20] != null){
                tab4 = link[20];
            }
        }else{
            tab4 = null;
        }

        if (link[5] != null || link[11] != null){
            if(link[5] != null){
                cpaas = link[5];
            }else if(link[11] != null){
                cpaas = link[11];
            }
        }else{
            cpaas = null;
        }

        if (link[10] != null || link[14] != null){
            if(link[10] != null){
                messaging = link[10];
            }else if(link[14] != null){
                messaging = link[14];
            }
        }else{
            messaging = null;
        }

        if (link[9] != null || link[15] != null){
            if(link[9] != null){
                call = link[9];
            }else if(link[15] != null){
                call = link[15];
            }
        }else{
            call = null;
        }

        if (link[6] != null || link[12] != null){
            if(link[6] != null){
                contact = link[6];
            }else if(link[12] != null){
                contact = link[12];
            }
        }else{
            contact = null;
        }

        if (link[8] != null || link[13] != null){
            if(link[8] != null){
                post = link[8];
            }else if(link[13] != null){
                post = link[13];
            }
        }else{
            post = null;
        }

        if (link[7] != null || link[16] != null){
            if(link[7] != null){
                streaming = link[7];
            }else if(link[16] != null){
                streaming = link[16];
            }
        }else{
            streaming = null;
        }

        // FINAL RESULT
        // console.log("Tab 1 = ", tab1);
        // console.log("Tab 2 = ", tab2);
        // console.log("Tab 3 = ", tab3);
        // console.log("Tab 4 = ", tab4);
        // console.log("CPaaS = ", cpaas);
        // console.log("Messaging = ", messaging);
        // console.log("Call = ", call);
        // console.log("Contact = ", contact);
        // console.log("Post = ", post);
        // console.log("Streaming = ", streaming);

        // console.log("Background = ", background);
        // console.log("Certificate = ", certificate);
    }

    // WHEN DROP PICTURE BLUR OUTSIDE DISSAPEAR

    function clearBlur(){
        $('.main-sidebar').css('opacity','1');
        $('.left-side').css('opacity','1');
        $('.blur').css('opacity','1');
    }

    // WHEN DROP PICTURE BACKGROUND HIGHLIGHT DISSAPEAR

    function clearBorder(){
        $('#big-icon-1').css('background-color','#d7d7d7');
        $('#big-icon-2').css('background-color','#d7d7d7');
        $('#big-icon-3').css('background-color','#d7d7d7');
        $('#big-icon-4').css('background-color','#d7d7d7');
        $('#main-center').css('background-color','grey');
        $('#big-icon-6').css('background-color','#d7d7d7');
        $('#big-icon-7').css('background-color','#d7d7d7');
        $('#big-icon-8').css('background-color','#d7d7d7');
        $('#big-icon-9').css('background-color','#d7d7d7');
        $('#floating-button').css('background-color','grey');
        $('#small-icon-1').css('background-color','#d7d7d7');
        $('#small-icon-2').css('background-color','#d7d7d7');
        $('#small-icon-3').css('background-color','#d7d7d7');
        $('#small-icon-4').css('background-color','#d7d7d7');
        $('#small-icon-5').css('background-color','#d7d7d7');
        $('#small-icon-6').css('background-color','#d7d7d7');
        $('#small-icon-7').css('background-color','#d7d7d7');
        $('#small-icon-8').css('background-color','#d7d7d7');
        $('#small-icon-9').css('background-color','#d7d7d7');
        $('#small-icon-10').css('background-color','#d7d7d7');
    }

</script>

<script>
    function btnOption() {
        document.getElementById("myDropdown").classList.toggle("show");
    }

    window.onclick = function(event) {
        if (!event.target.matches('.dropbtn')) {
            var dropdowns = document.getElementsByClassName("dropdown-content");
            var i;
            for (i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                }
            }
        }
    }
</script>

<script>
    $(".docked-content").hide();
    $("#burger-area").hide();
    $("#sub-docked-button").hide();

    function selectTabMenu(){

        var menuType = $('#menuType').val();

        if (menuType == 0){
            $("#palio-balloon").show();
            $(".docked-content").hide();
            $(".docked-content-2").show();
            $("#burger-area").hide();
            $("#sub-floating-button").show();
            $("#sub-docked-button").hide();
        }

        else if (menuType == 1){
            $("#palio-balloon").hide();
            $(".docked-content").show();
            $(".docked-content-2").hide();
            $("#burger-area").hide();
            $("#sub-floating-button").hide();
            $("#sub-docked-button").show();
        }
        
        else{
            $("#palio-balloon").hide();
            $(".docked-content").hide();
            $(".docked-content-2").show();
            $("#burger-area").show();
            $("#sub-floating-button").hide();
            $("#sub-docked-button").hide();
        }

        // CLEAR ALL IMAGES WHILE SWITCH CPAAS MODEL
        link[1] = null;
        link[2] = null;
        link[3] = null;
        link[4] = null;
        link[5] = null;
        link[6] = null;
        link[7] = null;
        link[8] = null;
        link[9] = null;
        link[10] = null;
        link[11] = null;
        link[12] = null;
        link[13] = null;
        link[14] = null;
        link[15] = null;
        link[16] = null;
        link[17] = null;
        link[18] = null;
        link[19] = null;
        link[20] = null;

        $('#image-preview-1').hide();
        $('#image-preview-1').attr('src','');
        $('#image-preview-2').hide();
        $('#image-preview-2').attr('src','');
        $('#image-preview-3').hide();
        $('#image-preview-3').attr('src','');
        $('#image-preview-4').hide();
        $('#image-preview-4').attr('src','');
        $('#image-preview-5').hide();
        $('#image-preview-5').attr('src','');
        $('#image-preview-6').hide();
        $('#image-preview-6').attr('src','');
        $('#image-preview-7').hide();
        $('#image-preview-7').attr('src','');
        $('#image-preview-8').hide();
        $('#image-preview-8').attr('src','');
        $('#image-preview-9').hide();
        $('#image-preview-9').attr('src','');
        $('#image-preview-10').hide();
        $('#image-preview-10').attr('src','');
        $('#image-preview-11').hide();
        $('#image-preview-11').attr('src','');
        $('#image-preview-12').hide();
        $('#image-preview-12').attr('src','');
        $('#image-preview-13').hide();
        $('#image-preview-13').attr('src','');
        $('#image-preview-14').hide();
        $('#image-preview-14').attr('src','');
        $('#image-preview-15').hide();
        $('#image-preview-15').attr('src','');
        $('#image-preview-16').hide();
        $('#image-preview-16').attr('src','');
        $('#image-preview-17').hide();
        $('#image-preview-17').attr('src','');
        $('#image-preview-18').hide();
        $('#image-preview-18').attr('src','');
        $('#image-preview-19').hide();
        $('#image-preview-19').attr('src','');
        $('#image-preview-20').hide();
        $('#image-preview-20').attr('src','');
        
        $('#plus-1').show();
        $('#plus-2').show();
        $('#plus-3').show();
        $('#plus-4').show();
        $('#plus-5').show();
        $('#plus-6').show();
        $('#plus-7').show();
        $('#plus-8').show();
        $('#plus-9').show();
        $('#plus-10').show();
        $('#plus-11').show();
        $('#plus-12').show();
        $('#plus-13').show();
        $('#plus-14').show();
        $('#plus-15').show();
        $('#plus-16').show();
        $('#plus-17').show();
        $('#plus-18').show();
        $('#plus-19').show();
        $('#plus-20').show();

    }

    // SELECT FILE FROM BUTTON + IN PHONE 

    var loadFile1 = function(event) {
		var reader = new FileReader();
		reader.onload = function(){;
            $('#plus-1').hide();
            $('#image-preview-1').attr('src', reader.result);
            $('#image-preview-1').show();
            link[1] = reader.result;
            checkFile();
        };
        reader.readAsDataURL(event.target.files[0]);
    }

    var loadFile2 = function(event) {
		var reader = new FileReader();
		reader.onload = function(){;
            $('#plus-2').hide();
            $('#image-preview-2').attr('src', reader.result);
            $('#image-preview-2').show();
            link[2] = reader.result;
            checkFile();
        };
        reader.readAsDataURL(event.target.files[0]);
    }

    var loadFile3 = function(event) {
		var reader = new FileReader();
		reader.onload = function(){;
            $('#plus-3').hide();
            $('#image-preview-3').attr('src', reader.result);
            $('#image-preview-3').show();
            link[3] = reader.result;
            checkFile();
        };
        reader.readAsDataURL(event.target.files[0]);
    }

    var loadFile4 = function(event) {
		var reader = new FileReader();
		reader.onload = function(){;
            $('#plus-4').hide();
            $('#image-preview-4').attr('src', reader.result);
            $('#image-preview-4').show();
            link[4] = reader.result;
            checkFile();
        };
        reader.readAsDataURL(event.target.files[0]);
    }

    var loadFile5 = function(event) {
		var reader = new FileReader();
		reader.onload = function(){;
            $('#plus-5').hide();
            $('#image-preview-5').attr('src', reader.result);
            $('#image-preview-5').show();
            link[5] = reader.result;
            checkFile();
        };
        reader.readAsDataURL(event.target.files[0]);
    }

    var loadFile6 = function(event) {
		var reader = new FileReader();
		reader.onload = function(){;
            $('#plus-6').hide();
            $('#image-preview-6').attr('src', reader.result);
            $('#image-preview-6').show();
            link[6] = reader.result;
            checkFile();
        };
        reader.readAsDataURL(event.target.files[0]);
    }

    var loadFile7 = function(event) {
		var reader = new FileReader();
		reader.onload = function(){;
            $('#plus-7').hide();
            $('#image-preview-7').attr('src', reader.result);
            $('#image-preview-7').show();
            link[7] = reader.result;
            checkFile();
        };
        reader.readAsDataURL(event.target.files[0]);
    }

    var loadFile8 = function(event) {
		var reader = new FileReader();
		reader.onload = function(){;
            $('#plus-8').hide();
            $('#image-preview-8').attr('src', reader.result);
            $('#image-preview-8').show();
            link[8] = reader.result;
            checkFile();
        };
        reader.readAsDataURL(event.target.files[0]);
    }

    var loadFile9 = function(event) {
		var reader = new FileReader();
		reader.onload = function(){;
            $('#plus-9').hide();
            $('#image-preview-9').attr('src', reader.result);
            $('#image-preview-9').show();
            link[9] = reader.result;
            checkFile();
        };
        reader.readAsDataURL(event.target.files[0]);
    }


    var loadFile10 = function(event) {
		var reader = new FileReader();
		reader.onload = function(){;
            $('#plus-10').hide();
            $('#image-preview-10').attr('src', reader.result);
            $('#image-preview-10').show();
            link[10] = reader.result;
            checkFile();
        };
        reader.readAsDataURL(event.target.files[0]);
    }

    var loadFile11 = function(event) {
		var reader = new FileReader();
		reader.onload = function(){;
            $('#plus-11').hide();
            $('#image-preview-11').attr('src', reader.result);
            $('#image-preview-11').show();
            link[11] = reader.result;
            checkFile();
        };
        reader.readAsDataURL(event.target.files[0]);
    }

    var loadFile12 = function(event) {
		var reader = new FileReader();
		reader.onload = function(){;
            $('#plus-12').hide();
            $('#image-preview-12').attr('src', reader.result);
            $('#image-preview-12').show();
            link[12] = reader.result;
            checkFile();
        };
        reader.readAsDataURL(event.target.files[0]);
    }

    var loadFile13 = function(event) {
		var reader = new FileReader();
		reader.onload = function(){;
            $('#plus-13').hide();
            $('#image-preview-13').attr('src', reader.result);
            $('#image-preview-13').show();
            link[13] = reader.result;
            checkFile();
        };
        reader.readAsDataURL(event.target.files[0]);
    }

    var loadFile14 = function(event) {
		var reader = new FileReader();
		reader.onload = function(){;
            $('#plus-14').hide();
            $('#image-preview-14').attr('src', reader.result);
            $('#image-preview-14').show();
            link[14] = reader.result;
            checkFile();
        };
        reader.readAsDataURL(event.target.files[0]);
    }

    var loadFile15 = function(event) {
		var reader = new FileReader();
		reader.onload = function(){;
            $('#plus-15').hide();
            $('#image-preview-15').attr('src', reader.result);
            $('#image-preview-15').show();
            link[15] = reader.result;
            checkFile();
        };
        reader.readAsDataURL(event.target.files[0]);
    }

    var loadFile16 = function(event) {
		var reader = new FileReader();
		reader.onload = function(){;
            $('#plus-16').hide();
            $('#image-preview-16').attr('src', reader.result);
            $('#image-preview-16').show();
            link[16] = reader.result;
            checkFile();
        };
        reader.readAsDataURL(event.target.files[0]);
    }

    var loadFile17 = function(event) {
		var reader = new FileReader();
		reader.onload = function(){;
            $('#plus-17').hide();
            $('#image-preview-17').attr('src', reader.result);
            $('#image-preview-17').show();
            link[17] = reader.result;
            checkFile();
        };
        reader.readAsDataURL(event.target.files[0]);
    }

    var loadFile18 = function(event) {
		var reader = new FileReader();
		reader.onload = function(){;
            $('#plus-18').hide();
            $('#image-preview-18').attr('src', reader.result);
            $('#image-preview-18').show();
            link[18] = reader.result;
            checkFile();
        };
        reader.readAsDataURL(event.target.files[0]);
    }

    var loadFile19 = function(event) {
		var reader = new FileReader();
		reader.onload = function(){;
            $('#plus-19').hide();
            $('#image-preview-19').attr('src', reader.result);
            $('#image-preview-19').show();
            link[19] = reader.result;
            checkFile();
        };
        reader.readAsDataURL(event.target.files[0]);
    }

    var loadFile20 = function(event) {
		var reader = new FileReader();
		reader.onload = function(){;
            $('#plus-20').hide();
            $('#image-preview-20').attr('src', reader.result);
            $('#image-preview-20').show();
            link[20] = reader.result;
            checkFile();
        };
        reader.readAsDataURL(event.target.files[0]);
    }

    var backgroundFile = function(event) {
		var reader = new FileReader();
		reader.onload = function(){;
            background.push(reader.result);
            checkFile();
        };
        reader.readAsDataURL(event.target.files[0]);
    }

    var certificateFile = function(event) {
		var reader = new FileReader();
		reader.onload = function(){;
            certificate = reader.result;
            checkFile();
        };
        reader.readAsDataURL(event.target.files[0]);
    }
    
</script>

<!-- SCRIPT XHR TO SUBMIT ALL FORM -->

<script>

    // SCRIPT CONVERT BASE64 TO OBJECT

    function dataURLtoFile(dataurl, filename){
        var arr = dataurl.split(','), mime = arr[0].match(/:(.*?);/)[1],
        bstr = atob(arr[1]), n = bstr.length, u8arr = new Uint8Array(n);

        while(n--){
            u8arr[n] = bstr.charCodeAt(n);
        }

        return new File([u8arr], filename, {type:mime});
    }

    // NEW FORMAT BASE 64 FOR APPEND

    function newFormat(base64_link){

        var format = base64_link.split(";");

        if (format[0].slice(-4) == "jpeg" || format[0].slice(-4) == "webp"){
            var ext = format[0].slice(-4);
        }else{
            var ext = format[0].slice(-3);
        }

        var rand = Math.floor(Math.random() * 1000000000000);

        var converted_link = dataURLtoFile(base64_link, rand + "." + ext);

        return converted_link;
    }

    // SEND FORM

    function sendData(){

        var formData = new FormData();

        // DECLARE VAR FROM VAL

        var companyWebsite = $('#companyWebsite').val();
        var companyName = $('#companyName').val();
        var appId = $('#appId').val();
        
        var tab1_page = $('#tab1').val();
        var tab2_page = $('#tab2').val();
        var tab3_page = $('#tab3').val();
        var tab4_page = $('#tab4').val();

        if (tab1){
            var tab1_icon = newFormat(tab1);
        }else{
            var tab1_icon = "";
        }

        if (tab2){
            var tab2_icon = newFormat(tab2);
        }else{
            var tab2_icon = "";
        }

        if (tab3){
            var tab3_icon = newFormat(tab3);
        }else{
            var tab3_icon = "";
        }

        if (tab4){
            var tab4_icon = newFormat(tab4);
        }else{
            var tab4_icon = "";
        }

        if (cpaas){
            var cpaas_icon = newFormat(cpaas);
        }else{
            var cpaas_icon = "";
        }

        if (messaging){        
            var fb1_icon = newFormat(messaging);
        }else{
            var fb1_icon = "";
        }

        if (call){        
            var fb2_icon = newFormat(call);
        }else{
            var fb2_icon = "";
        }

        if (contact){        
            var fb3_icon = newFormat(contact);
        }else{
            var fb3_icon = "";
        }

        if (post){        
            var fb4_icon = newFormat(post);
        }else{
            var fb4_icon = "";
        }

        if (streaming){        
            var fb5_icon = newFormat(streaming);
        }else{
            var fb5_icon = "";
        }

        var content_tab_layout = $('#content-tab-layout').val();
        var menuType = $('#menuType').val();
        var app_font = $('#app_font').val();

        if (background.length > 0){        
            var background_wall = [];

            for (var i = 0; i < background.length; i++) {
                background_wall.push(newFormat(background[i]));
            }

            console.log("BACK"+background_wall);

        }else{
            var background_wall = "";
        }
        
        var ver_name = $('#ver_name').val();
        var ver_code = <?= $ver_code ?>;
        var generate_apk = $('#generate-apk').val();

        var generate_default_certif = radioCertif;
        if (radioCertif == null || radioCertif == ""){
            generate_default_certif = '0';
        }

        if (certificate){        
            var app_certificate = newFormat(certificate);
        }else{
            var app_certificate = "";
        }

        var keyPassword_existing = $('#keyPassword-existing').val();
        var inputAlias_existing = $('#inputAlias-existing').val();
        var storePassword_existing = $('#storePassword-existing').val();

        var inputAlias = $('#inputAlias').val();
        var keyPassword = $('#keyPassword').val();
        var inputValidity = $('#inputValidity').val();
        var storePassword = $('#storePassword').val();
        var inputName = $('#inputName').val();
        var inputUnit = $('#inputUnit').val();
        var inputOrg = $('#inputOrg').val();
        var inputCity = $('#inputCity').val();
        var inputState = $('#inputState').val();
        var inputCode = $('#inputCode').val();

        // CONSOLE.LOG

        // console.log("Company Website = ", companyWebsite);
        // console.log("Company Name = ", companyName);
        // console.log("App ID = ", appId);

        // console.log("Tab 1 = ", tab1_page);
        // console.log("Tab 2 = ", tab2_page);
        // console.log("Tab 3 = ", tab3_page);
        // console.log("Tab 4 = ", tab4_page);

        // console.log("Icon Tab 1 = ", tab1_icon);
        // console.log("Icon Tab 2 = ", tab2_icon);
        // console.log("Icon Tab 3 = ", tab3_icon);
        // console.log("Icon Tab 4 = ", tab4_icon);
        // console.log("Icon CPaaS = ", cpaas_icon);
        // console.log("Icon Messaging = ", fb1_icon);
        // console.log("Icon A/V Call = ", fb2_icon);
        // console.log("Icon Contact Center = ", fb3_icon);
        // console.log("Icon Post = ", fb4_icon);
        // console.log("Icon Streaming = ", fb5_icon);

        // console.log("Content Layout = ", content_tab_layout);
        // console.log("Menu Type = ", menuType);
        // console.log("App Font = ", app_font);
        // console.log("Background = ", background_wall);
        // console.log("Ver Name = ", ver_name);

        // console.log("Generate Certif = ", generate_default_certif);

        // console.log("App Certificate", app_certificate);
        // console.log("Key Password = ", keyPassword_existing);
        // console.log("Alias = ", inputAlias_existing);
        // console.log("Key Store Password = ", storePassword_existing);

        // console.log("Alias = ", inputAlias);
        // console.log("Key Password = ", keyPassword);
        // console.log("Validity = ", inputValidity);
        // console.log("Key Store Password = ", storePassword);
        // console.log("First Last Name = ", inputName);
        // console.log("Organizational Unit = ", inputUnit);
        // console.log("Organizational Name = ", inputOrg);
        // console.log("City = ", inputCity);
        // console.log("State = ", inputState);
        // console.log("Country Code = ", inputCode);

        // FORM DATA APPEND

        formData.append('company-website', companyWebsite);
        formData.append('company-name', companyName);
        formData.append('app-id', appId);

        formData.append('tab1', tab1_page);
        formData.append('tab2', tab2_page);
        formData.append('tab3', tab3_page);
        formData.append('tab4', tab4_page);

        formData.append('tab1_icon', tab1_icon);
        formData.append('tab2_icon', tab2_icon);
        formData.append('tab3_icon', tab3_icon);
        formData.append('tab4_icon', tab4_icon);
        formData.append('cpaas_icon', cpaas_icon);
        formData.append('fb1_icon', fb1_icon);
        formData.append('fb2_icon', fb2_icon);
        formData.append('fb3_icon', fb3_icon);
        formData.append('fb4_icon', fb4_icon);
        formData.append('fb5_icon', fb5_icon);

        formData.append('generate-apk', ver_code);
        formData.append('ver_code', generate_apk);

        formData.append('content_tab_layout', content_tab_layout);
        formData.append('access_model', menuType);
        formData.append('app_font', app_font);

        for(var i=0; i<background_wall.length; i++){
            formData.append('background[]', background_wall[i]);
        }

        formData.append('ver_name', ver_name);

        formData.append('check-certif', generate_default_certif);

        formData.append('app-certificate', app_certificate);
        formData.append('keyPassword-existing', keyPassword_existing);
        formData.append('inputAlias-existing', inputAlias_existing);
        formData.append('storePassword-existing', storePassword_existing);

        formData.append('inputAlias', inputAlias);
        formData.append('keyPassword', keyPassword);
        formData.append('inputValidity', inputValidity);
        formData.append('storePassword', storePassword);
        formData.append('inputName', inputName);
        formData.append('inputUnit', inputUnit);
        formData.append('inputOrg', inputOrg);
        formData.append('inputCity', inputCity);
        formData.append('inputState', inputState);
        formData.append('inputCode', inputCode);

        // XMLHTTP PROCESS

        for (var pair of formData.entries()) {
            console.log(pair[0]+ ', ' + pair[1]); 
        }

        let xmlHttp = new XMLHttpRequest();
        xmlHttp.onreadystatechange = function (){

            if (xmlHttp.readyState == 4 && xmlHttp.status == 200){
                console.log(xmlHttp.responseText);

                if(xmlHttp.responseText=="Berhasil"){
                    window.location.href = "/dashboardv2/index.php";
                }else{
                    console.log("Gagal");
                }
            }
        }

        xmlHttp.open("post", "logics/submit_build_apk");
        xmlHttp.send(formData);

    }

</script>