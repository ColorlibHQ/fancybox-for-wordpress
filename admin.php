<?php

function mfbfw_options_page() {
	require_once( FBFW_PATH . 'lib/admin-head.php' );

	?>

    <div class="wrap about-wrap fbfw-wrap">
        <div id="icon-plugins" class="icon32"></div>
        <div class="inlined">
            <div id="pluginDescription">
                <h1><?php printf( __( 'Fancybox for WordPress (version %s)', 'mfbfw' ), FBFW_VERSION ); ?></h1>
                <p class="about-text">Seamlessly integrates FancyBox into your blog: Upload, activate, and you’re done. Additional configuration optional.</p>
            </div>
        </div>

        <br/>

        <form method="post" action="options.php" id="options">

			<?php settings_fields( 'mfbfw-options' ); ?>

            <div id="fbfwTabs">
                <ul class="nav-tab-wrapper wp-clearfix">
                    <li><a href="#fbfw-appearance"><?php _e( 'Appearance', 'mfbfw' ); ?></a></li>
                    <li><a href="#fbfw-animations"><?php _e( 'Animations', 'mfbfw' ); ?></a></li>
                    <li><a href="#fbfw-behaviour"><?php _e( 'Behaviour', 'mfbfw' ); ?></a></li>
                    <li><a href="#fbfw-galleries"><?php _e( 'Galleries', 'mfbfw' ); ?></a></li>
                    <li><a href="#fbfw-other"><?php _e( 'Misc.', 'mfbfw' ); ?></a></li>
                    <li><a href="#fbfw-support" style="color:green;"><?php _e( 'Support', 'mfbfw' ); ?></a></li>
                </ul>

                <div id="fbfw-appearance">
					<?php require_once( FBFW_PATH . 'lib/admin-tab-appearance.php' ); ?>
                </div>

                <div id="fbfw-animations">
					<?php require_once( FBFW_PATH . 'lib/admin-tab-animations.php' ); ?>
                </div>

                <div id="fbfw-behaviour">
					<?php require_once( FBFW_PATH . 'lib/admin-tab-behaviour.php' ); ?>
                </div>

                <div id="fbfw-galleries">
					<?php require_once( FBFW_PATH . 'lib/admin-tab-galleries.php' ); ?>
                </div>

                <div id="fbfw-other">
					<?php require_once( FBFW_PATH . 'lib/admin-tab-other.php' ); ?>
                </div>

                <div id="fbfw-support">
					<?php require_once( FBFW_PATH . 'lib/admin-tab-support.php' ); ?>
                </div>

            </div>

            <p class="submit" style="text-align:center;">
                <input type="submit" name="mfbfw_update" class="button-primary"
                       value="<?php esc_attr_e( 'Save Changes', 'mfbfw' ); ?>"/>
            </p>

        </form>

        <form method="post" action="">
            <div style="text-align:center;padding:0 0 1.5em;margin:-15px 0 5px;">
				<?php wp_nonce_field( 'mfbfw-options-reset' ); ?>
                <input type="submit" name="mfbfw_update" id="reset" onClick="return confirmDefaults();"
                       class="button-secondary" value="<?php esc_attr_e( 'Revert to defaults', 'mfbfw' ); ?>"/>
                <input type="hidden" name="action" value="reset"/>
            </div>

            <div id="mfbfwd"
                 style="border-top:1px dashed #DDDDDD;margin:20px 0 40px;overflow:hidden;padding-top:25px;width:100%;float:left;display:block !important;">

                Plugin developed and supported by <a href="https://colorlib.com">Colorlib</a>

            </div>

    </div>
    
    <div class="modula-wrap">
        <a target="_blank" href="http://wp-modula.com/?utm_source=fancybox-for-wp&utm_medium=options-page&utm_campaign=Modula%20Lite" class="modula-link">
        <img src="<?php echo FBFW_URL; ?>assets/images/modula-300x300.jpg"/>
        <h2>Easy Image Gallery for WP</h2>
        <p>Modula is creative! Modula is dynamic! Modula doesn’t always look the same. Just have fun with it! Modula uses a new concept to build its internal grid. The result is a dynamic, creative, interesting and attractive gallery.</p>

        <?php

        $plugin_slug = 'modula-best-grid-gallery';
        $plugin_path = 'modula-best-grid-gallery/Modula.php';

        $installed = false;
        $activated = false;
        if ( file_exists( ABSPATH . 'wp-content/plugins/' . $plugin_slug ) ) {
            $installed = true;
        }

        if ( file_exists( ABSPATH . 'wp-content/plugins/' . $plugin_path ) ) {
            include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
            if ( is_plugin_active( $plugin_path ) ) {
                $activated = true;
            }
        }

        if ( ! $activated ) {
           
            if ( ! $installed ) {
                $label = esc_html__( 'Install & Activate Modula', 'mfbfw' );
                $link = wp_nonce_url(
                    add_query_arg(
                        array(
                            'action' => 'install-plugin',
                            'plugin' => $plugin_slug,
                        ),
                        network_admin_url( 'update.php' )
                    ),
                    'install-plugin_' . $plugin_slug
                );
                $action = 'install';
            }else{
                $label = esc_html__( 'Activate Modula', 'mfbfw' );
                $link = add_query_arg(
                    array(
                        'action'        => 'activate',
                        'plugin'        => rawurlencode( $plugin_path ),
                        'plugin_status' => 'all',
                        'paged'         => '1',
                        '_wpnonce'      => wp_create_nonce( 'activate-plugin_' . $plugin_path ),
                    ),
                    admin_url( 'plugins.php' )
                );
                $action = 'activate';
            }

            echo '<a href="' . esc_url( $link ) . '" class="mfbfw-modula-link button button-primary button-large" data-action="' . esc_attr( $action ) . '">' . esc_html( $label ) . '</a>';

        }

        ?>

        </a>
    </div>
   

	<?php
}

?>
