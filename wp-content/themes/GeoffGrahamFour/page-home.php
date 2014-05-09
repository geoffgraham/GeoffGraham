<?php
/**
 * Template Name: Homepage
 * @package WordPress
 * @subpackage GeoffGrahamFour
 * @since GeoffGrahamFour 1.0
 */
 get_header(); ?>

<div class="home">
  <div class="hero">
    <!--<h1 aria-hidden="true" data-icon="&#xe007; &#xe005; &#xe006;"></h1>-->
    <h1>Geoff Graham</h1>
    <h2>web design and development</h2>
    <a href="/contact" role="link" class="btn-secondary" alt="Hire Geoff Graham">Hire Me</a>
  </div><!-- hero -->
  
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <?php the_content(); ?>
  <?php endwhile; endif; ?>
  
  <?php include ('sidebar-portfolio.php'); ?>
  
</div><!--  home -->

<?php get_footer(); ?>
