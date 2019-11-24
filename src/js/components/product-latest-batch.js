import { $doc } from '../global/selectors';
import Test from '../helpers/Test';

const $parent = $('.k-latestbatch');
const $tabs = $parent.find('.k-latestbatch--tabs__tab');
const $batchIdTarget = $parent.find('#k-batchid');
const $thcTarget = $parent.find('.k-totalthc__render-target');
let $cbdTarget = $parent.find('.k-totalcbd__render-target');
const $coaTarget = $parent.find('#k-coaurl');
const $variantTarget = $parent.find('.k-latestbatch__variant-render-target');
const $resultsContainer = $('.k-latestbatch--results');
const $columns = $('.k-latestbatch--results__column');
const $totalCbdContainer = $parent.find('#k-totalcbd');
const originalMarkup = $totalCbdContainer.html();

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
      if (responseJSON.data.length > 0) {
        try {
          $t.data('response', responseJSON.data[0]);
          setResults(responseJSON.data[0], $t);
        } catch (error) {
          console.warn(responseJSON);
          insertSearchPrompt();
          console.error(Error(error));
        }
      } else {
        insertSearchPrompt();
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
  const test = new Test(results);

  $batchIdTarget.text(test.results.batchid);
  $thcTarget.text(test.results.totalthc);

  // maybe instead of doing this, we use the Test class to handle
  // the same errors that could occur on the aggregate lab result search page.
  if (test.results.viewCBDinCOA) {
    $totalCbdContainer.html(/*html*/ `
      <p class="k-upcase" style="font-size: 100%">${test.results.viewcoa}</p>    
    `);
    $totalCbdContainer.addClass(['k-base-font-size', 'k-upcase']);
  } else {
    restoreOriginalMarkup(test.results.totalcbd);
  }

  $coaTarget.attr('href', test.results.coaurl);
  $coaTarget.attr('href', test.results.coaurl);
  if ($variantTarget[0]) {
    $variantTarget.text($t.text());
  }

  if (window.__labError === true) {
    removeSearchPrompt();
  }
}

function restoreOriginalMarkup(totalcbd) {
  $totalCbdContainer.html(originalMarkup);
  $totalCbdContainer.removeClass(['k-base-font-size', 'k-upcase']);
  $cbdTarget = $parent.find('.k-totalcbd__render-target');
  $cbdTarget.text(totalcbd);
}
