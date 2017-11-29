<?php
/**
 * Place common functions here.
 **/

if ( ! class_exists( 'UCF_Spotlight_Common' ) ) {
	class UCF_Spotlight_Common {

		public static function display_spotlight( $item, $args=array() ) {
			$args = array_merge( self::get_spotlight_meta( $item->ID ), $args );

			ob_start();

			// Main content/loop
			$layout_content = ucf_spotlight_display_square( '', $item, $args ); // square=default
			if ( has_filter( 'ucf_spotlight_display_' . $args['layout'] ) ) {
				$layout_content = apply_filters( 'ucf_spotlight_display_' . $args['layout'], $layout_content, $item, $args );
			}
			echo $layout_content;

			return ob_get_clean();
		}

		/**
		 * Returns a spotlight by its slug.
		 *
		 * @author Jo Dickson
		 * @since 2.0.0
		 * @param string $slug | Spotlight slug
		 * @return mixed | WP_Post object for the spotlight, or false on failure
		 */
		public static function get_spotlight_by_slug( $slug ) {
			$posts = get_posts( array(
				'post_type'   => 'ucf_spotlight',
				'numberposts' => 1,
				'name'        => $slug
			) );

			return $posts ? $posts[0] : false;
		}

		/**
		 * Returns an array of relevant post metadata for the given spotlight.
		 *
		 * @author Jo Dickson
		 * @since 2.0.0
		 * @param int $spotlight_id | ID for the spotlight
		 * @return array | array of metadata
		 */
		public static function get_spotlight_meta( $spotlight_id ) {
			return array(
				'layout'    => get_post_meta( $spotlight_id, 'ucf_spotlight_layout', true ) ?: 'square',
				'header'    => get_post_meta( $spotlight_id, 'ucf_spotlight_header', true ),
				'copy'      => get_post_meta( $spotlight_id, 'ucf_spotlight_copy', true ),
				'link_text' => get_post_meta( $spotlight_id, 'ucf_spotlight_link_text', true ),
				'link_url'  => get_post_meta( $spotlight_id, 'ucf_spotlight_link_url', true ),
				'image_id'  => get_post_thumbnail_id( $spotlight_id )
			);
		}

	}
}

 ?>
