<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://vishwas.me/
 * @since      1.0.0
 *
 * @package    PreloadX_Custom_Preloader
 * @subpackage Preloadx_Cp_5199/public/partials
 */
    
    if ( !defined( 'ABSPATH' ) ) exit;

    require_once(plugin_dir_path( dirname( __FILE__, 2) ) . 'includes/class-preloadx-custom-preloader-utilities.php');

    function preloadx_cp_attach_preloader_to_body() {
        if ( class_exists( 'Preloadx_Cp_5199_Utilities' ) ) {
            $selected_preloader = get_option( 'preloadx_selected', 'none' );
            
            if ( $selected_preloader === 'none' ) {
                return;
            }

            $hide_mobile = get_option( 'preloadx_hide_mobile', '0' );
            if ( $hide_mobile === '1' && wp_is_mobile() ) {
                return;
            }

            $homepage_only = get_option( 'preloadx_homepage_only', '0' );
            if ( $homepage_only === '1' && !is_front_page() && !is_home() ) {
                return;
            }

            $preloader_utilities = new Preloadx_Cp_5199_Utilities();  
            $preloader_html = $preloader_utilities->preloadx_get_preloader_html($selected_preloader);
            
            // Allow img tags for the custom image preloader
            $allowed_tags = array(
                'div'   => array('class' => array(), 'id' => array(), 'style' => array(), 'data-text' => array()),
                'span'  => array('class' => array(), 'style' => array()),
                'img'   => array('src' => array(), 'alt' => array(), 'class' => array(), 'style' => array()),
                'a'     => array('href' => array(), 'title' => array(), 'target' => array(), 'style' => array()),
                'svg'   => array('class' => array(), 'viewBox' => array(), 'preserveAspectRatio' => array(), 'xmlns' => array(), 'style' => array()),
                'g'     => array('transform' => array(), 'style' => array()),
                'path'  => array(
                    'id' => array(),
                    'class' => array(),
                    'stroke-dasharray' => array(),
                    'stroke-dashoffset' => array(),
                    'd' => array(),
                    'style' => array(),
                    'stroke-width' => array(),
                    'stroke-linecap' => array(),
                    'stroke-linejoin' => array(),
                    'pathLength' => array(),
                    'fill' => array(),
                    'stroke' => array(),
                    'opacity' => array()
                )
            );
            
            echo wp_kses($preloader_html, $allowed_tags);
            
            // Include close button markup if enabled
            $close_button = get_option( 'preloadx_close_button', '0' );
            if ( $close_button === '1' ) {
                echo '<button id="preloadx-close-btn" style="display:none; position:fixed; top:20px; right:20px; z-index:999999; padding:10px 15px; background:rgba(0,0,0,0.5); color:#fff; border:none; border-radius:5px; cursor:pointer;">Close</button>';
            }
        }
    }
    add_action( 'wp_body_open', 'preloadx_cp_attach_preloader_to_body' );
?>