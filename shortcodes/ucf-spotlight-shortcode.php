<?php
/**
 * Registers the spotlight shortcode
 * @author RJ Bruneel
 * @since 1.0.0
 **/

if ( ! class_exists( 'UCF_Spotlight_Shortcode' ) ) {
	class UCF_Spotlight_Shortcode {
		public static function shortcode( $atts ) {
			$atts = shortcode_atts( array(
				'title'  => '',
				'layout' => '',
			), $atts );

			return UCF_Spotlight_Common::display_spotlight( $atts );
		}
	}
	add_shortcode( 'ucf-spotlight', array( 'UCF_Spotlight_Shortcode', 'shortcode' ) );
}
?>