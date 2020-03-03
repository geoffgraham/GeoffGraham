<?php
/**
 * The template for displaying archive pages
 *
 * @package Geoff_Graham
 */

get_header();
?>

	<div id="primary" class="content-area">
		<div class="post-wrapper">
			<main class="main-content">

			<?php if ( have_posts() ) :

				/* Start the Loop */
				while ( have_posts() ) :
					the_post();

					the_title( '<h2><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
					echo the_content();

				endwhile;

				the_posts_navigation();

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif;
			?>

			</main><!-- #main -->
		</div>
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
