(() => {
  // oh god...
  if(document.querySelector('#wc-authorize-net-cim-credit-card-credit-card-form')) {
    const cardNumber = document.querySelector('#wc-authorize-net-cim-credit-card-account-number'),
          cardDate = document.querySelector('#wc-authorize-net-cim-credit-card-expiry'),
          cardCode = document.querySelector('#wc-authorize-net-cim-credit-card-csc');

    cardNumber.setAttribute('required', 'required');
    cardDate.setAttribute('required', 'required');
    cardCode.setAttribute('required', 'required');
  }
})();