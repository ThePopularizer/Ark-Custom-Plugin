<?php

/* jQuery from Google */

add_action( 'init', 'google_jquery', 1 );
function google_jquery() {
	if (is_admin()) {
		return;
	}
	global $wp_scripts;
	if (isset($wp_scripts->registered['jquery']->ver)) {
		$ver = $wp_scripts->registered['jquery']->ver;
		$ver = str_replace("-wp","",$ver);
	} else {
		$ver = '3.3.1';
	}
	wp_deregister_script('jquery');
	wp_register_script('jquery', "//ajax.googleapis.com/ajax/libs/jquery/$ver/jquery.min.js", false, $ver);
}

/* Preload Scripts - Did not help */

// add_action('wp_head', function () {
//
//     global $wp_scripts;
//
//     foreach($wp_scripts->queue as $handle) {
//         $script = $wp_scripts->registered[$handle];
//
//         //-- Weird way to check if script is being enqueued in the footer.
//         if($script->extra['group'] === 1) {
//
//             //-- If version is set, append to end of source.
//             $source = $script->src . ($script->ver ? "?ver={$script->ver}" : "");
//
//             //-- Spit out the tag.
//             echo "<link rel='preload' href='{$source}' as='script'/>\n";
//         }
//     }
// }, 1);

/** Dequeue CSS Styles **/

// add_action('wp_enqueue_scripts', 'dequeue_styles', 99);
// function dequeue_styles() {
//     $dequeue_styles = array(
// 			// "acf-datepicker",
// 			// "acf-timepicker",
// 			// "buttons",
// 			// "wp-color-picker",
// 			// "normalize",
// 			// "font-awesome",
// 			// "tbs3-default",
//     );
//     foreach($dequeue_styles as $style){
//         wp_deregister_style($style);
// 				wp_dequeue_style( $style );
//     }
// }

/** Dequeue Scripts **/

add_action( 'wp_head', 'dequeue_scripts_everywhere', 9999 );
add_action( 'admin_enqueue_scripts', 'dequeue_scripts_everywhere', 9999 );
add_action( 'admin_head', 'dequeue_scripts_everywhere', 9999 );
add_action( 'wp_print_scripts', 'dequeue_scripts_everywhere', 9999 );
add_action( 'wp_enqueue_scripts', 'dequeue_scripts_everywhere', 9999 );

add_action('wp_enqueue_scripts', 'dequeue_scripts_everywhere');
function dequeue_scripts_everywhere() {
    $dequeue_scripts = array(
			// "jquery-migrate",
    );
    foreach($dequeue_scripts as $script){
        wp_deregister_script($script);
				wp_dequeue_script( $script );
    }
}

add_action('wp_enqueue_scripts', 'dequeue_scripts_front', 9999);
function dequeue_scripts_front() {
    $dequeue_scripts = array(
			"acf-timepicker",
			"quicktags",
    );
    foreach($dequeue_scripts as $script){
        wp_deregister_script($script);
				wp_dequeue_script( $script );
    }
}

/* TinyMCE */

// if (!is_user_logged_in()) {
// 	add_filter ( 'user_can_richedit' , create_function ( '$a' , 'return false;' ) , 50 );
// }

/* Disable Emoticons */

/**
* Disable the emoji's
*/
function crave_disable_emojis() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
	add_filter( 'wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2 );
}
add_action( 'init', 'crave_disable_emojis' );

/**
* Filter function used to remove the tinymce emoji plugin.
*
* @param array $plugins
* @return array Difference betwen the two arrays
*/
function disable_emojis_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}

/**
* Remove emoji CDN hostname from DNS prefetching hints.
*
* @param array $urls URLs to print for resource hints.
* @param string $relation_type The relation type the URLs are printed for.
* @return array Difference betwen the two arrays.
*/
function disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
	if ( 'dns-prefetch' == $relation_type ) {
		/** This filter is documented in wp-includes/formatting.php */
		$emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );
		$urls = array_diff( $urls, array( $emoji_svg_url ) );
	}
	return $urls;
}

