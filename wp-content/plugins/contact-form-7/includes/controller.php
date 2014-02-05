<?php

add_action( 'init', 'wpcf7_control_init', 11 );

function wpcf7_control_init() {
	wpcf7_ajax_onload();
	wpcf7_ajax_json_echo();
	wpcf7_submit_nonajax();
}

function wpcf7_ajax_onload() {
	if ( 'GET' != $_SERVER['REQUEST_METHOD']
	|| ! isset( $_GET['_wpcf7_is_ajax_call'] ) ) {
		return;
	}

	$echo = '';
	$items = array();

	if ( isset( $_GET['_wpcf7'] ) ) {
		if ( $contact_form = wpcf7_contact_form( (int) $_GET['_wpcf7'] ) ) {
			WPCF7_ContactForm::set_current( $contact_form );
			$items = apply_filters( 'wpcf7_ajax_onload', $items );
			WPCF7_ContactForm::reset_current();
		}
	}

	$echo = json_encode( $items );

	if ( wpcf7_is_xhr() ) {
		@header( 'Content-Type: application/json; charset=' . get_option( 'blog_charset' ) );
		echo $echo;
	}

	exit();
}

function wpcf7_ajax_json_echo() {
	if ( 'POST' != $_SERVER['REQUEST_METHOD'] || ! isset( $_POST['_wpcf7_is_ajax_call'] ) )
		return;

	$echo = '';

	if ( isset( $_POST['_wpcf7'] ) ) {
		$id = (int) $_POST['_wpcf7'];
		$unit_tag = wpcf7_sanitize_unit_tag( $_POST['_wpcf7_unit_tag'] );

		if ( $contact_form = wpcf7_contact_form( $id ) ) {
			WPCF7_ContactForm::set_current( $contact_form );

			$items = array(
				'mailSent' => false,
				'into' => '#' . $unit_tag,
				'captcha' => null );

			$result = $contact_form->submit( true );

			if ( ! empty( $result['message'] ) )
				$items['message'] = $result['message'];

			if ( $result['mail_sent'] )
				$items['mailSent'] = true;

			if ( ! $result['valid'] ) {
				$invalids = array();

				foreach ( $result['invalid_reasons'] as $name => $reason ) {
					$invalids[] = array(
						'into' => 'span.wpcf7-form-control-wrap.' . $name,
						'message' => $reason );
				}

				$items['invalids'] = $invalids;
			}

			if ( $result['spam'] )
				$items['spam'] = true;

			if ( ! empty( $result['scripts_on_sent_ok'] ) )
				$items['onSentOk'] = $result['scripts_on_sent_ok'];

			if ( ! empty( $result['scripts_on_submit'] ) )
				$items['onSubmit'] = $result['scripts_on_submit'];

			$items = apply_filters( 'wpcf7_ajax_json_echo', $items, $result );

			WPCF7_ContactForm::reset_current();
		}
	}

	$echo = json_encode( $items );

	if ( wpcf7_is_xhr() ) {
		@header( 'Content-Type: application/json; charset=' . get_option( 'blog_charset' ) );
		echo $echo;
	} else {
		@header( 'Content-Type: text/html; charset=' . get_option( 'blog_charset' ) );
		echo '<textarea>' . $echo . '</textarea>';
	}

	exit();
}

function wpcf7_is_xhr() {
	if ( ! isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) )
		return false;

	return $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';
}

function wpcf7_submit_nonajax() {
	if ( ! isset( $_POST['_wpcf7'] ) )
		return;

	if ( $contact_form = wpcf7_contact_form( (int) $_POST['_wpcf7'] ) ) {
		WPCF7_ContactForm::set_current( $contact_form );

		$contact_form->submit();

		WPCF7_ContactForm::reset_current();
	}
}

add_filter( 'widget_text', 'wpcf7_widget_text_filter', 9 );

function wpcf7_widget_text_filter( $content ) {
	if ( ! preg_match( '/\[[\r\n\t ]*contact-form(-7)?[\r\n\t ].*?\]/', $content ) )
		return $content;

	$content = do_shortcode( $content );

	return $content;
}

/* Shortcodes */

add_action( 'plugins_loaded', 'wpcf7_add_shortcodes' );

