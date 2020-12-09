function showPaymentDetails(){
    $('#payment-container').modal('show');

    var form = document.getElementById('paymentForm');
    Worldpay.useOwnForm({
   'clientKey': 'L_C_7f701bae-08c0-4216-ba50-a485db2dfc2f',
   'form': form,
   'reusable': false,
   'callback': function(status, response) {
      document.getElementById('paymentErrors').innerHTML = '';
      if (response.error) {
         Worldpay.handleError(form, document.getElementById('paymentErrors'), response.error);
      } else {
         var token = response.token;
         Worldpay.formBuilder(form, 'input', 'hidden', 'token', token);
         form.submit();
      }
   }
});

      return false;
}

