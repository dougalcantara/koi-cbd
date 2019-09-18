<section
  class="k-producthero k-headermargin"
  data-yotpo-product-id="<?php echo $product_id ?>"
>
  <div class="k-inner k-inner--xl">
    <?php
    include(locate_template('partials/components/product-hero/image-gallery.php'));
    ?>
    <div class="k-producthero--details">
      <div class="k-producthero--details__content">
        <div class="k-producthero--titlerow">
          <span class="k-producthero--preheading"><?php echo $product_type; ?></span>
          
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

        <form class="k-productform <?php echo $all_bundled_items ? 'k-productform--bundle' : '' ?>">
          <div class="k-productform--liner">
          <?php

          if ($all_variants) {
            include(locate_template('partials/components/product-hero/variant-select.php'));
          }

          if ($all_bundled_items) {
            include(locate_template('partials/components/product-hero/bundled-items.php'));
          } else { ?>
            <div class="k-productform--item k-productform--quantity">
              <button id="k-reduce">-</button>
              <input id="k-num-to-add" type="number" value="1" />
              <button id="k-increase">+</button>
            </div>
          <?php
          }
          ?>

            <div class="k-productform--item k-productform--submit">
              <button
                type="submit"
                class="k-button k-button--primary k-add-to-cart"
              <?php
              if (get_class($product) !== 'WC_Product_Variable') { ?>
                data-purchase-id="<?php echo $product_id; ?>"
              <?php
              } else { // this will get populated by JS since it's based off the selected variation (strength) ?>
                data-purchase-id=""
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
              if ($product->regular_price != $product->$price) { ?>
                $<span class="k-productform--pricetarget"><?php echo $product->price; ?><sup>was <?php echo $product->regular_price; ?></sup></span>
              <?php
              } else { ?>
                $<span class="k-productform--pricetarget"><?php echo $product->price; ?></span>
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