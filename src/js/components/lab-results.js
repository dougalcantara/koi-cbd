import Fuse from 'fuse.js';

// const sampleTests = [
//   {
//     type: 'tincture',
//     flavor: 'peppermint',
//     variation: '250 mg',
//     batchid: '123456',
//     totalthc: '0.000%',
//     totalcbd: '249.1979 mg/unit',
//     coaurl: '#0',
//   },
//   {
//     type: 'edible',
//     flavor: 'gummies',
//     variation: '',
//     batchid: '654321',
//     totalthc: '0.000%',
//     totalcbd: '249.1979 mg/unit',
//     coaurl: '#0',
//   },
//   {
//     type: 'pet',
//     flavor: '',
//     variation: '',
//     batchid: '135791',
//     totalthc: '0.000%',
//     totalcbd: '249.1979 mg/unit',
//     coaurl: '#0',
//   },
//   {
//     type: 'vape',
//     flavor: 'spearmint',
//     variation: '250 mg',
//     batchid: 'kjhdfu',
//     totalthc: '0.000%',
//     totalcbd: '249.1979 mg/unit',
//     coaurl: '#0',
//   },
// ];

let sampleTests;
getResults();

function getResults() {
  const RESULTS_URL = 'https://koi-test-results-api.herokuapp.com/results';
  $.ajax({
    url: `${RESULTS_URL}`,
    method: 'GET',
    complete: ({ responseJSON }) => {
      try {
        // $t.data('response', responseJSON.data[0]);
        // setResults(responseJSON.data[0]);
        sampleTests = responseJSON.data;
      } catch (error) {
        console.warn(responseJSON);
        throw new Error(error);
      }
    },
  });
}

const $resultsForm = $('#k-resultssearch');
const $insertTarget = $('#resultsembedtarget');
const fuseOpts = {
  shouldSort: true,
  threshold: 0.6,
  location: 0,
  distance: 100,
  maxPatternLength: 32,
  minMatchCharLength: 1,
  keys: ['type', 'flavor', 'batchid', 'productsku', 'ordername'],
};

function displayResults(e) {
  e.preventDefault();

  const $t = $(this);
  const f = new Fuse(sampleTests, fuseOpts);
  const searchVal = $t.find('input[type="text"]').val();
  const results = f.search(searchVal);
  console.log(results.length);

  $insertTarget.empty();

  results.forEach(test => {
    console.log(test.ordername);

    $insertTarget.append(/*html*/ `
      <div class="k-latestbatch--results">
        <div class="k-latestbatch--results__liner">

          <div class="k-latestbatch--results__column">
            <div>
              <p class="k-upcase">${test.flavor}</p>
              <p class="k-upcase k-latestbatch--strength">${test.variation}</p>
            </div>
            <div>
              <p class="k-upcase">Batch #</p>
              <p class="k-upcase k-latestbatch--strength">${test.batchid}</p>
            </div>
          </div>
          <div class="k-latestbatch--results__column">
            <div>
              <p class="k-upcase">8.5MG of CBD / 1ML</p>
              <p class="k-upcase k-latestbatch--strength">(Full dropper / Serving Size)</p>
            </div>
            <div>
              <p class="k-upcase">Approx. 0.42MG of CBD / drop</p>
              <p class="k-upcase k-latestbatch--strength">(Depending on drop size)</p>
            </div>
          </div>
          <div class="k-latestbatch--results__column">
            <p class="k-bigtext">${test.totalthc} <span>Total THC</span></p>
            <p class="k-bigtext">${test.totalcbd} <span>Total CBD</span></p>
          </div>
          <div class="k-latestbatch--results__column">
            <a href="${test.coaurl}"></a>
            <span>.PDF &darr;</span>
          </div>

        </div>
      </div>
    `);
  });
}

$resultsForm.submit(displayResults);
