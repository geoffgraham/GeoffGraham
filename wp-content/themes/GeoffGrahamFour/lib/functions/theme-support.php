<?php
/**
 * THEME SUPPORT
 * Adds supported functionality to the theme
 * Reference: http://codex.wordpress.org/Function_Reference/add_theme_support
 * Language, menus, post thumbnails, rss, post formats
 * ----------------------------------------------------------------------------
 */
 
function geoffgraham_theme_support() {
  // Add language support
  load_theme_textdomain('geoffgraham', get_template_directory() . '/languages');

  // Add menu support
  add_theme_support('menus');

  // Add post thumbnail support: http://codex.wordpress.org/Post_Thumbnails
  add_theme_support('post-thumbnails');
  // set_post_thumbnail_size(150, 150, false);

  // rss feed links
  add_theme_support('automatic-feed-links');

  // Add post formarts support: http://codex.wordpress.org/Post_Formats
  add_theme_support('post-formats', array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat'));
  
  // Register primary navigation
  register_nav_menu( 'primary', __( 'Navigation Menu', 'geoffgraham' ) );

}

add_action('after_setup_theme', 'geoffgraham_theme_support'); 

?>