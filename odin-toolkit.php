<?php
/**
 * Plugin Name: Odin Toolkit
 * Plugin URI: https://github.com/wpbrasil
 * Description: Plugin com funcionalidades para desenvolvimento de projetos e novos plugins WordPress
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
			require_once $this->plugin_dir . '/inc/classes/abstracts/abstract-front-end-form.php';
			require_once $this->plugin_dir . '/inc/classes/class-theme-options.php';
			require_once $this->plugin_dir . '/inc/classes/class-options-helper.php';
			require_once $this->plugin_dir . '/inc/classes/class-post-type.php';
			require_once $this->plugin_dir . '/inc/classes/class-taxonomy.php';
			require_once $this->plugin_dir . '/inc/classes/class-metabox.php';
			require_once $this->plugin_dir . '/inc/classes/class-contact-form.php';
			require_once $this->plugin_dir . '/inc/classes/class-post-form.php';
			require_once $this->plugin_dir . '/inc/classes/class-user-meta.php';
			require_once $this->plugin_dir . '/inc/classes/class-post-status.php';
			require_once $this->plugin_dir . '/inc/classes/class-term-meta.php';
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
