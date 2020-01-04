<section class="k-latestbatch k-block k-block--md <?php echo $product_acf['frequently_asked_questions'] ? NULL : 'k-no-padding--bottom' ?>">
  <div class="k-inner k-inner--md">

    <div class="k-latestbatch__intro">
      <div class="k-latestbatch__intro-left">
        <figure class="k-figure">
          <div class="k-figure--liner">
            <img class="k-figure--img" data-src="<?php echo $root.'/dist/img/lab-results-detail.jpg'; ?>" alt="Every batch of Koi CBD is tested multiple times during production to ensure quality.">
          </div>
        </figure>
      </div>
      <div class="k-latestbatch__intro-right">
        <div class="k-latestbatch--title">
          <h2 class="k-headline k-headline--sm">Every batch of Koi CBD is tested multiple times during production to ensure quality.</h2>
        </div>
        <div class="k-latestbatch__description k-rte-content">
          <p>Knowing that your CBD product meets high quality standards, from potency to purity, is important. At Koi, we use independent, accredited labs to test our USA-grown hemp extracts. These extracts are then infused into our products which are tested multiple times throughout the manufacturing process. We maintain transparency of our product quality by making all test results publicly available.</p>
        </div>
        <div class="k-latestbatch__icon-row">
          <div class="k-latestbatch__icon">
            <div class="k-latestbatch__icon-image">
              <figure class="k-figure">
                <div class="k-figure--liner">
                  <img class="k-figure--img" data-src="https://via.placeholder.com/350" alt="Tested by a 3rd Party">
                </div>
              </figure>
            </div>
            <div class="k-latestbatch__icon-description">
              <div class="k-latestbatch__icon-title">
                <p class="k-weight--lg">Tested by a 3<sup>rd</sup> Party Lab</p>
              </div>
              <div class="k-latestbatch__icon-text">
                <p class="k-rte-content">Our testing labs are all ISO accredited to assure high quality results of full-panel tests.</p>
              </div>
            </div>
          </div>
          <div class="k-latestbatch__icon">
            <div class="k-latestbatch__icon-image">
              <figure class="k-figure">
                <div class="k-figure--liner">
                  <img class="k-figure--img" data-src="https://via.placeholder.com/350" alt="Tested for Potency">
                </div>
              </figure>
            </div>
            <div class="k-latestbatch__icon-description">
              <div class="k-latestbatch__icon-title">
                <p class="k-weight--lg">Tested for Potency</p>
              </div>
              <div class="k-latestbatch__icon-text">
                <p class="k-rte-content">We obtain detailed phytocannabinoid and terpenoid profiles for every product, ensuring no detectable levels of THC (&lt;0.001%).</p>
              </div>
            </div>
          </div>
          <div class="k-latestbatch__icon">
            <div class="k-latestbatch__icon-image">
              <figure class="k-figure">
                <div class="k-figure--liner">
                  <img class="k-figure--img" data-src="https://via.placeholder.com/350" alt="Tested for Purity">
                </div>
              </figure>
            </div>
            <div class="k-latestbatch__icon-description">
              <div class="k-latestbatch__icon-title">
                <p class="k-weight--lg">Tested for Purity</p>
              </div>
              <div class="k-latestbatch__icon-text">
                <p class="k-rte-content">Our products pass testing for more than 100 different contaminants including pesticides, solvents, and heavy metals.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="k-latestbatch--main">
      <?php if ($product_wc_type == 'variable') : ?>
      <nav class="k-latestbatch--tabs">
      <?php
      foreach($product->get_available_variations() as $i => $variant) :
        $_variant = wc_get_product($variant['variation_id']);
        $attributes = $_variant->get_variation_attributes();
        $this_attribute = formatAttrName(reset($attributes));
        $sku = $_variant->get_sku();
      ?>
        <div class="k-latestbatch--tabs__tab <?php echo $i == 0 ? 'active' : '' ?>" data-product-sku="<?php echo $sku; ?>">
          <?php if ($has_flavor_attribute) : ?>
          <span>
            <?php echo $attributes['attribute_flavor']; ?>
          </span>
          <?php endif; ?>
          <span class="k-latestbatch__variant-name"><?php echo $this_attribute . ($attributes['attribute_quantity'] ? ' (' . $attributes['attribute_quantity'] . ')' : null); ?></span>
        </div>
      <?php endforeach; ?>
      </nav>
      <?php elseif ($product_wc_type == 'simple'): ?>
        <div class="k-latestbatch--tabs__tab active" data-product-sku="<?php echo $product->sku ?>">
          <span class="k-latestbatch__variant-name"><?php echo $product->name; ?></span>
        </div>
      <?php elseif ($product_wc_type == 'bundle'): ?>
        <nav class="k-latestbatch--tabs">
          <?php
          $bundled_items = $product->get_bundled_items();  
          $bundled_item_key = 0;
          foreach($bundled_items as $bundled_item_key => $bundled_item):
            $parent_id = $product->get_id();
            $parent_name = $product->get_name();
            $wc_bundled_product = wc_get_product($bundled_item->get_data()['product_id']);
            $variations = $wc_bundled_product->get_available_variations();
            $discount_amount = $bundled_item->get_data()['discount'] / 100;
            $bundled_item_name = $wc_bundled_product->get_name();
          ?>
            <?php foreach($variations as $variant): ?>
              <div class="k-latestbatch--tabs__tab <?php echo $counter == 0 ? 'active' : '' ?>" data-product-sku="<?php echo $variant['sku']; ?>">
                <?php $exploded_name = explode(' | ', $wc_bundled_product->name); ?>
                <?php $last_string = count($exploded_name) - 1;?>
                <span class="k-latestbatch__variant-name">
                  <?php echo explode(' | ', $wc_bundled_product->name)[$last_string];?>
                </span>
                <span class="k-latestbatch__variant-name">
                  <?php echo $variant['attributes']['attribute_strength'] ? $variant['attributes']['attribute_strength'] : $variant['attributes']['attribute_pa_strength']; ?>
                </span>
              </div>
              <?php $counter++; ?>
            <?php endforeach; ?>
          <?php endforeach; ?>
        </nav>
      <?php endif; ?>
      <div class="k-latestbatch__results">
        <div class="k-latestbatch__results-liner">
          <div class="k-latestbatch__results-column">
            <?php if ($product_wc_type != 'simple'): ?>
            <div>
              <p class="k-headline k-headline--sm"><?php echo get_the_title(); ?></p>
            </div>
            <?php endif; ?>
          </div>

          <div class="k-latestbatch__results-column">
            <div>
              <p class="k-latestbatch--strength">Strength: <span class="k-latestbatch__variant-render-target">250 MG</span></p>
              <p class="k-latestbatch--size">Size: <span><?php the_field('unit', get_the_ID()); ?></span></p>
              <p class="k-latestbatch--batch">Batch #: <span id="k-batchid" class="k-upcase k-latestbatch--strength">8296NLL250</span></p>
            </div>
          </div>
          <?php $url = site_url(); ?>
          <div class="k-latestbatch__results-column">
            <a id="k-coaurl" class="k-weight--lg" href="#0" target="_blank" rel="noopener noreferrer">View this product's<br>Certificate of Analysis (COA)</a>
            <a class="k-accent-text" href="<?php echo $url . '/lab-results' ?>">Looking for other product lab results? Click Here.</a>
          </div>

        </div>
      </div>
    </div>

  </div>
</section>