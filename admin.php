<?php

function mfbfw_options_page() {

	require_once( FBFW_PATH . 'lib/admin-head.php' );
	?>

	<div class="wrap about-wrap full-width-layout">
		<div id="icon-plugins" class="icon32"></div>
		<div class="inlined">
			<div id="pluginDescription">
				<h1><?php printf( __( 'Fancybox for WordPress (version %s)', 'mfbfw' ), FBFW_VERSION ); ?></h1>
				<p class="about-text">Seamlessly integrates FancyBox into your blog: Upload, activate, and you’re done. Additional configuration optional.</p></div>
			<div id="pluginLogo"><img src="<?php echo FBFW_URL . 'assets/images/icon.jpg'; ?>"></div>
		</div>

		<br />

		<form method="post" action="options.php" id="options">

			<?php settings_fields( 'mfbfw-options' ); ?>

			<div id="fbfwTabs">
				<ul class="nav-tab-wrapper wp-clearfix">
					<li><a href="#fbfw-info"><?php _e( 'Info', 'mfbfw' ); ?></a></li>
					<li><a href="#fbfw-appearance"><?php _e( 'Appearance', 'mfbfw' ); ?></a></li>
					<li><a href="#fbfw-animations"><?php _e( 'Animations', 'mfbfw' ); ?></a></li>
					<li><a href="#fbfw-behaviour"><?php _e( 'Behaviour', 'mfbfw' ); ?></a></li>
					<li><a href="#fbfw-galleries"><?php _e( 'Galleries', 'mfbfw' ); ?></a></li>
					<li><a href="#fbfw-other"><?php _e( 'Misc.', 'mfbfw' ); ?></a></li>
					<!--<li><a href="#fbfw-calls"><?php _e( 'Extra Calls', 'mfbfw' ); ?></a></li>-->
					<!--<li><a href="#fbfw-troubleshooting"><?php _e( 'Troubleshooting', 'mfbfw' ); ?></a></li>-->
					<li><a href="#fbfw-support" style="color:green;"><?php _e( 'Support', 'mfbfw' ); ?></a></li>
					<!--<li><a href="#fbfw-uninstall" style="color:red;"><?php _e( 'Uninstall', 'mfbfw' ); ?></a></li>-->
				</ul>

				<div id="fbfw-info">
					<?php require_once ( FBFW_PATH . 'lib/admin-tab-info.php' ); ?>
				</div>

				<div id="fbfw-appearance">
					<?php require_once ( FBFW_PATH . 'lib/admin-tab-appearance.php' ); ?>
				</div>

				<div id="fbfw-animations">
					<?php require_once ( FBFW_PATH . 'lib/admin-tab-animations.php' ); ?>
				</div>

				<div id="fbfw-behaviour">
					<?php require_once ( FBFW_PATH . 'lib/admin-tab-behaviour.php' ); ?>
				</div>

				<div id="fbfw-galleries">
					<?php require_once ( FBFW_PATH . 'lib/admin-tab-galleries.php' ); ?>
				</div>

				<div id="fbfw-other">
					<?php require_once ( FBFW_PATH . 'lib/admin-tab-other.php' ); ?>
				</div>

				<!--<div id="fbfw-calls">
					<?php require_once ( FBFW_PATH . 'lib/admin-tab-calls.php' ); ?>
				</div>

				<div id="fbfw-troubleshooting">
					<?php require_once ( FBFW_PATH . 'lib/admin-tab-troubleshooting.php' ); ?>
				</div>-->

				<div id="fbfw-support">
					<?php require_once ( FBFW_PATH . 'lib/admin-tab-support.php' ); ?>
				</div>
<!--
				<div id="fbfw-uninstall">
					<?php require_once ( FBFW_PATH . 'lib/admin-tab-uninstall.php' ); ?>
				</div>
-->
			</div>

			<p class="submit" style="text-align:center;">
				<input type="submit" name="mfbfw_update" class="button-primary" value="<?php esc_attr_e( 'Save Changes', 'mfbfw' ); ?>" />
			</p>

		</form>

		<form method="post" action="">
			<div style="text-align:center;padding:0 0 1.5em;margin:-15px 0 5px;">
				<?php wp_nonce_field( 'mfbfw-options-reset' ); ?>
				<input type="submit" name="mfbfw_update" id="reset" onClick="return confirmDefaults();" class="button-secondary" value="<?php esc_attr_e( 'Revert to defaults', 'mfbfw' ); ?>" />
				<input type="hidden" name="action" value="reset" />
			</div>
		</form>

		<div id="mfbfwd" style="border-top:1px dashed #DDDDDD;margin:20px 0 40px;overflow:hidden;padding-top:25px;width:100%;float:left">

			Plugin developed and supported by <a href="https://colorlib.com">Colorlib</a>

		</div>

	</div>

	<?php
}
?>
