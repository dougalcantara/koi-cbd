<p class="k-productform--item k-productform--heading">Strength</p>
  <div class="k-productform--item k-productform--variants">

  <?php

  $i = 0; // index needed to make the first variant `checked` by default

  foreach($all_variants as $variant) {
    $price = $variant['display_price'];
    $variant_id = $variant['variation_id'];

    if ($variant['attributes']['attribute_strength']) {
      // some products have the "strength" attribute attached differently
      $strength = $variant['attributes']['attribute_strength'];
    } else {
      $strength = $variant['attributes']['attribute_pa_strength'];
    }

    // lotions have variations as well
    if ($variant['attributes']['attribute_choose']) {
      $scent = $variant['attributes']['attribute_choose'];
    }
  ?>
    <div class="k-productform--variantselect">
      <?php 
      // if this product has "strength" options, render those
      if ($strength) { ?>
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
          data-variant-id="<?php echo $variant_id; ?>"
          data-variant-price="<?php echo $variant['display_price']; ?>"
        >
          <span><?php echo $strength; ?></span>
        </label>
      <?php
      // otherwise, this is a lotion, so render the "scents" instead of the "strengths"
      } else { ?>
        <input
          type="radio"
          name="variant-select"
          id="<?php echo $scent.$i; ?>"
          value="<?php echo $scent; ?>"
          <?php if ($i == 0) { ?> checked <?php } ?>
        />
        <label
          for="<?php echo $scent.$i; ?>"
          class="k-productform--varianttoggle"
          data-variant-id="<?php echo $variant_id; ?>"
          data-variant-price="<?php echo $variant['display_price']; ?>"
        >
          <span><?php echo $scent; ?></span>
        </label>
      <?php
      }
      ?>

    </div>
  <?php
    $i++;
  }
  ?>
</div>