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
	<main id="content" class="main-content">

		<?php if ( have_posts() ) :
			while ( have_posts() ) : the_post(); ?>
			<article class="post-single">
				<div class="post-single__date">
					<?php if ( in_category( 'TIL' ) ) {
						echo "On ";
					} ?>
					<?php 
						echo the_date( 'F j, Y' );
					
					if ( in_category( 'TIL' ) ) {
						echo ", I learned...";
					}?>
					
					<?php
						$j_date = get_the_date( 'j' );
						$j_modified_date = get_the_modified_time( 'j' );
				
						if ( ($j_modified_date >= $j_date + 1) && !in_category( 'TIL' ) ) { 
							echo '<span>Updated: ' . get_the_modified_time( 'n/d/Y' ) . '</span>';
						}
					?>
				</div>
				
				<?php the_title( '<h1 class="post-single__title" style=
    "view-transition-name: post-' . get_the_id() . '">', '</h1>' ); ?>
			
				<div class="post-single__body">
          <?php if ( in_category( 'RSS Club' ) ) : ?>
            <span class="rss-note">👋 Hey! This post is exclusive for RSS subscribers.</span>
          <?php endif; ?>
            <?php echo the_content(); ?>
				</div>
			</article>

		<?php 
			endwhile;
			endif; 
    ?>

		<?php if ( comments_open() || get_comments_number() ) { ?>
			<?php comments_template(); ?>
		<?php } ?>
	</main>


<?php get_footer();