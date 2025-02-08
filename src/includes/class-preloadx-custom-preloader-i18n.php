<?php
/**
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Preloadx_Custom_Preloader
 * @subpackage Preloadx_Custom_Preloader/includes
 * @author     Vishwas R
 */
class Preloadx_Custom_Preloader_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'preloadx-custom-preloader',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
