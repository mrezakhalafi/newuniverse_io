function fetchComplaint() {
    let formData = new FormData();

    formData.append('f_pin', localStorage.F_PIN);

    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function () {
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
            data = JSON.parse(xmlHttp.responseText);

            for (const d of data) {
                let img;

                var root = 'http://108.137.84.148';

                if (d.IMAGE == null) {
                    img = "/chatcore/assets/img/forum.png";
                } else {
                    img =  root + "/file/image/" + d.IMAGE;
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

                if (d.STATUS == 2) {
                    complaint_history.push(comp);
                } else if (d.STATUS == 0) {
                    ongoingComplaint = comp;
                }
            }
        }
    }
    xmlHttp.open("post", "/chatcore/logics/fetch_complaint");
    xmlHttp.send(formData);
}