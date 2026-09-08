<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    PreloadX_Custom_Preloader
 * @subpackage Preloadx_Cp_5199/admin
 * @author     Vishwas R
 * @link       https://vishwas.me/
 * @since      1.0.0
 */
class Preloadx_Cp_5199_Admin {

	/**
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
	 * @since      1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		add_action( 'admin_init', array( $this, 'preloadx_settings_register' ) );
		add_action( 'admin_menu', array( $this, 'add_admin_menu' ) );
		add_action( 'wp_ajax_preloadx_set_options', array( $this, 'preloadx_set_options' ) );
	}

	public function preloadx_settings_register() {		
		$settings = array(
			'preloadx_selected' => 'sanitize_text_field',
			'preloadx_color' => 'sanitize_text_field',
			'preloadx_bgcolor' => 'sanitize_text_field',
			'preloadx_bggradient' => 'sanitize_text_field',
			'preloadx_bgimage' => 'sanitize_url',
			'preloadx_bgtype' => 'sanitize_text_field',
			// Dimensions & Customizations
			'preloadx_loader_size' => 'absint',
			'preloadx_loader_radius' => 'absint',
			'preloadx_font_size' => 'absint',
			'preloadx_custom_image' => 'sanitize_url',
			'preloadx_text_reveal_text' => 'sanitize_text_field',
			'preloadx_hide_mobile' => 'sanitize_text_field',
			'preloadx_homepage_only' => 'sanitize_text_field',
			'preloadx_exit_animation' => 'sanitize_text_field',
			'preloadx_min_load_time' => 'absint',
			'preloadx_close_button' => 'sanitize_text_field'
		);

		foreach ($settings as $setting_name => $sanitize_callback) {
			register_setting('preloadx_options_group', $setting_name, $sanitize_callback);
		}

		add_settings_section( 'preloadx_section', '', null, 'preloadx-custom-preloader' );
	}

	 /**
     * Register the menu page for the plugin.
     *
     * @since    1.0.0
     */
    public function add_admin_menu() {
        add_menu_page(
            'Preloadx Custom Preloader Settings',
            'Custom Preloader',
            'manage_options',
            'preloadx-custom-preloader',
            array( $this, 'display_plugin_page' ),
            'dashicons-admin-generic',
            5
        );
    }

