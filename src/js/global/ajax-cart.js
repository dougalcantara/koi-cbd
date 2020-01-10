import $ from 'jquery';

const AjaxCart = {
  url: `${window.SITE_GLOBALS.root}/wp-admin/admin-ajax.php`,
  cart: [],
};

async function _makeRequest({ method, data, onComplete }) {
  return $.ajax({
    dataType: 'json',
    url: AjaxCart.url,
    method,
    data,
    complete: res => {
      if (onComplete) {
        onComplete(res.responseJSON);
      }
    },
  });
}

AjaxCart.getCartItems = async function(cb) {
  await _makeRequest({
    method: 'GET',
    data: { action: 'k_get_cart' },
    onComplete: cart => {
      AjaxCart.cart = cart;

      if (cb) cb(cart.expanded_products);
    },
  });

  return this.cart;
};

AjaxCart.empty = async function() {
  await _makeRequest({
    method: 'GET',
    data: { action: 'remove_all_cart_items' },
  });

  return this.getCartItems();
};

AjaxCart.removeItem = async function(key) {
  await _makeRequest({
    method: 'POST',
    data: {
      action: 'remove_cart_item',
      cart_item_key: key,
    },
  });

  return this.getCartItems();
};

AjaxCart.addItem = async function(id, quantity, cb) {
  await _makeRequest({
    method: 'POST',
    data: {
      action: 'add_product',
      product_id: id,
      quantity,
    },
    onComplete: cb,
  });

  return this.getCartItems();
};

AjaxCart.addBundle = async function(id, bundledItems, min, max, bundlePrice) {
  await _makeRequest({
    method: 'POST',
    data: {
      action: 'add_bundle',
      product_id: id,
      selected_child_items: bundledItems,
      min_items: min,
      max_items: max,
      bundle_price: bundlePrice,
    },
  });

  return this.getCartItems();
};

AjaxCart.decrementCartItem = async function(key, prevQuantity) {
  try {
    await _makeRequest({
      method: 'POST',
      data: {
        action: 'decrement_cart_item',
        cart_item_quantity: prevQuantity,
        cart_item_key: key,
      },
    });
  } catch (error) {
    return console.log(error);
  }

  return this.getCartItems();
};

AjaxCart.incrementCartItem = async function(key, prevQuantity) {
  try {
    await _makeRequest({
      method: 'POST',
      data: {
        action: 'increment_cart_item',
        cart_item_quantity: prevQuantity,
        cart_item_key: key,
      },
    });
  } catch (error) {
    return console.log(error);
  }

  return this.getCartItems();
};

AjaxCart.updateItemQuantity = async function(key, newQuantity) {
  try {
    await _makeRequest({
      method: 'POST',
      data: {
        action: 'update_item_quantity',
        cart_item_quantity: newQuantity,
        cart_item_key: key,
      },
      onComplete: () => {
        if (!window.location.href.includes('open_cart')) {
          window.location = window.location += `?open_cart=true`;
        } else {
          window.location = window.location;
        }
      },
    });
  } catch (error) {
    console.log(error);
  }
};

AjaxCart.updateAllItemQuantities = async function(keys, newQuantities) {
  try {
    await _makeRequest({
      method: 'POST',
      data: {
        action: 'update_all_item_quantities',
        cart_item_keys: keys,
        cart_item_quantities: newQuantities,
      },
      onComplete: res => {
        if (!window.location.href.includes('open_cart')) {
          window.location += `?open_cart=true`;
        } else {
          window.location = window.location;
        }
      },
    });
  } catch (error) {
    console.log(error);
  }
};

export default AjaxCart;
