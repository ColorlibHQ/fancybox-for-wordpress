<?php

/*
  Plugin Name: FancyBox for WordPress
  Plugin URI: http://plugins.josepardilla.com/fancybox-for-wordpress/
  Description: Integrates <a href="http://fancybox.net/">FancyBox</a> by <a href="http://klade.lv/">Janis Skarnelis</a> into WordPress.
  Version: 3.0.2
  Author: Jos&eacute; Pardilla
  Author URI: http://josepardilla.com/

 * FancyBox is Copyright (c) 2008 - 2010 Janis Skarnelis
 * Dual licensed under the MIT and GPL licenses:
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl.html

 */



/**
 * Plugin Init
 */
// Constants
define( 'FBFW_VERSION', '3.0.2' );
define( 'FBFW_PATH', plugin_dir_path( __FILE__ ) );
define( 'FBFW_URL', plugin_dir_url( __FILE__ ) );

// Get Main Settings
$mfbfw			 = get_option( 'mfbfw' );
$mfbfw_version	 = get_option( 'mfbfw_active_version' );

// If previous version detected
if ( is_admin() && isset( $mfbfw_version ) && $mfbfw_version < FBFW_VERSION ) {

	// get default settings and add any new ones to the database
	$current_settings	 = get_option( 'mfbfw' );
	$default_settings	 = mfbfw_defaults();
	$new_settings		 = (array) $current_settings + (array) $default_settings;
	update_option( 'mfbfw', $new_settings );

	// update version number
	update_option( 'mfbfw_active_version', FBFW_VERSION );
} else {

	// update is not needed, add settings if first time activation
	$default_settings = mfbfw_defaults();
	add_option( 'mfbfw', $default_settings );
	add_option( 'mfbfw_active_version', FBFW_VERSION );
}

/**
 * Store default settings in an array
 */
function mfbfw_defaults() {

	$default_settings = array(
		// Appearance
		'border'			 => '',
		'borderColor'		 => '#BBBBBB',
		'borderRadius'		 => '5',
		'borderRadiusInner'	 => '0',
		'showCloseButton'	 => 'on',
		'closeHorPos'		 => 'right',
		'closeVerPos'		 => 'top',
		'paddingColor'		 => '#FFFFFF',
		'padding'			 => '15',
		'overlayShow'		 => 'on',
		'overlayColor'		 => '#000000',
		'overlayOpacity'	 => '0.7',
		'shadowOpacity'		 => '0.5',
		'shadowSize'		 => '25',
		'shadowOffset'		 => '10',
		'titleShow'			 => 'on',
		'titlePosition'		 => 'inside',
		'titleColor'		 => '#333333',
		'arrows'			 => 'on',
		// Animations
		'zoomOpacity'		 => 'on',
		'zoomSpeedIn'		 => '500',
		'zoomSpeedOut'		 => '500',
		'animationDuration'	 => '500',
		'transitionDuration' => '500',
		'animationEffect'	 => 'fade',
		'transitionEffect'	 => 'fade',
		'transitionOut'		 => 'fade',
//		'easing'			 => '',
//		'easingIn'			 => 'easeOutBack',
//		'easingOut'			 => 'easeInBack',
//		'easingChange'		 => 'easeInOutQuart',
		// Behaviour
		'imageScale'		 => 'on',
		'centerOnScroll'	 => 'on',
		'clickContent'		 => 'function(current, event) {
    return current.type === "image" ? "close" : false;
  },',
		'clickSlide'		 => 'on',
		'keyboard'			 => 'on',
		'loop'				 => 'on',
		'wheel'				 => 'off',
		// Gallery Type
		'galleryType'		 => 'all',
		'customExpression'	 => 'jQuery(thumbnails).addClass("fancybox").attr("rel","fancybox").getTitle();',
		// Other
		'autoDimensions'	 => 'on',
		'frameWidth'		 => '560',
		'frameHeight'		 => '340',
		'loadAtFooter'		 => '',
		'callbackEnable'	 => '',
		'callbackOnStart'	 => 'function() { alert("Start!"); }',
		'callbackOnCancel'	 => 'function() { alert("Cancel!"); }',
		'callbackOnComplete' => 'function() { alert("Complete!"); }',
		'callbackOnCleanup'	 => 'function() { alert("CleanUp!"); }',
		'callbackOnClose'	 => 'function() { alert("Close!"); }',
		'copyTitleFunction'	 => 'var arr = jQuery("a[data-fancybox]");
jQuery.each(arr, function() {
	var title = jQuery(this).children("img").attr("title");
	jQuery(this).attr("title",title);
});	',
		// Troubleshooting
		'nojQuery'			 => '',
		// Extra Calls
		'extraCallsEnable'	 => '',
		'extraCalls'		 => '',
		// Uninstall
		'uninstall'			 => ''
	);

	return $default_settings;
}

