function fetchComplaint() {
    let formData = new FormData();

    formData.append('f_pin', localStorage.F_PIN);

    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function () {
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
            data = JSON.parse(xmlHttp.responseText);

            for (const d of data) {
                let img;

                var root = 'http://' + location.host;

                if (d.IMAGE == null) {
                    img = "/webchat/assets/img/forum.png";
                } else {
                    img =  root + ":2809/file/image/" + d.IMAGE;
                }

                let comp = {
                    id: d.ID,
                    cust_id: d.CUSTOMER_ID,
                    officer_id: d.OFFICER_ID,
                    start_handling: d.START_HANDLING,
                    duration: d.DURATION,
                    status: d.STATUS,
                    channel: d.CHANNEL,
                }

                complaint_history.push(comp);
            }
        }
    }
    xmlHttp.open("post", "/webchatPalioLite/logics/fetch_complaint");
    xmlHttp.send(formData);
}