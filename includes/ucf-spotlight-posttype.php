<?php
/**
 * Handles the registration of the spotlight custom post type.
 * @author RJ Bruneel
 * @since 1.0.0
 **/
if ( ! class_exists( 'UCF_Spotlight_PostType' ) ) {
	class UCF_Spotlight_PostType {
		/**
		 * Registers the custom post type.
		 * @author RJ Bruneel
		 * @since 1.0.0
		 **/
		public static function register() {
			$labels = apply_filters(
				'ucf_spotlight_labels',
				array(
					'singular'    => 'Spotlight',
					'plural'      => 'Spotlights',
					'text_domain' => 'ucf_spotlight'
				)
			);
			register_post_type( 'ucf_spotlight', self::args( $labels ) );
			add_action( 'add_meta_boxes', array( 'UCF_Spotlight_PostType', 'register_metabox' ) );
			add_action( 'save_post', array( 'UCF_Spotlight_PostType', 'save_metabox' ) );
		}


		/**
		 * Adds a metabox to the spotlight custom post type.
		 * @author RJ Bruneel
		 * @since 1.0.0
		 **/
		public static function register_metabox() {
			add_meta_box(
				'ucf_spotlight_metabox',
				'Spotlight Details',
				array( 'UCF_Spotlight_PostType', 'register_metafields' ),
				'ucf_spotlight',
				'normal',
				'high'
			);
		}


		/**
		 * Adds metafields to the metabox
		 * @author RJ Bruneel
		 * @since 1.0.0
		 * @param $post WP_POST object
		 **/
		public static function register_metafields( $post ) {
			wp_nonce_field( 'ucf_spotlight_nonce_save', 'ucf_spotlight_nonce' );
			$layout = get_post_meta( $post->ID, 'ucf_spotlight_layout', TRUE );
			$header = get_post_meta( $post->ID, 'ucf_spotlight_header', TRUE );
			$copy = get_post_meta( $post->ID, 'ucf_spotlight_copy', TRUE );
			$link_text = get_post_meta( $post->ID, 'ucf_spotlight_link_text', TRUE );
			$link_url = get_post_meta( $post->ID, 'ucf_spotlight_link_url', TRUE );
?>
			<table class="form-table">
				<tbody>
					<tr>
						<th>
							<strong>Shortcode</strong>
						</th>
						<td>
							<p class="description">
								[ucf-spotlight slug="<?php echo $post->post_name ?>"]
							</p>
						</td>
					</tr>
					<tr>
						<th>
							<label class="block" for="ucf_spotlight_layout"><strong>Layout</strong></label>
						</th>
						<td>
							<p class="description">One of three layout options depicting the appearance.</p>
							<select id="ucf_spotlight_layout" name="ucf_spotlight_layout" class="regular-text">
								<option value="square"<?php echo ( $layout == 'square' ) ? ' selected' : ''; ?>>Square - Feature Image Size: 650x300</option>
								<option value="vertical"<?php echo ( $layout == 'vertical' ) ? ' selected' : ''; ?>>Vertical - Feature Image Size: 320x400</option>
								<option value="horizontal"<?php echo ( $layout == 'horizontal' ) ? ' selected' : ''; ?>>Horizontal - Feature Image Size: 1200x400</option>
							</select>
						</td>
					</tr>
					<tr>
						<th>
							<label class="block" for="ucf_spotlight_header"><strong>Header</strong></label>
						</th>
						<td>
							<p class="description">(Optional) Large header displayed at the top of the spotlight.</p>
							<input type="text" id="ucf_spotlight_header" name="ucf_spotlight_header" class="regular-text" <?php echo ( ! empty( $header ) ) ? 'value="' . $header . '"' : ''; ?>>
						</td>
					</tr>
					<tr>
						<th>
							<label class="block" for="ucf_spotlight_copy"><strong>Copy</strong></label>
						</th>
						<td>
							<p class="description">(Optional) Copy displayed under the large header.</p>
							<textarea id="ucf_spotlight_copy" name="ucf_spotlight_copy" cols="46" rows="5"><?php echo ( ! empty( $copy ) ) ? $copy : ''; ?></textarea>
						</td>
					</tr>
					<tr>
						<th>
							<label class="block" for="ucf_spotlight_link_text"><strong>Link Text</strong></label>
						</th>
						<td>
							<p class="description">(Optional) Text displayed within the link under the copy.</p>
							<input type="text" id="ucf_spotlight_link_text" name="ucf_spotlight_link_text" class="regular-text" <?php echo ( ! empty( $link_text ) ) ? 'value="' . $link_text . '"' : ''; ?>>
						</td>
					</tr>
					<tr>
						<th>
							<label class="block" for="ucf_spotlight_link_url"><strong>Link URL</strong></label>
						</th>
						<td>
							<p class="description">(Optional) URL of the link.</p>
							<input type="text" id="ucf_spotlight_link_url" name="ucf_spotlight_link_url" class="regular-text" <?php echo ( ! empty( $link_url ) ) ? 'value="' . $link_url . '"' : ''; ?>>
						</td>
					</tr>
				</tbody>
			</table>
<?php
		}

		/**
		 * Handles saving the data in the metabox
		 * @author RJ Bruneel
		 * @since 1.0.0
		 * @param $post_id WP_POST post id
		 **/
		public static function save_metabox( $post_id ) {
			$post_type = get_post_type( $post_id );
			// If this isn't a spotlight, return.
			if ( 'ucf_spotlight' !== $post_type ) return;

			if ( isset( $_POST['ucf_spotlight_layout'] ) ) {
				// Ensure field is valid.
				$layout = $_POST['ucf_spotlight_layout'];
				if ( $layout ) {
					update_post_meta( $post_id, 'ucf_spotlight_layout', $layout );
				}
			}

			if ( isset( $_POST['ucf_spotlight_header'] ) ) {
				// Ensure field is valid.
				$header = sanitize_text_field( $_POST['ucf_spotlight_header'] );
				if ( $header ) {
					update_post_meta( $post_id, 'ucf_spotlight_header', $header );
				}
			}

			if ( isset( $_POST['ucf_spotlight_copy'] ) ) {
				// Ensure field is valid.
				$copy = $_POST['ucf_spotlight_copy'];
				if ( $copy ) {
					update_post_meta( $post_id, 'ucf_spotlight_copy', $copy );
				}
			}

			if ( isset( $_POST['ucf_spotlight_link_text'] ) ) {
				// Ensure field is valid.
				$link_text = sanitize_text_field( $_POST['ucf_spotlight_link_text'] );
				if ( $link_text ) {
					update_post_meta( $post_id, 'ucf_spotlight_link_text', $link_text );
				}
			}

			if ( isset( $_POST['ucf_spotlight_link_url'] ) ) {
				// Ensure field is valid.
				$link_url = sanitize_text_field( $_POST['ucf_spotlight_link_url'] );
				if ( $link_url ) {
					update_post_meta( $post_id, 'ucf_spotlight_link_url', $link_url );
				}
			}
		}

		/**
		 * Returns an array of labels for the custom post type.
		 * @author RJ Bruneel
		 * @since 1.0.0
		 * @param $singular string | The singular form for the CPT labels.
		 * @param $plural string | The plural form for the CPT labels.
		 * @param $text_domain string | The text domain.
		 * @return Array
		 **/
		public static function labels( $singular, $plural, $text_domain ) {
			return array(
				'name'                  => _x( $plural, 'Post Type General Name', $text_domain ),
				'singular_name'         => _x( $singular, 'Post Type Singular Name', $text_domain ),
				'menu_name'             => __( $plural, $text_domain ),
				'name_admin_bar'        => __( $singular, $text_domain ),
				'archives'              => __( $plural . ' Archives', $text_domain ),
				'parent_item_colon'     => __( 'Parent ' . $singular . ':', $text_domain ),
				'all_items'             => __( 'All ' . $plural, $text_domain ),
				'add_new_item'          => __( 'Add New ' . $singular, $text_domain ),
				'add_new'               => __( 'Add New', $text_domain ),
				'new_item'              => __( 'New ' . $singular, $text_domain ),
				'edit_item'             => __( 'Edit ' . $singular, $text_domain ),
				'update_item'           => __( 'Update ' . $singular, $text_domain ),
				'view_item'             => __( 'View ' . $singular, $text_domain ),
				'search_items'          => __( 'Search ' . $plural, $text_domain ),
				'not_found'             => __( 'Not found', $text_domain ),
				'not_found_in_trash'    => __( 'Not found in Trash', $text_domain ),
				'featured_image'        => __( 'Featured Image', $text_domain ),
				'set_featured_image'    => __( 'Set featured image', $text_domain ),
				'remove_featured_image' => __( 'Remove featured image', $text_domain ),
				'use_featured_image'    => __( 'Use as featured image', $text_domain ),
				'insert_into_item'      => __( 'Insert into ' . $singular, $text_domain ),
				'uploaded_to_this_item' => __( 'Uploaded to this ' . $singular, $text_domain ),
				'items_list'            => __( $plural . ' list', $text_domain ),
				'items_list_navigation' => __( $plural . ' list navigation', $text_domain ),
				'filter_items_list'     => __( 'Filter ' . $plural . ' list', $text_domain ),
			);
		}

		/**
		 * Returns the array of args for registering the ucf_spotlight custom post type
		 * @author RJ Bruneel
		 * @since 1.0.0
		 * @param $labels array | An array of labels
		 * @return Array
		 **/
		public static function args( $labels ) {
			$singular = $labels['singular'];
			$plural = $labels['plural'];
			$text_domain = $labels['text_domain'];

			$args = array(
				'label'                 => __( 'Spotlight', 'ucf_spotlight' ),
				'description'           => __( 'Spotlights', 'ucf_spotlight' ),
				'labels'                => self::labels( $singular, $plural, $text_domain ),
				'supports'              => array( 'title', 'thumbnail', 'revisions', ),
				'taxonomies'            => self::taxonomies(),
				'hierarchical'          => false,
				'public'                => true,
				'show_ui'               => true,
				'show_in_menu'          => true,
				'menu_position'         => 5,
				'menu_icon'             => 'dashicons-lightbulb',
				'show_in_admin_bar'     => true,
				'show_in_nav_menus'     => true,
				'can_export'            => true,
				'has_archive'           => true,
				'exclude_from_search'   => false,
				'publicly_queryable'    => true,
				'capability_type'       => 'post',
			);
			$args = apply_filters( 'ucf_spotlight_post_type_args', $args );
			return $args;
		}

		/**
		 * Returns an array of taxonomies to register for the post type
		 * @author RJ Bruneel
		 * @since 1.0.0
		 * @return array
		 **/
		public static function taxonomies() {
			$retval = array();
			$retval = apply_filters( 'ucf_spotlight_taxonomies', $retval );

			foreach( $retval as $taxonomy ) {
				if ( ! taxonomy_exists( $taxonomy ) ) {
					unset( $retval[$taxonomy] );
				}
			}
			return $retval;
		}
	}

	/** Register the custom post type */
    add_action( 'init', array( 'UCF_Spotlight_PostType', 'register' ), 10, 0 );
}
?>
