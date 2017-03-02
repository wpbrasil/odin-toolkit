<?php
// Prevents direct access
if ( ! defined( 'ABSPATH' ) ) {
   exit;
}

if( ! class_exists( 'Odin_Toolkit_Settings' ) ) {

	class Odin_Toolkit_Settings {

		/**
		 * Initialize settings
		 */
		public static function init() {
			add_action( 'admin_menu', 'odin_toolkit_add_admin_menu' );
			add_action( 'admin_init', 'odin_toolkit_settings_init' );
		}

		/**
		 * Add Odin Toolkit menu
		 */
		public static function odin_toolkit_add_admin_menu(  ) {
			add_submenu_page( 'tools.php', 'Odin Toolkit', 'Odin Toolkit', 'manage_options', 'odin_toolkit', 'odin_toolkit_options_page' );
		}

		/**
		 * [odin_toolkit_settings_init description]
		 * @return [type] [description]
		 */
		public static function odin_toolkit_settings_init(  ) {

			register_setting( 'pluginPage', 'odin_toolkit_settings' );

			add_settings_section(
				'odin_toolkit_pluginPage_section',
				__( 'Your section description', 'odin-toolkit' ),
				'odin_toolkit_settings_section_callback',
				'pluginPage'
			);

			add_settings_field(
				'odin_toolkit_checkbox_field_0',
				__( 'Settings field description', 'odin-toolkit' ),
				'odin_toolkit_checkbox_field_0_render',
				'pluginPage',
				'odin_toolkit_pluginPage_section'
			);

			add_settings_field(
				'odin_toolkit_checkbox_field_1',
				__( 'Settings field description', 'odin-toolkit' ),
				'odin_toolkit_checkbox_field_1_render',
				'pluginPage',
				'odin_toolkit_pluginPage_section'
			);


		}


		public static function odin_toolkit_checkbox_field_0_render(  ) {

			$options = get_option( 'odin_toolkit_settings' );
			?>
			<input type='checkbox' name='odin_toolkit_settings[odin_toolkit_checkbox_field_0]' <?php checked( $options['odin_toolkit_checkbox_field_0'], 1 ); ?> value='1'>
			<?php

		}


		public static function odin_toolkit_checkbox_field_1_render(  ) {

			$options = get_option( 'odin_toolkit_settings' );
			?>
			<input type='checkbox' name='odin_toolkit_settings[odin_toolkit_checkbox_field_1]' <?php checked( $options['odin_toolkit_checkbox_field_1'], 1 ); ?> value='1'>
			<?php

		}


		public static function odin_toolkit_settings_section_callback(  ) {
			echo __( 'This section description', 'odin-toolkit' );
		}


		public static function odin_toolkit_options_page(  ) {

			?>
			<form action='options.php' method='post'>

				<h2>Odin Toolkit</h2>

				<?php
				settings_fields( 'pluginPage' );
				do_settings_sections( 'pluginPage' );
				submit_button();
				?>

			</form>
			<?php

		}
	}
}
?>
