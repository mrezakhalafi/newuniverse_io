var insert_form = function(){
    var body = {};
    var data = $('form').serializeArray();
    body["form_id"] = FORM_ID;
    body["user_id"] = USER_ID;
    body["items"] = data;
    $.ajax({
        url: "/dashboardv2/logics/insert_form_data",
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

$('#digitalForm').submit(function(event){
    event.preventDefault();
    insert_form();
});