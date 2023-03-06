<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/dashboardv2/dashboard_header.php'); ?>

<?php
// if (isset($_REQUEST['user_id'])) {
//     $user_id = $_REQUEST['user_id'];
// }
// else{
//     $user_id = "029c327a22";
// }

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// state control
$_SESSION['previous_page'] = $_SESSION['current_page'];
$_SESSION['current_page'] = 14;
require_once($_SERVER['DOCUMENT_ROOT'] . '/state_control.php');

// $forms = include_once($_SERVER['DOCUMENT_ROOT'] . '/dashboardv2/logics/fetch_forms.php');

// echo "jangan deh ";
$dbConnPalioLite = dbConnPalioLite();
$company_id = $_SESSION['id_company'];

$fpin_query = $dbConnPalioLite->prepare("SELECT gr.CREATED_BY FROM BUSINESS_ENTITY be, `GROUPS` gr WHERE be.COMPANY_ID = ".$company_id."
    AND gr.BUSINESS_ENTITY = be.ID
    AND gr.IS_ORGANIZATION = 1");
//$fpin_query->bind_param("s", $company_id);
$fpin_query->execute();
$query_result = $fpin_query->get_result()->fetch_assoc();
$survey_fpin = $query_result['CREATED_BY'];
$fpin_query->close();
// echo "pa kek ";

// echo " ". $survey_fpin;
setSession('survey_fpin', $survey_fpin);

$user_id = $survey_fpin;

$forms_query = "SELECT * FROM `FORM` WHERE `CREATED_BY`='".$user_id."' ORDER BY SQ_NO";
$query = $dbConnPalioLite->prepare($forms_query);
$query->execute();
$groups  = $query->get_result();
$query->close();

$rows = array();
while ($group = $groups->fetch_assoc()) {
    $rows[] = $group;
};

$forms = $rows;

// get existing callback URL

$url = "";

try {

    $sqlBE = 'SELECT ID FROM `BUSINESS_ENTITY` be WHERE COMPANY_ID = ' . $company_id;
    $query = $dbConnPalioLite->prepare($sqlBE);
    $query->execute();
    $be_id = $query->get_result()->fetch_assoc();
    $query->close();

    $sqlCB = "SELECT * FROM CTA_CALLBACK cc WHERE cc.BE_ID = ".$be_id['ID'];
    $query = $dbConnPalioLite->prepare($sqlCB);
    $query->execute();
    $url_callback = $query->get_result()->fetch_assoc();
    $query->close();

    if ($url_callback != null && $url_callback["CALLBACK"] != "") {
        $url = $url_callback['CALLBACK'];
    }
} catch (Exception $e){
    
}

?>
<style>

    html,
    body {
        max-width: 100%;
        overflow-x: hidden;
    }

</style>

<div class="content-wrapper">
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <h4 class="card-name"><strong data-translate="dashdf-1">Form Management</strong></h4>
            <?php
            echo '<a href="edit_form.php" role="button" class="btn btn-primary my-2" data-translate="dashdf-2">Create New Form</a>';
            ?>
            <table class="table">
                <thead>
                    <tr>
                        <th data-translate="dashdf-3">No.</th>
                        <th data-translate="dashdf-4">Form ID</th>
                        <th data-translate="dashdf-5">Title</th>
                        <th data-translate="dashdf-6">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $index = 1;
                    foreach ($forms as $form) {
                        echo '<tr>';
                        echo '<td>' . $index . '</td>';
                        echo '<td>' . $form["FORM_ID"] . '</td>';
                        echo '<td>' . $form["TITLE"] . '</td>';
                        echo '<td>' .
                            '<a href="edit_form.php?form_id=' . $form["FORM_ID"] . '" role="button" class="mr-2 btn btn-secondary btn-edit" style="width: 65px; margin-bottom: 5px; font-size: 12px;" data-translate="dashdf-7">EDIT</a>' .
                            '<button type="button" value="' . $form["FORM_ID"] . '" class="btn btn-danger btn-delete" style="width: 65px; margin-bottom: 5px; font-size: 12px;" data-translate="dashdf-8">DELETE</button>' . '</td>';
                        echo '</tr>';
                        $index++;
                    }
                    ?>
                </tbody>
            </table>

            
        </div>
        <div class="container-fluid">
            <h5 class="card-name" data-translate="dashdf-9">Form Callback</h5>
            <p data-translate="dashdf-10">
                Set a form callback URL.
            </p>
            <div class="row">
                <div class="col-8">
                    <input type="text" id="url-callback" class="form-control mb-1" name="url_callback" placeholder="www.url.com" required="" <?= $url != "" ? "value=\"$url\"" : ""?>>
                    <p style="font-size:12px" data-translate="dashdf-11"><strong>Note</strong>: please make sure your website is secure/https enabled.</strong>
                    <p id="invalid-url" class="d-none" style="color:red;" data-translate="dashdf-12">
                        URL format invalid!
                    </p>
                </div>
                <div class="col-2">
                    <button id="save-url" class="btn btn-primary" data-translate="dashdf-13">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/dashboardv2/dashboard_footer.php'); ?>

<!-- 
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> -->
<script>
    // var FORM_ID = "<?php //echo $form_id; 
                        ?>";
    // var USER_ID = "<?php //echo $user_id; 
                        ?>";

    document.addEventListener('DOMContentLoaded', function() {
        $('a.nav-link[href="billpayment.php"]').removeClass('active');
        $('a.nav-link[href="index.php"]').removeClass('active');
        $('a.nav-link[href="usage.php"]').removeClass('active');
        $('a.nav-link[href="support.php"]').removeClass('active');
        $('a.nav-link[href="mailbox.php"]').removeClass('active');
        $('a.nav-link[href="webappform.php"]').removeClass('active');
        $('a.nav-link[href="form_management.php"]').addClass('active');
    }, false);

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

    $("#change-lang-EN").click(function () {
		localStorage.lang = 0;
		$("#lang-nav").text('EN');
		change_lang();
	});

	$("#change-lang-ID").click(function () {
		localStorage.lang = 1;
		$("#lang-nav").text('ID');
		change_lang();
	}); 


</script>
<script src="assets/js/form_management.js"></script>