<?php
  /* Template Name: 2019 Cart Page */

  get_header();
  
  $cart = WC()->cart;
  $cart_acf = get_fields();
  $items_in_cart = $cart->get_cart();

defined( 'ABSPATH' ) || exit;

do_action('k_before_first_section');

do_action( 'woocommerce_before_cart' ); ?>

<section class="k-cart k-block k-block--md">
  <!-- <div class="k-inner k-inner--xl">
    <h1 class="k-headline k-headline--md">Your Cart</h1>
  </div> -->
  <div class="k-inner k-inner--xl">

    <div class="k-cart--main">

      <div class="k-cart--titlerow">
        <div class="k-cart--titleitem">
          <p class="k-upcase"><?php esc_html_e('Product', 'woocommerce'); ?></p>
        </div>
        <div class="k-cart--titleitem">
          <p class="k-upcase"><?php esc_html_e('Quantity', 'woocommerce'); ?></p>
        </div>
        <div class="k-cart--titleitem">
          <p class="k-upcase"><?php esc_html_e('Price', 'woocommerce'); ?></p>
        </div>
      </div>

      <form action="<?php echo esc_url(wc_get_cart_url()); ?>" class="k-cart--form woocommerce-cart-form" method="POST">
        <div class="k-cart--form__liner">
        <?php
          foreach ($cart->get_cart() as $cart_item_key => $cart_item) {
            $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
            $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);
            $is_product_bundle = wc_pb_is_bundle_container_cart_item($cart_item); // check if this item contains sub-items
            $is_bundled_item = wc_pb_is_bundled_cart_item($cart_item); // check if this is a sub-item of a bundle, in which case it should not be treated like an individual item

            if ($is_bundled_item) {
              continue; // don't render anything for this item; it does not belong on its own
            }

            if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_cart_item_visible', true, $cart_item, $cart_item_key)) {
              $product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key); ?>

              <div class="k-cart--item woocommerce-cart-form__cart-item <?php echo esc_attr(apply_filters('woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key)); ?>">
                <div class="k-cart--item__liner">

                  <div class="k-cart--item__thumbnail">
                    <a href="<?php echo $product_permalink; ?>">
                      <img src="<?php echo get_the_post_thumbnail_url($product_id); ?>" alt="<?php echo $_product->get_name(); ?>" />
                    </a>
                  </div>

                  <div class="k-cart--item__title product-name" data-title="<?php esc_attr_e('Product', 'woocommerce'); ?>">
                    <a href="<?php echo $product_permalink; ?>">
                      <h3 class="k-headline k-headline--mini"><?php echo wp_kses_post(apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key)); ?></h3>
                    </a>
                    <?php
                    if ($is_product_bundle) {
                      $bundled_items = wc_pb_get_bundled_cart_items($cart_item); ?>

                      <ul>
                      <?php
                      foreach($bundled_items as $idx => $bundled_item) {
                        $bundled_product = wc_get_product($bundled_item['variation_id']); ?>
                        <li class="k-cart--item__bundleditem">
                          <a href="<?php echo $bundled_product->get_permalink(); ?>"><?php echo $bundled_product->get_name(); ?></a>
                        </li>
                      <?php
                      }
                      ?>
                      </ul>
                    <?php
                    }
                    ?>
                    <p class="k-upcase k-cart-remove-item" data-cart-item-key="<?php echo $cart_item_key; ?>">Remove</p>
                    <?php
                    // backorder notification
                    if ($_product->backorders_require_notification() && $_product->is_on_backorder($cart_item['quantity'])) {
                      echo wp_kses_post(apply_filters('woocommerce_cart_item_backorder_notification', '<p class="k-cart--backordernotice backorder_notification">'.esc_html__('Available on backorder', 'woocommerce').'</p>', $product_id));
                    }
                    ?>
                  </div>

                  <div class="k-cart--item__quantity">
                  <?php
                  if ($_product->is_sold_individually()) {
                    $product_quantity = sprintf('1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key);
                  } else { ?>
                    <!-- <label for="<?php echo 'cart['.$cart_item_key.'][qty]'; ?>">Quantity:</label> -->
                    <div class="k-productform--quantity">
                      <button class="k-reduce">-</button>
                      <input
                        id="<?php echo 'cart['.$cart_item_key.'][qty]'; ?>"
                        type="number"
                        name="<?php echo 'cart['.$cart_item_key.'][qty]'; ?>"
                        value="<?php echo $cart_item['quantity'] ?>"
                        min="0"
                        max="10"
                        />
                      <button class="k-increase">+</button>
                    </div>
                  <?php
                  }
                  ?>
                  </div>

                  <div class="k-cart--item__price">
                    <?php
                    if ($_product->get_type() != 'bundle') { ?>
                      <p class="k-bigtext"><?php echo $cart->get_product_subtotal($_product, $cart_item['quantity']); ?></p>
                    <?php
                    } 
                    ?>
                  </div>

                </div>
              </div>
        <?php
            }
          }
        ?>
          <div class="k-cart--item k-cart--meta">
          <?php if (wc_coupons_enabled()) { ?>

            <div class="k-cart--meta__coupon">
              <label for="coupon_code"><?php esc_html_e('Coupon:', 'woocommerce'); ?></label>
              <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e('Coupon code', 'woocommerce'); ?>" />
            </div>

            <div class="k-cart--meta__actions">
              <button type="submit" class="k-button k-button--dark" name="apply_coupon" value="<?php esc_attr_e('Apply coupon', 'woocommerce'); ?>">
                <?php esc_attr_e('Apply coupon', 'woocommerce'); ?>
              </button>
              <!-- <button type="submit" class="k-button k-button--default" name="update_cart" value="<?php esc_attr_e('Update cart', 'woocommerce'); ?>">
                <?php esc_html_e('Update cart', 'woocommerce'); ?>
              </button> -->
            </div>

          <?php 
          }
          ?>
          </div>

        </div>
      </form>
    </div>

    <div class="k-cart--sidebar">
      <div class="k-cart--sidebar__liner">
        <p class="k-upcase">Subtotal</p>
        <p class="k-bigtext"><?php echo $cart->get_cart_subtotal(); ?></p>
        <a href="<?php echo site_url().'/checkout'; ?>" class="k-button k-button--primary">Checkout</a>
        <a href="<?php echo site_url(); ?>" class="k-button k-button--dark">Keep Shopping</a>
        <p class="k-upcase">Secure Checkout Guaranteed</p>
        <p>View Koi CBD <a href="#0">Shipping & Return Policies</a> before purchasing.</p>
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