import { $doc } from '../global/selectors';

const $productHeroCarousel = $('.k-producthero--gallery');
const $variantToggles = $('.k-productform--variants .k-productform--varianttoggle');
const $priceTarget = $('.k-productform--pricetarget');
const $bundledItemSelects = $('.k-productform--select-bundled-item');
const $addToCartTrigger = $('.k-productform .k-add-to-cart');
const $increment = $('#k-increase');
const $decrement = $('#k-reduce');
const $quantity = $('#k-num-to-add');

let flkty;

$increment.click(function(e) {
  e.preventDefault();

  let oldQ = parseInt($quantity.val());
  const newQ = ++oldQ;

  if (newQ > 10) {
    return alert('Max 10 items.');
  } else {
    $quantity.val(newQ);
  }
});

$decrement.click(function(e) {
  e.preventDefault();

  let oldQ = parseInt($quantity.val());
  const newQ = --oldQ;

  if (newQ < 1) {
    return alert('Min 1 item.');
  } else {
    $quantity.val(newQ);
  }
});

$variantToggles.click(function() {
  const $t = $(this);
  const variantPrice = $t.data('variant-price');
  const variantId = $t.data('variant-id');

  $priceTarget.text(`$${variantPrice}`);
  $addToCartTrigger.attr('data-product-id', variantId);
});

$bundledItemSelects.click(function() {
  const $t = $(this);

  const $targetDrawer = $t.siblings().last();
  const targetHeight = $targetDrawer.children().first().outerHeight();

  const numOfCheckedItems = $('.k-productform--select-bundled-item:checked').length;

  if (numOfCheckedItems > 5) {
    target.checked = false;
    return alert('May only select 5 items.');
  }
  
  if ($t.is(':checked')) {
    $targetDrawer.height(targetHeight);
  } else {
    $targetDrawer.height(0);
  }
});

$doc.ready(function() {
  if (!$productHeroCarousel.length) return;

  flkty = new Flickity($productHeroCarousel[0], {
    cellSelector: '.k-producthero--slide',
    pageDots: false,
    contain: true,
    dragThreshold: 10,
    imagesLoaded: true,
  });

  $variantToggles.each(function() {
    const $t = $(this);

    if ($t.siblings().first().is(':checked')) {
      const variantPrice = $t.data('variant-price');
      const variantId = $t.data('variant-id');
    
      $priceTarget.text(`$${variantPrice}`);
      $addToCartTrigger.attr('data-product-id', variantId);
    }
  });
});
