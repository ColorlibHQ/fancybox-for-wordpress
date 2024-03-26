<h3><?php echo wp_kses_post( __( 'Other Settings <span style="color:red">(advanced)</span>', 'mfbfw' ) ); ?></h3>
<p><?php esc_html_e( 'These are additional settings for advanced users.', 'mfbfw' ); ?></p>
<table class="form-table fancy-table" style="clear:none;">
    <tbody>
    <tr valign="top">
        <th scope="row"><?php esc_html_e( 'Dimensions', 'mfbfw' ); ?>
            <span class="tooltip-right"
                  data-tooltip="<?php esc_html_e( 'Auto detect dimensions (default: on)', 'mfbfw' ); ?>">
                  <i class="dashicons dashicons-editor-help"></i>
             </span>
        </th>
        <td>
            <fieldset>
                <div class="epsilon-toggle">
                    <input class="epsilon-toggle__input" type="checkbox" id="autoDimensions" name="mfbfw[autoDimensions]" <?php checked( 1, isset( $settings['autoDimensions'] ) && $settings['autoDimensions'] ); ?> >
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
                    <em><?php echo wp_kses_post( __( 'Only works with <strong>Ajax</strong> and <strong>Inline</strong> content! Flash dimensions won\'t be autodetected so specify them below if necessary. If you want to insert several pieces of flash content with different dimensions you will have to use the <strong>Additional FancyBox Calls</strong> option.', 'mfbfw' ) ); ?></em>
                </p>
                <div class="line-spacer"></div>
                <label for="frameWidth">
                    <input type="text" name="mfbfw[frameWidth]" id="frameWidth"
                           value="<?php echo esc_attr( $settings['frameWidth'] ); ?>" size="4" maxlength="4"/>
					<?php esc_html_e( 'Width for iframe and swf content. Also set for inline content if <em>autoDimensions</em> is disabled (default: 560)', 'mfbfw' ); ?>
                </label>
                <label for="frameHeight">
                    <input type="text" name="mfbfw[frameHeight]" id="frameHeight"
                           value="<?php echo esc_attr( $settings['frameHeight'] ); ?>" size="4" maxlength="4"/>
					<?php esc_html_e( 'Height for iframe and swf content. Also set for inline content if <em>autoDimensions</em> is disabled (default: 340)', 'mfbfw' ); ?>
                </label>
            </fieldset>
        </td>
    </tr>
    <tr valign="top">
        <th scope="row"><?php esc_html_e( 'Load JavaScript in Footer', 'mfbfw' ); ?>
            <span class="tooltip-right"
                  data-tooltip="<?php esc_html_e( 'Loads JavaScript at the end of the blog\'s HTML (experimental) (default: off)', 'mfbfw' ); ?>">
                  <i class="dashicons dashicons-editor-help"></i>
             </span>
        </th>
        <td>
            <fieldset>
                <div class="epsilon-toggle">
                    <input class="epsilon-toggle__input" type="checkbox" id="loadAtFooter" name="mfbfw[loadAtFooter]" <?php checked( 1, isset( $settings['loadAtFooter'] ) && $settings['loadAtFooter'] ); ?> >
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
                    <em><?php esc_html_e( 'This option won\'t be recognized if you use <strong>Parallel Load</strong> plugin. In that case, you can do this from Parallel Load\'s options.', 'mfbfw' ); ?></em>
                </p>
            </fieldset>
        </td>
    </tr>
    <tr valign="top">
        <th scope="row"><?php esc_html_e( 'Callbacks', 'mfbfw' ); ?>
            <span class="tooltip-right"
                  data-tooltip="<?php esc_html_e( 'Enable callbacks (default: off)', 'mfbfw' ); ?>">
                  <i class="dashicons dashicons-editor-help"></i>
             </span>
        </th>
        <td>
            <fieldset>
                <div class="epsilon-toggle">
                    <input class="epsilon-toggle__input" type="checkbox" id="callbackEnable" name="mfbfw[callbackEnable]" <?php checked( 1, isset( $settings['callbackEnable'] ) && $settings['callbackEnable'] ); ?> >
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
                <p class="description"><em><?php esc_html_e( 'Enabling this will show additional settings.', 'mfbfw' ); ?></em>
                </p>
                <div class="line-spacer"></div>
                <div id="callbackBlock">
					<?php echo wp_kses_post( __( 'Callback on <strong>Start</strong> event: Will be called right before attempting to load the content', 'mfbfw' ) ); ?>
                    <div class="line-spacer"></div>
                    <label for="callbackOnStart">
                        <div class="start-editing"><p><?php esc_html_e( 'Click to start editing', 'mfbfw' ); ?></p></div>
                        <textarea rows="10" cols="50" class="large-text code" name="mfbfw[callbackOnStart]"
                                  wrap="physical"
                                  id="callbackOnStart"><?php echo esc_attr(  $settings['callbackOnStart'] ); ?></textarea>
                    </label>
					<?php echo wp_kses_post( __( 'Callback on <strong>Cancel</strong> event: Will be called after loading is canceled', 'mfbfw' ) ); ?>
                    <div class="line-spacer"></div>
                    <label for="callbackOnCancel">
                        <div class="start-editing"><p><?php esc_html_e( 'Click to start editing', 'mfbfw' ); ?></p></div>
                        <textarea rows="10" cols="50" class="large-text code" name="mfbfw[callbackOnCancel]"
                                  wrap="physical"
                                  id="callbackOnCancel"><?php echo esc_attr( $settings['callbackOnCancel'] ); ?></textarea>
                    </label>
					<?php echo wp_kses_post( __( 'Callback on <strong>Complete</strong> event: Will be called once the content is displayed', 'mfbfw' ) ); ?>
                    <div class="line-spacer"></div>
                    <label for="callbackOnComplete">
                        <div class="start-editing"><p><?php esc_html_e( 'Click to start editing', 'mfbfw' ); ?></p></div>
                        <textarea rows="10" cols="50" class="large-text code" name="mfbfw[callbackOnComplete]"
                                  wrap="physical"
                                  id="callbackOnComplete"><?php echo esc_attr(  $settings['callbackOnComplete'] ); ?></textarea>
                    </label>
					<?php echo wp_kses_post( __( 'Callback on <strong>CleanUp</strong> event: Will be called just before closing', 'mfbfw' ) ); ?>
                    <div class="line-spacer"></div>
                    <label for="callbackOnCleanup">
                        <div class="start-editing"><p><?php esc_html_e( 'Click to start editing', 'mfbfw' ); ?></p></div>
                        <textarea rows="10" cols="50" class="large-text code" name="mfbfw[callbackOnCleanup]"
                                  wrap="physical"
                                  id="callbackOnCleanup"><?php echo esc_attr(  $settings['callbackOnCleanup'] ); ?></textarea>
                    </label>
					<?php echo wp_kses_post( __( 'Callback on <strong>Closed</strong> event: Will be called once FancyBox is closed', 'mfbfw' ) ); ?>
                    <div class="line-spacer"></div>
                    <label for="callbackOnClosed">
                        <div class="start-editing"><p><?php esc_html_e( 'Click to start editing', 'mfbfw' ); ?></p></div>
                        <textarea rows="10" cols="50" class="large-text code" name="mfbfw[callbackOnClose]"
                                  wrap="physical"
                                  id="callbackOnClosed"><?php echo esc_attr(  $settings['callbackOnClose'] ); ?></textarea>
                    </label>
                    <p class="description"><strong><em><?php esc_html_e( 'Example:', 'mfbfw' ); ?></em></strong></p>
                    <p class="description"><em><code>function() { alert('Hello world!'); }</code></em></p>
                    <p class="description">
                        <em><?php esc_html_e( 'Leave empty any speciic callbacks you don\'t need to use.', 'mfbfw' ); ?></em>
                    </p>
                </div>
            </fieldset>
        </td>
    </tr>
    </tbody>
