<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/dashboardv2/dashboard_header.php'); ?>

<?php

$user_id = getSession('survey_fpin');

$form_id = "0";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_GET['form_id'])) {
    // echo "get exist";
    $form_id = $_GET['form_id'];
    $form = include_once($_SERVER['DOCUMENT_ROOT'] . '/dashboardv2/logics/fetch_form.php');
}
// if (isset($_GET['user_id'])) {
//     $user_id = $_GET['user_id'];
// }
// else{
//     $user_id = "0";
// }
?>
<div class="content-wrapper">
    <!-- Main content -->
    <div class="content" style="padding-left: 64px; padding-right: 64px;">
        <div class="col">
            <div class="row">
                <div class="col-6 d-flex align-items-center">
                    <a href="form_management.php" style="color: grey; font-size: 14px;"><i class="fas fa-chevron-left mr-1"></i><span data-translate="dashnf-1">Back</span></a>
                </div>
                
            </div>
            <hr style="margin: 0; margin-bottom: 20px; margin-top: 20px;">
            <div class="row">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card" id="inbox" style="padding: unset; min-height: 75vh;">
                                <h4 class="card-name font-medium m-0" style="padding: 1.5rem">
                                    <?php
                                        if (isset($_GET['form_id'])) {
                                            echo '<span data-translate="dashnf-8">Edit Form</span>';
                                        } else {
                                            echo '<span data-translate="dashnf-7">New Form</span>';
                                        }
                                    ?>
                                </h4>
                                <div class="container-fluid py-0" style="padding: 1.5rem;">
                                    <form id="form-editor">
                                        <input type="hidden" id="company" value="<?php echo $id_company; ?>">
                                        <div class="form-group mb-4">
                                            <label for="title" style="font-size: 14px;" data-translate="dashnf-2">TITLE*</label>
                                            <?php
                                            if ($form_id != "0") {
                                                echo '<input style="border-radius: 5px;" type="text" class="form-control" id="title" value="' . $form[0]["TITLE"] . '" required oninput="setCustomValidity(``)" oninvalid="if (localStorage.lang == 1){ this.setCustomValidity(`Harap isi field ini.`) }else{ this.setCustomValidity(`Please fill this field.`) }"">';
                                            } else {
                                                echo '<input style="border-radius: 5px;" type="text" class="form-control" id="title" required oninput="setCustomValidity(``)" oninvalid="if (localStorage.lang == 1){ this.setCustomValidity(`Harap isi field ini.`) }else{ this.setCustomValidity(`Please fill this field.`) }">';
                                            }
                                            ?>
                                        </div>
                                        <button id="add-form" type="button" class="btn btn-success add-item-button px-4 py-1 mb-4" style="font-size: 14px; border: solid 1px #6945A5; background-color: white; color: #6945A5;" data-translate="dashnf-3">ADD ITEM</button>
                                        <p class="mb-0" style="font-size:12px;"><strong data-translate="dashnf-4">Note:</strong></p>
                                        <p class="mb-0" style="font-size:12px;" data-translate="dashnf-5"> You can add an asterisk (*) to the value of "Label" field to make it mandatory/required. Example: "First Name*"</p>
                                        <p style="font-size:12px;" data-translate="dashnf-6">For types with multiple options such as <strong>Select</strong> or <strong>Button</strong>, you can input multiple values in the <strong>Default Value</strong> column separated by comma.</p>
                                        <div id="form-items"></div>
                                        <div class="d-flex align-items-center justify-content-center mt-5" style="width: 100%;">
                                            <input type="submit" id="btn-submit" class="btn text-white px-4" style="background-color: #6945A5; font-size: 12px;" value="SUBMIT">
                                        </div>
                                    </form>
                                </div>
                                <div class="card-body" style="padding: unset;">
                                    <div class="table-responsive mailbox-messages">
                                        <table class="table table-hover table-striped">
                                            <tbody>
                                                <?php $number = 0;
                                                while ($row = $itemMessage->fetch_assoc()) { ?>
                                                    <tr style="background-color: <?= $row['IS_READ'] != 1 ? '#f7f6fb' : 'unset'; ?>"" class=" msgs" data-href='read-mail.php?id=<?php echo $row['ID']; ?>'>
                                                        <td></td>
                                                        <td><input type="checkbox" id="scales" name="scales"></td>
                                                        <td class="mailbox-name font-medium">Qmera Team
                                                            <?php if ($row['IS_READ'] != 1) {
                                                                echo "<span style='color: #FFA500;''>*</span>";
                                                            } ?>
                                                        </td>
                                                        <td class="mailbox-subject mail-title font-medium">
                                                            <?php
                                                            if ($row['M_ID'] == 1) echo $welcome;
                                                            else if ($row['M_ID'] == 6) echo $due_date;
                                                            else if ($row['M_ID'] == 2) echo $payment;
                                                            else if ($row['M_ID'] == 3) echo $overdue; //substr($message3, 0, 12)."...[TRIAL]";
                                                            else if ($row['M_ID'] == 4) echo $cutoff_date; //substr($message4, 0, 12)."...[DUE DATE]";
                                                            else if ($row['M_ID'] == 5) echo $terminate; //substr($message5, 0, 12)."...[PAYMENT]";
                                                            ?>
                                                        </td>
                                                        <td class="mailbox-subject">
                                                            <?php if ($row['IS_READ'] != 1) {
                                                                echo "<b>";
                                                            } ?>
                                                            <?php
                                                            if ($row['M_ID'] == 1) echo (substr($message1, 0, 100) . "...");
                                                            else if ($row['M_ID'] == 2) echo (substr($message2, 0, 100) . "...");
                                                            else if ($row['M_ID'] == 3) echo (substr($message3, 0, 100) . "...");
                                                            else if ($row['M_ID'] == 4) echo (substr($message4, 0, 100) . "...");
                                                            else if ($row['M_ID'] == 5) echo (substr($message5, 0, 50) . "...");
                                                            else if ($row['M_ID'] == 6) echo (substr($message6, 0, 100) . "...");
                                                            ?>
                                                            <?php if ($row['IS_READ'] != 1) {
                                                                echo "</b>";
                                                            } ?>
                                                        </td>
                                                        <td class="mailbox-date"><?php echo $row['MESSAGE_DATE']; ?></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> -->
<script>
    $('a.nav-link[href="billpayment.php"]').removeClass('active');
    $('a.nav-link[href="index.php"]').removeClass('active');
    $('a.nav-link[href="usage.php"]').removeClass('active');
    $('a.nav-link[href="support.php"]').removeClass('active');
    $('a.nav-link[href="mailbox.php"]').removeClass('active');
    $('a.nav-link[href="webappform.php"]').removeClass('active');
    $('a.nav-link[href="form_management.php"]').addClass('active');
    var form_id = "<?php echo $form_id; ?>";
    var user_id = "<?php echo $user_id; ?>";

    var survey_fpin = "<?php echo getSession("survey_fpin"); ?>";
</script>
<script src="assets/js/edit_form.js?v=<?php echo time(); ?>"></script>

<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/dashboardv2/dashboard_footer.php'); ?>

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

    $("#change-lang-EN").click(function () {
		localStorage.lang = 0;
		$("#lang-nav").text('EN');
        $('#btn-submit').val('SUBMIT');
		change_lang();
	});

	$("#change-lang-ID").click(function () {
		localStorage.lang = 1;
		$("#lang-nav").text('ID');
        $('#btn-submit').val('KIRIM');
		change_lang();
	}); 


    if (localStorage.lang == 1){
        $('#btn-submit').val('KIRIM');
    }

</script>