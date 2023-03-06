function fetchFriendPeriodic() {
    var formData = new FormData();
    formData.append('f_pin', localStorage.F_PIN);

    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function () {
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
            // get friends lpins
            data = JSON.parse(xmlHttp.responseText);

            // loop through every friends lpin
            for (const d of data) {
                let found = contactList.some(el => el.id === d.L_PIN);
                if (!found) {
                    fetchUser(d.L_PIN);
                    updateFriendList();
                }
            }
        }
    }
    xmlHttp.open("post", "/webchat/logics/fetch_friend_list.php");
    xmlHttp.send(formData);
}