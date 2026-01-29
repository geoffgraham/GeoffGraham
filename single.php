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
  <?php if ( have_posts() ) :
    while ( have_posts() ) : the_post(); ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class( 'post-single' ); ?>>
      <header class="post-header">
      
        <?php the_title( '<h1 class="post-title" style=
  "view-transition-name: post-' . get_the_id() . '">', '</h1>' ); ?>
        <?php if ( in_category( 'RSS Club' ) ) : ?>
        <span class="rss-note">👋 Hey! This post is exclusive for RSS subscribers.</span>
      <?php endif; ?>

      <div class="post-date">
          <?php if ( in_category( 'TIL' ) ) {
            echo "What I learned on ";
          } ?>
          <?php echo the_date( 'F j, Y' ); ?>
          
          <?php
            $j_date = get_the_date( 'j' );
            $j_modified_date = get_the_modified_time( 'j' );
      
            if ( ($j_modified_date >= $j_date + 1) && !in_category( 'TIL' ) ) { 
              echo '<span>Updated: ' . get_the_modified_time( 'n/d/Y' ) . '</span>';
            }
          ?>
        </div>
      </header>
      <div class="post-body">
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

<?php get_footer();