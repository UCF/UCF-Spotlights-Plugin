<?php

/**
 * Returns a default template for single Spotlights when the
 * current theme (or its parent theme, if applicable) haven't
 * already defined one.
 *
 * @author Jo Dickson
 * @since 2.1.0
 */
function ucf_spotlight_template( $template ) {
	if ( get_query_var( 'post_type' ) === 'ucf_spotlight' && ! is_archive() ) {
		// Look for a file in theme
		if ( ! locate_template( 'single-ucf_spotlight.php', false ) ) {
			$new_template = UCF_SPOTLIGHT__PLUGIN_DIR . 'templates/single-ucf_spotlight.php';
			if ( file_exists( $new_template ) ) {
				return $new_template;
			}
		}
	}

	return $template;
}

add_filter( 'template_include', 'ucf_spotlight_template', 9 );
