<?php
/* Template Name: 2019 Checkout Page */

global $wp;

if (!defined('ABSPATH')) {
	exit;
}

// Upon a successful purchase, send the user to our custom Thank You page instead of the default Woo stuff
if (strpos($wp->request, 'order-received')) {
	wp_redirect(site_url() . '/order-received', 301);
}

get_header();


$checkout = WC()->checkout();
$cart = WC()->cart;
$user_id = get_current_user_id();
$user_data = get_userdata($user_id);

/**
 * Veterans get a 25% discount automatically applied in the form of a special coupon.
 */
function is_valid_veteran() {
	global $user_id;
	global $user_data;
	global $cart;

	// Accounts with 'veteran' role created before the new system launched get grandfathered in
	$launch_date = 1578441600; 
	$registered_before_new_system = strtotime($user_data->user_registered) < $launch_date;
	$is_legacy_veteran = in_array('veteran', $user_data->roles) && $registered_before_new_system;

	// Now check for our current setup:
	$is_valid_veteran = get_fields('user_' . $user_id)['veteran_status'] == 'Veteran Approved';

	return $is_legacy_veteran || $is_valid_veteran;
}

$veteran_coupon_already_applied = in_array('veteran coupon', $cart->get_applied_coupons());
$do_apply = is_valid_veteran() && !$veteran_coupon_already_applied;

/**
 * If the veteran coupon is not applied,
 * and the user is an approved veteran:
 */
if ($do_apply && !$veteran_coupon_already_applied) {
  $cart->apply_coupon('veteran coupon');
}
/**
 * If a non-veteran tries to use the veteran coupon, 
 * or if a valid veteran decides to remove the coupon:
 */
$valid_veteran_remove_coupon = $_GET['remove_coupon'] == 'veteran coupon';
if (!$user_is_veteran_role && $valid_veteran_remove_coupon) {
	$cart->remove_coupon('veteran coupon');
}

do_action('k_before_first_section');
?>

<section class="k-checkout k-block k-block--md k-no-padding--top">
	<div class="k-inner k-inner--sm">

		<div class="k-checkout__headline">
			<h1 class="k-headline k-headline--md">Checkout</h1>
			<?php if (!is_user_logged_in()) : ?>
			<div class="woocommerce-form-login-toggle">
				Returning customer? <a href="<?php echo site_url() . '/login'; ?>">Click here to log in.</a>
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
