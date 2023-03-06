function fetchComplaintHistory() {
    let formData = new FormData();

    formData.append('f_pin', localStorage.F_PIN);

    var root = 'http://' + location.host;

    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function () {
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
            data = JSON.parse(xmlHttp.responseText);

            for (const d of data) {

                // let body;
                // let file;
                // if (d.CONTENT != null && d.CONTENT != '' && d.IMAGE_ID == null && d.VIDEO_ID == null && d.AUDIO_ID == null && d.FILE_ID == null) {
                //     body = d.CONTENT;
                //     file = 'text';

                // } else if (d.IMAGE_ID != null) {
                //     body = "<a href=\'" + root + "/filepalio/image/" + d.IMAGE_ID + "\' target=\'_blank\'>" + d.IMAGE_ID + "</a>";
                //     file = 'image';

                // } else if (d.VIDEO_ID != null) {
                //     body = "<a href=\'" + root + "/filepalio/image/" + d.VIDEO_ID + "\' target=\'_blank\'>" + d.VIDEO_ID + "</a>";
                //     file = 'video';

                // } else if (d.AUDIO_ID != null) {
                //     body = "<a href=\'" + root + "/filepalio/image/" + d.AUDIO_ID + "\' target=\'_blank\'>" + d.AUDIO_ID + "</a>";
                //     file = 'audio';

                // } else {
                //     body = "<a href=\'" + root + "/filepalio/image/" + d.FILE_ID + "\'>" + d.FILE_ID + "</a>";
                //     file = 'file';

                // }

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


                let msg = {
                    id: d.MESSAGE_ID,
                    sender: d.ORIGINATOR,
                    body: body,
                    time: mDate(parseInt(d.SENT_TIME)).toString(),
                    status: 1,
                    recvId: d.DESTINATION,
                    recvIsGroup: false,
                    file: file,
                    file_id: file_id,
                    is_complain: d.IS_COMPLAINT,
                    complainID: d.CALL_CENTER_ID
                }

                // m = {
                //     id: d.MESSAGE_ID,
                //     sender: sender,
                //     body: body,
                //     time: mDate(parseInt(d.SENT_TIME)).toString(),
                //     status: d.L_PIN != localStorage.F_PIN && d.STATUS == -1 ? 3 : d.STATUS,
                //     recvId: d.DESTINATION,
                //     recvIsGroup: isGroup,
                //     file: file,
                //     l_pin: d.L_PIN,
                //     is_complain: d.IS_COMPLAINT,
                //     complainID: d.CALL_CENTER_ID,
                // };

                msgs_complaint.push(msg);
            }
        }
    }
    xmlHttp.open("post", "/chatcore/logics/fetch_complaint_history");
    xmlHttp.send(formData);
}