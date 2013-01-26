				<h2><?php _e('Other Settings <span style="color:red">(advanced)</span>', 'mfbfw'); ?></h2>

				<p><?php _e('These are additional settings for advanced users.', 'mfbfw'); ?></p>

				<table class="form-table" style="clear:none;">
					<tbody>

						<tr valign="top">
							<th scope="row"><?php _e('Dimensions', 'mfbfw'); ?></th>
							<td>
								<fieldset>

									<label for="autoDimensions">
										<input type="checkbox" name="mfbfw[autoDimensions]" id="autoDimensions"<?php if ( isset($mfbfw['autoDimensions']) && $mfbfw['autoDimensions'] ) echo ' checked="yes"';?> />
										<?php _e('Auto detect dimensions (default: on)', 'mfbfw'); ?>
									</label><br />

									<small><em><?php _e('Only works with <strong>Ajax</strong> and <strong>Inline</strong> content! Flash dimensions won\'t be autodetected so specify them below if necessary. If you want to insert several pieces of flash content with different dimensions you will have to use the <strong>Additional FancyBox Calls</strong> option.', 'mfbfw'); ?></em></small><br /><br />

									<label for="frameWidth">
										<input type="text" name="mfbfw[frameWidth]" id="frameWidth" value="<?php echo $mfbfw['frameWidth']; ?>" size="4" maxlength="4" />
										<?php _e('Width for iframe and swf content. Also set for inline content if <em>autoDimensions</em> is disabled (default: 560)', 'mfbfw'); ?>
									</label><br /><br />

									<label for="frameHeight">
										<input type="text" name="mfbfw[frameHeight]" id="frameHeight" value="<?php echo $mfbfw['frameHeight']; ?>" size="4" maxlength="4" />
										<?php _e('Height for iframe and swf content. Also set for inline content if <em>autoDimensions</em> is disabled (default: 340)', 'mfbfw'); ?>
									</label><br /><br />

								</fieldset>
							</td>
						</tr>
                        
                        <tr valign="top">
							<th scope="row"><?php _e('SVG Support', 'mfbfw'); ?></th>
                            <td>
                                <label for="svgEnable">
                                    <input type="checkbox" name="mfbfw[svgEnable]" id="svgEnable"<?php if ( isset($mfbfw['svgEnable']) && $mfbfw['svgEnable'] ) echo ' checked="yes"';?> />
                                    <?php _e('Look for image links inside SVG elements (default: off)', 'mfbfw'); ?>
                                </label>
                            </td>
                        </tr>

						<tr valign="top">
							<th scope="row"><?php _e('Load JavaScript in Footer', 'mfbfw'); ?></th>
							<td>
								<fieldset>

									<label for="loadAtFooter">
										<input type="checkbox" name="mfbfw[loadAtFooter]" id="loadAtFooter"<?php if ( isset($mfbfw['loadAtFooter']) && $mfbfw['loadAtFooter'] ) echo ' checked="yes"';?> />
										<?php _e('Loads JavaScript at the end of the blog\'s HTML (default: off)', 'mfbfw'); ?>
									</label><br />

									<small><em><?php _e('This option won\'t be recognized if you use <strong>Parallel Load</strong> plugin. In that case, you can do this from Parallel Load\'s options.', 'mfbfw'); ?></em></small><br /><br />

								</fieldset>
							</td>
						</tr>

						<tr valign="top">
							<th scope="row"><?php _e('Image Title function', 'mfbfw'); ?></th>
							<td>
								<fieldset>

									<label for="copyTitleFunction">
										<?php _e('Function to customize image titles', 'mfbfw'); ?>
										<textarea rows="10" cols="50" class="large-text code" name="mfbfw[copyTitleFunction]" wrap="physical" id="copyTitleFunction"><?php echo ($mfbfw['copyTitleFunction']); ?></textarea>
									</label><br />

									<small><em><?php _e('This option allows you to edit image titles with your own jQuery function.', 'mfbfw'); ?></em></small><br /><br />

									<small><strong><em><?php _e('Example:', 'mfbfw'); ?></em></strong></small><br />
									<small><em><code>
										var arr = jQuery("a.fancybox");<br />
										jQuery.each(arr, function() {<br />
										&nbsp;&nbsp;var title = jQuery(this).children("img").attr("title");<br />
										&nbsp;&nbsp;jQuery(this).attr("title",title);<br />
										})
									</code></em></small><br /><br />

								</fieldset>
							</td>
						</tr>

						<tr valign="top">
							<th scope="row"><?php _e('Callbacks', 'mfbfw'); ?></th>
							<td>
								<fieldset>

									<label for="callbackEnable">
										<input type="checkbox" name="mfbfw[callbackEnable]" id="callbackEnable"<?php if ( isset($mfbfw['callbackEnable']) && $mfbfw['callbackEnable'] ) echo ' checked="yes"';?> />
										<?php _e('Enable callbacks (default: off)', 'mfbfw'); ?>
									</label><br />

									<small><em><?php _e('Enabling this will show additional settings.', 'mfbfw'); ?></em></small><br /><br />

									<div id="callbackBlock">

										<label for="callbackOnStart">
											<?php _e('Callback on <strong>Start</strong> event: Will be called right before attempting to load the content', 'mfbfw'); ?>
											<textarea rows="10" cols="50" class="large-text code" name="mfbfw[callbackOnStart]" wrap="physical" id="callbackOnStart"><?php echo ($mfbfw['callbackOnStart']); ?></textarea>
										</label><br /><br />

										<label for="callbackOnCancel">
											<?php _e('Callback on <strong>Cancel</strong> event: Will be called after loading is canceled', 'mfbfw'); ?>
											<textarea rows="10" cols="50" class="large-text code" name="mfbfw[callbackOnCancel]" wrap="physical" id="callbackOnCancel"><?php echo ($mfbfw['callbackOnCancel']); ?></textarea>
										</label><br /><br />

										<label for="callbackOnComplete">
											<?php _e('Callback on <strong>Complete</strong> event: Will be called once the content is displayed', 'mfbfw'); ?>
											<textarea rows="10" cols="50" class="large-text code" name="mfbfw[callbackOnComplete]" wrap="physical" id="callbackOnComplete"><?php echo ($mfbfw['callbackOnComplete']); ?></textarea>
										</label><br /><br />

										<label for="callbackOnCleanup">
											<?php _e('Callback on <strong>CleanUp</strong> event: Will be called just before closing', 'mfbfw'); ?>
											<textarea rows="10" cols="50" class="large-text code" name="mfbfw[callbackOnCleanup]" wrap="physical" id="callbackOnCleanup"><?php echo ($mfbfw['callbackOnCleanup']); ?></textarea>
										</label><br /><br />

										<label for="callbackOnClosed">
											<?php _e('Callback on <strong>Closed</strong> event: Will be called once FancyBox is closed', 'mfbfw'); ?>
											<textarea rows="10" cols="50" class="large-text code" name="mfbfw[callbackOnClose]" wrap="physical" id="callbackOnClosed"><?php echo ($mfbfw['callbackOnClose']); ?></textarea>
										</label><br /><br/>

										<small><strong><em><?php _e('Example:', 'mfbfw'); ?></em></strong></small><br />
										<small><em><code>function() { alert('Hello world!'); }</code></em></small><br />
										<small><em><?php _e('Leave empty any specific callbacks you don\'t need to use.', 'mfbfw'); ?></em></small><br /><br />

									</div>

								</fieldset>
							</td>
						</tr>

					</tbody>
				</table>