<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Geoff_Graham
 */

get_header();
?>

	<main class="main-content">

	<?php if ( have_posts() ) :
		while ( have_posts() ) : the_post(); ?>

		<article class="post-single">
			<?php the_title( '<h1 class="post-single__title">', '</h1>' ); ?>
			<div class="post-single__date">
				<?php 
				$j_date = get_the_date('j');
				$j_modified_date = get_the_modified_time('j');
				if ($j_modified_date >= $j_date + 1) { 
					echo the_date('F j, Y');
					echo "<span>Updated: "; the_modified_time('F j, Y');
					echo "</span>";
				} else {
					echo the_date('F jS, Y');
				} ?>
			</div>
			<div class="post-single__body">
			<?php if ( in_category( 'RSS Club', $post_id ) ) : ?>
				<span class="rss-note">👋 Hey! This post is exclusive for RSS subscribers.</span>
			<?php endif; ?>
				<?php echo the_content(); ?>
			</div>
		</article>

		<?php 
			endwhile;
		endif; ?>
	</main>

	<?php if ( comments_open() || get_comments_number() ) {
		comments_template();
	}
	?>


<?php get_footer();