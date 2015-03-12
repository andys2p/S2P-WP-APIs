<?php
/**
 * @package Smart2Pay API
 * @version 1.0.0
 */
/*
Plugin Name: Smart2Pay API
Plugin URI: https://github.com/andys2p/S2P-WP-APIs
Description: We play with Smart2Pay API
Version: 1.0.0
Author: Andy
Author URI: https://github.com/andys2p/
License: GPLv2 or later
Text Domain: smart2pay_api
*/

/*
 * This plugin was built on top of WordPress-Plugin-Skeleton by Ian Dunn.
 * See https://github.com/iandunn/WordPress-Plugin-Skeleton for details.
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Access denied.' );
}

define( 'S2PA_NAME',                 'Smart2Pay API' );
define( 'S2PA_REQUIRED_PHP_VERSION', '5.3' );                          // because of get_called_class()
define( 'S2PA_REQUIRED_WP_VERSION',  '3.1' );                          // because of esc_textarea()
define( 'S2PA_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'S2PA_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

/**
 * Checks if the system requirements are met
 *
 * @return bool True if system requirements are met, false if not
 */
function s2pa_requirements_met() {
	global $wp_version;
	//require_once( ABSPATH . '/wp-admin/includes/plugin.php' );		// to get is_plugin_active() early

	if ( version_compare( PHP_VERSION, S2PA_REQUIRED_PHP_VERSION, '<' ) ) {
		return false;
	}

	if ( version_compare( $wp_version, S2PA_REQUIRED_WP_VERSION, '<' ) ) {
		return false;
	}

	/*
	if ( ! is_plugin_active( 'plugin-directory/plugin-file.php' ) ) {
		return false;
	}
	*/

	return true;
}

/**
 * Prints an error that the system requirements weren't met.
 */
function s2pa_requirements_error() {
	global $wp_version;

	require_once( dirname( __FILE__ ) . '/views/requirements-error.php' );
}

/*
 * Check requirements and load main class
 * The main program needs to be in a separate file that only gets loaded if the plugin requirements are met. Otherwise older PHP installations could crash when trying to parse it.
 */
if ( s2pa_requirements_met() ) {
	require_once( __DIR__ . '/classes/s2pa-module.php' );
	require_once( __DIR__ . '/classes/smart2pay-api-plugin.php' );
	require_once( __DIR__ . '/includes/admin-notice-helper/admin-notice-helper.php' );
	require_once( __DIR__ . '/classes/s2pa-custom-post-type.php' );
	require_once( __DIR__ . '/classes/s2pa-cpt-example.php' );
	require_once( __DIR__ . '/classes/s2pa-settings.php' );
	require_once( __DIR__ . '/classes/s2pa-cron.php' );
	require_once( __DIR__ . '/classes/s2pa-instance-class.php' );

	if ( class_exists( 'Smart2Pay_API_Plugin' ) )
	{
		$GLOBALS['s2pa'] = Smart2Pay_API_Plugin::get_instance();
		register_activation_hook(   __FILE__, array( $GLOBALS['s2pa'], 'activate' ) );
		register_deactivation_hook( __FILE__, array( $GLOBALS['s2pa'], 'deactivate' ) );
	}
} else {
	add_action( 'admin_notices', 's2pa_requirements_error' );
}
