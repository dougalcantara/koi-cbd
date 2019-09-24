<div class="k-productform--item k-productform--bundleselect">
  <p>Select <?php echo $max_items; ?>:</p>

  <?php

  // var_dump($product->get_bundle_regular_price());
  // var_dump(get_class_methods($product));

  $item_index = 0;

  foreach($product->get_bundled_items() as $bundled_product_key => $bundled_product) { 
    $parent_product = $bundled_product->product;
    $parent_id = $parent_product->get_id();
    $parent_name = $parent_product->get_name();
    $bundled_variants = $parent_product->get_available_variations();
  ?>
    <div class="k-productform--bundleselect__item">

      <input
        class="k-productform--select-bundled-item"
        type="checkbox"
        name="<?php echo 'product-id|'.$parent_id; ?>"
        id="<?php echo 'product-id|'.$parent_id; ?>"
        data-max-items="<?php echo $max_items; ?>"
        data-parent-id="<?php echo $parent_id; ?>"
        data-bundled-product-key="<?php echo $bundled_product_key; ?>"
      />
      <label for="<?php echo 'product-id|'.$parent_id; ?>">
        <span><?php echo $parent_name; ?></span>
      </label>

      <div class="k-productform--bundleselect__item--drawer">
        <div class="k-productform--bundleselect__item--flex">
        <?php
        
        $variant_index = 0; // this is to keep the individual inputs in the inner loop unique
        
        foreach($bundled_variants as $variant) {
          $_variant = wc_get_product($variant['variation_id']);
          $price = $_variant->get_price();
          $variant_id = $_variant->get_id();
          $attributes = $_variant->get_attributes();
        ?>
          <div class="k-productform--bundleselect__variant">
            <input
              type="radio"
              name="<?php echo 'variant-select|'.$parent_id; ?>"
              id="<?php echo 'bundled-item-variant-'.$item_index.'-'.$variant_index; ?>"
              value="<?php echo $attributes['strength']; ?>"
              data-variant-id="<?php echo $variant_id; ?>"
              data-variant-strength="<?php echo $attributes['strength']; ?>"
            />
            <label
              for="<?php echo 'bundled-item-variant-'.$item_index.'-'.$variant_index; ?>"
              class="k-productform--varianttoggle"
              data-variant-price="<?php echo $price; ?>"
              data-variant-strength="<?php echo 'strength|'.$attributes['strength']; ?>"
            >
              <span><?php echo $attributes['strength']; ?></span>
            </label>
          </div>

          <?php
            $variant_index++;
          }
          ?>
        </div>
      </div>
    </div>
  <?php
  $item_index++;
  }              
  ?>
</div>