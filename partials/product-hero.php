<section class="k-producthero" data-yotpo-product-id="<?php echo $product_id ?>">
  <div class="k-inner k-inner--xl">
    <?php
    include(locate_template('partials/components/product-hero/image-gallery.php'));
    ?>
    <div class="k-producthero--details">
      <div class="k-producthero--details__content">
        <div class="k-producthero--titlerow">
          <span class="k-producthero--preheading"><?php echo $product_category; ?></span>
          
          <h1 class="k-headline k-headline--sm"><?php the_title(); ?></h1>
          
          <div class="k-rte-content">
            <p><?php echo strip_tags(get_the_excerpt()); ?></p>
          </div>
          
          <div class="k-producthero--reviews">
            <p>
              <a href="#product-reviews">Reviews (<span class="k-productcard--numreviews">0</span>) </a>
              <span class="k-productcard--reviewavg ">5.0</span>
            </p>
            <?php get_template_part('partials/svg/gold-star'); ?>
          </div>

        </div>

        <form
          class="k-productform <?php echo $product_wc_type == 'bundle' ? 'k-productform--bundle' : '' ?>"
          data-product-id="<?php echo $product_id; ?>"
          data-min-items="<?php echo $min_items; ?>"
          data-max-items="<?php echo $max_items; ?>"
        >
          <div class="k-productform--liner">
          <?php

          if ($product_wc_type == 'variable') {
            include(locate_template('partials/components/product-hero/variant-select.php'));
          }

          if ($product_wc_type == 'bundle') {
            include(locate_template('partials/components/product-hero/bundled-items.php'));
          } else { ?>
            <div class="k-productform--item k-productform--quantity">
              <button id="k-reduce" type="button">-</button>
              <input id="k-num-to-add" type="number" value="1" max="10" min="1" step="1" />
              <button id="k-increase" type="button">+</button>
            </div>
          <?php
          }
          ?>

            <div class="k-productform--item k-productform--submit">
              <button
                type="submit"
                class="
                  k-button
                  k-button--primary
                  <?php 
                  echo $product_wc_type == 'bundle' ? 'k-add-to-cart--bundle' : 'k-add-to-cart';
                  ?>
                "
              <?php
              if ($product_wc_type == 'simple') { ?>
                data-product-id="<?php echo $product_id; ?>"
              <?php
              }

              if ($product_wc_type == 'bundle') { ?>
                data-bundle-id="<?php echo $product_id; ?>"
              <?php
              } else { // this will get populated by JS since it's based off the selected variation (strength) ?>
                data-product-id=""
              <?php
              }
              ?>
              >
                Buy Now &rarr;
              </button>
            </div>

            <div class="k-productform--item k-productform--price">
              <p>
              <?php
                if ($product_wc_type == 'bundle') { ?>
                  <span class="k-productform--pricetarget">$<?php echo $product->get_bundle_price(); ?><sup>was $<?php echo $product->get_bundle_regular_price(); ?></sup></span>
                <?php
                } else { ?>
                  <span class="k-productform--pricetarget">$<?php echo $product->get_price(); ?></span>
                <?php
                }
                ?>
              </p>
            </div>

          </div>
        </form>

      </div>
      
    </div>
  </div>
</section>