const AjaxCart = {
  url: `${window.SITE_GLOBALS.root}/wp-admin/admin-ajax.php`,
  items: [],
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

AjaxCart.getCartItems = async function() {
  await _makeRequest({
    method: 'GET',
    data: { action: 'k_get_cart' },
    onComplete: cartItems => (AjaxCart.items = Object.values(cartItems)),
  });

  return this.items;
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

AjaxCart.addItem = async function(id, quantity) {
  await _makeRequest({
    method: 'POST',
    data: {
      action: 'add_product',
      product_id: id,
      quantity,
    },
  });

  return this.getCartItems();
};

AjaxCart.addBundle = async function(id, bundledItems, min, max) {
  await _makeRequest({
    method: 'POST',
    data: {
      action: 'add_bundle',
      product_id: id,
      selected_child_items: bundledItems,
      min_items: min,
      max_items: max,
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

export default AjaxCart;
