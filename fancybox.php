<?php
/**
* Plugin Name: FancyBox for WordPress
* Plugin URI: https://wordpress.org/plugins/fancybox-for-wordpress/
* Description: Integrates <a href="http://fancyapps.com/fancybox/3/">FancyBox 3</a> into WordPress.
* Version: 3.4.0
* Author: Colorlib
* Author URI: https://colorlib.com/wp/
* Tested up to: 7.0
* Requires at least: 5.6
* License: GPLv3 or later
* License URI: https://www.gnu.org/licenses/gpl-3.0.html
* Requires PHP: 7.4
* Text Domain: fancybox-for-wordpress
* Domain Path: /languages
*
* Copyright 2008-2016 	Janis Skarnelis 	https://twitter.com/moskis/
* Copyright 2016-2026 	Colorlib 			support@colorlib.com
*
* This program is free software; you can redistribute it and/or modify
* it under the terms of the GNU General Public License, version 3, as
* published by the Free Software Foundation.
*
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.
*
* You should have received a copy of the GNU General Public License
* along with this program; if not, write to the Free Software
* Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

defined( 'ABSPATH' ) || exit;

/**
 * Plugin Init
 */
// Constants
define( 'FBFW_VERSION', '3.4.0' );
define( 'FBFW_PATH', plugin_dir_path( __FILE__ ) );
define( 'FBFW_URL', plugin_dir_url( __FILE__ ) );
define( 'FBFW_PLUGIN_BASE', plugin_basename( __FILE__ ) );
define( 'FBFW_PREVIOUS_PLUGIN_VERSION', '3.0.14' );
define( 'FBFW_FILE_', __FILE__ );
define( 'FBFW_SLUG', 'fancybox-for-wordpress' );

// Historically declared unprefixed, which collides with any other plugin doing the
// same. Kept for backwards compatibility, but never redefined if someone won the race.
if ( ! defined( 'PLUGIN_NAME' ) ) {
	define( 'PLUGIN_NAME', FBFW_SLUG );
}

include 'class-fancybox-review.php';

/**
 * Describes every option: its default and how it must be normalized.
 *
 * This single table drives the defaults, the save-time sanitizer and the read-time
 * normalizer, so a value can never reach the page in a shape the output code did
 * not expect.
 *
 * Types:
 *  - toggle : stored as 'on' or '' (any legacy truthy value normalizes to 'on')
 *  - color  : #rgb / #rrggbb, falls back to the default when invalid
 *  - int    : absint, clamped to 'max'
 *  - float  : clamped between 'min' and 'max'
 *  - choice : must be one of 'choices'
 *  - js     : raw JavaScript supplied by an administrator
 *
 * @since 3.4.0
 *
 * @return array<string, array<string, mixed>>
 */
