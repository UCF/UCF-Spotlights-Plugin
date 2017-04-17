<?php
/**
 * Place common functions here.
 **/

if ( ! class_exists( 'UCF_Promo_Common' ) ) {
	class UCF_Promo_Common {

		public function enqueue_styles() {
			wp_enqueue_style( 'ucf_promo_css', plugins_url( 'static/css/ucf-promo.min.css', UCF_PROMO__PLUGIN_FILE ), false, false, 'all' );
		}

		public static function display_promo( $attr ) {
			$output = ucf_promo_display( $attr );
			return apply_filters( 'ucf_promo_display', $output );
		}
	}

	add_action( 'wp_enqueue_scripts', array( 'UCF_Promo_Common', 'enqueue_styles' ), 99 );
}

/**
* Returns the promo HTML to be displayed on the page.
* @author RJ Bruneel
* @since 1.0.0
* @param $attr string | title of the promo post type and one of three layouts.
* @return String
**/
if ( ! function_exists( 'ucf_promo_display' ) ) {
	function ucf_promo_display( $attr ) {
		// get post with $title
		if( !empty( $attr['title'] ) ) {
			$post = get_page_by_title( $attr['title'], OBJECT, 'ucf_promo' );

			$promo_image = ( $thumb = get_post_thumbnail_id( $post->ID ) ) ? array_shift( wp_get_attachment_image_src( $thumb, 'single-post-thumbnail' ) ) : NULL;

			$args = array(
				'header'    => get_post_meta( $post->ID, "ucf_promo_header", True ),
				'copy'      => get_post_meta( $post->ID, "ucf_promo_copy", True ),
				'link_text' => get_post_meta( $post->ID, "ucf_promo_link_text", True ),
				'link_url'  => get_post_meta( $post->ID, "ucf_promo_link_url", True ),
				'image'     => $promo_image,
			);

			switch ( $attr['layout'] ) {
				case "horizontal":
					return ucf_promo_horizontal( $args );
				case "vertical":
					return ucf_promo_vertical( $args );
				case "square":
					return ucf_promo_square( $args );
				default:
					return ucf_promo_square( $args );
			}
		}
	}
}

/**
* Returns the promo HTML for the horizontal layout of the promo.
* @author RJ Bruneel
* @since 1.0.0
* @param $attr string | contains the various elements of the promo (header, copy, link text and link url).
* @return String
**/
if ( ! function_exists( 'ucf_promo_horizontal' ) ) {
	function ucf_promo_horizontal( $args ) {
		ob_start();
	?>
				</div>
			</div>
		</div>
		<section class="promo-horizontal" style="background-image: url(<?php echo $args['image'] ?>)">
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-sm-12">
						<?php if( $args['header'] ): ?>
							<h2 class="promo-header"><?php echo $args['header'] ?></h2>
						<? endif; ?>
						<?php if( $args['copy'] ): ?>
							<p class="promo-copy"><?php echo $args['copy'] ?></p>
						<? endif ?>
						<?php if( $args['link_url'] && $args['link_text'] ): ?>
							<a class="promo-link" href="<?php echo $args['link_url'] ?>"><?php echo $args['link_text'] ?></a>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</section>
	<?php
		return ob_get_clean();
	}
}

/**
* Returns the promo HTML for the vertical layout of the promo.
* @author RJ Bruneel
* @since 1.0.0
* @param $attr string | contains the various elements of the promo (header, copy, link text and link url).
* @return String
**/
if ( ! function_exists( 'ucf_promo_vertical' ) ) {
	function ucf_promo_vertical( $args ) {
		ob_start();
	?>
		<aside>
			<div class="promo-vertical">
				<?php if( $args['image'] ): ?>
					<img class="promo-image" src="<?php echo $args['image'] ?>" alt="">
				<? endif; ?>
				<?php if( $args['header'] ): ?>
					<h2 class="promo-header"><?php echo $args['header'] ?></h2>
				<? endif; ?>
				<?php if( $args['copy'] ): ?>
					<p class="promo-copy"><?php echo $args['copy'] ?></p>
				<?php endif; ?>
				<?php if( $args['link_url'] && $args['link_text'] ): ?>
					<a class="promo-btn" href="<?php echo $args['link_url'] ?>"><?php echo $args['link_text'] ?></a>
				<?php endif; ?>
			</div>
		</aside>
	<?php
		return ob_get_clean();
	}
}

/**
* Returns the promo HTML for the square layout of the promo.
* @author RJ Bruneel
* @since 1.0.0
* @param $attr string | contains the various elements of the promo (header, copy, link text and link url).
* @return String
**/
if ( ! function_exists( 'ucf_promo_square' ) ) {
	function ucf_promo_square( $args ) {
		ob_start();
	?>
		<aside>
			<?php if( $args['link_url'] ): ?>
				<a href="<?php echo $args['link_url'] ?>">
			<?php endif; ?>
				<div class="promo-square" style="background-image: url(<?php echo $args['image'] ?>)">
					<?php if( $args['header'] ): ?>
						<h2 class="promo-header"><?php echo $args['header'] ?></h2>
					<? endif; ?>
					<?php if( $args['copy'] ): ?>
						<p class="promo-copy"><?php echo $args['copy'] ?></p>
					<?php endif; ?>
					<?php if( $args['link_text'] ): ?>
						<div class="promo-btn-wrapper">
							<div class="promo-btn"><?php echo $args['link_text'] ?></div>
						</div>
					<?php endif; ?>
				</div>
			<?php if( $args['link_url'] ): ?>
				</a>
			<?php endif; ?>
		</aside>
	<?php
		return ob_get_clean();
	}
}

 ?>