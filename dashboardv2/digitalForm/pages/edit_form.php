<?php

$user_id = getSession('survey_fpin');

if (isset($_GET['form_id'])) {
    $form_id = $_GET['form_id'];
    $form = include_once($_SERVER['DOCUMENT_ROOT'] . '/digitalForm/logics/fetch_form.php');
} else {
    $form_id = "0";
}
// if (isset($_GET['user_id'])) {
//     $user_id = $_GET['user_id'];
// }
// else{
//     $user_id = "0";
// }
?>

<!-- <!doctype html>
<html lang="en">

<head>
    <title>Edit Form</title> -->
<!-- Required meta tags -->
<!-- <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> -->

<!-- Bootstrap CSS -->
<!-- <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;1,100;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
<!-- <script src="https://kit.fontawesome.com/c6d7461088.js" crossorigin="anonymous"></script> -->
<!-- </head>
<body> -->
<div class="content-wrapper">
    <!-- Main content -->
    <div class="content">
        <div class="jumbotron text-center">
            <h1><?php if ($form_id != '0') {
                    echo "Edit Form";
                } else {
                    echo "New Form";
                } ?></h1>
        </div>

        <div class="container-fluid">
            <form id="form-editor">;
                <div class="form-group">
                    <label for="title">Title</label>
                    <!-- <input type="text" class="form-control" id="title" value="" required> -->
                    <?php
                    if ($form_id != "0") {
                        echo '<input type="text" class="form-control" id="title" value="' . $form[0]["TITLE"] . '" required>';
                    } else {
                        echo '<input type="text" class="form-control" id="title" required>';
                    }
                    ?>
                </div>
                <div id="form-items"></div>
                <input type="submit" class="btn btn-primary" value="Submit">
                <button type="button" class="btn btn-success add-item-button">Add Item</button>
            </form>
        </div>
    </div>
</div>

<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/dashboardv2/dashboard_footer.php'); ?>


<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> -->
<script>
    var FORM_ID = "<?php echo $form_id; ?>";
    var USER_ID = "<?php echo $user_id; ?>";

    var survey_fpin = "<?php echo getSession("survey_fpin"); ?>";
</script>
<script src="../assets/js/edit_form.js"></script>