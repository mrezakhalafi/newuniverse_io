function fetchSubgroup(p_id) {
    // var formData = new FormData();
    // formData.append('f_pin', localStorage.F_PIN);

    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function () {
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
            // get friends lpins
            data = JSON.parse(xmlHttp.responseText);

            for (const d of data) {
                let img;

                var root = 'http://' + location.host;

                if (d.IMAGE_ID == null) {
                    img = "/webchatPalioLite/assets/img/cuc_groupicon.png";
                } else {
                    img = root + "/filepalio/image/" + d.IMAGE_ID;
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

                let isGroupExist = groupList.some(el => el.id === d.GROUP_ID);

                if (!isGroupExist) {
                    groupList.push(grp);
                }
            }
        }
    }
    xmlHttp.open("get", "/webchatPalioLite/logics/fetch_subgroup.php?p_id=" + p_id);
    xmlHttp.send();
}