function addGroupArray(arr, grpId, m) {
    const found = arr.some(el => el.id === grpId);
    if (!found) {
        // messages.push(m);
        // if(localStorage.destination === m.recvId) {
        //     console.log('active chat = message destination');
        //     addMessageToMessageArea(m);
        // }
        // generateChatList();
        groupList.push(m);
        updateGroupList();
    }
}

function fetchGroupPeriodic() {
    var formData = new FormData();
    formData.append('f_pin', localStorage.F_PIN);

    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function () {
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
            // get friends lpins
            data = JSON.parse(xmlHttp.responseText);

            for (const d of data) {
                let img;

                if (d.IMAGE_ID == null) {
                    img = "/webchat/assets/img/palio.png";
                } else {
                    img = d.IMAGE_ID;
                }

                let grp = {
                    id: d.GROUP_ID,
                    name: d.GROUP_NAME,
                    quote: d.QUOTE,
                    pic: img,
                    last_update: d.LAST_UPDATE,
                    parent: d.PARENT_ID,
                    is_open: d.IS_OPEN
                }

                addGroupArray(groupList, grp.id, grp);
            }
        }
    }
    xmlHttp.open("post", "/webchat/logics/fetch_group.php");
    xmlHttp.send(formData);
}