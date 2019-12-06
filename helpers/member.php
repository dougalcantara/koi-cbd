<?php
/**
 * Class Member
 */

defined('ABSPATH') || exit;

class Member {
  public function __construct(){
    add_action("wp_ajax_change_password", array($this, 'change_password'));
    add_action("wp_ajax_nopriv_change_password", array($this, 'change_password'));
  }

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
  public function change_password() {
    global $current_user;
    if(!is_wp_error(wp_authenticate($current_user->user_login, $_POST['old']))) {
      wp_set_password($_POST['next'], $current_user->id);
      echo json_encode(true);
    } else {
      echo  json_encode(false);
    }
    wp_die();
  }
}