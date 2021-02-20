<?php
/**
 * The main template file
 *
 * @package Geoff_Graham
 */

get_header();
?>
	<main class="main-content posts">

		<?php get_template_part( 'template-parts/loop/loop', 'posts' ); ?>

		<footer class="posts__pagination">
			<?php next_posts_link( 'Older' ); ?>
			<?php previous_posts_link( 'Newer' ); ?>
		</footer>

	</main>
	
	<?php
	get_footer();
	?>