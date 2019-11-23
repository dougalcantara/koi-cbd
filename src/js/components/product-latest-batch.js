import { $doc } from '../global/selectors';

const $parent = $('.k-latestbatch');
const $tabs = $parent.find('.k-latestbatch--tabs__tab');
const $batchIdTarget = $parent.find('#k-batchid');
const $thcTarget = $parent.find('.k-totalthc__render-target');
const $cbdTarget = $parent.find('.k-totalcbd__render-target');
const $coaTarget = $parent.find('#k-coaurl');
const $variantTarget = $parent.find('.k-latestbatch__variant-render-target');
const $resultsContainer = $('.k-latestbatch--results');
const $columns = $('.k-latestbatch--results__column');

const RESULTS_URL = 'https://koi-test-results-api.herokuapp.com/results';

$doc.ready(() => {
  $tabs.each(function() {
    const $t = $(this);
    if ($t.hasClass('active')) {
      getResult($t, $t.data('product-sku'));
    }
  });
});

$tabs.click(function() {
  const $t = $(this);
  const sku = $t.data('product-sku');

  $tabs.removeClass('active');
  $t.addClass('active');

  if ($t.data('response')) {
    setResults($t.data('response'), $t);
  } else {
    getResult($t, sku);
  }
});

function getResult($t, sku) {
  $.ajax({
    url: `${RESULTS_URL}?productsku=${sku}`,
    method: 'GET',
    complete: ({ responseJSON }) => {
      try {
        $t.data('response', responseJSON.data[0]);
        setResults(responseJSON.data[0], $t);
      } catch (error) {
        console.warn(responseJSON);
        insertSearchPrompt();

        console.error(Error(error));
      }
    },
  });
}

function insertSearchPrompt() {
  const url = window.location.href.split('/product')[0];

  if (window.__labError === true) {
    removeSearchPrompt();
  }

  window.__labError = true;

  $resultsContainer.addClass('k-result-error');
  $columns.addClass('k-result-error--blur');

  const markup = /*html*/ `
    <div class="k-latestbatch__error">
      <h2>We had trouble loading these Lab Results.</h2>
      <p>Search for this product on our <a href="${url}/lab-results" class="k-upcase">Lab Results</a> Page.</p>
    </div>
  `;

  $resultsContainer[0].insertAdjacentHTML('afterbegin', markup);
}

function removeSearchPrompt() {
  const errorMessage = document.querySelector('.k-latestbatch__error');
  errorMessage.remove();

  $resultsContainer.removeClass('k-result-error');
  $columns.removeClass('k-result-error--blur');

  window.__labError = false;
}

function setResults(results, $t) {
  const { batchid, totalthc, totalcbd, coaurl } = results;
  $batchIdTarget.text(batchid);
  $thcTarget.text(totalthc);
  $cbdTarget.text(totalcbd);
  $coaTarget.attr('href', coaurl);
  $coaTarget.attr('href', coaurl);
  if ($variantTarget[0]) {
    $variantTarget.text($t.text());
  }

  if (window.__labError === true) {
    removeSearchPrompt();
  }
}
