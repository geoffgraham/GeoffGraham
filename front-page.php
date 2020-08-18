<?php
/**
 * Front page content
 *
 * @package Geoff_Graham
 */

	get_header(); ?>

<main id="content" class="main-content">

<?php if ( is_front_page() && ! is_404() ) {
	get_template_part( 'template-parts/content/content', 'home' );
} ?>