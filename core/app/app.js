/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/* global WS_EC, HMC */

//var wsUri = "ws://192.168.0.31:80/ws";
// aws : 
// local dev : 
// local staging : 
//var local_dev = "192.168.0.31:80";
//var cbn = "202.158.33.28:8088"; // direct to cbn
//var cbn = "202.158.33.27:6087";
//var wsUri = "ws://" + cbn + "/ws";
var local_dev = "192.168.0.33:55555";
//var local_dev = "103.94.169.26:55555";




//var local_dev = "34.87.67.217:55555";
//var cbn = "202.158.33.28:8088";
//var aws = "13.250.142.22:8088";
var azure = "newuniverse.io";
var cbn2 = "202.158.33.27:8087";
var azuredev = "103.104.138.104:8087";
var wsUri = "ws://" + local_dev + "/ws";
//var wsUri = "wss://" + azure + "/ws";
//var wsUri = "wss://" + local_dev  + "/ws";
var ws;
var socketQueue = {};
var sCODESNRESP = new Object();

var gs_main = {
    first_name: '',
    last_name: '',
    f_pin: '',
    quote: '',
    thumb_id: '',
};

var wsConnState = false;
var reloadState = false;


var timeoutStateCheck= "";
function waitingStateClosed() {
/*
0	CONNECTING	Socket has been created. The connection is not yet open.
1	OPEN	    The connection is open and ready to communicate.
2	CLOSING	    The connection is in the process of closing.
3	CLOSED	    The connection is closed or couldn't be opened.
*/
    clearTimeout(timeoutStateCheck);
    timeoutStateCheck = setTimeout(function () {
        console.log("waitingStateClosed: " + ws.readyState);
        if (ws.readyState != 3) {
            waitingStateClosed();
        }
        else {
            ws = null;
            initWS();
        }
    }, 1000);
}

function closeIfExist() {
    console.log("Closing existing Web Socket...");
    if (ws != undefined && ws != null) {
        ws.close();
    }
    waitingStateClosed();
}

function initWS() {
    try {
        console.log("init Web Socket to " + wsUri);
        if (ws != undefined || ws != null) {
            closeIfExist();
            return;
        }
        ws = new WebSocket(wsUri);
        console.log("Waiting Web Socket callback.....");

        ws.onopen = function(p_response) {
            console.log('Web Socket onopen');
            $('#showChat').css('display','block');
            ResendInfo();
            if (reconnectId != "") {
                clearTimeout(reconnectId);
                console.log("clearTimeout: " + reconnectId);
            }
            wsConnState = true;
            reloadState = false;
            //        showHideInfoConnection(3);

            $("#modal-connection").modal("hide");
            if (reloadState) {
                console.log('reconnect page after disconnect');
                location.reload();
                reloadState = false;
            } else {
                // getConnectionState();
            }
        };

        ws.onmessage = function(p_response) {
            var data = JSON.parse(p_response.data);
            if (typeof(data['cw_mid']) != 'undefined' && typeof(socketQueue['i_' + data['cw_mid']]) == 'function') {
                if (wsConnState) {
                    execFunc = socketQueue['i_' + data['cw_mid']];
                    execFunc(data['cw_mid'], eval(data['cw_content']));
                    delete socketQueue['i_' + data['cw_mid']];
                    return;
                }
            } else {
                var receiver = new Receiver(p_response);
                receiver.getData();
            }
        };

        ws.onclose = function (p_response) {
            try {
                console.log('Web Socket onclose');
                console.log(p_response);
                wsConnState = false;
                var browser = true;
                var type = localStorage.getItem("type")
                console.log(type)
                console.log("Response reason HMC.LOGOUT --> " + (p_response.reason == HMC.LOGOUT));
                if (p_response.reason == HMC.LOGOUT) {
                    initWS();
                    return;
                }
                
                if (type == null || type == 'null'){
                    // ketika user hanya mengakses website saja, dan socket disconnect maka tidak perlu menampilkan notifikasi connection loss.
                    return;
                }
                console.log("Response code WS_EC.E1006 --> " + (p_response.code == WS_EC.E1006.CODE));
                console.log("Response code WS_EC.E1000 --> " + (p_response.code == WS_EC.E1000.CODE));
                if (p_response.code == WS_EC.E1006.CODE) {
                    if (!browser) {
                        return;
                    } else {
                        console.log("Closed... Abnormal Closure");
                        ws.close();
                        $("#modal-connection").modal("show");
                        $("#span-modal-connection").html("Unfortunately web disconnected");
                        reconnectConnection();
                    }
                }
                else if (p_response.code == WS_EC.E1000.CODE) {
                    console.log("Closed... Normal Closure");
                    if (!browser) {
                        return;
                    } else {
                        $("#modal-connection").modal("show");
                        $("#span-modal-connection").html("Unfortunately web disconnected");
                        reconnectConnection();
                    }
                }
                else if (p_response.code == WS_EC.E1008.CODE) {
                    if (!browser) {
                        return;
                    } else {
                        $("#modal-connection").modal("show");
                        $("#span-modal-connection").html("Security Alert! Unfortunately connection can't establish");
                    }
                }
            } catch(e) {
              console.log(e);
            }
        };

        ws.onerror = function(p_response) {
            console.log('Web Socket onerror');
            console.log(p_response);
            ws.close();
            reloadState = true;
            wsConnState = false;
    //        document.getElementById("login-code").style.display = "none";
    //        $('.loader').fadeIn(100).delay(500);
            console.log("onerror");
        };
     } catch(e) {
        console.log(e);
     }
}

var reconnectId = "";
function reconnectConnection() {
        if (reconnectId != "") {
            clearTimeout(reconnectId);
            console.log("clearTimeout: " + reconnectId);
        }
        if (wsConnState) {
            console.log("close reconnect , connection already established");
            $("#modal-connection").modal("hide");
            return;
        }
        console.log("reconnect connection");
        $("#span-modal-connection").html("Reconnecting...");
        reconnectId = setTimeout(function() {
            initWS();
        }, 15000);
    }


window.addEventListener("load", initWS, false);
sCODESNRESP[HMC.WAD_UPLOAD] = HMC.WAD_UPLOAD;
