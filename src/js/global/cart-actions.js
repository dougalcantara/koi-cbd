import AjaxCart from './ajax-cart';
import { $win, $doc, $body, $backdrop, $cartSidebar } from './selectors';

const $addToCart = $('.k-add-to-cart');
const $addItemToBundle = $('.k-productform--select-bundled-item');
const $addBundleToCart = $('.k-add-to-cart--bundle');
const $cartNum = $('#k-cartnum');
const $removeItemFromCart = $('.k-cart-remove-item');
const $removeAll = $('#k-cart-remove-all');
const $decrementCartItem = $('.k-reduce');
const $incrementCartItem = $('.k-increase');
const $cartItemsTarget = $('#k-ajaxcart-cartitems');
const $cartSidebarToggle = $('#k-carttoggle');
const $cartSidebarClose = $cartSidebar.find('.k-cart-sidebar__close');

function updateCartStatus(cartItems, expandedProducts) {
  let numInCart = 0;

  cartItems.forEach(item => {
    // don't count items in a bundle as individual items in the final count
    if (item.bundled_by) {
      return;
    }

    numInCart += item.quantity;
  });

  if (numInCart) {
    $cartNum.text(numInCart);
    $cartNum.addClass('k-has-value');
  } else {
    $cartNum.text(0);
    $cartNum.removeClass('k-has-value');
  }

  handleCartSidebar(expandedProducts);
}

function handleCartSidebar(cartItems) {
  $cartItemsTarget.empty(); // handles duplicate items being added while still on the same page

  cartItems.forEach(product => {
    const isBundledItem = product.is_bundled_item;

    if (isBundledItem) return;

    const quantity = product.is_bundle ? '1' : product.quantity;
    const totalPrice = (product.price * quantity).toFixed(2);

    $cartItemsTarget.append(/*html*/ `
      <div class="k-cart-sidebar__item">
        <div class="k-cart-sidebar__item__liner">
          <img src="${product.thumbnail_url}" alt="" />
          <h3>
            <a href="${product.permalink}">${product.name}</a>
          </h3>
          <p>Quantity: ${quantity}</p>
          <p class="k-bigtext">$${totalPrice}</p>
        </div>
      </div>
    `);
  });

  $cartSidebar.addClass('k-cart-sidebar--loaded');
}

async function addSingleItemToCart(e) {
  e.preventDefault();

  const $t = $(this);
  const productId = $t.data('product-id');
  const quantity = parseInt($('#k-num-to-add').val());

  $t.attr('disabled', true);
  $backdrop.addClass('active');
  $cartSidebar.addClass('k-cart-sidebar--open');
  $body.css({
    position: 'fixed',
    top: $win.scrollTop(),
  });

  const {
    cart_items: cartItems,
    expanded_products: expandedProducts,
  } = await AjaxCart.addItem(productId, quantity);

  handleCartSidebar(expandedProducts);

  $t.attr('disabled', false);

  updateCartStatus(Object.values(cartItems), expandedProducts);
}

async function addBundleToCart(e) {
  e.preventDefault();

  const t = $(this);
  const parent = t.closest('form');
  const productId = parent.data('product-id');
  const selectedChildItems = $(
    [...parent.find('.k-productform--select-bundled-item')].filter(
      item => item.checked
    )
  );
  const minItems = parseInt(parent.data('min-items'));
  const maxItems = parseInt(parent.data('max-items'));

  t.attr('disabled', true);
  $backdrop.addClass('active');
  $cartSidebar.addClass('k-cart-sidebar--open');
  $body.css({
    position: 'fixed',
    top: $win.scrollTop(),
  });

  if (
    selectedChildItems.length > maxItems ||
    selectedChildItems.length < minItems
  ) {
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

  const {
    cart_items: cartItems,
    expanded_products: expandedProducts,
  } = await AjaxCart.addBundle(
    productId,
    getUserBundleSelections(),
    minItems,
    maxItems
  );

  handleCartSidebar(expandedProducts);

  t.attr('disabled', false);

  updateCartStatus(Object.values(cartItems), expandedProducts);
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

async function incrementCartItem(e) {
  e.preventDefault();

  const $t = $(this);
  const cartItemQuantity = parseInt($t.prev().val());
  const cartItemKey = $t.data('cart-item-key');

  await AjaxCart.incrementCartItem(cartItemKey, cartItemQuantity);

  window.location.reload();
}

// == event listeners == //
$doc.ready(async function() {
  const {
    cart_items: cartItems,
    expanded_products: expandedProducts,
  } = await AjaxCart.getCartItems();

  updateCartStatus(Object.values(cartItems), expandedProducts);
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
$cartSidebarClose.click(function() {
  $backdrop.removeClass('active');
  $cartSidebar.removeClass('k-cart-sidebar--open k-cart-sidebar--loaded');
  $body.removeAttr('style');
});
$cartSidebarToggle.click(function(e) {
  e.preventDefault();

  $backdrop.addClass('active');
  $cartSidebar.addClass('k-cart-sidebar--open k-cart-sidebar--loaded');
  $body.css({
    position: 'fixed',
    top: $win.scrollTop(),
  });
});
