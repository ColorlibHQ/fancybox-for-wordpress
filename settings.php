<?php

/*-----------------------------------------------------------------------------------*/
/* Default settings
/*-----------------------------------------------------------------------------------*/

function mfbfw_defaults() {
	$defaults_array = array(

		// Appearance
		'border'                => '',
		'borderColor'           => '#BBBBBB',
		'showCloseButton'       => 'on',
		'closeHorPos'           => 'right',
		'closeVerPos'           => 'top',
		'paddingColor'			=> '#FFFFFF',
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
		'autoDimensions'        => 'on',//
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



/*-----------------------------------------------------------------------------------*/
/* When plugin is installed, write defaul settings and update version
/*-----------------------------------------------------------------------------------*/

function mfbfw_install() {

	// If settings pressent populate database with defaults
	if ( get_option( 'mfbfw_active_version' ) == false ) {

		$defaults_array = mfbfw_defaults();

		add_option( 'mfbfw', $defaults_array );
		add_option( 'mfbfw_active_version', FBFW_VERSION );

	}

}
register_activation_hook( __FILE__, 'mfbfw_install' );



/*-----------------------------------------------------------------------------------*/
/* Plugin update and settings conversion
/*-----------------------------------------------------------------------------------*/

// Get database version and convert to integrer to compare with current version
$db_version =  intval( str_replace( ".", "", get_option('mfbfw_active_version') ) );
$current_version =  intval( str_replace( ".", "", FBFW_VERSION ) );


// If lower than current version we need to get old options, convert, and delete them
if ( $db_version < $current_version ) {

	$old_settings_array = array (

		'titleShow'                => get_option('mfbfw_showTitle'),
		'border'                   => get_option('mfbfw_border'),
		'borderColor'              => get_option('mfbfw_borderColor'),
		'closeHorPos'              => get_option('mfbfw_closeHorPos'),
		'closeVerPos'              => get_option('mfbfw_closeVerPos'),
		'paddingColor'             => get_option('mfbfw_paddingColor'),
		'padding'                  => get_option('mfbfw_padding'),
		'overlayShow'              => get_option('mfbfw_overlayShow'),
		'overlayColor'             => get_option('mfbfw_overlayColor'),
		'overlayOpacity'           => get_option('mfbfw_overlayOpacity'),
		'zoomOpacity'              => get_option('mfbfw_zoomOpacity'),
		'zoomSpeedIn'              => get_option('mfbfw_zoomSpeedIn'),
		'zoomSpeedOut'             => get_option('mfbfw_zoomSpeedOut'),
		'zoomSpeedChange'          => get_option('mfbfw_zoomSpeedChange'),
		'easing'                   => get_option('mfbfw_easing'),
		'easingIn'                 => get_option('mfbfw_easingIn'),
		'easingOut'                => get_option('mfbfw_easingOut'),
		'easingChange'             => get_option('mfbfw_easingChange'),

		'imageScale'               => get_option('mfbfw_imageScale'),
		'enableEscapeButton'       => get_option('mfbfw_enableEscapeButton'),
		'showCloseButton'          => get_option('mfbfw_showCloseButton'),
		'centerOnScroll'           => get_option('mfbfw_centerOnScroll'),
		'hideOnOverlayClick'       => get_option('mfbfw_hideOnOverlayClick'),
		'hideOnContentClick'       => get_option('mfbfw_hideOnContentClick'),
		'loadAtFooter'             => get_option('mfbfw_loadAtFooter'),
		'frameWidth'               => get_option('mfbfw_frameWidth'),
		'frameHeight'              => get_option('mfbfw_frameHeight'),

		'callbackOnStart'          => get_option('mfbfw_callbackOnStart'),
		'callbackOnComplete'       => get_option('mfbfw_callbackOnShow'),
		'callbackOnClose'          => get_option('mfbfw_callbackOnClose'),

		'galleryType'              => get_option('mfbfw_galleryType'),
		'customExpression'         => get_option('mfbfw_customExpression'),

		'nojQuery'                 => get_option('mfbfw_nojQuery'),
		'jQnoConflict'             => get_option('mfbfw_jQnoConflict'),

		'uninstall'                => get_option('mfbfw_uninstall'),


		// New Settings since 3.0
		'titlePosition'            => 'inside',
		'titleColor'               => '#333333',
		'showNavArrows'            => 'on',

		'transitionIn'             => 'fade',
		'transitionOut'            => 'fade',

		'cyclic'                   => '',
		'mouseWheel'               => '',

		'autoDimensions'           => 'on',

		'callbackEnable'           => '',
		'callbackOnCancel'         => 'function() { alert("Cancel!"); }',
		'callbackOnCleanup'        => 'function() { alert("CleanUp!"); }',

		'extraCallsEnable'         => '',
		'extraCalls'               => ''

	);

	// save old settings to database in a single serialized option
	add_option( 'mfbfw', $old_settings_array );

	// Get deprecated settings and delete them from database
	$deprecated_array = array (
		'mfbfw_version',
		'mfbfw_showTitle',
		'mfbfw_border',
		'mfbfw_borderColor',
		'mfbfw_closeHorPos',
		'mfbfw_closeVerPos',
		'mfbfw_paddingColor',
		'mfbfw_padding',
		'mfbfw_overlayShow',
		'mfbfw_overlayColor',
		'mfbfw_overlayOpacity',
		'mfbfw_zoomOpacity',
		'mfbfw_zoomSpeedIn',
		'mfbfw_zoomSpeedOut',
		'mfbfw_zoomSpeedChange',
		'mfbfw_easing',
		'mfbfw_easingIn',
		'mfbfw_easingOut',
		'mfbfw_easingChange',
		'mfbfw_imageScale',
		'mfbfw_enableEscapeButton',
		'mfbfw_showCloseButton',
		'mfbfw_centerOnScroll',
		'mfbfw_hideOnOverlayClick',
		'mfbfw_hideOnContentClick',
		'mfbfw_loadAtFooter',
		'mfbfw_frameWidth',
		'mfbfw_frameHeight',
		'mfbfw_callbackOnStart',
		'mfbfw_callbackOnShow',
		'mfbfw_callbackOnClose',
		'mfbfw_galleryType',
		'mfbfw_customExpression',
		'mfbfw_nojQuery',
		'mfbfw_jQnoConflict',
		'mfbfw_autoApply',
		'mfbfw_closePosition',
		'mfbfw_noTextLinks',
		'mfbfw_uninstall'
	);

	foreach ( $deprecated_array as $key ) {
		delete_option( $key );
	}

	// Update Version
	update_option( 'mfbfw_active_version', FBFW_VERSION );

}

?>