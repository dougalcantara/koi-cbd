<?php

function k_product_card($args) {
  ob_start(); ?>

  <div class="k-productcard" data-yotpo-product-id="<?php echo $args['product_id']; ?>">
    <div class="k-productcard--liner">

      <figure class="k-figure">
        <div class="k-figure--liner">
          <img class="k-figure--img" data-src="<?php echo $args['product_image_url']; ?>" alt="">
        </div>
      </figure>

      <div class="k-productcard--title">
        <h3 class="k-headline k-headline--fake k-weight--lg"><?php echo $args['product_title']; ?></h3>
        <p class="k-accent-text">Blue Raspberry. Vape it in & balance out.</p>
      </div>

      <div class="k-productcard--action">
        <a href="<?php echo $args['product_link']; ?>" class="k-button k-button--default">Shop Now</a>
      </div>

      <div class="k-productcard--reviews">
        <p class="k-accent-text">Reviews (<span class="k-productcard--numreviews">0</span>)</p>
        <ul>
          <li class="k-productcard--reviewavg k-accent-text">5</li>
          <li><?php get_template_part('partials/svg/gold-star'); ?></li>
        </ul>
      </div>

    </div>
  </div>

  <?php
    $result = ob_get_contents();
    ob_end_clean();
    return $result;
}

?>