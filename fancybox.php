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
 * Constants
 */

define( 'FBFW_VERSION', '3.0.2' );
define( 'FBFW_PATH', plugin_dir_path(__FILE__) );
define( 'FBFW_URL', plugin_dir_url(__FILE__) );

// Get Main Settings
$mfbfw = get_option( 'mfbfw' );


/**
 * Store default settings in an array
 */

function mfbfw_defaults() {

	$defaults_array = array(

		// Appearance
		'border'                => '',
		'borderColor'           => '#BBBBBB',
		'showCloseButton'       => 'on',
		'closeHorPos'           => 'right',
		'closeVerPos'           => 'top',
		'paddingColor'          => '#FFFFFF',
		'padding'               => '10',
		'overlayShow'           => 'on',
		'overlayColor'          => '#666666',
		'overlayOpacity'        => '0.3',
		'titleShow'             => 'on',
		'titlePosition'         => 'inside',
		'titleColor'            => '#333333',
		'showNavArrows'         => 'on',

		// Animations
		'zoomOpacity'           => 'on',
		'zoomSpeedIn'           => '500',
		'zoomSpeedOut'          => '500',
		'zoomSpeedChange'       => '300',
		'transitionIn'          => 'fade',
		'transitionOut'         => 'fade',
		'easing'                => '',
		'easingIn'              => 'easeOutBack',
		'easingOut'             => 'easeInBack',
		'easingChange'          => 'easeInOutQuart',

		// Behaviour
		'imageScale'            => 'on',
		'centerOnScroll'        => 'on',
		'hideOnContentClick'    => '',
		'hideOnOverlayClick'    => 'on',
		'enableEscapeButton'    => 'on',
		'cyclic'                => '',
		'mouseWheel'            => '',

		// Gallery Type
		'galleryType'           => 'all',
		'customExpression'      => 'jQuery(thumbnails).addClass("fancybox").attr("rel","fancybox").getTitle();',

		// Other
		'autoDimensions'        => 'on',
		'frameWidth'            => '560',
		'frameHeight'           => '340',
		'loadAtFooter'          => '',
		'callbackEnable'        => '',
		'callbackOnStart'       => 'function() { alert("Start!"); }',
		'callbackOnCancel'      => 'function() { alert("Cancel!"); }',
		'callbackOnComplete'    => 'function() { alert("Complete!"); }',
		'callbackOnCleanup'     => 'function() { alert("CleanUp!"); }',
		'callbackOnClose'       => 'function() { alert("Close!"); }',

		// Troubleshooting
		'nojQuery'              => '',

		// Extra Calls
		'extraCallsEnable'      => '',
		'extraCalls'            => '',

		// Uninstall
		'uninstall'             => ''

	);

	return $defaults_array;
}



/**
 * When plugin is installed, write default settings and update version
 */

function mfbfw_install() {

	$defaults_array = mfbfw_defaults();
	add_option( 'mfbfw', $defaults_array );
	update_option( 'mfbfw_active_version', FBFW_VERSION );

}
register_activation_hook( __FILE__, 'mfbfw_install' );



/**
 * If requested, when plugin is deactivated, remove settings
 */

function mfbfw_uninstall() {

	global $mfbfw;

	if ( isset($mfbfw['uninstall']) && $mfbfw['uninstall'] ) {
		delete_option( 'mfbfw' );
		delete_option( 'mfbfw_active_version' );
	}

}
register_deactivation_hook( __FILE__, 'mfbfw_uninstall' );



/**
 * Load FancyBox JS with jQuery and jQuery.easing & jquery.mousewheel if necessary
 */

