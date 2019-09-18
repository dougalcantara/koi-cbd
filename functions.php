<?php

// == begin AJAX fn's == //
/**
 * Add product to cart
 * args - product_id
 */
function k_ajax_add_product() {
  $product_id = intval($_POST['product_id']);

  WC()->cart->add_to_cart($product_id, 1);

  wp_send_json(WC()->cart->get_cart());

  die();
}
// add_action('wp_ajax_add_product', 'k_ajax_add_product');
add_action('wp_ajax_nopriv_add_product', 'k_ajax_add_product');

/**
 * Get cart contents
 * no args
 */
function k_ajax_get_cart() {
  wp_send_json(WC()->cart->get_cart());
  
  die();
}
// add_action('wp_ajax_get_cart', 'k_ajax_get_cart');
add_action('wp_ajax_nopriv_get_cart', 'k_ajax_get_cart');

/**
 * Remove a single item from cart
 * args - product_id
 */
function k_ajax_remove_cart_item() {
  $this_item_key = intval($_POST['cart_item_key']);
  $cart_items = WC()->cart->get_cart();

  foreach ($cart_items as $cart_item_key => $cart_item) {
    if ($cart_item_key == $this_item_key) {
      WC()->cart->remove_cart_item($cart_item_key);
    }
  }

  k_ajax_get_cart();

  die();
}
// add_action('wp_ajax_remove_cart_item', 'k_ajax_remove_cart_item');
add_action('wp_ajax_nopriv_remove_cart_item', 'k_ajax_remove_cart_item');

/**
 * Remove all items from cart
 * no args
 */
function k_ajax_remove_all_cart_items() {
  WC()->cart->empty_cart();

  k_ajax_get_cart();

  die();
}
// add_action('wp_ajax_remove_all_cart_items', 'k_ajax_remove_all_cart_items');
add_action('wp_ajax_nopriv_remove_all_cart_items', 'k_ajax_remove_all_cart_items');
// == end AJAX fn's == //



// == begin macros -- reuseable components that can take args and spit out HTML == //
include_once('partials/macros/product-card.php');
include_once('partials/macros/product-video.php');
include_once('partials/macros/article-card.php');
// == end macros == //


// == begin plugin stuff == //
function add_wc_support() {
  add_theme_support('woocommerce');
}
add_action('after_setup_theme', 'add_wc_support');
// == end plugin stuff == //

?>