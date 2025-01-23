<?php
/**
 * Plugin Name: PreloadX - Custom Preloader
 * Description: Customize your WordPress site's preloader with multiple CSS preloaders and flexible background options, including colors, gradients, or images, with adjustable foreground colors.
 * Version: 1.0
 * Author: Vishwas R
 * Author URI: https://vishwas.me/
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function preloadx_menu() {
    add_menu_page(
        'PreloadX Settings',
        'PreloadX Settings',
        'manage_options',
        'preloadx',
        'preloadx_settings_page',
        'dashicons-image-filter',
        100
    );
}
add_action( 'admin_menu', 'preloadx_menu' );

function preloadx_settings_page() {
    ?>
    <style>
        .preloadx-wrap .container {
            max-width: 800px;
            margin: auto;
            background: #fff;
            width: 800px;
            padding: 25px 40px 10px 40px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .preloadx-wrap .container .text {
            background-color: #00b0ff;
            color: white;
            font-family: "Roboto", sans-serif;
            text-transform: uppercase;
            padding: 14px 0 10px 49px;
            letter-spacing: 1px;
            margin-left: -52px;
            width: 330px;
            font-size: 28px;
            font-weight: bold;
            background: #f12711;
            background: linear-gradient(to right, #f12711, #f5af19);
        }
        .preloadx-wrap .container form {
            padding: 30px 0 0 0;
        }
        .preloadx-wrap .container form .form-row {
            display: flex;
            margin: 32px 0;
        }
        .preloadx-wrap form .form-row .input-data {
            width: 100%;
            height: 40px;
            margin: 0 20px;
            position: relative;
        }
        .preloadx-wrap form .form-row {
            height: 70px;
        }
        .preloadx-wrap .input-data input {
            display: block;
            width: 100%;
            height: 100%;
            border: none;
            font-size: 17px;
            border-bottom: 2px solid rgba(0, 0, 0, 0.12);
        }
        .preloadx-wrap .input-data input[type=color] {
            height: revert;
        }
        .preloadx-wrap .input-data select {
            width: 100%;
            max-width: 100%;
            padding: .375rem 2.25rem .375rem .75rem;
            -moz-padding-start: calc(0.75rem - 3px);
            font-size: 1rem;
            line-height: 1.5;
        }
        .preloadx-wrap .input-data input:focus ~ label,
        .preloadx-wrap .input-data input:valid ~ label {
            transform: translateY(-20px);
            font-size: 16px;
            color: #3498db;
        }
        .preloadx-wrap .input-data label {
            /* position: absolute; */
            pointer-events: none;
            bottom: 10px;
            font-family: "Roboto", sans-serif;
            font-size: 16px;
            transition: all 0.3s ease;
        }
        .preloadx-wrap .input-data .underline {
            position: absolute;
            bottom: 0;
            height: 2px;
            width: 100%;
        }
        .preloadx-wrap .input-data .underline:before {
            position: absolute;
            content: "";
            height: 2px;
            width: 100%;
            background: #3498db;
            transform: scaleX(0);
            transform-origin: center;
            transition: transform 0.3s ease;
        }
        .preloadx-wrap .input-data input:focus ~ .underline:before,
        .preloadx-wrap .input-data input:valid ~ .underline:before {
            transform: scale(1);
        }
        .preloadx-wrap .button {
            --c:  #E95A49;  
            box-shadow: 0 0 0 .1em inset var(--c) !important; 
            --_g: linear-gradient(var(--c) 0 0) no-repeat;
            background: 
                var(--_g) calc(var(--_p,0%) - 100%) 0%,
                var(--_g) calc(200% - var(--_p,0%)) 0%,
                var(--_g) calc(var(--_p,0%) - 100%) 100%,
                var(--_g) calc(200% - var(--_p,0%)) 100% !important;
            color: var(--c) !important;
            background-size: 50.5% calc(var(--_p,0%)/2 + .5%) !important;
            outline-offset: .1em !important;
            transition: background-size .4s, background-position 0s .4s !important;
            font-family: system-ui, sans-serif !important;
            font-size: 16px !important;
            cursor: pointer !important;
            padding: 0px 8px !important;
            font-weight: bold !important;  
            border: none !important;
            margin-top: 5rem !important;
        }
        .preloadx-wrap .button:hover {
            --_p: 100%;
            transition: background-position .4s, color .5s, background-size 0s !important;
            color: #fff !important;
        }
        .preloadx-wrap .button:active {
            box-shadow: 0 0 9e9q inset #0009 !important; 
            background-color: var(--c) !important;
            color: #fff !important;
        }
        @media (max-width: 700px) {
            .preloadx-wrap .container .text {
                font-size: 20px;
            }
            .preloadx-wrap .container form {
                padding: 10px 0 0 0;
            }
            .preloadx-wrap .container form .form-row {
                display: block;
            }
            .preloadx-wrap form .form-row .input-data {
                margin: 35px 0 !important;
            }
        }
        #footer {
        text-align: center;
        padding: 10px;
        }
        
        #footer p {
        font-size: 14px;
        color: #555;
        }
        .heart {
            display: inline-block;
            color: #d53434;
            animation: animateHeart 1s infinite;
        }
        @keyframes animateHeart {
        0%
        {
            transform: scale( 1 );
        }
        20%
        {
            transform: scale( 1.5 );
        }
        40%
        {
            transform: scale( 1 );
        }
        60%
        {
            transform: scale( 1.5 );
        }
        80%
        {
            transform: scale( 1 );
        }
        100%
        {
            transform: scale( 1 );
        }
        }
    </style>
    <div class="preloadx-wrap">
        <div class="container">
            <div class="text">
            PreloadX Settings
            </div>
            <form method="post" action="options.php">
                <?php
                    settings_fields( 'preloadx_options_group' );
                    do_settings_sections( 'preloadx' );
                ?>
                <div class="form-row">
                    <div class="input-data">
                        <label for="preloadx_bgtype">Background Type</label>
                        <select id="background-type" name="preloadx_bgtype">
                            <option value="color" <?php selected( get_option( 'preloadx_bgtype', 'color' ), 'color' ); ?>>Color</option>
                            <option value="gradient" <?php selected( get_option( 'preloadx_bgtype', 'color' ), 'gradient' ); ?>>Gradient</option>
                            <option value="image" <?php selected( get_option( 'preloadx_bgtype', 'color' ), 'image' ); ?>>Image</option>
                        </select>
                        <div class="underline"></div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="input-data" id="color-input" style="display: block;">
                        <div valign="top" >
                            <label for="preloadx_bgcolor">Background Color</label>
                            <input type="color" name="preloadx_bgcolor" id="preloadx_bgcolor" value="<?php echo esc_attr( get_option( 'preloadx_bgcolor', '#000' ) ); ?>" />
                        </div>
                    </div>
                    <div class="input-data" id="gradient-input" style="display: none;">
                        <div valign="top">
                            <label for="preloadx_bggradient">Background Gradient</label>
                            <input type="text" name="preloadx_bggradient" id="preloadx_bggradient" value="<?php echo esc_attr( get_option( 'preloadx_bggradient', '' ) ); ?>" placeholder="e.g., linear-gradient(to right, #ff7e5f, #feb47b)" />
                        </div>
                    </div>
                    <div class="input-data" id="image-input" style="display: none;">
                        <div valign="top">
                            <label for="preloadx_bgimage">Background Image URL</label>
                            <input type="text" name="preloadx_bgimage" id="preloadx_bgimage" value="<?php echo esc_attr( get_option( 'preloadx_bgimage', '' ) ); ?>" placeholder="Image URL" />
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="input-data">
                        <label for="preloadx_bgcolor">Preloader Color</label>
                        <input type="color" id="preloadx_color" name="preloadx_color" value="<?php echo esc_attr( get_option( 'preloadx_color', '#fff' ) ); ?>" />
                    </div>
                </div>
                <div>
                    <div id="preloader-gallery" style="display: flex; flex-wrap: wrap; gap: 20px;">
                        <?php
                        $selected_preloader = get_option( 'preloadx_selected', 'none' );
                        $preloaders = [
                            'none' => 'None',
                            'loading-text' => 'Loading Text',
                            'spinner' => 'Spinner',
                            'square' => 'Square',
                            'rounded-progress' => 'Rounded Progress',
                            'clock-loader' => 'Clock Loader',
                            'hourglass' => 'Hourglass',
                            'ekg-waves' => 'EKG Pulse',
                            'bouncing-bubbles' => 'Bouncing Bubbles',
                            'scaling-bubble-colors' => 'Scaling Bubble Colors',
                            'wavy-colors' => 'Wavy Colors'
                        ];

                        foreach ( $preloaders as $value => $label ) {
                            $checked = ( $selected_preloader === $value ) ? 'checked' : '';
                            ?>
                            <div style="text-align: center; width: 250px;">
                                <div class="preloader-preview">
                                    <?php echo preloadx_get_preloader_html( $value ); ?>
                                </div>
                                <label>
                                    <input type="radio" name="preloadx_selected" value="<?php echo esc_attr( $value ); ?>" <?php echo $checked; ?> />
                                    <?php echo esc_html( $label ); ?>
                                </label>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <?php submit_button(); ?>
            </form>
        </div>
        <div id="footer">
            <p>Built with <span class="heart">&#10084;</span> | <a href="https://vishwas.me" target="_blank">Vishwas</a></p>
        </div>
    </div>
    <script>
        function toggleBackgroundInputs() {
            var type = document.getElementById('background-type').value;
            document.getElementById('color-input').style.display = (type === 'color') ? 'block' : 'none';
            document.getElementById('gradient-input').style.display = (type === 'gradient') ? 'block' : 'none';
            document.getElementById('image-input').style.display = (type === 'image') ? 'block' : 'none';
            changeBackground(type);
        }
        function changeBackground(type) {
            var elements = document.getElementsByClassName('pxpreloader-preview');
            for (var i = 0; i < elements.length; i++) {
                if(type === "image") {
                    elements[i].style.background = "url(" + document.getElementById('preloadx_bg' + type).value + ")";
                    elements[i].style.backgroundSize = "cover";
                    elements[i].style.backgroundRepeat = "no-repeat";
                }
                else {
                    elements[i].style.background = elements[i].getAttribute("id") === "no-loader" ? "none" : document.getElementById('preloadx_bg' + type).value;
                }
            }
        }
        document.addEventListener('DOMContentLoaded', function() {
            toggleBackgroundInputs();
        });
        document.getElementById("background-type").addEventListener("change", function() {
            toggleBackgroundInputs();
        });
        document.getElementById("preloadx_bgcolor").addEventListener("change", function() {
            changeBackground('color');
        });
        document.getElementById("preloadx_bggradient").addEventListener("change", function() {
            changeBackground("gradient");
        });
        document.getElementById("preloadx_bgimage").addEventListener("change", function() {
            changeBackground("image");
        });
        document.getElementById("preloadx_color").addEventListener("change", function() {
            document.documentElement.style.setProperty('--preloader-color', document.getElementById('preloadx_color').value);
        });
    </script>
    <?php
}

