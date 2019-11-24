import { $doc, $backdrop, $reviewModal } from './selectors';

const $titleTarget = $reviewModal.find('.k-review__producttitle span');
const $reviewModalForm = $reviewModal.find('.k-form--review');
const $reviewModalClose = $reviewModal.find('.k-modal__close');
const $createReviewTriggers = $('.k-createreview');

$createReviewTriggers.click(async function() {
  const $t = $(this);

  const productSku = $t.data('product-sku');
  const productTitle = $t.data('product-title');

  $titleTarget.text(productTitle);

  $backdrop.addClass('active');
  $reviewModal.addClass('k-modal--open');

  $reviewModalForm.attr('data-product-sku', productSku);
  $reviewModalForm.attr('data-product-title', productTitle);
});

$reviewModalForm.submit(async function(e) {
  e.preventDefault();

  const $t = $(this);
  const $parentModal = $t.closest('.k-modal');
  const displayName = $t.find('#k-review-displayname').val();
  const email = $t.find('#k-review-email').val();
  const reviewTitle = $t.find('#k-review-title').val();
  const reviewContent = $t.find('#k-review-content').val();
  const reviewStars = $t
    .find('.k-review__rating')
    .find('input[type=radio]:checked')
    .val();

  $parentModal.addClass('k-modal--submitting');

  $.ajax({
    url: 'https://api.yotpo.com/v1/widget/reviews',
    method: 'POST',
    data: {
      appkey: 'MS3VY5Cc4TFD6zbI2zGhMsb9gvkPpQDKwUcPhaSG',
      domain: 'https://koicbddev.wpengine.com',
      sku: $t.data('product-sku'),
      product_title: $t.data('product-title'),
      product_url: window.location.href,
      display_name: displayName,
      email: email,
      review_title: reviewTitle,
      review_content: reviewContent,
      review_score: reviewStars,
    },
    complete: ({ status }) => {
      $parentModal.removeClass('k-modal--submitting');

      if (status !== 200) {
        return alert('Something went wrong, please try again.');
      } else {
        $parentModal.addClass('k-modal--success');

        setTimeout(function() {
          $parentModal.removeClass('k-modal--open');
          $backdrop.removeClass('active');
        }, 2500);
      }
    },
  });
});

$reviewModalClose.click(function() {
  $backdrop.removeClass('active');
  $reviewModal.removeClass('k-modal--open');
});

$doc.ready(async function() {
  // console.log(access_token);
  // $.ajax({
  //   method: 'POST',
  //   url: 'https://api.yotpo.com/oauth/token',
  //   data: {
  //     client_id: 'MS3VY5Cc4TFD6zbI2zGhMsb9gvkPpQDKwUcPhaSG',
  //     client_secret: 'ilZr8xIWpF82rPMAoaqHS7PH9UYDr3nw8hMFcPPs',
  //     grant_type: 'client_credentials',
  //   },
  //   complete: res => console.log(res),
  // });
});
