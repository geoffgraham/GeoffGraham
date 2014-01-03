<?php
/**
 * @package WordPress
 * @subpackage GeoffGrahamFour
 * @since GeoffGrahamFour 1.0
 */
 
  require_once('lib/functions/custom-post-types.php');
  
################################################################################
// BOILERPLATE STUFF
################################################################################


// Options Framework (https://github.com/devinsays/options-framework-plugin)
/*----------------------------------------------------------------------------*/

if ( !function_exists( 'optionsframework_init' ) ) {
	define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/_/inc/' );
	require_once dirname( __FILE__ ) . '/_/inc/options-framework.php';
}


// Theme Setup (based on twentythirteen: http://make.wordpress.org/core/tag/twentythirteen/)
/*----------------------------------------------------------------------------*/

function geoffgraham_setup() {
	load_theme_textdomain( 'geoffgraham', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );	
	add_theme_support( 'structured-post-formats', array( 'link', 'video' ) );
	add_theme_support( 'post-formats', array( 'aside', 'audio', 'chat', 'gallery', 'image', 'quote', 'status' ) );
	register_nav_menu( 'primary', __( 'Navigation Menu', 'geoffgraham' ) );
	add_theme_support( 'post-thumbnails' );
}
add_action( 'after_setup_theme', 'geoffgraham_setup' );


// Scripts & Styles (based on twentythirteen: http://make.wordpress.org/core/tag/twentythirteen/)
/*----------------------------------------------------------------------------*/

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


// WP Title (based on twentythirteen: http://make.wordpress.org/core/tag/twentythirteen/)
/*----------------------------------------------------------------------------*/

function geoffgraham_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

// Add the site name.
		$title .= get_bloginfo( 'name' );
	
// Add the site description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) )
			$title = "$title $sep $site_description";
	
// Add a page number if necessary.
		if ( $paged >= 2 || $page >= 2 )
			$title = "$title $sep " . sprintf( __( 'Page %s', 'geoffgraham' ), max( $paged, $page ) );
			
		return $title;
	}
	add_filter( 'wp_title', 'geoffgraham_wp_title', 10, 2 );


// Old Stuff
/*----------------------------------------------------------------------------*/

	// Custom Menu
	register_nav_menu( 'primary', __( 'Navigation Menu', 'geoffgraham' ) );

	// Navigation - update coming from twentythirteen
	
	// Add role and class to next_ and previous_ posts links
	add_filter('next_posts_link_attributes', 'posts_link_attributes');
  add_filter('previous_posts_link_attributes', 'posts_link_attributes');

  function posts_link_attributes() {
    return '';
  }
	
	function post_navigation() {
		echo '<div class="navigation">';
		echo '	<div class="next-posts">'.get_next_posts_link('&laquo; Older Entries').'</div>';
		echo '	<div class="prev-posts">'.get_previous_posts_link('Newer Entries &raquo;').'</div>';
		echo '</div>';
	}

	// Posted On
	function posted_on() {
		printf( __( '<span class="sep">Posted </span><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a> by <span class="byline author vcard">%5$s</span>', '' ),
			esc_url( get_permalink() ),
			esc_attr( get_the_time() ),
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_author() )
		);
	}
	
################################################################################
// MY FUNCTIONS
################################################################################

// Prevent WordPress Thumbnail Images
/*----------------------------------------------------------------------------*/

add_filter('intermediate_image_sizes_advanced','stop_thumbs');
function stop_thumbs($sizes){
      return array();
}

// Post Excerpts
/*----------------------------------------------------------------------------*/

// Length: 25 words
function awesome_excerpt_length( $length ) {
	return 25;
}
add_filter( 'excerpt_length', 'awesome_excerpt_length' );

// Returns a "Continue Reading" link for excerpts
function awesome_continue_reading_link() {
	return ' <p><a role="button" class="button-primary" href="'. get_permalink() . '">' . __( 'Continue', 'awesome' ) . '</a></p>';
}

// Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and awesome_continue_reading_link().
function awesome_auto_excerpt_more( $more ) {
	return ' &hellip;' . awesome_continue_reading_link();
}
add_filter( 'excerpt_more', 'awesome_auto_excerpt_more' );

// Adds a pretty "Continue Reading" link to custom post excerpts.
function awesome_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= awesome_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'awesome_custom_excerpt_more' );

add_filter( 'excerpt_length', 'awesome_excerpt_length' );

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

// Register Sidebars
/*----------------------------------------------------------------------------*/

function awesome_widgets_init() {

	register_sidebar( array(
		'name' => 'Blog Right Sidebar',
		'id' => 'blog-right',
		'before_widget' => '<aside>',
		'after_widget' => '</aside>',
		'before_title' => '<h2">',
		'after_title' => '</h2>',
	) );
}
add_action( 'widgets_init', 'awesome_widgets_init' );


// Register TinyMCE Styles in Editor
/*----------------------------------------------------------------------------*/

add_filter( 'tiny_mce_before_init', 'my_custom_tinymce' );

function my_custom_tinymce( $init ) {
	$init['theme_advanced_buttons2_add_before'] = 'styleselect';
	$init['theme_advanced_styles'] = 'Subhead=subhead,Shadow=shadow';
	return $init;
}

// Art Direction
/*----------------------------------------------------------------------------*/

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
			echo '<script>'.get_post_meta(get_the_ID(), '_custom_js', true).'</script>';
		endwhile; endif;
		rewind_posts();
	}
}

?>