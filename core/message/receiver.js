/* global Class, HMC */
var Receiver = Class.extend({
    construct: function(pResponse) {
        this.response = pResponse;
    },
    getData: function() {
        var validResponse = false;
        try {
            var response = JSON.parse(this.response.data);
            validResponse = true;
            var cw_code = response.cw_code;
            var cw_content = "";

            if (wsConnState) { // true
                if (cw_code == HMC.LOGIN_NU) {
                    console.log('response ');
                    console.log(response.cw_wid);
                    console.log(response.cw_f_pin);
                    var browser = browserValidation();
                    if (!browser){
                        clearTimeout(JProcess.sLoginTimeoutId);
                        return ;
                    }
                    cw_content = response.cw_content;
                    mine.f_pin = response.cw_f_pin;
                    if(response.cw_wid !="" || response.cw_wid != null || response.cw_wid == undefined ){
                        localStorage.setItem(storage_key.webid, response.cw_wid);
                    }
                    //                    alert(localStorage.getItem(storage_key.webid));
                } else {
                    cw_content = eval(response.cw_content);
                }
                this.whenHandle(cw_code, cw_content);
            } else { // false
                if (cw_code == HMC.CONNECTED_FROM_MOBILE) {
                    this.whenHandle(cw_code, cw_content);
                }
            }
        } catch (e) {
            validResponse = false;
            console.log(e);
        }
    },
    whenHandle: function(pCode, pContent) {
        try {
            console.log("whenHandle: " + pCode);
            console.log("pContent: ");
            console.log(pContent);

            if (pCode == HMC.WAD_INVALID_SESSION) {
                $('#invalid-modal').modal('show');
                localStorage.clear();
            } else if (pCode == HMC.CONNECTED_FROM_MOBILE) {
                connectedFromMobile();
            } else if (pCode == HMC.DISCONNECTED_FROM_MOBILE) {
                disconnectedFromMobile();
            } else if (pCode == HMC.SCANNED_QR_CODE) {
                homePage(pContent);
            } else if (pCode == HMC.INIT_WEB_FINISH) {
                webFinish();
            } else if (pCode == HMC.SEND_IM) {
                IncomingMessage(pContent);
            } else if (pCode == HMC.INIT_RETRIEVE_MYSELF) {
                pushMySelf(pContent);
            } else if (pCode == HMC.INIT_RETRIEVE_FRIEND_LIST) {
                renderFriend(pContent);
            } else if (pCode == HMC.INIT_RETRIEVE_GROUP) {
                setTimeout(function() {
                    renderGroupID(pContent);
                }, 300);
            } else if (pCode == HMC.INIT_RETRIEVE_TOPIC) {
                renderGroupTopic(pContent);
            } else if (pCode == HMC.INIT_RETRIEVE_DF_TEMPLATE) {
                onFormReceived(pContent);
            } else if (pCode == HMC.INIT_RETRIEVE_SUB_ACTIVITY) {
                RetreiveSubActivity(pContent);
            } else if (pCode == HMC.INIT_RETRIEVE_UC_LIST || pCode == HMC.RETRIEVE_UC_LIST) {
                loadConversation(pContent);
                getAddTag(pContent);
            } else if (pCode == HMC.WAD_LOGOUT) {
                logOut();
            } else if (pCode == HMC.LOAD_MORE_MESSAGES) {
                callMessageObject(pContent);
                previousMessage(pContent)
                getViewMedia();
                getAddTag(pContent);
            } else if (pCode == HMC.RETRIEVE_DIF_BROWSE) {
                onFormManagerReceive(pContent);
            } else if (pCode == HMC.RETRIEVE_DIF_OPEN) {

                if (flag_search_formResult) {
                    openFormManager(pContent);
                } else {
                    sendQuote(pContent)
                }

            } else if (pCode == HMC.DELETE_IM) {
                recDelChatMsg(pContent);
            } else if (pCode == HMC.READ_IM) {
                clearUnread(pContent);
            } else if (pCode == HMC.UPDATE_CTEXT) {
                updateMsgStatus(pContent);
            } else if (pCode == HMC.GET_INFO_MESSAGE) {
                viewMessageInfo(pContent);
            } else if (pCode == HMC.MARK_ALL_AS_READ) {
                markAsRead(pContent);
            } else if (pCode == HMC.UPDATE_MESSAGES) {
                favMsg(pContent);
            } else if (pCode == HMC.LOAD_FAVORITE_MESSAGES) {
                showFavMsg(pContent);
            } else if (pCode == HMC.GET_MESSAGE_OBJECT) {
                previousQuote(pContent);
            } else if (pCode == HMC.CHANGE_PERSON_INFO) {
                getDataPersonInfo(pContent);
            } else if (pCode == HMC.CREATE_GROUP) {} else if (pCode == HMC.PUSH_GROUP) {
                getRespPushAddGroup(pContent);
                liveChangeGroup(pContent);
            } else if (pCode == HMC.PUSH_GROUP_MEMBER) {
                getPushAddGroupMembers(pContent);
            } else if (pCode == HMC.DELETE_GROUP) {
                getRespDelGroup(pContent);
            } else if (pCode == HMC.LEAVE_GROUP) {
                getRespLeaveGroup(pContent);
            } else if (pCode == HMC.ADD_TOPIC) {} else if (pCode == HMC.GET_PROGRESS_DASHBOARD) {
                renderDashboard(pContent);
            } else if (pCode == HMC.GET_PROGRESS_RETRIEVE) {
                renderProgres(pContent);
            } else if (pCode == HMC.GET_PROGRESS_SUB_ACTIVITY) {
                renderSubActivity(pContent);
            } else if (pCode == HMC.GET_PROGRESS_RETRIEVE_TASK_TITLE) {
                renderTaskTitle(pContent);
            } else if (pCode == HMC.CHANGE_GROUP_INFO) {
                getRespChangeGroupInfo(pContent);
            } else if (pCode == HMC.GET_FORM_DETAIL) {
                ResFormDetail(pContent);
            } else if (pCode == HMC.UPDATE_TOPIC) {
                cekAnonym(pContent);
            } else if (pCode == HMC.PUSH_TOPIC) {
                getRespPushAddTopic(pContent);
            } else if (pCode == HMC.ADD_MEMBER) {
                getRespAddNewGroupMember(pContent);
            } else if (pCode == HMC.DELETE_CONVERSATION) {
                deletedUConView(pContent);
            } else if (pCode == HMC.SEARCH_IM) {
                retriveSearchMessage(pContent);
            } else if (pCode == HMC.CHANGE_GROUP_MEMBER_POSITION) {
                getRespSetMemberPosition(pContent);
            } else if (pCode == HMC.REMOVE_MEMBER) {
                getRespRemoveMember(pContent);
            } else if (pCode == HMC.LOAD_EMAIL) {
                displayEmail(pContent);
            } else if (pCode == HMC.ADD_EMAIL) {
                displayAddEmail(pContent);
            } else if (pCode == HMC.REMOVE_EMAIL) {
                removeEmail(pContent);
            } else if (pCode == HMC.CONNECT_DISCONNECT_EMAIL) {
                statusEmail(pContent)
            } else if (pCode == HMC.CHECK_LEAVE) {
                rescheckLeave(pContent);
            } else if (pCode == HMC.INIT_RETRIEVE_ORGANIZATION_LEADER) {
                RetrieveLeader(pContent);
            } else if (pCode == HMC.ADD_TAG_IM) {
                getAddTag(pContent);
            } else if (pCode == HMC.GET_FROM_SERVER) {
                getDriver(pContent);
            } else if (pCode == HMC.PUSH_CLIENT_ADDRESS) {
                resClientAddress(pContent);
            } else if (pCode == HMC.NOTIF) {
                enableLunch(pContent);
            } else if (pCode == HMC.RETRIEVE_DIF_SEARCH) {
                ResRetrieveFormSearch(pContent);
            } else if (pCode == HMC.GET_DATA_CALENDAR) {
                getDataCalendar(pContent);
            } else if (pCode == HMC.LUNCH_STORIES) {
                lunchStories(pContent);
            } else if (pCode == HMC.FORM_APPROVAL) {
                updApproval(pContent);
            } else if (pCode == HMC.FORM_PIC_SUBMIT_STATUS) {
                updAssignApproval(pContent);
            } else if (pCode == HMC.TYPING_MESSAGE) {
                isTypingMessage(pContent);
            } else if (pCode == HMC.MINE_INFO) {
                getMySelf(pContent);
            } else if (pCode == HMC.RETRIEVE_TIMELINE_FIRST) {
                getTimeLineFirst(pContent);
            } else if (pCode == HMC.RETRIEVE_TIMELINE_OLDEST) {
                getTimelineOld(pContent);
            } else if (pCode == HMC.RETIREVE_TIMELINE_NEWEST) {
                getTimelineNew(pContent);
            } else if (pCode == HMC.RETRIEVE_TIMELINE_FIRST_MINE) {
                getTimelineMineFirst(pContent);
            } else if (pCode == HMC.RETRIEVE_TIMELINE_OLDEST_MINE) {
                getTimelineMineOld(pContent);
            } else if (pCode == HMC.RETRIEVE_TIMELINE_NEWEST_MINE) {
                getTimelineMineNew(pContent);
            } else if (pCode == HMC.LIKE_UNLIKE) {
                renderLikeUnlike(pContent);
            } else if (pCode == HMC.VIEW_COMMENT) {
                renderComment(pContent);
                renderCommentProfile(pContent);
            } else if (pCode == HMC.ADD_COMMENT) {
                renderAddComment(pContent);
            } else if (pCode == HMC.DELETE_COMMENT) {
                renderDeleteComment(pContent);
            } else if (pCode == HMC.LOGIN_NU) {
                handleLoginResponse(pContent);
            } else if (pCode == HMC.COUNT_LIKE_COMMENT) {
                handleLikeCommCounts(pContent);
            } else if(pCode == HMC.WAD_RETRIEVE_CLIENT) {
                renderClientList(pContent);
                retriveClient(pContent);
            } else if(pCode == HMC.WAD_RETRIEVE_PROJECT){
                renderProjectList(pContent);
                retriveProject(pContent);
            } else if (pCode == HMC.WAD_RETRIEVE_ACTIVITY) {
                retriveActivity(pContent);
                getActivitiyList(pContent);
            } else if (pCode == HMC.WAD_RETRIEVE_ACOUNTABLE) {
                retriveAccountable(pContent);
            } else if (pCode == HMC.WAD_RETRIEVE_RESPONSIBLE) {
                retriveResponsible(pContent);
            } else if (pCode == HMC.WAD_RETRIEVE_CONSULTED_AND_INFORMED) {
                retriveCI(pContent);
            } else if (pCode == HMC.WAD_PENDING_ACTION) {
                insertTable(pContent);
            } else if (pCode == HMC.WAD_SUBMIT_CONTEXT_ACTIVITY) {
                contextActivitySuccess(pContent);
            } else if(pCode == HMC.WAD_RETRIEVE_DIVISI){
                renderDivisi(pContent);
            } else if(pCode == HMC.WAD_RETRIEVE_MEMBER){
                renderMemberList(pContent);
            } else if(pCode == HMC.WAD_SUBMIT_USER){
                statusSubmitUser(pContent);
            } else if(pCode == HMC.WAD_RETRIEVE_HIERARCHY){
                renderOrganization(pContent)
            } else if(pCode == HMC.WAD_RETRIEVE_HIERARCHY_NEW){
                renderOrganization(pContent)
            } else if(pCode == HMC.WAD_SUBMIT_PROJECT){
                handleAddProject(pContent)
            } else if(pCode == HMC.WAD_SUBMIT_CLIENT){
                handleAddClient(pContent);
            } else if(pCode == HMC.WAD_REGISTRATION_FILE){
                submitStatusRegsitrationFile(pContent);
            } else if(pCode == HMC.WAD_RETRIEVE_OFFICE){
                getOffice(pContent);
            } else if(pCode == HMC.WAD_RETRIEVE_OFFICE_TIME){
                getOfficeTime(pContent);
            } else if(pCode == HMC.WAD_SUBMIT_ACTIVITY){
                handleAddActivity(pContent);
            } else if(pCode == HMC.WAD_PUSH_ADMIN_INFO){
                handleAdminInfo(pContent);
            } else if(pCode == HMC.WAD_RETRIEVE_MEMBER_INFO_EDIT){
                handleEditMember(pContent);
            }else if(pCode == HMC.WAD_SUBMIT_MEMBER_INFO_EDIT){
                handleSubmitEditMember(pContent);
            } else if(pCode == HMC.WAD_RETRIEVE_ROLE){
                getRole(pContent);
                retrivePosition(pContent)
            } else if(pCode == HMC.WAD_RETRIEVE_LIST_COMPANY){
                handleRetrieveCompany(pContent);
            } else if(pCode == HMC.WAD_RETRIEVE_LIST_DETAIL_COMPANY){
                handleRetrieveReport(pContent);
            } else if(pCode == HMC.WAD_RETRIEVE_LIST_DETAIL_COMPANY_PERSHEET){
                handleRetrieveReport(pContent);
            } else if(pCode == HMC.WAD_ADD_ORGANIZATION){
                statusAddOrganization(pContent);
            } else if(pCode == HMC.WAD_REMOVE_ORGANIZATION){
                statusRemoveOrganization(pContent);
            } else if(pCode == HMC.WAD_RETRIVE_ORG_DETAIL){
                retriveOrgDetail(pContent);
            } else if(pCode == HMC.WAD_EDT_ORG){
                statusEdtOrganization(pContent);
            } else if(pCode == HMC.WAD_ADD_USER_ADMIN){
                handlesubmitUserAdmin(pContent);
            } else if(pCode == HMC.WAD_CHANGE_PASSWORD){
                console.log(pContent);
                handleChangePassword(pContent)
            } else if(pCode == HMC.WAD_EMAIL_CONFIG_RETRIEVE){
                handleEmailConfig(pContent);
            } else if(pCode == HMC.RETRIEVE_USER_COMPANY){
                renderAdminPerCompany(pContent);
            } else if(pCode == HMC.RETRIEVE_COMPANY){
                renderCompanyList(pContent)
            } else if(pCode == HMC.WAD_ADD_POSITION){
                statusAddPosition(pContent)
            } else if(pCode == HMC.WAD_OFFICE_ADD){
                status_add_office(pContent)
            } else if(pCode == HMC.WAD_RETRIEVE_RS){
                retrieve_rs(pContent)
            } 
            else if(pCode == HMC.WAD_SUBMIT_RS){
                status_submit_rs(pContent)
            } 
            else if(pCode == HMC.WAD_EDIT_RS){
                status_edit_rs(pContent)
            } 
            else if(pCode == HMC.WAD_EMAIL_CONFIG_EDIT){
                console.log(pContent);
                handleEmailConfigEdit(pContent);
            } else if(pCode == HMC.WAD_SEARCH_ORGANIZATION){
                handleSearchOrganization(pContent);
            } else if(pCode == HMC.WAD_SEARCH_MEMBER){
                handleSearchMember(pContent);
            }
            else if(pCode == HMC.WAD_LIST_APPROVAL){
                approval_request.get_list_of_request(pContent)
            }
            else if(pCode == HMC.WAD_VIEW_APPROVAL){
                approval_request.get_list_detail(pContent)
            }
            else if(pCode == HMC.WAD_REPORT_SUMMARY){
                console.log("WAD_REPORT_SUMMARY");
                console.log(pContent);
                handleReportSummary(pContent);
//                approval_request.get_list_detail(pContent)
            }else if(pCode == HMC.WAD_REPORT_DETAIL_SUMMARY){
                console.log("WAD_REPORT_DETAIL_SUMMARY");
                console.log(pContent);
                handleReportDetailSummary(pContent);
//                approval_request.get_list_detail(pContent)
            } else if (pCode == HMC.WAD_EDIT_VIEW_USER_ADMIN){
                handleEditVIewUserAdmin(pContent);
            } else if (pCode == HMC.WAD_DAFTAR_COMPANY_ADDRESS){
                getOffice(pContent);
            } else if (pCode == HMC.WAD_ADD_USER_ADMIN_SINGLE){
                handlesubmitUserAdmin(pContent);
            } else if (pCode == HMC.WAD_EDIT_USER_ADMIN){
                handleNotifikasiEditUser(pContent);
            } else if(pCode == "MCS"){
		setTimeout(function(){
		 incomingMessage(pContent);
		},2000)
                //incomingMessage(pContent);
            } else if(pCode == "PM"){ // push message
				setTimeout(function(){
					var allMessage = localStorage.getItem("allMessage");
					if(allMessage == null){
						incomingMessage(pContent);
					}
				},3000)
                
            }else if(pCode == "QA"){
                incomingMessage(pContent);
            }else if(pCode == "BTM01"){
                incomingMessage(pContent);
            }else if(pCode == "NRF"){
                incomingMessage(pContent);
            }else if(pCode == "S00"){
                suggestion(pContent);
            }else if(pCode == "S01"){
                incomingMessage(pContent);
            }
        } catch (e) {
            console.log(e);
        }
    },
    response: new Object(),
});

function invalidSession(p_response) {
    localStorage.removeItem("wid");
}

function terminateConnlogOut() {
    localStorage.removeItem("wid");
    ws.close(1000, HMC.LOGOUT);
    directPage(1);
}

function connectedFromMobile() {
    setConnectionWS(true);
    JProcess.initialization();
    showHideInfoConnection(3);
    console.log('mobile connected');
    setTimeout(function() {
        reloadPageAfterConnect();
    }, 3000)
}

function disconnectedFromMobile() {
    setConnectionWS(false);
    showHideInfoConnection(2);
}

function setConnectionWS(p_type) {
    wsConnState = p_type;
}