	public function preloadx_set_options() {
		if( !isset( $_POST['preloadx_nonce_field'] ) || !wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['preloadx_nonce_field'] ) ), 'preloadx_nonce_action' ) ) {
			wp_send_json_error( 'Nonce verification failed.' );
			wp_die();
		}
	
		// Check if the user has the correct permissions
		if ( !current_user_can( 'manage_options' ) ) {
			wp_send_json_error( 'You do not have permission to access this.' );
		}
	
		$options = [];
		if ( isset( $_POST['preloadx_bgtype'] ) ) {
			$options['preloadx_bgtype'] = sanitize_text_field( wp_unslash( $_POST['preloadx_bgtype'] ) );
		}
		if ( isset( $_POST['preloadx_bgcolor'] ) ) {
			$options['preloadx_bgcolor'] = sanitize_hex_color( wp_unslash( $_POST['preloadx_bgcolor'] ) );
		}
		if ( isset( $_POST['preloadx_bggradient'] ) ) {
			$options['preloadx_bggradient'] = sanitize_text_field( wp_unslash( $_POST['preloadx_bggradient'] ) );
		}
		if ( isset( $_POST['preloadx_bgimage'] ) ) {
			$options['preloadx_bgimage'] = esc_url_raw( wp_unslash( $_POST['preloadx_bgimage'] ) );
		}
		if ( isset( $_POST['preloadx_color'] ) ) {
			$options['preloadx_color'] = sanitize_hex_color( wp_unslash( $_POST['preloadx_color'] ) );
		}
		if ( isset( $_POST['preloadx_selected'] ) ) {
			$allowed_preloaders = [
				'none',
				'classic-spinner',
				'pulse-ring',
				'double-bounce',
				'wave-dots',
				'spinning-square',
				'rotating-chase',
				'progress-bar',
				'equalizer-wave',
				'morphing-blob',
				'infinity-loop',
				'isometric-cube',
				'orbital-ring',
				'radar-scanner',
				'text-reveal',
				'svg-outline',
				'custom-image'
			];
			if ( in_array( wp_unslash( $_POST['preloadx_selected'] ), $allowed_preloaders, true ) ) {
				$options['preloadx_selected'] = sanitize_text_field( wp_unslash( $_POST['preloadx_selected'] ) );
			}
		}
		if ( isset( $_POST['preloadx_loader_size_unit'] ) ) {
			$unit = sanitize_text_field( wp_unslash( $_POST['preloadx_loader_size_unit'] ) );
			$options['preloadx_loader_size_unit'] = in_array( $unit, array( '%', 'px' ), true ) ? $unit : '%';
		}
		if ( isset( $_POST['preloadx_loader_size'] ) ) {
			$options['preloadx_loader_size'] = absint( wp_unslash( $_POST['preloadx_loader_size'] ) );
		}
		if ( isset( $_POST['preloadx_loader_radius'] ) ) {
			$options['preloadx_loader_radius'] = absint( wp_unslash( $_POST['preloadx_loader_radius'] ) );
		}
		if ( isset( $_POST['preloadx_font_size'] ) ) {
			$options['preloadx_font_size'] = absint( wp_unslash( $_POST['preloadx_font_size'] ) );
		}
		if ( isset( $_POST['preloadx_custom_image'] ) ) {
			$options['preloadx_custom_image'] = esc_url_raw( wp_unslash( $_POST['preloadx_custom_image'] ) );
		}
		if ( isset( $_POST['preloadx_text_reveal_text'] ) ) {
			$options['preloadx_text_reveal_text'] = sanitize_text_field( wp_unslash( $_POST['preloadx_text_reveal_text'] ) );
		}
		
		// Checkboxes are only set if checked, so we need to default to '0' if not set
		$options['preloadx_hide_mobile'] = isset( $_POST['preloadx_hide_mobile'] ) ? '1' : '0';
		$options['preloadx_homepage_only'] = isset( $_POST['preloadx_homepage_only'] ) ? '1' : '0';
		$options['preloadx_close_button'] = isset( $_POST['preloadx_close_button'] ) ? '1' : '0';
		
		if ( isset( $_POST['preloadx_exit_animation'] ) ) {
			$options['preloadx_exit_animation'] = sanitize_text_field( wp_unslash( $_POST['preloadx_exit_animation'] ) );
		}
		if ( isset( $_POST['preloadx_min_load_time'] ) ) {
			$options['preloadx_min_load_time'] = absint( wp_unslash( $_POST['preloadx_min_load_time'] ) );
		}
	
		foreach ($options as $key => $value) {
			update_option( $key, $value );
		}
	
		wp_send_json_success( 'Settings Saved Successfully!' );
	}
	

	 /**
     * Callback function to render the plugin settings page.
     *
     * @since    1.0.0
     */
    public function display_plugin_page() {
        include (plugin_dir_path( __FILE__ ) . 'partials/'. $this->plugin_name . '-admin-display.php');
    }

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
		$screen = get_current_screen();
		if($screen->id === "toplevel_page_preloadx-custom-preloader") {
			wp_enqueue_style( $this->plugin_name . '-admin-style', plugin_dir_url( __FILE__ ) . 'css/preloadx-admin-style.css', array(), $this->version, 'all' );
            if ( class_exists( 'Preloadx_Cp_5199_Utilities' ) ) {
                $utilities = new Preloadx_Cp_5199_Utilities();
                $utilities->add_inline_root_styles();
            }
		}
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		$screen = get_current_screen();
		if ( $screen && $screen->id === 'toplevel_page_preloadx-custom-preloader' ) {
			wp_enqueue_script( $this->plugin_name . '-script', plugin_dir_url( __FILE__ ) . 'js/preloadx-custom-preloader-admin.js', array( 'jquery' ), $this->version, true );

			wp_localize_script(
				$this->plugin_name . '-script',
				'preloadxAdmin',
				array(
					'ajax_url' => admin_url( 'admin-ajax.php' ),
				)
			);
		}
	}
}