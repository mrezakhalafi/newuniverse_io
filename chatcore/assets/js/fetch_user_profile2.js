function fetchProfile(dir){

    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function () {
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
            data = JSON.parse(xmlHttp.responseText);

            var root = 'http://108.137.84.148';

            let profPic = "";
            

            if (data.IMAGE == null || data.IMAGE == "")  {
                if (localStorage.FLAG == 1) {
                    profPic = "/chatcore/assets/img/default_pp.png";
                } else {
                    profPic = "/chatcore/assets/img/default_pp.png";
                }
            } else {
                profPic = root + dir + data.IMAGE;
            }

            user = {
                id: data.F_PIN,
                name: data.FIRST_NAME + " " + data.LAST_NAME,
                number: data.MSISDN,
                pic: profPic,
                lastSeen: data.LAST_UPDATE,
                isOnline: data.CONNECTED,
                user_type: data.USER_TYPE
            };

            $('#navbar #username').html(user.name.trim());
            $('#input-name').val(user.name.trim());
            // if (chat != null && chat.isGroup) {
            //     $('#messages .self .group-username').each(function() {
            //         $(this).html(user.name.trim());
            //     });
            // }

            let isExist = contactList.some(el => el.id === data.F_PIN);

            if (!isExist) {
                contactList.push(user);
            }
        }
    }
    xmlHttp.open("get", "/chatcore/logics/fetch_user_profile?f_pin=" + localStorage.F_PIN + "&flag=" + localStorage.FLAG);
    xmlHttp.send();
}
