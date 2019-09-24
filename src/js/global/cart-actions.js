import { $doc } from './selectors';

const url = `${window.SITE_GLOBALS.root}/wp-admin/admin-ajax.php`;

const $addToCartButtons = $('.k-add-to-cart');
const $addItemToBundleButtons = $('.k-productform--select-bundled-item');
const $addBundleToCartButton = $('.k-add-to-cart--bundle');
const $cartNum = $('#k-cartnum');
const $removeFromCartTrigger = $('.k-cart-remove-item');
const $removeAllTrigger = $('#k-cart-remove-all');

function onDocReady() {
  const request = {
    method: 'GET',
    url,
    data: {
      action: 'k_get_cart',
    },
    dataType: 'json',
    success: cart => updateCartStatus(Object.values(cart)),
    error: err => console.log(err),
  };

  $.ajax(request);
}

function numItemsInCart(items) {
  let numInCart = 0;

  items.forEach(item => {
    numInCart += item.quantity;
  });

  return numInCart;
}

async function removeItemFromCart(key) {
  const request = {
    method: 'POST',
    url,
    data: {
      action: 'remove_cart_item',
      cart_item_key: key,
    },
    dataType: 'json',
    success: cart => updateCartStatus(Object.values(cart)),
    error: err => console.log(err),
    complete: res => console.log(res),
  };

  return $.ajax(request);
}

async function emptyCart() {
  const request = {
    method: 'GET',
    url,
    data: {
      action: 'remove_all_cart_items',
    },
    dataType: 'json',
    success: cart => updateCartStatus(Object.values(cart)),
    error: err => console.log(err),
  };

  return $.ajax(request);
}

function updateCartStatus(cartItems) {
  console.log('cart updated:', cartItems);

  const n = numItemsInCart(cartItems);
  
  if (n) {
    $cartNum.text(n);
    $cartNum.addClass('k-has-value');
  } else {
    $cartNum.text(0);
    $cartNum.removeClass('k-has-value');
  }
}

function addBundleToCart(e) {
  e.preventDefault();

  const t = $(this);
  const parent = t.closest('form');
  const productId = parent.data('product-id');
  const selectedChildItems = $([...parent.find('.k-productform--select-bundled-item')].filter(item => item.checked));
  const minItems = parent.data('min-items');
  const maxItems = parent.data('max-items');

  if (selectedChildItems.length > 4 || selectedChildItems.length < 4) {
    return alert('Please select 4 items');
  }

  const getUserBundleSelections = function() {
    const selections = [];

    selectedChildItems.each(function() {
      const t = $(this);
      const parentId = t.data('parent-id');
      const bundledProductKey = t.data('bundled-product-key');
      const variations = t.siblings().find('input[type="radio"]');
      const selectedVariation = $([...variations].filter(item => item.checked));
      
      selections.push({
        product_id: parentId,
        bundled_product_key: bundledProductKey,
        quantity: 1,
        variation_id: selectedVariation.data('variant-id'),
        attributes: {
          strength: selectedVariation.data('variant-strength'),
        },
      });
    });

    return selections;
  };

  t.attr('disabled', true);

  $.ajax({
    type: 'POST',
    url,
    data: {
      action: 'add_bundle',
      product_id: productId,
      selected_child_items: getUserBundleSelections(),
      max_items: maxItems,
      min_items: minItems,
    },
    dataType: 'json',
    success: cart => updateCartStatus(Object.values(cart)),
    error: err => console.log(err),
    complete: () => t.attr('disabled', false),
  });
}

// == event listeners == //
$doc.ready(onDocReady);

$addToCartButtons.click(function(e) {
  e.preventDefault();

  const $t = $(this);
  const productId = $t.data('product-id');

  const data = {
    action: 'add_product',
    product_id: productId,
  };

  $t.attr('disabled', true);

  $.ajax({
    type: 'POST',
    url,
    data,
    dataType: 'json',
    success: cart => updateCartStatus(Object.values(cart)),
    error: function(err) {
      console.log('error', err);
    },
    complete: () => {
      $t.attr('disabled', false);
    },
  });
});

$removeFromCartTrigger.click(async function() {
  await removeItemFromCart($(this).data('cart-item-key'));
  window.location.reload();
});

$removeAllTrigger.click(async function() {
  await emptyCart();
  window.location.reload();
});

$addBundleToCartButton.click(addBundleToCart);

$addItemToBundleButtons.click(function() {
  const t = $(this);
  const maxItems = t.data('max-items');
  const numSelected = [...$addItemToBundleButtons].filter(item => item.checked).length;

  if (numSelected > maxItems) {
    t.prop('checked', false);
    return alert(`Please select ${maxItems} items.`);
  }
});
