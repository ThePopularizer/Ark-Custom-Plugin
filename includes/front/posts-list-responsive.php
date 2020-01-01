<?php
  // Use a variable instead of magic number. Consider moving this to a WordPress config instead using get_option

if ( !function_exists( 'get_field' ) ) {
	return;
}

add_shortcode( 'posts', 'responsive_carousel_function' );

function responsive_carousel_function( $atts ){

	$chunk_size = 1;

	static $instance=1;
	static $id=11;

	$args = array(

	);
	$carousel_posts = get_posts( $args );
	ob_start();

	// Shortcode Attributes

	$a = shortcode_atts( array(
		'title'							=> '',
		'numberposts'   		=> -1, // -1 is for all
		'category' 					=> '',
		'post_type'         => 'posts',
		'posts'    					=> '4',
		'orderby'           => "menu_order", // or 'date', 'rand'
		'order'             => "ASC", // or 'DESC'
		'items_per_slide'		=> '4',
		'theme'							=> 'light',
		'carousel'					=> 'enable',
		'speed'							=> '4000',
		'image_style'				=> 'round',
		'image_size'				=> 'thumbnail',
		'responsive'				=> 'disable',
		'button_icon'				=> '',
		'button_class'			=> '',
		'id'								=> $id,
		'featured_image'		=> 'disable',
	), $atts );

	// Set the arguments for the query
	global $post;
	$args = array(
		'numberposts'   		=> $a['numberposts'], // -1 is for all
		'testimonials-cat' 	=> $a['category'],
		'post_type'     		=> $a['post_type'], // or 'post', 'page'
		'posts_per_page'    => $a['posts'],
		'orderby'       		=> $a['orderby'],
		'order' 	      		=> $a['order'],
		'id'								=> $a['id'],
	);

	$chunk_size = $a['items_per_slide'];
	$post_type = $a['post_type'];
	$carousel = $a['carousel'];
	$speed = $a['speed'];
	$image_style = $a['image_style'];
	$image_size = $a['image_size'];
	$responsive = $a['responsive'];
	$button_icon = $a['button_icon'];
	$button_class = $a['button_class'];

	// Get the posts
	if ($a['post_type'] !== 'acf') {
		$myposts = get_posts($args);
	} elseif ($a['post_type'] == 'acf') {
		$feature_slider = get_field('feature_slider');
	}
	?>

	<div id="<? echo ($post_type); ?>-carousel-<?php echo ($a['id']); ?>" class="<?php if ($carousel == 'enable') { ?>carousel <?php } ?><?php if ($responsive == 'enable') { ?>responsive <?php } if ($feature_slider) { ?>feature-slider stretch <?php } ?>posts-list full-width slide <?php echo $a['theme']; ?>"
		data-instance="<?php echo $instance;?>" <?php if ($carousel == 'enable') { ?>data-interval="<?php echo $speed; ?>" data-wrap="true" data-columns="<?php echo $chunk_size; ?>" <?php } ?>
		>

		<?
		if ($a['title'] !== '') {
			echo '<h2 class="text-center title ' . ($a['title']) . '">' . ($a['title']) . '</h2>';
		}
		?>

	  <div class="carousel-inner">

			<?php

			$i = 1;	// Item size (set here the number of posts for each group)
			$i = $a['items_per_slide'];



			// If there are posts
			if($myposts):

				// Groups the posts in groups of $i
				$chunks = array_chunk($myposts, $i);
				$html = "";

				/*
				 * Item
				 * For each group (chunk) it generates an item
				 */
				foreach($chunks as $chunk):
					// Sets as 'active' the first item
					($chunk === reset($chunks)) ? $active = "active" : $active = "";
					$html .= '<div class=" item ' . $active . '"><div class="row">';

					/*
					 * Posts inside the current Item
					 * For each item it generates the posts HTML
					 */
					foreach($chunk as $post):
						$columns = 'col-xs-12 col-sm-12 col-lg-12';
						if ($a['items_per_slide'] == 2) {
							$columns = 'col-xs-12 col-sm-6 col-lg-6';
						} elseif ($a['items_per_slide'] == 3) {
							$columns = 'col-xs-12 col-sm-4 col-lg-4';
						} elseif ($a['items_per_slide'] == 4) {
							$columns = 'col-xs-12 col-sm-6 col-lg-3';
						} elseif ($a['items_per_slide'] == 6) {
							$columns = 'col-xs-12 col-sm-4 col-lg-4';
						} elseif ($a['items_per_slide'] == 8) {
							$columns = 'col-xs-12 col-sm-3 col-lg-3';
						}
						$html .= '<div class="post-column ' . $columns . '">';
						$icon = get_field('icon');
						$image = get_field('image');
						$featuredImage = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' )[0];
						$html .= '<div class="post-wrapper';
						if ($featuredImage && $a['featured_image'] == 'enable') {
								$html .= ' parallax-slow" style="background-image: url(' . $featuredImage . ')';
						}
						$html .= '"><div class="post-image"><a href="' . get_permalink() . '">';
						if( $image ) {
							$html .= wp_get_attachment_image( $image, $image_size, false, ["class" => $image_style ] );
						} elseif ($icon) {
							$html .= '<i class="fa ' . $icon . '" aria-hidden="true"></i>';
						} else {
							$html .='<img class="' . $image_style . '" src="' . get_stylesheet_directory_uri() . '/images/user.png" />';
						}
						$html .= '</a></div>'.'<h3><a href="' . get_permalink() . '">'. get_the_title() . '</a></h3>';
						$html .= '<div class="entry-content">' . get_the_excerpt() . '</div>';
						if (!has_excerpt() && is_user_logged_in()) {
							$html .= '<div class="alert alert-danger" role="alert">The full content is being displayed; Please <a href="' . get_edit_post_link() . '#postexcerpt">add a short excerpt</a> to be displayed here.</div>';
						}
						$html .= '<div class="' . get_post_type() . ' details">' ;
						if (get_field('name')) {
							$html .= '<div class="name">' . get_field('name') . '</div>';
						}
						if (get_field('credentials')) {
							$html .= '<div class="credentials">' . get_field('credentials') . '</div>';
						}
						if (get_field('organisation')) {
							$html .= '<div class="organisation">' . get_field('organisation') . '</div>';
						}
						if (get_field('location')) {
							$html .= '<div class="location">' . get_field('location') . '</div>';
						}
						$html .= '<div><a href="' . get_edit_post_link() . '">(Edit)</a></div>';
						$html .= '</div></div></div>';
					endforeach;

					$html .= '</div></div>';

				endforeach;

				// Prints the HTML
				echo $html;

			endif;

			if ($feature_slider) {
				$first = true;
				foreach( $feature_slider as $slide ) {
					?>
						<div class="item
							<?php if ($first) {
								echo 'active';
								$first = false;
							} ?>
							">
								<div class="feature-slide parallax stretch" style="background-image: url(' <?php echo $slide[url] ?>')">
									<?php if ($slide[caption]) { ?>
										<h2>
											<?php echo $slide[caption] ?>
										</h2>
									<?php } ?>

									<?php if ($slide[description]) { ?>
										<div class="description">
											<?php echo $slide[description] ?>
										</div>
									<?php } ?>
								</div>
						</div>
					<?php
				}


			} ?>

		</div>

		<?php if ($carousel == 'enable' && !$feature_slider) { ?>
			<ol class="carousel-indicators">
				<?php // Use a for loop here instead of foreach, since you don't actually need the contents of the array ?>
				<?php for ($i = 0, $l = ceil(count($carousel_posts) / $chunk_size); $i <= $l; $i++):  ?>
					<li data-target="#<? echo ($post_type); ?>-carousel-<?php echo ($a['id']); ?>" data-slide-to="<?php echo $i ?>" <?php echo ($i === 0 ? 'class="active"' : '') ?></li>
				<?php endfor; ?>
			</ol>
		<?php }

		if ($a['posts'] > $a['items_per_slide']) {
			echo '</br><a class="btn btn-default ';
			if ($button_class) {
				echo $button_class . ' ';
			}
			echo '" href="/' . $post_type . '">';
			if ($button_icon) {
				echo '<i class="fa ' . $button_icon . '"></i> ';
			}
			echo 'View All</a>';
		}

		if (is_user_logged_in()){
			echo '<br/></br><a class="btn btn-sm btn-default" href="/wp-admin/edit.php?post_type=' . $post_type . '"><i class="fa fa-pencil"></i> Edit All</a>';
		}
		if ($carousel == 'enable') { ?>
			<a class="left carousel-control" href="#<? echo ($post_type); ?>-carousel-<?php echo ($a['id']); ?>" role="button" data-slide="prev">
				<span class="fa fa-angle-left" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="right carousel-control" href="#<? echo ($post_type); ?>-carousel-<?php echo ($a['id']); ?>" role="button" data-slide="next">
				<span class="fa fa-angle-right" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>
		<?php } ?>

	  </div>

<?php

$instance++;
$id++;

wp_reset_query(); ?>

	<? return ob_get_clean();
}

?>
