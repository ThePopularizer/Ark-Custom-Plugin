<?php

if ( !function_exists( 'get_field' ) )
return;

/********** SECTION: Header Area *****/

/* Logo Area */

function logo_headings() {
	ob_start(); ?>
	<h1 itemscope itemtype="http://schema.org/Organization" class="logo-heading"><a href="/" alt="Click to go to home page"><span itemprop="legalName"><?php bloginfo('name'); ?></span><br/><small itemprop="description"><?php bloginfo('description'); ?></small></a></h1>
<a href="/" alt="Click to go to home page"><span class="stretch"> </span></a>
	<? return ob_get_clean();
}
add_shortcode( 'logo-headings', 'logo_headings');

/* Feature Area */

function feature_area( $atts ){
	ob_start();
	$videoembed     = get_field('video_embed');
	$videoupload    = get_field('video_file');
	$feature_slider = get_field('feature_slider');
	$videouploadurl = $videoupload['url'];
	$autoplay       = '';
	if (get_field('autoplay')) {
	    $autoplay = 'autoplay="on" mute="on" ';
	}
	$loop = '';
	if (get_field("loop_video")) {
	    $loop = 'loop="on"';
	}
	$fittocontent = get_field("featured_area_fit_to_content");
	$height       = get_field('height');
	$noprotrusion = get_field("no_protrusion");
	if ($noprotrusion) {
	    echo '<style> .featured-image-row { margin-bottom: 0;} </style>';
	}
	$default_image = get_field('default_image', 'option');
	?>

	<div id="feature-area" class="feature-area parallax relative
	    <?php
	if (has_post_thumbnail() || $default_image || get_field('featured_content') || get_field('video_embed')) {
	?> has-featured <?php
	}
	if (has_post_thumbnail()) {
	?> has-image <?php
	}
	if (get_field('height')) {
	    echo $height;
	}
	if (get_field('video_embed') || $videoupload) {
	?> has-video <?php
	}
	?>
	   "
	  <?php
	if (has_post_thumbnail() /* && !is_woocommerce() */ ) {
	    $featuredImage = wp_get_attachment_image_src(get_post_thumbnail_id($page->ID), 'full');
	} elseif ($default_image) {
	    $featuredImage = $default_image;
	}
	if (defined('WC_VERSION')) {
	    if (is_woocommerce()) {
	        if (is_product_category() || is_product()) { // load all 'category' terms for the post

	            $terms = wp_get_post_terms(get_the_ID(), 'product_cat'); // we will use the first term to load ACF data from
	            if (!empty($terms)) {
	                $term            = array_pop($terms);
	                $featuredImage   = get_field('woo_category_featured_image', $term);
	                $categoryvideo   = get_field('video_embed', $term);
	                $categorycontent = get_field('featured_content', $term);
	            }

	            $thumbnail_id  = get_woocommerce_term_meta($term->term_id, 'thumbnail_id', true);
	            $image         = wp_get_attachment_image_src($thumbnail_id, 'full');
	            $featuredImage = $image[0];

	            global $wp_query;
	            $cat          = $wp_query->get_queried_object();
	            $thumbnail_id = get_woocommerce_term_meta($cat->term_id, 'thumbnail_id', true);
	            $image        = wp_get_attachment_url($thumbnail_id);
	            if ($image) {
	                $featuredImage = $image;
	            }
	        } elseif (is_product_tag()) {
	            $terms = wp_get_post_terms(get_the_ID(), 'product_tag');
	            if (!empty($terms)) {
	                $term            = array_pop($terms);
	                $featuredImage   = get_field('woo_category_featured_image', $term);
	                $categoryvideo   = get_field('video_embed', $term);
	                $categorycontent = get_field('featured_content', $term);
	            }
	        }
	    }
	}
	if (!isset($featuredImage)) {
	    $featuredImage = 'http://loremflickr.com/1280/600/landscape';
	}
	if (isset($featuredImage)) {
	  echo $featuredImage;
	?>
	 itemprop="image"
	  style="background-image: url('<?php
	    if (has_post_thumbnail() /* && !is_woocommerce() */ ) {
	        echo $featuredImage[0];
	    } else {
	        echo $featuredImage;
	    }
	?>');"
	<?php
	}
	?>> <!––  /* #feature-area opening */ -->
	<div class="ct-section">
	  <div class="ct-section-inner-wrap">
	    <h1 id="title" class="text-shadow text-white" itemprop="headline">
	      <?php
	      if ( !is_front_page() && (is_single() || is_page() )) {
					echo get_the_title();
	      } elseif (is_archive()) {
	        echo post_type_archive_title( '', false );
	      }
	?>
	   </h1>
	  </div>
	</div>

	    <?php
	if (get_field('featured_content')) {
	    the_field('featured_content');
	}
	if ($videoupload) {
	?>
	   <div class="embed-responsive embed-responsive-16by9 <?php
	    if (get_field('autoplay')) {
	        echo 'autoplay';
	    }
	?>">
	      <?php
	    echo do_shortcode('[video src="' . $videouploadurl . '" ' . $autoplay . ' ' . $loop . ' preload="auto"]');
	?>
	   </div>
	    <?php
	} elseif ($videoembed) {
	    if (!get_field('autoplay')) {
	        the_field('video_embed');
	        $queried_object = get_queried_object();
	        $taxonomy       = $queried_object->product_cat;
	        $term_id        = $queried_object->term_id;
	        the_field('video_embed', $taxonomy . '_' . $term_id);
	    } else {
	?>
	   <?php
	        /* Autoplay Video */
	        $iframe = get_field('video_embed'); // get iframe HTML
	        preg_match('/src="(.+?)"/', $iframe, $matches); // use preg_match to find iframe src
	        $src    = $matches[1];
	        $params = array( // add extra params to iframe src
	            'controls' => 0,
	            'autohide' => 1,
	            'autoplay' => 1,
	            'rel' => 0,
	            'loop' => 0
	        );
	        if (get_field("loop_video")) {
	            $params['loop'] = 1;
	        }
	        $new_src    = add_query_arg($params, $src);
	        $iframe     = str_replace($src, $new_src, $iframe);
	        $attributes = 'frameborder="0"'; // add extra attributes to iframe html
	        $iframe     = str_replace('></iframe>', ' ' . $attributes . '></iframe>', $iframe);
	        echo $iframe;
	    }
	} elseif ($feature_slider) {
		echo do_shortcode('[posts post_type="acf" speed="5500"]');
	}
	?>
	   <div class="overlay stretch">

	    </div>

	</div>
	</div>

	  <?php
	if (get_field("video_embed") && $fittocontent) {
	?>
	 <style>
	    .white.container {
	      margin-top: 55px;
	    }
	  </style>
	  <?php
	}
	return ob_get_clean();
}
add_shortcode( 'feature-area', 'feature_area' );

