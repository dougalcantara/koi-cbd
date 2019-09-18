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
  $product_category = $page_fields['product_type']->name;

  get_header();
?>

<section class="k-hero k-hero--productlisting k-headermargin on-dark">
  <div class="k-inner k-inner--md">

    <div class="k-hero--content">

      <div class="k-hero--preheading k-upcase">Koi CBD</div>

      <h2 class="k-headline k-headline--md"><?php echo $product_category; ?></h2>

      <div class="k-rte-content">
        <p>The easy and delicious supplement for more balanced days. Experience Koi CBD Tinctures in 6 great-tasting flavors, 2 sizes, and 4 strengths.</p>
      </div>

    </div>

  </div>
</section>

<section class="k-breadcrumb k-block k-block--sm">
  <div class="k-inner k-inner--md">
    <?php woocommerce_breadcrumb(); ?>
  </div>
</section>

<section class="k-productlisting k-block k-block--md k-no-padding--top">
  <div class="k-inner k-inner--md">

  <?php
    $args = array(
      'post_type' => 'product',
      'product_cat' => $product_category,
    );

    $products = wc_get_products($args);

    foreach($products as $idx => $product) {
      $name = $product->get_name();
      $id = $product->get_id();
      $image = wp_get_attachment_image_src(get_post_thumbnail_id($id), 'large')[0];

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
  $product_video_fields = array(
    'preheadline' => 'Feel calm, feel relief, feel balanced',
    'headline' => 'With all-natural Koi CBD Tinctures, happy, healthy days are a few drops away.',
    'video_headline' => 'Experience the rejuvenating of Koi CBD Tinctures',
    'body_copy' => '
      <p>Repudiandae fuga non nemo facere nihil, libero nesciunt quae, beatae officia distinctio aliquam hic? Optio repudiandae iusto eveniet, sed, deserunt, maxime voluptatibus earum recusandae repellat natus magnam vitae culpa. Amet officiis doloremque error.</p>
      <p>Quod aliquam beatae sed repellendus nihil sint aliquid voluptates. Repudiandae fuga non nemo facere nihil, libero nesciunt quae, beatae officia distinctio aliquam hic? Optio repudiandae iusto eveniet.</p>
      <a href="#0" class="k-button k-button--dark">Learn More &rarr;</a>
    '
  );

  echo k_product_video($product_video_fields);

  $featured_articles = $page_fields['featured_articles'];
  include(locate_template('partials/blog-promo.php'));
  include(locate_template('partials/components/randoms/line.php'));
  include(locate_template('partials/cta-takeover.php'));

  get_footer();
?>