function mfbfw_option_schema() {

	static $schema = null;

	if ( null !== $schema ) {
		return $schema;
	}

	$schema = array(
		// Appearance.
		'border'                     => array( 'type' => 'toggle', 'default' => '' ),
		'borderColor'                => array( 'type' => 'color', 'default' => '#BBBBBB' ),
		'paddingColor'               => array( 'type' => 'color', 'default' => '#FFFFFF' ),
		'padding'                    => array( 'type' => 'int', 'default' => 10, 'max' => 200 ),
		'overlayShow'                => array( 'type' => 'toggle', 'default' => 'on' ),
		'overlayColor'               => array( 'type' => 'color', 'default' => '#666666' ),
		'overlayOpacity'             => array( 'type' => 'float', 'default' => 0.3, 'min' => 0, 'max' => 1 ),
		'titleShow'                  => array( 'type' => 'toggle', 'default' => 'on' ),
		'captionShow'                => array( 'type' => 'toggle', 'default' => '' ),
		'titlePosition'              => array( 'type' => 'choice', 'default' => 'inside', 'choices' => array( 'inside', 'over', 'float', 'outside' ) ),
		'titleColor'                 => array( 'type' => 'color', 'default' => '#333333' ),
		'showNavArrows'              => array( 'type' => 'toggle', 'default' => 'on' ),
		'disableOnMobile'            => array( 'type' => 'toggle', 'default' => '' ),
		'titleSize'                  => array( 'type' => 'int', 'default' => 14, 'max' => 200 ),
		'showCloseButton'            => array( 'type' => 'toggle', 'default' => '' ),
		'showToolbar'                => array( 'type' => 'toggle', 'default' => 'on' ),

		// Animations.
		'zoomOpacity'                => array( 'type' => 'toggle', 'default' => 'on' ),
		'zoomSpeedIn'                => array( 'type' => 'int', 'default' => 500, 'max' => 10000 ),
		'zoomSpeedChange'            => array( 'type' => 'int', 'default' => 300, 'max' => 10000 ),
		'transitionIn'               => array( 'type' => 'choice', 'default' => 'fade', 'choices' => array( 'fade', 'zoom', 'zoom-in-out', 'none' ) ),
		'transitionEffect'           => array( 'type' => 'choice', 'default' => 'fade', 'choices' => array( 'false', 'fade', 'slide', 'circular', 'tube', 'zoom-in-out', 'rotate' ) ),

		// Behaviour.
		'hideOnOverlayClick'         => array( 'type' => 'toggle', 'default' => 'on' ),
		'hideOnContentClick'         => array( 'type' => 'toggle', 'default' => '' ),
		'zoomOnClick'                => array( 'type' => 'toggle', 'default' => '' ),
		'enableEscapeButton'         => array( 'type' => 'toggle', 'default' => 'on' ),
		'cyclic'                     => array( 'type' => 'toggle', 'default' => '' ),
		'mouseWheel'                 => array( 'type' => 'toggle', 'default' => '' ),
		'disableWoocommercePages'    => array( 'type' => 'toggle', 'default' => '' ),
		'disableWoocommerceProducts' => array( 'type' => 'toggle', 'default' => '' ),
		'exclude_pdf'                => array( 'type' => 'toggle', 'default' => '' ),

		// Gallery type.
		'galleryType'                => array( 'type' => 'choice', 'default' => 'all', 'choices' => array( 'all', 'post', 'none', 'single_gutenberg_block', 'custom' ) ),
		'customExpression'           => array( 'type' => 'js', 'default' => 'jQuery(thumbnails).attr("data-fancybox","gallery").getTitle();' ),

		// Misc.
		'autoDimensions'             => array( 'type' => 'toggle', 'default' => 'on' ),
		'frameWidth'                 => array( 'type' => 'int', 'default' => 560, 'max' => 10000 ),
		'frameHeight'                => array( 'type' => 'int', 'default' => 340, 'max' => 10000 ),
		'loadAtFooter'               => array( 'type' => 'toggle', 'default' => '' ),
		'callbackEnable'             => array( 'type' => 'toggle', 'default' => '' ),
		'callbackOnStart'            => array( 'type' => 'js', 'default' => 'function() { alert("Start!"); }' ),
		'callbackOnCancel'           => array( 'type' => 'js', 'default' => 'function() { alert("Cancel!"); }' ),
		'callbackOnComplete'         => array( 'type' => 'js', 'default' => 'function() { alert("Complete!"); }' ),
		'callbackOnCleanup'          => array( 'type' => 'js', 'default' => 'function() { alert("CleanUp!"); }' ),
		'callbackOnClose'            => array( 'type' => 'js', 'default' => 'function() { alert("Close!"); }' ),
		'nojQuery'                   => array( 'type' => 'toggle', 'default' => '' ),
		'extraCallsEnable'           => array( 'type' => 'toggle', 'default' => '' ),
		'extraCallsData'             => array( 'type' => 'js', 'default' => '' ),
		'uninstall'                  => array( 'type' => 'toggle', 'default' => '' ),

		/*
		 * Regenerated on every request by mfbfw_title_copy_js(); the stored value is
		 * ignored. Kept in the schema so upgrades from <3.4.0 do not lose the row.
		 */
		'copyTitleFunction'          => array( 'type' => 'js', 'default' => '' ),

		/*
		 * Legacy keys from the FancyBox 1.x era. They have no UI any more, but sites
		 * upgraded from those versions still carry them and their CSS is still
		 * honoured, so they must survive sanitization.
		 */
		'borderRadius'               => array( 'type' => 'int', 'default' => null, 'max' => 200, 'optional' => true ),
		'borderRadiusInner'          => array( 'type' => 'int', 'default' => null, 'max' => 200, 'optional' => true ),
		'shadowSize'                 => array( 'type' => 'int', 'default' => null, 'max' => 200, 'optional' => true ),
		'shadowOffset'               => array( 'type' => 'int', 'default' => null, 'max' => 200, 'optional' => true ),
		'shadowOpacity'              => array( 'type' => 'float', 'default' => null, 'min' => 0, 'max' => 1, 'optional' => true ),
		'easing'                     => array( 'type' => 'toggle', 'default' => null, 'optional' => true ),
		'wheel'                      => array( 'type' => 'toggle', 'default' => null, 'optional' => true ),
	);

	return $schema;
}

/**
 * Store default settings in an array
 */
function mfbfw_defaults() {

	$defaults = array();

	foreach ( mfbfw_option_schema() as $key => $spec ) {
		if ( ! empty( $spec['optional'] ) ) {
			continue;
		}
		$defaults[ $key ] = $spec['default'];
	}

	// Historically stored as ints; keep them strings so a strict-comparing theme
	// that predates 3.4.0 keeps working.
	foreach ( array( 'padding', 'titleSize', 'zoomSpeedIn', 'zoomSpeedChange', 'frameWidth', 'frameHeight' ) as $key ) {
		$defaults[ $key ] = (string) $defaults[ $key ];
	}
	$defaults['overlayOpacity'] = '0.3';

	return $defaults;
}

/**
 * Validate a hex colour without depending on load order of wp-admin includes.
 *
 * @since 3.4.0
 *
 * @param mixed  $color    Raw value.
 * @param string $fallback Returned when $color is not a valid hex colour.
 * @return string
 */
function mfbfw_sanitize_hex_color( $color, $fallback = '' ) {

	if ( ! is_scalar( $color ) ) {
		return $fallback;
	}

	$color = trim( (string) $color );

	if ( '' === $color ) {
		return $fallback;
	}

	if ( '#' !== $color[0] ) {
		$color = '#' . $color;
	}

	return preg_match( '/^#([A-Fa-f0-9]{3}){1,2}$/', $color ) ? $color : $fallback;
}

/**
 * Normalize a checkbox-style option to 'on' or ''.
 *
 * Older versions stored arbitrary truthy values here (hideOnOverlayClick held a
 * whole JavaScript function), so anything non-empty counts as enabled.
 *
 * @since 3.4.0
 *
 * @param mixed $value Raw value.
 * @return string
 */
function mfbfw_normalize_toggle( $value ) {

	if ( is_string( $value ) ) {
		$value = trim( $value );

		if ( '' === $value || '0' === $value || 'off' === $value || 'false' === $value ) {
			return '';
		}

		return 'on';
	}

	return $value ? 'on' : '';
}

/**
 * Coerce one raw option value into the shape its schema entry promises.
 *
 * @since 3.4.0
 *
 * @param mixed $value Raw value.
 * @param array $spec  Schema entry.
 * @return mixed
 */
