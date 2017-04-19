<?php
/**
 * Handles plugin configuration
 */
if ( ! class_exists( 'UCF_Spotlight_Config' ) ) {
	class UCF_Spotlight_Config {
		public static function add_options_page() {
			add_options_page(
				'UCF Spotlight',
				'UCF Spotlight',
				'manage_options',
				'ucf_spotlight_settings',
				array(
					'UCF_Spotlight_Config',
					'add_settings_page'
				)
			);
			add_action( 'admin_init', array( 'UCF_Spotlight_Config', 'register_settings' ) );
		}
		public static function register_settings() {
			register_setting( 'ucf-spotlight-group', 'ucf_spotlight_include_css' );
		}
		public static function add_settings_page() {
			$ucf_spotlight_include_css = get_option( 'ucf_spotlight_include_css', 'on' );
	?>
			<div class="wrap">
			<h1>UCF Spotlight Settings</h1>
			<form method="post" action="options.php">
				<?php settings_fields( 'ucf-spotlight-group' ); ?>
				<?php do_settings_sections( 'ucf-spotlight-groups' ); ?>
				<table class="form-table">
					<tr>
						<th scope="row">Include CSS</th>
						<td><input type="checkbox" name="ucf_spotlight_include_css" <?php echo ( $ucf_spotlight_include_css === 'on' ) ? 'checked' : ''; ?>>
							Include Default CSS (Leave unchecked if the Athena Framework is included in the theme.)
						</input></td>
					</tr>
				<?php submit_button(); ?>
			</form>
	<?php
		}
	}
}
?>