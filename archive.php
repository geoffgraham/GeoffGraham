<?php
/**
 * The template for displaying archive pages
 *
 * @package Geoff_Graham
 */

get_header();
?>

<section class="posts">
	<?php get_template_part( 'template-parts/loop/loop', 'posts' ); ?>
</section>

<?php get_footer(); ?>