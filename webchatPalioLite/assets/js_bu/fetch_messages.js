function fetchMessages(pin) {

    var formData = new FormData();
    formData.append('f_pin', pin);

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
                    body = "<a href=\'" + root + ":2809/file/image/" + d.IMAGE_ID + "\' target=\'_blank\'>" + d.IMAGE_ID + "</a>";
                    // body = "<img src=\'" + root + ":2809/file/image/" + d.IMAGE_ID + "\' width=\'300\'>";
                    file = 'image';

                } else if (d.VIDEO_ID != null) {
                    body = "<a href=\'" + root + ":2809/file/image/" + d.VIDEO_ID + "\' target=\'_blank\'>" + d.VIDEO_ID + "</a>";
                    // body = "<video src=\'" + root + ":2809/file/image/" + d.VIDEO_ID + "\' width=\'300\' controls>";
                    file = 'video';

                } else if (d.AUDIO_ID != null) {
                    body = "<a href=\'" + root + ":2809/file/image/" + d.AUDIO_ID + "\' target=\'_blank\'>" + d.AUDIO_ID + "</a>";
                    // body = "<audio src=\'" + root + ":2809/file/image/" + d.AUDIO_ID + "\' controls>";
                    file = 'audio';

                } else {
                    body = "<a href=\'" + root + ":2809/file/image/" + d.FILE_ID + "\'>" + d.FILE_ID + "</a>";
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
                    };

                let checkMsg = messages.filter(msg => msg.id === d.MESSAGE_ID);

                if (checkMsg.length == 0) {
                    messages.push(m);
                }
            }
        }
    }
    xmlHttp.open("post", "/webchat/logics/fetch_messages.php");
    xmlHttp.send(formData);

}
