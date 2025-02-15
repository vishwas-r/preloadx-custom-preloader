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

    include(plugin_dir_path( dirname( __FILE__, 2) ) . 'includes/class-preloadx-custom-preloader-utilities.php');

    function attach_preloader_to_body() {
        if ( class_exists( 'Preloadx_Cp_5199_Utilities' ) ) {
            $selected_preloader = get_option( 'preloadx_selected', 'none' );
            $preloader_utilities = new Preloadx_Cp_5199_Utilities();  
            $preloader_html = $preloader_utilities->preloadx_get_preloader_html($selected_preloader);
            $allowed_tags = array(
                'div'   => array('class' => array(), 'id' => array(), 'style' => array()),
                'span'  => array('class' => array(), 'style' => array()),
                'a'     => array('href' => array(), 'title' => array(), 'target' => array(), 'style' => array()),
                'svg'   => array('class' => array(), 'viewBox' => array(), 'preserveAspectRatio' => array(), 'xmlns' => array(), 'style' => array()),
                'g'     => array('transform' => array(), 'style' => array()),
                'path'  => array(
                    'id' => array(),
                    'stroke-dasharray' => array(),
                    'stroke-dashoffset' => array(),
                    'd' => array(),
                    'style' => array(),
                    'stroke-width' => array(),
                    'stroke-linecap' => array(),
                    'stroke-linejoin' => array()
                )
            );
            
            echo wp_kses($preloader_html, $allowed_tags);            
            add_action('wp_head', $preloader_utilities->add_inline_root_styles());
        }
    }
    add_action( 'wp_body_open', 'attach_preloader_to_body' );
?>