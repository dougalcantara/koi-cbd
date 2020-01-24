<div class="k-productform--item k-productform--bundleselect">
  <p>Select <?php echo $max_items; ?>:</p>

  <?php
  $bundled_items = $product->get_bundled_items();

  foreach($bundled_items as $bundled_item_key => $bundled_item) {
    $parent_id = $product->get_id();
    $parent_name = $product->get_name();
    $wc_bundled_product = wc_get_product($bundled_item->get_data()['product_id']);
    $discount_amount = $bundled_item->get_data()['discount'] / 100;
    $bundled_item_name = $wc_bundled_product->get_name();
  ?>
    <div class="k-productform--bundleselect__item" data-discount-amount="<?php echo $discount_amount; ?>">

      <input
        class="k-productform--select-bundled-item"
        type="checkbox"
        id="<?php echo 'product-id|'.$bundled_item_key; ?>"
        data-max-items="<?php echo $max_items; ?>"
        data-parent-id="<?php echo $parent_id; ?>"
        data-bundled-product-key="<?php echo $bundled_item_key; ?>"
        tabindex="-1"
      />
      <label for="<?php echo 'product-id|'.$bundled_item_key; ?>" tabindex="0">
        <span><?php echo $bundled_item_name; ?></span>
      </label>

      <div class="k-productform--bundleselect__item--drawer">
        <div class="k-productform--bundleselect__item--flex">
          <?php
            $allowed_variations = $bundled_item->get_data()['allowed_variations'];
        
            foreach($allowed_variations as $idx => $variant) {
              $_variant = wc_get_product($variant);
              $price = $_variant->get_price();
              $variant_id = $_variant->get_id();
              $attributes = $_variant->get_attributes();
              $this_attribute = reset($attributes);
              $price_with_discount = number_format($price - ($discount_amount * $price), 2);
          ?>
            <div class="k-productform--bundleselect__variant">
              <input
                type="radio"
                id="<?php echo 'bundled-item-variant-'.$idx.'-'.$bundled_item_key; ?>"
                name="<?php echo $bundled_item_key; ?>"
                value="<?php echo $this_attribute; ?>"
                data-parent-id="<?php echo $parent_id; ?>"
                data-bundle-key="<?php echo $bundled_item_key; ?>"
                data-variant-id="<?php echo $variant_id; ?>"
                data-variant-price="<?php echo $price_with_discount; ?>"
                data-full-price="<?php echo $price; ?>"
                data-variant-strength="<?php echo $this_attribute; ?>"
                tabindex="-1"
              />
              <label
                for="<?php echo 'bundled-item-variant-'.$idx.'-'.$bundled_item_key; ?>"
                class="k-productform--varianttoggle"
                data-variant-price="<?php echo $price_with_discount; ?>"
                data-full-price="<?php echo $price; ?>"
                data-variant-strength="<?php echo 'strength|'.$this_attribute; ?>"
              >
                <span><?php echo $this_attribute; ?></span>
              </label>
            </div>
          <?php
          }
          ?>
          <div class="k-productform__bundleselect-quantity">
            <div class="k-productform__group">
              <label class="k-weight--md" for="quantity">QTY</label>
              <input
                class="k-bundle-quantity"
                type="number"
                name="quantity"
                step="1"
                min="0"
                max="<?php echo $max_items; ?>"
                value="0"
              >
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php
  }              
  ?>
</div>