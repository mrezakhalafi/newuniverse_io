// setInterval(function () {
//     if (user.type != 24 && chat != null && chat.is_complain == 1) {
//         fetchNotifCallPeriodic();
//     }
// }, 1000);

// complain notif modal
function complainDetail(name, thumb) {
    document.getElementById('call-cc-fpin').innerHTML = name;
    if (localStorage.getItem('complain_channel') == '0') {
        document.getElementById('call-cc-type').innerHTML = 'Chat';
    } else if (localStorage.getItem('complain_channel') == '1') {
        document.getElementById('call-cc-type').innerHTML = 'Audio Call';
    } else if (localStorage.getItem('complain_channel') == '2') {
        document.getElementById('call-cc-type').innerHTML = 'Video Call';
    } 
} 

function fetchNotifCallPeriodic() {
    var formData = new FormData();
    // formData.append('f_pin', user.id);
    // formData.append('complainID', localStorage.getItem('complainID'));
    formData.append('f_pin', user.id);

    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function () {
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
            // get friends lpins
            data = JSON.parse(xmlHttp.responseText);
            // console.log(data);

            // Put the object into storage
            
            
            // if(data.CUSTOMER_THUMB == null || data.CUSTOMER_THUMB.trim() == ''){
            //     var thumb = "/chatcore/assets/img/default_pp.png";
            // } else {
            //     var thumb = 'http://' + location.host + "/filepalio/image/" + data.CUSTOMER_THUMB;
            // }
            if (data != null && user.type != 24 && user.id == data.CUSTOMER_F_PIN){
                // console.log('ada panggilan');
                complainDetail(data.CUSTOMER_F_PIN, data.CHANNEL);
                
                // localStorage.setItem('complainID', data.COMPLAINT_ID);
                if (localStorage.getItem('complainID') != null) {
                    localStorage.setItem('call_complain_ID', data.COMPLAINT_ID);
                } else {
                    localStorage.setItem('complainID', data.COMPLAINT_ID);
                    localStorage.setItem('call_complain_ID', data.COMPLAINT_ID);
                }
                localStorage.setItem('complain', data.CUSTOMER_F_PIN);
                // console.log('fetchnotifperiodic channel: ' + localStorage.getItem('complain_channel'));
                
                mClassList(DOM.callCCModal).remove('d-none');
                mClassList(DOM.callCCModal).add('d-block');
                // $('#call-cc-modal').modal('show');
            } else {
                // console.log('panggilan gak masuk');
                mClassList(DOM.callCCModal).remove('d-block');
                mClassList(DOM.callCCModal).add('d-none');
                // $('#call-cc-modal').modal('hide');
            }
        }
    }
    xmlHttp.open("post", "/chatcore/logics/fetch_notif_call_customer");
    xmlHttp.send(formData);
}