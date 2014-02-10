<?php
/**
 * POST EXCERPTS
 * Sets length and style attributes for post excerpts
 * ----------------------------------------------------------------------------
 */

// Length: 25 words
function geoffgraham_excerpt_length( $length ) {
	return 25;
}
add_filter( 'excerpt_length', 'geoffgraham_excerpt_length' );

// Returns a "Continue Reading" link for excerpts
function geoffgraham_continue_reading_link() {
	return ' <p><a role="button" class="button-primary" href="'. get_permalink() . '">' . __( 'Continue', 'geoffgraham' ) . '</a></p>';
}

// Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and geoffgraham_continue_reading_link().
function geoffgraham_auto_excerpt_more( $more ) {
	return ' &hellip;' . geoffgraham_continue_reading_link();
}
add_filter( 'excerpt_more', 'geoffgraham_auto_excerpt_more' );

// Adds a pretty "Continue Reading" link to custom post excerpts.
function geoffgraham_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= geoffgraham_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'geoffgraham_custom_excerpt_more' );

add_filter( 'excerpt_length', 'geoffgraham_excerpt_length' );

// Length: 40 words
function wpe_excerptlength_searchteaser($length) {
    return 40;
}

// Length: 85 words
function wpe_excerptlength_events($length) {
    return 85;
}

// Register the "More" function for custom length excerpts
function wpe_excerptmore($more) {
    return '';
}

function wpe_excerpt($length_callback='', $more_callback='') {
  global $post;
  if(function_exists($length_callback)){
      add_filter('excerpt_length', $length_callback);
  }
  if(function_exists($more_callback)){
      add_filter('excerpt_more', $more_callback);
  }
  $output = get_the_excerpt();
  $output = apply_filters('wptexturize', $output);
  $output = apply_filters('convert_chars', $output);
  $output = '<p>'.$output.'</p>';
  echo $output;
}