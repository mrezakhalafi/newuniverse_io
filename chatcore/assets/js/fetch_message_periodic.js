function ExtractValue(data, key) {
    var rx = new RegExp(key + ":([^,]+)(?=}|,)");
    var values = rx.exec(data); // or: data.match(rx);
    return values && values[1];
}

function addMessageArray(arr, msgId, m) {
    const found = arr.some(el => el.id === msgId);
    if (!found) {
        periodicInterval = 500;
        messages.push(m);
        // console.log(m);
        if (localStorage.destination === m.recvId || (localStorage.destination === m.sender && m.recvId == localStorage.F_PIN)) {
            addMessageToMessageArea(m);

            if (m.body.includes("thank you for contacting") && chat.is_complain == 1 && isCallCenterEditor == true) {
                isOngoingCC = true;
            }

            // function toBottom() {
            //     var trueDivHeight = DOM.messages.scrollHeight;
            //     var divHeight = $('#messages').height();
            //     var scrollLeft = trueDivHeight - divHeight;
            //     DOM.messages.scrollTop = scrollLeft;
            // }

            // document.getElementById('scroll-to-bottom').removeEventListener("click", toBottom);

            // document.getElementById('scroll-to-bottom').addEventListener("click", function() {
            //     console.log('to bottom dong')
            // });

            if (m.status < 4 && m.status > -1 && m.sender !== user.id) {
                var formData = new FormData();
                formData.append('from', user.id);
                formData.append('message_id', m.id);
                formData.append('f_pin', m.sender);
                formData.append('l_pin', m.recvId);
                // formData.append('scope', '3');
                if (!chat.isGroup) {
                    formData.append('scope', '3');
                } else {
                    formData.append('scope', '4');
                }
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
        // console.log('update status 1');
        generateChatList();
    } else {
        periodicInterval = 3000;
        // update msg status

        try {
            let msgObj = messages.find(el => el.id === msgId);
            let msgIndex = messages.findIndex(el => el.id === msgId);
            let msgStatus = msgObj.status;
            let msgIsDeleted = msgObj.is_deleted;

            if (msgIndex > -1) {
                // if (m.sender === user.id) 
                    if (m.status != msgStatus && m.sender == localStorage.F_PIN) {
                        // console.log(msgId + ' | status ' + msgStatus + ' ' + m.status);
                        messages[msgIndex].status = m.status;

                        if (chat != null && ((!chat.isGroup && m.recvId == chat.contact.id) || (chat.isGroup && m.recvId == chat.group.id))) {
                            // let names = $('#msg-' + msgId + ' .time [class*=fa-check]').attr('class').split(' ');
                            // console.log(msgId);
                            let names = $('#msg-' + msgId + ' .time i').attr('class').split(' ');
                            let className;
                            $.each(names, function () {
                                if (this.toLowerCase().indexOf("fa-check") >= 0) {
                                    className = this;
                                    $('#msg-' + msgId + ' i.fas').removeClass(className);
                                    if (m.status == 3) {
                                        $('#msg-' + msgId + ' .time i.fas').addClass('fa-check-double');
                                    } else if (m.status == 4) {
                                        $('#msg-' + msgId + ' .time i.fas').addClass('fa-check-double');
                                        $('#msg-' + msgId + ' .time i.fas').css('color', '#6960EC');
                                    }
                                }
                            })
                        }
                        let checkIsWhisper = contactList.some(el => el.id == m.recvId);
                        if (checkIsWhisper) {
                            // console.log(msgObj.id + ' m.status: ' + m.status + ' | msgstatus: ' + msgStatus);
                            // console.log('update status 2');
                            generateChatList();
                        }
                        

                    }
                // }
                if (msgIsDeleted == 0 && m.is_deleted == 1) {
                    messages[msgIndex].is_deleted = m.is_deleted;
                    if (chat != null) {
                        if (messages[msgIndex].sender !== localStorage.F_PIN) {
                            document.getElementById('msg-' + msgId).getElementsByClassName('body')[0].innerHTML = "<span style='font-style:italic;'><i class='fa fa-ban' aria-hidden='true'></i> Message has been deleted.</span>";
                        } else {
                            document.getElementById('msg-' + msgId).getElementsByClassName('body')[0].innerHTML = "<span style='font-style:italic;'><i class='fa fa-ban' aria-hidden='true'></i> You deleted this message.</span>";
                        }
                    }
                    // if (isGroupListOpen == false && isFriendListOpen == false && isProfileOpen == false) {
                        generateChatList();
                    // }
                }
            }
            // if (msgStatus == -1 && msgObj.l_pin == user.id) {
            //     console.log('ada delete ' + msgId);
            //     generateChatList();
            // }
        } catch (e) {
            
        }
    }
}

function addBotMessage(arr, msgId, m) {
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

function fetchMessagePeriodic(dir) {


    var root = location.protocol + '//' + location.host;

    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function () {
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
            // get messages
            data = JSON.parse(xmlHttp.responseText);

            let newIDs = [];
            
            // console.log("before: " + msgIdArr.length);
            let beforeLength = msgIdArr.length;
            let isNotDel = data.filter(el => el.L_PIN === localStorage.F_PIN && el.STATUS == -1);
            isNotDel.forEach(el => {
                if (!msgIdArr.some(ele => ele == el.MESSAGE_ID)) {
                    msgIdArr.push(el.MESSAGE_ID);
                    newIDs.push(el.MESSAGE_ID);
                }                
            });
            // console.log(newIDs);
            // console.log("after: " + msgIdArr.length);
            let afterLength = msgIdArr.length;

            
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
                    // console.log(invi);
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

                // if ((m.l_pin == localStorage.F_PIN && m.status > -1) && (m.l_pin != localStorage.F_PIN && m.status == -1)) {
                addMessageArray(messages, m.id, m);
                if (toInitiator != null) {
                    addBotMessage(messages, toInitiator.id, toInitiator);
                }
            }
            if (afterLength - beforeLength > 0) {
                let ctr = 0;
                newIDs.forEach(elem => {
                    ctr++;
                    let findIdx = messages.findIndex(abc => abc.id == elem.id);
                    messages.splice(findIdx,1);
                    if (ctr == newIDs.length) {
                        console.log('delconv');
                        generateChatList();
                    }
                });
                
            }
        }
    }
    xmlHttp.open("get", "/chatcore/logics/fetch_messages?f_pin=" + localStorage.F_PIN + "&flag=" + localStorage.FLAG);
    xmlHttp.send();

}