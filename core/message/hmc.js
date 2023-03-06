/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


var HMC = {
    INITIALIZATION : "ZNZ",
    INVALID_SESSION : "ZNS",
    NOTIF : "NTW",
    
    CONNECTED_FROM_MOBILE : "CFM",
    DISCONNECTED_FROM_MOBILE : "DFM",
    
    INIT_RETRIEVE_MYSELF : "ZWM",
    INIT_RETRIEVE_FRIEND_LIST : "ZWL",
    INIT_RETRIEVE_TOPIC : "ZWT",
    INIT_RETRIEVE_GROUP : "ZWG",
    INIT_RETRIEVE_DF_TEMPLATE : "ZWD",
    INIT_RETRIEVE_SUB_ACTIVITY : "ZWS",
    INIT_RETRIEVE_ORGANIZATION_LEADER : "ZWO",
    INIT_RETRIEVE_UC_LIST : "ZWU",
    INIT_WEB_FINISH : "ZWF",
    
    GET_INFO_MESSAGE : "Z07",
    
    /**
     * 
     * @type Temporary
     */
    RETRIEVE_UC_LIST : "Z08",
    
    
    LOAD_MORE_MESSAGES : "Z09",
    
    SEND_IM: "Z10",
    READ_IM : "Z11",
    DELETE_IM : "Z12",
    SEARCH_IM : "Z13",
    ADD_TAG_IM : "Z14",
    DELETE_CONVERSATION : "Z15",
    READ_SINGLE_IM : "Z16",
    
    CONFIRMATION_IM : "Z18",
    
    
    SCANNED_QR_CODE : "Z19",
    LOGIN_NU : "WADZNL",
    LOGOUT : "Z20",
    RETRIEVE_DIF_BROWSE : "Z23",
    RETRIEVE_DIF_OPEN : "Z24",
    CHANGE_PERSON_INFO : "Z25",
    MARK_ALL_AS_READ : "Z26",
    UPDATE_MESSAGES : "Z27",
    LOAD_FAVORITE_MESSAGES : "Z28",
    GET_MESSAGE_OBJECT : "Z29",
    
    CREATE_GROUP : "Z30",
    DELETE_GROUP : "Z31",
    LEAVE_GROUP : "Z32",
    CHANGE_GROUP_INFO : "Z33",
    PUSH_GROUP : "Z34",
    PUSH_GROUP_MEMBER : "Z35",
    ADD_TOPIC : "Z36",
    REMOVE_TOPIC : "Z37",
    UPDATE_TOPIC : "Z38",
    ADD_MEMBER : "Z39",
    REMOVE_MEMBER : "Z40",
    CHANGE_GROUP_MEMBER_POSITION : "Z41",
    
    GET_PROGRESS_DASHBOARD : "Z43",
    GET_PROGRESS_RETRIEVE : "Z44",
    GET_PROGRESS_SUB_ACTIVITY : "Z45",
    GET_PROGRESS_RETRIEVE_TASK_TITLE : "Z46",
    
    GET_FROM_SERVER : "Z48",
    PUSH_TOPIC : "Z47",
    
    FORM_APPROVAL : "Z60",
    GET_FORM_DETAIL : "Z61",
    FORM_PIC_SUBMIT : "Z62",
    FORM_FOLLOW : "Z63",
    UPDATE_CTEXT : "A002",
    FORM_PIC_SUBMIT_STATUS : "A114",
    
    UPLOAD : "Z50",
    
    LOAD_EMAIL : "Z51",
    ADD_EMAIL : "Z52",
    CONNECT_DISCONNECT_EMAIL : "Z53",
    REMOVE_EMAIL : "Z54",
    CHECK_LEAVE : "Z55",
    PUSH_CLIENT_ADDRESS : "Z56",
    
    GET_MESSAGE_OBJECT_BASED_ON_REFID : "Z59",
    RETRIEVE_DIF_SEARCH : "Z64",
    LUNCH_STORIES : "Z57",
    GET_DATA_CALENDAR : "Z58",
    
    TYPING_MESSAGE : "Z06",
    
    /*nu channel post timeline*/
    POST_TIMELINE : "Z65",
    MINE_INFO : "Z66",
    RETRIEVE_TIMELINE_FIRST : "Z67",
    RETRIEVE_TIMELINE_OLDEST : "Z68",
    RETIREVE_TIMELINE_NEWEST : "Z69",
    RETRIEVE_TIMELINE_FIRST_MINE : "Z70",
    RETRIEVE_TIMELINE_OLDEST_MINE : "Z71",
    RETRIEVE_TIMELINE_NEWEST_MINE : "Z72",
    
    /*like*/
    LIKE_UNLIKE : "Z73",
    ADD_COMMENT : "Z74",
    VIEW_COMMENT : "Z75",
    DELETE_COMMENT : "Z76",
    EDIT_POST : "Z77",
    COUNT_LIKE_COMMENT : "Z78",
    CHANGE_PRIVACY : "Z79",
    WAD_REGISTRATION_FILE : "WADZ01",
    WAD_RETRIEVE_CLIENT : "WADZ02",
    WAD_RETRIEVE_PROJECT : "WADZ03",
    WAD_RETRIEVE_HIERARCHY:  "WADZ10",
    WAD_SUBMIT_CLIENT : "WADZ05",
    WAD_SUBMIT_PROJECT : "WADZ06",
    WAD_SUBMIT_ACTIVITY : "WADZ19",
    WAD_RETRIEVE_DIVISI : "WADZ08",
    WAD_RETRIEVE_MEMBER : "WADZ09",
    WAD_SUBMIT_USER : "WADZ15",
    WAD_RETRIEVE_ACTIVITY : "WADZ13",
    WAD_RETRIEVE_RESPONSIBLE : "WADZ14",
    WAD_RETRIEVE_OFFICE : "WADZ16",
    WAD_RETRIEVE_ACOUNTABLE : "WADZ17",
    WAD_RETRIEVE_OFFICE_TIME : "WADZ18",
    WAD_RETRIEVE_CONSULTED_AND_INFORMED : "WADZ20",
    WAD_SUBMIT_CONTEXT_ACTIVITY : "WADZ21",
    WAD_PENDING_ACTION : "WADZ22",
    WAD_PUSH_ADMIN_INFO : "WADZ23",
    WAD_RETRIEVE_MEMBER_INFO_EDIT : "WADZ24",
    WAD_SUBMIT_MEMBER_INFO_EDIT : "WADZ25",
    WAD_OFFICE_ADD : "WADZ45",
    WAD_UPLOAD : "WADZ50",
    WAD_INVALID_SESSION : "WADZNS",
    WAD_LOGOUT : "WADZLO",
    WAD_RETRIEVE_ROLE : "WADZ26",
    WAD_RETRIEVE_LIST_COMPANY : "WADZ27",
    WAD_RETRIEVE_LIST_DETAIL_COMPANY : "WADZ28",
    WAD_RETRIEVE_LIST_DETAIL_COMPANY_PERSHEET : "WADZ29",
    WAD_ADD_ORGANIZATION : "WADZ30",
    WAD_REMOVE_ORGANIZATION : "WADZ31",
    WAD_MUTATION_ROLE : "WADZ32",
    WAD_RETRIVE_ORG_DETAIL : "WADZ33",
    WAD_EDT_ORG : "WADZ34",
    WAD_RETRIEVE_HIERARCHY_NEW:  "WADZ40",
    WAD_ADD_USER_ADMIN : "WADZ60",
    WAD_CHANGE_PASSWORD  : "WADZ43",
    RETRIEVE_USER_COMPANY : "WADZ48",
    WAD_EMAIL_CONFIG_RETRIEVE : "WADZ49",
    RETRIEVE_COMPANY : "WADZ51",
    WAD_ADD_POSITION : "WADZ44",
    WAD_EMAIL_CONFIG_EDIT : "WADZ47",
    WAD_SEARCH_ORGANIZATION : "WADZ53",
    WAD_SEARCH_MEMBER : "WADZ54",
    WAD_RETRIEVE_RS : "WADZ55",
    WAD_SUBMIT_RS : "WADZ56",
    WAD_EDIT_RS : "WADZ57",
    WAD_LIST_APPROVAL: "WADZ58",
    WAD_VIEW_APPROVAL: "WADZ59",
    WAD_REPORT_SUMMARY: "WADZ61",
    WAD_REPORT_DETAIL_SUMMARY: "WADZ62",
    WAD_EDIT_VIEW_USER_ADMIN : "WADZ64",
    WAD_ADD_USER_ADMIN_SINGLE : "WADZ63",
    WAD_DAFTAR_COMPANY_ADDRESS : "WADZ66",
    WAD_EDIT_USER_ADMIN : 'WADZ65'
};


