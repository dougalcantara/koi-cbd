<?php
$root = get_template_directory_uri();
$fields = get_fields();

get_header();
do_action('k_before_first_section');
?>

<section class="k-hero--blogsingle on-dark">
  <div class="blog-schema" style="opacity: 0; pointer-events: none;"><?php include(locate_template('helpers/blog-schema.php')); ?></div>
  <div class="k-hero--bgimg" data-src="<?php echo get_the_post_thumbnail_url(); ?>"></div>

  <div class="k-inner k-inner--xl">

    <div class="k-hero--main">

      <div class="k-hero--meta">
        <div class="k-hero--date">
          <span class="k-upcase"><?php echo get_the_date('m.d.y'); ?></span>
        </div>
        <div class="k-hero--category">
          <p class="k-upcase"><?php echo get_the_category()[0]->name; ?></p>
        </div>
      </div>

      <div class="k-hero--title">
        <h1 class="k-headline k-headline--md"><?php echo get_the_title(); ?></h1>
        <p><?php echo get_the_excerpt(); ?></p>
      </div>

    </div>

  </div>
</section>

<?php new Breadcrumbs([
  [
    'name' => 'Home',
    'url' => home_url()
  ],
  [
    'name' => get_the_title(),
    'url' => get_the_permalink()
  ]
]); ?>

<section class="k-blogcontent k-block k-block--md">
  <div class="k-inner k-inner--xl">
    
    <aside class="k-sidebar">
      <div class="k-sidebar--content">
        <?php
          if ($fields['sidebar_product_callout']) {
            $featured_product = wc_get_product($fields['sidebar_product_callout']->ID);
          } else {
            $featured_product = wc_get_product(205491);
          }
          
          $featured_product_image = wp_get_attachment_url($featured_product->get_image_id());

          $card_fields = array(
            'product_image_url' => $featured_product_image,
            'product_title' => $featured_product->get_name(),
            'product_link' => $featured_product->get_permalink(),
            'product_id' => $featured_product->get_id(),
          );

          echo k_product_card($card_fields);
        ?>

        <div class="k-sidebar--newsletter on-dark">
          <div class="k-sidebar--newsletter__bgimg" style="background-image: url(<?php echo $root.'/dist/img/koi-cta-takeover-bg.jpg'; ?>);"></div>
          
          <div class="k-sidebar--newsletter__content">

            <span>Sign Up for the Koi CBD Newsletter</span>

            <form class="k-form" data-hs-form-id="eae9de54-3f3d-46f7-a523-5e504254f49f">
              <input type="email" name="email" id="koi-blog-newsletter-signup" />
              <label for="koi-blog-newsletter-signup">Email Address</label>
              <button type="submit">&rarr;</button>

              <div class="k-form--message"><p>Got it, thanks!</p></div>
            </form>

          </div>

        </div>
      </div>
    </aside>

    <article class="k-article" id="k-main-content">
      <div class="k-article--content k-rte-content">
        <?php echo $post->post_content; ?>
      </div>
    </article>

  </div>
</section>
<?php

$slider_fields = array(
  'headline' => 'Shop Related Koi Products',
  'products' => $fields['recommended_products'],
  'half_padding_top' => true,
  'half_padding_bottom' => true,
);
include(locate_template('partials/promo-slider.php'));

include(locate_template('partials/components/randoms/line.php'));

$featured_articles = $fields['related_posts'];
include(locate_template('partials/blog-promo.php'));

get_footer();
?>
