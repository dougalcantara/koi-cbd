import axios from 'axios';
import { format } from 'date-fns';
import { $doc, $reviewModal, $backdrop } from '../global/selectors';

$doc.ready(() => {
  const renderTarget = document.querySelector(
    '.k-productreviews__render-target'
  );

  if (renderTarget) {
    const reviews = new ProductReview(
      renderTarget.dataset.productId,
      renderTarget
    );
  }
});

class ProductReview {
  constructor(productId, renderTarget) {
    this.id = productId;
    this.baseUrl = `https://api.yotpo.com`;
    this.appId = `MS3VY5Cc4TFD6zbI2zGhMsb9gvkPpQDKwUcPhaSG`;
    this.reviews = null;
    this.ready = false;
    this.renderTarget = renderTarget;

    this.getReviews().then(res => {
      this.reviews = res.data.response.reviews;
      this.renderReviews();
    });
  }

  async getReviews() {
    return axios.get(
      `${this.baseUrl}/v1/widget/${this.appId}/products/${this.id}/reviews.json`
    );
  }

  noReviews() {
    const markup = /*html*/ `
      <p>None yet! Be the first to <a href="#0" class="k-createreview">leave a review.</a></p>    
    `;
    return markup;
  }

  appendListener() {
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

  renderReviews() {
    if (this.reviews.length > 0) {
      this.reviews.forEach(review => {
        this.renderTarget.innerHTML += this.renderReview(review);
      });
    } else {
      this.renderTarget.innerHTML = this.noReviews();
      this.appendListener();
    }
  }

  renderReview(review) {
    const { title, content, user, votes_up, votes_down } = review;
    let { created_at } = review;

    created_at = format(new Date(created_at), 'MMMM dd, yyyy');

    const markup = /*html*/ `
      <article class="k-review">
        <div class="k-review--liner">
          <div class="k-review--title">
            <h3 class="k-weight--lg">${title}</h3>
          </div>
          <div class="k-review--body">
            <p>${content}</p>
          </div>
          <div class="k-review--meta">
            <p>${created_at} - ${user.display_name}</p>
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
              <p>${votes_up}</p>
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
              <p>${votes_down}</p>
            </div>
          </div>
        </div>
      </article>
    `;

    return markup;
  }
}
