<?php

if ( !function_exists( 'get_field' ) )
return;

$option = get_field('post_types', 'option');
if ( (!$option) || (!in_array('publications', $option)) ) {
	return;
}

/* Publications */

if ( ! function_exists( 'Publication_category' ) ) {

function Publication_category() {

	$labels = array(
		'name'                       => _x( 'Publication Categories', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Publication Category', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Categories', 'text_domain' ),
		'all_items'                  => __( 'All Publication Categories', 'text_domain' ),
		'parent_item'                => __( 'Parent Publication Category', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Publication Category:', 'text_domain' ),
		'new_item_name'              => __( 'New Publication Category Name', 'text_domain' ),
		'add_new_item'               => __( 'Add New Publication Category', 'text_domain' ),
		'edit_item'                  => __( 'Edit Publication Category', 'text_domain' ),
		'update_item'                => __( 'Update Publication Category', 'text_domain' ),
		'view_item'                  => __( 'View Publication Category', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate Publication Categories with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove Publication Categories', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular Publication Categories', 'text_domain' ),
		'search_items'               => __( 'Search Publication Categories', 'text_domain' ),
		'not_found'                  => __( 'Publication Categories Not Found', 'text_domain' ),
		'no_terms'                   => __( 'No Publication Categories', 'text_domain' ),
		'items_list'                 => __( 'Publication Categories list', 'text_domain' ),
		'items_list_navigation'      => __( 'Publication Categories list navigation', 'text_domain' ),
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
	register_taxonomy( 'publication_category', array( 'publications' ), $args );

}
add_action( 'init', 'publication_category', 0 );

}


if ( ! function_exists('publications_post_type') ) {

// Register Custom Post Type
function publications_post_type() {

	$labels = array(
		'name'                  => _x( 'Publications', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Publication', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Publications', 'text_domain' ),
		'name_admin_bar'        => __( 'Publication', 'text_domain' ),
		'archives'              => __( 'Publications Archives', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Publication:', 'text_domain' ),
		'all_items'             => __( 'All Publications', 'text_domain' ),
		'add_new_item'          => __( 'Add New Publication', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Publication', 'text_domain' ),
		'edit_item'             => __( 'Edit Publication', 'text_domain' ),
		'update_item'           => __( 'Update Publication', 'text_domain' ),
		'view_item'             => __( 'View Publication', 'text_domain' ),
		'search_items'          => __( 'Search Publication', 'text_domain' ),
		'not_found'             => __( 'Publication Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Publication Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set Featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into publication', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this publication', 'text_domain' ),
		'items_list'            => __( 'Publications list', 'text_domain' ),
		'items_list_navigation' => __( 'Publications list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter Publications list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Publication', 'text_domain' ),
		'description'           => __( 'Publications', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail', 'comments', 'revisions', ),
		'taxonomies'            => array( 'publication_category', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-book',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
	);
	register_post_type( 'publications', $args );

}
add_action( 'init', 'publications_post_type', 0 );

}

/* File Download & Embed */

function publication_post($content) {
	if ( is_single() ) {
		$file = get_field('file_upload');
		if ( $file ) {
			$url = $file['url'];?>
			<div class="panel panel-default">
				<div class="panel-heading"><i class="fa fa-calendar-o fa-fw"></i>Issue: <?php the_date(); ?></div>
				<div class="line-height-0">
					<iframe class="fullwidth" src="<?php echo $url; ?>" height="1200px" frameborder="0"></iframe>
				</div>
				 <div class="panel-footer text-center"><?php echo do_shortcode('[download-button]'); ?></div>
			</div>
			<?php
		}
	}
}
add_shortcode( 'publication-details', 'publication_post' );

/* Post Relationships: Publication -> Posts */

add_shortcode( 'post-links', 'publication_links' );
function publication_links( $atts ) {
	ob_start();
	$posts = get_field('included_articles');
	if( $posts ): ?>
	<div class="related-panel panel panel-default">
		<div class="panel-heading">
			<h4><i class="fa fa-rss"></i> Included in this issue</h4></div>
			<!-- <div class="panel-body">
		</div> -->
		<div class="list-group">
			<?php foreach( $posts as $p ): // variable must NOT be called $post (IMPORTANT) ?>
				<a class="list-group-item" href="<?php echo get_permalink( $p->ID ); ?>"><?php echo get_the_title( $p->ID ); ?></a>
				<!-- <span>Custom field from $post: <?php the_field('__FIELD_IN_POST__', $p->ID); ?></span> -->
			<?php endforeach; ?>
		</div>
	</div>
<?php endif;
return ob_get_clean();
wp_reset_query();
}
if ( ( is_single() ) ) {
	function show_publication_links() {
		if ( get_field('included_articles') ) {
			echo do_shortcode("[post-links]");
		}
	}
}

/* Reverse Query: Post -> Publication */

function source_publication($content) {
	$relatedposts = get_posts(array(
		'post_type' => 'publications',
		'meta_query' => array(
			array(
				'key' => 'included_articles', // name of custom field
				'value' => '"' . get_the_ID() . '"', // matches exaclty "123", not just 123. This prevents a match for "1234"
				'compare' => 'LIKE'
			)
		)
	));
	if( (is_single()) && $relatedposts ): ?>
	<div class="post-links-wrapper">
		<div class="related-panel panel panel-default ">
			<div class="panel-heading"><h3><i class="fa fa-rss"></i> Source Publication</h3></div>
			<!-- <div class="panel-body"></div> -->
			<div class="list-group">
				<?php foreach( $relatedposts as $relatedpost ): ?>
					<a class="list-group-item" href="<?php echo get_permalink( $relatedpost->ID ); ?>" target="_blank">
						<?php echo get_the_post_thumbnail( $relatedpost->ID, 'medium' ); ?>
						<h4><?php echo get_the_title( $relatedpost->ID ); ?></h4>
						<?php echo do_shortcode("[download-button]"); ?>
					</a>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
<?php endif;
return $content;
}
add_shortcode( 'publication-posts', 'source_publication' );


/*************** Custom Post Types  ***************/

/* Link Tags archive to Custom Post Types */

add_filter('pre_get_posts', 'query_post_type');
function query_post_type($query) {
  if(is_category() || is_tag()) {
    $post_type = get_query_var('post_type');
	if($post_type)
	    $post_type = $post_type;
	else
	    $post_type = array('post','publications'); // replace cpt to your custom post type
    $query->set('post_type',$post_type);
	return $query;
  }
}


/*************** Loop Shortcodes ***************/

function publications_loop() {
	$file = get_field('file_upload');
	if ( $file ) {
		$url = $file['url']; ?>
		<div class="panel panel-default publications-wrapper">
			<div class="panel-heading">
				<h3 class="panel-title">
					<a href="<?php echo get_permalink( $p->ID ); ?>">
						<?php echo get_the_title( $p->ID ); ?>, <?php echo get_the_date( $p -> ID ); ?>
					</a>
				</h3>
			</div>
			<div class="panel-body">
				<!-- <a href="<?php echo get_permalink( $p->ID ); ?>">
					<img class="bulletin-cover perspective" src="/wp-content/uploads/cover.jpg" alt=""/>
				</a> -->
				<div class="btn-group btn-group-lg <?php echo $alignmentClass ?>" role="group">
					<a class="btn btn-default" href="<?php echo get_permalink( $p->ID ); ?>"><i class="fa fa-eye"></i> View</a>
					<?php echo do_shortcode("[download-button]"); ?>
				</div>
			</div>
		</div>
		<div class="margin-bottom"></div>
		<?
	}
}
add_shortcode( 'publications-loop', 'publications_loop' );

function publications_list( $atts ) {

	extract( shortcode_atts( array (
		'type' => 'publications',
		'order' => 'date',
		'posts' => 1,
		'category' => '',
		'align' => 'horizontal',
	), $atts ) );

// define query parameters based on attributes

	$options = array(
		 'post_type' => $type,
		 'order' => $order,
		 'posts_per_page' => $posts,
		 'category_name' => $category,
		 'align' => $align,
	);

	$alignmentClass = 'horizontal';
	if ($align == 'vertical') {
		$alignmentClass = "btn-group-vertical";
	}

	ob_start();
	$loop = new WP_Query( $options );

	while ( $loop->have_posts() ) : $loop->the_post();
	$file = get_field('file_upload');
	if ( $file ) {
		$url = $file['url']; ?>
		<div class="panel panel-default publications-wrapper">
			<div class="panel-heading">
				<h3 class="panel-title">
					<a href="<?php echo get_permalink( $p->ID ); ?>">
						<?php echo get_the_title( $p->ID ); ?><br/>
						<small><?php echo get_the_date( $p -> ID ); ?></small>
					</a>
				</h3>
			</div>
			<div class="panel-body">
				<!-- <a href="<?php echo get_permalink( $p->ID ); ?>">
					<img class="bulletin-cover perspective" src="/wp-content/uploads/cover.jpg" alt=""/>
				</a> -->
				<div class="btn-group btn-group-lg <?php echo $alignmentClass ?>" role="group">
					<a class="btn btn-default" href="<?php echo get_permalink( $p->ID ); ?>"><i class="fa fa-eye"></i> View</a>
					<?php echo do_shortcode("[download-button]"); ?>
				</div>
			</div>
		</div>
		<div class="margin-bottom"></div>
		<?
	}
endwhile; ?>
<nav>
	<?php previous_posts_link('&laquo; Newer',$wp_query->max_num_pages); ?>
	<?php next_posts_link('Older &raquo;',$wp_query->max_num_pages); ?>
</nav>
<?php
return ob_get_clean();
}
add_shortcode( 'publications-list', 'publications_list' );
