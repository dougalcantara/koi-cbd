<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

 /* Template Name: 2019 Product Listing Page */

defined( 'ABSPATH' ) || exit;

$page_fields = get_fields();
$product_type = $page_fields['product_type'];

get_header();
?>

<section class="k-hero k-hero--productlisting k-headermargin">
  <div class="k-inner k-inner--md">



  </div>
</section>

<section class="k-productlisting k-block k-block--md">
  <div class="k-inner k-inner--md">

  <?php
    $args = array(
      'post_type' => 'product',
      'product_cat' => $product_type->name,
    );

    $products = wc_get_products($args);

    var_dump($products);
  ?>

  </div>
</section>

<?php
get_footer();
?>