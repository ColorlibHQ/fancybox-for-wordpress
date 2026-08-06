<?php defined( 'ABSPATH' ) || exit; ?>
<h3><?php echo wp_kses_post( __( 'Appearance Settings <span style="color:green">(basic)</span>', 'fancybox-for-wordpress' ) ); ?></h3>

<p><?php esc_html_e( 'These setting control how Fancybox looks, they let you tweak color, borders and position of elements, like the image title and closing buttons.', 'fancybox-for-wordpress' ); ?></p>

<table class="form-table fancy-table" style="clear:none;">
    <tbody>
    <tr valign="top">
        <th scope="row"><?php esc_html_e( 'Close Button', 'fancybox-for-wordpress' ); ?>
            <span class="tooltip-right"
                  data-tooltip="<?php esc_html_e( 'Show Close button (default: off)', 'fancybox-for-wordpress' ); ?>">
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
        <th scope="row"><?php esc_html_e( 'Toolbar', 'fancybox-for-wordpress' ); ?>
            <span class="tooltip-right"
                  data-tooltip="<?php esc_html_e( 'Show Toolbar  (default: on)', 'fancybox-for-wordpress' ); ?>">
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
        <th scope="row"><?php esc_html_e( 'Border', 'fancybox-for-wordpress' ); ?>
            <span class="tooltip-right"
                  data-tooltip="<?php esc_html_e( 'Show Border (default: off)', 'fancybox-for-wordpress' ); ?>">
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
                               value="<?php echo esc_attr( $settings['borderColor'] ) ?>" size="7" maxlength="7"/>
                    </label>
                    <p class="description"><?php esc_html_e( 'HTML color of the border (default: #BBBBBB)', 'fancybox-for-wordpress' ); ?></p>
                </div>
            </fieldset>
        </td>
    </tr>
    <tr valign="top">
        <th scope="row"><?php esc_html_e( 'Padding', 'fancybox-for-wordpress' ); ?>
            <span class="tooltip-right"
                  data-tooltip="<?php esc_html_e( 'HTML color of the padding (default: #FFFFFF)', 'fancybox-for-wordpress' ); ?>">
                  <i class="dashicons dashicons-editor-help"></i>
             </span>
        </th>
        <td>
            <fieldset>
                <label for="paddingColor">
                    <input type="text" class="color-btn" name="mfbfw[paddingColor]" id="paddingColor"
                           value="<?php echo esc_attr( $settings['paddingColor'] ) ?>" size="7" maxlength="7"/>
                </label>
                <p class="description"><?php esc_html_e( '(This should be left on #FFFFFF (white) if you want to display anything other than images, like inline or framed content)', 'fancybox-for-wordpress' ); ?></p>
                <div class="line-spacer"></div>
                <label for="padding" class="inlined">
                    <input type="text" class="slider-text" name="mfbfw[padding]" id="padding"
                           value="<?php echo esc_attr( $settings['padding'] ); ?>" size="7" maxlength="7"/>
                    <div class="slider-horizontal" minSl="0" maxSl="100" stepSl="1" rangeSl="min"
                         style="height:14px;"></div>
                    <div class="cf"></div>
                    <p class="description"><span class="slider-spantext"><?php esc_html_e( 'Padding size in pixels (default: 10)', 'fancybox-for-wordpress' ); ?></span></p>
                </label>
            </fieldset>
        </td>
    </tr>
    <tr valign="top">
        <th scope="row"><?php esc_html_e( 'Overlay Options', 'fancybox-for-wordpress' ); ?>
            <span class="tooltip-right"
                  data-tooltip="<?php esc_html_e( 'Add overlay (default: on)', 'fancybox-for-wordpress' ); ?>">
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
                               value="<?php echo esc_attr( $settings['overlayColor'] ); ?>" size="7" maxlength="7"/>
                    </label>
                    <p class="description"><?php esc_html_e( 'HTML color of the overlay (default: #666666)', 'fancybox-for-wordpress' ); ?></p>
                    <div class="line-spacer"></div>
                    <label for="overlayOpacity" class="inlined">
                        <input type="text" class="slider-text" name="mfbfw[overlayOpacity]" id="overlayOpacity"
                               value="<?php echo esc_attr( $settings['overlayOpacity'] ); ?>" size="7" maxlength="7"/>
                        <div class="slider-horizontal" minSl="0" maxSl="1" stepSl="0.1" rangeSl="min"
                             style="height:14px;"></div>
                        <div class="cf"></div>
                        <p class="description"><span class="slider-spantext"><?php esc_html_e( 'Opacity of overlay. 0 is transparent, 1 is opaque (default: 0.3)', 'fancybox-for-wordpress' ); ?></span></p>
                    </label>
                </div>
            </fieldset>
        </td>
    </tr>
    <tr valign="top">
        <th scope="row"><?php esc_html_e( 'Title', 'fancybox-for-wordpress' ); ?>
            <span class="tooltip-right"
                  data-tooltip="<?php esc_html_e( 'Show the title (default: on)', 'fancybox-for-wordpress' ); ?>">
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
                               value="<?php echo esc_attr( $settings['titleSize'] ); ?>"/>
						<?php esc_html_e( 'Title size (default: 14px)', 'fancybox-for-wordpress' ); ?>
                    </label>
                    <div class="cf"></div>
                    <div class="line-spacer"></div>
                    <input id="titlePositionInside" class="titlePosition" type="radio" value="inside"
                           name="mfbfw[titlePosition]"<?php if ( $settings['titlePosition'] == 'inside' ) {
						echo ' checked="yes"';
					} ?> />
                    <label for="titlePositionInside">
						<?php esc_html_e( 'Inside (default)', 'fancybox-for-wordpress' ); ?>
                    </label>
                    <input id="titlePositionOutside" class="titlePosition" type="radio" value="float"
                           name="mfbfw[titlePosition]"<?php if ( $settings['titlePosition'] == 'float' ) {
						echo ' checked="yes"';
					} ?> />
                    <label for="titlePositionOutside">
						<?php esc_html_e( 'Outside', 'fancybox-for-wordpress' ); ?>
                    </label>
                    <input id="titlePositionOver" class="titlePosition" type="radio" value="over"
                           name="mfbfw[titlePosition]"<?php if ( $settings['titlePosition'] == 'over' ) {
						echo ' checked="yes"';
					} ?> />
                    <label for="titlePositionOver">
						<?php esc_html_e( 'Over', 'fancybox-for-wordpress' ); ?>
                    </label>
                    <div class="line-spacer"></div>
                    <div id="titleColorBlock">
                        <label for="titleColor">
                            <input type="text" class="color-btn" name="mfbfw[titleColor]" id="titleColor"
                                   class="colorpick" value="<?php echo esc_attr( $settings['titleColor'] ); ?>" size="7"
                                   maxlength="7"/>
                        </label>
                        <p class="description"><?php esc_html_e( 'Title text color (default: #333333)', 'fancybox-for-wordpress' ); ?></p>
                        <p class="description"><?php esc_html_e( '(Should contrast with the padding color set above)', 'fancybox-for-wordpress' ); ?></p>
                    </div>
                </div>
            </fieldset>
        </td>
    </tr>
    <tr valign="top">
        <th scope="row"><?php esc_html_e( 'Hide caption*', 'fancybox-for-wordpress' ); ?>
            <span class="tooltip-right"
                  data-tooltip="<?php esc_html_e( 'Hide the caption in lightbox. In some cases both figure caption and image title are displayed in the lightbox (default: off)', 'fancybox-for-wordpress' ); ?>">
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
        <th scope="row"><?php esc_html_e( 'Navigation Arrows', 'fancybox-for-wordpress' ); ?>
            <span class="tooltip-right"
                  data-tooltip="<?php esc_html_e( 'Show the navigation arrows (default: on)', 'fancybox-for-wordpress' ); ?>">
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