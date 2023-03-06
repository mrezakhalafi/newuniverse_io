// Here a date has been assigned
// while creating Date object
dateobj = new Date();
// Contents of above date object is converted
// into a string using toISOString() function.
dates = dateobj.toISOString();
price = "1184400.00";
// datenow = "2020-04-15T21:33:00.000+07:00";

// dates = "2020-04-16T23:23:00.000+07:00";
utilities();

function utilities(){
  $.ajax({
    type: 'POST',
    url: "https://sandbox.bca.co.id/api/oauth/token",
    headers: {
        "Authorization":'Basic MmEyYTRiNjktZmY3Ni00NzMyLWE4M2QtYWIyYzI5YzBlNjZlOjNlODYwZGRjLTcwZTEtNDVlNS04ZDFkLTE5MjA2ZWY1MjRkNw==',
        "Content-Type":'application/x-www-form-urlencoded',
    },
    data: { "grant_type":"client_credentials"  },
    // dataType: "json",
    success: function(result){
        // console.log(result);
        acctoken = result.access_token;
        utilities_signature();
    }
  });
}

function utilities_signature(){
  $.ajax({
    type: 'POST',
    url: "https://sandbox.bca.co.id/utilities/signature",
    headers: {
        "Timestamp":dates,
        "URI":'/sakuku-commerce/payments',
        "AccessToken":acctoken,
        "APISecret":'ff0d47e9-f645-4d68-92ca-19e996d99e3e',
        "HTTPMethod":'POST',
        "Content-Type":'text/plain',
    },
    data: '{"MerchantID":"89000","MerchantName":"Merchant One","Amount":"'+price+'","Tax":"0.0","TransactionID":"156479","CurrencyCode":"IDR","RequestDate":"'+dates+'","ReferenceID":"123465798"}',
    success: function(signature){
        dict = {};
        res = signature.split("\n");
        res.forEach(function(entry){
          var myarr = entry.split(":");
          var key = myarr[0];
          var value = myarr[1].substring(1, myarr[1].length);
          dict[ key ] = value;
        });
        // signature_timestamp = dict.Timestamp;
        signature_hmac = dict.CalculatedHMAC;
        // console.log(signature);
        sakuku_commerce();
    },
    error: function(error){
      console.log(error);
    }
  });
}

function sakuku_commerce(){
  $.ajax({
    type: 'POST',
    url: "https://sandbox.bca.co.id/sakuku-commerce/payments",
    headers: {
      "X-BCA-Timestamp":dates,
      "X-BCA-Key":'a3ae887a-8c41-41ea-82e0-a2682ea4711b',
      "Authorization":"Bearer "+acctoken,
      "X-BCA-Signature":signature_hmac,
      "Content-Type":'application/json',
    },
    data: '{"MerchantID":"89000","MerchantName":"Merchant One","Amount":"'+price+'","Tax":"0.0","TransactionID":"156479","CurrencyCode":"IDR","RequestDate":"'+dates+'","ReferenceID":"123465798"}',
    // dataType: "json",
    success: function(sakuku){
        sakuku_url = sakuku.LandingPageURL;
    },
    error: function(error){
        alert(error);
    }
  });
}

function sakuku_payment(){
  window.open(sakuku_url);
}
