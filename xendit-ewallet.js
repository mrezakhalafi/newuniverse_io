date = new Date();
external_id = date.getTime().toString() + "-" + date.getDate().toString() + date.getMonth().toString() + date.getFullYear().toString();
amount = bca_payment;
phone = $('#phone-number').val();
transactionid = transaction_id.toString();

// LIVE API
auth = "Basic eG5kX3Byb2R1Y3Rpb25fRHNJTkpRVDRjbXRkaEtJeExKVGdxVzV1eWR4VWc4OGN1YTNpdDhhT0FTUW9SRUZoQjlEanBoa2pMbTZlWk1QOg==";

// TEST MODE API
// auth = "Basic eG5kX2RldmVsb3BtZW50X3RZSHJQRUt3dU5KUHJ0b1JXWTZqR05QbUxHUEF4MUxXUjU2ZXZsdDZLMkFTUnhTaE5zS25Wa1B0ZzFrODo=";

// UNUSED
function ovo() {
  event.preventDefault();
  var settings = {
    // "url": "https://cors-anywhere.herokuapp.com/https://api.xendit.co/ewallets",
    "url": "https://api.xendit.co/ewallets",
    "method": "POST",
    "timeout": 0,
    "headers": {
      "Authorization": auth,
      "Content-Type": "application/x-www-form-urlencoded",
    },
    "data": {
      "external_id": external_id,
      "amount": amount,
      "phone": $('#phone-number').val(),
      "ewallet_type": "OVO",
    }
  };

  $.ajax(settings).done(function (response) {
    //display loading
    $('#exampleModalCenter').modal('show');

    //redirect to status page
    if (response.error_code) {
      // window.open('status/palio/status.php', "_self");
      alert('Error, please try again later!');
    } else {
      response_external_id = response.external_id;
      console.log(response);
      console.log(response.status);
      cekStatusOvo(response_external_id);
    }
  });
}

function cekStatusOvo(res) {
  var settings = {
    // "url": "https://cors-anywhere.herokuapp.com/https://api.xendit.co/ewallets?external_id=" + res + "&ewallet_type=OVO",
    "url": "https://api.xendit.co/ewallets?external_id=" + res + "&ewallet_type=OVO",
    "method": "GET",
    "timeout": 0,
    "headers": {
      "Authorization": auth,
      "Content-Type": "application/x-www-form-urlencoded",
    },
  };

  $.ajax(settings).done(function (response) {
    console.log(response);
    console.log(response.status);

    //redirect to status page
    if (response.status === 'COMPLETED') {
      displaySuccess();
      // alert("sukses");
    } else if (response.status === 'PENDING') {
      cekStatusOvo(res);
    } else {
      displayError();
    }
  });
}

function displayError() {
    window.open('status/palio/status.php', "_self");
};

function displaySuccess(res) {
    var js = {
        company_id: company_id,
        transaction_id: transactionid,
    };
    $.post("ovo_ewallet_charge.php",
        js,
        async function(data, status){
          window.open('status/palio/status.php', "_self");
        }
    );

}

// initiate ovo payment AND update user status in db if succeded
$("#ovo-form").submit(async function(e) {
    e.preventDefault();

    //display loading
    $('#exampleModalCenter').modal('show');

    // wait to check user status
    // 1 = already paid
    // 0 = not yet
    var status = await checkUserStatus();

    if(status == 0){

      var phoneNumber = $('#phone-number').val();
      var url = "xendit_ovo_charge.php";
      var secretKey = auth;

      var formData = {
        amount : amount,
        phone : phoneNumber,
        secretKey : secretKey,

        transaction_id : transactionid,
        company_id : company_id,
      };

      $.ajax({
        type : 'POST',
        url : url,
        data : formData,
        encode : true,
        success: function (response, status, xhr) {

          // console.log(response);
          $('#exampleModalCenter').modal('hide');
          window.location.replace("status/palio/status.php", "_self");

          // var res = JSON.parse(response);
          // checkOvo(res['external_id']);

        },
        error: function (xhr, status, error) {

          $('#exampleModalCenter').modal('hide');
          alert("Payment failed, please try again.");
          // console.log(error);
        }
      });

    } else if(status == 1){

      alert("Payment Accepted.");
      $('#exampleModalCenter').modal('hide');
      // window.location.replace("login.php", "_self");

    } else {

      $('#exampleModalCenter').modal('hide');
      alert("Check status error, please try again.");

    }

});

// ajax call to check user status
// 1 = paid, 0 = not paid
function checkUserStatus(){

    var url = "user_status_checker.php";
    var formData = {
      company_id : company_id,
    };

    // promise make js to wait for this function before continue
    return new Promise(function(resolve, reject) {
      $.ajax({
        type : 'POST',
        url : url,
        data : formData,
        encode : true,
        success: function (response, status, xhr) {

          resolve(response);

        },
        error: function (xhr, status, error) {
          
          resolve(error);

        }
      });
    });

}

// check ovo status and update user data in database (UNUSED)
function checkOvo(res) {
   
    var external_id = res;
    var url = "xendit_ovo_charge_check.php";
    var secretKey = auth;

    var formData = {
      external_id : external_id,
      secretKey : secretKey,
      company_id : company_id,
      transaction_id : transactionid,
    };

    $.ajax({
      type : 'POST',
      url : url,
      data : formData,
      encode : true,
      success: function (response, status, xhr) {

        $('#exampleModalCenter').modal('hide');
        // checkOvo(response);
        // console.log(response);
        // alert("payment success");

        // window.open('status/palio/status.php', "_self");
        window.location.replace("status/palio/status.php", "_self");

      },
      error: function (xhr, status, error) {
        checkOvo(external_id);
      }
    });

}