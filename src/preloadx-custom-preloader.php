<?php

/**
 * @link              https://vishwas.me/
 * @since             1.0.0
 * @package           PreloadX_Custom_Preloader
 *
 * @wordpress-plugin
 * Plugin Name:       PreloadX - Custom Preloader
 * Plugin URI:        https://github.com/vishwas-r/preloadx-custom-preloader
 * Description:       Customize your WordPress site's preloader with multiple CSS preloaders and flexible background options, including colors, gradients, or images, with adjustable foreground colors.
 * Version:           1.0.0
 * Author:            Vishwas R
 * Author URI:        https://vishwas.me/
 * License:           GPL-3.0
 * License URI:       https://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain:       preloadx-custom-preloader
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'PRELOADX_CUSTOM_PRELOADER_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-preloadx-custom-preloader-activator.php
 */
function preloadx_cp_activate() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-preloadx-custom-preloader-activator.php';
	Preloadx_Cp_5199_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-preloadx-custom-preloader-deactivator.php
 */
function depreloadx_cp_deactivate() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-preloadx-custom-preloader-deactivator.php';
	Preloadx_Cp_5199_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'preloadx_cp_activate' );
register_deactivation_hook( __FILE__, 'depreloadx_cp_deactivate' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-preloadx-custom-preloader.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function preloadx_cp_run() {

	$plugin = new Preloadx_Cp_5199();
	$plugin->run();

}
preloadx_cp_run();
