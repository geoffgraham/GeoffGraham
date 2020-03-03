<?php
/**
 * The template for displaying all pages
 *
 * @package Geoff_Graham
 */

get_header();
?>
<div class="post-wrapper">
	<main class="main-content">
		<?php while ( have_posts() ) : the_post();
			get_template_part( 'template-parts/content/content', 'page' );
		endwhile; ?>
	</main>
</div>

<?php get_footer(); ?>