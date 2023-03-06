var defaultLang = "id";

var dictionary = {
    notice: {
        title: {
            id: "Peringatan",
            en: "Notice"
        },
        emptyCart: {
            text: {
                id: "Keranjang Anda kosong!",
                en: "Your cart is empty!"
            }
        },
        successAdd: {
            text: {
                id: "Barang berhasil ditambahkan ke keranjang!",
                en: "Item succesfully added to your cart!"
            }
        },
        successClear: {
            text: {
                id: "Keranjang berhasil dikosongkan!",
                en: "Your cart is now empty!"
            }
        }
    },
    addItem: {
        title: {
            id: "Tambahkan item ini ke keranjang Anda?",
            en: "Add this item to your cart?"
        },
        buttons: {
            yes: {
                id: "Ya",
                en: "Yes"
            },
            no: {
                id: "Tidak",
                en: "No"
            }
        }
    },
    cart: {
        title: {
            id: "Keranjang Anda",
            en: "Your cart"
        },
        buttons: {
            checkout: {
                id: "Bayar",
                en: "Checkout"
            },
            clear: {
                id: "Hapus",
                en: "Clear"
            }
        }
    },
    checkout: {
        title: {
            id: "Pilih metode pembayaran Anda",
            en: "Choose your payment method"
        },
        buttons: {
            id: "Bayar",
            en: "Pay"
        },
        notice: {
            emptyForm: {
                id: "Formulir tidak boleh kosong!",
                en: "Form can't be empty!"
            },
            pleaseWait: {
                id: "Mohon tunggu...",
                en: "Please wait..."
            },
            success: {
                id: "Transaksi berhasil",
                en: "Transaction success"
            },
            failed: {
                id: "Transaksi gagal",
                en: "Transaction failed"
            },
            error: {
                id: "Terjadi kesalahan",
                en: "Error occured"
            }
        }
    }
}

function changeLang(lang) {

    defaultLang = lang;

}

// card payment template
var cardModalHtml =
    '<div class="overlay" style="display: none;"></div>' +
    '<div id="three-ds-container" style="display: none;">' +
    '   <iframe id="sample-inline-frame" name="sample-inline-frame" width="100%" height="400"> </iframe>' +
    '</div>' +
    '<form id="credit-card-form" name="creditCardForm" method="post" style="max-height: 300px; overflow-y: auto;">' +
    '  <div class="input-group btn border-70 p-0 mt-4">' +
    '    <input maxlength="16" size="16" type="text" required class="form-control form-control fs-16 fontRobReg" id="credit-card-number" placeholder="Credit Card Number (e.g 4000000000000002)" name="creditCardNumber">' +
    '  </div>' +
    '  <div class="row input-group btn border-70 p-0 mt-4" style="text-align: left">' +
    '    <div class="col-sm-3">' +
    '      <p>Exp Month</p>' +
    '      <div class="input-group btn border-70 p-0 mt-4">' +
    '        <select required class="form-control form-control fs-16 fontRobReg" id="credit-card-exp-month" placeholder="MM" style="border-color: #608CA5" name="creditCardExpMonth">' +
    '          <option>01</option>' +
    '          <option>02</option>' +
    '          <option>03</option>' +
    '          <option>04</option>' +
    '          <option>05</option>' +
    '          <option>06</option>' +
    '          <option>07</option>' +
    '          <option>08</option>' +
    '          <option>09</option>' +
    '          <option>10</option>' +
    '          <option>11</option>' +
    '          <option>12</option>' +
    '        </select>' +
    '      </div>' +
    '    </div>' +
    '    <div class="col-sm-6">' +
    '      <p>Exp Year</p>' +
    '      <div class="input-group btn border-70 p-0 mt-4">' +
    '        <input maxlength="4" size="4" type="text" required class="form-control form-control fs-16 fontRobReg" id="credit-card-exp-year" placeholder="YYYY" style="border-color: #608CA5" name="creditCardExpYear">' +
    '      </div>' +
    '    </div>' +
    '    <div class="col-sm-3">' +
    '      <p>CVV</p>' +
    '      <div class="input-group btn border-70 p-0 mt-4">' +
    '        <input maxlength="3" size="3" type="text" required class="form-control form-control fs-16 fontRobReg" id="credit-card-cvv" placeholder="123" style="border-color: #608CA5" name="creditCardCvv">' +
    '      </div>' +
    '    </div>' +
    '  </div>' +
    '  <input onclick="return toSubmit();" type="submit" id="pay-with-credit-card" class="col-md-12 simple-modal-button-green py-1 px-3 m-0 my-4 fs-16" value="' + dictionary.checkout.buttons[defaultLang] + '" name="payWithCreditCard">' +
    '</form>';

