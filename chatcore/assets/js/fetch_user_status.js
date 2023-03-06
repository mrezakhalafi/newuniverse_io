setInterval(function () {
    fetch_user_status();
}, 2000);

let shown = 0;

function fetch_user_status() {
    let url = '';
    if (localStorage.getItem("env") == 2) {
        url = "/chatcore/logics/gaspol/fetch_user_status?qr_code=" + document.getElementById("qr").getAttribute("title");
    } else {
        url = "/chatcore/logics/fetch_user_status?qr_code=" + document.getElementById("qr").getAttribute("title");
    }
    $.ajax({
        url: url,
        method: "GET",
        success: function (data) {
            
            data = JSON.parse(data);
            console.log(data);
            if(data.STATUS != 0 && data.FLAG != 1 && localStorage.getItem("env") == 0){
                localStorage.setItem("F_PIN", data.F_PIN);
                localStorage.setItem("FLAG", data.FLAG); 
                window.location.href = "/chatcore/pages/catchup/chat_index.php";
            } else if(data.STATUS != 0 && data.FLAG == 1 && localStorage.getItem("env") == 1){
                localStorage.setItem("F_PIN", data.F_PIN);
                localStorage.setItem("FLAG", data.FLAG);
                window.location.href = "/chatcore/pages/paliolite/chat_index.php";
            } else if(data.STATUS != 0 && data.FLAG == 1 && localStorage.getItem("env") == 2){
                localStorage.setItem("F_PIN", data.F_PIN);
                localStorage.setItem("FLAG", 1);
                window.location.href = "/gaspol_web/pages/gaspol-landing/dashboard/index";
            } else if(data.STATUS != 0 && data.FLAG == 1 && localStorage.getItem("env") == 3){
                localStorage.setItem("F_PIN", data.F_PIN);
                localStorage.setItem("FLAG", 1);
                window.location.href = "/chatcore/pages/digisales/chat_index.php";
            } else if(localStorage.getItem("env") == 2 && data.ERROR == 'Please login as an administrator.') {
                alert(data.ERROR);
                window.location.reload();
            } else if(data.STATUS != 0 && shown == 0){
                // window.location.href = "/chatcore/logics/logout_chat.php";
                shown = 1;
                console.log(data);
                let flag = parseInt(new URLSearchParams(window.location.search).get('env'));
                if (localStorage.getItem("env") == 2 && flag == 1){
                    alert("You are currently trying to log into Qmera Lite. Please scan the QR code using Qmera Lite app.");
                    window.location.href = "/chatcore/logics/logout_chat.php";
                } else if (localStorage.getItem("env") == 1 && flag == 2){
                    alert("You are currently trying to log into Gaspol. Please scan the QR code using Palio Lite app.");
                    window.location.href = "/chatcore/logics/logout_chat.php";
                }
            }
        }
    })
}