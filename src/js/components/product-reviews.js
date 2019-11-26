import axios from 'axios';
import { $doc, $reviewModal, $backdrop } from '../global/selectors';
import ProductReview from '../helpers/ProductReview';

$doc.ready(() => {
  const renderTarget = document.querySelector(
    '.k-productreviews__render-target'
  );

  const productStore = document.querySelector('.k-producthero');
  // const sku = document.querySelector('.k-producthero').dataset.productSku;
  const sku = productStore.dataset.productSku;
  const productTitle = productStore.dataset.productTitle;

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
          sku,
          productTitle,
        };

        renderReviews(opts);
      } else {
        renderTarget.innerHTML = noReviews(sku, productTitle);
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

function noReviews(sku, title) {
  const markup = /*html*/ `
      <p>None yet! Be the first to <a href="#0" class="k-createreview">leave a review.</a></p>    
    `;
  return markup;
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

function renderReviews(opts) {
  const { reviews, baseUrl, appId, renderTarget, sku, productTitle } = opts;

  reviews.forEach((review, index) => {
    /*
      Some products have hundreds of reviews. For now, only render the 10 most recent.
    */
    if (index <= 10) {
      const productReview = new ProductReview({
        baseUrl: baseUrl,
        appId: appId,
        review: review,
        renderTarget: renderTarget,
        voting: true,
        showRating: true,
      });
    }
  });

  appendReviewPrompt(sku, productTitle);
}

function appendReviewPrompt(sku, title) {
  const $reviewContainerLeft = $('.k-productreviews--title');

  const reviewPromptMarkup = /*html*/ `
    <p><a href="#0" class="k-createreview k-upcase" data-product-sku="" data-product-title="">Write a review</a></p>
  `;

  $reviewContainerLeft.append(reviewPromptMarkup);

  appendModalListeners(sku, title);
}
