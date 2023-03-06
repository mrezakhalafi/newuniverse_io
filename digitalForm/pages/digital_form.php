<?php
    if (isset($_REQUEST['form_id'])) {
        $form_id = $_REQUEST['form_id'];
    }
    else{
        $form_id = "14045";
    }
    if(isset($_REQUEST['user_id'])){
        $user_id = $_REQUEST['user_id'];
    }
    else{
        $user_id = "63234";
    }
    $form = include_once($_SERVER['DOCUMENT_ROOT'] . '/digitalForm/logics/fetch_form.php');
    $form_item = include_once($_SERVER['DOCUMENT_ROOT'] . '/digitalForm/logics/fetch_form_item.php');
?>

<!doctype html>
<html lang="en">

<head>
    <title><?php echo $form[0]["TITLE"]; ?></title>
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

    <div class="jumbotron text-center">
        <h1><?php echo $form[0]["TITLE"]; ?></h1>
    </div>

    <div class="container-fluid">
        <form id="digitalForm" name="digitalForm">
        <?php 
            foreach($form_item as $item){
                $item_type = $item["TYPE"];
                if($item_type == '6'){
                    echo '<div class="form-group">'.'<label for="'.$item["KEY"].'">'.$item["LABEL"].'</label>';
                    echo '<input type="text" class="form-control" id="'.$item["KEY"].'" name="'.$item["KEY"].'"></div>';
                }
                else if($item_type == '11'){
                    echo '<div class="form-group">'.'<label for="'.$item["KEY"].'">'.$item["LABEL"].'</label>';
                    echo '<textarea class="form-control" rows="5" id="'.$item["KEY"].'" name="'.$item["KEY"].'"></textarea></div>';
                }
                else if($item_type == '14'){
                    echo '<div class="form-group">'.'<label for="'.$item["KEY"].'">'.$item["LABEL"].'</label>';
                    echo '<div class="custom-file">
                    <input type="file" class="custom-file-input" id="'.$item["KEY"].'" name="'.$item["KEY"].'">
                    <label class="custom-file-label" for="'.$item["KEY"].'">Choose file</label>
                        </div></div>';
                }
                else if($item_type == '15'){
                    echo '<div class="form-group">'.'<label for="'.$item["KEY"].'">'.$item["LABEL"].'</label>';
                    echo '<div class="custom-file">
                    <input type="file" class="custom-file-input" id="'.$item["KEY"].'" name="'.$item["KEY"].'">
                    <label class="custom-file-label" for="'.$item["KEY"].'">Choose file</label>
                        </div></div>';
                }
                else if($item_type == '1'){
                    echo '<div class="form-group"><label for="'.$item["KEY"].'">'.$item["LABEL"].'</label>'.
                    '<input type="date" class="form-control" id="'.$item["KEY"].'" name="'.$item["KEY"].'"/>
                    </div>';
                }
                else if($item_type == '2'){
                    echo '<div class="form-group"><label for="'.$item["KEY"].'">'.$item["LABEL"].'</label>'.
                    '<input type="datetime" class="form-control" id="'.$item["KEY"].'" name="'.$item["KEY"].'"/>
                    </div>';
                }
                else if($item_type == '3'){
                    echo '<div class="form-group"><label for="'.$item["KEY"].'">'.$item["LABEL"].'</label>'.
                    '<input type="time" class="form-control" id="'.$item["KEY"].'" name="'.$item["KEY"].'"/>
                    </div>';
                }
                else if($item_type == '5'){
                    echo '<div class="form-group"><label for="'.$item["KEY"].'">'.$item["LABEL"].'</label>'.
                    '<input type="number" class="form-control" id="'.$item["KEY"].'" name="'.$item["KEY"].'"/>
                    </div>';
                }
                else if($item_type == '12'){
                    echo '<div class="form-group form-check">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" value="'.$item["VALUE"].'" id="'.$item["KEY"].'" name="'.$item["KEY"].'">'.$item["LABEL"].'
                    </label>
                  </div>';
                }
            }
        ?>
        <input type="submit" class="btn btn-primary" value="Submit">
        <button type="reset" class="btn btn-secondary">Reset</button>
        </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script>
        var FORM_ID = "<?= $form_id ?>";
        var USER_ID = "<?= $user_id ?>";
    </script>
    <script src="../assets/js/digital_form.js"></script>
</body>