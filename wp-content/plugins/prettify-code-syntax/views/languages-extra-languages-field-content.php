<fieldset><legend class="screen-reader-text"><span><?php _e('Extra Languages', 'markup-highlighter') ?></span></legend>
	<?php 
	foreach ($this->language_modules as $language => $name):
	?>
		<label for="mh-languages-<?php echo $language; ?>">
			<input id="mh-languages-<?php echo $language; ?>" type="checkbox" name="prettify_code_syntax[languages_<?php echo $language; ?>]" <?php if ($this->options['languages_'.$language]) { echo 'checked="checked"'; } ?> />
			<?php echo $name; ?>
		</label>
		<br />
	<?php 
	endforeach;
	?>
</fieldset>
