<?php
  /* Template Name: 2019 Homepage */

  $root = get_template_directory_uri();
  $fields = get_fields();
  $site_content = get_fields('option');

  get_header();

  /**
   * This page relies on the include(locate_template()) hack.
   * Any variables declared in this file's scope will be silently
   * passed to any files included with this method, as if the 
   * included file's content was in this file to begin with.
   * 
   * There's cleaner ways of doing this, but this does work and 
   * we're not sure at this point if these homepage components 
   * are even reuseable.
   * 
   * It works nicely, however, since the majority of the site's 
   * content is entered on the ACF "options" page titled
   * "Site Content". Let's all just embrace global vars, okay?
   */
  $hero_fields = array(
    'headline' => $site_content['hero_headline'],
    'body' => $site_content['hero_body'],
    'bgImg' => $site_content['hero_background_image'],
    'actions' => $site_content['hero_actions'],
  );
  include(locate_template('partials/home-hero.php'));
  echo "<section class='home-sections'>";
  $slider_fields = array(
    'headline' => $site_content['product_slider_headline'],
    'products' => $site_content['product_slider_products'],
    'half_padding_top' => true,
  );
  include(locate_template('partials/promo-slider.php'));

  $overview_fields = array(
    'headline' => $site_content['product_overview_headline'],
    'main_image' => $site_content['product_overview_main_image'],
    'supporting_copy' => $site_content['product_overview_supporting_copy'],
    'main_link' => $site_content['product_overview_main_link'],
    'tinctures_copy' => $site_content['product_overview_tinctures_supporting_copy'],
    'topicals_copy' => $site_content['product_overview_topicals_supporting_copy'],
    'pets_copy' => $site_content['product_overview_pets_supporting_copy'],
    'edibles_copy' => $site_content['product_overview_edibles_supporting_copy'],
    'vape_copy' => $site_content['product_overview_vape_supporting_copy'],
    'merch_copy' => $site_content['product_overview_merch_supporting_copy'],
  );
  include(locate_template('partials/home-overview.php'));

  $testimonial_fields = array(
    'testimonials' => $site_content['homepage_testimonials'],
  );
  include(locate_template('partials/testimonial-slider.php'));

  $cta_fields = array(
    'preheading' => $site_content['cta_banner_preheading'],
    'heading' => $site_content['cta_banner_heading'],
    'link' => $site_content['cta_banner_link'],
  );
  include(locate_template('partials/cta-banner.php'));
  
  get_template_part('partials/process-preview');
  echo "</section>";

  get_footer();
?>