<?php
/**
 * The template for displaying all pages
 *
 * @package Geoff_Graham
 */

get_header();
?>

	<?php while ( have_posts() ) : the_post();
		get_template_part( 'template-parts/content/content', 'page' );
	endwhile; ?>

<?php get_footer(); ?>