function mfbfw_normalize_value( $value, array $spec ) {

	switch ( $spec['type'] ) {
		case 'toggle':
			return mfbfw_normalize_toggle( $value );

		case 'color':
			return mfbfw_sanitize_hex_color( $value, (string) $spec['default'] );

		case 'int':
			// Falling back to the default rather than to absint()'s 0 keeps a garbled
			// value from silently disabling animations or collapsing the padding.
			$value = is_numeric( $value ) ? absint( $value ) : (int) $spec['default'];
			if ( isset( $spec['max'] ) ) {
				$value = min( $value, (int) $spec['max'] );
			}
			return $value;

		case 'float':
			$value = is_numeric( $value ) ? (float) $value : (float) $spec['default'];
			if ( isset( $spec['min'] ) ) {
				$value = max( $value, (float) $spec['min'] );
			}
			if ( isset( $spec['max'] ) ) {
				$value = min( $value, (float) $spec['max'] );
			}
			return $value;

		case 'choice':
			return in_array( $value, $spec['choices'], true ) ? $value : $spec['default'];

		case 'js':
			return is_scalar( $value ) ? wp_strip_all_tags( (string) $value ) : '';
	}

	return $value;
}

/**
 * Return a complete, normalized settings array.
 *
 * Every consumer goes through here, so output code can rely on every key existing
 * and holding a value of the expected type. Previously the raw option was used
 * directly, which produced a wall of "undefined array key" warnings on PHP 8 (and a
 * fatal when the row was not an array at all).
 *
 * @since 3.4.0
 *
 * @param mixed $raw Optional raw settings to normalize instead of reading the option.
 * @return array
 */
function mfbfw_get_settings( $raw = null ) {

	static $cache = null;

	$use_cache = ( null === $raw );

	if ( $use_cache && null !== $cache ) {
		return $cache;
	}

	if ( null === $raw ) {
		$raw = get_option( 'mfbfw' );
	}

	// A corrupted row (empty string, bool, serialized scalar) used to fatal here.
	if ( ! is_array( $raw ) ) {
		$raw = array();
	}

	$schema   = mfbfw_option_schema();
	$settings = array();

	foreach ( $schema as $key => $spec ) {
		if ( array_key_exists( $key, $raw ) ) {
			$settings[ $key ] = mfbfw_normalize_value( $raw[ $key ], $spec );
		} elseif ( empty( $spec['optional'] ) ) {
			$settings[ $key ] = $spec['default'];
		}
	}

	// Preserve unknown keys so third-party code that stashes data here keeps working.
	foreach ( $raw as $key => $value ) {
		if ( ! isset( $schema[ $key ] ) ) {
			$settings[ $key ] = $value;
		}
	}

	/**
	 * Filters the resolved FancyBox settings.
	 *
	 * @since 3.4.0
	 *
	 * @param array $settings Normalized settings.
	 */
	$settings = apply_filters( 'mfbfw_settings', $settings );

	if ( $use_cache ) {
		$cache = $settings;
	}

	return $settings;
}

/**
 * Whether a checkbox-style option is enabled.
 *
 * @since 3.4.0
 *
 * @param string     $key      Option key.
 * @param array|null $settings Optional settings array.
 * @return bool
 */
function mfbfw_is_on( $key, $settings = null ) {

	if ( ! is_array( $settings ) ) {
		$settings = mfbfw_get_settings();
	}

	return isset( $settings[ $key ] ) && '' !== $settings[ $key ] && $settings[ $key ];
}

// Populate the historical globals. Third-party code reads $mfbfw directly, so it
// stays available - but it now always holds a complete array.
$mfbfw         = mfbfw_get_settings();
$mfbfw_version = get_option( 'mfbfw_active_version' );

/**
 * Create or migrate the stored settings.
 *
 * Runs on plugins_loaded rather than at include time so the write happens once WordPress
 * is fully bootstrapped, and on the front end as well as in wp-admin. The old
 * admin-only guard meant a site whose first request after an update was a front-end
 * hit ran the whole page render against a settings array missing every new key.
 *
 * @since 3.4.0
 */
function mfbfw_maybe_upgrade_settings() {

	$stored  = get_option( 'mfbfw' );
	$version = get_option( 'mfbfw_active_version' );

	if ( ! is_array( $stored ) ) {
		update_option( 'mfbfw', mfbfw_defaults() );
		update_option( 'mfbfw_active_version', FBFW_VERSION );

		return;
	}

	if ( $version && version_compare( $version, FBFW_VERSION, '>=' ) ) {
		return;
	}

	// Existing values win; only genuinely new keys pick up a default.
	update_option( 'mfbfw', $stored + mfbfw_defaults() );
	update_option( 'mfbfw_active_version', FBFW_VERSION );
}

add_action( 'plugins_loaded', 'mfbfw_maybe_upgrade_settings' );

/**
 * If requested, when plugin is deactivated, remove settings
 */
function mfbfw_deactivate() {

	if ( mfbfw_is_on( 'uninstall' ) ) {
		delete_option( 'mfbfw' );
		delete_option( 'mfbfw_active_version' );
		delete_option( 'mfbfw-rate-time' );
	}
}

register_deactivation_hook( __FILE__, 'mfbfw_deactivate' );

/**
 * Whether the lightbox should run for the current request.
 *
 * @since 3.4.0
 *
 * @return bool
 */
function mfbfw_is_enabled() {

	$enabled = true;

	if ( mfbfw_is_on( 'disableOnMobile' ) && wp_is_mobile() ) {
		$enabled = false;
	}

	$woocommerce = fancy_check_if_woocommerce();

	if ( 'product' === $woocommerce && mfbfw_is_on( 'disableWoocommerceProducts' ) ) {
		$enabled = false;
	}

	if ( 'shop_page' === $woocommerce && mfbfw_is_on( 'disableWoocommercePages' ) ) {
		$enabled = false;
	}

	/**
	 * Filters whether FancyBox loads on the current request.
	 *
	 * @since 3.4.0
	 *
	 * @param bool $enabled Whether to load.
	 */
	return (bool) apply_filters( 'mfbfw_is_enabled', $enabled );
}

