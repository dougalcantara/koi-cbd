
<?php
add_filter('the_title', 'ignore_default_title');

function ignore_default_title() {
  $s = get_search_query();

  return 'Koi Search: ' . $s;
}

get_header();

do_action('k_before_first_section');
?>

<section class="k-block k-block--md k-no-padding--bottom">
  <div class="k-inner k-inner--md">
    <p class="k-preheading k-upcase">Search Koi CBD</p>
    <h1 class="k-headline k-headline--md">Search Results</h1>
  </div>
</section>

<section class="k-searchresults k-block k-block--md k-no-padding--top">
  <div class="k-inner k-inner--md">
  <?php
    global $wp_query;
    $posts = $wp_query->posts;
    
    foreach($posts as $key => $_post) {
      $is_product = get_post_type($_post) == 'product';
    
      if ($is_product) {
        $product = wc_get_product($_post->ID);
        $id = $product->get_id();
        $image = wp_get_attachment_image_src(get_post_thumbnail_id($id), 'large')[0];
        $price = $product->get_price();
        $link_to_product = $product->get_permalink();
      ?>
        <div class="k-searchresults--item" data-yotpo-product-id="<?php echo $id; ?>">
          <div class="k-searchresults--item__liner">

            <div class="k-searchresults--item__image">
              <a href="<?php echo $link_to_product; ?>">
                <figure class="k-figure">
                  <div class="k-figure--liner" style="padding-bottom: 100%;">
                    <img src="<?php echo $image; ?>" alt="" class="k-figure--img">
                  </div>
                </figure>
              </a>
            </div>

            <div class="k-searchresults--item__title">
              <a href="<?php echo $link_to_product; ?>">
                <h3 class="k-headline k-headline--sm"><?php echo $product->get_title(); ?></h3>
              </a>
            </div>

            <div class="k-searchresults--item__reviews">
              <ul>
                <li><?php get_template_part('partials/svg/gold-star'); ?></li>
                <li class="k-productcard--reviewavg k-accent-text">5</li>
              </ul>
            </div>

            <div class="k-searchresults--item__price">
              <p class="k-bigtext"><?php echo $price > 0 ? $price : ''; ?></p>
            </div>

            <div class="k-searchresults--item__action">
              <a href="<?php echo $link_to_product; ?>" class="k-button k-button--primary">Go</a>
            </div>
          </div>
        </div>
  <?php
      }
    }
  ?>
  </div>
</section>

<?php
get_footer();
?>