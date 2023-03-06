function addGroupArray(arr, grpId, m) {
    const found = arr.some(el => el.id === grpId);
    if (!found) {
        groupList.push(m);
        // groupIsMember.push(grp);
        fetchSubgroup(grpId, dir);
        updateGroupList();
    } else {
        let existingGroupIdx = groupList.findIndex(elem => elem.id == grpId);

        if (groupList[existingGroupIdx].quote != m.quote) {
            console.log('ada ganti');
            console.log('previous: ' + groupList[existingGroupIdx].quote + ' | new: ' + m.quote);
            groupList[existingGroupIdx].quote = m.quote;
            generateChatList();
        }
    }
}

function fetchGroupPeriodic(dir) {
    // var formData = new FormData();
    // formData.append('f_pin', localStorage.F_PIN);

    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function () {
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
            // get friends lpins
            data = JSON.parse(xmlHttp.responseText);

            for (const d of data) {
                let img;
                
                var root = 'http://108.137.84.148';

                if (d.IMAGE_ID == null) {
                    img = "/chatcore/assets/img/cuc_groupicon.png";
                } else {
                    img = root + dir + d.IMAGE_ID;
                }

                let grp = {
                    id: d.GROUP_ID,
                    name: d.GROUP_NAME,
                    quote: d.QUOTE,
                    pic: img,
                    last_update: d.LAST_UPDATE,
                    parent: d.PARENT_ID,
                    is_open: d.IS_OPEN,
                    is_organization: d.IS_ORGANIZATION,
                }

                addGroupArray(groupList, grp.id, grp);
            }
        }
    }
    xmlHttp.open("get", "/chatcore/logics/fetch_group?f_pin=" + localStorage.F_PIN + "&flag=" + localStorage.FLAG);
    xmlHttp.send();
}