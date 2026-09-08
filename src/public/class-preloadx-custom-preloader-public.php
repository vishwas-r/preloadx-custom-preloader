<?php
/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    PreloadX_Custom_Preloader
 * @subpackage Preloadx_Cp_5199/public
 * @author     Vishwas R
 */
class Preloadx_Cp_5199_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
        require_once (plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-preloadx-custom-preloader-utilities.php');
		require_once (plugin_dir_path( __FILE__ ) . 'partials/'. $this->plugin_name . '-public-display.php');
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		if ( class_exists( 'Preloadx_Cp_5199_Utilities' ) ) {
            $utilities = new Preloadx_Cp_5199_Utilities();
            $utilities->add_inline_root_styles();
        }
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		wp_enqueue_script( $this->plugin_name . '-public', plugin_dir_url( __FILE__ ) . 'js/preloadx-custom-preloader-public.js', array(), $this->version, true );

		$preloadx_settings = array(
			'exit_animation' => get_option( 'preloadx_exit_animation', 'fade' ),
			'min_load_time'  => get_option( 'preloadx_min_load_time', '500' ),
			'close_button'   => get_option( 'preloadx_close_button', '0' ),
			'selected'       => get_option( 'preloadx_selected', 'none' )
		);

		wp_localize_script( $this->plugin_name . '-public', 'preloadxSettings', $preloadx_settings );
	}

}
