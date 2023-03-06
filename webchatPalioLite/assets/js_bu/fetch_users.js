function fetchUser(fpin){

    function dataUser(data) {
        if (data === null) {
            return;
        } else {
            var root = location.protocol + '//' + location.host;
            var profpic = "/webchat/assets/img/palio.png";

            if (data.IMAGE !== null && data.IMAGE !== "") {
                profpic = root + ":2809/file/image/" + data.IMAGE;
            }
            
            var contact = {
                id: data.F_PIN,
                name: data.FIRST_NAME + " " + data.LAST_NAME,
                number: data.MSISDN,
                pic: profpic,
                lastSeen: data.LAST_UPDATE
            };
            
            contactList.push(contact);
        }
    }
    
    var formData = new FormData();
    formData.append('f_pin', fpin);

    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function () {
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
            dataUser(JSON.parse(xmlHttp.responseText)); 
        }
    }
    xmlHttp.open("post", "/webchat/logics/fetch_user_profile.php");
    xmlHttp.send(formData);

}
