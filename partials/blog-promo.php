<section class="k-blogpromo k-block k-block--md">
  <div class="k-inner k-inner--md">
    <div class="k-promoslider--titlerow">
      <span class="k-upcase k-promoslider--titlerow__item">Keep Exploring</span>
      <h2 class="k-headline k-headline--sm k-promoslider--titlerow__item">Read about <?php echo $product_category; ?></h2>
      <a href="#0" class="k-upcase k-promoslider--titlerow__item">View All</a>
    </div>

    <div class="k-blogpromo--articles">
    <?php

    foreach($featured_articles as $article) {
      $_article = $article['article'];
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
