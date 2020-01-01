<?php

add_action( 'wp_enqueue_scripts', 'enqueue_font_awesome', 1);
function enqueue_font_awesome() {
  wp_enqueue_style( 'font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' );
}

/* Content Width */

// if ( ! isset( $content_width ) ) {
// 	$content_width = 1100;
// }

/********** SECTION: Usability */

/* Remove Admin Menus for Non-Administrators */

// if ( ! current_user_can( 'administrator' ) ) {
// 	add_action( 'admin_menu', 'remove_links_menu' );
// 	function remove_links_menu() {
// 	     remove_menu_page('link-manager.php');
// 	}
// }

/* Email Notifications */

// function custom_comment_moderation_recipients( $emails, $comment_id ) {
// function custom_comment_moderation_recipients( $detail, $comment_id ) {
// 	if( have_rows('contact_details', 'options') ) {
// 		while( have_rows('contact_details', 'options') ): the_row();
// 			$type = get_sub_field('type', 'options');
// 			$detail = get_sub_field('detail', 'options');
// 			if ($type == 'envelope-o') {
// 				return $detail;
// 			}
// 		endwhile;
// 	}
// }
// add_filter( 'comment_moderation_recipients', 'custom_comment_moderation_recipients', 11, 2 );
// add_filter( 'comment_notification_recipients', 'custom_comment_moderation_recipients', 11, 2 );

/*****  SECTION: Fixes & Patches */

/* IE Conditional Styes */

// function ie_8_and_below_css () {
// 	wp_register_style( 'ie8', get_stylesheet_directory_uri() . '/css/style-ie8.css'  );
// 	$GLOBALS['wp_styles']->add_data( 'ie8', 'conditional', 'lte IE 8' );
// 	wp_enqueue_style( 'ie8' );
// }
// add_action ('wp_enqueue_scripts','ie_8_and_below_css');
//
// function ie_7_and_below_css () {
// 	wp_register_style( 'ie7', get_stylesheet_directory_uri() . '/css/style-ie7.css'  );
// 	$GLOBALS['wp_styles']->add_data( 'ie7', 'conditional', 'lte IE 7' );
// 	wp_enqueue_style( 'ie7' );
// }
// add_action ('wp_enqueue_scripts','ie_7_and_below_css');

/* Enable Shortcodes */

// add_filter( 'term_description', 'do_shortcode' );

/* Reset Metaboxes */

// function prefix_reset_metabox_positions(){
//   delete_user_meta( wp_get_current_user()->ID, 'meta-box-order_post' );
//   delete_user_meta( wp_get_current_user()->ID, 'meta-box-order_page' );
//   delete_user_meta( wp_get_current_user()->ID, 'meta-box-order_custom_post_type' );
// }
// add_action( 'admin_init', 'prefix_reset_metabox_positions' );
