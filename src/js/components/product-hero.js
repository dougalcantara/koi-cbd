import { $doc } from '../global/selectors';
import wasEnter from '../helpers/wasEnter';
import preventScrollOnDrag from '../helpers/FlickityEvents';

const $productHero = $('.k-producthero');
const $productHeroCarousel = $('.k-producthero--gallery');
const $variantSelects = $(
  '.k-productform--variants .k-productform--variantselect'
);
const $productForm = $('.k-productform');
const $priceTarget = $('.k-productform--pricetarget');
const $pricePrefix = $('#k-bundle-price-prefix');
const $bundledItemSelects = $(
  '.k-producthero--bundle .k-productform--select-bundled-item'
);
const $bundleOptionLabels = $(
  '.k-producthero--bundle .k-productform--bundleselect__item > label'
);
const $bundledVariants = $(
  '.k-producthero--bundle .k-productform--varianttoggle'
);
const $addToCartTrigger = $('.k-productform .k-add-to-cart');
const $increment = $('#k-increase');
const $decrement = $('#k-reduce');
const $quantity = $('#k-num-to-add');
const $prev = $productHeroCarousel.find('.k-producthero__prev');
const $next = $productHeroCarousel.find('.k-producthero__next');

const minItems = $productHero.data('min-items');
let flkty;

$doc.ready(() => {
  if ($variantSelects.length > 0) {
    const $firstVariant = $variantSelects.first();
    setVariant($firstVariant);
  }
});

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

$variantSelects.click(function(e) {
  setVariant($(this));
});

$variantSelects.keypress(function(e) {
  if (wasEnter(e)) {
    setVariant($(this), true);
  }
});

function setVariant(context, wasKeypress = false) {
  let $t;

  if (wasKeypress) {
    const $checkbox = context.find('input');
    $checkbox.prop('checked', !$checkbox[0].checked);
  }

  $t = context.find('.k-productform--varianttoggle');
  const variantPrice = $t.data('variant-price');
  const variantId = $t.data('variant-id');
  debugger;
  $priceTarget.text(`$${variantPrice}`);
  $addToCartTrigger.attr('data-product-id', variantId);
}

/**
 * Handle drawer state when selecting an item from a Product Bundle
 */
$bundledItemSelects.click(function() {
  handleBundleOption($(this));
});

$bundleOptionLabels.keypress(function(e) {
  if (wasEnter(e)) {
    const $checkbox = $(this).siblings('input');
    $checkbox.prop('checked', !$checkbox[0].checked);
    handleBundleOption($checkbox);
  }
});

function handleBundleOption(contextElement) {
  const $t = contextElement;

  const $targetDrawer = $t.siblings().last();
  const targetHeight = $targetDrawer
    .children()
    .first()
    .outerHeight();

  if ($t.is(':checked')) {
    const $labels = $targetDrawer.find('label');
    // make open labels tab accessible
    $labels.attr('tabindex', '0');

    $targetDrawer.height(targetHeight);
  } else {
    /**
     * When the user un-selects a bundled item, we need to remove the selected variant
     * of that previously selected bundled item. That way we can correctly calculate the
     * price visually.
     *
     * EG: User initially selects a "Lemon-Lime" tincture as part of this bundle, and
     *     selects a variant for the tincture; "250mg".
     *
     *     The user later removes the "Lemon-Lime" tincture from their selections.
     *
     *     In this case, we need to remove the active class from the variant ("250mg") from
     *     the bundled item ("Lemon-Lime" tincture) so that the final price calc works as
     *     expected.
     *
     *     The final price calc looks at bundled item variants that have the class
     *     ".bundled-variant-selected"
     */

    // Find selected variant for this bundled item
    const _variantSelects = $t
      .siblings()
      .find('.k-productform--varianttoggle.bundled-variant-selected');

    // remove 'checked' attr from sibling <input />
    _variantSelects.prev().prop('checked', false);

    // remove active class from selected variants
    _variantSelects.removeClass('bundled-variant-selected');
    $targetDrawer.height(0);

    // make closed labels non-tabbable
    const $closedLabels = $targetDrawer.find($bundledVariants);
    $closedLabels.attr('tabindex', '-1');
  }
}

$bundledVariants.keypress(function(e) {
  if (wasEnter(e)) {
    const $checkbox = $(this).siblings('input');
    $checkbox.prop('checked', !$checkbox[0].checked);
  }
});

/**
 * This calculates the final price (visually, doesn't affect price for actual payment)
 * to be shown in the Product Hero after a user has selected the minimum number of items
 * in a Product Bundle.
 */
$bundledVariants.click(function() {
  const $t = $(this);
  let $selectedBundledVariants;

  $t.addClass('bundled-variant-selected');

  /**
   * Find other variant selects that may have been previously
   * selected and remove the active class from them.
   */
  $t.parent()
    .siblings()
    .find('.bundled-variant-selected')
    .removeClass('bundled-variant-selected');

  /**
   * Keep track of selected variants
   */
  $selectedBundledVariants = $productForm.find(
    '.k-productform--varianttoggle.bundled-variant-selected'
  );

  /**
   * Once the num of selected variants matches the num of min
   * items for this bundle, sum the price of all selected variants
   * and update the price element with that sum.
   *
   * Also update price prefix to be a little more clear once all items
   * are selected.
   */
  if ($selectedBundledVariants.length === minItems) {
    let priceWithSelectedItems = 0;

    $selectedBundledVariants.each(function() {
      priceWithSelectedItems += $(this).data('variant-price');
    });

    $pricePrefix.text('with selected items:');
    $priceTarget.text(`$${priceWithSelectedItems.toFixed(2)}`);
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

  preventScrollOnDrag(flkty);

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
