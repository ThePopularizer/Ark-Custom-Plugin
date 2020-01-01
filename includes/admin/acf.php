<?php

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
