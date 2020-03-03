<?php
/**
 * Geoff Graham functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Geoff_Graham
 */

if ( ! function_exists( 'geoff_graham_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function geoff_graham_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Geoff Graham, use a find and replace
		 * to change 'geoff-graham' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'geoff-graham', get_template_directory() . '/languages' );

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

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'geoff_graham_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

	}
endif;

add_action( 'after_setup_theme', 'geoff_graham_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function geoff_graham_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'geoff_graham_content_width', 640 );
}

add_action( 'after_setup_theme', 'geoff_graham_content_width', 0 );

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

/**
 * Enqueue scripts and styles.
 */
function geoff_graham_scripts() {
	wp_enqueue_style( 'geoff-graham-stylesheet', get_template_directory_uri() . '/dist/css/style.css', array(), '1.0.0', 'all' );

	wp_enqueue_script( 'geoff-graham-scripts', get_template_directory_uri() . '/dist/js/scripts.js', array(), '1.0.0', true );

	if ( is_single() || is_archive() ) {
		wp_enqueue_script( 'geoff-graham-prism', get_template_directory_uri() . '/dist/js/prism.js', array(), '1.0.0', true );
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'geoff_graham_scripts' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

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

// Custom markup for comments
function gg_comments($comment, $args, $depth) {
	if ( 'div' === $args['style'] ) {
		$tag       = 'div';
		$add_below = 'comment-item';
	} else {
		$tag       = 'li';
		$add_below = 'commentitem';
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
					<a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>"><?php
					printf( 
						get_comment_date()
					); ?>
					</a>
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