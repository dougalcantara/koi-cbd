<?php
/* Template Name: 2019 Product Listing Page */

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

defined('ABSPATH') || exit;

$page_fields = get_fields();
$product_category = $page_fields['product_type']->name;

get_header();

do_action('k_before_first_section');

$hero_fields = array(
  'preheading' => 'Koi CBD',
  'headline' => $product_category,
  'body' => $page_fields['hero_supporting_copy'],
  'background_image' => $page_fields['hero_background_image']['url'],
);

echo k_hero($hero_fields);

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
    'name' => $product_category,
    'url' => home_url() . '/' . $page_fields['product_type']->slug
  ]
]);

$list_flavored_only = $_GET['flavored'] == true;
$unflavored_products = array(205502, 30207);
?>

  <section class="k-productlisting k-block k-block--md k-no-padding--bottom">
    <div class="k-inner k-inner--md">

      <?php
      $args = array(
        'post_type' => 'product',
        'product_cat' => $product_category,
      );

      $products = wc_get_products($args);

      foreach ($products as $idx => $product) {
        $product_is_hidden = $product->get_status() === 'draft' || $product->get_catalog_visibility() === 'hidden';
        if ($product_is_hidden) : continue; endif;

        $name = $product->get_name();
        $id = $product->get_id();
        $image = wp_get_attachment_image_src(get_post_thumbnail_id($id), 'large')[0];

        /**
         * If the user was recommended a flavored item from the Product Rec Tool,
         * don't show un-flavored items here.
         * 
         * Since Koi only has one un-flavored type of each product, the Product
         * Rec Tool just sends them straight to that item, so we don't have to 
         * worry about handling the opposite condition here.
         */
        if ($list_flavored_only && in_array($id, $unflavored_products)) : continue; endif;

        $card_fields = array(
          'product_image_url' => $image,
          'product_title' => $name,
          'product_link' => get_the_permalink($id),
          'product_id' => $id,
        );

        echo k_product_card($card_fields);
      }
      ?>

    </div>
  </section>

<?php
// $product_video_fields = array(
//   'preheadline' => 'Feel calm, feel relief, feel balanced',
//   'headline' => 'With all-natural Koi CBD Tinctures, happy, healthy days are a few drops away.',
//   'video_headline' => 'Experience the rejuvenating of Koi CBD Tinctures',
//   'body_copy' => '
//     <p>Repudiandae fuga non nemo facere nihil, libero nesciunt quae, beatae officia distinctio aliquam hic? Optio repudiandae iusto eveniet, sed, deserunt, maxime voluptatibus earum recusandae repellat natus magnam vitae culpa. Amet officiis doloremque error.</p>
//     <p>Quod aliquam beatae sed repellendus nihil sint aliquid voluptates. Repudiandae fuga non nemo facere nihil, libero nesciunt quae, beatae officia distinctio aliquam hic? Optio repudiandae iusto eveniet.</p>
//     <a href="#0" class="k-button k-button--dark">Learn More &rarr;</a>
//   '
// );

// echo k_product_video($product_video_fields);

$featured_articles = $page_fields['featured_articles'];
include(locate_template('partials/blog-promo.php'));
include(locate_template('partials/components/randoms/line.php'));

get_footer();
?>