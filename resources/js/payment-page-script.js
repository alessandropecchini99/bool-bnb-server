var addCardBtn = document.querySelector('#add-card-button');
let submitPaymentBtn = document.querySelector('#submit-payment-button');
braintree.dropin.create({
    authorization: 'sandbox_g42y39zw_348pk9cgf3bgyw2b',
    selector: '#dropin-container'
}, function (err, instance) {
    addCardBtn.addEventListener('click', function () {
        instance.requestPaymentMethod(function (err, payload) {
            if (err) {
                console.error(err);
                return;
            }
            // Set the payment method nonce in the hidden input field
            document.querySelector('#payment-method-nonce').value = payload.nonce;
        });
    });
    submitPaymentBtn.addEventListener('click', function () {
        // Submit the form to your server for payment processing
        document.querySelector('#payment-form').submit();
    })
});



