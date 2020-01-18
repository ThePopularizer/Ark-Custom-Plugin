<?php

if ( ! defined( 'ABSPATH' ) ) exit;

/* Add ACF Options Page */

function add_options_pages()
{
  if( function_exists('acf_add_options_page') ) {

  	acf_add_options_page(array(
  		'page_title' 	=> 'Your Website',
  		'menu_title'	=> 'Your Website',
  		'menu_slug' 	=> 'your-website',
  		'position' => 2.1,
  		'icon_url' => 'dashicons-admin-home',
  	));

  	// acf_add_options_sub_page(array(
  	// 	'page_title' 	=> 'Theme Header Settings',
  	// 	'menu_title'	=> 'Header',
  	// 	'parent_slug'	=> 'theme-general-settings',
  	// ));

  }
}
add_action('init', 'add_options_pages');

function admin_google_maps_api() {
  add_filter('acf/settings/google_api_key', function () {
    $key = get_field('google_maps_api', 'option');
    return $key;
  });
}
add_action('admin_init', 'admin_google_maps_api');

/***** SECTION: Whitelabeling */

add_action('login_head', 'custom_login_logo');
function custom_login_logo() {
	echo '<style type="text/css">
		body {
			background: #33abff;
		}
    h1 a {
			background-image:url(https://res.cloudinary.com/thepopularizer/image/upload/v1550263796/ThePopularizer-Logo.png) !important; background-size: contain !important;height: 150px !important; width: 311px !important; margin-bottom: 0 !important; padding-bottom: 0 !important;
		}
    .login form {
			 margin-top: 10px !important;
		 }
    </style>';
}

add_filter( 'login_headerurl', 'url_login' );
function url_login(){
	return 'https://thepopularizer.com';
}

add_filter( 'login_headertitle', 'login_logo_url_title' );
function login_logo_url_title() {
  return 'ThePopularizer - Promote your Cause, Commerce, & Community!';
}

add_action( 'init', 'login_checked_remember_me' );
function login_checked_remember_me() {
  add_filter( 'login_footer', 'rememberme_checked' )
  ;
}
function rememberme_checked() {
  echo "<script>document.getElementById('rememberme').checked = true;</script>";
}

add_filter ( 'login_errors', 'failed_login' );
function failed_login () {
  return 'The login information you have entered is incorrect. Please try again.';
}

add_filter( 'admin_footer_text', 'modify_footer_admin' );
function modify_footer_admin () {
  echo '<span id="footer-thankyou">Thank you for working with <a target="_blank" href="https://thepopularizer.com" title="Promote your Cause, Commerce, &amp; Community!">ThePopularizer</a>!</span> | <a href="mailto:Tim@thepopularizer.com"><i class="fa fa-fw fa-envelope-o"></i> Email Tim</a>';
}

add_action( 'admin_bar_menu', 'remove_wp_logo', 999 );
function remove_wp_logo( $wp_admin_bar ) {
	$wp_admin_bar->remove_node( 'wp-logo' );
}

function admin_default_page() {
  return '/wp-admin/admin.php?page=your-website';
}
add_filter('login_redirect', 'admin_default_page');
