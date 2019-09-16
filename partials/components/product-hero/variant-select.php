<p class="k-productform--item k-productform--heading">Strength</p>
  <div class="k-productform--item k-productform--variants">
  <?php
  $i = 0; // index needed to make the first variant `checked` by default
  foreach($all_variants as $variant) {
    $price = $variant['display_price'];
    $strength;

    if ($variant['attributes']['attribute_strength']) {
      // some products have attributes attached differently
      $strength = $variant['attributes']['attribute_strength'];
    } else {
      $strength = $variant['attributes']['attribute_pa_strength'];
    }
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