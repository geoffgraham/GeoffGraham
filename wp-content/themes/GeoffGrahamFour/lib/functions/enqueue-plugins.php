<?php
/**
 * ENQUEUE PLUGINS
 * Load plugin scripts and sctyles only when we need them
 * Source: http://designloud.com/conditionally-load-plugins-in-wordpress/
 * ----------------------------------------------------------------------------
 */

//conditional plugins - deactivate

function geoffgraham_dequeue_styles() {
  
  // Contact Form 7 Styles
	wp_dequeue_style( 'contact-form-7' );
	wp_dequeue_style( 'contact-form-7-rtl' );
	
	// Prettify Styles
	wp_dequeue_style( 'prettify' );
	
	// Disqus Styles
	wp_dequeue_style( 'wp-pointer' );
	
}
	 
function geoffgraham_dequeue_javascript() {
  
  // Contact Form 7 Scripts
	wp_dequeue_script( 'contact-form-7' );
	wp_dequeue_script( 'jquery-form' );
	
	// Prettify Scripts
	wp_dequeue_script( 'prettify' );
	wp_dequeue_script( 'prettify-load' );
	wp_dequeue_script( 'prettify-css' );
	
	// Disqus Scripts
	wp_dequeue_script( 'wp-pointer' );
	
}

add_action( 'wp_print_styles', 'geoffgraham_dequeue_styles', 100 );
add_action( 'wp_print_scripts', 'geoffgraham_dequeue_javascript', 100 );

// now conditionally load the styles needed...
function geoffgraham_enqueue_styles() {
	
	// ...in contact.php or home
	if ( is_page_template('contact.php') || is_home() ) {
		wp_enqueue_style( 'contact-form-7' );
		wp_enqueue_style( 'contact-form-7-rtl' );
	}
	
	// ...in single.php
	if (is_single()) {
		wp_enqueue_style( 'prettify' );
		wp_enqueue_style( 'wp-pointer' );
	}
	
}

// now conditionally load the scripts needed...
function geoffgraham_enqueue_javascript() {
	
	// ...in contact.php
	if (is_page_template('contact.php')) {
		wp_enqueue_script( 'contact-form-7' );
    wp_enqueue_script( 'jquery-form' );
	}
	
	// ...in single.php
	if (is_single()) {
		wp_enqueue_script( 'prettify' );
		wp_enqueue_script( 'prettify-load' );
		wp_enqueue_script( 'prettify-css' );
		wp_enqueue_script( 'wp-pointer' );
	}
	
}

add_action( 'wp_print_styles', 'geoffgraham_enqueue_styles', 100 );
add_action( 'wp_print_scripts', 'geoffgraham_enqueue_javascript', 100 );