var service_length;
var curr_value_storage;
var curr_value_bandwidth;
var value_bandwidth = bandwidth_value;
var value_storage = storage_value;
var multiplier_storage = storage_price;
var multiplier_bandwidth = bandwidth_price;
var multiplier_monthly = multiplier_monthly_value;
var multiplier_annual = multiplier_annual_value;
var index_storage;
var index_bandwidth;
var value_text_storage;
var value_text_bandwidth;
var old_value_storage;
var old_value_bandwidth;

function slider(){

  //start pricing rangeslider
  $('#js-range-slider').ionRangeSlider({
    skin: "round",
    type: "single",
    prefix: "Storage: ",
    postfix: "GB",
    grid: true,
    hide_min_max: true,
    values: value_storage,
    onFinish: function() {
      calculatePrice();
      $('#storage_value').val($('#js-range-slider').val());
    },
  });

  $('#js-range-slider2').ionRangeSlider({
    skin: "round",
    type: "single",
    prefix: "Bandwidth: ",
    postfix: "MB",
    grid: true,
    hide_min_max: true,
    values: value_bandwidth,
    onFinish: function() {
      calculatePrice();
      $('#bandwidth_value').val($('#js-range-slider2').val());
    },
  });

}

  function checkFunction(elem){
    if (elem.checked)
    {
      service_length = document.querySelectorAll('input[type="checkbox"]:checked').length;
      // console.log(service_length);
      if(service_length == 0) {
        alert("You must check at least one checkbox.");
        $("#livestreaming").prop("checked", true);
        return false;
      }
      calculatePrice();
    }
    else
    {
      $("#select-all").prop("checked", false);
      service_length = document.querySelectorAll('input[type="checkbox"]:checked').length;
      // console.log(service_length);
      if(service_length == 0) {
        alert("You must check at least one checkbox.");
        $("#livestreaming").prop("checked", true);
        return false;
      }
      calculatePrice();
    }
  }

  $('#select-all').click(function(event) {
    if(this.checked) {
        // Iterate each checkbox
        $(':checkbox').each(function() {
            this.checked = true;
        });
        $("#chatbot").prop("checked", false);
        service_length = 6;
        calculatePrice();
    } else {
        $(':checkbox').each(function() {
            this.checked = false;
        });
        $("#livestreaming").prop("checked", true);
        service_length = document.querySelectorAll('input[type="checkbox"]:checked').length;
        calculatePrice();
    }
  });

  function calculatePrice() {
    curr_value_storage = $('#js-range-slider').val();
    curr_value_bandwidth = $('#js-range-slider2').val();

    index_storage = value_storage.indexOf(parseInt(curr_value_storage));
    index_bandwidth = value_bandwidth.indexOf(parseInt(curr_value_bandwidth));

    //price 1 service
    price_monthly = multiplier_storage[index_storage] + multiplier_bandwidth[index_bandwidth] + multiplier_monthly[0];
    price_annual = multiplier_storage[index_storage] + multiplier_bandwidth[index_bandwidth] + multiplier_annual[0];

    if (service_length > 1){ //jika user pilih lebih dari 1 service

      var i = 1;
      while (i < service_length) {
        price_monthly += multiplier_monthly[i];
        price_annual += multiplier_annual[i];
        i++;
      }

    }

    $('#sub-value-monthly').html('<b>' + curr_value_storage + 'GB</b> storage quota and <b>'+ curr_value_bandwidth +'MB</b> bandwidth for <b>$' + price_monthly + ' / ' + Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(price_monthly*14187.5) + '<span style="color: red;">*</span></b> per month</span>');
    document.getElementById('monthly').value = price_monthly;
    $('#sub-value-annual').html('<b>' + curr_value_storage + 'GB</b> storage quota and <b>'+ curr_value_bandwidth +'MB</b> bandwidth for <b>$' + price_annual + ' / ' + Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(price_annual*14187.5) + '<span style="color: red;">*</span></b> per year</span>');
    document.getElementById('annual').value = price_annual;
  }

  function selectedRadio(){
    var type = $('input[type=radio][name=subscription_period]:checked').attr('id');
    $('#type').val(type);
  }
