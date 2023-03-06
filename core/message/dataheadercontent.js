/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/* global Message, gs_main */

var HeaderM = Message.extend({
    construct: function () {
        arguments.callee.super.construct.call(this);
        var time = new Date();
        this.cw_content = new Array();
//        this.cw_wid = localStorage.getItem("wid");
        this.cw_wid = "";
        this.cw_code = '';
        this.cw_time = time.getTime();
        this.cw_mid = "" + HMI.next() + "wad";
        this.cw_f_pin = '';
        this.cw_ack = '1';
    },
    setWId: function (pWId) {
        this.cw_wid = pWId;
    },
    setCode: function (pCode) {
        this.cw_code = pCode;
    },
    setPin: function (pPin) {
        this.cw_f_pin = pPin;
    },
    setContent: function (pContent) {
        this.cw_content = pContent;
    },
    addContent: function (pContent) {
        this.cw_content.push(pContent.pack());
    },
    packConArrJSON : function(pContent){
        this.cw_content.push(pContent.pack());
    },
    pack: function () {
        arguments.callee.super.pack.call(this);

        this.msg = new Object();
        this.msg.cw_wid = this.cw_wid;
        this.msg.cw_code = this.cw_code;
        this.msg.cw_time = this.cw_time;
        this.msg.cw_mid = this.cw_mid;
        this.msg.cw_f_pin = this.cw_f_pin;
        this.msg.cw_ack = this.cw_ack;
        this.msg.cw_content = JSON.stringify(this.cw_content);
        return this.msg;
    }
});

var ContentM = Message.extend({
    construct: function () {
        arguments.callee.super.construct.call(this);
        this.mBodies = new Object();
    },
    putBody: function (p_key, p_value) {
        if (p_key != null && !p_key == "") {
            this.mBodies[p_key] = p_value;
        }
    },
    pack: function () {
        arguments.callee.super.pack.call(this);

        this.msg = new Object();
        for (var key in this.mBodies) {
            if (!this.mBodies.hasOwnProperty(key)) {
                continue;
            }
            this.msg[key] = this.mBodies[key];
        }
        return this.msg;
    }
});
