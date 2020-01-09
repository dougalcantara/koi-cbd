<?php
/* Template Name: 2019 Blog Listing Template */

defined( 'ABSPATH' ) || exit;

get_header();

do_action('k_before_first_section');

$hero_fields = array(
  'preheading' => 'Experience The',
  'headline' => get_the_title(),
  'body' => 'New products, balanced lives, and CBD in the news. Find it all and more on our blog.',
  'background_image' => get_fields()['blog_listing_hero_background_image']['url'],
);

echo k_hero($hero_fields);

$all_categories = get_categories();
$requested_category = $_GET['category'];
$per_page = 12;

if ($requested_page === 0) {
  $query_args = array(
    'paged' => false,
    'numberposts' => $per_page,
  );
} else {
  $query_args = array(
    'paged' => false,
    'numberposts' => 12,
    'offset' => $per_page * ($requested_page - 1),
  );
}

if ($requested_category && $requested_category != 'all') {
  /**
  * Map the req'd category up to the slug-ified name of the category in WP.
  *
  * If match is found, query posts w/ that category ID. Can't use the actual
  * category->slug because they're not all formatted in a uniform way,
  * eg: 'getting-started-with-cbd' vs 'cbdfactvsfiction'
  * */
  foreach($all_categories as $key => $category) {
    $c_name = strtolower(str_replace(' ', '-', $category->cat_name));

    if ($c_name == $requested_category) {
      $query_args['cat'] = $category->cat_ID;
    }
  }
}

$all_posts = get_posts($query_args);
var_dump($requested_page);
?>

<section class="k-blognav">
  <?php new Breadcrumbs([
    [
      'name' => 'Home',
      'url' => home_url()
    ],
    [
      'name' => 'CBD Blog',
      'url' => home_url() . '/blog'
    ]
  ]); ?>
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

<section class="k-bloglist k-block k-block--md">
  <div class="k-inner k-inner--md">
  <?php
    foreach($all_posts as $index => $post) {
      $id = $post->ID;
      $should_break_for_cta = $index > 0 && $index % 6 == 0;

      if ($should_break_for_cta) { ?>
        </div> <!-- close out the flex inner around the cards -->

        <section class="k-cta--subscribe on-dark"> <!-- Insert big ass "inner-breaking" CTA section here -->
          <div class="k-inner k-inner--xl k-block k-block--md cta-subscribe-bg">
            <div class="k-cta--content">
              <div class="k-inner k-inner--md">
                <p class="k-cta--preheading k-upcase">Sign Up For Our Emails</p>
                
                <div class="k-cta__subscribe-content">
                <h2 class="k-headline k-headline--sm">
                  Get Into the #KoiCBDLife with Special News & Promos
                </h2>
              </div>
                  <a href="#0" class="k-cta__form-trigger k-button k-button--secondary">Let's Get Started &nbsp; &rarr;</a>
              </div>
            </div>
            <div class="k-cta__form-container">
              <div class="k-inner k-inner--md">
                <form class="k-cta__form" action="POST">
                  <fieldset class="k-form--group">
                    <label for="first name">First Name</label>
                    <input class="k-cta-first" type="text" name="first name" required>
                  </fieldset>
                  <fieldset class="k-form--group">
                    <label for="last name">Last Name</label>
                    <input class="k-cta-last" type="text" name="last name" required>
                  </fieldset>
                  <fieldset class="k-form--group">
                    <label for="email">Email</label>
                    <input class="k-cta-email" type="text" name="email" required>
                  </fieldset>                                
                  <button class="k-button k-button--primary">
                    Sign Up
                  </button>
                </form>
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
  <div class="k-bloglist__pagination">
    <?php
    $num_blog_posts = intval(wp_count_posts()->publish);
    $total_pages = intval(ceil($num_blog_posts / $per_page));
    $is_first_page = $requested_page <= 1;
    $is_final_page = $requested_page === $total_pages;
    ?>
    <div class="k-inner k-inner--md">
      <ul>
        <?php
          if ($requested_page > 1) : ?>
          <li>
            <a
              class="k-upcase"
              href="<?php echo site_url() . '/blog?page=' . ($requested_page - 1); ?>"
            >
              &larr;
            </a>
          </li>
        <?php endif; ?>
      <?php
      for ($i = 0; $i < $total_pages; $i++) :
        $page_num = $i + 1;
        $give_active_to_first = $is_first_page && $i === 0;
        $give_active_to_other = $page_num === $requested_page;
      ?>
        <li <?php echo $give_active_to_first || $give_active_to_other ? 'class="active"' : null; ?>>
          <a href="<?php echo site_url() . '/blog?page=' . $page_num; ?>">
            <?php echo $page_num; ?>
          </a>
        </li>
      <?php
      endfor;
      if (!$is_final_page) :
      ?>
        <li>
          <a
            class="k-upcase"
            href="<?php echo site_url() . '/blog?page=' . ($requested_page + 1); ?>"
          >
            &rarr;
          </a>
        </li>
      <?php endif; ?>
      </ul>
    </div>
      
  </div>
</section>

<?php

get_footer();

?>
