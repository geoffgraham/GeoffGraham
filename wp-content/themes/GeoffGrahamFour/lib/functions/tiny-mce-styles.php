<?php
/**
 * TINY MCE STYLES
 * Adds style classes to the visual editor
 * ----------------------------------------------------------------------------
 */

add_filter( 'tiny_mce_before_init', 'my_custom_tinymce' );

function my_custom_tinymce( $init ) {
	$init['theme_advanced_buttons2_add_before'] = 'styleselect';
	$init['theme_advanced_styles'] = 'Subhead=subhead,Shadow=shadow';
	return $init;
}