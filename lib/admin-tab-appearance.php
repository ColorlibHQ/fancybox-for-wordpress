				<h2><?php _e('Appearance Settings <span style="color:green">(basic)</span>', 'mfbfw'); ?></h2>

				<p><?php _e('These setting control how Fancybox looks, they let you tweak color, borders and position of elements, like the image title and closing buttons.', 'mfbfw'); ?></p>

				<table class="form-table" style="clear:none;">
					<tbody>

						<tr valign="top">
							<th scope="row"><?php _e('Border', 'mfbfw'); ?></th>
							<td>
								<fieldset>

									<label for="border">
										<input type="checkbox" name="mfbfw[border]" id="border"<?php if ( isset($mfbfw['border']) && $mfbfw['border'] ) echo ' checked="yes"';?> />
										<?php _e('Show Border (default: off)', 'mfbfw'); ?>
									</label><br /><br />

									<div id="borderColorBlock">

										<label for="borderColor">
											<input type="text" name="mfbfw[borderColor]" id="borderColor" value="<?php echo $mfbfw['borderColor'] ?>" size="7" maxlength="7" />
											<?php _e('HTML color of the border (default: #BBBBBB)', 'mfbfw'); ?>
										</label><br /><br />

									</div>

								</fieldset>
							</td>
						</tr>

						<tr valign="top">
							<th scope="row"><?php _e('Close Button', 'mfbfw'); ?></th>
							<td>
								<fieldset>

									<label for="showCloseButton">
										<input type="checkbox" name="mfbfw[showCloseButton]" id="showCloseButton"<?php if ( isset($mfbfw['showCloseButton']) && $mfbfw['showCloseButton'] ) echo ' checked="yes"';?> />
										<?php _e('Show Close button (default: on)', 'mfbfw'); ?>
									</label><br /><br />

									<div id="closeButtonBlock">

										<?php _e('Close button position:', 'mfbfw'); ?><br />
										<input name="mfbfw[closeHorPos]" type="radio" value="left" id="closePosLeft"<?php if ( isset($mfbfw['closeHorPos']) && $mfbfw['closeHorPos'] == 'left' ) echo ' checked="yes"';?> />
										<label for="closePosLeft" style="padding-right:15px">
											<?php _e('Left', 'mfbfw'); ?>
										</label>

										<input name="mfbfw[closeHorPos]" type="radio" value="right" id="closePosRight"<?php if ( isset($mfbfw['closeHorPos']) && $mfbfw['closeHorPos'] == 'right' ) echo ' checked="yes"';?> />
										<label for="closePosRight">
											<?php _e('Right (default)', 'mfbfw'); ?>
										</label><br />

										<input name="mfbfw[closeVerPos]" type="radio" value="bottom" id="closePosBottom"<?php if ( isset($mfbfw['closeVerPos']) && $mfbfw['closeVerPos'] == 'bottom' ) echo ' checked="yes"';?> />
										<label for="closePosBottom" style="padding-right:15px">
											<?php _e('Bottom', 'mfbfw'); ?>
										</label>

										<input name="mfbfw[closeVerPos]" type="radio" value="top" id="closePosTop"<?php if ( isset($mfbfw['closeVerPos']) && $mfbfw['closeVerPos'] == 'top' ) echo ' checked="yes"';?> />
										<label for="closePosTop">
											<?php _e('Top (default)', 'mfbfw'); ?>
										</label><br /><br />

									</div>

								</fieldset>
							</td>
						</tr>

						<tr valign="top">
							<th scope="row"><?php _e('FancyBox Shape', 'mfbfw'); ?></th>
							<td>
								<fieldset>

									<label for="paddingColor">
										<input type="text" name="mfbfw[paddingColor]" id="paddingColor" value="<?php echo $mfbfw['paddingColor'] ?>" size="7" maxlength="7" />
										<?php _e('Padding HTML color (default: #FFFFFF)', 'mfbfw'); ?>
									</label><br />

									<small><em><?php _e('(This should be left on #FFFFFF (white) if you want to display anything other than images, like inline or framed content)', 'mfbfw'); ?></em></small><br /><br />

									<label for="padding">
										<input type="text" name="mfbfw[padding]" id="padding" value="<?php echo $mfbfw['padding']; ?>" size="3" maxlength="3" />
										<?php _e('Padding size in pixels (default: 15)', 'mfbfw'); ?>
									</label><br /><br />

									<label for="borderRadius">
										<input type="text" name="mfbfw[borderRadius]" id="borderRadius" value="<?php echo $mfbfw['borderRadius']; ?>" size="2" maxlength="2" />
										<?php _e('Rounded Corners radius (default: 5)', 'mfbfw'); ?>
									</label><br /><br />

									<label for="borderRadiusInner">
										<input type="text" name="mfbfw[borderRadiusInner]" id="borderRadiusInner" value="<?php echo $mfbfw['borderRadiusInner']; ?>" size="2" maxlength="2" />
										<?php _e('Rounded Corners inner radius (default: 0)', 'mfbfw'); ?>
									</label><br /><br />

								</fieldset>
							</td>
						</tr>

						<tr valign="top">
							<th scope="row"><?php _e('Overlay Options', 'mfbfw'); ?></th>
							<td>
								<fieldset>

									<label for="overlayShow">
										<input type="checkbox" name="mfbfw[overlayShow]" id="overlayShow"<?php if ( isset($mfbfw['overlayShow']) && $mfbfw['overlayShow'] ) echo ' checked="yes"';?> />
										<?php _e('Add overlay (default: on)', 'mfbfw'); ?>
									</label><br /><br />

									<div id="overlayBlock">

										<label for="overlayColor">
											<input type="text" name="mfbfw[overlayColor]" id="overlayColor" value="<?php echo $mfbfw['overlayColor']; ?>" size="7" maxlength="7" />
											<?php _e('Overlay HTML color (default: #666666)', 'mfbfw'); ?>
										</label><br /><br />

										<label for="overlayOpacity">
											<select name="mfbfw[overlayOpacity]" id="overlayOpacity">
												<?php
												foreach($overlayArray as $key=> $opacity) {
													if($mfbfw['overlayOpacity'] != $opacity) $selected = '';
													else $selected = ' selected';
													echo "<option value='$opacity'$selected>$opacity</option>\n";
												}
												?>
											</select>
											<?php _e('Overlay opacity. 0 is transparent, 1 is opaque (default: 0.3)', 'mfbfw'); ?>
										</label><br /><br />

									</div>

								</fieldset>
							</td>
						</tr>

						<tr valign="top">
							<th scope="row"><?php _e('Shadow', 'mfbfw'); ?></th>
							<td>
								<fieldset>

									<label for="shadowSize">
										<input type="text" name="mfbfw[shadowSize]" id="shadowSize" value="<?php echo $mfbfw['shadowSize'] ?>" size="3" maxlength="3" />
										<?php _e('Shadow size (default: 25)', 'mfbfw'); ?>
									</label><br /><br />

									<label for="shadowOffset">
										<input type="text" name="mfbfw[shadowOffset]" id="shadowOffset" value="<?php echo $mfbfw['shadowOffset'] ?>" size="2" maxlength="2" />
										<?php _e('Shadow distance (default: 10)', 'mfbfw'); ?>
									</label><br /><br />

									<label for="shadowOpacity">
										<select name="mfbfw[shadowOpacity]" id="shadowOpacity">
											<?php
											foreach($overlayArray as $key=> $opacity) {
												if($mfbfw['shadowOpacity'] != $opacity) $selected = '';
												else $selected = ' selected';
												echo "<option value='$opacity'$selected>$opacity</option>\n";
											}
											?>
										</select>
										<?php _e('Shadow opacity. 0 is transparent, 1 is opaque (default: 0.5)', 'mfbfw'); ?>
									</label><br /><br />

								</fieldset>
							</td>
						</tr>

						<tr valign="top">
							<th scope="row"><?php _e('Title', 'mfbfw'); ?></th>
							<td>
								<fieldset>

									<label for="titleShow">
										<input type="checkbox" name="mfbfw[titleShow]" id="titleShow"<?php if ( isset($mfbfw['titleShow']) && $mfbfw['titleShow'] ) echo ' checked="yes"';?> />
										<?php _e('Show the title (default: on)', 'mfbfw'); ?>
									</label><br /><br />

									<div id="titleBlock">

										<input id="titlePositionInside" class="titlePosition" type="radio" value="inside" name="mfbfw[titlePosition]"<?php if ($mfbfw['titlePosition'] == 'inside') echo ' checked="yes"';?> />
										<label for="titlePositionInside">
											<?php _e('Inside (default)', 'mfbfw'); ?>
										</label><br />

										<input id="titlePositionOutside" class="titlePosition" type="radio" value="float" name="mfbfw[titlePosition]"<?php if ($mfbfw['titlePosition'] == 'float') echo ' checked="yes"';?> />
										<label for="titlePositionOutside">
											<?php _e('Outside', 'mfbfw'); ?>
										</label><br />

										<input id="titlePositionOver" class="titlePosition" type="radio" value="over" name="mfbfw[titlePosition]"<?php if ($mfbfw['titlePosition'] == 'over') echo ' checked="yes"';?> />
										<label for="titlePositionOver">
											<?php _e('Over', 'mfbfw'); ?>
										</label><br /><br />

										<div id="titleColorBlock">

											<label for="titleColor">
												<input type="text" name="mfbfw[titleColor]" id="titleColor" class="colorpick" value="<?php echo $mfbfw['titleColor']; ?>" size="7" maxlength="7" />
												<?php _e('Title text color (default: #333333)', 'mfbfw'); ?>
											</label><br />

											<small><em><?php _e('(Should contrast with the padding color set above)', 'mfbfw'); ?></em></small><br /><br />

										</div>

									</div>

								</fieldset>
							</td>
						</tr>

						<tr valign="top">
							<th scope="row"><?php _e('Navigation Arrows', 'mfbfw'); ?></th>
							<td>
								<fieldset>

									<label for="showNavArrows">
										<input type="checkbox" name="mfbfw[showNavArrows]" id="showNavArrows"<?php if ( isset($mfbfw['showNavArrows']) && $mfbfw['showNavArrows'] ) echo ' checked="yes"';?> />
										<?php _e('Show the navigation arrows (default: on)', 'mfbfw'); ?>
									</label><br /><br />

								</fieldset>
							</td>
						</tr>

					</tbody>
				</table>