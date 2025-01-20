<?php
/**
 * Plugin Name: PreloadX - Custom Preloader
 * Description: A customizable preloader plugin with 10 built-in options and a custom preloader option for your WordPress site.
 * Version: 1.2
 * Author: VR
 * Author URI: https://yourwebsite.com
 * License: GPL2
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Register the plugin settings page
function preloadx_menu() {
    add_menu_page(
        'PreloadX Settings',          // Page Title
        'PreloadX Settings',          // Menu Title
        'manage_options',             // Capability
        'preloadx',                   // Menu Slug
        'preloadx_settings_page',     // Function to display settings page
        'dashicons-image-filter',     // Icon
        100                           // Position
    );
}
add_action( 'admin_menu', 'preloadx_menu' );

// Display the plugin settings page
function preloadx_settings_page() {
    ?>
    <div class="wrap">
        <h1>PreloadX Settings</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields( 'preloadx_options_group' );
            do_settings_sections( 'preloadx' );
            ?>
            <table class="form-table">
                <tr valign="top">
                    <td>
                        Background Color: <input type="color" name="preloadx_bgcolor" value="<?php echo esc_attr( get_option( 'preloadx_bgcolor', '#000' ) ); ?>" />
                    </td>
                    <td>
                        Preloader Color: <input type="color" name="preloadx_color" value="<?php echo esc_attr( get_option( 'preloadx_color', '#3498db' ) ); ?>" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Select Preloader</th>
                    <td>
                        <div id="preloader-gallery" style="display: flex; flex-wrap: wrap; gap: 20px;">
                            <?php
                            $selected_preloader = get_option( 'preloadx_selected', 'none' );
                            $preloaders = [
                                'none' => 'None',
                                'loading-text' => 'Loading Text',
                                'rounded-progress' => 'Rounded Progress',
                                'square' => 'Square',
                                'hourglass' => 'Hourglass',
                                'clock-loader' => 'Clock Loader'
                            ];

                            foreach ( $preloaders as $value => $label ) {
                                $checked = ( $selected_preloader === $value ) ? 'checked' : '';
                                ?>
                                <div style="text-align: center; width: 250px;">
                                    <div class="preloader-preview">
                                        <?php echo preloadx_get_preloader_html( $value ); ?>
                                    </div>
                                    <label>
                                        <input type="radio" name="preloadx_selected" value="<?php echo esc_attr( $value ); ?>" <?php echo $checked; ?> onclick="updatePreloaderPreview(this.value)" />
                                        <?php echo esc_html( $label ); ?>
                                    </label>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

// Register plugin settings
function preloadx_register_settings() {
    register_setting( 'preloadx_options_group', 'preloadx_selected' );
    register_setting( 'preloadx_options_group', 'preloadx_custom_html' );
    register_setting( 'preloadx_options_group', 'preloadx_color' );
    register_setting( 'preloadx_options_group', 'preloadx_bgcolor' );
    add_settings_section( 'preloadx_section', '', null, 'preloadx' );
}
add_action( 'admin_init', 'preloadx_register_settings' );

// Enqueue plugin styles
function preloadx_enqueue_styles() {
    wp_enqueue_style( 'preloadx-style', plugins_url( 'assets/style.css', __FILE__ ) );
}
add_action( 'wp_enqueue_scripts', 'preloadx_enqueue_styles' );
add_action( 'admin_enqueue_scripts', 'preloadx_enqueue_styles' );

// Get preloader HTML based on selection
function preloadx_get_preloader_html( $selected_preloader ) {
    $color = get_option( 'preloadx_color', '#3498db' );  // Fall back to #3498db if not set
    $bgcolor = get_option( 'preloadx_bgcolor', '#000' );  // Fall back to #000 if not set

    $is_admin = is_admin();
    $preloader_html = '';

    // Check which preloader was selected
    if ( $selected_preloader === 'loading-text' ) {
        $preloader_html = '<div class="' . ( $is_admin ? 'pxpreloader-preview' : 'pxpreloader' ) . '"><div class="loader loading-text"></div></div>';
    } elseif ( $selected_preloader === 'rounded-progress' ) {
        $preloader_html = '<div class="' . ( $is_admin ? 'pxpreloader-preview' : 'pxpreloader' ) . '"><div class="loader rounded-progress"></div></div>';
    } elseif ( $selected_preloader === 'square' ) {
        $preloader_html = '<div class="' . ( $is_admin ? 'pxpreloader-preview' : 'pxpreloader' ) . '"><div class="loader square"></div></div>';
    } elseif ( $selected_preloader === 'hourglass' ) {
        $preloader_html = '<div class="' . ( $is_admin ? 'pxpreloader-preview' : 'pxpreloader' ) . '"><div class="loader hourglass"></div></div>';
    } elseif ( $selected_preloader === 'clock-loader' ) {
        $preloader_html = '<div class="' . ( $is_admin ? 'pxpreloader-preview' : 'pxpreloader' ) . '"><div class="loader clock-loader"></div></div>';
    } elseif ( $selected_preloader === 'fade' ) {
        $preloader_html = '<div class="' . ( $is_admin ? 'pxpreloader-preview' : 'pxpreloader' ) . '"><div class="loader fade"></div></div>';
    } elseif ( $selected_preloader === 'circle' ) {
        $preloader_html = '<div class="' . ( $is_admin ? 'pxpreloader-preview' : 'pxpreloader' ) . '"><div class="loader circle"></div></div>';
    } elseif ( $selected_preloader === 'wave' ) {
        $preloader_html = '<div class="' . ( $is_admin ? 'pxpreloader-preview' : 'pxpreloader' ) . '"><div class="loader wave"></div></div>';
    } elseif ( $selected_preloader === 'pulsar' ) {
        $preloader_html = '<div class="' . ( $is_admin ? 'pxpreloader-preview' : 'pxpreloader' ) . '"><div class="loader pulsar"></div></div>';
    }

    // Add custom HTML preloader if selected
    if ( $selected_preloader === 'custom' ) {
        $preloader_html = get_option( 'preloadx_custom_html', '' );
    }

    return $preloader_html;
}

// Insert the preloader and styles (for both admin and front-end)
function preloadx_insert_header() {
    $selected_preloader = get_option( 'preloadx_selected', 'none' );
    $color = get_option( 'preloadx_color', '#3498db' );  // Fall back to #3498db if not set
    $bgcolor = get_option( 'preloadx_bgcolor', '#000' );  // Fall back to #000 if not set

    // Only show preloader if selected is not 'none'
    if ( $selected_preloader === 'none' ) return;
    $preloader_html = preloadx_get_preloader_html( $selected_preloader );

    if (!is_admin()) {
        echo $preloader_html;  
    }
    echo '<style>
    :root {
        --preloader-bgcolor: ' . esc_attr( $bgcolor ) . ';
        --preloader-color: ' . esc_attr( $color ) . ';
    }
    </style>';
}

// Hook into the appropriate actions
add_action( 'wp_body_open', 'preloadx_insert_header', 1 );    // For front-end
add_action( 'admin_head', 'preloadx_insert_header', 1 );      // For admin panel


// Add JS to hide preloader on page load and update preview colors dynamically
function preloadx_hide_preloader_js() {
    ?>
    <script>
        window.onload = function() {
            document.querySelector('.pxpreloader').classList.add('no-show');
        };

        // Function to update preloader preview
        function updatePreloaderPreview(value) {
            var previewDivs = document.querySelectorAll('.preloader-preview');
            previewDivs.forEach(function(div) {
                div.innerHTML = '<?php echo preloadx_get_preloader_html( "none" ); ?>';
                div.innerHTML = '<?php echo preloadx_get_preloader_html( "' + value + '" ); ?>';
            });
        }

        // Dynamically update the CSS variables and loader previews when the color inputs change
        function updateColorVariablesAndPreviews() {
            console.log(document.querySelector('[name="preloadx_bgcolor"]'))
            var bgcolor = document.querySelector('[name="preloadx_bgcolor"]').value;
            var color = document.querySelector('[name="preloadx_color"]').value;

            // Update the CSS custom properties (variables)
            document.documentElement.style.setProperty('--preloader-bgcolor', bgcolor);
            document.documentElement.style.setProperty('--preloader-color', color);

            // Update the loader previews in the gallery
            var previewDivs = document.querySelectorAll('.preloader-preview');
            previewDivs.forEach(function(div) {
                var preloaderType = div.querySelector('input[type="radio"]:checked') ? div.querySelector('input[type="radio"]:checked').value : 'none';
                div.innerHTML = '<?php echo preloadx_get_preloader_html( "' + preloaderType + '" ); ?>';
            });
        }

        // Add event listeners to the color inputs to update colors dynamically
        document.querySelector('[name="preloadx_bgcolor"]').addEventListener('input', updateColorVariablesAndPreviews);
        document.querySelector('[name="preloadx_color"]').addEventListener('input', updateColorVariablesAndPreviews);

        // Initialize color previews on page load
        window.onload = updateColorVariablesAndPreviews;
    </script>
    <?php
}
add_action( 'wp_head', 'preloadx_hide_preloader_js', 100 );
?>