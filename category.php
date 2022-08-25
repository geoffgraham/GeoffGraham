<?php
/**
 * The template for displaying category archive pages
 *
 * @package Geoff_Graham
 */

	get_header();
?>

<div class="site-wrapper">
	<main id="content" class="main-content">
		<?php get_template_part( 'template-parts/loop/loop', 'posts' ); ?>
	</main>
</div>

<?php get_footer(); ?>