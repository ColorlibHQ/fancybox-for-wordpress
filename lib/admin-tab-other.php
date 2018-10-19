<h3><?php _e( 'Other Settings <span style="color:red">(advanced)</span>', 'mfbfw' ); ?></h3>

<p><?php _e( 'These are additional settings for advanced users.', 'mfbfw' ); ?></p>

<table class="form-table fancy-table" style="clear:none;">
	<tbody>

		<tr valign="top">
			<th scope="row"><?php _e( 'Dimensions', 'mfbfw' ); ?></th>
			<td>
				<fieldset>
					<label for="frameWidth">
						<input type="text" name="mfbfw[frameWidth]" id="frameWidth" value="<?php echo $settings[ 'frameWidth' ]; ?>" size="4" maxlength="4" />
						<?php _e( 'Width for iframe and swf content. Also set for inline content if <em>autoDimensions</em> is disabled (default: 560)', 'mfbfw' ); ?>
					</label><br /><br />

					<label for="frameHeight">
						<input type="text" name="mfbfw[frameHeight]" id="frameHeight" value="<?php echo $settings[ 'frameHeight' ]; ?>" size="4" maxlength="4" />
						<?php _e( 'Height for iframe and swf content. Also set for inline content if <em>autoDimensions</em> is disabled (default: 340)', 'mfbfw' ); ?>
					</label><br /><br />
				</fieldset>
			</td>
		</tr>

		<tr valign="top">
			<th scope="row"><?php _e( 'Load JavaScript in Footer', 'mfbfw' ); ?></th>
			<td>
				<fieldset>
					<input type="checkbox" class="onoffswitch-checkbox" name="mfbfw[loadAtFooter]" id="loadAtFooter"<?php if ( isset( $settings[ 'loadAtFooter' ] ) && $settings[ 'loadAtFooter' ] ) echo ' checked="yes"'; ?> />
					<label for="loadAtFooter" class="onoffswitch-label"></label>
					<span class="switch-text"><?php _e( 'Loads JavaScript at the end of the blog\'s HTML (experimental) (default: off)', 'mfbfw' ); ?></span><div class="cf"></div><br />

					<small><em><?php _e( 'This option won\'t be recognized if you use <strong>Parallel Load</strong> plugin. In that case, you can do this from Parallel Load\'s options.', 'mfbfw' ); ?></em></small><br /><br />

				</fieldset>
			</td>
		</tr>

		<tr valign="top">
			<th scope="row"><?php _e( 'Callbacks', 'mfbfw' ); ?></th>
			<td>
				<fieldset>
					<input type="checkbox" class="onoffswitch-checkbox" name="mfbfw[callbackEnable]" id="callbackEnable"<?php if ( isset( $settings[ 'callbackEnable' ] ) && $settings[ 'callbackEnable' ] ) echo ' checked="yes"'; ?> />
					<label for="callbackEnable" class="onoffswitch-label"></label>
					<span class="switch-text"><?php _e( 'Enable callbacks (default: off)', 'mfbfw' ); ?></span><div class="cf"></div><br />

					<small><em><?php _e( 'Enabling this will show additional settings.', 'mfbfw' ); ?></em></small><br /><br />

					<div id="callbackBlock">

                        <?php _e( 'Callback on <strong>Start</strong> event: Will be called right before attempting to load the content', 'mfbfw' ); ?>
						<label for="callbackOnStart">
                            <div class="start-editing"><p><?php _e( 'Click to start editing', 'mfbfw' ); ?></p></div>
							<textarea rows="10" cols="50" class="large-text code" name="mfbfw[callbackOnStart]" wrap="physical" id="callbackOnStart"><?php echo ($settings[ 'callbackOnStart' ]); ?></textarea>
						</label><br /><br />

						<?php _e( 'Callback on <strong>Cancel</strong> event: Will be called after loading is canceled', 'mfbfw' ); ?>
						<label for="callbackOnCancel">
                            <div class="start-editing"><p><?php _e( 'Click to start editing', 'mfbfw' ); ?></p></div>
							<textarea rows="10" cols="50" class="large-text code" name="mfbfw[callbackOnCancel]" wrap="physical" id="callbackOnCancel"><?php echo ($settings[ 'callbackOnCancel' ]); ?></textarea>
						</label><br /><br />

						<?php _e( 'Callback on <strong>Complete</strong> event: Will be called once the content is displayed', 'mfbfw' ); ?>
						<label for="callbackOnComplete">
                            <div class="start-editing"><p><?php _e( 'Click to start editing', 'mfbfw' ); ?></p></div>
							<textarea rows="10" cols="50" class="large-text code" name="mfbfw[callbackOnComplete]" wrap="physical" id="callbackOnComplete"><?php echo ($settings[ 'callbackOnComplete' ]); ?></textarea>
						</label><br /><br />

						<?php _e( 'Callback on <strong>CleanUp</strong> event: Will be called just before closing', 'mfbfw' ); ?>
						<label for="callbackOnCleanup">
                            <div class="start-editing"><p><?php _e( 'Click to start editing', 'mfbfw' ); ?></p></div>
							<textarea rows="10" cols="50" class="large-text code" name="mfbfw[callbackOnCleanup]" wrap="physical" id="callbackOnCleanup"><?php echo ($settings[ 'callbackOnCleanup' ]); ?></textarea>
						</label><br /><br />

						<?php _e( 'Callback on <strong>Closed</strong> event: Will be called once FancyBox is closed', 'mfbfw' ); ?>
						<label for="callbackOnClosed">
                            <div class="start-editing"><p><?php _e( 'Click to start editing', 'mfbfw' ); ?></p></div>
							<textarea rows="10" cols="50" class="large-text code" name="mfbfw[callbackOnClose]" wrap="physical" id="callbackOnClosed"><?php echo ($settings[ 'callbackOnClose' ]); ?></textarea>
						</label><br /><br/>

						<small><strong><em><?php _e( 'Example:', 'mfbfw' ); ?></em></strong></small><br />
						<small><em><code>function() { alert('Hello world!'); }</code></em></small><br />
						<small><em><?php _e( 'Leave empty any speciic callbacks you don\'t need to use.', 'mfbfw' ); ?></em></small><br /><br />

					</div>

				</fieldset>
			</td>
		</tr>

	</tbody>
