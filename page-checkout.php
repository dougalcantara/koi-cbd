<?php
/* Template Name: 2019 Checkout Page */

if (!defined('ABSPATH')) {
	exit;
}

get_header();

$checkout = WC()->checkout();

do_action('k_before_first_section');
?>

<section class="k-checkout k-block k-block--md k-no-padding--top">
	<div class="k-inner k-inner--sm">

		<div class="k-checkout__headline">
			<h1 class="k-headline k-headline--md">Checkout</h1>
			<?php if (!is_user_logged_in()) : ?>
			<div class="woocommerce-form-login-toggle">
				Returning customer? <a href="<?php echo site_url() . '/account/login'; ?>">Click here to log in.</a>
				<!-- <?php wc_print_notice( apply_filters( 'woocommerce_checkout_login_message', __( 'Returning customer?', 'woocommerce' ) ) . ' <a href="#" class="showlogin">' . __( 'Click here to login', 'woocommerce' ) . '</a>', 'notice' ); ?> -->
			</div>
			<?php endif; ?>
		</div>

		<?php
			do_action('woocommerce_before_checkout_form', $checkout);

			if (!$checkout->is_registration_enabled() && $checkout->is_registration_required() && !is_user_logged_in()) {
				echo esc_html(apply_filters('woocommerce_checkout_must_be_logged_in_message', __('You must be logged in to checkout.', 'woocommerce')));
				return;
			}
			do_action('woocommerce_before_checkout_form', $checkout);
		?>
		<form
			name="checkout"
			method="post"
			class="k-form checkout woocommerce-checkout"
			action="<?php echo esc_url(wc_get_checkout_url()); ?>"
			enctype="multipart/form-data"
		>

		<?php if ($checkout->get_checkout_fields()) : ?>

		<?php do_action('woocommerce_checkout_before_customer_details'); ?>

		<div class="k-checkout__forms" id="customer_details">
			<div class="k-liner">
			
				<div class="k-checkout__billing">
					<div class="k-checkout__title">
						<div class="k-liner">
							<h3><?php esc_html_e('Billing details', 'woocommerce'); ?></h3>
						</div>
					</div>
					<div class="k-checkout__fields">
						<?php do_action('woocommerce_checkout_billing'); ?>
					</div>
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
						<?php do_action('woocommerce_checkout_shipping'); ?>
					</div>
				</div>

			</div>
		</div>

		<?php do_action('woocommerce_checkout_after_customer_details'); ?>

		<?php endif; ?>

		<?php do_action('woocommerce_checkout_before_order_review_heading'); ?>

		<?php do_action('woocommerce_checkout_before_order_review'); ?>

		<div id="order_review" class="woocommerce-checkout-review-order">
			<h3 id="order_review_heading"><?php esc_html_e( 'Your order', 'woocommerce' ); ?></h3>
			<?php do_action('woocommerce_checkout_order_review'); ?>
		</div>

		<?php
			do_action('woocommerce_checkout_after_order_review'); 
			do_action('woocommerce_after_checkout_form', $checkout);
		?>
		</form>
	</div>
</section>
<?php
get_footer();
?>
