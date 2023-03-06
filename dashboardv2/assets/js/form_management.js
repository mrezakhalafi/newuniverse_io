var delete_form = function(form_id){
    if (localStorage.lang == 0) {
        var conf = confirm("Are you sure you want to delete?");
    }
    else {
        var conf = confirm("Apakah anda yakin ingin menghapus?");
    }
    if(conf){
        $.get("/dashboardv2/logics/delete_form.php?form_id=" + form_id, function(data){
            location.reload();
        });
    }
}

$(".btn-delete").click( function(){
    delete_form($(this).val());
});

function submitURLCallback(url) {
    console.log(url);
    let formData = new FormData();
    formData.append('url', url);
    let xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function () {

        if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
            console.log(xmlHttp.responseText);

            let resp = xmlHttp.responseText;

            if (resp.includes('Success')) {
                if (localStorage.lang == 0) {
                    alert('Callback set to ' + resp.split(",")[1]);
                }
                else {
                    alert('Panggilan balik terhadap ' + resp.split(",")[1]);
                }
                window.location.reload();
            }
        }
    }

    xmlHttp.open("post", "logics/submit_url_callback");
    xmlHttp.send(formData);
}

$('#save-url').click(function() {
    let urlCallback = $('#url-callback').val().trim();
    
    if (urlCallback != '') {
        let urlHttps = '';
        if (!urlCallback.includes('http://') && !urlCallback.includes('https://')) {
            urlHttps = 'https://' + urlCallback;
        } else {
            urlHttps = urlCallback;
        }
        submitURLCallback(urlHttps);
    } else {
        if (localStorage.lang == 0) {
            alert('Please fill the URL first.');
        }
        else {
            alert('Harap isi URL terlebih dahulu.');
        }
    }
})