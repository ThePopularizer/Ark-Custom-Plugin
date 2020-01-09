<?php

if ( !function_exists( 'get_field' ) )
return;

$option = get_field('post_types', 'option');
if ( (!$option) || (!in_array('locations', $option)) ) {
	add_shortcode( 'map', 'shortcode_placeholder' );
	function shortcode_placeholder( $atts ) {

	}
	return;
}
if ( ! function_exists('location_post_type') ) {

	// Register Custom Post Type
	function location_post_type() {

		$labels = array(
			'name'                  => _x( 'Locations', 'Post Type General Name', 'text_domain' ),
			'singular_name'         => _x( 'Location', 'Post Type Singular Name', 'text_domain' ),
			'menu_name'             => __( 'Locations', 'text_domain' ),
			'name_admin_bar'        => __( 'Location', 'text_domain' ),
			'archives'              => __( 'Locations Archives', 'text_domain' ),
			'attributes'            => __( 'Location Attributes', 'text_domain' ),
			'parent_item_colon'     => __( 'Parent Location:', 'text_domain' ),
			'all_items'             => __( 'All Locations', 'text_domain' ),
			'add_new_item'          => __( 'Add New Location', 'text_domain' ),
			'add_new'               => __( 'Add Location', 'text_domain' ),
			'new_item'              => __( 'New Location', 'text_domain' ),
			'edit_item'             => __( 'Edit Location', 'text_domain' ),
			'update_item'           => __( 'Update Location', 'text_domain' ),
			'view_item'             => __( 'View Location', 'text_domain' ),
			'view_items'            => __( 'View Location', 'text_domain' ),
			'search_items'          => __( 'Search Location', 'text_domain' ),
			'not_found'             => __( 'Location Not found', 'text_domain' ),
			'not_found_in_trash'    => __( 'Location Not found in Trash', 'text_domain' ),
			'featured_image'        => __( 'Featured Image', 'text_domain' ),
			'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
			'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
			'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
			'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
			'uploaded_to_this_item' => __( 'Uploaded to this Location', 'text_domain' ),
			'items_list'            => __( 'Locations list', 'text_domain' ),
			'items_list_navigation' => __( 'Locations list navigation', 'text_domain' ),
			'filter_items_list'     => __( 'Filter Locations list', 'text_domain' ),
		);
		$args = array(
			'label'                 => __( 'Location', 'text_domain' ),
			'description'           => __( 'Location', 'text_domain' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail',  'revisions', 'custom-fields', ),
			'hierarchical'          => true,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 5,
			'menu_icon'             => 'dashicons-location',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => true,
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'capability_type'       => 'page',
		);
		register_post_type( 'location', $args );

	}
	add_action( 'init', 'location_post_type', 0 );

}

// Scheduel Table Template

function schedule_table() {
	if ( have_rows('schedule')) { ?>
		<table class="table table-hover">
			<?php while ( have_rows('schedule')): the_row(); ?>

				<tr class="panel-heading light">
					<th colspan="100" class="">
						<h4 class="panel-title"><?php the_sub_field('event_title'); ?></h4>
					</th>
				</tr>
				<?php if ( have_rows('event_times')) { ?>
					<?php while ( have_rows('event_times')): the_row(); ?>
						<tr>
							<td><?php the_sub_field('days'); ?></td>
							<td><?php the_sub_field('hours'); ?></td>
						</tr>
					<?php endwhile; ?>

					<?php
				}
			endwhile; ?>
		</table>
	<?php }
}



// Locations Details

add_shortcode( 'location-details', 'location_function' );
function location_function( $atts ){
	ob_start();
	$additional_details = get_field('additional_details');
	$location = get_field('address'); ?>
	<?php if ( have_rows('schedule') || $additional_details || $location) { ?>
	<div class="panel panel-default">

		<?php schedule_table() ?>

		<?php if ($additional_details || $location) { ?>
			<div class="list-group">
			<?php }
			if ($additional_details) { ?>
				<div class="list-group-item">
					<small>
						<?php echo $additional_details; ?>
					</small>
				</div>
				<?php
			} ?>
			<?php
			if ($location) { ?>
				<div class="panel-heading">
					<h3 class="panel-title">
						Location
					</h3>
				</div>
				<div class="acf-map hidden">
					<div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>">
						<h3><?php the_title(); ?></h3>
						<p>
							<a href="https://www.google.com/maps/dir//<?php echo $location['address']; ?>" target="_blank"><i class="fa fa-location-arrow fa-fw"></i>
								<?php echo $location['address']; ?>
								<br/>
								<span class="btn btn-sm btn-default">Get Directions</span>
							</a>
						</p>
					</div>
				</div>
				<a class="list-group-item" href="https://www.google.com/maps/dir//<?php echo $location['address']; ?>" target="_blank" data-toggle="tooltip" data-placement="bottom" title="Click to Get Directions" ><small><i class="fa fa-location-arrow fa-fw"></i> <?php echo $location['address']; ?></small></a>
			<?php } ?>
			<?php if ($additional_details || $location) { ?>
			</div>
			<?php
		} ?>
	</div>
		<?php
	}
	return ob_get_clean();
}
	add_filter( 'after_post', 'show_location_details', 10, 3 );
if ( ! function_exists('show_location_details')) {
		function show_location_details() {
			echo do_shortcode("[location-details]");
		}
	}

	// Locations List

	function locations_posts() {
		$loop = new WP_Query( array( 'post_type' => 'location', ) );
		ob_start();
		if ( $loop->have_posts() ) :
			while ( $loop->have_posts() ) : $loop->the_post();
			$additional_details = get_field('additional_details');
			$location = get_field('address');
			?>
			<h3>
				<a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a>
			</h3>
			<div class="panel panel-default">
				<?php if ( has_post_thumbnail() ) { ?>
					<a href="<?php the_permalink(); ?>">
						<div class="parallax-slow fullwidth" style="display: block; background-size: cover; background-image: url('<?php the_post_thumbnail_url( 'medium' ); ?>'); height: 150px;" ></div>
					</a>
				<?php } ?>
				<?php schedule_table() ?>

				<?php if ($additional_details || $location) { ?>
					<div class="list-group">
					<?php }
					if ($additional_details) { ?>
						<div class="list-group-item">
							<small>
								<?php echo $additional_details; ?>
							</small>
						</div>
						<?php
					} ?>
					<?php
					if ($location) { ?>
						<a class="list-group-item" href="https://www.google.com/maps/dir//<?php echo $location['address']; ?>" target="_blank" data-toggle="tooltip" data-placement="bottom" title="Click to Get Directions" ><small><i class="fa fa-location-arrow fa-fw"></i> <?php echo $location['address']; ?></small></a><?php } ?>
					</div>
				</div>
				<?php if ( current_user_can( 'edit_posts' ) ) { ?>
					<a href="<?php echo get_edit_post_link(); ?>"><i class="fa fa-pencil-square-o"></i> Edit Location</a>
				<?php } ?>
			<?php endwhile;
			if (  $loop->max_num_pages > 1 ) : ?>
			<div id="nav-below" class="navigation">
				<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Previous', 'domain' ) ); ?></div>
				<div class="nav-next"><?php previous_posts_link( __( 'Next <span class="meta-nav">&rarr;</span>', 'domain' ) ); ?></div>
			</div>
		<?php endif;
	endif;
	return ob_get_clean();
	wp_reset_postdata();
}
add_shortcode( 'locations', 'locations_posts' );


// Main Locations Map

add_shortcode( 'map', 'site_locations_map' );
function site_locations_map( $atts ) {
	ob_start();
	$key = get_field('google_maps_api', 'option');
	if (!$key) {
		echo 'Get <a href="https://console.cloud.google.com/google/maps-apis/overview">Google Maps API key</a> and <a href="/wp-admin/admin.php?page=your-website">add to Your Website details.'; 
	}
	$mapposts = new WP_Query( array(
		'post_status' => 'publish',
		'post_type' => 'location',
	) );
	?>
	<div class="acf-map hidden">
		<?php while ( $mapposts->have_posts() ) : $mapposts->the_post(); ?>
			<?php
			$location = get_field('address');
			$gtemp = explode (',',  implode($location));
			$coord = explode (',', implode($gtemp));
			?>
			<div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>">
				<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
				<a href="https://www.google.com/maps/dir//<?php echo $location['address']; ?>" target="_blank"><br/>
					<p>
						<i class="fa fa-location-arrow fa-fw"></i><?php echo $location['address']; ?>
					</p>
					<p>
						<span class="btn btn-sm btn-default">Get Directions</span>
					</p>
				</a>
				<?php schedule_table() ?>
			</div>
		<?php endwhile; ?>
		<?php return ob_get_clean();
	}

	/* In-Post Maps */

	add_shortcode( 'locations-maps', 'locations_map' );
	function locations_map( $atts ) {
		ob_start(); ?>
		<?php if( have_rows('locations') ): ?>
			<div class="acf-map">
				<?php while ( have_rows('locations') ) : the_row();
				$location = get_sub_field('location-map');
				?>
				<div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>">
					<h4><?php the_sub_field('location_title'); ?></h4>
					<p class="address"><?php echo $location['address']; ?></p>
					<p><?php the_sub_field('location_description'); ?></p>
				</div>
			<?php endwhile; ?>
		</div>
	<?php endif;
	$locations_content = ob_get_clean();
	return $locations_content;
}

add_filter( 'the_content', 'map_after_content', 11 );
function map_after_content($content) {
	$content .= do_shortcode("[locations-maps]");
	return $content;
}

function google_maps_scripts() {
  $key = get_field('google_maps_api', 'option');
  if (!$key) {
    $key = '';
  }
  if ( shortcode_exists('map') ) {
    // wp_enqueue_script( 'google-map-js', 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false', array(), '1.0.0', true );
    wp_enqueue_script( 'map-script', 'https://maps.googleapis.com/maps/api/js?key=' . $key, array(), '1.0.0', true );
  }
}
add_action( 'wp_enqueue_scripts', 'google_maps_scripts' );
