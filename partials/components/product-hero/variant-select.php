<p class="k-productform--item k-productform--heading">Select One:</p>
<div class="k-productform--item k-productform--variants">

<?php
function formatAttrName($string) {
  $arr = explode('-', $string);

  foreach($arr as $idx => $str) {
    $arr[$idx] = ucfirst($str);
  }

  return join(' ', $arr);
}

foreach($product->get_available_variations() as $i => $variant) {
  $_variant = wc_get_product($variant['variation_id']);
  $price = $_variant->get_price();
  $variant_id = $_variant->get_id();
  $attributes = $_variant->get_variation_attributes();
  $this_attribute = formatAttrName(reset($attributes));
?>
  <div class="k-productform--variantselect">
    <input
      type="radio"
      name="variant-select"
      id="<?php echo $this_attribute.$i; ?>"
      value="<?php echo $this_attribute; ?>"
      <?php if ($i == 0) { ?> checked <?php } ?>
    />
    <label
      for="<?php echo $this_attribute.$i; ?>"
      class="k-productform--varianttoggle"
      data-variant-id="<?php echo $variant_id; ?>"
      data-variant-price="<?php echo $variant['display_price']; ?>"
    >
      <span><?php echo $this_attribute; ?></span>
    </label>
  </div>
<?php
}
?>
</div>