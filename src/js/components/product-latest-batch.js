import { $doc } from '../global/selectors';

const $tabs = $('.k-latestbatch--tabs__tab');

$tabs.click(function() {
  const $t = $(this);

  $tabs.removeClass('active');
  $t.addClass('active');
});
