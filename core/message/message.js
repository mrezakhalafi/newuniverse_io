var Message = Class.extend({
    construct: function () {
        this.msg = new Object();
    },
    pack: function () {

        return this.msg;
    },
    unpack: function () {
    },
    msg: new Object(),
});

var ScanQrCode = Message.extend({
    construct: function () {
        arguments.callee.super.construct.call(this);
        this.qrcode = '';
    },
    setQrCode: function (pQrCode) {
        this.qrcode = pQrCode;
    },
    pack: function () {
        this.msg = new Object();

        this.msg.qrcode = this.qrcode;
        return this.msg;
    }
});

var mId = 0;
var HMI = {
    next : function() {
        return this.increase().toString(16);
    },
    increase : function() {
        var now = new Date().getTime();
        if (now > mId) {
            mId = now;
        }
        else {
            ++mId;
            if ((now = mId) == 9223372036854775807) {
                mId = 0;
            }
        }
        return now;
    }
}