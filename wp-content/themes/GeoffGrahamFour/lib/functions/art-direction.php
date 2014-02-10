<?php
/**
 * ART DIRECTION
 * Injects custom CSS, JS and other head scripts into individual posts and pages
 * -----------------------------------------------------------------------------
 */

// Custom CSS
add_action('admin_menu', 'custom_css_hooks');
add_action('save_post', 'save_custom_css');
add_action('wp_head','insert_custom_css');
function custom_css_hooks() {
	add_meta_box('custom_css', 'Custom CSS', 'custom_css_input', 'post', 'normal', 'high');
	add_meta_box('custom_css', 'Custom CSS', 'custom_css_input', 'page', 'normal', 'high');
}

function custom_css_input() {
	global $post;
	echo '<input type="hidden" name="custom_css_noncename" id="custom_css_noncename" value="'.wp_create_nonce('custom-css').'" />';
	echo '<textarea name="custom_css" id="custom_css" rows="5" cols="30" style="width:100%;">'.get_post_meta($post->ID,'_custom_css',true).'</textarea>';
}

function save_custom_css($post_id) {
	if (!wp_verify_nonce($_POST['custom_css_noncename'], 'custom-css')) return $post_id;
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return $post_id;
	$custom_css = $_POST['custom_css'];
	update_post_meta($post_id, '_custom_css', $custom_css);
}

function insert_custom_css() {
	if (is_page() || is_single()) {
		if (have_posts()) : while (have_posts()) : the_post();
			echo '<style type="text/css">'.get_post_meta(get_the_ID(), '_custom_css', true).'</style>';
		endwhile; endif;
		rewind_posts();
	}
}

// Custom Head Injections
add_action('admin_menu', 'custom_head_hooks');
add_action('save_post', 'save_custom_head');
add_action('wp_footer','insert_custom_head');
function custom_head_hooks() {
	add_meta_box('custom_head', 'Custom Head Scripts', 'custom_head_input', 'post', 'normal', 'high');
	add_meta_box('custom_head', 'Custom Head Scripts', 'custom_head_input', 'page', 'normal', 'high');
}

function custom_head_input() {
	global $post;
	echo '<input type="hidden" name="custom_head_noncename" id="custom_head_noncename" value="'.wp_create_nonce('custom-head').'" />';
	echo '<textarea name="custom_head" id="custom_head" rows="5" cols="30" style="width:100%;">'.get_post_meta($post->ID,'_custom_head',true).'</textarea>';
}

function save_custom_head($post_id) {
	if (!wp_verify_nonce($_POST['custom_head_noncename'], 'custom-head')) return $post_id;
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return $post_id;
	$custom_head = $_POST['custom_head'];
	update_post_meta($post_id, '_custom_head', $custom_head);
}

function insert_custom_head() {
	if (is_page() || is_single()) {
		if (have_posts()) : while (have_posts()) : the_post();
			echo get_post_meta(get_the_ID(), '_custom_head', true);
		endwhile; endif;
		rewind_posts();
	}
}

// Custom JS
add_action('admin_menu', 'custom_js_hooks');
add_action('save_post', 'save_custom_js');
add_action('wp_footer','insert_custom_js');
function custom_js_hooks() {
	add_meta_box('custom_js', 'Custom JS', 'custom_js_input', 'post', 'normal', 'high');
	add_meta_box('custom_js', 'Custom JS', 'custom_js_input', 'page', 'normal', 'high');
}

function custom_js_input() {
	global $post;
	echo '<input type="hidden" name="custom_js_noncename" id="custom_js_noncename" value="'.wp_create_nonce('custom-js').'" />';
	echo '<textarea name="custom_js" id="custom_js" rows="5" cols="30" style="width:100%;">'.get_post_meta($post->ID,'_custom_js',true).'</textarea>';
}

function save_custom_js($post_id) {
	if (!wp_verify_nonce($_POST['custom_js_noncename'], 'custom-js')) return $post_id;
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return $post_id;
	$custom_js = $_POST['custom_js'];
	update_post_meta($post_id, '_custom_js', $custom_js);
}

function insert_custom_js() {
	if (is_page() || is_single()) {
		if (have_posts()) : while (have_posts()) : the_post();
			echo '<script type="text/javascript">'.get_post_meta(get_the_ID(), '_custom_js', true).'</script>';
		endwhile; endif;
		rewind_posts();
	}
}