/* Remove Elements Header */

function remove_extra_meta() {
	// remove_action('wp_head', 'feed_links', 2);
	// remove_action('wp_head', 'feed_links_extra', 3);
	remove_action('wp_head', 'rsd_link'); // Blog Client
	remove_action('wp_head', 'wp_generator');
	remove_action('wp_head', 'index_rel_link');
	remove_action('wp_head', 'wlwmanifest_link');
	remove_action('wp_head', 'start_post_rel_link', 10, 0);
	remove_action('wp_head', 'parent_post_rel_link', 10, 0);
	remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);
	remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
	remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0 ); // remove shortlink
	// remove_action('wp_head', array(visual_composer(), 'addMetaData'));
}
add_action('init', 'remove_extra_meta');

/* Defer Scripts */

function defer_scripts( $tag, $handle ) {
  $scripts_to_defer = array(
    // Only some scripts, as the rest are compressed by the caching system:
		"google-map-site-js",
  );
  foreach( $scripts_to_defer as $defer_script ) {
    if ( $defer_script === $handle ) {
        return str_replace( ' src', ' defer="defer" src', $tag );
    }
  }
  return $tag;
}
add_filter( 'script_loader_tag', 'defer_scripts', 10, 2 );


/* Async Scripts */

add_filter( 'script_loader_tag', 'async_scripts', 10, 3 );
function async_scripts( $tag, $handle, $src ) {

	$async_scripts = array(
		"fb-scripts",
		// 'custom-scripts',
		// "chart",
		// 'wp-embed',
    // Only some scripts, as the rest are compressed by the caching system:
	);

    if ( in_array( $handle, $async_scripts ) ) {
        return '<script src="' . $src . '" async="async" type="text/javascript"></script>' . "\n";
    }
    return $tag;
}


/* Logged In Users */

function your_login_function()
{
	if (is_user_logged_in()) {
		add_filter( 'script_loader_tag', 'async_scripts_logged_in', 10, 3 );
		function async_scripts_logged_in( $tag, $handle, $src ) {

			// The handles of the enqueued scripts we want to async
			$async_scripts = array(
				'custom-scripts',
				'admin-bar',
				'comet_cache-admin-bar',
				'default-scripts',
				'devicepx',
				// 'et_monarch-custom-js',
				// 'et_monarch-idle',
				// 'google-map-site-js',
				'jetpack-photon',
				'jquery-lazyloadxt-extend',
				'prettyPhoto-init',
				'prettyPhoto',
				'pwb_frontend_functions',
				'ult-css-gen',
				'vc_woocommerce-add-to-cart-js',
				'wc-add-to-cart',
				'wc-cart-fragments',
				'wc-single-product',
			);

				if ( in_array( $handle, $async_scripts ) ) {
						return '<script src="' . $src . '" async="async" type="text/javascript"></script>' . "\n";
				}
				return $tag;
		}
	} else {
		add_filter( 'script_loader_tag', 'async_scripts_logged_out', 10, 3 );
		function async_scripts_logged_out( $tag, $handle, $src ) {

			// The handles of the enqueued scripts we want to defer
			$async_scripts = array(

			);

				if ( in_array( $handle, $async_scripts ) ) {
						return '<script src="' . $src . '" async="async" type="text/javascript"></script>' . "\n";
				}
				return $tag;
		}
  }
}
add_action('wp_enqueue_scripts', 'your_login_function', 99);

/*** Remove Query String from Static Resources ***/

function remove_cssjs_ver( $src ) {
 if( strpos( $src, '?ver=' ) )
 $src = remove_query_arg( 'ver', $src );
 return $src;
}
add_filter( 'style_loader_src', 'remove_cssjs_ver', 10, 2 );
add_filter( 'script_loader_src', 'remove_cssjs_ver', 10, 2 );


/* Slow down Heartbeat API */

