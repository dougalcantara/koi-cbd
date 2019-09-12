<?php
  $root = get_template_directory_uri();
  $all_variants = $product->get_available_variations();
  $product_category = get_the_terms($product->get_id(), 'product_cat')[0]->name;
?>

<section class="k-producthero k-headermargin" data-yotpo-product-id="<?php echo $post->ID ?>">
  <div class="k-inner k-inner--xl">
    <div class="k-producthero--gallery">
      <?php
      foreach($all_variants as $variant) {
      ?>
        <div class="k-producthero--slide">
          <div class="k-figure">
            <div class="k-figure--liner">
              <img src="<?php echo $variant['image']['url'] ?>" alt="" class="k-figure--img" />
            </div>
          </div>
        </div>
      <?php
      }
      ?>
      
    </div>
    <div class="k-producthero--details">
      <div class="k-producthero--details__content">
        <div class="k-producthero--titlerow">
          <span class="k-producthero--preheading"><?php echo $product_category ?></span>
          
          <h1 class="k-headline k-headline--sm"><?php the_title(); ?></h1>
          
          <div class="k-rte-content">
            <p><?php echo strip_tags(get_the_excerpt()); ?></p>
          </div>
          
          <p>Reviews (<span class="k-productcard--numreviews">0</span>) <span class="k-productcard--reviewavg ">5.0</span> <?php get_template_part('partials/svg/gold-star'); ?></p>
        </div>

        <form class="k-productform">
          <div class="k-productform--liner">
            <div class="k-productform--item k-productform--variants">
              <p>Strength</p>
              <?php
              $i = 0;
              foreach($all_variants as $variant) {
                $price = $variant['display_price'];
                $strength = $variant['attributes']['attribute_strength'];
              ?>
                <div class="k-productform--variantselect">
                  <input
                    type="radio"
                    name="variant-select"
                    id="<?php echo $strength.$i; ?>"
                    value="<?php echo $strength; ?>"
                    <?php if ($i == 0) { ?> checked <?php } ?>
                  />
                  <label
                    for="<?php echo $strength.$i; ?>"
                    class="k-productform--varianttoggle"
                    data-product-price="<?php echo $variant['display_price']; ?>"
                    data-product-strength="<?php echo $strength; ?>"
                  >
                    <span><?php echo $strength; ?></span>
                  </label>
                </div>
              <?php
                $i++;
              }
              ?>
            </div>
            <div class="k-productform--item k-productform--quantity">
              <button id="k-reduce">-</button>
              <input id="k-num-to-add" type="number" value="1" />
              <button id="k-increase">+</button>
            </div>
            <div class="k-productform--item k-productform--submit">
              <button type="submit" class="k-button k-button--primary">Buy Now &rarr;</button>
            </div>
            <div class="k-productform--item k-productform--price">
              <p>$<span class="k-productform--pricetarget"><?php echo $product->price; ?></span></p>
            </div>

          </div>
        </form>
      </div>
      
    </div>
  </div>
</section>