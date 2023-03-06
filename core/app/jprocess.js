/* global HMC */
var JProcess = {
    sLoginTimeoutId: "",
    systemTimeOut : "",
    sAddOfficeTimeoutId: "",
    sEditEmailConfigTimeoutId: "",
    resendCS: function (uname) {
//        alert(uname + " / "+ message);
        var hmessage = new HeaderM();
        hmessage.setCode("CS01");
        hmessage.setPin(uname);
        hmessage.setWId(uname);

        var cmessage = new ContentM();
        cmessage.putBody(HMK.WAD_USERNAME, uname);
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage, "CS:");
        sender.send();
    },
    sendCS: function (uname) {
//        alert(uname + " / "+ message);
        var hmessage = new HeaderM();
        hmessage.setCode("CS01");
        hmessage.setPin(uname);

        var cmessage = new ContentM();
        cmessage.putBody(HMK.WAD_USERNAME, uname);
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage, "CS:");
        sender.send();
    },

    sendMessageCS: function (uname, message) {
       console.log(uname + " / "+ message);
        var d = new Date();
        var timemilis = d.getTime();

        var hmessage = new HeaderM();
        hmessage.setCode("MCS");
        hmessage.setPin(uname);
        hmessage.setWId(uname);

        var cmessage = new ContentM();
        cmessage.putBody(HMK.WAD_USERNAME, uname);
        cmessage.putBody("A07", message);
        
        
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    sendLiveChat: function (uname, message) {
       console.log(uname + " / "+ message);
        var d = new Date();
        var timemilis = d.getTime();

        var hmessage = new HeaderM();
        hmessage.setCode("LC00");
        hmessage.setPin(uname);
        hmessage.setWId(uname);

        var cmessage = new ContentM();
        cmessage.putBody(HMK.WAD_USERNAME, uname);
        cmessage.putBody("A07", message);
        
        
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    closeSession: function(uname){
        var hmessage = new HeaderM();
        hmessage.setCode("CS02");
        hmessage.setPin(uname);

        var cmessage = new ContentM();
        cmessage.putBody(HMK.WAD_USERNAME, uname);
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    send_question: function(uname,question_id){
        var hmessage = new HeaderM();
        hmessage.setCode("QA");
        hmessage.setPin(uname);

        var cmessage = new ContentM();
        cmessage.putBody(HMK.WAD_USERNAME, uname);
        cmessage.putBody("question_id", question_id);
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    send_suggest: function(uname,question_id){
        var hmessage = new HeaderM();
        hmessage.setCode("S01");
        hmessage.setPin(uname);

        console.log("question_id "+question_id);
        var cmessage = new ContentM();
        cmessage.putBody(HMK.WAD_USERNAME, uname);
        cmessage.putBody("id", question_id);
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    suggestion : function(uname,word){
        var hmessage = new HeaderM();
        hmessage.setCode("S00");
        hmessage.setPin(uname);

        var cmessage = new ContentM();
        cmessage.putBody(HMK.WAD_USERNAME, uname);
        cmessage.putBody("word", word);
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    back_menu: function(uname){
        var hmessage = new HeaderM();
        hmessage.setCode("BTM");
        hmessage.setPin(uname);

        var cmessage = new ContentM();
        cmessage.putBody(HMK.WAD_USERNAME, uname);
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    no_results: function(uname){
        var hmessage = new HeaderM();
        hmessage.setCode("NRF");
        hmessage.setPin(uname);

        var cmessage = new ContentM();
        cmessage.putBody(HMK.WAD_USERNAME, uname);
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    initialization: function (p_qrCode) {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.INITIALIZATION);

        var sender = new Sender(hmessage);
        sender.send();
    },
    sendQrCode: function (p_qrCode) {
        var msg = new ScanQrCode();
        msg.setQrCode(p_qrCode);

        var sender = new Sender(msg, true);
        sender.send();
    },
     sendLoginInfo : function(p_email, p_password){
        console.log('sendlogin');
        $("#login_page").hide();
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.LOGIN_NU);
        var cmessage = new ContentM();
        cmessage.putBody(HMK.USER_IDS, p_email);
        cmessage.putBody(HMK.PASSWORD, p_password);
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage, true);
        sender.send();

        JProcess.sLoginTimeoutId = setTimeout(function() {
            $('.container_login_failed').show();
            $('.warning_desc').text("Login failed. System busy. Please try again in a few seconds")
            loginFailed();
        }, 5000);

        console.log('sendlogin sLoginTimeoutId : ' + JProcess.sLoginTimeoutId);

    },
    sendTimelinePost : function(p_fpin, p_postid, p_post_title, p_post_desc, p_post_audition, p_post_type,
            p_post_created_date, p_post_audition_date, p_thumb_id, p_priv_flag, p_file_id,
            p_duration, p_cat_id, p_media_type, p_type_ads, p_post_code)
    {

        console.log("p_fpin, p_post_title, p_post_desc :" + p_post_title + " | " + p_post_desc);
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.POST_TIMELINE);
        var cmessage = new ContentM();
        cmessage.putBody("A00", p_fpin);
        cmessage.putBody(HMK.TL_POST_ID, p_postid);
        cmessage.putBody(HMK.TL_POST_TITLE, p_post_title);
        cmessage.putBody(HMK.TL_POST_DESC, p_post_desc);
        cmessage.putBody(HMK.TL_POST_AUDITION, p_post_audition);
        cmessage.putBody(HMK.TL_POST_TYPE, p_post_type);
        cmessage.putBody(HMK.TL_POST_CREATE_DATE, p_post_created_date);
        cmessage.putBody(HMK.TL_POST_AUDITION_DATE, p_post_audition_date);
        cmessage.putBody(HMK.TL_POST_THUMBID, p_thumb_id);
        cmessage.putBody(HMK.TL_POST_PRIV_FLAG, p_priv_flag);
        cmessage.putBody(HMK.TL_POST_FILE_ID, p_file_id);
        cmessage.putBody(HMK.TL_DURATION, p_duration);
        cmessage.putBody(HMK.TL_POST_CAT_ID, p_cat_id);
        cmessage.putBody(HMK.TL_POST_MEDIA_TYPE, p_media_type);
        cmessage.putBody(HMK.TL_POST_TYPE_ADS, p_type_ads);
        cmessage.putBody(HMK.TL_POST_CODE, p_post_code);
        hmessage.packConArrJSON(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    pullMyself: function (p_fpin) {
        console.log('request myself');
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.MINE_INFO);
        var cmessage = new ContentM();
        cmessage.putBody("A00", p_fpin);
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    retrieveTimelineFirst: function () {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.RETRIEVE_TIMELINE_FIRST);
        var cmessage = new ContentM();
        cmessage.putBody("A00", mine.f_pin);
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    retrieveTimelineOld: function (p_time, p_postid) {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.RETRIEVE_TIMELINE_OLDEST);
        var cmessage = new ContentM();
        cmessage.putBody("A00", mine.f_pin);
        cmessage.putBody(HMK.TL_TIME, p_time);
        cmessage.putBody(HMK.TL_POST_ID, p_postid);
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    retrieveTimelineNew: function (p_time, p_postid) {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.RETIREVE_TIMELINE_NEWEST);
        var cmessage = new ContentM();
        cmessage.putBody("A00", mine.f_pin);
        cmessage.putBody(HMK.TL_TIME, p_time);
        cmessage.putBody(HMK.TL_POST_ID, p_postid);
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    retrieveTimelineMine: function () {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.RETRIEVE_TIMELINE_FIRST_MINE);
        var cmessage = new ContentM();
        cmessage.putBody("A00", mine.f_pin);
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    retrieveTimelineMineOld: function (p_time, p_postid) {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.RETRIEVE_TIMELINE_OLDEST_MINE);
        var cmessage = new ContentM();
        cmessage.putBody("A00", mine.f_pin);
        cmessage.putBody(HMK.TL_TIME, p_time);
        cmessage.putBody(HMK.TL_POST_ID, p_postid);
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    retrieveTimelineMineNew: function (p_time, p_postid) {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.RETRIEVE_TIMELINE_NEWEST_MINE);
        var cmessage = new ContentM();
        cmessage.putBody("A00", mine.f_pin);
        cmessage.putBody(HMK.TL_TIME, p_time);
        cmessage.putBody(HMK.TL_POST_ID, p_postid);
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    sendLike: function (p_postid, p_p_time, p_flag, p_befchange) {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.LIKE_UNLIKE);
        var cmessage = new ContentM();
        cmessage.putBody(HMK.POST_ID, p_postid);
        cmessage.putBody(HMK.LAST_UPDATE, p_p_time);
        cmessage.putBody(HMK.FLAG_REACTION, p_flag);
        cmessage.putBody(HMK.BEFORE_FLAG_CHANGE, p_befchange);
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    sendCountLike: function (p_postid) {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.COUNT_LIKE_COMMENT);
        var cmessage = new ContentM();
        cmessage.putBody(HMK.POST_ID, p_postid);
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    sendComment: function (p_postid, p_comment_id, p_comment_text, p_comment_date, p_ref_comment) {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.ADD_COMMENT);
        var cmessage = new ContentM();
        cmessage.putBody(HMK.POST_ID, p_postid);
        cmessage.putBody(HMK.COMMENT_ID, p_comment_id);
        cmessage.putBody(HMK.COMMENT_TEXT, p_comment_text);
        cmessage.putBody(HMK.COMMENT_DATE, p_comment_date);
        cmessage.putBody(HMK.COMMENT_REF, p_ref_comment);
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    viewComment: function (p_postid) {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.VIEW_COMMENT);
        var cmessage = new ContentM();
        cmessage.putBody(HMK.POST_ID, p_postid);
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    deleteComment: function (p_postid, p_comment_id, p_ref_comment) {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.DELETE_COMMENT);
        var cmessage = new ContentM();
        cmessage.putBody(HMK.POST_ID, p_postid);
        cmessage.putBody(HMK.COMMENT_ID, p_comment_id);
        cmessage.putBody(HMK.COMMENT_REF, p_ref_comment);
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    edit_post: function (p_postid, p_title, p_desc, p_type, p_audit_date, p_privflag, p_media_type, p_thumb_id, p_file_id, p_time) {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.EDIT_POST);
        var cmessage = new ContentM();
        cmessage.putBody(HMK.POST_ID, p_postid);
        cmessage.putBody(HMK.TITLE, p_title);
        cmessage.putBody(HMK.DESCRIPTION, p_desc);
        cmessage.putBody(HMK.TYPE, p_type);
        cmessage.putBody(HMK.AUDITION_DATE, p_audit_date);
        cmessage.putBody(HMK.PRIVACY_FLAG, p_privflag);
        cmessage.putBody(HMK.MEDIA_TYPE, p_media_type);
        cmessage.putBody(HMK.THUMB_ID, p_thumb_id);
        cmessage.putBody(HMK.FILE_ID, p_file_id);
        cmessage.putBody(HMK.TL_TIME, p_time);
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    changePrivacyTimeline: function (p_postid, p_privflag) {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.CHANGE_PRIVACY);
        var cmessage = new ContentM();
        cmessage.putBody(HMK.POST_ID, p_postid);
        cmessage.putBody(HMK.PRIVACY_FLAG, p_privflag);
        cmessage.putBody(HMK.TL_TIME, Date.now().toString());
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    sendMessage: function (p_message_id, p_l_pin, p_chat_id, p_scope_id, p_msg_text, p_read_receipts, p_credential, p_reff_id, p_img_id, p_thumb_id, p_audio_id, p_file_id, p_video_id) {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.SEND_IM);

        var cmessage = new ContentM();
        cmessage.putBody("A18", p_message_id);
        cmessage.putBody("A00", gs_main.f_pin);
        cmessage.putBody("A01", p_l_pin); // opposite_pin
        cmessage.putBody("A19", new Date().getTime() + "");
        cmessage.putBody("A06", p_scope_id);
        cmessage.putBody("A07", p_msg_text);
        cmessage.putBody("Bf", p_read_receipts);
        cmessage.putBody("A118", p_credential);

        if (p_img_id != null && !p_img_id == "") {
            cmessage.putBody("A57", p_img_id);
        }
        if (p_audio_id != null && !p_audio_id == "") {
            cmessage.putBody("A63", p_audio_id);
        }
        if (p_video_id != null && !p_video_id == "") {
            cmessage.putBody("A47", p_video_id);
        }
        if (p_file_id != null && !p_file_id == "") {
            cmessage.putBody("BN", p_file_id);
        }
        if (p_thumb_id != null && !p_thumb_id == "") {
            cmessage.putBody("A74", p_thumb_id);
        }
        if (p_reff_id != null && !p_reff_id == "") {
            cmessage.putBody("A121", p_reff_id);
        }
        if (p_chat_id != null && !p_chat_id == "") {
            cmessage.putBody("BA", p_chat_id); // chat_id
        }

        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    deleteMessage: function (p_message_id, p_delete_flag, p_f_pin, p_l_pin, p_chat_id) {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.DELETE_IM);

        var cmessage = new ContentM();
        cmessage.putBody("A18", p_message_id);
        cmessage.putBody("D01", p_delete_flag);
        cmessage.putBody("A00", p_f_pin);
        cmessage.putBody("A01", p_l_pin);
        cmessage.putBody("BA", p_chat_id);
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    ackMessage: function (p_message_id) {
        console.log("ngirim ack nih");
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.CONFIRMATION_IM);

        var cmessage = new ContentM();
        cmessage.putBody("A18", p_message_id);
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    loadMoreMessages: function (p_server_date, p_opposite_pin, p_chat_id) {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.LOAD_MORE_MESSAGES);

        var cmessage = new ContentM();
        cmessage.putBody("A19", p_server_date);
        cmessage.putBody("OP1", p_opposite_pin);
        cmessage.putBody("BA", p_chat_id);
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    retrieveDiFBrowse: function (p_path, p_id, p_limit, p_sequence) {
//        console.log(p_path+" = "+p_id);
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.RETRIEVE_DIF_BROWSE);

        var cmessage = new ContentM();
        cmessage.putBody("A44", p_path);
        cmessage.putBody("A20", p_id);
        cmessage.putBody("Be", p_limit);
        cmessage.putBody("BE", p_sequence);
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    retrieveDiFOpen: function (p_reff_id, p_form_id) {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.RETRIEVE_DIF_OPEN);

        var cmessage = new ContentM();
        cmessage.putBody("A120", p_form_id);
        cmessage.putBody("A121", p_reff_id);
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    getInfoMessageView: function (p_message_id) {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.GET_INFO_MESSAGE);

        var cmessage = new ContentM();
        cmessage.putBody("A18", p_message_id);
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    submitDigForm: function (p_item_id, p_data, p_chat_id) {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.SEND_IM);

        var cmessage = new ContentM();
        cmessage.putBody("A121", gs_main.f_pin + getTID()); //reff_id
        cmessage.putBody("A18", gs_main.f_pin + new Date().getTime()); //message_id
        cmessage.putBody("A00", gs_main.f_pin);
        cmessage.putBody("A01", p_item_id);
        cmessage.putBody("A07", JSON.stringify(p_data));
        cmessage.putBody("A06", "18");
        cmessage.putBody("BA", p_chat_id);
        cmessage.putBody("BN", p_item_id);
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    getFormDetail: function (p_ref_id) {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.GET_FORM_DETAIL);

        var cmessage = new ContentM();
        cmessage.putBody("A121", p_ref_id); //reff_id
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    formApproval: function (p_ref_id, p_approve, p_note, p_sign) {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.FORM_APPROVAL);

        var cmessage = new ContentM();
        cmessage.putBody("A121", p_ref_id); //reff_id
        cmessage.putBody("A15", p_approve);
        cmessage.putBody("nt", p_note);
        cmessage.putBody("sg", p_sign);
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    formApprovalRequestDriver: function (p_ref_id, p_approve, p_note, p_sign, p_pic) {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.FORM_APPROVAL);

        var cmessage = new ContentM();
        cmessage.putBody("A121", p_ref_id); //reff_id
        cmessage.putBody("A15", p_approve);
        cmessage.putBody("nt", p_note);
        cmessage.putBody("sg", p_sign);
        cmessage.putBody("pic", p_pic);
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    formPicSubmit: function (p_ref_id, p_type, p_note, p_data) {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.FORM_PIC_SUBMIT);

        var cmessage = new ContentM();
        cmessage.putBody("A121", p_ref_id); //reff_id
        cmessage.putBody("A38", p_type);
        cmessage.putBody("nt", p_note);
        if (p_data == undefined) {
            cmessage.putBody("A112", "");
        } else {
            cmessage.putBody("A112", p_data);
        }
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    formFollow: function (p_ref_id, p_approve, p_note, p_sign) {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.FORM_FOLLOW);

        var cmessage = new ContentM();
        cmessage.putBody("A121", p_ref_id); //reff_id
        cmessage.putBody("A15", p_approve);
        cmessage.putBody("nt", p_note);
        cmessage.putBody("sg", p_sign);
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    formSolved: function (p_ref_id, p_approve, p_note, p_data, p_sign) {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.FORM_APPROVAL);

        var cmessage = new ContentM();
        cmessage.putBody("A121", p_ref_id); //reff_id
        cmessage.putBody("A15", p_approve);
        cmessage.putBody("nt", p_note);
        cmessage.putBody("A112", p_data);
        cmessage.putBody("sg", p_sign);
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    changePersonInfo_Image: function (p_thumb_id) {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.CHANGE_PERSON_INFO);

        var cmessage = new ContentM();
        cmessage.putBody("A74", p_thumb_id);
        cmessage.putBody("C01", "1");
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    changePersonInfo_Quote: function (p_quote) {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.CHANGE_PERSON_INFO);

        var cmessage = new ContentM();
        cmessage.putBody("A16", p_quote);
        cmessage.putBody("C01", "2");
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    updateReadMessage: function (p_chat_id, p_f_pin, p_scope_id) {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.READ_IM);

        var cmessage = new ContentM();
        cmessage.putBody("BA", p_chat_id);
        cmessage.putBody("A00", p_f_pin);
//        cmessage.putBody("A06", p_scope_id);
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    /**
     * DONT DELETE REMARK BELOW
     * @param {type} p_chat_id
     * @param {type} p_f_pin
     * @param {type} p_scope_id
     * @param {type} p_batchpin
     * @param {type} p_qty
     * @param {type} p_message_id
     */
//    updateSingleReadMessage: function (p_chat_id, p_f_pin, p_scope_id, p_batchpin, p_qty, p_message_id) {
//        var hmessage = new HeaderM();
//        hmessage.setCode(HMC.READ_IM);
//
//        var cmessage = new ContentM();
//        cmessage.putBody("BA", p_chat_id);
//        cmessage.putBody("A00", p_f_pin);
//        cmessage.putBody("A01", p_batchpin);
//        cmessage.putBody("A06", p_scope_id);
//        cmessage.putBody("A18", p_message_id);
//        cmessage.putBody("BC", p_qty + "");
//        hmessage.addContent(cmessage);
//        var sender = new Sender(hmessage);
//        sender.send();
//    },
    updateSingleReadMessage: function (p_chat_id, p_f_pin, p_message_id) {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.READ_SINGLE_IM);

        var cmessage = new ContentM();
        cmessage.putBody("BA", p_chat_id);
        cmessage.putBody("A00", p_f_pin);
        cmessage.putBody("A18", p_message_id);
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    markAllAsRead: function () {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.MARK_ALL_AS_READ);

        var sender = new Sender(hmessage);
        sender.send();
    },
    updateFavoriteMessage: function (p_message_id, p_is_stared) {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.UPDATE_MESSAGES);

        var cmessage = new ContentM();
        cmessage.putBody("A18", p_message_id);
        cmessage.putBody("IS1", p_is_stared);
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    loadFavoriteMessages: function () {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.LOAD_FAVORITE_MESSAGES);

        var sender = new Sender(hmessage);
        sender.send();
    },
    getMessageObject: function (p_message_id) {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.GET_MESSAGE_OBJECT);

        var cmessage = new ContentM();
        cmessage.putBody("A18", p_message_id);
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    getMessageObjectBasedOnReffID: function (reff_id) {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.GET_MESSAGE_OBJECT_BASED_ON_REFID);

        var cmessage = new ContentM();
        cmessage.putBody("A121", reff_id);
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    createGroup: function (group_id, p_group_name) {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.CREATE_GROUP);

        var cmessage = new ContentM();
        cmessage.putBody("A04", group_id);
        cmessage.putBody("A05", p_group_name);
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    deleteGroup: function (p_group_id) {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.DELETE_GROUP);

        var cmessage = new ContentM();
        cmessage.putBody("A04", p_group_id);
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    leaveGroup: function (p_group_id) {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.LEAVE_GROUP);

        var cmessage = new ContentM();
        cmessage.putBody("A04", p_group_id);
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    changeGroupInfo_Name: function (p_group_id, p_group_name) {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.CHANGE_GROUP_INFO);

        var cmessage = new ContentM();
        cmessage.putBody("A04", p_group_id);
        cmessage.putBody("A05", p_group_name);
        cmessage.putBody("C02", "1");
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    changeGroupInfo_Quote: function (p_group_id, p_quote) {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.CHANGE_GROUP_INFO);

        var cmessage = new ContentM();
        cmessage.putBody("A04", p_group_id);
        cmessage.putBody("A16", p_quote);
        cmessage.putBody("C02", "2");
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    changeGroupInfo_Img: function (p_group_id, p_img) {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.CHANGE_GROUP_INFO);

        var cmessage = new ContentM();
        cmessage.putBody("A04", p_group_id);
        cmessage.putBody("A74", p_img);
        cmessage.putBody("C02", "3");
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    addTopic: function (p_group_id, p_title) {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.ADD_TOPIC);

        var cmessage = new ContentM();
        cmessage.putBody("A04", p_group_id);
        cmessage.putBody("A37", p_title);
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    changeTopicInfo_Name: function (p_chat_id, p_title) {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.UPDATE_TOPIC);

        var cmessage = new ContentM();
        cmessage.putBody("BA", p_chat_id);
        cmessage.putBody("A37", p_title);
        cmessage.putBody("C04", "1");
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    changeTopicInfo_Anonymous: function (p_chat_id, p_anonymous) {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.UPDATE_TOPIC);

        var cmessage = new ContentM();
        cmessage.putBody("BA", p_chat_id);
        cmessage.putBody("A145", p_anonymous);
        cmessage.putBody("C04", "2");
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    removeTopic: function (p_group_id, p_chat_id) {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.REMOVE_TOPIC);

        var cmessage = new ContentM();
        cmessage.putBody("A04", p_group_id);
        cmessage.putBody("BA", p_chat_id);
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    changeMemberPositionGroup: function (p_group_id, p_f_pin, p_change_flag) { // P_CHANGE_FLAG  :  1 ADMIN, 2 COMMON USER 
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.CHANGE_GROUP_MEMBER_POSITION);

        var cmessage = new ContentM();
        cmessage.putBody("A04", p_group_id);
        cmessage.putBody("A00", p_f_pin);
        cmessage.putBody("C03", p_change_flag);
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    removeMember: function (p_group_id, p_f_pin) { // P_CHANGE_FLAG  :  3 REMOVE MEMBER 
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.REMOVE_MEMBER);

        var cmessage = new ContentM();
        cmessage.putBody("A04", p_group_id);
        cmessage.putBody("A00", p_f_pin);
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    addMember: function (p_group_id, p_f_pin) {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.ADD_MEMBER);

        var cmessage = new ContentM();
        cmessage.putBody("A04", p_group_id);
        cmessage.putBody("A00", p_f_pin);
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    getProgressDashboard: function () {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.GET_PROGRESS_DASHBOARD);

        var sender = new Sender(hmessage);
        sender.send();
    },
    getProgressReport: function (p_project, p_client) {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.GET_PROGRESS_RETRIEVE);

        var cmessage = new ContentM();
        cmessage.putBody("project", p_project);
        cmessage.putBody("client", p_client);
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    getProgressSubActivity: function (p_project, p_client, p_activity) {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.GET_PROGRESS_SUB_ACTIVITY);

        var cmessage = new ContentM();
        cmessage.putBody("project", p_project);
        cmessage.putBody("client", p_client);
        cmessage.putBody("activity", p_activity);
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    getProgressTaskTitle: function (p_project, p_client, p_activity, p_sub_activity) {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.GET_PROGRESS_RETRIEVE_TASK_TITLE);

        var cmessage = new ContentM();
        cmessage.putBody("project", p_project);
        cmessage.putBody("client", p_client);
        cmessage.putBody("activity", p_activity);
        cmessage.putBody("sub_activity", p_sub_activity);
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    deleteConversation: function (p_data) {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.DELETE_CONVERSATION);

        var cmessage = new ContentM();
        cmessage.putBody("A112", p_data);
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    searchMessage: function (p_server_date, p_l_pin, p_chat_id, p_message_text, flag_id) {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.SEARCH_IM);

        var cmessage = new ContentM();
        cmessage.putBody("A19", p_server_date);
        cmessage.putBody("A01", p_l_pin);
        cmessage.putBody("BA", p_chat_id);
        cmessage.putBody("A07", p_message_text);
        cmessage.putBody("C05", flag_id);
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    addNewEmail: function (pop3_host, pop3_port, smtp_host, smtp_port, domain_email, username_email, password_email) {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.ADD_EMAIL);

        var cmessage = new ContentM();
        cmessage.putBody("EM1", pop3_host);
        cmessage.putBody("EM2", pop3_port);
        cmessage.putBody("EM3", smtp_host);
        cmessage.putBody("EM4", smtp_port);
        cmessage.putBody("EM5", domain_email);
        cmessage.putBody("A92", username_email);
        cmessage.putBody("Bm", password_email);
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    sendStatus: function (email, status) {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.CONNECT_DISCONNECT_EMAIL);

        var cmessage = new ContentM();
        cmessage.putBody("B6", email);
        cmessage.putBody("A15", status);
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    delete_email: function (email) {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.REMOVE_EMAIL);

        var cmessage = new ContentM();
        cmessage.putBody("B6", email);
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    retrieveSubActivity: function () {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.INIT_RETRIEVE_SUB_ACTIVITY);

        var sender = new Sender(hmessage);
        sender.send();
    },
    sendAddTag: function (MESSAGE_ID, TAG_FORUM, TAG_CLIENT, TAG_ACTIVITY, TAG_SUBACTIVITY) {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.ADD_TAG_IM);

        var cmessage = new ContentM();
        cmessage.putBody("A18", MESSAGE_ID);
        cmessage.putBody("tgf", TAG_FORUM);
        cmessage.putBody("tgc", TAG_CLIENT);
        cmessage.putBody("tga", TAG_ACTIVITY);
        cmessage.putBody("tgsa", TAG_SUBACTIVITY);
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    getFromServer: function (p_req_id, p_data) {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.GET_FROM_SERVER);

        var cmessage = new ContentM();
        cmessage.putBody("A98", p_req_id);
        cmessage.putBody("A112", p_data);
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    getClientAddress: function (client_id) {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.PUSH_CLIENT_ADDRESS);

        var cmessage = new ContentM();
        cmessage.putBody("cln_id", client_id);
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    checkLeave: function (sc_date, ec_date) {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.CHECK_LEAVE);

        var cmessage = new ContentM();
        cmessage.putBody("A90", sc_date);
        cmessage.putBody("A91", ec_date);

        var sender = new Sender(hmessage);
        sender.send();
    },
    RetrieveFormSearch: function (path, id, key_word) {
//        console.log(path +","+id+","+key_word );
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.RETRIEVE_DIF_SEARCH);

        var cmessage = new ContentM();
        cmessage.putBody("A44", path);
        cmessage.putBody("A20", id);
        cmessage.putBody("Bt", key_word);
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    RetrieveDataCalendar: function (s_date, e_date) {
        var hmessage = new HeaderM();
        var cmessage = new ContentM();
        hmessage.setCode(HMC.GET_DATA_CALENDAR);
        cmessage.putBody("A90", s_date);
        cmessage.putBody("A91", e_date);
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    getLunchStories: function () {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.LUNCH_STORIES);

        var sender = new Sender(hmessage);
        sender.send();
    },
    loadEmail: function () {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.LOAD_EMAIL);

        var sender = new Sender(hmessage);
        sender.send();
    },
    JPRenderFriend: function () {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.INIT_RETRIEVE_FRIEND_LIST);

        var sender = new Sender(hmessage);
        sender.send();
    },
    NotifLunch: function () {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.NOTIF);

        var sender = new Sender(hmessage);
        sender.send();
    },
    typingMessage: function (f_pin, p_id, p_scope, p_typing) {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.TYPING_MESSAGE);

        var cmessage = new ContentM();
        cmessage.putBody("A00", f_pin);
        cmessage.putBody("A01", p_id);
        cmessage.putBody("A76", p_scope);
        cmessage.putBody("A15", p_typing);
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    registrationFile: function (company, email, file_org, file_member, file_activity, file_office, file_client, file_project) {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.WAD_REGISTRATION_FILE);

        var cmessage = new ContentM();
        cmessage.putBody(HMK.WAD_COMPANY, company);
        cmessage.putBody(HMK.WAD_EMAIL, email);
        cmessage.putBody(HMK.WAD_UPL_ORGANIZATION, file_org);
        cmessage.putBody(HMK.WAD_UPL_MEMBER, file_member);
        cmessage.putBody(HMK.WAD_UPL_ACTIVITY, file_activity);
        cmessage.putBody(HMK.WAD_UPL_OFFICE, file_office);
        cmessage.putBody(HMK.WAD_UPL_CLIENT, file_client);
        cmessage.putBody(HMK.WAD_UPL_PROJECT, file_project);
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send()
    },
    retrieveClient: function () {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.WAD_RETRIEVE_CLIENT);
        var sender = new Sender(hmessage);
        sender.send();
    },
    retrieveActivity: function () {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.WAD_RETRIEVE_ACTIVITY);
        var sender = new Sender(hmessage);
        sender.send();
    },
    retrieveCI: function () {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.WAD_RETRIEVE_CONSULTED_AND_INFORMED);
        var sender = new Sender(hmessage);
        sender.send();
    },
    retrieveResponsible: function (activity_id) {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.WAD_RETRIEVE_RESPONSIBLE);
        var cmessage = new ContentM();
        cmessage.putBody(HMK.WAD_ACTIVITY_ID, activity_id);
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    retrieveSubmitContextActivity: function (product, client, activity, responsible, ar_accounttable, ar_consulted, ar_informed) {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.WAD_SUBMIT_CONTEXT_ACTIVITY);
        var cmessage = new ContentM();
        cmessage.putBody(HMK.WAD_PROJECT, product);
        cmessage.putBody(HMK.WAD_CLIENT, client);
        cmessage.putBody(HMK.WAD_ACTIVITY_ID, activity);
        cmessage.putBody(HMK.WAD_R, responsible);
        cmessage.putBody(HMK.WAD_A, ar_accounttable);
        cmessage.putBody(HMK.WAD_C, ar_consulted);
        cmessage.putBody(HMK.WAD_I, ar_informed);
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    retrieveAccounttable: function (responsible_id) {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.WAD_RETRIEVE_ACOUNTABLE);
        var cmessage = new ContentM();
        cmessage.putBody(HMK.WAD_RESPONSIBLE_ID, responsible_id);
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    retrieveProject: function () {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.WAD_RETRIEVE_PROJECT);
        var sender = new Sender(hmessage);
        sender.send();
    },
    submitProject: function (p_name, p_type) {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.WAD_SUBMIT_PROJECT);
        var cmessage = new ContentM();
        cmessage.putBody(HMK.WAD_TITLE, p_name);
        cmessage.putBody(HMK.WAD_TYPE, p_type);
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    retrieveDivisi: function () {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.WAD_RETRIEVE_DIVISI);
        var sender = new Sender(hmessage);
        sender.send();
        clearTimeout(JProcess.systemTimeOut);
        JProcess.systemTimeOut = setTimeout(function () {
            $('#systemBusyModal').modal("show");
            $('.loader_membership').hide();
        }, 5000)
    },
    retrieveMember: function (group_id) {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.WAD_RETRIEVE_MEMBER);
        var cmessage = new ContentM();
        cmessage.putBody(HMK.WAD_GROUP_ID, group_id);
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();

        JProcess.systemTimeOut = setTimeout(function () {
            $('#systemBusyModal').modal("show");
        }, 5000)
    },
    submitUser: function (f_name, f_nik, f_msisdn, f_email, f_extention, f_be, f_group, f_ac, f_office, f_office_time) {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.WAD_SUBMIT_USER);
        var cmessage = new ContentM();
        cmessage.putBody(HMK.WAD_NAME, f_name);
        cmessage.putBody(HMK.WAD_NIK, f_nik);
        cmessage.putBody(HMK.WAD_MSISDN, f_msisdn);
        cmessage.putBody(HMK.WAD_EMAIL, f_email);
        cmessage.putBody(HMK.WAD_EXT, f_extention);
        cmessage.putBody(HMK.WAD_BE, f_be);
        cmessage.putBody(HMK.WAD_GROUP_ID, f_group);
        cmessage.putBody(HMK.WAD_AC, f_ac);
        cmessage.putBody(HMK.WAD_OFFCIE, f_office);
        cmessage.putBody(HMK.WAD_TIME, f_office_time);

        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    submitClient: function (p_country, p_cname, p_caddress, p_cunit, p_ccity, p_cregion, p_czipcode, p_cnpwp, p_cemail, p_latitude, p_longitude) {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.WAD_SUBMIT_CLIENT);
        var cmessage = new ContentM();
        cmessage.putBody(HMK.WAD_SELECT_COUNTRY, p_country);
        cmessage.putBody(HMK.WAD_NAME, p_cname);
        cmessage.putBody(HMK.WAD_COMPANY_ADDRESS, p_caddress);
        cmessage.putBody(HMK.WAD_UNIT, p_cunit);
        cmessage.putBody(HMK.WAD_CITY, p_ccity);
        cmessage.putBody(HMK.WAD_REGION, p_cregion);
        cmessage.putBody(HMK.WAD_POSTZIPCODE, p_czipcode);
        cmessage.putBody(HMK.WAD_NPWP, p_cnpwp);
        cmessage.putBody(HMK.WAD_EMAIL, p_cemail);
        cmessage.putBody(HMK.WAD_LATITUDE, p_latitude);
        cmessage.putBody(HMK.WAD_LONGITUDE, p_longitude);
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    retrieveHierarchy: function () {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.WAD_RETRIEVE_HIERARCHY_NEW);
        var sender = new Sender(hmessage);
        sender.send();
        clearTimeout(JProcess.systemTimeOut);
        JProcess.systemTimeOut = setTimeout(function () {
            $('#systemBusyModal').modal("show");
            $('.loader_hierarchy').hide();
        }, 5000)
    },
    pendingAction: function () {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.WAD_PENDING_ACTION);
        var sender = new Sender(hmessage);
        sender.send();
    },
    addPendingAcion: function () {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.WAD_ADD_PENDING_ACTION);
        var sender = new Sender(hmessage);
        sender.send();
    },
    retrieveOffice: function () {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.WAD_RETRIEVE_OFFICE);
        var sender = new Sender(hmessage);
        sender.send();
    },
    retrieveEmailConfig: function () {
        console.log("Masuk JPROSES")
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.WAD_EMAIL_CONFIG_RETRIEVE);
        var sender = new Sender(hmessage);
        sender.send();
    },
    addActivity: function (p_actid, p_actname) {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.WAD_SUBMIT_ACTIVITY);
        var cmessage = new ContentM();
        cmessage.putBody(HMK.WAD_GROUP_ID, p_actid);
        cmessage.putBody(HMK.WAD_NAME, p_actname);
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    addOrganization: function (p_org_id, p_org_name, p_pos_lead) {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.WAD_ADD_ORGANIZATION);
        var cmessage = new ContentM();
        cmessage.putBody(HMK.WAD_GROUP_ID, p_org_id);
        cmessage.putBody(HMK.WAD_NAME, p_org_name);
        cmessage.putBody(HMK.WAD_AC, p_pos_lead);
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    edtOrganization: function (p_org_id, p_org_name, p_pos_lead) {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.WAD_EDT_ORG);
        var cmessage = new ContentM();
        cmessage.putBody(HMK.WAD_GROUP_ID, p_org_id);
        cmessage.putBody(HMK.WAD_NAME, p_org_name);
        cmessage.putBody(HMK.WAD_AC, p_pos_lead);
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    removeOrganization: function (p_org_id) {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.WAD_REMOVE_ORGANIZATION);
        var cmessage = new ContentM();
        cmessage.putBody(HMK.WAD_GROUP_ID, p_org_id);
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    requestOrgDetail: function (p_org_id) {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.WAD_RETRIVE_ORG_DETAIL);
        var cmessage = new ContentM();
        cmessage.putBody(HMK.WAD_GROUP_ID, p_org_id);
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    retrieveOficeTime: function () {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.WAD_RETRIEVE_OFFICE_TIME);
        var cmessage = new ContentM();
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();

    },
    retrieveAdminInfo: function () {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.WAD_PUSH_ADMIN_INFO);
        var cmessage = new ContentM();
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    retrieveEditMember: function (p_fpin) {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.WAD_RETRIEVE_MEMBER_INFO_EDIT);
        var cmessage = new ContentM();
        cmessage.putBody(HMK.F_PIN, p_fpin);
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();

        JProcess.systemTimeOut = setTimeout(function () {
            $('#systemBusyModal').modal("show");
        }, 5000)
    },
    submitEditMember: function (p_fpin, p_name, p_mdn, p_email, role, org_id) {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.WAD_SUBMIT_MEMBER_INFO_EDIT);
        var cmessage = new ContentM();
        cmessage.putBody(HMK.F_PIN, p_fpin);
        if (!(p_name == '')) {
            cmessage.putBody(HMK.WAD_NAME, p_name);
        }
        if (!(p_mdn == '')) {
            cmessage.putBody(HMK.WAD_MSISDN, p_mdn);
        }
        if (!(p_email == '')) {
            cmessage.putBody(HMK.WAD_EMAIL, p_email);
        }
        if (!(role == '')) {
            cmessage.putBody(HMK.WAD_AC, role);
        }
        if (!(org_id == '')) {
            cmessage.putBody(HMK.WAD_GROUP_ID, org_id);
        }
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    logOut: function () {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.WAD_LOGOUT);
        var cmessage = new ContentM();
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    retrieveRole: function () {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.WAD_RETRIEVE_ROLE);
        var cmessage = new ContentM();
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    retrieveListCompany() {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.WAD_RETRIEVE_LIST_COMPANY);
        var sender = new Sender(hmessage);
        sender.send();
    },
    retrieveReport(p_comp_scheme, p_status) {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.WAD_RETRIEVE_LIST_DETAIL_COMPANY);
        var cmessage = new ContentM();
        cmessage.putBody(HMK.WAD_SCHEME, p_comp_scheme);
        cmessage.putBody(HMK.WAD_STATUS, p_status);
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    retrieveReportPerSheet(p_comp_scheme, p_status, p_start, p_to) {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.WAD_RETRIEVE_LIST_DETAIL_COMPANY_PERSHEET);
        var cmessage = new ContentM();
        cmessage.putBody(HMK.WAD_SCHEME, p_comp_scheme);
        cmessage.putBody(HMK.WAD_STATUS, p_status);
        cmessage.putBody(HMK.WAD_START, p_start);
        cmessage.putBody(HMK.WAD_TO, p_to);
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    editmember: function (p_fpin, p_name, p_mdn, p_email, role, org_id) {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.WAD_MUTATION_ROLE);
        var cmessage = new ContentM();
        cmessage.putBody(HMK.F_PIN, p_fpin);
        if (!(p_name == '')) {
            cmessage.putBody(HMK.WAD_NAME, p_name);
        }
        if (!(p_mdn == '')) {
            cmessage.putBody(HMK.WAD_MSISDN, p_mdn);
        }
        if (!(p_email == '')) {
            cmessage.putBody(HMK.WAD_EMAIL, p_email);
        }
        cmessage.putBody(HMK.WAD_AC, role);
        cmessage.putBody(HMK.WAD_GROUP_ID, org_id);

        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    AddUserAdmin: function (type, company_name, be_id, p_data) {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.WAD_ADD_USER_ADMIN);
        var cmessage = new ContentM();
        cmessage.putBody(HMK.WAD_TYPE, type);
        cmessage.putBody(HMK.WAD_COMPANY_NAME, company_name);
        cmessage.putBody(HMK.WAD_COMPANY, be_id)
        cmessage.putBody(HMK.WAD_DATA_USER_ADMIN, p_data);

        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    ChangePassword: function (old, new_pass, confirm_pass) {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.WAD_CHANGE_PASSWORD);
        var cmessage = new ContentM();
        cmessage.putBody(HMK.WAD_OLD, old);
        cmessage.putBody(HMK.WAD_NEW, new_pass);
        cmessage.putBody(HMK.WAD_CONFIRM, confirm_pass)

        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    RetrieveUserAdminPerCompany: function (company_id) {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.RETRIEVE_USER_COMPANY);
        var cmessage = new ContentM();
        cmessage.putBody("BE", company_id);
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    RetrieveCompany: function (company_id) {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.RETRIEVE_COMPANY);
        var sender = new Sender(hmessage);
        sender.send();
    },
    addOffice: function (p_name, p_addr, p_lat, p_lng, p_rad, p_func) {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.WAD_OFFICE_ADD);
        var cmessage = new ContentM();
        cmessage.putBody(HMK.WAD_NAME, p_name);
        cmessage.putBody(HMK.WAD_COMPANY_ADDRESS, p_addr);
        cmessage.putBody(HMK.WAD_LATITUDE, p_lat);
        cmessage.putBody(HMK.WAD_LONGITUDE, p_lng);
        cmessage.putBody(HMK.WAD_RADIUS, p_rad);
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();

        JProcess.sAddOfficeTimeoutId = setTimeout(function () {
            realtimeEditBar2("Add Office", "2", "500", "Connection Failed", "Add Office");
        }, 15000);
    },
    addPosition: function (position_name) {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.WAD_ADD_POSITION);
        var cmessage = new ContentM();
        cmessage.putBody(HMK.WAD_NAME, position_name);
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    submitRs: function (data) {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.WAD_SUBMIT_RS);
        var cmessage = new ContentM();
        cmessage.putBody(HMK.WAD_DATA_USER_ADMIN, data);
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    editRs: function (data) {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.WAD_EDIT_RS);
        var cmessage = new ContentM();
        cmessage.putBody(HMK.WAD_DATA_USER_ADMIN, data);
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    retrieve_rs: function () {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.WAD_RETRIEVE_RS);
        var sender = new Sender(hmessage);
        sender.send();
    },
    emailConfigEdit: function (p_pop3_host, p_pop3_port, p_imap_host, p_imap_port, p_smtp_host, p_smtp_port) {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.WAD_EMAIL_CONFIG_EDIT);
        var cmessage = new ContentM();
        cmessage.putBody(HMK.WAD_POP_HOST, p_pop3_host);
        cmessage.putBody(HMK.WAD_POP_PORT, p_pop3_port);
        cmessage.putBody(HMK.WAD_IMAP_HOST, p_imap_host);
        cmessage.putBody(HMK.WAD_IMAP_PORT, p_imap_port);
        cmessage.putBody(HMK.WAD_SMTP_HOST, p_smtp_host);
        cmessage.putBody(HMK.WAD_SMTP_PORT, p_smtp_port);
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();

        JProcess.sEditEmailConfigTimeoutId = setTimeout(function () {
            realtimeEditBar2("Edit Email Config", "2", "500", "Connection Failed", "Edit Email Config");
        }, 15000);
    },
    searchOrganization: function (value) {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.WAD_SEARCH_ORGANIZATION);
        var cmessage = new ContentM();
        cmessage.putBody(HMK.WAD_SEARCH, value);
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    searchMember: function (value) {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.WAD_SEARCH_MEMBER);
        var cmessage = new ContentM();
        cmessage.putBody(HMK.WAD_SEARCH, value);
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    retrieveListOfApproval: function () {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.WAD_LIST_APPROVAL);
        var sender = new Sender(hmessage);
        sender.send();
    },
    viewApproval: function (id) {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.WAD_VIEW_APPROVAL);
        var cmessage = new ContentM();
        cmessage.putBody("", id);
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    reportSummary: function (id) {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.WAD_REPORT_SUMMARY);
        var cmessage = new ContentM();
        cmessage.putBody(HMK.WAD_SCHEME, id);
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    reportDetailSummary: function (bw_id, id) {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.WAD_REPORT_DETAIL_SUMMARY);
        var cmessage = new ContentM();
        cmessage.putBody(HMK.WAD_SCHEME, bw_id);
        cmessage.putBody("be_id", id);
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    editViewUserAdmin: function (id) {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.WAD_EDIT_VIEW_USER_ADMIN);
        var cmessage = new ContentM();
        cmessage.putBody(HMK.WAD_USERID, id);
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    addUserAdminSingle: function (type, companyName, u_name, password, fullname, contact, email, office, phone_no, company_id) {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.WAD_ADD_USER_ADMIN_SINGLE);
        var cmessage = new ContentM();
        cmessage.putBody(HMK.WAD_TYPE, type);
        cmessage.putBody(HMK.WAD_COMPANY_NAME, companyName);
        cmessage.putBody(HMK.WAD_USERNAME, u_name);
        cmessage.putBody(HMK.WAD_PASSWORD, password);
        cmessage.putBody(HMK.WAD_NAME, fullname);
        cmessage.putBody(HMK.WAD_MSISDN, contact);
        cmessage.putBody(HMK.WAD_EMAIL, email);
        cmessage.putBody(HMK.WAD_COMPANY_ADDRESS, office);
        cmessage.putBody(HMK.WAD_COMPANY_PHONE_NO, phone_no);
        cmessage.putBody(HMK.WAD_COMPANY, company_id);
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    daftarCompanyAddress: function (id_company) {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.WAD_DAFTAR_COMPANY_ADDRESS);
        var cmessage = new ContentM();
        cmessage.putBody(HMK.WAD_BE, id_company);
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    },
    saveEdit_User_admin: function (u_name, fullname, contact, email, office, phone_no, userId) {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.WAD_EDIT_USER_ADMIN);
        var cmessage = new ContentM();
        cmessage.putBody(HMK.WAD_USERNAME, u_name);
        cmessage.putBody(HMK.WAD_NAME, fullname);
        cmessage.putBody(HMK.WAD_MSISDN, contact);
        cmessage.putBody(HMK.WAD_EMAIL, email);
        cmessage.putBody(HMK.WAD_COMPANY_ADDRESS, office);
        cmessage.putBody(HMK.WAD_COMPANY_PHONE_NO, phone_no);
        cmessage.putBody(HMK.WAD_USERID, userId);
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.send();
    }
};
