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
		register_setting( 
			'preloadx_options_group', 
			'preloadx_selected', 
			array(
				'type' => 'string',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
	
		register_setting( 
			'preloadx_options_group', 
			'preloadx_color', 
			array(
				'type' => 'string',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
	
		register_setting( 
			'preloadx_options_group', 
			'preloadx_bgcolor', 
			array(
				'type' => 'string',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
	
		register_setting( 
			'preloadx_options_group', 
			'preloadx_bggradient', 
			array(
				'type' => 'string',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
	
		register_setting( 
			'preloadx_options_group', 
			'preloadx_bgimage', 
			array(
				'type' => 'string',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
	
		register_setting( 
			'preloadx_options_group', 
			'preloadx_bgtype', 
			array(
				'type' => 'string',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
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
			$options['preloadx_bgtype'] = sanitize_text_field( $_POST['preloadx_bgtype'] );
		}
		if ( isset( $_POST['preloadx_bgcolor'] ) ) {
			$options['preloadx_bgcolor'] = sanitize_hex_color( $_POST['preloadx_bgcolor'] );
		}
		if ( isset( $_POST['preloadx_bggradient'] ) ) {
			$options['preloadx_bggradient'] = sanitize_text_field( $_POST['preloadx_bggradient'] );
		}
		if ( isset( $_POST['preloadx_bgimage'] ) ) {
			$options['preloadx_bgimage'] = esc_url_raw( $_POST['preloadx_bgimage'] );
		}
		if ( isset( $_POST['preloadx_color'] ) ) {
			$options['preloadx_color'] = sanitize_hex_color( $_POST['preloadx_color'] );
		}
		if ( isset( $_POST['preloadx_selected'] ) ) {
			$allowed_preloaders = ['none', 'loading-text', 'spinner', 'square', 'rounded-progress', 'clock-loader', 'hourglass', 'ekg-waves', 'bouncing-bubbles', 'scaling-bubble-colors', 'wavy-colors'];
			if ( in_array( $_POST['preloadx_selected'], $allowed_preloaders, true ) ) {
				$options['preloadx_selected'] = sanitize_text_field( $_POST['preloadx_selected'] );
			}
		}
		
		if ( isset( $_POST['preloadx_selected'] ) ) {
			$options['preloadx_selected'] = sanitize_text_field( $_POST['preloadx_selected'] );
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
			wp_enqueue_style( $this->plugin_name . 'admin-style', plugin_dir_url( __FILE__ ) . 'css/preloadx-admin-style.css', array(), $this->version, 'all' );
			wp_enqueue_style( $this->plugin_name . '-style', plugin_dir_url( __DIR__ ) . 'assets/css/preloadx-style.css', array(), $this->version, 'all' );
		}
		
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		$screen = get_current_screen();
		if($screen->id === "toplevel_page_preloadx-custom-preloader") {
			wp_enqueue_script( $this->plugin_name . "-script", plugin_dir_url( __FILE__ ) . 'js/preloadx-custom-preloader-admin.js', array( 'jquery' ), $this->version, false );

			wp_add_inline_script( $this->plugin_name . "-script", '
				jQuery(document).ready(function($) {
					$("#preloadx-settings-form").on("submit", function(e) {
						e.preventDefault();
						var formData = new FormData(this);
        				formData.append("action", "preloadx_set_options");
						
						$.ajax({
							type: "POST",
							url: "' . esc_url(admin_url('admin-ajax.php')) . '",
							dataType: "json",
							data: Object.fromEntries(formData.entries()),
							success: function(response) {
								$("#preloadx-settings-response-message").hide();
								if (response.success) {
									$("#preloadx-settings-response-message").text(response.data).removeClass("error").addClass("success").show();
								} else {
									$("#preloadx-settings-response-message").text(response.data).removeClass("success").addClass("error").show();
								}
								setTimeout(function() {
									$("#preloadx-settings-response-message").fadeOut();
								}, 10000);
							},
							error: function() {
								$("#preloadx-settings-response-message").text("An error occurred, please try again.").removeClass("success").addClass("error").show();
								setTimeout(function() {
									$("#preloadx-settings-response-message").fadeOut();
								}, 10000);
							}
						});
					});
				});
			');

		}

	}
}