function change_heartbeat_settings( $settings ) {
    $settings['interval'] = 60; //Anything between 15-60
    return $settings;
}
add_filter( 'heartbeat_settings', 'change_heartbeat_settings' );


/* Remove REST API */

remove_action( 'wp_head', 'rest_output_link_wp_head' );
remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
remove_action( 'template_redirect', 'rest_output_link_header', 11 );


/* DNS Prefetch */

function insert_dns_prefetch() {
	echo '<meta http-equiv="x-dns-prefetch-control" content="on">
	<link rel="dns-prefetch" href="//fonts.googleapis.com" />
	<link rel="dns-prefetch" href="//fonts.gstatic.com" />
	<link rel="dns-prefetch" href="//ajax.googleapis.com" />
	<link rel="dns-prefetch" href="//apis.google.com" />
	<link rel="dns-prefetch" href="//google-analytics.com" />
	<link rel="dns-prefetch" href="//www.google-analytics.com" />
	<link rel="dns-prefetch" href="//ssl.google-analytics.com" />
	<link rel="dns-prefetch" href="//code.jquery.com" />
	<link rel="dns-prefetch" href="//s0.wp.com" />
	<link rel="dns-prefetch" href="//stats.wp.com" />';
  if ( function_exists( 'get_field' ) ) {
    $option = get_field('post_types', 'option');
    if (!$option || in_array('locations', $option) )  {
      echo '<link rel="dns-prefetch" href="//maps.gstatic.com" />';
    }
    if ( shortcode_exists( 'facebook-page') || shortcode_exists( 'facebook-like') ) {
      echo '<link rel="dns-prefetch" href="//connect.facebook.net" />';
    }
  }
}
add_action('wp_head', 'insert_dns_prefetch', 0);


/* Pre-render Pages */

// function ost_prerender_prefetch() {
//   /* follow me on Twitter: @HertogJanR */
//   $next_post = get_next_post();
//   $prev_post = get_previous_post();
//   if ( !empty( $next_post ) ) {
//     echo '<link rel="prefetch" href="'.get_permalink( $next_post->ID ).'" />
//       <link rel="prerender" href="'.get_permalink( $next_post->ID ).'" />';
//   }
//   if ( !empty( $prev_post ) ) {
//     echo '<link rel="prefetch" href="'.get_permalink( $prev_post->ID ).'" />
//       <link rel="prerender" href="'.get_permalink( $prev_post->ID ).'" />';
//   }
// }
// add_action( 'wp_head', 'ost_prerender_prefetch', 10 );

/* Disable Self Pingbacks */

function no_self_ping( &$links ) {
    $home = get_option( 'home' );
    foreach ( $links as $l => $link )
        if ( 0 === strpos( $link, $home ) )
            unset($links[$l]);
}

add_action( 'pre_ping', 'no_self_ping' );

/* Dashicons */

function wpdocs_dequeue_dashicon() {
        if (current_user_can( 'update_core' )) {
            return;
        }
        wp_deregister_style('dashicons');
}
add_action( 'wp_enqueue_scripts', 'wpdocs_dequeue_dashicon' );

/**
 * ACF load json folder
 */

add_action( 'acf/save_post', 'create_acf_json_dir', 20 );
function create_acf_json_dir() {
	$target = wp_upload_dir()['baseurl'] . '/acf-json';
	wp_mkdir_p( $target );

	if ( wp_mkdir_p( $target ) === TRUE )
	{
			echo "Folder $target successfully created";
	}
	else
	{
			echo "Failed";
	}
}

add_filter('acf/settings/save_json', 'my_acf_json_save_point');

function my_acf_json_save_point( $path ) {

   // update path
   $path = wp_upload_dir()['baseurl'] . '/acf-json';

   // return
   return $path;

}
add_filter('acf/settings/load_json', 'my_acf_json_load_point');

function my_acf_json_load_point( $paths ) {

   // remove original path (optional)
   unset($paths[0]);


   // append path
   $paths[] = wp_upload_dir()['baseurl'] . '/acf-json';


   // return
   return $paths;

}
