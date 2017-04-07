<?php
/**
 * Place common functions here.
 **/

if ( ! class_exists( 'UCF_Promo_Common' ) ) {
	class UCF_Promo_Common {
		public static function display_promo( $layout ) {
			$output = ucf_promo_display( $layout );
			echo apply_filters( 'ucf_promo_display', $output );
		}
	}
}

if ( ! function_exists( 'ucf_promo_display' ) ) {
	function ucf_promo_display( $layout='' ) {
		switch ($layout) {
			case "horizontal":
				echo ucf_promo_horizontal();
				break;
			case "vertical":
				echo ucf_promo_vertical();
				break;
			case "square":
				echo ucf_promo_square();
				break;
		}
	}
}

if ( ! function_exists( 'ucf_promo_horizontal' ) ) {
	function ucf_promo_horizontal( ) {
		ob_start();
	?>
		<div>
			<h3>Title</h3>
			<p>Description</p>
			<a href="">Link</a>
		</div>
	<?php
		return ob_get_clean();
	}
}

if ( ! function_exists( 'ucf_promo_vertical' ) ) {
	function ucf_promo_vertical( ) {
		ob_start();
	?>
		<div>
			<img src="" alt="">

			<h3>Title</h3>
			<p>Description</p>
			<a href="" class="btn btn-gold">Button</a>
		</div>
	<?php
		return ob_get_clean();
	}
}

if ( ! function_exists( 'ucf_promo_square' ) ) {
	function ucf_promo_square( ) {
		ob_start();
	?>
		<div>
			<p>Square copy</p>
			<a href="" class="btn btn-gold">Button</a>
		</div>
	<?php
		return ob_get_clean();
	}
}

 ?>