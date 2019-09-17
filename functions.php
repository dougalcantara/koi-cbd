<?php
function k_ajax_add_product() {
  $product_id = intval($_POST['product_id']);

  WC()->cart->add_to_cart($product_id, 1);

  die();
}

add_action('wp_enqueue_scripts', 'k_ajax_add_product');
add_action('wp_ajax_add_product', 'k_ajax_add_product');
add_action('wp_ajax_nopriv_add_product', 'k_ajax_add_product');

include_once('partials/macros/product-card.php');

function add_wc_support() {
  add_theme_support('woocommerce');
}

add_action('after_setup_theme', 'add_wc_support');

?>