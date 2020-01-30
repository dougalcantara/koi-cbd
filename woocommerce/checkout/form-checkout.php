<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
	return;
}

?>
<section class="k-checkout k-block k-block--md k-no-padding--top k-no-padding--bottom">
	<div class="k-inner k-inner--sm">
		<form name="checkout" method="post" class="k-form checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

			<?php if ( $checkout->get_checkout_fields() ) : ?>
				
				<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>
				
					<div class="k-checkout__forms" id="customer_details">
						<div class="k-liner">
							<div class="k-checkout__billing">
								<div class="k-checkout__title">
									<div class="k-liner">
										<h3><?php esc_html_e('Billing details', 'woocommerce'); ?></h3>
									</div>
								</div>								
								<?php do_action( 'woocommerce_checkout_billing' ); ?>
							</div>
							<div class="k-checkout__shipping">
								<div class="k-checkout__title">
									<div class="k-liner">
										<h3><?php esc_html_e('Shipping details', 'woocommerce'); ?></h3>
										<div class="k-toggle-shipping">
											<input id="ship-to-different-address" class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" type="checkbox" name="ship_to_different_address" value="1" /> 
											<label for="ship-to-different-address" class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">
												<?php esc_html_e( 'Ship to a different address?', 'woocommerce' ); ?>
											</label>
										</div>
									</div>
								</div>
								<div class="k-checkout__fields">
									<div class="k-checkout__shipping-drawer" style="display: none;">
										<?php do_action('woocommerce_checkout_shipping'); ?>
									</div>
								</div>
							</div>
						</div>
		
				</div>
		
				<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>
		
			<?php endif; ?>
			
			<?php do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>
			
			<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>
		
			<div id="order_review" class="woocommerce-checkout-review-order">
				<?php do_action( 'woocommerce_checkout_order_review' ); ?>
			</div>
		
			<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
		
		</form>
		
		<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>

	</div>
</section>
