<?php

/* List scripts/css according to Handle */

function tp_print_scripts_styles() {
    // Print all loaded Scripts
		echo '<!-- Scripts Handles -- ';
    global $wp_scripts;
    foreach( $wp_scripts->queue as $script ) :
        echo $script . '  **  ';
    endforeach;
    // Print all loaded Styles (CSS)
		echo '-------------- CSS Handles --';
    global $wp_styles;
    foreach( $wp_styles->queue as $style ) :
        echo $style . '  ||  ';
    endforeach;
}
add_action( 'wp_head', 'tp_print_scripts_styles' );
add_action( 'admin_head', 'tp_print_scripts_styles' );

/* List Generated Image Sizes */

function list_generated_image_sizes() {
	echo '<!-- Generated Image Sizes -- ';
	$image_sizes = get_intermediate_image_sizes();
	foreach ($image_sizes as $size_name):
		echo $size_name . ' -- ';
	endforeach;
	echo ' -->';
}
add_action( 'wp_head', 'list_generated_image_sizes' );
add_action( 'admin_head', 'list_generated_image_sizes' );
