<?php
/*
Plugin Name: FancyBox for WordPress
Plugin URI: http://blog.moskis.net/downloads/plugins/fancybox-for-wordpress/
Description: Integrates <a href="http://fancy.klade.lv/">FancyBox</a> by <a href="http://klade.lv/">Janis Skarnelis</a> into WordPress.
Version: 2.7.5
Author: Jos&eacute; Pardilla
Author URI: http://josepardilla.com/

 * FancyBox is Copyright (c) 2008 - 2010 Janis Skarnelis
 * Dual licensed under the MIT and GPL licenses:
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl.html

*/


// Define paths
define('FBFW_PATH', dirname(__FILE__));
define('FBFW_URL', WP_PLUGIN_URL . '/fancybox-for-wordpress');

// When plugin is activated, update version, and set any new settings to default
function mfbfw_install() {

		update_option('mfbfw_active_version', '2.7.5');

		add_option('mfbfw_showTitle',					'on');
		add_option('mfbfw_border',						'');
		add_option('mfbfw_borderColor',				'#BBBBBB');
		add_option('mfbfw_closeHorPos',				'right');
		add_option('mfbfw_closeVerPos',				'top');
		add_option('mfbfw_paddingColor',			'#FFFFFF');
		add_option('mfbfw_padding',						'10');
		add_option('mfbfw_overlayShow',				'on');
		add_option('mfbfw_overlayColor',			'#666666');
		add_option('mfbfw_overlayOpacity',		'0.3');
		add_option('mfbfw_zoomOpacity',				'on');
		add_option('mfbfw_zoomSpeedIn',				'500');
		add_option('mfbfw_zoomSpeedOut',			'500');
		add_option('mfbfw_zoomSpeedChange',		'300');
		add_option('mfbfw_easing',						'');
		add_option('mfbfw_easingIn',					'easeOutBack');
		add_option('mfbfw_easingOut',					'easeInBack');
		add_option('mfbfw_easingChange',			'easeInOutQuart');

		add_option('mfbfw_imageScale',					'on');
		add_option('mfbfw_enableEscapeButton',	'on');
		add_option('mfbfw_showCloseButton',			'on');
		add_option('mfbfw_centerOnScroll',			'on');
		add_option('mfbfw_hideOnOverlayClick',	'on');
		add_option('mfbfw_hideOnContentClick',	'');
		add_option('mfbfw_loadAtFooter',				'');
		add_option('mfbfw_frameWidth',					'560');
		add_option('mfbfw_frameHeight',					'340');
		
		add_option('mfbfw_callbackOnStart',			'');
		add_option('mfbfw_callbackOnShow',			'');
		add_option('mfbfw_callbackOnClose',			'');

		add_option('mfbfw_galleryType',					'all');
		add_option('mfbfw_customExpression',		'jQuery(thumbnails).addClass("fancybox").attr("rel","fancybox").getTitle();');

		add_option('mfbfw_nojQuery',				'');
		add_option('mfbfw_jQnoConflict',		'on');

		add_option('mfbfw_uninstall',				'');

		// Settings, on previous versions, no longer used
		delete_option('mfbfw_autoApply');
		delete_option('mfbfw_closePosition');
		delete_option('mfbfw_noTextLinks');

}


