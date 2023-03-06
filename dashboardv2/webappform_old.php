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

// print_r($query_one_result);

if ($query_one_result['VERSION_CODE'] != null) {
    $ver_code = intval($query_one_result["VERSION_CODE"]);
} else {
    $ver_code = 1;
}

if ($query_one_result['WEB_URL'] == null) {
    $webURL = "";
} else {
    $webURL = $query_one_result["WEB_URL"];
}

// $ver_code = $query_one_result["VERSION_CODE"];


// echo 'ver code ' . $ver_code;

?>

<!-- Pretify -->
<script type="text/javascript" src="<?php echo base_url(); ?>js/prettify.js"></script>

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
        margin-top: -315px;
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

    .home {
        width: 50px;
        margin-left: 80px;
        margin-top: 45px;
        font-family: "Poppins", sans-serif;
        font-size: 10px;
        color: grey;
        text-align: center;
    }

    .home-2 {
        width: 50px;
        margin-left: 89px;
        margin-top: 145px;
        font-family: "Poppins", sans-serif;
        font-size: 10px;
        color: grey;
        text-align: center;
    }

    .home-3 {
        width: 50px;
        margin-left: 89px;
        margin-top: -250px;
        font-family: "Poppins", sans-serif;
        font-size: 10px;
        color: grey;
        text-align: center;
    }

    .chats {
        width: 150px;
        margin-left: 73px;
        margin-top: -31px;
        font-family: "Poppins", sans-serif;
        font-size: 10px;
        color: grey;
    }

    .chats-2 {
        width: 150px;
        margin-left: 97px;
        margin-top: -31px;
        font-family: "Poppins", sans-serif;
        font-size: 10px;
        color: grey;
    }

    .chats-3 {
        width: 150px;
        margin-left: 97px;
        margin-top: -31px;
        font-family: "Poppins", sans-serif;
        font-size: 10px;
        color: grey;
    }

    .contents {
        width: 50px;
        margin-left: 225px;
        margin-top: -31px;
        font-family: "Poppins", sans-serif;
        font-size: 10px;
        color: grey;
        text-align: center;
    }

    .contents-2 {
        width: 50px;
        margin-left: 205px;
        margin-top: -31px;
        font-family: "Poppins", sans-serif;
        font-size: 10px;
        color: grey;
        text-align: center;
    }

    .contents-3 {
        width: 50px;
        margin-left: 205px;
        margin-top: -31px;
        font-family: "Poppins", sans-serif;
        font-size: 10px;
        color: grey;
        text-align: center;
    }

    .settings {
        width: 150px;
        margin-left: 221px;
        margin-top: -31px;
        font-family: "Poppins", sans-serif;
        font-size: 10px;
        color: grey;
    }

    .settings-2 {
        width: 150px;
        margin-left: 214px;
        margin-top: -31px;
        font-family: "Poppins", sans-serif;
        font-size: 10px;
        color: grey;
    }

    .settings-3 {
        width: 150px;
        margin-left: 214px;
        margin-top: -31px;
        font-family: "Poppins", sans-serif;
        font-size: 10px;
        color: grey;
    }

    img[src=""] {
        display: none;
    }

    @media screen and (min-width:1590px) {
        #outside-text{
            font-size: 24px;
        }
    }

    @media screen and (max-width:1590px) {
        #outside-text{
            font-size: 18px;
        }
    }

    @media screen and (min-width:768px) {
        #phone-simulator{
            padding-left: 50px;
        }
    }

    @media screen and (max-width:768px) {
        #phone-simulator{
            margin-left: -45px;
        }
    }

    @media screen and (min-width:1800px) {
        #phone-simulator{
            padding-left: 150px;
        }
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
                                            <input type="checkbox" id="generate-apk" name="generate-apk" value="1">
                                            <span class="checkmark"></span>
                                        </label><br>
                                        <label class="genapkcheckbox" for="edit-apk"> I want to edit apk
                                            <input type="checkbox" id="edit-apk" name="edit_apk" value="1">
                                            <span class="checkmark"></span>
                                        </label><br>
                                    </div>
                                </div>

                                <div id="generate-apk-form">
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <p style="font-size:.85rem;">Please make sure you have uploaded a company logo at the dashboard's <a href="/dashboardv2/index">main page</a>.</p>
                                        </div>
                                    </div>

                                    <div class="row mb-5">
                                        <div class="col-sm-12 col-md-6 left">
                                            <label for="companyName">Your company name <span style="color:red;">*</span> :</label>
                                            <input type="textarea" id="companyName" class="form-control" name="company-name" placeholder="Company Name">
                                        </div>
                                        <div class="col-sm-12 col-md-6 right">
                                            <label for="appId">Your app id <span style="color:red;">*</span> :</label>
                                            <input type="textarea" id="appId" class="form-control" name="app-id" placeholder="com.example">
                                        </div>
                                    </div>

                                    <h6><strong>APK Settings</strong></h6>

                                    <div class="row mt-3">
                                        <div class="col-md-12">
                                            <p style="font-size:.85rem;">
                                                In this section you can change the content of tabs and change tab icons. Nexilis default tab icons will be used if you don't upload a custom icon.
                                                <br>
                                                <strong>Note:</strong> You can't select the same option for different tabs.
                                            </p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <p id="outside-text" class="d-none" style="position:absolute; margin-top: 285px; margin-left: 30px"><b>Drop & Drag</b> outside the phone to remove Icon.</p>
                                        <div class="col-12 col-md-6 left-side">
                                            <div class="row">
                                                <!-- <div class="col-sm-1">
                                                <label class="genapkcheckbox d-flex align-items-center" for="tab1-active">
                                                    <input type="checkbox" id="tab1-active" name="tab1_active" value="1" checked>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div> -->

                                                <label class="col-sm-4 col-form-label" for="tab1">Tab 1 content <span style="color:red;">*</span> :</label>

                                                <div class="col-sm-8">
                                                    <select id="tab1" class="form-control tab-content" name="tab1" onchange="checkOpt(this.id);">
                                                        <option value="" disabled selected>Select your option</option>
                                                        <option value="1">Home Page</option>
                                                        <option value="2">Chats & Groups</option>
                                                        <option value="3">Content Posting</option>
                                                        <option value="4">Settings & User Profile</option>
                                                        <option value="0">Unused</option>
                                                    </select>
                                                </div>
                                                <!-- <label class="col-sm-2 col-form-label" for="tab1_icon">Home Page icon :</label> -->

                                                <div class="col-sm-4 d-none">
                                                    <input type="file" id="tab1_icon" class="form-control" name="tab1_icon" onchange="loadFile1(event)">
                                                    <input type="file" id="tab5_icon" class="form-control" name="tab5_icon" onchange="loadFile17(event)">
                                                </div>
                                            </div>
                                            <div class="row mt-3 d-none" id="tab1_url_row">
                                                <!-- <label class="col-sm-4 col-form-label" for="tab1_url">Home page URL :</label>

                                                <div class="col-sm-8">
                                                    <input type="text" id="tab1_url" placeholder="www.example.com" class="form-control mb-1" name="tab1_url">
                                                </div> -->
                                            </div>
                                            <div class="row mt-3">
                                                <!-- <div class="col-sm-1">
                                                <label class="genapkcheckbox d-flex align-items-center" for="tab2-active">
                                                    <input type="checkbox" id="tab2-active" name="tab2_active" value="1" checked>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div> -->
                                                <label class="col-sm-4 col-form-label" for="tab2">Tab 2 content <span style="color:red;">*</span> :</label>

                                                <div class="col-sm-8">
                                                    <select id="tab2" class="form-control tab-content" name="tab2" onchange="checkOpt(this.id);">
                                                        <option value="" disabled selected>Select your option</option>
                                                        <option value="1">Home Page</option>
                                                        <option value="2">Chats & Groups</option>
                                                        <option value="3">Content Posting</option>
                                                        <option value="4">Settings & User Profile</option>
                                                        <option value="0">Unused</option>
                                                    </select>
                                                </div>
                                                <!-- <label class="col-sm-2 col-form-label" for="tab2_icon">Chats & Groups icon :</label> -->

                                                <div class="col-sm-4 d-none">
                                                    <input type="file" id="tab2_icon" class="form-control" name="tab2_icon" onchange="loadFile2(event)">
                                                    <input type="file" id="tab6_icon" class="form-control" name="tab6_icon" onchange="loadFile18(event)">
                                                </div>
                                            </div>

                                            <div class="row mt-3 d-none" id="tab2_url_row">
                                                <!-- <label class="col-sm-4 col-form-label" for="tab2_url">Home page URL :</label>

                                                <div class="col-sm-8">
                                                    <input type="text" id="tab2_url" placeholder="www.example.com" class="form-control mb-1" name="tab2_url">
                                                </div> -->
                                            </div>
                                            <div class="row mt-3">
                                                <!-- <div class="col-sm-1">
                                                <label class="genapkcheckbox d-flex align-items-center" for="tab3-active">
                                                    <input type="checkbox" id="tab3-active" name="tab3_active" value="1" checked>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div> -->
                                                <label class="col-sm-4 col-form-label" for="tab3">Tab 3 content <span style="color:red;">*</span> :</label>

                                                <div class="col-sm-8">
                                                    <select id="tab3" class="form-control tab-content" name="tab3" onchange="checkOpt(this.id);">
                                                        <option value="" disabled selected>Select your option</option>
                                                        <option value="1">Home Page</option>
                                                        <option value="2">Chats & Groups</option>
                                                        <option value="3">Content Posting</option>
                                                        <option value="4">Settings & User Profile</option>
                                                        <option value="0">Unused</option>
                                                    </select>
                                                </div>
                                                <!-- <label class="col-sm-2 col-form-label" for="tab3_icon">Content Posting icon :</label> -->

                                                <div class="col-sm-4 d-none">
                                                    <input type="file" id="tab3_icon" class="form-control" name="tab3_icon" onchange="loadFile3(event)">
                                                    <input type="file" id="tab7_icon" class="form-control" name="tab7_icon" onchange="loadFile19(event)">
                                                </div>
                                            </div>

                                            <div class="row mt-3 d-none" id="tab3_url_row">
                                                <!-- <label class="col-sm-4 col-form-label" for="tab3_url">Home page URL :</label>

                                                <div class="col-sm-8">
                                                    <input type="text" id="tab3_url" placeholder="www.example.com" class="form-control mb-1" name="tab3_url">
                                                </div> -->
                                            </div>
                                            <div class="row mt-3">
                                                <!-- <div class="col-sm-1">
                                                <label class="genapkcheckbox d-flex align-items-center" for="tab4-active">
                                                    <input type="checkbox" id="tab4-active" name="tab4_active" value="1" checked>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div> -->
                                                <label class="col-sm-4 col-form-label" for="tab4">Tab 4 content <span style="color:red;">*</span> :</label>

                                                <div class="col-sm-8">
                                                    <select id="tab4" class="form-control tab-content" name="tab4" onchange="checkOpt(this.id);">
                                                        <option value="" disabled selected>Select your option</option>
                                                        <option value="1">Home Page</option>
                                                        <option value="2">Chats & Groups</option>
                                                        <option value="3">Content Posting</option>
                                                        <option value="4">Settings & User Profile</option>
                                                        <option value="0">Unused</option>
                                                    </select>
                                                </div>
                                                <!-- <label class="col-sm-2 col-form-label" for="tab4_icon">Settings & User Profile icon :</label> -->

                                                <div class="col-sm-4 d-none">
                                                    <input type="file" id="tab4_icon" class="form-control" name="tab4_icon" onchange="loadFile4(event)">
                                                    <input type="file" id="tab8_icon" class="form-control" name="tab8_icon" onchange="loadFile20(event)">
                                                </div>
                                            </div>
                                            <div class="row mt-3 d-none" id="tab4_url_row">
                                                <!-- <label class="col-sm-4 col-form-label" for="tab4_url">Home page URL :</label>

                                                <div class="col-sm-8">
                                                    <input type="text" id="tab4_url" placeholder="www.example.com" class="form-control mb-1" name="tab4_url">
                                                </div> -->
                                            </div>
                                            <div class="row mt-5">
                                                <div class="col-md-12">
                                                    <p style="font-size:.85rem;">
                                                        Select the view layout for Home Page.
                                                    </p>
                                                </div>
                                            </div>
                                            <!-- <div class="row">
                                                <label class="col-sm-4 col-form-label" for="content-tab-layout">Content layout :</label>

                                                <div class="col-sm-8">
                                                    <select class="form-control" name="content_tab_layout" id="content-tab-layout">
                                                        <option value="0" selected>Rows only</option>
                                                        <option value="1">Grid</option>
                                                    </select>
                                                </div>
                                            </div> -->
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
                                        </div>
                                        <div class="row">
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
                                        </div> -->
                                            <!-- <div class="row">
                                                <label class="col-sm-4 col-form-label" for="cpaas_icon">CPaaS Icon :</label> -->

                                            <div class="col-sm-8 d-none">
                                                <input type="file" id="cpaas_icon" class="form-control" name="cpaas_icon" onchange="loadFile5(event)">
                                                <input type="file" id="cpaas_icon2" class="form-control" name="cpaas_icon2" onchange="loadFile11(event)">
                                            </div>
                                            <!-- </div> -->
                                            <div class="row mt-4">
                                                <label class="col-sm-4 col-form-label" for="app_font">Font :</label>

                                                <div class="col-sm-8">
                                                    <!-- <input type="file" id="tab3_icon" class="form-control" name="tab3_icon"> -->
                                                    <select class="form-control" name="app_font">
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

                                                <div class="row mt-3" id="small-prev-slot" style="pointer-events: none; -webkit-user-select: none; -khtml-user-select: none; -moz-user-select: none; -o-user-select: none; user-select: none">
                                                    <!-- FOR SMALL BACKGROUND PREV APPEND FROM JS -->
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
                                                <label class="col-sm-4 col-form-label" for="ver_name">Version name <span style="color:red;">*</span> :</label>

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
                                                <p style="font-size: 20px; margin-top: 30px" class="text-center"><b>CPaaS</b> in app Preview</p>
                                                <p style="font-size: 16px" class="text-center">Change <b>CPaaS</b> model in Access Model option.</p>
                                                <img src="assets/note-5.webp" style="width: 100%; height: auto; pointer-events: none; -webkit-user-select: none; -khtml-user-select: none; -moz-user-select: none; -o-user-select: none; user-select: none" alt="">
                                                <img id="phone-bg" src="" style="position: absolute; width: 232px; height: 366px; margin-left: -315px; margin-top: 81px; pointer-events: none; -webkit-user-select: none; -khtml-user-select: none; -moz-user-select: none; -o-user-select: none; user-select: none" alt="">

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
                                                            <img id="image-preview-1" class="image-preview" src="" width="30" height="30" />
                                                        </div>
                                                    </label>
                                                    <label for="tab2_icon" style="display: contents">
                                                        <div id="big-icon-2" class="col-2 d-flex justify-content-center smile-icon pt-2" style="width: 60px; height: 45px; z-index: 1000">
                                                            <span id="plus-2" style="margin-top: -5px; font-size: 25px">+</span>
                                                            <img id="image-preview-2" class="image-preview" src="" width="30" height="30" />
                                                        </div>
                                                    </label>

                                                    <div class="col-4 d-flex justify-content-center">
                                                        <div id="main-center" class="d-flex justify-content-center justify-align-center align-self-center" style="width: 60px; height: 60px; background-color: grey; margin-top: -30px; border-radius: 50%">
                                                            <div class="row gx-0 d-flex justify-content-center">
                                                                <div class="small-icon gx-0 justify-content-center" style="width: 260px; height: 80px; position: absolute; margin-top: -30px">
                                                                    <label for="fb3_icon" style="display: contents">
                                                                        <div id="small-icon-1" class="small-icon-1 d-flex justify-content-center" style="position: absolute; margin-top: -80px; background-color: #d7d7d7; border-radius: 50%; width: 40px; height: 40px; margin-left: 110px">
                                                                            <span id="plus-6" style="margin-top: 10px; font-size: 15px">+</span>
                                                                            <img id="image-preview-6" class="image-preview" src="" style="margin-top: 10px" width="20px" height="20px" />
                                                                        </div>
                                                                    </label>
                                                                    <label for="fb5_icon" style="display: contents">
                                                                        <div id="small-icon-2" class="small-icon-2 d-flex justify-content-center" style="position: absolute; margin-top: -25px; margin-left: 180px; background-color: #d7d7d7; border-radius: 50%; width: 40px; height: 40px">
                                                                            <span id="plus-7" style="margin-top: 10px; font-size: 15px">+</span>
                                                                            <img id="image-preview-7" class="image-preview" src="" style="margin-top: 10px" width="20px" height="20px" />
                                                                        </div>
                                                                    </label>
                                                                    <label for="fb4_icon" style="display: contents">
                                                                        <div id="small-icon-3" class="small-icon-3 d-flex justify-content-center" style="position: absolute; margin-top: -65px; margin-left: 150px; background-color: #d7d7d7; border-radius: 50%; width: 40px; height: 40px">
                                                                            <span id="plus-8" style="margin-top: 10px; font-size: 15px">+</span>
                                                                            <img id="image-preview-8" class="image-preview" src="" style="margin-top: 10px" width="20px" height="20px" />
                                                                        </div>
                                                                    </label>
                                                                    <label for="fb2_icon" style="display: contents">
                                                                        <div id="small-icon-4" class="small-icon-4 d-flex justify-content-center" style="position: absolute; margin-top: -65px; margin-left: 70px; background-color: #d7d7d7; border-radius: 50%; width: 40px; height: 40px">
                                                                            <span id="plus-9" style="margin-top: 10px; font-size: 15px">+</span>
                                                                            <img id="image-preview-9" class="image-preview" src="" style="margin-top: 10px" width="20px" height="20px" />
                                                                        </div>
                                                                    </label>
                                                                    <label for="fb1_icon" style="display: contents">
                                                                        <div id="small-icon-5" class="small-icon-5 d-flex justify-content-center" style="position: absolute; margin-top: -25px; margin-left: 40px; background-color: #d7d7d7; border-radius: 50%; width: 40px; height: 40px">
                                                                            <span id="plus-10" style="margin-top: 10px; font-size: 15px">+</span>
                                                                            <img id="image-preview-10" class="image-preview" src="" style="margin-top: 10px" width="20px" height="20px" />
                                                                        </div>
                                                                    </label>
                                                                </div>
                                                                <label for="cpaas_icon" style="display: contents">
                                                                    <div id="big-icon-5" style="z-index: 1000">
                                                                        <div id="plus-5" style="padding-top: 12px; font-size: 25px">+</div>
                                                                        <img id="image-preview-5" class="image-preview" src="" width="60" height="60" />
                                                                    </div>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <label for="tab3_icon" style="display: contents;">
                                                        <div id="big-icon-3" class="col-2 d-flex justify-content-center home-icon pt-2" style="width: 60px; height: 45px; border-right: 1px solid grey; z-index: 1000">
                                                            <span id="plus-3" style="margin-top: -5px; font-size: 25px">+</span>
                                                            <img id="image-preview-3" class="image-preview" src="" width="30" height="30" />
                                                        </div>
                                                    </label>
                                                    <label for="tab4_icon" style="display: contents; z-index: 1000">
                                                        <div id="big-icon-4" class="col-2 d-flex justify-content-center settings-icon pt-2" style="width: 60px; height: 45px">
                                                            <span id="plus-4" style="margin-top: -5px; font-size: 25px">+</span>
                                                            <img id="image-preview-4" class="image-preview" src="" width="30" height="30" />
                                                        </div>
                                                    </label>
                                                </div>
                                                <!-- END DOCKED AREA -->

                                                <!-- START DOCKED AREA 2 -->
                                                <div class="docked-content-2 row gx-0" style="position: absolute; margin-top: -119px; margin-left: 85px; background-color: #d7d7d7; width: 232px; height: 45px; z-index: 999">
                                                    <label for="tab5_icon" style="display: contents">
                                                        <div id="big-icon-6" class="col-3 d-flex justify-content-center msg-icon pt-2" style="width: 60px; height: 45px; border-right: 1px solid grey; z-index: 1000">
                                                            <span id="plus-17" style="margin-top: -5px; font-size: 25px">+</span>
                                                            <img id="image-preview-17" class="image-preview" src="" width="30" height="30" />
                                                        </div>
                                                    </label>
                                                    <label for="tab6_icon" style="display: contents">
                                                        <div id="big-icon-7" class="col-3 d-flex justify-content-center smile-icon pt-2" style="width: 60px; height: 45px; border-right: 1px solid grey; z-index: 1000">
                                                            <span id="plus-18" style="margin-top: -5px; font-size: 25px">+</span>
                                                            <img id="image-preview-18" class="image-preview" src="" width="30" height="30" />
                                                        </div>
                                                    </label>
                                                    <label for="tab7_icon" style="display: contents;">
                                                        <div id="big-icon-8" class="col-3 d-flex justify-content-center home-icon pt-2" style="width: 60px; height: 45px; border-right: 1px solid grey; z-index: 1000">
                                                            <span id="plus-19" style="margin-top: -5px; font-size: 25px">+</span>
                                                            <img id="image-preview-19" class="image-preview" src="" width="30" height="30" />
                                                        </div>
                                                    </label>
                                                    <label for="tab8_icon" style="display: contents; z-index: 1000">
                                                        <div id="big-icon-9" class="col-3 d-flex justify-content-center settings-icon pt-2" style="width: 60px; height: 45px">
                                                            <span id="plus-20" style="margin-top: -5px; font-size: 25px">+</span>
                                                            <img id="image-preview-20" class="image-preview" src="" width="30" height="30" />
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
                                                                <img id="image-preview-12" class="image-preview" src="" style="margin-top: 10px" width="20px" height="20px" />
                                                            </div>
                                                        </label>
                                                        <!-- HIDDEN POST ON FLOATING BUTTON -->
                                                        <label for="fb10_icon" style="display: contents" class="d-none">
                                                            <div id="small-icon-7" class="small-icon-2 d-flex justify-content-center" style="position: absolute; margin-top: 55px; margin-left: 110px; background-color: #d7d7d7; border-radius: 50%; width: 40px; height: 40px">
                                                                <span id="plus-13" style="margin-top: 10px; font-size: 15px">+</span>
                                                                <img id="image-preview-13" class="image-preview" src="" style="margin-top: 10px" width="20px" height="20px" />
                                                            </div>
                                                        </label>
                                                        <label for="fb9_icon" style="display: contents">
                                                            <div id="small-icon-8" class="small-icon-3 d-flex justify-content-center" style="position: absolute; margin-top: -35px; margin-left: 110px; background-color: #d7d7d7; border-radius: 50%; width: 40px; height: 40px">
                                                                <span id="plus-14" style="margin-top: 10px; font-size: 15px">+</span>
                                                                <img id="image-preview-14" class="image-preview" src="" style="margin-top: 10px" width="20px" height="20px" />
                                                            </div>
                                                        </label>
                                                        <label for="fb7_icon" style="display: contents">
                                                            <div id="small-icon-9" class="small-icon-4 d-flex justify-content-center" style="position: absolute; margin-top: 10px; margin-left: 110px; background-color: #d7d7d7; border-radius: 50%; width: 40px; height: 40px">
                                                                <span id="plus-15" style="margin-top: 10px; font-size: 15px">+</span>
                                                                <img id="image-preview-15" class="image-preview" src="" style="margin-top: 10px" width="20px" height="20px" />
                                                            </div>
                                                        </label>
                                                        <label for="fb11_icon" style="display: contents">
                                                            <div id="small-icon-10" class="small-icon-5 d-flex justify-content-center" style="position: absolute; margin-top: 55px; margin-left: 110px; background-color: #d7d7d7; border-radius: 50%; width: 40px; height: 40px">
                                                                <span id="plus-16" style="margin-top: 10px; font-size: 15px">+</span>
                                                                <img id="image-preview-16" class="image-preview" src="" style="margin-top: 10px" width="20px" height="20px" />
                                                            </div>
                                                        </label>
                                                    </div>
                                                    <label for="cpaas_icon2" style="display: contents">
                                                        <div id="floating-button" style="z-index: 1000; background-color: grey; width: 60px; height: 60px; border-radius: 50%; text-align: center; margin-top: -285px; margin-left: 240px; position: absolute">
                                                            <div id="plus-11" style="padding-top: 12px; font-size: 25px">+</div>
                                                            <img id="image-preview-11" class="image-preview" src="" width="60" height="60" />
                                                        </div>
                                                    </label>
                                                </div>

                                                <!-- END FLOATING AREA -->
                                                <p class="text-center mt-3">Click "<b>+</b>" to insert new Icon.</p>
                                                <p class="text-center"><b>Drag</b> and <b>Drop</b> Icon to set Icon Position</p>
                                                <!-- <p class="text-center"><b>Drop</b> Icon outside the phone to delete Icon.</p> -->

                                                <div id="sub-floating-button">
                                                    <div class="contact-center gx-0 d-flex justify-content-center">
                                                        <p style="z-index: 1000">Contact Center</p>
                                                    </div>
                                                    <div class="message gx-0 d-flex justify-content-center">
                                                        <p style="z-index: 1000">Message</p>
                                                    </div>
                                                    <div class="call gx-0 d-flex justify-content-center">
                                                        <p style="z-index: 1000">Call</p>
                                                    </div>
                                                    <!-- <div class="new-post gx-0 d-flex justify-content-center">
                                                        <p>New Post</p>
                                                    </div> -->
                                                    <div class="live-streaming gx-0 d-flex justify-content-center">
                                                        <p style="z-index: 1000">Live Streaming</p>
                                                    </div>
                                                </div>

                                                <div id="sub-floating-button-2" style="z-index: 100">
                                                    <div class="home-2 gx-0 d-flex justify-content-center">
                                                        <p style="z-index: 1000">Home</p>
                                                    </div>
                                                    <div class="chats-2 gx-0 d-flex justify-content-center">
                                                        <p style="z-index: 1000">Chats</p>
                                                    </div>
                                                    <div class="contents-2 gx-0 d-flex justify-content-center">
                                                        <p style="z-index: 1000">Content</p>
                                                    </div>
                                                    <div class="settings-2 gx-0 d-flex justify-content-center">
                                                        <p style="z-index: 1000">Settings</p>
                                                    </div>
                                                </div>

                                                <div id="sub-docked-button">
                                                    <div class="contact-center-2 gx-0 d-flex justify-content-center">
                                                        <p style="z-index: 1000">Message</p>
                                                    </div>
                                                    <div class="message-2 gx-0 d-flex justify-content-center">
                                                        <p style="z-index: 1000">Call</p>
                                                    </div>
                                                    <div class="call-2 gx-0 d-flex justify-content-center">
                                                        <p style="z-index: 1000">Contact Center</p>
                                                    </div>
                                                    <div class="new-post-2 gx-0 d-flex justify-content-center">
                                                        <p style="z-index: 1000">Post</p>
                                                    </div>
                                                    <div class="live-streaming-2 gx-0 d-flex justify-content-center">
                                                        <p style="z-index: 1000">Live Streaming</p>
                                                    </div>
                                                </div>

                                                <div id="sub-docked-button-2">
                                                    <div class="home gx-0 d-flex justify-content-center">
                                                        <p style="z-index: 1000">Home</p>
                                                    </div>
                                                    <div class="chats gx-0 d-flex justify-content-center">
                                                        <p style="z-index: 1000">Chats</p>
                                                    </div>
                                                    <div class="contents gx-0 d-flex justify-content-center">
                                                        <p style="z-index: 1000">Content</p>
                                                    </div>
                                                    <div class="settings gx-0 d-flex justify-content-center">
                                                        <p style="z-index: 1000">Settings</p>
                                                    </div>
                                                </div>

                                                <div id="sub-burger-button">
                                                    <div class="home-3 gx-0 d-flex justify-content-center">
                                                        <p style="z-index: 1000">Home</p>
                                                    </div>
                                                    <div class="chats-3 gx-0 d-flex justify-content-center">
                                                        <p style="z-index: 1000">Chats</p>
                                                    </div>
                                                    <div class="contents-3 gx-0 d-flex justify-content-center">
                                                        <p style="z-index: 1000">Content</p>
                                                    </div>
                                                    <div class="settings-3 gx-0 d-flex justify-content-center">
                                                        <p style="z-index: 1000">Settings</p>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <!-- END PHONE SIMULATOR -->
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card" id="choose-certificate-details">
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

                        <div class="card" id="edit-tabs">
                            <div class="card-body">
                                <div class="row">
                                    <!-- <div class="col-sm-1">
                                            <label class="genapkcheckbox d-flex align-items-center" for="tab1-active">
                                                <input type="checkbox" id="tab1-active" name="tab1_active" value="1" checked>
                                                <span class="checkmark"></span>
                                            </label>
                                        </div> -->

                                    <label class="col-sm-2 col-form-label" for="tab1_edit">Tab 1 content :</label>

                                    <div class="col-sm-5">
                                        <select id="tab1_edit" class="form-control tab-content" name="tab1_edit" onchange="checkOptEdit(this.id);">
                                            <option value="" disabled selected>Select your option</option>
                                            <option value="1">Home Page</option>
                                            <option value="2">Chats & Groups</option>
                                            <option value="3">Content Posting</option>
                                            <option value="4">Settings & User Profile</option>
                                            <option value="0">Unused</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-3 d-none" id="tab1_edit_url_row">

                                </div>
                                <div class="row mt-3">
                                    <!-- <div class="col-sm-1">
                                            <label class="genapkcheckbox d-flex align-items-center" for="tab2-active">
                                                <input type="checkbox" id="tab2-active" name="tab2_active" value="1" checked>
                                                <span class="checkmark"></span>
                                            </label>
                                        </div> -->
                                    <label class="col-sm-2 col-form-label" for="tab2_edit">Tab 2 content :</label>

                                    <div class="col-sm-5">
                                        <select id="tab2_edit" class="form-control tab-content" name="tab2_edit" onchange="checkOptEdit(this.id);">
                                            <option value="" disabled selected>Select your option</option>
                                            <option value="1">Home Page</option>
                                            <option value="2">Chats & Groups</option>
                                            <option value="3">Content Posting</option>
                                            <option value="4">Settings & User Profile</option>
                                            <option value="0">Unused</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-3 d-none" id="tab2_edit_url_row">

                                </div>
                                <div class="row mt-3">
                                    <!-- <div class="col-sm-1">
                                            <label class="genapkcheckbox d-flex align-items-center" for="tab3-active">
                                                <input type="checkbox" id="tab3-active" name="tab3_active" value="1" checked>
                                                <span class="checkmark"></span>
                                            </label>
                                        </div> -->
                                    <label class="col-sm-2 col-form-label" for="tab3_edit">Tab 3 content :</label>

                                    <div class="col-sm-5">
                                        <select id="tab3_edit" class="form-control tab-content" name="tab3_edit" onchange="checkOptEdit(this.id);">
                                            <option value="" disabled selected>Select your option</option>
                                            <option value="1">Home Page</option>
                                            <option value="2">Chats & Groups</option>
                                            <option value="3">Content Posting</option>
                                            <option value="4">Settings & User Profile</option>
                                            <option value="0">Unused</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-3 d-none" id="tab3_edit_url_row">

                                </div>
                                <div class="row mt-3">
                                    <!-- <div class="col-sm-1">
                                            <label class="genapkcheckbox d-flex align-items-center" for="tab4-active">
                                                <input type="checkbox" id="tab4-active" name="tab4_active" value="1" checked>
                                                <span class="checkmark"></span>
                                            </label>
                                        </div> -->
                                    <label class="col-sm-2 col-form-label" for="tab4_edit">Tab 4 content :</label>

                                    <div class="col-sm-5">
                                        <select id="tab4_edit" class="form-control tab-content" name="tab4_edit" onchange="checkOptEdit(this.id);">
                                            <option value="" disabled selected>Select your option</option>
                                            <option value="1">Home Page</option>
                                            <option value="2">Chats & Groups</option>
                                            <option value="3">Content Posting</option>
                                            <option value="4">Settings & User Profile</option>
                                            <option value="0">Unused</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-3 d-none" id="tab4_edit_url_row">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4 d-flex justify-content-end">
                    <div class="col-md-12 text-center">
                        <button class="btn mt-2 mb-5 btn-yellow" type="button" id="submit-form" onclick="sendData()">
                            SUBMIT
                        </button>
                    </div>
            </form>
        </div>
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
    var ver_code = <?= $ver_code ?>;
</script>

<script src="js/webappform.js?<?php echo $version; ?>"></script>