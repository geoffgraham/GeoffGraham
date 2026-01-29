<?php
/**
 * The template for displaying archive pages
 *
 * @package Geoff_Graham
 */

get_header();
?>

	<section id="posts" class="posts-wrapper">
		<?php get_template_part( 'template-parts/loop/loop', 'posts' ); ?>
	</section>
</main>

<?php get_footer(); ?>