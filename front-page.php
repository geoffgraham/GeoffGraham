<?php
/**
 * Front page content
 *
 * @package Geoff_Graham
 */

	get_header(); ?>

<main class="main-content">

	<?php 
		get_template_part( 'template-parts/loop/loop', 'posts' ); 
		get_footer();
	?>