<?php
/**
 * The template for displaying all pages
 *
 * @package Geoff_Graham
 */

get_header();
?>

<main id="content" class="main-content">
	<?php while ( have_posts() ) : the_post();
		get_template_part( 'template-parts/content/content', 'page' );
	endwhile; ?>
</main>

<?php get_footer(); ?>