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
                                    if ( class_exists( 'Preloadx_Custom_Preloader_Utilities' ) ) {
                                        $preloader_utilities = new Preloadx_Custom_Preloader_Utilities();                                    
                                        $preloader_html = $preloader_utilities->preloadx_get_preloader_html($value);
                                        echo $preloader_html;
                                        add_action('wp_head', $preloader_utilities->add_inline_root_styles());
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
            <input type="hidden" name="preloadx_nonce_field" value="<?php echo wp_create_nonce( 'preloadx_nonce_action' ); ?>" />

            <?php submit_button(); ?>
            <div id="preloadx-settings-response-message" style="display: none; padding: 10px; margin: 10px 0; border-radius: 5px; font-weight: bold;"></div>
        </form>
    </div>
    <div id="footer">
        <p>Built with <span class="heart">&#10084;</span> | <a href="https://vishwas.me" target="_blank">Vishwas</a></p>
    </div>
</div>

<script>
		jQuery("#preloadx-settings-form").on("submit", function(e) {
            e.preventDefault();
            var formData = new FormData(jQuery(this)[0]);
            var value = Object.fromEntries(formData.entries());

            jQuery.ajax({
                type: 'POST',
                url: '<?php echo admin_url('admin-ajax.php'); ?>',
                dataType: 'json',
                data: {
                    ...value,
                    action: 'preloadx_set_options',
                    preloadx_nonce_field: jQuery('[name="preloadx_nonce_field"]').val()
                },
                success: function(response) {
                    jQuery('#preloadx-settings-response-message').hide();
                    if (response.success) {
                        jQuery('#preloadx-settings-response-message').text(response.data).removeClass('error').addClass('success').show();
                    } else {
                        jQuery('#preloadx-settings-response-message').text(response.data).removeClass('success').addClass('error').show();
                    }
                    setTimeout(function() {
                        jQuery('#preloadx-settings-response-message').fadeOut();
                    }, 10000);
                },
                error: function(error) {
                    console.log(error);
                    jQuery('#preloadx-settings-response-message').text('An error occurred, please try again.').removeClass('success').addClass('error').show();
                    setTimeout(function() {
                        jQuery('#preloadx-settings-response-message').fadeOut();
                    }, 10000);
                }
            });
        });

	</script>