/**
 * Path suffix for minified assets, unless SCRIPT_DEBUG asks for readable sources.
 *
 * @since 3.4.0
 *
 * @return string
 */
function mfbfw_asset_suffix() {

	return ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
}

/**
 * Load FancyBox JS with jQuery and
 */
function mfbfw_enqueue_scripts() {

	if ( ! mfbfw_is_enabled() ) {
		return;
	}

	$settings = mfbfw_get_settings();
	$footer   = mfbfw_is_on( 'loadAtFooter', $settings );
	$suffix   = mfbfw_asset_suffix();

	// Troubleshooting switch: skip the jQuery dependency when it is loaded elsewhere.
	$deps = mfbfw_is_on( 'nojQuery', $settings ) ? array( 'fbfw-purify' ) : array( 'jquery', 'fbfw-purify' );

	wp_register_script( 'fbfw-purify', FBFW_URL . 'assets/js/purify' . $suffix . '.js', array(), FBFW_VERSION, $footer );
	wp_register_script( 'fancybox-for-wp', FBFW_URL . 'assets/js/jquery.fancybox' . $suffix . '.js', $deps, FBFW_VERSION, $footer );

	wp_enqueue_script( 'fancybox-for-wp' );

	wp_register_style( 'fancybox-for-wp', FBFW_URL . 'assets/css/fancybox' . $suffix . '.css', array(), FBFW_VERSION );
	wp_enqueue_style( 'fancybox-for-wp' );
}

add_action( 'wp_enqueue_scripts', 'mfbfw_enqueue_scripts' );

/**
 * Build the inline stylesheet from the stored settings.
 *
 * Every interpolated value has already been through the schema normalizer, so
 * colours are known-good hex and sizes are integers. That closes the CSS injection
 * that `esc_html()` did not - it only blocks `<`, so a value like
 * `blue}body{display:none}` used to escape its own declaration block.
 *
 * @since 3.4.0
 *
 * @param array $s Normalized settings.
 * @return string
 */
function mfbfw_build_css( array $s ) {

	$padding_color = $s['paddingColor'];
	$title_color   = $s['titleColor'];
	$position      = $s['titlePosition'];
	$title_inside  = ( 'inside' === $position );

	$rules = array();

	$rules[] = '.fancybox-slide--image .fancybox-content{background-color:' . $padding_color . '}';

	if ( 'inside' === $position || 'over' === $position ) {
		$rules[] = 'div.fancybox-caption{display:none !important;}';
	}

	$rules[] = 'img.fancybox-image{border-width:' . $s['padding'] . 'px;border-color:' . $padding_color . ';border-style:solid;}';

	if ( mfbfw_is_on( 'overlayShow', $s ) ) {
		$rules[] = 'div.fancybox-bg{background-color:' . mfbfw_hex_to_rgba( $s['overlayColor'], $s['overlayOpacity'] ) . ';opacity:1 !important;}';
	} else {
		$rules[] = 'div.fancybox-bg{background:transparent !important;}';
	}

	$rules[] = 'div.fancybox-content{border-color:' . $padding_color . '}';

	if ( $title_inside ) {
		$rules[] = 'div#fancybox-title{background-color:' . $padding_color . '}';
		$rules[] = 'div#fancybox-title-inside{color:' . $title_color . '}';
	}

	$rules[] = 'div.fancybox-content{background-color:' . $padding_color
		. ( mfbfw_is_on( 'border', $s ) ? ';border:1px solid ' . $s['borderColor'] : '' ) . '}';

	// Legacy FancyBox 1.x keys, still honoured for sites that carry them.
	if ( isset( $s['borderRadius'] ) ) {
		$rules[] = 'div.fancybox-content{border-radius:' . (int) $s['borderRadius'] . 'px}';
	}

	if ( isset( $s['borderRadiusInner'] ) ) {
		$rules[] = 'img#fancybox-img{border-radius:' . (int) $s['borderRadiusInner'] . 'px}';
	}

	if ( isset( $s['shadowSize'], $s['shadowOffset'], $s['shadowOpacity'] ) ) {
		$rules[] = 'div.fancybox-content{box-shadow:0 ' . (int) $s['shadowOffset'] . 'px ' . (int) $s['shadowSize']
			. 'px rgba(0,0,0,' . (float) $s['shadowOpacity'] . ')}';
	}

	if ( mfbfw_is_on( 'titleShow', $s ) ) {
		$rules[] = 'div.fancybox-caption p.caption-title{display:inline-block}';
	} else {
		$rules[] = 'div.fancybox-custom-caption p.caption-title{display:none}div.fancybox-caption{display:none;}';
	}

	$rules[] = 'div.fancybox-caption p.caption-title{font-size:' . $s['titleSize'] . 'px}';
	$rules[] = 'div.fancybox-caption p.caption-title{color:' . ( $title_inside ? $title_color : '#fff' ) . '}';
	$rules[] = 'div.fancybox-caption{color:' . $title_color . '}';

	if ( $title_inside ) {
		$rules[] = 'div.fancybox-caption p.caption-title{background:#fff;width:auto;padding:10px 30px;}'
			. 'div.fancybox-content p.caption-title{color:' . $title_color . ';margin:0;padding:5px 0;}';
	} elseif ( 'float' === $position ) {
		$rules[] = 'div.fancybox-caption p.caption-title{background:#fff;color:#000;padding:10px 30px;width:auto;}';
	} else {
		$rules[] = 'div.fancybox-caption{position:relative;max-width:50%;margin:0 auto;min-width:480px;padding:15px;}'
			. 'div.fancybox-caption p.caption-title{position:relative;left:0;right:0;margin:0 auto;top:0;color:#fff;}';
	}

	if ( mfbfw_is_on( 'showCloseButton', $s ) ) {
		$rules[] = 'body.fancybox-active .fancybox-container .fancybox-stage .fancybox-content .fancybox-close-small{display:block;}';
	}

	return implode( "\n\t", $rules );
}

