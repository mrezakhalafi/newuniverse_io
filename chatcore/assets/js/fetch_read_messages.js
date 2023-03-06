function fetchReadMessages() {

    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function () {
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
            // get friends lpins
            data = JSON.parse(xmlHttp.responseText);
            console.log(data);

            // loop through every friends lpin
            for (const d of data) {
                let msgIndex = messages.findIndex(el => el.id === d.MESSAGE);
                messages[msgIndex].status = d.STATUS;
                messages[msgIndex].L_PIN = d.L_PIN;
            }
        }
    }
    xmlHttp.open("get", "/chatcore/logics/fetch_read_messages?f_pin=" + localStorage.F_PIN + "&flag=" + localStorage.FLAG);
    xmlHttp.send();
}