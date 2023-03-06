function fetchGroupMembers(group_id) {
    let formData = new FormData();
    formData.append('group_id', group_id);
    let xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function () {
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
            // get friends lpins
            data = JSON.parse(xmlHttp.responseText);

            for (const d of data) {

                let m = {
                    group_id: d.GROUP_ID,
                    group_name: d.GROUP_NAME,
                    f_pin: d.F_PIN,
                    name: d.FIRST_NAME + " " + d.LAST_NAME,
                    pic: "/webchatPalioLite/assets/img/palio.png",
                    position: d.POSITION,
                    quote: d.QUOTE
                }

                // let isMemberExist = groupMembers.some(member => member.f_pin === m.f_pin);
                // let isGroupExist = groupList.some(elem => elem.id === m.group_id);
                let isMemberGroupExist = groupMembers.some(elem => elem.group_id === m.group_id && elem.f_pin === m.f_pin);

                if (!isMemberGroupExist) {
                    groupMembers.push(m);
                }

                // groupMembers.push(m);
            }

            // let memberNames = groupMembers.map(function (elem) {
            //     return elem.name.trim();
            // }).join(", ");

            // DOM.messageAreaDetails.innerHTML = memberNames;
        }
    }
    xmlHttp.open("post", "/webchatPalioLite/logics/fetch_group_members");
    xmlHttp.send(formData);
}