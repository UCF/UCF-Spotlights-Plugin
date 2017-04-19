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
					'singular'  => 'Spotlight',
					'plural'    => 'Spotlight',
					'post_type' => 'ucf_spotlight'
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
								<option value="horizontal"<?php echo ( $layout == 'horizontal' ) ? ' selected' : ''; ?>>Horizontal - Feature Image Size: 1100x400</option>
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
		 * @param $post_type string | The post type name.
		 * @return Array
		 **/
		public static function labels( $singular, $plural, $post_type ) {
			return array(
				'name'                  => _x( $plural, 'Post Type General Name', $post_type ),
				'singular_name'         => _x( $singular, 'Post Type Singular Name', $post_type ),
				'menu_name'             => __( $plural, $post_type ),
				'name_admin_bar'        => __( $singular, $post_type ),
				'archives'              => __( $plural . ' Archives', $post_type ),
				'parent_item_colon'     => __( 'Parent ' . $singular . ':', $post_type ),
				'all_items'             => __( 'All ' . $plural, $post_type ),
				'add_new_item'          => __( 'Add New ' . $singular, $post_type ),
				'add_new'               => __( 'Add New', $post_type ),
				'new_item'              => __( 'New ' . $singular, $post_type ),
				'edit_item'             => __( 'Edit ' . $singular, $post_type ),
				'update_item'           => __( 'Update ' . $singular, $post_type ),
				'view_item'             => __( 'View ' . $singular, $post_type ),
				'search_items'          => __( 'Search ' . $plural, $post_type ),
				'not_found'             => __( 'Not found', $post_type ),
				'not_found_in_trash'    => __( 'Not found in Trash', $post_type ),
				'featured_image'        => __( 'Featured Image', $post_type ),
				'set_featured_image'    => __( 'Set featured image', $post_type ),
				'remove_featured_image' => __( 'Remove featured image', $post_type ),
				'use_featured_image'    => __( 'Use as featured image', $post_type ),
				'insert_into_item'      => __( 'Insert into ' . $singular, $post_type ),
				'uploaded_to_this_item' => __( 'Uploaded to this ' . $singular, $post_type ),
				'items_list'            => __( $plural . ' list', $post_type ),
				'items_list_navigation' => __( $plural . ' list navigation', $post_type ),
				'filter_items_list'     => __( 'Filter ' . $plural . ' list', $post_type ),
			);
		}

		public static function args() {
			$args = array(
				'label'                 => __( 'Spotlight', 'ucf_spotlight' ),
				'description'           => __( 'Spotlights', 'ucf_spotlight' ),
				'labels'                => self::labels( $singular, $plural, $post_type ),
				'supports'              => array( 'title', 'thumbnail', 'revisions', ),
				'taxonomies'            => self::taxonomies(),
				'hierarchical'          => false,
				'public'                => true,
				'show_ui'               => true,
				'show_in_menu'          => true,
				'menu_position'         => 5,
				'menu_icon'             => 'dashicons-tag',
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
    add_action( 'init', array( 'UCF_Spotlight_PostType', 'register' ), 10, 0 );
}
?>