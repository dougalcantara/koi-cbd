<?php
/* Template Name: 2019 Find My CBD Product Page */

/**
 * It works like this:
 * 1) Dump product JSON into hidden div as string
 * 2) JSON.parse it and throw it on the window
 * 3) Product finder rec tool looks at window.allProducts for product data
 */
get_header(); ?>

<div id="product-json" style="display: none;">
  <?php echo file_get_contents(get_template_directory_uri() . '/dist/misc/wc_products.json'); ?>
</div>

<script type="text/javascript">
  (function() {
    var jsonParent = document.querySelector('#product-json');
    var jsonContent = JSON.parse(jsonParent.innerHTML)

    window.allProducts = jsonContent;
  })();
</script>

<?php get_footer(); ?>
