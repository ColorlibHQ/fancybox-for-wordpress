				<h2><?php _e('Behavior Settings <span style="color:orange">(medium)</span>', 'mfbfw'); ?></h2>

				<p><?php _e('The following settings should be left on default unless you know what you are doing.', 'mfbfw'); ?></p>

				<table class="form-table" style="clear:none;">
					<tbody>

						<tr valign="top">
							<th scope="row"><?php _e('Auto Resize to Fit', 'mfbfw'); ?></th>
							<td>
								<fieldset>

									<label for="mfbfw_imageScale">
										<input type="checkbox" name="mfbfw_imageScale" id="mfbfw_imageScale"<?php if ($settings['imageScale']) echo ' checked="yes"';?> />
										<?php _e('Scale images to fit in viewport (default: on)', 'mfbfw'); ?>
									</label><br /><br />

								</fieldset>
							</td>
						</tr>

						<tr valign="top">
							<th scope="row"><?php _e('Center on Scroll', 'mfbfw'); ?></th>
							<td>
								<fieldset>

									<label for="mfbfw_centerOnScroll">
										<input type="checkbox" name="mfbfw_centerOnScroll" id="mfbfw_centerOnScroll"<?php if ($settings['centerOnScroll']) echo ' checked="yes"';?> />
										<?php _e('Keep image in the center of the browser window when scrolling (default: on)', 'mfbfw'); ?>
									</label><br /><br />

								</fieldset>
							</td>
						</tr>

						<tr valign="top">
							<th scope="row"><?php _e('Close on Content Click', 'mfbfw'); ?></th>
							<td>
								<fieldset>

									<label for="mfbfw_hideOnContentClick">
										<input type="checkbox" name="mfbfw_hideOnContentClick" id="mfbfw_hideOnContentClick"<?php if ($settings['hideOnContentClick']) echo ' checked="yes"';?> />
										<?php _e('Close FancyBox by clicking on the image (default: off)', 'mfbfw'); ?>
									</label><br />

									<small><em><?php _e('(You may want to leave this off if you display iframed or inline content that containts clickable elements - for example: play buttons for movies, links to other pages)', 'mfbfw'); ?></em></small><br /><br />

								</fieldset>
							</td>
						</tr>
						
						<tr valign="top">
							<th scope="row"><?php _e('Close on Overlay Click', 'mfbfw'); ?></th>
							<td>
								<fieldset>

									<label for="mfbfw_hideOnOverlayClick">
										<input type="checkbox" name="mfbfw_hideOnOverlayClick" id="mfbfw_hideOnOverlayClick"<?php if ($settings['hideOnOverlayClick']) echo ' checked="yes"';?> />
										<?php _e('Close FancyBox by clicking on the overlay sorrounding it (default: on)', 'mfbfw'); ?>
									</label><br /><br />

								</fieldset>
							</td>
						</tr>
						
						<tr valign="top">
							<th scope="row"><?php _e('Close with &quot;Esc&quot;', 'mfbfw'); ?></th>
							<td>
								<fieldset>

									<label for="mfbfw_enableEscapeButton">
										<input type="checkbox" name="mfbfw_enableEscapeButton" id="mfbfw_enableEscapeButton"<?php if ($settings['enableEscapeButton']) echo ' checked="yes"';?> />
										<?php _e('Close FancyBox when &quot;Escape&quot; key is pressed (default: on)', 'mfbfw'); ?>
									</label><br /><br />

								</fieldset>
							</td>
						</tr>

					</tbody>
				</table>