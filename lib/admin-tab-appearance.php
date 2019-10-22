<h3><?php _e( 'Appearance Settings <span style="color:green">(basic)</span>', 'mfbfw' ); ?></h3>

<p><?php _e( 'These setting control how Fancybox looks, they let you tweak color, borders and position of elements, like the image title and closing buttons.', 'mfbfw' ); ?></p>

<table class="form-table fancy-table" style="clear:none;">
    <tbody>
    <tr valign="top">
        <th scope="row"><?php _e( 'Close Button', 'mfbfw' ); ?>
            <span class="tooltip-right"
                  data-tooltip="<?php _e( 'Show Close button (default: off)', 'mfbfw' ); ?>">
                  <i class="dashicons dashicons-editor-help"></i>
             </span>
        </th>
        <td>
            <fieldset>
                <div class="epsilon-toggle">
                    <input class="epsilon-toggle__input" type="checkbox" id="showCloseButton" name="mfbfw[showCloseButton]" <?php checked( 1, isset( $settings['showCloseButton'] ) && $settings['showCloseButton'] ); ?> >
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

                <div class="cf"></div>
            </fieldset>
        </td>
    </tr>
    <tr valign="top">
        <th scope="row"><?php _e( 'Toolbar', 'mfbfw' ); ?>
            <span class="tooltip-right"
                  data-tooltip="<?php _e( 'Show Toolbar  (default: on)', 'mfbfw' ); ?>">
                  <i class="dashicons dashicons-editor-help"></i>
             </span>
        </th>
        <td>
            <fieldset>
                <div class="epsilon-toggle">
                    <input class="epsilon-toggle__input" type="checkbox" id="showToolbar" name="mfbfw[showToolbar]" <?php checked( 1, isset( $settings['showToolbar'] ) && $settings['showToolbar'] ); ?> >
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
                <div class="cf"></div>
            </fieldset>
        </td>
    </tr>
    <tr valign="top">
        <th scope="row"><?php _e( 'Border', 'mfbfw' ); ?>
            <span class="tooltip-right"
                  data-tooltip="<?php _e( 'Show Border (default: off)', 'mfbfw' ); ?>">
                  <i class="dashicons dashicons-editor-help"></i>
             </span>
        </th>
        <td>
            <fieldset>
                <div class="epsilon-toggle">
                    <input class="epsilon-toggle__input" type="checkbox" id="border" name="mfbfw[border]" <?php checked( 1, isset( $settings['border'] ) && $settings['border'] ); ?> >
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
        <th scope="row"><?php _e( 'Padding', 'mfbfw' ); ?>
            <span class="tooltip-right"
                  data-tooltip="<?php _e( 'HTML color of the padding (default: #FFFFFF)', 'mfbfw' ); ?>">
                  <i class="dashicons dashicons-editor-help"></i>
             </span>
        </th>
        <td>
            <fieldset>
                <label for="paddingColor">
                    <input type="text" class="color-btn" name="mfbfw[paddingColor]" id="paddingColor"
                           value="<?php echo $settings['paddingColor'] ?>" size="7" maxlength="7"/>
                </label>
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
        <th scope="row"><?php _e( 'Overlay Options', 'mfbfw' ); ?>
            <span class="tooltip-right"
                  data-tooltip="<?php _e( 'Add overlay (default: on)', 'mfbfw' ); ?>">
                  <i class="dashicons dashicons-editor-help"></i>
             </span>
        </th>
        <td>
            <fieldset>
                <div class="epsilon-toggle">
                    <input class="epsilon-toggle__input" type="checkbox" id="overlayShow" name="mfbfw[overlayShow]" <?php checked( 1, isset( $settings['overlayShow'] ) && $settings['overlayShow'] ); ?> >
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
        <th scope="row"><?php _e( 'Title', 'mfbfw' ); ?>
            <span class="tooltip-right"
                  data-tooltip="<?php _e( 'Show the title (default: on)', 'mfbfw' ); ?>">
                  <i class="dashicons dashicons-editor-help"></i>
             </span>
        </th>
        <td>
            <fieldset>
                <div class="epsilon-toggle">
                    <input class="epsilon-toggle__input" type="checkbox" id="titleShow" name="mfbfw[titleShow]" <?php checked( 1, isset( $settings['titleShow'] ) && $settings['titleShow'] );?> >
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
        <th scope="row"><?php _e( 'Hide caption*', 'mfbfw' ); ?>
            <span class="tooltip-right"
                  data-tooltip="<?php _e( 'Hide the caption in lightbox. In some cases both figure caption and image title are displayed in the lightbox (default: off)', 'mfbfw' ); ?>">
                  <i class="dashicons dashicons-editor-help"></i>
             </span>
        </th>
        <td>
            <fieldset>
                <div class="epsilon-toggle">
                    <input class="epsilon-toggle__input" type="checkbox" id="captionShow" name="mfbfw[captionShow]" <?php checked( 1, isset( $settings['captionShow'] ) && $settings['captionShow'] );?> >
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
                <div class="cf"></div>
            </fieldset>
        </td>
    </tr>
    <tr valign="top">
        <th scope="row"><?php _e( 'Navigation Arrows', 'mfbfw' ); ?>
            <span class="tooltip-right"
                  data-tooltip="<?php _e( 'Show the navigation arrows (default: on)', 'mfbfw' ); ?>">
                  <i class="dashicons dashicons-editor-help"></i>
             </span>
        </th>
        <td>
            <fieldset>
                <div class="epsilon-toggle">
                    <input class="epsilon-toggle__input" type="checkbox" id="showNavArrows" name="mfbfw[showNavArrows]" <?php checked( 1, isset( $settings['showNavArrows'] ) && $settings['showNavArrows'] ); ?> >
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

                <div class="cf"></div>
            </fieldset>
        </td>
    </tr>
    </tbody>
</table>