</table>

<h3><?php _e( 'Extra FancyBox Calls <span style="color:red">(advanced)</span>', 'mfbfw' ); ?></h3>

<p><?php _e( 'Here you can add as many additional calls to fancybox as you want, with different settings. For example, if you want to use fancybox with iframes or ajax on any specific link, you can configure those calls here without affecting the settings for images.', 'mfbfw' ); ?></p>

<p><?php _e( 'For information on the options available you can use here see <a href="http://fancyapps.com/fancybox/3/">FancyBox\'s API & Options page</a>.', 'mfbfw' ); ?></p>

<table class="form-table fancy-table" style="clear:none;">
	<tbody>

		<tr valign="top">
			<th scope="row"><?php _e( 'Additional FancyBox Calls', 'mfbfw' ); ?></th>
			<td>
				<fieldset>
					<input type="checkbox" class="onoffswitch-checkbox" name="mfbfw[extraCallsEnable]" id="extraCallsEnable"<?php if ( isset( $settings[ 'extraCallsEnable' ] ) && $settings[ 'extraCallsEnable' ] ) echo ' checked="yes"'; ?> />
					<label for="extraCallsEnable" class="onoffswitch-label"></label>
					<span class="switch-text"><?php _e( 'Additional FancyBox Calls (default: off)', 'mfbfw' ); ?></span><div class="cf"></div><br /><br />

					<div id="extraCallsBlock">

						<label for="extraCalls">
							<textarea rows="20" cols="50" class="large-text code" name="mfbfw[extraCallsData]" wrap="physical" id="extraCalls"><?php echo ($settings[ 'extraCallsData' ]); ?></textarea>
						</label><br /><br />

						<small><strong><em><?php _e( 'Example:', 'mfbfw' ); ?></em></strong></small><br />
						<small><em><code>
									jQuery("#login a").fancybox({<br />
									&nbsp;&nbsp;'transitionIn': 'elastic',<br />
									&nbsp;&nbsp;'speedIn': 600,<br />
									&nbsp;&nbsp;'speedOut': 200,<br />
									&nbsp;&nbsp;'type': 'iframe'<br />
									});
								</code></em></small><br /><br />
					</div>

				</fieldset>
			</td>
		</tr>

	</tbody>
</table>

<h3><?php _e( 'Troubleshooting Settings', 'mfbfw' ); ?></h3>

<p><span style="font-weight:bold;color:red;"><?php _e( 'Settings in this section should only be changed if you are having problems with the plugin!', 'mfbfw' ); ?></span></p>

<p><?php _e( 'If the plugin doesn\'t seem to work, first you should check for other plugins that may be conflicting with this one, especially other Lightbox, Slimbox, etc. Make sure all your plugins and WordPress itself are up to date (this plugin has only been tested in WordPress 2.7 and above).', 'mfbfw' ); ?></p>

<p><?php _e( 'Change them one at a time and test to see if they help. Remember that having a cache plugin may prevent changes from taking effect immidiately, so clear cache after saving changes here or deactivate cache until you finish editing these options.', 'mfbfw' ); ?></p><br />

<table class="form-table fancy-table" style="clear:none;">
	<tbody>

		<tr valign="top">
			<th scope="row"><?php _e( 'Do not call jQuery', 'mfbfw' ); ?></th>
			<td>
				<fieldset>
					<input type="checkbox" class="onoffswitch-checkbox" name="mfbfw[nojQuery]" id="nojQuery"<?php if ( isset( $settings[ 'nojQuery' ] ) && $settings[ 'nojQuery' ] ) echo ' checked="yes"'; ?> />
					<label for="nojQuery" class="onoffswitch-label"></label>
					<span class="switch-text"><?php _e( 'Skip jQuery call. Use this only if jQuery is being loaded twice (default: off)', 'mfbfw' ); ?></span><div class="cf"></div><br />

				</fieldset>
			</td>
		</tr>

	</tbody>
</table>

<h3><?php _e( 'Uninstall', 'mfbfw' ); ?></h3>

<p><?php _e( 'Like many other plugins, FancyBox for WordPress stores its settings on your WordPress\' options database table. Actually, these settings are not using more than a couple of kilobytes of space, but if you want to completely uninstall this plugin, check the option below, then save changes, and <strong>when you deactivate the plugin</strong>, all its settings will be removed from the database.', 'mfbfw' ); ?></p>

<table class="form-table fancy-table" style="clear:none;">
	<tbody>
		<tr valign="top">
			<th scope="row"><?php _e( 'Remove settings', 'mfbfw' ); ?></th>
			<td>
				<fieldset>
					<input type="checkbox" class="onoffswitch-checkbox" name="mfbfw[uninstall]" id="uninstall"<?php if ( isset( $settings[ 'uninstall' ] ) && $settings[ 'uninstall' ] ) echo ' checked="yes"'; ?> />
					<label for="uninstall" class="onoffswitch-label"></label>
					<span class="switch-text"><?php _e( 'Remove Settings when plugin is deactivated from the "Manage Plugins" page. (default: off)', 'mfbfw' ); ?></span><div class="cf"></div><br /><br />
				</fieldset>
			</td>
		</tr>
	</tbody>
</table>