/**
 * If requested, when plugin is deactivated, remove settings
 */
function mfbfw_deactivate() {

	global $mfbfw;

	if ( isset( $mfbfw[ 'uninstall' ] ) && $mfbfw[ 'uninstall' ] ) {
		delete_option( 'mfbfw' );
		delete_option( 'mfbfw_active_version' );
	}
}

register_deactivation_hook( __FILE__, 'mfbfw_deactivate' );

/**
 * Load FancyBox JS with jQuery and jQuery.easing & jquery.mousewheel if necessary
 */
function mfbfw_enqueue_scripts() {

	global $mfbfw, $wp_styles;

	// Check if script should be loaded in footer
	if ( isset( $mfbfw[ 'loadAtFooter' ] ) && $mfbfw[ 'loadAtFooter' ] ) {
		$footer = true;
	} else {
		$footer = false;
	}

	// Check if plugin should not call jQuery script (for troubleshooting only)
	if ( isset( $mfbfw[ 'nojQuery' ] ) && $mfbfw[ 'nojQuery' ] ) {
		$jquery = false;
	} else {
		$jquery = array( 'jquery' );
	}

	// Register Scripts
	wp_register_script( 'fancybox', FBFW_URL . 'assets/js/jquery.fancybox.js', $jquery, '1.3.4', $footer ); // Main Fancybox script
	wp_register_script( 'jqueryeasing', FBFW_URL . 'assets/js/jquery.easing.1.3.min.js', $jquery, '1.3', $footer ); // Easing animations script
	wp_register_script( 'jquerymousewheel', FBFW_URL . 'assets/js/jquery.mousewheel.3.0.4.pack.js', $jquery, '3.0.4', $footer ); // Mouse wheel support script
	// Enqueue Scripts
	wp_enqueue_script( 'fancybox' ); // Load fancybox

	if ( isset( $mfbfw[ 'easing' ] ) && $mfbfw[ 'easing' ] ) {
		wp_enqueue_script( 'jqueryeasing' ); // Load easing javascript file if required
	}

	if ( isset( $mfbfw[ 'wheel' ] ) && $mfbfw[ 'wheel' ] ) {
		wp_enqueue_script( 'jquerymousewheel' ); // Load mouse wheel javascript file if required
	}

	// Register Styles
	wp_register_style( 'fancybox', FBFW_URL . 'assets/css/fancybox.css', false, '1.3.4' ); // Main Fancybox style
	wp_register_style( 'fancybox-ie', FBFW_URL . 'assets/css/fancybox.ie.css', array( 'fancybox' ), '1.3.4' ); // Main Fancybox style fixes for IE6-8
	// Enqueue Styles
	wp_enqueue_style( 'fancybox' );
	wp_enqueue_style( 'fancybox-ie' );

	// Make IE specific styles load only on IE6-8
	$wp_styles->add_data( 'fancybox-ie', 'conditional', 'lt IE 9' );
}

add_action( 'wp_enqueue_scripts', 'mfbfw_enqueue_scripts' );

/**
 * Print inline styles and load FancyBox with the selected settings
 */
