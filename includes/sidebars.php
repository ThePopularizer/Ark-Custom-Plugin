<?php

if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! function_exists( 'custom_sidebars' ) ) {

// Register Sidebars
function custom_sidebars() {

	$args = array(
		'id'            => 'primary-sidebar',
		'class'         => 'primary sidebar',
		'name'          => __( 'Primary Sidebar', 'text_domain' ),
	);
	register_sidebar( $args );

	$args = array(
		'id'            => 'secondary-sidebar',
		'class'         => 'secondary sidebar',
		'name'          => __( 'Secondary Sidebar', 'text_domain' ),
	);
	register_sidebar( $args );

	$args = array(
		'id'            => 'footer-1',
		'class'         => 'footer-1 sidebar',
		'name'          => __( 'Footer Area 1', 'text_domain' ),
	);
	register_sidebar( $args );

	$args = array(
		'id'            => 'footer-2',
		'class'         => 'footer-2 sidebar',
		'name'          => __( 'Footer Area 2', 'text_domain' ),
	);
	register_sidebar( $args );


	if (defined('WC_VERSION')) {
		$args = array(
			'id'            => 'woocommerce-sidebar',
			'class'         => 'woocommerce sidebar',
			'name'          => __( 'WooCommerce Sidebar', 'text_domain' ),
		);
		register_sidebar( $args );
	}

}
add_action( 'widgets_init', 'custom_sidebars' );

}
