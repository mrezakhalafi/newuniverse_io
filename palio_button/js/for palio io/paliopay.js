// card payment template
var cardModalHtml =
    // '<div class="modal hide fade" id="creditModalCenter" tabindex="-1" role="dialog" aria-labelledby="creditModalCenterTitle" aria-hidden="true">'+
    // '    <div class="modal-dialog modal-dialog-centered" role="document">'+
    // '        <div class="modal-content">'+
    // '            <div class="modal-body" style="text-align: center;">'+
    // '                <span class="fa fa-spinner fa-spin fa-5x"></span><br>'+
    // '                Please don\'t close the browser or refresh the page.'+
    // '            </div>'+
    // '        </div>'+
    // '    </div>'+
    // '</div>'+
    '<div class="overlay" style="display: none;"></div>'+
    '<div id="three-ds-container" style="display: none;">'+
    '   <iframe id="sample-inline-frame" name="sample-inline-frame" width="100%" height="400"> </iframe>'+
    '</div>'+
    '<form id="credit-card-form" name="creditCardForm" method="post">'+
    '  <div class="input-group btn border-70 p-0 mt-4">'+
    '    <input maxlength="16" size="16" type="text" required class="form-control form-control fs-16 fontRobReg" id="credit-card-number" placeholder="Credit Card Number (e.g 4000000000000002)" name="creditCardNumber">'+
    '  </div>'+
    '  <div class="row input-group btn border-70 p-0 mt-4" style="text-align: left">'+
    '    <div class="col-sm-3">'+
    '      <p>Exp Month</p>'+
    '      <div class="input-group btn border-70 p-0 mt-4">'+
    '        <select required class="form-control form-control fs-16 fontRobReg" id="credit-card-exp-month" placeholder="MM" style="border-color: #608CA5" name="creditCardExpMonth">'+
    '          <option>01</option>'+
    '          <option>02</option>'+
    '          <option>03</option>'+
    '          <option>04</option>'+
    '          <option>05</option>'+
    '          <option>06</option>'+
    '          <option>07</option>'+
    '          <option>08</option>'+
    '          <option>09</option>'+
    '          <option>10</option>'+
    '          <option>11</option>'+
    '          <option>12</option>'+
    '        </select>'+
    '      </div>'+
    '    </div>'+
    '    <div class="col-sm-6">'+
    '      <p>Exp Year</p>'+
    '      <div class="input-group btn border-70 p-0 mt-4">'+
    '        <input maxlength="4" size="4" type="text" required class="form-control form-control fs-16 fontRobReg" id="credit-card-exp-year" placeholder="YYYY" style="border-color: #608CA5" name="creditCardExpYear">'+
    '      </div>'+
    '    </div>'+
    '    <div class="col-sm-3">'+
    '      <p>CVV</p>'+
    '      <div class="input-group btn border-70 p-0 mt-4">'+
    '        <input maxlength="3" size="3" type="text" required class="form-control form-control fs-16 fontRobReg" id="credit-card-cvv" placeholder="123" style="border-color: #608CA5" name="creditCardCvv">'+
    '      </div>'+
    '    </div>'+
    '  </div>'+
    '  <input onclick="return toSubmit();" type="submit" id="pay-with-credit-card" class="col-md-12 simple-modal-button-green py-1 px-3 m-0 my-4 fs-16" value="Pay with Credit Card" name="payWithCreditCard">'+
    '</form>';

// ovo payment template
var ovoModalHtml =
    '<form id="ovo-form" name="ovoForm" method="post">'+
    '  <div class="input-group btn border-70 p-0 mt-4">'+
    '    <input maxlength="16" size="16" type="text" required class="form-control form-control fs-16 fontRobReg" id="phone-number" placeholder="Phone Number (e.g +6282111234567)" name="phoneNumber">'+
    '  </div>'+
    '  <input onclick="return toSubmitOVO();" type="submit" id="pay-with-ovo" class="col-md-12 simple-modal-button-green py-1 px-3 m-0 my-4 fs-16" value="Pay with OVO" name="payWithOVO">'+
    '</form>';

// dana payment template
var danaModalHtml =
    '<form id="dana-form" name="danaForm" method="post">'+
    '  <input onclick="return toSubmitDANA();" type="submit" id="pay-with-dana" class="col-md-12 simple-modal-button-green py-1 px-3 m-0 my-4 fs-16" value="Pay with DANA" name="payWithDANA">'+
    '</form>';

