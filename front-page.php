<?php
/**
 * Front page content
 *
 * @package Geoff_Graham
 */

	get_header(); ?>

<main id="content">

<?php if ( is_front_page() && ! is_404() ) {
	echo the_content();
} ?>

<?php get_footer(); ?>