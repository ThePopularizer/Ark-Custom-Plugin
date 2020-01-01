<?php

/********** Reusable Part Shortcodes **********/

add_shortcode( 'oxygen-template', 'func_oxygen_template' );
/**
 * Add a custom shortcode for displaying a Oxygen template/reusable part.
 *
 * Sample usage: [oxygen-template id="478"]
 *
 * @param array $atts Shortcode attributes.
 * @return string HTML output of the specified Oxygen template/reusable part.
 */
function func_oxygen_template( $atts ) {

    return do_shortcode( get_post_meta( $atts['id'], 'ct_builder_shortcodes', true ) );

}

/********** Advanced Custom Fields **********/

if ( !function_exists( 'get_field' ) )
return;

/*************** Before Content ***************/

/* Video / Media Embed */

add_shortcode( 'videos_media', 'videos_media' );
function videos_media( $atts ) {
	ob_start();
		$url = get_sub_field('embed-url');
		if( have_rows('videos_media') ) { ?>
			<div class="panel panel-default videos_media-wrapper">
				<?php while ( have_rows('videos_media') ) : the_row(); ?>
					<div class="videos_media">
						<?php if( get_sub_field('embed-caption') ) { ?>
							<div class="videos_media-caption panel-footer"><h4 class="margin-0">
								<i class="fa fa-angle-down"></i> <?php the_sub_field('embed-caption'); ?>
							</h4></div>
						<?php } ?>
						<?php if( get_sub_field('embed-url') ) { ?>
							<div class="embed-responsive embed-responsive-16by9">
								<?php the_sub_field('embed-url'); ?>
							</div>
						<?php } ?>
					</div>
				<?php endwhile; ?>
			</div><?php
		}
	return ob_get_clean();
}

/* Documents */

add_shortcode( 'doc-files', 'doc_files' );
function doc_files( $atts ) {
	ob_start();
		if( have_rows('documents') ) { ?>
			<div class="doc-files-wrapper">
				<?php while ( have_rows('documents') ) : the_row(); ?>
						<?php if( get_sub_field('doc-title') && get_sub_field('doc-file')) {
							$url = get_sub_field('doc-file')[url];
							?>
          		<a class="btn btn-lg btn-default btn-block" href="<?php echo $url; ?>"  download="<?php the_title(); ?> <?php the_sub_field('doc-title') ?>" data-toggle="tooltip" data-placement="bottom" title="<?php the_sub_field('doc-description'); ?>"><i class="fa fa-cloud-download"></i> <?php the_sub_field('doc-title'); ?></a>
							<?php if ( get_sub_field('show_preview') && is_singular() ) { ?>
								<iframe class="fullwidth" src="<?php echo $url; ?>" height="500px" frameborder="0"></iframe>
							<?php } ?>
						<?php } ?>
				<?php endwhile; ?>
			</div><?php
		}
	return ob_get_clean();
}

/* Services, Benefits */

add_shortcode( 'feature', 'feature_icon_image' );
function feature_icon_image() {
	ob_start();
	$icon = get_field('icon');
	$image = get_field('image');
	if ($image || $icon) { ?>
		<div class="featured">
			<a href="<?php echo get_permalink(); ?>">
				<?php
				if ($icon) {
					echo '<i class="fa ' . $icon . '" aria-hidden="true"></i>';
				} elseif ($image) {
					echo wp_get_attachment_image( $image, $size, false, array( "class" => "round shadow" ) );
				}
				?>
			</a>
		</div>
	<?php
	}
	return ob_get_clean();
}

/*************** After Content ***************/

/* Gallery */

function after_content($content) {
   if (get_field('post_gallery')) {
      $image_ids = get_field('post_gallery', false, false);
      $shortcode = '[gallery link="file" ids="' . implode(',', $image_ids) . '"]';
   	$content = do_shortcode( $shortcode ) . $content;
   	return $content;
   } else {
    return $content;
   }
}

/* Facebook */

function facebook_embed( $atts ){
	ob_start();
	if( have_rows('facebook_posts') ) {
		 while ( have_rows('facebook_posts') ) : the_row(); ?>
		 <div class="clearfix"></div>
		 <div class="embed-container">
				<h4 class="facebook-post-title"><?php the_sub_field('facebook_post_title'); ?></h4>
				<div class="facebook-post-description"><?php the_sub_field('facebook_post_description'); ?></div>
				<div class="fb-post" data-href="<?php the_sub_field('facebook_post'); ?>" data-width="100%"></div>
		 </div>
	<?php endwhile;
	}
	return ob_get_clean();
}
add_shortcode( 'facebook-embed', 'facebook_embed' );


/* Audio */

function audio_embed( $atts ){
	ob_start(); ?>
		<?php // Check if the repeater field has rows of data
		if( have_rows('audio') ) { ?>
			<div class="panel panel-default audio">
				<?php // loop through the rows of data & set variable for Track URL
				while ( have_rows('audio') ) : the_row();

					$track = get_sub_field('audio-file');
					?>
					<div class="panel-heading">
						<?php the_sub_field('audio_title');?>
						<?php
						$attr = array(
							'src'      => $track['url'],
							'loop'     => '',
							'autoplay' => '',
							'preload' => 'none'
							);
						?>
						<a href='<?php echo $track['url'];?>' class="download-link pull-right neutraltext" download="<?php the_sub_field('audio_title');?>"><i class="fa fa-cloud-download fa-fw"></i> Download</a>
					</div>
					<div>
							<?php echo wp_audio_shortcode( $attr ); ?>
					</div>

				<?php endwhile;?>
		</div>
	<?php } ?>
	<? return ob_get_clean();
}
add_shortcode( 'audio-embed', 'audio_embed' );


/* Person Details for Teams and Testimonials */


function person_details() {
	if (get_field('name')) {
		$name = get_field('name');
		$credentials = get_field('credentials');
		$organisation = get_field('organisation');
		$location = get_field('location');
		?>
		<div class="<?php echo get_post_type() . ' '; ?>details">
			<?php if ($name) { ?><div class="name"><?php echo $name; ?></div><?php } ?>
			<?php if ($credentials) { ?><div class="credentials"><?php echo $credentials; ?></div><?php } ?>
			<?php if ($organisation) { ?><div class="organisation"><?php echo $organisation; ?></div><?php } ?>
			<?php if ($location) { ?><div class="location"><?php echo $location; ?></div><?php } ?>
		</div>
	<?php
	}
}
add_shortcode( 'person_details', 'person_details' );