// ovo payment template
var ovoModalHtml =
    '<form id="ovo-form" name="ovoForm" method="post">' +
    '  <div class="input-group btn border-70 p-0 mt-4">' +
    '    <input maxlength="16" size="16" type="text" required class="form-control form-control fs-16 fontRobReg" id="phone-number" placeholder="Phone Number (e.g +6282111234567)" name="phoneNumber">' +
    '  </div>' +
    '  <input onclick="return toSubmitOVO();" type="submit" id="pay-with-ovo" class="col-md-12 simple-modal-button-green py-1 px-3 m-0 my-4 fs-16" value="' + dictionary.checkout.buttons[defaultLang] + '" name="payWithOVO">' +
    '</form>';

// dana payment template
var danaModalHtml =
    '<form id="dana-form" name="danaForm" method="post">' +
    '  <input onclick="return toSubmitDANA();" type="submit" id="pay-with-dana" class="col-md-12 simple-modal-button-green py-1 px-3 m-0 my-4 fs-16" value="' + dictionary.checkout.buttons[defaultLang] + '" name="payWithDANA">' +
    '</form>';

// linkaja payment template
var linkajaModalHtml =
    '<form id="linkaja-form" name="linkajaForm" method="post">' +
    '  <input onclick="return toSubmitLINKAJA();" type="submit" id="pay-with-linkaja" class="col-md-12 simple-modal-button-green py-1 px-3 m-0 my-4 fs-16" value="' + dictionary.checkout.buttons[defaultLang] + '" name="payWithLINKAJA">' +
    '</form>';

// validate form input
function validateForm(formId) {

    var elements = document.getElementById(formId);

    for (var i = 0; i < elements.length; i++) {
        if (elements[i].value == "") {
            return false;
        }
    }

    return true;
}

// redirect with post
function postForm(path, params, method) {
    method = method || 'post';

    var form = document.createElement('form');
    form.setAttribute('method', method);
    form.setAttribute('action', path);

    for (var key in params) {
        if (params.hasOwnProperty(key)) {
            var hiddenField = document.createElement('input');
            hiddenField.setAttribute('type', 'hidden');
            hiddenField.setAttribute('name', key);
            hiddenField.setAttribute('value', params[key]);

            form.appendChild(hiddenField);
        }
    }

    document.body.appendChild(form);
    form.submit();
}

// check ewallet payment status
function checkEwallet(id) {
    // 1. Create a new XMLHttpRequest object
    let xhr = new XMLHttpRequest();

    // 2. Configure it: GET-request for the URL /article/.../load
    xhr.open('GET', 'http://192.168.0.56/palio_browser/logics/ewallet_check.php?id=' + id);

    xhr.responseType = 'json';

    // 3. Send the request over the network
    xhr.send();

    // 4. This will be called after the response is received
    xhr.onload = function () {
        if (xhr.status != 200) { // analyze HTTP status of the response
            // alert(`Error ${xhr.status}: ${xhr.statusText}`); // e.g. 404: Not Found
            showSuccessModal(dictionary.checkout.notice.error[defaultLang], "");

        } else { // show the result
            let responseObj = xhr.response;
            // console.log(responseObj);

            if (responseObj.status == "SUCCEEDED") {
                // alert(`Payment received!`); // response is the server response
                // postForm("http://192.168.0.56/palio_browser/logics/store_payment", { fpin: fpin, method: responseObj.channel_code, status: "success", items: items });
                if (responseObj.channel_code == "ID_DANA") {
                    var method = "DANA";
                } else if (responseObj.channel_code == "ID_LINKAJA") {
                    var method = "LINKAJA";
                }

                showSuccessModal(dictionary.checkout.notice.success[defaultLang], method);

            } else {
                checkEwallet(id);
            }
            // alert(`Done, got ${xhr.response.length} bytes`); // response is the server response
        }
    };

    // xhr.onprogress = function (event) {
    //     if (event.lengthComputable) {
    //         alert(`Received ${event.loaded} of ${event.total} bytes`);
    //     } else {
    //         alert(`Received ${event.loaded} bytes`); // no Content-Length
    //     }

    // };

    xhr.onerror = function () {
        // alert("Request failed");
        showSuccessModal(dictionary.checkout.notice.error[defaultLang], "OVO");
    };
}

