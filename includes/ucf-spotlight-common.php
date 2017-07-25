<?php
/**
 * Place common functions here.
 **/

if ( ! class_exists( 'UCF_Spotlight_Common' ) ) {
	class UCF_Spotlight_Common {

		public static function enqueue_styles() {
			if ( get_option( 'ucf_spotlight_include_css' ) ) {
				wp_enqueue_style( 'ucf_spotlight_css', plugins_url( 'static/css/ucf-spotlight.min.css', UCF_SPOTLIGHT__PLUGIN_FILE ), false, false, 'all' );
			}
		}

		public static function display_spotlight( $attr ) {
			$output = self::ucf_spotlight_display( $attr );
			return apply_filters( 'ucf_spotlight_display', $output );
		}

		/**
		* Returns the spotlight HTML to be displayed on the page.
		* @author RJ Bruneel
		* @since 1.0.0
		* @param $attr string | slug of the spotlight post type and one of three layouts.
		* @return String
		**/
		private static function ucf_spotlight_display( $attr ) {
			// get post with $slug
			if( !empty( $attr['slug'] ) ) {

				$args = array(
					'name'        => $attr['slug'],
					'post_type'   => 'ucf_spotlight',
					'post_status' => 'publish',
					'numberposts' => 1
				);

				if( $posts = get_posts( $args ) ) {
					$post = array_shift( $posts );
				} else {
					return;
				}

				if( $thumb = get_post_thumbnail_id( $post->ID )) {
					if( $attachments = wp_get_attachment_image_src( $thumb, 'single-post-thumbnail' ) ) {
						$attachment = array_shift( $attachments );
					}
				}

				$spotlight_image = ( $thumb ) ? $attachment : NULL;

				$args = array(
					'layout'    => get_post_meta( $post->ID, "ucf_spotlight_layout", True ),
					'header'    => get_post_meta( $post->ID, "ucf_spotlight_header", True ),
					'copy'      => get_post_meta( $post->ID, "ucf_spotlight_copy", True ),
					'link_text' => get_post_meta( $post->ID, "ucf_spotlight_link_text", True ),
					'link_url'  => get_post_meta( $post->ID, "ucf_spotlight_link_url", True ),
					'image'     => $spotlight_image,
				);

				switch ( $args['layout'] ) {
					case "horizontal":
						return self::ucf_spotlight_horizontal( $args );
					case "vertical":
						return self::ucf_spotlight_vertical( $args );
					default:
						return self::ucf_spotlight_square( $args );
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
		private static function ucf_spotlight_horizontal( $args ) {
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
								<div class="spotlight-header"><?php echo $args['header'] ?></div>
							<?php endif; ?>
							<?php if( $args['copy'] ): ?>
								<p class="spotlight-copy"><?php echo $args['copy'] ?></p>
							<?php endif ?>
							<?php if( $args['link_url'] && $args['link_text'] ): ?>
								<a class="btn btn-primary" href="<?php echo $args['link_url'] ?>"><?php echo $args['link_text'] ?></a>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</section>
		<?php
			return ob_get_clean();
		}

		/**
		* Returns the spotlight HTML for the vertical layout of the spotlight.
		* @author RJ Bruneel
		* @since 1.0.0
		* @param $attr string | contains the various elements of the spotlight (header, copy, link text and link url).
		* @return String
		**/
		private static function ucf_spotlight_vertical( $args ) {
			ob_start();
		?>
			<aside>
				<div class="spotlight-vertical">
					<?php if( $args['image'] ): ?>
						<img class="spotlight-image" src="<?php echo $args['image'] ?>" alt="">
					<?php endif; ?>
					<?php if( $args['header'] ): ?>
						<div class="spotlight-header"><?php echo $args['header'] ?></div>
					<?php endif; ?>
					<?php if( $args['copy'] ): ?>
						<p class="spotlight-copy"><?php echo $args['copy'] ?></p>
					<?php endif; ?>
					<?php if( $args['link_url'] && $args['link_text'] ): ?>
						<a class="btn btn-primary" href="<?php echo $args['link_url'] ?>"><?php echo $args['link_text'] ?></a>
					<?php endif; ?>
				</div>
			</aside>
		<?php
			return ob_get_clean();
		}

		/**
		* Returns the spotlight HTML for the square layout of the spotlight.
		* @author RJ Bruneel
		* @since 1.0.0
		* @param $attr string | contains the various elements of the spotlight (header, copy, link text and link url).
		* @return String
		**/
		private static function ucf_spotlight_square( $args ) {
			ob_start();
		?>
			<aside>
				<?php if( $args['link_url'] ): ?>
					<a href="<?php echo $args['link_url'] ?>">
				<?php endif; ?>
					<div class="spotlight-square" style="background-image: url(<?php echo $args['image'] ?>)">
						<?php if( $args['header'] ): ?>
							<div class="spotlight-header"><?php echo $args['header'] ?></div>
						<?php endif; ?>
						<?php if( $args['copy'] ): ?>
							<p class="spotlight-copy"><?php echo $args['copy'] ?></p>
						<?php endif; ?>
						<?php if( $args['link_text'] ): ?>
							<div class="spotlight-btn-wrapper">
								<div class="btn btn-primary"><?php echo $args['link_text'] ?></div>
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

	add_action( 'wp_enqueue_scripts', array( 'UCF_Spotlight_Common', 'enqueue_styles' ) );
}

 ?>
