<?php
/**
 * @package WordPress
 * @subpackage GeoffGrahamFour
 * @since GeoffGrahamFour 1.0
 */
 get_header(); ?>
 
<div class="fourohfour">
  <section class="banner">
    <div class="wrapper">
      <h1><span>Four-Oh-Four</span></h1>
      <h2>This page was not found.</h2>
      <a href="/" role="button" class="button-primary" alt="Geoff Graham Website Home">Take me home</a>
    </div><!-- wrapper -->
  </section><!-- banner -->
</div><!-- 404 -->

<?php include ('sidebar-portfolio-dark.php'); ?>

<script>
  $("h1").fitText(1.0, { minFontSize: '50px', maxFontSize: '300px' });
  $("h1").lettering();
</script>

<?php get_footer(); ?>