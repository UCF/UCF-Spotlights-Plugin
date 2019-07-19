<?php
/*
Plugin Name: UCF Spotlights
Description: Provides a custom post type, shortcode and functions for displaying Spotlights.
Version: 2.0.5
Author: UCF Web Communications
License: GPL3
*/


if ( ! defined( 'WPINC' ) ) {
	die;
}

add_action( 'plugins_loaded', function() {

	define( 'UCF_SPOTLIGHT__PLUGIN_FILE', __FILE__ );

	add_image_size( 'ucf-spotlight-horizontal', 1200, 400, false );
	add_image_size( 'ucf-spotlight-vertical', 360, 360, false );
	add_image_size( 'ucf-spotlight-square', 767, 767, true );

	require_once 'layouts/layout-square.php';
	require_once 'layouts/layout-horizontal.php';
	require_once 'layouts/layout-vertical.php';
	require_once 'includes/ucf-spotlight-common.php';
	require_once 'includes/ucf-spotlight-posttype.php';
	require_once 'shortcodes/ucf-spotlight-shortcode.php';

} );

?>
