<?php
/**
 * Settings screen for FancyBox for WordPress.
 *
 * @package FancyBox_For_WordPress
 */

defined( 'ABSPATH' ) || exit;

function mfbfw_options_page() {

	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( esc_html__( 'You do not have permission to access this page.', 'fancybox-for-wordpress' ) );
	}

	require_once FBFW_PATH . 'lib/admin-head.php';

	?>

    <div class="wrap about-wrap fbfw-wrap">
        <div id="icon-plugins" class="icon32"></div>
        <div class="inlined">
            <div id="pluginDescription">
                <h1>
					<?php
					printf(
						/* translators: %s: Plugin version number. */
						esc_html__( 'Fancybox for WordPress (version %s)', 'fancybox-for-wordpress' ),
						esc_html( FBFW_VERSION )
					);
					?>
                </h1>
                <p class="about-text"><?php esc_html_e( 'Seamlessly integrates FancyBox into your blog: Upload, activate, and you\'re done. Additional configuration optional.', 'fancybox-for-wordpress' ); ?></p>
            </div>
        </div>

        <br/>

        <form method="post" action="options.php" id="options">

			<?php settings_fields( 'mfbfw-options' ); ?>

            <div id="fbfwTabs">
                <ul class="nav-tab-wrapper wp-clearfix">
                    <li><a href="#fbfw-appearance"><?php esc_html_e( 'Appearance', 'fancybox-for-wordpress' ); ?></a></li>
                    <li><a href="#fbfw-animations"><?php esc_html_e( 'Animations', 'fancybox-for-wordpress' ); ?></a></li>
                    <li><a href="#fbfw-behaviour"><?php esc_html_e( 'Behaviour', 'fancybox-for-wordpress' ); ?></a></li>
                    <li><a href="#fbfw-galleries"><?php esc_html_e( 'Galleries', 'fancybox-for-wordpress' ); ?></a></li>
                    <li><a href="#fbfw-other"><?php esc_html_e( 'Misc.', 'fancybox-for-wordpress' ); ?></a></li>
                    <li><a href="#fbfw-support" style="color:green;"><?php esc_html_e( 'Support', 'fancybox-for-wordpress' ); ?></a></li>
                </ul>

                <div id="fbfw-appearance">
					<?php require FBFW_PATH . 'lib/admin-tab-appearance.php'; ?>
                </div>

                <div id="fbfw-animations">
					<?php require FBFW_PATH . 'lib/admin-tab-animations.php'; ?>
                </div>

                <div id="fbfw-behaviour">
					<?php require FBFW_PATH . 'lib/admin-tab-behaviour.php'; ?>
                </div>

                <div id="fbfw-galleries">
					<?php require FBFW_PATH . 'lib/admin-tab-galleries.php'; ?>
                </div>

                <div id="fbfw-other">
					<?php require FBFW_PATH . 'lib/admin-tab-other.php'; ?>
                </div>

                <div id="fbfw-support">
					<?php require FBFW_PATH . 'lib/admin-tab-support.php'; ?>
                </div>

            </div>

            <p class="submit" style="text-align:center;">
                <input type="submit" name="mfbfw_update" class="button-primary"
                       value="<?php esc_attr_e( 'Save Changes', 'fancybox-for-wordpress' ); ?>"/>
            </p>

        </form>

        <form method="post" action="">
            <div style="text-align:center;padding:0 0 1.5em;margin:-15px 0 5px;">
				<?php wp_nonce_field( 'mfbfw-options-reset' ); ?>
                <input type="submit" name="mfbfw_update" id="reset"
                       class="button-secondary" value="<?php esc_attr_e( 'Revert to defaults', 'fancybox-for-wordpress' ); ?>"/>
                <input type="hidden" name="action" value="reset"/>
            </div>
        </form>

        <div id="mfbfwd"
             style="border-top:1px dashed #DDDDDD;margin:20px 0 40px;overflow:hidden;padding-top:25px;width:100%;float:left;display:block !important;">
			<?php
			printf(
				/* translators: %s: Colorlib link. */
				esc_html__( 'Plugin developed and supported by %s', 'fancybox-for-wordpress' ),
				'<a href="https://colorlib.com">Colorlib</a>'
			);
			?>
        </div>

    </div>

	<?php
}