// payment with ovo
function toSubmitOVO() {
    event.preventDefault();

    if (validateForm("ovo-form") == false) {
        showSuccessModal(dictionary.checkout.notice.emptyForm[defaultLang]);
        return;
    };

    // add please wait text and disable button
    var form = document.getElementById("payment-choices");
    document.getElementById("pay-with-ovo").disabled = true;
    while (form.firstChild) {
        form.removeChild(form.firstChild);
    }
    form.innerHTML = dictionary.checkout.notice.pleaseWait[defaultLang];

    $("#ovo-form :input").prop('readonly', true);

    var js = {
        phone_number: $('#phone-number').val(),
        amount: this.price,
    };

    // var callbackURL = this.callbackURL;
    // var amount = this.price;

    $.post("https://palio.io/paliobutton/php/paliopay_ovo",
        js,
        function (data, status) {
            try {
                if (data == "SUCCEEDED") {
                    // postForm("http://192.168.0.56/palio_browser/logics/store_payment", { fpin: fpin, method: "ovo", status: "success", items: items });
                    showSuccessModal(dictionary.checkout.notice.success[defaultLang], "OVO");
                }
                else {
                    // alert("Credit card transaction failed");
                    showSuccessModal(dictionary.checkout.notice.failed[defaultLang], "OVO");
                }
            }
            catch (err) {
                // console.log(err);
                // alert("Error occured");
                showSuccessModal(dictionary.checkout.notice.error[defaultLang], "OVO");
            }
        }
    );

    // alert("Please finish your payment.");
}

// payment with dana
function toSubmitDANA() {
    event.preventDefault();

    // add please wait text and disable button
    var form = document.getElementById("payment-choices");
    document.getElementById("pay-with-dana").disabled = true;
    while (form.firstChild) {
        form.removeChild(form.firstChild);
    }
    form.innerHTML = dictionary.checkout.notice.pleaseWait[defaultLang];

    $("#dana-form :input").prop('readonly', true);

    var js = {
        // callback: this.callbackURL,
        callback: "https://palio.io/paliobutton/php/close.php",
        amount: this.price,
    };

    $.post("https://palio.io/paliobutton/php/paliopay_dana",
        js,
        function (data, status) {
            try {
                var response = JSON.parse(data);

                checkEwallet(response.id);

                window.open(response.actions.desktop_web_checkout_url, "_blank");
                // console.log(response.actions.desktop_web_checkout_url);
            }
            catch (err) {
                // console.log(err);
                // alert("Error occured");
                showSuccessModal(dictionary.checkout.notice.error[defaultLang], "DANA");
            }
        }
    );
}

// payment with linkaja
function toSubmitLINKAJA() {
    event.preventDefault();

    // add please wait text and disable button
    var form = document.getElementById("payment-choices");
    document.getElementById("pay-with-linkaja").disabled = true;
    while (form.firstChild) {
        form.removeChild(form.firstChild);
    }
    form.innerHTML = dictionary.checkout.notice.pleaseWait[defaultLang];

    var js = {
        // callback: this.callbackURL,
        callback: "https://palio.io/paliobutton/php/close.php",
        amount: this.price,
    };

    $.post("https://palio.io/paliobutton/php/paliopay_linkaja",
        js,
        function (data, status) {
            try {
                var response = JSON.parse(data);

                checkEwallet(response.id);

                window.open(response.actions.desktop_web_checkout_url, "_blank");
                // console.log(response.actions.desktop_web_checkout_url);
            }
            catch (err) {
                // console.log(err);
                // alert("Error occured");
                showSuccessModal(dictionary.checkout.notice.error[defaultLang], "LINKAJA");
            }
        }
    );
}

