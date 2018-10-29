<h3><?php _e( 'Animation Settings <span style="color:green">(basic)</span>', 'mfbfw' ); ?></h3>

<p><?php _e( 'These settings control the animations when opening and closing Fancybox, and the optional easing effects.', 'mfbfw' ); ?></p>

<table class="form-table fancy-table" style="clear:none;">
    <tbody>
    <tr valign="top">
        <th scope="row"><?php _e( 'Zoom Options', 'mfbfw' ); ?></th>
        <td>
            <fieldset>
                <input type="checkbox" class="onoffswitch-checkbox" name="mfbfw[zoomOpacity]"
                       id="zoomOpacity"<?php if ( isset( $settings['zoomOpacity'] ) && $settings['zoomOpacity'] ) {
					echo ' checked="yes"';
				} ?> />
                <label for="zoomOpacity" class="onoffswitch-label"></label>
                <span class="switch-text"><?php _e( 'Change content transparency during zoom animations (default: on)', 'mfbfw' ); ?></span>
            </fieldset>
        </td>
    </tr>
    <tr valign="top">
        <th scope="row"><?php _e( 'Animation Type', 'mfbfw' ); ?></th>
        <td>
            <fieldset>
                <label for="transitionIn">
                    <select name="mfbfw[transitionIn]" id="transitionIn">
						<?php
						foreach ( $transitionTypeArray as $key => $ms ) {
							echo "<option value='$ms' " . selected( $settings['transitionIn'], $ms, false ) . ">$ms</option>\n";
						}
						?>
                    </select>
					<?php _e( 'Animation type when opening FancyBox. (default: fade)', 'mfbfw' ); ?>
                </label>
                <div class="cf"></div>
                <div class="line-spacer"></div>
                <label for="zoomSpeedIn">
                    <select name="mfbfw[zoomSpeedIn]" id="zoomSpeedIn">
						<?php
						foreach ( $msArray as $key => $ms ) {
							echo "<option value='$ms' " . selected( $settings['zoomSpeedIn'], $ms, false ) . ">$ms</option>\n";
						}
						?>
                    </select>
					<?php _e( 'Speed in miliseconds of the FancyBox opening  animation (default: 500)', 'mfbfw' ); ?>
                </label>
            </fieldset>
        </td>
    </tr>
    <tr valign="top">
        <th scope="row"><?php _e( 'Animation between slides Options', 'mfbfw' ); ?></th>
        <td>
            <fieldset>
                <label for="transitionEffect">
                    <select name="mfbfw[transitionEffect]" id="animationDuration">
						<?php
						foreach ( $slideEffectArray as $key => $ms ) {
							echo "<option value='$ms' " . selected( $settings['transitionEffect'], $ms, false ) . ">$ms</option>\n";
						}
						?>
                    </select>
					<?php _e( 'Select Animation type for the slides(default: fade)', 'mfbfw' ); ?>
                </label>
                <div class="line-spacer"></div>
                <label for="zoomSpeedChange">
                    <select name="mfbfw[zoomSpeedChange]" id="zoomSpeedChange">
						<?php
						foreach ( $msArray as $key => $ms ) {
							echo "<option value='$ms' " . selected( $settings['zoomSpeedChange'], $ms, false ) . ">$ms</option>\n";
						}
						?>
                    </select>
					<?php _e( 'Speed in miliseconds of the animation when navigating thorugh gallery items (default: 300)', 'mfbfw' ); ?>
                </label>
            </fieldset>
        </td>
    </tr>
    </tbody>
</table>