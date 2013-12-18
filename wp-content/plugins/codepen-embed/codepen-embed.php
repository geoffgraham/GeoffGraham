<?php
/*
Plugin Name: CodePen Embed
Plugin URI: http://jawittdesigns.github.com/codepen-embed-wordpress-plugin/
Version: 1.0
Author: Jason Witt
Description: Easily Include CodePen Embeds on your WordPress Blog
Author URI: http://jawittdesigns.com
Text Domain: codepen-embed
License: GPL3
*/
/*  
CodePen Embed Copyright 2013 Jason Witt (email : contact@jawittdesigns.com)

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/
/*===============================================================================
	Plugin Constants
===============================================================================*/
// Plugin URL Constant
if ( !defined( 'PLUGIN_URL' ) ){
	define( 'PLUGIN_URL', WP_PLUGIN_URL . '/' . str_replace(basename( __FILE__), "" ,plugin_basename(__FILE__)));
}
// Plugin Directory Constant
if ( !defined( 'PLUGIN_DIR' ) ){
	define( 'PLUGIN_DIR', WP_PLUGIN_DIR  . '/' . str_replace(basename( __FILE__), "" ,plugin_basename(__FILE__)));
}
// Plugin Domain Constant
if ( !defined( 'DOMAIN' ) ) {
		define( 'DOMAIN', 'codepen-embed' );
}	
/*===============================================================================
	Includes
===============================================================================*/
// Required class.new-tinymce-button.php
require(PLUGIN_DIR.'includes/class.new-tinymce-button.php');
// Required class.new_wp_quicktag.php
require(PLUGIN_DIR.'includes/class.new_wp_quicktag.php');
// Required cpe_shortcode.php
require(PLUGIN_DIR.'includes/cpe_shortcode.php');
// Include cpe_i18n_init.php
include_once(PLUGIN_DIR.'includes/cpe_i18n_init.php');
/*===============================================================================
	Classes
===============================================================================*/
// New instance of the new_tinymce_btn() Class 
new new_tinymce_btn('|','codepen_embed', PLUGIN_URL.'tinymce/codepen-tinymce.js');
// New instance of the wp_add_quicktags() Class
new wp_add_quicktags('CodePen','CodePen', '[CodePen height=300 show=html href=aBcdE user=username ]','','','Insert CodePen Embed');
/*===============================================================================
	Actions and Filters
===============================================================================*/
// Action for cpe_shortcode() function in cpe_shortcode.php
add_shortcode('CodePen', 'cpe_shortcode');
?>