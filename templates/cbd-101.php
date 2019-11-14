<?php
/* Template Name: 2019 CBD 101 Landing Page */

/**
 * This template just lists blog posts tagged w/ the "CBD 101" category.
 * It has its own template because it needs its own URL @ koicbd.com/cbd-101
 */
$_posts;

foreach(get_categories() as $category) :
  if ($category->name == 'CBD 101') :
    $_posts = get_posts(array('cat' => $category->term_id));
  endif;
endforeach;

get_header();
$fields = get_fields();

$hero_fields = array(
  'preheading' => $fields['hero_preheading'],
  'headline' => $fields['hero_heading'],
  'body' => $fields['hero_body'],
  'background_image' => $fields['hero_background_image']['url'],
);
echo k_hero($hero_fields);

// Below is the same exact section as the blog listing, with CTA breaks and everything
?>
<section class="k-bloglist k-block k-block--md">
  <div class="k-inner k-inner--md">
  <?php

    foreach($_posts as $index => $post) {
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

<?php get_footer(); ?>
