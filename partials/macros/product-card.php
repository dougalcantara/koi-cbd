<?php

function k_product_card($args) {
  ob_start(); ?>
  <div 
    class="k-productcard <?php echo $args['debug_param']; ?>"
    data-review-url="<?php echo $args['product_link']; ?>/#product-reviews"
    <?php echo $args['is_archive'] === true ? null : 'data-yotpo-product-id="' . $args['product_id'] . '"' ?>>
    <div class="k-productcard--liner">

      <a href="<?php echo $args['product_link']; ?>">
        <figure class="k-figure">
          <div class="k-figure--liner">
            <img class="k-figure--img" data-src="<?php echo $args['product_image_url']; ?>" alt="<?php echo $args['product_title']; ?>">
          </div>
        </figure>
      </a>

      <div class="k-productcard--title">
        <h3 class="k-headline k-headline--fake k-weight--lg"><a href="<?php echo $args['product_link']; ?>"><?php echo $args['product_title']; ?></a></h3>
        <p class="k-accent-text k-rte-content"><?php echo $args['product_short_description']; ?></p>
      </div>

      <?php if ($args['product_price']) : ?>
        <div class="k-productcard--price">
          <p><span>From</span> $<?php echo $args['product_price']; ?></p>
        </div>
      <?php endif; ?>

      <div class="k-productcard--action">
        <a href="<?php echo $args['product_link']; ?>" class="k-button k-button--default">Shop Now</a>
      </div>

      <div class="k-productcard--reviews k-reviewembed">

      <?php if ($args['product_total_reviews'] <= 0): ?>
        <p>
          <a href="#0" class="k-accent-text k-createreview">Be the first to review!</a>
        </p>
      <?php else: ?>
        <?php
          $score = $args['product_rating'];
          $decimal_value =  fmod($score, 1);
          $difference = 1 - $decimal_value;
          $translate_value = $difference * 100;
        ?>
        <p class="k-accent-text k-productcard__review-target">
          Reviews(<span class="k-productcard--numreviews"><?php echo $args['product_total_reviews']; ?></span>)
          <a href="<?php echo $args['product_review_link']; ?>" class="k-wraparound-link"></a>
        </p>
        <ul>
          <li class="k-productcard--reviewavg k-accent-text"><?php echo number_format($args['product_rating'], 2, '.', ''); ?></li>
          <li>
            <?php for ($i = 0; $i < $score; $i++): ?>
              <div class="k-goldstar">
                <div class="k-goldstar--liner">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 49.57 47.14" style="transform: translate3d(<?php echo $i + 1 > $score ? -$translate_value : 0; ?>%, 0, 0);">
                    <g id="Layer_2" data-name="Layer 2">
                      <g id="Layer_1-2" data-name="Layer 1">
                        <polygon style="fill: #f4b13e; transform: translate3d(<?php echo $i + 1 > $score ? $translate_value : 0; ?>%, 0, 0);" points="24.78 0 32.44 15.52 49.57 18.01 37.18 30.09 40.1 47.14 24.78 39.09 9.47 47.14 12.39 30.09 0 18.01 17.13 15.52 24.78 0"/>
                      </g>
                    </g>
                  </svg>
                </div>
              </div>               
              <?php endfor; ?>
            </li>
        </ul>
      <?php endif; ?>
      </div>

    </div>
  </div>

  <?php
    $result = ob_get_contents();
    ob_end_clean();
    return $result;
}

?>