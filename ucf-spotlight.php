<?php
/*
Plugin Name: UCF Spotlight
Description:
Version: 1.0.3
Author: UCF Web Communications
License: GPL3
*/


if ( ! defined( 'WPINC' ) ) {
	die;
}

add_action( 'plugins_loaded', function() {

	define( 'UCF_SPOTLIGHT__PLUGIN_FILE', __FILE__ );

	require_once 'includes/ucf-spotlight-config.php';
	require_once 'includes/ucf-spotlight-common.php';
	require_once 'shortcodes/ucf-spotlight-shortcode.php';
	require_once 'includes/ucf-spotlight-posttype.php';

	add_action( 'admin_menu', array( 'UCF_Spotlight_Config', 'add_options_page' ) );

} );

?>
