				<h2><?php _e('Troubleshooting Settings', 'mfbfw'); ?></h2>

				<p><span style="color:red;"><?php _e('Settings in this section should only be changed if you are having problems with the plugin!', 'mfbfw'); ?></span></p>

				<p><?php _e('If the plugin doesn\'t seem to work, first you should check for other plugins that may be conflicting with this one, especially other Lightbox, Slimbox, etc. Make sure all your plugins and WordPress itself are up to date (this plugin has only been tested in WordPress 2.7 and above).', 'mfbfw'); ?></p>

				<p><?php _e('Change them one at a time and test to see if they help. Remember that having a cache plugin may prevent changes from taking effect immidiately, so clear cache after saving changes here or deactivate cache until you finish editing these options.', 'mfbfw'); ?></p><br />

				<table class="form-table" style="clear:none;">
					<tbody>

						<tr valign="top">
							<th scope="row"><?php _e('Do not call jQuery', 'mfbfw'); ?></th>
							<td>
								<fieldset>

									<label for="mfbfw_nojQuery">
										<input type="checkbox" name="mfbfw_nojQuery" id="mfbfw_nojQuery"<?php if ($settings['nojQuery']) echo ' checked="yes"';?> />
										<?php _e('Skip jQuery call. Use this only if jQuery is being loaded twice (default: off)', 'mfbfw'); ?>
									</label><br />

								</fieldset>
							</td>
						</tr>

						<tr valign="top">
							<th scope="row"><?php _e('jQuery "noConflict" Mode', 'mfbfw'); ?></th>
							<td>
								<fieldset>

									<label for="mfbfw_jQnoConflict">
										<input type="checkbox" name="mfbfw_jQnoConflict" id="mfbfw_jQnoConflict"<?php if ($settings['jQnoConflict']) echo ' checked="yes"';?> />
										<?php _e('Use jQuery noConflict mode (default: on)', 'mfbfw'); ?>
									</label><br />

									<small><em><?php _e('(Turning this off may cause problems if there are plugins activated that use other js framework like mootools, prototype, scriptaculous, etc.)', 'mfbfw'); ?></em></small><br /><br />

								</fieldset>
							</td>
						</tr>

					</tbody>
				</table>