// var formData = new FormData();
// formData.append('f_pin', localStorage.F_PIN);

var contactList = [];

var xmlHttp = new XMLHttpRequest();
xmlHttp.onreadystatechange = function () {
    if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
        // get friends lpins
        data = JSON.parse(xmlHttp.responseText);

        // loop through every friends lpin
        for (const d of data) {
            fetchUser(d.L_PIN);
        }

        fetchProfile();
        fetchGroup();
        fetchDiscussion();
        // fetchCompanyAlias();
        
        /** fetch DM */
        fetchMessages(localStorage.F_PIN);
        fetchUserType();
        fetchComplaint();
        fetchComplaintHistory();
    }
}
xmlHttp.open("get", "/webchatPalioLite/logics/fetch_friend_list.php?f_pin=" + localStorage.F_PIN);
xmlHttp.send();