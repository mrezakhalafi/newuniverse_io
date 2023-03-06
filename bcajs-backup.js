authorization = "sQ/0yMIR/RW+JBYaKo6/oghsxVpVCotbVlfNei1EueE7Sw17/XcL0w==";
clientid = "A1370B764ABC4B2584FFB4D74ABE2BB8";

//Request Authentication
function requestAuth(){
  $.ajax({
    type: "POST",
    url: "https://uatmb.com:41405/eWallet/RequestAuthentication",
    headers: {
        "Authorization":authorization,
        "ClientID":clientid,
    },
    data: JSON.stringify({"GrantType":"client_credentials","ReferenceID":"123456789"}),
    contentType: "application/json; charset=utf-8",
    dataType: "json",
    success: function(result){
      access_token = result.OutputSchema.AccessToken;
      requestPay();
    }
  });
}

//Request Transaction Payment
function requestPay(){
  $.ajax({
    type: "POST",
    url: "https://uatmb.com:41405/eWallet/RequestTransactionPayment",
    headers: {
        "Authorization":"Bearer " + access_token.toString(),
    },
    data: JSON.stringify({"MerchantID":"89000","MerchantName":"Merchant One","Amount":"'"+bca_payment+"'","Tax":"0.0","TransactionID":"156479","CurrencyCode":"IDR","RequestDate":"2015-04-29 09:54:00","ReferenceID":"123465798","CallbackURL":"https://dev.newuniverse.io/status/ibpayment/"}),
    contentType: "application/json; charset=utf-8",
    dataType: "json",
    success: function(result){
      paymentid = result.OutputSchema.PaymentID;
      landingpage = result.OutputSchema.LandingPageURL;
      window.open(landingpage);
    }
  });
}

//Check Inquiry Status
function checkStatus(){
  $.ajax({
    type: "POST",
    url: "https://uatmb.com:41405/eWallet/RequestInquiryStatus",
    headers: {
        "Authorization":authorization,
        "ClientID":clientid,
    },
    data: {"PaymentList":[{"PaymentID":paymentid.toString()}]},
    // dataType: "json",
    success: function(result){
        // console.log(result);
        // alert(result);
        paymentstatus = result.OutputSchema.PaymentList[0].PaymentStatus;
        //01 failed
        //00 success
        if(paymentstatus == "00"){
          $("#todashboard").click();
        } else {
          alertstatus = result.OutputSchema.PaymentList[0].ReasonStatus.ReasonStatusID;
          alert(alertstatus);
        }
    }
  });
}
