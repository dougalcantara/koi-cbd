<?php /**
 * Class Members
 * Creates a WP Endpoint for HS webhook.
 * When fired, inserts/updates WP user with role of veteran.
 * Then sends back to HS with password and reset link.
 */

class Members {

  private $api_key = '9f7da0c8-2d44-40e9-86da-125a458151ce';

  public function __construct() {
    add_action('rest_api_init', array($this, 'endpoint'));
  }

  public function endpoint() {
    register_rest_route('veterans/v1', 'create', array(
      'methods' => 'POST',
      'callback' => array($this, 'create')
    ));
  }

  public function create($request) {
    $contactData = json_decode($this->get_hubspot_user($request['objectId']), true);
    $contact = array(
      'firstname' => $contactData['properties']['firstname']['value'],
      'lastname' => $contactData['properties']['lastname']['value'],
      'email' => $contactData['properties']['email']['value'],
      'password' => wp_generate_password(20)
    );
    $response = new WP_REST_Response($contact);
    if($request['objectId']) {
      $response->set_status(200);
      $response->set_data($this->sendUser([
        'vid' => $request['objectId'],
        'password' => $contact['password'],
        'new_user' => $this->create_user($contact)
      ]));
    } else {
      $response->set_status(501);
    }
    return $response;
  }

  public function get_hubspot_user($id) {
    $curl = curl_init('https://api.hubapi.com/contacts/v1/contact/vid/'.$id.'/profile?property=firstname&property=lastname&property=email&hapikey='.$this->api_key);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    return $data = curl_exec($curl);
  }

  private function create_user($fields) {
    $user = array(
      'user_login' =>  $fields['email'],
      'user_pass'  =>  md5($fields['password']),
      'first_name' => $fields['firstname'],
      'last_name' => $fields['lastname'],
      'user_email' => $fields['email'],
      'role' => 'veteran'
    );
    if(email_exists($fields['email'])) {
      $wp_user = get_user_by('email', $fields['email']);
      $update = $wp_user;
      $update->set_role('veteran');
      wp_update_user($wp_user, $update);
      return false;
    } else {
      wp_insert_user($user);
      return true;
    }
  }

  public function sendUser($user) {
    $email = get_field('email', $_GET['id']);
    $ch = @curl_init();
    @curl_setopt($ch, CURLOPT_POST, true);
    @curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
      'properties' => array(
        array(
          'property' => 'veteran_password_link',
          'value' => get_home_url() . '/password-reset'
        ),
        array(
          'property' => 'veteran_temp_password',
          'value' => $user['password']
        ),
        array(
          'property' => 'new_wordpress_user',
          'value' => $user['new_user']
        )
      )
    ]));
    @curl_setopt($ch, CURLOPT_URL, 'https://api.hubapi.com/contacts/v1/contact/vid/'.$user['vid'].'/profile?hapikey='.$this->api_key);
    @curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    @curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = @curl_exec($ch);
    $status_code = @curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curl_errors = curl_error($ch);
    @curl_close($ch);
    return $status_code;
  }

}