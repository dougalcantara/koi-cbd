<?php
/* Template Name: 2019 Find My CBD Product Page */
global $wpdb;

$formatted_products = array();
$args = array(
  'orderby'  => 'name',
);
$products = wc_get_products($args);

var_dump($products);
?>