var HMK = {
    F_PIN : "A00",
    POST_ID : "PO1",
    FLAG_REACTION : "FL1",
    LAST_UPDATE : "A11",
    BEFORE_FLAG_CHANGE : "BC1",
    PARTICIPATE_ID : "PTI",
    ADDRESS : "FL3",
    TYPE_ADS : "FL4",
    TYPE_LP : "FL5",
    TYPE_POST : "FL6",
    LAST_EDIT : "l_ed",
    TITLE : "A37",
    DESCRIPTION : "A40",
    TYPE : "A38",
    AUDITION_DATE : "FL2",
    PRIVACY_FLAG : "A27",
    MEDIA_TYPE : "A30",
    THUMB_ID : "A74",
    FILE_ID : "BN",
    
    COMMENT_ID : "A162",
    COMMENT_TEXT : "A161",
    COMMENT_DATE : "A160",
    COMMENT_REF : "A159",
    
    TL_POST_ID : "A170",
    TL_POST_TITLE : "A171",
    TL_POST_DESC : "A172",
    TL_POST_AUDITION : "A173",
    TL_POST_TYPE : "A174",
    TL_POST_CREATE_DATE : "A175",
    TL_POST_AUDITION_DATE : "A176",
    TL_POST_THUMBID : "A177",
    TL_POST_PRIV_FLAG : "A178",
    TL_POST_FILE_ID : "A179",
    TL_DURATION : "A180",
    TL_POST_CAT_ID : "A181",
    TL_POST_MEDIA_TYPE : "A182",
    TL_POST_TYPE_ADS : "A183",
    TL_POST_CODE : "A184",
    TL_TIME : "A185",
    TL_TYPE_RET : "B170",
    
    USER_IDS : "B7",
    PASSWORD : "Bm",
    WAD_UPL_ORGANIZATION : "WD01",
    WAD_UPL_MEMBER : "WD02",
    WAD_UPL_ACTIVITY : "WD03",
    WAD_UPL_OFFICE : "WD04",
    WAD_SELECT_COUNTRY : "WD09",
    WAD_COMPANY_NAME : "WD17",
    WAD_COMPANY_ADDRESS : "WD41",
    WAD_UNIT : "WD12",
    WAD_CITY : "WD13",
    WAD_REGION : "WD14",
    WAD_POSTZIPCODE : "WD15",
    WAD_NPWP : "WD16",
    WAD_UPL_CLIENT : "WD21",
    WAD_UPL_PROJECT: "WD22",
    WAD_EXT: "WD27",
    WAD_TIME: "WD32",
    WAD_LATITUDE : "WD42",
    WAD_LONGITUDE : "WD43",
    WAD_GROUP_ID : "WD44",
    WAD_ACTIVITY_ID : "WD18",
    WAD_RESPONSIBLE_ID : "WD19",
    
    WAD_ID: "WD23",
    WAD_PROJECT: "WD24",
    WAD_SC_DATE: "WD45",
    WAD_EC_DATE: "WD46",
    WAD_TITLE: "WD27",
    WAD_THUMB: "WD28",
    WAD_BE: "WD29",
    WAD_STATUS: "WD30",
    WAD_NAME: "WD31",
    WAD_NIK: "WD32",
    WAD_MSISDN: "WD33",
    WAD_EXT: "WD35",
    WAD_GROUP: "WD37",
    WAD_AC: "WD38",
    WAD_OFFCIE: "WD39",
    WAD_TIME: "WD40",
    WAD_CLIENT : "WD47",

    WAD_EMAIL: "WD05",
    WAD_COMPANY: "WD06",
    WAD_TYPE: "WD08",
    WAD_GROUP_ID: "WD44",
    WAD_R : "WD48",
    WAD_A : "WD49",
    WAD_C : "WD50",
    WAD_I : "WD51",
    WAD_SCHEME : "WD55",
    WAD_ORGANIZATION : "WD56",
    WAD_START : "WD57",
    WAD_TO : "WD58",
    WAD_DATA_USER_ADMIN : "WD62",
    WAD_USERNAME : 'WD53',
    WAD_USERID : 'WD52',
    WAD_PASSWORD : 'WD54',
    WAD_OLD : 'WD63',
    WAD_NEW : 'WD54',
    WAD_CONFIRM : 'WD64',
    WAD_RADIUS : 'WD65',
    WAD_COMPANY_ID : 'WD06',
    WAD_POP_HOST: 'WD66',
    WAD_POP_PORT: 'WD67',
    WAD_IMAP_HOST: 'WD70',
    WAD_IMAP_PORT: 'WD71',
    WAD_SMTP_HOST: 'WD68',
    WAD_SMTP_PORT: 'WD69',
    WAD_SEARCH: 'Bt',
    WAD_CONTACT_NO : 'B5',
    EMAIL : 'B6',
    WAD_COMPANY_PHONE_NO : 'WD72',
};




























