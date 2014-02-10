<?php
/**
 * ENQUEUE SCRIPTS AND STYLES
 * Inject CSS and JS into the document
 * Reference: http://codex.wordpress.org/Function_Reference/wp_enqueue_script
 * ----------------------------------------------------------------------------
 */
 
function geoffgraham_scripts_styles() {
	global $wp_styles;

	// Load Comments	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	// Load Stylesheet
  wp_enqueue_style('global.css', get_template_directory_uri().'/lib/styles/global.css', false ,'1.0', 'all' );

	// Load Scripts
	wp_enqueue_script( 'geoffgraham-modernizr', get_template_directory_uri() . '/lib/javascripts/vendor/custom.modernizr-min.js' ); 
	wp_enqueue_script( 'geoffgraham-global', get_template_directory_uri() . '/lib/javascripts/global-min.js', array(), '1.0.0', false );
  wp_enqueue_script( 'fitvids', get_template_directory_uri() . '/lib/javascripts/vendor/jquery.fitvids.js', array(), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'geoffgraham_scripts_styles' );

// Load jQuery
if ( !function_exists( 'core_mods' ) ) {
	function core_mods() {
		if ( !is_admin() ) {
			wp_deregister_script( 'jquery' );
			wp_register_script( 'jquery', ( "//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" ), array(), '1.9.1', false);
			wp_enqueue_script( 'jquery' );
		}
	}
	add_action( 'wp_enqueue_scripts', 'core_mods' );
}