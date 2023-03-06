function fetchSubgroup(p_id, dir) {

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
                    is_open: d.IS_OPEN
                }

                let isGroupExist = groupList.some(el => el.id === d.GROUP_ID);

                if (!isGroupExist) {
                    groupList.push(grp);
                }
            }
        }
    }
    xmlHttp.open("get", "/chatcore/logics/fetch_subgroup?p_id=" + p_id + "&flag=" + localStorage.FLAG);
    xmlHttp.send();
}