function preloadx_register_settings() {
    register_setting( 'preloadx_options_group', 'preloadx_selected' );
    register_setting( 'preloadx_options_group', 'preloadx_custom_html' );
    register_setting( 'preloadx_options_group', 'preloadx_color' );
    register_setting( 'preloadx_options_group', 'preloadx_bgcolor' );
    register_setting( 'preloadx_options_group', 'preloadx_bggradient' );
    register_setting( 'preloadx_options_group', 'preloadx_bgimage' );
    register_setting( 'preloadx_options_group', 'preloadx_bgtype' );
    add_settings_section( 'preloadx_section', '', null, 'preloadx' );
}
add_action( 'admin_init', 'preloadx_register_settings' );

function preloadx_enqueue_styles() {
    wp_enqueue_style( 'preloadx-style', plugins_url( 'assets/style.css', __FILE__ ) );
}
add_action( 'wp_enqueue_scripts', 'preloadx_enqueue_styles' );
add_action( 'admin_enqueue_scripts', 'preloadx_enqueue_styles' );

function preloadx_get_preloader_html( $selected_preloader ) {
    $color = get_option( 'preloadx_color', '#3498db' );
    $bgcolor = get_option( 'preloadx_bgcolor', '#000' );

    $is_admin = is_admin();
    $preloader_html = '';

    if ( $selected_preloader === 'none' ) {
        $preloader_html = '<div class="' . ( $is_admin ? 'pxpreloader-preview' : 'pxpreloader' ) . '" id="no-loader"><div class="loader"></div></div>';
    } elseif ( $selected_preloader === 'loading-text' ) {
        $preloader_html = '<div class="' . ( $is_admin ? 'pxpreloader-preview' : 'pxpreloader' ) . '"><div class="loader loading-text"></div></div>';
    } elseif ( $selected_preloader === 'rounded-progress' ) {
        $preloader_html = '<div class="' . ( $is_admin ? 'pxpreloader-preview' : 'pxpreloader' ) . '"><div class="loader rounded-progress"></div></div>';
    } elseif ( $selected_preloader === 'square' ) {
        $preloader_html = '<div class="' . ( $is_admin ? 'pxpreloader-preview' : 'pxpreloader' ) . '"><div class="loader square"></div></div>';
    } elseif ( $selected_preloader === 'hourglass' ) {
        $preloader_html = '<div class="' . ( $is_admin ? 'pxpreloader-preview' : 'pxpreloader' ) . '"><div class="loader hourglass"></div></div>';
    } elseif ( $selected_preloader === 'clock-loader' ) {
        $preloader_html = '<div class="' . ( $is_admin ? 'pxpreloader-preview' : 'pxpreloader' ) . '"><div class="loader clock-loader"></div></div>';
    } elseif ( $selected_preloader === 'spinner' ) {
        $preloader_html = '<div class="' . ( $is_admin ? 'pxpreloader-preview' : 'pxpreloader' ) . '"><div class="loader spinner"></div></div>';
    } elseif ( $selected_preloader === 'scaling-bubble-colors' ) {
        $preloader_html = '<div class="' . ( $is_admin ? 'pxpreloader-preview' : 'pxpreloader' ) . '"><div class="loader scaling-bubble-colors"><div class="yellow"></div><div class="pink"></div><div class="blue"></div><div class="violet"></div></div></div>';
    } elseif ( $selected_preloader === 'ekg-waves' ) {
        $preloader_html = '<div class="' . ( $is_admin ? 'pxpreloader-preview' : 'pxpreloader' ) . '"><div class="loader ekg-waves"><svg class="ekg" viewBox="0 0 300 195" preserveAspectRatio="xMinYMin"><g transform="translate(-0.13703948,-768.38124)"><path id="ekg" stroke-dasharray="750" stroke-dashoffset="750" d="m 2.8096902,901.62064 27.8352018,0 29.835201,0 c 9.945067,0 32.20852,-29.26009 43.835197,0 l 15.8352,0 13.39911,23.5426 16.58744,-153.5426 19.3139,188.52018 16.07175,-58.52018 28.48543,0 c 9.15882,-23.20628 26.67189,-23.20628 34.48542,0 l 22.48542,0 26.48543,0" style="fill:none;fill-rule:evenodd;stroke-width:5;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-opacity:1"/></g></svg><svg class="ekg" viewBox="0 0 300 195" preserveAspectRatio="xMinYMin"><g transform="translate(-0.13703948,-768.38124)"><path id="ekg" stroke-dasharray="750" stroke-dashoffset="750" d="m 2.8096902,901.62064 27.8352018,0 29.835201,0 c 9.945067,0 32.20852,-29.26009 43.835197,0 l 15.8352,0 13.39911,23.5426 16.58744,-153.5426 19.3139,188.52018 16.07175,-58.52018 28.48543,0 c 9.15882,-23.20628 26.67189,-23.20628 34.48542,0 l 22.48542,0 26.48543,0" style="fill:none;fill-rule:evenodd;stroke-width:5;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-opacity:1"/></g></svg></div></div>';
    }elseif ( $selected_preloader === 'bouncing-bubbles' ) {
        $preloader_html = '<div class="' . ( $is_admin ? 'pxpreloader-preview' : 'pxpreloader' ) . '"><div class="loader bouncing-bubbles"><div class="circle"></div><div class="circle"></div><div class="circle"></div><div class="shadow"></div><div class="shadow"></div><div class="shadow"></div><span>Loading</span></div></div>';
    } elseif ( $selected_preloader === 'wavy-colors' ) {
        $preloader_html = '<div class="' . ( $is_admin ? 'pxpreloader-preview' : 'pxpreloader' ) . '"><div class="loader wavy-colors"><div class="bar1"></div><div class="bar2"></div><div class="bar3"></div><div class="bar4"></div><div class="bar5"></div><div class="bar6"></div></div></div>';
    }

    if ( $selected_preloader === 'custom' ) {
        $preloader_html = get_option( 'preloadx_custom_html', '' );
    }

    return $preloader_html;
}

