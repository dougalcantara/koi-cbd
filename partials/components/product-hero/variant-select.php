<p class="k-productform--item k-productform--heading">Choose CBD strength:</p>
<div class="k-productform--item k-productform--variants">
<?php
$first_available = 0;

foreach($product->get_available_variations() as $i => $variant) {
  $_variant = wc_get_product($variant['variation_id']);
  $price = $_variant->get_price();
  $variant_id = $_variant->get_id();
  $attributes = $_variant->get_variation_attributes();
  $this_attribute = formatAttrName(reset($attributes));
  $out_of_stock = $_variant->get_stock_status() == 'outofstock';
  $has_quantity_attributes = $attributes['attribute_quantity'] != NULL;
  $has_flavor_attribute = $attributes['attribute_flavor'] != NULL;
?>
  <?php if ($first_available == 0 && $out_of_stock == false) {$first_available = $variant;};?>
  <div 
    class="
      k-productform--variantselect
      <?php
        echo $out_of_stock ? 'k-out-of-stock' : NULL;
        echo $has_quantity_attributes ? ' has-quantity' : NULL;
      ?>
    "
    <?php if ($out_of_stock): ?>
    data-out-of-stock="true"
    <?php endif; ?>
    tabindex="0"
  >
  <?php
  if ($has_quantity_attributes) : ?>
    <div class="k-productform--variantselect__badge k-badge k-badge--quantity">
      <div class="k-badge--liner">
        <span><?php echo $attributes['attribute_quantity']; ?></span>
      </div>
    </div>
  <?php
  endif;
  ?>

  <?php
  if ($out_of_stock) : ?>
    <div class="k-productform--variantselect__badge k-badge k-badge--outofstock">
      <div class="k-badge--liner">
        <span>Out Of Stock</span>
      </div>
    </div>
  <?php
  endif;
  ?>
    <input
      type="radio"
      name="variant-select"
      id="<?php echo $this_attribute.$i; ?>"
      value="<?php echo $this_attribute; ?>"
      <?php echo $variant == $first_available ? 'checked' : '' ?>
    />
    <label
      for="<?php echo $this_attribute.$i; ?>"
      class="k-productform--varianttoggle <?php echo $out_of_stock ? 'k-out-of-stock' : NULL; ?>"
      data-variant-id="<?php echo $variant_id; ?>"
      data-variant-price="<?php echo $variant['display_price']; ?>"  
      data-flickityselector="<?php echo $variant['attributes']['attribute_flavor'],$variant['attributes']['attribute_choose'],$variant['attributes']['attribute_strength'],$variant['attributes']['attribute_pa_strength'],$variant['attributes']['attribute_pa_flavor'] ?>"
    >
      <span>
        <?php if ($has_flavor_attribute) : echo $attributes['attribute_flavor']; endif; ?>
        <?php echo $this_attribute; ?>
      </span>
    </label>
  </div>
<?php
}
?>
</div>
