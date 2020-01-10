import $ from 'jquery';
import axios from 'axios';
import products from '../../../yotpoProducts';

const BASE_URL = `https://api.yotpo.com`;
const APP_ID = `MS3VY5Cc4TFD6zbI2zGhMsb9gvkPpQDKwUcPhaSG`;

const hasProductId = [...document.querySelectorAll('[data-yotpo-product-id]')];

async function getSingleReview(id) {
  return axios.get(
    `${BASE_URL}/v1/widget/${APP_ID}/products/${id}/reviews.json?per_page=150`
  );
}

function fetchRequiredProductReviews() {
  window.yotpoProductReviews = window.yotpoProductReviews || [];

  hasProductId.forEach(async (element, index) => {
    const $e = $(element);
    const id = $e.data('yotpo-product-id');

    const { data } = await getSingleReview(id);

    const { response } = data;

    window.yotpoProductReviews.push(response);

    insertReviewData($e, response);

    const $targets = $e.find('.k-productcard__review-target');
    $targets.append(
      /*html*/ `<a class="k-wraparound-link" href="${$e.data(
        'reviewUrl'
      )}"></a>`
    );
  });
}

function insertReviewData($parentEl, data) {
  const $embedTarget = $parentEl.find('.k-reviewembed');
  const numReviews = data.reviews.length;
  const score = parseFloat(data.bottomline.average_score.toFixed(1));
  const starMarkup = getStarMarkup(score);

  if (numReviews > 0) {
    $embedTarget.empty(); // remove the placeholder "be the first to review" cta
    $embedTarget.addClass('has-reviews');

    if ($parentEl.hasClass('k-producthero')) {
      $embedTarget.append(/*html*/ `
        <p>
          <a href="#product-reviews">Reviews (<span class="k-productcard--numreviews">0</span>) </a>
          <span class="k-productcard--reviewavg">${score}</span>
        </p>
        ${starMarkup}
      `);
    } else if ($parentEl.hasClass('k-productcard')) {
      $embedTarget.append(/*html*/ `
        <p class="k-accent-text k-productcard__review-target">Reviews (<span class="k-productcard--numreviews">None </span>)</p>
        <ul>
          <li class="k-productcard--reviewavg k-accent-text">${score}</li>
          <li class="k-productcard__review-target">
            ${starMarkup}
          </li>
        </ul>
      `);
    }

    const $totalReviewsTarget = $embedTarget.find('.k-productcard--numreviews');
    // const $avgReviewTarget = $embedTarget.find('.k-productcard--reviewavg');

    $totalReviewsTarget.text(numReviews);
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

function getStarMarkup(score) {
  let markup = '';

  const decimalValue = score % 1;
  const difference = 1 - decimalValue;
  const translateValue = difference * 100;

  for (let i = 0; i < score; i++) {
    markup += /*html*/ `
      <div class="k-goldstar">
        <div class="k-goldstar--liner">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 49.57 47.14" style="transform: translate3d(${
            i + 1 > score ? -translateValue : 0
          }%, 0, 0);">
            <g id="Layer_2" data-name="Layer 2">
              <g id="Layer_1-2" data-name="Layer 1">
                <polygon style="fill: #f4b13e; transform: translate3d(${
                  i + 1 > score ? translateValue : 0
                }%, 0, 0);" points="24.78 0 32.44 15.52 49.57 18.01 37.18 30.09 40.1 47.14 24.78 39.09 9.47 47.14 12.39 30.09 0 18.01 17.13 15.52 24.78 0"/>
              </g>
            </g>
          </svg>
        </div>
      </div> 
    `;
  }

  return markup;
}

document.addEventListener('DOMContentLoaded', globalDataQueue);