function wpcf7_add_shortcodes() {
	add_shortcode( 'contact-form-7', 'wpcf7_contact_form_tag_func' );
	add_shortcode( 'contact-form', 'wpcf7_contact_form_tag_func' );
}

function wpcf7_contact_form_tag_func( $atts, $content = null, $code = '' ) {
	if ( is_feed() )
		return '[contact-form-7]';

	if ( 'contact-form-7' == $code ) {
		$atts = shortcode_atts( array(
			'id' => 0,
			'title' => '',
			'html_id' => '',
			'html_class' => '' ), $atts );

		$id = (int) $atts['id'];
		$title = trim( $atts['title'] );

		if ( ! $contact_form = wpcf7_contact_form( $id ) )
			$contact_form = wpcf7_get_contact_form_by_title( $title );

	} else {
		if ( is_string( $atts ) )
			$atts = explode( ' ', $atts, 2 );

		$id = (int) array_shift( $atts );
		$contact_form = wpcf7_get_contact_form_by_old_id( $id );
	}

	if ( ! $contact_form )
		return '[contact-form-7 404 "Not Found"]';

	WPCF7_ContactForm::set_current( $contact_form );

	$html = $contact_form->form_html( $atts );

	WPCF7_ContactForm::reset_current();

	return $html;
}

if ( WPCF7_LOAD_JS )
	add_action( 'wp_enqueue_scripts', 'wpcf7_enqueue_scripts' );

function wpcf7_enqueue_scripts() {
	// jquery.form.js originally bundled with WordPress is out of date and deprecated
	// so we need to deregister it and re-register the latest one
	wp_deregister_script( 'jquery-form' );
	wp_register_script( 'jquery-form',
		wpcf7_plugin_url( 'includes/js/jquery.form.min.js' ),
		array( 'jquery' ), '3.48.0-2013.12.28', true );

	$in_footer = true;
	if ( 'header' === WPCF7_LOAD_JS )
		$in_footer = false;

	wp_enqueue_script( 'contact-form-7',
		wpcf7_plugin_url( 'includes/js/scripts.js' ),
		array( 'jquery', 'jquery-form' ), WPCF7_VERSION, $in_footer );

	$_wpcf7 = array(
		'loaderUrl' => wpcf7_ajax_loader(),
		'sending' => __( 'Sending ...', 'contact-form-7' ) );

	if ( defined( 'WP_CACHE' ) && WP_CACHE )
		$_wpcf7['cached'] = 1;

	if ( wpcf7_support_html5_fallback() )
		$_wpcf7['jqueryUi'] = 1;

	wp_localize_script( 'contact-form-7', '_wpcf7', $_wpcf7 );

	do_action( 'wpcf7_enqueue_scripts' );
}

function wpcf7_script_is() {
	return wp_script_is( 'contact-form-7' );
}

if ( WPCF7_LOAD_CSS )
	add_action( 'wp_enqueue_scripts', 'wpcf7_enqueue_styles' );

function wpcf7_enqueue_styles() {
	wp_enqueue_style( 'contact-form-7',
		wpcf7_plugin_url( 'includes/css/styles.css' ),
		array(), WPCF7_VERSION, 'all' );

	if ( wpcf7_is_rtl() ) {
		wp_enqueue_style( 'contact-form-7-rtl',
			wpcf7_plugin_url( 'includes/css/styles-rtl.css' ),
			array(), WPCF7_VERSION, 'all' );
	}

	do_action( 'wpcf7_enqueue_styles' );
}

function wpcf7_style_is() {
	return wp_style_is( 'contact-form-7' );
}

/* HTML5 Fallback */

add_action( 'wp_enqueue_scripts', 'wpcf7_html5_fallback', 11 );

function wpcf7_html5_fallback() {
	if ( ! wpcf7_support_html5_fallback() )
		return;

	if ( WPCF7_LOAD_JS ) {
		wp_enqueue_script( 'jquery-ui-datepicker' );
		wp_enqueue_script( 'jquery-ui-spinner' );
	}

	if ( WPCF7_LOAD_CSS ) {
		wp_enqueue_style( 'jquery-ui-smoothness',
			wpcf7_plugin_url( 'includes/js/jquery-ui/themes/smoothness/jquery-ui.min.css' ), array(), '1.10.3', 'screen' );
	}
}

?>