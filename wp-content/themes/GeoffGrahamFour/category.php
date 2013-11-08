<?php
/**
 * @package WordPress
 * @subpackage GeoffGrahamFour
 * @since GeoffGrahamFour 1.0
 */

get_header(); ?>


<?php if ( have_posts() ) : ?>
  <header>
	<h1><?php printf( __( 'Category Archives: %s', 'geoffgraham' ), '<span>' . single_cat_title( '', false ) . '</span>' ); ?></h1>

<?php if ( category_description() ) : // Show an optional category description ?
  <?php echo category_description(); ?>
<?php endif; ?>
</header>

<?php while ( have_posts() ) : the_post();
  get_template_part( 'content', get_post_format() );
  endwhile;
  twentytwelve_content_nav( 'nav-below' );
?>

<?php else : ?>
  <?php get_template_part( 'content', 'none' ); ?>
<?php endif; ?>

<?php get_footer(); ?>