function side_graphics( $atts ){
	ob_start(); ?>
	<!-- <img class="header-img left" src="/wp-content/themes/JustitiaEtPax/images/scale.png" alt="Justice"  />
	<img class="header-img right" src="/wp-content/themes/JustitiaEtPax/images/dove.png" alt="Peace" /> -->
	<? return ob_get_clean();
}
add_shortcode( 'feature-bottom', 'side_graphics' );

/* Open Graph */

function open_graph() {
if (has_post_thumbnail() /* && !is_woocommerce() */ ) {
		$featuredImage = wp_get_attachment_image_src( get_post_thumbnail_id( $page->ID ), 'full' );
		echo '<meta property="og:image" content="' . $featuredImage[0] . '" /> ';
	}
}
add_action('wp_head', 'open_graph', 11);

/***** SECTION: Content Area */

// if ( is_post_type_archive() ) {
// 	add_filter( 'ct_be', 'breadcrumb_header', 10, 3 );
// }
function breadcrumb_header() {
	if ( function_exists('yoast_breadcrumb') && !is_front_page() ) {
	  yoast_breadcrumb('<div class="breadcrumb">','</div>');
	}
}

/* SECTION: Footer */

function site_name( $atts ){
ob_start();
	$a = shortcode_atts( array(
			'placement' => 'top',
			'display'  =>  'inline'
	), $atts ); ?>
	<span data-toggle="tooltip" data-placement="<?php echo $a['placement']; ?>" data-original-title="<?php echo bloginfo('description'); ?>" >
		<?php echo get_bloginfo( 'name', 'display' ); ?>
	</span>
	<?php
	return ob_get_clean();
}
add_shortcode( 'site-name', 'site_name' );