function mfbfw_enqueue_scripts() {

	global $mfbfw;

	// Check if script should be loaded in footer
	if ( isset($mfbfw['loadAtFooter']) && $mfbfw['loadAtFooter'] ) {
		$footer = true;
	} else {
		$footer = false;
	}

	// Check if plugin should not call jQuery script (for troubleshooting only)
	if ( isset($mfbfw['nojQuery']) && $mfbfw['nojQuery'] ) {
		$jquery = false;
	} else {
		$jquery = array('jquery');
	}

	// Register Scripts
	wp_register_script('fancybox', FBFW_URL . 'fancybox/jquery.fancybox.js', $jquery, '1.3.4', $footer ); // Main Fancybox script
	wp_register_script('jqueryeasing', FBFW_URL . 'js/jquery.easing.1.3.min.js', $jquery, '1.3', $footer ); // Easing animations script
	wp_register_script('jquerymousewheel', FBFW_URL . 'js/jquery.mousewheel.3.0.4.pack.js', $jquery, '3.0.4', $footer ); // Mouse wheel support script

	// Enqueue Scripts
	wp_enqueue_script( 'fancybox' ); // Load fancybox

	if ( isset($mfbfw['easing']) && $mfbfw['easing'] ) {
		wp_enqueue_script( 'jqueryeasing' ); // Load easing javascript file if required
	}

	if ( isset($mfbfw['mouseWheel']) && $mfbfw['mouseWheel'] ) {
		wp_enqueue_script( 'jquerymousewheel' ); // Load mouse wheel javascript file if required
	}

	// Register Styles
	wp_register_style( 'fancybox', FBFW_URL . 'fancybox/fancybox.css', false, '1.3.4' ); // Main Fancybox style

	// Enqueue Styles
	wp_enqueue_style( 'fancybox' );

}
add_action( 'wp_enqueue_scripts', 'mfbfw_enqueue_scripts' );



/**
 * Print inline styles and load FancyBox with the selected settings
 */