// If requested, when plugin is deactivated, remove settings
function mfbfw_uninstall() {

	if (get_option('mfbfw_uninstall')) {

		delete_option('mfbfw_active_version');

		delete_option('mfbfw_showTitle');
		delete_option('mfbfw_border');
		delete_option('mfbfw_borderColor');
		delete_option('mfbfw_closeHorPos');
		delete_option('mfbfw_closeVerPos');
		delete_option('mfbfw_paddingColor');
		delete_option('mfbfw_padding');
		delete_option('mfbfw_overlayShow');
		delete_option('mfbfw_overlayColor');
		delete_option('mfbfw_overlayOpacity');
		delete_option('mfbfw_zoomOpacity');
		delete_option('mfbfw_zoomSpeedIn');
		delete_option('mfbfw_zoomSpeedOut');
		delete_option('mfbfw_zoomSpeedChange');
		delete_option('mfbfw_easing');
		delete_option('mfbfw_easingIn');
		delete_option('mfbfw_easingOut');
		delete_option('mfbfw_easingChange');

		delete_option('mfbfw_imageScale');
		delete_option('mfbfw_enableEscapeButton');
		delete_option('mfbfw_showCloseButton');
		delete_option('mfbfw_centerOnScroll');
		delete_option('mfbfw_hideOnOverlayClick');
		delete_option('mfbfw_hideOnContentClick');
		delete_option('mfbfw_loadAtFooter');
		delete_option('mfbfw_frameWidth');
		delete_option('mfbfw_frameHeight');
		
		delete_option('mfbfw_callbackOnStart');
		delete_option('mfbfw_callbackOnShow');
		delete_option('mfbfw_callbackOnClose');

		delete_option('mfbfw_galleryType');
		delete_option('mfbfw_customExpression');

		delete_option('mfbfw_nojQuery');
		delete_option('mfbfw_jQnoConflict');

		delete_option('mfbfw_uninstall');

	}

}


// Store plugin options in an array and return that array
function mfbfw_get_settings() {

	$mfbfwSettingsArray=array(

		'version'						=> get_option('mfbfw_active_version'),

		'showTitle'					=> get_option('mfbfw_showTitle'),
		'border'						=> get_option('mfbfw_border'),
		'borderColor'				=> get_option('mfbfw_borderColor'),
		'closeHorPos'				=> get_option('mfbfw_closeHorPos'),
		'closeVerPos'				=> get_option('mfbfw_closeVerPos'),
		'paddingColor'			=> get_option('mfbfw_paddingColor'),
		'padding'						=> get_option('mfbfw_padding'),
		'overlayShow'				=> get_option('mfbfw_overlayShow'),
		'overlayColor'			=> get_option('mfbfw_overlayColor'),
		'overlayOpacity'		=> get_option('mfbfw_overlayOpacity'),
		'zoomOpacity'				=> get_option('mfbfw_zoomOpacity'),
		'zoomSpeedIn'				=> get_option('mfbfw_zoomSpeedIn'),
		'zoomSpeedOut'			=> get_option('mfbfw_zoomSpeedOut'),
		'zoomSpeedChange'		=> get_option('mfbfw_zoomSpeedChange'),
		'easing'						=> get_option('mfbfw_easing'),
		'easingIn'					=> get_option('mfbfw_easingIn'),
		'easingOut'					=> get_option('mfbfw_easingOut'),
		'easingChange'			=> get_option('mfbfw_easingChange'),

		'imageScale'						=> get_option('mfbfw_imageScale'),
		'enableEscapeButton'		=> get_option('mfbfw_enableEscapeButton'),
		'showCloseButton'				=> get_option('mfbfw_showCloseButton'),
		'centerOnScroll'				=> get_option('mfbfw_centerOnScroll'),
		'hideOnOverlayClick'		=> get_option('mfbfw_hideOnOverlayClick'),
		'hideOnContentClick'		=> get_option('mfbfw_hideOnContentClick'),
		'loadAtFooter'					=> get_option('mfbfw_loadAtFooter'),
		'frameWidth'						=> get_option('mfbfw_frameWidth'),
		'frameHeight'						=> get_option('mfbfw_frameHeight'),
		
		'callbackOnStart'				=> get_option('mfbfw_callbackOnStart'),
		'callbackOnShow'				=> get_option('mfbfw_callbackOnShow'),
		'callbackOnClose'				=> get_option('mfbfw_callbackOnClose'),

		'galleryType'						=> get_option('mfbfw_galleryType'),
		'customExpression'			=> get_option('mfbfw_customExpression'),

		'nojQuery'							=> get_option('mfbfw_nojQuery'),
		'jQnoConflict'					=> get_option('mfbfw_jQnoConflict'),

		'uninstall'							=> get_option('mfbfw_uninstall')

	);

	return $mfbfwSettingsArray;

}


