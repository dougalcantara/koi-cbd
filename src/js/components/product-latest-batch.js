import { $doc } from '../global/selectors';

const $parent = $('.k-latestbatch');
const $tabs = $parent.find('.k-latestbatch--tabs__tab');
const $batchIdTarget = $parent.find('#k-batchid');
const $thcTarget = $parent.find('#k-totalthc');
const $cbdTarget = $parent.find('#k-totalcbd');
const $coaTarget = $parent.find('#k-coaurl');

const RESULTS_URL = 'https://koi-test-results-api.herokuapp.com/results';

$tabs.click(function() {
  const $t = $(this);
  const sku = $t.data('product-sku');

  $tabs.removeClass('active');
  $t.addClass('active');

  $.ajax({
    url: `${RESULTS_URL}?productsku=${sku}`,
    method: 'GET',
    complete: ({ responseJSON }) => {
      const { batchid, totalthc, totalcbd, coaurl } = responseJSON.data[0];

      $batchIdTarget.text(batchid);
      $thcTarget.text(totalthc);
      $cbdTarget.text(totalcbd);
      $coaTarget.attr('href', coaurl);
    },
  });
});
