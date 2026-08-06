<?php
/**
 * Runs when the plugin is deleted from the Plugins screen.
 *
 * Deactivation already honours the "Remove settings" option, but a user who deletes
 * the plugin outright never triggers it, so the rows used to be left behind forever.
 *
 * @package FancyBox_For_WordPress
 * @since 3.4.0
 */

defined( 'WP_UNINSTALL_PLUGIN' ) || exit;

$mfbfw_settings = get_option( 'mfbfw' );

if ( is_array( $mfbfw_settings ) && ! empty( $mfbfw_settings['uninstall'] ) ) {
	delete_option( 'mfbfw' );
	delete_option( 'mfbfw_active_version' );
	delete_option( 'mfbfw-rate-time' );
}
