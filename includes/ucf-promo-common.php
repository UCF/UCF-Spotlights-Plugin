<?php
/**
 * Place common functions here.
 **/

if ( ! class_exists( 'UCF_Promo_Common' ) ) {
	class UCF_Promo_Common {
		public static function display_promo( $layout ) {

			ob_start();

			$output = ucf_promo_display();
			echo apply_filters( 'ucf_promo_display', $output );

			return ob_get_clean();

		}
	}
}

if ( ! function_exists( 'ucf_promo_display' ) ) {
	function ucf_promo_display( $output='' ) {
		ob_start();
	?>
		<h2>Promo Goes Here</h2>
	<?php
		return ob_get_clean();
	}
}

 ?>