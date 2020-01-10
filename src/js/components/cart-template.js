import $ from 'jquery';
import { $doc, $body } from '../global/selectors';
import AjaxCart from '../global/ajax-cart';
import CartItem from '../components/ajax-cart-item';

$doc.ready(async function() {
  const $cartInputs = $('.k-cart--form input[type="number"]');
  const $cartItems = $('.woocommerce-cart-form__cart-item');

  if ($body.hasClass('page-template-cart')) {
    let cart = await AjaxCart.getCartItems();

    window.__cartItems = [];

    $cartItems.each(function(index, element) {
      const pair = pairItemByProductKey($(this), cart);
      const item = new CartItem(
        pair.$domElement,
        pair.$domElement[0],
        pair.matchingCartItem.key
      );
      window.__cartItems.push(item);
    });
  }
});

function pairItemByProductKey($domElement, cart) {
  const cartItems = Object.values(cart.cart_items);
  const productId = $domElement.data('productId');
  let matchingCartItem = cartItems.filter(cart_item => {
    return cart_item.product_id === productId;
  })[0];

  if (!matchingCartItem) {
    // if there isn't a direct productId match, search for the variation id.
    matchingCartItem = cartItems.filter(
      cart_item => cart_item.variation_id === productId
    )[0];
  }

  if (!matchingCartItem) {
    console.warn('Could not pair items with certainty.');
    console.warn(matchingCartItem, $domElement, cartItems);
  }

  return { matchingCartItem, $domElement };
}
