<h2><?php _e( 'Behavior Settings <span style="color:orange">(medium)</span>', 'mfbfw' ); ?></h2>

<p><?php _e( 'The following settings should be left alone unless you know what you are doing.', 'mfbfw' ); ?></p>

<table class="form-table fancy-table" style="clear:none;">
	<tbody>

		<!-- Razvan. Disabled this in the new fancybox.js-->

<!--<tr valign="top">
			<th scope="row"><?php _e( 'Auto Resize to Fit', 'mfbfw' ); ?></th>
			<td>
				<fieldset>
					<input type="checkbox" class="onoffswitch-checkbox" name="mfbfw[imageScale]" id="imageScale"<?php if ( isset( $settings[ 'imageScale' ] ) && $settings[ 'imageScale' ] ) echo ' checked="yes"'; ?> />
					<label for="imageScale" class="onoffswitch-label"></label>
		<?php _e( 'Scale images to fit in viewport (default: on)', 'mfbfw' ); ?><br /><br />

				</fieldset>
			</td>
		</tr>-->




		<!-- Razvan. Disabled this in the new fancybox.js-->

<!--<tr valign="top">
	<th scope="row"><?php _e( 'Center on Scroll', 'mfbfw' ); ?></th>
	<td>
		<fieldset>
			<input type="checkbox" class="onoffswitch-checkbox" name="mfbfw[centerOnScroll]" id="centerOnScroll"<?php if ( isset( $settings[ 'centerOnScroll' ] ) && $settings[ 'centerOnScroll' ] ) echo ' checked="yes"'; ?> />
			<label for="centerOnScroll"class="onoffswitch-label"></label>
		<?php _e( 'Keep image in the center of the browser window when scrolling (default: on)', 'mfbfw' ); ?><br /><br />

		</fieldset>
	</td>
</tr>-->




		<tr valign="top">
			<th scope="row"><?php _e( 'Close on Content Click', 'mfbfw' ); ?></th>
			<td>
				<fieldset>
					<input type="checkbox" class="onoffswitch-checkbox" name="mfbfw[clickContent]" id="clickContent"<?php if ( isset( $settings[ 'clickContent' ] ) && $settings[ 'clickContent' ] ) echo ' checked="yes"'; ?> />
					<label for="clickContent" class="onoffswitch-label"></label>
					<?php _e( 'Close FancyBox by clicking on the image (default: off)', 'mfbfw' ); ?><br />

					<small><em><?php _e( '(You may want to leave this off if you display iframed or inline content that containts clickable elements - for example: play buttons for movies, links to other pages)', 'mfbfw' ); ?></em></small><br /><br />

				</fieldset>
			</td>
		</tr>

		<tr valign="top">
			<th scope="row"><?php _e( 'Close on Overlay Click', 'mfbfw' ); ?></th>
			<td>
				<fieldset>
					<input type="checkbox" class="onoffswitch-checkbox" name="mfbfw[clickSlide]" id="clickSlide"<?php if ( isset( $settings[ 'clickSlide' ] ) && $settings[ 'clickSlide' ] ) echo ' checked="yes"'; ?> />
					<label for="clickSlide" class="onoffswitch-label"></label>
					<?php _e( 'Close FancyBox by clicking on the overlay sorrounding it (default: on)', 'mfbfw' ); ?><br /><br />

				</fieldset>
			</td>
		</tr>


		<!--Razvan.Disabled this in the new fancybox.js-->
		<!--<tr valign="top">
					<th scope="row"><?php _e( 'Close with &quot;Esc&quot;', 'mfbfw' ); ?></th>
					<td>
						<fieldset>
							<input type="checkbox" class="onoffswitch-checkbox" name="mfbfw[enableEscapeButton]" id="enableEscapeButton"<?php if ( isset( $settings[ 'enableEscapeButton' ] ) && $settings[ 'enableEscapeButton' ] ) echo ' checked="yes"'; ?> />
							<label for="enableEscapeButton" class="onoffswitch-label"></label>
		<?php _e( 'Close FancyBox when &quot;Escape&quot; key is pressed (default: on)', 'mfbfw' ); ?><br /><br />
		
						</fieldset>
					</td>
				</tr>-->

		<!--		Added keyboard navigation-->
		<tr valign="top">
			<th scope="row"><?php _e( 'Keyboard navigation;', 'mfbfw' ); ?></th>
			<td>
				<fieldset>
					<input type="checkbox" class="onoffswitch-checkbox" name="mfbfw[keyboard]" id="keyboard"<?php if ( isset( $settings[ 'keyboard' ] ) && $settings[ 'keyboard' ] ) echo ' checked="yes"'; ?> />
					<label for="keyboard" class="onoffswitch-label"></label>
					<?php _e( 'Enable Keyboard Navigation (default: on)', 'mfbfw' ); ?><br /><br />

				</fieldset>
			</td>
		</tr>



		<tr valign="top">
			<th scope="row"><?php _e( 'Loop Galleries', 'mfbfw' ); ?></th>
			<td>
				<fieldset>
					<input type="checkbox" class="onoffswitch-checkbox" name="mfbfw[loop]" id="loop"<?php if ( isset( $settings[ 'loop' ] ) && $settings[ 'loop' ] ) echo ' checked="yes"'; ?> />
					<label for="loop" class="onoffswitch-label"></label>
					<?php _e( 'This will make galleries loop, allowing you to keep pressing next/back (default: off)', 'mfbfw' ); ?><br /><br />

				</fieldset>
			</td>
		</tr>

		<tr valign="top">
			<th scope="row"><?php _e( 'Mouse Wheel Navigation', 'mfbfw' ); ?></th>
			<td>
				<fieldset>
					<input type="checkbox" class="onoffswitch-checkbox" name="mfbfw[wheel]" id="wheel"<?php if ( isset( $settings[ 'wheel' ] ) && $settings[ 'wheel' ] ) echo ' checked="yes"'; ?> />
					<label for="wheel" class="onoffswitch-label"></label>
					<?php _e( 'Lets visitors navigate galleries with the mouse wheel  (default: off)', 'mfbfw' ); ?><br />

					<small><em><?php _e( '(Will load one additional javascript file, 3KB)', 'mfbfw' ); ?></em></small><br /><br />

				</fieldset>
			</td>
		</tr>

	</tbody>
</table>