/**
 * JavaScript that copies image titles (and block captions) onto their parent link.
 *
 * The stored `copyTitleFunction` option has been ignored since 3.2.6 - it was
 * unconditionally overwritten before use - so it is generated here instead of
 * pretending to be configurable.
 *
 * @since 3.4.0
 *
 * @param array $s Normalized settings.
 * @return string
 */
function mfbfw_title_copy_js( array $s ) {

	if ( mfbfw_is_on( 'captionShow', $s ) ) {
		return <<<'JS'
var arr = jQuery("a[data-fancybox]");
jQuery.each(arr, function () {
	var title = jQuery(this).children("img").attr("title");
	if (title) { jQuery(this).attr("title", title); }
});
JS;
	}

	return <<<'JS'
var arr = jQuery("a[data-fancybox]");
jQuery.each(arr, function () {
	var title = jQuery(this).children("img").attr("title") || '';
	var figCaptionHtml = jQuery(this).next("figcaption").html() || '';
	var processedCaption = figCaptionHtml;
	if (figCaptionHtml.length && typeof DOMPurify === 'function') {
		processedCaption = DOMPurify.sanitize(figCaptionHtml, {USE_PROFILES: {html: true}});
	} else if (figCaptionHtml.length) {
		processedCaption = jQuery("<div>").text(figCaptionHtml).html();
	}
	var newTitle = title;
	if (processedCaption.length) {
		newTitle = title.length ? title + " " + processedCaption : processedCaption;
	}
	if (newTitle.length) { jQuery(this).attr("title", newTitle); }
});
JS;
}

/**
 * The `caption` callback handed to FancyBox.
 *
 * Keeps the DOMPurify path introduced in 3.3.7: markup is sanitized when DOMPurify
 * is present and hard-escaped through jQuery's text() when it is not.
 *
 * @since 3.4.0
 *
 * @return string
 */
function mfbfw_caption_js() {

	return <<<'JS'
function (instance, item) {
	var title = '';
	if ("undefined" != typeof jQuery(this).context) {
		title = jQuery(this).context.title;
	} else {
		title = ("undefined" != typeof jQuery(this).attr("title")) ? jQuery(this).attr("title") : '';
	}
	title = title || '';
	var caption = jQuery(this).data('caption') || '';
	if (item.type === 'image' && title.length) {
		caption = (caption.length ? caption + '<br />' : '') + '<p class="caption-title">' + jQuery("<div>").text(title).html() + '</p>';
	}
	if (typeof DOMPurify === "function" && caption.length) {
		return DOMPurify.sanitize(caption, {USE_PROFILES: {html: true}});
	}
	return jQuery("<div>").text(caption).html();
}
JS;
}

/**
 * The `afterLoad` callback, which paints the caption inside or over the image.
 *
 * @since 3.4.0
 *
 * @param array $s Normalized settings.
 * @return string
 */
function mfbfw_after_load_js( array $s ) {

	$position = $s['titlePosition'];

	if ( 'inside' !== $position && 'over' !== $position ) {
		return 'function () {}';
	}

	$style = ( 'inside' === $position )
		? 'position:absolute;left:0;right:0;color:#000;margin:0 auto;bottom:0;text-align:center;background-color:' . $s['paddingColor'] . ';'
		: 'position:absolute;left:0;right:0;color:#000;padding-top:10px;bottom:0;margin:0 auto;text-align:center;';

	$class = ( 'inside' === $position ) ? 'fancybox-custom-caption inside-caption' : 'fancybox-custom-caption';

	return sprintf(
		<<<'JS'
function (instance, current) {
	var captionContent = current.opts.caption || '';
	var sanitized = '';
	if (typeof DOMPurify === 'function' && captionContent.length) {
		sanitized = DOMPurify.sanitize(captionContent, {USE_PROFILES: {html: true}});
	} else if (captionContent.length) {
		sanitized = jQuery("<div>").text(captionContent).html();
	}
	if (sanitized.length) {
		current.$content.append(jQuery('<div class="%1$s" style="%2$s"></div>').html(sanitized));
	}
}
JS,
		esc_js( $class ),
		esc_js( $style )
	);
}

/**
 * The selector that decides which links become lightbox links.
 *
 * @since 3.4.0
 *
 * @param array $s Normalized settings.
 * @return string
 */
function mfbfw_thumbnail_selector_js( array $s ) {

	$extensions = mfbfw_is_on( 'exclude_pdf', $s )
		? 'jpe?g|png|gif|mp4|webp|bmp'
		: 'jpe?g|png|gif|mp4|webp|bmp|pdf';

	return sprintf(
		'jQuery("a:has(img)").not(".nolightbox").not(".envira-gallery-link").not(".ngg-simplelightbox").filter(function () {'
		. ' return /\.(%s)(\?[^/]*)*$/i.test(jQuery(this).attr("href")); })',
		$extensions
	);
}

/**
 * The JavaScript that tags links with their gallery grouping.
 *
 * @since 3.4.0
 *
 * @param array $s Normalized settings.
 * @return string
 */
