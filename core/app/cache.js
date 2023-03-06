var CACHE_ID = {
    PRODUCT_LIST_SEV: 1,
    PRODUCT_BASED_ON_PARENT: 8,
//    INCENTIVE_PROGRAM_HDR: 17,
    FRONTLINER: 18,
    PACKAGE_HDR: 24,
    RS: 1548,
    GC_STOCK_BALANCE: 28,
    GC_STOCK_BALANCE_DENOM: 29,
//    INCENTIVE_PROGRAM: 58,
    INCENTIVE_REWARD: 43,
    E_VOUCHER: 45,
    INCENTIVE_ALL_PROGRAM: 59,
};

var CACHE_MESSAGE = {
//    GC_STOCK_BALANCE: function() {
//        var msg = new GetDataFromRetrowM();
//        msg.setRetId(CACHE_ID.GC_STOCK_BALANCE + "");
//        msg.addRetCond(" = " + Home.outletID);
//        msg.addRetCond(" = 3");
//
//        var retrow = new RetrowMessage(CACHE_ID.GC_STOCK_BALANCE, msg);
//        return retrow;
//    },
//    E_VOUCHER: function() {
//        var msg = new GetDataFromRetrowM();
//        msg.setRetId(CACHE_ID.E_VOUCHER);
//
//        var retrow = new RetrowMessage(CACHE_ID.E_VOUCHER, msg);
//        return retrow;
//    },
    FRONTLINER: function () {
        var msg = new GetDataFromRetrowM();
        msg.setRetId(CACHE_ID.FRONTLINER);
        msg.addRetCond(" = " + Home.outletID);
        msg.addRetCond(" = 5 ");

        var retrow = new CacheMessage(CACHE_ID.FRONTLINER, msg, true);
        return retrow;
    },
//    INCENTIVE_PROGRAM: function() {
//        var msg = new GetDataFromRetrowM();
//        msg.setRetId(CACHE_ID.INCENTIVE_PROGRAM);
//        msg.addRetCond(" = " + Home.outletID);
//        msg.addRetCond(" = " + Home.territory);
//        
//        var retrow = new CacheMessage(CACHE_ID.INCENTIVE_PROGRAM, msg, true);
//        return retrow;
//    },
    INCENTIVE_ALL_PROGRAM: function () {
        var msg = new GetDataFromRetrowM();
        msg.setRetId(CACHE_ID.INCENTIVE_ALL_PROGRAM);
        msg.addRetCond(" = " + Home.outletID);
        msg.addRetCond(" = " + Home.territory);

        var retrow = new CacheMessage(CACHE_ID.INCENTIVE_ALL_PROGRAM, msg, true);
        return retrow;
    },
//    INCENTIVE_PROGRAM_HDR: function() {
//        var pic = "";
//        if (Home.sFlagMaster === 1 || Home.sFlagMaster === "1") {
//            pic = Home.outletID;
//        } else {
//            pic = Home.userID;
//        }
//        var msg = new GetDataFromRetrowM();
//        msg.setRetId(CACHE_ID.INCENTIVE_PROGRAM_HDR);
//        msg.addRetCond(" = " + pic);
//
//        var retrow = new CacheMessage(CACHE_ID.INCENTIVE_PROGRAM_HDR, msg, true);
//        return retrow;
//    },
    INCENTIVE_REWARD: function () {
        var msg = new GetDataFromRetrowM();
        msg.setRetId(CACHE_ID.INCENTIVE_REWARD);
//        msg.addRetCond(" = " + (Home.sFlagMaster === 0 || Home.sFlagMaster === "0" ? Home.userID : Home.outletID));
//        msg.addRetCond(" = " + (Home.sFlagMaster === 0 || Home.sFlagMaster === "0" ? "3" : "1"));
        msg.addRetCond(" = " + Home.outletID);

        var retrow = new CacheMessage(CACHE_ID.INCENTIVE_REWARD, msg, true);
        return retrow;
    },
    PACKAGE_HDR: function () {
        var msg = new GetDataFromRetrowM();
        msg.setRetId(CACHE_ID.PACKAGE_HDR);
        msg.addRetCond(" = 3 ");

        var retrow = new CacheMessage(CACHE_ID.PACKAGE_HDR, msg, true);
        return retrow;
    },
    RS: function () {
        var msg = new GetDataFromRetrowM();
        msg.setRetId(CACHE_ID.RS);
        msg.addRetCond(" = " + Home.userID);
        var retrow = new CacheMessage(CACHE_ID.RS, msg, true);
        return retrow;
    },
    PRODUCT_BASED_ON_PARENT: function () {
        var msg = new GetDataFromRetrowM();
        msg.setRetId(CACHE_ID.PRODUCT_BASED_ON_PARENT);
        msg.addRetCond(" = " + Home.outletID);

        var retrow = new CacheMessage(CACHE_ID.PRODUCT_BASED_ON_PARENT, msg, true);
        return retrow;
    },
//    PRODUCT_LIST_SEV: function(){
////        var msg = new RetrieveProductSevM();
//           var userSO = new UserSO().getData();
//           var msg = new RetrieveBalanceWalletM();
//               msg.setOutletId(userSO.outletId);
//        var retrieve = new CacheMessage(CACHE_ID.PRODUCT_LIST_SEV, msg, true);
//        return retrieve;
//    }
};

