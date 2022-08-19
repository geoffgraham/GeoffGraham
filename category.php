<?php
/**
 * The template for displaying category archive pages
 *
 * @package Geoff_Graham
 */

	get_header();
?>

<main id="content" class="main-content">
	<?php get_template_part( 'template-parts/loop/loop', 'posts' ); ?>
</main>

<?php get_footer(); ?>