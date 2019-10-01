<?php
$root = get_template_directory_uri();
$fields = get_fields();

get_header();

do_action('k_before_first_section');
?>

<section class="k-hero--blogsingle on-dark">
  <div class="k-hero--bgimg" style="background-image: url(<?php echo get_the_post_thumbnail_url(); ?>);"></div>

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

<nav class="k-blog-breadcrumb">
  <div class="k-inner k-inner--xl">

    <div class="k-blog-breadcrumb--content">

      <ul>
        <li><a href="<?php echo site_url(); ?>">Home</a>&nbsp;&rsaquo;&nbsp;</li>
        <li><a href="<?php echo site_url().'/resources'; ?>">Resources</a>&nbsp;&rsaquo;&nbsp;</li>
        <li><a href="<?php echo site_url().'/blog'; ?>">Koi Blog</a>&nbsp;&rsaquo;&nbsp;</li>
        <li><?php echo get_the_title(); ?></li>
      </ul>

    </div>

  </div>
</nav>

<section class="k-blogcontent k-block k-block--md">
  <div class="k-inner k-inner--xl">
    
    <aside class="k-sidebar">
      <div class="k-sidebar--content">
        <?php
          $featured_product = wc_get_product(205491);
          $featured_product_image = wp_get_attachment_url($featured_product->get_image_id());

          $card_fields = array(
            'product_image_url' => $featured_product_image,
            'product_title' => $featured_product->post_title,
            'product_link' => get_the_permalink(205491),
            'product_id' => 205491,
          );

          echo k_product_card($card_fields);
        ?>

        <div class="k-sidebar--newsletter on-dark">
          <div class="k-sidebar--newsletter__bgimg" style="background-image: url(<?php echo $root.'/dist/img/koi-cta-takeover-bg.jpg'; ?>);"></div>
          
          <div class="k-sidebar--newsletter__content">

            <span>Sign Up for the Koi CBD Newsletter</span>

            <form class="k-form">
              <input type="email" name="email" id="koi-blog-newsletter-signup" />
              <label for="koi-blog-newsletter-signup">Email Address</label>
              <button type="submit">&rarr;</button>
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
  'products' => $fields['product_slider_default_products'],
  'half_padding_top' => true,
);
include(locate_template('partials/promo-slider.php'));

include(locate_template('partials/components/randoms/line.php'));

$featured_articles = $fields['featured_articles'];
include(locate_template('partials/blog-promo.php'));

get_footer();
?>
