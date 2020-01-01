<?php

if ( !function_exists( 'get_field' ) )
return;

$option = get_field('post_types', 'option');
if ( (!$option) || (!in_array('portfolios', $option)) ) {
	return;
}

// Register Custom Post Type

if ( ! function_exists('portfolio_post_type') ) {

function portfolio_post_type() {

	$labels = array(
		'name'                  => _x( 'Portfolios', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Portfolio', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Portfolios', 'text_domain' ),
		'name_admin_bar'        => __( 'Portfolio', 'text_domain' ),
		'archives'              => __( 'Portfolio Archives', 'text_domain' ),
		'attributes'            => __( 'Portfolio Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Portfolio:', 'text_domain' ),
		'all_items'             => __( 'All Portfolios', 'text_domain' ),
		'add_new_item'          => __( 'Add New Portfolio', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Portfolio', 'text_domain' ),
		'edit_item'             => __( 'Edit Portfolio', 'text_domain' ),
		'update_item'           => __( 'Update Portfolio', 'text_domain' ),
		'view_item'             => __( 'View Portfolio', 'text_domain' ),
		'view_items'            => __( 'View Portfolio', 'text_domain' ),
		'search_items'          => __( 'Search Portfolios', 'text_domain' ),
		'not_found'             => __( 'Portfolio Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Portfolio Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into Portfolio', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Portfolio', 'text_domain' ),
		'items_list'            => __( 'Portfolios list', 'text_domain' ),
		'items_list_navigation' => __( 'Portfolios list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter Portfolios list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Portfolio', 'text_domain' ),
		'description'           => __( 'Portfolio posts.', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'revisions' ),
		'taxonomies'            => array( 'portfolio-category' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-portfolio',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'portfolio', $args );

}
add_action( 'init', 'portfolio_post_type', 0 );

}


/* Portfolio Categories */

if ( ! function_exists( 'portfolio_category' ) ) {

function portfolio_category() {

	$labels = array(
		'name'                       => _x( 'Portfolio Categories', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Portfolio Category', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Categories', 'text_domain' ),
		'all_items'                  => __( 'All Portfolio Categories', 'text_domain' ),
		'parent_item'                => __( 'Parent Portfolio Category', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Portfolio Category:', 'text_domain' ),
		'new_item_name'              => __( 'New Portfolio Category Name', 'text_domain' ),
		'add_new_item'               => __( 'Add New Portfolio Category', 'text_domain' ),
		'edit_item'                  => __( 'Edit Portfolio Category', 'text_domain' ),
		'update_item'                => __( 'Update Portfolio Category', 'text_domain' ),
		'view_item'                  => __( 'View Portfolio Category', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate Portfolio Categories with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove Portfolio Categories', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular Portfolio Categories', 'text_domain' ),
		'search_items'               => __( 'Search Portfolio Categories', 'text_domain' ),
		'not_found'                  => __( 'Portfolio Categories Not Found', 'text_domain' ),
		'no_terms'                   => __( 'No Portfolio Categories', 'text_domain' ),
		'items_list'                 => __( 'Portfolio Categories list', 'text_domain' ),
		'items_list_navigation'      => __( 'Portfolio Categories list navigation', 'text_domain' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		"publicly_queryable" 				 => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		"show_in_menu" 							 => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'portfolio_category', array( 'portfolio' ), $args );

}
add_action( 'init', 'portfolio_category', 0 );

}
