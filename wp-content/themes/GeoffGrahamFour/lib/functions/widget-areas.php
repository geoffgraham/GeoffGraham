<?php
/**
 * WIDGET AREAS
 * Creates spaces for theme widgets (Appearance > Widgets)
 * ----------------------------------------------------------------------------
 */

// Sidebar Widgets
$sidebars = array('Sidebar');
foreach ($sidebars as $sidebar) {
  register_sidebar( array(
		'name' => 'Blog Right Sidebar',
		'id' => 'blog-right',
		'before_widget' => '<aside>',
		'after_widget' => '</aside>',
		'before_title' => '<h2">',
		'after_title' => '</h2>',
	));
}