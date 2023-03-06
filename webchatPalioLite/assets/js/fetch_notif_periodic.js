setInterval(function () {
    fetchNotifPeriodic();
}, 2000);

// complain notif modal
function complainIdentity(name, thumb) {
    document.getElementById('complain-name').innerHTML = name;
    document.getElementById('complain-thumb').src = thumb;
}

function fetchNotifPeriodic() {
    // var formData = new FormData();
    // formData.append('f_pin', localStorage.F_PIN);

    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function () {
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
            // get friends lpins
            data = JSON.parse(xmlHttp.responseText);

            // Put the object into storage
            localStorage.setItem('complain', data.CUSTOMER_F_PIN);
            
            if(data.CUSTOMER_THUMB == null || data.CUSTOMER_THUMB.trim() == ''){
                var thumb = "/webchatPalioLite/assets/img/default_pp.png";
            } else {
                var thumb = 'http://' + location.host + "/filepalio/image/" + data.CUSTOMER_THUMB;
            }

            complainIdentity(data.CUSTOMER_NAME, thumb);

            if (data != 0){
                mClassList(DOM.complainModal).remove('d-none');
                mClassList(DOM.complainModal).add('d-block');
            } else {
                mClassList(DOM.complainModal).remove('d-block');
                mClassList(DOM.complainModal).add('d-none');
            }
        }
    }
    xmlHttp.open("get", "/webchatPalioLite/logics/fetch_notif.php?f_pin=" + localStorage.F_PIN);
    xmlHttp.send();
}