function mfbfw_gallery_js( array $s ) {

	switch ( $s['galleryType'] ) {

		case 'post':
			return <<<'JS'
	if (fbfwIsSingular) {
		thumbnails.addClass("fancyboxforwp").attr("data-fancybox", "gallery").getTitle();
		iframeLinks.attr({"data-fancybox": "gallery"}).getTitle();
	} else {
		var posts = jQuery(".post");
		posts.each(function () {
			var idx = posts.index(this);
			jQuery(this).find(thumbnails).addClass("fancyboxforwp").attr("data-fancybox", "gallery" + idx).attr("rel", "fancybox" + idx).getTitle();
			jQuery(this).find(iframeLinks).attr({"data-fancybox": "gallery" + idx}).attr("rel", "fancybox" + idx).getTitle();
		});
	}
JS;

		case 'none':
			return <<<'JS'
	thumbnails.each(function () {
		var rel = jQuery(this).attr("rel");
		var imgTitle = jQuery(this).children("img").attr("title");
		jQuery(this).addClass("fancyboxforwp").attr("data-fancybox", rel);
		if (imgTitle) { jQuery(this).attr("title", imgTitle); }
	});
	iframeLinks.each(function () {
		var rel = jQuery(this).attr("rel");
		var imgTitle = jQuery(this).children("img").attr("title");
		jQuery(this).attr({"data-fancybox": rel});
		if (imgTitle) { jQuery(this).attr("title", imgTitle); }
	});
JS;

		case 'single_gutenberg_block':
			/*
			 * WordPress 5.9 moved the gallery block from `ul.wp-block-gallery` to
			 * `figure.wp-block-gallery.has-nested-images`, so the old element-qualified
			 * selectors matched nothing on any modern install. The fallback branch also
			 * tested a jQuery object for truthiness, which is always true.
			 */
			return <<<'JS'
	var galleryBlocks = jQuery(".wp-block-gallery");
	if (!galleryBlocks.length) {
		galleryBlocks = jQuery(".blocks-gallery-grid");
	}
	galleryBlocks.each(function () {
		var idx = galleryBlocks.index(this);
		jQuery(this).find(thumbnails).addClass("fancyboxforwp").attr("data-fancybox", "gallery" + idx).attr("rel", "fancybox" + idx).getTitle();
		jQuery(this).find(iframeLinks).attr({"data-fancybox": "gallery" + idx}).attr("rel", "fancybox" + idx).getTitle();
	});
JS;

		case 'custom':
			return "\t/* Custom Expression */\n\t" . html_entity_decode( $s['customExpression'] );

		case 'all':
		default:
			return <<<'JS'
	thumbnails.addClass("fancyboxforwp").attr("data-fancybox", "gallery").getTitle();
	iframeLinks.attr({"data-fancybox": "gallery"}).getTitle();
JS;
	}
}

/**
 * Assemble the option object passed to fancyboxforwp().
 *
 * Scalar options are JSON encoded rather than hand-interpolated. Previously
 * `animationDuration` was written unquoted straight from the option value, so any
 * value that skipped the sanitizer became executable JavaScript.
 *
 * @since 3.4.0
 *
 * @param array $s Normalized settings.
 * @return array{json: string, functions: array<string, string>}
 */
function mfbfw_build_options( array $s ) {

	$scalar = array(
		'loop'                  => mfbfw_is_on( 'cyclic', $s ),
		'smallBtn'              => mfbfw_is_on( 'showCloseButton', $s ),
		'zoomOpacity'           => mfbfw_is_on( 'zoomOpacity', $s ) ? 'auto' : false,
		'animationEffect'       => $s['transitionIn'],
		'animationDuration'     => (int) $s['zoomSpeedIn'],
		'transitionEffect'      => $s['transitionEffect'],
		'transitionDuration'    => (int) $s['zoomSpeedChange'],
		'overlayShow'           => mfbfw_is_on( 'overlayShow', $s ),
		'overlayOpacity'        => (float) $s['overlayOpacity'],
		'titleShow'             => mfbfw_is_on( 'titleShow', $s ),
		'titlePosition'         => $s['titlePosition'],
		'keyboard'              => mfbfw_is_on( 'enableEscapeButton', $s ),
		'showCloseButton'       => mfbfw_is_on( 'showCloseButton', $s ),
		'arrows'                => mfbfw_is_on( 'showNavArrows', $s ),
		'clickContent'          => mfbfw_is_on( 'hideOnContentClick', $s ) ? 'close' : false,
		'clickSlide'            => mfbfw_is_on( 'hideOnOverlayClick', $s ) ? 'close' : false,
		'wheel'                 => mfbfw_is_on( 'mouseWheel', $s ),
		'toolbar'               => mfbfw_is_on( 'showToolbar', $s ),
		'preventCaptionOverlap' => true,
	);

	if ( ! mfbfw_is_on( 'autoDimensions', $s ) ) {
		$scalar['width']  = (int) $s['frameWidth'];
		$scalar['height'] = (int) $s['frameHeight'];
	}

	$mobile_content = mfbfw_is_on( 'hideOnContentClick', $s ) ? '"close"' : '"toggleControls"';
	$mobile_slide   = mfbfw_is_on( 'hideOnOverlayClick', $s ) ? '"close"' : '"toggleControls"';

	$callbacks_on = mfbfw_is_on( 'callbackEnable', $s );

	$callback = static function ( $key ) use ( $s, $callbacks_on ) {
		if ( $callbacks_on && ! empty( $s[ $key ] ) ) {
			return html_entity_decode( $s[ $key ] );
		}

		return 'function () {}';
	};

	if ( $callbacks_on && ! empty( $s['callbackOnComplete'] ) ) {
		$after_show = html_entity_decode( $s['callbackOnComplete'] );
	} elseif ( mfbfw_is_on( 'zoomOnClick', $s ) ) {
		// Namespaced and rebound each time, otherwise every slide stacked another
		// click handler on the same image element.
		$after_show = 'function (instance) { jQuery(".fancybox-image").off("click.fbfwZoom").on("click.fbfwZoom", function () {'
			. ' instance.isScaledDown() ? instance.scaleToActual() : instance.scaleToFit(); }); }';
	} else {
		$after_show = 'function () {}';
	}

	$functions = array(
		'mobile'       => sprintf(
			'{ clickContent: function (current) { return current.type === "image" ? %s : false; },'
			. ' clickSlide: function (current) { return current.type === "image" ? %s : "close"; } }',
			$mobile_content,
			$mobile_slide
		),
		'onInit'       => $callback( 'callbackOnStart' ),
		'onDeactivate' => $callback( 'callbackOnCancel' ),
		'beforeClose'  => $callback( 'callbackOnCleanup' ),
		'afterShow'    => $after_show,
		'afterClose'   => $callback( 'callbackOnClose' ),
		'caption'      => mfbfw_caption_js(),
		'afterLoad'    => mfbfw_after_load_js( $s ),
	);

	return array(
		'json'      => wp_json_encode( $scalar ),
		'functions' => $functions,
	);
}

