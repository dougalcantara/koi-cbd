import axios from 'axios'
import yotpoProducts from '../../../yotpoProducts'

const BASE_URL = `https://api.yotpo.com`
const APP_ID = `MS3VY5Cc4TFD6zbI2zGhMsb9gvkPpQDKwUcPhaSG`

const hasProductId = [...document.querySelectorAll('[data-yotpo-product-id]')]

async function getSingleReview(id) {
  return axios.get(`${BASE_URL}/v1/widget/${APP_ID}/products/${id}/reviews.json`)
}

function fetchRequiredProductReviews() {
  window.yotpoProductReviews = window.yotpoProductReviews || []

  hasProductId.forEach(async element => {
    const id = element.dataset.yotpoProductId
    
    const { data } = await getSingleReview(id)

    const { response } = data

    window.yotpoProductReviews.push(response)

    insertReviewData(element, response)
  });
}

function insertReviewData(element, data) {
  const totalReviewsTarget = element.querySelector('.k-productcard--numreviews')
  const avgReviewTarget = element.querySelector('.k-productcard--reviewavg')

  console.log(data);

  totalReviewsTarget.innerHTML = data.reviews.length
  avgReviewTarget.innerHTML = data.bottomline.average_score.toFixed(1)
}

function createProductMap() {
  window.yotpoProductMap = yotpoProducts.products.map(({name, external_product_id}) => ({
    name,
    external_product_id,
  }))
}

function globalDataQueue() {
  createProductMap()
  fetchRequiredProductReviews()
}

document.addEventListener('DOMContentLoaded', globalDataQueue)
