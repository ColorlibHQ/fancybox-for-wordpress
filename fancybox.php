<?php

/*
Plugin Name: FancyBox for WordPress
Plugin URI: https://wordpress.org/plugins/fancybox-for-wordpress/
Description: Integrates <a href="http://fancyapps.com/fancybox/3/">FancyBox 3</a> into WordPress.
Version: 3.1.8
Author: Colorlib
Author URI: https://colorlib.com/wp/

 * FancyBox is Copyright (c) 2008 - 2010 Janis Skarnelis
 * Dual licensed under the MIT and GPL licenses:
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl.html

 */

/**
 * Plugin Init
 */
// Constants
define( 'FBFW_VERSION', '3.1.8' );
define( 'FBFW_PATH', plugin_dir_path( __FILE__ ) );
define( 'FBFW_URL', plugin_dir_url( __FILE__ ) );
define( 'FBFW_PLUGIN_BASE', plugin_basename( __FILE__ ) );
define( 'FBFW_PREVIOUS_PLUGIN_VERSION', '3.0.14' );
define( 'FBFW_FILE_', __FILE__ );
define( 'PLUGIN_NAME', 'fancybox-for-wordpress' );


// Get Main Settings
$mfbfw         = get_option( 'mfbfw' );
$mfbfw_version = get_option( 'mfbfw_active_version' );

// If previous version detected
if ( is_admin() && isset( $mfbfw_version ) && $mfbfw_version < FBFW_VERSION ) {

	// get default settings and add any new ones to the database
	$current_settings = get_option( 'mfbfw' );
	$default_settings = mfbfw_defaults();
	$new_settings     = (array) $current_settings + (array) $default_settings;
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
		'border'                     => '',
		'borderColor'                => '#BBBBBB',
		'paddingColor'               => '#FFFFFF',
		'padding'                    => '10',
		'overlayShow'                => 'on',
		'overlayColor'               => '#666666',
		'overlayOpacity'             => '0.3',
		'titleShow'                  => 'on',
		'titlePosition'              => 'inside',
		'titleColor'                 => '#333333',
		'showNavArrows'              => 'on',
		'titleSize'                  => '14',
		'showCloseButton'            => '',
		'showToolbar'                => 'on',
		// Animations
		'zoomOpacity'                => 'on',
		'zoomSpeedIn'                => '500',
		'zoomSpeedChange'            => '300',
		'transitionIn'               => 'fade',
		'transitionEffect'           => 'fade',
		// Behaviour
		'hideOnOverlayClick'         => 'function(current, event) {
									return current.type === "image" ? "close" : false;
								  },',
		'hideOnContentClick'         => '',
		'enableEscapeButton'         => 'on',
		'cyclic'                     => '',
		'mouseWheel'                 => '',
		'disableWoocommercePages'    => '',
		'disableWoocommerceProducts' => '',
		// Gallery Type
		'galleryType'                => 'all',
		'customExpression'           => 'jQuery(thumbnails).attr("data-fancybox","gallery").getTitle();',
		// Misc
		'autoDimensions'             => 'on',
		'frameWidth'                 => '560',
		'frameHeight'                => '340',
		'loadAtFooter'               => '',
		'callbackEnable'             => '',
		'callbackOnStart'            => 'function() { alert("Start!"); }',
		'callbackOnCancel'           => 'function() { alert("Cancel!"); }',
		'callbackOnComplete'         => 'function() { alert("Complete!"); }',
		'callbackOnCleanup'          => 'function() { alert("CleanUp!"); }',
		'callbackOnClose'            => 'function() { alert("Close!"); }',
		'copyTitleFunction'          => 'var arr = jQuery("a[data-fancybox]");
                                jQuery.each(arr, function() {
                                    var title = jQuery(this).children("img").attr("title");
                                    var caption = jQuery(this).next("figcaption").html();
                                    if(caption.length){jQuery(this).attr("title",title+" " + caption)}else{ jQuery(this).attr("title",title);};
                                });	',
		'nojQuery'                   => '',
		'extraCallsEnable'           => '',
		'extraCallsData'             => '',
		'uninstall'                  => '',
	);

	return $default_settings;
}