function preloadx_insert_header() {
    $selected_preloader = get_option( 'preloadx_selected', 'none' );
    $color = get_option( 'preloadx_color', '#3498db' );
    $bgcolor = get_option( 'preloadx_bgcolor', '#000' );
    $bggradient = get_option( 'preloadx_bggradient', '' );
    $bgimage = get_option( 'preloadx_bgimage', '' );
    $bgtype = get_option( 'preloadx_bgtype', 'color' );

    if ( $selected_preloader === 'none' ) return;
    $preloader_html = preloadx_get_preloader_html( $selected_preloader );

    if (!is_admin()) {
        echo $preloader_html;  
    }
    $background_style = '';

    if ( $bgtype === 'color' ) {
        $background_style = "background-color: " . esc_attr( $bgcolor ) . ";";
    } elseif ( $bgtype === 'gradient' ) {
        $background_style = "background: " . esc_attr( $bggradient ) . ";";
    } elseif ( $bgtype === 'image' ) {
        $background_style = "background-color: " . esc_attr( $bgcolor ) . "; background-image: url('" . esc_url( $bgimage ) . "'); background-size: cover; background-repeat: no-repeat;";
    }
    echo '<style>
    :root {
        --preloader-color: ' . esc_attr( $color ) . ';
    }
    .pxpreloader-preview, .pxpreloader {
        ' . $background_style . '
    }
    </style>';
}

add_action( 'wp_body_open', 'preloadx_insert_header', 1 );
add_action( 'admin_head', 'preloadx_insert_header', 1 );

function preloadx_hide_preloader_js() {
    ?>
    <script>
        window.onload = function() {
            var preloader = document.getElementsByClassName('pxpreloader');
            if(preloader && preloader.length)
                preloader[0].classList.add('no-show');
        };
    </script>
    <?php
}
add_action( 'wp_head', 'preloadx_hide_preloader_js', 100 );
?>