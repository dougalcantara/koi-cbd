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

function formatAttrName($string)
{
  $arr = explode('-', $string);

  foreach ($arr as $idx => $str) {
    $arr[$idx] = ucfirst($str);
  }

  return join(' ', $arr);
}

while (have_posts()) : the_post();
  $product_id = $product->get_id();
  $product_acf = get_fields();
  $cat_name = get_the_terms($product_id, 'product_cat');
  $product_category = reset($cat_name)->name;
  $product_wc_type = $product->get_type();

  // "Bundle" product types have min/max limitations
  $min_items = $product_acf['min_items'];
  $max_items = $product_acf['max_items'];

  do_action('k_before_first_section');

  include(locate_template('partials/product-hero.php'));
  new Breadcrumbs([
    [
      'name' => 'Home',
      'url' => home_url()
    ],
    [
      'name' => 'Shop All',
      'url' => home_url() . '/cbd-products'
    ],
    [
      'name' => $product_category = reset($cat_name)->name,
      'url' => home_url() . '/' . $product_category = reset($cat_name)->slug
    ],
    [
      'name' => $product->name,
      'url' => home_url() . '/product/' . $product->slug
    ]
  ]);
  include(locate_template('partials/product-details.php'));

  if ($product_category != 'Merchandise' && $product_category != 'CBD Vape Devices') : // these categories don't have lab results associated with them
    include(locate_template('partials/product-latest-batch.php'));
  else : // need something here to keep spacing consistent w/o the "latest batch" section. This is the quickest way for now
    ?>
    <section class="k-block k-block--md k-no-padding--top"></section>
  <?php endif;

  if ($product_acf['frequently_asked_questions']) {
    include(locate_template('partials/product-faq-accordion.php'));
  }

  include(locate_template('partials/product-reviews.php'));

  /**
   * This will be included post-launch
   */
  // $product_video_fields = array(
  //   'preheadline' => $product_category,
  //   'headline' => 'Create Balance Daily with Easy & Natural Koi CBD Tinctures',
  //   'video_headline' => 'Experience the benefits of Koi CBD in its simplest form.',
  //   'body_copy' => '
  //     <p>Designed as sublingual tinctures, Koi Naturals CBD tinctures are most effective when held under the tongue for a few moments before swallowing.</p>
  //     <p>All of our CBD oil is available in two sizes, four strengths, and six delicious flavors. Once you try some for yourself, you\'ll know why Koi Naturals is our most frequently recommended supplement line.</p>
  //     <a href="#0" class="k-button k-button--dark">Learn More &rarr;</a>
  //   '
  // );

  // echo k_product_video($product_video_fields);

  $slider_fields = array(
    'headline' => 'Shop Customer Favorites',
    'products' => $product_acf['other_recommended_products'],
  );

  include(locate_template('partials/promo-slider.php'));

endwhile;

get_footer();
