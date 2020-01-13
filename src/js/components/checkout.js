import $ from 'jquery';
import { $doc, $win } from '../global/selectors';

const $parent = $('.k-checkout form');
const $shippingDetailsTrigger = $('#ship-to-different-address');
const $drawer = $parent.find('.k-checkout--shipping');
const $heightTarget = $drawer.find('.k-checkout--shipping__heighttarget');
const $shippingInputs = $('#shipping_method input');

$shippingInputs.click(function() {
  $('#order_review').addClass('reloading');

  setTimeout(() => {
    window.location.reload();
  }, 2000);
});

function toggleDrawer(e) {
  if ($drawer.hasClass('open')) {
    $drawer.height(0);
    $drawer.removeClass('open');
  } else {
    $drawer.height($heightTarget.outerHeight());
    $drawer.addClass('open');
  }
}

$shippingDetailsTrigger.click(toggleDrawer);
