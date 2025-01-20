<?php
/**
 * Plugin Name: Preloadify - Custom Preloader
 * Description: A customizable preloader plugin with 10 built-in options and a custom preloader option for your WordPress site.
 * Version: 1.1
 * Author: VR
 * Author URI: https://yourwebsite.com
 * License: GPL2
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Register the plugin settings page
function preloadify_menu() {
    add_menu_page(
        'Preloadify Settings',          // Page Title
        'Preloadify Settings',          // Menu Title
        'manage_options',               // Capability
        'preloadify',                   // Menu Slug
        'preloadify_settings_page',     // Function to display settings page
        'dashicons-image-filter',       // Icon
        100                             // Position
    );
}
add_action( 'admin_menu', 'preloadify_menu' );

// Display the plugin settings page
function preloadify_settings_page() {
    ?>
    <div class="wrap">
        <h1>Preloadify Settings</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields( 'preloadify_options_group' );
            do_settings_sections( 'preloadify' );
            ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Select Preloader</th>
                    <td>
                        <select name="preloadify_selected" id="preloadify_selected">
                            <option value="none" <?php selected( get_option( 'preloadify_selected' ), 'none' ); ?>>None</option>
                            <option value="spinner" <?php selected( get_option( 'preloadify_selected' ), 'spinner' ); ?>>Spinner</option>
                            <option value="roller" <?php selected( get_option( 'preloadify_selected' ), 'roller' ); ?>>Roller</option>
                            <option value="loading-text" <?php selected( get_option( 'preloadify_selected' ), 'loading-text' ); ?>>Loading Text</option>
                            <option value="rounded-progress" <?php selected( get_option( 'preloadify_selected' ), 'rounded-progress' ); ?>>Rounded Progress</option>
                            <option value="square" <?php selected( get_option( 'preloadify_selected' ), 'square' ); ?>>Square</option>
                            <option value="hourglass" <?php selected( get_option( 'preloadify_selected' ), 'hourglass' ); ?>>Hourglass</option>
                            <option value="clock-loader" <?php selected( get_option( 'preloadify_selected' ), 'clock-loader' ); ?>>Clock Loader</option>
                            <option value="wave" <?php selected( get_option( 'preloadify_selected' ), 'wave' ); ?>>Wave</option>
                            <option value="pulsar" <?php selected( get_option( 'preloadify_selected' ), 'pulsar' ); ?>>Pulsar</option>
                            <option value="custom" <?php selected( get_option( 'preloadify_selected' ), 'custom' ); ?>>Custom</option>
                        </select>
                        <div id="preloader-preview" class="preloader-preview"></div>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Preloader Background Color</th>
                    <td>
                        <input type="color" name="preloadify_bgcolor" value="<?php echo esc_attr( get_option( 'preloadify_bgcolor', '#000' ) ); ?>" />
                        <p class="description">Choose the Background-Color for the preloader.</p>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Preloader Color</th>
                    <td>
                        <input type="color" name="preloadify_color" value="<?php echo esc_attr( get_option( 'preloadify_color', '#3498db' ) ); ?>" />
                        <p class="description">Choose the color for the preloader.</p>
                    </td>
                </tr>

                <tr valign="top" class="custom-preloader-field" style="display: none;">
                    <th scope="row">Custom Preloader HTML</th>
                    <td>
                        <textarea name="preloadify_custom_html" rows="5" cols="50"><?php echo esc_textarea( get_option( 'preloadify_custom_html' ) ); ?></textarea>
                        <p class="description">Add your custom preloader HTML here.</p>
                    </td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

// Register plugin settings
function preloadify_register_settings() {
    register_setting( 'preloadify_options_group', 'preloadify_selected' );
    register_setting( 'preloadify_options_group', 'preloadify_custom_html' );
    register_setting( 'preloadify_options_group', 'preloadify_bgcolor' );
    register_setting( 'preloadify_options_group', 'preloadify_color' );
    add_settings_section( 'preloadify_section', '', null, 'preloadify' );
}
add_action( 'admin_init', 'preloadify_register_settings' );

// Enqueue the styles and scripts for the admin panel
function preloadify_admin_enqueue_scripts($hook) {

    if ($hook !== 'toplevel_page_preloadify') {
        return;
    }

    wp_enqueue_style('preloadify-admin-style', plugins_url('assets/style.css', __FILE__));
    wp_enqueue_script('preloadify-admin-script', plugins_url('assets/preview.js', __FILE__), array(), null, true);
}
add_action('admin_enqueue_scripts', 'preloadify_admin_enqueue_scripts');


// Enqueue the CSS file in the <head> section
function preloadify_enqueue_styles() {
    wp_enqueue_style( 'preloadify-style', plugins_url( 'assets/style.css', __FILE__ ) );
    wp_enqueue_script( 'preloadify-preview', plugins_url( 'assets/preview.js', __FILE__ ), array('jquery'), null, true );
}
add_action( 'wp_enqueue_scripts', 'preloadify_enqueue_styles' );

// Insert the preloader directly after <body> tag using wp_body_open hook
function preloadify_insert_header() {
    $selected_preloader = get_option( 'preloadify_selected', 'none' );
    $bgcolor = get_option( 'preloadify_bgcolor', '#000' );
    $color = get_option( 'preloadify_color', '#3498db' );

    if ($selected_preloader === 'none') return;

    $preloader_html = '';

    if ($selected_preloader === 'spinner') {
        $preloader_html = '<div class="p-preloader"><div class="loader spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></div>';
    } elseif ($selected_preloader === 'loading-text') {
        $preloader_html = '<div class="p-preloader"><div class="loader loading-text"></div></div>';
    } elseif ($selected_preloader === 'rounded-progress') {
        $preloader_html = '<div class="p-preloader"><div class="loader rounded-progress"></div></div>';
    } elseif ($selected_preloader === 'square') {
        $preloader_html = '<div class="p-preloader"><div class="loader square"></div></div>';
    } elseif ($selected_preloader === 'hourglass') {
        $preloader_html = '<div class="p-preloader"><div class="loader hourglass"></div></div>';
    } elseif ($selected_preloader === 'clock-loader') {
        $preloader_html = '<div class="p-preloader"><div class="loader clock-loader"></div></div>';
    } elseif ($selected_preloader === 'roller') {
        $preloader_html = '<div class="p-preloader"><div class="loader roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></div>';
    } elseif ($selected_preloader === 'wave') {
        $preloader_html = '<div class="p-preloader"><div class="loader wave"></div></div>';
    } elseif ($selected_preloader === 'pulsar') {
        $preloader_html = '<div class="p-preloader"><div class="loader pulsar"></div></div>';
    }

    // Add custom HTML preloader if provided
    if ($selected_preloader === 'custom') {
        $preloader_html = get_option( 'preloadify_custom_html', '' );
    }

    // Output the HTML preloader
    echo $preloader_html;
    echo '<style>
        :root {
            --preloader-bgcolor: ' . esc_attr( $bgcolor ) . ';
            --preloader-color: ' . esc_attr( $color ) . ';
        }
    </style>';
}
add_action( 'wp_body_open', 'preloadify_insert_header', 1 );

// Add JS to hide preloader on page load
function preloadify_hide_preloader_js() {
    ?>
    <script>
        window.onload = function() {
            document.querySelector('.preloader').classList.add('no-show');
        };
    </script>
    <?php
}
add_action( 'wp_head', 'preloadify_hide_preloader_js', 100 );