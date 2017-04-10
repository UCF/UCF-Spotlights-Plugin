<?php
/*
Plugin Name: UCF Promo
Description:
Version: 1.0.0
Author: UCF Web Communications
License: GPL3
*/


if ( ! defined( 'WPINC' ) ) {
	die;
}

add_action( 'plugins_loaded', function() {

	define( 'UCF_PROMO__PLUGIN_FILE', __FILE__ );

	require_once 'includes/ucf-promo-common.php';
	require_once 'shortcodes/ucf-promo-shortcode.php';
	require_once 'includes/ucf-promo-posttype.php';

} );

?>
