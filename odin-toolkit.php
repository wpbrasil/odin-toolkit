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
		 * Current version number
		 *
		 * @var   string
		 * @since 1.0.0
		 */
		const VERSION = '1.0.0';

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
			add_action( 'init', array( $this, 'include_odin_toolkit' ), 0 );
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
		 * Return file name in odin pattern from class name.
		 *
		 * @param  	string $class
		 * @return 	string
		 * @since 	1.0.0
		 */
		private function get_file_name_from_class( $class ) {
			$class = str_replace( 'Odin_', '', $class );
			$class = str_replace( '_', '-', $class );
			$class = strtolower( $class );
			return 'class-' . $class . '.php';
		}

		/**
		 * A final check if Odin Toolkit exists before kicking off our Odin Toolkit loading.
		 * ODIN_TOOLKIT_VERSION is defined at this point.
		 *
		 * @since  1.0.0
		 */
		public function include_odin_toolkit() {
			if ( ! defined( 'ODIN_TOOLKIT_VERSION' ) ) {
				define( 'ODIN_TOOLKIT_VERSION', self::VERSION );
			}

			if ( ! defined( 'ODIN_TOOLKIT_DIR' ) ) {
				define( 'ODIN_TOOLKIT_DIR', untrailingslashit( plugin_dir_path( __FILE__ ) ) );
			}

			// Now kick off the class autoloader.
			spl_autoload_register( array( $this, 'odin_toolkit_autoload_classes' ) );
		}

		/**
		 * Autoloads files with Odin classes when needed
		 *
		 * @since  1.0.0
		 * @param  string $class_name Name of the class being requested
		 */
		public function odin_toolkit_autoload_classes( $class_name ) {
			if ( 0 !== strpos( $class_name, 'Odin' ) ) {
				return;
			}

			$file = $this->get_file_name_from_class( $class_name );
			$path = 'includes/classes';

			if ( 'Odin_Front_End_Form' === $class_name ) {
				$path .= '/abstracts';
			}

			include_once( ODIN_TOOLKIT_DIR . "/$path/$file" );
		}

		/**
		 * Load plugin translation
		 */
		public function load_textdomain() {
			load_plugin_textdomain( 'odin-toolkit', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
		}
	}
 }

 /**
 * Initialize the plugin actions.
 */
add_action( 'plugins_loaded', array( 'Odin_Toolkit', 'init' ) );
