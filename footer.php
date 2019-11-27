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
    <script type="text/javascript" src="https://koicbd.com/wp-content/plugins/woocommerce/assets/js/jquery-payment/jquery.payment.min.js?ver=3.0.0"></script>
    <script type="text/javascript" src="https://koicbd.com/wp-content/plugins/woocommerce-gateway-authorize-net-cim/vendor/skyverge/wc-plugin-framework/woocommerce/payment-gateway/assets/js/frontend/sv-wc-payment-gateway-payment-form.min.js?ver=5.4.1"></script>
    <script type="text/javascript" src="https://koicbd.com/wp-content/plugins/woocommerce-gateway-authorize-net-cim/assets/js/frontend/wc-authorize-net-cim.min.js?ver=3.0.6"></script>
    <script type="text/javascript" src="https://js.authorize.net/v1/Accept.js"></script>
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
  jQuery(function(o){tvc_lc="USD",jQuery("div").on("click",".apply_coupons_credits",function(){if(coupon_code=jQuery(this).find("div.code").text(),""!=coupon_code&&null!=coupon_code){jQuery(this).css("opacity","0.5");var o="https://koicbd.com/?sc-page=checkout&coupon-code="+coupon_code;jQuery(location).attr("href",o)}});var e=function(){jQuery("div#coupons_list").find("div.coupon-container").length>0?jQuery("div#coupons_list").slideDown(800):jQuery("div#coupons_list").hide()};jQuery("#all_coupon_container").height()>400?(jQuery("#all_coupon_container").css("height","400px"),jQuery("#all_coupon_container").css("overflow-y","scroll")):(jQuery("#all_coupon_container").css("height",""),jQuery("#all_coupon_container").css("overflow-y","")),jQuery(".checkout_coupon").next("#coupons_list").hide(),jQuery("a.showcoupon").on("click",function(){e()}),jQuery(document).on("ready",function(){jQuery("div#invalid_coupons_list div#all_coupon_container .coupon-container").removeClass("apply_coupons_credits")}),jQuery(document.body).on("updated_checkout",function(o,c){c.fragments.wc_sc_available_coupons&&jQuery("div#coupons_list").replaceWith(c.fragments.wc_sc_available_coupons),e()}),jQuery(document.body).on("updated_cart_totals update_checkout",function(){jQuery("div#coupons_list").css("opacity","0.5"),jQuery.ajax({url:"https://koicbd.com/wp-admin/admin-ajax.php",type:"post",dataType:"html",data:{action:"sc_get_available_coupons",security:"d4cc3fa80e"},success:function(o){null!=o&&""!=o&&jQuery("div#coupons_list").replaceWith(o),e(),jQuery("div#coupons_list").css("opacity","1")}})}),jQuery("body").on("applied_coupon removed_coupon update_checkout",function(){jQuery.ajax({url:"https://koicbd.com/wp-admin/admin-ajax.php",type:"POST",dataType:"html",data:{action:"get_wc_coupon_message",security:"847daaf786"},success:function(o){jQuery(".wc_coupon_message_wrap").html(""),null!=o&&""!=o&&jQuery(".wc_coupon_message_wrap").html(o)}})}),window.wc_authorize_net_cim_credit_card_payment_form_handler=new WC_Authorize_Net_Payment_Form_Handler({plugin_id:"authorize_net_cim",id:"authorize_net_cim_credit_card",id_dasherized:"authorize-net-cim-credit-card",type:"credit-card",csc_required:!0,csc_required_for_tokens:!1,logging_enabled:!1,lightbox_enabled:!1,login_id:"8Q98gCqJ",client_key:"2KwRL5ATs76sRasQkv625958x6K8fS6R84Rb8UJAVs9WZ2s76tqUmQQegphvywcZ",general_error:"An error occurred, please try again or try an alternate form of payment.",ajax_url:"https://koicbd.com/wp-admin/admin-ajax.php",ajax_log_nonce:"7168f93909",enabled_card_types:["visa","mastercard","amex"]})});
  </script>
  <?php endif; ?>
<!-- Start of LiveChat (www.livechatinc.com) code -->

<!--<script type="text/javascript">-->
<!--  window.__lc = window.__lc || {};-->
<!--  window.__lc.license = 9499945;-->
<!--  (function() {-->
<!--    var lc = document.createElement('script'); lc.type = 'text/javascript'; lc.async = true;-->
<!--    lc.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'cdn.livechatinc.com/tracking.js';-->
<!--    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(lc, s);-->
<!--  })();-->
<!--</script>-->
<!--<noscript>-->
<!--  <a href="https://www.livechatinc.com/chat-with/9499945/" rel="nofollow">Chat with us</a>,-->
<!--  powered by <a href="https://www.livechatinc.com/?welcome" rel="noopener nofollow" target="_blank">LiveChat</a>-->
<!--</noscript>-->

<!-- End of LiveChat code -->
</body>
</html>