function mfbfw_init() {

	global $mfbfw;

	echo '
<!-- Fancybox for WordPress v' . get_option( 'mfbfw_active_version' ) . ' -->
<style type="text/css">
	#fancybox-close{' . $mfbfw['closeHorPos'] . ':-15px;' . $mfbfw['closeVerPos'] . ':-15px}
	' . ( isset($mfbfw['paddingColor']) && $mfbfw['paddingColor'] ? 'div#fancybox-content{border-color:' . $mfbfw['paddingColor'] . '}' : '' ) . '
	' . ( isset($mfbfw['paddingColor']) && $mfbfw['paddingColor'] && $mfbfw['titlePosition'] == 'inside' ? 'div#fancybox-title{background-color:' . $mfbfw['paddingColor'] . '}' : '' ) . '
	div#fancybox-outer{background-color:' . $mfbfw['paddingColor'] . ( isset($mfbfw['border']) && $mfbfw['border'] ? ';border:1px solid ' . $mfbfw['borderColor'] : '' ) .  '}
	' . ( isset($mfbfw['titleColor']) && $mfbfw['titleColor'] && $mfbfw['titlePosition'] == 'inside' ? 'div#fancybox-title-inside{color:' . $mfbfw['titleColor'] . '}' : '' ) . '
</style>';

?>

<script type="text/javascript">
jQuery(function(){

jQuery.fn.getTitle = function() { // Copy the title of every IMG tag and add it to its parent A so that fancybox can show titles
	var arr = jQuery("a.fancybox");
	jQuery.each(arr, function() {
		var title = jQuery(this).children("img").attr("title");
		jQuery(this).attr("title",title);
	})
}

// Supported file extensions
var thumbnails = jQuery("a:has(img)").not(".nolightbox").filter( function() { return /\.(jpe?g|png|gif|bmp)$/i.test(jQuery(this).attr("href")) });

<?php if ( $mfbfw['galleryType'] == 'post' ) {

		// Gallery type BY POST and on post or page (so only one post or page is visible)
		if ( is_single() | is_page() ) {
			echo 'thumbnails.addClass("fancybox").attr("rel","fancybox").getTitle();';
		}

		// Gallery type BY POST, but neither on post or page, so make a different rel attribute on each post
		else {
			echo 'var posts = jQuery(".post");

posts.each(function() {
	jQuery(this).find(thumbnails).addClass("fancybox").attr("rel","fancybox"+posts.index(this)).getTitle()
});';
		}

	}

	// Gallery type ALL
	elseif ( $mfbfw['galleryType'] == 'all' ) {
		echo 'thumbnails.addClass("fancybox").attr("rel","fancybox").getTitle();';
	}

	// Gallery type NONE
	elseif ( $mfbfw['galleryType'] == 'none' ) {
		echo 'thumbnails.addClass("fancybox").getTitle();';
	}

	// Else, gallery type is custom, so just print the custom expression
	else {
		echo $mfbfw['customExpression'];
	}

	// Call fancybox and apply it on any link with a rel atribute that starts with "fancybox", with the options set on the admin panel
	?>

jQuery("a.fancybox").fancybox({
	'cyclic': <?php if ( isset($mfbfw['cyclic']) && $mfbfw['cyclic'] ) { echo "true"; } else { echo "false"; } ?>,
	'autoScale': <?php if ( isset($mfbfw['imageScale']) && $mfbfw['imageScale'] ) { echo "true"; } else { echo "false"; } ?>,
	'padding': <?php echo $mfbfw['padding']; ?>,
	'opacity': <?php if ( isset($mfbfw['zoomOpacity']) && $mfbfw['zoomOpacity'] ) { echo "true"; } else { echo "false"; } ?>,
	'speedIn': <?php echo $mfbfw['zoomSpeedIn']; ?>,
	'speedOut': <?php echo $mfbfw['zoomSpeedOut']; ?>,
	'changeSpeed': <?php echo $mfbfw['zoomSpeedChange']; ?>,
	'overlayShow': <?php if ( isset($mfbfw['overlayShow']) && $mfbfw['overlayShow'] ) { echo "true"; } else { echo "false"; } ?>,
	'overlayOpacity': <?php echo '"' . $mfbfw['overlayOpacity'] . '"'; ?>,
	'overlayColor': <?php echo '"' . $mfbfw['overlayColor'] . '"'; ?>,
	'titleShow': <?php if ( isset($mfbfw['titleShow']) && $mfbfw['titleShow'] ) { echo "true"; } else { echo "false"; } ?>,
	'titlePosition': '<?php echo $mfbfw['titlePosition']; ?>',
	'enableEscapeButton': <?php if ( isset($mfbfw['enableEscapeButton']) && $mfbfw['enableEscapeButton'] ) { echo "true"; } else { echo "false"; } ?>,
	'showCloseButton': <?php if ( isset($mfbfw['showCloseButton']) && $mfbfw['showCloseButton'] ) { echo "true"; } else { echo "false"; } ?>,
	'showNavArrows': <?php if ( isset($mfbfw['showNavArrows']) && $mfbfw['showNavArrows'] ) { echo "true"; } else { echo "false"; } ?>,
	'hideOnOverlayClick': <?php if ( isset($mfbfw['hideOnOverlayClick']) && $mfbfw['hideOnOverlayClick'] ) { echo "true"; } else { echo "false"; } ?>,
	'hideOnContentClick': <?php if ( isset($mfbfw['hideOnContentClick']) && $mfbfw['hideOnContentClick'] ) { echo "true"; } else { echo "false"; } ?>,
	'width': <?php echo $mfbfw['frameWidth']; ?>,
	'height': <?php echo $mfbfw['frameHeight']; ?>,
	'transitionIn': <?php echo '"' . $mfbfw['transitionIn'] . '"'; ?>,
	'transitionOut': <?php echo '"' . $mfbfw['transitionOut'] . '"'; ?>,
<?php if ( isset($mfbfw['callbackEnable'], $mfbfw['callbackOnStart']) && $mfbfw['callbackEnable'] && $mfbfw['callbackOnStart'] ) echo "\t'onStart': ". $mfbfw['callbackOnStart'] .","."\n"; ?>
<?php if ( isset($mfbfw['callbackEnable'], $mfbfw['callbackOnCancel']) && $mfbfw['callbackEnable'] && $mfbfw['callbackOnCancel'] ) echo "\t'onCancel': ". $mfbfw['callbackOnCancel'] .","."\n"; ?>
<?php if ( isset($mfbfw['callbackEnable'], $mfbfw['callbackOnCleanup']) && $mfbfw['callbackEnable'] && $mfbfw['callbackOnCleanup'] ) echo "\t'onCleanup': ". $mfbfw['callbackOnCleanup'] .","."\n"; ?>
<?php if ( isset($mfbfw['callbackEnable'], $mfbfw['callbackOnComplete']) && $mfbfw['callbackEnable'] && $mfbfw['callbackOnComplete'] ) echo "\t'onComplete': ". $mfbfw['callbackOnComplete'] .","."\n"; ?>
<?php if ( isset($mfbfw['callbackEnable'], $mfbfw['callbackOnClose']) && $mfbfw['callbackEnable'] && $mfbfw['callbackOnClose'] ) echo "\t'onClosed': ". $mfbfw['callbackOnClose'] .","."\n"; ?>
	'centerOnScroll': <?php if ( isset($mfbfw['centerOnScroll']) && $mfbfw['centerOnScroll'] ) { echo "true"; } else { echo "false"; } ?><?php if ( isset($mfbfw['easing']) && $mfbfw['easing'] ) { ?>,
	'easingIn': <?php echo '"' . $mfbfw['easingIn'] . '"'; ?>,
	'easingOut': <?php echo '"' . $mfbfw['easingOut'] . '"'; ?>,
	'easingChange': <?php echo '"' . $mfbfw['easingChange'] . '"';
} ?>

});

<?php if ( isset($mfbfw['extraCallsEnable']) && $mfbfw['extraCallsEnable'] ) { echo $mfbfw['extraCalls'];  echo "\n"; } ?>

})
</script>
<?php echo "<!-- END Fancybox for WordPress -->\n";
}

