<?php
if (isset($_GET['form_id'])) {
    $form_id = $_GET['form_id'];
} else {
    $form_id = "14045";
}
$form_items = include_once($_SERVER['DOCUMENT_ROOT'] . '/dashboardv2/logics/fetch_form_item.php');
?>
<?php
foreach ($form_items as $item) {
    echo '<div class="form-group form-row form-item" id="item-' . $item["SQ_NO"] . '">';
    echo '<div class="col-sm-6 col-md" style="margin-bottom: 7px">';
    echo '<input type="text" class="form-control item-label" placeholder="Label" value="' . $item["LABEL"] . '" required style="border-radius: 5px; font-size: 12px;">';
    echo '</div>';
    echo '<div class="col-sm-6 col-md" style="margin-bottom: 7px">';
    echo '<input type="text" class="form-control item-key" placeholder="Key" value="' . $item["KEY"] . '" required style="border-radius: 5px; font-size: 12px;">';
    echo '</div>';
    echo '<div class="col-sm-6 col-md" style="margin-bottom: 7px" class="default-value" id="default-value-' . $item["SQ_NO"] . '">';
    if ($item["TYPE"] == "12") {
        echo '<select style="border-radius: 5px; font-size: 12px;" class="form-control item-value">';
        // echo '<option '. $item["VALUE"] == "1" ? 'selected' : ''.' value="1">Checked</option>';
        // echo '<option '. $item["VALUE"] == "0" ? 'selected' : ''.'value="0">Unchecked</option>';
        if ($item["VALUE"] == "1") {
            echo '<option selected value="1">Checked</option>';
            echo '<option value="0">Unchecked</option>';
        } else {
            echo '<option value="1">Checked</option>';
            echo '<option selected value="0">Unchecked</option>';
        }
        echo '</select>';
    } else {
        // echo '<input type="text" class="form-control item-key" placeholder="Key" value="' . $item["KEY"] . '" required>';
        if (!is_null($item["VALUE"])) {
            echo '<input type="text" class="form-control item-value" value="' . $item["VALUE"] . '" placeholder="Default Value" style="border-radius: 5px; font-size: 12px;">';
        } else {
            echo '<input type="text" class="form-control item-value" placeholder="Default Value" style="border-radius: 5px; font-size: 12px;">';
        }
    }
    echo '</div>';
    echo '<div class="col-sm-6 col-md" style="margin-bottom: 7px">';
    echo '<select class="form-control item-select" style="border-radius: 5px; font-size: 12px;" id="type-' . $item["SQ_NO"] . '" onchange="changeType(this.id)">';
    if ($item["TYPE"] == "6") {
        echo '<option selected value="6">Text</option>';
    } else {
        echo '<option value="6">Text</option>';
    }
    if ($item["TYPE"] == "11") {
        echo '<option selected value="11">Multiline Text</option>';
    } else {
        echo '<option value="11">Multiline Text</option>';
    }
    if ($item["TYPE"] == "5") {
        echo '<option selected value="5">Number</option>';
    } else {
        echo '<option value="5">Number</option>';
    }
    if ($item["TYPE"] == "2") {
        echo '<option selected value="2">Date & Time</option>';
    } else {
        echo '<option value="2">Date & Time</option>';
    }
    if ($item["TYPE"] == "1") {
        echo '<option selected value="1">Date</option>';
    } else {
        echo '<option value="1">Date</option>';
    }
    if ($item["TYPE"] == "3") {
        echo '<option selected value="3">Time</option>';
    } else {
        echo '<option value="3">Time</option>';
    }
    if ($item["TYPE"] == "4") {
        echo '<option selected value="4">Select</option>';
    } else {
        echo '<option value="4">Select</option>';
    }
    if ($item["TYPE"] == "8") {
        echo '<option selected value="8">Select multiple</option>';
    } else {
        echo '<option value="8">Select multiple</option>';
    }
    if ($item["TYPE"] == "7") {
        echo '<option selected value="7">Radio button</option>';
    } else {
        echo '<option value="7">Radio button</option>';
    }
    if ($item["TYPE"] == "12") {
        echo '<option selected value="12">Checkbox</option>';
    } else {
        echo '<option value="12">Checkbox</option>';
    }
    if ($item["TYPE"] == "14") {
        echo '<option selected value="14">File attachment</option>';
    } else {
        echo '<option value="14">File attachment</option>';
    }
    if ($item["TYPE"] == "15") {
        echo '<option selected value="15">Photo/Image</option>';
    } else {
        echo '<option value="15">Photo/Image</option>';
    }
    if ($item["TYPE"] == "20") {
        echo '<option selected value="20">Canvas/Drawing</option>';
    } else {
        echo '<option value="20">Canvas/Frawing</option>';
    }
    if ($item["TYPE"] == "24") {
        echo '<option selected value="24">OCR</option>';
    } else {
        echo '<option value="24">OCR</option>';
    }
    if ($item["TYPE"] == "0") {
        echo '<option selected value="0">Label/Header</option>';
    } else {
        echo '<option value="0">Label/Header</option>';
    }
    if ($item["TYPE"] == "25") {
        echo '<option selected value="25">Pricing</option>';
    } else {
        echo '<option value="25">Pricing</option>';
    }
    // if (count($form_items) == 1) {
        if ($item["TYPE"] == "26") {
            $btn_option = count($form_items) == 1 ? '<option selected class="btn_option" value="26">Button</option>' : '<option selected class="btn_option d-none" value="26">Button</option>';
            // echo '<option selected value="26">Button</option>';
            echo $btn_option;
        } else {
            // echo '<option value="26">Button</option>';
            $btn_option = count($form_items) == 1 ? '<option class="btn_option" value="26">Button</option>' : '<option class="btn_option d-none" value="26">Button</option>';
            echo $btn_option;
        }
    // }
    echo '</select>';
    echo '</div>';
    echo '<div class="col-12 col-md-2 pl-1 pr-0 d-flex align-items-center">';
    echo '<button type="button" class="btn btn-danger delete-button" style="width: 100%; font-size: 12px;" data-translate="dashnf-9">DELETE</button>';
    echo '</div>';
    echo '<div class="subitem-area"></div></div>';
    
    $button_info = '<div class="row button-info d-none mt-1">
        <div class="col-12" style="font-size:11px">
            You can add buttons with these default functions by adding them to the <strong>Default Value</strong> input:
            <ul>
                <li>
                    <strong>cc</strong> - sets up a call center session
                </li>
                <li>
                    <strong>call_&lt;phone_number&gt;</strong> - replace &lt;phone_number&gt; with a number; sets up a phone call
                </li>
            </ul>
        </div>
    </div>';

    echo $button_info;
}
?>