function mfbfw_init() {

	global $mfbfw, $mfbfw_version;

	//baseTpl testing for title
	$baseTpl = '<div class=\'fancybox-container\' role=\'dialog\' tabindex=\'-1\'> " +
    "<div class=\'fancybox-bg\'></div>"+
    "<div class=\'fancybox-inner\'>"+
    "<div class=\'fancybox-infobar\'><span data-fancybox-index></span>&nbsp;/&nbsp;<span data-fancybox-count></span></div>"+
    "<div class=\'fancybox-toolbar\'>{{buttons}}</div>"+
    "<div class=\'fancybox-navigation\'>{{arrows}}</div>"+
    "<div class=\'fancybox-stage\'></div>"+
	"<div class=\'fancybox-title\'></div>"+
    "<div class=\'fancybox-caption\'></div>"+
    "</div>"+
    "</div>';

	// fix undefined index copyTitleFunction. $mfbfw array misses this index.
	$mfbfw[ 'copyTitleFunction' ] = 'var arr = jQuery("a[data-fancybox]");
jQuery.each(arr, function() {
	var title = jQuery(this).children("img").attr("title");
	jQuery(this).attr("title",title);
});	';

	echo '
<!-- Fancybox for WordPress v' . $mfbfw_version . ' -->
<style type="text/css">
	' . ( isset( $mfbfw[ 'overlayColor' ] ) && $mfbfw[ 'overlayColor' ] ? 'div.fancybox-inner{background-color:' . hexTorgba( $mfbfw[ 'overlayColor' ], $mfbfw[ 'overlayOpacity' ] ) . ';}' : '' ) . ( isset( $mfbfw[ 'paddingColor' ] ) && $mfbfw[ 'paddingColor' ] ? 'div.fancybox-content{border-color:' . $mfbfw[ 'paddingColor' ] . '}' : '' ) . '
	' . ( isset( $mfbfw[ 'paddingColor' ] ) && $mfbfw[ 'paddingColor' ] && $mfbfw[ 'titlePosition' ] == 'inside' ? 'div#fancybox-title{background-color:' . $mfbfw[ 'paddingColor' ] . '}' : '' ) . '
	div.fancybox-content{background-color:' . $mfbfw[ 'paddingColor' ] . ( isset( $mfbfw[ 'border' ] ) && $mfbfw[ 'border' ] ? ';border:1px solid ' . $mfbfw[ 'borderColor' ] : '' ) . '}
	' . ( isset( $mfbfw[ 'titleColor' ] ) && $mfbfw[ 'titleColor' ] && $mfbfw[ 'titlePosition' ] == 'inside' ? 'div#fancybox-title-inside{color:' . $mfbfw[ 'titleColor' ] . '}' : '' ) . '
	' . ( isset( $mfbfw[ 'borderRadius' ] ) ? 'div.fancybox-content{border-radius:' . $mfbfw[ 'borderRadius' ] . 'px}' : '' ) . '
	' . ( isset( $mfbfw[ 'borderRadiusInner' ] ) ? 'img#fancybox-img{border-radius:' . $mfbfw[ 'borderRadiusInner' ] . 'px}' : '' ) . '
	' . ( isset( $mfbfw[ 'shadowSize' ] ) && $mfbfw[ 'shadowOffset' ] && $mfbfw[ 'shadowOpacity' ] ? 'div.fancybox-content{box-shadow:0 ' . $mfbfw[ 'shadowOffset' ] . 'px ' . $mfbfw[ 'shadowSize' ] . 'px rgba(0,0,0,' . $mfbfw[ 'shadowOpacity' ] . ')}' : '' ) . '
</style>';

	echo '
<script type="text/javascript">
	jQuery(function(){

		jQuery.fn.getTitle = function() { // Copy the title of every IMG tag and add it to its parent A so that fancybox can show titles
			' . $mfbfw[ 'copyTitleFunction' ] . '
		}

		// Supported file extensions
		var thumbnails = jQuery("a:has(img)").not(".nolightbox, .nofancybox, a:has(img.nolightbox, img.nofancybox)").filter( function() { return /\.(jpe?g|png|gif|bmp)$/i.test(jQuery(this).attr("href")) });
';
	if ( $mfbfw[ 'galleryType' ] == 'post' ) {

		// Gallery type BY POST and on post or page (so only one post or page is visible)
		if ( is_singular() ) {
			echo '
		// Gallery by post
		//humbnails.addClass("fancybox").attr("rel","fancybox").getTitle();
		thumbnails.attr("data-fancybox","gallery").getTitle();
';

			// Gallery type BY POST, but neither on post or page, so make a different rel attribute on each post
		} else {
			echo '
		// Gallery by post
		var posts = jQuery(".post");
		posts.each(function() {
			//jQuery(this).find(thumbnails).addClass("fancybox").attr("rel","fancybox"+posts.index(this)).getTitle()
			//razvan modification. here we need to make sure the attribut for each gallery is different
			jQuery(this).find(thumbnails).attr("data-fancybox","gallery"+posts.index(this)).attr("rel","fancybox"+posts.index(this)).getTitle()
		});
';
		}

// Gallery type ALL
	} elseif ( $mfbfw[ 'galleryType' ] == 'all' ) {
		echo '
		// Gallery All
		//thumbnails.addClass("fancybox").attr("rel","fancybox").getTitle();
		
		//razvan modification. New fancybox script uses data-fancybox attribute, so we don\'t need the class. 
		thumbnails.attr("data-fancybox","gallery").getTitle();
';

// Gallery type NONE
	} elseif ( $mfbfw[ 'galleryType' ] == 'none' ) {
		echo '
		// No Galleries
		//thumbnails.addClass("fancybox").getTitle();
		//razvan modification
		thumbnails.attr("data-fancybox").getTitle();
';

// Else, gallery type is custom, so just print the custom expression
	} else {
		echo '
		// Custom Expression
		' . $mfbfw[ 'customExpression' ] . '
';
	}

// Call fancybox and apply it on any link with a rel atribute that starts with "fancybox", with the options set on the admin panel
//removed lines : 
	//"enableEscapeButton": ' . ( isset( $mfbfw[ 'enableEscapeButton' ] ) && $mfbfw[ 'enableEscapeButton' ] ? 'true' : 'false' ) . ',
	//
	//"transitionOut": "' . $mfbfw[ 'transitionOut' ] . '",
	//"autoScale": ' . ( isset( $mfbfw[ 'imageScale' ] ) && $mfbfw[ 'imageScale' ] ? 'true' : 'false' ) . ',
	//"speedIn": ' . $mfbfw[ 'zoomSpeedIn' ] . ',
	//"speedOut": ' . $mfbfw[ 'zoomSpeedOut' ] . ',
	//"overlayColor": "' . $mfbfw[ 'overlayColor' ] . '",
	echo '
		jQuery("a[data-fancybox]").fancybox({
			"loop": ' . ( isset( $mfbfw[ 'loop' ] ) && $mfbfw[ 'loop' ] ? 'true' : 'false' ) . ',
			"animationEffect": "zoom",
			"padding": ' . $mfbfw[ 'padding' ] . ',
			"opacity": ' . ( isset( $mfbfw[ 'zoomOpacity' ] ) && $mfbfw[ 'zoomOpacity' ] ? 'true' : 'false' ) . ',
			"animationEffect": "' . $mfbfw[ 'animationEffect' ] . '",
			"animationDuration": ' . $mfbfw[ 'animationDuration' ] . ',
			"transitionEffect": "' . $mfbfw[ 'transitionEffect' ] . '",
			"overlayShow": ' . ( isset( $mfbfw[ 'overlayShow' ] ) && $mfbfw[ 'overlayShow' ] ? 'true' : 'false' ) . ',
			"overlayOpacity": "' . $mfbfw[ 'overlayOpacity' ] . '",
			"titleShow": ' . ( isset( $mfbfw[ 'titleShow' ] ) && $mfbfw[ 'titleShow' ] ? 'true' : 'false' ) . ',
			"titlePosition": "' . $mfbfw[ 'titlePosition' ] . '",
			"keyboard": ' . ( isset( $mfbfw[ 'keyboard' ] ) && $mfbfw[ 'keyboard' ] ? 'true' : 'false' ) . ',
			"showCloseButton": ' . ( isset( $mfbfw[ 'showCloseButton' ] ) && $mfbfw[ 'showCloseButton' ] ? 'true' : 'false' ) . ',
			"arrows": ' . ( isset( $mfbfw[ 'arrows' ] ) && $mfbfw[ 'arrows' ] ? 'true' : 'false' ) . ',
			"clickSlide": ' . ( isset( $mfbfw[ 'clickSlide' ] ) && $mfbfw[ 'clickSlide' ] ? '"close"' : 'false' ) . ',
			"clickContent": ' . ( isset( $mfbfw[ 'clickContent' ] ) && $mfbfw[ 'clickContent' ] ? 'function(current, event) {
    return current.type === "image" ? "close" : false;
  }' : 'false' ) . ',			
			"wheel": ' . ( isset( $mfbfw[ 'wheel' ] ) && $mfbfw[ 'wheel' ] ? 'true' : 'false' ) . ',
			"width": ' . $mfbfw[ 'frameWidth' ] . ',
			"height": ' . $mfbfw[ 'frameHeight' ] . ',
			"onStart": ' . ( isset( $mfbfw[ 'callbackEnable' ], $mfbfw[ 'callbackOnStart' ] ) && $mfbfw[ 'callbackEnable' ] && $mfbfw[ 'callbackOnStart' ] ? $mfbfw[ 'callbackOnStart' ] . ',' : 'function() { },' ) . '
			"onCancel": ' . ( isset( $mfbfw[ 'callbackEnable' ], $mfbfw[ 'callbackOnCancel' ] ) && $mfbfw[ 'callbackEnable' ] && $mfbfw[ 'callbackOnCancel' ] ? $mfbfw[ 'callbackOnCancel' ] . ',' : 'function() { },' ) . '
			"onCleanup": ' . ( isset( $mfbfw[ 'callbackEnable' ], $mfbfw[ 'callbackOnCleanup' ] ) && $mfbfw[ 'callbackEnable' ] && $mfbfw[ 'callbackOnCleanup' ] ? $mfbfw[ 'callbackOnCleanup' ] . ',' : 'function() { },' ) . '
			"onComplete": ' . ( isset( $mfbfw[ 'callbackEnable' ], $mfbfw[ 'callbackOnComplete' ] ) && $mfbfw[ 'callbackEnable' ] && $mfbfw[ 'callbackOnComplete' ] ? $mfbfw[ 'callbackOnComplete' ] . ',' : 'function() { },' ) . '
			"onClosed": ' . ( isset( $mfbfw[ 'callbackEnable' ], $mfbfw[ 'callbackOnClose' ] ) && $mfbfw[ 'callbackEnable' ] && $mfbfw[ 'callbackOnClose' ] ? $mfbfw[ 'callbackOnClose' ] . ',' : 'function() { },' ) . '
			"centerOnScroll": ' . ( isset( $mfbfw[ 'centerOnScroll' ] ) && $mfbfw[ 'centerOnScroll' ] ? 'true' : 'false ' ) . ( isset( $mfbfw[ 'easing' ] ) && $mfbfw[ 'easing' ] ? ',
			"easingIn": "' . $mfbfw[ 'easingIn' ] . '",
			"easingOut": "' . $mfbfw[ 'easingOut' ] . '",
			"easingChange": "' . $mfbfw[ 'easingChange' ] . '"' : '' ) . ',
			"baseTpl": "' . $baseTpl . '"
		});
';

	if ( isset( $mfbfw[ 'extraCallsEnable' ] ) && $mfbfw[ 'extraCallsEnable' ] )
		echo '
// Extra Calls
' . $mfbfw[ 'extraCallsData' ] . '
';
	echo '
	})
</script>
<!-- END Fancybox for WordPress -->
';
}

