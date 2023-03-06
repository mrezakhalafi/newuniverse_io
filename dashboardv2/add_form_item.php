<?php
$index = $_GET["index"];
// echo $index;
?>
<div class="form-group form-row form-item" id="item-<?= $index ?>">
    <!-- <div class="col-12 px-0"> -->
        <!-- <div class="row mx-0" style="width: 100%;"> -->
            <!-- <div class="col-11 pl-0 pr-2">
                <div class="row"> -->
                    <div class="col-sm-6 col-md" style="margin-bottom: 7px">
                        <input type="text" style="border-radius: 5px; font-size: 12px;" class="form-control item-label" placeholder="Label" required oninput="setCustomValidity(``)" oninvalid="if (localStorage.lang == 1){ this.setCustomValidity(`Harap isi field ini.`) }else{ this.setCustomValidity(`Please fill this field.`) }">
                    </div>
                    <div class="col-sm-6 col-md" style="margin-bottom: 7px">
                        <input type="text" style="border-radius: 5px; font-size: 12px;" class="form-control item-key" placeholder="Key" required oninput="setCustomValidity(``)" oninvalid="if (localStorage.lang == 1){ this.setCustomValidity(`Harap isi field ini.`) }else{ this.setCustomValidity(`Please fill this field.`) }">
                    </div>
                    <div class="col-sm-6 col-md" style="margin-bottom: 7px" class="default-value" id="default-value-<?= $index ?>">
                        <input type="text" style="border-radius: 5px; font-size: 12px;" class="form-control item-value" placeholder="Default Value">
                    </div>
                    <!-- <div class="col button-defaults d-none" id="button-defaults-<?= $index ?>">
                        <select style="border-radius: 5px; font-size: 12px;" class="form-control" onchange="changeButtonDefault">
                            <option selected disabled value="">Button default actions</option>
                            <option value="cc">Call Center</option>
                            <option value="call">Call a number</option>
                        </select>
                    </div>
                    <div class="col call-number d-none" id="call-number-<?= $index ?>">
                        <input type="text" style="border-radius: 5px; font-size: 12px;" class="form-control" placeholder="Phone number">
                    </div> -->
                    <div class="col-sm-6 col-md" style="margin-bottom: 7px">
                        <select style="border-radius: 5px; font-size: 12px;" class="form-control item-select form-type" id="type-<?= $index ?>" onchange="changeType(this.id)">
                            <option selected value="6">Text</option>
                            <option value="11">Multiline Text</option>
                            <option value="5">Number</option>
                            <option value="2">Date & Time</option>
                            <option value="1">Date</option>
                            <option value="3">Time</option>
                            <option value="4">Select</option>
                            <!-- <option value="8">Select multiple</option>
                            <option value="7">Radio button</option> -->
                            <option value="12">Checkbox</option>
                            <option value="14">File attachment</option>
                            <option value="15">Photo/Image</option>
                            <option value="20">Canvas/Drawing</option>
                            <option value="24">OCR</option>
                            <option value="0">Label/Header</option>
                            <option value="25">Pricing</option>

                            
                            <option class="btn_option <?= $index != 1 ? "d-none" : ""?>" value="26">Button</option>
                            
                            
                        </select>
                    </div>
            <div class="col-12 col-md-2 pl-1 pr-0 d-flex align-items-center">
                <button type="button" class="btn btn-danger delete-button" style="width: 100%; font-size: 12px;" data-translate="dashnf-9">DELETE</button>
            </div>
        </div>
        <div class="row button-info d-none mt-1">
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
            <!-- </div>
        </div> -->
    <!-- </div> -->

    <div class="subitem-area"></div>
</div>

<script>
    
</script>