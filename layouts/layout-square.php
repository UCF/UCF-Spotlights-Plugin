<?php
/**
 * Returns the spotlight HTML for the square layout of the spotlight.
 * @author Jo Dickson
 * @since 2.0.0
 * @param object $item | WP_Post object for the spotlight
 * @param array $args | contains the various elements of the spotlight (header, copy, link text and link url).
 * @return String
 **/
function ucf_spotlight_display_square( $content='', $item, $args ) {
	$img = get_the_post_thumbnail( $item, 'ucf-spotlight-square', array(
		'class' => 'media-background object-fit-cover'
	) );

	ob_start();
?>
	<aside class="spotlight spotlight-square">
		<?php if ( $args['link_url'] ): ?>
			<a href="<?php echo $args['link_url']; ?>" class="spotlight-block-link hover-parent text-decoration-none">
		<?php endif; ?>
			<div class="<?php if ( $img ) { echo 'media-background-container'; } ?> bg-default d-flex flex-column text-center p-4" style="min-height: 20rem;">
				<?php if ( $img ) { echo $img; } ?>

				<?php if ( $args['header'] ): ?>
				<div class="spotlight-header h3 font-slab-serif text-inverse">
					<?php echo $args['header']; ?>
				</div>
				<?php endif; ?>

				<div class="spotlight-copy font-sans-serif text-inverse">
					<?php if ( $args['copy'] ) { echo $args['copy']; } ?>
				</div>

				<?php if ( $args['link_text'] ): ?>
				<div class="spotlight-btn-wrapper font-sans-serif mt-auto pt-5">
					<div class="spotlight-btn btn btn-primary btn-sm p-3">
						<?php echo $args['link_text']; ?>
					</div>
				</div>
				<?php endif; ?>
			</div>
		<?php if ( $args['link_url'] ): ?>
			</a>
		<?php endif; ?>
	</aside>
<?php
	return ob_get_clean();
}

add_filter( 'ucf_spotlight_display_square', 'ucf_spotlight_display_square', 10, 3 );