//function getTimeline(p_response){
//    if(p_response == undefined || p_response == null){
//        p_response = "";
//    }
//    let arr_timeline = [];
//    let obj, obj2, obj3, obj4, obj5;
//    try{
//        obj = {
//            timeline_title : 'Kompetisi desain UI NU channel berhadiah jutaan rupiah',
//            timeline_content : 'Kamu punya bakat dan keahlian dalam desain ? Segera kirim hasil karyamu\n\
//                                dalam kompetisi desain UI NU Channel. Menanti hadiah menarik sampai dengan 500 juta rupiah!!\n\
//                                Ayo partisipasi sekarang juga dengan cara menekan ikon tangan dibawah ini',
//            timeline_likes : '12',
//            timeline_dislikes : '3',
//            timeline_comments : '8',
//            timestamp : '1543298108450',
//            thumb_id : 'img/nu_image/user.png',
//            timelime_type : '1',
//            file_id : '',
//            f_pin : '',
//        };
//        
//        obj2 = {
//            timeline_title : 'NU Studio membuka peluang untuk anak muda berbakat',
//            timeline_content : 'Kamu punya bakat dan keahlian dalam desain ? Segera kirim hasil karyamu\n\
//                                dalam kompetisi desain UI NU Channel. Menanti hadiah menarik sampai dengan 500 juta rupiah!!\n\
//                                Ayo partisipasi sekarang juga dengan cara menekan ikon tangan dibawah ini',
//            timeline_likes : '12',
//            timeline_dislikes : '2',
//            timeline_comments : '29',
//            timestamp : '1543298108450',
//            thumb_id : 'img/nu_image/user.png',
//            timelime_type : '2',
//            file_id : '',
//            f_pin : '',
//        };
//        
//        obj3 = {
//            timeline_title : 'Belajar Pemgrograman dasar',
//            timeline_content : 'Mari belajar pemrograman dengan metode yang lebih menarik dan asik, ayo coding!!',
//            timeline_likes : '12',
//            timeline_dislikes : '2',
//            timeline_comments : '29',
//            timestamp : '1543298108450',
//            thumb_id : 'img/nu_image/user.png',
//            timelime_type : '3',
//            file_id : 'data.pdf',
//            f_pin : '',
//        };
//        
//        obj4 = {
//            timeline_title : 'Dua Sosok Dibalik Gaya Keren Jokowi',
//            timeline_content : 'Tidak bisa dipungkiri apa pun yang dipakai Presiden Jokowi selalu terlihat keren dan pada akhirnya\n\
//                               menjadi viral. Ternyata orang orang dibalik gaya keren jokowi diantaranya adalah anaknya sendiri...',
//            timeline_likes : '12',
//            timeline_dislikes : '2',
//            timeline_comments : '29',
//            timestamp : '1543298108450',
//            thumb_id : 'img/nu_image/user.png',
//            timelime_type : '2',
//            file_id : '',
//            f_pin : '',
//        };
//        
//        obj5 = {
//            timeline_title : 'Belajar Invesatasi sejak dini',
//            timeline_content : 'Mari belajar pemrograman dengan metode yang lebih menarik dan asik, ayo coding!!',
//            timeline_likes : '12',
//            timeline_dislikes : '2',
//            timeline_comments : '29',
//            timestamp : '1543298108450',
//            thumb_id : 'img/nu_image/user.png',
//            timelime_type : '3',
//            file_id : 'invest.pdf',
//            f_pin : '',
//        };
//        
//        arr_timeline.push(obj);
//        arr_timeline.push(obj2);
//        arr_timeline.push(obj3);
//        arr_timeline.push(obj4);
//        arr_timeline.push(obj5);
//       
//        let i = 0;
//        for(i; i < arr_timeline.length; i++){
//            let container;
//            let format_date = formatTime(arr_timeline[i].timestamp.toString());
//            switch (arr_timeline[i].timelime_type){
//                /*
//                 * specify adapter view
//                 */
//                case '1': // type pict & image 
//                container = '<div class="card card-container">\n\
//                                    <div class="linier_content">\n\
//                                        <div class="tl_wrapper_head">\n\
//                                            <label class="user_profile_tl"><img class="round" src="'+arr_timeline[i].thumb_id+'"></label>\n\
//                                            <label id="user_profile_text">'+arr_timeline[i].timeline_title+'</label>\n\
//                                            <p class="tl_time">'+format_date+'</p>\n\
//                                            <p class="tl_content">'+arr_timeline[i].timeline_content+'</p>\n\
//                                            <div class="thumb_content">\n\
//                                                <img class="lazy_load" src="img/nu_image/nature1.png"/>\n\
//                                            </div\n\
//                                            <div class="linier_content_detail">\n\
//                                                <img class="icon_content lazy_load" src="img/nu_image/like.png"/>\n\
//                                                <label class="label_content">&nbsp;'+arr_timeline[i].timeline_likes+'</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n\
//                                                <img class="icon_content lazy_load" src="img/nu_image/dislike.png"/>\n\
//                                                <label class="label_content">&nbsp;'+arr_timeline[i].timeline_dislikes+'</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n\
//                                                <img class="icon_content lazy_load" src="img/nu_image/comment.png"/>\n\
//                                                <label class="label_content">&nbsp;'+arr_timeline[i].timeline_comments+'</label>\n\
//                                                <img class="icon_content_medium toright lazy_load" src="img/nu_image/more.png"/>\n\
//                                            </div>\n\
//                                        </div>\n\
//                                    </div>\n\
//                                </div>';
//                break;
//                case '2' : // type video
//                container = '<div class="card card-container">\n\
//                                <div class="linier_content">\n\
//                                    <div class="tl_wrapper_head">\n\
//                                        <label class="user_profile_tl"><img class="round lazy_load" src="'+arr_timeline[i].thumb_id+'"></label>\n\
//                                        <label id="user_profile_text">'+arr_timeline[i].timeline_title+'</label>\n\
//                                        <p class="tl_time">'+format_date+'</p>\n\
//                                        <p class="tl_content">'+arr_timeline[i].timeline_content+'</p>\n\
//                                        <div class="thumb_content">\n\
//                                            <video width="100%" controls>\n\
//                                                 <source src="img/nu_image/video.mp4" type="video/mp4">\n\
//                                            </video>\n\
//                                        </div\n\
//                                        <div class="linier_content_detail">\n\
//                                                <img class="icon_content lazy_load" src="img/nu_image/like.png"/>\n\
//                                                <label class="label_content">&nbsp;'+arr_timeline[i].timeline_likes+'</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n\
//                                                <img class="icon_content lazy_load" src="img/nu_image/dislike.png"/>\n\
//                                                <label class="label_content">&nbsp;'+arr_timeline[i].timeline_dislikes+'</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n\
//                                                <img class="icon_content lazy_load" src="img/nu_image/comment.png"/>\n\
//                                                <label class="label_content">&nbsp;'+arr_timeline[i].timeline_comments+'</label>\n\
//                                                <img class="icon_content_medium toright lazy_load" src="img/nu_image/more.png"/>\n\
//                                            </div>\n\
//                                        <div></div>\n\
//                                    </div>\n\
//                                </div>\n\
//                            </div>';
//                break;
//                case '3' : // type docs
//                    container = '<div class="card card-container">\n\
//                                <div class="linier_content">\n\
//                                    <div class="tl_wrapper_head">\n\
//                                        <label class="user_profile_tl"><img class="round lazy_load" src="'+arr_timeline[i].thumb_id+'"></label>\n\
//                                        <label id="user_profile_text">'+arr_timeline[i].timeline_title+'</label>\n\
//                                        <p class="tl_time">'+format_date+'</p>\n\
//                                        <p class="tl_content">'+arr_timeline[i].timeline_content+'</p>\n\
//                                        <div class="thumb_content">\n\
//                                          <label class="doc_container"><img class="lazy_load" height="20" src="img/nu_image/attach_doc.png">&nbsp;&nbsp;'+arr_timeline[i].file_id+'</label>\n\
//                                        </div\n\
//                                        <div class="linier_content_detail">\n\
//                                                <img class="icon_content lazy_load" src="img/nu_image/like.png"/>\n\
//                                                <label class="label_content lazy_load">&nbsp;'+arr_timeline[i].timeline_likes+'</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n\
//                                                <img class="icon_content lazy_load" src="img/nu_image/dislike.png"/>\n\
//                                                <label class="label_content">&nbsp;'+arr_timeline[i].timeline_dislikes+'</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n\
//                                                <img class="icon_content lazy_load" src="img/nu_image/comment.png"/>\n\
//                                                <label class="label_content">&nbsp;'+arr_timeline[i].timeline_comments+'</label>\n\
//                                                <img class="icon_content_medium toright lazy_load" src="img/nu_image/more.png"/>\n\
//                                            </div>\n\
//                                        <div></div>\n\
//                                    </div>\n\
//                                </div>\n\
//                            </div>';
//                break;
//            }
////            TIMELINE_CONTAINER.append(container);
//        }
//    }catch(e){
//        console.log(e);
//    }
//}
