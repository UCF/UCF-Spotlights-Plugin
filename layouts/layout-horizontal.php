<?php
/**
 * Returns the spotlight HTML for the horizontal layout of the spotlight.
 * @author Jo Dickson
 * @since 2.0.0
 * @param object $item | WP_Post object for the spotlight
 * @param array $args | contains the various elements of the spotlight (header, copy, link text and link url).
 * @return String
 **/
function ucf_spotlight_display_horizontal( $content='', $item, $args ) {
	$img = get_the_post_thumbnail( $item, 'ucf-spotlight-horizontal', array(
		'class' => 'media-background object-fit-cover hidden-md-down'
	) );

	ob_start();
?>
	<aside class="spotlight spotlight-horizontal py-5 <?php if ( $img ) { echo 'media-background-container'; } ?>">
		<?php if ( $img ) { echo $img; } ?>
		<div class="container">
			<div class="row">
				<div class="col-lg-8">
					<?php if ( $args['header'] ): ?>
					<div class="spotlight-header h1 font-condensed text-uppercase mb-4">
						<?php echo $args['header']; ?>
					</div>
					<?php endif; ?>

					<?php if ( $args['copy'] ): ?>
					<div class="spotlight-copy">
						<?php echo $args['copy']; ?>
					</div>
					<?php endif; ?>

					<?php if ( $args['link_url'] && $args['link_text'] ): ?>
					<a class="spotlight-btn btn btn-primary mt-4" href="<?php echo $args['link_url']; ?>">
						<?php echo $args['link_text']; ?>
					</a>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</aside>
<?php
	return ob_get_clean();
}

add_filter( 'ucf_spotlight_display_horizontal', 'ucf_spotlight_display_horizontal', 10, 3 );
