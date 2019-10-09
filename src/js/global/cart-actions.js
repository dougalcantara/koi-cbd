import AjaxCart from './ajax-cart';
import { $doc, $backdrop, $cartModal } from './selectors';

const $addToCart = $('.k-add-to-cart');
const $addItemToBundle = $('.k-productform--select-bundled-item');
const $addBundleToCart = $('.k-add-to-cart--bundle');
const $cartNum = $('#k-cartnum');
const $removeItemFromCart = $('.k-cart-remove-item');
const $removeAll = $('#k-cart-remove-all');
const $decrementCartItem = $('.k-reduce');
const $incrementCartItem = $('.k-increase');
const $cartItemsTarget = $('#k-ajaxcart-cartitems');
const cartModalOpen = () => $cartModal.hasClass('k-modal--open');

// this is broken, need some way to show that a user has something in their cart
function updateCartStatus(cartItems) {
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
}

async function addSingleItemToCart(e) {
  e.preventDefault();

  const $t = $(this);
  const productId = $t.data('product-id');
  const quantity = parseInt($('#k-num-to-add').val());

  $t.attr('disabled', true);
  $backdrop.addClass('active');
  $cartModal.addClass('k-modal--open');

  const { cart_items: cartItems } = await AjaxCart.addItem(productId, quantity);

  (async function handleCartModal() {
    const {
      expanded_products: expandedProducts,
    } = await AjaxCart.getCartItems();

    console.log(expandedProducts);

    const cartItemsArr = Object.values(cartItems);

    expandedProducts.forEach((product, idx) => {
      $cartItemsTarget.append(/*html*/ `
        <div className="k-ajaxcart--item">
          <div className="k-ajaxcart--item__liner">
            <img src="${product.thumbnail_url}" alt="" style="width: 50px;"/>
            <h3>${product.name}&nbsp;<span>x ${cartItemsArr[idx].quantity}</span></h3>
          </div>
        </div>
      `);
    });

    $cartModal.addClass('k-modal--loaded');
  })();

  $t.attr('disabled', false);

  updateCartStatus(Object.values(cartItems));
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

  const transaction = await AjaxCart.addBundle(
    productId,
    getUserBundleSelections(),
    minItems,
    maxItems
  );

  t.attr('disabled', false);

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
  const itemsInCart = await AjaxCart.getCartItems();

  updateCartStatus(Object.values(itemsInCart.cart_items));
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
