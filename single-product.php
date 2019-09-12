<?php
  $root = get_template_directory_uri();

  /* Template Name: 2019 Product Detail Page */

  get_header();

  if (have_posts()) {
    while (have_posts()) {
      the_post();
      include(locate_template('partials/product-hero.php'));
    }
  }
  
?>

<?php get_footer(); ?>