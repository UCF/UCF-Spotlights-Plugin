<?php
/**
 * Place common functions here.
 **/

if ( ! class_exists( 'UCF_Spotlight_Common' ) ) {
	class UCF_Spotlight_Common {

		public function enqueue_styles() {
			wp_enqueue_style( 'ucf_spotlight_css', plugins_url( 'static/css/ucf-spotlight.min.css', UCF_SPOTLIGHT__PLUGIN_FILE ), false, false, 'all' );
		}

		public static function display_spotlight( $attr ) {
			$output = ucf_spotlight_display( $attr );
			return apply_filters( 'ucf_spotlight_display', $output );
		}
	}

	add_action( 'wp_enqueue_scripts', array( 'UCF_Spotlight_Common', 'enqueue_styles' ), 99 );
}

/**
* Returns the spotlight HTML to be displayed on the page.
* @author RJ Bruneel
* @since 1.0.0
* @param $attr string | title of the spotlight post type and one of three layouts.
* @return String
**/
if ( ! function_exists( 'ucf_spotlight_display' ) ) {
	function ucf_spotlight_display( $attr ) {
		// get post with $title
		if( !empty( $attr['title'] ) ) {
			$post = get_page_by_title( $attr['title'], OBJECT, 'ucf_spotlight' );

			$spotlight_image = ( $thumb = get_post_thumbnail_id( $post->ID ) ) ? array_shift( wp_get_attachment_image_src( $thumb, 'single-post-thumbnail' ) ) : NULL;

			$args = array(
				'header'    => get_post_meta( $post->ID, "ucf_spotlight_header", True ),
				'copy'      => get_post_meta( $post->ID, "ucf_spotlight_copy", True ),
				'link_text' => get_post_meta( $post->ID, "ucf_spotlight_link_text", True ),
				'link_url'  => get_post_meta( $post->ID, "ucf_spotlight_link_url", True ),
				'image'     => $spotlight_image,
			);

			switch ( $attr['layout'] ) {
				case "horizontal":
					return ucf_spotlight_horizontal( $args );
				case "vertical":
					return ucf_spotlight_vertical( $args );
				case "square":
					return ucf_spotlight_square( $args );
				default:
					return ucf_spotlight_square( $args );
			}
		}
	}
}

/**
* Returns the spotlight HTML for the horizontal layout of the spotlight.
* @author RJ Bruneel
* @since 1.0.0
* @param $attr string | contains the various elements of the spotlight (header, copy, link text and link url).
* @return String
**/
if ( ! function_exists( 'ucf_spotlight_horizontal' ) ) {
	function ucf_spotlight_horizontal( $args ) {
		ob_start();
	?>
				</div>
			</div>
		</div>
		<section class="spotlight-horizontal" style="background-image: url(<?php echo $args['image'] ?>)">
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-sm-12">
						<?php if( $args['header'] ): ?>
							<h2 class="spotlight-header"><?php echo $args['header'] ?></h2>
						<? endif; ?>
						<?php if( $args['copy'] ): ?>
							<p class="spotlight-copy"><?php echo $args['copy'] ?></p>
						<? endif ?>
						<?php if( $args['link_url'] && $args['link_text'] ): ?>
							<a class="spotlight-link" href="<?php echo $args['link_url'] ?>"><?php echo $args['link_text'] ?></a>
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
* Returns the spotlight HTML for the vertical layout of the spotlight.
* @author RJ Bruneel
* @since 1.0.0
* @param $attr string | contains the various elements of the spotlight (header, copy, link text and link url).
* @return String
**/
if ( ! function_exists( 'ucf_spotlight_vertical' ) ) {
	function ucf_spotlight_vertical( $args ) {
		ob_start();
	?>
		<aside>
			<div class="spotlight-vertical">
				<?php if( $args['image'] ): ?>
					<img class="spotlight-image" src="<?php echo $args['image'] ?>" alt="">
				<? endif; ?>
				<?php if( $args['header'] ): ?>
					<h2 class="spotlight-header"><?php echo $args['header'] ?></h2>
				<? endif; ?>
				<?php if( $args['copy'] ): ?>
					<p class="spotlight-copy"><?php echo $args['copy'] ?></p>
				<?php endif; ?>
				<?php if( $args['link_url'] && $args['link_text'] ): ?>
					<a class="spotlight-btn" href="<?php echo $args['link_url'] ?>"><?php echo $args['link_text'] ?></a>
				<?php endif; ?>
			</div>
		</aside>
	<?php
		return ob_get_clean();
	}
}

/**
* Returns the spotlight HTML for the square layout of the spotlight.
* @author RJ Bruneel
* @since 1.0.0
* @param $attr string | contains the various elements of the spotlight (header, copy, link text and link url).
* @return String
**/
if ( ! function_exists( 'ucf_spotlight_square' ) ) {
	function ucf_spotlight_square( $args ) {
		ob_start();
	?>
		<aside>
			<?php if( $args['link_url'] ): ?>
				<a href="<?php echo $args['link_url'] ?>">
			<?php endif; ?>
				<div class="spotlight-square" style="background-image: url(<?php echo $args['image'] ?>)">
					<?php if( $args['header'] ): ?>
						<h2 class="spotlight-header"><?php echo $args['header'] ?></h2>
					<? endif; ?>
					<?php if( $args['copy'] ): ?>
						<p class="spotlight-copy"><?php echo $args['copy'] ?></p>
					<?php endif; ?>
					<?php if( $args['link_text'] ): ?>
						<div class="spotlight-btn-wrapper">
							<div class="spotlight-btn"><?php echo $args['link_text'] ?></div>
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