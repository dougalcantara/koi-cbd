import $ from 'jquery';
import AjaxCart from './ajax-cart';
import wasEnter from '../helpers/wasEnter';
import {
  $win,
  $doc,
  $body,
  $header,
  $backdrop,
  $cartSidebar,
} from './selectors';
import { closeAllDropdowns } from '../components/site-header';
import { backdropTriggerClose } from '../global/ui';

import CartItem from '../components/ajax-cart-item';

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
const cartSubtotal = document.querySelector('.k-cart-sidebar--subtotal');
const tooMany = /*html*/ `
  <div class="k-productform__error">
    <p class="k-limit-reached">Maximum number of items reached.</p>
  </div>
`;

const bundleSettings = {
  quantities: $('.k-bundle-quantity'),
  maxItems: $addItemToBundle.data('max-items'),
};

/**
 * Need this because bundles have a dynamic price, based on the items
 * that the customer selects as part of the bundle.
 *
 * It gets passed to AjaxCart.addBundle so that it can be read elsehere,
 * like the cart sidebar.
 */
const price = parseFloat(
  $('.k-productform--pricetarget')
    .text()
    .replace('$', '')
);

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

  updateSubtotal();
  handleCartSidebar(cartItems, expandedProducts);
}

function updateSubtotal() {
  let runningTotal = 0;

  AjaxCart.getCartItems().then(res => {
    for (const item in res.cart_items) {
      runningTotal += res.cart_items[item]['line_subtotal'];
    }
    cartSubtotal.textContent = `$${runningTotal.toFixed(2)}`;
  });
}

function handleCartSidebar(cartItems, expandedProducts) {
  $cartItemsTarget.empty(); // handles duplicate items being added while still on the same page

  const reversedExpandedProducts = expandedProducts.reverse();

  reversedExpandedProducts.forEach(product => {
    const belongsToBundle = product.is_bundled_item;
    let bundledPrice = 0;

    if (belongsToBundle) {
      return;
    } else if (product.is_bundle) {
      bundledPrice = getBundlePrice(product, cartItems);

      if (bundledPrice === null) {
        bundledPrice = 'View In Cart';
      } else {
        bundledPrice = `$${bundledPrice}`;
      }
    }

    const quantity = product.is_bundle ? '1' : product.quantity;
    const totalPrice = `$${(product.price * quantity).toFixed(2)}`;

    $cartItemsTarget.append(/*html*/ `
      <div class="k-cart-sidebar__item" data-item-key="${product.key}">
        <div class="k-cart-sidebar__item__liner">
          <img src="${product.thumbnail_url}" alt="${product.name}" />
          <h3>
            <a href="${product.permalink}">${product.name}</a>
          </h3>
          <div class="k-cart-sidebar__item-actions">
            <span class="k-cart-sidebar__quantity k-upcase">QTY:</span>
            <div class="k-productform--quantity">
              <input id="k-num-to-add" type="number" value="${
                product.quantity
              }" min="0" step="1" />
            </div>
            <p class="k-bigtext">
            <span class="k-cart-sidebar__item-price k-cartItem--price-target" tabindex="0" aria-label="price">${
              product.is_bundle ? bundledPrice : totalPrice
            }</span>
            <button class="k-cart-sidebar__item-update k-button k-button--primary">Update</button>
            </p>
          </div>
        </div>
      </div>
    `);
  });

  initializecartItems();
  $cartSidebar.addClass('k-cart-sidebar--loaded');
}

function initializecartItems() {
  const $items = $('.k-cart-sidebar__item');

  window.__cartItems = [];

  $items.each(function(index, element) {
    const item = new CartItem($(this), element, element.dataset.itemKey);
    window.__cartItems.push(item);
  });

  if (window.location.search.includes('open_cart=true')) {
    $backdrop.addClass('active');
    $cartSidebar.addClass('k-cart-sidebar--open');
    $cartSidebar.focus();
  }
}

function getBundlePrice(bundle, cartItems) {
  const correspondingCartItem = cartItems.filter(
    cartItem => bundle.key === cartItem.key
  )[0];
  let bundlePrice = 0;

  if (!Array.isArray(correspondingCartItem.bundled_items)) {
    console.error(Error('Could not identify bundled items.'));
    return null;
  }

  correspondingCartItem.bundled_items.forEach(key => {
    const matchingProduct = cartItems.filter(item => key === item.key)[0];
    bundlePrice += matchingProduct.line_subtotal;
  });

  return bundlePrice.toFixed(2);
}

async function addSingleItemToCart(e) {
  e.preventDefault();
  const $t = $(this);
  const productId = parseInt($t[0].dataset.productId);
  const quantity = parseInt($('#k-num-to-add').val());

  $t.attr('disabled', true);
  $backdrop.addClass('active');
  $cartSidebar.addClass('k-cart-sidebar--open');
  $cartSidebar.focus();
  cartSubtotal.textContent = 'Processing...';

  const {
    cart_items: cartItems,
    expanded_products: expandedProducts,
  } = await AjaxCart.addItem(productId, quantity);

  // handleCartSidebar(expandedProducts);

  $t.attr('disabled', false);

  updateCartStatus(Object.values(cartItems), expandedProducts);
}

