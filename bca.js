authorization = "Ux+P4xfBqT0rw68kgBHdTM2/bc+fZaNqvbaZl0njkt92ZtjxBCDbyQ==";
clientid = "A73EC6ED95507524E05400144FF98E94";
referenceid = "481051";
merchantid = "S405";
merchantname = "Palio";
transactionid = transaction_id.toString();
callbackurl = "https://dev.newuniverse.io/status/palio/status.php";

// requestdate = transaction_date;
amount = bca_payment.toString();
acsToken = "";

corsproxy = "corsproxy.php?url=";
authapi = "https://uatmb.com:41405/eWallet/RequestAuthentication";
paymentapi = "https://uatmb.com:41405/eWallet/RequestTransactionPayment";

//Request Authentication
function requestAuth() {
  $.ajax({
    type: "POST",
    // url: "https://cors-anywhere.herokuapp.com/https://uatmb.com:41405/eWallet/RequestAuthentication",
    url: base_url + corsproxy + authapi + "&referenceid=" + referenceid,
    headers: {
      "Authorization": authorization,
      "ClientID": clientid,
    },
    // data: JSON.stringify({"GrantType":"client_credentials","ReferenceID":"123456789"}),
    data: JSON.stringify({
      "GrantType": "client_credential",
      "ReferenceID": referenceid
    }),
    contentType: "application/json; charset=utf-8",
    dataType: "json",
    success: function (result) {
      // console.log(result);
      if (result.contents.ErrorSchema.ErrorCode == "ESB-00-000") {
        access_token = result.contents.OutputSchema.AccessToken;
        Number.prototype.padLeft = function (base, chr) {
          var len = (String(base || 10).length - String(this).length) + 1;
          return len > 0 ? new Array(len).join(chr || '0') + this : this;
        }
        acsToken = access_token;
        var d = new Date,
          dformat = [d.getFullYear(), (d.getMonth() + 1).padLeft(), d.getDate().padLeft()].join('-') + ' ' + [d.getHours().padLeft(), d.getMinutes().padLeft(), d.getSeconds().padLeft()].join(':');
        requestdate = dformat;
        // console.log(requestdate);
        requestPay();
      } else {
        alert('Request Authentication Failed');
      }

    }
  });
}

//Request Transaction Payment
function requestPay() {
  $.ajax({
    type: "POST",
    // url: "https://cors-anywhere.herokuapp.com/https://uatmb.com:41405/eWallet/RequestTransactionPayment",
    url: base_url + corsproxy + paymentapi + "&merchantid=" + merchantid + "&merchantname=" + merchantname + "&amount=" + amount + "&transactionid=" + transactionid + "&requestdate=" + requestdate + "&referenceid=" + referenceid + "&callbackurl=" + callbackurl + "&access_token=" + access_token.toString(),
    headers: {
      "Authorization": "Bearer " + access_token.toString(),
    },
    data: JSON.stringify({
      "MerchantID": merchantid,
      "MerchantName": merchantname,
      "Amount": bca_payment.toString(),
      "Tax": "0.0",
      "TransactionID": transactionid,
      "CurrencyCode": "IDR",
      "RequestDate": requestdate,
      "ReferenceID": referenceid,
      "CallbackURL": callbackurl
    }),
    contentType: "application/json; charset=utf-8",
    dataType: "json",
    success: function (result) {
      landingpage = result.contents.OutputSchema.LandingPageURL;
      if (result.contents.ErrorSchema.ErrorCode == "ESB-00-000") {
        $.post(window.location.origin + "/sakuku_history.php", {
            accessToken: acsToken,
            transactionID: result.contents.OutputSchema.TransactionID,
            paymentID: result.contents.OutputSchema.PaymentID,
            fullAmount: amount,
            landingPageURL: landingpage
          },
          async function (returnedData) {
            if (returnedData == 1) {
              window.open(landingpage, "_self");
            } else {
              alert('Request Payment Failed');
            }
          }).fail(function () {
            alert('Request Payment Failed');
        });
      } else {
        alert('Request Payment Failed');
      }
    }
  });
}

//Check Inquiry Status
function checkStatus() {
  $.ajax({
    type: "POST",
    url: "https://cors-anywhere.herokuapp.com/https://uatmb.com:41405/eWallet/RequestInquiryStatus",
    headers: {
      "Authorization": authorization,
      "ClientID": clientid,
    },
    data: {
      "PaymentList": [{
        "PaymentID": paymentid.toString()
      }]
    },
    // dataType: "json",
    success: function (result) {
      // console.log(result);
      // alert(result);
      paymentstatus = result.OutputSchema.PaymentList[0].PaymentStatus;
      //01 failed
      //00 success
      if (paymentstatus == "00") {
        $("#todashboard").click();
      } else {
        alertstatus = result.OutputSchema.PaymentList[0].ReasonStatus.ReasonStatusID;
        alert(alertstatus);
      }
    }
  });
}