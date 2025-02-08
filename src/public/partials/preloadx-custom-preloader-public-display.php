<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://vishwas.me/
 * @since      1.0.0
 *
 * @package    Preloadx_Custom_Preloader
 * @subpackage Preloadx_Custom_Preloader/public/partials
 */
    include(plugin_dir_path( dirname( __FILE__, 2) ) . 'includes/class-preloadx-custom-preloader-utilities.php');

    function add_preloader_to_body() {
        if ( class_exists( 'Preloadx_Custom_Preloader_Utilities' ) ) {
            $selected_preloader = get_option( 'preloadx_selected', 'none' );
            $preloader_utilities = new Preloadx_Custom_Preloader_Utilities();  
            $preloader_html = $preloader_utilities->preloadx_get_preloader_html($selected_preloader);
            echo $preloader_html;
            add_action('wp_head', $preloader_utilities->add_inline_root_styles());
        }
    }
    add_action( 'wp_body_open', 'add_preloader_to_body' );
?>