// Check if inline script should be loaded in footer
if ( isset($mfbfw['loadAtFooter']) && $mfbfw['loadAtFooter'] ) {
	add_action( 'wp_footer', 'mfbfw_init' );
} else {
	add_action( 'wp_head', 'mfbfw_init' );
}




/**
 * Load text domain
 */

function mfbfw_textdomain() {

	if ( function_exists('load_plugin_textdomain') ) {
		load_plugin_textdomain( 'mfbfw', FBFW_URL . 'languages', 'fancybox-for-wordpress/languages' );
	}

}
add_action( 'init', 'mfbfw_textdomain' );



/**
 * Register options
 */

function mfbfw_admin_options() {

	if ( isset($_GET['page']) && $_GET['page'] == 'fancybox-for-wordpress' ) {

		if ( isset($_REQUEST['action']) && 'update' == $_REQUEST['action'] ) {

			$settings = stripslashes_deep( $_POST['mfbfw'] );
			$settings = array_map( 'convert_chars', $settings );

			update_option( 'mfbfw', $settings );
			wp_safe_redirect( add_query_arg('updated', 'true') );
			die;

		} else if ( isset($_REQUEST['action']) && 'reset' == $_REQUEST['action'] ) {

			$defaults_array = mfbfw_defaults(); // Store defaults in an array
			update_option( 'mfbfw', $defaults_array ); // Write defaults to database
			wp_safe_redirect( add_query_arg('reset', 'true') );
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
add_action('admin_menu', 'mfbfw_admin_menu');



/**
 * Load Admin CSS & JS (called in mfbfw_admin_menu())
 */

function mfbfw_admin_styles() {
	wp_enqueue_style( 'fancybox-admin', FBFW_URL . 'css/fancybox-admin.css' ); // Load custom CSS for Admin Page
}

function mfbfw_admin_scripts() {
	wp_enqueue_script( 'fancybox-admin', FBFW_URL . 'js/admin.js', array('jquery') ); // Load specific JS for Admin Page
}



/**
 * Settings Button on Plugins Panel
 */

function mfbfw_plugin_action_links($links, $file) {

	static $this_plugin;
	if ( ! $this_plugin ) $this_plugin = plugin_basename( __FILE__ );

	if ( $file == $this_plugin ){
		$settings_link = '<a href="options-general.php?page=fancybox-for-wordpress">' . __( 'Settings', 'mfbfw' ) . '</a>';
		array_unshift( $links, $settings_link );
	}

	return $links;

}
add_filter( 'plugin_action_links', 'mfbfw_plugin_action_links', 10, 2 );