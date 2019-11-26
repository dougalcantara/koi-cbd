<ul>
  
  <?php
  foreach(array_slice(get_users(array('role' => 'veteran')), 0, 100) as $veteran_user) :
    echo '<li>' . $veteran_user . '</li>';
  endforeach;
  ?>
  </ul>