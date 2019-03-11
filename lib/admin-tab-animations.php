<h3><?php _e( 'Animation Settings <span style="color:green">(basic)</span>', 'mfbfw' ); ?></h3>

<p><?php _e( 'These settings control the animations when opening and closing Fancybox, and the optional easing effects.', 'mfbfw' ); ?></p>

<table class="form-table fancy-table" style="clear:none;">
    <tbody>
    <tr valign="top">
        <th scope="row"><?php _e( 'Zoom Options', 'mfbfw' ); ?>
            <span class="tooltip-right"
                  data-tooltip="<?php _e( 'Change content transparency during zoom animations (default: on)', 'mfbfw' ); ?>">
                  <i class="dashicons dashicons-editor-help"></i>
             </span>
        </th>
        <td>
            <fieldset>
                <div class="epsilon-toggle">
                    <input class="epsilon-toggle__input" type="checkbox" id="zoomOpacity" name="mfbfw[zoomOpacity]" <?php checked( 1, isset( $settings['zoomOpacity'] ) && $settings['zoomOpacity'] ); ?> >
                    <div class="epsilon-toggle__items">
                        <span class="epsilon-toggle__track"></span>
                        <span class="epsilon-toggle__thumb"></span>
                        <svg class="epsilon-toggle__off" width="6" height="6" aria-hidden="true" role="img" focusable="false" viewBox="0 0 6 6">
                            <path d="M3 1.5c.8 0 1.5.7 1.5 1.5S3.8 4.5 3 4.5 1.5 3.8 1.5 3 2.2 1.5 3 1.5M3 0C1.3 0 0 1.3 0 3s1.3 3 3 3 3-1.3 3-3-1.3-3-3-3z"></path>
                        </svg>
                        <svg class="epsilon-toggle__on" width="2" height="6" aria-hidden="true" role="img" focusable="false" viewBox="0 0 2 6">
                            <path d="M0 0h2v6H0z"></path>
                        </svg>
                    </div>
                </div>
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