<?php

/**
 * Common Utilities for the plugin.
 *
 * Maintain a list of all common utilities that are used throughout
 * the plugin
 *
 * @package    Preloadx_Custom_Preloader
 * @subpackage Preloadx_Custom_Preloader/includes
 * @author     Vishwas R
 */
class Preloadx_Cp_5199_Utilities {
    
    public function add_inline_root_styles() {
        $color = get_option( 'preloadx_color', '#3498db' );
        $bgcolor = get_option( 'preloadx_bgcolor', '#000' );
        $bggradient = get_option( 'preloadx_bggradient', '' );
        $bgimage = get_option( 'preloadx_bgimage', '' );
        $bgtype = get_option( 'preloadx_bgtype', 'color' );
        $size_unit = get_option( 'preloadx_loader_size_unit', '%' );
        $default_size = ( $size_unit === '%' ) ? '100' : '60';
        $loader_size = get_option( 'preloadx_loader_size', $default_size );
        $loader_radius = get_option( 'preloadx_loader_radius', '12' );
        $font_size = get_option( 'preloadx_font_size', '18' );

        $background_style = '';

        if ( $bgtype === 'color' ) {
            $background_style = "background-color: " . esc_attr( $bgcolor ) . ";";
        } elseif ( $bgtype === 'gradient' ) {
            $background_style = "background: " . esc_attr( $bggradient ) . ";";
        } elseif ( $bgtype === 'image' ) {
            $background_style = "background-color: " . esc_attr( $bgcolor ) . "; background-image: url('" . esc_url( $bgimage ) . "'); background-size: cover; background-repeat: no-repeat;";
        }

        $size_val = absint( $loader_size );
        if ( $size_unit === '%' ) {
            $public_size = "clamp(24px, calc(15vmin * (" . $size_val . " / 100)), 400px)";
            $preview_size = "clamp(20px, calc(60px * (" . $size_val . " / 100)), 120px)";
        } else {
            $public_size = $size_val . "px";
            $preview_size = "clamp(20px, " . $size_val . "px, 120px)";
        }

        $inline_css = "
                :root {
                    --preloader-color: " . esc_attr( $color ) . ";
                    --preloader-size: " . $public_size . ";
                    --preloader-radius: " . absint( $loader_radius ) . "px;
                    --preloader-font-size: " . absint( $font_size ) . "px;
                }
                .pxpreloader-preview {
                    --preloader-size: " . $preview_size . ";
                }
                .pxpreloader-preview, .pxpreloader {" .
                    esc_attr( $background_style )
                . "}
        ";
        $version = defined('PRELOADX_CUSTOM_PRELOADER_VERSION') ? PRELOADX_CUSTOM_PRELOADER_VERSION : '1.2.0';
        wp_enqueue_style( 'preloadx-custom-preloader-style', plugin_dir_url( dirname( __FILE__, 2 ) . '/preloadx-custom-preloader.php' ) . 'assets/css/preloadx-style.css', array(), $version, 'all' );
        wp_add_inline_style( 'preloadx-custom-preloader-style', $inline_css );
    }

    public function preloadx_get_preloader_html( $selected ) {
        $is_admin = is_admin();
        $container_class = $is_admin ? 'pxpreloader-preview' : 'pxpreloader';
        
        $inner_html = '';
        $text_reveal = get_option( 'preloadx_text_reveal_text', 'LOADING' );
        $custom_image = get_option('preloadx_custom_image', '');

        switch($selected) {
            case 'none':
                $inner_html = '<div id="no-loader"></div>';
                break;
            case 'classic-spinner':
                $inner_html = '<div id="classic-spinner-loader"><div class="px-classic-spinner"></div></div>';
                break;
            case 'pulse-ring':
                $inner_html = '<div id="pulse-ring-loader"><div class="px-pulse-ring"></div></div>';
                break;
            case 'double-bounce':
                $inner_html = '<div id="double-bounce-loader"><div class="px-double-bounce1"></div><div class="px-double-bounce2"></div></div>';
                break;
            case 'wave-dots':
                $inner_html = '<div id="wave-dots-loader"><div class="px-wave-dot"></div><div class="px-wave-dot"></div><div class="px-wave-dot"></div></div>';
                break;
            case 'spinning-square':
                $inner_html = '<div id="spinning-square-loader"><div class="px-spinning-square"></div></div>';
                break;
            case 'rotating-chase':
                $inner_html = '<div id="rotating-chase-loader">
                                    <div class="px-chase-dot"></div>
                                    <div class="px-chase-dot"></div>
                                    <div class="px-chase-dot"></div>
                                    <div class="px-chase-dot"></div>
                                    <div class="px-chase-dot"></div>
                                    <div class="px-chase-dot"></div>
                               </div>';
                break;
            case 'progress-bar':
                $inner_html = '<div id="progress-bar-loader">
                                    <div class="px-progress-track">
                                        <div class="px-progress-fill" id="px-progress-bar"></div>
                                    </div>
                                    <div class="px-progress-text" id="px-progress-text">0%</div>
                                </div>';
                break;
            case 'equalizer-wave':
                $inner_html = '<div id="equalizer-wave-loader">
                                    <div class="px-equalizer">
                                        <span class="px-eq-bar"></span>
                                        <span class="px-eq-bar"></span>
                                        <span class="px-eq-bar"></span>
                                        <span class="px-eq-bar"></span>
                                        <span class="px-eq-bar"></span>
                                    </div>
                               </div>';
                break;
            case 'morphing-blob':
                $inner_html = '<div id="morphing-blob-loader">
                                    <div class="px-blob"></div>
                                </div>';
                break;
            case 'infinity-loop':
                $inner_html = '<div id="infinity-loop-loader">
                                    <svg class="px-infinity-svg" viewBox="0 0 100 50">
                                        <path class="px-inf-bg" d="M 50,25 C 65,10 90,10 90,25 C 90,40 65,40 50,25 C 35,10 10,10 10,25 C 10,40 35,40 50,25 Z" />
                                        <path class="px-inf-trail" d="M 50,25 C 65,10 90,10 90,25 C 90,40 65,40 50,25 C 35,10 10,10 10,25 C 10,40 35,40 50,25 Z" />
                                        <path class="px-inf-head" d="M 50,25 C 65,10 90,10 90,25 C 90,40 65,40 50,25 C 35,10 10,10 10,25 C 10,40 35,40 50,25 Z" />
                                    </svg>
                               </div>';
                break;
            case 'isometric-cube':
                $inner_html = '<div id="isometric-cube-loader">
                                    <div class="px-iso-cube">
                                        <div class="px-iso-side px-iso-top"></div>
                                        <div class="px-iso-side px-iso-left"></div>
                                        <div class="px-iso-side px-iso-right"></div>
                                    </div>
                               </div>';
                break;
            case 'orbital-ring':
                $inner_html = '<div id="orbital-ring-loader">
                                    <div class="px-orbit-wrap">
                                        <div class="px-orbit-nucleus"></div>
                                        <div class="px-orbit-track px-orbit-track-1"><div class="px-orbit-satellite"></div></div>
                                        <div class="px-orbit-track px-orbit-track-2"><div class="px-orbit-satellite"></div></div>
                                        <div class="px-orbit-track px-orbit-track-3"><div class="px-orbit-satellite"></div></div>
                                    </div>
                               </div>';
                break;
            case 'radar-scanner':
                $inner_html = '<div id="radar-scanner-loader">
                                    <div class="px-radar">
                                        <div class="px-radar-sweep"></div>
                                        <div class="px-radar-ring"></div>
                                        <div class="px-radar-center"></div>
                                    </div>
                               </div>';
                break;
            case 'text-reveal':
                $inner_html = '<div id="text-reveal-loader">
                                    <div class="px-text-reveal" data-text="' . esc_attr($text_reveal) . '">' . esc_html($text_reveal) . '</div>
                                </div>';
                break;
            case 'svg-outline':
                $inner_html = '<div id="svg-outline-loader">';
                if ($custom_image) {
                    $inner_html .= '<div class="px-svg-mask" style="-webkit-mask-image: url(' . esc_url($custom_image) . '); mask-image: url(' . esc_url($custom_image) . ');"></div>';
                } else {
                    $inner_html .= '<div class="px-svg-mask-placeholder">Upload an SVG/Image</div>';
                }
                $inner_html .= '</div>';
                break;
            case 'custom-image':
                $inner_html = '<div id="custom-image-loader">';
                if ($custom_image) {
                    $inner_html .= '<img src="' . esc_url($custom_image) . '" alt="Loading..." class="px-custom-img" />';
                } else {
                    $inner_html .= '<span>Custom Image</span>';
                }
                $inner_html .= '</div>';
                break;
        }
    
        return '<div class="' . esc_attr($container_class) . '">' . $inner_html . '</div>';
    }    
}