var CacheMessage = Class.extend({
    construct: function (pId, pMsg, pAuto) {
        this.id = pId;
        this.msg = pMsg;
        this.autoLoad = pAuto;
    },
    id: 0,
    msg: new Object(),
    autoLoad: false
});

var Cache = Class.extend({
    construct: function () {
        CACHE = new Object();
    },
    load: function () {
        for (var i in CACHE_MESSAGE) {
            try {
                var message = CACHE_MESSAGE[i]();
                if (message.autoLoad) {
                    var sender = new Sender(message.msg, message.id);
                    sender.send(function (pResponse, pErrorCode) {
                        var cacheId = parseInt(this.arg_1);
                        if (cacheId === CACHE_ID.INCENTIVE_PROGRAM) {
                            console.log("Load cache " + cacheId);
                            console.log(this.msg);
                            console.log(eval(pResponse));

                            console.log("outlet " + Home.outletID);
                            console.log("sales t " + Home.territory);
                        }
                        CACHE[cacheId] = eval(pResponse);
                    }.bind(sender));
                }
            } catch (e) {
                console.log(e);
            }
        }
    },
    loadCache: function (pCacheId, pCallback) {
        try {
            if (typeof (pCallback) !== "function") {
                pCallback = function () {
                };
            }
            for (var i in CACHE_MESSAGE) {
                var message = CACHE_MESSAGE[i]();
                if (message.id === pCacheId) {
                    if (message !== undefined) {
                        var sender = new Sender(message.msg, message.id);
                        sender.send(function (pResponse, pErrorCode) {
                            var cacheId = parseInt(this.arg_1);
                            CACHE[cacheId] = eval(pResponse);
                            pCallback();
                        }.bind(sender));
                    }
                    break;
                }
            }
        } catch (e) {
            console.log(e);
        }
    },
    clear: function () {
        CACHE = new Object();
    },
    get: function (p_id) {
        return CACHE[p_id];
    },
    toSelectOptions: function (p_id) {
        var cache = this.get(p_id);
        var option = new Array();
        console.log("toSelectOptions: " + p_id);
        console.log(cache);
        for (var i in cache) {
            switch (p_id) {
                case CACHE_ID.GC_STOCK_BALANCE:
                    option.push({value: cache[i][0], label: cache[i][1]});
                    break;
                default:
                    option.push({value: cache[i][0], label: cache[i][1]});
                    $('#beid').val(cache[i][0]);
                    break;
            }
        }
        return option;
    }
});