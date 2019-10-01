<?php
/* Template Name: 2019 Blog Listing Template */

defined( 'ABSPATH' ) || exit;

get_header();

do_action('k_before_first_section');

$hero_fields = array(
  'preheading' => 'Experience The',
  'headline' => get_the_title(),
  'body' => '<p>New products, balanced lives, and CBD in the news. Find it all and more on our blog.</p>',
);

echo k_hero($hero_fields);

$all_categories = get_categories();
$requested_category = urldecode($_GET['category']);
$query_args = array(
  'paged' => false,
  'numberposts' => 1000,
);

$found_category;

if ($requested_category) {
  /**
  * 
  * This loop has multiple jobs, like any good loop
  * 1) Map the req'd category up to the slug-ified name of the category in WP. If match is found, query posts w/ that category. Can't 
  *    use the actual category->slug because they're not all formatted in a uniform way, eg: 'getting-started-with-cbd' vs 'cbdfactvsfiction'
  *
  * 2) Spit out the options for the 
  * 
  * */
  foreach($all_categories as $key => $category) {
    $c_name = strtolower(str_replace(' ', '-', $category->cat_name));

    if ($c_name == $requested_category) {
      $found_category = $c_name;
    }
  }

  $query_args['category_name'] = $found_category;
}

$all_posts = get_posts($query_args);
?>

<section class="k-blognav">
<?php
  get_template_part('partials/components/randoms/breadcrumb'); ?>
  <div class="k-blognav--filterby">
    <label for="select-blog-category">Filter By&nbsp;&rsaquo;&nbsp;</label>
    <select name="select-blog-category" id="select-blog-category">
      <option value="all">All</option>
      <?php
        foreach($all_categories as $key => $category) { ?>
          <option value="<?php echo $category->cat_name; ?>">
            <?php echo $category->cat_name; ?>
          </option>
      <?php
        }
      ?>
    </select>
  </div>
</section>

<section class="k-bloglist k-block k-block--md k-no-padding--top">
  <div class="k-inner k-inner--md">
  <?php

    foreach($all_posts as $index => $post) {
      $id = $post->ID;
      $should_break_for_cta = $index > 0 && $index % 6 == 0;

      if ($should_break_for_cta) { ?>
        </div> <!-- close out the flex inner around the cards -->

        <section class="k-cta--subscribe on-dark"> <!-- Insert big ass "inner-breaking" CTA section here -->
          <div class="k-inner k-inner--xl k-block k-block--md">

            <div class="k-cta--content">
              <div class="k-inner k-inner--md">
                <p class="k-cta--preheading k-upcase">Sign Up For Our Emails</p>

                <h2 class="k-headline k-headline--sm">
                  Get Into the #KoiCBDLife with Special News & Promos
                </h2>

                <a href="#0" class="k-button k-button--secondary">Let's Get Started &nbsp; &rarr;</a>
              </div>
            </div>

          </div>
        </section>

        <div class="k-inner k-inner--md"> <!-- reopen the flex inner and include this $index's card -->
        <?php
          $article_card_props = array(
            'featured_image_url' => wp_get_attachment_image_src(get_post_thumbnail_id($id), 'large')[0],
            'category' => get_the_category($id)[0]->cat_name,
            'publish_date' => get_the_date('m.d.y', $id),
            'title' => $post->post_title,
            'excerpt' => $post->post_excerpt,
            'url' => get_the_permalink($id),
          );

          echo k_article_card($article_card_props);
        ?>
      <?php
      } else {
        $article_card_props = array(
          'featured_image_url' => wp_get_attachment_image_src(get_post_thumbnail_id($id), 'large')[0],
          'category' => get_the_category($id)[0]->cat_name,
          'publish_date' => get_the_date('m.d.y', $id),
          'title' => $post->post_title,
          'excerpt' => $post->post_excerpt,
          'url' => get_the_permalink($id),
        );

        echo k_article_card($article_card_props, $index);
      }
    }
  ?>
  </div>
</section>

<?php

get_footer();

?>