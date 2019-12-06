<section class="k-productreviews k-block k-block--md" id="product-reviews">
  <div class="k-inner k-inner--md">

    <div class="k-productreviews--title">
      <h2 class="k-headline k-headline--sm"><?php echo $product->get_name(); ?> Reviews</h2>
    </div>

    <div class="k-productreviews--main k-productreviews__render-target" data-product-id="<?php echo $product_id; ?>">
    <?php
    $num_per_page = 10;
    $req_url = 'https://api.yotpo.com/v1/widget/MS3VY5Cc4TFD6zbI2zGhMsb9gvkPpQDKwUcPhaSG/products/' . $product_id . '/reviews.json?per_page=150';
    $reviews_response = wp_remote_get($req_url);

    if (!is_wp_error($reviews_response)) :
      $to_json = json_decode($reviews_response['body'])->response;
      $first_page_reviews = $to_json->reviews;
      $pagination_meta = $to_json->pagination;
      $total_reviews = $pagination_meta->total;

      foreach($first_page_reviews as $index=>$review) :
        if ($index % 10 == 0) {
          if ($index != 0) {
            echo '</div>';
          }
          echo '<div class="k-review-container">';
          echo k_product_review($review, $index);
        } else if ($index == count($first_page_reviews) - 1){
          echo '</div>';
        } else {
          echo k_product_review($review, $index);          
        }
      endforeach; ?>
    <?php else : ?>
      <p>None yet! Be the first to <a href="#0" class="k-createreview">leave a review.</a></p>
    <?php
    endif; ?>
    </div>
    <div class="k-productreviews__controls">
      <div class="k-productreviews__create"><span class="k-upcase k-createreview">Write A Review</span></div>
      <div><span class="k-productreviews__prev k-upcase">Previous</span></div>
      <div><span class="k-productreviews__next k-upcase">Next</span></div>
    </div>
  </div>
</section>