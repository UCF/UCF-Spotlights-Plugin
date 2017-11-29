<?php
/**
 * Returns the spotlight HTML for the vertical layout of the spotlight.
 * @author Jo Dickson
 * @since 2.0.0
 * @param object $item | WP_Post object for the spotlight
 * @param array $args | contains the various elements of the spotlight (header, copy, link text and link url).
 * @return String
 **/
function ucf_spotlight_display_vertical( $content='', $item, $args ) {
	$img = get_the_post_thumbnail( $item, 'ucf-spotlight-vertical', array(
		'class' => 'img-fluid mb-3'
	) );

	ob_start();
?>
	<aside class="spotlight spotlight-vertical font-sans-serif">
		<?php if ( $args['link_url'] ): ?>
		<a href="<?php echo $args['link_url']; ?>" class="spotlight-block-link" style="color: inherit;">
		<?php endif; ?>

		<?php if ( $img ) { echo $img; } ?>

		<?php if ( $args['header'] ): ?>
		<div class="spotlight-header h4">
			<?php echo $args['header']; ?>
		</div>
		<?php endif; ?>

		<?php if ( $args['link_url'] ): ?>
		</a>
		<?php endif; ?>

		<?php if ( $args['copy'] ): ?>
		<div class="spotlight-copy">
			<?php echo $args['copy']; ?>
		</div>
		<?php endif; ?>

		<?php if ( $args['link_url'] && $args['link_text'] ): ?>
		<a class="spotlight-btn btn btn-primary mt-3" href="<?php echo $args['link_url']; ?>">
			<?php echo $args['link_text']; ?>
		</a>
		<?php endif; ?>
	</aside>
<?php
	return ob_get_clean();
}

add_filter( 'ucf_spotlight_display_vertical', 'ucf_spotlight_display_vertical', 10, 3 );
