let msgIdArr = [];

function ExtractValue(data, key) {
    var rx = new RegExp(key + ":([^,]+)(?=}|,)");
    var values = rx.exec(data); // or: data.match(rx);
    return values && values[1];
}

function fetchMessages(pin, dir) {

    var root = 'http://' + location.host;

    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function () {
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
            // get messages
            data = JSON.parse(xmlHttp.responseText);
            // console.log(data);

            let isNotDel = data.filter(el => el.L_PIN === localStorage.F_PIN && el.STATUS == -1);
            // let msgIdArr = [];
            isNotDel.forEach(el => {
                msgIdArr.push(el.MESSAGE_ID);
            });

            // console.log(isNotDel);
            // console.log(msgIdArr);

            // loop through every friends lpin
            for (const d of data) {

                let checkInArr = msgIdArr.some(el => el === d.MESSAGE_ID);
                if (checkInArr) {
                    continue;
                }

                let body = "";
                let file = "";
                let file_id = "";
                if (d.CONTENT != null || d.CONTENT != '') {
                    body = d.CONTENT;
                    // file = 'text';
                    if (d.IS_DELETED == 1) {
                        if (d.ORIGINATOR != localStorage.F_PIN) {
                            body = "<span style='font-style:italic;'><i class='fa fa-ban' aria-hidden='true'></i> Message has been deleted.</span>";
                        } else {
                            body = "<span style='font-style:italic;'><i class='fa fa-ban' aria-hidden='true'></i> You deleted this message.</span>";
                        }
                    }
                }

                if (d.IMAGE_ID != null) {
                    file_id = d.IMAGE_ID;
                    file = 'image';
                    // body = typeof d.CONTENT.split('|')[1] === 'undefined' ? '' : d.CONTENT.split('|')[1];
                    body = d.CONTENT;
                } else if (d.VIDEO_ID != null) {
                    file_id = d.VIDEO_ID;
                    file = 'video';
                    body = typeof d.CONTENT.split('|')[1] === 'undefined' ? '' : d.CONTENT.split('|')[1];
                } else if (d.AUDIO_ID != null) {
                    // file_id = "<a href=\'" + root + dir + d.AUDIO_ID + "\' target=\'_blank\'>" + d.AUDIO_ID + "</a>";
                    file_id = d.AUDIO_ID;
                    file = 'audio';
                    body = typeof d.CONTENT.split('|')[1] === 'undefined' ? '' : d.CONTENT.split('|')[1];
                } else if (d.FILE_ID != null) {
                    // file_id = "<a href=\'" + root + dir + d.FILE_ID + "\' target=\'_blank\'>" + d.FILE_ID + "</a>";
                    file_id = d.FILE_ID;
                    file = 'file';
                    body = typeof d.CONTENT.split('|')[1] === 'undefined' ? '' : d.CONTENT.split('|')[1];
                }

                let isGroup = false;
                if (d.DESTINATION.length > 10) {
                    isGroup = true;
                }

                let sender = d.ORIGINATOR;
                let tagline = false;
                let about = "Seminar";
                let invi = {};
                if (d.CONTENT.includes("{\"title\":")) {
                    sender = "-999";
                    invi = JSON.parse(d.CONTENT);
                    console.log(invi);
                    if (d.CONTENT.includes("tagline")) {
                        tagline = true;
                        about = invi.tagline;
                    } else if (!d.CONTENT.includes("description")) {
                        if (localStorage.FLAG == "null") {
                            about = "Video Conference Room";
                        } else {
                            about = invi.tagline;
                        }
                    }
                }



                var m = {};
                let toInitiator = null;

                if (sender == "-999") {

                    m = {
                        id: d.MESSAGE_ID,
                        sender: sender,
                        body: body,
                        time: mDate(parseInt(d.SENT_TIME)).toString(),
                        status: d.L_PIN != localStorage.F_PIN && d.STATUS == -1 ? 3 : d.STATUS,
                        recvId: d.DESTINATION,
                        recvIsGroup: isGroup,
                        file: file,
                        l_pin: d.L_PIN,
                        is_complain: d.IS_COMPLAINT,
                        complainID: d.CALL_CENTER_ID,
                        title: invi.title,
                        description: invi.description,
                        start: invi.time,
                        broadcaster: invi.by,
                        tagline: tagline,
                        about: about,
                    };

                    if (invi.by == localStorage.F_PIN) {
                        // console.log('broadcaster is self');
                        toInitiator = {
                            id: d.MESSAGE_ID,
                            sender: sender,
                            body: body,
                            time: mDate(parseInt(d.SENT_TIME)).toString(),
                            status: d.L_PIN != localStorage.F_PIN && d.STATUS == -1 ? 3 : d.STATUS,
                            recvId: localStorage.F_PIN,
                            recvIsGroup: isGroup,
                            file: file,
                            l_pin: d.L_PIN,
                            is_complain: d.IS_COMPLAINT,
                            complainID: d.CALL_CENTER_ID,
                            title: invi.title,
                            description: invi.description,
                            start: invi.time,
                            broadcaster: invi.by,
                            tagline: tagline,
                            about: about,
                        };
                    }
                } else {
                    m = {
                        id: d.MESSAGE_ID,
                        sender: sender,
                        body: body,
                        time: mDate(parseInt(d.SENT_TIME)).toString(),
                        status: d.L_PIN != localStorage.F_PIN && d.STATUS == -1 ? 3 : d.STATUS,
                        recvId: d.DESTINATION,
                        recvIsGroup: isGroup,
                        file: file,
                        file_id: file_id,
                        is_complain: d.IS_COMPLAINT,
                        complainID: d.CALL_CENTER_ID,
                        is_deleted: d.IS_DELETED,
                        l_pin: d.L_PIN,
                        reply_to: d.REPLY_TO
                    };
                }


                let checkMsg = messages.filter(msg => msg.id === d.MESSAGE_ID);



                if (checkMsg.length == 0 && !(m.l_pin == localStorage.F_PIN && m.status == -1)) {
                    messages.push(m);
                    if (toInitiator != null) {
                        messages.push(toInitiator);
                    }
                }
            }
        }
    }
    xmlHttp.open("get", "/chatcore/logics/fetch_messages?f_pin=" + pin + "&flag=" + localStorage.FLAG);
    xmlHttp.send();

}