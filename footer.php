<?php
$root = get_template_directory_uri();
?>
  </main>

  <?php
  get_template_part('partials/site-footer');
  ?>

  <div id="k-backdrop" class="active"></div>

  <div class="k-modal k-modal--search">
    <div class="k-inner k-inner--sm">
      <div class="k-modal--content">
        <form class="k-form k-form--search">
          <input name="k-search-input" id="k-search-input" type="text" />
          <label for="k-search-input">Search...</label>
          <button type="submit">&rarr;</button>
        </form>
      </div>
      <div class="k-modal--close k-searchtrigger">
        <div class="k-modal--close__liner">
          <span class="k-headline k-headline--sm">+</span>
        </div>
      </div>
    </div>
  </div>

  <div class="k-modal k-modal--review">
    <div class="k-modal--content">
      <div class="k-modal__close">X</div>

      <h3 class="k-headline k-headline--sm">Write a Review</h3>
      <p class="k-review__producttitle"><span></span></p>

      <div class="k-modal__successmsg">
        <p>Review submitted. Thank you!</p>
      </div>

      <form
        class="k-form k-form--review"
        data-product-sku=""
        data-product-title=""
      >
        <div class="k-form__liner">
          <div class="k-form__group">
            <input class="k-input" type="email" name="email" id="k-review-email" required/>
            <label for="k-reviewemail">Email Address</label>
          </div>
          <div class="k-form__group">
            <input type="text" class="k-input" name="displayname" id="k-review-displayname" required/>
            <label for="k-review-displayname">Display Name</label>
          </div>
          <div class="k-form__group">
            <input type="text" name="reviewtitle" id="k-review-title" class="k-input" required/>
            <label for="k-review-title">Review Title</label>
          </div>

          <div class="k-form__group k-review__rating">
            <p>Star Rating</p>
            <div class="k-review__ratingitem">
              <input type="radio" name="reviewrating" id="k-review-5star" value="5" />
              <label for="k-review-5star"> <?php get_template_part('partials/svg/gold-star');get_template_part('partials/svg/gold-star');get_template_part('partials/svg/gold-star');get_template_part('partials/svg/gold-star');get_template_part('partials/svg/gold-star'); ?></label>
            </div>
            <div class="k-review__ratingitem">
              <input type="radio" name="reviewrating" id="k-review-4star" value="4" />
              <label for="k-review-4star"><?php get_template_part('partials/svg/gold-star');get_template_part('partials/svg/gold-star');get_template_part('partials/svg/gold-star');get_template_part('partials/svg/gold-star'); ?></label>
            </div>
            <div class="k-review__ratingitem">
              <input type="radio" name="reviewrating" id="k-review-3star" value="3" />
              <label for="k-review-3star"><?php get_template_part('partials/svg/gold-star'); get_template_part('partials/svg/gold-star'); get_template_part('partials/svg/gold-star'); ?></label>
            </div>
            <div class="k-review__ratingitem">
              <input type="radio" name="reviewrating" id="k-review-2star" value="2" />
              <label for="k-review-2star"><?php get_template_part('partials/svg/gold-star'); get_template_part('partials/svg/gold-star'); ?></label>
            </div>
            <div class="k-review__ratingitem">
              <input type="radio" name="reviewrating" id="k-review-1star" value="1" />
              <label for="k-review-1star"><?php get_template_part('partials/svg/gold-star'); ?></label>
            </div>
          </div>

          <div class="k-form__group k-form__group--textarea">
            <label for="k-review-content">Review Content</label>
            <textarea
              name="reviewcontent"
              id="k-review-content"
              cols="30"
              rows="10"
              placeholder="I love this product!"
            ></textarea>
          </div>

          <div class="k-form__actions">
            <button type="submit" class="k-button k-button--primary">Submit Review</button>
          </div>

        </div>
      </form>
    </div>
  </div>

  <?php
    if (is_page_template('templates/cart.php') == false) {
      get_template_part('partials/cart-sidebar');
    }
    global $wp;
  ?>
  
  <!-- Start of LiveChat (www.livechatinc.com) code -->
  <script type="text/javascript">
  window.__lc = window.__lc || {};
  window.__lc.license = 9499945;
  (function() {
    var lc = document.createElement('script'); lc.type = 'text/javascript'; lc.async = true;
    lc.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'cdn.livechatinc.com/tracking.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(lc, s);
  })();
  </script>
  <!-- End of LiveChat code -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tilt.js/1.2.1/tilt.jquery.min.js"></script>
  <script type="text/javascript" src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
  <script type="text/javascript" src="https://cdn.plyr.io/3.5.6/plyr.polyfilled.js"></script>

  <?php if ($wp->request == 'checkout') : ?>
    <script type="text/javascript" src="https://koicbdstaging.wpengine.com/wp-content/plugins/woocommerce/assets/js/jquery-payment/jquery.payment.min.js?ver=3.0.0"></script>
    
    <!-- <script type="text/javascript" src="https://koicbdstaging.wpengine.com/wp-content/plugins/woocommerce-gateway-authorize-net-cim/vendor/skyverge/wc-plugin-framework/woocommerce/payment-gateway/assets/js/frontend/sv-wc-payment-gateway-payment-form.min.js?ver=5.4.1"></script>
    <script type="text/javascript" src="https://koicbdstaging.wpengine.com/wp-content/plugins/woocommerce-gateway-authorize-net-cim/assets/js/frontend/wc-authorize-net-cim.min.js?ver=3.0.6"></script>
    <script type="text/javascript" src="https://js.authorize.net/v1/Accept.js"></script> -->
    <script type="text/javascript">
    /* <![CDATA[ */
    var sv_wc_payment_gateway_payment_form_params = {"card_number_missing":"Card number is missing","card_number_invalid":"Card number is invalid","card_number_digits_invalid":"Card number is invalid (only digits allowed)","card_number_length_invalid":"Card number is invalid (wrong length)","cvv_missing":"Card security code is missing","cvv_digits_invalid":"Card security code is invalid (only digits are allowed)","cvv_length_invalid":"Card security code is invalid (must be 3 or 4 digits)","card_exp_date_invalid":"Card expiration date is invalid","check_number_digits_invalid":"Check Number is invalid (only digits are allowed)","check_number_missing":"Check Number is missing","drivers_license_state_missing":"Drivers license state is missing","drivers_license_number_missing":"Drivers license number is missing","drivers_license_number_invalid":"Drivers license number is invalid","account_number_missing":"Account Number is missing","account_number_invalid":"Account Number is invalid (only digits are allowed)","account_number_length_invalid":"Account number is invalid (must be between 5 and 17 digits)","routing_number_missing":"Routing Number is missing","routing_number_digits_invalid":"Routing Number is invalid (only digits are allowed)","routing_number_length_invalid":"Routing number is invalid (must be 9 digits)"};
    /* ]]> */
    </script>
    <script type="text/javascript" src="https://koicbdstaging.wpengine.com/wp-content/plugins/woocommerce-square/vendor/skyverge/wc-plugin-framework/woocommerce/payment-gateway/assets/js/frontend/sv-wc-payment-gateway-payment-form.min.js?ver=5.4.0"></script>
    <script type="text/javascript" src="https://koicbdstaging.wpengine.com/wp-content/plugins/woocommerce-square/assets/js/frontend/wc-square.min.js?ver=2.0.8"></script>
  <?php endif; ?>
  
  <script type="text/javascript" src="<?php echo $root.'/dist/js/magnetic.bundle.js'; ?>"></script>
  <script type="text/javascript">
    (function() {
      var backdrop = document.querySelector('#k-backdrop');
      backdrop.classList.remove('active');
    })();
  </script>

  <?php if ($wp->request == 'checkout') : ?>
    <script type="text/javascript">
      jQuery(function($) {
        tvc_lc="USD";

        jQuery('div').on('click', '.apply_coupons_credits', function() {
          coupon_code = jQuery(this).find('div.code').text();

          if( coupon_code != '' && coupon_code != undefined ) {
            jQuery(this).css('opacity', '0.5');
            var url = 'https://koicbdstaging.wpengine.com/?sc-page=checkout&coupon-code='+coupon_code;
            jQuery(location).attr('href', url);
          }
        });

        var show_hide_coupon_list = function() {
          if ( jQuery('div#coupons_list').find('div.coupon-container').length > 0 ) {
            jQuery('div#coupons_list').slideDown(800);
          } else {
            jQuery('div#coupons_list').hide();
          }
        };

        var coupon_container_height = jQuery('#all_coupon_container').height();
        if ( coupon_container_height > 400 ) {
          jQuery('#all_coupon_container').css('height', '400px');
          jQuery('#all_coupon_container').css('overflow-y', 'scroll');
        } else {
          jQuery('#all_coupon_container').css('height', '');
          jQuery('#all_coupon_container').css('overflow-y', '');
        }

        jQuery('.checkout_coupon').next('#coupons_list').hide();

        jQuery('a.showcoupon').on('click', function() {
          show_hide_coupon_list();
        });

        jQuery(document).on('ready', function(){
          jQuery('div#invalid_coupons_list div#all_coupon_container .coupon-container').removeClass('apply_coupons_credits');
        });


        jQuery(document.body).on('updated_checkout', function( e, data ){
          if ( data.fragments.wc_sc_available_coupons ) {
            jQuery('div#coupons_list').replaceWith( data.fragments.wc_sc_available_coupons );
          }
          show_hide_coupon_list();
        });

        jQuery(document.body).on('updated_cart_totals update_checkout', function(){
          jQuery('div#coupons_list').css('opacity', '0.5');
          jQuery.ajax({
            url: 'https://koicbdstaging.wpengine.com/wp-admin/admin-ajax.php',
            type: 'post',
            dataType: 'html',
            data: {
              action: 'sc_get_available_coupons',
              security: 'd9b8523f48'
            },
            success: function( response ) {
              if ( response != undefined && response != '' ) {
                jQuery('div#coupons_list').replaceWith( response );
              }
              show_hide_coupon_list();
              jQuery('div#coupons_list').css('opacity', '1');
            }
          });
        });


        jQuery('body').on('applied_coupon removed_coupon update_checkout', function(){
          jQuery.ajax({
            url: 'https://koicbdstaging.wpengine.com/wp-admin/admin-ajax.php',
            type: 'POST',
            dataType: 'html',
            data: {
              action: 'get_wc_coupon_message',
              security: 'f3c5c1cc74'
            },
            success: function( response ) {
              jQuery('.wc_coupon_message_wrap').html('');
              if ( response != undefined && response != '' ) {
                jQuery('.wc_coupon_message_wrap').html( response );										
              }
            }
          });
        });	

        console.log('Running square init script');
        window.wc_square_credit_card_payment_form_handler = new WC_Square_Payment_Form_Handler( {"id":"square_credit_card","id_dasherized":"square-credit-card","csc_required":true,"logging_enabled":false,"general_error":"An error occurred, please try again or try an alternate form of payment.","ajax_url":"https:\/\/koicbdstaging.wpengine.com\/wp-admin\/admin-ajax.php","ajax_log_nonce":"6661d6b414","application_id":"sq0idp-wGVapF8sNt9PLrdj5znuKA","enabled_card_types":["visa","mastercard","amex","discover"],"square_card_types":{"visa":"visa","masterCard":"mastercard","americanExpress":"amex","discover":"discover","discoverDiners":"dinersclub","JCB":"jcb"},"input_styles":[{"backgroundColor":"transparent","fontSize":"1.3em"}]} );
      });
    </script>
    <script src="https://js.squareup.com/payments/data.js"></script>
    <script>
      (function() {
        var interval;

        interval = setInterval(function() {
          if (window.wc_square_credit_card_payment_form_handler) {
            console.log(window.wc_square_credit_card_payment_form_handler);
            clearInterval(interval);
            window.wc_square_credit_card_payment_form_handler.handle_pay_page();
          }
        }, 50);
      })();
    </script>
  <?php endif; ?>
</body>
</html>
