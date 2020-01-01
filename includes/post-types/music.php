<?php

if ( !function_exists( 'get_field' ) )
return;

$option = get_field('post_types', 'option');
if ( (!$option) || (!in_array('music', $option)) ) {
	return;
}

// Register Custom Post Type
function music_post_type() {

	$labels = array(
		'name'                  => _x( 'Music', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Music', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Music', 'text_domain' ),
		'name_admin_bar'        => __( 'Music', 'text_domain' ),
		'archives'              => __( 'Music Archives', 'text_domain' ),
		'attributes'            => __( 'Music Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Music:', 'text_domain' ),
		'all_items'             => __( 'All Music', 'text_domain' ),
		'add_new_item'          => __( 'Add New Music', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Music', 'text_domain' ),
		'edit_item'             => __( 'Edit Music', 'text_domain' ),
		'update_item'           => __( 'Update Music', 'text_domain' ),
		'view_item'             => __( 'View Music', 'text_domain' ),
		'view_items'            => __( 'View Music', 'text_domain' ),
		'search_items'          => __( 'Search Music', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into music', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this music', 'text_domain' ),
		'items_list'            => __( 'Music list', 'text_domain' ),
		'items_list_navigation' => __( 'Music list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter music list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Music', 'text_domain' ),
		'description'           => __( 'Music', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'comments', 'revisions', 'custom-fields', 'page-attributes', ),
		'taxonomies'            => array( 'music-type', 'music-tag' ),
		'hierarchical'          => true,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-format-audio',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
	);
	register_post_type( 'music', $args );

}
add_action( 'init', 'music_post_type', 0 );

// Register Custom Taxonomy
function music_type() {

	$labels = array(
		'name'                       => _x( 'Music Types', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Music Type', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Music Type', 'text_domain' ),
		'all_items'                  => __( 'All Music Types', 'text_domain' ),
		'parent_item'                => __( 'Parent Music Type', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Music Type:', 'text_domain' ),
		'new_item_name'              => __( 'New Music Type Name', 'text_domain' ),
		'add_new_item'               => __( 'Add New Music Type', 'text_domain' ),
		'edit_item'                  => __( 'Edit Music Type', 'text_domain' ),
		'update_item'                => __( 'Update Music Type', 'text_domain' ),
		'view_item'                  => __( 'View Music Type', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate Music Types with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove Music Types', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular Music Types', 'text_domain' ),
		'search_items'               => __( 'Search Music Types', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
		'no_terms'                   => __( 'No Music Types', 'text_domain' ),
		'items_list'                 => __( 'Music Types list', 'text_domain' ),
		'items_list_navigation'      => __( 'Music Types list navigation', 'text_domain' ),
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
	register_taxonomy( 'music-type', array( 'music' ), $args );

}
add_action( 'init', 'music_type', 0 );

// Register Custom Taxonomy
function music_tag() {

	$labels = array(
		'name'                       => _x( 'Music Tags', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Music Tag', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Music Tag', 'text_domain' ),
		'all_items'                  => __( 'All Music Tags', 'text_domain' ),
		'parent_item'                => __( 'Parent Music Tag', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Music Tag:', 'text_domain' ),
		'new_item_name'              => __( 'New Music Tag Name', 'text_domain' ),
		'add_new_item'               => __( 'Add New Music Tag', 'text_domain' ),
		'edit_item'                  => __( 'Edit Music Tag', 'text_domain' ),
		'update_item'                => __( 'Update Music Tag', 'text_domain' ),
		'view_item'                  => __( 'View Music Tag', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate Music Tags with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove Music Tags', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular Music Tags', 'text_domain' ),
		'search_items'               => __( 'Search Music Tags', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
		'no_terms'                   => __( 'No Music Tags', 'text_domain' ),
		'items_list'                 => __( 'Music Tags list', 'text_domain' ),
		'items_list_navigation'      => __( 'Music Tags list navigation', 'text_domain' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'music-tag', array( 'music' ), $args );

}
add_action( 'init', 'music_tag', 0 );

// Composers - Register Custom Taxonomy
function composer_function() {

	$labels = array(
		'name'                       => 'Composer',
		'singular_name'              => 'Composer',
		'menu_name'                  => 'Composers',
		'all_items'                  => 'All Composers',
		'parent_item'                => 'Parent Composer',
		'parent_item_colon'          => 'Parent Composer:',
		'new_item_name'              => 'New Composer',
		'add_new_item'               => 'Add New Composer',
		'edit_item'                  => 'Edit Composer',
		'update_item'                => 'Update Composer',
		'separate_items_with_commas' => 'Separate Composers with commas',
		'search_items'               => 'Search Composers',
		'add_or_remove_items'        => 'Add or remove Composer',
		'choose_from_most_used'      => 'Choose from the most used Composers',
		'not_found'                  => 'Composer Not Found',
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'composer', array( 'music' ), $args );

}

// Hook into the 'init' action
add_action( 'init', 'composer_function', 0 );


// Suggested Uses - Register Custom Taxonomy
function music_uses_function() {

	$labels = array(
		'name'                       => 'Suggested Uses',
		'singular_name'              => 'Suggested Use',
		'menu_name'                  => 'Suggested Uses',
		'all_items'                  => 'All Suggested Uses',
		'parent_item'                => 'Parent Suggested Use',
		'parent_item_colon'          => 'Parent Suggested Use:',
		'new_item_name'              => 'New Suggested Use',
		'add_new_item'               => 'Add New Suggested Use',
		'edit_item'                  => 'Edit Suggested Use',
		'update_item'                => 'Update Suggested Use',
		'separate_items_with_commas' => 'Separate Suggested Uses with commas',
		'search_items'               => 'Search Suggested Uses',
		'add_or_remove_items'        => 'Add or remove Suggested Uses',
		'choose_from_most_used'      => 'Choose from the most used Suggested Uses',
		'not_found'                  => 'Suggested Uses Not Found',
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
	register_taxonomy( 'suggested_use', array( 'music' ), $args );

}

// Hook into the 'init' action
add_action( 'init', 'music_uses_function', 0 );


// Hook into the 'init' action
add_action( 'init', 'resource_type_function', 0 );

// Register Custom Taxonomy
function liturgical_season_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Liturgical Seasons', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Liturgical Season', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Liturgical Seasons', 'text_domain' ),
		'all_items'                  => __( 'All Liturgical Seasons', 'text_domain' ),
		'parent_item'                => __( 'Parent Liturgical Seasons', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Liturgical Season:', 'text_domain' ),
		'new_item_name'              => __( 'New Liturgical Season Name', 'text_domain' ),
		'add_new_item'               => __( 'Add New Liturgical Season', 'text_domain' ),
		'edit_item'                  => __( 'Edit Liturgical Season', 'text_domain' ),
		'update_item'                => __( 'Update Liturgical Season', 'text_domain' ),
		'view_item'                  => __( 'View Liturgical Season', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate Liturgical Seasons with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove Liturgical Seasons', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular Liturgical Seasons', 'text_domain' ),
		'search_items'               => __( 'Search Liturgical Seasons', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
		'no_terms'                   => __( 'No Liturgical Seasons', 'text_domain' ),
		'items_list'                 => __( 'Liturgical Seasons list', 'text_domain' ),
		'items_list_navigation'      => __( 'Liturgical Seasons navigation', 'text_domain' ),
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
	register_taxonomy( 'liturgical-season', array( 'music' ), $args );

}
add_action( 'init', 'liturgical_season_taxonomy', 0 );

/* Musescore */

add_shortcode( 'musescore', 'musescore_shortcode' );
function musescore_shortcode( $atts ) {
	ob_start();
		if( have_rows('musescore') ) { ?>
			<div class="doc-files-wrapper">
				<?php while ( have_rows('musescore') ) : the_row();
					$url = get_sub_field('url');
					$musescore = 'https://musescore.com/score/';
					preg_match('/(\d+)$/', $url, $matches);
					$number = $matches[0];
					$parts = get_sub_field('multiple_parts');
					?>
					<div class="btn-group btn-group-justified" role="group" aria-label="Justified button group with nested dropdown">
						<a class="btn btn-lg btn-default" href="<?php echo $musescore; echo $number; ?>/download<?php if ($parts) { ?>-parts<?php } ?>/pdf"  download="<?php the_title(); ?>"><i class="fa fa-cloud-download"></i> Download Score</a>
						<div class="btn-group" role="group">
							<a href="#" class="btn btn-lg btn-default dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cloud-download"></i> Other Files <span class="caret"></span> </a>
							<ul class="dropdown-menu">
								<li><a href="<?php echo $musescore; echo $number; ?>/download"><i class="fa fa-file-o fa-fw"></i> Musescore File</a></li>
								<li><a href="<?php echo $musescore; echo $number; ?>/download/mxl"><i class="fa fa-file-o fa-fw"></i> MusicXML</a></li>
								<li><a href="<?php echo $musescore; echo $number; ?>/download/mid"><i class="fa fa-file-o fa-fw"></i> MIDI File</a></li>
								<li role="separator" class="divider"></li>
								<li><a href="<?php echo $musescore; echo $number; ?>/download/mp3"><i class="fa fa-file-audio-o fa-fw"></i> MP3 File</a></li>
							</ul>
						</div>
					</div>

					<?php if ( is_singular() ) { ?>
						<iframe class="fullwidth" src="<?php echo $url; ?>/embed" height="550px" frameborder="0"></iframe>
					<?php } ?>
				<?php endwhile; ?>
			</div><?php
		}
	return ob_get_clean();
}
if ( ! function_exists('show_musescore') ) {
	function show_musescore() {
		if( have_rows('musescore')) {
		   echo do_shortcode("[musescore]");
	  }
   }
}

/* Music Links */

add_shortcode( 'music-links', 'music_links' );
function music_links( $atts ) {
	ob_start();
		if( have_rows('music-links') ) { ?>
			<div class="doc-files-wrapper">
				<?php while ( have_rows('music-links') ) : the_row(); ?>
						<?php if( get_sub_field('title') && get_sub_field('link')) { ?>
          		<a href="<?php the_sub_field('link'); ?>" target="_blank" class="btn btn-lg btn-primary btn-block"  <?php the_sub_field('title') ?>" data-toggle="tooltip" data-placement="top" title="<?php the_sub_field('description'); ?>"><i class="fa fa-globe"></i> <?php the_sub_field('title'); ?></a>
						<?php } ?>
				<?php endwhile; ?>
			</div><?php
		}
	return ob_get_clean();
}
if ( ! function_exists('showmusic_link') ) {
	function showmusic_link() {
		if (have_rows('music-links')) {
		   echo do_shortcode("[music-links]");
	  }
   }
}

add_shortcode( 'music-text', 'music_text' );
function music_text( $atts ) {
ob_start(); ?>
	<?php if( have_rows('music-text') ): ?>
		<table class="music-table table table-striped table-hover fullwidth">
		  <tr >
		    <th class="column1">
				<?php if( get_field( "original_language" ) ): ?>
				   <?php the_field('original_language'); ?>
				<?php endif; ?>
			</th>
		   <th class="column2">
				<?php if( get_field( "translation_language" ) ): ?>
				    <?php the_field('translation_language'); ?>
				<?php endif; ?>
			</th>
		  </tr>
    <?php while ( have_rows('music-text') ) : the_row(); ?>
			<tr>
				<td><?php the_sub_field('original_text'); ?></td>
				<td><?php the_sub_field('translation'); ?></td>
			</tr>
    <?php endwhile; ?>
</table>
	<?php else :
	    // no rows found
	endif;
}
if ( ! function_exists('showmusic_text') ) {
	function showmusic_text() {
		if (have_rows('music-text') && is_singular() ) {
		   echo do_shortcode("[music-text]");
	  }
   }
}

/* Music Embed Score */

if ( ! function_exists('embed_score') ) {
	function embed_score() {
		if( get_field('embed_score') && is_singular() ) {
		   echo get_field('embed_score');
	  }
   }
}

/* Post Relationships: Music -> Posts */

add_shortcode( 'related-music', 'related_music' );
function related_music( $atts ) {
	ob_start();
	$posts = get_field('related_music');
	if( $posts ) { ?>
	<div class="related-panel panel panel-default">
		<div class="panel-heading">
			<h4 class="panel-title"><i class="fa fa-music"></i> Related Featured Music</h4>
		</div>
			<!-- <div class="panel-body">
		</div> -->
		<div class="list-group">
			<?php foreach( $posts as $p ): // variable must NOT be called $post (IMPORTANT) ?>
				<a target="_blank" class="list-group-item " href="<?php echo get_permalink( $p->ID ); ?>">
					<span class="media-left">
						<img width=40" height="40" src="<?php echo get_the_post_thumbnail_url( $p->ID, 'thumbnail' ); ?>" alt="<?php the_title(); ?>"/>
					</span>
					<div class="media-body">
						<h4 class="media-heading">
							<?php echo get_the_title( $p->ID ); ?>
						</h4>
					</div>
				</a>
			<?php endforeach; ?>
		</div>
	</div>
	<?php }
return ob_get_clean();
wp_reset_query();
}
if ( ! function_exists('show_related_music') ) {
	function show_related_music() {
		if ( get_field('related_music') ) {
			echo do_shortcode("[related-music]");
		}
	}
}

/* Reverse Query: Post -> Music */

function source_music($content) {
	$relatedposts = get_posts(array(
		'post_type' => 'music',
		'meta_query' => array(
			array(
				'key' => 'related_music', // name of custom field
				'value' => '"' . get_the_ID() . '"', // matches exaclty "123", not just 123. This prevents a match for "1234"
				'compare' => 'LIKE'
			)
		)
	));
	if( $relatedposts && is_singular() ): ?>
	<div class="related-music-wrapper">
		<div class="related-panel panel panel-default ">
			<div class="panel-heading"><h4 class="panel-title"><i class="fa fa-rss"></i> Featured in</h4></div>
			<!-- <div class="panel-body"></div> -->
			<div class="list-group media-list">
				<?php foreach( $relatedposts as $relatedpost ): ?>
					<a class="list-group-item " href="<?php echo get_permalink( $relatedpost->ID ); ?>" target="_blank">
						<div class="media-left">
							<img width=40" height="40" src="<?php echo get_the_post_thumbnail_url( $relatedpost->ID, 'thumbnail' ); ?>" alt="<?php the_title(); ?>"/>
						</div>
						<div class="media-body">
							<?php if (!is_singular()) { ?>
								<h4 class="media-heading"><?php echo get_the_title( $relatedpost->ID ); ?></h4>
							<?php } else { ?>
								<?php echo get_the_title( $relatedpost->ID ); ?>
							<?php } ?>
							<?php echo do_shortcode("[download-button]"); ?>
						</div>
					</a>
				<?php endforeach; ?>
			</div>
		</div>
	</div><?php endif;
return $content;
}

/* Composer Description */

if ( ! function_exists('show_composer_description') ) {
	function show_composer_description() {
		$terms = get_the_terms( $post->ID, 'composer' );
		if ($terms && is_singular() ) {
		    foreach($terms as $term) { ?>
					<?php $description = $term->description; ?>
					<div class="panel panel-default">
					  <div class="panel-heading">
					    <h3 class="panel-title text-capitalize"><?php echo $term->taxonomy; ?>: <?php echo $term->name; ?></h3>
					  </div>
						<?php if ( $description !== '' ) { ?>
					  <div class="panel-body">
					    <?php echo $description; ?>
					  </div>
						<?php } ?>
					</div>
				<?php
	    }
		}
	}
}

/* Music Submission Form */

function acf_submission_form( $atts ){
	ob_start(); ?>
	<?php acf_form(
		array(
			'new_post'		=> array(
				'post_type'		=> 'music',
				'post_status'	=> 'draft',
			),
			'post_title' => true,
			'post_content' => true,
			'post_id' => 'new_post',
			'submit_value'	=> 'Submit Music',
			'updated_message' => __('<div class="alert alert-success" role="alert"><i class="fa fa-check fa-fw"></i> Thank you for your submission! It will be published upon approval.</div>', 'acf'),
		)
	); ?>
	<? return ob_get_clean();
}
add_shortcode( 'music-form', 'acf_submission_form' );

if ( shortcode_exists( 'music-form' ) ) {
	add_filter( 'init', 'acf_form_head' );
}
