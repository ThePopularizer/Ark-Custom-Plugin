<?php
/*
Plugin Name:	Custom Functions
Plugin URI:		https://example.com
Description:	Custom Functions by ThePopularizer.
Version:		1.0.0
Author:			ThePopularizer
Author URI:		https://thepopularizer.// COMBAK:
License:		GPL-2.0+
License URI:	http://www.gnu.org/licenses/gpl-2.0.txt

This plugin is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

This plugin is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with This plugin. If not, see {URI to Plugin License}.
*/

if ( ! defined( 'WPINC' ) ) {
	die;
}

function include_all_php($folder){ foreach (glob("{$folder}/*.php") as $filename) { include_once $filename; } }
include_all_php(plugin_dir_path( __FILE__ ).'includes'); // Function called for "Includes" diretory
include_all_php(plugin_dir_path( __FILE__ ).'includes/post-types'); // Function called for "Includes" diretory
if ( is_admin() ) {
	include_all_php(plugin_dir_path( __FILE__ ).'includes/admin');
} else {
	include_all_php(plugin_dir_path( __FILE__ ).'includes/front');
}


// function add_async_attribute($tag, $handle) {
//    // add script handles to the array below
//    $scripts_to_async = array(
// 		 'async-script',
// 		 'another-handle',
// 	 );
//
//    foreach($scripts_to_async as $async_script) {
//       if ($async_script === $handle) {
//          return str_replace(' src', ' async="async" src', $tag);
//       }
//    }
//    return $tag;
// }
// add_filter( 'script_loader_tag', 'add_async_attribute', 10, 2 );


add_action( 'wp_enqueue_scripts', 'custom_enqueue_files', 20);
/**
 * Loads <list assets here>.
 */
function custom_enqueue_files() {
	wp_enqueue_script( 'async-script', plugin_dir_url( __FILE__ ) . 'js/scripts.js', '', '9.9.0', true );
	// wp_enqueue_script( 'highlightjs-init', plugin_dir_url( __FILE__ ) . 'js/highlight-init.js', '', '1.0.0', true );
}

// Enqueue in footer for performance

function prefix_add_footer_styles() {
	wp_enqueue_style( 'custom-dynamic-styles', wp_upload_dir()['baseurl'] . '/css/dynamicstyle.css' );
  // wp_enqueue_style( 'font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' );
};
if ( !is_admin() ) {
	add_action( 'wp_footer', 'prefix_add_footer_styles' );
}

// Excerpt

add_filter( 'excerpt_length', function($length) {
    return 20;
} );

// Gutenberg

add_theme_support( 'align-wide' );

// Dynamic CSS

function generate_dynamic_css() {
  $ss_dir = plugin_dir_path( __FILE__ );
  ob_start(); // Capture all output into buffer
  require(plugin_dir_path( __FILE__ ) . 'css/dynamicstyle.php'); // Grab the custom-style.php file
  $css = ob_get_clean(); // Store output in a variable, then flush the buffer
	$css = str_replace('; ',';',str_replace(' }','}',str_replace('{ ','{',str_replace(array("\r\n","\r","\n","\t",'  ','    ','    '),"",preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!','',$css)))));
  file_put_contents(wp_upload_dir()['basedir'] . '/css/dynamicstyle.css', $css, LOCK_EX); // Save it as a css file
}
add_action( 'acf/save_post', 'generate_dynamic_css', 20 ); //Parse the output and write the CSS file on post save (thanks Esmail Ebrahimi)