/**
 * Print inline styles and load FancyBox with the selected settings
 */
function mfbfw_init() {

	if ( ! mfbfw_is_enabled() ) {
		return;
	}

	global $mfbfw;

	$s = mfbfw_get_settings( is_array( $mfbfw ) ? $mfbfw : null );

	$options = mfbfw_build_options( $s );

	$assignments = '';
	foreach ( $options['functions'] as $name => $body ) {
		$assignments .= sprintf( "\t\tfbfwOptions.%s = %s;\n", $name, $body );
	}

	/*
	 * When disableOnMobile is on, the server-side check in mfbfw_enqueue_scripts()
	 * already skipped the assets - but a full-page cache can serve a desktop-rendered
	 * page to a phone, so the guard is repeated in the browser.
	 */
	$mobile_guard = mfbfw_is_on( 'disableOnMobile', $s )
		? "\t\tif (window.matchMedia && window.matchMedia('(max-width: 767px)').matches) { return; }\n"
		: '';

	$extra_calls = ( mfbfw_is_on( 'extraCallsEnable', $s ) && ! empty( $s['extraCallsData'] ) )
		? "\t\t/* Extra Calls */\n\t\t" . html_entity_decode( $s['extraCallsData'] ) . "\n"
		: '';

	// phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped -- CSS and JS are
	// assembled from schema-normalized values above; see mfbfw_build_css()/mfbfw_build_options().
	?>
<!-- Fancybox for WordPress v<?php echo esc_html( FBFW_VERSION ); ?> -->
<style type="text/css">
	<?php echo mfbfw_build_css( $s ); ?>

</style>
<script type="text/javascript">
	(function () {
		if (typeof window.jQuery === 'undefined') { return; }
		jQuery(function () {
<?php echo $mobile_guard; ?>
			var fbfwIsSingular = <?php echo is_singular() ? 'true' : 'false'; ?>;

			// Copy the title of every IMG tag onto its parent A so FancyBox can show it.
			jQuery.fn.getTitle = function () {
				<?php echo mfbfw_title_copy_js( $s ); ?>

				return this;
			};

			var thumbnails = <?php echo mfbfw_thumbnail_selector_js( $s ); ?>;

			// Anything that is not an image, video or PDF opens in an iframe.
			var iframeLinks = jQuery('.fancyboxforwp').filter(function () {
				return !/\.(jpe?g|png|gif|mp4|webp|bmp|pdf)(\?[^/]*)*$/i.test(jQuery(this).attr('href'));
			}).filter(function () {
				return !/vimeo|youtube/i.test(jQuery(this).attr('href'));
			});
			iframeLinks.attr({"data-type": "iframe"}).getTitle();

<?php echo mfbfw_gallery_js( $s ); ?>

			var fbfwOptions = <?php echo $options['json']; ?>;
<?php echo $assignments; ?>
			jQuery("a.fancyboxforwp").fancyboxforwp(fbfwOptions);
<?php echo $extra_calls; ?>
		});
	})();
</script>
<!-- END Fancybox for WordPress -->
	<?php
	// phpcs:enable WordPress.Security.EscapeOutput.OutputNotEscaped
}

// Check if inline script should be loaded in footer
if ( mfbfw_is_on( 'loadAtFooter' ) ) {
	add_action( 'wp_footer', 'mfbfw_init' );
} else {
	add_action( 'wp_head', 'mfbfw_init' );
}

/**
 * Load text domain
 */
function mfbfw_textdomain() {

	// The second parameter has been deprecated since WordPress 2.7 and passing
	// anything but false triggers a _doing_it_wrong() notice.
	load_plugin_textdomain( 'fancybox-for-wordpress', false, dirname( FBFW_PLUGIN_BASE ) . '/languages' );
}

add_action( 'init', 'mfbfw_textdomain' );

/**
 * Register options
 */
function mfbfw_admin_options() {

	if ( isset( $_GET['page'] ) && FBFW_SLUG === sanitize_key( wp_unslash( $_GET['page'] ) ) ) {

		if ( isset( $_REQUEST['action'] ) && 'reset' === sanitize_key( wp_unslash( $_REQUEST['action'] ) ) && check_admin_referer( 'mfbfw-options-reset' ) ) {

			if ( ! current_user_can( 'manage_options' ) ) {
				wp_die( esc_html__( 'You do not have permission to change these settings.', 'fancybox-for-wordpress' ) );
			}

			update_option( 'mfbfw', mfbfw_defaults() );
			wp_safe_redirect( add_query_arg( 'reset', 'true' ) );
			exit;
		}
	}

	register_setting(
		'mfbfw-options',
		'mfbfw',
		array(
			'type'              => 'array',
			'sanitize_callback' => 'mfbfw_sanitize_fancy_options',
			'default'           => mfbfw_defaults(),
		)
	);
}

add_action( 'admin_init', 'mfbfw_admin_options' );

/**
 * Admin options page
 */
function mfbfw_admin_menu() {

	require_once FBFW_PATH . 'admin.php';

	$mfbfwadmin = add_submenu_page(
		'options-general.php',
		__( 'Fancybox for WordPress Options', 'fancybox-for-wordpress' ),
		__( 'Fancybox for WP', 'fancybox-for-wordpress' ),
		'manage_options',
		FBFW_SLUG,
		'mfbfw_options_page'
	);

	add_action( 'admin_print_styles-' . $mfbfwadmin, 'mfbfw_admin_styles' );
	add_action( 'admin_print_scripts-' . $mfbfwadmin, 'mfbfw_admin_scripts' );
}

