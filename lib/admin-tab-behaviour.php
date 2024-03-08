<h3><?php echo wp_kses_post( __( 'Behavior Settings <span style="color:orange">(medium)</span>', 'mfbfw' ) ); ?></h3>
<p><?php esc_html_e( 'The following settings should be left alone unless you know what you are doing.', 'mfbfw' ); ?></p>
<table class="form-table fancy-table" style="clear:none;">
    <tbody>
    <tr valign="top">
        <th scope="row"><?php esc_html_e( 'Close on Content Click', 'mfbfw' ); ?>
            <span class="tooltip-right"
                  data-tooltip="<?php esc_html_e( 'Close FancyBox by clicking on the image (default: off)', 'mfbfw' ); ?>">
                  <i class="dashicons dashicons-editor-help"></i>
             </span>
        </th>
        <td>
            <fieldset>
                <div class="epsilon-toggle">
                    <input class="epsilon-toggle__input" type="checkbox" id="hideOnContentClick" name="mfbfw[hideOnContentClick]" <?php checked( 1, isset( $settings['hideOnContentClick'] ) && $settings['hideOnContentClick'] ); ?> >
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
                <p class="description">
                    <em><?php esc_html_e( '(You may want to leave this off if you display iframed or inline content that containts clickable elements - for example: play buttons for movies, links to other pages)', 'mfbfw' ); ?>
                </p>
            </fieldset>
        </td>
    </tr>
    <tr valign="top">
        <th scope="row"><?php esc_html_e( 'Close on Overlay Click', 'mfbfw' ); ?>
            <span class="tooltip-right"
                  data-tooltip="<?php esc_html_e( 'Close FancyBox by clicking on the overlay surrounding it (default: on)', 'mfbfw' ); ?>">
                  <i class="dashicons dashicons-editor-help"></i>
             </span>
        </th>
        <td>
            <fieldset>
                <div class="epsilon-toggle">
                    <input class="epsilon-toggle__input" type="checkbox" id="hideOnOverlayClick" name="mfbfw[hideOnOverlayClick]" <?php checked( 1, isset( $settings['hideOnOverlayClick'] ) && $settings['hideOnOverlayClick'] ); ?> >
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
        <th scope="row"><?php esc_html_e( 'Keyboard navigation;', 'mfbfw' ); ?>
            <span class="tooltip-right"
                  data-tooltip="<?php esc_html_e( 'Enable Keyboard Navigation (default: on)', 'mfbfw' ); ?>">
                  <i class="dashicons dashicons-editor-help"></i>
             </span>
        </th>
        <td>
            <fieldset>
                <div class="epsilon-toggle">
                    <input class="epsilon-toggle__input" type="checkbox" id="enableEscapeButton" name="mfbfw[enableEscapeButton]" <?php checked( 1, isset( $settings['enableEscapeButton'] ) && $settings['enableEscapeButton'] ); ?> >
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
        <th scope="row"><?php esc_html_e( 'Loop Galleries', 'mfbfw' ); ?>
            <span class="tooltip-right"
                  data-tooltip="<?php esc_html_e( 'This will make galleries loop, allowing you to keep pressing next/back (default: off)', 'mfbfw' ); ?>">
                  <i class="dashicons dashicons-editor-help"></i>
             </span>
        </th>
        <td>
            <fieldset>
                <div class="epsilon-toggle">
                    <input class="epsilon-toggle__input" type="checkbox" id="cyclic" name="mfbfw[cyclic]" <?php checked( 1, isset( $settings['cyclic'] ) && $settings['cyclic'] ); ?> >
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
        <th scope="row"><?php esc_html_e( 'Mouse Wheel Navigation', 'mfbfw' ); ?>
            <span class="tooltip-right"
                  data-tooltip="<?php esc_html_e( 'Lets visitors navigate galleries with the mouse wheel  (default: off)', 'mfbfw' ); ?>">
                  <i class="dashicons dashicons-editor-help"></i>
             </span>
        </th>
        <td>
            <fieldset>
                <div class="epsilon-toggle">
                    <input class="epsilon-toggle__input" type="checkbox" id="mouseWheel" name="mfbfw[mouseWheel]" <?php checked( 1, isset( $settings['mouseWheel'] ) && $settings['mouseWheel'] ); ?> >
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
        <th scope="row"><?php esc_html_e( 'Zoom On Click', 'mfbfw' ); ?>
            <span class="tooltip-right"
                  data-tooltip="<?php esc_html_e( 'Lets visitors zoom in on the image when clicking it. It will have no effect if Close on Content Click is toggled.   (default: off)', 'mfbfw' ); ?>">
                  <i class="dashicons dashicons-editor-help"></i>
             </span>
        </th>
        <td>
            <fieldset>
                <div class="epsilon-toggle">
                    <input class="epsilon-toggle__input" type="checkbox" id="zoomOnClick" name="mfbfw[zoomOnClick]" <?php checked( 1, isset( $settings['zoomOnClick'] ) && $settings['zoomOnClick'] ); ?> >
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
        <th scope="row"><?php esc_html_e( 'Woocommerce:', 'mfbfw' ); ?></th>
        <td>
            <fieldset>
                <div class="epsilon-toggle">
                    <input class="epsilon-toggle__input" type="checkbox" id="disableWoocommercePages" name="mfbfw[disableWoocommercePages]" <?php checked( 1, isset( $settings['disableWoocommercePages'] ) && $settings['disableWoocommercePages'] ); ?> >
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
                <span class="switch-text"><?php esc_html_e( 'Disable on Woocommerce Shop page.( Default : off )', 'mfbfw' ); ?></span>
                <div class="cf"></div>
            </fieldset>
            <fieldset>
                <div class="epsilon-toggle">
                    <input class="epsilon-toggle__input" type="checkbox" id="disableWoocommerceProducts" name="mfbfw[disableWoocommerceProducts]" <?php checked( 1, isset( $settings['disableWoocommerceProducts'] ) && $settings['disableWoocommerceProducts'] ); ?> >
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
                <span class="switch-text"><?php esc_html_e( 'Disable on Woocommerce products.( Default : off )', 'mfbfw' ); ?></span>
                <div class="cf"></div>
            </fieldset>
        </td>
    </tr>
    <tr valign="top">
        <th scope="row"><?php esc_html_e( 'Exclude PDF files', 'mfbfw' ); ?>
            <span class="tooltip-right"
                  data-tooltip="<?php esc_html_e( 'Excludes links to files type .pdf from being displayed in the lightbox  (default: off)', 'mfbfw' ); ?>">
                  <i class="dashicons dashicons-editor-help"></i>
             </span>
        </th>
        <td>
            <fieldset>
                <div class="epsilon-toggle">
                    <input class="epsilon-toggle__input" type="checkbox" id="exclude_pdf" name="mfbfw[exclude_pdf]" <?php checked( 1, isset( $settings['exclude_pdf'] ) && $settings['exclude_pdf'] ); ?> >
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
	    <th scope="row"><?php esc_html_e( 'Disable FancyBox on mobile', 'mfbfw' ); ?>
		    <span class="tooltip-right"
		          data-tooltip="<?php esc_html_e( 'Disables FancyBox on mobile view (default: off)', 'mfbfw' ); ?>">
                  <i class="dashicons dashicons-editor-help"></i>
             </span>
	    </th>
	    <td>
		    <fieldset>
			    <div class="epsilon-toggle">
				    <input class="epsilon-toggle__input" type="checkbox" id="disableOnMobile" name="mfbfw[disableOnMobile]" <?php checked( 1, isset( $settings['disableOnMobile'] ) && 'on' == $settings['disableOnMobile'] ); ?> >
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