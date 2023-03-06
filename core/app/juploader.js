/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/* global HMC */

var JUploader = {
    upload: function (p_attach_data, p_file_name, p_prefix, p_thumb, p_func) {
        var hmessage = new HeaderM();
        hmessage.setCode(HMC.WAD_UPLOAD);

        var cmessage = new ContentM();
        cmessage.putBody("A112", p_attach_data);
        cmessage.putBody("A92", p_file_name);
        cmessage.putBody("A153", p_prefix);
        cmessage.putBody("A74", p_thumb);
        hmessage.addContent(cmessage);
        var sender = new Sender(hmessage);
        sender.sSendResp(function (p_mid, p_resp) {
            if (typeof p_func === "function") {
                p_func(p_mid, p_resp);
            }
        });
    },
};
