function addBotMessageArray(arr, msgId, m) {
    const found = arr.some(el => el.id === msgId && el.recvId == localStorage.F_PIN);
    if (!found) {
        messages.push(m);
        // console.log(m);
        if ((localStorage.destination === "-999" && m.recvId == localStorage.F_PIN)) {
            addMessageToMessageArea(m);

            if (m.status < 4 && m.status > -1 && m.sender !== user.id) {
                var formData = new FormData();
                formData.append('from', user.id);
                formData.append('message_id', m.id);
                formData.append('f_pin', m.sender);
                formData.append('l_pin', m.recvId);
                // formData.append('scope', '3');
                // if (!chat.isGroup) {
                    formData.append('scope', '3');
                // } else {
                //     formData.append('scope', '4');
                // }
                formData.append('status', '4');
                formData.append('time', new Date().getTime().toString());
                formData.append('flag', localStorage.FLAG);

                // open xhr
                var xmlHttp = new XMLHttpRequest();
                var url = "/chatcore/logics/update_msg_status";
                xmlHttp.onreadystatechange = function () {
                    if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
                        // console.log(xmlHttp.responseText);
                        m.status = 4;
                    }
                }
                xmlHttp.open("post", url);
                xmlHttp.send(formData);
            }
        }
        generateChatList();
    }
}



function fetchBotMessagePeriodic(dir) {


    var root = location.protocol + '//' + location.host;

    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function () {
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
            // get messages
            data = JSON.parse(xmlHttp.responseText);

            let newIDs = [];
            
            // console.log("before: " + msgIDBot.length);
            let beforeLength = msgIDBot.length;
            let isNotDel = data.filter(el => el.L_PIN === localStorage.F_PIN && el.STATUS == -1);
            isNotDel.forEach(el => {
                if (!msgIDBot.some(ele => ele == el.MESSAGE_ID)) {
                    msgIDBot.push(el.MESSAGE_ID);
                    newIDs.push(el.MESSAGE_ID);
                }                
            });
            // console.log(newIDs);
            // console.log("after: " + msgIDBot.length);
            let afterLength = msgIDBot.length;

            
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
                if(d.CONTENT.includes("tagline")){
                    tagline = true;
                    about = "Live Video Promotion";
                } else if(!d.CONTENT.includes("description")){
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

                // if ((m.l_pin == localStorage.F_PIN && m.status > -1) && (m.l_pin != localStorage.F_PIN && m.status == -1)) {
                addBotMessageArray(messages, m.id, m);
                if (toInitiator != null) {
                    addBotMessageArray(messages, toInitiator.id, toInitiator);
                }
            }
            if (afterLength - beforeLength > 0) {
                newIDs.forEach(elem => {
                    let findIdx = messages.findIndex(i => i.id == elem.id);
                    messages.splice(findIdx,1);
                })
                generateChatList();
            }
        }
    }
    xmlHttp.open("get", "/chatcore/logics/fetch_bot_messages?f_pin=" + localStorage.F_PIN + "&flag=" + localStorage.FLAG);
    xmlHttp.send();

}