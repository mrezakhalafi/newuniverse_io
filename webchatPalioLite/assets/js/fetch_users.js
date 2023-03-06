function fetchUser(fpin){

    function dataUser(data) {
        if (data === null) {
            return;
        } else {
            var root = 'http://' + location.host;
            var profpic = "/webchatPalioLite/assets/img/default_pp.png";

            if (data.IMAGE !== null && data.IMAGE !== "") {
                profpic = root + "/filepalio/image/" + data.IMAGE;
            }
            
            var contact = {
                id: data.F_PIN,
                name: data.FIRST_NAME + " " + data.LAST_NAME,
                number: data.MSISDN,
                pic: profpic,
                lastSeen: data.LAST_UPDATE
            };
            
            let isExist = contactList.some(el => el.id === data.F_PIN);

            if (!isExist) {
                contactList.push(contact);
            }
        }
    }
    
    // var formData = new FormData();
    // formData.append('f_pin', fpin);

    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function () {
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
            dataUser(JSON.parse(xmlHttp.responseText)); 
        }
    }
    xmlHttp.open("get", "/webchatPalioLite/logics/fetch_user_profile.php?f_pin=" + fpin);
    xmlHttp.send();

}
