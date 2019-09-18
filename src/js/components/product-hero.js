import { $doc } from '../global/selectors';

const $productHeroCarousel = $('.k-producthero--gallery');
const $variantToggles = $('.k-productform--variants .k-productform--varianttoggle');
const $priceTarget = $('.k-productform--pricetarget');
const $bundledItemSelects = $('.k-productform--select-bundled-item');
const $addToCartTrigger = $('.k-productform .k-add-to-cart');

let flkty;

$variantToggles.click(function() {
  const $t = $(this);
  const variantPrice = $t.data('variant-price');
  const variantId = $t.data('variant-id');

  $priceTarget.text(variantPrice);
  $addToCartTrigger.attr('data-purchase-id', variantId);
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
    
      $priceTarget.text(variantPrice);
      $addToCartTrigger.attr('data-purchase-id', variantId);
    }
  });
});
