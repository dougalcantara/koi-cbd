<?php
  /* Template Name: 2019 Homepage */

  $root = get_template_directory_uri();
  $fields = get_fields();
  $homepage_fields = get_fields();

  get_header();

  do_action('k_before_first_section');

  $hero_fields = array(
    'headline' => $fields['hero_headline'],
    'body' => $fields['hero_copy'],
    'bgImg' => $fields['hero_background_image'],
  );

  include(locate_template('partials/home-hero.php'));

  $slider_fields = array(
    'headline' => $fields['product_slider_headline'],
    'products' => $fields['product_slider_default_products'],
    'half_padding_top' => true,
  );

  include(locate_template('partials/promo-slider.php'));

  get_template_part('partials/home-overview');
  get_template_part('partials/testimonial-slider');
  get_template_part('partials/cta-banner');
  get_template_part('partials/video-gallery');

  get_footer();
?>