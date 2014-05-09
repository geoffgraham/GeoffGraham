<?php
/**
 * @package WordPress
 * @subpackage GeoffGrahamFour
 * @since GeoffGrahamFour 1.0
 */
 get_header(); ?>

<section class="page">
  <div class="banner">
    <div class="wrapper">
      <h1><?php the_title(); ?></h1>
    </div><!-- wrapper -->
  </div><!-- banner -->
    <div class="wrapper">
      <div class="content">
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <?php the_content(); ?>
      <?php endwhile; endif; ?>
      </div><!-- content -->
    </div><!-- wrapper -->
</section><!-- page -->

<?php get_footer(); ?>
