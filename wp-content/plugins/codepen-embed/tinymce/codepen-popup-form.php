<?php
require('../../../../wp-blog-header.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>CodePen Embed</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.js"></script>
<script type="text/javascript" src="../../../../wp-includes/js/tinymce/tiny_mce_popup.js"></script>
<link href="../css/codepen-embed.css"  media="screen"  rel="stylesheet" type="text/css" />
<script>
// Code used on init
/*global tinymce: true, tinyMCEPopup: true, jQuery: true*/
var CodepenEmbed = {
    local_ed: 'ed',
    init: function (ed) {
        "use strict";
        CodepenEmbed.local_ed = ed;
        tinyMCEPopup.resizeToInnerSize();
    },
    // Insert data to editor and close
    insert: function insertShortcode(ed) {
        "use strict";
        tinyMCEPopup.execCommand('mceRemoveNode', false, null);
        var show = jQuery('#codepen-form select#codepen-show').val(),
            height = jQuery('#codepen-form input#codepen-height').val(),
            href = jQuery('#codepen-form input#codepen-href').val(),
            user = jQuery('#codepen-form input#codepen-user').val(),
            output = '';
        output = '[CodePen ';
        output += 'height=' + height + ' ';
        output += 'show=' + show + ' ';
        output += 'href=' + href + ' ';
        output += 'user=' + user + ' ';
        output += ']';
        tinyMCEPopup.execCommand('mceReplaceContent', false, output);
        tinyMCEPopup.close();
    }
};
tinyMCEPopup.onInit.add(CodepenEmbed.init, CodepenEmbed);
</script>
</head>
<body>
<div id="codepen-form" class="codepen-embed">
	<form action="/" method="get" accept-charset="utf-8">
		<div class="form-element">
			<label for="codepen-user"><h3><?php _e('Username',DOMAIN); ?></h3></label>
			<input type="text" id="codepen-user" name="user" value=""/>
			<div class="description"><strong><?php _e('Codepen Username',DOMAIN); ?></strong></div>
		</div>
		<div class="clear"></div>
		<div class="form-element">
			<label for="href"><h3><?php _e('URL',DOMAIN); ?></h3></label>
			<input type="text" id="codepen-href" name="href" value="aBcdE"/>
			<strong><?php _e('The Last Part of the Pen\'s URL',DOMAIN); ?><br/>
			<div class="description"><?php _e('Example: http://codepen.io/username/pen/',DOMAIN); ?></strong><em><?php _e('JustThis',DOMAIN); ?></em></div>
		</div>
		<div class="clear"></div>
		<div class="form-element">
			<label for="codepen-show"><h3><?php _e('Display Onload',DOMAIN); ?></h3></label>
			<select name="show" id="codepen-show">
				<option value="html"><?php _e('HTML',DOMAIN); ?></option>
				<option value="css"><?php _e('CSS',DOMAIN); ?></option>
				<option value="js"><?php _e('JavaScript',DOMAIN); ?></option>
				<option value="result"><?php _e('Result',DOMAIN); ?></option>
			</select>
			<div class="description"><strong><?php _e('Choose What Section to Display When the Pen Loads',DOMAIN); ?></strong></div>
		</div>
		<div class="clear"></div>
		<div class="form-element">
			<label for="codepen-height"><h3><?php _e('Height',DOMAIN); ?></h3></label>
			<input type="text" id="codepen-height" name="height" value="300"/>
			<div class="description"><strong><?php _e('The Height of the Pen Embed',DOMAIN); ?><br/>
			<?php _e('Example: \'300\' not \'300px\'',DOMAIN); ?></strong></div>
		</div>
		<div class="clear"></div>
		<div class="form-element">
			<a href="javascript:CodepenEmbed.insert(CodepenEmbed.local_ed)" id="insert">	
				<?php _e('Insert',DOMAIN); ?>
			</a>
		</div>
	</form>
</div>
</body>
</html>