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
			//Init
			$odin_theme_options = new Odin_Theme_Options(
			    'odin-toolkit',
			    __( 'Odin Toolkit', 'odin-toolkit' ),
			    'manage_options'
			);

			//Tabs
			$odin_theme_options->set_tabs(
			    array(
			        array(
			            'id' => 'odin_toolkit_modules', // ID da aba e nome da entrada no banco de dados.
			            'title' => __( 'Modules', 'odin-toolkit' ), // Título da aba.
			        ),
			    )
			);

			//Fields
			$odin_theme_options->set_fields(
			    array(
			        'modules_section' => array(
			            'tab'   => 'odin_toolkit_modules',
			            'title' => __( 'Activate Modules', 'odin' ),
			            'fields' => array(
							array(
							    'id'    => 'description', // Obrigatório
							    'label' => __( 'Instructions', 'odin' ), // Obrigatório
							    'type'  => 'HTML', // Obrigatório
							    'description' => '<p>' . __( 'Mark which module of Odin Toolkit you will activate for your website, according to your needs. You can check in your plugin/theme if a module is active by using: <code>Odin_Toolkit::module_active( \'contact_form_module\' )</code>. For further explanation, see the plugin documentation.', 'odin-toolkit' ) . '</p>' // Opcional
							),
							array(
								 'id'          => 'contact_form_module',
								 'label'       => __( 'Contact Form', 'odin-toolkit' ),
								 'type'        => 'checkbox',
								 'description' => __( 'Helper to create custom contact forms.', 'odin-toolkit' ),
							 ),
							array(
							     'id'          => 'metabox_module',
							     'label'       => __( 'Metabox', 'odin-toolkit' ),
							     'type'        => 'checkbox',
							     'description' => __( 'Helper to create meta boxes for page, posts and custom post types.', 'odin-toolkit' ),
							 ),
							 array(
								  'id'          => 'post_form_module',
								  'label'       => __( 'Post Form', 'odin-toolkit' ),
								  'type'        => 'checkbox',
								  'description' => __( 'Helper to build front-end post forms.', 'odin-toolkit' ),
							 ),
							 array(
								  'id'          => 'post_status_module',
								  'label'       => __( 'Post Status', 'ododin-toolkitin' ),
								  'type'        => 'checkbox',
								  'description' => __( 'Helper to build custom post status.', 'odin-toolkit' ),
							 ),
							 array(
								  'id'          => 'post_type_module',
								  'label'       => __( 'Custom Post Types', 'odin-toolkit' ),
								  'type'        => 'checkbox',
								  'description' => __( 'Helper to build custom post types.', 'odin-toolkit' ),
							 ),
							 array(
								  'id'          => 'shortcodes_module',
								  'label'       => __( 'Shortcodes ', 'odin-toolkit' ),
								  'type'        => 'checkbox',
								  'description' => __( 'Insert shortcodes menu on editor text.', 'odin-toolkit' ),
							 ),
							 array(
								  'id'          => 'taxonomy_module',
								  'label'       => __( 'Taxonomy', 'odin-toolkit' ),
								  'type'        => 'checkbox',
								  'description' => __( 'Helper to build custom taxonomies.', 'odin-toolkit' ),
							 ),
							 array(
								  'id'          => 'term_meta_module',
								  'label'       => __( 'Term Meta', 'odin-toolkit' ),
								  'type'        => 'checkbox',
								  'description' => __( 'Helper to build term meta fields.', 'odin-toolkit' ),
							 ),
							 array(
								  'id'          => 'user_meta_module',
								  'label'       => __( 'User Meta', 'odin-toolkit' ),
								  'type'        => 'checkbox',
								  'description' => __( 'Helper to build user meta fields.', 'odin-toolkit' ),
							 )
			            )
			        ),
			    )
			);
		}
	}
}
?>
