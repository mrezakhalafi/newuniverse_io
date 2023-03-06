<?php
    $index = $_GET["index"];
?>
<div class="form-group form-row form-item">
    <div class="col">
        <input type="text" class="form-control item-label" placeholder="Label" required>
    </div>
    <div class="col">
        <input type="text" class="form-control item-key" placeholder="Key" required>
    </div>
    <div class="col">
        <input type="text" class="form-control item-value" placeholder="Default Value">
    </div>
    <div class="col">
        <select class="form-control item-select">
            <option selected value="6">Text</option>
            <option value="11">Multiline Text</option>
            <option value="5">Number</option>
            <option value="2">Date & Time</option>
            <option value="1">Date</option>
            <option value="3">Time</option>
            <option value="12">Checkbox</option>
        </select>
    </div>
    <div class="col">
        <button type="button" class="btn btn-danger delete-button">Delete</button>
    </div>
    <div class="subitem-area"></div>
</div>