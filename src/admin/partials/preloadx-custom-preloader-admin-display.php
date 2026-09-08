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

<div class="wrap preloadx-admin-wrap">
    <div class="preloadx-header">
        <div class="preloadx-brand">
            <h1 class="preloadx-title">PreloadX <span class="preloadx-version-badge">v1.1.0</span></h1>
            <p class="preloadx-subtitle">Customize modern, ultra-smooth page loaders for your WordPress website</p>
        </div>
    </div>
    
    <div class="preloadx-main-card">
        <nav class="preloadx-tabs" id="preloadx-tabs">
            <a href="#tab-general" class="nav-tab nav-tab-active">
                <span class="dashicons dashicons-admin-appearance"></span> General & Appearance
            </a>
            <a href="#tab-display" class="nav-tab">
                <span class="dashicons dashicons-visibility"></span> Display Rules
            </a>
            <a href="#tab-advanced" class="nav-tab">
                <span class="dashicons dashicons-admin-settings"></span> Advanced Settings
            </a>
        </nav>

        <form method="post" id="preloadx-settings-form">
            <?php wp_nonce_field( 'preloadx_nonce_action', 'preloadx_nonce_field' ); ?>
            <?php
                settings_fields( 'preloadx_options_group' );
                do_settings_sections( 'preloadx-custom-preloader' );
            ?>

            <!-- TAB: GENERAL -->
            <div id="tab-general" class="preloadx-tab-content" style="display:block;">
                <div class="preloadx-section-header">
                    <h3>Background & Canvas Styling</h3>
                    <p>Configure the background canvas and accent colors for your preloader.</p>
                </div>

                <div class="preloadx-form-grid">
                    <div class="preloadx-field">
                        <label for="preloadx_bgtype">Background Type</label>
                        <select id="preloadx_bgtype" name="preloadx_bgtype" class="preloadx-select">
                            <option value="color" <?php selected( get_option( 'preloadx_bgtype', 'color' ), 'color' ); ?>>Solid Color</option>
                            <option value="gradient" <?php selected( get_option( 'preloadx_bgtype', 'color' ), 'gradient' ); ?>>Gradient</option>
                            <option value="image" <?php selected( get_option( 'preloadx_bgtype', 'color' ), 'image' ); ?>>Image</option>
                        </select>
                    </div>

                    <div class="preloadx-field" id="color-input" style="display: block;">
                        <label for="preloadx_bgcolor">Background Color</label>
                        <div class="preloadx-color-wrap">
                            <input type="color" name="preloadx_bgcolor" id="preloadx_bgcolor" value="<?php echo esc_attr( get_option( 'preloadx_bgcolor', '#000' ) ); ?>" class="preloadx-color-input" />
                            <span class="preloadx-color-hex"><?php echo esc_attr( get_option( 'preloadx_bgcolor', '#000' ) ); ?></span>
                        </div>
                    </div>

                    <div class="preloadx-field" id="gradient-input" style="display: none;">
                        <label for="preloadx_bggradient">Background Gradient</label>
                        <input type="text" name="preloadx_bggradient" id="preloadx_bggradient" value="<?php echo esc_attr( get_option( 'preloadx_bggradient', '' ) ); ?>" placeholder="e.g. linear-gradient(135deg, #1e3a8a, #3b82f6)" class="preloadx-input" />
                        <span class="preloadx-field-hint">Enter any valid CSS linear or radial gradient expression.</span>
                    </div>

                    <div class="preloadx-field" id="image-input" style="display: none;">
                        <label for="preloadx_bgimage">Background Image URL</label>
                        <input type="text" name="preloadx_bgimage" id="preloadx_bgimage" value="<?php echo esc_attr( get_option( 'preloadx_bgimage', '' ) ); ?>" placeholder="https://example.com/background.jpg" class="preloadx-input" />
                        <span class="preloadx-field-hint">Direct link to an image file for full-screen cover.</span>
                    </div>

                    <div class="preloadx-field">
                        <label for="preloadx_color">Preloader Accent Color</label>
                        <div class="preloadx-color-wrap">
                            <input type="color" id="preloadx_color" name="preloadx_color" value="<?php echo esc_attr( get_option( 'preloadx_color', '#3498db' ) ); ?>" class="preloadx-color-input" />
                            <span class="preloadx-color-hex"><?php echo esc_attr( get_option( 'preloadx_color', '#3498db' ) ); ?></span>
                        </div>
                    </div>
                </div>

                <hr class="preloadx-divider" />

                <!-- LOADER DIMENSIONS & TYPOGRAPHY -->
                <div class="preloadx-section-header">
                    <h3>Dimensions & Typography</h3>
                    <p>Fine-tune the size, corner radius, and font scaling of your preloaders in real-time.</p>
                </div>

                <div class="preloadx-form-grid">
                    <?php
                    $preloadx_cp_size_unit = get_option( 'preloadx_loader_size_unit', '%' );
                    $preloadx_cp_default_size = ( $preloadx_cp_size_unit === '%' ) ? '100' : '60';
                    $preloadx_cp_loader_size = get_option( 'preloadx_loader_size', $preloadx_cp_default_size );
                    $preloadx_cp_min_size = ( $preloadx_cp_size_unit === '%' ) ? '10' : '20';
                    $preloadx_cp_max_size = ( $preloadx_cp_size_unit === '%' ) ? '200' : '400';
                    ?>
                    <div class="preloadx-field">
                        <div class="preloadx-slider-header">
                            <label for="preloadx_loader_size">Loader Size</label>
                            <div class="preloadx-unit-toggle">
                                <button type="button" class="preloadx-unit-btn <?php echo ( $preloadx_cp_size_unit === '%' ) ? 'active' : ''; ?>" data-unit="%">%</button>
                                <button type="button" class="preloadx-unit-btn <?php echo ( $preloadx_cp_size_unit === 'px' ) ? 'active' : ''; ?>" data-unit="px">px</button>
                                <input type="hidden" name="preloadx_loader_size_unit" id="preloadx_loader_size_unit" value="<?php echo esc_attr( $preloadx_cp_size_unit ); ?>" />
                            </div>
                            <span class="preloadx-slider-badge" id="preloadx-size-val"><?php echo esc_html( $preloadx_cp_loader_size . $preloadx_cp_size_unit ); ?></span>
                        </div>
                        <input type="range" id="preloadx_loader_size" name="preloadx_loader_size" min="<?php echo esc_attr( $preloadx_cp_min_size ); ?>" max="<?php echo esc_attr( $preloadx_cp_max_size ); ?>" step="1" value="<?php echo esc_attr( $preloadx_cp_loader_size ); ?>" class="preloadx-range-input" />
                        <span class="preloadx-field-hint" id="preloadx-size-hint"><?php echo ( $preloadx_cp_size_unit === '%' ) ? 'Responsive percentage scale (10% to 200%).' : 'Fixed pixel size (20px to 400px+).'; ?></span>
                    </div>

                    <div class="preloadx-field">
                        <div class="preloadx-slider-header">
                            <label for="preloadx_loader_radius">Corner Radius</label>
                            <span class="preloadx-slider-badge" id="preloadx-radius-val"><?php echo esc_html( get_option( 'preloadx_loader_radius', '12' ) ); ?>px</span>
                        </div>
                        <input type="range" id="preloadx_loader_radius" name="preloadx_loader_radius" min="0" max="40" step="1" value="<?php echo esc_attr( get_option( 'preloadx_loader_radius', '12' ) ); ?>" class="preloadx-range-input" />
                        <span class="preloadx-field-hint">Controls corner roundness for square, cube, equalizer, and image loaders.</span>
                    </div>

                    <div class="preloadx-field">
                        <div class="preloadx-slider-header">
                            <label for="preloadx_font_size">Font Size</label>
                            <span class="preloadx-slider-badge" id="preloadx-font-val"><?php echo esc_html( get_option( 'preloadx_font_size', '18' ) ); ?>px</span>
                        </div>
                        <input type="range" id="preloadx_font_size" name="preloadx_font_size" min="12" max="48" step="1" value="<?php echo esc_attr( get_option( 'preloadx_font_size', '18' ) ); ?>" class="preloadx-range-input" />
                        <span class="preloadx-field-hint">Controls typography size in Text Reveal and Progress Bar.</span>
                    </div>
                </div>

                <hr class="preloadx-divider" />

                <div class="preloadx-section-header">
                    <h3>Select Preloader Style</h3>
                    <p>Click on any card to select that preloader animation style.</p>
                </div>

                <div id="preloader-gallery" class="preloadx-gallery-grid">
                    <?php
                    $preloadx_cp_selected = get_option( 'preloadx_selected', 'none' );
                    $preloadx_cp_preloaders = [
                        'none'            => 'None (Disabled)',
                        'classic-spinner' => 'Classic Spinner',
                        'pulse-ring'      => 'Pulse Ring',
                        'double-bounce'   => 'Double Bounce',
                        'wave-dots'       => 'Wave Dots',
                        'spinning-square' => 'Spinning Square',
                        'rotating-chase'  => 'Rotating Chase',
                        'progress-bar'    => 'Real Progress Bar',
                        'equalizer-wave'  => 'Equalizer Wave',
                        'morphing-blob'   => 'Morphing Fluid Blob',
                        'infinity-loop'   => 'Infinity Loop',
                        'isometric-cube'  => '3D Isometric Cube',
                        'orbital-ring'    => '3D Celestial Orbit',
                        'radar-scanner'   => 'Neon Radar Scanner',
                        'text-reveal'     => 'Cinematic Text Reveal',
                        'svg-outline'     => 'SVG Outline Drawing',
                        'custom-image'    => 'Custom Image / Logo'
                    ];

                    foreach ( $preloadx_cp_preloaders as $preloadx_cp_value => $preloadx_cp_label ) {
                        $preloadx_cp_checked = ( $preloadx_cp_selected === $preloadx_cp_value ) ? 'checked' : '';
                        $preloadx_cp_active_class = ( $preloadx_cp_selected === $preloadx_cp_value ) ? 'is-selected' : '';
                        ?>
                        <div class="preloadx-card <?php echo esc_attr( $preloadx_cp_active_class ); ?>" data-value="<?php echo esc_attr( $preloadx_cp_value ); ?>">
                            <div class="preloadx-card-badge">✓</div>
                            <div class="preloadx-card-preview">
                                <?php
                                    if ( class_exists( 'Preloadx_Cp_5199_Utilities' ) ) {
                                        $preloadx_cp_utilities = new Preloadx_Cp_5199_Utilities();                                    
                                        $preloadx_cp_html = $preloadx_cp_utilities->preloadx_get_preloader_html($preloadx_cp_value);
                                        $preloadx_cp_allowed_tags = array(
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
                                        
                                        echo wp_kses($preloadx_cp_html, $preloadx_cp_allowed_tags);
                                    }
                                ?>
                            </div>
                            <div class="preloadx-card-footer">
                                <input type="radio" id="preloadx-loader-<?php echo esc_attr( $preloadx_cp_value ); ?>" name="preloadx_selected" value="<?php echo esc_attr( $preloadx_cp_value ); ?>" <?php echo esc_attr( $preloadx_cp_checked ); ?> class="preloadx-hidden-radio" />
                                <span class="preloadx-card-name">
                                    <?php echo esc_html( $preloadx_cp_label ); ?>
                                </span>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>

                <!-- Conditional Input: Custom Image -->
                <div class="preloadx-conditional-box" id="custom-image-input" style="<?php echo in_array($preloadx_cp_selected, ['custom-image', 'svg-outline'], true) ? 'display:block;' : 'display:none;'; ?>">
                    <div class="preloadx-field">
                        <label for="preloadx_custom_image">Custom Image / Logo URL</label>
                        <input type="text" name="preloadx_custom_image" id="preloadx_custom_image" value="<?php echo esc_attr( get_option( 'preloadx_custom_image', '' ) ); ?>" placeholder="e.g. https://yoursite.com/logo.png" class="preloadx-input" />
                        <span class="preloadx-field-hint">Used as the centered image logo, or as the mask shape for SVG Outline Drawing.</span>
                    </div>
                </div>

                <!-- Conditional Input: Cinematic Text Reveal -->
                <div class="preloadx-conditional-box" id="text-reveal-input" style="<?php echo ($preloadx_cp_selected === 'text-reveal') ? 'display:block;' : 'display:none;'; ?>">
                    <div class="preloadx-field">
                        <label for="preloadx_text_reveal_text">Text to Reveal</label>
                        <input type="text" name="preloadx_text_reveal_text" id="preloadx_text_reveal_text" value="<?php echo esc_attr( get_option( 'preloadx_text_reveal_text', 'LOADING' ) ); ?>" placeholder="e.g. LOADING" class="preloadx-input" />
                        <span class="preloadx-field-hint">Word or brand name to display with a cinematic metallic light sweep.</span>
                    </div>
                </div>
            </div>

            <!-- TAB: DISPLAY RULES -->
            <div id="tab-display" class="preloadx-tab-content" style="display:none;">
                <div class="preloadx-section-header">
                    <h3>Display Rules & Visibility</h3>
                    <p>Control where and when the preloader is shown to visitors.</p>
                </div>

                <div class="preloadx-options-list">
                    <label class="preloadx-toggle-card">
                        <input type="checkbox" name="preloadx_hide_mobile" id="preloadx_hide_mobile" value="1" <?php checked( get_option( 'preloadx_hide_mobile', '0' ), '1' ); ?> />
                        <div class="preloadx-toggle-info">
                            <strong>Hide Preloader on Mobile Devices</strong>
                            <span>Disable the preloader on smartphones and tablets for faster perceived page load times.</span>
                        </div>
                    </label>

                    <label class="preloadx-toggle-card">
                        <input type="checkbox" name="preloadx_homepage_only" id="preloadx_homepage_only" value="1" <?php checked( get_option( 'preloadx_homepage_only', '0' ), '1' ); ?> />
                        <div class="preloadx-toggle-info">
                            <strong>Show Preloader ONLY on Homepage</strong>
                            <span>Only show the preloader when visitors arrive on the homepage / front page, and bypass for sub-pages.</span>
                        </div>
                    </label>
                </div>
            </div>

            <!-- TAB: ADVANCED -->
            <div id="tab-advanced" class="preloadx-tab-content" style="display:none;">
                <div class="preloadx-section-header">
                    <h3>Transitions & Timeout Handling</h3>
                    <p>Customize smooth exit transitions and safeguard user experience.</p>
                </div>

                <div class="preloadx-form-grid">
                    <div class="preloadx-field">
                        <label for="preloadx_exit_animation">Exit Transition Animation</label>
                        <select id="preloadx_exit_animation" name="preloadx_exit_animation" class="preloadx-select">
                            <option value="fade" <?php selected( get_option( 'preloadx_exit_animation', 'fade' ), 'fade' ); ?>>Fade Out</option>
                            <option value="slide-up" <?php selected( get_option( 'preloadx_exit_animation', 'fade' ), 'slide-up' ); ?>>Slide Up</option>
                            <option value="split" <?php selected( get_option( 'preloadx_exit_animation', 'fade' ), 'split' ); ?>>Curtain Split</option>
                            <option value="diagonal-wipe" <?php selected( get_option( 'preloadx_exit_animation', 'fade' ), 'diagonal-wipe' ); ?>>Diagonal Wipe</option>
                            <option value="scale-out" <?php selected( get_option( 'preloadx_exit_animation', 'fade' ), 'scale-out' ); ?>>Scale Out</option>
                        </select>
                        <span class="preloadx-field-hint">How the preloader screen animates away when the page finishes loading.</span>
                    </div>

                    <div class="preloadx-field">
                        <label for="preloadx_min_load_time">Minimum Load Time (milliseconds)</label>
                        <input type="number" id="preloadx_min_load_time" name="preloadx_min_load_time" value="<?php echo esc_attr( get_option( 'preloadx_min_load_time', '500' ) ); ?>" min="0" step="100" class="preloadx-input" />
                        <span class="preloadx-field-hint">Prevents animations from flashing too quickly on fast connections (e.g. 500ms).</span>
                    </div>
                </div>

                <div class="preloadx-options-list" style="margin-top: 20px;">
                    <label class="preloadx-toggle-card">
                        <input type="checkbox" name="preloadx_close_button" id="preloadx_close_button" value="1" <?php checked( get_option( 'preloadx_close_button', '0' ), '1' ); ?> />
                        <div class="preloadx-toggle-info">
                            <strong>Enable Fallback "Close" Button</strong>
                            <span>Shows an emergency "Close" button after 5 seconds if a slow script or asset causes the page to hang.</span>
                        </div>
                    </label>
                </div>
            </div>

            <!-- ACTION BAR -->
            <div class="preloadx-action-bar">
                <input type="hidden" name="action" value="preloadx_set_options" />
                <button type="submit" class="preloadx-save-btn">
                    <span class="dashicons dashicons-saved"></span> Save Changes
                </button>
                <div id="preloadx-settings-response-message" style="display: none;"></div>
            </div>
        </form>
    </div>

    <div class="preloadx-admin-footer">
        <p>Built with <span class="heart">&#10084;</span> by <a href="https://vishwas.me" target="_blank" rel="noopener noreferrer">Vishwas</a></p>
    </div>
</div>