setInterval(function () {
    fetch_user_status();
}, 2000);

function fetch_user_status() {
    $.ajax({
        url: "/webchat/logics/fetch_user_status.php?qr_code=" + document.getElementById("qr").getAttribute("title"),
        method: "POST",
        success: function (data) {
            data = jQuery.parseJSON(data);
            if(data.STATUS != 0){
                localStorage.setItem("F_PIN", data.F_PIN); 
                window.location.href = "/webchat/pages/chat_index.php";
            }
        }
    })
}