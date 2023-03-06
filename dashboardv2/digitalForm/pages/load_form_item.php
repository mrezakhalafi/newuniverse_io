<?php
    if (isset($_GET['form_id'])) {
        $form_id = $_GET['form_id'];
    }
    else{
        $form_id = "14045";
    }
    $form_items = include_once($_SERVER['DOCUMENT_ROOT'] . '/digitalForm/logics/fetch_form_item.php');
?>
<?php 
    foreach($form_items as $item){
        echo '<div class="form-group form-row form-item" id="'.$item["ID"].'">';
        echo '<div class="col">';
            echo '<input type="text" class="form-control item-label" placeholder="Label" value="'.$item["LABEL"].'" required>';
        echo '</div>';
        echo '<div class="col">';
            echo '<input type="text" class="form-control item-key" placeholder="Key" value="'.$item["KEY"].'" required>';
        echo '</div>';
        echo '<div class="col">';
        if(!is_null($item["VALUE"])){
            echo '<input type="text" class="form-control item-value" value="'.$item["VALUE"].'" placeholder="Default Value">';
        }
        else{
            echo '<input type="text" class="form-control item-value" placeholder="Default Value">';
        }
        echo '</div>';
        echo '<div class="col">';
            echo '<select class="form-control item-select">';
                if($item["TYPE"] == "6"){
                    echo '<option selected value="6">Text</option>';
                }
                else{
                    echo '<option value="6">Text</option>';
                }
                if($item["TYPE"] == "11"){
                    echo '<option selected value="11">Multiline Text</option>';
                }
                else{
                    echo '<option value="11">Multiline Text</option>';
                }
                if($item["TYPE"] == "5"){
                    echo '<option selected value="5">Number</option>';
                }
                else{
                    echo '<option value="5">Number</option>';
                }
                if($item["TYPE"] == "2"){
                    echo '<option selected value="2">Date & Time</option>';
                }
                else{
                    echo '<option value="2">Date & Time</option>';
                }
                if($item["TYPE"] == "1"){
                    echo '<option selected value="1">Date</option>';
                }
                else{
                    echo '<option value="1">Date</option>';
                }
                if($item["TYPE"] == "3"){
                    echo '<option selected value="3">Time</option>';
                }
                else{
                    echo '<option value="3">Time</option>';
                }
                if($item["TYPE"] == "12"){
                    echo '<option selected value="12">Checkbox</option>';
                }
                else{
                    echo '<option value="12">Checkbox</option>';
                }
            echo '</select>';
        echo '</div>';
        echo '<div class="col">';
            echo '<button type="button" class="btn btn-danger delete-button">Delete</button>';
        echo '</div>';
        echo '<div class="subitem-area"></div></div>';
    }
?>