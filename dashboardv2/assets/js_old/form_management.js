var delete_form = function(form_id){
    var conf = confirm("Are you sure you want to delete?");
    if(conf){
        $.get("/dashboardv2/logics/delete_form.php?form_id=" + form_id, function(data){
            location.reload();
        });
    }
}

$(".btn-delete").click( function(){
    delete_form($(this).val());
});