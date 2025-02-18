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
                :root {
                    --preloader-color:" . esc_attr( $color ) . "
                }
                .pxpreloader-preview, .pxpreloader {" .
                    esc_attr( $background_style )
                . "}
        ";
        wp_enqueue_style( 'preloadx-custom-preloader-style', plugin_dir_url( __DIR__ ) . 'assets/css/preloadx-style.css', array(), $this->version, 'all' );
        wp_add_inline_style( 'preloadx-custom-preloader-style', $inline_css );
    }

    public function preloadx_get_preloader_html( $selected_preloader ) {
        $is_admin = is_admin();
        $container_class = $is_admin ? 'pxpreloader-preview' : 'pxpreloader';

        $preloaders = array(
            'none'                  => '<div class="' . $container_class . '" id="no-loader"><div class="loader"></div></div>',
            'loading-text'          => '<div class="' . $container_class . '"><div class="loader loading-text"></div></div>',
            'rounded-progress'      => '<div class="' . $container_class . '"><div class="loader rounded-progress"></div></div>',
            'square'                => '<div class="' . $container_class . '"><div class="loader square"></div></div>',
            'hourglass'             => '<div class="' . $container_class . '"><div class="loader hourglass"></div></div>',
            'clock-loader'          => '<div class="' . $container_class . '"><div class="loader clock-loader"></div></div>',
            'spinner'               => '<div class="' . $container_class . '"><div class="loader spinner"></div></div>',
            'scaling-bubble-colors' => '<div class="' . $container_class . '"><div class="loader scaling-bubble-colors"><div class="yellow"></div><div class="pink"></div><div class="blue"></div><div class="violet"></div></div></div>',
            'bouncing-bubbles'      => '<div class="' . $container_class . '"><div class="loader bouncing-bubbles"><div class="circle"></div><div class="circle"></div><div class="circle"></div><div class="shadow"></div><div class="shadow"></div><div class="shadow"></div><span>Loading</span></div></div>',
            'wavy-colors'           => '<div class="' . $container_class . '"><div class="loader wavy-colors"><div class="bar1"></div><div class="bar2"></div><div class="bar3"></div><div class="bar4"></div><div class="bar5"></div><div class="bar6"></div></div></div>',
            'ekg-waves'             => '<div class="' . $container_class . '"><div class="loader ekg-waves"><svg class="ekg" viewBox="0 0 300 195" preserveAspectRatio="xMinYMin"><g transform="translate(-0.13703948,-768.38124)"><path id="ekg" stroke-dasharray="750" stroke-dashoffset="750" d="m 2.8096902,901.62064 27.8352018,0 29.835201,0 c 9.945067,0 32.20852,-29.26009 43.835197,0 l 15.8352,0 13.39911,23.5426 16.58744,-153.5426 19.3139,188.52018 16.07175,-58.52018 28.48543,0 c 9.15882,-23.20628 26.67189,-23.20628 34.48542,0 l 22.48542,0 26.48543,0"/></g></svg><svg class="ekg" viewBox="0 0 300 195" preserveAspectRatio="xMinYMin"><g transform="translate(-0.13703948,-768.38124)"><path id="ekg" stroke-dasharray="750" stroke-dashoffset="750" d="m 2.8096902,901.62064 27.8352018,0 29.835201,0 c 9.945067,0 32.20852,-29.26009 43.835197,0 l 15.8352,0 13.39911,23.5426 16.58744,-153.5426 19.3139,188.52018 16.07175,-58.52018 28.48543,0 c 9.15882,-23.20628 26.67189,-23.20628 34.48542,0 l 22.48542,0 26.48543,0"/></g></svg></div></div>'
        );
    
        return isset($preloaders[$selected_preloader]) ? $preloaders[$selected_preloader] : '';
    }    
}
?>