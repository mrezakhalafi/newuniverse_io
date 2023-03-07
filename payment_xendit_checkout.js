$(function () {
    transactionid = transaction_id.toString();
    var fileEnv = "production";

    if (fileEnv !== 'production') {
        Xendit._useIntegrationURL(true);
    }

    var $form = $('#credit-card-form');

    $form.submit(function (event) {

        // $('#creditModalCenter').modal('show');

        // TEST MODE
        // xnd_public_development_qcfW9OvrvG3U0ph6Dc01xNMhKhhW2On4a0l7ZMUS696BBWR8vNbkSKyRZGlOLQ
        // OLD xnd_public_development_QToOEG2Dx1gvrMjuOjwbWKcOttQTwjhPtjI3JYUMzv7mzAzRTmT9iHQonH12
        Xendit.setPublishableKey('xnd_public_development_qcfW9OvrvG3U0ph6Dc01xNMhKhhW2On4a0l7ZMUS696BBWR8vNbkSKyRZGlOLQ');

        // LIVE MODE
        // Xendit.setPublishableKey('xnd_public_production_qoec6uRBSVSb4n0WwIijVZgDJevwSZ5xKuxaTRh4YBix0nMSsKgxi226yxtTd7');

        // Disable the submit button to prevent repeated clicks:
        // $form.find('.submit').prop('disabled', true);

        // Request a token from Xendit:
        var tokenData = getTokenData();

        Xendit.card.createToken(tokenData, xenditResponseHandler);

        // Prevent the form from being submitted:
        return false;
    });

    function xenditResponseHandler(err, creditCardCharge) {
        // $form.find('.submit').prop('disabled', false);

        $('#creditModalCenter').modal('hide');

        if (err) {
            console.log("ERR", err)
            return displayError(err);
        }

        console.log("XENDIT RESPONSE", creditCardCharge);
        $('html').css('overflow', 'hidden');

        if (creditCardCharge.status === 'APPROVED' || creditCardCharge.status === 'VERIFIED') {
            console.log("APPROVED/VERIFIED")
            displaySuccess(creditCardCharge);
        } else if (creditCardCharge.status === 'IN_REVIEW') {
            window.open(creditCardCharge.payer_authentication_url, 'sample-inline-frame');
            $('.overlay').show();
            $('#three-ds-container').show();
        } else if (creditCardCharge.status === 'FRAUD') {
            displayError(creditCardCharge);
        } else if (creditCardCharge.status === 'FAILED') {
            displayError(creditCardCharge);
        } else if (creditCardCharge.error_code !== undefined && creditCardCharge.error_code != "") {
            displayError(creditCardCharge);
        }
    }

    function displayError(err) {
        console.log("ERR", err);
        $('html').css('overflow', '');
        $('#three-ds-container').hide();
        $('.overlay').hide();
        $('#creditModalCenter').modal('hide');
        if (localStorage.lang == 1) {
            alert('Proses Pengisian Kartu Kredit Gagal');
        }
        else {
            alert('Request Credit Card Charge Failed');
        }
        return false;
    };

    function displaySuccess(creditCardCharge) {
        console.log("SUCCESS", creditCardCharge)
        $('#three-ds-container').hide();
        $('.overlay').hide();
        $('#creditModalCenter').modal('show');
        var js = {
            company_id: company_id,
            transaction_id: transactionid,
            token_id: creditCardCharge["id"],
            amount: $form.find('#credit-card-amount').val(),
            cvv: $form.find('#credit-card-cvv').val()
        };
        console.log("XENDIT PARAM", js);
        $.post((typeof topup !== 'undefined') ? "xendit_creditcard_charge_topup" : "xendit_creditcard_charge_checkout",
            js, async function (data, status) {
                try {
                    console.log("CHARGE", data);
                    if (data.status == "CAPTURED") {
                        $('#creditModalCenter').modal('hide');
                        window.onbeforeunload = null;
                        localStorage.removeItem('in_checkout');
                        window.open("/status/palio/status.php?status=1", "_self");
                    }
                    else {
                        $('#creditModalCenter').modal('hide');
                        alert("Credit card transaction failed");
                    }
                }
                catch (err) {
                    $('#creditModalCenter').modal('hide');
                    console.log(err);
                    alert("Error occured");
                }
            }, 'json'
        );
    }

    function getTokenData() {
        return {
            amount: $form.find('#credit-card-amount').val(),
            card_number: $form.find('#credit-card-number').val(),
            card_exp_month: $form.find('#credit-card-exp-month').val(),
            card_exp_year: $form.find('#credit-card-exp-year').val(),
            card_cvn: $form.find('#credit-card-cvv').val(),
            is_multiple_use: false,
            should_authenticate: true
        };
    }

    function getFraudData() {
        return JSON.parse($form.find('#meta-json').val());
    }
});