// Check if inline script should be loaded in footer
if ( isset( $mfbfw[ 'loadAtFooter' ] ) && $mfbfw[ 'loadAtFooter' ] ) {
	add_action( 'wp_footer', 'mfbfw_init' );
} else {
	add_action( 'wp_head', 'mfbfw_init' );
}

/**
 * Load text domain
 */
function mfbfw_textdomain() {

	if ( function_exists( 'load_plugin_textdomain' ) ) {
		load_plugin_textdomain( 'mfbfw', FBFW_URL . 'languages', 'fancybox-for-wordpress/languages' );
	}
}

add_action( 'init', 'mfbfw_textdomain' );

/**
 * Register options
 */
function mfbfw_admin_options() {

	$settings = get_option( 'mfbfw' );

	if ( isset( $_GET[ 'page' ] ) && $_GET[ 'page' ] == 'fancybox-for-wordpress' ) {

		if ( isset( $_REQUEST[ 'action' ] ) && 'reset' == $_REQUEST[ 'action' ] && check_admin_referer( 'mfbfw-options-reset' ) ) {

			$defaults_array = mfbfw_defaults(); // Store defaults in an array
			update_option( 'mfbfw', $defaults_array ); // Write defaults to database
			wp_safe_redirect( add_query_arg( 'reset', 'true' ) );
			die;
		}
	}

	register_setting( 'mfbfw-options', 'mfbfw' );
}