// Here we load FancyBox JS with jQuery and jQuery.easing if necessary
function mfbfw_load() {

	$settings = mfbfw_get_settings();
	
	if ($settings['loadAtFooter']) $loadAtFooter = true;

	if (!is_admin()) { // avoid the scripts from loading on admin panel

		if ($settings['nojQuery']) {

			wp_enqueue_script('fancybox', FBFW_URL . '/js/jquery.fancybox-1.2.6.min.js', $loadAtFooter); // Load fancybox without jQuery (for troubleshooting)

		} else {

			wp_enqueue_script('fancybox', FBFW_URL . '/js/jquery.fancybox-1.2.6.min.js', array('jquery'), '1.3.2', $loadAtFooter); // Load fancybox with jQuery

		}
		
		if (get_option('mfbfw_easing')) {

			wp_enqueue_script('jqueryeasing', FBFW_URL . '/js/jquery.easing.1.3.min.js', array('jquery'), '1.3.2', $loadAtFooter); // Load easing javascript file if required

		}
	
	}

}


// Link to FancyBox stylesheet and apply some custom styles
function mfbfw_css() {

	$settings = mfbfw_get_settings();

	echo "\n".'<link rel="stylesheet" href="'. FBFW_URL . '/css/fancybox.css" type="text/css" media="screen" />'."\n";

	?>

	<style type="text/css">
		div#fancy_inner {border-color:<?php echo $settings['borderColor']; ?>}
		div#fancy_close {<?php echo $settings['closeHorPos']; ?>:-15px;<?php echo $settings['closeVerPos']; ?>:-12px}
		div#fancy_bg {background-color:<?php echo $settings['paddingColor']; if ($settings['border']) { echo "; border:1px solid " . $settings['borderColor']; } ?>}
		<?php if (!$settings['showTitle']) { echo "div#fancy_title table {display:none} \n"; } ?>
	</style>

	<?php
	
}


