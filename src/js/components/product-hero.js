import { addEventListeners, removeClass } from '../helpers/dom';

const productHeroCarousel = document.querySelector('.k-producthero--gallery');
const variantToggles = document.querySelectorAll('.k-productform--varianttoggle');
const priceTarget = document.querySelector('.k-productform--pricetarget');

let flkty;

addEventListeners(variantToggles, 'click', ({ target }) => {
  const { productPrice } = target.dataset;

  priceTarget.innerHTML = productPrice;
});

document.addEventListener('DOMContentLoaded', () => {
  if (!productHeroCarousel) return;

  console.log(variantToggles);

  flkty = new Flickity(productHeroCarousel , {
    cellSelector: '.k-producthero--slide',
    pageDots: false,
    contain: true,
    dragThreshold: 10,
  })
});
