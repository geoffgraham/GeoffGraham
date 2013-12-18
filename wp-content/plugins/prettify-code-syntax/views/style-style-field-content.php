<fieldset><legend class="screen-reader-text"><span><?php _e('Style', $this->plugin_id) ?></span></legend>
	<table>
		<?php 
		foreach ($this->styles as $style => $name):
		?>
			<tr>
				<td>
					<label for="mh-style-<?php echo $style; ?>">
						<input id="mh-style-<?php echo $style; ?>" type="radio" name="prettify_code_syntax[style]" value="<?php echo $style; ?>" <?php if ($this->options['style'] == $style || (!$options['style'] && $style == 'default')) { echo 'checked="checked"'; } ?> />
						<?php _e($name, $this->plugin_id) ?>
					</label>
				</td>
				<td>
					<label for="mh-style-<?php echo $style; ?>">
						<img src="<?php echo $this->plugin_url ?>/images/<?php echo $style; ?>.png" alt="<?php echo $name; ?>" />
					</label>
				</td>
			</tr>
		<?php 
		endforeach;
		?>

		<tr>
			<td>
				<label for="mh-style-custom">
					<input id="mh-style-custom" type="radio" name="prettify_code_syntax[style]" value="custom" <?php if ($this->options['style'] == 'custom') { echo 'checked="checked"'; } ?> />
					<?php _e('Custom', $this->plugin_id) ?>
				</label>
			</td>
			<td>
				<label for="mh-style-custom">
					<textarea cols="90" rows="30" name="prettify_code_syntax[style_custom]">
<?php 
if(!empty($this->options['style_custom'])) {
	echo $this->options['style_custom']; 
} else {
	include(dirname(dirname(__FILE__)).'/stylesheets/sunburst.css');
}
?>
					</textarea>
				</label>
			</td>
		</tr>
	</table>
</fieldset>






