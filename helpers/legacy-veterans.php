<?php
/**
 * !- Read carefully before executing -!
 * 
 * Below is a pretty scary script if used incorrectly, since it
 * iterates over every user in the database. 
 * 
 * Previously, "veteran" status was managed through the Ultimate
 * Member plugin. Now, we are using HubSpot as the source of truth
 * for that status.
 * 
 * The implementation works like this:
 * 
 * 1) User fills out veteran application on /veteran-program
 * 2) Koi staff member approves user in HubSpot
 * 3) HubSpot fires webhook that's received by /helpers/members.php
 * 4) User is created in WP with "veteran" role, and their 
 *    "veteran_status" ACF field is switched to "Veteran Approved"
 * 5) User is sent a HubSpot email with temp login creds
 * 6) When the user visits the /cart or /checkout pages, a discount is
 *    automatically applied via a coupon
 * 
 * The ACF key mentioned in step 4 is how we'll check for veteran status
 * from templates. However, that will ignore users that were previously
 * approved veterans through the UM plugin.
 * 
 * This script upgrades legacy veterans to use this new identifier 
 * instead of the UM one.
 * 
 * This script was written with intention of only being run once
 * when the site is initially launched. 
 * 
 * To run it, you can either:
 * 
 * 1) Include this file in the footer, or
 * 2) fire this function from functions.php, or
 * 3) paste the body of this function anywhere you want to run it
 * 
 * In any case, make sure you only run it once and the remove it.
 * Pretty crazy performance hit.
 * 
 * Good luck!
 */
function update_legacy_veterans() {
  // Only allow admins to run it
  if (!current_user_can('manage_options')) :
    return;
  endif;

  $legacy_args = array(
    'role' => 'veteran',
    'meta_value' => 'approved',
  );
  
  $legacy_veterans = get_users($legacy_args);
  
  foreach($legacy_veterans as $legacy_veteran) :
    $post_id = 'user_' . $legacy_veteran->ID;
    $acf_key = 'veteran_status';
    $new_value = 'Veteran Applied';
  
    update_field($acf_key, $new_value, $post_id);
  endforeach;  
}

update_legacy_veterans();
