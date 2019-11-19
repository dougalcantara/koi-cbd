<?php

/* Template Name: 2019 Logout Page */
defined( 'ABSPATH' ) || exit;

get_header();
var_dump($current_user);
wp_logout();
var_dump($current_user);
wp_redirect(site_url() . '/account', 301);

get_footer();
?>