// xendit cc functions
function toSubmit() {
    event.preventDefault();

    if (validateForm("credit-card-form") == false) {
        showSuccessModal(dictionary.checkout.notice.emptyForm[defaultLang]);
        return;
    };

    // add please wait text and disable button
    var form = document.getElementById("payment-choices");
    document.getElementById("pay-with-credit-card").disabled = true;
    while (form.firstChild) {
        form.removeChild(form.firstChild);
    }
    form.innerHTML = dictionary.checkout.notice.pleaseWait[defaultLang];

    // disable input
    $("#credit-card-form :input").prop('readonly', true);
    $("#credit-card-exp-month").attr('disabled', true);

    // document.getElementById("credit-card-form").classList.add('d-none');

    Xendit.setPublishableKey('xnd_public_development_QToOEG2Dx1gvrMjuOjwbWKcOttQTwjhPtjI3JYUMzv7mzAzRTmT9iHQonH12');

    var tokenData = getTokenData();

    Xendit.card.createToken(tokenData, xenditResponseHandler);
}

function xenditResponseHandler(err, creditCardCharge) {
    if (err) {
        return displayError(err);
        // console.log(err);
    }

    if (creditCardCharge.status === 'APPROVED' || creditCardCharge.status === 'VERIFIED') {
        console.log("success");
        displaySuccess(creditCardCharge);
    } else if (creditCardCharge.status === 'IN_REVIEW') {
        window.open(creditCardCharge.payer_authentication_url, 'sample-inline-frame');
        $('.overlay').show();
        $('#three-ds-container').show();
    } else if (creditCardCharge.status === 'FRAUD') {
        displayError(creditCardCharge);
    } else if (creditCardCharge.status === 'FAILED') {
        displayError(creditCardCharge);
    }
}

function displayError(err) {
    $('#three-ds-container').hide();
    $('.overlay').hide();
    $("#credit-card-form :input").prop('readonly', false);
    $("#credit-card-exp-month").attr('disabled', false);
    // alert('Request Credit Card Charge Failed');

    showSuccessModal(dictionary.checkout.notice.error[defaultLang], "");
};

function displaySuccess(creditCardCharge) {
    var $form = $('#credit-card-form');
    $('#three-ds-container').hide();
    $('.overlay').hide();

    // loading modal
    // $('#creditModalCenter').modal('show');

    var js = {
        token_id: creditCardCharge["id"],
        amount: this.price,
        cvv: $form.find('#credit-card-cvv').val()
    };
    var callbackURL = this.callbackURL;
    var amount = this.price;
    var items = JSON.stringify(cart);

    if (userAgent) {
        var fpin = window.Android.getFpin();
    } else {
        var fpin = "test";
    }

    $.post("https://palio.io/paliobutton/php/paliopay",
        js,
        function (data, status) {
            try {
                if (data.status == "CAPTURED") {
                    // postForm("http://192.168.0.56/palio_browser/logics/store_payment", { fpin: fpin, method: "card", status: "success", items: items });
                    showSuccessModal(dictionary.checkout.notice.success[defaultLang], "CARD");
                }
                else {
                    // alert("Credit card transaction failed");
                    showSuccessModal(dictionary.checkout.notice.failed[defaultLang], "CARD");
                }
            }
            catch (err) {
                console.log(err);
                // alert("Error occured");
                showSuccessModal(dictionary.checkout.notice.error[defaultLang], "CARD");
            }
        }, 'json'
    );
}

function getTokenData() {
    var $form = $('#credit-card-form');
    return {
        // amount: $form.find('#credit-card-amount').val(),
        amount: this.price,
        card_number: $form.find('#credit-card-number').val(),
        card_exp_month: $form.find('#credit-card-exp-month').val(),
        card_exp_year: $form.find('#credit-card-exp-year').val(),
        card_cvn: $form.find('#credit-card-cvv').val(),
        is_multiple_use: false,
        should_authenticate: true
    };
}

