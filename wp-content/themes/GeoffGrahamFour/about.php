<?php
/**
 * Template Name: About
 * @package WordPress
 * @subpackage GeoffGrahamFour
 * @since GeoffGrahamFour 1.0
 */
 get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <?php the_content(); ?>
<?php endwhile; endif; ?>

<?php include ('sidebar-testimony.php'); ?>
<?php include ('sidebar-portfolio.php'); ?>

<script>
  $("h1").fitText(1.0, { minFontSize: '24px', maxFontSize: '100px' });
  $("h1").lettering();
</script>

<?php get_footer(); ?>