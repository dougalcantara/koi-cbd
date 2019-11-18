<?php

function k_product_card($args) {
  ob_start(); ?>

  <div 
    class="k-productcard"
    <?php echo $args['product_id'] ? 'data-yotpo-product-id="' . $args['product_id'] . '"' : null; ?>>
    <div class="k-productcard--liner">

      <a href="<?php echo $args['product_link']; ?>">
        <figure class="k-figure">
          <div class="k-figure--liner">
            <img class="k-figure--img" data-src="<?php echo $args['product_image_url']; ?>" alt="">
          </div>
        </figure>
      </a>

      <div class="k-productcard--title">
        <h3 class="k-headline k-headline--fake k-weight--lg"><a href="<?php echo $args['product_link']; ?>"><?php echo $args['product_title']; ?></a></h3>
        <p class="k-accent-text k-rte-content"><?php echo $args['product_short_description']; ?></p>
      </div>

      <div class="k-productcard--action">
        <a href="<?php echo $args['product_link']; ?>" class="k-button k-button--default">Shop Now</a>
      </div>

      <div class="k-productcard--reviews k-reviewembed">
        <p>
          <a href="#0" class="k-accent-text k-createreview">Be the first to review!</a>
        </p>
      </div>

    </div>
  </div>

  <?php
    $result = ob_get_contents();
    ob_end_clean();
    return $result;
}

?>