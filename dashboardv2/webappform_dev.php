<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/dashboardv2/dashboard_header.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/url_function.php'); ?>
<?php //include_once($_SERVER['DOCUMENT_ROOT'] . '/db_conn.php'); 
?>

<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

// state control
$_SESSION['previous_page'] = $_SESSION['current_page'];
$_SESSION['current_page'] = 14;
require_once($_SERVER['DOCUMENT_ROOT'] . '/state_control.php');

$session_company = $_SESSION['id_company'];

$dbConnPalio = dbConnPalioLite();

$query_one = $dbconn->prepare("SELECT wf.COMPANY_NAME, wf.APP_ID, wf.TAB1, wf.TAB2, wf.TAB3, wf.TAB4, wf.ENABLE_SMS, wf.ENABLE_OSINT, wf.ENABLE_SCAN, wf.ENABLE_EMAIL, wf.APP_BG, wf.CPAAS_ICON, wf.TAB1_ICON, wf.TAB2_ICON, wf.TAB3_ICON, wf.TAB4_ICON, wf.FBUTTON1, wf.FBUTTON2, wf.FBUTTON3, wf.FBUTTON4, wf.FBUTTON5, wf.ACCESS_MODEL, wf.FONT, wf.VERSION_NAME, wf.WEB_URL, wf.VERSION_CODE FROM WEBFORM wf WHERE wf.COMPANY_ID = " . $session_company . "
ORDER BY CREATED_AT DESC LIMIT 1");
$query_one->execute();
$query_one_result = $query_one->get_result()->fetch_assoc();
$query_one->close();

$query_two = $dbConnPalio->prepare("SELECT * FROM ACCESS_CATEGORY");
$query_two->execute();
$user_access = $query_two->get_result();
$query_two->close();

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
        border-radius: 5px;
    }

    .checkmark-small {
        position: absolute;
        top: 0;
        left: 0;
        height: 20px;
        width: 20px;
        border: .5px solid black;
        background-color: white;
        border-radius: 5px;
    }

    /* On mouse-over, add a grey background color */
    .genapkcheckbox:hover input~.checkmark,
    .genapkcheckbox:hover input~.checkmark-small {
        background-color: #1799ad;
    }

    /* When the checkbox is checked, add a blue background */
    .genapkcheckbox input:checked~.checkmark,
    .genapkcheckbox input:checked~.checkmark-small {
        background-color: #1799ad;
    }

    /* Create the checkmark/indicator (hidden when not checked) */
    .checkmark:after,
    .checkmark-small:after {
        content: "";
        position: absolute;
        display: none;
    }

    /* Show the checkmark when checked */
    .genapkcheckbox input:checked~.checkmark:after,
    .genapkcheckbox input:checked~.checkmark-small:after {
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

    .genapkcheckbox .checkmark-small:after {
        left: 6px;
        top: 3px;
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
        background: #1799ad;
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
        margin-top: 110px;
        font-family: "Poppins", sans-serif;
        font-size: 10px;
        color: grey;
        text-align: center;
    }

    .home-3 {
        width: 50px;
        margin-left: 89px;
        margin-top: -235px;
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
        #outside-text {
            font-size: 24px;
        }
    }

    @media screen and (max-width:1590px) {
        #outside-text {
            font-size: 18px;
        }
    }

    @media screen and (min-width:768px) {
        #phone-simulator {
            padding-left: 50px;
        }
    }

    @media screen and (max-width:768px) {
        #phone-simulator {
            margin-left: -45px;
        }
    }

    @media screen and (min-width:1800px) {
        #phone-simulator {
            padding-left: 150px;
        }
    }

    @media screen and (max-width:415px) {

        #cpaas-model-text {
            font-size: 12px;
        }

        #cpaas-model-text {
            font-size: 12px;
        }

        #drag-drop-text {
            font-size: 12px;
        }

        #drag-drop-text {
            font-size: 12px;
        }
    }


    @media screen and (min-width:415px) {

        #cpaas-model-text {
            font-size: 16px;
        }

        #cpaas-model-text {
            font-size: 16px;
        }

        #drag-drop-text {
            font-size: 16px;
        }

        #drag-drop-text {
            font-size: 16px;
        }
    }

    html,
    body {
        max-width: 100%;
        overflow-x: hidden;
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
                            <h4 class="card-name" data-translate="dashform-1">WebApp Form</h4>
                            <div class="card-body">
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <h6><strong data-translate="dashform-2">NEXILIS FLOATING BUTTON</strong></h6>
                                        <p data-translate="dashform-3">To embed nexilis Floating Button to your website, please register your website address in the form below first.<br>
                                            <!-- <span>Note: No protocol (<strong>http://</strong> or <strong>https://</strong>) needed</span> -->
                                        </p>
                                        <input type="textarea" id="companyWebsite" class="form-control mb-3" name="company-website" placeholder="Website URL" required value="<?php echo $webURL; ?>">

                                        <p data-translate="dashform-4">Once you have registered your website, add the following line to the <strong>&lt;head&gt;</strong> section of any web page you want to embed the floating button to.</p>

                                        <pre class="prettyprint linenums:1 mt-2 mb-4" style="color:lightgray;">
&lt;script src="https://newuniverse.io/palio_button/embeddedbutton.js"&gt;&lt;/script&gt;</pre>

                                        <p data-translate="dashform-5">Example:</p>

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
                                        <label class="genapkcheckbox" for="generate-apk"> <span data-translate="dashform-6">I want to generate apk</span>
                                            <input type="checkbox" id="generate-apk" name="generate-apk" value="1">
                                            <span class="checkmark"></span>
                                        </label><br>
                                        <label class="genapkcheckbox" for="edit-apk"> <span data-translate="dashform-7">I want to edit apk</span>
                                            <input type="checkbox" id="edit-apk" name="edit_apk" value="1">
                                            <span class="checkmark"></span>
                                        </label><br>
                                    </div>
                                </div>

                                <div id="generate-apk-form">
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <p style="font-size:.85rem;" data-translate="dashform-8">Please make sure you have uploaded a company logo at the dashboard's <a href="/dashboardv2/index">main page</a>.</p>
                                        </div>
                                    </div>

                                    <div class="row mb-5">
                                        <div class="col-sm-12 col-md-6 left">
                                            <label for="companyName" data-translate="dashform-9">Your company name <span style="color:red;">*</span> :</label>
                                            <input type="textarea" id="companyName" class="form-control" name="company-name" placeholder="Company Name" value="<?php if ($query_one_result['COMPANY_NAME'] != "") : echo $query_one_result['COMPANY_NAME'];
                                                                                                                                                                endif; ?>">
                                        </div>
                                        <div class="col-sm-12 col-md-6 right">
                                            <label for="appId" data-translate="dashform-10">Your app id <span style="color:red;">*</span> :</label>
                                            <input type="textarea" id="appId" class="form-control" name="app-id" placeholder="com.example" value="<?php if ($query_one_result['APP_ID'] != "") : echo $query_one_result['APP_ID'];
                                                                                                                                                    endif; ?>">
                                        </div>
                                    </div>

                                    <div class="row mt-5">
                                        <div class="col-md-12">
                                            <label class="genapkcheckbox" for="enable_category"> <span data-translate="dashform-11">Add content category</span>
                                                <input type="checkbox" id="enable_category" name="enable_category" value="1">
                                                <span class="checkmark"></span>
                                            </label>
                                            <p style="font-size:.85rem;" data-translate="dashform-12">Check this box if you want to add content categories for your app's content.</p>
                                        </div>
                                    </div>
                                    <div class="row d-none" id="content-categories">
                                        <div class="col-md-12">
                                            <button class="btn btn-yellow" type="button" id="add-category" style="font-size:14px;" data-translate="dashform-13">Add category</button>
                                            <div id="category_arr" class="mt-1">
                                                <div class="row category-row" id="category-row-0">
                                                    <div class="col-3">
                                                        <input type="text" id="category-0" class="category-name form-control mb-1" placeholder="Insert category name" name="category[]" style="display:inline-block;">
                                                        <!-- <button class="btn btn-yellow" type="button" id="deleteCategory-0" onclick="deleteCategory(0);" style="min-width:unset; background-color: red; margin:unset;">
                                                                    X
                                                                </button> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-3 d-none" id="save-category">
                                        <div class="col-md-12">
                                            <button class="btn btn-yellow" type="button" id="save-category-btn" style="font-size:14px;" data-translate="dashform-14">Save category</button>
                                            <p id="save-category-error" class="d-none" style="color:red;" data-translate="dashform-15">
                                                Failed to save category! Please make sure all fields are filled.
                                            </p>
                                            <p id="save-category-success" class="d-none" style="color:green;" data-translate="dashform-16">
                                                Category saved.
                                            </p>
                                        </div>
                                    </div>

                                    <h6 class="mt-5"><strong data-translate="dashform-17">APK Settings</strong></h6>

                                    <div class="row mt-3">
                                        <div class="col-md-12">
                                            <p style="font-size:.85rem;">
                                                <span data-translate="dashform-18">In this section you can change the content of tabs and change tab icons. Nexilis default tab icons will be used if you don't upload a custom icon.</span>
                                                <br>
                                                <span data-translate="dashform-19"><strong>Note:</strong> You can't select the same option for different tabs.</span>
                                            </p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <p id="outside-text" class="d-none" style="position:absolute; margin-top: 285px; margin-left: 30px" data-translate="dashform-20"><b>Drop & Drag</b> outside the phone to remove Icon.</p>
                                        <div class="col-12 col-md-6 left-side">
                                            <div class="row">
                                                <!-- <div class="col-sm-1">
                                                <label class="genapkcheckbox d-flex align-items-center" for="tab1-active">
                                                    <input type="checkbox" id="tab1-active" name="tab1_active" value="1" checked>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div> -->

                                                <label class="col-sm-4 col-form-label" for="tab1" data-translate="dashform-21">Tab 1 content <span style="color:red;">*</span> :</label>

                                                <div class="col-sm-8">
                                                    <select id="tab1" class="form-control tab-content" name="tab1" onchange="checkOpt(this.id);" required>
                                                        <option value="" disabled <?php if ($query_one_result['TAB1'] == "") : ?> selected <?php endif; ?> data-translate="dashform-22">Select your option</option>
                                                        <option value="1" <?php if ($query_one_result['TAB1'] == 1) : ?> selected <?php endif; ?>>Home Page</option>
                                                        <option value="2" <?php if ($query_one_result['TAB1'] == 2) : ?> selected <?php endif; ?>>Chats & Groups</option>
                                                        <option value="3" <?php if ($query_one_result['TAB1'] == 3) : ?> selected <?php endif; ?>>Content Posting</option>
                                                        <option value="4" <?php if ($query_one_result['TAB1'] == 4) : ?> selected <?php endif; ?>>Settings & User Profile</option>
                                                        <option value="5" <?php if ($query_one_result['TAB1'] == 5) : ?> selected <?php endif; ?>>Secure Folder</option>
                                                        <option value="6" <?php if ($query_one_result['TAB1'] == 6) : ?> selected <?php endif; ?>>Call Log</option>
                                                        <option value="0" data-translate="dashform-71">Unused</option>
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
                                            <div class="row mt-3 d-none" id="tab1-default-content">
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
                                                <label class="col-sm-4 col-form-label" for="tab2" data-translate="dashform-23">Tab 2 content <span style="color:red;">*</span> :</label>

                                                <div class="col-sm-8">
                                                    <select id="tab2" class="form-control tab-content" name="tab2" onchange="checkOpt(this.id);" required>
                                                        <option value="" disabled <?php if ($query_one_result['TAB2'] == "") : ?> selected <?php endif; ?> data-translate="dashform-22">Select your option</option>
                                                        <option value="1" <?php if ($query_one_result['TAB2'] == 1) : ?> selected <?php endif; ?>>Home Page</option>
                                                        <option value="2" <?php if ($query_one_result['TAB2'] == 2) : ?> selected <?php endif; ?>>Chats & Groups</option>
                                                        <option value="3" <?php if ($query_one_result['TAB2'] == 3) : ?> selected <?php endif; ?>>Content Posting</option>
                                                        <option value="4" <?php if ($query_one_result['TAB2'] == 4) : ?> selected <?php endif; ?>>Settings & User Profile</option>
                                                        <option value="5" <?php if ($query_one_result['TAB2'] == 5) : ?> selected <?php endif; ?>>Secure Folder</option>
                                                        <option value="6" <?php if ($query_one_result['TAB2'] == 6) : ?> selected <?php endif; ?>>Call Log</option>
                                                        <option value="0" data-translate="dashform-71">Unused</option>
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
                                            <div class="row mt-3 d-none" id="tab2-default-content">
                                                <!-- <label class="col-sm-4 col-form-label" for="tab1_url">Home page URL :</label>

                                                <div class="col-sm-8">
                                                    <input type="text" id="tab1_url" placeholder="www.example.com" class="form-control mb-1" name="tab1_url">
                                                </div> -->
                                            </div>
                                            <div class="row mt-3">
                                                <!-- <div class="col-sm-1">
                                                <label class="genapkcheckbox d-flex align-items-center" for="tab3-active">
                                                    <input type="checkbox" id="tab3-active" name="tab3_active" value="1" checked>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div> -->
                                                <label class="col-sm-4 col-form-label" for="tab3" data-translate="dashform-24">Tab 3 content <span style="color:red;">*</span> :</label>

                                                <div class="col-sm-8">
                                                    <select id="tab3" class="form-control tab-content" name="tab3" onchange="checkOpt(this.id);" required>
                                                        <option value="" disabled <?php if ($query_one_result['TAB3'] == "") : ?> selected <?php endif; ?> data-translate="dashform-22">Select your option</option>
                                                        <option value="1" <?php if ($query_one_result['TAB3'] == 1) : ?> selected <?php endif; ?>>Home Page</option>
                                                        <option value="2" <?php if ($query_one_result['TAB3'] == 2) : ?> selected <?php endif; ?>>Chats & Groups</option>
                                                        <option value="3" <?php if ($query_one_result['TAB3'] == 3) : ?> selected <?php endif; ?>>Content Posting</option>
                                                        <option value="4" <?php if ($query_one_result['TAB3'] == 4) : ?> selected <?php endif; ?>>Settings & User Profile</option>
                                                        <option value="5" <?php if ($query_one_result['TAB3'] == 5) : ?> selected <?php endif; ?>>Secure Folder</option>
                                                        <option value="6" <?php if ($query_one_result['TAB3'] == 6) : ?> selected <?php endif; ?>>Call Log</option>
                                                        <option value="0" data-translate="dashform-71">Unused</option>
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
                                            <div class="row mt-3 d-none" id="tab3-default-content">
                                                <!-- <label class="col-sm-4 col-form-label" for="tab1_url">Home page URL :</label>

                                                <div class="col-sm-8">
                                                    <input type="text" id="tab1_url" placeholder="www.example.com" class="form-control mb-1" name="tab1_url">
                                                </div> -->
                                            </div>
                                            <div class="row mt-3">
                                                <!-- <div class="col-sm-1">
                                                <label class="genapkcheckbox d-flex align-items-center" for="tab4-active">
                                                    <input type="checkbox" id="tab4-active" name="tab4_active" value="1" checked>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div> -->
                                                <label class="col-sm-4 col-form-label" for="tab4" data-translate="dashform-25">Tab 4 content <span style="color:red;">*</span> :</label>

                                                <div class="col-sm-8">
                                                    <select id="tab4" class="form-control tab-content" name="tab4" onchange="checkOpt(this.id);" required>
                                                        <option value="" disabled <?php if ($query_one_result['TAB4'] == "") : ?> selected <?php endif; ?> data-translate="dashform-22">Select your option</option>
                                                        <option value="1" <?php if ($query_one_result['TAB4'] == 1) : ?> selected <?php endif; ?>>Home Page</option>
                                                        <option value="2" <?php if ($query_one_result['TAB4'] == 2) : ?> selected <?php endif; ?>>Chats & Groups</option>
                                                        <option value="3" <?php if ($query_one_result['TAB4'] == 3) : ?> selected <?php endif; ?>>Content Posting</option>
                                                        <option value="4" <?php if ($query_one_result['TAB4'] == 4) : ?> selected <?php endif; ?>>Settings & User Profile</option>
                                                        <option value="5" <?php if ($query_one_result['TAB4'] == 5) : ?> selected <?php endif; ?>>Secure Folder</option>
                                                        <option value="6" <?php if ($query_one_result['TAB4'] == 6) : ?> selected <?php endif; ?>>Call Log</option>
                                                        <option value="0" data-translate="dashform-71">Unused</option>
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
                                            <div class="row mt-3 d-none" id="tab4-default-content">
                                                <!-- <label class="col-sm-4 col-form-label" for="tab1_url">Home page URL :</label>

                                                <div class="col-sm-8">
                                                    <input type="text" id="tab1_url" placeholder="www.example.com" class="form-control mb-1" name="tab1_url">
                                                </div> -->
                                            </div>
                                            <!-- <div class="row mt-5">
                                                <div class="col-md-12">
                                                    <p style="font-size:.85rem;" data-translate="dashform-26">
                                                        Select the view layout for Home Page.
                                                    </p>
                                                </div>
                                            </div> -->
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
                                                        <strong data-translate="dashform-27">Enable/Disable Features</strong>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label class="genapkcheckbox" for="enable_sms" style="font-size:.8rem;"> SMS
                                                        <input type="checkbox" id="enable_sms" name="enable_sms" value="1" <?php if ($query_one_result['ENABLE_SMS'] == 1) : ?> checked <?php endif; ?>>
                                                        <span class="checkmark-small"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label class="genapkcheckbox" for="enable_osint" style="font-size:.8rem;"> OSINT Search
                                                        <input type="checkbox" id="enable_osint" name="enable_osint" value="1" <?php if ($query_one_result['ENABLE_OSINT'] == 1) : ?> checked <?php endif; ?>>
                                                        <span class="checkmark-small"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label class="genapkcheckbox" for="enable_scan" style="font-size:.8rem;"> ID Scan
                                                        <input type="checkbox" id="enable_scan" name="enable_scan" value="1" <?php if ($query_one_result['ENABLE_SCAN'] == 1) : ?> checked <?php endif; ?>>
                                                        <span class="checkmark-small"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label class="genapkcheckbox" for="enable_email" style="font-size:.8rem;"> Email
                                                        <input type="checkbox" id="enable_email" name="enable_email" value="1" <?php if ($query_one_result['ENABLE_EMAIL'] == 1) : ?> checked <?php endif; ?>>
                                                        <span class="checkmark-small"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label class="genapkcheckbox" for="enable_loc" style="font-size:.8rem;"> Location
                                                        <input type="checkbox" id="enable_loc" name="enable_loc" value="1">
                                                        <span class="checkmark-small"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="row mt-5">
                                                <div class="col-md-12">
                                                    <p style="font-size:.85rem;">
                                                        Choose your preferred look for Nexilis build UI.
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label class="col-sm-4 col-form-label" for="nx_im_theme">Messaging :</label>

                                                <div class="col-sm-8">
                                                    <!-- <input type="file" id="tab3_icon" class="form-control" name="tab3_icon"> -->
                                                    <select class="form-control" name="nx_im_theme" id="nx_im_theme">
                                                        <option value="0" selected>Standard</option>
                                                        <option value="1">Bubble</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <label class="col-sm-4 col-form-label" for="nx_ac_theme">Audio Call :</label>

                                                <div class="col-sm-8">
                                                    <!-- <input type="file" id="tab3_icon" class="form-control" name="tab3_icon"> -->
                                                    <select class="form-control" name="nx_ac_theme" id="nx_ac_theme">
                                                        <option value="0" selected>Standard</option>
                                                        <option value="1">Bubble</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <label class="col-sm-4 col-form-label" for="nx_sm_theme">Seminar :</label>

                                                <div class="col-sm-8">
                                                    <!-- <input type="file" id="tab3_icon" class="form-control" name="tab3_icon"> -->
                                                    <select class="form-control" name="nx_sm_theme" id="nx_sm_theme">
                                                        <option value="0" selected>Standard</option>
                                                        <option value="1">Bubble</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <label class="col-sm-4 col-form-label" for="nx_ls_theme">Live Streaming :</label>

                                                <div class="col-sm-8">
                                                    <!-- <input type="file" id="tab3_icon" class="form-control" name="tab3_icon"> -->
                                                    <select class="form-control" name="nx_ls_theme" id="nx_ls_theme">
                                                        <option value="0" selected>Standard</option>
                                                        <option value="1">Bubble</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <label class="col-sm-4 col-form-label" for="nx_vc_theme">Video Call :</label>

                                                <div class="col-sm-8">
                                                    <!-- <input type="file" id="tab3_icon" class="form-control" name="tab3_icon"> -->
                                                    <select class="form-control" name="nx_vc_theme" id="nx_vc_theme">
                                                        <option value="0" selected>Standard</option>
                                                        <option value="1">Bubble</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mt-5">
                                                <div class="col-md-12">
                                                    <p style="font-size:.85rem;" data-translate="dashform-32">
                                                        <strong>Access model</strong> setting allows you to change how you can access CPaaS features.
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label class="col-sm-4 col-form-label" for="access_model" data-translate="dashform-28">Access model :</label>

                                                <div class="col-sm-8">
                                                    <!-- <input type="file" id="tab3_icon" class="form-control" name="tab3_icon"> -->
                                                    <select class="form-control" name="access_model" onchange="selectTabMenu()" id="menuType">
                                                        <option value="0" <?php if ($query_one_result['ACCESS_MODEL'] == 0) : ?> selected <?php endif; ?>>Floating button</option>
                                                        <option value="1" <?php if ($query_one_result['ACCESS_MODEL'] == 1) : ?> selected <?php endif; ?>>Docked</option>
                                                        <option value="2" <?php if ($query_one_result['ACCESS_MODEL'] == 2) : ?> selected <?php endif; ?>>Hamburger Menu</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mt-3 align-items-center d-none" id="show_fb_options">

                                            </div>

                                            <div class="row mt-3 align-items-center" id="fb_pp_options">
                                                <label class="col-sm-4 col-form-label" for="access_model" data-translate="dashform-29">Use Floating Button image as Profile Pict. :</label>

                                                <div class="col-sm-8">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="fb_pp" id="fb_pp1" value="1">
                                                        <label class="form-check-label" for="fb_pp1" data-translate="dashform-30">Yes</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="fb_pp" id="fb_pp0" value="0" checked>
                                                        <label class="form-check-label" for="fb_pp0" data-translate="dashform-31">No</label>
                                                    </div>
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
                                                <label class="col-sm-4 col-form-label" for="app_font" data-translate="dashform-33">Font :</label>

                                                <div class="col-sm-8">
                                                    <!-- <input type="file" id="tab3_icon" class="form-control" name="tab3_icon"> -->
                                                    <select class="form-control" name="app_font" id="app_font">
                                                        <option value="0" <?php if ($query_one_result['FONT'] == 0) : ?> selected <?php endif; ?>>Poppins</option>
                                                        <option value="1" <?php if ($query_one_result['FONT'] == 1) : ?> selected <?php endif; ?>>Roboto</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-md-12">
                                                    <p style="font-size:.85rem;" data-translate="dashform-34">
                                                        You can upload multiple backgrounds by selecting multiple files in the file explorer window and click "open".
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label class="col-sm-4 col-form-label" for="background" data-translate="dashform-35">Background wallpaper :</label>

                                                <div class="col-sm-8" id="section-background">
                                                    <div class="form-control">
                                                        <label for="background" class="btn" style="position: absolute">
                                                            <button data-translate="dashindex-35" style="border: 1px solid grey; margin-top: -8px; margin-left: -8px; pointer-events: none">Choose File</button>
                                                        </label>
                                                        <input id="no-chosen-bg" type="text" style="margin-top: -5px; padding-left: 130px; border: none; background-color:none; background-color: transparent !important" class="form-control border-70" readonly value="No file chosen.">
                                                        <input id="bg-upload-name" type="text" style="margin-top: -5px; padding-left: 130px; border: none; background-color:none; background-color: transparent !important" class="form-control border-70 d-none" readonly>
                                                    </div>
                                                    <input type="file" id="background" class="form-control d-none" accept="image/*" name="background[]" multiple onchange="backgroundFile(event)">
                                                </div>

                                                <div class="col-sm-8 text-primary d-none mt-4 mb-4" id="old-bg-list"><?= $oldBG ?></div>

                                                <div class="row mt-3" id="small-prev-slot" style="pointer-events: none; -webkit-user-select: none; -khtml-user-select: none; -moz-user-select: none; -o-user-select: none; user-select: none">
                                                    <!-- FOR SMALL BACKGROUND PREV APPEND FROM JS -->
                                                </div>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-md-12">
                                                    <p style="font-size:.85rem;" data-translate="dashform-36">
                                                        You can upload a custom splash screen here (video/image), max 32MB.
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="check-existing-image mt-2 mb-4">

                                                <?php if (isset($oldBG)) : ?>
                                                    <div class="text-success"><b data-translate="dashform-37">Existing Background Image Found.</b></div>
                                                <?php endif; ?>

                                                <input type="hidden" id="old-bg-hidden" value="<?= $oldBG ?>">

                                            </div>

                                            <?php if (isset($oldBG)) : ?>
                                                <label class="genapkcheckbox mt-2 mb-5" for="use-old-bg"> <span data-translate="dashform-38">I want to use old background</span>
                                                    <input type="checkbox" id="use-old-bg" name="use-old-bg" value="1">
                                                    <span class="checkmark"></span>
                                                </label>
                                            <?php endif; ?>

                                            <div class="row">
                                                <label class="col-sm-4 col-form-label" for="splashscreen" data-translate="dashform-39">Splash screen :</label>

                                                <div class="col-sm-8">
                                                    <div class="form-control">
                                                        <label for="splashscreen" class="btn" style="position: absolute">
                                                            <button data-translate="dashindex-35" style="border: 1px solid grey; margin-top: -8px; margin-left: -8px; pointer-events: none">Choose File</button>
                                                        </label>
                                                        <input id="no-chosen-splash" type="text" style="margin-top: -5px; padding-left: 130px; border: none; background-color:none; background-color: transparent !important" class="form-control border-70" readonly value="No file chosen.">
                                                        <input id="splash-upload-name" type="text" style="margin-top: -5px; padding-left: 130px; border: none; background-color:none; background-color: transparent !important" class="form-control border-70 d-none" readonly>

                                                        <input type="file" id="splashscreen" class="form-control d-none" accept="image/*,video/*" name="splashscreen">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-5">
                                                <div class="col-md-12">
                                                    <p style="font-size:.85rem;" data-translate="dashform-40">
                                                        Input your desired version name here. For simplicity, please use an easily recognizable pattern such as <strong>1.0.0, 1.0.1, 1.0.2,</strong> etc.
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label class="col-sm-4 col-form-label" for="ver_name" data-translate="dashform-41">Version name <span style="color:red;">*</span> :</label>

                                                <div class="col-sm-8">
                                                    <input type="text" id="ver_name" class="form-control mb-1" name="ver_name" value="<?php if ($query_one_result['VERSION_NAME'] != "") : echo $query_one_result['VERSION_NAME'];
                                                                                                                                        endif; ?>" required>
                                                    <p id="ver_name_format" style="font-size:.85rem; color:red;" class="d-none">
                                                        Please use only alphabet, numbers and dots.
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="row mt-5">
                                                <div class="col-md-12">
                                                    <p style="font-size:.85rem;">
                                                        If you wish to include Google Firebase Cloud Messaging (FCM), check the following box below.
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="row d-none">
                                                <div class="col-md-12">
                                                    <label class="genapkcheckbox" for="include_hms" style="font-size:.8rem;"> Include HMS
                                                        <input type="checkbox" id="include_hms" name="include_hms" value="1">
                                                        <span class="checkmark-small"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="row d-none" id="huawei_json">

                                                <div class="col-sm-6">
                                                    <input type="file" id="huawei_pushkit" class="form-control mb-1" name="huawei_pushkit">
                                                    <p id="huawei_pushkit_validation" style="font-size:.85rem; color:red;" class="d-none">
                                                        Please make sure your JSON includes a matching package name or app id.
                                                    </p>
                                                </div>

                                                <div class="col-sm-6">
                                                    <input type="text" id="huawei_client_id" class="form-control mb-1" name="huawei_client_id" placeholder="App Gallery Client Secret">
                                                    <p style="font-size:12px;">
                                                        Please input your Huawei App Gallery OAuth 2.0 Client Secret as shown <a href="https://developer.huawei.com/consumer/en/doc/development/HMSCore-Guides/android-config-agc-0000001050170137#section125831926193110">here</a>.
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-md-12">
                                                    <label class="genapkcheckbox" for="include_gps" style="font-size:.8rem;"> Include FCM
                                                        <input type="checkbox" id="include_gps" name="include_gps" value="1" checked>
                                                        <span class="checkmark-small"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="row d-none" id="gps_json">

                                                <!-- <div class="col-sm-10">
                                                    <input type="file" id="gps_pushkit" class="form-control mb-1" name="gps_pushkit">
                                                    <p id="gps_pushkit_validation" style="font-size:.85rem; color:red;" class="d-none">
                                                        Please make sure your JSON includes a matching package name or app id.
                                                    </p>
                                                </div> -->
                                                <!-- <div class="col-sm-6">
                                                    <input type="text" id="gps_client_id" class="form-control mb-1" name="gps_client_id">
                                                    <p style="font-size:12px;">
                                                        Please input your Google Firebase Project ID.
                                                    </p>
                                                </div> -->
                                            </div>


                                        </div>
                                        <!-- START PHONE SIMULATOR -->
                                        <div class="col-xxl-2"></div>
                                        <div id="phone-simulator" class="col-12 col-md-6 col-xxl-4">
                                            <div style="width: 400px; height: 800px; margin-left: -10px">
                                                <p style="font-size: 20px; margin-top: 30px" class="text-center" data-translate="dashform-43"><b>CPaaS</b> in app Preview</p>
                                                <p id="cpaas-model-text" class="text-center" data-translate="dashform-44">Change <b>CPaaS</b> model in Access Model option.</p>
                                                <img src="assets/note-5.webp" style="width: 100%; height: auto; pointer-events: none; -webkit-user-select: none; -khtml-user-select: none; -moz-user-select: none; -o-user-select: none; user-select: none" alt="">
                                                <img id="phone-bg" <?php if ($query_one_result['APP_BG'] != "") : ?> src="/dashboardv2/uploads/background/<?= $query_one_result['APP_BG']; ?>" <?php else : ?> src="" <?php endif; ?> style="position: absolute; width: 232px; height: 366px; margin-left: -315px; margin-top: 81px; pointer-events: none; -webkit-user-select: none; -khtml-user-select: none; -moz-user-select: none; -o-user-select: none; user-select: none" alt="">

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
                                                            <?php
                                                            if ($query_one_result['TAB1_ICON'] != "") {
                                                            ?>
                                                                <img id="plus-1" width="30" height="30" src="/dashboardv2/uploads/tab_icon/<?= $query_one_result['TAB1_ICON']; ?>"></img>
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <span id="plus-1" style="margin-top: -5px; font-size: 25px">+</span>
                                                            <?php
                                                            }
                                                            ?>
                                                            <img id="image-preview-1" class="image-preview" src="" width="30" height="30" />
                                                        </div>
                                                    </label>
                                                    <label for="tab2_icon" style="display: contents">
                                                        <div id="big-icon-2" class="col-2 d-flex justify-content-center smile-icon pt-2" style="width: 60px; height: 45px; z-index: 1000">
                                                            <?php
                                                            if ($query_one_result['TAB2_ICON'] != "") {
                                                            ?>
                                                                <img id="plus-2" width="30" height="30" src="/dashboardv2/uploads/tab_icon/<?= $query_one_result['TAB2_ICON']; ?>"></img>
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <span id="plus-2" style="margin-top: -5px; font-size: 25px">+</span>
                                                            <?php
                                                            }
                                                            ?>
                                                            <img id="image-preview-2" class="image-preview" src="" width="30" height="30" />
                                                        </div>
                                                    </label>

                                                    <div class="col-4 d-flex justify-content-center">
                                                        <div id="main-center" class="d-flex justify-content-center justify-align-center align-self-center" style="width: 60px; height: 60px; background-color: grey; margin-top: -30px; border-radius: 50%">
                                                            <div class="row gx-0 d-flex justify-content-center">
                                                                <div class="small-icon gx-0 justify-content-center" style="width: 260px; height: 80px; position: absolute; margin-top: -30px">
                                                                    <label for="fb3_icon" style="display: contents">
                                                                        <div id="small-icon-1" class="small-icon-1 d-flex justify-content-center" style="position: absolute; margin-top: -80px; background-color: #d7d7d7; border-radius: 50%; width: 40px; height: 40px; margin-left: 110px">
                                                                            <?php
                                                                            if ($query_one_result['FBUTTON3'] != "") {
                                                                            ?>
                                                                                <img id="plus-6" style="margin-top: 10px" width="20" height="20" src="/dashboardv2/uploads/fb_icon/<?= $query_one_result['FBUTTON3']; ?>"></img>
                                                                            <?php
                                                                            } else {
                                                                            ?>
                                                                                <span id="plus-6" style="margin-top: 10px; font-size: 15px">+</span>
                                                                            <?php
                                                                            }
                                                                            ?>
                                                                            <img id="image-preview-6" class="image-preview" src="" style="margin-top: 10px" width="20px" height="20px" />
                                                                        </div>
                                                                    </label>
                                                                    <label for="fb5_icon" style="display: contents">
                                                                        <div id="small-icon-2" class="small-icon-2 d-flex justify-content-center" style="position: absolute; margin-top: -25px; margin-left: 180px; background-color: #d7d7d7; border-radius: 50%; width: 40px; height: 40px">
                                                                            <?php
                                                                            if ($query_one_result['FBUTTON5'] != "") {
                                                                            ?>
                                                                                <img id="plus-7" style="margin-top: 10px" width="20" height="20" src="/dashboardv2/uploads/fb_icon/<?= $query_one_result['FBUTTON5']; ?>"></img>
                                                                            <?php
                                                                            } else {
                                                                            ?>
                                                                                <span id="plus-7" style="margin-top: 10px; font-size: 15px">+</span>
                                                                            <?php
                                                                            }
                                                                            ?>
                                                                            <img id="image-preview-7" class="image-preview" src="" style="margin-top: 10px" width="20px" height="20px" />
                                                                        </div>
                                                                    </label>
                                                                    <label for="fb4_icon" style="display: contents">
                                                                        <div id="small-icon-3" class="small-icon-3 d-flex justify-content-center" style="position: absolute; margin-top: -65px; margin-left: 150px; background-color: #d7d7d7; border-radius: 50%; width: 40px; height: 40px">
                                                                            <?php
                                                                            if ($query_one_result['FBUTTON4'] != "") {
                                                                            ?>
                                                                                <img id="plus-8" style="margin-top: 10px" width="20" height="20" src="/dashboardv2/uploads/fb_icon/<?= $query_one_result['FBUTTON4']; ?>"></img>
                                                                            <?php
                                                                            } else {
                                                                            ?>
                                                                                <span id="plus-8" style="margin-top: 10px; font-size: 15px">+</span>
                                                                            <?php
                                                                            }
                                                                            ?>
                                                                            <img id="image-preview-8" class="image-preview" src="" style="margin-top: 10px" width="20px" height="20px" />
                                                                        </div>
                                                                    </label>
                                                                    <label for="fb2_icon" style="display: contents">
                                                                        <div id="small-icon-4" class="small-icon-4 d-flex justify-content-center" style="position: absolute; margin-top: -65px; margin-left: 70px; background-color: #d7d7d7; border-radius: 50%; width: 40px; height: 40px">
                                                                            <?php
                                                                            if ($query_one_result['FBUTTON2'] != "") {
                                                                            ?>
                                                                                <img id="plus-9" style="margin-top: 10px" width="20" height="20" src="/dashboardv2/uploads/fb_icon/<?= $query_one_result['FBUTTON2']; ?>"></img>
                                                                            <?php
                                                                            } else {
                                                                            ?>
                                                                                <span id="plus-9" style="margin-top: 10px; font-size: 15px">+</span>
                                                                            <?php
                                                                            }
                                                                            ?>
                                                                            <img id="image-preview-9" class="image-preview" src="" style="margin-top: 10px" width="20px" height="20px" />
                                                                        </div>
                                                                    </label>
                                                                    <label for="fb1_icon" style="display: contents">
                                                                        <div id="small-icon-5" class="small-icon-5 d-flex justify-content-center" style="position: absolute; margin-top: -25px; margin-left: 40px; background-color: #d7d7d7; border-radius: 50%; width: 40px; height: 40px">
                                                                            <?php
                                                                            if ($query_one_result['FBUTTON1'] != "") {
                                                                            ?>
                                                                                <img id="plus-10" style="margin-top: 10px" width="20" height="20" src="/dashboardv2/uploads/fb_icon/<?= $query_one_result['FBUTTON1']; ?>"></img>
                                                                            <?php
                                                                            } else {
                                                                            ?>
                                                                                <span id="plus-10" style="margin-top: 10px; font-size: 15px">+</span>
                                                                            <?php
                                                                            }
                                                                            ?>
                                                                            <img id="image-preview-10" class="image-preview" src="" style="margin-top: 10px" width="20px" height="20px" />
                                                                        </div>
                                                                    </label>
                                                                </div>
                                                                <label for="cpaas_icon" style="display: contents">
                                                                    <div id="big-icon-5" style="z-index: 1000">
                                                                        <?php
                                                                        if ($query_one_result['CPAAS_ICON'] != "") {
                                                                        ?>
                                                                            <img id="plus-5" width="60" height="60" src="/dashboardv2/uploads/logofloat/<?= $query_one_result['CPAAS_ICON']; ?>"></img>
                                                                        <?php
                                                                        } else {
                                                                        ?>
                                                                            <div id="plus-5" style="padding-top: 12px; font-size: 25px">+</div>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                        <img id="image-preview-5" class="image-preview" src="" width="60" height="60" />
                                                                    </div>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <label for="tab3_icon" style="display: contents;">
                                                        <div id="big-icon-3" class="col-2 d-flex justify-content-center home-icon pt-2" style="width: 60px; height: 45px; border-right: 1px solid grey; z-index: 1000">
                                                            <?php
                                                            if ($query_one_result['TAB3_ICON'] != "") {
                                                            ?>
                                                                <img id="plus-3" width="30" height="30" src="/dashboardv2/uploads/tab_icon/<?= $query_one_result['TAB3_ICON']; ?>"></img>
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <span id="plus-3" style="margin-top: -5px; font-size: 25px">+</span>
                                                            <?php
                                                            }
                                                            ?>
                                                            <img id="image-preview-3" class="image-preview" src="" width="30" height="30" />
                                                        </div>
                                                    </label>
                                                    <label for="tab4_icon" style="display: contents; z-index: 1000">
                                                        <div id="big-icon-4" class="col-2 d-flex justify-content-center settings-icon pt-2" style="width: 60px; height: 45px">
                                                            <?php
                                                            if ($query_one_result['TAB4_ICON'] != "") {
                                                            ?>
                                                                <img id="plus-4" width="30" height="30" src="/dashboardv2/uploads/tab_icon/<?= $query_one_result['TAB4_ICON']; ?>"></img>
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <span id="plus-4" style="margin-top: -5px; font-size: 25px">+</span>
                                                            <?php
                                                            }
                                                            ?>
                                                            <img id="image-preview-4" class="image-preview" src="" width="30" height="30" />
                                                        </div>
                                                    </label>
                                                </div>
                                                <!-- END DOCKED AREA -->

                                                <!-- START DOCKED AREA 2 -->
                                                <div class="docked-content-2 row gx-0" style="position: absolute; margin-top: -119px; margin-left: 85px; background-color: #d7d7d7; width: 232px; height: 45px; z-index: 999">
                                                    <label for="tab5_icon" style="display: contents">
                                                        <div id="big-icon-6" class="col-3 d-flex justify-content-center msg-icon pt-2" style="width: 60px; height: 45px; border-right: 1px solid grey; z-index: 1000">
                                                            <?php
                                                            if ($query_one_result['TAB1_ICON'] != "") {
                                                            ?>
                                                                <img id="plus-17" width="30" height="30" src="/dashboardv2/uploads/tab_icon/<?= $query_one_result['TAB1_ICON']; ?>"></img>
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <span id="plus-17" style="margin-top: -5px; font-size: 25px">+</span>
                                                            <?php
                                                            }
                                                            ?>
                                                            <img id="image-preview-17" class="image-preview" src="" width="30" height="30" />
                                                        </div>
                                                    </label>
                                                    <label for="tab6_icon" style="display: contents">
                                                        <div id="big-icon-7" class="col-3 d-flex justify-content-center smile-icon pt-2" style="width: 60px; height: 45px; border-right: 1px solid grey; z-index: 1000">
                                                            <?php
                                                            if ($query_one_result['TAB2_ICON'] != "") {
                                                            ?>
                                                                <img id="plus-18" width="30" height="30" src="/dashboardv2/uploads/tab_icon/<?= $query_one_result['TAB2_ICON']; ?>"></img>
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <span id="plus-18" style="margin-top: -5px; font-size: 25px">+</span>
                                                            <?php
                                                            }
                                                            ?>
                                                            <img id="image-preview-18" class="image-preview" src="" width="30" height="30" />
                                                        </div>
                                                    </label>
                                                    <label for="tab7_icon" style="display: contents;">
                                                        <div id="big-icon-8" class="col-3 d-flex justify-content-center home-icon pt-2" style="width: 60px; height: 45px; border-right: 1px solid grey; z-index: 1000">
                                                            <?php
                                                            if ($query_one_result['TAB3_ICON'] != "") {
                                                            ?>
                                                                <img id="plus-19" width="30" height="30" src="/dashboardv2/uploads/tab_icon/<?= $query_one_result['TAB3_ICON']; ?>"></img>
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <span id="plus-19" style="margin-top: -5px; font-size: 25px">+</span>
                                                            <?php
                                                            }
                                                            ?>
                                                            <img id="image-preview-19" class="image-preview" src="" width="30" height="30" />
                                                        </div>
                                                    </label>
                                                    <label for="tab8_icon" style="display: contents; z-index: 1000">
                                                        <div id="big-icon-9" class="col-3 d-flex justify-content-center settings-icon pt-2" style="width: 60px; height: 45px">
                                                            <?php
                                                            if ($query_one_result['TAB4_ICON'] != "") {
                                                            ?>
                                                                <img id="plus-20" width="30" height="30" src="/dashboardv2/uploads/tab_icon/<?= $query_one_result['TAB4_ICON']; ?>"></img>
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <span id="plus-20" style="margin-top: -5px; font-size: 25px">+</span>
                                                            <?php
                                                            }
                                                            ?>
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
                                                                <?php
                                                                if ($query_one_result['FBUTTON5'] != "") {
                                                                ?>
                                                                    <img id="plus-12" style="margin-top: 10px" width="20" height="20" src="/dashboardv2/uploads/fb_icon/<?= $query_one_result['FBUTTON5']; ?>"></img>
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <span id="plus-12" style="margin-top: 10px; font-size: 15px">+</span>
                                                                <?php
                                                                }
                                                                ?>
                                                                <img id="image-preview-12" class="image-preview" src="" style="margin-top: 10px" width="20px" height="20px" />
                                                            </div>
                                                        </label>
                                                        <!-- HIDDEN POST ON FLOATING BUTTON -->
                                                        <label for="fb10_icon" style="display: contents">
                                                            <div id="small-icon-7" class="small-icon-2 d-flex justify-content-center" style="position: absolute; margin-top: 55px; margin-left: 110px; background-color: #d7d7d7; border-radius: 50%; width: 40px; height: 40px">
                                                                <?php
                                                                if ($query_one_result['FBUTTON2'] != "") {
                                                                ?>
                                                                    <img id="plus-13" style="margin-top: 10px" width="20" height="20" src="/dashboardv2/uploads/fb_icon/<?= $query_one_result['FBUTTON2']; ?>"></img>
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <span id="plus-13" style="margin-top: 10px; font-size: 15px">+</span>
                                                                <?php
                                                                }
                                                                ?>
                                                                <img id="image-preview-13" class="image-preview" src="" style="margin-top: 10px" width="20px" height="20px" />
                                                            </div>
                                                        </label>
                                                        <label for="fb9_icon" style="display: contents">
                                                            <div id="small-icon-8" class="small-icon-3 d-flex justify-content-center" style="position: absolute; margin-top: -35px; margin-left: 110px; background-color: #d7d7d7; border-radius: 50%; width: 40px; height: 40px">
                                                                <?php
                                                                if ($query_one_result['FBUTTON4'] != "") {
                                                                ?>
                                                                    <img id="plus-14" style="margin-top: 10px" width="20" height="20" src="/dashboardv2/uploads/fb_icon/<?= $query_one_result['FBUTTON4']; ?>"></img>
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <span id="plus-14" style="margin-top: 10px; font-size: 15px">+</span>
                                                                <?php
                                                                }
                                                                ?>
                                                                <img id="image-preview-14" class="image-preview" src="" style="margin-top: 10px" width="20px" height="20px" />
                                                            </div>
                                                        </label>
                                                        <label for="fb7_icon" style="display: contents">
                                                            <div id="small-icon-9" class="small-icon-4 d-flex justify-content-center" style="position: absolute; margin-top: 10px; margin-left: 110px; background-color: #d7d7d7; border-radius: 50%; width: 40px; height: 40px">
                                                                <?php
                                                                if ($query_one_result['FBUTTON3'] != "") {
                                                                ?>
                                                                    <img id="plus-15" style="margin-top: 10px" width="20" height="20" src="/dashboardv2/uploads/fb_icon/<?= $query_one_result['FBUTTON3']; ?>"></img>
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <span id="plus-15" style="margin-top: 10px; font-size: 15px">+</span>
                                                                <?php
                                                                }
                                                                ?>
                                                                <img id="image-preview-15" class="image-preview" src="" style="margin-top: 10px" width="20px" height="20px" />
                                                            </div>
                                                        </label>
                                                        <label for="fb11_icon" style="display: contents">
                                                            <div id="small-icon-10" class="small-icon-5 d-flex justify-content-center" style="position: absolute; margin-top: 100px; margin-left: 110px; background-color: #d7d7d7; border-radius: 50%; width: 40px; height: 40px">
                                                                <?php
                                                                if ($query_one_result['FBUTTON1'] != "") {
                                                                ?>
                                                                    <img id="plus-16" style="margin-top: 10px" width="20" height="20" src="/dashboardv2/uploads/fb_icon/<?= $query_one_result['FBUTTON1']; ?>"></img>
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <span id="plus-16" style="margin-top: 10px; font-size: 15px">+</span>
                                                                <?php
                                                                }
                                                                ?>
                                                                <img id="image-preview-16" class="image-preview" src="" style="margin-top: 10px" width="20px" height="20px" />
                                                            </div>
                                                        </label>
                                                    </div>
                                                    <label for="cpaas_icon2" style="display: contents">
                                                        <div id="floating-button" style="z-index: 1000; background-color: grey; width: 60px; height: 60px; border-radius: 50%; text-align: center; margin-top: -245px; margin-left: 240px; position: absolute">
                                                            <?php
                                                            if ($query_one_result['CPAAS_ICON'] != "") {
                                                            ?>
                                                                <img id="plus-11" width="60" height="60" src="/dashboardv2/uploads/logofloat/<?= $query_one_result['CPAAS_ICON']; ?>"></img>
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <div id="plus-11" style="padding-top: 12px; font-size: 25px">+</div>
                                                            <?php
                                                            }
                                                            ?>
                                                            <img id="image-preview-11" class="image-preview" src="" width="60" height="60" />
                                                        </div>
                                                    </label>
                                                </div>

                                                <!-- END FLOATING AREA -->
                                                <p class="text-center mt-3" data-translate="dashform-45">Click "<b>+</b>" to insert new Icon.</p>
                                                <p id="drag-drop-text" class="text-center" data-translate="dashform-46"><b>Drag</b> and <b>Drop</b> Icon to set Icon Position</p>
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
                                                    <div class="new-post gx-0 d-flex justify-content-center">
                                                        <p>New Post</p>
                                                    </div>
                                                    <div class="live-streaming gx-0 d-flex justify-content-center">
                                                        <p style="z-index: 1000">Live Streaming</p>
                                                    </div>
                                                </div>

                                                <div id="sub-floating-button-2" style="z-index: 100">
                                                    <div class="home-2 gx-0 d-flex justify-content-center">
                                                        <p style="z-index: 1000">Tab 1</p>
                                                    </div>
                                                    <div class="chats-2 gx-0 d-flex justify-content-center">
                                                        <p style="z-index: 1000">Tab 2</p>
                                                    </div>
                                                    <div class="contents-2 gx-0 d-flex justify-content-center">
                                                        <p style="z-index: 1000">Tab 3</p>
                                                    </div>
                                                    <div class="settings-2 gx-0 d-flex justify-content-center">
                                                        <p style="z-index: 1000">Tab 4</p>
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
                                                        <p style="z-index: 1000">Tab 1</p>
                                                    </div>
                                                    <div class="chats gx-0 d-flex justify-content-center">
                                                        <p style="z-index: 1000">Tab 2</p>
                                                    </div>
                                                    <div class="contents gx-0 d-flex justify-content-center">
                                                        <p style="z-index: 1000">Tab 3</p>
                                                    </div>
                                                    <div class="settings gx-0 d-flex justify-content-center">
                                                        <p style="z-index: 1000">Tab 4</p>
                                                    </div>
                                                </div>

                                                <div id="sub-burger-button">
                                                    <div class="home-3 gx-0 d-flex justify-content-center">
                                                        <p style="z-index: 1000">Tab 1</p>
                                                    </div>
                                                    <div class="chats-3 gx-0 d-flex justify-content-center">
                                                        <p style="z-index: 1000">Tab 2</p>
                                                    </div>
                                                    <div class="contents-3 gx-0 d-flex justify-content-center">
                                                        <p style="z-index: 1000">Tab 3</p>
                                                    </div>
                                                    <div class="settings-3 gx-0 d-flex justify-content-center">
                                                        <p style="z-index: 1000">Tab 4</p>
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
                                        <label for="generate-default-certif" data-translate="dashform-47"> Let nexilis generate a default certificate for you</label><br>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-12 radio-item">
                                        <input onclick="checkCertif()" type="radio" id="exist-certif" name="check-certif" value="1">
                                        <label for="exist-certif" data-translate="dashform-48"> I already have my own certificate</label><br>
                                    </div>
                                </div>

                                <div id="cert-existing">
                                    <div class="row mt-3">
                                        <label class="col-sm-2 col-form-label" for="appCertificate" data-translate="dashform-51">Your app certificate :</label>

                                        <div class="col-sm-4">
                                            <div class="form-control">
                                                <label for="appCertificate" class="btn" style="position: absolute">
                                                    <button data-translate="dashindex-35" style="border: 1px solid grey; margin-top: -8px; margin-left: -8px; pointer-events: none">Choose File</button>
                                                </label>
                                                <input id="no-chosen-certif" type="text" style="margin-top: -5px; padding-left: 130px; border: none; background-color:none; background-color: transparent !important" class="form-control border-70" readonly value="No file chosen.">
                                                <input id="certif-upload-name" type="text" style="margin-top: -5px; padding-left: 130px; border: none; background-color:none; background-color: transparent !important" class="form-control border-70 d-none" readonly>
                                            </div>
                                            <input type="file" id="appCertificate" class="form-control d-none" name="app-certificate" placeholder="App Certificate" onchange="certificateFile(event)">
                                        </div>
                                        <label class="col-sm-2 col-form-label" for="inputAlias-existing" data-translate="dashform-52">Alias :</label>

                                        <div class="col-sm-4">
                                            <input type="textarea" id="inputAlias-existing" class="form-control" name="inputAlias-existing">
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <label for="inputPassword" class="col-sm-2 col-form-label" data-translate="dashform-53">Key password</label>
                                        <div class="col-sm-4">
                                            <input type="password" class="form-control" id="keyPassword-existing" name="keyPassword-existing">
                                        </div>
                                        <label for="inputConfirmPassword" class="col-sm-2 col-form-label" data-translate="dashform-54">Key store password</label>
                                        <div class="col-sm-4">
                                            <input type="password" class="form-control" id="storePassword-existing" name="storePassword-existing">
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-12 radio-item">
                                        <input onclick="checkCertif()" type="radio" id="generate-new-certif" name="check-certif" value="2">
                                        <label for="generate-new-certif" data-translate="dashform-49"> I want to create a new certificate</label><br>
                                    </div>
                                </div>

                                <div id="dont-have-certificate">
                                    <div class="col mt-3">
                                        <div class="form-group row align-items-center">
                                            <label for="inputAlias" class="col-sm-3 col-md-2 col-form-label" data-translate="dashform-55">Alias</label>
                                            <div class="col-sm-9 col-md-4 left">
                                                <input type="text" class="form-control" id="inputAlias" name="inputAlias">
                                                <small id="alias-error-text" class="text-danger mt-1 d-none">Alias minimum 6 character.</small>
                                            </div>
                                            <div class="col-md-6"></div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <label for="inputPassword" class="col-sm-3 col-md-2 col-form-label" data-translate="dashform-56">Key Password</label>
                                            <div class="col-sm-9 col-md-4 left">
                                                <input type="password" class="form-control" id="keyPassword" name="keyPassword">
                                                <small id="key-password-error-text" class="text-danger mt-1 d-none">Key Password minimum 8 character.</small>
                                            </div>
                                            <label for="inputConfirmPassword" class="col-sm-3 col-md-2 col-form-label" data-translate="dashform-57">Key Store Password</label>
                                            <div class="col-sm-9 col-md-4 right">
                                                <input type="password" class="form-control" id="storePassword" name="storePassword">
                                                <small id="key-store-password-error-text" class="text-danger mt-1 d-none">Key Store Password minimum 8 character.</small>
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <label for="inputValidity" class="col-sm-3 col-md-2 col-form-label" data-translate="dashform-58">Validity (years)</label>
                                            <div class="col-sm-9 col-md-4 left">
                                                <input type="number" class="form-control" id="inputValidity" name="inputValidity">
                                            </div>
                                            <div class="col-md-6"></div>
                                        </div>

                                        <hr>

                                        <div class="form-group row align-items-center">
                                            <label for="inputName" class="col-sm-3 col-md-2 col-form-label" data-translate="dashform-59">First and Last name</label>
                                            <div class="col-sm-9 col-md-4 left">
                                                <input type="text" class="form-control" id="inputName" name="inputName">
                                            </div>
                                            <label for="inputCity" class="col-sm-3 col-md-2 col-form-label" data-translate="dashform-60">City or Locality</label>
                                            <div class="col-sm-9 col-md-4 right">
                                                <input type="text" class="form-control" id="inputCity" name="inputCity">
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <label for="inputUnit" class="col-sm-3 col-md-2 col-form-label" data-translate="dashform-61">Organizational Unit</label>
                                            <div class="col-sm-9 col-md-4 left">
                                                <input type="text" class="form-control" id="inputUnit" name="inputUnit">
                                            </div>
                                            <label for="inputState" class="col-sm-3 col-md-2  col-form-label" data-translate="dashform-62">State or Province</label>
                                            <div class="col-sm-9 col-md-4 right">
                                                <input type="text" class="form-control" id="inputState" name="inputState">
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <label for="inputOrg" class="col-sm-3 col-md-2 col-form-label" data-translate="dashform-63">Organization Name</label>
                                            <div class="col-sm-9 col-md-4 left">
                                                <input type="text" class="form-control" id="inputOrg" name="inputOrg">
                                            </div>

                                            <label for="inputCode" class="col-sm-3 col-md-2 col-form-label" data-translate="dashform-64">Country Code (XX)</label>
                                            <div class="col-sm-9 col-md-4 right">
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

                        <!-- START SESSION 2 / EDIT SESSION -->

                        <div class="card" id="edit-tabs">
                            <div id="generate-apk-form-2">

                                <div class="row mb-5">
                                    <div class="col-sm-12 col-md-12 left">
                                        <label for="userAccess" data-translate="dashform-65">Choose User Access<span style="color:red;">*</span> :</label>
                                        <!-- <input type="textarea" id="userAccess" class="form-control" name="company-name" placeholder="Company Name"> -->
                                    </div>
                                    <div class="col-sm-12 col-md-12 left">
                                        <select id="userAccess" class="form-control tab-content" name="company-name" required>

                                            <?php foreach ($user_access as $ua) : ?>
                                                <option value="<?= $ua['ID'] ?>"><?= $ua['NAME'] ?></option>
                                            <?php endforeach; ?>

                                        </select>
                                    </div>
                                </div>

                                <!-- <div class="row d-none" id="content-categories">
                                    <div class="col-md-12">
                                        <button class="btn btn-yellow" type="button" id="add-category" style="font-size:14px;">Add category</button>
                                        <div id="category_arr" class="mt-1">
                                            <div class="row category-row" id="category-row-0">
                                                <div class="col-3">
                                                    <input type="text" id="category-0" class="category-name form-control mb-1" placeholder="Insert category name" name="category[]" style="display:inline-block;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                                <!-- <div class="row mt-3 d-none" id="save-category">
                                    <div class="col-md-12">
                                        <button class="btn btn-yellow" type="button" id="save-category-btn" style="font-size:14px;">Save category</button>
                                        <p id="save-category-error" class="d-none" style="color:red;">
                                            Failed to save category! Please make sure all fields are filled.
                                        </p>
                                        <p id="save-category-success" class="d-none" style="color:green;">
                                            Category saved.
                                        </p>
                                    </div>
                                </div> -->

                                <h6 class="mt-5"><strong data-translate="dashform-17">APK Settings</strong></h6>

                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <p style="font-size:.85rem;">
                                            <span data-translate="dashform-18">In this section you can change the content of tabs and change tab icons. Nexilis default tab icons will be used if you don't upload a custom icon.</span>
                                            <br>
                                            <span data-translate="dashform-19"><strong>Note:</strong> You can't select the same option for different tabs.</span>
                                        </p>
                                    </div>
                                </div>

                                <div class="row">
                                    <p id="outside-text-2" class="d-none" style="position:absolute; margin-top: 285px; margin-left: 30px" data-translate="dashform-20"><b>Drop & Drag</b> outside the phone to remove Icon.</p>
                                    <div class="col-12 col-md-6 left-side">
                                        <div class="row">
                                            <label class="col-sm-4 col-form-label" for="tab1_edit" data-translate="dashform-21">Tab 1 content<span style="color:red;">*</span> :</label>
                                            <div class="col-sm-8">
                                                <select id="tab1_edit" class="form-control tab-content" name="tab1_edit" onchange="checkOptEdit(this.id);" required>
                                                    <option value="" disabled selected data-translate="dashform-22">Select your option</option>
                                                    <option value="1">Home Page</option>
                                                    <option value="2">Chats & Groups</option>
                                                    <option value="3">Content Posting</option>
                                                    <option value="4">Settings & User Profile</option>
                                                    <option value="5">Secure Folder</option>
                                                    <option value="6">Call Log</option>
                                                    <option value="0" data-translate="dashform-71">Unused</option>
                                                </select>
                                            </div>

                                            <div class="col-sm-4 d-none">
                                                <input type="file" id="tab21_icon" class="form-control" name="tab21_icon" onchange="loadFile21(event)">
                                                <input type="file" id="tab25_icon" class="form-control" name="tab25_icon" onchange="loadFile37(event)">
                                            </div>
                                        </div>
                                        <div class="row mt-3 d-none" id="tab1_edit_url_row">

                                        </div>

                                        <div class="row mt-3">
                                            <label class="col-sm-4 col-form-label" for="tab2_edit" data-translate="dashform-23">Tab 2 content<span style="color:red;">*</span> :</label>
                                            <div class="col-sm-8">
                                                <select id="tab2_edit" class="form-control tab-content" name="tab2_edit" onchange="checkOptEdit(this.id);" required>
                                                    <option value="" disabled selected data-translate="dashform-22">Select your option</option>
                                                    <option value="1">Home Page</option>
                                                    <option value="2">Chats & Groups</option>
                                                    <option value="3">Content Posting</option>
                                                    <option value="4">Settings & User Profile</option>
                                                    <option value="5">Secure Folder</option>
                                                    <option value="6">Call Log</option>
                                                    <option value="0" data-translate="dashform-71">Unused</option>
                                                </select>
                                            </div>

                                            <div class="col-sm-4 d-none">
                                                <input type="file" id="tab22_icon" class="form-control" name="tab22_icon" onchange="loadFile22(event)">
                                                <input type="file" id="tab26_icon" class="form-control" name="tab26_icon" onchange="loadFile38(event)">
                                            </div>
                                        </div>
                                        <div class="row mt-3 d-none" id="tab2_edit_url_row">

                                        </div>

                                        <div class="row mt-3">
                                            <label class="col-sm-4 col-form-label" for="tab3_edit" data-translate="dashform-24">Tab 3 content<span style="color:red;">*</span> :</label>
                                            <div class="col-sm-8">
                                                <select id="tab3_edit" class="form-control tab-content" name="tab3_edit" onchange="checkOptEdit(this.id);" required>
                                                    <option value="" disabled selected data-translate="dashform-22">Select your option</option>
                                                    <option value="1">Home Page</option>
                                                    <option value="2">Chats & Groups</option>
                                                    <option value="3">Content Posting</option>
                                                    <option value="4">Settings & User Profile</option>
                                                    <option value="5">Secure Folder</option>
                                                    <option value="6">Call Log</option>
                                                    <option value="0" data-translate="dashform-71">Unused</option>
                                                </select>
                                            </div>

                                            <div class="col-sm-4 d-none">
                                                <input type="file" id="tab23_icon" class="form-control" name="tab23_icon" onchange="loadFile23(event)">
                                                <input type="file" id="tab27_icon" class="form-control" name="tab27_icon" onchange="loadFile39(event)">
                                            </div>
                                        </div>
                                        <div class="row mt-3 d-none" id="tab3_edit_url_row">

                                        </div>

                                        <div class="row mt-3">
                                            <label class="col-sm-4 col-form-label" for="tab4_edit" data-translate="dashform-25">Tab 4 content<span style="color:red;">*</span> :</label>
                                            <div class="col-sm-8">
                                                <select id="tab4_edit" class="form-control tab-content" name="tab4_edit" onchange="checkOptEdit(this.id);" required>
                                                    <option value="" disabled selected data-translate="dashform-22">Select your option</option>
                                                    <option value="1">Home Page</option>
                                                    <option value="2">Chats & Groups</option>
                                                    <option value="3">Content Posting</option>
                                                    <option value="4">Settings & User Profile</option>
                                                    <option value="5">Secure Folder</option>
                                                    <option value="6">Call Log</option>
                                                    <option value="0" data-translate="dashform-71">Unused</option>
                                                </select>
                                            </div>

                                            <div class="col-sm-4 d-none">
                                                <input type="file" id="tab24_icon" class="form-control" name="tab24_icon" onchange="loadFile24(event)">
                                                <input type="file" id="tab28_icon" class="form-control" name="tab28_icon" onchange="loadFile40(event)">
                                            </div>
                                        </div>
                                        <div class="row mt-3 d-none" id="tab4_edit_url_row">

                                        </div>

                                        <div class="row mt-5">
                                            <div class="col-md-12">
                                                <p style="font-size:.85rem;" data-translate="dashform-26">
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
                                                    <strong data-translate="dashform-27">Enable/Disable Features</strong>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label class="genapkcheckbox" for="enable_sms_edit" style="font-size:.8rem;"> SMS
                                                    <input type="checkbox" id="enable_sms_edit" name="enable_sms" value="1">
                                                    <span class="checkmark-small"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label class="genapkcheckbox" for="enable_osint_edit" style="font-size:.8rem;"> OSINT Search
                                                    <input type="checkbox" id="enable_osint_edit" name="enable_osint" value="1">
                                                    <span class="checkmark-small"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label class="genapkcheckbox" for="enable_scan_edit" style="font-size:.8rem;"> ID Scan
                                                    <input type="checkbox" id="enable_scan_edit" name="enable_scan" value="1">
                                                    <span class="checkmark-small"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label class="genapkcheckbox" for="enable_email_edit" style="font-size:.8rem;"> Email
                                                    <input type="checkbox" id="enable_email_edit" name="enable_email" value="1">
                                                    <span class="checkmark-small"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row mt-5">
                                            <div class="col-md-12">
                                                <p style="font-size:.85rem;">
                                                    Choose your preferred look for Nexilis build UI.
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label class="col-sm-4 col-form-label" for="nx_im_theme_edit">Messaging :</label>

                                            <div class="col-sm-8">
                                                <!-- <input type="file" id="tab3_icon" class="form-control" name="tab3_icon"> -->
                                                <select class="form-control" name="nx_im_theme_edit" id="nx_im_theme_edit">
                                                    <option value="0" selected>Standard</option>
                                                    <option value="1">Bubble</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <label class="col-sm-4 col-form-label" for="nx_ac_theme_edit">Audio Call :</label>

                                            <div class="col-sm-8">
                                                <!-- <input type="file" id="tab3_icon" class="form-control" name="tab3_icon"> -->
                                                <select class="form-control" name="nx_ac_theme_edit" id="nx_ac_theme_edit">
                                                    <option value="0" selected>Standard</option>
                                                    <option value="1">Bubble</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <label class="col-sm-4 col-form-label" for="nx_sm_theme_edit">Seminar :</label>

                                            <div class="col-sm-8">
                                                <!-- <input type="file" id="tab3_icon" class="form-control" name="tab3_icon"> -->
                                                <select class="form-control" name="nx_sm_theme_edit" id="nx_sm_theme_edit">
                                                    <option value="0" selected>Standard</option>
                                                    <option value="1">Bubble</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <label class="col-sm-4 col-form-label" for="nx_ls_theme_edit">Live Streaming :</label>

                                            <div class="col-sm-8">
                                                <!-- <input type="file" id="tab3_icon" class="form-control" name="tab3_icon"> -->
                                                <select class="form-control" name="nx_ls_theme_edit" id="nx_ls_theme_edit">
                                                    <option value="0" selected>Standard</option>
                                                    <option value="1">Bubble</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <label class="col-sm-4 col-form-label" for="nx_vc_theme_edit">Video Call :</label>

                                            <div class="col-sm-8">
                                                <!-- <input type="file" id="tab3_icon" class="form-control" name="tab3_icon"> -->
                                                <select class="form-control" name="nx_vc_theme_edit" id="nx_vc_theme_edit">
                                                    <option value="0" selected>Standard</option>
                                                    <option value="1">Bubble</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mt-5">
                                            <div class="col-md-12">
                                                <p style="font-size:.85rem;">
                                                    <span data-translate="dashform-32"><strong>Access model</strong> setting allows you to change how you can access CPaaS features.</span>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label class="col-sm-4 col-form-label" for="access_model" data-translate="dashform-28">Access model :</label>

                                            <div class="col-sm-8">
                                                <!-- <input type="file" id="tab3_icon" class="form-control" name="tab3_icon"> -->
                                                <select class="form-control" name="access_model" onchange="selectTabMenuTwo()" id="menuTypeTwo">
                                                    <option value="0" selected>Floating button</option>
                                                    <option value="1">Docked</option>
                                                    <option value="2">Hamburger Menu</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mt-3 align-items-center d-none" id="show_fb_options_2">

                                        </div>

                                        <div class="row mt-3 align-items-center" id="fb_pp_options_2">
                                            <label class="col-sm-4 col-form-label" for="access_model" data-translate="dashform-29">Use Floating Button image as Profile Pict. :</label>

                                            <div class="col-sm-8">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="fb_pp_edit" id="fb_pp3" value="1">
                                                    <label class="form-check-label" for="fb_pp3" data-translate="dashform-30">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="fb_pp_edit" id="fb_pp2" value="0" checked>
                                                    <label class="form-check-label" for="fb_pp2" data-translate="dashform-31">No</label>
                                                </div>
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
                                            <input type="file" id="fb21_icon" class="form-control" name="fb21_icon" onchange="loadFile30(event)">
                                            <input type="file" id="fb28_icon" class="form-control" name="fb28_icon" onchange="loadFile32(event)">
                                        </div>
                                        <!-- </div>
                                    <div class="row mt-3">
                                        <label class="col-sm-2 col-form-label" for="fb2_icon">A/V Call icon :</label> -->

                                        <div class="col-sm-4 d-none">
                                            <input type="file" id="fb22_icon" class="form-control" name="fb22_icon" onchange="loadFile29(event)">
                                            <input type="file" id="fb29_icon" class="form-control" name="fb29_icon" onchange="loadFile34(event)">
                                        </div>
                                        <!-- </div>
                                    <div class="row mt-3">
                                        <label class="col-sm-2 col-form-label" for="fb3_icon">Contact Center icon :</label> -->

                                        <div class="col-sm-4 d-none">
                                            <input type="file" id="fb23_icon" class="form-control" name="fb23_icon" onchange="loadFile26(event)">
                                            <input type="file" id="fb27_icon" class="form-control" name="fb27_icon" onchange="loadFile35(event)">
                                        </div>
                                        <!-- </div>
                                    <div class="row mt-3">
                                        <label class="col-sm-2 col-form-label" for="fb4_icon">Streaming & Seminar icon :</label> -->

                                        <div class="col-sm-4 d-none">
                                            <input type="file" id="fb24_icon" class="form-control" name="fb24_icon" onchange="loadFile28(event)">
                                            <input type="file" id="fb30_icon" class="form-control" name="fb30_icon" onchange="loadFile33(event)">
                                        </div>
                                        <!-- </div>
                                    <div class="row mt-3">
                                        <label class="col-sm-2 col-form-label" for="fb5_icon">Create Post icon :</label> -->

                                        <div class="col-sm-4 d-none">
                                            <input type="file" id="fb25_icon" class="form-control" name="fb25_icon" onchange="loadFile27(event)">
                                            <input type="file" id="fb31_icon" class="form-control" name="fb31_icon" onchange="loadFile36(event)">
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
                                            <input type="file" id="cpaas_icon3" class="form-control" name="cpaas_icon3" onchange="loadFile25(event)">
                                            <input type="file" id="cpaas_icon4" class="form-control" name="cpaas_icon4" onchange="loadFile31(event)">
                                        </div>
                                        <!-- </div> -->
                                        <div class="row mt-4">
                                            <label class="col-sm-4 col-form-label" for="app_font_edit" data-translate="dashform-33">Font :</label>

                                            <div class="col-sm-8">
                                                <!-- <input type="file" id="tab3_icon" class="form-control" name="tab3_icon"> -->
                                                <select class="form-control" name="app_font_edit" id="app_font_edit">
                                                    <option value="0">Poppins</option>
                                                    <option value="1">Roboto</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row mt-3">
                                            <div class="col-md-12">
                                                <p style="font-size:.85rem;" data-translate="dashform-34">
                                                    You can upload multiple backgrounds by selecting multiple files in the file explorer window and click "open".
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label class="col-sm-4 col-form-label" for="background" data-translate="dashform-35">Background wallpaper :</label>

                                            <div class="col-sm-8" id="section-background-2">
                                                <div class="form-control">
                                                    <label for="background_edit" class="btn" style="position: absolute">
                                                        <button data-translate="dashindex-35" style="border: 1px solid grey; margin-top: -8px; margin-left: -8px; pointer-events: none">Choose File</button>
                                                    </label>
                                                    <input id="no-chosen-bg-edit" type="text" style="margin-top: -5px; padding-left: 130px; border: none; background-color:none; background-color: transparent !important" class="form-control border-70" readonly value="No file chosen.">
                                                    <input id="bg-upload-name-edit" type="text" style="margin-top: -5px; padding-left: 130px; border: none; background-color:none; background-color: transparent !important" class="form-control border-70 d-none" readonly>
                                                </div>
                                                <input type="file" id="background_edit" class="form-control d-none" accept="image/*" name="background[]" multiple onchange="backgroundFileEdit(event)">
                                            </div>

                                            <div class="col-sm-8 text-primary d-none mt-4 mb-4" id="old-bg-list-2"><?= $oldBG ?></div>

                                            <div class="row mt-3" id="small-prev-slot-edit" style="pointer-events: none; -webkit-user-select: none; -khtml-user-select: none; -moz-user-select: none; -o-user-select: none; user-select: none">
                                                <!-- FOR SMALL BACKGROUND PREV APPEND FROM JS -->
                                            </div>
                                        </div>

                                        <div class="row mt-3">
                                            <div class="col-md-12">
                                                <p style="font-size:.85rem;" data-translate="dashform-36">
                                                    You can upload a custom splash screen here (video/image), max 32MB.
                                                </p>
                                            </div>
                                        </div>

                                        <div class="check-existing-image mt-2 mb-4">

                                            <?php if (isset($oldBG)) : ?>
                                                <div class="text-success"><b data-translate="dashform-37">Existing Background Image Found.</b></div>
                                            <?php endif; ?>

                                            <input type="hidden" id="old-bg-hidden-2" value="<?= $oldBG ?>">

                                        </div>

                                        <?php if (isset($oldBG)) : ?>
                                            <label class="genapkcheckbox mt-2 mb-5" for="use-old-bg-2" data-translate="dashform-38"> I want to use old background
                                                <input type="checkbox" id="use-old-bg-2" name="use-old-bg" value="1">
                                                <span class="checkmark"></span>
                                            </label>
                                        <?php endif; ?>

                                        <!-- <div class="row">
                                            <label class="col-sm-4 col-form-label" for="splashscreen">Splash screen :</label>

                                            <div class="col-sm-8">
                                                <input type="file" id="splashscreen" class="form-control" accept="image/*,video/*" name="splashscreen">
                                            </div>
                                        </div> -->

                                        <!-- <div class="row mt-5">
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
                                        </div> -->

                                    </div>
                                    <!-- START PHONE SIMULATOR 2 -->
                                    <div class="col-xxl-2"></div>
                                    <div id="phone-simulator" class="col-12 col-md-6 col-xxl-4">
                                        <div style="width: 400px; height: 800px; margin-left: -10px">
                                            <p style="font-size: 20px; margin-top: 30px" class="text-center" data-translate="dashform-43"><b>CPaaS</b> in app Preview</p>
                                            <p id="cpaas-model-text" class="text-center" data-translate="dashform-44">Change <b>CPaaS</b> model in Access Model option.</p>
                                            <img src="assets/note-5.webp" style="width: 100%; height: auto; pointer-events: none; -webkit-user-select: none; -khtml-user-select: none; -moz-user-select: none; -o-user-select: none; user-select: none" alt="">
                                            <img id="phone-bg-edit" src="" style="position: absolute; width: 232px; height: 366px; margin-left: -315px; margin-top: 81px; pointer-events: none; -webkit-user-select: none; -khtml-user-select: none; -moz-user-select: none; -o-user-select: none; user-select: none" alt="">

                                            <!-- START BURGER AREA SIMULATOR 2-->
                                            <div id="burger-area-2" style="width: 232px; margin-left: 85px; height: 40px; margin-top: -486; background-color: grey; position: absolute">
                                                <div class="shadow" style="background-color: #d7d7d7; position: absolute; margin-left: 117px; width: 115px; height: 140px; margin-top: 10px; padding-top: 7px">
                                                    <div id="burger-1" style="font-size: 10px; padding: 5px"><b>Contact Center</b></div>
                                                    <div id="burger-2" style="font-size: 10px; padding: 5px"><b>Instant Messaging</b></div>
                                                    <div id="burger-3" style="font-size: 10px; padding: 5px"><b>A/V Call</b></div>
                                                    <div id="burger-4" style="font-size: 10px; padding: 5px"><b>New Post</b></div>
                                                    <div id="burger-5" style="font-size: 10px; padding: 5px"><b>Live Streaming</b></div>
                                                </div>
                                            </div>
                                            <!-- END BURGER AREA SIMULATOR 2 -->

                                            <!-- START DOCKED AREA SIMULATOR 2 -->
                                            <div class="docked-content-3 row gx-0" style="position: absolute; margin-top: -119px; margin-left: 85px; background-color: #d7d7d7; width: 232px; height: 45px; z-index: 999">
                                                <label for="tab21_icon" style="display: contents">
                                                    <div id="big-icon-21" class="col-2 d-flex justify-content-center msg-icon pt-2" style="width: 60px; height: 45px; border-right: 1px solid grey; z-index: 1000">
                                                        <span id="plus-21" style="margin-top: -5px; font-size: 25px">+</span>
                                                        <img id="image-preview-21" class="image-preview" src="" width="30" height="30" />
                                                    </div>
                                                </label>
                                                <label for="tab22_icon" style="display: contents">
                                                    <div id="big-icon-22" class="col-2 d-flex justify-content-center smile-icon pt-2" style="width: 60px; height: 45px; z-index: 1000">
                                                        <span id="plus-22" style="margin-top: -5px; font-size: 25px">+</span>
                                                        <img id="image-preview-22" class="image-preview" src="" width="30" height="30" />
                                                    </div>
                                                </label>

                                                <div class="col-4 d-flex justify-content-center">
                                                    <div id="main-center-2" class="d-flex justify-content-center justify-align-center align-self-center" style="width: 60px; height: 60px; background-color: grey; margin-top: -30px; border-radius: 50%">
                                                        <div class="row gx-0 d-flex justify-content-center">
                                                            <div class="small-icon gx-0 justify-content-center" style="width: 260px; height: 80px; position: absolute; margin-top: -30px">
                                                                <label for="fb23_icon" style="display: contents">
                                                                    <div id="small-icon-21" class="small-icon-1 d-flex justify-content-center" style="position: absolute; margin-top: -80px; background-color: #d7d7d7; border-radius: 50%; width: 40px; height: 40px; margin-left: 110px">
                                                                        <span id="plus-26" style="margin-top: 10px; font-size: 15px">+</span>
                                                                        <img id="image-preview-26" class="image-preview" src="" style="margin-top: 10px" width="20px" height="20px" />
                                                                    </div>
                                                                </label>
                                                                <label for="fb25_icon" style="display: contents">
                                                                    <div id="small-icon-22" class="small-icon-2 d-flex justify-content-center" style="position: absolute; margin-top: -25px; margin-left: 180px; background-color: #d7d7d7; border-radius: 50%; width: 40px; height: 40px">
                                                                        <span id="plus-27" style="margin-top: 10px; font-size: 15px">+</span>
                                                                        <img id="image-preview-27" class="image-preview" src="" style="margin-top: 10px" width="20px" height="20px" />
                                                                    </div>
                                                                </label>
                                                                <label for="fb24_icon" style="display: contents">
                                                                    <div id="small-icon-23" class="small-icon-3 d-flex justify-content-center" style="position: absolute; margin-top: -65px; margin-left: 150px; background-color: #d7d7d7; border-radius: 50%; width: 40px; height: 40px">
                                                                        <span id="plus-28" style="margin-top: 10px; font-size: 15px">+</span>
                                                                        <img id="image-preview-28" class="image-preview" src="" style="margin-top: 10px" width="20px" height="20px" />
                                                                    </div>
                                                                </label>
                                                                <label for="fb22_icon" style="display: contents">
                                                                    <div id="small-icon-24" class="small-icon-4 d-flex justify-content-center" style="position: absolute; margin-top: -65px; margin-left: 70px; background-color: #d7d7d7; border-radius: 50%; width: 40px; height: 40px">
                                                                        <span id="plus-29" style="margin-top: 10px; font-size: 15px">+</span>
                                                                        <img id="image-preview-29" class="image-preview" src="" style="margin-top: 10px" width="20px" height="20px" />
                                                                    </div>
                                                                </label>
                                                                <label for="fb21_icon" style="display: contents">
                                                                    <div id="small-icon-25" class="small-icon-5 d-flex justify-content-center" style="position: absolute; margin-top: -25px; margin-left: 40px; background-color: #d7d7d7; border-radius: 50%; width: 40px; height: 40px">
                                                                        <span id="plus-30" style="margin-top: 10px; font-size: 15px">+</span>
                                                                        <img id="image-preview-30" class="image-preview" src="" style="margin-top: 10px" width="20px" height="20px" />
                                                                    </div>
                                                                </label>
                                                            </div>
                                                            <label for="cpaas_icon3" style="display: contents">
                                                                <div id="big-icon-25" style="z-index: 1000">
                                                                    <div id="plus-25" style="padding-top: 12px; font-size: 25px">+</div>
                                                                    <img id="image-preview-25" class="image-preview" src="" width="60" height="60" />
                                                                </div>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <label for="tab23_icon" style="display: contents;">
                                                    <div id="big-icon-23" class="col-2 d-flex justify-content-center home-icon pt-2" style="width: 60px; height: 45px; border-right: 1px solid grey; z-index: 1000">
                                                        <span id="plus-23" style="margin-top: -5px; font-size: 25px">+</span>
                                                        <img id="image-preview-23" class="image-preview" src="" width="30" height="30" />
                                                    </div>
                                                </label>
                                                <label for="tab24_icon" style="display: contents; z-index: 1000">
                                                    <div id="big-icon-24" class="col-2 d-flex justify-content-center settings-icon pt-2" style="width: 60px; height: 45px">
                                                        <span id="plus-24" style="margin-top: -5px; font-size: 25px">+</span>
                                                        <img id="image-preview-24" class="image-preview" src="" width="30" height="30" />
                                                    </div>
                                                </label>
                                            </div>
                                            <!-- END DOCKED AREA SIMULATOR 2 -->

                                            <!-- START DOCKED AREA 2 SIMULATOR 2 -->
                                            <div class="docked-content-4 row gx-0" style="position: absolute; margin-top: -119px; margin-left: 85px; background-color: #d7d7d7; width: 232px; height: 45px; z-index: 999">
                                                <label for="tab25_icon" style="display: contents">
                                                    <div id="big-icon-26" class="col-3 d-flex justify-content-center msg-icon pt-2" style="width: 60px; height: 45px; border-right: 1px solid grey; z-index: 1000">
                                                        <span id="plus-37" style="margin-top: -5px; font-size: 25px">+</span>
                                                        <img id="image-preview-37" class="image-preview" src="" width="30" height="30" />
                                                    </div>
                                                </label>
                                                <label for="tab26_icon" style="display: contents">
                                                    <div id="big-icon-27" class="col-3 d-flex justify-content-center smile-icon pt-2" style="width: 60px; height: 45px; border-right: 1px solid grey; z-index: 1000">
                                                        <span id="plus-38" style="margin-top: -5px; font-size: 25px">+</span>
                                                        <img id="image-preview-38" class="image-preview" src="" width="30" height="30" />
                                                    </div>
                                                </label>
                                                <label for="tab27_icon" style="display: contents;">
                                                    <div id="big-icon-28" class="col-3 d-flex justify-content-center home-icon pt-2" style="width: 60px; height: 45px; border-right: 1px solid grey; z-index: 1000">
                                                        <span id="plus-39" style="margin-top: -5px; font-size: 25px">+</span>
                                                        <img id="image-preview-39" class="image-preview" src="" width="30" height="30" />
                                                    </div>
                                                </label>
                                                <label for="tab28_icon" style="display: contents; z-index: 1000">
                                                    <div id="big-icon-29" class="col-3 d-flex justify-content-center settings-icon pt-2" style="width: 60px; height: 45px">
                                                        <span id="plus-40" style="margin-top: -5px; font-size: 25px">+</span>
                                                        <img id="image-preview-40" class="image-preview" src="" width="30" height="30" />
                                                    </div>
                                                </label>
                                            </div>
                                            <!-- END DOCKED AREA 2 SIMULATOR 2 -->

                                            <!-- START FLOATING AREA SIMULATOR 2 -->
                                            <div id="palio-balloon-2">
                                                <div class="small_icon gx-0 justify-content-center" style="width: 260px; height: 80px; position: absolute; margin-left: 150px; margin-top: -390px">
                                                    <label for="fb28_icon" style="display: contents">
                                                        <div id="small-icon-26" class="small-icon-1 d-flex justify-content-center" style="position: absolute; margin-top: -80px; background-color: #d7d7d7; border-radius: 50%; width: 40px; height: 40px; margin-left: 110px">
                                                            <span id="plus-32" style="margin-top: 10px; font-size: 15px">+</span>
                                                            <img id="image-preview-32" class="image-preview" src="" style="margin-top: 10px" width="20px" height="20px" />
                                                        </div>
                                                    </label>
                                                    <!-- HIDDEN POST ON FLOATING BUTTON SIMULATOR 2 -->
                                                    <label for="fb30_icon" style="display: contents">
                                                        <div id="small-icon-27" class="small-icon-2 d-flex justify-content-center" style="position: absolute; margin-top: 55px; margin-left: 110px; background-color: #d7d7d7; border-radius: 50%; width: 40px; height: 40px">
                                                            <span id="plus-33" style="margin-top: 10px; font-size: 15px">+</span>
                                                            <img id="image-preview-33" class="image-preview" src="" style="margin-top: 10px" width="20px" height="20px" />
                                                        </div>
                                                    </label>
                                                    <label for="fb29_icon" style="display: contents">
                                                        <div id="small-icon-28" class="small-icon-3 d-flex justify-content-center" style="position: absolute; margin-top: -35px; margin-left: 110px; background-color: #d7d7d7; border-radius: 50%; width: 40px; height: 40px">
                                                            <span id="plus-34" style="margin-top: 10px; font-size: 15px">+</span>
                                                            <img id="image-preview-34" class="image-preview" src="" style="margin-top: 10px" width="20px" height="20px" />
                                                        </div>
                                                    </label>
                                                    <label for="fb27_icon" style="display: contents">
                                                        <div id="small-icon-29" class="small-icon-4 d-flex justify-content-center" style="position: absolute; margin-top: 10px; margin-left: 110px; background-color: #d7d7d7; border-radius: 50%; width: 40px; height: 40px">
                                                            <span id="plus-35" style="margin-top: 10px; font-size: 15px">+</span>
                                                            <img id="image-preview-35" class="image-preview" src="" style="margin-top: 10px" width="20px" height="20px" />
                                                        </div>
                                                    </label>
                                                    <label for="fb31_icon" style="display: contents">
                                                        <div id="small-icon-30" class="small-icon-5 d-flex justify-content-center" style="position: absolute; margin-top: 100px; margin-left: 110px; background-color: #d7d7d7; border-radius: 50%; width: 40px; height: 40px">
                                                            <span id="plus-36" style="margin-top: 10px; font-size: 15px">+</span>
                                                            <img id="image-preview-36" class="image-preview" src="" style="margin-top: 10px" width="20px" height="20px" />
                                                        </div>
                                                    </label>
                                                </div>
                                                <label for="cpaas_icon4" style="display: contents">
                                                    <div id="floating-button-2" style="z-index: 1000; background-color: grey; width: 60px; height: 60px; border-radius: 50%; text-align: center; margin-top: -245px; margin-left: 240px; position: absolute">
                                                        <div id="plus-31" style="padding-top: 12px; font-size: 25px">+</div>
                                                        <img id="image-preview-31" class="image-preview" src="" width="60" height="60" />
                                                    </div>
                                                </label>
                                            </div>

                                            <!-- END FLOATING AREA SIMULATOR 2 -->
                                            <p class="text-center mt-3" data-translate="dashform-45">Click "<b>+</b>" to insert new Icon.</p>
                                            <p id="drag-drop-text" class="text-center" data-translate="dashform-46"><b>Drag</b> and <b>Drop</b> Icon to set Icon Position</p>
                                            <!-- <p class="text-center"><b>Drop</b> Icon outside the phone to delete Icon.</p> -->

                                            <div id="sub-floating-button-3">
                                                <div class="contact-center gx-0 d-flex justify-content-center">
                                                    <p style="z-index: 1000">Contact Center</p>
                                                </div>
                                                <div class="message gx-0 d-flex justify-content-center">
                                                    <p style="z-index: 1000">Message</p>
                                                </div>
                                                <div class="call gx-0 d-flex justify-content-center">
                                                    <p style="z-index: 1000">Call</p>
                                                </div>
                                                <div class="new-post gx-0 d-flex justify-content-center">
                                                    <p>New Post</p>
                                                </div>
                                                <div class="live-streaming gx-0 d-flex justify-content-center">
                                                    <p style="z-index: 1000">Live Streaming</p>
                                                </div>
                                            </div>

                                            <div id="sub-floating-button-4" style="z-index: 100">
                                                <div class="home-2 gx-0 d-flex justify-content-center">
                                                    <p style="z-index: 1000">Tab 1</p>
                                                </div>
                                                <div class="chats-2 gx-0 d-flex justify-content-center">
                                                    <p style="z-index: 1000">Tab 2</p>
                                                </div>
                                                <div class="contents-2 gx-0 d-flex justify-content-center">
                                                    <p style="z-index: 1000">Tab 3</p>
                                                </div>
                                                <div class="settings-2 gx-0 d-flex justify-content-center">
                                                    <p style="z-index: 1000">Tab 4</p>
                                                </div>
                                            </div>

                                            <div id="sub-docked-button-3">
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

                                            <div id="sub-docked-button-4">
                                                <div class="home gx-0 d-flex justify-content-center">
                                                    <p style="z-index: 1000">Tab 1</p>
                                                </div>
                                                <div class="chats gx-0 d-flex justify-content-center">
                                                    <p style="z-index: 1000">Tab 2</p>
                                                </div>
                                                <div class="contents gx-0 d-flex justify-content-center">
                                                    <p style="z-index: 1000">Tab 3</p>
                                                </div>
                                                <div class="settings gx-0 d-flex justify-content-center">
                                                    <p style="z-index: 1000">Tab 4</p>
                                                </div>
                                            </div>

                                            <div id="sub-burger-button-2">
                                                <div class="home-3 gx-0 d-flex justify-content-center">
                                                    <p style="z-index: 1000">Tab 1</p>
                                                </div>
                                                <div class="chats-3 gx-0 d-flex justify-content-center">
                                                    <p style="z-index: 1000">Tab 2</p>
                                                </div>
                                                <div class="contents-3 gx-0 d-flex justify-content-center">
                                                    <p style="z-index: 1000">Tab 3</p>
                                                </div>
                                                <div class="settings-3 gx-0 d-flex justify-content-center">
                                                    <p style="z-index: 1000">Tab 4</p>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <!-- END PHONE SIMULATOR 2 -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4 d-flex justify-content-end">
                    <div class="col-md-12 text-center">
                        <button class="btn mt-2 mb-5 btn-yellow" type="button" id="submit-form" onclick="sendData()" data-translate="dashform-50">
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
                <p class="mt-3 mx-2" data-translate="dashform-67">
                    Please don't refresh or change this page until the download starts.
                </p>
                <div class="text-center">
                    <img src="assets/loading_build.gif" style="width: 50%"><br />
                    <small data-translate="dashform-68">Build APK in progress...</small><br />
                    <p class="mt-4" data-translate="dashform-69">Usually takes about <b>12-15 minutes.</b></p>
                </div>
                <div class="text-start card p-4 shadow mt-3 m-2" style="padding-bottom: 10px !important">
                    <div id="build-start-time"></div>
                    <div id="build-end-time" class="mt-3 mb-3"></div>
                </div>
            </div>
            <!-- </form> -->
        </div>
    </div>
</div>
<div class="modal fade" id="buildSuccessModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <p class="mt-3 mx-2" data-translate="dashform-70">
                    Build finished. You can refresh the page.
                </p>
            </div>
            <!-- </form> -->
        </div>
    </div>
</div>

<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/dashboardv2/dashboard_footer.php'); ?>

<!-- <script src="js/support.js?<?php echo $version; ?>"></script> -->

<script>
    var ver_code = <?= $ver_code ?>;
    var company_id = <?= $session_company ?>;
</script>

<script src="js/webappform_dev.js?<?php echo $version; ?>"></script>

<script>
    // $('#lang-nav').hover(function(){
    //     $('#lang-menu').dropdown("show");
    //     }, function(){
    //     $('#lang-menu').dropdown("hide");
    // });

    // $('#lang-menu').hover(function(){
    //     $('#lang-menu').dropdown("show");
    //     }, function(){
    //     $('#lang-menu').dropdown("hide");
    // });

    if (localStorage.lang == 1) {
        $('#companyName').attr('placeholder', 'Nama Perusahaan');
        $('.category-name').attr('placeholder', 'Masukan nama kategori');
        $('#companyWebsite').attr('placeholder', 'URL Website');
    }

    $("#change-lang-EN").click(function() {
        localStorage.lang = 0;
        $("#lang-nav").text('EN');
        $('#companyName').attr('placeholder', 'Company Name');
        $('.category-name').attr('placeholder', 'Insert category name');
        $('#companyWebsite').attr('placeholder', 'Website URL');
        change_lang();
    });

    $("#change-lang-ID").click(function() {
        localStorage.lang = 1;
        $("#lang-nav").text('ID');
        $('#companyName').attr('placeholder', 'Nama Perusahaan');
        $('.category-name').attr('placeholder', 'Masukan nama kategori');
        $('#companyWebsite').attr('placeholder', 'URL Website');
        change_lang();
    });

    $('#background').change(function(e) {
        e.preventDefault();

        $('#no-chosen-bg').hide();
        $('#bg-upload-name').removeClass('d-none');
        $('#bg-upload-name').attr('placeholder', this.files[0].name);
    });

    $('#background_edit').change(function(e) {
        e.preventDefault();

        $('#no-chosen-bg-edit').hide();
        $('#bg-upload-name-edit').removeClass('d-none');
        $('#bg-upload-name-edit').attr('placeholder', this.files[0].name);
    });

    $('#splashscreen').change(function(e) {
        e.preventDefault();

        $('#no-chosen-splash').hide();
        $('#splash-upload-name').removeClass('d-none');
        $('#splash-upload-name').attr('placeholder', this.files[0].name);
    });

    $('#appCertificate').change(function(e) {
        e.preventDefault();

        $('#no-chosen-certif').hide();
        $('#certif-upload-name').removeClass('d-none');
        $('#certif-upload-name').attr('placeholder', this.files[0].name);
    });

    $('#inputAlias').on('input', function() {

        let val = $('#inputAlias').val();

        if (val.length < 6) {
            $('#alias-error-text').removeClass('d-none');
        } else {
            $('#alias-error-text').addClass('d-none');
        }

        checkLength();

    })

    $('#keyPassword').on('input', function() {

        let val = $('#keyPassword').val();

        if (val.length < 8) {
            $('#key-password-error-text').removeClass('d-none');
        } else {
            $('#key-password-error-text').addClass('d-none');
        }

        checkLength();

    })

    $('#storePassword').on('input', function() {

        let val = $('#storePassword').val();

        if (val.length < 8) {
            $('#key-store-password-error-text').removeClass('d-none');
        } else {
            $('#key-store-password-error-text').addClass('d-none');

        }

        checkLength();

    })

    function checkLength() {

        let inputAlias = $('#inputAlias').val();
        let keyPassword = $('#keyPassword').val();
        let storePassword = $('#storePassword').val();

        if (inputAlias.length >= 6 && keyPassword.length >= 8 && storePassword.length >= 8) {
            $('#submit-form').attr('disabled', false);
        } else {
            $('#submit-form').attr('disabled', true);
        }

    }

    var menuTypeValue = $("#menuType").val();

    if (menuTypeValue == 0) {
        $("#palio-balloon").show();
        $(".docked-content").hide();
        $(".docked-content-2").show();
        $("#burger-area").hide();
        $("#sub-floating-button").show();
        $("#sub-floating-button-2").show();
        $("#sub-docked-button").hide();
        $("#sub-docked-button-2").hide();
        $("#sub-burger-button").hide();

        $('#show_fb_options').addClass('d-none');
        $('#show_fb_options').html('');

        let fb_pp_radio = `
        <label class="col-sm-4 col-form-label" for="access_model">Use Floating Button image as Profile Pict. :</label>

        <div class="col-sm-8">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="fb_pp" id="fb_pp1" value="1">
                <label class="form-check-label" for="fb_pp1">Yes</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="fb_pp" id="fb_pp0" value="0" checked>
                <label class="form-check-label" for="fb_pp0">No</label>
            </div>
        </div>
        `

        $('#fb_pp_options').html(fb_pp_radio);
        $('#fb_pp_options').removeClass('d-none');
    } else if (menuTypeValue == 1) {
        $("#palio-balloon").hide();
        $(".docked-content").show();
        $(".docked-content-2").hide();
        $("#burger-area").hide();
        $("#sub-floating-button").hide();
        $("#sub-floating-button-2").hide();
        $("#sub-docked-button").show();
        $("#sub-docked-button-2").show();
        $("#sub-burger-button").hide();

        let show_fb_radio = `
        <label class="col-sm-4 col-form-label" for="access_model">Show Floating Button :</label>

        <div class="col-sm-8">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="show_fb" id="show_fb1" value="1">
                <label class="form-check-label" for="show_fb1">Yes</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="show_fb" id="show_fb0" value="0" checked>
                <label class="form-check-label" for="show_fb0">No</label>
            </div>
        </div>`

        let fb_pp_radio = `
        <label class="col-sm-4 col-form-label" for="access_model">Use Floating Button image as Profile Pict. :</label>

        <div class="col-sm-8">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="fb_pp" id="fb_pp1" value="1">
                <label class="form-check-label" for="fb_pp1">Yes</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="fb_pp" id="fb_pp0" value="0" checked>
                <label class="form-check-label" for="fb_pp0">No</label>
            </div>
        </div>
        `

        $('#fb_pp_options').html(fb_pp_radio);
        $('#fb_pp_options').removeClass('d-none');

        $('#show_fb_options').html(show_fb_radio);
        $('#show_fb_options').removeClass('d-none');
    } else {
        $("#palio-balloon").hide();
        $(".docked-content").hide();
        $(".docked-content-2").show();
        $("#burger-area").show();
        $("#sub-floating-button").hide();
        $("#sub-floating-button-2").hide();
        $("#sub-docked-button").hide();
        $("#sub-docked-button-2").hide();
        $("#sub-burger-button").show();

        $('#show_fb_options').addClass('d-none');
        $('#show_fb_options').html('');

        $('#fb_pp_options').html('');
        $('#fb_pp_options').addClass('d-none');
    }
</script>