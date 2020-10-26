<?php

/**
 * Removes the Spotlight post type from WP-generated sitemaps.
 *
 * @since 2.1.0
 * @author Jo Dickson
 * @param array $post_types Array of post type names
 * @return array
 */
function ucf_spotlight_wp_sitemaps( $post_types ) {
	if ( isset( $post_types['ucf_spotlight'] ) ) {
		unset( $post_types['ucf_spotlight'] );
	}
	return $post_types;
}


/**
 * Removes the Spotlight post type from Yoast-generated sitemaps.
 *
 * @since 2.1.0
 * @author Jo Dickson
 * @param bool $excluded Whether or not the given post type should be excluded
 * @param string $post_type Post type name
 * @return bool
 */
function ucf_spotlight_yoast_sitemaps( $excluded, $post_type ) {
	if ( $post_type === 'ucf_spotlight' ) {
		return true;
	}
	return $excluded;
}


/**
 * Appends a noindex,nofollow meta tag to single Spotlights.
 *
 * For use via `wp_head`.
 *
 * @since 2.1.0
 * @author Jo Dickson
 * @return void
 */
function ucf_spotlight_meta_noindex() {
	if ( is_singular( 'ucf_spotlight' ) ) :
?>
<meta name="robots" content="noindex,nofollow">
<?php
	endif;
}


/**
 * Appends a noindex,nofollow meta tag to single Spotlights.
 *
 * For use via the `wpseo_robots` hook.
 *
 * @since 2.1.0
 * @author Jo Dickson
 * @param mixed $robots A meta robots string value, or false
 * @return mixed
 */
function ucf_spotlight_yoast_noindex( $robots ) {
	if ( is_singular( 'ucf_spotlight' ) ) {
		return 'noindex,nofollow';
	}
	return $robots;
}


/**
 * Removes Spotlights from Yoast's list of "accessible"
 * post types (public, indexable).
 *
 * For use via the `wpseo_accessible_post_types` hook.
 *
 * @since 2.1.0
 * @author Jo Dickson
 * @param array $post_types Array of post type names
 * @return array
 */
function ucf_spotlight_yoast_accessible_cpt( $post_types ) {
	if ( isset( $post_types['ucf_spotlight'] ) ) {
		unset( $post_types['ucf_spotlight'] );
	}
	return $post_types;
}


/**
 * Force-toggles Yoast settings in the admin to make it
 * slightly more obvious that these settings aren't
 * editable.
 *
 * For use via the `option_wpseo_titles` hook.
 *
 * @since 2.1.0
 * @author Jo Dickson
 * @param array $options Array of nested option keys/vals
 * @return array
 */
function ucf_spotlight_yoast_titles( $options ) {
	// "Show Spotlights in search results?"
	$options['noindex-ucf_spotlight'] = true; // yes this has to be `true` ¯\_(ツ)_/¯
	// "Yoast SEO Meta Box"
	$options['display-metabox-pt-ucf_spotlight'] = false;

	return $options;
}


/**
 * Register filters/actions based on whether or not
 * Yoast is activated:
 */
if ( class_exists( 'WPSEO_Options' ) ) {
	add_filter( 'wpseo_sitemap_exclude_post_type', 'ucf_spotlight_yoast_sitemaps', 10, 2 );
	add_filter( 'wpseo_robots', 'ucf_spotlight_yoast_noindex' );
	add_filter( 'wpseo_accessible_post_types', 'ucf_spotlight_yoast_accessible_cpt', 10, 1 );
	add_filter( 'option_wpseo_titles', 'ucf_spotlight_yoast_titles', 10, 1 );
}
else {
	add_filter( 'wp_sitemaps_post_types', 'ucf_spotlight_wp_sitemaps', 10, 1 );
	add_action( 'wp_head', 'ucf_spotlight_meta_noindex', 1 );
}

