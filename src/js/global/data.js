import axios from 'axios';
import products from '../../../yotpoProducts';

const BASE_URL = `https://api.yotpo.com`;
const APP_ID = `MS3VY5Cc4TFD6zbI2zGhMsb9gvkPpQDKwUcPhaSG`;

const hasProductId = [...document.querySelectorAll('[data-yotpo-product-id]')];

async function getSingleReview(id) {
  return axios.get(
    `${BASE_URL}/v1/widget/${APP_ID}/products/${id}/reviews.json`
  );
}

function fetchRequiredProductReviews() {
  window.yotpoProductReviews = window.yotpoProductReviews || [];

  hasProductId.forEach(async element => {
    const $e = $(element);
    const id = $e.data('yotpo-product-id');

    const { data } = await getSingleReview(id);

    const { response } = data;

    window.yotpoProductReviews.push(response);

    insertReviewData($e, response);
  });
}

function insertReviewData($parentEl, data) {
  const $embedTarget = $parentEl.find('.k-reviewembed');
  const numReviews = data.reviews.length;

  if (numReviews > 0) {
    $embedTarget.empty(); // remove the placeholder "be the first to review" cta
    $embedTarget.addClass('has-reviews');

    if ($parentEl.hasClass('k-producthero')) {
      $embedTarget.append(`
        <p>
          <a href="#product-reviews">Reviews (<span class="k-productcard--numreviews">0</span>) </a>
          <span class="k-productcard--reviewavg ">5.0</span>
        </p>
        <div class="k-goldstar">
          <div class="k-goldstar--liner">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 49.57 47.14">
              <g id="Layer_2" data-name="Layer 2">
                <g id="Layer_1-2" data-name="Layer 1">
                  <polygon style="fill: #f4b13e" points="24.78 0 32.44 15.52 49.57 18.01 37.18 30.09 40.1 47.14 24.78 39.09 9.47 47.14 12.39 30.09 0 18.01 17.13 15.52 24.78 0"/>
                </g>
              </g>
            </svg>
          </div>
        </div>
      `);
    } else if ($parentEl.hasClass('k-productcard')) {
      $embedTarget.append(`
        <p class="k-accent-text">Reviews (<span class="k-productcard--numreviews">None </span>)</p>
        <ul>
          <li class="k-productcard--reviewavg k-accent-text">5</li>
          <li>
            <div class="k-goldstar">
              <div class="k-goldstar--liner">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 49.57 47.14">
                  <g id="Layer_2" data-name="Layer 2">
                    <g id="Layer_1-2" data-name="Layer 1">
                      <polygon style="fill: #f4b13e" points="24.78 0 32.44 15.52 49.57 18.01 37.18 30.09 40.1 47.14 24.78 39.09 9.47 47.14 12.39 30.09 0 18.01 17.13 15.52 24.78 0"/>
                    </g>
                  </g>
                </svg>
              </div>
            </div>
          </li>
        </ul>
      `);
    }

    const $totalReviewsTarget = $embedTarget.find('.k-productcard--numreviews');
    const $avgReviewTarget = $embedTarget.find('.k-productcard--reviewavg');

    $totalReviewsTarget.text(numReviews);
    $avgReviewTarget.text(data.bottomline.average_score.toFixed(1));
  }
}

function createProductMap() {
  window.yotpoProductMap = products.map(({ name, external_product_id }) => ({
    name,
    external_product_id,
  }));
}

function globalDataQueue() {
  createProductMap();
  fetchRequiredProductReviews();
}

document.addEventListener('DOMContentLoaded', globalDataQueue);
