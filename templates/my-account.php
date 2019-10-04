<?php
/* Template Name: 2019 Account Page */

/**
 * My Account page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.0
 */
defined( 'ABSPATH' ) || exit;

get_header();

do_action('k_before_first_section');

// 301 to acct login page if user not logged in
if (!is_user_logged_in()) :
  wp_redirect(site_url() . '/account/login', 301);
endif;
?>

<section class="k-dashboard k-block k-block--md woocommerce-MyAccount-content">
	<div class="k-inner k-inner--xl">

		<div class="k-dashboard--sidebar">
			<?php	do_action('woocommerce_account_navigation'); ?>
		</div>

		<div class="k-dashboard--main">
			<div class="k-dashboard--main__liner">
				<?php do_action('woocommerce_account_content'); ?>
			</div>
		</div>

	</div>
</section>

<?php
get_footer();
?>
