function fetchProfile(){

    // var formData = new FormData();
    // formData.append('f_pin', localStorage.F_PIN);

    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function () {
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
            data = JSON.parse(xmlHttp.responseText);

            var root = 'http://' + location.host;
            var profPic = "";

            if (data.IMAGE == null || data.IMAGE == "")  {
                profPic =  "/webchatPalioLite/assets/img/palio.png";
            } else {
                profPic = root + "/filepalio/image/" + data.IMAGE;
            }

            user = {
                id: data.F_PIN,
                name: data.FIRST_NAME.trim() + " " + data.LAST_NAME.trim(),
                number: data.MSISDN,
                pic: profPic,
                lastSeen: data.LAST_UPDATE,
                isOnline: data.CONNECTED,
            };

            let isExist = contactList.some(el => el.id === data.F_PIN);

            if (!isExist) {
                contactList.push(user);
            }
        }
    }
    xmlHttp.open("get", "/webchatPalioLite/logics/fetch_user_profile.php?f_pin=" + localStorage.F_PIN);
    xmlHttp.send();
}