// linkaja payment template
var linkajaModalHtml =
    '<form id="linkaja-form" name="linkajaForm" method="post">'+
    '  <input onclick="return toSubmitLINKAJA();" type="submit" id="pay-with-linkaja" class="col-md-12 simple-modal-button-green py-1 px-3 m-0 my-4 fs-16" value="Pay with LINKAJA" name="payWithLINKAJA">'+
    '</form>';

// declare empty cart if localstorage is not set yet
if(localStorage.getItem("cart") != null){
  var cart = JSON.parse(localStorage.getItem("cart"));
} else {
  var cart = [];
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

// postForm('mysite.com/form', {arg1: 'value1', arg2: 'value2'});

// payment with ovo
function toSubmitOVO(){
    event.preventDefault();

    $("#ovo-form :input").prop('readonly', true);

    var js = {
        phone_number: $('#phone-number').val(),
        amount: this.price,
    };

    var callbackURL = this.callbackURL;
    var amount = this.price;
    $.post("https://palio.io/paliobutton/php/paliopay_ovo", 
        js, 
        function (data, status) {
            try {
                if (data == "SUCCEEDED") {
                    // window.onbeforeunload = null;
                    // window.open("/status/palio/status.php", "_self");
                    alert("Transaction success.");
                    cart = [];
                    localStorage.removeItem("cart");
                    postForm(callbackURL, {amount: amount});
                }
                else {
                    alert("Credit card transaction failed");
                }
            }
            catch (err) {
                console.log(err);
                alert("Error occured");
            }
        }
    );

    // alert("Please finish your payment.");
}

// payment with dana
function toSubmitDANA(){
    event.preventDefault();

    $("#dana-form :input").prop('readonly', true);

    var js = {
        callback: this.callbackURL,
        amount: this.price,
    };

    $.post("https://palio.io/paliobutton/php/paliopay_dana", 
        js, 
        function (data, status) {
            try {
                window.location.href = data;
            }
            catch (err) {
                console.log(err);
                alert("Error occured");
            }
        }
    );

    // alert("Please finish your payment.");
}

// payment with linkaja
function toSubmitLINKAJA(){
    event.preventDefault();

    $("#linkaja-form :input").prop('readonly', true);

    var js = {
        callback: this.callbackURL,
        amount: this.price,
    };

    $.post("https://palio.io/paliobutton/php/paliopay_dana", 
        js, 
        function (data, status) {
            try {
                window.location.href = data;
            }
            catch (err) {
                console.log(err);
                alert("Error occured");
            }
        }
    );

    // alert("Please finish your payment.");
}

// xendit cc functions
function toSubmit(){
    event.preventDefault();

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
    alert('Request Credit Card Charge Failed');
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
    $.post("https://palio.io/paliobutton/php/paliopay", 
        js, 
        function (data, status) {
            try {
                if (data.status == "CAPTURED") {
                    // window.onbeforeunload = null;
                    // window.open("/status/palio/status.php", "_self");
                    alert("Transaction success.");
                    cart = [];
                    localStorage.removeItem("cart");
                    postForm(callbackURL, {amount: amount});

                }
                else {
                    alert("Credit card transaction failed");
                }
            }
            catch (err) {
                console.log(err);
                alert("Error occured");
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

    this.callbackURL = callbackURL || window.location.href;
    this.price = price || 0;
    this.name = name || null;
    this.quantity = quantity || 0;

    if (this.name != null && this.quantity != 0){
        // cart modal
        this.myModal = new CartModal(this.callbackURL, this.price, this.name, this.quantity);
    } else {
        // payment modal
        this.myModal = new SimpleModal();
    }
    
    try {
      const modalResponse = await myModal.question();
    } catch(err) {
      console.log(err);
    }
}

"use strict";

// payment modal
class SimpleModal {

  constructor(modalTitle) {
        this.modalTitle = modalTitle || "Choose your payment method!";
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
        window.appendChild(buttonGroup);

        // credit / debit button
        this.cardButton = document.createElement('button');
        this.cardButton.type = "button";
        this.cardButton.setAttribute("id", "credit");
        this.cardButton.classList.add('simple-modal-button-green');
        this.cardButton.classList.add('pay-method');
        this.cardButton.classList.add('simple-modal-button-red');
        this.cardButton.textContent = "Credit / Debit";
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

// add to cart modal
class CartModal {

  constructor(itemSource, itemPrice, itemName, itemQuantity) {
        this.modalTitle = "Add this item to your cart?";
        this.acceptText = "Yes";
        this.cancelText = "No";

        this.itemSource = itemSource;
        this.itemPrice = itemPrice;
        this.itemName = itemName;
        this.itemQuantity = itemQuantity;

        this.parent = document.body;

        this.modal = undefined;
        this.acceptButton = undefined;
        this.cancelButton = undefined;

        this._createModal();
  }

  question() {
        return new Promise((resolve, reject) => {
          if (!this.modal || !this.acceptButton || !this.cancelButton) {
            reject("There was a problem creating the modal window!");
            return;
          }

          this.acceptButton.focus();

          this.acceptButton.addEventListener("click", () => {

            // items
            var item_details = {};
            item_details.itemName  = this.itemName;
            item_details.itemPrice = this.itemPrice;
            item_details.itemQuantity = this.itemQuantity;

            var merchant = cart.find(el => el.merchant_name == this.itemSource);

            // merchant
            if(merchant != undefined){ // check if the merchant already in the json
                var item = merchant.items.find(el => el.itemName == this.itemName);
                
                if(item != undefined){
                    item.itemQuantity += this.itemQuantity;
                } else {
                    merchant.items.push(item_details);
                }

            } else {
                var new_merchant = {};
                new_merchant.merchant_name = this.itemSource;
                new_merchant.items = [];
                new_merchant.items.push(item_details);

                cart.push(new_merchant);    
            }

            localStorage.setItem("cart", JSON.stringify(cart));
            alert("Item successfully added to your cart.");
            this._destroyModal();
          });

          this.cancelButton.addEventListener("click", () => {
            resolve(false);
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

        // Cancel button
        this.cancelButton = document.createElement('button');
        this.cancelButton.type = "button";
        this.cancelButton.classList.add('simple-modal-button-red');
        this.cancelButton.textContent = this.cancelText;
        buttonGroup.appendChild(this.cancelButton);

        // Let's rock
        this.parent.appendChild(this.modal);
        changeColor();
  }

  _destroyModal() {
        this.parent.removeChild(this.modal);
        delete this;
  }
}

// change color of the clicked payment method button
function changeColor(){
    var buttons = document.querySelectorAll(".pay-method");
     
    for (button in buttons) {
        buttons[button].onclick = function() {
            buttons.forEach(function(btn){
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


if(window.top.location.host == "localhost"){
    document.querySelectorAll('.content-image').forEach(item => {
      item.addEventListener('contextmenu', event => {
        //handle right-click and long click
        event.preventDefault();
        // alert("You've tried to open context menu"); //here you draw your own menu
        palioPay(window.top.location.host, 100000, item.alt, 1);
      }, false)
    })
}


if(window.top.location.host == "romlah.com"){
    document.querySelectorAll(".product-small .box").forEach(item => {
        item.addEventListener('contextmenu', event => {
            event.preventDefault();

            let itemSource = window.top.location.host;
            let itemName = item.querySelector(".product-title").innerText;
            let itemPrice = item.getElementsByTagName("bdi")[0].innerText.substring(3).replace(".", "");

            // console.log(itemName + " " + Number(itemPrice));
            palioPay(itemSource, itemPrice, itemName, 1);
        }, false)
    })
}


// checkout multiple items from multiple merchants
function collectiveCheckout(callbackURL){
    // document.getElementById("collective-checkout").addEventListener("click", event => {
    //    event.preventDefault();

        if(cart.length == 0){
          alert("Your cart is empty!");
          return false;
        }

        let totalPrice = 0;
        cart[0].items.forEach(item => {
          totalPrice += item.itemQuantity * item.itemPrice;
        })

        // console.log(totalPrice);
        // do the collective checkout
        palioPay(callbackURL, totalPrice);

    // }); 
}

// clear the shopping cart
function clearCart(){
    cart = [];
    localStorage.removeItem("cart");
    alert("Your cart is now empty!");
}
