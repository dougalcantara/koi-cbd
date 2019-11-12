import { $doc } from '../global/selectors';

const $productHeroCarousel = $('.k-producthero--gallery');
const $variantSelects = $(
  '.k-productform--variants .k-productform--variantselect'
);
const $productForm = $('.k-productform');
const $priceTarget = $('.k-productform--pricetarget');
const $bundledItemSelects = $('.k-productform--select-bundled-item');
const $addToCartTrigger = $('.k-productform .k-add-to-cart');
const $increment = $('#k-increase');
const $decrement = $('#k-reduce');
const $quantity = $('#k-num-to-add');
const $prev = $productHeroCarousel.find('.k-producthero__prev');
const $next = $productHeroCarousel.find('.k-producthero__next');

let flkty;

$increment.click(function increment(e) {
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

$variantSelects.click(function() {
  const $t = $(this).find('.k-productform--varianttoggle');
  const variantPrice = $t.data('variant-price');
  const variantId = $t.data('variant-id');

  $priceTarget.text(`$${variantPrice}`);
  $addToCartTrigger.attr('data-product-id', variantId);
});

$bundledItemSelects.click(function() {
  const $t = $(this);

  const $targetDrawer = $t.siblings().last();
  const targetHeight = $targetDrawer
    .children()
    .first()
    .outerHeight();

  const numOfCheckedItems = $('.k-productform--select-bundled-item:checked')
    .length;

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
    prevNextButtons: false,
  });

  $prev.click(() => flkty.previous());
  $next.click(() => flkty.next());

  $variantSelects.each(function() {
    const $t = $(this);

    if (
      $t
        .siblings()
        .first()
        .is(':checked')
    ) {
      const variantPrice = $t.data('variant-price');
      const variantId = $t.data('variant-id');

      $priceTarget.text(`$${variantPrice}`);
      $addToCartTrigger.attr('data-product-id', variantId);
    }
  });
});
