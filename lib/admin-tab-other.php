				<h2><?php _e('Other Settings <span style="color:red">(advanced)</span>', 'mfbfw'); ?></h2>

				<p><?php _e('These are additional settings for advanced users.', 'mfbfw'); ?></p>
				
				<table class="form-table" style="clear:none;">
					<tbody>
					
						<tr valign="top">
							<th scope="row"><?php _e('Callbacks', 'mfbfw'); ?></th>
							<td>
								<fieldset>
								
									<label for="mfbfw_callbackOnStart">
										<?php _e('Callback on Start event (default: empty)', 'mfbfw'); ?>
										<textarea rows="10" cols="50" class="large-text code" name="mfbfw_callbackOnStart" wrap="physical" id="mfbfw_callbackOnStart"><?php echo ($settings['callbackOnStart']); ?></textarea>
									</label><br /><br />
									
									<label for="mfbfw_callbackOnShow">
										<?php _e('Callback on Show event (default: empty)', 'mfbfw'); ?>
										<textarea rows="10" cols="50" class="large-text code" name="mfbfw_callbackOnShow" wrap="physical" id="mfbfw_callbackOnShow"><?php echo ($settings['callbackOnShow']); ?></textarea>
									</label><br /><br />
									
									<label for="mfbfw_callbackOnClose">
										<?php _e('Callback on Close event (default: empty)', 'mfbfw'); ?>
										<textarea rows="10" cols="50" class="large-text code" name="mfbfw_callbackOnClose" wrap="physical" id="mfbfw_callbackOnClose"><?php echo ($settings['callbackOnClose']); ?></textarea>
									</label><br />

									<small><strong><em><?php _e('Example:', 'mfbfw'); ?></em></strong></small><br />

									<small><em><code>function() { alert('Completed!'); }</code></em></small><br /><br />
									
									<small><em><?php _e('Leave the fields empty to disable.', 'mfbfw'); ?></em></small><br /><br />

								</fieldset>
							</td>
						</tr>
						
						<tr valign="top">
							<th scope="row"><?php _e('Frame Size', 'mfbfw'); ?></th>
							<td>
								<fieldset>

									<label for="mfbfw_frameWidth">
										<input type="text" name="mfbfw_frameWidth" id="mfbfw_frameWidth" value="<?php echo $settings['frameWidth']; ?>" size="4" maxlength="4" />
										<?php _e('Width in pixels of FancyBox when showing iframe content (default: 560)', 'mfbfw'); ?>
									</label><br /><br />

									<label for="mfbfw_frameHeight">
										<input type="text" name="mfbfw_frameHeight" id="mfbfw_frameHeight" value="<?php echo $settings['frameHeight']; ?>" size="4" maxlength="4" />
										<?php _e('Height in pixels of FancyBox when showing iframe content (default: 340)', 'mfbfw'); ?>
									</label><br /><br />

								</fieldset>
							</td>
						</tr>
						
						<tr valign="top">
							<th scope="row"><?php _e('Load JavaScript in Footer', 'mfbfw'); ?></th>
							<td>
								<fieldset>

									<label for="mfbfw_loadAtFooter">
										<input type="checkbox" name="mfbfw_loadAtFooter" id="mfbfw_loadAtFooter"<?php if ($settings['loadAtFooter']) echo ' checked="yes"';?> />
										<?php _e('Loads JavaScript at the end of the blog\'s HTML (experimental) (default: off)', 'mfbfw'); ?>
									</label><br />
									
									<small><em><?php _e('This option won\'t be recognized if you use <strong>Parallel Load</strong> plugin. In that case, you can do this from Parallel Load\'s options.', 'mfbfw'); ?></em></small><br /><br />

								</fieldset>
							</td>
						</tr>
						
					</tbody>
				</table>