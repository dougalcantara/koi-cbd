<?php
/* Template Name: 2019 All Products Page */
$url = site_url();
$fields = get_fields();

get_header();

do_action('k_before_first_section');

echo k_hero(array(
  'preheading' => $fields['hero_preheading'],
  'headline' => $fields['hero_heading'],
  'body' => $fields['hero_body'],
  'background_image' => $fields['hero_background_image']['url'],
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
    $cat_fields = get_fields('term_' . $product_cat->cat_ID); ?>
    <div class="k-productcard">
    <div class="k-productcard--liner">

      <a href="<?php echo $args['product_link']; ?>">
        <figure class="k-figure">
          <div class="k-figure--liner">
            <img class="k-figure--img" data-src="<?php echo $cat_fields['category_featured_image']['url']; ?>" alt="">
          </div>
        </figure>
      </a>

      <div class="k-productcard--title">
        <h3 class="k-headline k-headline--fake k-weight--lg"><a href="<?php echo $args['product_link']; ?>"><?php echo $product_cat->name; ?></a></h3>
        <p class="k-accent-text"><?php echo $product_cat->description; ?></p>
      </div>

      <div class="k-productcard--action">
        <a href="<?php echo $args['product_link']; ?>" class="k-button k-button--default">Shop Now</a>
      </div>

    </div>
  </div>
  <?php endforeach; ?>
  </div>
</section>

<?php get_footer(); ?>