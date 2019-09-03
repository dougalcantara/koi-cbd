<?php

function k_product_card($args) {
  ob_start(); ?>

  <div class="k-productcard">
    <div class="k-productcard--liner">

      <div class="k-figure">
        <div class="k-figure--liner">
          <img src="<?php echo $args['product_image_url'] ?>" alt="">
        </div>
      </div>

      <div class="k-productcard--title">
        <h3>Blue Koi Vape Juice</h3>
        <p class="k-accent-text">Blue Raspberry. Vape it in & balance out.</p>
      </div>

      <div class="k-productcard--action">
        <div class="k-button k-button--default">Buy Now</div>
      </div>

      <div class="k-productcard--reviews">
        <p class="k-accent-text">Reviews (57)</p>
        <ul>
          <?php
          for ($i = 0; $i < 5; $i++) { ?>
            <li><?php get_template_part('partials/gold-star'); ?></li>
          <?php } ?>
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