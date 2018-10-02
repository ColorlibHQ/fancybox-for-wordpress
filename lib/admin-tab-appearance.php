<h2><?php _e('Appearance Settings <span style="color:green">(basic)</span>', 'mfbfw'); ?></h2>

<p><?php _e('These setting control how Fancybox looks, they let you tweak color, borders and position of elements, like the image title and closing buttons.', 'mfbfw'); ?></p>

<table class="form-table" style="clear:none;">
	<tbody>
		
		<tr valign="top">
			<th scope="row"><?php _e('Border', 'mfbfw'); ?></th>
			<td>
				<fieldset>
					
					<label for="border">
						<input type="checkbox" class="custom-switch" name="mfbfw[border]" id="border"<?php if ( isset($settings['border']) && $settings['border'] ) echo ' checked="yes"';?> />
						<?php _e('Show Border (default: off)', 'mfbfw'); ?>
					</label><br /><br />
					
					<div id="borderColorBlock">
						
						<label for="borderColor">
							<input type="color" name="mfbfw[borderColor]" id="borderColor" value="<?php echo $settings['borderColor'] ?>" size="7" maxlength="7" />
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
						<input type="checkbox" class="custom-switch" name="mfbfw[showCloseButton]" id="showCloseButton"<?php if ( isset($settings['showCloseButton']) && $settings['showCloseButton'] ) echo ' checked="yes"';?> />
						<?php _e('Show Close button (default: on)', 'mfbfw'); ?>
					</label><br /><br />
					
					<div id="closeButtonBlock">
						
						<?php _e('Close button position:', 'mfbfw'); ?><br />
						<input name="mfbfw[closeHorPos]" type="radio" value="left" id="closePosLeft"<?php if ( isset($settings['closeHorPos']) && $settings['closeHorPos'] == 'left' ) echo ' checked="yes"';?> />
						<label for="closePosLeft" style="padding-right:15px">
							<?php _e('Left', 'mfbfw'); ?>
						</label>
						
						<input name="mfbfw[closeHorPos]" type="radio" value="right" id="closePosRight"<?php if ( isset($settings['closeHorPos']) && $settings['closeHorPos'] == 'right' ) echo ' checked="yes"';?> />
						<label for="closePosRight">
							<?php _e('Right (default)', 'mfbfw'); ?>
						</label><br />
						
						<input name="mfbfw[closeVerPos]" type="radio" value="bottom" id="closePosBottom"<?php if ( isset($settings['closeVerPos']) && $settings['closeVerPos'] == 'bottom' ) echo ' checked="yes"';?> />
						<label for="closePosBottom" style="padding-right:15px">
							<?php _e('Bottom', 'mfbfw'); ?>
						</label>
						
						<input name="mfbfw[closeVerPos]" type="radio" value="top" id="closePosTop"<?php if ( isset($settings['closeVerPos']) && $settings['closeVerPos'] == 'top' ) echo ' checked="yes"';?> />
						<label for="closePosTop">
							<?php _e('Top (default)', 'mfbfw'); ?>
						</label><br /><br />
						
					</div>
					
				</fieldset>
			</td>
		</tr>
		
		<tr valign="top">
			<th scope="row"><?php _e('Padding', 'mfbfw'); ?></th>
			<td>
				<fieldset>
					
					<label for="paddingColor">
						<input type="color" name="mfbfw[paddingColor]" id="paddingColor" value="<?php echo $settings['paddingColor'] ?>" size="7" maxlength="7" />
						<?php _e('HTML color of the padding (default: #FFFFFF)', 'mfbfw'); ?>
					</label><br />
					
					<small><em><?php _e('(This should be left on #FFFFFF (white) if you want to display anything other than images, like inline or framed content)', 'mfbfw'); ?></em></small><br /><br />
					<!-- Added class inlined to the label. Razvan -->
					<label for="padding" class="inlined">
						<input type="text" name="mfbfw[padding]" id="padding" value="<?php echo $settings['padding']; ?>" size="7" maxlength="7" />
						<div class="slider-horizontal" minSl="0" maxSl="100" stepSl="1" rangeSl="min" style="height:14px;"></div>
						<?php _e('Padding size in pixels (default: 10)', 'mfbfw'); ?>
					</label><br /><br />	
					
				</fieldset>
			</td>
		</tr>
		
		<tr valign="top">
			<th scope="row"><?php _e('Overlay Options', 'mfbfw'); ?></th>
			<td>
				<fieldset>
					
					<label for="overlayShow">
						<input type="checkbox" class="custom-switch" name="mfbfw[overlayShow]" id="overlayShow"<?php if ( isset($settings['overlayShow']) && $settings['overlayShow'] ) echo ' checked="yes"';?> />
						<?php _e('Add overlay (default: on)', 'mfbfw'); ?>
					</label><br /><br />
					
					<div id="overlayBlock">
						
						<label for="overlayColor">
							<input type="color" name="mfbfw[overlayColor]" id="overlayColor" value="<?php echo $settings['overlayColor']; ?>" size="7" maxlength="7" />
							<?php _e('HTML color of the overlay (default: #666666)', 'mfbfw'); ?>
						</label><br /><br />
						
						<label for="overlayOpacity" class="inlined">
						<!-- Commented the select. We will use input type text. Razvan-->
							<!-- <select name="mfbfw[overlayOpacity]" id="overlayOpacity">
								<?php
									foreach($overlayArray as $key=> $opacity) {
										if($settings['overlayOpacity'] != $opacity) $selected = '';
										else $selected = ' selected';
										echo "<option value='$opacity'$selected>$opacity</option>\n";
									}
								?>
							</select> --> 
							<input type="text" name="mfbfw[overlayOpacity]" id="overlayOpacity" value="<?php echo $settings['overlayOpacity']; ?>" size="7" maxlength="7" />
							<div class="slider-horizontal"  minSl="0" maxSl="1" stepSl="0.1" rangeSl="min" style="height:14px;"></div>
							<!-- End Modification -->
							<?php _e('Opacity of overlay. 0 is transparent, 1 is opaque (default: 0.3)', 'mfbfw'); ?>
						</label><br /><br />
						
					</div>
					
				</fieldset>
			</td>
		</tr>
		
		<tr valign="top">
			<th scope="row"><?php _e('Title', 'mfbfw'); ?></th>
			<td>
				<fieldset>
					
					<label for="titleShow">
						<input type="checkbox" class="custom-switch" name="mfbfw[titleShow]" id="titleShow"<?php if ( isset($settings['titleShow']) && $settings['titleShow'] ) echo ' checked="yes"';?> />
						<?php _e('Show the title (default: on)', 'mfbfw'); ?>
					</label><br /><br />
					
					<label for="titleSize">
						<input type="text" name="mfbfw[titleSize]" id="titleSize" size="2" maxlength="4" value="<?php echo $settings['titleSize']; ?>" />
						<?php _e('Title size (default: 14px)', 'mfbfw'); ?>
					</label><br /><br />
					
					<div id="titleBlock">
						
						<input id="titlePositionInside" class="titlePosition" type="radio" value="inside" name="mfbfw[titlePosition]"<?php if ($settings['titlePosition'] == 'inside') echo ' checked="yes"';?> />
						<label for="titlePositionInside">
							<?php _e('Inside (default)', 'mfbfw'); ?>
						</label><br />
						
						<input id="titlePositionOutside" class="titlePosition" type="radio" value="float" name="mfbfw[titlePosition]"<?php if ($settings['titlePosition'] == 'float') echo ' checked="yes"';?> />
						<label for="titlePositionOutside">
							<?php _e('Outside', 'mfbfw'); ?>
						</label><br />
						
						<input id="titlePositionOver" class="titlePosition" type="radio" value="over" name="mfbfw[titlePosition]"<?php if ($settings['titlePosition'] == 'over') echo ' checked="yes"';?> />
						<label for="titlePositionOver">
							<?php _e('Over', 'mfbfw'); ?>
						</label><br /><br />
						
						<div id="titleColorBlock">
							
							<label for="titleColor">
								<input type="color" name="mfbfw[titleColor]" id="titleColor" class="colorpick" value="<?php echo $settings['titleColor']; ?>" size="7" maxlength="7" />
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
						<input type="checkbox" class="custom-switch" name="mfbfw[showNavArrows]" id="showNavArrows"<?php if ( isset($settings['showNavArrows']) && $settings['showNavArrows'] ) echo ' checked="yes"';?> />
						<?php _e('Show the navigation arrows (default: on)', 'mfbfw'); ?>
					</label><br /><br />
					
				</fieldset>
			</td>
		</tr>
		
	</tbody>
</table>