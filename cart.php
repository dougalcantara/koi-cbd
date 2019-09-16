<?php
  /* Template Name: 2019 Cart Page */

  $cart_page_id = wc_get_page_id('cart');
  $cart_page = get_post($cart_page_id);

  var_dump($cart_page);
?>