var Sender = Class.extend({
    construct: function (pMsg, pScqrc) {
        this.msg = pMsg;
        this.scqrc = pScqrc;
    },
    send: function (callback, loading) {
        if (loading) {
            loadingScreen(true);
        }
        try {
            if(this.scqrc == "CS:"){
                var data = JSON.stringify(this.msg.pack());
                var msg = "CS:" + data
                if(wsConnState) {
                    ws.send(msg);
                }
            }else if (this.scqrc) {
                alert("XXLGN")
                var data = JSON.stringify(this.msg.pack());
                var msg = "XXLGN:" + data
                if(wsConnState) {
                    ws.send(msg);
                }
            } else {
                var msg = JSON.stringify(this.msg.pack());
                ws.send(msg);
            }
        } catch (e) {
            console.log(e);
        }
    },
    sSendResp : function(onReturnFunction) {
        if(true) {
    //        if (typeof (returnFunc) == 'function') {
                socketQueue['i_' + this.msg.cw_mid] = onReturnFunction;
    //        }
            try {
                if(wsConnState) {
                    ws.send(JSON.stringify(this.msg.pack()));
                }
            } catch (e) {
                console.log('Sending failed ... .disconnected');
                console.log(e);
            }
        }
    },
    msg: new Message(),
    scqrc: false, // scanned qrcode
});