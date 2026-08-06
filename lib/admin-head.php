<?php
/**
 * Shared setup for the settings tabs.
 *
 * Every lib/admin-tab-*.php partial is included after this file and reads the
 * variables it defines, so they are not self-contained.
 *
 * @package FancyBox_For_WordPress
 */

defined( 'ABSPATH' ) || exit;

if ( isset( $_REQUEST['reset'] ) && sanitize_text_field( wp_unslash( $_REQUEST['reset'] ) ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- read-only notice; the reset itself is nonce-checked in mfbfw_admin_options().
	echo '<div id="message" class="notice notice-success is-dismissible"><p><strong>'
		. esc_html__( 'FancyBox for WordPress settings have been reset.', 'fancybox-for-wordpress' )
		. '</strong></p></div>';
}

/*
 * Resolved settings: every key is present and already normalized to its declared
 * type. This used to call the save-time sanitizer on read, which is now an
 * allow-list and would drop anything it did not recognise.
 */
$settings = mfbfw_get_settings();

// Get Version
$version = get_option( 'mfbfw_active_version' );

// Make selects data
$transitionTypeArray = array( 'fade', 'zoom', 'zoom-in-out', 'none' );
$overlayArray        = array( 0.1, 0.2, 0.3, 0.4, 0.5, 0.6, 0.7, 0.8, 0.9, 1 );
$msArray             = array( 0, 25, 50, 75, 100, 200, 300, 400, 500, 600, 700, 800, 900, 1000, 1250, 1500, 1750, 2000 );
$slideEffectArray    = array( 'false', 'fade', 'slide', 'circular', 'tube', 'zoom-in-out', 'rotate' );