</table>
<h3><?php echo wp_kses_post( __( 'Extra FancyBox Calls <span style="color:red">(advanced)</span>', 'mfbfw' ) ); ?></h3>
<p><?php esc_html_e( 'Here you can add as many additional calls to fancybox as you want, with different settings. For example, if you want to use fancybox with iframes or ajax on any specific link, you can configure those calls here without affecting the settings for images.', 'mfbfw' ); ?></p>
<p><?php echo wp_kses_post( __( 'For information on the options available you can use here see <a href="http://fancyapps.com/fancybox/3/">FancyBox\'s API & Options page</a>.', 'mfbfw' ) ); ?></p>
<table class="form-table fancy-table" style="clear:none;">
    <tbody>
    <tr valign="top">
        <th scope="row"><?php esc_html_e( 'Additional FancyBox Calls', 'mfbfw' ); ?>
            <span class="tooltip-right"
                  data-tooltip="<?php esc_html_e( 'Additional FancyBox Calls (default: off)', 'mfbfw' ); ?>">
                  <i class="dashicons dashicons-editor-help"></i>
             </span>
        </th>
        <td>
            <fieldset>
                <div class="epsilon-toggle">
                    <input class="epsilon-toggle__input" type="checkbox" id="extraCallsEnable" name="mfbfw[extraCallsEnable]" <?php checked( 1, isset( $settings['extraCallsEnable'] ) && $settings['extraCallsEnable'] ); ?> >
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
                <div class="line-spacer"></div>
                <div id="extraCallsBlock">
                    <label for="extraCalls">
                        <div class="start-editing"><p><?php esc_html_e( 'Click to start editing', 'mfbfw' ); ?></p></div>
                        <textarea rows="20" cols="50" class="large-text code" name="mfbfw[extraCallsData]"
                                  wrap="physical"
                                  id="extraCalls"><?php echo esc_attr( $settings['extraCallsData'] ); ?></textarea>
                    </label>
                    <p class="description"><strong><em><?php esc_html_e( 'Example:', 'mfbfw' ); ?></em></strong></p><br/>
                    <p class="description"><em><code>
                                jQuery("#login a").fancybox({<br/>
                                &nbsp;&nbsp;'transitionIn': 'elastic',<br/>
                                &nbsp;&nbsp;'speedIn': 600,<br/>
                                &nbsp;&nbsp;'speedOut': 200,<br/>
                                &nbsp;&nbsp;'type': 'iframe'<br/>
                                });
                            </code></em></p>
                </div>
            </fieldset>
        </td>
    </tr>
    </tbody>
