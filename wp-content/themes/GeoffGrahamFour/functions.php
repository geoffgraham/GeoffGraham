<?php
/**
 * @package WordPress
 * @subpackage GeoffGrahamFour
 * @since GeoffGrahamFour 1.0
 */

################################################################################
// THEME FUNCTIONS
################################################################################
  
  // Cleanup functions
  require_once('lib/functions/cleanup.php');
  
  // Theme support
  require_once('lib/functions/theme-support.php');
  
  // Enqueue javascripts
  require_once('lib/functions/enqueue-scripts.php');
  
  // Custom post types
  require_once('lib/functions/custom-post-types.php');
  
  // Art direction
  require_once('lib/functions/art-direction.php');
  
  // Tiny MCE styles
  require_once('lib/functions/tiny-mce-styles.php');
  
  // Thumbnail images
  require_once('lib/functions/thumbnails.php');
  
  // Post excerpts
  require_once('lib/functions/post-excerpts.php');
  
  // Widget areas
  require_once('lib/functions/widget-areas.php');
  

################################################################################
// BOILERPLATE STUFF
################################################################################

// Options Framework (https://github.com/devinsays/options-framework-plugin)
/*----------------------------------------------------------------------------*/

if ( !function_exists( 'optionsframework_init' ) ) {
	define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/_/inc/' );
	require_once dirname( __FILE__ ) . '/_/inc/options-framework.php';
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

?>