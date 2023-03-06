const clientId = "AaIDxN07-OfsTeeqPXhMG-BpfLAVhBah94jfutKGersh9uIKkU5kgupWXiWRDxtfsnFF1rnjYTCeNGCi";
const components = "buttons";
let buttons;

function cleanupBeforeReload() {
    if (buttons) {
        buttons.close();
    }
}

function loadAndRender(transactionType) {
    if (transactionType === "order") {
        window
            .paypalLoadScript({
                "client-id": clientId,
                components
            })
            .then(() => {
                render({
                    style: {
                        shape: "pill",
                        color: "gold",
                        layout: "vertical",
                        label: "pay"
                    },
                    createOrder: function (data, actions) {
                        // please wait modal
                        $('#creditModalCenter').modal('show');
                        return actions.order.create({
                            purchase_units: [{
                                "description": "Palio.io monthly subscription fee",
                                "amount": {
                                    "currency_code": "USD",
                                    "value": 33.5
                                }
                            }]
                        });
                    },
                    onApprove: function (data, actions) {
                        return actions.order.capture().then(function (details) {
                            // in case internet down after pay to paypal, set the status locally
                            localStorage.isPaid = '1';

                            // update state user after success payment
                            var js = {
                                company_id: company_id,
                            };
                            $.post("state_update", js,
                                function (data, status) {
                                    // alert("Data: " + data + "\nStatus: " + status);
                                    console.log("Data: " + data + "\nStatus: " + status);
                                });
                            // end update state

                            alert('Transaction completed by ' + details.payer.name.given_name + '!');

                            // redirect to dashboard and store data to db
                            $("#todashboard").click();
                        });
                    }
                });
            });
    } else {
        window
            .paypalLoadScript({
                "client-id": clientId,
                vault: true,
                intent: "subscription",
                components
            })
            .then(() => {
                render({
                    style: {
                        shape: "pill",
                        color: "gold",
                        layout: "vertical",
                        label: "subscribe"
                    },
                    createSubscription: function (data, actions) {
                        // please wait modal
                        $('#creditModalCenter').modal('show');
                        return actions.subscription.create({
                            plan_id: "P-06918665NC7435338MAD2CSI"
                        });
                    },
                    onApprove: function (data, actions) {
                        // in case internet down after pay to paypal, set the status locally
                        localStorage.isPaid = '1';

                        // update state user after success payment
                        var js = {
                            company_id: company_id,
                        };
                        $.post("state_update", js,
                            function (data, status) {
                                // alert("Data: " + data + "\nStatus: " + status);
                                console.log("Data: " + data + "\nStatus: " + status);
                            });
                        // end update state

                        alert(data.subscriptionID);

                        // redirect to dashboard and store data to db
                        $("#todashboard").click();
                    }
                });
            });
    }
}

const debounce = (func, wait) => {
    let timeout;

    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };

        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
};

const debouncedLoadAndRender = debounce(loadAndRender, 500);

function onClickCallback(event) {
    cleanupBeforeReload();
    debouncedLoadAndRender(event.target.value);
}

document.querySelectorAll('input[name="intent"]').forEach((radio) => {
    radio.addEventListener("click", onClickCallback);
});

function render(options) {
    buttons = paypal.Buttons(options);
    buttons.render("#paypal-button-container").catch((err) => {
        console.warn(
            "Warning - Caught an error when attempting to render component",
            err
        );
    });
}

loadAndRender("subscription");

// window.onload = function() {
//     localStorage.setItem('in_checkout', 1);
//     if (localStorage.country_code == 'ID') {

//         if (localStorage.getItem('lang') == 1) {
//             <?php if ($currencyBill == 'IDR') { ?>
//                 $('#newpricing-6').html('Hanya dengan <strong>Rp450<sup>000</sup></strong> biaya langganan per bulan, kamu mendapatkan:');
//             <?php } else if ($currencyBill == 'USD') { ?>
//                 $('#newpricing-6').html('Hanya dengan <strong>$33<sup>50</sup></strong> biaya langganan per bulan, kamu mendapatkan:');
//             <?php } else { ?>
//                 $('#newpricing-6').html('Hanya dengan <strong>Rp450<sup>000</sup></strong> biaya langganan per bulan, kamu mendapatkan:');
//             <?php } ?>
//         } else if (localStorage.getItem('lang') == 0) {
//             <?php if ($currencyBill == 'IDR') { ?>
//                 $('#newpricing-6').html('For just <strong>Rp450<sup>000</sup></strong> monthly subscription, you get:');
//             <?php } else if ($currencyBill == 'USD') { ?>
//                 $('#newpricing-6').html('For just <strong>$33<sup>50</sup></strong> monthly subscription, you get:');
//             <?php } else { ?>
//                 $('#newpricing-6').html('For just <strong>Rp450<sup>000</sup></strong> monthly subscription, you get:');
//             <?php } ?>
//         }
//     } else if (localStorage.country_code != 'ID') {
//         <?php if ($currencyBill == 'IDR') { ?>
//             $('#newpricing-6').html('For just <strong>Rp450<sup>000</sup></strong> monthly subscription, you get:');
//         <?php } else if ($currencyBill == 'USD') { ?>
//             $('#newpricing-6').html('For just <strong>$33<sup>50</sup></strong> monthly subscription, you get:');
//         <?php } else { ?>
//             $('#newpricing-6').html('For just <strong>$33<sup>50</sup></strong> monthly subscription, you get:');
//         <?php } ?>
//     }
// }