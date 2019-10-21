<?php

/**
 * Article Card
 * 
 * args-
 * 
 * featured_image_url
 * category
 * publish_date
 * title
 * excerpt
 * url
 */
function k_article_card($args) {
  ob_start(); ?>

  <div class="k-articlecard">
    <div class="k-articlecard--liner">

      <a href="<?php echo $args['url']; ?>">
        <figure class="k-figure k-figure--rounded k-tilt">
          <div class="k-figure--liner">
            <img class="k-figure--img" data-src="<?php echo $args['featured_image_url']; ?>" alt="">
          </div>
        </figure>
      </a>

      <div class="k-articlecard--meta">
        <span class="k-upcase"><?php echo $args['category']; ?> &nbsp; | &nbsp; <?php echo $args['publish_date'] ?></span>
      </div>

      <div class="k-articlecard--title">
        <h3 class="k-headline k-headline--xs"><?php echo $args['title']; ?></h3>
      </div>

      <div class="k-articlecard--excerpt k-rte-content">
        <p><?php echo substr($args['excerpt'], 0, 120).'...'; ?></p>
      </div>

      <div class="k-articlecard--action k-rte-content">
        <a href="<?php echo $args['url']; ?>">Read More</a>
      </div>

    </div>
  </div>

  <?php
    $result = ob_get_contents();
    ob_end_clean();
    return $result;
}

?>