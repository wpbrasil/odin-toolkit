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

 // require_once get_template_directory() . '/inc/classes/abstracts/abstract-front-end-form.php';
 // require_once get_template_directory() . '/inc/classes/class-theme-options.php';
 // require_once get_template_directory() . '/inc/classes/class-options-helper.php';
 // require_once get_template_directory() . '/inc/classes/class-post-type.php';
 // require_once get_template_directory() . '/inc/classes/class-taxonomy.php';
 // require_once get_template_directory() . '/inc/classes/class-metabox.php';
 // require_once get_template_directory() . '/inc/classes/class-contact-form.php';
 // require_once get_template_directory() . '/inc/classes/class-post-form.php';
 // require_once get_template_directory() . '/inc/classes/class-user-meta.php';
 // require_once get_template_directory() . '/inc/classes/class-post-status.php';
 // require_once get_template_directory() . '/inc/classes/class-term-meta.php';

 /**
  * Carrega arquivos de traduções.
  *
  * @return void
  */
 function odin_toolkit_load_textdomain() {
 	load_plugin_textdomain( 'odin-toolkit', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
 }
 add_action( 'plugins_loaded', 'odin_toolkit_load_textdomain' );