// Load FancyBox with the settings set
function mfbfw_init() {
	
	$settings = mfbfw_get_settings();

	echo "\n"."\n"."<!-- Fancybox for WordPress v". $settings['version'] ." -->"."\n";
	
	?>

<script type="text/javascript">

	<?php if ($settings['jQnoConflict']) { ?>jQuery.noConflict();<?php } echo "\n" ?>

	jQuery(function(){

		<?php // This copies the title of every IMG tag and adds it to its parent A so that fancybox can use it ?>
		jQuery.fn.getTitle = function() {
			var arr = jQuery("a.fancybox");
			jQuery.each(arr, function() {
				var title = jQuery(this).children("img").attr("title");
				jQuery(this).attr('title',title);
			})
		}

		// Supported file extensions
		var thumbnails = 'a:has(img)[href$=".bmp"],a:has(img)[href$=".gif"],a:has(img)[href$=".jpg"],a:has(img)[href$=".jpeg"],a:has(img)[href$=".png"],a:has(img)[href$=".BMP"],a:has(img)[href$=".GIF"],a:has(img)[href$=".JPG"],a:has(img)[href$=".JPEG"],a:has(img)[href$=".PNG"]';

	<?php if ($settings['galleryType'] == 'post') {

		// Gallery type BY POST and we are on post or page (so only one post or page is visible)
		if ( is_single() | is_page() ) { ?>

		jQuery(thumbnails).addClass("fancybox").attr("rel","fancybox").getTitle();

	<?php }

	// Gallery type BY POST, but we are neither on post or page, so we make a different rel attribute on each post
	// (optimized based on sugestions from http://mentalfruition.com/)
	else { ?>

		var posts = jQuery('.post');

		posts.each(function() {
			jQuery(this).find(thumbnails).addClass("fancybox").attr('rel','fancybox'+posts.index(this)).getTitle()
		});


	<?php }
	
	}

	// Gallery type ALL
	elseif ($settings['galleryType'] == 'all') { ?>

		jQuery(thumbnails).addClass("fancybox").attr("rel","fancybox").getTitle();

	<?php }

	// Gallery type NONE
	elseif ($settings['galleryType'] == 'none') { ?>

		jQuery(thumbnails).addClass("fancybox").getTitle();

	<?php }

	// Else, gallery type is custom, so we just print the custom expression
	else {

		echo $settings['customExpression'];

	}

		// Now we call fancybox and apply it on any link with a rel atribute that starts with "fancybox", with the options set on the admin panel ?>
		jQuery("a.fancybox").fancybox({
			'imageScale': <?php if ($settings['imageScale']) { echo "true"; } else { echo "false"; } ?>,
			'padding': <?php echo $settings['padding']; ?>,
			'zoomOpacity': <?php if ($settings['zoomOpacity']) { echo "true"; } else { echo "false"; } ?>,
			'zoomSpeedIn': <?php echo $settings['zoomSpeedIn']; ?>,
			'zoomSpeedOut': <?php echo $settings['zoomSpeedOut']; ?>,
			'zoomSpeedChange': <?php echo $settings['zoomSpeedChange']; ?>,
			'overlayShow': <?php if ($settings['overlayShow']) { echo "true"; } else { echo "false"; } ?>,
			'overlayColor': <?php echo '"' . $settings['overlayColor'] . '"'; ?>,
			'overlayOpacity': <?php echo $settings['overlayOpacity']; ?>,
			'enableEscapeButton': <?php if ($settings['enableEscapeButton']) { echo "true"; } else { echo "false"; } ?>,
			'showCloseButton': <?php if ($settings['showCloseButton']) { echo "true"; } else { echo "false"; } ?>,
			'hideOnOverlayClick': <?php if ($settings['hideOnOverlayClick']) { echo "true"; } else { echo "false"; } ?>,
			'hideOnContentClick': <?php if ($settings['hideOnContentClick']) { echo "true"; } else { echo "false"; } ?>,
			'frameWidth':  <?php echo $settings['frameWidth']; ?>,
			'frameHeight':  <?php echo $settings['frameHeight']; ?>,
			<?php if ($settings['callbackOnStart']) { echo "'callbackOnStart': ". $settings['callbackOnStart'] .","."\n"; } ?>
			<?php if ($settings['callbackOnShow']) { echo "'callbackOnShow': ". $settings['callbackOnShow'] .","."\n"; } ?>
			<?php if ($settings['callbackOnClose']) { echo "'callbackOnClose': ". $settings['callbackOnClose'] .","."\n"; } ?>
			'centerOnScroll': <?php if ($settings['centerOnScroll']) { echo "true"; } else { echo "false"; } ?><?php if ($settings['easing']) { ?>,
			'easingIn': <?php echo '"' . $settings['easingIn'] . '"'; ?>,
			'easingOut': <?php echo '"' . $settings['easingOut'] . '"'; ?>,
			'easingChange': <?php echo '"' . $settings['easingChange'] . '"';
		} ?>

		});

})

</script>
<?php echo "<!-- END Fancybox for WordPress -->"."\n";

}


// Admin options page
function mfbfw_admin_menu() {

	require FBFW_PATH . '/admin.php';

	$mfbfwadmin = add_submenu_page('options-general.php', 'Fancybox for WordPress Options', 'Fancybox for WP', 10, 'fancybox-for-wordpress', 'mfbfw_options_page');
	add_action( "admin_print_scripts-$mfbfwadmin", 'mfbfw_admin_head' );

}

// Load Admin JS 
function mfbfw_admin_head() {
	wp_enqueue_script('jquery-ui-tabs', array('jquery-ui-core')); // Load jQuery UI Tabs for Admin Page
	wp_enqueue_script('fancyboxadmin', FBFW_URL . '/js/admin.js', array('jquery')); // Load specific JS for Admin Page
}


// Load text domain
function mfbfw_textdomain() {

	if (function_exists('load_plugin_textdomain')) {
		load_plugin_textdomain('mfbfw', FBFW_URL . '/languages', 'fancybox-for-wordpress/languages');
	}

}


