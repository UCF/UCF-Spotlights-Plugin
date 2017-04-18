<?php
/*
Plugin Name: UCF Spotlight
Description:
Version: 1.0.0
Author: UCF Web Communications
License: GPL3
*/


if ( ! defined( 'WPINC' ) ) {
	die;
}

add_action( 'plugins_loaded', function() {

	define( 'UCF_SPOTLIGHT__PLUGIN_FILE', __FILE__ );

	require_once 'includes/ucf-spotlight-common.php';
	require_once 'shortcodes/ucf-spotlight-shortcode.php';
	require_once 'includes/ucf-spotlight-posttype.php';

} );

?>
