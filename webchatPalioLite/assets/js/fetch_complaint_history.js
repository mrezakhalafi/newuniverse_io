function fetchComplaintHistory() {
    let formData = new FormData();

    formData.append('f_pin', localStorage.F_PIN);

    var root = 'http://' + location.host;

    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function () {
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
            data = JSON.parse(xmlHttp.responseText);

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

                let msg = {
                    id: d.MESSAGE_ID,
                    sender: d.ORIGINATOR,
                    body: body,
                    time: mDate(parseInt(d.SENT_TIME)).toString(),
                    status: 1,
                    recvId: d.DESTINATION,
                    recvIsGroup: false,
                    file: file,
                    is_complain: d.IS_COMPLAINT,
                    complainID: d.CALL_CENTER_ID
                }

                msgs_complaint.push(msg);
            }
        }
    }
    xmlHttp.open("post", "/webchatPalioLite/logics/fetch_complaint_history");
    xmlHttp.send(formData);
}