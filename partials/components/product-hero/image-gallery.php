<div class="k-producthero--gallery">
<?php
if ($product_wc_type == 'variable') {
  foreach($product->get_available_variations() as $variant) { ?>
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
} else if ($product_wc_type == 'simple') {
  // foreach($product->get_gallery_image_ids() as $image_id) { ?>
    <div class="k-producthero--slide">
      <div class="k-figure">
        <div class="k-figure--liner">
          <img src="<?php echo wp_get_attachment_image_url($product->get_image_id(), 'large'); ?>" alt="" class="k-figure--img" />
        </div>
      </div>
    </div>
  <?php
  // }
} else { // in case there's a sole image for the product, and it's the Post's Featured Image ?>
  <div class="k-producthero--slide">
    <div class="k-figure">
      <div class="k-figure--liner">
        <img src="<?php echo get_the_post_thumbnail_url($product_id)?>" alt="" class="k-figure--img" />
      </div>
    </div>
  </div>
<?php
}
?>
  <div class="k-producthero__controls">
    <svg class="k-producthero__prev" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
    <svg class="k-producthero__next" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
  </div>
</div>