add_action( 'admin_init', 'mfbfw_admin_options' );

/**
 * Admin options page
 */
function mfbfw_admin_menu() {

	require FBFW_PATH . 'admin.php';

	$mfbfwadmin = add_submenu_page( 'options-general.php', 'Fancybox for WordPress Options', 'Fancybox for WP', 'manage_options', 'fancybox-for-wordpress', 'mfbfw_options_page' );

	add_action( 'admin_print_styles-' . $mfbfwadmin, 'mfbfw_admin_styles' );
	add_action( 'admin_print_scripts-' . $mfbfwadmin, 'mfbfw_admin_scripts' );
}

add_action( 'admin_menu', 'mfbfw_admin_menu' );

/**
 * Load Admin CSS & JS (called in mfbfw_admin_menu())
 */
function mfbfw_admin_styles() {
	wp_enqueue_style( 'fancybox-admin', FBFW_URL . 'assets/css/fancybox-admin.css', false, FBFW_VERSION ); // Load custom CSS for Admin Page
	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_style( 'jquery-ui', '//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css' ); // Load jQuery UI Tabs CSS for Admin Page
}

function mfbfw_admin_scripts() {
	wp_enqueue_script( 'jquery-ui-tabs', array( 'jquery-ui-core' ) ); // Load jQuery UI Tabs JS for Admin Page
	wp_enqueue_script( 'wp-color-picker' );
	wp_enqueue_script( 'fancybox-admin', FBFW_URL . 'assets/js/admin.js', array( 'jquery', 'wp-color-picker' ), FBFW_VERSION ); // Load specific JS for Admin Page

	/* Load codemirror editor */
	// Enqueue code editor and settings for manipulating Javascript.
	$settings = wp_enqueue_code_editor( array( 'type' => 'text/javascript' ) );
}

/**
 * Settings Button on Plugins Panel
 */
function mfbfw_plugin_action_links( $links,
									$file ) {

	static $this_plugin;
	if ( !$this_plugin )
		$this_plugin = plugin_basename( __FILE__ );

	if ( $file == $this_plugin ) {
		$settings_link = '<a href="options-general.php?page=fancybox-for-wordpress">' . __( 'Settings', 'mfbfw' ) . '</a>';
		array_unshift( $links, $settings_link );
	}

	return $links;
}

add_filter( 'plugin_action_links', 'mfbfw_plugin_action_links', 10, 2 );


/*
 * Transform from Hex to rgb or rgba
 */

function hexTorgba( $hexColor,
					$opacity ) {
	list($r, $g, $b) = sscanf( $hexColor, "#%02x%02x%02x" );
	if ( $opacity ) {
		$rgb = 'rgba(' . $r . ',' . $g . ',' . $b . ',' . $opacity . ')';
	} else {
		$rgb = 'rgba(' . $r . ',' . $g . ',' . $b . ')';
	}

	return $rgb;
}
