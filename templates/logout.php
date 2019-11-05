<?php

/* Template Name: 2019 Logout Page */
defined( 'ABSPATH' ) || exit;

get_header();

wp_logout();

wp_redirect(site_url() . '/account', 301);

get_footer();
?>