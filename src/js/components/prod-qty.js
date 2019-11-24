(() => {
  if(document.querySelector('.k-productform')) {
    const qty = document.querySelector('#k-num-to-add'),
          btns = document.querySelectorAll('.k-productform--quantity button'),
          price = document.querySelector('.k-productform--pricetarget');

    function calc() {
      return parseFloat(qty.value * price.getAttribute('data-price')).toFixed(2);
    }

    btns.forEach(btn => btn.addEventListener('click', () => {
      price.innerHTML = `$${calc()}`;
    }));

  }
})();