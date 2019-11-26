import AjaxCart from './ajax-cart';
import wasEnter from '../helpers/wasEnter';
import AjaxCartItem from '../components/ajax-cart-item';
import {
  $win,
  $doc,
  $body,
  $header,
  $backdrop,
  $cartSidebar,
} from './selectors';
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
          <img src="${product.thumbnail_url}" alt="" />
          <h3>
            <a href="${product.permalink}">${product.name}</a>
          </h3>
          <div class="k-cart-sidebar__item-actions">
            <span class="k-cart-sidebar__quantity k-upcase">QTY:</span>
            <div class="k-productform--quantity">
              <!-- <button class="k-reduce" class="" type="button">-</button> -->
              <input id="k-num-to-add" type="number" value="${
                product.quantity
              }" min="0" step="1" />
              <!-- <button class="k-increase" class="" type="button">+</button> -->
            </div>
            <p class="k-bigtext">
            <span class="k-cart-sidebar__item-price">${
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

async function addBundleToCart(e) {
  e.preventDefault();

  const t = $(this);
  const parent = t.closest('form');
  const productId = parent.data('product-id');
  const selectedChildItems = () => {
    let selected = [];

    $addItemToBundle.each((_, el) =>
      el.checked ? selected.push($(el)) : null
    );

    return selected;
  };
  const minItems = parseInt(parent.data('min-items'));
  const maxItems = parseInt(parent.data('max-items'));

  if (
    selectedChildItems().length > maxItems ||
    selectedChildItems().length < minItems
  ) {
    return alert(`Please select ${minItems} items`);
  }

  t.attr('disabled', true);
  $backdrop.addClass('active');
  $cartSidebar.addClass('k-cart-sidebar--open');
  $cartSidebar.focus();
  cartSubtotal.textContent = 'Processing...';

  const getUserBundleSelections = function() {
    const selections = [];

    selectedChildItems().forEach(function(el) {
      const t = $(el);
      const parentId = t.data('parent-id');
      const bundledProductKey = t.data('bundled-product-key');
      const variations = t.siblings().find('input[type="radio"]');
      const selectedVariation = () => {
        let selected;
        variations.each((_, el) => (el.checked ? (selected = el) : null));
        return $(selected);
      };

      selections.push({
        product_id: parentId,
        bundled_product_key: bundledProductKey,
        quantity: 1,
        variation_id: selectedVariation().data('variant-id'),
        attributes: {
          strength: selectedVariation().data('variant-strength'),
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
    maxItems,
    price
  );

  // handleCartSidebar(expandedProducts);

  t.attr('disabled', false);

  updateCartStatus(Object.values(cartItems), expandedProducts);
}

function addItemToBundle() {
  let count = 0;

  const t = $(this);
  const maxItems = t.data('max-items');
  const numSelected = () => {
    $addItemToBundle.each((_, el) => (el.checked ? count++ : null));
    return count;
  };

  if (numSelected() > maxItems) {
    count--; // because at this point it's been incremented 1 beyond the max
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

export function closeSidebar() {
  $backdrop.removeClass('active');
  $cartSidebar.removeClass('k-cart-sidebar--open k-cart-sidebar--loaded');
  $body.removeAttr('style');
  $body.removeClass('cart-sidebar-open');
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
$cartSidebarClose.click(closeSidebar);
$cartSidebarClose.keypress(function(e) {
  if (wasEnter(e)) {
    closeSidebar();
  }
});
$cartSidebarToggle.click(function(e) {
  e.preventDefault();

  if ($header.hasClass('is-open')) {
    $header.removeClass('is-open');
  }

  $backdrop.addClass('active');

  const isOpen = $cartSidebar.hasClass('.k-cart-sidebar--loaded');

  if (isOpen) {
    closeSidebar();
  } else {
    $body.addClass('cart-sidebar-open');
    $cartSidebar.addClass('k-cart-sidebar--open k-cart-sidebar--loaded');
    $cartSidebar.focus();
  }
});
