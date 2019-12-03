<section class="k-productreviews k-block k-block--md <?php echo $product_acf['frequently_asked_questions'] ? NULL : 'k-no-padding--top' ?>" id="product-reviews">
  <div class="k-inner k-inner--md">

    <div class="k-productreviews--title">
      <h2 class="k-headline k-headline--sm"><?php echo $product->get_name(); ?> Reviews</h2>
    </div>

    <div class="k-productreviews--main k-productreviews__render-target" data-product-id="<?php echo $product_id; ?>">
    <?php
    $num_per_page = 10;
    $req_url = 'https://api.yotpo.com/v1/widget/MS3VY5Cc4TFD6zbI2zGhMsb9gvkPpQDKwUcPhaSG/products/' . $product_id . '/reviews.json?per_page=' . $num_per_page . '&sort=rating';
    $reviews_response = wp_remote_get($req_url);

    if (!is_wp_error($reviews_response)) :
      $to_json = json_decode($reviews_response['body'])->response;
      $first_page_reviews = $to_json->reviews;
      $pagination_meta = $to_json->pagination;
      $total_reviews = $pagination_meta->total;
    
      foreach($first_page_reviews as $review) :
        echo k_product_review($review);
      endforeach; ?>

      <ul class="k-productreviews__pagination">
      <?php
      for ($i = 0; $i < $total_reviews; $i += 10) :
        $page_num = substr($i, 0, 1) + 1; ?>

        <li class="<?php echo $i == 0 ? 'active' : NULL; ?>">
          <a href="#reviews_page=<?php echo $page_num; ?>"><?php echo $page_num; ?></a>
        </li>
      <?php endfor; ?>
      </ul>
    <?php else : ?>
      <p>None yet! Be the first to <a href="#0" class="k-createreview">leave a review.</a></p>
    <?php
    endif; ?>
    </div>
  </div>
</section>