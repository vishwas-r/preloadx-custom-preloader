<?php

/**
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://vishwas.me/
 * @since      1.0.0
 *
 * @package    Preloadx_Custom_Preloader
 * @subpackage Preloadx_Custom_Preloader/admin/partials
 */
    if ( !defined( 'ABSPATH' ) ) exit;
?>

<?php wp_nonce_field( 'preloadx_nonce_action', 'preloadx_nonce_field' ); ?>

<div class="preloadx-wrap">
    <div class="container">
        <div class="text">
            PreloadX Settings
        </div>
        <form method="post" id="preloadx-settings-form">
            <?php
                settings_fields( 'preloadx_options_group' );
                do_settings_sections( 'preloadx-custom-preloader' );
            ?>
            <div class="form-row">
                <div class="input-data">
                    <label for="preloadx_bgtype">Background Type</label>
                    <select id="preloadx_bgtype" name="preloadx_bgtype">
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
                    <label for="preloadx_color">Preloader Color</label>
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
                                <?php
                                    if ( class_exists( 'Preloadx_Cp_5199_Utilities' ) ) {
                                        $preloader_utilities = new Preloadx_Cp_5199_Utilities();                                    
                                        $preloader_html = $preloader_utilities->preloadx_get_preloader_html($value);
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
                                        
                                        add_action('wp_enqueue_scripts', $preloader_utilities->add_inline_root_styles());
                                    }
                                ?>
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
            <input type="hidden" name="preloadx_nonce_field" value="<?php echo esc_attr( wp_create_nonce( 'preloadx_nonce_action' ) ); ?>" />
            <?php submit_button(); ?>
            <div id="preloadx-settings-response-message" style="display: none; padding: 10px; margin: 10px 0; border-radius: 5px; font-weight: bold;"></div>
        </form>
    </div>
    <div id="footer">
        <p>Built with <span class="heart">&#10084;</span> | <a href="https://vishwas.me" target="_blank">Vishwas</a></p>
    </div>
</div>