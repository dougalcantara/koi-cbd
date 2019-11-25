import axios from 'axios';
import { $doc, $reviewModal, $backdrop } from '../global/selectors';
import ProductReview from '../helpers/ProductReview';

$doc.ready(() => {
  const renderTarget = document.querySelector(
    '.k-productreviews__render-target'
  );

  let reviews;
  const baseUrl = `https://api.yotpo.com`;
  const appId = `MS3VY5Cc4TFD6zbI2zGhMsb9gvkPpQDKwUcPhaSG`; // prod
  // const appId = `AXADc1rXubJYln9af9KlCO2iSAZehe2FIPjdwoVS`; // dev

  if (renderTarget) {
    const productId = renderTarget.dataset.productId;

    getReviews(productId).then(res => {
      reviews = res.data.response.reviews;

      console.log(reviews);

      if (reviews.length > 0) {
        const opts = {
          baseUrl,
          appId,
          renderTarget,
          reviews,
        };

        renderReviews(opts);
      } else {
        renderTarget.innerHTML = noReviews();
        appendModalListeners();
      }
    });
  }

  async function getReviews(id) {
    return axios.get(
      `${baseUrl}/v1/widget/${appId}/products/${id}/reviews.json`
    );
  }
});

function noReviews() {
  const markup = /*html*/ `
      <p>None yet! Be the first to <a href="#0" class="k-createreview">leave a review.</a></p>    
    `;
  return markup;
}

function appendModalListeners() {
  const $titleTarget = $reviewModal.find('.k-review__producttitle span');
  const $reviewModalForm = $reviewModal.find('.k-form--review');
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
}

function renderReviews(opts) {
  const { reviews, baseUrl, appId, renderTarget } = opts;

  reviews.forEach(review => {
    const productReview = new ProductReview({
      baseUrl: baseUrl,
      appId: appId,
      review: review,
      renderTarget: renderTarget,
      voting: true,
      showRating: true,
    });
  });
}
