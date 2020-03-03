<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Geoff_Graham
 */

get_header();
?>

	<div class="post-wrapper">
		<main class="main-content posts">

		<?php // If "TIL" category, let's show a title.
		if ( is_category( 'TIL' ) ) :
		?>

		<h1>Today I Learned...</h1>

		<?php
		endif;
		
		// All categories, except TIL
		if ( have_posts() && ! is_category( 'TIL' ) ) :

			while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/loop/loop', 'posts' );

			endwhile;
		
		// Only TIL
		else :

			while ( have_posts() ) : the_post(); ?>

			<?php		
			get_template_part( 'template-parts/loop/category', 'til' );

			endwhile;

		endif;
		?>

		</main>
	</div>

	<?php
		get_footer();
	?>