/**
 * If requested, when plugin is deactivated, remove settings
 */
function mfbfw_deactivate() {

	global $mfbfw;

	if ( isset( $mfbfw['uninstall'] ) && $mfbfw['uninstall'] ) {
		delete_option( 'mfbfw' );
		delete_option( 'mfbfw_active_version' );
	}
}

register_deactivation_hook( __FILE__, 'mfbfw_deactivate' );

/**
 * Load FancyBox JS with jQuery and
 */
function mfbfw_enqueue_scripts() {

	global $mfbfw, $wp_styles;

	// Check if script should be loaded in footer
	if ( isset( $mfbfw['loadAtFooter'] ) && $mfbfw['loadAtFooter'] ) {
		$footer = true;
	} else {
		$footer = false;
	}

	// Check if plugin should not call jQuery script (for troubleshooting only)
	if ( isset( $mfbfw['nojQuery'] ) && $mfbfw['nojQuery'] ) {
		$jquery = false;
	} else {
		$jquery = array( 'jquery' );
	}

	// Register Scripts
	wp_register_script( 'fancybox', FBFW_URL . 'assets/js/jquery.fancybox.js', $jquery, '1.3.4', $footer ); // Main Fancybox script
	// Enqueue Scripts
	wp_enqueue_script( 'fancybox' ); // Load fancybox

	if ( isset( $mfbfw['easing'] ) && $mfbfw['easing'] ) {
		wp_enqueue_script( 'jqueryeasing' ); // Load easing javascript file if required
	}

	if ( isset( $mfbfw['wheel'] ) && $mfbfw['wheel'] ) {
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

	//caption function to display image title
	$caption = 'function( instance, item ) {' .
	           'var testing = jQuery(this).context.title;' .
	           'var caption = jQuery(this).data(\'caption\') || \'\';' .
	           'if ( item.type === \'image\' && testing.length ) {' .
	           'caption = (caption.length ? caption + \'<br />\' : \'\') + \'<p class="caption-title">\'+testing+\'</p>\' ;' .
	           '}' .
	           'return caption;' .
	           '}';

	// fix undefined index copyTitleFunction. $mfbfw array misses this index.

	$mfbfw['copyTitleFunction'] = 'var arr = jQuery("a[data-fancybox]");
									jQuery.each(arr, function() {
										var title = jQuery(this).children("img").attr("title");
										 var caption = jQuery(this).next("figcaption").html();
                                        if(caption && title){jQuery(this).attr("title",title+" " + caption)}else if(title){ jQuery(this).attr("title",title);}else if(caption){jQuery(this).attr("title",caption);}
									});	';


	if ( $mfbfw['titlePosition'] == 'inside' ) {
		$afterLoad = 'function( instance, current ) {';
		$afterLoad .= 'current.$content.append(\'<div class=\"fancybox-custom-caption\" style=\" position: absolute;left:0;right:0;color:#000;padding-top:10px;bottom:-50px;margin:0 auto;text-align:center; \">\' + current.opts.caption + \'</div>\');';
		$afterLoad .= '}';
		$hideCaption = 'div.fancybox-caption{display:none !important;}';
	} else if ( $mfbfw['titlePosition'] == 'over' ) {
		$afterLoad = 'function( instance, current ) {';
		$afterLoad .= 'current.$content.append(\'<div class=\"fancybox-custom-caption\" style=\" position: absolute;left:0;right:0;color:#000;padding-top:10px;bottom:0;margin:0 auto;text-align:center; \">\' + current.opts.caption + \'</div>\');';
		$afterLoad .= '}';
		$hideCaption = 'div.fancybox-caption{display:none !important;}';
	} else {
		$afterLoad .= '""';
		$hideCaption = '';
	}


	if ( isset( $mfbfw['autoDimensions'] ) && $mfbfw['autoDimensions'] == true ) {
		$frameSize = '';
	} else {
		$frameSize = ' "width": ' . $mfbfw['frameWidth'] . ',
			"height": ' . $mfbfw['frameHeight'] . ',';
	}


	$mfbfw['customExpression'] = str_replace( '"rel"', '"data-fancybox"', $mfbfw['customExpression'] );

	//title position settings
	if ( isset( $mfbfw['titlePosition'] ) ) {
		if ( $mfbfw['titlePosition'] == 'inside' ) {
			$captionPosition = 'div.fancybox-caption p.caption-title {background:#fff; width:auto;padding:10px 30px;}';
		} elseif ( $mfbfw['titlePosition'] == 'float' ) {
			$captionPosition = 'div.fancybox-caption p.caption-title {background:#fff;color:#000;padding:10px 30px;width:auto;}';
		} else {
			$captionPosition = 'div.fancybox-caption {position:relative;max-width:50%;margin:0 auto;min-width:480px;padding:15px;}div.fancybox-caption p.caption-title{position:relative;left:0;right:0;margin:0 auto;top:0px;color:#fff;}';
		}
	}

	if ( ( isset( $mfbfw['disableWoocommerceProducts'] ) && $mfbfw['disableWoocommerceProducts'] == true && fancy_check_if_woocommerce() == 'product' ) || ( isset( $mfbfw['disableWoocommercePages'] ) && $mfbfw['disableWoocommercePages'] == true && fancy_check_if_woocommerce() == 'shop_page' ) ) {

	} else {


		echo '
<!-- Fancybox for WordPress v' . $mfbfw_version . ' -->
<style type="text/css">
	'.$hideCaption.'
	' . ( isset( $mfbfw['overlayShow'] ) ? '' : 'div.fancybox-bg{background:transparent !important;}' ) . '
	' . 'img.fancybox-image{border-width:' . $mfbfw['padding'] . 'px;border-color:' . $mfbfw['paddingColor'] . ';border-style:solid;height:auto;}' . '
	' . ( isset( $mfbfw['overlayColor'] ) && $mfbfw['overlayColor'] ? 'div.fancybox-bg{background-color:' . hexTorgba( $mfbfw['overlayColor'], $mfbfw['overlayOpacity'] ) . ';opacity:1 !important;}' : '' ) . ( isset( $mfbfw['paddingColor'] ) && $mfbfw['paddingColor'] ? 'div.fancybox-content{border-color:' . $mfbfw['paddingColor'] . '}' : '' ) . '
	' . ( isset( $mfbfw['paddingColor'] ) && $mfbfw['paddingColor'] && $mfbfw['titlePosition'] == 'inside' ? 'div#fancybox-title{background-color:' . $mfbfw['paddingColor'] . '}' : '' ) . '
	div.fancybox-content{background-color:' . $mfbfw['paddingColor'] . ( isset( $mfbfw['border'] ) && $mfbfw['border'] ? ';border:1px solid ' . $mfbfw['borderColor'] : '' ) . '}
	' . ( isset( $mfbfw['titleColor'] ) && $mfbfw['titleColor'] && $mfbfw['titlePosition'] == 'inside' ? 'div#fancybox-title-inside{color:' . $mfbfw['titleColor'] . '}' : '' ) . '
	' . ( isset( $mfbfw['borderRadius'] ) ? 'div.fancybox-content{border-radius:' . $mfbfw['borderRadius'] . 'px}' : '' ) . '
	' . ( isset( $mfbfw['borderRadiusInner'] ) ? 'img#fancybox-img{border-radius:' . $mfbfw['borderRadiusInner'] . 'px}' : '' ) . '
	' . ( isset( $mfbfw['shadowSize'] ) && $mfbfw['shadowOffset'] && $mfbfw['shadowOpacity'] ? 'div.fancybox-content{box-shadow:0 ' . $mfbfw['shadowOffset'] . 'px ' . $mfbfw['shadowSize'] . 'px rgba(0,0,0,' . $mfbfw['shadowOpacity'] . ')}' : '' ) . '
	' . ( isset( $mfbfw['titleShow'] ) ? 'div.fancybox-caption p.caption-title{display:inline-block}' : 'div.fancybox-caption p.caption-title{display:none}div.fancybox-caption{display:none;}' ) . '
	' . ( isset( $mfbfw['titleSize'] ) ? 'div.fancybox-caption p.caption-title{font-size:' . $mfbfw['titleSize'] . 'px}' : 'div.fancybox-caption p.caption-title{font-size:14px}' ) . '
	' . ( isset( $mfbfw['titleColor'] ) && $mfbfw['titlePosition'] == 'inside' ? 'div.fancybox-caption p.caption-title{color:' . $mfbfw['titleColor'] . '}' : 'div.fancybox-caption p.caption-title{color:#fff}' ) . '
	' . ( isset( $mfbfw['titlePosition'] ) ? 'div.fancybox-caption {color:' . $mfbfw['titleColor'] . '}' : 'div.fancybox-caption p.caption-title{color:#333333}' ) . $captionPosition . '
</style>';
?>
<script type="text/javascript">
	jQuery(function(){

		jQuery.fn.getTitle = function() { // Copy the title of every IMG tag and add it to its parent A so that fancybox can show titles
			<?php echo $mfbfw['copyTitleFunction'] ?>
		}

		// Supported file extensions
		var thumbnails = jQuery("a:has(img)").not(".nolightbox").not('.envira-gallery-link').not('.ngg-simplelightbox').filter( function() { return /\.(jpe?g|png|gif|mp4|webp|bmp|pdf)(\?[^/]*)*$/i.test(jQuery(this).attr('href')) });

		// Add data-type iframe for links that are not images or videos.
        var iframeLinks = jQuery('.fancyboxforwp').filter( function() { return ! /\.(jpe?g|png|gif|mp4|webp|bmp|pdf)(\?[^/]*)*$/i.test(jQuery(this).attr('href')) }).filter( function() { return ! /vimeo|youtube/i.test(jQuery(this).attr('href')) });
        iframeLinks.attr({ "data-type" : "iframe" }).getTitle();

		<?php if ( $mfbfw['galleryType'] == 'post' ) { ?>

			// Gallery type BY POST and on post or page (so only one post or page is visible)
			<?php if ( is_singular() ) { ?>
			// Gallery by post
			thumbnails.addClass("fancyboxforwp").attr("data-fancybox","gallery").getTitle();
            iframeLinks.attr({ "data-fancybox":"gallery" }).getTitle();

    <?php } else { ?>
			// Gallery by post
			var posts = jQuery(".post");
			posts.each(function() {
				jQuery(this).find(thumbnails).addClass("fancyboxforwp").attr("data-fancybox","gallery"+posts.index(this)).attr("rel","fancybox"+posts.index(this)).getTitle();

                jQuery(this).find(iframeLinks).attr({ "data-fancybox":"gallery"+posts.index(this) }).attr("rel","fancybox"+posts.index(this)).getTitle();

			});

			<?php } ?>

		// Gallery type ALL
		<?php } elseif ( $mfbfw['galleryType'] == 'all' ) { ?>
		// Gallery All
		thumbnails.addClass("fancyboxforwp").attr("data-fancybox","gallery").getTitle();
        iframeLinks.attr({ "data-fancybox":"gallery" }).getTitle();

		// Gallery type NONE
		<?php } elseif ( $mfbfw['galleryType'] == 'none' ) { ?>
		// No Galleries
		thumbnails.each(function(){
			var rel = jQuery(this).attr("rel");
			var imgTitle = jQuery(this).children("img").attr("title");
			jQuery(this).addClass("fancyboxforwp").attr("data-fancybox",rel);
			jQuery(this).attr("title",imgTitle);
		});

        iframeLinks.each(function(){
            var rel = jQuery(this).attr("rel");
            var imgTitle = jQuery(this).children("img").attr("title");
            jQuery(this).attr({"data-fancybox":rel});
            jQuery(this).attr("title",imgTitle);
        });

		// Else, gallery type is custom, so just print the custom expression
		<?php } else { ?>
			/* Custom Expression */
			<?php echo $mfbfw['customExpression']; ?>
		<?php } ?>



		// Call fancybox and apply it on any link with a rel atribute that starts with "fancybox", with the options set on the admin panel
		jQuery("a.fancyboxforwp").fancyboxforwp({
			loop: <?php echo ( isset( $mfbfw['cyclic'] ) && $mfbfw['cyclic'] ? 'true' : 'false' ) ?>,
			smallBtn: <?php echo ( isset( $mfbfw['showCloseButton'] ) && $mfbfw['showCloseButton'] ? 'true' : 'false' ) ?>,
			zoomOpacity: <?php echo ( isset( $mfbfw['zoomOpacity'] ) && $mfbfw['zoomOpacity'] ? '"auto"' : 'false' ) ?>,
			animationEffect: "<?php echo $mfbfw['transitionIn'] ?>",
			animationDuration: <?php echo $mfbfw['zoomSpeedIn'] ?>,
			transitionEffect: "<?php echo $mfbfw['transitionEffect'] ?>",
			transitionDuration : "<?php echo $mfbfw['zoomSpeedChange'] ?>",
			overlayShow: <?php echo ( isset( $mfbfw['overlayShow'] ) && $mfbfw['overlayShow'] ? 'true' : 'false' ) ?>,
			overlayOpacity: "<?php echo $mfbfw['overlayOpacity'] ?>",
			titleShow: <?php echo ( isset( $mfbfw['titleShow'] ) && $mfbfw['titleShow'] ? 'true' : 'false' ) ?>,
			titlePosition: "<?php echo $mfbfw['titlePosition'] ?>",
			keyboard: <?php echo ( isset( $mfbfw['enableEscapeButton'] ) && $mfbfw['enableEscapeButton'] ? 'true' : 'false' ) ?>,
			showCloseButton: <?php echo ( isset( $mfbfw['showCloseButton'] ) && $mfbfw['showCloseButton'] ? 'true' : 'false' ) ?>,
			arrows: <?php echo ( isset( $mfbfw['showNavArrows'] ) && $mfbfw['showNavArrows'] ? 'true' : 'false' ) ?>,
			clickContent: <?php echo ( isset( $mfbfw['hideOnContentClick'] ) && $mfbfw['hideOnContentClick'] ? '"close"' : 'false' ) ?>,
            clickSlide: <?php echo ( isset( $mfbfw['hideOnOverlayClick'] ) && $mfbfw['hideOnOverlayClick'] ? '"close"' : 'false' ) ?>,
			wheel: <?php echo ( isset( $mfbfw['mouseWheel'] ) && $mfbfw['mouseWheel'] ? 'true' : 'false' ) ?>,
			toolbar: <?php echo ( isset( $mfbfw['showToolbar'] ) && $mfbfw['showToolbar'] ? 'true' : 'false' ) ?>,
			preventCaptionOverlap: true,
			onInit: <?php echo ( isset( $mfbfw['callbackEnable'], $mfbfw['callbackOnStart'] ) && $mfbfw['callbackEnable'] && $mfbfw['callbackOnStart'] ? $mfbfw['callbackOnStart'] . ',' : 'function() { },' ) ?>
			onDeactivate: <?php echo ( isset( $mfbfw['callbackEnable'], $mfbfw['callbackOnCancel'] ) && $mfbfw['callbackEnable'] && $mfbfw['callbackOnCancel'] ? $mfbfw['callbackOnCancel'] . ',' : 'function() { },' ) ?>
			beforeClose: <?php echo ( isset( $mfbfw['callbackEnable'], $mfbfw['callbackOnCleanup'] ) && $mfbfw['callbackEnable'] && $mfbfw['callbackOnCleanup'] ? $mfbfw['callbackOnCleanup'] . ',' : 'function() { },' ) ?>
			afterShow: <?php echo ( isset( $mfbfw['callbackEnable'], $mfbfw['callbackOnComplete'] ) && $mfbfw['callbackEnable'] && $mfbfw['callbackOnComplete'] ? $mfbfw['callbackOnComplete'] . ',' : 'function() { },' ) ?>
			afterClose: <?php echo ( isset( $mfbfw['callbackEnable'], $mfbfw['callbackOnClose'] ) && $mfbfw['callbackEnable'] && $mfbfw['callbackOnClose'] ? $mfbfw['callbackOnClose'] . ',' : 'function() { },' ) ?>
			caption : <?php echo $caption ?>,
			afterLoad : <?php echo $afterLoad ?>,
			<?php echo $frameSize ?>
		});
		<?php if ( isset( $mfbfw['extraCallsEnable'] ) && $mfbfw['extraCallsEnable'] ) {
			echo "/* Extra Calls */";
            echo $mfbfw['extraCallsData'];
		} ?>

	})
</script>
<!-- END Fancybox for WordPress -->
<?php
	}
}

// Check if inline script should be loaded in footer
if ( isset( $mfbfw['loadAtFooter'] ) && $mfbfw['loadAtFooter'] ) {
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

	if ( isset( $_GET['page'] ) && $_GET['page'] == 'fancybox-for-wordpress' ) {

		if ( isset( $_REQUEST['action'] ) && 'reset' == $_REQUEST['action'] && check_admin_referer( 'mfbfw-options-reset' ) ) {

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
	wp_enqueue_script( 'jquery-ui-tabs', array( 'jquery-ui-core' ), true ); // Load jQuery UI Tabs JS for Admin Page
	wp_enqueue_script( 'fancybox-admin', FBFW_URL . 'assets/js/admin.js', array( 'jquery', 'wp-color-picker', 'updates' ), FBFW_VERSION, true ); // Load specific JS for Admin Page

	/* Load codemirror editor */
	$settings = wp_enqueue_code_editor( array( 'type' => 'text/javascript' ) );
}

/**
 * Settings Button on Plugins Panel
 */
function mfbfw_plugin_action_links(
	$links,
	$file
) {

	static $this_plugin;
	if ( ! $this_plugin ) {
		$this_plugin = plugin_basename( __FILE__ );
	}

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

function hexTorgba( $hexColor, $opacity ) {
	list( $r, $g, $b ) = sscanf( $hexColor, "#%02x%02x%02x" );
	if ( $opacity ) {
		$rgb = 'rgba(' . $r . ',' . $g . ',' . $b . ',' . $opacity . ')';
	} else {
		$rgb = 'rgba(' . $r . ',' . $g . ',' . $b . ')';
	}

	return $rgb;
}

/*
 *
 * Check if WooCommerce Product post
 *
 */
function fancy_check_if_woocommerce() {
	if ( class_exists( 'WooCommerce' ) ) {
		if ( is_shop() ) {
			return 'shop_page';
		} else if ( get_post_type( get_the_id() ) == 'product' ) {
			return 'product';
		} else {
			return 'true';
		}
	} else {
		return 'true';
	}
}

// Ajax request for activate link
add_action( 'wp_ajax_mfbfw_activate_link', 'mfbfw_get_activate_link' );
function mfbfw_get_activate_link() {

	$plugin_path = 'modula-best-grid-gallery/Modula.php';
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

	wp_die(
		wp_json_encode(
			array(
				'status' => 'succes',
				'link'   => $link,
			)
		)
	);

}