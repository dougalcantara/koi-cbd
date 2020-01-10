<?php global $wp; ?>
<section
  class="k-producthero <?php echo $product_wc_type == 'bundle' ? 'k-producthero--bundle' : NULL; ?>"
  data-yotpo-product-id="<?php echo $product_id ?>"
  data-min-items="<?php echo $min_items; ?>"
  data-product-sku="<?php echo $product->get_sku(); ?>"
  data-product-title="<?php echo the_title(); ?>"
>
  <div class="k-inner k-inner--xl">
    <?php
    include(locate_template('partials/components/product-hero/image-gallery.php'));
    ?>
    <div class="k-producthero--details">
      <div class="k-producthero--details__content">
        <div class="k-producthero--titlerow">
          <?php 
          if ($product_category !== 'cbd-oil') : ?>
          <span class="k-producthero--preheading"><?php echo reset($cat_name)->name; ?></span>
          <?php endif; ?>
          
          <h1 class="k-headline k-headline--sm"><?php the_title(); ?></h1>
          
          <div class="k-rte-content">
            <p><?php echo $product->post->post_excerpt; ?></p>
          </div>
          
          <div class="k-producthero--reviews k-reviewembed">
            <p>
              <a
                href="#0"
                class="k-accent-text k-createreview"
                data-product-sku="<?php echo $product->get_sku(); ?>"
                data-product-title="<?php echo $product->get_title(); ?>"
                data-product-url="<?php echo site_url() . '/' . $wp->request; ?>"
              >
                Be the first to review!
              </a>
            </p>
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
          } else {
          if (reset($product->get_category_ids()) == 265 || reset($product->get_category_ids()) == 256) : // CBD Oil/Tincture
            $other_tinctures = wc_get_products(array(
              'post_type' => 'product',
              'product_cat' => $product_category,
            ));
          ?>
          <div class="k-productform--item k-productform__flavorselect">
            <p>Choose flavor:</p>
            <div class="k-productform__flavorselect__main">
              <select>
                <?php // have the current one be the "current selected" option" ?>
                <option selected>&#10003; <?php echo $product->get_name(); ?></option>
                <?php
                foreach($other_tinctures as $idx => $tincture) :
                  $is_visible = $tincture->get_status() !== 'draft';
                  $is_not_bundle = $tincture->get_type() !== 'bundle';
                  $is_not_current = $tincture->get_id() !== $product_id;
                  $is_not_weird_one = $tincture->get_id() !== 30239; // the 60ML variant is not be included in this list

                  $show_tincture = $is_visible && $is_not_bundle && $is_not_current && $is_not_weird_one;

                  if ($show_tincture) : ?>
                    <option data-permalink="<?php echo $tincture->get_permalink(); ?>"><?php echo $tincture->get_name(); ?></option>
                  <?php 
                  endif;
                endforeach; ?>
                </select>
              <span>&#9660;</span>
            </div>
          </div>
          <?php endif; ?>
          <div class="k-productform--item k-productform__desc">
            <span class="k-upcase">Qty</span><span class="k-upcase">Price</span>
          </div>
            <div class="k-productform--item k-productform--quantity">
              <!-- <button id="k-reduce" class="" type="button">-</button> -->
              <input id="k-num-to-add" type="number" value="1" min="1" step="1" />
              <!-- <button id="k-increase" class="" type="button">+</button> -->
            </div>
          <?php
          }
          ?>

            <div class="k-productform--item k-productform--submit">
              <?php
                $out_of_stock = $product->get_stock_status() == 'outofstock'
              ?>
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
                if ($out_of_stock) : ?> disabled
                <?php
                endif;
                if ($product_wc_type == 'simple') : ?> data-product-id="<?php echo $product_id;?>" data-price="<?php echo $product->get_price(); ?>"
                <?php
                endif;
                if ($product_wc_type == 'bundle') : ?> data-bundle-id="<?php echo $product_id; ?>"
                <?php endif; ?>
              >
                <?php
                if ($out_of_stock) : ?> Out Of Stock
                <?php
                else : ?> Add To Cart
                <?php
                endif;
                ?>
              </button>
            </div>

            <div class="k-productform--item k-productform--price">
              <p>
              <?php
                if ($product_wc_type == 'bundle') {
                  /**
                   * Calculate the minimum bundle price by:
                   * 1) Finding out how many items make up this bundle (typically 4 or 5 of the listed items may be selected)
                   * 2) Get the discounted price of each item
                   * 3) Multiply that by the number of items that the bundle can contain
                   * 4) Render that price to the page
                   * 
                   * JS will take over and update the price as the user selects individual items.
                   */
                  $max_items = intval($product_acf['max_items']);
                  $bundled_items = $product->get_bundled_items();
                  $bundle_price = 0;

                  $idx = 0;
                  foreach($bundled_items as $item) :
                    if ($idx < $max_items) {
                      $bundle_price += $item->get_price();
                    }
                    $idx++;
                  endforeach;
                ?>
                  <span class="k-accent-text" id="k-bundle-price-prefix">from</span>
                  <span class="k-productform--pricetarget">$<?php echo $bundle_price; ?></span>
                  <sup>20% off!</sup>
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