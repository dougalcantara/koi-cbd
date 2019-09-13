<?php
  $root = get_template_directory_uri();

  /* Template Name: 2019 Product Detail Page */

  get_header();

  if (have_posts()) {
    while (have_posts()) {
      the_post();

      /* 
      * Multiple types of product classes are being used in this store.
      * Need to check or else some $product methods/props will produce a fatal error.
      *
      * I've found that there are at least two classes in play here:
      *
      * WC_Product_Variable - https://docs.woocommerce.com/wc-apidocs/class-WC_Product_Variable.html
      * and
      * WC_Product_Simple - https://docs.woocommerce.com/wc-apidocs/class-WC_Product_Simple.html
      */
      $all_variants;
      $all_image_ids;

      if (get_class($product) === 'WC_Product_Variable') {
        // "variations" include their own attached images, we can get those from that object
        $all_variants = $product->get_available_variations();
      } else {
        // assume this is not a Variable product, just get the images straight from the post
        $all_image_ids = $product->get_gallery_image_ids();
      }

      $product_acf = get_fields();

      // NOTE: all `include`s get access to vars from this scope
      include(locate_template('partials/product-hero.php'));
      include(locate_template('partials/product-details.php'));
      include(locate_template('partials/product-latest-batch.php'));
      include(locate_template('partials/product-faq-accordion.php'));
    }
  }

  get_footer();
?>