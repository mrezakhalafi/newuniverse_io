var index = 1
var default_item = $("#item-1").html();
var deleted_items = [];
var listeners = function(){
    $(".delete-button").click(function(){
        if($(this).parent().parent().attr('id') != undefined){
            deleted_items.push($(this).parent().parent().attr('id'));
        }
        $(this).parent().parent().remove();
    });
    $('.item-select').change(function(){
        $(this).parent().parent().find('.item-value').eq(0).val("");
    });
};
var add_item = function(index){
    $.get("add_form_item.php?index=" + index, function(data){
        $(data).appendTo("#form-items");
        listeners();
    });
};

$(".add-item-button").click(function(){
        index++;
        add_item(index);
        listeners();
    }
);

var load_items = function(){
    $.get("load_form_item.php?form_id=" + FORM_ID, function(data){
        $(data).appendTo("#form-items");
        listeners();
    });
};

var insert_form = function(){
    // alert("insert form!");
    var body = {};
    var title = $('#title').val();
    body["title"] = title;
    body["user_id"] = USER_ID;
    var items = [];
    $(".form-item").each(function(i,obj){
        var item = {};
        item["label"] = $(this).find('.item-label')[0].value;
        item["key"] = $(this).find('.item-key')[0].value;
        item["value"] = $(this).find('.item-value')[0].value;
        item["type"] = $(this).find('.item-select')[0].value;
        items.push(item);
    });
    body["items"] = items;
    $.ajax({
        url: "../logics/insert_form",
        type: "POST",
        dataType: "json",
        contentType: "application/json",
        data: JSON.stringify(body),
        success: function(result){
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
            alert("insert form success!");
        },
        error: function(err){
            alert("insert form error!");
        }
    });
};

var update_form = function(){
    // alert("update form!");
    var body = {};
    var title = $('#title').val();
    body["title"] = title;
    body["form_id"] = FORM_ID;
    var items = [];
    var deleted = [];
    $(".form-item").each(function(i,obj){
        var item = {};
        if($(this).attr('id') != undefined){
            item["id"] = $(this).attr('id');
        }
        else{
            item["id"] = "0";
        }
        item["label"] = $(this).find('.item-label')[0].value;
        item["key"] = $(this).find('.item-key')[0].value;
        item["value"] = $(this).find('.item-value')[0].value;
        item["type"] = $(this).find('.item-select')[0].value;
        items.push(item);
    });
    deleted_items.forEach(function(item,index){
        var item_id = {value: item};
        deleted.push(item_id);
    });
    body["items"] = items;
    body["deleted"] = deleted;
    $.ajax({
        url: "../logics/update_form",
        type: "POST",
        contentType: "application/json",
        data: JSON.stringify(body),
        success: function(result){
            alert("insert form success!");
        },
        error: function(err){
            alert("insert form error!");
        }
    });
};

$('#form-editor').submit(function(event){
    event.preventDefault();
    if(FORM_ID != "0"){
        update_form();
    }
    else{
        insert_form();
    }
});

if(FORM_ID != "0"){
    load_items();
}
else{
    add_item(index);
}
listeners();