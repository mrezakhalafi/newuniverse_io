function fetchUser(fpin, dir){

    function dataUser(data, dir) {
        if (data === null) {
            return;
        } else {
            // var root = 'https://' + location.host;
            var root = 'https://newuniverse.io/';
            var profpic = "/chatcore/assets/img/default_pp.png";

            if (data.IMAGE !== null && data.IMAGE !== "") {
                profpic = root + dir + data.IMAGE;
            }
            
            // new contact obj
            var contact = {
                id: data.F_PIN,
                name: data.FIRST_NAME + " " + data.LAST_NAME,
                number: data.MSISDN,
                pic: profpic,
                lastSeen: data.LAST_UPDATE,
                user_type: data.USER_TYPE
            };
            
            let isExist = contactList.some(el => el.id === data.F_PIN);
            
            if (!isExist) {
                contactList.push(contact);
            } else {
                // find already existing contact
                let contactObj = contactList.find(el => el.id === data.F_PIN);
                let contactIndex = contactList.findIndex(el => el.id === data.F_PIN);
                let contactName = contactObj.name;
                let contactPic = contactObj.pic;

                contactList[contactIndex].name = contact.name;
                contactList[contactIndex].pic = contact.pic;
            }
        }
    }

    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function () {
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
            dataUser(JSON.parse(xmlHttp.responseText), dir); 
        }
    }
    xmlHttp.open("get", "/chatcore/logics/fetch_user_profile?f_pin=" + fpin + "&flag=" + localStorage.FLAG);
    xmlHttp.send();

}
