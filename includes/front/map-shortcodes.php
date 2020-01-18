<?php

if ( ! defined( 'ABSPATH' ) ) exit;

	// Location Details

	function location_schedule( $atts ){
	reset_rows();
	ob_start();
		$a = shortcode_atts( array(
				'location' => 0,
		), $atts );
		if ( have_rows('location_schedule', 'options')) {
			$number = 1;
			while ( have_rows('location_schedule', 'options')): the_row();
				$additional_details = get_sub_field('additional_details', 'options');
				$location = get_sub_field('address', 'options');
				$name = get_sub_field('name', 'options');
				?>
				<div class="panel panel-default">
				  <div class="panel-heading">
				    <h3 class="panel-title"><?php echo $name; ?></h3>
				  </div>
					<?php
					$image = get_sub_field('image', 'options');
					if( !empty($image) ) {
						$url = $image['url'];
						$title = $image['title'];
						$alt = $image['alt'];
						$caption = $image['caption'];
						$size = 'medium';
						$medium = $image['sizes'][ $size ];
						$width = $image['sizes'][ $size . '-width' ];
						$height = $image['sizes'][ $size . '-height' ];
						?><div class="parallax" style="background-image: url(<?php echo $medium; ?>) width: <?php echo $width; ?>; height: <?php echo $height; ?>;" class="fullwidth"></div><?php
					}
					?>
					<?php if ( have_rows('hours', 'options')) { ?>
						<table class="table table-hover">
						<?php while ( have_rows('hours', 'options')): the_row(); ?>
							<tr>
								<td><?php the_sub_field('days', 'options'); ?></td>
								<td><?php the_sub_field('hours', 'options'); ?></td>
							</tr>
						<?php endwhile; ?>
						</table>
					<?php }
					if ($additional_details || $location) { ?>
						<div class="list-group">
							<a class="list-group-item toggle collapsed" data-toggle="collapse" href="#location-<?php echo $number; ?>" target=""><small>Additional Details</small></a>
						<div class="collapse" id="location-<?php echo $number++; ?>">
					<?php }
					if ($additional_details) { ?>
					  <div class="list-group-item">
							<small>
								<?php echo $additional_details; ?>
							</small>
						</div>
					<?php } ?>
					<?php
					if ($location) { ?>
						<a class="list-group-item" href="https://www.google.com/maps/place/<?php echo $location['address']; ?>" target="_blank" data-toggle="tooltip" data-placement="bottom" title="Click to Get Directions" ><small><i class="fa fa-location-arrow fa-fw"></i> <?php echo $location['address']; ?></small></a>
					<?php } ?>
					<?php if ($additional_details || $location) { ?>
					</div>
				</div>
				<?php } ?>
			</div>
			<?php endwhile;
		}
	return ob_get_clean();
	}
	add_shortcode( 'location-schedule', 'location_schedule' );
