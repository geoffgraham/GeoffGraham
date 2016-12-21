<?php
/*
Plugin Name: My Awesome Podcast
Description: A really simple RSS feed and custom post type for a podcast
Version: 1.0
*/

// First, let's register the custom RSS feed for the podcast
// First variable of add_feed is the slug: your-site.com/feed/my-podcast
add_action('init', 'podcast_rss');
function podcast_rss(){
  add_feed('my-awesome-podcast', 'my_podcast_rss');
}

// Now, let's register our Podcast Custom Post Type
function custom_post_type() {

  $labels = array(
    'name'                => _x( 'Podcasts', 'Podcast General Name', 'text_domain' ),
    'singular_name'       => _x( 'Podcast', 'Course Singular Name', 'text_domain' ),
    'menu_name'           => __( 'Podcasts', 'text_domain' ),
    'parent_item_colon'   => __( 'Parent Podcast:', 'text_domain' ),
    'all_items'           => __( 'All Podcasts', 'text_domain' ),
    'view_item'           => __( 'View Podcast', 'text_domain' ),
    'add_new_item'        => __( 'Add New Podcast', 'text_domain' ),
    'add_new'             => __( 'Add New', 'text_domain' ),
    'edit_item'           => __( 'Edit Podcast', 'text_domain' ),
    'update_item'         => __( 'Update Podcast', 'text_domain' ),
    'search_items'        => __( 'Search Podcasts', 'text_domain' ),
    'not_found'           => __( 'Not found', 'text_domain' ),
    'not_found_in_trash'  => __( 'Not found in Trash', 'text_domain' ),
  );
  $args = array(
    'label'               => __( 'podcasts', 'text_domain' ),
    'description'         => __( 'Podcast Description', 'text_domain' ),
    'labels'              => $labels,
    'supports'            => array( 'title', 'editor', 'thumbnail' ),
    'taxonomies'          => array( 'category', 'post_tag' ),
    'hierarchical'        => false,
    'public'              => true,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'show_in_nav_menus'   => true,
    'show_in_admin_bar'   => true,
    'menu_position'       => 5,
    'menu_icon'           => 'dashicons-format-audio',
    'can_export'          => true,
    'has_archive'         => true,
    'exclude_from_search' => false,
    'publicly_queryable'  => true,
    'capability_type'     => 'page'
  );
  register_post_type( 'podcasts', $args );
}

add_action( 'init', 'custom_post_type', 0 );

// Finally, let's call the template of our custom RSS feed
function my_podcast_rss(){
  require_once( dirname( __FILE__ ) . '/podcast-rss-template.php' );
}

?>