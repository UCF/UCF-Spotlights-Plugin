<?php
/*
Plugin Name: UCF Spotlights
Description: Provides a custom post type, shortcode and functions for displaying Spotlights.
Version: 2.0.7
Author: UCF Web Communications
License: GPL3
GitHub Plugin URI: UCF/UCF-Spotlights-Plugin
*/


if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'UCF_SPOTLIGHT__PLUGIN_FILE', __FILE__ );
define( 'UCF_SPOTLIGHT__PLUGIN_DIR', plugin_dir_path( UCF_SPOTLIGHT__PLUGIN_FILE ) );


add_action( 'plugins_loaded', function() {

	add_image_size( 'ucf-spotlight-horizontal', 1200, 400, false );
	add_image_size( 'ucf-spotlight-vertical', 360, 360, false );
	add_image_size( 'ucf-spotlight-square', 767, 767, true );

	require_once UCF_SPOTLIGHT__PLUGIN_DIR . 'layouts/layout-square.php';
	require_once UCF_SPOTLIGHT__PLUGIN_DIR . 'layouts/layout-horizontal.php';
	require_once UCF_SPOTLIGHT__PLUGIN_DIR . 'layouts/layout-vertical.php';
	require_once UCF_SPOTLIGHT__PLUGIN_DIR . 'includes/ucf-spotlight-common.php';
	require_once UCF_SPOTLIGHT__PLUGIN_DIR . 'includes/ucf-spotlight-posttype.php';
	require_once UCF_SPOTLIGHT__PLUGIN_DIR . 'includes/ucf-spotlight-templates.php';
	require_once UCF_SPOTLIGHT__PLUGIN_DIR . 'includes/ucf-spotlight-meta.php';
	require_once UCF_SPOTLIGHT__PLUGIN_DIR . 'shortcodes/ucf-spotlight-shortcode.php';

} );

?>
