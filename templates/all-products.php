<?php
/* Template Name: 2019 All Products Page */
$url = site_url();

get_header();

do_action('k_before_first_section');

echo k_hero(array(
  'preheading' => 'Koi CBD',
  'headline' => get_the_title(),
  'body' => '<p>Welcome to the Awesome World of CBD.',
));

get_template_part('partials/components/randoms/breadcrumb');

$taxonomy = 'product_cat';
$orderby = 'name';  
$show_count = 0;
$pad_counts = 0;
$hierarchical = 0;
$title = '';  
$empty = 0;

$args = array(
  'taxonomy' => $taxonomy,
  'orderby' => $orderby,
  'show_count' => $show_count,
  'pad_counts' => $pad_counts,
  'hierarchical' => $hierarchical,
  'title_li' => $title,
  'hide_empty' => $empty
);

$all_categories = get_categories($args);
?>

<section class="k-block k-block--md k-all-products k-no-padding--top">
  <div class="k-inner k-inner--md">
  <?php
  foreach($all_categories as $product_cat) :
    echo k_product_card(array(
      'product_title' => $product_cat->name,
      'product_short_description' => $product_cat->description,
    ));
  endforeach;
  ?>
  </div>
</section>

<?php
get_footer();
?>