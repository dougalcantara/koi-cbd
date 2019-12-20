<?php
/**
 * 10/26/19 - 
 * Need to disable the blog & any callouts pointing at the blog. Anything blog related cannot be rendered
 * to any page at all. Update to follow soon.
 * 
 * Commeting out the guts of this module and making it visually hidden is the easiest way to hide this 
 * content without affecting other templates or making content editors pore over every page of the site.

<section class="k-blogpromo k-block k-block--md" style="height: 0; overflow:hidden; padding: 0;">
  <div class="k-inner k-inner--md">
    <div class="k-promoslider--titlerow">
      <span class="k-upcase k-promoslider--titlerow__item">Keep Exploring</span>
      <h2 class="k-headline k-headline--sm k-promoslider--titlerow__item">Read More</h2>
      
    </div>

    <div class="k-blogpromo--articles">
    <?php

    foreach($featured_articles as $article) {
      // accidental inconsitent naming on this in ACF, unfortunately too late to change site-wide
      $_article = $article['article'] ? $article['article'] : $article['post'];
      $id = $_article->ID;

      $article_card_props = array(
        'featured_image_url' => wp_get_attachment_image_src(get_post_thumbnail_id($id), 'large')[0],
        'category' => get_the_category($id)[0]->cat_name,
        'publish_date' => get_the_date('m.d.y', $id),
        'title' => $_article->post_title,
        'excerpt' => $_article->post_excerpt,
        'url' => get_the_permalink($id),
      );

      echo k_article_card($article_card_props);
    }

    ?>
    </div>

  </div>
</section>

 */
?>