function triggerInlineCart($t) {
  $t.attr('disabled', true);
  $backdrop.addClass('active');
  $cartSidebar.addClass('k-cart-sidebar--open');
  $cartSidebar.focus();
  cartSubtotal.textContent = 'Processing...';
}

async function addBundleToCart(e) {
  e.preventDefault();
  const maxItems = bundleSettings.maxItems;
  const t = $(this);

  const parent = t.closest('form');
  const productId = parent.data('product-id');
  const selected = [];

  bundleSettings.quantities.each(function(index, el) {
    const $this = $(this);

    if ($this.val() > 0) {
      selected.push($this);
    }
  });

  triggerInlineCart(t);

  const parsedSelections = [];

  selected.forEach(variant => {
    parsedSelections.push({
      product_id: variant.data('parent-id'),
      bundled_product_key: variant.data('bundle-key'),
      quantity: parseInt(variant.val()),
      variation_id: variant.data('variant-id'),
      attributes: {
        strength: variant.data('variant-strength'),
      },
    });
  });

  const {
    cart_items: cartItems,
    expanded_products: expandedProducts,
  } = await AjaxCart.addBundle(
    productId,
    parsedSelections,
    maxItems,
    maxItems,
    price
  );

  t.attr('disabled', false);
  updateCartStatus(Object.values(cartItems), expandedProducts);
}

function getBundleItemRunningTotal() {
  let count = 0;

  bundleSettings.quantities.each(function(index, el) {
    const $t = $(el);
    count += parseInt($t.val());
  });
  return count;
}

bundleSettings.quantities.change(function() {
  const $t = $(this);
  const $container = $t.closest('.k-productform--bundleselect__item--flex');
  verifyItemCount($container, $t);
});

function verifyItemCount($container, $thisQuantity) {
  const { maxItems } = bundleSettings;
  const runningTotal = getBundleItemRunningTotal();

  if (runningTotal > maxItems) {
    const difference = runningTotal - maxItems;
    $thisQuantity.val($thisQuantity.val() - difference);
  }

  if (!$thisQuantity.val()) {
    $thisQuantity.val(0);
  }

  handleItemError($container);
}

function handleItemError($container) {
  const { maxItems } = bundleSettings;
  const runningTotal = getBundleItemRunningTotal();
  if (runningTotal < maxItems) {
    // if the variant dropdown has an error message
    if ($container[0].getAttribute('data-error')) {
      $container[0].removeAttribute('data-error');
      $container.find('.k-productform__error').remove();
    }
  } else if (runningTotal >= maxItems) {
    event.stopPropagation();
    // add the error message if it isn't already there.
    if (!$container[0].getAttribute('data-error')) {
      $container[0].setAttribute('data-error', 'true');
      $container.find('.k-productform__group').after(tooMany);
    }
  }
}

function handleBundleItem() {
  // assuming the user wants to add the item to the bundle
  const t = $(this);
  const $thisQuantity = t.siblings().find('.k-bundle-quantity');
  const $container = $thisQuantity.closest(
    '.k-productform--bundleselect__item--flex'
  );
  verifyItemCount($container, $thisQuantity);
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

export function closeSidebar() {
  $cartSidebar.removeClass('k-cart-sidebar--open', 'k-cart-sidebar--loaded');
  $body.removeAttr('style');
  $body.removeClass('cart-sidebar-open');

  backdropTriggerClose();
}

// == event listeners == //
$doc.ready(async function() {
  if ($body.hasClass('page-template-cart')) return;
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
$addItemToBundle.click(handleBundleItem);
$cartSidebarClose.click(closeSidebar);
$cartSidebarClose.keypress(function(e) {
  if (wasEnter(e)) {
    closeSidebar();
  }
});
$cartSidebarToggle.click(function(e) {
  toggleCartSidebar(e);
});
$cartSidebarToggle.keypress(function(e) {
  if (wasEnter(e)) {
    toggleCartSidebar(e);
  }
});

function toggleCartSidebar(e) {
  e.preventDefault();

  closeAllDropdowns();

  if ($header.hasClass('is-open')) {
    $header.removeClass('is-open');
  }

  $backdrop.addClass('cart');

  const isOpen = $cartSidebar.hasClass('.k-cart-sidebar--loaded');

  if (isOpen) {
    closeSidebar();
  } else {
    $body.addClass('cart-sidebar-open');
    $cartSidebar.addClass('k-cart-sidebar--open k-cart-sidebar--loaded');
    $cartSidebar.focus();
  }
}