add_action( 'admin_menu', 'mfbfw_admin_menu' );

/**
 * Load Admin CSS & JS (called in mfbfw_admin_menu())
 */
function mfbfw_admin_styles() {

	wp_enqueue_style( 'fancybox-admin', FBFW_URL . 'assets/css/fancybox-admin.css', array(), FBFW_VERSION );
	wp_enqueue_style( 'wp-color-picker' );

	// Bundled rather than pulled from code.jquery.com: plugins on WordPress.org may not
	// load assets from third-party CDNs, and doing so leaked visitor IPs to jQuery.
	wp_enqueue_style( 'fbfw-jquery-ui', FBFW_URL . 'assets/css/jquery-ui.css', array(), FBFW_VERSION );
}

function mfbfw_admin_scripts() {

	wp_enqueue_script( 'jquery-ui-tabs' );
	wp_enqueue_script( 'jquery-ui-slider' );
	wp_enqueue_script( 'fancybox-admin', FBFW_URL . 'assets/js/admin.js', array( 'jquery', 'jquery-ui-tabs', 'jquery-ui-slider', 'wp-color-picker', 'updates' ), FBFW_VERSION, true );

	wp_localize_script(
		'fancybox-admin',
		'fbfwAdmin',
		array(
			'confirmDefaults' => __( 'Are you sure you want to restore FancyBox for WordPress to default settings?', 'fancybox-for-wordpress' ),
		)
	);

	/* Load codemirror editor */
	wp_enqueue_code_editor( array( 'type' => 'text/javascript' ) );
}

/**
 * Settings Button on Plugins Panel
 */
function mfbfw_plugin_action_links( $links, $file ) {

	if ( FBFW_PLUGIN_BASE === $file ) {
		$settings_link = '<a href="' . esc_url( admin_url( 'options-general.php?page=' . FBFW_SLUG ) ) . '">' . esc_html__( 'Settings', 'fancybox-for-wordpress' ) . '</a>';
		array_unshift( $links, $settings_link );
	}

	return $links;
}

add_filter( 'plugin_action_links', 'mfbfw_plugin_action_links', 10, 2 );

/**
 * Transform a hex colour into an rgba() string.
 *
 * @since 3.4.0
 *
 * @param string $hex_color Hex colour.
 * @param mixed  $opacity   Opacity between 0 and 1.
 * @return string
 */
function mfbfw_hex_to_rgba( $hex_color, $opacity ) {

	$hex_color = mfbfw_sanitize_hex_color( $hex_color, '#666666' );

	// Expand the shorthand form so sscanf() always sees six digits.
	if ( 4 === strlen( $hex_color ) ) {
		$hex_color = '#' . $hex_color[1] . $hex_color[1] . $hex_color[2] . $hex_color[2] . $hex_color[3] . $hex_color[3];
	}

	$parts = sscanf( $hex_color, '#%02x%02x%02x' );

	list( $r, $g, $b ) = is_array( $parts ) ? array_map( 'intval', $parts ) : array( 102, 102, 102 );

	$opacity = is_numeric( $opacity ) ? min( 1, max( 0, (float) $opacity ) ) : 1;

	return 'rgba(' . $r . ',' . $g . ',' . $b . ',' . $opacity . ')';
}

/**
 * Transform from Hex to rgb or rgba
 *
 * @deprecated 3.4.0 Use mfbfw_hex_to_rgba() instead.
 *
 * @param string $hexColor Hex colour.
 * @param mixed  $opacity  Opacity.
 * @return string
 */
function hexTorgba( $hexColor, $opacity ) { // phpcs:ignore WordPress.NamingConventions

	return mfbfw_hex_to_rgba( $hexColor, $opacity );
}

/*
 *
 * Check if WooCommerce Product post
 *
 */
function fancy_check_if_woocommerce() {

	if ( ! class_exists( 'WooCommerce' ) ) {
		return 'true';
	}

	if ( function_exists( 'is_shop' ) && is_shop() ) {
		return 'shop_page';
	}

	if ( 'product' === get_post_type( get_the_ID() ) ) {
		return 'product';
	}

	return 'true';
}

/**
 * Sanitize options
 *
 * Rewritten in 3.4.0 as an allow-list driven by mfbfw_option_schema(). The previous
 * implementation started from `$sanitized = $value`, so any key it did not
 * explicitly name was written to the database untouched.
 *
 * @since 3.3.4
 *
 * @param mixed $value Raw submitted value.
 * @return array
 */
function mfbfw_sanitize_fancy_options( $value ) {

	if ( ! is_array( $value ) ) {
		return mfbfw_defaults();
	}

	$schema    = mfbfw_option_schema();
	$stored    = get_option( 'mfbfw' );
	$stored    = is_array( $stored ) ? $stored : array();
	$sanitized = array();

	foreach ( $schema as $key => $spec ) {

		if ( array_key_exists( $key, $value ) ) {
			$sanitized[ $key ] = mfbfw_normalize_value( $value[ $key ], $spec );
			continue;
		}

		/*
		 * Legacy keys have no form field, so they are always absent from the POST
		 * body. Carrying the stored value over stops the first save on an upgraded
		 * site from silently dropping its border radius and shadow styling.
		 */
		if ( ! empty( $spec['optional'] ) ) {
			if ( array_key_exists( $key, $stored ) ) {
				$sanitized[ $key ] = mfbfw_normalize_value( $stored[ $key ], $spec );
			}
			continue;
		}

		// An unchecked checkbox is simply absent from the POST body.
		$sanitized[ $key ] = ( 'toggle' === $spec['type'] ) ? '' : $spec['default'];
	}

	return $sanitized;
}
