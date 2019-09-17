<?php
  get_header();
  /* Template Name: 2019 Cart Page */
  $cart = WC()->cart;
  $cart_acf = get_fields();
  $items_in_cart = $cart->get_cart();
  ?>

  <section class="k-cart k-headermargin k-bg-dark">
    <div class="k-inner k-inner--xl k-block k-block--md">
    <?php
      include(locate_template('partials/components/cart/contents-list.php'));
    ?>
      <div class="k-cart--sidebar">
        <div class="k-cart--sidebar__liner">
          <p class="k-upcase">Subtotal</p>
          <p class="k-bigtext"><?php echo $cart->get_subtotal(); ?></p>
          <a href="#0" class="k-button k-button--primary">Checkout &rarr;</a>
          <a href="#0" class="k-button k-button--secondary on-light">Continue Shopping</a>
          
          <div class="k-cart--sidebar__meta">
            <p class="k-upcase">Secure Checkout Guaranteed</p>
            <p>View Koi CBD <a href="#0">Shipping & Return Policies before purchasing.</a></p>
          </div>
          
        </div>
      </div>
    </div>
  </section>



<?php
  $slider_fields = array(
    'headline' => 'You Might Also Like',
    'products' => $cart_acf['recommended_products'],
  );

  include(locate_template('partials/promo-slider.php'));

  get_footer();
?>