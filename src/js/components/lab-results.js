import Fuse from 'fuse.js';
import Test from '../helpers/Test';
import { $body } from '../global/selectors';

let sampleTests = undefined;

if ($body.hasClass('page-template-lab-results')) {
  getResults();

  let counter = 0;
  const waiting = setInterval(() => {
    counter++;
    if (counter === 100) {
      // 10 seconds since ajax request
      alert('Error getting results from test database.');
      clearInterval(waiting);
    }
    if (sampleTests !== undefined) {
      setDefaultResults();
      clearInterval(waiting);
    }
  }, 100);
}

const $resultsForm = $('#k-resultssearch');
const $insertTarget = $('#resultsembedtarget');
const $tabAppendTarget = $('.k-recentresults__tab-append-target');
const $recentTestTarget = $('.k-recentresults__test-append-target');
const $spacer = $('.k-recentresults__spacer');

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

function setDefaultResults() {
  window.__defaults = [
    {
      categoryName: 'tinctures',
      sku: [
        'NATNAT250',
        'NATNAT500',
        'NATNAT1000',
        // 'NATNAT1500' - exists but isnt listed on PDP
        'NATNAT2000',
        // 'NATNAT3000' - exists but isnt listed on PDP
      ],
      button: $('[data-category="tincture"]'),
      unit: '30mL bottle',
      labResults: [],
    },
    {
      categoryName: 'gummies',
      sku: ['REGGUM20', 'SRGUM20'],
      button: $('[data-category="gummies"]'),
      unit: '20 gummies',
      labResults: [],
    },
    {
      categoryName: 'sprays',
      sku: ['NATNAT1500', 'NATNAT3000'],
      button: $('[data-category="sprays"]'),
      unit: '60mL bottle',
      labResults: [],
    },
    {
      categoryName: 'vape',
      sku: ['WHTKOI100', 'WHTKOI250', 'WHTKOI500', 'WHTKOI1000'],
      button: $('[data-category="vape"]'),
      unit: '30mL bottle',
      labResults: [],
    },
    {
      categoryName: 'hempExtractBalm',
      sku: ['KHB 500 mg'],
      button: $('[data-category="hempExtractBalm"]'),
      unit: '45g container',
      labResults: [],
    },
    {
      categoryName: 'lotion',
      sku: ['LTNCTBRST', 'LTNLAV', 'LTNPNKGRP'],
      button: $('[data-category="lotion"]'),
      unit: '4.25oz bottle',
      labResults: [],
    },
    {
      categoryName: 'petChew',
      sku: ['KPTSCHEWS'],
      button: $('[data-category="petChew"]'),
      unit: '25 chews',
      labResults: [],
    },
    {
      categoryName: 'petSpray',
      sku: ['PETSPRY'],
      button: $('[data-category="petSpray"]'),
      unit: '60mL spray bottle',
      labResults: [],
    },
  ];

  window.__defaults.forEach(category => {
    category.sku.forEach(sku => {
      // for each sku inside each category
      if (sku != undefined) {
        let newestMatch = sampleTests.filter(
          test => test.productsku === sku
        )[0];
        newestMatch.unit = category.unit;
        category.labResults.push(new Test(newestMatch));
      }
    });

    category.button.click(function(event) {
      showRecentTest(category.labResults[0], category, event);
      $body.animate(
        {
          scrollTop: $spacer.offset().top - 100,
        },
        50
      );
    });
  });
}

function showRecentTest(match, category, event) {
  $recentTestTarget.html(``);
  appendMarkup(match, $recentTestTarget, category, event);
}

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
          <div class="k-latestbatch__results">
            <div class="k-latestbatch__results-liner k-latestbatch__results-liner--error">
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
      appendMarkup(test, $insertTarget);
    });
  } else {
    displayTermPrompt();
  }
}

function displayTermPrompt() {
  $insertTarget.append(/*html*/ `
    <div class="k-latestbatch__results">
      <div class="k-latestbatch__results-liner k-latestbatch__results-liner--error">
        <h1>Sorry, we can't seem to find that.</h1>
        <!-- <p>Try searching for a product name, batch number, SKU, or strength.</p> -->
        <p>Try searching for a valid batch number.</p>
      </div>
    </div>    
  `);
}

function getTabMarkup(test, category) {
  const tab = /*html*/ `
    <div class="k-latestbatch--tabs__tab" data-product-sku="${
      test.productsku
    }" data-category="${category.categoryName}">
      <span class="k-latestbatch__variant-name">
        ${test.strength ? test.strength : test.ordername}
      </span>
    </div>
  `;

  return tab;
}

