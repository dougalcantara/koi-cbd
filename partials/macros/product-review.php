<?php

function k_product_review($review) {
  $created_at = date_format(date_create($review->created_at), 'M j, Y');
  $username = $review->user->display_name;

  ob_start();
  ?>
  <article class="k-review" data-review-id="<?php echo $review->id; ?>">
    <div class="k-review--liner">
      <div class="k-review--title">
        <h3 class="k-weight--lg"><?php echo $review->title; ?></h3>
      </div>
      <div class="k-review--body">
        <p><?php echo $review->content; ?></p>
      </div>
      <div class="k-review--meta">
        <p><?php echo $created_at; ?> - <?php echo $username; ?></p>
      </div>
      <div class="k-review--actions">
        <div class="k-review--actions__item">
          <div class="k-arrow k-arrow--up">
            <div class="k-arrow--liner">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-up-circle">
                <circle cx="12" cy="12" r="10"></circle>
                <polyline points="16 12 12 8 8 12"></polyline>
                <line x1="12" y1="16" x2="12" y2="8"></line>
              </svg>
            </div>
          </div>
          <p class="k-review__upvote-count-target"><?php echo $review->votes_up; ?></p>
        </div>
        <div class="k-review--actions__item">
          <div class="k-arrow k-arrow--down">
            <div class="k-arrow--liner">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-down-circle">
                <circle cx="12" cy="12" r="10"></circle>
                <polyline points="8 12 12 16 16 12"></polyline>
                <line x1="12" y1="8" x2="12" y2="16"></line>
              </svg>
            </div>
          </div>
          <p class="k-review__downvote-count-target"><?php echo $review->votes_down; ?></p>
        </div>
      </div>
    </div>
  </article>
  <?php
    $result = ob_get_contents();
    ob_end_clean();
    return $result;
}
?>