function fetchGroupMembers(group_id) {
    let formData = new FormData();
    formData.append('group_id', group_id);
    formData.append('flag', localStorage.FLAG);
    let xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function () {
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
            // get friends lpins
            data = JSON.parse(xmlHttp.responseText);

            var root = "http://108.137.84.148/filepalio/image/";

            for (const d of data) {

                let usr_img = root + d.IMAGE;
                if (d.IMAGE.trim() == "") {
                    usr_img = "/chatcore/assets/img/default_pp.png";
                }

                let m = {
                    group_id: d.GROUP_ID,
                    group_name: d.GROUP_NAME,
                    f_pin: d.F_PIN,
                    name: d.FIRST_NAME + " " + d.LAST_NAME,
                    pic: usr_img,
                    position: d.POSITION,
                    quote: d.QUOTE
                }

                // let isMemberExist = groupMembers.some(member => member.f_pin === m.f_pin);
                // let isGroupExist = groupList.some(elem => elem.id === m.group_id);
                let isMemberGroupExist = groupMembers.some(elem => elem.group_id === m.group_id && elem.f_pin === m.f_pin);

                if (!isMemberGroupExist) {
                    groupMembers.push(m);
                } else {
                    // let existingMemberIdx = groupMembers.findIndex(elem => elem.f_pin == m.f_pin);

                    // // ganti nama
                    // if (groupMembers[existingMemberIdx].name.trim() != m.name.trim()) {
                    //     // console.log('ada ganti');
                    //     console.log('previous: ' + groupMembers[existingMemberIdx].name.trim() + ' | new: ' + m.name.trim());
                    //     groupMembers[existingMemberIdx].name = m.name.trim();
                    //     console.log('updated: ' + groupMembers[existingMemberIdx].name);
                    //     console.log('f pin: ' + groupMembers[existingMemberIdx].f_pin);
                    // } 

                    // // ganti profpic
                    // if (groupMembers[existingMemberIdx].pic != m.pic) {
                    //     // console.log('ada ganti');
                    //     // console.log('previous: ' + groupList[existingGroupIdx].quote + ' | new: ' + m.quote);
                    //     groupMembers[existingMemberIdx].pic = m.pic;
                    // } 

                    groupMembers.forEach(mbr => {
                        // update name
                        if (mbr.f_pin == m.f_pin && mbr.name.trim() != m.name.trim()) {
                            // console.log('previous: ' + mbr.name.trim() + ' | new: ' + m.name.trim());
                            mbr.name = m.name.trim();
                            if ($("#info-area").hasClass("d-flex")) {
                                $("#info-area #groupMember-" + mbr.f_pin + " .name").html(mbr.name);
                            }
                            // console.log('updated: ' + mbr.name.trim());

                        }

                        // update pic
                        if (mbr.f_pin == m.f_pin && mbr.pic != m.pic) {
                            // console.log('previous: ' + mbr.pic + ' | new: ' + m.pic);
                            mbr.pic = m.pic;
                            if ($("#info-area").hasClass("d-flex")) {
                                $("#info-area #groupMember-" + mbr.f_pin + " .member-pp").attr("src", mbr.pic);
                            }
                            // console.log('updated: ' + mbr.pic);
                        }
                    })
                }

                // groupMembers.push(m);
            }

            // let memberNames = groupMembers.map(function (elem) {
            //     return elem.name.trim();
            // }).join(", ");

            // DOM.messageAreaDetails.innerHTML = memberNames;
        }
    }
    xmlHttp.open("post", "/chatcore/logics/fetch_group_members");
    xmlHttp.send(formData);
}