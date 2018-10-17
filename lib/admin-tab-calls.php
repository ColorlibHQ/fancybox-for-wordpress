<h3><?php _e( 'Extra FancyBox Calls <span style="color:red">(advanced)</span>', 'mfbfw' ); ?></h3>

<p><?php _e( 'Here you can add as many additional calls to fancybox as you want, with different settings. For example, if you want to use fancybox with iframes or ajax on any specific link, you can configure those calls here without affecting the settings for images.', 'mfbfw' ); ?></p>

<p><?php _e( 'For information on the options available you can use here see <a href="http://fancyapps.com/fancybox/3/">FancyBox\'s API & Options page</a>.', 'mfbfw' ); ?></p>

<table class="form-table fancy-table" style="clear:none;">
	<tbody>

		<tr valign="top">
			<th scope="row"><?php _e( 'Additional FancyBox Calls', 'mfbfw' ); ?></th>
			<td>
				<fieldset>
					<input type="checkbox" class="onoffswitch-checkbox" name="mfbfw[extraCallsEnable]" id="extraCallsEnable"<?php if ( isset( $settings[ 'extraCallsEnable' ] ) && $settings[ 'extraCallsEnable' ] ) echo ' checked="yes"'; ?> />
					<label for="extraCallsEnable" class="onoffswitch-label"></label>
					<span class="switch-text"><?php _e( 'Additional FancyBox Calls (default: off)', 'mfbfw' ); ?></span><div class="cf"></div><br /><br />

					<div id="extraCallsBlock">

						<label for="extraCalls">
							<textarea rows="20" cols="50" class="large-text code" name="mfbfw[extraCallsData]" wrap="physical" id="extraCalls"><?php echo ($settings[ 'extraCallsData' ]); ?></textarea>
						</label><br /><br />

						<small><strong><em><?php _e( 'Example:', 'mfbfw' ); ?></em></strong></small><br />
						<small><em><code>
									jQuery("#login a").fancybox({<br />
									&nbsp;&nbsp;'transitionIn': 'elastic',<br />
									&nbsp;&nbsp;'speedIn': 600,<br />
									&nbsp;&nbsp;'speedOut': 200,<br />
									&nbsp;&nbsp;'type': 'iframe'<br />
									});
								</code></em></small><br /><br />
					</div>

				</fieldset>
			</td>
		</tr>

	</tbody>
</table>