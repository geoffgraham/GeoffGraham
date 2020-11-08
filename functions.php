<?php
/**
 * Geoff Graham functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Geoff_Graham
 */

if ( !function_exists( 'geoff_graham_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function geoff_graham_setup() {

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'geoff-graham' ),
			'menu-2' => esc_html__( 'Social', 'geoff-graham' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

	}
endif;
add_action( 'after_setup_theme', 'geoff_graham_setup' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function geoff_graham_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'geoff-graham' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'geoff-graham' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}

add_action( 'widgets_init', 'geoff_graham_widgets_init' );

wp_localize_script( 'scripts', 'ajax_posts', array(
	'ajaxurl' => admin_url( 'admin-ajax.php' ),
	'noposts' => __('No older posts found', 'gg'),
));	

/**
 * Enqueue scripts and styles.
 */
function geoff_graham_scripts() {
	wp_enqueue_style( 'geoff-graham-stylesheet', get_template_directory_uri() . '/dist/css/style.css', array(), wp_date( DATE_RFC3339 ), 'all' );

	wp_register_script( 'scripts', get_template_directory_uri() . '/dist/js/scripts-min.js');

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'geoff_graham_scripts' );

/**
 * Allow SVG uploads in the Media Library
 */
function gg_add_file_types_to_uploads($file_types) {
	$new_filetypes = array();
	$new_filetypes['svg'] = 'image/svg+xml';
	$file_types = array_merge($file_types, $new_filetypes );
	return $file_types;
}

add_filter('upload_mimes', 'gg_add_file_types_to_uploads');

/**
	* Add page slug to body classes
	*/
function add_slug_body_class( $classes ) {
	global $post;
	if ( isset( $post ) ) {
		$classes[] = $post->post_name;
	}
		return $classes;
	}

add_filter( 'body_class', 'add_slug_body_class' );

/**
 * Exclude "Today I Learned" and "RSS Club" categories from blog loop
 */
function exclude_category_posts( $query ) {
	if ( $query->is_home() && $query->is_main_query() ) {
		$query->set( 'cat', '-52, -54' );
	}
}
add_action( 'pre_get_posts', 'exclude_category_posts' );

/**
 * Remove Jetpack's CSS File
 */
add_filter( 'jetpack_sharing_counts', '__return_false', 99 );
add_filter( 'jetpack_implode_frontend_css', '__return_false', 99 );

/**
 * Remove WordPress jQuery from front-end
 */

function change_default_jquery( &$scripts){
	if(!is_admin()){
		$scripts->remove( 'jquery');
		$scripts->add( 'jquery', false, array( 'jquery-core' ), '1.10.2' );
	}
}
add_filter( 'wp_default_scripts', 'change_default_jquery' );

// Add ACF icon field to navigation
add_filter('wp_nav_menu_objects', 'gg_wp_nav_menu_objects', 10, 2);

function gg_wp_nav_menu_objects( $items, $args ) {
	
	foreach( $items as &$item ) {
		$icon = get_field('icon', $item);
		
		if( $icon ) {		
			$item->title = '<svg class="navigation__icon" width="30" height="30"><use xlink:href="#' . $icon . '"></use></svg>' . $item->title ;
		}		
	}
	// return
	return $items;
}

// Custom markup for comments
function gg_comments($comment, $args, $depth) {
	if ( 'div' === $args['style'] ) {
		$tag       = 'div';
		$add_below = 'comment-item';
	} else {
		$tag       = 'li';
		$add_below = 'comment-item';
	}?>
	<<?php echo $tag; ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'comment--parent' ); ?> id="comment-<?php comment_ID() ?>"><?php 
	if ( 'div' != $args['style'] ) { ?>
		<div id="comment-<?php comment_ID() ?>" class="comment__wrapper">
		<?php } ?>
			<div class="comment__avatar">
			<?php 
				if ( $args['avatar_size'] != 0 ) {
					echo get_avatar( $comment, $args['avatar_size'] ); 
				}
			?>
			</div>
			<div class="comment__body">
				<div class="comment__author"> 
					<?php printf( __( '%s' ), get_comment_author_link() ); ?>
				</div><?php 
				if ( $comment->comment_approved == '0' ) { ?>
				<span class="comment__notice"><?php _e( 'Your comment is waiting for approval.' ); ?></span><?php 
			} ?>
				<div class="comment__meta">
					<a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>">#</a>
					<?php
					printf( 
						get_comment_date()
					); ?>
				</div>
				<div class="comment__text">
					<?php comment_text(); ?>
					<?php comment_reply_link( 
						array_merge( 
							$args, 
							array( 
								'add_below' => $add_below, 
								'depth'     => $depth, 
								'max_depth' => $args['max_depth'] 
							) 
						) 
					); ?>
				</div>
			</div>
			<?php 
	if ( 'div' != $args['style'] ) : ?>
		</div><?php 
	endif;
}

// Markdown support notice after comment form submit button
function filter_comment_form_submit_button( $submit_button, $args ) {
	// make filter magic happen here...
	$submit_before = '';
	$submit_after = '<small>Markdown supported</small>';
	return $submit_before . $submit_button . $submit_after;
};
add_filter( 'comment_form_submit_button', 'filter_comment_form_submit_button', 10, 2 );