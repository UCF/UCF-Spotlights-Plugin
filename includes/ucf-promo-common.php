<?php
/**
 * Place common functions here.
 **/

if ( ! class_exists( 'UCF_Promo_Common' ) ) {
	class UCF_Promo_Common {
		public static function display_promo( $attr ) {
			$output = ucf_promo_display( $attr );
			echo apply_filters( 'ucf_promo_display', $output );
		}
	}
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
					echo ucf_promo_horizontal( $args );
					break;
				case "vertical":
					echo ucf_promo_vertical( $args );
					break;
				default:
					echo ucf_promo_square( $args );
					break;
			}
		}
	}
}

if ( ! function_exists( 'ucf_promo_horizontal' ) ) {
	function ucf_promo_horizontal( $args ) {
		ob_start();
	?>
		<div class="promo-horizontal" style="background-image: url(<?php echo $args['image'] ?>)">
			<?php if( $args['header'] ): ?>
				<h3><?php echo $args['header'] ?></h3>
			<? endif; ?>
			<?php if( $args['copy'] ): ?>
				<p><?php echo $args['copy'] ?></p>
			<? endif ?>
			<?php if( $args['link_url'] && $args['link_text'] ): ?>
				<a href="<?php echo $args['link_url'] ?>"><?php echo $args['link_text'] ?></a>
			<?php endif; ?>
		</div>
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
				<h3><?php echo $args['header'] ?></h3>
			<? endif; ?>
			<?php if( $args['copy'] ): ?>
				<p><?php echo $args['copy'] ?></p>
			<?php endif; ?>
			<?php if( $args['link_url'] && $args['link_text'] ): ?>
				<a href="<?php echo $args['link_url'] ?>"><?php echo $args['link_text'] ?></a>
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
		<div class="promo-square" style="background-image: url(<?php echo $args['image'] ?>)">
			<?php if( $args['header'] ): ?>
				<h3><?php echo $args['header'] ?></h3>
			<? endif; ?>
			<?php if( $args['copy'] ): ?>
				<p><?php echo $args['copy'] ?></p>
			<?php endif; ?>
			<?php if( $args['link_url'] && $args['link_text'] ): ?>
				<a href="<?php echo $args['link_url'] ?>"><?php echo $args['link_text'] ?></a>
			<?php endif; ?>
		</div>
	<?php
		return ob_get_clean();
	}
}

 ?>