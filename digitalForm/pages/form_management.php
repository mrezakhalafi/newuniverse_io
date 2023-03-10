<?php
    if (isset($_REQUEST['user_id'])) {
        $user_id = $_REQUEST['user_id'];
    }
    else{
        $user_id = "029c327a22";
    }
    $forms = include_once($_SERVER['DOCUMENT_ROOT'] . '/digitalForm/logics/fetch_forms.php');
?>

<!doctype html>
<html lang="en">

<head>
    <title>Timeline</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;1,100;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- <script src="https://kit.fontawesome.com/c6d7461088.js" crossorigin="anonymous"></script> -->
</head>
<body>
    
    <div class="container-fluid">
        <?php
        echo '<a href="edit_form.php?user_id='.$user_id.'" role="button" class="btn btn-primary my-2">Create New Form</a>';
        ?>
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
                <?php
                    $index = 1;
                     foreach($forms as $form){
                         echo '<tr>';
                            echo '<td>'.$index.'</td>';
                            echo '<td>'.$form["TITLE"].'</td>';
                            echo '<td>'.
                            '<a href="edit_form.php?form_id='.$form["FORM_ID"].'" role="button" class="mr-2 btn btn-secondary btn-edit">Edit</a>'.
                            '<button type="button" value="'.$form["FORM_ID"].'" class="btn btn-danger btn-delete">Delete</button>'.'</td>';
                         echo '</tr>';
                         $index++;
                     }   
                ?>
            </tbody>
        </table>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script>
        var FORM_ID = "<?php echo $form_id; ?>";
        var USER_ID = "<?php echo $user_id; ?>";
    </script>
    <script src="../assets/js/form_management.js"></script>
</body>