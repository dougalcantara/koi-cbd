<?php
/**
 * Class Member
 */

class Member {
  static public function delete() {
    if($_POST['password']) {
      global $current_user;
      if(!is_wp_error(wp_authenticate($current_user->user_login, $_POST['password']))) {
        require_once(ABSPATH.'wp-admin/includes/user.php' );
        $current_user = wp_get_current_user();
        wp_delete_user( $current_user->ID );
        wp_redirect(home_url() . '/login');
      } else {
        echo '<p>Your password is incorrect</p>';
      }
    }
  }
}