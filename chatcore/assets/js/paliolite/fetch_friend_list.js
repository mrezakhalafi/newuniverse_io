var xmlHttp = new XMLHttpRequest();
xmlHttp.onreadystatechange = function () {
    if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
        // get friends lpins
        data = JSON.parse(xmlHttp.responseText);

        // loop through every friends lpin
        for (const d of data) {
            fetchUser(d.L_PIN, dir);
        }

        fetchProfile(dir);
        fetchGroup(dir);
        fetchDiscussion(dir);
        
        /** fetch DM */
        fetchMessages(localStorage.F_PIN, dir);
        fetchBotMessages(localStorage.F_PIN, dir);
        fetchUserType();
        fetchComplaint();
        fetchComplaintHistory();
        fetchAPIKey();
    }
}
xmlHttp.open("get", "/chatcore/logics/fetch_friend_list?f_pin=" + localStorage.F_PIN + "&flag=" + localStorage.FLAG);
xmlHttp.send();