// Settings Button on Plugins Panel
function mfbfw_plugin_action_links($links, $file) {

	static $this_plugin;
	if ( ! $this_plugin ) $this_plugin = plugin_basename(__FILE__);

	if ( $file == $this_plugin ){
		$settings_link = '<a href="options-general.php?page=fancybox-for-wordpress">' . __('Settings', 'mfbfw') . '</a>';
		array_unshift( $links, $settings_link );
	}

	return $links;

}


// Load text domain
function mfbfw_admin_init() {

		register_setting('mfbfw-options', 'mfbfw_showTitle');
		register_setting('mfbfw-options', 'mfbfw_border');
		register_setting('mfbfw-options', 'mfbfw_borderColor');
		register_setting('mfbfw-options', 'mfbfw_closeHorPos');
		register_setting('mfbfw-options', 'mfbfw_closeVerPos');
		register_setting('mfbfw-options', 'mfbfw_paddingColor');
		register_setting('mfbfw-options', 'mfbfw_padding');
		register_setting('mfbfw-options', 'mfbfw_overlayShow');
		register_setting('mfbfw-options', 'mfbfw_overlayColor');
		register_setting('mfbfw-options', 'mfbfw_overlayOpacity');
		register_setting('mfbfw-options', 'mfbfw_zoomOpacity');
		register_setting('mfbfw-options', 'mfbfw_zoomSpeedIn');
		register_setting('mfbfw-options', 'mfbfw_zoomSpeedOut');
		register_setting('mfbfw-options', 'mfbfw_zoomSpeedChange');
		register_setting('mfbfw-options', 'mfbfw_easing');
		register_setting('mfbfw-options', 'mfbfw_easingIn');
		register_setting('mfbfw-options', 'mfbfw_easingOut');
		register_setting('mfbfw-options', 'mfbfw_easingChange');
		register_setting('mfbfw-options', 'mfbfw_imageScale');
		register_setting('mfbfw-options', 'mfbfw_centerOnScroll');
		register_setting('mfbfw-options', 'mfbfw_enableEscapeButton');
		register_setting('mfbfw-options', 'mfbfw_showCloseButton');
		register_setting('mfbfw-options', 'mfbfw_hideOnOverlayClick');
		register_setting('mfbfw-options', 'mfbfw_hideOnContentClick');
		register_setting('mfbfw-options', 'mfbfw_loadAtFooter');
		register_setting('mfbfw-options', 'mfbfw_frameWidth');
		register_setting('mfbfw-options', 'mfbfw_frameHeight');
		register_setting('mfbfw-options', 'mfbfw_callbackOnStart');
		register_setting('mfbfw-options', 'mfbfw_callbackOnShow');
		register_setting('mfbfw-options', 'mfbfw_callbackOnClose');
		register_setting('mfbfw-options', 'mfbfw_galleryType');
		register_setting('mfbfw-options', 'mfbfw_customExpression');
		register_setting('mfbfw-options', 'mfbfw_nojQuery');
		register_setting('mfbfw-options', 'mfbfw_jQnoConflict');
		register_setting('mfbfw-options', 'mfbfw_uninstall');

}



// Actions
add_action('init', 'mfbfw_textdomain');           // Load Text Domain
add_action('wp_print_scripts', 'mfbfw_load');     // Load FancyBox Script
add_action('wp_print_styles', 'mfbfw_css');       // Fancybox Stylesheet
add_action('wp_head', 'mfbfw_init');              // Initiate Fancybox
add_action('admin_menu', 'mfbfw_admin_menu');     // Admin Panel Page
add_action('admin_init', 'mfbfw_admin_init');     // Register options


// Filters
add_filter( 'plugin_action_links', 'mfbfw_plugin_action_links', 10, 2 ); // Settings Button on Plugins Panel


// Install and Uninstall
register_activation_hook(__FILE__,'mfbfw_install');
register_deactivation_hook(__FILE__,'mfbfw_uninstall');

?>