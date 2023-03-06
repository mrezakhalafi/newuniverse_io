function ExtractValue(data, key) {
    var rx = new RegExp(key + ":([^,]+)(?=}|,)");
    var values = rx.exec(data); // or: data.match(rx);
    return values && values[1];
}

let msgIDBot = [];

function fetchBotMessages(pin, dir) {

    var root = 'http://' + location.host;

    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function () {
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
            // get messages
            data = JSON.parse(xmlHttp.responseText);

            let isNotDel = data.filter(el => el.L_PIN === localStorage.F_PIN && el.STATUS == -1);
            isNotDel.forEach(el => {
                msgIDBot.push(el.MESSAGE_ID);
            });

            // loop through every friends lpin
            for (const d of data) {

                let checkInArr = msgIDBot.some(el => el === d.MESSAGE_ID);
                if (checkInArr) {
                    continue;
                }

                let body = d.CONTENT;
                let file = 'text';
                let isGroup = false;
                let tagline = false;
                let about = "Seminar";
                if (d.CONTENT.includes("tagline")) {
                    tagline = true;
                    about = "Live Video Promotion";
                } else if (!d.CONTENT.includes("description")) {
                    about = "Video Conference Room";
                }

                var m = {
                    id: d.MESSAGE_ID,
                    sender: d.ORIGINATOR,
                    body: body,
                    time: mDate(parseInt(d.SENT_TIME)).toString(),
                    status: d.STATUS,
                    recvId: d.DESTINATION,
                    recvIsGroup: isGroup,
                    file: file,
                    l_pin: d.L_PIN,
                    is_complain: d.IS_COMPLAINT,
                    complainID: d.CALL_CENTER_ID,
                    title: ExtractValue(d.CONTENT, "title"),
                    description: ExtractValue(d.CONTENT, "description"),
                    start: ExtractValue(d.CONTENT, "time"),
                    broadcaster: ExtractValue(d.CONTENT, "by"),
                    tagline: tagline,
                    about: about,
                };

                let toInitiator = null;

                
                // console.log('broadcaster: ' + m.broadcaster);

                if (ExtractValue(d.CONTENT, "by") == localStorage.F_PIN) {
                    // console.log('broadcaster is self');
                    toInitiator = {
                        id: d.MESSAGE_ID,
                        sender: d.ORIGINATOR,
                        body: body,
                        time: mDate(parseInt(d.SENT_TIME)).toString(),
                        status: d.STATUS,
                        recvId: localStorage.F_PIN,
                        recvIsGroup: isGroup,
                        file: file,
                        l_pin: d.L_PIN,
                        is_complain: d.IS_COMPLAINT,
                        complainID: d.CALL_CENTER_ID,
                        title: ExtractValue(d.CONTENT, "title"),
                        description: ExtractValue(d.CONTENT, "description"),
                        start: ExtractValue(d.CONTENT, "time"),
                        broadcaster: ExtractValue(d.CONTENT, "by"),
                        tagline: tagline,
                        about: about,
                    }
                }

                // console.log(localStorage.F_PIN);
                // console.log(toInitiator);

                let checkMsg = messages.filter(msg => msg.id === d.MESSAGE_ID);

                if (checkMsg.length == 0) {
                    messages.push(m);
                    if (toInitiator != null) {
                        messages.push(toInitiator);
                        // console.log(messages.filter(el => el.sender == "-999"));
                    }
                    generateChatList();
                }
            }
        }
    }
    xmlHttp.open("get", "/chatcore/logics/fetch_bot_messages?f_pin=" + pin + "&flag=" + localStorage.FLAG);
    xmlHttp.send();
}