// summmon payment modal
async function palioPay(callbackURL, price, name, quantity) {
    event.preventDefault();

    // this.callbackURL = callbackURL || window.location.href;
    this.callbackURL = callbackURL || "-";
    this.price = price || 0;
    this.name = name || null;
    this.quantity = quantity || 0;

    // payment modal
    $('body').css('overflow', 'hidden');
    this.myModal = new SimpleModal();

    try {
        const modalResponse = await myModal.question();
    } catch (err) {
        console.log(err);
    }
}

"use strict";

// payment modal
class SimpleModal {

    constructor(modalTitle) {
        this.modalTitle = modalTitle || dictionary.checkout.title[defaultLang];
        this.parent = document.body;

        this.modal = undefined;
        this.closeButton = undefined;

        this._createModal();
    }

    question() {
        return new Promise((resolve, reject) => {
            if (!this.modal || !this.closeButton) {
                reject("There was a problem creating the modal window!");
                return;
            }

            this.closeButton.addEventListener("click", () => {
                resolve(null);
                $('body').css('overflow', 'auto');
                this._destroyModal();
            })
        })
    }

    _createModal() {
        // Background dialog
        this.modal = document.createElement('dialog');
        this.modal.classList.add('simple-modal-dialog');
        this.modal.show();

        // Message window
        const window = document.createElement('div');
        window.classList.add('simple-modal-window');
        this.modal.appendChild(window);

        // Title
        const title = document.createElement('div');
        title.classList.add('simple-modal-title');
        window.appendChild(title);

        // Title text
        const titleText = document.createElement('span');
        titleText.classList.add('simple-modal-title-text');
        titleText.textContent = this.modalTitle;
        title.appendChild(titleText);

        // Close
        this.closeButton = document.createElement('button');
        this.closeButton.type = "button";
        this.closeButton.innerHTML = "&times;";
        this.closeButton.classList.add('simple-modal-close');
        title.appendChild(this.closeButton);

        // Accept and cancel button group
        const buttonGroup = document.createElement('div');
        buttonGroup.classList.add('simple-modal-button-group');
        buttonGroup.setAttribute("id", "payment-choices");
        window.appendChild(buttonGroup);

        // credit / debit button
        this.cardButton = document.createElement('button');
        this.cardButton.type = "button";
        this.cardButton.setAttribute("id", "credit");
        this.cardButton.classList.add('simple-modal-button-green');
        this.cardButton.classList.add('pay-method');
        this.cardButton.classList.add('simple-modal-button-red');
        this.cardButton.textContent = "CARD";
        buttonGroup.appendChild(this.cardButton);

        // ovo button
        this.ovoButton = document.createElement('button');
        this.ovoButton.type = "button";
        this.ovoButton.setAttribute("id", "ovo");
        this.ovoButton.classList.add('simple-modal-button-green');
        this.ovoButton.classList.add('pay-method');
        this.ovoButton.textContent = "OVO";
        buttonGroup.appendChild(this.ovoButton);

        // dana button
        this.danaButton = document.createElement('button');
        this.danaButton.type = "button";
        this.danaButton.setAttribute("id", "dana");
        this.danaButton.classList.add('simple-modal-button-green');
        this.danaButton.classList.add('pay-method');
        this.danaButton.textContent = "DANA";
        buttonGroup.appendChild(this.danaButton);

        // linkaja button
        this.linkajaButton = document.createElement('button');
        this.linkajaButton.type = "button";
        this.linkajaButton.setAttribute("id", "linkaja");
        this.linkajaButton.classList.add('simple-modal-button-green');
        this.linkajaButton.classList.add('pay-method');
        this.linkajaButton.textContent = "LINKAJA";
        buttonGroup.appendChild(this.linkajaButton);

        // horizontal line
        this.hr = document.createElement('hr');
        buttonGroup.appendChild(this.hr);

        // Main text
        const text = document.createElement('span');
        text.setAttribute("id", "payment-form");
        text.classList.add('simple-modal-text');
        text.innerHTML = cardModalHtml;
        window.appendChild(text);

        // Let's rock
        this.parent.appendChild(this.modal);
        changeColor();
    }

