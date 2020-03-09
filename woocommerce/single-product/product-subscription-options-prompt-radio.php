<?php
/**
 * Product Subscription Options Radio Prompt Template.
 *
 * Override this template by copying it to 'yourtheme/woocommerce/single-product/product-subscription-options-prompt-radio.php'.
 *
 * On occasion, this template file may need to be updated and you (the theme developer) will need to copy the new files to your theme to maintain compatibility.
 * We try to do this as little as possible, but it does happen.
 * When this occurs the version of the template file will be bumped and the readme will list any important changes.
 *
 * @version 3.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="select_options_area">
<ul class="select_option wcsatt-options-prompt-radios">
	<li class="wcsatt-options-prompt-radio" id="yes_option"  onClick="yes_opt();" style="background-color: #f4b13e;">
		<label class="wcsatt-options-prompt-label wcsatt-options-prompt-label-subscription">
			<input class="wcsatt-options-prompt-action-input" type="radio" name="subscribe-to-action-input" value="yes" />
			<span class="wcsatt-options-prompt-action">Yes<?php // echo $subscription_cta; ?></span>
		</label>
	</li>
	<li class="wcsatt-options-prompt-radio" id="no_option" onClick="no_opt();" style="background-color: #000000;">
		<label class="wcsatt-options-prompt-label wcsatt-options-prompt-label-one-time">
			<input class="wcsatt-options-prompt-action-input" type="radio" name="subscribe-to-action-input" value="no" />
			<span class="wcsatt-options-prompt-action">No<?php // echo $one_time_cta; ?></span>
		</label>
	</li>
</ul>
</div>
<div class="select_options_text">
Subscribe & Save
</div>
<div class="clear"></div>
