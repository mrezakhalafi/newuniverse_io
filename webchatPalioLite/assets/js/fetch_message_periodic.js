function addMessageArray(arr, msgId, m) {
    const found = arr.some(el => el.id === msgId);
    if (!found) {
        arr.push(m);
        // if (m.is_complain == 0) {
        //     messages.push(m);
        //     if(localStorage.destination === m.recvId || localStorage.destination === m.sender) {
        //         addMessageToMessageArea(m);
        //     }
        // } else {
        //     msgs_complaint.push(m);
        //     if((localStorage.destination === m.recvId || localStorage.destination === m.sender) && (chat != null && chat.is_complain == 1)) {
        //         addMessageToMessageArea(m);
        //     }
        // }

        if (localStorage.destination === m.recvId || localStorage.destination === m.sender) {
            addMessageToMessageArea(m);
        }
        generateChatList();
    }
}

function fetchMessagePeriodic() {

    // var formData = new FormData();
    // formData.append('f_pin', localStorage.F_PIN);

    // get current active chat room
    let currChatRoom;
    if (chat != null) {
        if (typeof chat.group !== 'undefined') {
            currChatRoom = chat.group.id;
        } else {
            currChatRoom = chat.contact.id;
        }
    }


    var root = location.protocol + '//' + location.host;

    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function () {
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
            // get messages
            data = JSON.parse(xmlHttp.responseText);

            // loop through every friends lpin
            for (const d of data) {

                let body;
                let file;
                if (d.CONTENT != null && d.CONTENT != '' && d.IMAGE_ID == null && d.VIDEO_ID == null && d.AUDIO_ID == null && d.FILE_ID == null) {
                    body = d.CONTENT;
                    file = 'text';

                } else if (d.IMAGE_ID != null) {
                    body = "<a href=\'" + root + "/filepalio/image/" + d.IMAGE_ID + "\' target=\'_blank\'>" + d.IMAGE_ID + "</a>";
                    file = 'image';

                } else if (d.VIDEO_ID != null) {
                    body = "<a href=\'" + root + "/filepalio/image/" + d.VIDEO_ID + "\' target=\'_blank\'>" + d.VIDEO_ID + "</a>";
                    file = 'video';

                } else if (d.AUDIO_ID != null) {
                    body = "<a href=\'" + root + "/filepalio/image/" + d.AUDIO_ID + "\' target=\'_blank\'>" + d.AUDIO_ID + "</a>";
                    file = 'audio';

                } else {
                    body = "<a href=\'" + root + "/filepalio/image/" + d.FILE_ID + "\'>" + d.FILE_ID + "</a>";
                    file = 'file';

                }

                let isGroup = false;
                if (d.DESTINATION.length > 10) {
                    isGroup = true;
                }

                // check if the new message is inside our current chat room
                let messageStatus = 1;
                if (currChatRoom == d.ORIGINATOR || currChatRoom == d.DESTINATION) {
                    messageStatus = 2;
                }

                var m = {
                    id: d.MESSAGE_ID,
                    sender: d.ORIGINATOR,
                    body: body,
                    time: mDate(parseInt(d.SENT_TIME)).toString(),
                    status: messageStatus,
                    recvId: d.DESTINATION,
                    recvIsGroup: isGroup,
                    file: file,
                    is_complain: d.IS_COMPLAINT,
                    complainID: d.CALL_CENTER_ID
                };

                addMessageArray(messages, m.id, m);
                // if (m.is_complain == 0) {
                //     addMessageArray(messages, m.id, m);
                // } else {
                //     addMessageArray(msgs_complaint, m.id, m);
                // }
            }
        }
    }
    xmlHttp.open("get", "/webchatPalioLite/logics/fetch_messages.php?f_pin=" + localStorage.F_PIN);
    xmlHttp.send();

}