// payment template
var modalHtml =
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
	'  <input type="hidden" id="credit-card-amount" name="creditCardAmount" value="100000">'+
	'  <input onclick="return toSubmit();" type="submit" id="pay-with-credit-card" class="col-md-12 simple-modal-button-green py-1 px-3 m-0 my-4 fs-16" value="Pay with Credit Card" name="payWithCreditCard">'+
	'</form>';
// end payment template

// xendit functions
function toSubmit(){
	event.preventDefault();
    
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
    alert('Request Credit Card Charge Failed');
};

function displaySuccess(creditCardCharge) {
    var $form = $('#credit-card-form');
    $('#three-ds-container').hide();
    $('.overlay').hide();
    var js = {
        token_id: creditCardCharge["id"],
        amount: $form.find('#credit-card-amount').val(),
        cvv: $form.find('#credit-card-cvv').val()
    };
    $.post("http://192.168.0.56/paliobutton/php/paliopay", js, async function (data, status) {
            try {
                console.log(data);
                if (data.status == "CAPTURED") {
                    // window.onbeforeunload = null;
                    // window.open("/status/palio/status.php", "_self");
                    // alert("Success");
                    alert(this.callbackURL);
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
// end xendit functions

// payment modal
async function openModal(price, callbackURL) {
    this.price = price;
    this.callbackURL = callbackURL;
	this.myModal = new SimpleModal(price, callbackURL);
	try {
	  const modalResponse = await myModal.question();
	} catch(err) {
	  console.log(err);
	}
}

"use strict";

class SimpleModal {

  constructor(modalTitle, modalText, acceptText, cancelText) {
    this.modalTitle = modalTitle || "Choose your payment method!";
    this.modalText = modalText || "Do you confirm?";
    this.acceptText = acceptText || "Yes!";
    this.cancelText = cancelText || "Noo";

    this.parent = document.body;

    this.modal = undefined;
    this.acceptButton = undefined;
    this.cancelButton = undefined;
    this.closeButton = undefined;
    
    this._createModal();
  }

  question() {
    return new Promise((resolve, reject) => {
      if (!this.modal || !this.acceptButton || !this.cancelButton || !this.closeButton) {
        reject("There was a problem creating the modal window!");
        return;
      }
      this.acceptButton.focus();

      this.acceptButton.addEventListener("click", () => {
        resolve(true);
        this._destroyModal();
      });

      this.cancelButton.addEventListener("click", () => {
        resolve(false);
        this._destroyModal();
      });

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

    // Main text
    const text = document.createElement('span');
    text.classList.add('simple-modal-text');
    text.innerHTML = modalHtml;
    window.appendChild(text);

    // Accept and cancel button group
    const buttonGroup = document.createElement('div');
    buttonGroup.classList.add('simple-modal-button-group');
    window.appendChild(buttonGroup);

    // Accept button
    this.acceptButton = document.createElement('button');
    this.acceptButton.type = "button";
    this.acceptButton.classList.add('simple-modal-button-green');
    this.acceptButton.classList.add('d-none');
    this.acceptButton.textContent = this.acceptText;
    buttonGroup.appendChild(this.acceptButton);

    // Cancel button
    this.cancelButton = document.createElement('button');
    this.cancelButton.type = "button";
    this.cancelButton.classList.add('simple-modal-button-red');
    this.cancelButton.classList.add('d-none');
    this.cancelButton.textContent = this.cancelText;
    buttonGroup.appendChild(this.cancelButton);

    // Let's rock
    this.parent.appendChild(this.modal);
  }

  _destroyModal() {
    this.parent.removeChild(this.modal);
    delete this;
  }
}
// end payment modal

// long click image context menu
(function(){
    document.querySelectorAll('.to-buy').forEach(item => {
      item.addEventListener('contextmenu', event => {
        //handle right-click and long click
        event.preventDefault();
        // alert("You've tried to open context menu"); //here you draw your own menu
        openModal(100000, "https://www.google.com");
      }, false)
    })
})()
// long click image context menu