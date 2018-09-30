<?php
/**
 * Plugin Name: Odin Toolkit
 * Plugin URI: https://github.com/wpbrasil/odin-toolkit
 * Description: Use to add functionalities to be used in plugin or theme, or override the files to make your awesome new plugin.
 * Version: 0.0.1
 * Author: WPBrasil
 * Author URI: https://github.com/wpbrasil/
 * License: GPLv2
 * Text Domain: odin-toolkit
 * Domain Path: languages/
 */

 // Prevents direct access
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
		   add_action( 'init', array( $this, 'includes' ), 0 );
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
		* A final check if Odin Toolkit exists before kicking off our Odin Toolkit loading.
		* Odin_Toolkit_VERSION is defined at this point.
		*
		* @since  1.0.0
		*/
	   public function includes() {
		   if ( ! defined( 'Odin_Toolkit_VERSION' ) ) {
			   define( 'Odin_Toolkit_VERSION', self::VERSION );
		   }
		   // Now kick off the class autoloader.
		   spl_autoload_register( array( $this, 'autoload_classes' ) );

		   // Load the functions.php
		   require_once $this->plugin_dir . '/functions.php';
	   }

	   /**
		* Autoloads files with Odin classes when needed
		*
		* @since  1.0.0
		* @param  string $class_name Name of the class being requested
		*/
	   public function autoload_classes( $class_name ) {				
			$file = $this->get_file_name_from_class( $class_name );
			$path = 'includes/classes';
			
			if ( 'Odin_Front_End_Form' === $class_name ) {
				$path .= '/abstracts';
			}

			if ( file_exists( $this->plugin_dir . "$path/$file" ) ) {
				include $this->plugin_dir . "$path/$file";
			}
	   }

	   /**
		* Return file name in Odin pattern from class name. {Odin_Class_Name}
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
