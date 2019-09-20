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
add_action('wp_ajax_add_product', 'k_ajax_add_product');
add_action('wp_ajax_nopriv_add_product', 'k_ajax_add_product');

/**
 * Add product to cart
 * args - product_id
 */
function k_ajax_add_bundle_to_cart() {
  $bundle_id = intval($_POST['bundle_id']);

  WC_PB()->cart->add_bundle_to_cart($bundle_id, 1, array(
    81 => array(
      'product_id' => 205366,
      'quantity' => 1,
    ),
  ));

  k_ajax_get_cart();
  
  die();
}
add_action('wp_ajax_add_bundle', 'k_ajax_add_bundle_to_cart');
add_action('wp_ajax_nopriv_add_bundle', 'k_ajax_add_bundle_to_cart');

/**
 * Get cart contents
 * no args
 */
function k_ajax_get_cart() {
  wp_send_json(WC()->cart->get_cart());
  
  die();
}
add_action('wp_ajax_get_cart', 'k_ajax_get_cart');
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
add_action('wp_ajax_remove_cart_item', 'k_ajax_remove_cart_item');
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
add_action('wp_ajax_remove_all_cart_items', 'k_ajax_remove_all_cart_items');
add_action('wp_ajax_nopriv_remove_all_cart_items', 'k_ajax_remove_all_cart_items');
// == end AJAX fn's == //



// == begin macros -- reuseable components that can take args and spit out HTML == //
include_once('partials/macros/hero.php');
include_once('partials/macros/product-card.php');
include_once('partials/macros/product-video.php');
include_once('partials/macros/article-card.php');
// == end macros == //



// == begin helpers -- you know, helpers. They help. == //
function k_before_first_section() {
  echo '<div id="k-headermargin"></div>';
}
add_action('k_before_first_section', 'k_before_first_section');

function k_spacer() {
  echo '<div class="k-block k-block--md k-no-padding--bottom"></div>';
}
add_action('k_spacer', 'k_spacer');
// == end helpers == //


// == begin plugin stuff == //
function add_wc_support() {
  add_theme_support('woocommerce');
}
add_action('after_setup_theme', 'add_wc_support');
// == end plugin stuff == //

?>