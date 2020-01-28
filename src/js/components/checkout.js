import $ from 'jquery';
import { $body } from '../global/selectors';

const $parent = $('.k-checkout form');
const $shippingDetailsTrigger = $('#ship-to-different-address');
const $drawer = $parent.find('.k-checkout__shipping-drawer');
const $shippingInputs = $('#shipping_method input');
const $couponButton = $('.k-checkout__coupon-actions a');
const $couponField = $('.k-checkout__coupon input');
const $removeCoupon = $('.woocommerce-remove-coupon');
const $details = $('#customer_details');
const $review = $('#order_review');

$shippingInputs.click(function() {
  $details.addClass('processing');
  $review.addClass('processing');
  $body.trigger('updated_checkout');

  setTimeout(function() {
    /**
     * jQuery knows when all network requests are completed.
     * However, we have to delay this shortly since the built-in WC JS
     * triggers a custom event $('body').trigger('update_checkout');
     * that initiates ajax requests.
     *
     * By delaying this interval shortly, we ensure that it doesnt begin
     * the interval until the ajax requests started by WC JS have fired.
     *
     */
    const onAjaxComplete = setInterval(function() {
      console.log($.active);
      if ($.active === 0) {
        console.log('Network requests complete. Refreshing..');
        clearInterval(onAjaxComplete);
        window.location.reload();
      }
    }, 33);
  }, 1250);
});

function toggleDrawer(e) {
  if ($drawer.hasClass('open')) {
    $drawer.slideUp();
    $drawer.removeClass('open');
  } else {
    $drawer.addClass('open');
    $drawer.slideDown();
  }
}

$couponButton.click(function() {
  // event.preventDefault();
  console.log($couponField.val());
  // const $t = $(this);
  // $t.addClass('submitting');
  // applyCoupon($couponField.val());
});

let ticker = 0;
const waiting = setInterval(() => {
  ticker++;
  if ($removeCoupon.length > 0) {
    $removeCoupon.off();

    $removeCoupon.click(function() {
      event.stopImmediatePropagation();
      event.preventDefault();
      removeCoupon($removeCoupon.data('coupon'));
    });
    clearInterval(waiting);
  }

  if (ticker > 100) {
    clearInterval(waiting);
  }
}, 100);

// function applyCoupon(coupon) {
//   const { wc_checkout_params: wc, location } = window;

//   $('.woocommerce-message').remove();
//   $details.addClass('processing');
//   $review.addClass('processing');

//   $.ajax({
//     type: 'POST',
//     url: wc.wc_ajax_url.toString().replace('%%endpoint%%', 'apply_coupon'),
//     data: {
//       security: wc.apply_coupon_nonce,
//       coupon_code: coupon,
//     },
//     success: function(e) {
//       $('form.woocommerce-checkout').before(e);
//       $body.animate(
//         {
//           scrollTop: 0,
//         },
//         100
//       );
//       setTimeout(function() {
//         location.reload();
//       }, 650);
//     },
//   });
// }

// function removeCoupon(coupon) {
//   const { wc_checkout_params: wc, location } = window;

//   $('.woocommerce-message').remove();
//   $details.addClass('processing');
//   $review.addClass('processing');

//   $.ajax({
//     type: 'POST',
//     url: wc.wc_ajax_url.toString().replace('%%endpoint%%', 'remove_coupon'),
//     data: {
//       security: wc.remove_coupon_nonce,
//       coupon: coupon,
//     },
//     success: function(e) {
//       $('form.woocommerce-checkout').before(e);
//       $body.animate(
//         {
//           scrollTop: 0,
//         },
//         100
//       );
//       setTimeout(function() {
//         location.reload();
//       }, 650);
//     },
//   });
// }

$shippingDetailsTrigger.click(toggleDrawer);
