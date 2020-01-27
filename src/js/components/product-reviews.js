import $ from 'jquery';
import {
  html,
  $doc,
  $body,
  $reviewModal,
  $backdrop,
} from '../global/selectors';
import ProductReview from '../helpers/ProductReview';
import preventScrollOnDrag from '../helpers/FlickityEvents';

$doc.ready(() => {
  const productStore = document.querySelector('.k-productreviews');
  if (!productStore) return;

  const sku = productStore.dataset.productSku;
  const productTitle = productStore.dataset.productTitle;

  const $reviewScrollTarget = $('#product-reviews');
  const $reviewsContainer = $('.k-productreviews__render-target');
  const $prev = $('.k-productreviews__prev');
  const $next = $('.k-productreviews__next');

  window.__reviewsCarousel = new Flickity($reviewsContainer[0], {
    cellSelector: '.k-review-container',
    adaptiveHeight: true,
    pageDots: false,
    imagesLoaded: true,
    draggable: false,
    prevNextButtons: false,
  });
  preventScrollOnDrag(window.__reviewsCarousel);
  checkSelectedSlide(window.__reviewsCarousel, $prev, $next);

  const baseUrl = `https://api.yotpo.com`;
  const appId = `MS3VY5Cc4TFD6zbI2zGhMsb9gvkPpQDKwUcPhaSG`; // prod
  // const appId = `AXADc1rXubJYln9af9KlCO2iSAZehe2FIPjdwoVS`; // dev

  const allReviews = document.querySelectorAll('.k-review');
  // this will act as our 'subscription' store.
  window.__reviewsLoaded = [];
  allReviews.forEach(review => {
    const productReview = new ProductReview({
      id: review.dataset.reviewId,
      baseUrl,
      appId,
      sku,
      productTitle,
      review,
      score: parseInt(review.dataset.score),
      votesUp: parseInt(review.dataset.votesUp),
      votesDown: parseInt(review.dataset.votesDown),
      voting: true,
      showRating: true,
    });
  });

  observeReviews(allReviews, window.__reviewsLoaded);
  appendModalListeners(sku, productTitle);

  $prev.click(function() {
    window.__reviewsCarousel.previous(false, true);
    scrollToTarget($reviewScrollTarget);
    checkSelectedSlide(window.__reviewsCarousel, $prev, $next);
  });

  $next.click(function() {
    window.__reviewsCarousel.next(false, true);
    scrollToTarget($reviewScrollTarget);
    checkSelectedSlide(window.__reviewsCarousel, $prev, $next);
  });
});

function observeReviews(allReviews, subscription) {
  /*
    These ProductReviews need to be observed since the flickity instance
    needs to be resized after the markup for their review score is inserted.
    This changes their height, making the flickity cell larger, causing an
    overflow. When all the reviews have been pushed to the subscription,
    they are "complete", in the sense that their additional markup has been
    inserted into the DOM.
  */
  const allReviewsLoaded = setInterval(() => {
    if (subscription.length === allReviews.length) {
      window.__reviewsCarousel.resize();
      clearInterval(allReviewsLoaded);
    }
  }, 100);
}

function scrollToTarget($target) {
  html.animate(
    {
      scrollTop: $target.offset().top,
    },
    50
  );
}

function checkSelectedSlide(flkty, $prev, $next) {
  if (flkty.selectedIndex === 0) {
    $prev.addClass('inactive');
  } else if (flkty.selectedIndex === flkty.cells.length - 1) {
    $next.addClass('inactive');
  } else {
    $prev.removeClass('inactive');
    $next.removeClass('inactive');
  }

  if (flkty.cells.length === 1) {
    $prev.addClass('inactive');
    $next.addClass('inactive');
  }
}

function appendModalListeners(sku, title) {
  const $titleTarget = $reviewModal.find('.k-review__producttitle span');
  const $reviewModalForm = $reviewModal.find('.k-form--review');
  const $createReviewTriggers = $('.k-createreview');

  $createReviewTriggers.click(async function() {
    const $t = $(this);

    const productSku = sku;
    const productTitle = title;

    $titleTarget.text(productTitle);

    $backdrop.addClass('active');
    $reviewModal.addClass('k-modal--open');

    $reviewModalForm.attr('data-product-sku', productSku);
    $reviewModalForm.attr('data-product-title', productTitle);
  });
}
