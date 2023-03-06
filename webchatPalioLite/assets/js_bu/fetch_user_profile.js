function fetchProfile(){

    var formData = new FormData();
    formData.append('f_pin', localStorage.F_PIN);

    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function () {
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
            data = JSON.parse(xmlHttp.responseText);

            var root = location.protocol + '//' + location.host;
            var profPic = "";

            if (data.IMAGE === null || data.IMAGE === "")  {
                profPic =  "/webchat/assets/img/palio.png";
            } else {
                profPic = root + ":2809/file/image/" + data.IMAGE;
            }

            user = {
                id: data.F_PIN,
                name: data.FIRST_NAME + " " + data.LAST_NAME,
                number: data.MSISDN,
                pic: profPic,
                lastSeen: data.LAST_UPDATE,
                isOnline: data.CONNECTED,
            };

            contactList.push(user);
        }
    }
    xmlHttp.open("post", "/webchat/logics/fetch_user_profile.php");
    xmlHttp.send(formData);
}
