<?php

if ( !function_exists( 'get_field' ) ) {
	return;
}

$option = get_field('post_types', 'option');
if ( (!$option) || (!in_array('features', $option, true)) ) {
	return;
}

if ( ! function_exists('features_post_type') ) {

// Register Custom Post Type
function features_post_type() {

	$labels = array(
		'name'                  => _x( 'Features', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Feature', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Features', 'text_domain' ),
		'name_admin_bar'        => __( 'Feature', 'text_domain' ),
		'archives'              => __( 'Feature Archives', 'text_domain' ),
		'attributes'            => __( 'Feature Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Feature:', 'text_domain' ),
		'all_items'             => __( 'All Features', 'text_domain' ),
		'add_new_item'          => __( 'Add New Feature', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Feature', 'text_domain' ),
		'edit_item'             => __( 'Edit Feature', 'text_domain' ),
		'update_item'           => __( 'Update Feature', 'text_domain' ),
		'view_item'             => __( 'View Feature', 'text_domain' ),
		'view_items'            => __( 'View Features', 'text_domain' ),
		'search_items'          => __( 'Search Features', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Features list', 'text_domain' ),
		'items_list_navigation' => __( 'Features list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter Features list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Feature', 'text_domain' ),
		'description'           => __( 'Features offered.', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions',  ),
		'taxonomies'            => array( 'features-category' ),
		'hierarchical'          => true,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-star-filled',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'features', $args );

}
add_action( 'init', 'features_post_type', 0 );

}

if ( ! function_exists( 'features_category' ) ) {

// Register Custom Taxonomy
function features_category() {

	$labels = array(
		'name'                       => _x( 'Categories', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Category', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Categories', 'text_domain' ),
		'all_items'                  => __( 'All Categories', 'text_domain' ),
		'parent_item'                => __( 'Parent Category', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Category:', 'text_domain' ),
		'new_item_name'              => __( 'New Category Name', 'text_domain' ),
		'add_new_item'               => __( 'Add New Category', 'text_domain' ),
		'edit_item'                  => __( 'Edit Category', 'text_domain' ),
		'update_item'                => __( 'Update Category', 'text_domain' ),
		'view_item'                  => __( 'View Category', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate Categories with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove Categories', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular Categories', 'text_domain' ),
		'search_items'               => __( 'Search Categories', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
		'no_terms'                   => __( 'No Categories', 'text_domain' ),
		'items_list'                 => __( 'Categories list', 'text_domain' ),
		'items_list_navigation'      => __( 'Categories list navigation', 'text_domain' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'features_category', array( 'features' ), $args );

}
add_action( 'init', 'features_category', 0 );

}

/* Custom Excerpt Description */

function features_excerpt( $translation, $original ) {
    if ( 'Excerpt' == $original ) {
        return 'Features Excerpt';
    }else{
        $pos = strpos($original, 'Excerpts are optional hand-crafted summaries of your content that can be used in your theme.');
        if ($pos !== false) {
            return  'This is the brief summary that will appear on the homepage. Keep it short and to the point.';
        }
    }
    return $translation;
}
add_filter( 'gettext', 'features_excerpt', 20, 3 );
