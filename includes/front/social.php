<?php


if ( ! defined( 'ABSPATH' ) ) exit;

/* OpenGraph */

//Adding the Open Graph in the Language Attributes
function add_opengraph_doctype( $output ) {
		return $output . ' xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml"';
	}
add_filter('language_attributes', 'add_opengraph_doctype');

//Lets add Open Graph Meta Info

function insert_fb_in_head() {
	global $post;
	if ( !is_singular()) //if it is not a post or a page
		return;
        // echo '<meta property="fb:admins" content="YOUR USER ID"/>';
        echo '<meta property="og:title" content="' . get_the_title() . '"/>';
        echo '<meta property="og:type" content="article"/>';
        echo '<meta property="og:url" content="' . get_permalink() . '"/>';
        echo '<meta property="og:site_name" content="'. get_bloginfo('name') .'"/>';
	if(!has_post_thumbnail( $post->ID )) { //the post does not have featured image, use a default image

  if (has_post_thumbnail()) {
    $default_image = wp_get_attachment_image_src( get_post_thumbnail_id( $page->ID ), 'full' );
  } else {
    if( function_exists('get_field')) {
      if (get_field('default_image', 'option')) {
        $default_image = get_field('default_image', 'option');
      }
    }
  }
		echo '<meta property="og:image" content="' . $default_image . '"/>';
	}
	else{
		$thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );
		echo '<meta property="og:image" content="' . esc_attr( $thumbnail_src[0] ) . '"/>';
	}
	echo "
";
}
add_action( 'wp_head', 'insert_fb_in_head', 5 );

/* SECTION: Facebook */

if ( shortcode_exists( 'facebook-page') || shortcode_exists( 'facebook-like') ) {

  add_action('ct_before_builder', 'fb_header_code');
  function fb_header_code() {
  	 ?>
     <div id="fb-root"></div>

  	<?php
  }

}
