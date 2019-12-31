<?php
/**
 * The main template file
 *
 * @package Geoff_Graham
 */

get_header();
?>

	<main class="main-content posts">

		<?php if ( is_main_query() && have_posts() ) : ?>

			<h1>Blog Archive</h1>

			<?php while ( have_posts() ) : the_post();
				get_template_part( 'template-parts/loop/loop', 'posts' );
			endwhile;

		endif; ?>

		<footer class="posts__pagination">
			<?php next_posts_link( 'Older' ); ?>
			<?php previous_posts_link( 'Newer' ); ?>
		</footer>

	</main>

<?php
get_footer();
?>