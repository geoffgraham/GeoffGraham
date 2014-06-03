<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet
	$themename = get_option( 'stylesheet' );
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = $themename;
	update_option( 'optionsframework', $optionsframework_settings );
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'geoffgraham'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function optionsframework_options() {

	// Test data
	$test_array = array(
		'one' => __('One', 'geoffgraham'),
		'two' => __('Two', 'geoffgraham'),
		'three' => __('Three', 'geoffgraham'),
		'four' => __('Four', 'geoffgraham'),
		'five' => __('Five', 'geoffgraham')
	);

	// Multicheck Array
	$multicheck_array = array(
		'one' => __('French Toast', 'geoffgraham'),
		'two' => __('Pancake', 'geoffgraham'),
		'three' => __('Omelette', 'geoffgraham'),
		'four' => __('Crepe', 'geoffgraham'),
		'five' => __('Waffle', 'geoffgraham')
	);

	// Multicheck Defaults
	$multicheck_defaults = array(
		'one' => '1',
		'five' => '1'
	);

	// Background Defaults
	$background_defaults = array(
		'color' => '',
		'image' => '',
		'repeat' => 'repeat',
		'position' => 'top center',
		'attachment'=>'scroll' );

	// Typography Defaults
	$typography_defaults = array(
		'size' => '15px',
		'face' => 'georgia',
		'style' => 'bold',
		'color' => '#bada55' );
		
	// Typography Options
	$typography_options = array(
		'sizes' => array( '6','12','14','16','20' ),
		'faces' => array( 'Helvetica Neue' => 'Helvetica Neue','Arial' => 'Arial' ),
		'styles' => array( 'normal' => 'Normal','bold' => 'Bold' ),
		'color' => false
	);

	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}
	
	// Pull all tags into an array
	$options_tags = array();
	$options_tags_obj = get_tags();
	foreach ( $options_tags_obj as $tag ) {
		$options_tags[$tag->term_id] = $tag->name;
	}


	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}

	$options = array();

	$options[] = array(
		'name' => __('Header Meta', 'geoffgraham'),
		'type' => 'heading');

// Standard Meta
	$options[] = array(
		'name' => __('Google Analytics', 'geoffgraham'),
		'desc' => __("Google Analytics ID (e.g. UA-XXXXXXXX-1)", 'geoffgraham'),
		'id' => 'meta_google_analytics_id',
		'std' => '',
		'type' => 'text');
  $options[] = array(
		'name' => __('', 'geoffgraham'),
		'desc' => __("Property Name", 'geoffgraham'),
		'id' => 'meta_google_analytics_property',
		'std' => '',
		'type' => 'text');
  $options[] = array(
		'name' => __('Google+ Profile URL', 'geoffgraham'),
		'desc' => __("Adds support for <a href='https://plus.google.com/authorship'>Google Authorship</a>", 'geoffgraham'),
		'id' => 'meta_google_plus',
		'std' => '',
		'type' => 'text');
	$options[] = array(
		'name' => __('Author Name', 'geoffgraham'),
		'desc' => __('Populates meta author tag.', 'geoffgraham'),
		'id' => 'meta_author',
		'std' => '',
		'type' => 'text');
	$options[] = array(
		'name' => __('Mobile Viewport', 'geoffgraham'),
		'desc' => __('Uncomment to use; use thoughtfully!', 'geoffgraham'),
		'id' => 'meta_viewport',
		'std' => 'width=device-width, initial-scale=1.0',
		'type' => 'text');

// Typekit
  $options[] = array(
		'name' => __('Typekit Kit ID', 'geoffgraham'),
		'desc' => __('Just the ID for the Kit', 'geoffgraham'),
		'id' => 'meta_typekit_id',
		'std' => '',
		'type' => 'text');

// Option Types
//	$options[] = array(
//		'name' => __('', 'geoffgraham'),
//		'desc' => __('.', 'geoffgraham'),
//		'id' => '',
//		'std' => '',
//		'type' => 'text');

//		'class' => 'mini',
//
//$options[] = array(
//	'name' => __('', 'geoffgraham'),
//	'desc' => __('.', 'geoffgraham'),
//	'id' => '',
//	'std' => '',
//	'type' => 'text');


//	$options[] = array(
//		'name' => __('', 'geoffgraham'),
//		'desc' => __('', 'geoffgraham'),
//		'id' => '',
//		'std' => '1',
//		'type' => 'checkbox');


//	$options[] = array(
//		'name' => __('', 'geoffgraham'),
//		'desc' => __('.', 'geoffgraham'),
//		'id' => '',
//		'std' => '',
//		'type' => 'text');

	return $options;

}