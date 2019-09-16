import { addEventListeners, removeClass } from '../helpers/dom';

const productHeroCarousel = document.querySelector('.k-producthero--gallery');
const variantToggles = document.querySelectorAll('.k-productform--variants .k-productform--varianttoggle');
const priceTarget = document.querySelector('.k-productform--pricetarget');
const bundledItemSelects = document.querySelectorAll('.k-productform--select-bundled-item');

let flkty;

addEventListeners(variantToggles, 'click', ({ target }) => {
  const { productPrice } = target.dataset;

  priceTarget.innerHTML = productPrice;
});

addEventListeners(bundledItemSelects, 'click', ({ target }) => {
  const targetDrawer = [].filter.call(target.parentNode.children, child => child !== target).pop();
  const targetHeight = `${targetDrawer.firstChild.nextElementSibling.clientHeight}px`;

  const numOfCheckedItems = document.querySelectorAll('.k-productform--select-bundled-item:checked').length;

  if (numOfCheckedItems > 5) {
    target.checked = false;
    return alert('May only select 5 items.');
  }
  
  if (target.checked) {
    targetDrawer.style.height = targetHeight;
  } else {
    targetDrawer.style.height = '0px';
  }
});

document.addEventListener('DOMContentLoaded', () => {
  if (!productHeroCarousel) return;

  flkty = new Flickity(productHeroCarousel , {
    cellSelector: '.k-producthero--slide',
    pageDots: false,
    contain: true,
    dragThreshold: 10,
    imagesLoaded: true,
  })
});
