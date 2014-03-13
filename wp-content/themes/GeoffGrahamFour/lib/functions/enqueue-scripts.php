<?php
/**
 * ENQUEUE SCRIPTS AND STYLES
 * Inject CSS and JS into the document
 * Reference: http://codex.wordpress.org/Function_Reference/wp_enqueue_script
 * ----------------------------------------------------------------------------
 */

function geoffgraham_scripts() {
	
	// Load stylesheet
	wp_enqueue_style('global.css', get_template_directory_uri().'/lib/styles/global.css' );
	
	// Load Modernizr
	wp_enqueue_script( 'modernizr.js', get_template_directory_uri() . '/lib/javascripts/modernizr.js', array(), '1.0.0', false );
	
	// Register and load jquery
	if ( !is_admin() ) {
			wp_deregister_script( 'jquery' );
			wp_register_script( 'jquery', ( "//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" ), array(), '1.9.1', false);
			wp_enqueue_script( 'jquery' );
  }
	
	// Load custom scripts
	wp_enqueue_script( 'global.js', get_template_directory_uri() . '/lib/javascripts/global-min.js', array(), '1.0.0', false );
}

add_action( 'wp_enqueue_scripts', 'geoffgraham_scripts' );