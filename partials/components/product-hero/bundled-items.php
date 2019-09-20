<?php
$min_items = get_post_meta($product->get_ID(), '_wcpb_min_qty_limit')[0];
$max_items = get_post_meta($product->get_ID(), '_wcpb_max_qty_limit')[0];
?>

<div
  class="k-productform--item k-productform--bundleselect"
  data-min-items="<?php echo $min_items; ?>"
  data-max-items="<?php echo $max_items; ?>"
>
  <p>Select <?php echo $max_items; ?>:</p>

  <?php

  // var_dump($product->get_bundle_regular_price());
  // var_dump(get_class_methods($product));

  $item_index = 0;

  foreach($product->get_bundled_items() as $bundled_product) { 
    $this_product = $bundled_product->product;
    $id = $this_product->get_id();
    $name = $this_product->get_name();
    $bundled_variants = $this_product->get_available_variations();
  ?>
    <div class="k-productform--bundleselect__item">

      <input class="k-productform--select-bundled-item" type="checkbox" name="<?php echo 'product-id|'.$id; ?>" id="<?php echo 'product-id|'.$id; ?>" />
      <label for="<?php echo 'product-id|'.$id; ?>">
        <span><?php echo $name; ?></span>
      </label>

      <div class="k-productform--bundleselect__item--drawer">
        <div class="k-productform--bundleselect__item--flex">
        <?php
        
        $variant_index = 0; // this is to keep the individual inputs in the inner loop unique
        
        foreach($bundled_variants as $variant) {
          $price = $variant['display_price'];
          $strength;

          if ($variant['attributes']['attribute_strength']) {
            $strength = $variant['attributes']['attribute_strength'];
          } else {
            $strength = $variant['attributes']['attribute_pa_strength'];
          } ?>
          <div class="k-productform--bundleselect__variant">
            <input
              type="radio"
              name="<?php echo 'variant-select|'.$id; ?>"
              id="<?php echo 'bundled-item-variant-'.$item_index.'-'.$variant_index; ?>"
              value="<?php echo $strength; ?>"
            />
            <label
              for="<?php echo 'bundled-item-variant-'.$item_index.'-'.$variant_index; ?>"
              class="k-productform--varianttoggle"
              data-product-price="<?php echo $variant['display_price']; ?>"
              data-product-strength="<?php echo $strength; ?>"
            >
              <span><?php echo $strength; ?></span>
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