<section class="k-productreviews k-block k-block--md <?php echo $product_acf['frequently_asked_questions'] ? NULL : 'k-no-padding--top' ?>" id="product-reviews">
  <div class="k-inner k-inner--md">

    <div class="k-productreviews--title">
      <h2 class="k-headline k-headline--sm"><?php echo $product->get_name(); ?> Reviews</h2>
    </div>

    <div class="k-productreviews--main">
    <?php
      $request = wp_remote_get('https://api.yotpo.com/v1/widget/MS3VY5Cc4TFD6zbI2zGhMsb9gvkPpQDKwUcPhaSG/products/'.$product_id.'/reviews.json');
      $reviews = json_decode($request['body'])->response->reviews;

      if (!count($reviews)) : ?>
        <p>None yet! Be the first to <a href="#0" class="k-createreview">leave a review.</a></p>
      <?php
      else :
        foreach($reviews as $review) :
          $review_date = date_format(date_create(explode('T', $review->created_at)[0]), 'F d, Y'); ?>
  
          <article class="k-review">
            <div class="k-review--liner">
              <div class="k-review--title">
                <h3 class="k-weight--lg"><?php echo $review->title; ?></h3>
              </div>
              <div class="k-review--body">
                <p><?php echo $review->content; ?></p>
              </div>
              <div class="k-review--meta">
                <p><?php echo $review_date; ?> - <?php echo $review->user->display_name; ?></p>
              </div>
              <div class="k-review--actions">
                <div class="k-review--actions__item">
                  <?php get_template_part('partials/svg/arrow-up'); ?>
                  <p><?php echo $review->votes_up; ?></p>
                </div>
                <div class="k-review--actions__item">
                  <?php get_template_part('partials/svg/arrow-down'); ?>
                  <p><?php echo $review->votes_down; ?></p>
                </div>
              </div>
            </div>
          </article>
      <?php
        endforeach;
      endif;
      ?>
    </div>
  </div>
</section>