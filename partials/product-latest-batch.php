<section class="k-latestbatch k-block k-block--md">
  <div class="k-inner k-inner--md">

    <div class="k-latestbatch--intro">
      <div class="k-latestbatch--title">
        <h2 class="k-headline k-headline--sm">Every Batch of Koi CBD is Thoroughly Tested by Green Scientific Labs&trade;</h2>
      </div>

      <div class="k-latestbatch--description k-rte-content">
        <p>Koi CBD is 100% natural, 99%+ pure CBD manufactured in an ISO Certified Lab, and contains 0% THC. We use only the highest quality ingredients available, but we don't stop there.</p>
        <p>All Koi products are lab-tested for purity, consistency, and safety. Plus, we offer full traceability on every batch of our CBD - from plant to finished product.</p>
        <a href="<?php echo site_url() . '/lab-results'; ?>" class="k-upcase">View All Lab Results</a>
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
      <div class="k-latestbatch--results">
        <div class="k-latestbatch--results__liner">

          <div class="k-latestbatch--results__column">
            <?php if ($product_wc_type != 'simple'): ?>
            <div>
              <p class="k-upcase"><?php echo trim(explode(',', get_the_title())[1]); ?></p>
              <p class="k-upcase k-latestbatch--strength k-latestbatch__variant-render-target">250 MG</p>
            </div>
            <?php endif; ?>
            <div>
              <p class="k-upcase">Batch #</p>
              <p id="k-batchid" class="k-upcase k-latestbatch--strength">8296NLL250</p>
            </div>
          </div>
          <div class="k-latestbatch--results__column">
            <div>
              <p class="k-upcase">8.5MG of CBD / 1ML</p>
              <p class="k-upcase k-latestbatch--strength">(Full dropper / Serving Size)</p>
            </div>
            <div>
              <p class="k-upcase">Approx. 0.42MG of CBD / drop</p>
              <p class="k-upcase k-latestbatch--strength">(Depending on drop size)</p>
            </div>
          </div>
          <div class="k-latestbatch--results__column">
            <p id="k-totalthc" class="k-bigtext"> <span class="k-totalthc__render-target">0.0000</span>% <span class="k-measurement">Total THC</span></p>
            <p id="k-totalcbd" class="k-bigtext"> <span class="k-totalcbd__render-target">249.1979</span>mg/unit <span class="k-measurement">Total CBD</span></p>
          </div>
          <div class="k-latestbatch--results__column">
            <a id="k-coaurl" href="#0" target="_blank" rel="noopener, noreferrer"></a>
            <span>.PDF &darr;</span>
          </div>

        </div>
      </div>
    </div>

  </div>
</section>