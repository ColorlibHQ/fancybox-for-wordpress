				<h2><?php _e('Appearance Settings <span style="color:green">(basic)</span>', 'mfbfw'); ?></h2>

				<p><?php _e('These setting control how Fancybox looks, they let you tweak color, borders and position of elements, like the image title and closing buttons.', 'mfbfw'); ?></p>

				<table class="form-table" style="clear:none;">
					<tbody>

						<tr valign="top">
							<th scope="row"><?php _e('Border Color', 'mfbfw'); ?></th>
							<td>
								<fieldset>
								
									<label for="mfbfw_border">
										<input type="checkbox" name="mfbfw_border" id="mfbfw_border"<?php if ($settings['border']) echo ' checked="yes"';?> />
										<?php _e('Show Border (default: off)', 'mfbfw'); ?>
									</label><br /><br />

									<label for="mfbfw_borderColor">
										<input type="text" name="mfbfw_borderColor" id="mfbfw_borderColor" value="<?php echo $settings['borderColor'] ?>" size="7" maxlength="7" />
										<?php _e('HTML color of the border (default: #BBBBBB)', 'mfbfw'); ?>
									</label><br /><br />

								</fieldset>
							</td>
						</tr>

						<tr valign="top">
							<th scope="row"><?php _e('Close Button', 'mfbfw'); ?></th>
							<td>
								<fieldset>

									<label for="mfbfw_showCloseButton">
										<input type="checkbox" name="mfbfw_showCloseButton" id="mfbfw_showCloseButton"<?php if ($settings['showCloseButton']) echo ' checked="yes"';?> />
										<?php _e('Show Close button (default: on)', 'mfbfw'); ?>
									</label><br /><br />

									<?php _e('Close button position:', 'mfbfw'); ?><br />
									<input id="mfbfw_closePosLeft" type="radio" value="left" name="mfbfw_closeHorPos"<?php if ($settings['closeHorPos'] == 'left') echo ' checked="yes"';?> />
									<label for="mfbfw_closePosLeft" style="padding-right:15px">
										<?php _e('Left', 'mfbfw'); ?>
									</label>

									<input id="mfbfw_closePosRight" type="radio" value="right" name="mfbfw_closeHorPos"<?php if ($settings['closeHorPos'] == 'right') echo ' checked="yes"';?> />
									<label for="mfbfw_closePosRight">
										<?php _e('Right (default)', 'mfbfw'); ?>
									</label><br />

									<input id="mfbfw_closePosBottom" type="radio" value="bottom" name="mfbfw_closeVerPos"<?php if ($settings['closeVerPos'] == 'bottom') echo ' checked="yes"';?> />
									<label for="mfbfw_closePosBottom" style="padding-right:15px">
										<?php _e('Bottom', 'mfbfw'); ?>
									</label>

									<input id="mfbfw_closePosTop" type="radio" value="top" name="mfbfw_closeVerPos"<?php if ($settings['closeVerPos'] == 'top') echo ' checked="yes"';?> />
									<label for="mfbfw_closePosTop">
										<?php _e('Top (default)', 'mfbfw'); ?>
									</label><br /><br />

								</fieldset>
							</td>
						</tr>

						<tr valign="top">
							<th scope="row"><?php _e('Padding', 'mfbfw'); ?></th>
							<td>
								<fieldset>

									<label for="mfbfw_paddingColor">
										<input type="text" name="mfbfw_paddingColor" id="mfbfw_paddingColor" value="<?php echo $settings['paddingColor'] ?>" size="7" maxlength="7" />
										<?php _e('HTML color of the padding (default: #FFFFFF)', 'mfbfw'); ?>
									</label><br />
									
									<small><em><?php _e('(This should be left on #FFFFFF (white) if you want to display anything other than images, like inline or framed content)', 'mfbfw'); ?></em></small><br /><br />

									<label for="mfbfw_padding">
										<input type="text" name="mfbfw_padding" id="mfbfw_padding" value="<?php echo $settings['padding']; ?>" size="7" maxlength="7" />
										<?php _e('Padding size in pixels (default: 10)', 'mfbfw'); ?>
									</label><br /><br />

								</fieldset>
							</td>
						</tr>

						<tr valign="top">
							<th scope="row"><?php _e('Overlay Options', 'mfbfw'); ?></th>
							<td>
								<fieldset>

									<label for="mfbfw_overlayShow">
										<input type="checkbox" name="mfbfw_overlayShow" id="mfbfw_overlayShow"<?php if ($settings['overlayShow']) echo ' checked="yes"';?> />
										<?php _e('Add overlay (default: on)', 'mfbfw'); ?>
									</label><br /><br />

									<label for="mfbfw_overlayColor">
										<input type="text" name="mfbfw_overlayColor" id="mfbfw_overlayColor" value="<?php echo $settings['overlayColor']; ?>" size="7" maxlength="7" />
										<?php _e('HTML color of the overlay (default: #666666)', 'mfbfw'); ?>
									</label><br /><br />

									<label for="mfbfw_overlayOpacity">
										<select name="mfbfw_overlayOpacity" id="mfbfw_overlayOpacity">
											<?php
											foreach($overlayArray as $key=> $opacity) {
												if($settings['overlayOpacity'] != $opacity) $selected = '';
												else $selected = ' selected';
												echo "<option value='$opacity'$selected>$opacity</option>\n";
											}
											?>
										</select>
										<?php _e('Opacity of overlay. 0 is transparent, 1 is opaque (default: 0.3)', 'mfbfw'); ?>
									</label><br /><br />

								</fieldset>
							</td>
						</tr>
						
						<tr valign="top">
							<th scope="row"><?php _e('Show Title', 'mfbfw'); ?></th>
							<td>
								<fieldset>

									<label for="mfbfw_showTitle">
										<input type="checkbox" name="mfbfw_showTitle" id="mfbfw_showTitle"<?php if ($settings['showTitle']) echo ' checked="yes"';?> />
										<?php _e('Show the image title (default: on)', 'mfbfw'); ?>
									</label><br /><br />
									
								</fieldset>
							</td>
						</tr>

					</tbody>
				</table>