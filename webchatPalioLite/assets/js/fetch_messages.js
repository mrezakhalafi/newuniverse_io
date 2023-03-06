function fetchMessages(pin) {

    // var formData = new FormData();
    // formData.append('f_pin', pin);

    var root = 'http://' + location.host;

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

                var m = {
                        id: d.MESSAGE_ID,
                        sender: d.ORIGINATOR,
                        body: body,
                        time: mDate(parseInt(d.SENT_TIME)).toString(),
                        status: 1,
                        recvId: d.DESTINATION,
                        recvIsGroup: isGroup,
                        file: file,
                        is_complain: d.IS_COMPLAINT,
                        complainID: d.CALL_CENTER_ID
                    };

                let checkMsg = messages.filter(msg => msg.id === d.MESSAGE_ID);
                // let checkMsgComplain = msgs_complaint.filter(msg => msg.id === d.MESSAGE_ID);

                if (checkMsg.length == 0) {
                    messages.push(m);
                }
                // if (m.is_complain == 0) {
                //     if (checkMsg.length == 0) {
                //         messages.push(m);
                //     }
                // } else {
                //     if (checkMsgComplain.length == 0) {
                //         msgs_complaint.push(m);
                //     }
                // }
            }
        }
    }
    xmlHttp.open("get", "/webchatPalioLite/logics/fetch_messages.php?f_pin=" + pin);
    xmlHttp.send();

}