function appendVariantTabs(category) {
  // Display the variants as tabs
  let tabs = '';
  if (category.categoryName === 'lotion') {
    // lotion strength is *currently* always 200mg, so use the product name instead
    // this may change in the future as new products are added
    category.labResults.forEach(sku => {
      sku.results.strength = sku.results.ordername
        .split('Koi Lotion')[1]
        .split('200')[0];
      tabs += getTabMarkup(sku.results, category);
    });
  } else if (category.categoryName === 'gummies') {
    // gummies *currently* only have 1 strength, so use the name instead.
    // this may change in the future as new products are added
    category.labResults.forEach(sku => {
      sku.results.strength = sku.results.ordername
        .split('Koi')[1]
        .split('Fruit')[0];
      tabs += getTabMarkup(sku.results, category);
    });
  } else if (category) {
    category.labResults.forEach(sku => {
      tabs += getTabMarkup(sku.results, category);
    });
  }
  $tabAppendTarget.html(tabs);
  assignTabListeners();
}

function appendMarkup(test, $appendTarget, category, event = false) {
  try {
    const unitMarkup = /*html*/ `
      <p class="k-upcase k-latestbatch--unit">${
        test.results.unit ? test.results.unit : ''
      }</p>
    `;

    if (event) {
      appendVariantTabs(category);
    }

    $appendTarget.append(/*html*/ `
    <div class="k-latestbatch__results">
      <div class="k-latestbatch__results-liner">
        <div class="k-latestbatch__results-column">
          <div>
            <p class="k-upcase k-latestbatch--strength">
              ${
                test.results.strength !== false
                  ? test.results.strength
                  : 'View strength in PDF'
              }
            </p>
            ${unitMarkup}
            <p class="k-upcase k-latestbatch--strength">Batch #${
              test.results.batchid
            }</p>
          </div>
        </div>
        <div class="k-latestbatch__results-column">
          <div>
            <p class="k-upcase">Product Name: ${test.results.ordername}</p>
            <p class="k-upcase">Product SKU: ${test.results.productsku}</p>
          </div>
        </div>
        <div class="k-latestbatch__results-column">
          <p class="k-bigtext">
            <span class="k-weight--md">
              ${test.results.totalthc}
              ${test.results.totalthc === 'N/D' ? '' : '%'}
            </span>
            <span class="k-measurement">Total THC</span><br>
            ${
              test.results.viewCBDinCOA
                ? /*html*/ `<span class="k-upcase" style="font-size: 75%">${test.results.viewcoa}</span>`
                : /*html*/ `<span class="k-bigtext">
                  <span class="k-weight--md">${test.results.totalcbd}mg/unit</span>
                  <span class="k-measurement">Total CBD</span>
                </span>`
            }
          </p>
        </div>
        <div class="k-latestbatch__results-column">
          <a id="k-coaurl" class="k-button" href="${
            test.results.coaurl
          }" target="_blank">.PDF &darr;</a>
        </div>
      </div>
    </div>
  `);
  } catch (error) {
    console.error(Error(error));
    $tabAppendTarget.html(``);
    $appendTarget.append(/*html*/ `
      <div class="k-latestbatch__results k-result-error">
        <div class="k-latestbatch__error">
          <h2>We had trouble loading these Lab Results.</h2>
          <p>Have your batch number? Search for it below.</p>
        </div>
        <div class="k-latestbatch__results-liner" style="filter: blur(2px);">
          <div class="k-latestbatch__results-column">
            <div>
              <p class="k-upcase k-latestbatch--strength">
                100 MG
              </p>
              <p class="k-upcase k-latestbatch--strength">Batch #9075XXXXXX</p>
            </div>
          </div>
          <div class="k-latestbatch__results-column">
            <div>
              <p class="k-upcase">Product Name: CBD Vape Juice</p>
              <p class="k-upcase">Product SKU: XXXXXXXXXX</p>
            </div>
          </div>
          <div class="k-latestbatch__results-column">
            <p class="k-bigtext">
              <span class="k-weight--md">
                N/D
              </span>
              <span class="k-measurement">Total THC</span><br>
              <span class="k-upcase" style="font-size: 75%">View total CBD in PDF</span>
            </p>
          </div>
          <div class="k-latestbatch__results-column">
            <a id="k-coaurl" class="k-button" href="#" target="_blank">.PDF &darr;</a>
          </div>
        </div>
      </div>
    `);
  }
}

function assignTabListeners() {
  const $tabs = $('.k-latestbatch--tabs__tab');
  $tabs.first().addClass('active');

  $tabs.click(function() {
    const $t = $(this);

    $tabs.removeClass('active');
    $t.addClass('active');

    const category = window.__defaults.filter(
      cat => cat.categoryName === $t.data('category')
    )[0];

    const matchingTest = category.labResults.filter(
      test => test.results.productsku === $t.data('product-sku')
    )[0];

    $recentTestTarget.html(``);
    appendMarkup(matchingTest, $recentTestTarget, category);
  });
}
