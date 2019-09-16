<div class="k-producthero--gallery">
<?php
if ($all_variants) {
  foreach($all_variants as $variant) { ?>
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
<?php
} else if ($all_image_ids) {
  foreach($all_image_ids as $image_id) { ?>
    <div class="k-producthero--slide">
      <div class="k-figure">
        <div class="k-figure--liner">
          <img src="<?php echo wp_get_attachment_url($image_id) ?>" alt="" class="k-figure--img" />
        </div>
      </div>
    </div>
  <?php
  }
} else { // in case there's a sole image for the product, and it's the Post's Featured Image ?>
  <div class="k-producthero--slide">
    <div class="k-figure">
      <div class="k-figure--liner">
        <img src="<?php echo get_the_post_thumbnail_url($product->ID)?>" alt="" class="k-figure--img" />
      </div>
    </div>
  </div>
<?php
}
?>
</div>