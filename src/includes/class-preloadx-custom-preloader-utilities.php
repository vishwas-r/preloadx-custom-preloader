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
class Preloadx_Custom_Preloader_Utilities {
    
    public function add_inline_root_styles() {
        $selected_preloader = get_option( 'preloadx_selected', 'none' );
        $color = get_option( 'preloadx_color', '#3498db' );
        $bgcolor = get_option( 'preloadx_bgcolor', '#000' );
        $bggradient = get_option( 'preloadx_bggradient', '' );
        $bgimage = get_option( 'preloadx_bgimage', '' );
        $bgtype = get_option( 'preloadx_bgtype', 'color' );

        $background_style = '';

        if ( $bgtype === 'color' ) {
            $background_style = "background-color: " . esc_attr( $bgcolor ) . ";";
        } elseif ( $bgtype === 'gradient' ) {
            $background_style = "background: " . esc_attr( $bggradient ) . ";";
        } elseif ( $bgtype === 'image' ) {
            $background_style = "background-color: " . esc_attr( $bgcolor ) . "; background-image: url('" . esc_url( $bgimage ) . "'); background-size: cover; background-repeat: no-repeat;";
        }

        $inline_css = "
            <style>
                :root {
                    --preloader-color:" . esc_attr( $color ) . "
                }
                .pxpreloader-preview, .pxpreloader {" .
                    esc_attr($background_style)
                . "}
            </style>
        ";

        echo $inline_css;
    }

    public function preloadx_get_preloader_html( $selected_preloader ) {
        $color = get_option( 'preloadx_color', '#3498db' );
        $bgcolor = get_option( 'preloadx_bgcolor', '#000' );

        $is_admin = is_admin();
        $preloader_html = '';

        switch( $selected_preloader ) {
            case 'none':
                $preloader_html = '<div class="' . ( $is_admin ? 'pxpreloader-preview' : 'pxpreloader' ) . '" id="no-loader"><div class="loader"></div></div>';
                break;
            case 'loading-text':
                $preloader_html = '<div class="' . ( $is_admin ? 'pxpreloader-preview' : 'pxpreloader' ) . '"><div class="loader loading-text"></div></div>';
                break;
            case 'rounded-progress':
                $preloader_html = '<div class="' . ( $is_admin ? 'pxpreloader-preview' : 'pxpreloader' ) . '"><div class="loader rounded-progress"></div></div>';
                break;
            case 'square':
                $preloader_html = '<div class="' . ( $is_admin ? 'pxpreloader-preview' : 'pxpreloader' ) . '"><div class="loader square"></div></div>';
                break;
            case 'hourglass':
                $preloader_html = '<div class="' . ( $is_admin ? 'pxpreloader-preview' : 'pxpreloader' ) . '"><div class="loader hourglass"></div></div>';
                break;
            case 'clock-loader':
                $preloader_html = '<div class="' . ( $is_admin ? 'pxpreloader-preview' : 'pxpreloader' ) . '"><div class="loader clock-loader"></div></div>';
                break;
            case 'spinner':
                $preloader_html = '<div class="' . ( $is_admin ? 'pxpreloader-preview' : 'pxpreloader' ) . '"><div class="loader spinner"></div></div>';
                break;
            case 'scaling-bubble-colors':
                $preloader_html = '<div class="' . ( $is_admin ? 'pxpreloader-preview' : 'pxpreloader' ) . '"><div class="loader scaling-bubble-colors"><div class="yellow"></div><div class="pink"></div><div class="blue"></div><div class="violet"></div></div></div>';
                break;
            case 'ekg-waves':
                $preloader_html = '<div class="' . ( $is_admin ? 'pxpreloader-preview' : 'pxpreloader' ) . '"><div class="loader ekg-waves"><svg class="ekg" viewBox="0 0 300 195" preserveAspectRatio="xMinYMin"><g transform="translate(-0.13703948,-768.38124)"><path id="ekg" stroke-dasharray="750" stroke-dashoffset="750" d="m 2.8096902,901.62064 27.8352018,0 29.835201,0 c 9.945067,0 32.20852,-29.26009 43.835197,0 l 15.8352,0 13.39911,23.5426 16.58744,-153.5426 19.3139,188.52018 16.07175,-58.52018 28.48543,0 c 9.15882,-23.20628 26.67189,-23.20628 34.48542,0 l 22.48542,0 26.48543,0" style="fill:none;fill-rule:evenodd;stroke-width:5;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-opacity:1"/></g></svg><svg class="ekg" viewBox="0 0 300 195" preserveAspectRatio="xMinYMin"><g transform="translate(-0.13703948,-768.38124)"><path id="ekg" stroke-dasharray="750" stroke-dashoffset="750" d="m 2.8096902,901.62064 27.8352018,0 29.835201,0 c 9.945067,0 32.20852,-29.26009 43.835197,0 l 15.8352,0 13.39911,23.5426 16.58744,-153.5426 19.3139,188.52018 16.07175,-58.52018 28.48543,0 c 9.15882,-23.20628 26.67189,-23.20628 34.48542,0 l 22.48542,0 26.48543,0" style="fill:none;fill-rule:evenodd;stroke-width:5;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-opacity:1"/></g></svg></div></div>';
                break;
            case 'bouncing-bubbles':
                $preloader_html = '<div class="' . ( $is_admin ? 'pxpreloader-preview' : 'pxpreloader' ) . '"><div class="loader bouncing-bubbles"><div class="circle"></div><div class="circle"></div><div class="circle"></div><div class="shadow"></div><div class="shadow"></div><div class="shadow"></div><span>Loading</span></div></div>';
                break;
            case 'wavy-colors':
                $preloader_html = '<div class="' . ( $is_admin ? 'pxpreloader-preview' : 'pxpreloader' ) . '"><div class="loader wavy-colors"><div class="bar1"></div><div class="bar2"></div><div class="bar3"></div><div class="bar4"></div><div class="bar5"></div><div class="bar6"></div></div></div>';
                break;
            default:
                $preloader_html = '';
        }

        return $preloader_html;
    }
}
?>