</table>
<h3><?php esc_html_e( 'Troubleshooting Settings', 'mfbfw' ); ?></h3>
<p>
    <span style="font-weight:bold;color:red;"><?php esc_html_e( 'Settings in this section should only be changed if you are having problems with the plugin!', 'mfbfw' ); ?></span>
</p>
<p><?php esc_html_e( 'If the plugin doesn\'t seem to work, first you should check for other plugins that may be conflicting with this one, especially other Lightbox, Slimbox, etc. Make sure all your plugins and WordPress itself are up to date (this plugin has only been tested in WordPress 2.7 and above).', 'mfbfw' ); ?></p>
<p><?php esc_html_e( 'Change them one at a time and test to see if they help. Remember that having a cache plugin may prevent changes from taking effect immidiately, so clear cache after saving changes here or deactivate cache until you finish editing these options.', 'mfbfw' ); ?></p>
<br/>
<table class="form-table fancy-table" style="clear:none;">
    <tbody>
    <tr valign="top">
        <th scope="row"><?php esc_html_e( 'Do not call jQuery', 'mfbfw' ); ?>
            <span class="tooltip-right"
                  data-tooltip="<?php esc_html_e( 'Skip jQuery call. Use this only if jQuery is being loaded twice (default: off)', 'mfbfw' ); ?>">
                  <i class="dashicons dashicons-editor-help"></i>
             </span>
        </th>
        <td>
            <fieldset>
                <div class="epsilon-toggle">
                    <input class="epsilon-toggle__input" type="checkbox" id="nojQuery" name="mfbfw[nojQuery]" <?php checked( 1, isset( $settings['nojQuery'] ) && $settings['nojQuery'] ); ?> >
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
<h3><?php esc_html_e( 'Uninstall', 'mfbfw' ); ?></h3>
<p><?php echo wp_kses_post( __( 'Like many other plugins, FancyBox for WordPress stores its settings on your WordPress\' options database table. Actually, these settings are not using more than a couple of kilobytes of space, but if you want to completely uninstall this plugin, check the option below, then save changes, and <strong>when you deactivate the plugin</strong>, all its settings will be removed from the database.', 'mfbfw' ) ); ?></p>
<table class="form-table fancy-table" style="clear:none;">
    <tbody>
    <tr valign="top">
        <th scope="row"><?php esc_html_e( 'Remove settings', 'mfbfw' ); ?>
            <span class="tooltip-right"
                  data-tooltip="<?php echo esc_attr__( 'Remove Settings when plugin is deactivated from the "Manage Plugins" page. (default: off)', 'mfbfw' ); ?>">
                  <i class="dashicons dashicons-editor-help"></i>
             </span>
        </th>
        <td>
            <fieldset>
                <div class="epsilon-toggle">
                    <input class="epsilon-toggle__input" type="checkbox" id="uninstall" name="mfbfw[uninstall]" <?php checked( 1, isset( $settings['uninstall'] ) && $settings['uninstall'] ); ?> >
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