    _destroyModal() {
        this.parent.removeChild(this.modal);
        delete this;
    }
}

async function showSuccessModal(status, method) {
    event.preventDefault();

    $('body').css('overflow', 'hidden');
    this.myModal = new SuccessModal(status, method);

    try {
        const modalResponse = await myModal.question();
    } catch (err) {
        console.log(err);
    }
}

// add to cart modal
class SuccessModal {

    constructor(status, method) {
        this.modalTitle = dictionary.notice.title[defaultLang];
        this.acceptText = "Ok";

        this.parent = document.body;
        this.status = status;
        this.method = method;

        this.modal = undefined;
        this.acceptButton = undefined;

        this._createModal();
    }

    question() {
        return new Promise((resolve, reject) => {
            if (!this.modal || !this.acceptButton) {
                reject("There was a problem creating the modal window!");
                return;
            }

            this.acceptButton.focus();

            this.acceptButton.addEventListener("click", () => {
                var items = JSON.stringify(cart);
                var base64items = btoa(items);

                // if (userAgent) {
                //     var fpin = window.Android.getFpin();
                // } else {
                var fpin = "test";
                // }

                if (this.status == dictionary.checkout.notice.success[defaultLang]) {
                    clearCart();
                    postForm("https://palio.io/paliobutton/php/store_payment", { fpin: fpin, method: this.method, status: "SUCCESS", items: base64items });
                }

                $('body').css('overflow', 'auto');
                this._destroyModal();
            });

        })
    }

    _createModal() {
        // Background dialog
        this.modal = document.createElement('dialog');
        this.modal.classList.add('simple-modal-dialog');
        this.modal.show();

        // Message window
        const window = document.createElement('div');
        window.classList.add('simple-modal-window');
        this.modal.appendChild(window);

        // Title
        const title = document.createElement('div');
        title.classList.add('simple-modal-title');
        window.appendChild(title);

        // Title text
        const titleText = document.createElement('span');
        titleText.classList.add('simple-modal-title-text');
        titleText.style.margin = "0px";
        titleText.textContent = this.modalTitle;
        title.appendChild(titleText);

        // Main text
        const text = document.createElement('span');
        text.setAttribute("id", "payment-form");
        text.classList.add('simple-modal-text');
        text.innerHTML = this.status;
        window.appendChild(text);

        // Accept and cancel button group
        const buttonGroup = document.createElement('div');
        buttonGroup.classList.add('simple-modal-button-group');
        window.appendChild(buttonGroup);

        // Accept button
        this.acceptButton = document.createElement('button');
        this.acceptButton.type = "button";
        this.acceptButton.classList.add('simple-modal-button-green');
        this.acceptButton.textContent = this.acceptText;
        buttonGroup.appendChild(this.acceptButton);

        // Let's rock
        this.parent.appendChild(this.modal);
    }

    _destroyModal() {
        this.parent.removeChild(this.modal);
        delete this;
    }
}

// change color of the clicked payment method button
function changeColor() {
    var buttons = document.querySelectorAll(".pay-method");

    for (button in buttons) {
        buttons[button].onclick = function () {
            buttons.forEach(function (btn) {
                btn.classList.remove('simple-modal-button-red');
            })
            this.classList.add('simple-modal-button-red');

            var form = document.getElementById("payment-form");
            if (this.id == "credit") {
                form.removeChild(form.firstChild);
                form.innerHTML = cardModalHtml;
            } else if (this.id == "ovo") {
                form.removeChild(form.firstChild);
                form.innerHTML = ovoModalHtml;
            } else if (this.id == "dana") {
                form.removeChild(form.firstChild);
                form.innerHTML = danaModalHtml;
            } else if (this.id == "linkaja") {
                form.removeChild(form.firstChild);
                form.innerHTML = linkajaModalHtml;
            }
        }
    }
}
