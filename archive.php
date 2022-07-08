<?php
/**
 * The template for displaying archive pages
 *
 * @package Geoff_Graham
 */

get_header();
?>

<div class="site-wrapper">
	<section class="posts">
		<?php get_template_part( 'template-parts/loop/loop', 'posts' ); ?>
	</section>
</div>

<?php get_footer(); ?>