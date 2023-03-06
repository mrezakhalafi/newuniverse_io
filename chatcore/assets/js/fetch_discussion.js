function fetchDiscussion(dir) {
    // var formData = new FormData();
    // formData.append('f_pin', localStorage.F_PIN);

    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function () {
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
            data = JSON.parse(xmlHttp.responseText);

            for (const d of data) {
                let img;

                // var root = 'https://' + location.host;
                var root = 'http://108.137.84.148';

                if (d.IMAGE == null) {
                    img = "/chatcore/assets/img/forum.png";
                } else {
                    img =  root + dir + d.IMAGE;
                }

                let topic = {
                    id: d.CHAT_ID,
                    title: d.title,
                    group_id: d.GROUP_ID,
                    pic: img,
                    anon: d.ANONYM,
                    category: d.CATEGORY,
                    sc_date: d.SC_DATE,
                    ec_date: d.EC_DATE,
                    email: d.EMAIL,
                    client: d.CLIENT,
                    activity: d.ACTIVITY,
                    raci_r: d.R,
                    raci_a: d.A,
                    raci_c: d.C,
                    raci_i: d.I,
                }

                topicList.push(topic);
            }
        }
    }
    xmlHttp.open("get", "/chatcore/logics/fetch_discussion?f_pin=" + localStorage.F_PIN + "&flag=" + localStorage.FLAG);
    xmlHttp.send();
}