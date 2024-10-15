<?php
/**
 * The main template file
 *
 * @package Geoff_Graham
 */

get_header();
?>

<main id="content" class="main-content">
	<section id="content" class="posts-container">
		<?php get_template_part( 'template-parts/loop/loop', 'posts' ); ?>
	</section>
</main>

<?php get_footer(); ?>