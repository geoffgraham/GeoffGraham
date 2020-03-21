<?php
/**
 * The template for displaying all pages
 *
 * @package Geoff_Graham
 */

get_header();
?>
<main class="main-content">
	<div class="post-wrapper">
	<?php while ( have_posts() ) : the_post();
		get_template_part( 'template-parts/content/content', 'page' );
	endwhile; ?>
	</div>
</main>

<?php get_footer(); ?>