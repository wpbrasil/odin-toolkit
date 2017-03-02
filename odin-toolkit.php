<?php
/**
 * Plugin Name: Odin Toolkit
 * Plugin URI: https://github.com/wpbrasil
 * Description: Make greate plugins with the help of Odin with this toolkit.
 * Version: 0.0.1
 * Author: WordPress Brasil
 * Author URI:
 * License: GPLv2
 * Text Domain: odin-toolkit
 * Domain Path: languages/
 */

 // Previne acesso direto
 if ( ! defined( 'ABSPATH' ) ) {
 	exit;
 }

if( ! class_exists( 'Odin_Toolkit' ) ) {

	class Odin_Toolkit {
		/**
		 * Instance of this class.
		 *
		 * @var object
		 */
		protected static $instance = null;

		/**
		 * Plugin directory path
		 *
		 * @var string
		 */
		private $plugin_dir = null;

		/**
		 * Initialize the plugin.
		 */
		function __construct() {
			$this->plugin_dir = plugin_dir_path( __FILE__ );
			add_action( 'init', array( $this, 'load_textdomain' ) );
			add_action( 'init', array( $this, 'require_classes' ), 0 );
		}

		/**
		 * Return the plugin instance.
		 */
		public static function init()
		{
			// If the single instance hasn't been set, set it now.
			if ( null == self::$instance ) {
				self::$instance = new self;
			}
			return self::$instance;
		}

		/**
		 * Require the plugin classes.
		 */
		public function require_classes() {
			//Theme Options
			require_once $this->plugin_dir . '/includes/classes/class-theme-options.php';
			require_once $this->plugin_dir . '/includes/classes/class-options-helper.php';

			//Odin Toolkit Settings
			require_once $this->plugin_dir . '/includes/admin/class-settings.php';
			Odin_Toolkit_Settings::init();

			// Contact Form Module
			if( Odin_Toolkit::module_active( 'contact_form_module' ) ) {
				require_once $this->plugin_dir . '/includes/classes/abstracts/abstract-front-end-form.php';
				require_once $this->plugin_dir . '/includes/classes/class-contact-form.php';
			}

			// Metabox Module
			if( Odin_Toolkit::module_active( 'metabox_module' ) ) {
				require_once $this->plugin_dir . '/includes/classes/class-metabox.php';
			}

			// Post Form Module
			if( Odin_Toolkit::module_active( 'post_form_module' ) ) {
				require_once $this->plugin_dir . '/includes/classes/abstracts/abstract-front-end-form.php';
				require_once $this->plugin_dir . '/includes/classes/class-post-form.php';
			}

			// Post Status Module
			if( Odin_Toolkit::module_active( 'post_status_module' ) ) {
				require_once $this->plugin_dir . '/includes/classes/class-post-status.php';
			}

			// Post Type Module
			if( Odin_Toolkit::module_active( 'post_type_module' ) ) {
				require_once $this->plugin_dir . '/includes/classes/class-post-type.php';
			}

			// Taxonomy Module
			if( Odin_Toolkit::module_active( 'taxonomy_module' ) ) {
				require_once $this->plugin_dir . '/includes/classes/class-taxonomy.php';
			}

			// Term Meta Module
			if( Odin_Toolkit::module_active( 'term_meta_module' ) ) {
				require_once $this->plugin_dir . '/includes/classes/class-term-meta.php';
			}

			// User Meta Module
			if( Odin_Toolkit::module_active( 'user_meta_module' ) ) {
				require_once $this->plugin_dir . '/includes/classes/class-term-meta.php';
			}
		}

		/**
		 * Load plugin translation
		 */
		public function load_textdomain() {
			load_plugin_textdomain( 'odin-toolkit', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
		}

		public static function module_active( $module ) {
			$options = get_option( 'odin_toolkit_modules' );

			if( ! empty( $options[ $module ] ) && $options[ $module ] == true ) {
				return true;
			} else {
				return false;
			}
		}
	}
 }

 /**
 * Initialize the plugin actions.
 */
add_action( 'plugins_loaded', array( 'Odin_Toolkit', 'init' ) );
