<?php
if (function_exists('acf_add_options_page')) {
	$parent = acf_add_options_page(array(
		'page_title' => 'Site Content',
		'menu_title' => 'Site Content',
		'redirect' => false
	));
	
	acf_add_options_sub_page(array(
		'page_title' => 'Homepage',
		'menu_title' => 'Homepage',
		'parent_slug' => $parent['menu_slug'],
  ));
  
  acf_add_options_sub_page(array(
		'page_title' => 'About Us',
		'menu_title' => 'About Us',
		'parent_slug' => $parent['menu_slug'],
	));
}

/**
 * We need a custom implementation of the "Submit order --> order details page" user flow.
 * 
 * Tapping into this Woo hook lets us redirect to a custom "thank you" template once the 
 * purchase method has been charged. This should not affect any email & automation workflows.
 */
function go_to_thank_you($order_id) {
  WC()->cart->empty_cart(); // otherwise this doesn't happen

  wp_redirect(site_url() . '/order-received', 301);

  die();
}
add_action('woocommerce_checkout_order_processed', 'go_to_thank_you');

// == begin AJAX fn's == //
/**
 * Add product to cart
 * args - product_id
 */
function k_ajax_add_product() {
  $product_id = intval($_POST['product_id']);
  $quantity = intval($_POST['quantity']);

  WC()->cart->add_to_cart($product_id, $quantity);

  wp_send_json(WC()->cart->get_cart());

  die();
}
add_action('wp_ajax_add_product', 'k_ajax_add_product');
add_action('wp_ajax_nopriv_add_product', 'k_ajax_add_product');

/**
 * Add bundle to cart
 * args - product_id, selected_child_items[]
 * 
 * selected_child_items is an array of products. Each product must have this shape:
 * array(
 *   *-- required props --*
 *   'product_id' => 401123,
 *   'bundled_product_key' => 7, // WC_Product_Bundle->get_bundled_items() to get at this data
 *   'quantity' => 1,
 *
 *   *-- you only need the below props if this bundle is made up of WC_Product_Variable --*
 *   'variation_id' => 123456, // WC_Product_Variable['variation_id'] or WC_Product_Bundle->get_available_variations()
 *   'attributes' => array(
 *     'strength' => '250 MG', // WC_Product_Vairable->get_attributes()
 *   )
 * )
 */
function k_ajax_add_bundle_to_cart() {
  $product_id = intval($_POST['product_id']);
  $selected_child_items = $_POST['selected_child_items'];

  /**
   * Even though we're checking this client-side, we need server-side checking
   * to make sure that no one can spoof min/max items from the client by changing
   * data-attr's.
   * 
   * There was a plugin managing this (WC Product Bundles - Min/Max Items) but it 
   * was a total clusterfuck to integrate with. This is a quick workaround.
   */
  $product_acf = get_fields($product_id);
  $min_items = intval($product_acf['min_items']);
  $max_items = intval($product_acf['max_items']);
  $num_selected_items = count($selected_child_items);

  if ($num_selected_items < $min_items) {
    $err = new WP_Error('num_items_err', __('Expected minimum '.$min_items.' items, received '.$num_selected_items.' items'));
    
    wp_send_json_error($err, 400);
    
    die();
  }

  if ($num_selected_items > $max_items) {
    $err = new WP_Error('num_items_err', __('Expected maximum '.$max_items.' items, received '.$num_selected_items.' items'));
    
    wp_send_json_error($err, 400);
    
    die();
  }

  /**
   * The array passed to add_bundle_to_cart() must be indexed by the
   * item keys that you get from WC_Product_Bundle->get_bundled_items(). 
   * 
   * This array is not necessarily 0-indexed as you may expect.
   */
  $reshaped_items = array();
  foreach($selected_child_items as $index => $item) {
    $reshaped_items[$item['bundled_product_key']] = $item;
  }

  WC_PB()->cart->add_bundle_to_cart($product_id, 1, $reshaped_items);

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
  $cart_items = WC()->cart->get_cart();
  $response = array();
  $expanded = array();

  foreach($cart_items as $cart_item) {
    $product = wc_get_product($cart_item['product_id']);

    if ($product->get_type() == 'variable') {
      $product = wc_get_product($cart_item['variation_id']);
    } else {
      $product = wc_get_product($cart_item['product_id']);
    }

    $product_data = $product->get_data();
    
    $_product = array(
      'name' => $product_data['name'],
      'permalink' => $product->get_permalink(),
      'thumbnail_url' => wp_get_attachment_image_url($product->get_image_id(), 'small'),
      'quantity' => $cart_item['quantity'],
      'price' => $product->get_price(),
      'is_bundle' => wc_pb_is_bundle_container_cart_item($cart_item),
      'is_bundled_item' => wc_pb_is_bundled_cart_item($cart_item),
    );

    array_push($expanded, $_product);
  }

  // some AJAX fn's need the actual cart items, which have a different shape/schema than the actual products they represent
  $response['cart_items'] = $cart_items;
  // and other fn's need more granular product data
  $response['expanded_products'] = $expanded;

  wp_send_json($response);
  
  die();
}
add_action('wp_ajax_k_get_cart', 'k_ajax_get_cart');
add_action('wp_ajax_nopriv_k_get_cart', 'k_ajax_get_cart');

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

function k_decrement_cart_item() {
  $cart_item_key = $_POST['cart_item_key'];
  $cart_item_quantity = intval($_POST['cart_item_quantity']);

  $new_quantity = --$cart_item_quantity;

  WC()->cart->set_quantity($cart_item_key, $new_quantity);

  wp_redirect($_SERVER['HTTP_REFERRER']);

  die();
}
add_action('wp_ajax_decrement_cart_item', 'k_decrement_cart_item');
add_action('wp_ajax_nopriv_decrement_cart_item', 'k_decrement_cart_item');

function k_increment_cart_item() {
  $cart_item_key = $_POST['cart_item_key'];
  $cart_item_quantity = intval($_POST['cart_item_quantity']);

  var_dump($cart_item_key, $cart_item_quantity);

  $new_quantity = ++$cart_item_quantity;

  WC()->cart->set_quantity($cart_item_key, $new_quantity);

  wp_redirect($_SERVER['HTTP_REFERRER']);

  die();
}
add_action('wp_ajax_increment_cart_item', 'k_increment_cart_item');
add_action('wp_ajax_nopriv_increment_cart_item', 'k_increment_cart_item');
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