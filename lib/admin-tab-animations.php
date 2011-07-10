				<h2><?php _e('Animation Settings <span style="color:green">(basic)</span>', 'mfbfw'); ?></h2>

				<p><?php _e('These settings control the animations when opening and closing Fancybox, and the optional easing effects.', 'mfbfw'); ?></p>

			<table class="form-table" style="clear:none;">
					<tbody>

						<tr valign="top">
							<th scope="row"><?php _e('Zoom Options', 'mfbfw'); ?></th>
							<td>
								<fieldset>

									<label for="mfbfw_zoomOpacity">
										<input type="checkbox" name="mfbfw_zoomOpacity" id="mfbfw_zoomOpacity"<?php if ($settings['zoomOpacity']) echo ' checked="yes"';?> />
										<?php _e('Change content transparency during zoom animations (default: on)', 'mfbfw'); ?>
									</label><br /><br />

									<label for="mfbfw_zoomSpeedIn">
										<select name="mfbfw_zoomSpeedIn" id="mfbfw_zoomSpeedIn">
											<?php
											foreach($msArray as $key=> $ms) {
												if($settings['zoomSpeedIn'] != $ms) $selected = '';
												else $selected = ' selected';
												echo "<option value='$ms'$selected>$ms</option>\n";
											} ?>
										</select>
										<?php _e('Speed in miliseconds of the zooming-in animation (default: 500)', 'mfbfw'); ?>
									</label><br /><br />

									<label for="mfbfw_zoomSpeedOut">
										<select name="mfbfw_zoomSpeedOut" id="mfbfw_zoomSpeedOut">
											<?php
											foreach($msArray as $key=> $ms) {
												if($settings['zoomSpeedOut'] != $ms) $selected = '';
												else $selected = ' selected';
												echo "<option value='$ms'$selected>$ms</option>\n";
											} ?>
										</select>
										<?php _e('Speed in miliseconds of the zooming-out animation (default: 500)', 'mfbfw'); ?>
									</label><br /><br />
									
									<label for="mfbfw_zoomSpeedChange">
										<select name="mfbfw_zoomSpeedChange" id="mfbfw_zoomSpeedChange">
											<?php
											foreach($msArray as $key=> $ms) {
												if($settings['zoomSpeedChange'] != $ms) $selected = '';
												else $selected = ' selected';
												echo "<option value='$ms'$selected>$ms</option>\n";
											} ?>
										</select>
										<?php _e('Speed in miliseconds of the animation when navigating thorugh gallery items (default: 300)', 'mfbfw'); ?>
									</label><br /><br />

								</fieldset>
							</td>
						</tr>

						<tr valign="top">
							<th scope="row"><?php _e('Easing', 'mfbfw'); ?></th>
							<td>
								<fieldset>

									<label for="mfbfw_easing">
										<input type="checkbox" name="mfbfw_easing" id="mfbfw_easing"<?php if ($settings['easing']) echo ' checked="yes"';?> />
										<?php _e('Activate easing (default: off)', 'mfbfw'); ?>
									</label><br /><br />

									<label for="mfbfw_easingIn">
										<select name="mfbfw_easingIn" id="mfbfw_easingIn">
											<?php
											foreach($easingArray as $key=> $easingIn) {
												if($settings['easingIn'] != $easingIn) $selected = '';
												else $selected = ' selected';
												echo "<option value='$easingIn'$selected>$easingIn</option>\n";
											}
											?>
										</select>
										<?php _e('Easing method when opening FancyBox. (default: easeOutBack)', 'mfbfw'); ?>
									</label><br /><br />

									<label for="mfbfw_easingOut">
										<select name="mfbfw_easingOut" id="mfbfw_easingOut">
											<?php
											foreach($easingArray as $key=> $easingOut) {
												if($settings['easingOut'] != $easingOut) $selected = '';
												else $selected = ' selected';
												echo "<option value='$easingOut'$selected>$easingOut</option>\n";
											}
											?>
										</select>
										<?php _e('Easing method when closing FancyBox. (default: easeInBack)', 'mfbfw'); ?>
									</label><br /><br />

									<label for="mfbfw_easingChange">
										<select name="mfbfw_easingChange" id="mfbfw_easingChange">
											<?php
											foreach($easingArray as $key=> $easingChange) {
												if($settings['easingChange'] != $easingChange) $selected = '';
												else $selected = ' selected';
												echo "<option value='$easingChange'$selected>$easingChange</option>\n";
											}
											?>
										</select>
										<?php _e('Easing method when navigating through gallery items. (default: easeInOutQuart)', 'mfbfw'); ?>
									</label><br />

									<small><em><?php _e('(There are 30 different easing methods, the first ones are the most boring. You can test them <a href="http://commadot.com/jquery/easing.php" target="_blank">here</a> or <a href="http://hosted.zeh.com.br/mctween/animationtypes.html" target="_blank">here</a>)', 'mfbfw'); ?></em></small><br /><br />

								</fieldset>
							</td>
						</tr>

					</tbody>
				</table>