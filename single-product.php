<?php
/*
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */
if (!defined('ABSPATH')) {
	exit;
}

get_header();

while (have_posts()) : the_post();
  /**
   * check against this to see what type of product you're working with here
   * eg: if ($product_wc_type == $wc_product_types['variable']) { // ...do stuff }
   */
  $wc_product_types = array(
    'variable' => 'variable',
    'simple' => 'simple',
    'bundle' => 'bundle',
  );

  $product_id = $product->get_id();
  $product_acf = get_fields();
  $cat_name = get_the_terms($product_id, 'product_cat');
  $product_category = reset($cat_name)->name;
  $product_wc_type = $product->get_type();

  do_action('k_before_first_section');

  include(locate_template('partials/product-hero.php'));
  foreach($product->get_bundled_items() as $item_key => $item) {
    $bundled_product = wc_get_product($item->get_data()['product_id']);
    ?>
    <!-- <div style="margin-bottom: 10em;">
      <?php
        var_dump(
          $bundled_product->get_id(),
          $bundled_product->get_available_variations()[0]['variation_id']
        );
      ?>
    </div> -->
  <?php
  }

  $args = array(
    7 => array(
      'product_id' => 205366,
      'quantity' => 1,
      'variation_id' => 205403,
      'attributes' => array(
        'attribute_pa_strength' => '250',
      ),
    ),
    8 => array(
      'product_id' => 205342,
      'quantity' => 1,
      'variation_id' => 205355,
      'attributes' => array(
        'attribute_pa_strength' => '250',
      ),
    ),
    9 => array(
      'product_id' => 205502,
      'quantity' => 1,
      'variation_id' => 205503,
      'attributes' => array(
        'attribute_pa_strength' => '250',
      ),
    ),
    10 => array(
      'product_id' => 505474,
      'quantity' => 1,
      'variation_id' => 505475,
      'attributes' => array(
        'attribute_pa_strength' => '250',
      ),
    ),
  );

  var_dump(WC_PB()->cart->add_bundle_to_cart($product_id, 1, $args));
  include(locate_template('partials/product-details.php'));
  include(locate_template('partials/product-latest-batch.php'));
  include(locate_template('partials/product-faq-accordion.php'));
  include(locate_template('partials/product-reviews.php'));

  $product_video_fields = array(
    'preheadline' => $product_category,
    'headline' => 'Create Balance Daily with Easy & Natural Koi CBD Tinctures',
    'video_headline' => 'Experience the benefits of Koi CBD in its simplest form.',
    'body_copy' => '
      <p>Designed as sublingual tinctures, Koi Naturals CBD tinctures are most effective when held under the tongue for a few moments before swallowing.</p>
      <p>All of our CBD oil is available in two sizes, four strengths, and six delicious flavors. Once you try some for yourself, you\'ll know why Koi Naturals is our most frequently recommended supplement line.</p>
      <a href="#0" class="k-button k-button--dark">Learn More &rarr;</a>
    '
  );

  echo k_product_video($product_video_fields);

  $slider_fields = array(
    'headline' => 'Shop Customer Favorites',
    'products' => $product_acf['other_recommended_products'],
  );

  include(locate_template('partials/promo-slider.php'));

endwhile;

get_footer();
