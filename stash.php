<?php
  $response = wp_remote_get('https://api.yotpo.com/v1/widget/MS3VY5Cc4TFD6zbI2zGhMsb9gvkPpQDKwUcPhaSG/products/205491/reviews.json');

  var_dump($response);
?>