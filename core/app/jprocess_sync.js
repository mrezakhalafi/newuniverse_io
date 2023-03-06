/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var JProcess_sync = {
    product: function (data, p_func) {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.RETRIVE_PRODUCT);

        var cmessage = new ContentM();
        cmessage.putBody("A112", data);
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.sSendResp(function (p_mid, p_resp) {
            if (typeof p_func === "function") {
                p_func(p_mid, p_resp);
            }
        });
    },
    adminInfo: function (p_func) {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.WAD_PUSH_ADMIN_INFO);
        var sender = new Sender(hmessage);
        sender.sSendResp(function (p_mid, p_resp) {
            if (typeof p_func === "function") {
                p_func(p_mid, p_resp);
            }
        });
    },
    editMember : function(p_name, p_mdn, p_email, p_func){
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.WAD_SUBMIT_MEMBER_INFO_EDIT);
        var cmessage = new ContentM();
        cmessage.putBody(HMK.WAD_NAME, p_name);
        cmessage.putBody(HMK.WAD_MSISDN, p_mdn);
        cmessage.putBody(HMK.WAD_EMAIL, p_email);
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.sSendResp(function (p_mid, p_resp) {
            if (typeof p_func === "function") {
                p_func(p_mid, p_resp);
            }
        });
    },
    addOffice : function(p_name, p_addr, p_lat, p_lng, p_rad, p_func){
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
        sender.sSendResp(function (p_mid, p_resp) {
            if (typeof p_func === "function") {
                p_func(p_mid, p_resp);
            }
        });
    },
};
