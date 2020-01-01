<?php

if ( !function_exists( 'get_field' ) ) {
	return;
}

$option = get_field('post_types', 'option');
if ( (!$option) || (!in_array('logos', $option, true)) ) {
	return;
}

// Register Custom Post Type
function logos_post_type() {

	$labels = array(
		'name'                  => _x( 'Credibility Logos', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Credibility Logo', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Credibility Logos', 'text_domain' ),
		'name_admin_bar'        => __( 'Credibility Logo', 'text_domain' ),
		'archives'              => __( 'Logo Archives', 'text_domain' ),
		'attributes'            => __( 'Logo Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Logo:', 'text_domain' ),
		'all_items'             => __( 'All Logos', 'text_domain' ),
		'add_new_item'          => __( 'Add New Logo', 'text_domain' ),
		'add_new'               => __( 'Add New Logo', 'text_domain' ),
		'new_item'              => __( 'New Logo', 'text_domain' ),
		'edit_item'             => __( 'Edit Logo', 'text_domain' ),
		'update_item'           => __( 'Update Logo', 'text_domain' ),
		'view_item'             => __( 'View Logo', 'text_domain' ),
		'view_items'            => __( 'View Logos', 'text_domain' ),
		'search_items'          => __( 'Search Logo', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Logo Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set Logo image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove Logo image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as Logo image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into Logo', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Logo', 'text_domain' ),
		'items_list'            => __( 'Logos list', 'text_domain' ),
		'items_list_navigation' => __( 'Logos list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter Logos list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Credibility Logo', 'text_domain' ),
		'description'           => __( 'Credibility Logos', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'thumbnail' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-image-filter',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'logos', $args );

}
add_action( 'init', 'logos_post_type', 0 );
