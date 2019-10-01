<?php
/* Template Name: 2019 All Products Page */

get_header();

do_action('k_before_first_section');

echo k_hero(array(
  'preheading' => 'Koi CBD',
  'headline' => get_the_title(),
  'body' => '<p>Welcome to the Awesome World of CBD.',
));

get_template_part('partials/components/randoms/breadcrumb');

get_template_part('partials/home-overview');

get_footer();
?>