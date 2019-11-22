<section class="k-productreviews k-block k-block--md <?php echo $product_acf['frequently_asked_questions'] ? NULL : 'k-no-padding--top' ?>" id="product-reviews">
  <div class="k-inner k-inner--md">

    <div class="k-productreviews--title">
      <h2 class="k-headline k-headline--sm"><?php echo $product->get_name(); ?> Reviews</h2>
    </div>

    <div class="k-productreviews--main k-productreviews__render-target" data-product-id="<?php echo $product_id; ?>">
      <!-- reviews will be rendered here -->
    </div>
  </div>
</section>