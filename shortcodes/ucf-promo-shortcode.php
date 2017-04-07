<?php
/**
 * Registers the promo shortcode
 **/

if ( ! class_exists( 'UCF_Promo_Shortcode' ) ) {
	class UCF_Promo_Shortcode {
		public static function shortcode( $atts ) {
			$atts = shortcode_atts( array(
				'layout'       => '',
			), $atts );

			return UCF_Promo_Common::display_promo( $atts['layout'] );
		}
	}
	add_shortcode( 'ucf-promo', array( 'UCF_Promo_Shortcode', 'shortcode' ) );
}
?>