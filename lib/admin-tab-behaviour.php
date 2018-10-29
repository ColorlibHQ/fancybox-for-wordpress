<h3><?php _e( 'Behavior Settings <span style="color:orange">(medium)</span>', 'mfbfw' ); ?></h3>
<p><?php _e( 'The following settings should be left alone unless you know what you are doing.', 'mfbfw' ); ?></p>
<table class="form-table fancy-table" style="clear:none;">
    <tbody>
    <tr valign="top">
        <th scope="row"><?php _e( 'Close on Content Click', 'mfbfw' ); ?></th>
        <td>
            <fieldset>
                <input type="checkbox" class="onoffswitch-checkbox" name="mfbfw[hideOnContentClick]"
                       id="hideOnContentClick"<?php if ( isset( $settings['hideOnContentClick'] ) && $settings['hideOnContentClick'] ) {
					echo ' checked="yes"';
				} ?> />
                <label for="hideOnContentClick" class="onoffswitch-label"></label>
                <span class="switch-text"><?php _e( 'Close FancyBox by clicking on the image (default: off)', 'mfbfw' ); ?></span>
                <div class="cf"></div>
                <p class="description">
                    <em><?php _e( '(You may want to leave this off if you display iframed or inline content that containts clickable elements - for example: play buttons for movies, links to other pages)', 'mfbfw' ); ?>
                </p>
            </fieldset>
        </td>
    </tr>
    <tr valign="top">
        <th scope="row"><?php _e( 'Close on Overlay Click', 'mfbfw' ); ?></th>
        <td>
            <fieldset>
                <input type="checkbox" class="onoffswitch-checkbox" name="mfbfw[hideOnOverlayClick]"
                       id="hideOnOverlayClick"<?php if ( isset( $settings['hideOnOverlayClick'] ) && $settings['hideOnOverlayClick'] ) {
					echo ' checked="yes"';
				} ?> />
                <label for="hideOnOverlayClick" class="onoffswitch-label"></label>
                <span class="switch-text"><?php _e( 'Close FancyBox by clicking on the overlay sorrounding it (default: on)', 'mfbfw' ); ?></span>
                <div class="cf"></div>
            </fieldset>
        </td>
    </tr>
    <tr valign="top">
        <th scope="row"><?php _e( 'Keyboard navigation;', 'mfbfw' ); ?></th>
        <td>
            <fieldset>
                <input type="checkbox" class="onoffswitch-checkbox" name="mfbfw[enableEscapeButton]"
                       id="enableEscapeButton"<?php if ( isset( $settings['enableEscapeButton'] ) && $settings['enableEscapeButton'] ) {
					echo ' checked="yes"';
				} ?> />
                <label for="enableEscapeButton" class="onoffswitch-label"></label>
                <span class="switch-text"><?php _e( 'Enable Keyboard Navigation (default: on)', 'mfbfw' ); ?></span>
                <div class="cf"></div>
            </fieldset>
        </td>
    </tr>
    <tr valign="top">
        <th scope="row"><?php _e( 'Loop Galleries', 'mfbfw' ); ?></th>
        <td>
            <fieldset>
                <input type="checkbox" class="onoffswitch-checkbox" name="mfbfw[cyclic]"
                       id="cyclic"<?php if ( isset( $settings['cyclic'] ) && $settings['cyclic'] ) {
					echo ' checked="yes"';
				} ?> />
                <label for="cyclic" class="onoffswitch-label"></label>
                <span class="switch-text"><?php _e( 'This will make galleries loop, allowing you to keep pressing next/back (default: off)', 'mfbfw' ); ?></span>
                <div class="cf"></div>
            </fieldset>
        </td>
    </tr>
    <tr valign="top">
        <th scope="row"><?php _e( 'Mouse Wheel Navigation', 'mfbfw' ); ?></th>
        <td>
            <fieldset>
                <input type="checkbox" class="onoffswitch-checkbox" name="mfbfw[mouseWheel]"
                       id="mouseWheel"<?php if ( isset( $settings['mouseWheel'] ) && $settings['mouseWheel'] ) {
					echo ' checked="yes"';
				} ?> />
                <label for="mouseWheel" class="onoffswitch-label"></label>
                <span class="switch-text"><?php _e( 'Lets visitors navigate galleries with the mouse wheel  (default: off)', 'mfbfw' ); ?></span>
                <div class="cf"></div>
            </fieldset>
        </td>
    </tr>
    <tr valign="top">
        <th scope="row"><?php _e( 'Woocommerce:', 'mfbfw' ); ?></th>
        <td>
            <fieldset>
                <input type="checkbox" class="onoffswitch-checkbox" name="mfbfw[disableWoocommercePages]"
                       id="disableWoocommercePages"<?php if ( isset( $settings['disableWoocommercePages'] ) && $settings['disableWoocommercePages'] ) {
					echo ' checked="yes"';
				} ?> />
                <label for="disableWoocommercePages" class="onoffswitch-label"></label>
                <span class="switch-text"><?php _e( 'Disable on Woocommerce Shop page.( Default : off )', 'mfbfw' ); ?></span>
                <div class="cf"></div>
            </fieldset>
            <fieldset>
                <input type="checkbox" class="onoffswitch-checkbox" name="mfbfw[disableWoocommerceProducts]"
                       id="disableWoocommerceProducts"<?php if ( isset( $settings['disableWoocommerceProducts'] ) && $settings['disableWoocommerceProducts'] ) {
					echo ' checked="yes"';
				} ?> />
                <label for="disableWoocommerceProducts" class="onoffswitch-label"></label>
                <span class="switch-text"><?php _e( 'Disable on Woocommerce products.( Default : off )', 'mfbfw' ); ?></span>
                <div class="cf"></div>
            </fieldset>
        </td>
    </tr>
    </tbody>
</table>