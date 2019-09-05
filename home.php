<?php
  $root = get_template_directory_uri();

  /* Template Name: Homepage */
  get_header();

  get_template_part('partials/home-hero');
  get_template_part('partials/promo-slider');
  get_template_part('partials/home-overview');
  get_template_part('partials/testimonial-slider');
  get_template_part('partials/cta-banner');
  get_template_part('partials/video-gallery');
  get_template_part('partials/cta-takeover');

  get_footer();
?>