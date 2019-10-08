import AjaxCart from './ajax-cart';
import { $doc, $backdrop } from './selectors';

const url = `${window.SITE_GLOBALS.root}/wp-admin/admin-ajax.php`;

const $addToCart = $('.k-add-to-cart');
const $addItemToBundle = $('.k-productform--select-bundled-item');
const $addBundleToCart = $('.k-add-to-cart--bundle');
const $cartNum = $('#k-cartnum');
const $removeItemFromCart = $('.k-cart-remove-item');
const $removeAll = $('#k-cart-remove-all');
const $decrementCartItem = $('.k-reduce');
const $incrementCartItem = $('.k-increase');
const $cartModal = $('.k-modal--cart');
const cartModalOpen = () => $cartModal.hasClass('k-modal--open');

function updateCartStatus(cartItems) {
  let numInCart = 0;

  cartItems.forEach(item => numInCart += item.quantity);

  if (numInCart) {
    $cartNum.text(numInCart);
    $cartNum.addClass('k-has-value');
  } else {
    $cartNum.text(0);
    $cartNum.removeClass('k-has-value');
  }
}

async function addBundleToCart(e) {
  e.preventDefault();

  const t = $(this);
  const parent = t.closest('form');
  const productId = parent.data('product-id');
  const selectedChildItems = $([...parent.find('.k-productform--select-bundled-item')].filter(item => item.checked));
  const minItems = parseInt(parent.data('min-items'));
  const maxItems = parseInt(parent.data('max-items'));

  t.attr('disabled', true);

  if (selectedChildItems.length > maxItems || selectedChildItems.length < minItems) {
    return alert(`Please select ${minItems} items`);
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

  const transaction = await AjaxCart.addBundle(productId, getUserBundleSelections(), minItems, maxItems);

  t.attr('disabled', false);

  updateCartStatus(transaction);
}

async function addSingleItemToCart(e) {
  e.preventDefault();

  const $t = $(this);
  const productId = $t.data('product-id');
  const quantity = parseInt($('#k-num-to-add').val());

  $t.attr('disabled', true);

  const transaction = await AjaxCart.addItem(productId, quantity);

  $t.attr('disabled', false);

  updateCartStatus(transaction);
}

function addItemToBundle() {
  const t = $(this);
  const maxItems = t.data('max-items');
  const numSelected = [...$addItemToBundle].filter(item => item.checked).length;

  if (numSelected > maxItems) {
    t.prop('checked', false);
    return alert(`Please select ${maxItems} items.`);
  }
}

async function decrementCartItem(e) {
  e.preventDefault();

  const $t = $(this);
  const cartItemQuantity = parseInt($t.next().val());
  const cartItemKey = $t.data('cart-item-key');

  await AjaxCart.decrementCartItem(cartItemKey, cartItemQuantity);

  window.location.reload();
}

function incrementCartItem(e) {
  e.preventDefault();

  const $t = $(this);
  const cart_item_quantity = parseInt($t.prev().val());
  const cart_item_key = $t.data('cart-item-key');

  $.ajax({
    type: 'POST',
    url,
    data: {
      action: 'increment_cart_item',
      cart_item_quantity,
      cart_item_key,
    },
    dataType: 'json',
    complete: () => window.location.reload(),
  });
}

// == event listeners == //
$doc.ready(async function() {
  const itemsInCart = await AjaxCart.getCartItems();

  updateCartStatus(itemsInCart);
});

$decrementCartItem.click(decrementCartItem);
$incrementCartItem.click(incrementCartItem);

$removeItemFromCart.click(async function() {
  const key = $(this).data('cart-item-key');

  await AjaxCart.removeItem(key);

  window.location.reload();
});

$removeAll.click(async function() {
  await AjaxCart.empty();
  window.location.reload();
});

$addBundleToCart.click(addBundleToCart);
$addToCart.click(addSingleItemToCart);
$addItemToBundle.click(addItemToBundle);
