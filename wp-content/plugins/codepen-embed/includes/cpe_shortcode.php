<?php
/**
  * CodePan Shortcode
  *
  * Creates the shortcode used for CodePen Enbeds
  *
  *	@param mixed Attribures $atts
  *
  * @return $codepen_shortcode
  *
  *	@since 0.1.0
  */
function cpe_shortcode( $atts ){
	// Get attibutes and set defaults
	extract(shortcode_atts(array(
		'href' => '',
		'user' => '',
		'show' => '',
		'height' => ''
	), $atts));
	// The Code to output  
	$codepen_shortcode = '<pre class="codepen"';
	$codepen_shortcode .= 'data-height="'.$height.'"';
	$codepen_shortcode .= 'data-type="'.$show.'"';
	$codepen_shortcode .= 'data-href="'.$href.'"';
	$codepen_shortcode .= 'data-user="'.$user.'"';
	$codepen_shortcode .= 'data-safe="true">';
	$codepen_shortcode .= '<code></code>';
	$codepen_shortcode .= '<a href="http://codepen.io/'.$user.'/pen/'.$href.'">Check out this Pen!</a>';
	$codepen_shortcode .= '</pre>';
	$codepen_shortcode .= '<script async src="http://codepen.io/assets/embed/ei.js"></script>';
	return $codepen_shortcode;
} 
?>