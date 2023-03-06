// var index = 1;

var default_item = $("#item-1").html();
var deleted_items = [];
var added_items = [];
var listeners = function () {
    $(".delete-button").click(function () {
        let itemId = $(this).closest('.form-item').attr('id');

        $(this).closest('.form-item#' + itemId).remove();
        if ($('.form-item').length == 1) {
            console.log('1 remaining');
            $('.form-item .btn_option').removeClass('d-none');
        } else if ($('.form-item').length == 0) {
            document.getElementById("add-form").disabled = false;
        }
    });
    $('.item-select').change(function () {
        $(this).closest('.form-item').find('.item-value').eq(0).val("");
    });

    // if form only has button
    if ($('#form-items .form-item').length == 1 && document.querySelector('#item-1 .item-select').value == '26') {
        $(".add-item-button").prop('disabled', true);
        $('.button-info').removeClass('d-none');
    }
};
var add_item = function (index) {
    $.get("add_form_item.php?index=" + index, function (data) {
        // $(data).appendTo("#form-items");
        $('#form-items').append(data);

        if (localStorage.lang == 1){
            $('.delete-button').text('HAPUS');
        }

        listeners();
        // added_items.push(index.toString());
        if ($('.form-item').length > 1){
            $('.btn_option').addClass('d-none');
        } else {
            $('.form-item .btn_option').removeClass('d-none');
        }
    });
};

$(".add-item-button").click(function () {
    var index = parseInt($('.form-item').last().attr('id'));
    index++;
    
    add_item(index);
    listeners();
});

var load_items = function () {
    $.get("load_form_item.php?form_id=" + form_id, function (data) {
        $(data).appendTo("#form-items");
        listeners();

        if (localStorage.lang == 1){
            $('.delete-button').text('HAPUS');
        }
    });
};

var insert_form = function () {
    // alert("insert form!");
    var body = {};
    var title = $('#title').val();
    body["title"] = title;
    body["user_id"] = user_id;
    body["be"] = $('#company').val();
    var items = [];
    $(".form-item").each(function (i, obj) {
        var item = {};
        item["label"] = $(this).find('.item-label')[0].value;
        item["key"] = $(this).find('.item-key')[0].value;
        item["value"] = $(this).find('.item-value')[0].value;
        item["type"] = $(this).find('.item-select')[0].value;
        items.push(item);
    });
    body["items"] = items;
    console.log(body);
    $.ajax({
        url: "/dashboardv2/logics/insert_form",
        type: "POST",
        dataType: "json",
        contentType: "application/json",
        data: JSON.stringify(body),
        success: function (result) {
            console.log(result);
            // $.ajax({ 
            //     url: "../../api/services/broadcast",
            //     type: "POST",
            //     data: {
            //         sender: USER_ID,
            //         target_audience: "5",
            //         broadcast_type: "1",
            //         broadcast_mode: "1",
            //         start_date: result["timestamp"],
            //         category: "0",
            //         title: title,    
            //         message: "Please fill in this survey.",
            //         form_id: ""+result["form_id"],
            //         destinations: "029c271bf8"
            //     }
            // });
            if (localStorage.lang == 0) {
                alert("insert form success!");
            }
            else {
                alert("form berhasil ditambahkan!");
            }
            window.location.href = "/dashboardv2/form_management.php";
        },
        error: function (request, status, error) {
            console.log(request.responseText);
            alert("insert form error!");
        }
    });
};

function changeType(eleId) {        

    var formType = document.getElementById(eleId).value;

    console.log('type', formType);

    let selectCheckbox = `
    <select style="border-radius: 5px; font-size: 12px;" class="form-control item-value">
        <option selected value="1">Checked</option>
        <option value="0">Unchecked</option>
    </select>
    `;

    let textDefaultValue = `
    <input type="text" style="border-radius: 5px; font-size: 12px;" class="form-control item-value" placeholder="Default Value">
    `;

    let getId = eleId.split("-")[1];

    let parentId = "default-value-" + getId;
    console.log('this', eleId);
    console.log('parent',parentId);
    
    // 12 checkbox, 26 button
    if (formType === "26") {
        console.log('type 26')
        document.getElementById(parentId).innerHTML = textDefaultValue;
        document.getElementById("add-form").disabled = true;
        document.querySelector('.form-item#item-'+getId+' .item-key').value = "button";
        document.querySelector('.form-item#item-'+getId+' .item-key').disabled = true;
        // $('.button-defaults#button-defaults-' + getId).removeClass('d-none');
        $('.button-info').removeClass('d-none');
    } else if (formType === "12") {       
        console.log('type 12')     
        // $("#" + eleId).parent().siblings().find(".default-value").html(selectCheckbox); 
        document.getElementById(parentId).innerHTML = selectCheckbox;
        document.getElementById("add-form").disabled = false;
        // document.querySelector('.form-item#item-'+getId+' .item-key').value = "";
        document.querySelector('.form-item#item-'+getId+' .item-key').disabled = false;
        // $('.button-defaults#button-defaults-' + getId).addClass('d-none');
        $('.button-info').addClass('d-none');
    } else if (formType !== "12" && formType !== "26") {
        console.log('type other')       
        // $("#" + eleId).parent().siblings().find(".default-value").html(textDefaultValue);
        document.getElementById(parentId).innerHTML = textDefaultValue;
        document.getElementById("add-form").disabled = false;
        
        // document.querySelector('.form-item#item-'+getId+' .item-key').value = "";
        document.querySelector('.form-item#item-'+getId+' .item-key').disabled = false;
        // $('.button-defaults#button-defaults-' + getId).addClass('d-none');
        $('.button-info').addClass('d-none');
    }
    //  else {
    //     document.getElementById("add-form").disabled = false;
    // }

    

}

var update_form = function () {
    // alert("update form!");
    var body = {};
    var title = $('#title').val();
    body["title"] = title;
    body["form_id"] = form_id;
    var items = [];
    var deleted = [];
    $(".form-item").each(function (i, obj) {
        var item = {};
        if ($(this).attr('id') != undefined) {
            item["id"] = $(this).attr('id');
        } else {
            item["id"] = "0";
        }
        item["label"] = $(this).find('.item-label')[0].value;
        item["key"] = $(this).find('.item-key')[0].value;
        item["value"] = $(this).find('.item-value')[0].value;
        item["type"] = $(this).find('.item-select')[0].value;
        items.push(item);
    });
    deleted_items.forEach(function (item, index) {
        var item_id = {
            value: item
        };
        deleted.push(item_id);
    });
    body["items"] = items;
    // body["deleted"] = deleted;
    // body["added"] = added_items;
    console.log(body);
    $.ajax({
        url: "/dashboardv2/logics/update_form",
        type: "POST",
        contentType: "application/json",
        data: JSON.stringify(body),
        success: function (result) {
            console.log(result);
            if (localStorage.lang == 0) {
                alert("Edit form success!");
            }
            else {
                alert("Form berhasil diubah!");
            }
            window.location.href = "/dashboardv2/form_management.php";
        },
        error: function (err) {
            alert("update form error!");
        }
    });
};

$('#form-editor').submit(function (event) {
    event.preventDefault();
    if (form_id != "0") {
        update_form();
    } else {
        insert_form();
    }
});

if (form_id != "0") {
    load_items();
} else {
    add_item(1);
}
listeners();