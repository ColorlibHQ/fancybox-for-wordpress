<h3><?php _e( 'Appearance Settings <span style="color:green">(basic)</span>', 'mfbfw' ); ?></h3>

<p><?php _e( 'These setting control how Fancybox looks, they let you tweak color, borders and position of elements, like the image title and closing buttons.', 'mfbfw' ); ?></p>

<table class="form-table fancy-table" style="clear:none;">
    <tbody>
    <tr valign="top">
        <th scope="row"><?php _e( 'Close Button', 'mfbfw' ); ?></th>
        <td>
            <fieldset>
                <input type="checkbox" class="onoffswitch-checkbox" name="mfbfw[showCloseButton]"
                       id="showCloseButton"<?php if ( isset( $settings['showCloseButton'] ) && $settings['showCloseButton'] ) {
					echo ' checked="yes"';
				} ?> />
                <label for="showCloseButton" class="onoffswitch-label">
                </label>
                <span class="switch-text"><?php _e( 'Show Close button (default: off)', 'mfbfw' ); ?></span>
                <div class="cf"></div>
            </fieldset>
        </td>
    </tr>
    <tr valign="top">
        <th scope="row"><?php _e( 'Toolbar', 'mfbfw' ); ?></th>
        <td>
            <fieldset>
                <input type="checkbox" class="onoffswitch-checkbox" name="mfbfw[showToolbar]"
                       id="showToolbar"<?php if ( isset( $settings['showToolbar'] ) && $settings['showToolbar'] ) {
					echo ' checked="yes"';
				} ?> />
                <label for="showToolbar" class="onoffswitch-label">
                </label>
                <span class="switch-text"><?php _e( 'Show Toolbar  (default: on)', 'mfbfw' ); ?></span>
                <div class="cf"></div>
            </fieldset>
        </td>
    </tr>
    <tr valign="top">
        <th scope="row"><?php _e( 'Border', 'mfbfw' ); ?></th>
        <td>
            <fieldset>
                <input class="onoffswitch-checkbox" type="checkbox" name="mfbfw[border]"
                       id="border"<?php if ( isset( $settings['border'] ) && $settings['border'] ) {
					echo ' checked="yes"';
				} ?> />
                <label for="border" class="onoffswitch-label"></label>
                <span class="switch-text"><?php _e( 'Show Border (default: off)', 'mfbfw' ); ?></span>
                <div class="cf"></div>
                <div id="borderColorBlock" class="hidden-block">
                    <label for="borderColor">
                        <input type="text" class="color-btn" name="mfbfw[borderColor]" id="borderColor"
                               value="<?php echo $settings['borderColor'] ?>" size="7" maxlength="7"/>
                    </label>
                    <p class="description"><?php _e( 'HTML color of the border (default: #BBBBBB)', 'mfbfw' ); ?></p>
                </div>
            </fieldset>
        </td>
    </tr>
    <tr valign="top">
        <th scope="row"><?php _e( 'Padding', 'mfbfw' ); ?></th>
        <td>
            <fieldset>
                <label for="paddingColor">
                    <input type="text" class="color-btn" name="mfbfw[paddingColor]" id="paddingColor"
                           value="<?php echo $settings['paddingColor'] ?>" size="7" maxlength="7"/>
                </label>
                <p class="description"><?php _e( 'HTML color of the padding (default: #FFFFFF)', 'mfbfw' ); ?></p>
                <p class="description"><?php _e( '(This should be left on #FFFFFF (white) if you want to display anything other than images, like inline or framed content)', 'mfbfw' ); ?></p>
                <div class="line-spacer"></div>
                <label for="padding" class="inlined">
                    <input type="text" class="slider-text" name="mfbfw[padding]" id="padding"
                           value="<?php echo $settings['padding']; ?>" size="7" maxlength="7"/>
                    <div class="slider-horizontal" minSl="0" maxSl="100" stepSl="1" rangeSl="min"
                         style="height:14px;"></div>
                    <div class="cf"></div>
                    <p class="description"><span class="slider-spantext"><?php _e( 'Padding size in pixels (default: 10)', 'mfbfw' ); ?></span></p>
                </label>
            </fieldset>
        </td>
    </tr>
    <tr valign="top">
        <th scope="row"><?php _e( 'Overlay Options', 'mfbfw' ); ?></th>
        <td>
            <fieldset>
                <input type="checkbox" class="onoffswitch-checkbox" name="mfbfw[overlayShow]"
                       id="overlayShow"<?php if ( isset( $settings['overlayShow'] ) && $settings['overlayShow'] ) {
					echo ' checked="yes"';
				} ?> />
                <label for="overlayShow" class="onoffswitch-label"></label>
                <span class="switch-text"><?php _e( 'Add overlay (default: on)', 'mfbfw' ); ?></span>
                <div class="cf"></div>
                <div id="overlayBlock" class="hidden-block">
                    <label for="overlayColor">
                        <input type="text" class="color-btn" name="mfbfw[overlayColor]" id="overlayColor"
                               value="<?php echo $settings['overlayColor']; ?>" size="7" maxlength="7"/>
                    </label>
                    <p class="description"><?php _e( 'HTML color of the overlay (default: #666666)', 'mfbfw' ); ?></p>
                    <div class="line-spacer"></div>
                    <label for="overlayOpacity" class="inlined">
                        <input type="text" class="slider-text" name="mfbfw[overlayOpacity]" id="overlayOpacity"
                               value="<?php echo $settings['overlayOpacity']; ?>" size="7" maxlength="7"/>
                        <div class="slider-horizontal" minSl="0" maxSl="1" stepSl="0.1" rangeSl="min"
                             style="height:14px;"></div>
                        <div class="cf"></div>
                        <p class="description"><span class="slider-spantext"><?php _e( 'Opacity of overlay. 0 is transparent, 1 is opaque (default: 0.3)', 'mfbfw' ); ?></span></p>
                    </label>
                </div>
            </fieldset>
        </td>
    </tr>
    <tr valign="top">
        <th scope="row"><?php _e( 'Title', 'mfbfw' ); ?></th>
        <td>
            <fieldset>
                <input type="checkbox" class="onoffswitch-checkbox" name="mfbfw[titleShow]"
                       id="titleShow"<?php if ( isset( $settings['titleShow'] ) && $settings['titleShow'] ) {
					echo ' checked="yes"';
				} ?> />
                <label for="titleShow" class="onoffswitch-label"></label>
                <span class="switch-text"><?php _e( 'Show the title (default: on)', 'mfbfw' ); ?></span>
                <div class="cf"></div>
                <div id="titleBlock" class="hidden-block">
                    <label for="titleSize">
                        <input type="text" name="mfbfw[titleSize]" id="titleSize" size="2" maxlength="4"
                               value="<?php echo $settings['titleSize']; ?>"/>
						<?php _e( 'Title size (default: 14px)', 'mfbfw' ); ?>
                    </label>
                    <div class="cf"></div>
                    <div class="line-spacer"></div>
                    <input id="titlePositionInside" class="titlePosition" type="radio" value="inside"
                           name="mfbfw[titlePosition]"<?php if ( $settings['titlePosition'] == 'inside' ) {
						echo ' checked="yes"';
					} ?> />
                    <label for="titlePositionInside">
						<?php _e( 'Inside (default)', 'mfbfw' ); ?>
                    </label>
                    <input id="titlePositionOutside" class="titlePosition" type="radio" value="float"
                           name="mfbfw[titlePosition]"<?php if ( $settings['titlePosition'] == 'float' ) {
						echo ' checked="yes"';
					} ?> />
                    <label for="titlePositionOutside">
						<?php _e( 'Outside', 'mfbfw' ); ?>
                    </label>
                    <input id="titlePositionOver" class="titlePosition" type="radio" value="over"
                           name="mfbfw[titlePosition]"<?php if ( $settings['titlePosition'] == 'over' ) {
						echo ' checked="yes"';
					} ?> />
                    <label for="titlePositionOver">
						<?php _e( 'Over', 'mfbfw' ); ?>
                    </label>
                    <div class="line-spacer"></div>
                    <div id="titleColorBlock">
                        <label for="titleColor">
                            <input type="text" class="color-btn" name="mfbfw[titleColor]" id="titleColor"
                                   class="colorpick" value="<?php echo $settings['titleColor']; ?>" size="7"
                                   maxlength="7"/>
                        </label>
                        <p class="description"><?php _e( 'Title text color (default: #333333)', 'mfbfw' ); ?></p>
                        <p class="description"><?php _e( '(Should contrast with the padding color set above)', 'mfbfw' ); ?></p>
                    </div>
                </div>
            </fieldset>
        </td>
    </tr>
    <tr valign="top">
        <th scope="row"><?php _e( 'Navigation Arrows', 'mfbfw' ); ?></th>
        <td>
            <fieldset>
                <input type="checkbox" class="onoffswitch-checkbox" name="mfbfw[showNavArrows]"
                       id="showNavArrows"<?php if ( isset( $settings['showNavArrows'] ) && $settings['showNavArrows'] ) {
					echo ' checked="yes"';
				} ?> />
                <label for="showNavArrows" class="onoffswitch-label"></label>
                <span class="switch-text"><?php _e( 'Show the navigation arrows (default: on)', 'mfbfw' ); ?></span>
                <div class="cf"></div>
            </fieldset>
        </td>
    </tr>
    </tbody>
</table>