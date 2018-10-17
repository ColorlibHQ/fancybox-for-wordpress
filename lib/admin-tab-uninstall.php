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