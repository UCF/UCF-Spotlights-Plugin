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

if ( ! function_exists( 'ucf_promo_display' ) ) {
	function ucf_promo_display( $attr ) {
		// get post with $title
		if( !empty( $attr['title'] ) ) {
			$post = get_page_by_title( $attr['title'], OBJECT, 'promo' );

			$args = array(
				'header'    => get_post_meta( $post->ID, "ucf_promo_header", True ),
				'copy'      => get_post_meta( $post->ID, "ucf_promo_copy", True ),
				'link_text' => get_post_meta( $post->ID, "ucf_promo_link_text", True ),
				'link_url'  => get_post_meta( $post->ID, "ucf_promo_link_url", True ),
				'image'     => array_shift( wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ) ),
			);

			switch ($attr['layout']) {
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
							<h2><?php echo $args['header'] ?></h2>
						<? endif; ?>
						<?php if( $args['copy'] ): ?>
							<p><?php echo $args['copy'] ?></p>
						<? endif ?>
						<?php if( $args['link_url'] && $args['link_text'] ): ?>
							<a href="<?php echo $args['link_url'] ?>"><?php echo $args['link_text'] ?></a>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</section>
	<?php
		return ob_get_clean();
	}
}

if ( ! function_exists( 'ucf_promo_vertical' ) ) {
	function ucf_promo_vertical( $args ) {
		ob_start();
	?>
		<div class="promo-vertical">
			<?php if( $args['image'] ): ?>
				<img src="<?php echo $args['image'] ?>" alt="">
			<? endif; ?>
			<?php if( $args['header'] ): ?>
				<h2><?php echo $args['header'] ?></h2>
			<? endif; ?>
			<?php if( $args['copy'] ): ?>
				<p><?php echo $args['copy'] ?></p>
			<?php endif; ?>
			<?php if( $args['link_url'] && $args['link_text'] ): ?>
				<a class="btn" href="<?php echo $args['link_url'] ?>"><?php echo $args['link_text'] ?></a>
			<?php endif; ?>
		</div>
	<?php
		return ob_get_clean();
	}
}

if ( ! function_exists( 'ucf_promo_square' ) ) {
	function ucf_promo_square( $args ) {
		ob_start();
	?>
		<?php if( $args['link_url'] ): ?>
			<a href="<?php echo $args['link_url'] ?>">
		<?php endif; ?>
			<div class="promo-square" style="background-image: url(<?php echo $args['image'] ?>)">
				<?php if( $args['header'] ): ?>
					<h2><?php echo $args['header'] ?></h2>
				<? endif; ?>
				<?php if( $args['copy'] ): ?>
					<p><?php echo $args['copy'] ?></p>
				<?php endif; ?>
				<?php if( $args['link_text'] ): ?>
					<div class="btn-wrapper text-align-center">
						<div class="btn"><?php echo $args['link_text'] ?></div>
					</div>
				<?php endif; ?>
			</div>
		<?php if( $args['link_url'] ): ?>
			</a>
		<?php endif; ?>
	<?php
		return ob_get_clean();
	}
}

 ?>