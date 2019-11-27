import Fuse from 'fuse.js';
import Test from '../helpers/Test';
import { $body } from '../global/selectors';

let sampleTests;

if ($body.hasClass('page-template-lab-results')) {
  getResults();
}

const $resultsForm = $('#k-resultssearch');
const $insertTarget = $('#resultsembedtarget');
const fuseOpts = {
  shouldSort: true,
  threshold: 0.0,
  location: 0,
  distance: 100,
  maxPatternLength: 32,
  minMatchCharLength: 3,
  includeScore: true,
  keys: [/* 'type', 'flavor',*/ 'batchid' /*, 'productsku', 'ordername' */],
};

$resultsForm.submit(displayResults);

function getResults() {
  const RESULTS_URL = 'https://koi-test-results-api.herokuapp.com/results';
  const url = window.location.href.split('/lab-results')[0];
  $.ajax({
    url: `${RESULTS_URL}`,
    method: 'GET',
    complete: ({ responseJSON }) => {
      try {
        sampleTests = responseJSON.data;
      } catch (error) {
        $insertTarget.append(/*html*/ `
          <div class="k-latestbatch--results">
            <div class="k-latestbatch--results__liner k-latestbatch--results__liner--error">
              <h1>Sorry, there appears to be a connection issue.</h1>
              <p>Try refreshing the page.</p>
              <p>If you continue to experience a problem, please <a href="${url}/contact" style="text-decoration: underline;">let us know</a> and we'll be happy to help.</p>
            </div>
          </div>
        `);
        console.warn(responseJSON);
        console.error(Error(error));
      }
    },
  });
}

function displayResults(e) {
  e.preventDefault();

  const $t = $(this);
  const f = new Fuse(sampleTests, fuseOpts);
  const searchVal = $t.find('input[type="text"]').val();
  const results = f.search(searchVal);

  $insertTarget.empty();

  if (results.length > 0) {
    results.forEach(test => {
      test = new Test(test.item, test.score);
      appendMarkup(test);
    });
  } else {
    displayTermPrompt();
  }
}

function displayTermPrompt() {
  $insertTarget.append(/*html*/ `
    <div class="k-latestbatch--results">
      <div class="k-latestbatch--results__liner k-latestbatch--results__liner--error">
        <h1>Sorry, we can't seem to find that.</h1>
        <!-- <p>Try searching for a product name, batch number, SKU, or strength.</p> -->
        <p>Try searching for a valid batch number.</p>
      </div>
    </div>    
  `);
}

function appendMarkup(test) {
  $insertTarget.append(/*html*/ `
    <div class="k-latestbatch--results">
      <div class="k-latestbatch--results__liner">
        <div class="k-latestbatch--results__column">
          <div>
            <p class="k-upcase k-latestbatch--strength">
              ${test.results.strength !== false ? test.results.strength : ''}
            </p>
          </div>
          <div>
            <p class="k-upcase">Batch #</p>
            <p class="k-upcase k-latestbatch--strength">${
              test.results.batchid
            }</p>
          </div>
        </div>
        <div class="k-latestbatch--results__column">
          <div>
            <p class="k-upcase">Product Name:</p>
            <p class="k-upcase">${test.results.ordername}</p>
          </div>
          <div>
            <p class="k-upcase">Product SKU:</p>
            <p class="k-upcase">${test.results.productsku}</p>
          </div>
        </div>
        <div class="k-latestbatch--results__column">
          <p class="k-bigtext">${
            test.results.totalthc
          }% <span class="k-measurement">Total THC</span></p>
          ${
            test.results.viewCBDinCOA
              ? /*html*/ `<p class="k-upcase" style="font-size: 100%">${test.results.viewcoa}</p>`
              : /*html*/ `<p class="k-bigtext">${test.results.totalcbd}mg/unit <span class="k-measurement">Total CBD</span></p>`
          }
        </div>
        <div class="k-latestbatch--results__column">
          <a href="${test.results.coaurl}"></a>
          <span>.PDF &darr;</span>
        </div>
      </div>
    </div>
  `);
}
