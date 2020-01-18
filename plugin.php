<?php
/*
Plugin Name:	ThePopularizer Custom Functions
Plugin URI:		https://example.com
Description:	Custom Functions by ThePopularizer.
Version:		1.0.2
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

if ( ! defined( 'ABSPATH' ) ) exit;

require 'plugin-update-checker/plugin-update-checker.php';
$MyUpdateChecker = Puc_v4p8_Factory::buildUpdateChecker(
'https://raw.githubusercontent.com/ThePopularizer/Ark-Custom-Plugin/master/sync.json',
__FILE__,
'plugin'
);

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
	wp_enqueue_script( 'custom-scripts', plugin_dir_url( __FILE__ ) . 'js/scripts.js', '', '9.9.0', true );
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

if( function_exists('get_field')) {
	$option = get_field('post_types', 'option');
	if ( (in_array('locations', $option)) ) {
		add_action( 'wp_enqueue_scripts', 'map_enqueue_files', 10);
		function map_enqueue_files() {
			wp_enqueue_script( 'google-map-site-js', plugin_dir_url( __FILE__ ) . 'js/google-maps.js', '', 1.1, true);
		}
	}
}

/**
 * Plugin Name: ACF Local JSON
 * Plugin URI:  https://github.com/wplit/ACF-Local-JSON/
 * GitHub URI:  wplit/ACF-Local-JSON/
 * Description: Allows using Local JSON with ACF Pro without using a theme. Made for Oxygen Builder where the theme is disabled.
 * Version:     1.0.0
 * Author:      David Browne
 * Author URI:  https://wplit.com/
 *
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License version 2, as published by the
 * Free Software Foundation.  You may NOT assume that you can use any other
 * version of the GPL.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE.
 *
 * @package    OxygenACFLocalJSON
 * @since      1.0.0
 * @copyright  Copyright (c) 2018, David Browne
 * @license    GPL-2.0+
 */

add_filter('acf/settings/save_json', 'lit_acf_json_save_point');
/**
 * Adds plugin directory as new location for ACF Pro to save JSON
 *
 * @since 1.0.0
 *
 * @param $path Original path
 * @return new path as /acf-json/
 */
function lit_acf_json_save_point( $path ) {

    // update path
    $path = plugin_dir_path( __FILE__ ) . '/acf-json';

    // return
    return $path;

}

add_filter('acf/settings/load_json', 'lit_acf_json_load_point');
/**
 * Adds plugin directory as new location for ACF Pro to load JSON
 *
 * @since 1.0.0
 *
 * @param array $paths Original path
 * @return new path as /acf-json/
 */
function lit_acf_json_load_point( $paths ) {

    // remove original path
    unset($paths[0]);

    // append path
    $paths[] = plugin_dir_path( __FILE__ ) . '/acf-json';

    // return
    return $paths;

}
